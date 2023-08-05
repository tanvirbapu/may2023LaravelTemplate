<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'user', 'guard_name' => 'web']);
        Role::create(['name' => 'app user', 'guard_name' => 'web']);


        //create admin
        User::factory()->create([
            'role_id' => '1',
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret'),
            'phone' => '1234567890',
        ]);

        $user = User::find(1);
        $user->assignRole('admin');
    }
}