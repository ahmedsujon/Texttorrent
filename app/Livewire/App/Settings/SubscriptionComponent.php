<?php

namespace App\Livewire\App\Settings;

use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\User;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Subscription;
use GuzzleHttp\Psr7\Request;
use Stripe\Checkout\Session;

class SubscriptionComponent extends Component
{

    public $user_id, $package_type, $package_name, $amount, $status;

    // Own Gateway plan
    public function purchasePlan($type, $name)
    {
        if (user()) {
            $price = 0;
            if ($type == 'own-gateway') {
                if ($name == 'standard') {
                    $price = 49;
                    $credits = 7000;
                    $sub_account = 5;
                } else if ($name == 'premium') {
                    $price = 99;
                    $credits = 15000;
                    $sub_account = 10;
                } else if ($name == 'enterprise') {
                    $price = 149;
                    $credits = 30000;
                    $sub_account = 99999;
                }
                $duration = 1; // months
            } else if ($type == 'text-torrent') {
                if ($name == 'starter') {
                    $price = 625;
                    $credits = 25000;
                    $sub_account = 0;
                } else if ($name == 'growth') {
                    $price = 1250;
                    $credits = 50000;
                    $sub_account = 0;
                } else if ($name == 'pro') {
                    $price = 2550;
                    $credits = 100000;
                    $sub_account = 0;
                }
                $duration = '';
            }

            $getSubscription = Subscription::where('user_id', user()->id)->where('payment_status', 'unpaid')->first();

            if ($getSubscription) {
                $subscription = $getSubscription;
            } else {
                $subscription = new Subscription();
                $subscription->user_id = user()->id;
            }
            $subscription->package_type = $type;
            $subscription->package_name = $name;
            $subscription->amount = $price;
            $subscription->payment_status = 'unpaid';
            $subscription->duration = $duration;
            $subscription->credits = $credits;
            $subscription->sub_accounts = $sub_account;
            $subscription->save();

            $this->payWithStripe($subscription->id);
        } else {
            return redirect()->route('login');
        }
    }

    private function payWithStripe($subID)
    {
        $subscription = Subscription::where('id', $subID)->first();
        if ($subscription->package_type == 'own-gateway') {
            $description = 'Bring Your Own Gateway';
        } else {
            $description = 'All-Inclusive Platform';
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => ucwords($subscription->package_name) . ' Plan',
                            'description' => $description,
                        ],
                        'unit_amount'  => str_replace([',', '.'], ['', ''], $subscription->amount . '00'),
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('stripePaymentSuccess') . '?subscription_id=' . $subscription->id . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('user.subscription'),
        ]);

        return redirect()->away($session->url);
    }

    public function render()
    {
        return view('livewire.app.settings.subscription-component')->layout('livewire.app.layouts.base');
    }
}
