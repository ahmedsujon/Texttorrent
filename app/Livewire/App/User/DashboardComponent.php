<?php

namespace App\Livewire\App\User;

use Livewire\Component;
use App\Models\Transaction;

class DashboardComponent extends Component
{
    public function render()
    {
        $total_credits = Transaction::where('user_id', user()->id)->sum('credit');
        return view('livewire.app.user.dashboard-component', ['total_credits'=>$total_credits])->layout('livewire.app.layouts.base');
    }
}
