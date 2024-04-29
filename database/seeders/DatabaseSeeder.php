<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mamun Malik',
            'email' => 'admin@example.com',
            'type' => 'admin',
            'password' => 'password',
            'is_approved' => 'true',
        ]);
        User::factory()->create([
            'name' => 'Mehjabeen Tabassum',
            'email' => 'employee@example.com',
            'type' => 'employee',
            'password' => 'password',
            'is_approved' => 'true',
        ]);
    }
}
