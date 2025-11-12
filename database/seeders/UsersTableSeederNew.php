<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@swabinagatra.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create SDM User
        User::updateOrCreate(
            ['email' => 'sdm@swabinagatra.com'],
            [
                'name' => 'SDM User',
                'password' => Hash::make('sdm123'),
                'role' => 'sdm',
            ]
        );

        // Create Marketing User
        User::updateOrCreate(
            ['email' => 'marketing@swabinagatra.com'],
            [
                'name' => 'Marketing User',
                'password' => Hash::make('marketing123'),
                'role' => 'marketing',
            ]
        );

        echo "✅ Default users created successfully!\n";
        echo "📋 Login Credentials:\n";
        echo "   Admin:     admin@swabinagatra.com / admin123\n";
        echo "   SDM:       sdm@swabinagatra.com / sdm123\n";
        echo "   Marketing: marketing@swabinagatra.com / marketing123\n";
    }
}
