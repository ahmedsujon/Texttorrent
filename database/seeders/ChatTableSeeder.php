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
        $contact_numbers = DB::table('contacts')->where('user_id', 1)->take(7)->get();

        $faker = Faker::create();

        foreach ($contact_numbers as $key => $cNum) {
            $chat = new Chat();
            $chat->user_id = 1;
            $chat->from_number = Number::where('user_id', 1)->first()->number;
            $chat->contact_id = $cNum->id;
            $chat->last_message = $faker->randomElement(['Hello', 'Hi', 'Hey']);
            $chat->created_at = Carbon::parse(now())->subMinutes(15)->addMinutes($key + 1);
            $chat->updated_at = Carbon::parse(now())->subMinutes(15)->addMinutes($key + 1);
            $chat->save();

            if ($chat->id == 7) {
                for ($i = 1; $i <= 20; $i++) {
                    $msg = new ChatMessage();
                    $msg->chat_id = $chat->id;
                    $msg->sender = $i % 2 == 0 ? 1 : $cNum->id;
                    $msg->receiver = ($msg->sender === 1) ? $cNum->id : 1;
                    $msg->message = $faker->sentence;
                    $msg->save();
                }
            } else {
                $msg = new ChatMessage();
                $msg->chat_id = $chat->id;
                $msg->sender = 1;
                $msg->receiver = $cNum->id;
                $msg->message = $chat->last_message;
                $msg->save();
            }
        }
    }
}
