<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Subscription;

class DashboardComponent extends Component
{
    public function render()
    {
        $subscriptions = Subscription::orderBy('id', 'DESC')->take(10)->get();
        return view('livewire.admin.dashboard-component', ['subscriptions'=>$subscriptions])->layout('livewire.admin.layouts.base');
    }
}
