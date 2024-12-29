<?php

namespace Database\Seeders;
use App\Models\Letter;
use App\Models\Reply;
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
        $user = User::first(); // Get the first user for testing

    $letter = Letter::create([
        'title' => 'Test Letter',
        'body' => 'This is a sample letter.',
        'user_id' => $user->id,
    ]);

    Reply::create([
        'body' => 'This is a sample reply.',
        'letter_id' => $letter->id,
        'user_id' => $user->id,
    ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}


