<?php

namespace Database\Seeders;

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
        $this->call([
            TestUsersSeeder::class,
        ]);

        if (class_exists(\Database\Seeders\RealisticDemoSeeder::class)) {
            $this->call(\Database\Seeders\RealisticDemoSeeder::class);
        }
    }
}
