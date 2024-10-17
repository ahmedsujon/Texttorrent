<?php

namespace App\Livewire\Web;

use Livewire\Component;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class PricingComponent extends Component
{
    public $user_id, $package_type, $package_name, $amount, $status;

    // Own Gateway plan
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
        return redirect()->route('app.payment');
    }

    public function premiumPlan()
    {
        $package_type = 'ownGateway';
        $package_name = 'premium';
        $amount = 99;
        $status = 1;

        $data = new Subscription();
        $data->user_id = Auth::user()->id;
        $data->package_type = $package_type;
        $data->package_name = $package_name;
        $data->amount = $amount;
        $data->status = $status;
        $data->save();
        return redirect()->route('app.payment');
    }

    public function enterprisePlan()
    {
        $package_type = 'ownGateway';
        $package_name = 'enterprise';
        $amount = 149;
        $status = 1;

        $data = new Subscription();
        $data->user_id = Auth::user()->id;
        $data->package_type = $package_type;
        $data->package_name = $package_name;
        $data->amount = $amount;
        $data->status = $status;
        $data->save();
        return redirect()->route('app.payment');
    }

    // inclusive plan

    public function starterPlan()
    {
        $package_type = 'inclusive';
        $package_name = 'starter';
        $amount = 625;
        $status = 1;

        $data = new Subscription();
        $data->user_id = Auth::user()->id;
        $data->package_type = $package_type;
        $data->package_name = $package_name;
        $data->amount = $amount;
        $data->status = $status;
        $data->save();
        return redirect()->route('app.payment');
    }

    public function growthPlan()
    {
        $package_type = 'inclusive';
        $package_name = 'growth';
        $amount = 1250;
        $status = 1;

        $data = new Subscription();
        $data->user_id = Auth::user()->id;
        $data->package_type = $package_type;
        $data->package_name = $package_name;
        $data->amount = $amount;
        $data->status = $status;
        $data->save();
        return redirect()->route('app.payment');
    }

    public function proPlan()
    {
        $package_type = 'inclusive ';
        $package_name = 'pro';
        $amount = 2550;
        $status = 1;

        $data = new Subscription();
        $data->user_id = Auth::user()->id;
        $data->package_type = $package_type;
        $data->package_name = $package_name;
        $data->amount = $amount;
        $data->status = $status;
        $data->save();
        return redirect()->route('app.payment');
    }

    public function render()
    {
        return view('livewire.web.pricing-component')->layout('livewire.web.layouts.base');
    }
}
