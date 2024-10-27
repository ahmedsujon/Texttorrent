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
            $conditions = [];
            $price = 0;
            if ($type == 'own-gateway') {
                if ($name == 'standard') {
                    $price = 49;
                    $conditions = [
                        'credits' => 7000,
                        'sub-account' => 1
                    ];
                } else if ($name == 'premium') {
                    $price = 99;
                    $conditions = [
                        'credits' => 15000,
                        'sub-account' => 3
                    ];
                } else if ($name == 'enterprise') {
                    $price = 149;
                    $conditions = [
                        'credits' => 15000,
                        'sub-account' => 'unlimited'
                    ];
                }
                $duration = 1; // months
            } else if ($type == 'text-torrent') {
                if ($name == 'starter') {
                    $price = 625;
                    $conditions = [
                        'message-count' => 25000
                    ];
                } else if ($name == 'growth') {
                    $price = 1250;
                    $conditions = [
                        'message-count' => 50000
                    ];
                } else if ($name == 'pro') {
                    $price = 2550;
                    $conditions = [
                        'message-count' => 100000
                    ];
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
            $subscription->features = $conditions;
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
            'success_url' => route('app.stripePaymentSuccess') . '?subscription_id=' . $subscription->id . '&session_id={CHECKOUT_SESSION_ID}',
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
            $user->credit_balance += isset($subscription->features['credits']) ? $subscription->features['credits'] : 0;
            $user->sub_account_count = isset($subscription->features['sub-account']) ? $subscription->features['sub-account'] : 0;
            $user->message_balance += isset($subscription->features['message-count']) ? $subscription->features['message-count'] : 0;
            $user->save();

            $credit = isset($subscription->features['credits']) ? $subscription->features['credits'] : 0;
            $message = isset($subscription->features['message-count']) ? $subscription->features['message-count'] : 0;

            // transactions
            $trx = new Transaction();
            $trx->user_id = $user_id;
            $trx->transaction_type = 'subscription';
            $trx->description = 'Payment for subscription';
            $trx->amount = $subscription->amount;
            $trx->save();

            $trx2 = new Transaction();
            $trx2->user_id = $user_id;
            $trx2->amount = $subscription->amount;
            if ($subscription->package_type == 'own-gateway') {
                $trx2->transaction_type = 'credit_recharge';
                $trx2->description = 'Added ' . $credit . ' credits';
                $trx2->credit = $credit;
            } else {
                $trx2->transaction_type = 'message_recharge';
                $trx2->description = 'Added ' . $message . ' messages';
                $trx2->message = $message;
            }
            $trx2->save();

            return redirect()->route('user.dashboard');
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.app.settings.subscription-component')->layout('livewire.app.layouts.base');
    }
}
