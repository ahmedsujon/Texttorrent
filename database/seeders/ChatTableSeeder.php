<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Number;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact_numbers = DB::table('contacts')->where('user_id', 1)->take(1)->get();

        $faker = Faker::create();

        foreach ($contact_numbers as $key => $cNum) {
            $chat = new Chat();
            $chat->user_id = 1;
            $chat->from_number = Number::where('user_id', 1)->first()->number;
            $chat->contact_id = $cNum->id;
            $chat->last_message = 'Hello, TextTorrent Owner, This is a default sms template for testing.';
            $chat->created_at = Carbon::parse(now())->subMinutes(15)->addMinutes($key + 1);
            $chat->updated_at = Carbon::parse(now())->subMinutes(15)->addMinutes($key + 1);
            $chat->save();

            $msg = new ChatMessage();
            $msg->chat_id = $chat->id;
            $msg->direction = 'outbound';
            $msg->message = 'Hello, TextTorrent Owner, This is a default sms template for testing.';
            $msg->api_send_status = 'pending';
            $msg->api_send_response = '[Twilio.Api.V2010.MessageInstance accountSid=AC80f658d1006561368eceb8f14813fa45 sid=SMab2c9e5ddd74dffd5c645453d793ee1a]';
            $msg->api = 'Twilio';
            $msg->msg_sid = $key == 0 ? 'SMab2c9e5ddd74dffd5c645453d793ee1a' : '';
            $msg->created_at = Carbon::parse(now())->subDays(1);
            $msg->updated_at = Carbon::parse(now())->subDays(1);
            $msg->save();

            $msg2 = new ChatMessage();
            $msg2->chat_id = $chat->id;
            $msg2->direction = 'outbound';
            $msg2->message = 'Test Message to Check Live Status Update';
            $msg2->api_send_status = 'pending';
            $msg2->api_send_response = '[Twilio.Api.V2010.MessageInstance accountSid=AC80f658d1006561368eceb8f14813fa45 sid=SM921ef96c19674279cd4b906fc2548b79]';
            $msg2->api = 'Twilio';
            $msg2->msg_sid = $key == 0 ? 'SM921ef96c19674279cd4b906fc2548b79' : '';
            $msg2->created_at = Carbon::parse(now())->subDays(1);
            $msg2->updated_at = Carbon::parse(now())->subDays(1);
            $msg2->save();

            // for ($i = 0; $i < 120; $i++) {
            //     $msg2 = new ChatMessage();
            //     $msg2->chat_id = $chat->id;
            //     $msg2->direction = $i % 2 == 0 ? 'outbound' : 'inbound';
            //     $msg2->message = 'Test Message to Check Live Status Update';
            //     $msg2->api_send_status = $i % 2 == 0 ? 'delivered' : 'undelivered';
            //     $msg2->api_send_response = '';
            //     $msg2->api = 'Twilio';
            //     $msg2->msg_sid = '';
            //     $msg2->created_at = Carbon::parse(now())->subDays(1);
            //     $msg2->updated_at = Carbon::parse(now())->subDays(1);
            //     $msg2->save();
            // }
        }
    }
}
