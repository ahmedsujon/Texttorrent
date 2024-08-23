<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'base' => 'Dashboard',
                'permissions' => [
                    [
                        'name' => 'View Cards',
                        'permission' => 'view_dashboard_cards',
                    ],
                    [
                        'name' => 'View Transactions',
                        'permission' => 'view_dashboard_transactions',
                    ],
                ]
            ],
            [
                'base' => 'Admins',
                'permissions' => [
                    [
                        'name' => 'Manage Admins',
                        'permission' => 'manage_admins',
                    ],
                    [
                        'name' => 'Add New Admin',
                        'permission' => 'add_new_admin',
                    ],
                    [
                        'name' => 'Manage Roles',
                        'permission' => 'manage_roles_permissions',
                    ],
                ]
            ],
            [
                'base' => 'Users',
                'permissions' => [
                    [
                        'name' => 'Manage Users',
                        'permission' => 'manage_users',
                    ],
                    [
                        'name' => 'Add New User',
                        'permission' => 'add_new_user',
                    ],
                ]
            ],
            [
                'base' => 'Settings',
                'permissions' => [
                    [
                        'name' => 'Manage Settings',
                        'permission' => 'manage_settings',
                    ],
                    [
                        'name' => 'Manage Console',
                        'permission' => 'manage_console',
                    ],
                ]
            ],
        ];

        foreach ($permissions as $perm) {
            $base = $perm['base'];

            foreach ($perm['permissions'] as $key => $permission) {
                Permission::create([
                    'base' => $base,
                    'name' => $permission['name'],
                    'permission' => $permission['permission'],
                ]);
            }
        }
    }
}
