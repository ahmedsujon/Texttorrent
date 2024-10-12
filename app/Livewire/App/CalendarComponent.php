<?php

namespace App\Livewire\App;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Number;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CalendarComponent extends Component
{
    use WithPagination;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $searchTerm, $sortingValue = 10, $delete_id, $edit_id;
    public $user_id, $name, $subject, $date, $time, $sender_number, $alert_before, $participant_number, $participant_email;

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

        $this->dispatch('refreshCalendar');
        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'New event added successfully']);
        $this->resetForm();
    }

    public $selected_event_id, $selectedEvent;
    public function viewData($id)
    {
        $event = Event::findOrFail($id);


        $this->selectedEvent = $event;
        $this->selected_event_id = $event->id;

        $this->dispatch('viewEventDetails');
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

        $this->dispatch('showEditModal', ['sender_number' => $event->sender_number, 'participant_number' => $event->participant_number]);
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

        $event = Event::find($this->edit_id);
        // $event->user_id = Auth::user()->id;
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
        $this->dispatch('success', ['message' => 'Event updated successfully']);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['name', 'subject', 'date', 'time', 'sender_number', 'alert_before', 'participant_number', 'participant_email', 'edit_id', 'user_id']);
    }

    public function delete($id)
    {
        Event::find($id)->delete();
        session()->flash('message', 'Event Deleted Successfully!');
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
        $this->dispatch('show_delete_confirmation_event');
    }

    public function deleteData()
    {
        $data = Event::where('id', $this->delete_id)->first();
        $data->delete();

        $this->dispatch('event_deleted');
        $this->delete_id = '';
    }

    public function render()
    {
        $active_numbers = Number::where('id', Auth::user()->id)->get();

        $formattedEvents = Event::where('user_id', Auth::user()->id)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'start' => Carbon::parse($event->date)->format('Y-m-d') . 'T' . Carbon::parse($event->time)->format('h:i:s'),
                    'classNames' => ['sms_event'],
                ];
            })
            ->toArray();

        $formattedEvents = json_encode($formattedEvents);
        return view('livewire.app.calendar-component', ['active_numbers' => $active_numbers, 'events' => $formattedEvents])->layout('livewire.app.layouts.base');
    }
}
