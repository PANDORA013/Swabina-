<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignSuperAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update super admin user
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@swabinagatra.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('12345678'),
                'role' => 'superadmin',
                'admin_role_id' => null,
            ]
        );

        echo "✅ Super Admin account configured successfully!\n";
        echo "   Email: superadmin@swabinagatra.com\n";
        echo "   Password: 12345678\n";
    }
}
