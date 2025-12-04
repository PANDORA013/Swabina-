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
            // 1. Create Admin Roles Structure
            AdminRoleSeeder::class,
            
            // 2. Create Permissions System
            CreatePermissionsSeeder::class,
            
            // 3. Create Super Admin User (Hardcoded)
            CreateSpecificSuperAdminSeeder::class,
            
            // 4. Seed Service Pages (Dynamic Content)
            LayananSeeder::class,
            
            // 5. Seed Company Info (Optional - can be managed via admin)
            CompanyInfoSeeder::class,
        ]);
    }
}
