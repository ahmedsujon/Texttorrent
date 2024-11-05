<?php

namespace App\Livewire\App\Settings;

use Stripe\Stripe;
use Livewire\Component;
use Stripe\Checkout\Session;

class DLCCampaignPaymentComponent extends Component
{
    public function render()
    {
        return view('livewire.app.settings.d-l-c-campaign-payment-component')->layout('livewire.app.layouts.base');
    }
}
