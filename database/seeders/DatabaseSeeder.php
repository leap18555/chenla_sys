<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Account
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('leap18'),
            'role' => '1', // or 1
        ]);

        // 2. Manager Account
        User::create([
            'name' => 'Branch Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('leap18'),
            'role' => '2', // or 2
        ]);

        // 3. Staff Account
        User::create([
            'name' => 'Front Desk Staff',
            'email' => 'staff@example.com',
            'password' => Hash::make('leap18'),
            'role' => '3', // or 3
        ]);
    }
}