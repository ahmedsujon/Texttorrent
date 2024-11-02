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
                'purchased_by' => 1,
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
                'type' => 'local',
                'twilio_number_sid' => 'PN50d6e2f518465eb847d1dfbba2aaeb66',
                'twilio_service_sid' => 'MGa4a0fba3749494b6a89fc060c97112f8',
                'purchased_at' => '2024-10-07 10:15:24',
                'created_at' => '2024-10-07 10:15:24',
                'updated_at' => '2024-10-07 10:15:24',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'purchased_by' => 1,
                'friendly_name' => '(409) 220-0920',
                'number' => '+14092200920',
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
                'type' => 'local',
                'twilio_number_sid' => 'PN4646762c250977355abf9d932c5178f8',
                'twilio_service_sid' => 'MGa4a0fba3749494b6a89fc060c97112f8',
                'purchased_at' => '2024-10-07 10:15:24',
                'created_at' => '2024-10-07 10:15:24',
                'updated_at' => '2024-10-07 10:15:24',
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'purchased_by' => 1,
                'friendly_name' => '(508) 717-8400',
                'number' => '+15087178400',
                'region' => 'MA',
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
                'type' => 'local',
                'twilio_number_sid' => 'PNeacd56dc6ef583b07241915ba3516330',
                'twilio_service_sid' => 'MG3ce3523adb139c9a4bed631480155c1e',
                'purchased_at' => '2024-10-07 10:15:24',
                'created_at' => '2024-10-07 10:15:24',
                'updated_at' => '2024-10-07 10:15:24',
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'purchased_by' => 1,
                'friendly_name' => '(833) 789-9550',
                'number' => '+18337899550',
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
                'type' => 'local',
                'twilio_number_sid' => 'PNeacd56dc6ef583b07241915ba3516330',
                'twilio_service_sid' => 'MG3ce3523adb139c9a4bed631480155c1e',
                'purchased_at' => '2024-10-07 10:15:24',
                'created_at' => '2024-10-07 10:15:24',
                'updated_at' => '2024-10-07 10:15:24',
            ]
        ]);
    }
}
