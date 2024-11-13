<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\User;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Subscription;
use GuzzleHttp\Psr7\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class PricingComponent extends Component
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
            'cancel_url'  => route('app.pricing'),
        ]);

        return redirect()->away($session->url);
    }

    public function stripePaymentSuccess()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session_id = request()->get('session_id');

        try {
            $session = Session::retrieve($session_id);
            $stripe_trx_id = $session->payment_intent; // Get the Payment Intent ID (transaction ID)
            $subscription = Subscription::find(request()->get('subscription_id'));
            $subscription->payment_status = 'paid';
            $subscription->stripe_transaction_id = $stripe_trx_id;
            $subscription->start_date = Carbon::parse(now());
            if ($subscription->package_type == 'own-gateway') {
                $subscription->end_date = Carbon::parse(now())->addMonths(1);
            }
            $subscription->save();

            $user_id = $subscription->user_id;
            $user = User::find($user_id);
            $user->credits += $subscription->credits;
            $user->sub_accounts = $subscription->sub_accounts;
            $user->save();

            // transactions
            $trx = new Transaction();
            $trx->user_id = $user_id;
            $trx->transaction_type = 'subscription';
            $trx->description = 'Payment for subscription';
            $trx->amount = $subscription->amount;
            $trx->stripe_trx_id = $stripe_trx_id;
            $trx->save();

            $trx2 = new Transaction();
            $trx2->user_id = $user_id;
            $trx2->amount = $subscription->amount;
            $trx2->transaction_type = 'credit_recharge';
            $trx2->description = 'Added ' . $subscription->credits . ' credits';
            $trx2->credit = $subscription->credits;
            $trx->stripe_trx_id = $stripe_trx_id;
            $trx2->save();

            session()->flash('success', 'Subscription successful');
            if (user()) {
                return redirect()->route('user.subscription');
            } else {
                return redirect()->route('app.subscriptionSuccess');
            }
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.web.pricing-component')->layout('livewire.web.layouts.base');
    }
}
