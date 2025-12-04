<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminRoleSeeder::class,
            AssignSuperAdminRoleSeeder::class,
            CreatePermissionsSeeder::class,
            LayananSeeder::class, // Seed service pages data
        ]);
    }
}
