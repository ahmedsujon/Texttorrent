<?php

namespace App\Livewire\App;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Number;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CalendarComponent extends Component
{
    public $name, $subject, $date, $time, $sender_number, $alert_before, $participant_number, $participant_email, $edit_id, $user_id;

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'time' => 'required',
            'sender_number' => 'required',
            'alert_before' => 'required',
        ]);

        $event = new Event();
        $event->user_id = Auth::user()->id;
        $event->name = $this->name;
        $event->subject = $this->subject;
        $event->date = $this->date;
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
        $this->date = $event->date;
        $this->time = $event->time;
        $this->sender_number = $event->sender_number;
        $this->alert_before = $event->alert_before;
        $this->participant_number = $event->participant_number;
        $this->participant_email = $event->participant_email;
        $this->dispatch('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'time' => 'required',
            'sender_number' => 'required',
            'alert_before' => 'required',
        ]);

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
        $this->reset(['name', 'subject', 'date', 'time', 'sender_number', 'alert_before', 'participant_number', 'participant_email', 'edit_id', 'user_id']);
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
        $active_numbers = Number::where('id', Auth::user()->id)->get();

        $formattedEvents = Event::where('user_id', Auth::user()->id)
        ->get()
        ->map(function ($event) {
            return [
                'title' => $event->name,
                'start' => Carbon::parse($event->date)->format('Y-m-d').'T'.Carbon::parse($event->time)->format('h:i:s'),
                'classNames' => ['sms_event'],
            ];
        })
        ->toArray();

        $formattedEvents = json_encode($formattedEvents);

        // dd($formattedEvents);

        // $this->dispatch('reload_scripts');
        return view('livewire.app.calendar-component', ['active_numbers' => $active_numbers, 'events' => $formattedEvents])->layout('livewire.app.layouts.base');
    }
}
