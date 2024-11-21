<?php

namespace App\Livewire\App\User;

use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Stripe\Checkout\Session;

class DashboardComponent extends Component
{
    public $selected_event_id, $selectedEvent, $creditCost = 0, $bonusCredits = 0, $totalCredits = 0, $delivered_message = 0, $un_delivered_message = 0, $responded_message = 0, $stopped_message = 0;
    public $dateFilter = '12months'; // Default filter
    public $customDateRangeEnabled = true; // To track the checkbox state
    public $startDate;
    public $endDate;
    public $chartData = [
        'delivered_messages' => [],
        'responded_messages' => [],
        'undelivered' => [],
        'stopped' => [],
    ];

    public function mount()
    {
        $user_chats = DB::table('chats')->where('user_id', user()->id)->pluck('id')->toArray();

        $this->delivered_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)->where('api_send_status', 'delivered')->count();
        $this->un_delivered_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)->where('api_send_status', 'undelivered')->count();
        $this->responded_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)->where('direction', 'inbound')->count();
        $this->stopped_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)->where('api_send_status', 'failed')->count();

        $this->updateChartData();

    }

    public function updatedStartDate()
    {
        $this->updateChartData();
        $this->dispatch('updateChart', $this->chartData);

    }
    public function updatedEndDate()
    {
        $this->updateChartData();
        $this->dispatch('updateChart', $this->chartData);
    }
    public function updatedCustomDateRangeEnabled()
    {
        $this->updateChartData();
        $this->dispatch('updateChart', $this->chartData);
    }

    public function updateChartData()
    {
        $user_chats = DB::table('chats')->where('user_id', auth()->id())->pluck('id')->toArray();

        $query = DB::table('chat_messages')->whereIn('chat_id', $user_chats);

        // Apply the appropriate filter
        if ($this->customDateRangeEnabled && $this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [
                \Carbon\Carbon::parse($this->startDate)->startOfDay(),
                \Carbon\Carbon::parse($this->endDate)->endOfDay(),
            ]);
        } elseif ($this->dateFilter == '7days') {
            $query->where('created_at', '>=', now()->subDays(7));
        } elseif ($this->dateFilter == '30days') {
            $query->where('created_at', '>=', now()->subDays(30));
        } elseif ($this->dateFilter == '12months') {
            $query->where('created_at', '>=', now()->subMonths(12));
        }

        // Assign monthly data to chartData, using cloned queries for each type
        $this->chartData = [
            'delivered_messages' => $this->countMessagesByMonth((clone $query)->where('api_send_status', 'delivered')),
            'responded_messages' => $this->countMessagesByMonth((clone $query)->where('direction', 'inbound')),
            'undelivered' => $this->countMessagesByMonth((clone $query)->where('api_send_status', 'undelivered')),
            'stopped' => $this->countMessagesByMonth((clone $query)->where('api_send_status', 'failed')),
        ];

    }

    private function countMessagesByMonth($query)
    {
        // Initialize an array with 12 zeros (for each month, Jan to Dec)
        $monthlyData = array_fill(0, 12, 0);

        // Retrieve the counts grouped by month
        $data = $query->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Map the counts into the monthlyData array
        foreach ($data as $month => $count) {
            $monthlyData[$month - 1] = $count; // Month is 1-indexed (1 = Jan), so adjust to 0-indexed array
        }

        return $monthlyData;
    }

    public function setDateFilter($filter)
    {
        $this->dateFilter = $filter;
        $this->updateChartData();
        $this->dispatch('updateChart', $this->chartData);
    }

    public function viewData($id)
    {
        $event = Event::findOrFail($id);

        $this->selectedEvent = $event;
        $this->selected_event_id = $event->id;

        $this->dispatch('viewEventDetails');
    }

    public function buyCredit()
    {
        if ($this->creditCost > 0) {
            if (getActiveSubscription()['status'] != 'Active') {
                return redirect()->route('user.subscription');
            }

            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Buy TextTorrent Credits',
                                'description' => 'Credit Amount: ' . $this->totalCredits,
                            ],
                            'unit_amount' => str_replace([',', '.'], ['', ''], $this->creditCost . '00'),
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('user.buyCreditSuccess') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('user.dashboard'),
                'metadata' => [
                    'user_id' => user()->id,
                    'credit' => $this->totalCredits,
                    'amount' => $this->creditCost,
                ],
            ]);

            return redirect()->away($session->url);
        } else {
            $this->dispatch('error', ['message' => 'Select Credit Amount']);
        }
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
        return view('livewire.app.user.dashboard-component', ['credits_left' => $total_credits, 'events' => $formattedEvents])->layout('livewire.app.layouts.base');
    }
}
