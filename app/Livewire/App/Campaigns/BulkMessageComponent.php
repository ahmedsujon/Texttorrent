<?php

namespace App\Livewire\App\Campaigns;

use App\Models\BulkMessage;
use App\Models\BulkMessageItem;
use App\Models\ChatMessage;
use App\Models\Contact;
use App\Models\ContactList;
use App\Models\InboxTemplate;
use App\Models\Number;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class BulkMessageComponent extends Component
{
    use WithFileUploads;

    public $contact_list_id, $contact_list_name, $inbox_template_id, $selected_template_preview, $number_pool = true, $batch_process = true, $opt_out_link = true, $round_robin_campaign = true, $phone_numbers, $sms_type = 'sms', $sms_body, $appended_message, $batch_size, $batch_frequency, $sending_throttle, $file, $type;

    public function mount()
    {
        if (isUserPermitted('number-pool')) {
            $this->number_pool = true;
        } else {
            $this->number_pool = false;
        }
    }

    public function resetUpload()
    {
        $this->reset('file');
    }

    public function useTemplate($contact_id)
    {
        // $this->validate([
        //     'inbox_template_id' => 'required_if:sms_type,sms',
        // ], [
        //     'inbox_template_id.*' => 'Select a template',
        // ]);

        $contact = Contact::find($contact_id);
        $output = $this->sms_body; // Start with the template preview
        $output = str_replace('{phone_number}', $contact->number, $output);
        $output = str_replace('{email_address}', $contact->email, $output);
        $output = str_replace('{first_name}', $contact->first_name, $output);
        $output = str_replace('{last_name}', $contact->last_name, $output);
        $output = str_replace('{company}', $contact->company, $output);
        $output = processSpinText($output);

        return $output;
    }

    public $schedule_date, $schedule_time;
    public $selected_date, $selected_time;
    public function chooseTime()
    {
        $this->validate([
            'schedule_date' => 'required',
            'schedule_time' => 'required',
        ]);

        $this->selected_date = $this->schedule_date;
        $this->selected_time = $this->schedule_time;

        $this->dispatch('closeModal');
    }

    public $numbers = [], $all_numbers, $selectAllNumbers = false, $selectNumberSearch;
    public function selectPhoneNumbers($number)
    {
        $number = '+' . $number;

        if ($this->number_pool) {
            if (($key = array_search($number, $this->numbers)) !== false) {
                unset($this->numbers[$key]);
            } else {
                $this->numbers[] = $number;
            }
        } else {
            $this->numbers = [$number];
        }
    }

    public function updatedNumberPool()
    {
        if (!$this->number_pool) {
            $this->numbers = [];
            $this->selectAllNumbers = false;
        }
    }

    public function updatedSelectAllNumbers()
    {
        if ($this->selectAllNumbers) {
            $this->numbers = $this->all_numbers;
        } else {
            $this->numbers = [];
        }
    }

    public function selectList($id, $name)
    {
        $this->contact_list_id = $id;
        $this->contact_list_name = $name;

        $contactList = Contact::where('list_id', $this->contact_list_id)->where('blacklisted', 0)->get();
        $totalContacts = $contactList->count();

        $creditNeeded = msgCreditCalculation($this->sms_type, 'outgoing');
        $this->total_credit_without_seg = $creditNeeded * $totalContacts;
    }

    public $total_credit = 0, $total_credit_without_seg = 0;
    public function storeConfirmation()
    {
        $this->validate([
            'numbers' => 'required',
            'contact_list_id' => 'required',
            // 'inbox_template_id' => 'required_if:sms_type,sms',
            'batch_size' => 'required_if:batch_process,true',
            'batch_frequency' => 'required_if:batch_process,true',
            // 'sending_throttle' => 'required_if:batch_process,true',
            'appended_message' => 'required_if:opt_out_link,true',
            'sms_body' => 'required_if:sms_type,sms',
            'file' => 'required_if:sms_type,mms',
        ], [
            'numbers.required' => 'Phone number field is required',
            'contact_list_id.required' => 'Select a contact list',
            // 'inbox_template_id.*' => 'Select a template',
            'batch_size.*' => 'This field is required',
            'batch_frequency.*' => 'This field is required',
            // 'sending_throttle.*' => 'This field is required',
            'appended_message.*' => 'This field is required',
            'sms_body.*' => 'This field is required',
            'file.*' => 'This field is required',
        ]);

        $this->dispatch('showStoreDataConfirmation');
    }

    public function storeData()
    {
        if (getActiveSubscription()['status'] == 'Active') {

            if (user()->type == 'sub') {
                $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
                $credit_has = $au_user->credits;
                $user_id = $au_user->id;
            } else {
                $credit_has = user()->credits;
                $user_id = user()->id;
            }

            if ($credit_has >= $this->total_credit) {
                $data = new BulkMessage();
                $data->user_id = user()->id;
                $data->contact_list_id = $this->contact_list_id;
                $data->inbox_template_id = $this->inbox_template_id;
                $data->number_pool = $this->number_pool;
                $data->batch_process = $this->batch_process;
                $data->opt_out_link = $this->opt_out_link;
                $data->round_robin_campaign = $this->round_robin_campaign;
                $data->phone_numbers = $this->phone_numbers;
                $data->sms_type = $this->sms_type;
                $data->sms_body = $this->sms_body;
                $data->appended_message = $this->appended_message;
                $data->batch_size = $this->batch_size;
                $data->batch_frequency = $this->batch_frequency;
                // $data->sending_throttle = $this->sending_throttle;

                if ($this->sms_type == 'mms' && $this->file) {
                    $fileName = 'mms-' . uniqid() . Carbon::now()->timestamp . '.' . $this->file->extension();
                    $this->file->storeAs('uploads/mms_files', $fileName);
                    $data->file = 'uploads/mms_files/' . $fileName;
                }

                $data->save();

                // Check if schedule_date and schedule_time are provided
                if (!empty($this->selected_date) && !empty($this->selected_time)) {
                    $f_date = $this->selected_date . ' ' . $this->selected_time;
                    $scheduleDateTime = Carbon::parse($f_date);
                } else {
                    $scheduleDateTime = now(); // If no schedule provided, use current time
                }

                $contactList = Contact::where('list_id', $this->contact_list_id)->where('blacklisted', 0)->get();
                $totalContacts = $contactList->count();
                $batchSize = $this->batch_size ?? 100; // Default batch size
                $batchFrequency = $this->batch_frequency ?? 60; // Frequency in seconds (default to 60s between batches)

                $numberIndex = 0; // To keep track of the round-robin index
                $contactsProcessed = 0;
                $batchCount = 0;
                $availableNumbers = count($this->numbers); // Total available numbers

                foreach ($contactList as $key => $cList) {
                    if ($this->inbox_template_id) {
                        if ($this->opt_out_link) {
                            $message = $this->useTemplate($cList->id) . "\n" . $this->appended_message;
                        } else {
                            $message = $this->useTemplate($cList->id);
                        }
                    } else {
                        if ($this->opt_out_link) {
                            $message = $this->sms_body . "\n" . $this->appended_message;
                        } else {
                            $message = $this->sms_body;
                        }
                    }

                    // Reuse numbers even if there are fewer numbers than contacts
                    if ($this->number_pool) {
                        if ($this->round_robin_campaign) {
                            // Round-robin process
                            $number = $this->numbers[$numberIndex];
                            $numberIndex = ($numberIndex + 1) % $availableNumbers; // Rotate through numbers
                        } else {
                            // Random process
                            $number = $this->numbers[array_rand($this->numbers)];
                        }
                    } else {
                        // Default to the first number
                        $number = $this->numbers[0];
                    }

                    $sender = Number::select('user_id')->where('number', $number)->first();

                    // Create the SMS object
                    $sms = new BulkMessageItem();
                    $sms->bulk_message_id = $data->id;
                    // $sms->send_by = user()->id;
                    $sms->send_by = $sender->user_id;
                    $sms->send_from = $number;
                    $sms->send_to = $cList->number;
                    $sms->message = $message ? $message : null;
                    $sms->file = $data->file;
                    $sms->type = $data->sms_type;

                    if ($this->batch_process) {
                        // If batch_process is true, schedule the message with future execute_at time
                        $executeAt = $scheduleDateTime->copy()->addMinutes($batchCount * $batchFrequency);
                        $sms->execute_at = $executeAt;
                    } else {
                        // If batch_process is false, schedule all messages at the selected time (or now if schedule is empty)
                        $sms->execute_at = $scheduleDateTime;
                    }

                    $sms->status = 0; // Message is scheduled but not yet sent
                    $sms->save();

                    $contactsProcessed++;

                    // Increment the batch count for scheduling if batch processing is enabled
                    if ($this->batch_process && $contactsProcessed % $batchSize == 0) {
                        $batchCount++;
                    }
                }

                // credit deduction
                $user = User::find($user_id);
                $user->credits -= $this->total_credit;
                $user->save();

                // log
                creditLog('Send bulk messages', $this->total_credit);

                $this->dispatch('reset_form');
                $this->dispatch('closeModal');
                $this->dispatch('success', ['message' => 'Bulk message send successfully!']);
                if ($this->sms_type == 'mms') {
                    $this->resetUpload();
                }
                $this->resetForm();
            } else {
                $this->dispatch('error', ['message' => 'Not enough credit for this message!']);
            }
        } else {
            $this->dispatch('error', ['message' => 'No active subscription found!']);
        }
    }

    // public function updatedOptOutLink()
    // {
    //     if ($this->opt_out_link) {
    //         $this->dispatch('addOptOutLink', ['appended_message' => ""."\n"."" . $this->appended_message . ""."\n".""]);
    //     } else {
    //         $this->dispatch('addOptOutLink', ['appended_message' => '']);
    //     }
    // }

    // public function updatedAppendedMessage()
    // {
    //     if ($this->opt_out_link) {
    //         $this->dispatch('addOptOutLink', ['appended_message' => ""."\n"."" . $this->appended_message . ""."\n".""]);
    //     } else {
    //         $this->dispatch('addOptOutLink', ['appended_message' => '']);
    //     }
    // }

    public function resetForm()
    {
        $this->reset([
            'contact_list_id',
            'contact_list_name',
            'inbox_template_id',
            'selected_template_preview',
            'number_pool',
            'batch_process',
            'opt_out_link',
            'round_robin_campaign',
            'phone_numbers',
            'sms_type',
            'sms_body',
            'appended_message',
            'batch_size',
            'batch_frequency',
            // 'sending_throttle',
            'schedule_date',
            'schedule_time',
            'selected_date',
            'selected_time',
            'numbers',
            'total_credit',
            'total_credit_without_seg',
            'selectAllNumbers',
        ]);
    }

    public function updatedSmsType()
    {
        $contactList = Contact::where('list_id', $this->contact_list_id)->where('blacklisted', 0)->get();
        $totalContacts = $contactList->count();

        $creditNeeded = msgCreditCalculation($this->sms_type, 'outgoing');
        $this->total_credit_without_seg = $creditNeeded * $totalContacts;
    }

    public $charCount = 0;
    public $segments = 0;
    public function countSmsContent()
    {
        $smsBody = $this->sms_body . $this->appended_message;

        // Update character count
        $this->charCount = strlen($smsBody);

        // Calculate segments (GSM-7 encoding, 160 characters per segment)
        $this->segments = ceil($this->charCount / 160);
    }

    public function updatedSmsBody()
    {
        $this->countSmsContent();
    }
    public function updatedAppendedMessage()
    {
        $this->countSmsContent();
    }

    public function updatedRoundRobinCampaign()
    {
        $this->reset(['numbers', 'selectAllNumbers']);
    }

    public $searchContactList;
    public function render()
    {
        $contactLists = ContactList::where('name', 'like', '%' . $this->searchContactList . '%')->where('user_id', user()->id)->orderBy('id', 'DESC')->get();
        $messageTemplates = InboxTemplate::where('user_id', user()->id)->orderBy('id', 'DESC')->get();

        $user_ids = [user()->id];
        if ($this->round_robin_campaign) {
            $sub_users = DB::table('users')->where('parent_id', user()->id)->pluck('id')->toArray();
            $user_ids = array_merge($user_ids, $sub_users);
        }

        $activeNumbers = Number::whereIn('user_id', $user_ids)->where('number', 'like', '%' . $this->selectNumberSearch . '%')->where('status', 1)->orderBy('id', 'DESC')->get();

        $this->all_numbers = $activeNumbers->pluck('number')->toArray();

        if ($this->segments > 0) {
            $this->total_credit = $this->total_credit_without_seg * $this->segments;
        } else {
            $this->total_credit = $this->total_credit_without_seg;
        }

        return view(
            'livewire.app.campaigns.bulk-message-component',
            [
                'contactLists' => $contactLists,
                'messageTemplates' => $messageTemplates,
                'activeNumbers' => $activeNumbers,
            ]
        )->layout('livewire.app.layouts.base');
    }
}
