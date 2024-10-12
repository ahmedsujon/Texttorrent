<?php

namespace App\Livewire\App\Settings;

use App\Models\User;
use App\Models\Number;
use Livewire\Component;
use Twilio\Rest\Client;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

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
            $this->sortDirection = ($this->sortDirection ==  "ASC") ? 'DESC' : "ASC";
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

    public function releaseNumber($id, $status)
    {
        $number = Number::find($id);
        if ($number) {
            // If status is 'Active' or whatever the current status, change it to 'Released' (e.g., status = 2)
            $newStatus = 2; // Assuming 2 is for 'Released'
            $number->update(['status' => $newStatus]);

            // Initialize Twilio Client
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            try {
                // Release the number from Twilio
                $twilio->incomingPhoneNumbers($number->twilio_number_sid)->delete();

                // Dispatch success message
                $this->dispatch('success', ['message' => 'Number released successfully.']);
            } catch (\Exception $e) {
                // Dispatch error message if Twilio release fails
                $this->dispatch('error', ['message' => 'Failed to release the number.']);
            }
        } else {
            // Dispatch error message if the number is not found
            $this->dispatch('error', ['message' => 'Number not found.']);
        }
    }

    public function render()
    {
        $sub_accounts = User::where('type', 'sub')->where('parent_id', user()->id)->get();
        $numbers = Number::where('user_id', user()->id)->where(function ($q) {
            $q->where('number', 'like', '%' . $this->searchTerm . '%');
        })->orderBy($this->sortBy, $this->sortDirection)->paginate($this->sortingValue);

        return view('livewire.app.settings.active-number-component', ['numbers' => $numbers, 'sub_accounts'=>$sub_accounts])->layout('livewire.app.layouts.base');
    }
}
