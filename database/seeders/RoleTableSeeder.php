<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Manager', 'Staff'];

        foreach ($roles as $key => $role) {
            $role = Role::create(['role' => $role]);

            if($key == 0){
                $permissions = Permission::all();
                foreach ($permissions as $perm) {
                    RolePermission::create(['role_id' => 1, 'permission_id' => $perm->id]);
                }

            }
        }
    }
}
