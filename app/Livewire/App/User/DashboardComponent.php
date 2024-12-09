<?php

namespace App\Livewire\App\User;

use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Stripe\Checkout\Session;

class DashboardComponent extends Component
{
    public $selected_event_id, $selectedEvent, $creditCost = 0, $bonusCredits = 0, $totalCredits = 0, $delivered_message = 0, $un_delivered_message = 0, $responded_message = 0, $stopped_message = 0, $user_ids, $bulk_message_ids;
    public $dateFilter = '12months'; // Default filter
    public $customDateRangeEnabled = false; // To track the checkbox state
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
        $user_ids = [user()->id];
        $sub_users = DB::table('users')->where('parent_id', user()->id)->pluck('id')->toArray();
        $this->user_ids = array_merge($user_ids, $sub_users);

        $user_chats = DB::table('chats')->whereIn('user_id', $this->user_ids)->pluck('id')->toArray();

        $this->delivered_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)->where('api_send_status', 'delivered')->count() + DB::table('bulk_message_items')->whereIn('send_by', $this->user_ids)->where('send_status', 'delivered')->count();

        $this->un_delivered_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)->where('api_send_status', 'undelivered')->count() + DB::table('bulk_message_items')->whereIn('send_by', $this->user_ids)->where('send_status', 'undelivered')->count();

        $bulk_message_ids = DB::table('bulk_messages')->whereIn('user_id', $this->user_ids)->pluck('id')->toArray();
        $this->bulk_message_ids = $bulk_message_ids;

        $this->responded_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)->where('direction', 'inbound')->count() + DB::table('bulk_message_replies')->whereIn('bulk_message_id', $bulk_message_ids)->count();

        $this->stopped_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)->where('api_send_status', 'failed')->count() + DB::table('bulk_message_items')->whereIn('send_by', $this->user_ids)->where('send_status', 'failed')->count();

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

    // public function updateChartData()
    // {
    //     $user_chats = DB::table('chats')->whereIn('user_id', $this->user_ids)->pluck('id')->toArray();

    //     $query = DB::table('chat_messages')->whereIn('chat_id', $user_chats);

    //     // Apply the appropriate filter
    //     if ($this->customDateRangeEnabled && $this->startDate && $this->endDate) {
    //         $query->whereBetween('created_at', [
    //             \Carbon\Carbon::parse($this->startDate)->startOfDay(),
    //             \Carbon\Carbon::parse($this->endDate)->endOfDay(),
    //         ]);
    //     } elseif ($this->dateFilter == '7days') {
    //         $query->where('created_at', '>=', now()->subDays(7));
    //     } elseif ($this->dateFilter == '30days') {
    //         $query->where('created_at', '>=', now()->subDays(30));
    //     } elseif ($this->dateFilter == '12months') {
    //         $query->where('created_at', '>=', now()->subMonths(12));
    //     }

    //     $query2 = DB::table('bulk_message_items')->whereIn('send_by', $this->user_ids);
    //     // Apply the appropriate filter
    //     if ($this->customDateRangeEnabled && $this->startDate && $this->endDate) {
    //         $query2->whereBetween('created_at', [
    //             \Carbon\Carbon::parse($this->startDate)->startOfDay(),
    //             \Carbon\Carbon::parse($this->endDate)->endOfDay(),
    //         ]);
    //     } elseif ($this->dateFilter == '7days') {
    //         $query2->where('created_at', '>=', now()->subDays(7));
    //     } elseif ($this->dateFilter == '30days') {
    //         $query2->where('created_at', '>=', now()->subDays(30));
    //     } elseif ($this->dateFilter == '12months') {
    //         $query2->where('created_at', '>=', now()->subMonths(12));
    //     }

    //     $query3 = DB::table('bulk_message_replies')->whereIn('bulk_message_id', $this->bulk_message_ids);
    //     // Apply the appropriate filter
    //     if ($this->customDateRangeEnabled && $this->startDate && $this->endDate) {
    //         $query3->whereBetween('created_at', [
    //             \Carbon\Carbon::parse($this->startDate)->startOfDay(),
    //             \Carbon\Carbon::parse($this->endDate)->endOfDay(),
    //         ]);
    //     } elseif ($this->dateFilter == '7days') {
    //         $query3->where('created_at', '>=', now()->subDays(7));
    //     } elseif ($this->dateFilter == '30days') {
    //         $query3->where('created_at', '>=', now()->subDays(30));
    //     } elseif ($this->dateFilter == '12months') {
    //         $query3->where('created_at', '>=', now()->subMonths(12));
    //     }

    //     // Assign monthly data to chartData, using cloned queries for each type
    //     $this->chartData = [
    //         'delivered_messages' => $this->countMessagesByMonth((clone $query)->where('api_send_status', 'delivered')) + $this->countMessagesByMonth((clone $query2)->where('send_status', 'delivered')),
    //         'responded_messages' => $this->countMessagesByMonth((clone $query)->where('direction', 'inbound')) + $this->countMessagesByMonth((clone $query3)),
    //         'undelivered' => $this->countMessagesByMonth((clone $query)->where('api_send_status', 'undelivered')) + $this->countMessagesByMonth((clone $query2)->where('send_status', 'undelivered')),
    //         'stopped' => $this->countMessagesByMonth((clone $query)->where('api_send_status', 'failed')) + $this->countMessagesByMonth((clone $query2)->where('send_status', 'failed')),
    //     ];

    //     dd($this->chartData);

    // }

    public function updateChartData()
    {
        $user_chats = DB::table('chats')->whereIn('user_id', $this->user_ids)->pluck('id')->toArray();

        // Queries
        $query1 = DB::table('chat_messages')->whereIn('chat_id', $user_chats);
        $query2 = DB::table('bulk_message_items')->whereIn('send_by', $this->user_ids);
        $query3 = DB::table('bulk_message_replies')->whereIn('bulk_message_id', $this->bulk_message_ids);

        // Apply filters (example for 7 days)
        if ($this->dateFilter == '7days') {
            $query1->where('created_at', '>=', now()->subDays(7));
            $query2->where('created_at', '>=', now()->subDays(7));
            $query3->where('created_at', '>=', now()->subDays(7));
        }

        // Get monthly data
        $deliveredMessages1 = $this->countMessagesByMonth((clone $query1)->where('api_send_status', 'delivered'));
        $deliveredMessages2 = $this->countMessagesByMonth((clone $query2)->where('send_status', 'delivered'));

        $respondedMessages1 = $this->countMessagesByMonth((clone $query1)->where('direction', 'inbound'));
        $respondedMessages2 = $this->countMessagesByMonth((clone $query3));

        $undelivered1 = $this->countMessagesByMonth((clone $query1)->where('api_send_status', 'undelivered'));
        $undelivered2 = $this->countMessagesByMonth((clone $query2)->where('send_status', 'undelivered'));

        $stopped1 = $this->countMessagesByMonth((clone $query1)->where('api_send_status', 'failed'));
        $stopped2 = $this->countMessagesByMonth((clone $query2)->where('send_status', 'failed'));

        // Combine results using array_map
        $this->chartData = [
            'delivered_messages' => array_map(fn($a, $b) => $a + $b, $deliveredMessages1, $deliveredMessages2),
            'responded_messages' => array_map(fn($a, $b) => $a + $b, $respondedMessages1, $respondedMessages2),
            'undelivered' => array_map(fn($a, $b) => $a + $b, $undelivered1, $undelivered2),
            'stopped' => array_map(fn($a, $b) => $a + $b, $stopped1, $stopped2),
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
                                'description' => 'Credit Amount: ' . (string) number_format($this->totalCredits),
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
        $formattedEvents = Event::whereIn('user_id', $this->user_ids)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'start' => Carbon::parse($event->date)->format('Y-m-d') . 'T' . Carbon::parse($event->time)->format('H:i:s'),
                    'classNames' => $event->status == 1 ? ['send_event'] : ['sms_event'],
                ];
            })
            ->toArray();

        $formattedEvents = json_encode($formattedEvents);

        if (user()->type == 'sub') {
            $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
            $total_credits = $au_user->credits;
        } else {
            $total_credits = user()->credits;
        }

        $activities = DB::table('chat_messages')->select('chat_messages.*', 'chats.from_number as from', 'chats.contact_id')->join('chats', 'chats.id', 'chat_messages.chat_id')->whereIn('chats.user_id', $this->user_ids)->orderBy('chat_messages.id', 'DESC')->take(10)->get();

        return view('livewire.app.user.dashboard-component', ['credits_left' => $total_credits, 'activities' => $activities, 'events' => $formattedEvents])->layout('livewire.app.layouts.base');
    }
}
