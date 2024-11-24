<?php

namespace App\Console\Commands;

use App\Jobs\NumberExpiredAlert;
use App\Jobs\NumberRenewal;
use App\Jobs\NumberRenewedAlert;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Number;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class NumberRenewalAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:number-renewal-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Number Renewal Alert';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $numbers = DB::table('numbers')->select('id', 'user_id', 'number', 'next_renew_date', 'status')->where('status', 1)->where('next_renew_date', '<=', Carbon::parse(now())->addDays(5)->format('Y-m-d'))->get();

        foreach ($numbers as $key => $number) {
            $currentDate = now();
            $renewDate = Carbon::parse($number->next_renew_date);

            if ($currentDate->diffInDays($renewDate, false) <= 5 && $currentDate->diffInDays($renewDate, false) >= 0) {
                $user = User::find($number->user_id);

                $data['email'] = $user->email;
                $data['name'] = $user->first_name . ' ' . $user->last_name;
                $data['number'] = $number->number;
                $data['expiry_date'] = $number->next_renew_date;

                NumberRenewal::dispatch($data);
            }

            // If the expiration date is today or has passed
            if ($currentDate->greaterThanOrEqualTo($renewDate)) {
                $user = User::find($number->user_id);
                $number = Number::find($number->id);

                // Check if the user has enough credit
                $renewalCost = 300;
                if ($user->credits >= $renewalCost) {
                    // Deduct credit and renew
                    $user->credits -= $renewalCost;
                    $user->save();

                    // Extend the renewal date (e.g., by 1 year)
                    $number->next_renew_date = Carbon::parse(now())->addMonth();
                    $number->save();

                    // Optionally, log the renewal
                    $trx = new Transaction();
                    $trx->user_id = $user->id;
                    $trx->transaction_type = 'number_renewal';
                    $trx->description = 'Renewed number: '. $number->number;
                    $trx->credit = -$renewalCost;
                    $trx->save();

                    $data['email'] = $user->email;
                    $data['name'] = $user->first_name . ' ' . $user->last_name;
                    $data['number'] = $number->number;
                    $data['expiry_date'] = $number->next_renew_date;
                    NumberRenewedAlert::dispatch($data);
                } else {
                    // Not enough credit, set the number to inactive
                    $number->status = 0;
                    $number->save();

                    // Optionally, send an alert about deactivation
                    $user = User::find($number->user_id);

                    $data['email'] = $user->email;
                    $data['name'] = $user->first_name . ' ' . $user->last_name;
                    $data['number'] = $number->number;
                    $data['expiry_date'] = $number->next_renew_date;
                    NumberExpiredAlert::dispatch($data);
                }
            }

        }

        $this->info('Number renewal alert sent:- ' . $numbers->count() . ' ');
    }
}
