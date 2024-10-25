<?php

namespace App\Livewire\App\Campaigns;

use App\Models\BulkMessage;
use App\Models\BulkMessageItem;
use App\Models\Contact;
use App\Models\ContactList;
use App\Models\InboxTemplate;
use App\Models\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BulkMessageComponent extends Component
{
    public $contact_list_id, $contact_list_name, $inbox_template_id, $selected_template_preview, $number_pool = true, $batch_process = true, $opt_out_link = true, $round_robin_campaign = true, $phone_numbers, $sms_type, $sms_body, $appended_message, $batch_size, $batch_frequency, $sending_throttle;

    public function useTemplate($contact_id)
    {
        $this->validate([
            'inbox_template_id' => 'required',
        ], [
            'inbox_template_id.required' => 'Select a template',
        ]);

        $contact = Contact::find($contact_id);
        $output = $this->selected_template_preview; // Start with the template preview
        $output = str_replace('[phone_number]', $contact->number, $output);
        $output = str_replace('[email_address]', $contact->email, $output);
        $output = str_replace('[first_name]', $contact->first_name, $output);
        $output = str_replace('[last_name]', $contact->last_name, $output);
        $output = str_replace('[company]', $contact->company, $output);

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
    }

    public function storeData()
    {
        $this->validate([
            'numbers' => 'required',
            'contact_list_id' => 'required',
            'inbox_template_id' => 'required',
            'batch_size' => 'required_if:batch_process,true',
            'batch_frequency' => 'required_if:batch_process,true',
            'sending_throttle' => 'required_if:batch_process,true',
            'appended_message' => 'required_if:opt_out_link,true',
        ], [
            'numbers.required' => 'Phone number field is required',
            'contact_list_id.required' => 'Select a contact list',
            'inbox_template_id.required' => 'Select a template',
            'batch_size.*' => 'This field is required',
            'batch_frequency.*' => 'This field is required',
            'sending_throttle.*' => 'This field is required',
            'appended_message.*' => 'This field is required',
        ]);

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
        $data->sending_throttle = $this->sending_throttle;
        $data->save();

        // Check if schedule_date and schedule_time are provided
        if (!empty($this->selected_date) && !empty($this->selected_time)) {
            $f_date = $this->selected_date . ' ' . $this->selected_time;
            $scheduleDateTime = Carbon::parse($f_date);
        } else {
            $scheduleDateTime = now(); // If no schedule provided, use current time
        }

        $contactList = Contact::where('list_id', $this->contact_list_id)->get();
        $totalContacts = $contactList->count();
        $batchSize = $this->batch_size ?? 100; // Default batch size
        $batchFrequency = $this->batch_frequency ?? 60; // Frequency in seconds (default to 60s between batches)

        $numberIndex = 0; // To keep track of the round-robin index
        $contactsProcessed = 0;
        $batchCount = 0;
        $availableNumbers = count($this->numbers); // Total available numbers

        foreach ($contactList as $key => $cList) {
            $message = $this->useTemplate($cList->id);

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

            // Create the SMS object
            $sms = new BulkMessageItem();
            $sms->bulk_message_id = $data->id;
            $sms->send_from = $number;
            $sms->send_to = $cList->number;
            $sms->message = $message;

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

        $this->dispatch('reset_form');
        $this->dispatch('success', ['message' => 'Bulk message send successfully!']);
        $this->resetForm();
    }

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
            'sending_throttle',
            'schedule_date',
            'schedule_time',
            'selected_date',
            'selected_time',
            'numbers',
            'selectAllNumbers',
        ]);
    }

    public $searchContactList;
    public function render()
    {
        $contactLists = ContactList::where('name', 'like', '%' . $this->searchContactList . '%')->orderBy('id', 'DESC')->get();
        $messageTemplates = InboxTemplate::orderBy('id', 'DESC')->get();
        $activeNumbers = Number::where('user_id', Auth::user()->id)->where('number', 'like', '%' . $this->selectNumberSearch . '%')->orderBy('id', 'DESC')->get();

        $this->all_numbers = $activeNumbers->pluck('number')->toArray();

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
