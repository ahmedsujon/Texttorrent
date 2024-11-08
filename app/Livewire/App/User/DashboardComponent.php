<?php

namespace App\Livewire\App\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use Livewire\Component;
use App\Models\Transaction;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class DashboardComponent extends Component
{
    public $selected_event_id, $selectedEvent, $creditCost = 20, $bonusCredits = 0, $totalCredits = 4000;
    public function viewData($id)
    {
        $event = Event::findOrFail($id);


        $this->selectedEvent = $event;
        $this->selected_event_id = $event->id;

        $this->dispatch('viewEventDetails');
    }

    public function buyCredit()
    {
        if (getActiveSubscription()['status'] != 'Active') {
            return redirect()->route('user.subscription');
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => 'Buy TextTorrent Credits',
                            'description' => 'Credit Amount: ' . $this->totalCredits,
                        ],
                        'unit_amount'  => str_replace([',', '.'], ['', ''], $this->creditCost . '00'),
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('user.buyCreditSuccess') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('user.dashboard'),
            'metadata' => [
                'user_id' => user()->id,
                'credit' => $this->totalCredits,
                'amount' => $this->creditCost,
            ],
        ]);

        return redirect()->away($session->url);
    }

    public function buyCreditSuccess()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session_id = request()->get('session_id');

        try {
            $session = Session::retrieve($session_id);
            $stripe_trx_id = $session->payment_intent; // Get the Payment Intent ID (transaction ID)

            $user_id = $session['metadata']['user_id'];
            $credit = $session['metadata']['credit'];
            $amount = $session['metadata']['amount'];

            $user = User::find($user_id);
            $user->credits += $credit;
            $user->save();

            // transactions
            $trx = new Transaction();
            $trx->user_id = $user_id;
            $trx->amount = $amount;
            $trx->transaction_type = 'credit_recharge';
            $trx->description = 'Added ' . $credit . ' credits';
            $trx->credit = $credit;
            $trx->stripe_trx_id = $stripe_trx_id;
            $trx->save();

            session()->flash('success', 'Credit added successfully');
            return redirect()->route('user.dashboard');
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function render()
    {
        $formattedEvents = Event::where('user_id', Auth::user()->id)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'start' => Carbon::parse($event->date)->format('Y-m-d') . 'T' . Carbon::parse($event->time)->format('h:i:s'),
                    'classNames' => ['sms_event'],
                ];
            })
            ->toArray();

        $formattedEvents = json_encode($formattedEvents);

        $total_credits = user()->credits;
        return view('livewire.app.user.dashboard-component', ['credits_left'=>$total_credits, 'events'=>$formattedEvents])->layout('livewire.app.layouts.base');
    }
}
