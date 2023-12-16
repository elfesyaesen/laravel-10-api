<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = array(
            "user-add",
            "user-edit",
            "user-delete",
            "user-view",
            "role-add",
            "role-edit",
            "role-delete",
            "role-view"
        );

        foreach ($permissions as $permission) {
            Permission::create(["name" => $permission]);
        }
    }
}
