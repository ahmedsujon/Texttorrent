<?php

namespace App\Livewire\App\Settings;

use Livewire\Component;

class LogsComponent extends Component
{
    public function render()
    {
        return view('livewire.app.settings.logs-component')->layout('livewire.app.layouts.base');
    }
}
