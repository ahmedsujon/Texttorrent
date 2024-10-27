<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptions = [];

        for ($i = 1; $i <= 10; $i++) {
            $subscriptions[] = [
                'user_id' => $i,
                'package_type' => $i % 2 == 0 ? 'own-gateway' : 'text-torrent',
                'package_name' => $i % 2 == 0 ? 'Pro Plan' : 'Starter Plan',
                'amount' => $i % 2 == 0 ? 49.99 : 19.99,
                'payment_status' => $i % 3 == 0 ? 'unpaid' : 'paid',
                'stripe_transaction_id' => $i % 3 == 0 ? null : 'txn_1Example' . $i,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths($i),
                'features' => json_encode(["feature1", "feature$i"]),
                'duration' => "{$i} months",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('subscriptions')->insert($subscriptions);
    }
}
