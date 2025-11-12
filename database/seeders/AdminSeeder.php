<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@swabinagatra.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        echo "✅ 1 Admin account created (admin@swabinagatra.com / admin123)\n";
    }
}
