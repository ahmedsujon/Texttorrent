<?php

namespace App\Livewire\App;

use Livewire\Component;

class CalendarComponent extends Component
{
    public function render()
    {
        return view('livewire.app.calendar-component')->layout('livewire.app.layouts.base');
    }
}
