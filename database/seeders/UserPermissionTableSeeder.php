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
                'name' => 'Current Plan',
                'permission' => 'current-plan',
                'position' => 'left',
            ],
            [
                'name' => 'My Numbers',
                'permission' => 'my-numbers',
                'position' => 'left',
            ],
            [
                'name' => 'Campaign',
                'permission' => 'campaign',
                'position' => 'left',
            ],
            [
                'name' => 'Contact List',
                'permission' => 'contact-list',
                'position' => 'middle'
            ],
            [
                'name' => 'Inbox',
                'permission' => 'inbox',
                'position' => 'right'
            ],
            [
                'name' => 'Number Validator',
                'permission' => 'number-validator',
                'position' => 'middle'
            ],
            [
                'name' => 'Logs',
                'permission' => 'logs',
                'position' => 'middle'
            ],
            [
                'name' => 'Number Pool',
                'permission' => 'number-pool',
                'position' => 'middle'
            ],
            [
                'name' => 'SMS Credits',
                'permission' => 'sms-credits',
                'position' => 'right'
            ],
            [
                'name' => 'Import Contacts',
                'permission' => 'import-contacts',
                'position' => 'right'
            ],
            [
                'name' => 'Calendar',
                'permission' => 'calendar',
                'position' => 'right'
            ],
            [
                'name' => 'API',
                'permission' => 'api',
                'position' => 'right'
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
