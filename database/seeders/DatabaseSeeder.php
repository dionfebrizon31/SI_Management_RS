<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'tests@gmail.com',
            'username' => '123',
            'role' => 'admins',
            'nomorhp' => '123',
            'password' => Hash::make('123'),
            'jabatans_id' => '1',
        ]);
    }
}
