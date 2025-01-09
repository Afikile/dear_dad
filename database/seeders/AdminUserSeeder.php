<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the admin user doesn't already exist before creating
        User::firstOrCreate(
            ['email' => 'oneway102@gmail.com'], // Check for this email
            [
                'username' => 'Afikile',
                'email' => 'oneway102@gmail.com', // Match the email in the check
                'password' => Hash::make('Afikile21'), // Use a secure password
                'date_of_birth' => '1980-01-01',
                'role' => 'admin', // Assign admin role
            ]
        );
    }
}
