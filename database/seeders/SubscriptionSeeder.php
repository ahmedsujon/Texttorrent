<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscriptions')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'package_type' => 'own-gateway',
                'package_name' => 'enterprise',
                'amount' => 149.00,
                'payment_status' => 'paid',
                'stripe_transaction_id' => 'pi_3QKKY1Fbd1SX9jGu1SGxFpSD',
                'start_date' => Carbon::parse('2024-11-12 08:54:29'),
                'end_date' => Carbon::parse('2024-12-12 08:54:29'),
                'credits' => 30000,
                'sub_accounts' => 99999,
                'duration' => 1,
                'created_at' => Carbon::parse('2024-11-12 08:53:02'),
                'updated_at' => Carbon::parse('2024-11-12 08:54:29'),
            ],
        ]);

        User::where('id', 1)->update(['credits' => 30000, 'sub_accounts' => 99999]);
    }
}
