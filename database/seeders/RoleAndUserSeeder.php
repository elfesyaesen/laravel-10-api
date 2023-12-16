<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            "name"=> "admin",
            "email" => "admin@sofwaredevelopers.com",
            "password" => bcrypt("Api123")
        ]);
        $admin->assignRole('Super Admin');

        $user = User::create([
            "name"=> "user",
            "email" => "user@sofwaredevelopers.com",
            "password" => bcrypt("Api123")
        ]);
        $user->assignRole('User Admin');


    }
}
