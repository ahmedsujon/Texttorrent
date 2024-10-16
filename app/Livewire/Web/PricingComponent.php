<?php

namespace App\Livewire\Web;

use Livewire\Component;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class PricingComponent extends Component
{
    public $user_id, $package_type, $package_name, $amount, $status;

    public function standardPlan()
    {
        $package_type = 'ownGateway';
        $package_name = 'standard';
        $amount = 49;
        $status = 1;

        $data = new Subscription();
        $data->user_id = Auth::user()->id;
        $data->package_type = $package_type;
        $data->package_name = $package_name;
        $data->amount = $amount;
        $data->status = $status;
        $data->save();
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.web.pricing-component')->layout('livewire.web.layouts.base');
    }
}
