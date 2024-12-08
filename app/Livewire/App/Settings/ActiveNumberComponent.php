<?php

namespace App\Livewire\App\Settings;

use App\Models\Number;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Twilio\Rest\Client;

class ActiveNumberComponent extends Component
{
    use WithPagination;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $searchTerm, $sortingValue = 10, $delete_id, $edit_id, $TWILIO_SID, $TWILIO_AUTH_TOKEN;

    public function mount()
    {
        if (user()->type == 'sub') {
            $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
            $user_id = $au_user->id;
        } else {
            $user_id = user()->id;
        }

        $twilioCredentials = DB::table('apis')
            ->where('user_id', $user_id)
            ->where('gateway', 'Twilio')
            ->first();

        if ($twilioCredentials) {
            $this->TWILIO_SID = $twilioCredentials->account_sid;
            $this->TWILIO_AUTH_TOKEN = $twilioCredentials->auth_token;
        } else {
            if (user()->type == 'sub') {
                return redirect()->route('user.apiAlertSubAccount');
            } else {
                session()->flash('error', 'Please add your Twilio API.');
                return redirect()->route('user.apis');
            }
        }
    }

    public function delete($id)
    {
        Number::find($id)->delete();
        session()->flash('message', 'Number Deleted Successfully.');
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDirection = ($this->sortDirection == "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDirection = 'DESC';
    }

    //Delete Admin
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        $data = Number::where('id', $this->delete_id)->first();
        $data->delete();

        $this->dispatch('number_deleted');
        $this->delete_id = '';
    }

    public function changeStatus($id, $status)
    {
        Number::where('id', $id)->update(['status' => ($status == 1 ? 0 : 1)]);
        $this->dispatch('success', ['message' => 'Number updated successfully.']);
    }

    public $release_id, $release_status;
    public function releaseConfirmation($id, $status)
    {
        $this->release_id = $id;
        $this->release_status = $status;

        $this->dispatch('show_release_modal');
    }

    public function releaseNumber()
    {
        $id = $this->release_id;
        $status = $this->release_status;

        $number = Number::find($id);
        if ($number) {
            // If status is 'Active' or whatever the current status, change it to 'Released' (e.g., status = 2)
            $newStatus = 2; // Assuming 2 is for 'Released'
            DB::table('numbers')->where('id', $id)->update(['status' => $newStatus]);

            // Initialize Twilio Client
            $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);

            try {
                if ($number->twilio_number_sid) {
                    // Release the number from Twilio
                    $twilio->incomingPhoneNumbers($number->twilio_number_sid)->delete();

                    DB::table('numbers')->where('id', $id)->delete();

                    // Dispatch success message
                    $this->dispatch('closeModal');
                    $this->dispatch('success', ['message' => 'Number released successfully.']);
                } else {
                    $this->dispatch('closeModal');
                    $this->dispatch('error', ['message' => 'Failed to release the number.']);
                }
            } catch (\Exception $e) {
                // Dispatch error message if Twilio release fails
                $this->dispatch('error', ['message' => 'Failed to release the number.']);
            }
        } else {
            // Dispatch error message if the number is not found
            $this->dispatch('error', ['message' => 'Number not found.']);
        }
    }

    public function setWebhook($phoneNumber)
    {
        if (user()->type == 'sub') {
            $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
            $user_id = $au_user->id;
        } else {
            $user_id = user()->id;
        }

        $twilioCredentials = DB::table('apis')
            ->where('user_id', $user_id)
            ->where('gateway', 'Twilio')
            ->first();

        if ($twilioCredentials) {

            $sid = $twilioCredentials->account_sid;
            $token = $twilioCredentials->auth_token;

            try {
                $client = new Client($sid, $token);
                $client->incomingPhoneNumbers
                    ->read(['phoneNumber' => $phoneNumber])[0]
                    ->update([
                        "smsUrl" => 'https://texttorrent.com/api/v1/twilio/incoming-message',
                        "voiceUrl" => 'https://texttorrent.com/api/v1/twilio/incoming-message',
                    ]);
                $this->dispatch('success', ['message' => 'Webhook updated successfully']);
            } catch (\Exception $e) {
                $this->dispatch('error', ['message' => 'Failed to update webhook URL: ' . $e->getMessage()]);
            }
        }
    }

    public $selectedNumbers = [], $allNumberIDs, $s_numbers, $check_all;
    public function selectAll()
    {
        if ($this->check_all) {
            $this->selectedNumbers = $this->allNumberIDs;
        } else {
            $this->selectedNumbers = [];
        }
    }

    public $user_to_assign;
    public function assignNumberToUser()
    {
        if ($this->selectedNumbers != []) {
            $this->s_numbers = Number::whereIn('id', $this->selectedNumbers)->pluck('number')->toArray();
            $this->dispatch('showNumberAssignModal');
        } else {
            $this->dispatch('error', ['message' => 'Select a number first!']);
        }
    }

    public function assignToUser()
    {
        $this->validate([
            'user_to_assign' => 'required|exists:users,id',
        ]);
        foreach ($this->selectedNumbers as $number_id) {
            $number = Number::where('id', $number_id)->first();
            $number->purchased_by = $number->user_id;
            $number->user_id = $this->user_to_assign;
            $number->save();
        }

        $this->reset(['selectedNumbers']);

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'User has been assigned']);
    }

    public function bulkReleaseConfirmation()
    {
        if ($this->selectedNumbers != []) {
            $this->s_numbers = Number::whereIn('id', $this->selectedNumbers)->pluck('number')->toArray();
            $this->dispatch('showBulkReleaseConfirmation');
        } else {
            $this->dispatch('error', ['message' => 'Select a number first!']);
        }
    }

    public function bulkRelease()
    {
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);
        foreach ($this->selectedNumbers as $num_id) {
            $number = DB::table('numbers')->select('id', 'twilio_number_sid')->where('id', $num_id)->first();
            if ($number->twilio_number_sid) {
                $twilio->incomingPhoneNumbers($number->twilio_number_sid)->delete();
                DB::table('numbers')->where('id', $number->id)->delete();
            }
        }
        $this->dispatch('numberReleased');
    }

    public $renew_id;
    public function renewConfirmation($id)
    {
        $this->renew_id = $id;
        $this->dispatch('showRenewModal');
    }
    public function renewNumber()
    {
        if (user()->type == 'sub') {
            $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
            $user_id = $au_user->id;
            $creditBalance = $au_user->credits;
        } else {
            $user_id = user()->id;
            $creditBalance = user()->credits;
        }

        if ($creditBalance >= 300) {
            $number = Number::where('id', $this->renew_id)->first();
            $number->next_renew_date = Carbon::now()->addDays(30);
            $number->status = 1;
            $number->save();

            $user = User::find($user_id);
            $user->credits -= 300;
            $user->save();

            // Optionally, log the renewal
            $trx = new Transaction();
            $trx->user_id = $user->id;
            $trx->transaction_type = 'number_renewal';
            $trx->description = 'Renewed number: ' . $number->number;
            $trx->credit = -300;
            $trx->save();

            $this->renew_id = '';
            $this->dispatch('numberRenewed');
        } else {
            $this->dispatch('error', ['message' => 'Not enough credit to renew this number!']);
        }

    }

    public function updatedSearchTerm()
    {
        $this->check_all = false;
        $this->selectedNumbers = [];
    }
    public function updatedSortType()
    {
        $this->check_all = false;
        $this->selectedNumbers = [];
    }
    public function updatedSortStatus()
    {
        $this->check_all = false;
        $this->selectedNumbers = [];
    }

    // Don't delete this
    public function numberServices($number_id = null)
    {
        if (user()->type == 'sub') {
            $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
            $user_id = $au_user->id;
        } else {
            $user_id = user()->id;
        }

        $number = Number::find($number_id);
        $twilioCredentials = DB::table('apis')
            ->where('user_id', $user_id)
            ->where('gateway', 'Twilio')
            ->first();

        if ($twilioCredentials) {

            $sid = $twilioCredentials->account_sid;
            $token = $twilioCredentials->auth_token;

            try {
                // Initialize the Twilio Client
                $client = new Client($sid, $token);

                // // Define the name of the Messaging Service you want to use or create
                // $serviceName = "TextTorrent Messaging Service";

                // // Get the Phone Number SID from your database or request
                // $phoneNumberSid = $number->twilio_number_sid; // Replace with your Phone Number SID

                // // Check if the phone number is associated with any service
                // $services = $client->messaging->v1->services->read();
                // $isNumberInAnotherService = false;
                // $existingServiceSid = null;

                // foreach ($services as $service) {
                //     $phoneNumbers = $client->messaging->v1->services($service->sid)->phoneNumbers->read();

                //     foreach ($phoneNumbers as $number) {
                //         if ($number->sid === $phoneNumberSid) {
                //             $isNumberInAnotherService = true;
                //             $existingServiceSid = $service->sid;
                //             break 2; // Exit both loops if the number is found in any service
                //         }
                //     }
                // }

                // // If the phone number is already associated with another service, skip adding
                // if ($isNumberInAnotherService) {
                //     $output = [
                //         'message' => 'Phone number is already associated with another service.',
                //         'existingServiceSid' => $existingServiceSid,
                //     ];
                // } else {
                //     // Check if "TextTorrent Messaging Service" exists or create a new one
                //     $targetService = null;
                //     foreach ($services as $service) {
                //         if ($service->friendlyName === $serviceName) {
                //             $targetService = $service;
                //             break;
                //         }
                //     }

                //     // If the "TextTorrent Messaging Service" does not exist, create it
                //     if (!$targetService) {
                //         $targetService = $client->messaging->v1->services->create($serviceName);
                //     }

                //     // Add the phone number to the "TextTorrent Messaging Service"
                //     $client->messaging->v1->services($targetService->sid)
                //         ->phoneNumbers
                //         ->create($phoneNumberSid);

                //     $output = [
                //         'message' => 'Phone number added to "TextTorrent Messaging Service".',
                //         'serviceSid' => $targetService->sid,
                //     ];
                // }

                // // Return or print the output
                // dd($output);

                // Fetch all Messaging Services
                $services = $client->messaging->v1->services->read();
                $result = [];
                foreach ($services as $service) {
                    $phoneNumbers = $client->messaging->v1
                        ->services($service->sid)
                        ->phoneNumbers
                        ->read();
                    $result[] = [
                        'serviceSid' => $service->sid,
                        'friendlyName' => $service->friendlyName,
                        'phoneNumbers' => array_map(function ($number) {
                            return [
                                'phoneNumber' => $number->phoneNumber,
                                'sid' => $number->sid,
                            ];
                        }, $phoneNumbers),
                    ];
                }
                dd($result);

                // $result = [];
                // $numbers = Number::where('user_id', 1)->pluck('number')->toArray();
                // foreach ($numbers as $key => $number) {
                //     $numberDetails = $client->lookups->v1->phoneNumbers($number)
                //                      ->fetch(["type" => ["caller-name"]]);

                //     $result[] = $numberDetails;
                // }
                // dd($result);

                // $client->messaging->v1->services($sid)->delete();
                // $this->dispatch('success', ['message' => 'Service Deleted']);

            } catch (\Exception $e) {
                dd($e->getMessage());
                // $this->dispatch('error', ['message' => 'Failed' . $e->getMessage()]);
            }
        }
    }

    public function fetchPurchasedNumbers()
    {
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);

        try {
            // Fetch purchased numbers
            $incomingNumbers = $twilio->incomingPhoneNumbers->read();

            // Convert each number to a simple array
            $numbers_array = [];

            foreach ($incomingNumbers as $number) {
                $reflectedObject = new \ReflectionObject($number->capabilities);
                $props = $reflectedObject->getProperties(\ReflectionProperty::IS_PROTECTED);

                $caps = [];
                foreach ($props as $prop) {
                    $prop->setAccessible(true);
                    $caps[$prop->getName()] = $prop->getValue($number->capabilities);
                }

                // Create a simple array for each number
                $numbers_array[] = [
                    'sid' => $number->sid,
                    'friendlyName' => $number->friendlyName,
                    'phoneNumber' => $number->phoneNumber,
                    'capabilities' => $caps,
                    'type' => $caps['sms'] ? 'local' : 'tollfree',
                    'purchased_at' => Carbon::parse($number->dateCreated)->format('Y-m-d H:i:s'),
                ];
            }

            return $numbers_array;
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to fetch purchased numbers: ' . $e->getMessage());
            return [];
        }
    }

    public $numbers_to_sync, $total_numbers_to_sync, $total_credit_for_sync;
    public function syncNumbersConfirmation()
    {
        $numbers = $this->fetchPurchasedNumbers();
        $total_numbers_to_sync = 0;
        $numbers_to_sync = [];
        if (count($numbers) > 0) {
            foreach ($numbers as $key => $number) {
                // Check if number exists in our database
                $existing_number = Number::where('number', $number['phoneNumber'])->first();

                // If it doesn't exist, create a new record
                if (!$existing_number) {
                    $numbers_to_sync[] = $number;
                    $total_numbers_to_sync++;
                }
            }
        }

        $this->numbers_to_sync = $numbers_to_sync;
        $this->total_numbers_to_sync = $total_numbers_to_sync;
        $this->total_credit_for_sync = $total_numbers_to_sync * 300;

        if ($total_numbers_to_sync > 0) {
            $this->dispatch('showSyncConfirmation');
        } else {
            $this->dispatch('error', ['message' => 'No available numbers to sync!']);
        }
    }

    public function syncNumbers()
    {
        if (user()->type == 'sub') {
            $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
            $credit_has = $au_user->credits;
            $user_id = $au_user->id;
        } else {
            $credit_has = user()->credits;
            $user_id = user()->id;
        }

        if (getUserActiveSubscription($user_id)['status'] == 'Active') {
            if ($credit_has >= $this->total_credit_for_sync) {
                foreach ($this->numbers_to_sync as $key => $num) {
                    $number = new Number();
                    $number->user_id = user()->id;
                    $number->purchased_by = user()->id;
                    $number->number = $num['phoneNumber'];
                    $number->friendly_name = $num['friendlyName'];
                    $number->region = NULL;
                    $number->country = 'US';
                    $number->latitude = NULL;
                    $number->longitude = NULL;
                    $number->postal_code = NULL;
                    $number->capabilities = $num['capabilities'];
                    $number->twilio_number_sid = $num['sid'];
                    $number->twilio_service_sid = $this->getServiceSid($num['sid']);
                    $number->webhook = $this->setWebhookSt($num['phoneNumber']);
                    $number->type = $num['type'];
                    $number->purchased_at = $num['purchased_at'];
                    $number->next_renew_date = Carbon::parse(now())->addMonths(1);
                    $number->save();
                }

                // Subtract the credit used for sync
                $user = User::find($user_id);
                $user->credits -= $this->total_credit_for_sync;
                $user->save();

                // Optionally, log the sync
                creditLog('Number sync: '. $this->total_numbers_to_sync.' numbers', $this->total_credit_for_sync);

                $this->dispatch('syncSuccess');
                $this->reset(['numbers_to_sync', 'total_numbers_to_sync', 'total_credit_for_sync']);
            } else {
                $this->dispatch('error', ['message' => 'You do not have enough credits to sync numbers.']);
            }

        } else {
            $this->dispatch('error', ['message' => 'No active subscription. Please upgrade your subscription.']);
        }

    }

    public function setWebhookSt($number)
    {
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);
        $twilio->incomingPhoneNumbers
            ->read(['phoneNumber' => $number])[0]
            ->update([
                "smsUrl" => 'https://texttorrent.com/api/v1/twilio/incoming-message',
                "voiceUrl" => 'https://texttorrent.com/api/v1/twilio/incoming-message',
            ]);

        return 1;
    }

    public function getServiceSid($number_sid)
    {
        $client = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);

        try {
            $services = $client->messaging->v1->services->read();

            foreach ($services as $service) {
                $phoneNumbers = $client->messaging->v1
                    ->services($service->sid)
                    ->phoneNumbers
                    ->read();

                // Check if the given number SID exists in the current service
                foreach ($phoneNumbers as $phoneNumber) {
                    if ($phoneNumber->sid === $number_sid) {
                        // Return the service SID if the number is found
                        return $service->sid;
                    }
                }
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public $sort_type = 'all', $sort_status = 'all';
    public function render()
    {
        $sub_accounts = User::where('type', 'sub')->where('status', 1)->where('parent_id', user()->id)->get();

        if (user()->type == 'sub') {
            $numbers = Number::where('user_id', user()->id);
        } else {
            $user_ids = [user()->id];
            $sub_user_ids = $sub_accounts->pluck('id')->toArray();
            $user_ids = array_merge($user_ids, $sub_user_ids);

            $numbers = Number::where(function ($qs) use($user_ids) {
                $qs->whereIn('user_id', $user_ids)
                    ->orWhereIn('purchased_by', $user_ids);
            });
        }

        $numbers->where(function ($q) {
            $q->where('number', 'like', '%' . $this->searchTerm . '%');
        })->orderBy($this->sortBy, $this->sortDirection);

        if ($this->sort_type && $this->sort_type != 'all') {
            $numbers = $numbers->where('type', $this->sort_type);
        }

        if ($this->sort_status && $this->sort_status != 'all') {
            $numbers = $numbers->where('status', $this->sort_status);
        }

        $numbers = $numbers->paginate($this->sortingValue);

        $this->allNumberIDs = $numbers->pluck('id')->toArray();

        return view('livewire.app.settings.active-number-component', ['numbers' => $numbers, 'sub_accounts' => $sub_accounts])->layout('livewire.app.layouts.base');
    }
}
