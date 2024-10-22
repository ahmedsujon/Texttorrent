<?php

namespace App\Livewire\App;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.app.home-component')->layout('livewire.app.layouts.app_base');
    }
}
