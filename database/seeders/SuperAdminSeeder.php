<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update the super admin user
        User::updateOrCreate(
            ['email' => 'chanro7080@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('1234567890'),
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
