<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'Get Numbers',
                'permission' => 'get-numbers',
                'position' => 'left',
            ],
            [
                'name' => 'Send SMS',
                'permission' => 'send-sms',
                'position' => 'middle'
            ],
            [
                'name' => 'Groups',
                'permission' => 'groups',
                'position' => 'right'
            ],
            [
                'name' => 'Contact List',
                'permission' => 'contact-list',
                'position' => 'middle'
            ],
            [
                'name' => 'Import Contacts',
                'permission' => 'import-contacts',
                'position' => 'right'
            ],
            [
                'name' => '2-way SMS Chat',
                'permission' => '2-way-sms-chat',
                'position' => 'middle'
            ],
            [
                'name' => 'Scheduler',
                'permission' => 'scheduler',
                'position' => 'right'
            ],
            [
                'name' => 'Logs',
                'permission' => 'logs',
                'position' => 'middle'
            ],
            [
                'name' => 'Your Current Plan',
                'permission' => 'your-current-plan',
                'position' => 'left',
            ],
            [
                'name' => 'Secondary Number Assigned',
                'permission' => 'secondary-number-assigned',
                'position' => 'left',
            ],
            [
                'name' => 'Past Receipts',
                'permission' => 'past-receipts',
                'position' => 'left',
            ],
            [
                'name' => 'Reports',
                'permission' => 'reports',
                'position' => 'right'
            ],
            [
                'name' => 'Number Pool',
                'permission' => 'number-pool',
                'position' => 'middle'
            ],
            [
                'name' => 'Voice Credits',
                'permission' => 'voice-credits',
                'position' => 'right'
            ],
            [
                'name' => 'SMS Credits',
                'permission' => 'sms-credits',
                'position' => 'middle'
            ],
            [
                'name' => 'Current Credit Package',
                'permission' => 'current-credit-package',
                'position' => 'right'
            ],
            [
                'name' => 'Messages # of Messages',
                'permission' => 'messages-number-of-messages',
                'position' => 'middle'
            ],
        ];


        foreach ($permissions as $key => $value) {
            $getPermission = UserPermission::where('permission', $value)->first();

            if (!$getPermission) {
                $perm = new UserPermission();
                $perm->name = $value['name'];
                $perm->permission = $value['permission'];
                $perm->position = $value['position'];
                $perm->save();
            }
        }
    }
}
