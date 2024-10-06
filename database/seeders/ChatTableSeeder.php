<?php

namespace Database\Seeders;

use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact_numbers = DB::table('contacts')->where('user_id', 1)->take(15)->get();

        $faker = Faker::create();

        foreach ($contact_numbers as $key => $cNum) {
            $chat = new Chat();
            $chat->user_id = 1;
            $chat->contact_id = $cNum->id;
            $chat->last_message = $faker->randomElement(['Hello', 'Hi', 'Hey']);
            $chat->created_at = Carbon::parse(now())->subMinutes($key + 1);
            $chat->save();
        }
    }
}
