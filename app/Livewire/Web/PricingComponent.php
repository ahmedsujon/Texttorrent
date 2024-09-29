<?php

namespace App\Livewire\Web;

use Livewire\Component;

class PricingComponent extends Component
{
    public function render()
    {
        return view('livewire.web.pricing-component')->layout('livewire.web.layouts.base');
    }
}
