<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emails = ["user@example.com"];

        foreach ($emails as $key => $email) {
            $getUser = User::where('email', $email)->first();
            if (!$getUser) {
                $user = new User();
                $user->first_name = 'Mr';
                $user->last_name = 'User ' . $key;
                $user->username = 'mr_user_' . $key;
                $user->email = $email;
                $user->phone = '+13472102794';
                $user->password = Hash::make('12345678');
                $user->permissions = UserPermission::pluck('id')->toArray();
                $user->save();
            }
        }

        $subUser = new User();
        $subUser->first_name = 'Sub';
        $subUser->last_name = 'User';
        $subUser->username = 'sub_user';
        $subUser->email = 'subuser@example.com';
        $subUser->phone = '+13472102794';
        $subUser->password = Hash::make('12345678');
        $subUser->permissions = UserPermission::pluck('id')->toArray();
        $subUser->type = 'sub';
        $subUser->parent_id = 1;
        $subUser->status = 1;
        $subUser->save();
    }
}
