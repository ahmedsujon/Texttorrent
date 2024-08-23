<?php

namespace App\Livewire\App\User;

use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.app.user.dashboard-component')->layout('livewire.app.layouts.base');
    }
}
