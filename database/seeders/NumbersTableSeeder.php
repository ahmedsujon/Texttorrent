<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('numbers')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'friendly_name' => '(859) 209-6359',
                'number' => '+18592096359',
                'region' => 'KY',
                'country' => 'US',
                'latitude' => '37.645600',
                'longitude' => '-84.772200',
                'postal_code' => '40422',
                'capabilities' => json_encode([
                    'mms' => true,
                    'sms' => true,
                    'voice' => true,
                    'fax' => false
                ]),
                'purchased_at' => '2024-10-07 10:15:24',
                'created_at' => '2024-10-07 10:15:24',
                'updated_at' => '2024-10-07 10:15:24',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'friendly_name' => '(202) 816-4450',
                'number' => '+12028164450',
                'region' => 'KY',
                'country' => 'US',
                'latitude' => '37.645600',
                'longitude' => '-84.772200',
                'postal_code' => '40422',
                'capabilities' => json_encode([
                    'mms' => true,
                    'sms' => true,
                    'voice' => true,
                    'fax' => false
                ]),
                'purchased_at' => '2024-10-07 10:15:24',
                'created_at' => '2024-10-07 10:15:24',
                'updated_at' => '2024-10-07 10:15:24',
            ]
        ]);
    }
}
