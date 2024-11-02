<?php

namespace App\Livewire\App\Settings;

use App\Models\Number;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Twilio\Rest\Client;

class ActiveNumberComponent extends Component
{
    use WithPagination;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $searchTerm, $sortingValue = 10, $delete_id, $edit_id;

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
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            try {
                if ($number->twilio_number_sid) {
                    // Release the number from Twilio
                    $twilio->incomingPhoneNumbers($number->twilio_number_sid)->delete();

                    // Dispatch success message
                    $this->dispatch('success', ['message' => 'Number released successfully.']);
                } else {
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
        $twilioCredentials = DB::table('apis')
            ->where('user_id', auth()->id())
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
            Number::where('id', $number_id)->update(['user_id' => $this->user_to_assign]);
        }

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'User has been assigned']);
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
    // public function numberServices($number_id)
    // {
    //     $number = Number::find($number_id);
    //     $twilioCredentials = DB::table('apis')
    //         ->where('user_id', auth()->id())
    //         ->where('gateway', 'Twilio')
    //         ->first();

    //     if ($twilioCredentials) {

    //         $sid = $twilioCredentials->account_sid;
    //         $token = $twilioCredentials->auth_token;

    //         try {
    //             // Initialize the Twilio Client
    //             $client = new Client($sid, $token);

    //             // // Define the name of the Messaging Service you want to use or create
    //             // $serviceName = "TextTorrent Messaging Service";

    //             // // Get the Phone Number SID from your database or request
    //             // $phoneNumberSid = $number->twilio_number_sid; // Replace with your Phone Number SID

    //             // // Check if the phone number is associated with any service
    //             // $services = $client->messaging->v1->services->read();
    //             // $isNumberInAnotherService = false;
    //             // $existingServiceSid = null;

    //             // foreach ($services as $service) {
    //             //     $phoneNumbers = $client->messaging->v1->services($service->sid)->phoneNumbers->read();

    //             //     foreach ($phoneNumbers as $number) {
    //             //         if ($number->sid === $phoneNumberSid) {
    //             //             $isNumberInAnotherService = true;
    //             //             $existingServiceSid = $service->sid;
    //             //             break 2; // Exit both loops if the number is found in any service
    //             //         }
    //             //     }
    //             // }

    //             // // If the phone number is already associated with another service, skip adding
    //             // if ($isNumberInAnotherService) {
    //             //     $output = [
    //             //         'message' => 'Phone number is already associated with another service.',
    //             //         'existingServiceSid' => $existingServiceSid,
    //             //     ];
    //             // } else {
    //             //     // Check if "TextTorrent Messaging Service" exists or create a new one
    //             //     $targetService = null;
    //             //     foreach ($services as $service) {
    //             //         if ($service->friendlyName === $serviceName) {
    //             //             $targetService = $service;
    //             //             break;
    //             //         }
    //             //     }

    //             //     // If the "TextTorrent Messaging Service" does not exist, create it
    //             //     if (!$targetService) {
    //             //         $targetService = $client->messaging->v1->services->create($serviceName);
    //             //     }

    //             //     // Add the phone number to the "TextTorrent Messaging Service"
    //             //     $client->messaging->v1->services($targetService->sid)
    //             //         ->phoneNumbers
    //             //         ->create($phoneNumberSid);

    //             //     $output = [
    //             //         'message' => 'Phone number added to "TextTorrent Messaging Service".',
    //             //         'serviceSid' => $targetService->sid,
    //             //     ];
    //             // }

    //             // // Return or print the output
    //             // dd($output);

    //             // Fetch all Messaging Services
    //             $services = $client->messaging->v1->services->read();
    //             $result = [];
    //             foreach ($services as $service) {
    //                 $phoneNumbers = $client->messaging->v1
    //                     ->services($service->sid)
    //                     ->phoneNumbers
    //                     ->read();
    //                 $result[] = [
    //                     'serviceSid' => $service->sid,
    //                     'friendlyName' => $service->friendlyName,
    //                     'phoneNumbers' => array_map(function ($number) {
    //                         return [
    //                             'phoneNumber' => $number->phoneNumber,
    //                             'sid' => $number->sid,
    //                         ];
    //                     }, $phoneNumbers),
    //                 ];
    //             }
    //             dd($result);

    //             // $client->messaging->v1->services($sid)->delete();
    //             // $this->dispatch('success', ['message' => 'Service Deleted']);

    //         } catch (\Exception $e) {
    //             dd($e->getMessage());
    //             // $this->dispatch('error', ['message' => 'Failed' . $e->getMessage()]);
    //         }
    //     }
    // }

    public $sort_type = 'all', $sort_status = 'all';
    public function render()
    {
        $sub_accounts = User::where('type', 'sub')->where('status', 1)->where('parent_id', user()->id)->get();
        $numbers = Number::where('user_id', user()->id)->where(function ($q) {
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
