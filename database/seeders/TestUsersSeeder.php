<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@legalease.local'],
            [
                'name'     => 'Test Customer',
                'password' => Hash::make('password123'),
                'role_id'  => 3,
            ]
        );

        User::updateOrCreate(
            ['email' => 'lawyer@legalease.local'],
            [
                'name'     => 'Test Lawyer',
                'password' => Hash::make('password123'),
                'role_id'  => 2,
            ]
        );
    }
}
