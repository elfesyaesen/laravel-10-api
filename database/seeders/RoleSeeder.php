<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_permissions = array(
            "user-add",
            "user-edit",
            "user-delete",
            "user-view",
            "role-add",
            "role-edit",
            "role-delete",
            "role-view"
        );

        $admin_role = Role::create(["name" => "Super Admin"]);
        $admin_role->givePermissionTo($admin_permissions);

        $user_permissions = array(
            "user-edit",
            "user-view",
        );
        $user_role = Role::create(["name" => "User Admin"]);
        $user_role->givePermissionTo($user_permissions);
    }
}
