<?php

namespace App\Livewire\Web;

use Livewire\Component;

class SubscriptionSuccessComponent extends Component
{
    public function render()
    {
        return view('livewire.web.subscription-success-component')->layout('livewire.web.layouts.base');
    }
}
