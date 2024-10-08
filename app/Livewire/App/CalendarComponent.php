<?php

namespace App\Livewire\App;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CalendarComponent extends Component
{
    public $name, $subject, $time, $sender_number, $alert_before, $participant_number, $participant_email, $edit_id, $user_id;
    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'subject' => 'required',
            'time' => 'required',
            'sender_number' => 'required',
            'alert_before' => 'required',
            'participant_number' => 'required',
            'participant_email' => 'required',
        ]);

        $event = new Event();
        $event->user_id = Auth::user()->id;
        $event->name = $this->name;
        $event->subject = $this->subject;
        $event->time = $this->time;
        $event->sender_number = $this->sender_number;
        $event->alert_before = $this->alert_before;
        $event->participant_number = $this->participant_number;
        $event->participant_email = $this->participant_email;
        $event->save();

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'New event added successfully']);
        $this->resetForm();
    }

    public function editData($id)
    {
        $event = Event::findOrFail($id);
        $this->edit_id = $event->id;
        $this->user_id = $event->user_id;
        $this->name = $event->name;
        $this->subject = $event->subject;
        $this->time = $event->time;
        $this->sender_number = $event->sender_number;
        $this->alert_before = $event->alert_before;
        $this->participant_number = $event->participant_number;
        $this->participant_email = $event->participant_email;
        $this->dispatch('showEditModal');
    }

    public function updateData()
    {
        if ($this->password) {
            $this->validate([
                'username' => 'required|unique:users,username,' . $this->edit_id . '',
                'email' => 'required|email|unique:users,email,' . $this->edit_id . '',
                'first_name' => 'required|max:20',
                'last_name' => 'required|max:20',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|same:password',
            ]);
        } else {
            $this->validate([
                'username' => 'required|unique:users,username,' . $this->edit_id . '',
                'email' => 'required|email|unique:users,email,' . $this->edit_id . '',
                'first_name' => 'required|max:20',
                'last_name' => 'required|max:20',
            ]);
        }

        $user = User::find($this->edit_id);
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->permissions = $this->permissions;
        $user->save();

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'User updated successfully']);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['', 'name', 'subject', 'time', 'sender_number', 'alert_before', 'participant_number', 'participant_email']);
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Sub Account Deleted Successfully.');
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
        $data = User::where('id', $this->delete_id)->first();
        $data->delete();

        $this->dispatch('user_deleted');
        $this->delete_id = '';
    }

    public function changeStatus($id, $status)
    {
        User::where('id', $id)->update(['status' => ($status == 1 ? 0 : 1)]);
        $this->dispatch('success', ['message' => 'User updated successfully.']);
    }

    public function render()
    {
        return view('livewire.app.calendar-component')->layout('livewire.app.layouts.base');
    }
}
