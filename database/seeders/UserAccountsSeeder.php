<?php

namespace Database\Seeders;

use App\Models\UserAccounts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAccountsSeeder extends Seeder
{
    public function run(): void
    {
        UserAccounts::query()->updateOrCreate(
            ['username' => 'admin'],
            [
                'email' => 'admin@example.com',
                'password' => Hash::make('12345'),
                'role' => 'admin',
                'is_active' => 1,
                'must_change_password' => false,
            ]
        );

        UserAccounts::query()->updateOrCreate(
            ['username' => 'student1'],
            [
                'email' => 'student1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'is_active' => 1,
                'must_change_password' => true,
            ]
        );
    }
}
