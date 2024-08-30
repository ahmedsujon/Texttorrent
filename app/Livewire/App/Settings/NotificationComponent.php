<?php

namespace App\Livewire\App\Settings;

use Livewire\Component;

class NotificationComponent extends Component
{
    public function render()
    {
        return view('livewire.app.settings.notification-component')->layout('livewire.app.layouts.base');
    }
}
