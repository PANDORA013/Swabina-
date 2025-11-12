<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

echo "\n========================================\n";
echo "🔐 CREATE SUPER ADMIN ACCOUNT\n";
echo "========================================\n\n";

// Create or get super_admin role
$superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
echo "✅ Super Admin role ready\n\n";

// Create new super admin user
$email = 'superadmin@swabinagatra.com';
$password = 'SuperAdmin@2025';
$name = 'Super Administrator';

// Check if user exists
$user = User::where('email', $email)->first();

if ($user) {
    echo "⚠️  User already exists: $email\n";
    echo "   Updating password...\n";
    $user->update(['password' => Hash::make($password)]);
} else {
    echo "📝 Creating new user...\n";
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
        'role' => 'admin',
    ]);
    echo "✅ User created: $email\n";
}

// Assign super_admin role
$user->syncRoles([$superAdminRole]);
echo "✅ Super Admin role assigned\n\n";

// Verify
$user->refresh();
echo "========================================\n";
echo "✅ SUPER ADMIN ACCOUNT READY!\n";
echo "========================================\n\n";
echo "📧 Email: $email\n";
echo "🔑 Password: $password\n";
echo "👤 Name: $name\n";
echo "🎯 Role: " . implode(', ', $user->getRoleNames()->toArray()) . "\n\n";
echo "⚠️  PENTING: Simpan kredensial ini di tempat aman!\n";
echo "   Ubah password setelah login pertama kali.\n\n";
