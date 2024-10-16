<?php

namespace App\Livewire\Web;

use Livewire\Component;

class PricingComponent extends Component
{
    public $user_id, $package_type, $package_name, $amount;

    public function render()
    {
        return view('livewire.web.pricing-component')->layout('livewire.web.layouts.base');
    }
}
