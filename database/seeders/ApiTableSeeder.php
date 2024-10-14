<?php

namespace Database\Seeders;

use App\Models\Api;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $api = new Api();
        $api->user_id = 1;
        $api->gateway = 'Twilio';
        $api->account_sid = 'AC80f658d1006561368eceb8f14813fa45';
        $api->auth_token = '0080aadf1faf3e7c91d35b4f44813fca';
        $api->save();
    }
}
