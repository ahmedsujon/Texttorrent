<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emails = ["user@example.com", "user01@example.com", "user02@example.com", "user03@example.com", "user04@example.com"];

        foreach ($emails as $key => $email) {
            $getUser = User::where('email', $email)->first();
            if (!$getUser) {
                $user = new User();
                $user->first_name = 'Mr User ';
                $user->last_name = '00' . $key;
                $user->full_name = 'Mr User ' . $key;
                $user->username = 'mr_user_' . $key;
                $user->email = $email;
                $user->phone = '0170000000' . $key;
                $user->password = Hash::make('12345678');
                $user->avatar = '';
                $user->save();
            }
        }
    }
}
