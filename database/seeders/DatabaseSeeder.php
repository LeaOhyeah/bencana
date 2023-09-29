<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, Post, Disaster};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Disaster::factory()->create([
            'code' => 'DEFAULT',
            'created_by' => 1,
            'edited_by' => 1,
            'name' => 'Default',
            'start_date' => now(),
            'lat' => '1',
            'long' => '1',
        ]);

        Post::factory()->create([
            'code' => 'DEFAULT',
            'created_by' => 1,
            'edited_by' => 1,
            'disaster_id' => 1,
            'name' => 'Default',
            'lat' => '1',
            'long' => '1',
        ]);

        User::factory()->create([
            'full_name' => 'Default',
            'email' => 'default@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            'role' => 3,
            'is_verified' => true,
            'post_id' => 1,
        ]);
    }
}
