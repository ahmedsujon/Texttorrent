<?php

namespace App\Livewire\App\User;

use Carbon\Carbon;
use App\Models\Event;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardComponent extends Component
{
    public $selected_event_id, $selectedEvent;
    public function viewData($id)
    {
        $event = Event::findOrFail($id);


        $this->selectedEvent = $event;
        $this->selected_event_id = $event->id;

        $this->dispatch('viewEventDetails');
    }

    public function render()
    {
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

        $total_credits = Transaction::where('user_id', user()->id)->sum('credit');
        return view('livewire.app.user.dashboard-component', ['total_credits'=>$total_credits, 'events'=>$formattedEvents])->layout('livewire.app.layouts.base');
    }
}
