<?php

namespace App\Livewire\App\Settings;

use Livewire\Component;

class ChangePasswordComponent extends Component
{
    public function render()
    {
        return view('livewire.app.settings.change-password-component')->layout('livewire.app.layouts.base');
    }
}
