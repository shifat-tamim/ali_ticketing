<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // IT user
        User::create([
            'name' => 'IT User',
            'username' => 'ituser',
            'email' => 'it@example.com',
            'password' => Hash::make('it123'),
            'role' => 'it',
        ]);

        // General user
        User::create([
            'name' => 'General User',
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
