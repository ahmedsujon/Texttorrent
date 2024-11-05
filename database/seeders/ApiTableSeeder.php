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
        $api->account_sid = env('TWILIO_SID');
        $api->auth_token = env('TWILIO_TOKEN');
        $api->save();
    }
}
