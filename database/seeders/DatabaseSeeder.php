<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Admin
    \App\Models\User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'role' => 'admin',
        'password' => 'password', // <--- Just plain text!
    ]);

    // User
    \App\Models\User::factory()->create([
        'name' => 'Tester User',
        'email' => 'user@example.com',
        'role' => 'user',
        'password' => 'password', // <--- Just plain text!
    ]);
}
}
