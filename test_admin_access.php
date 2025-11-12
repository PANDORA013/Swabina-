<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

echo "\n========================================\n";
echo "🧪 TESTING ADMIN ACCESS\n";
echo "========================================\n\n";

// Get the admin user
$user = User::where('email', 'admin@swabinagatra.com')->first();

if (!$user) {
    echo "❌ Admin user not found!\n";
    exit(1);
}

echo "✅ Admin User: {$user->email}\n";
echo "   Name: {$user->name}\n\n";

// Test role check
echo "📋 ROLE CHECKS:\n";
echo "   Has super_admin role: " . ($user->hasRole('super_admin') ? '✅ YES' : '❌ NO') . "\n";
echo "   Has admin role: " . ($user->hasRole('admin') ? '✅ YES' : '❌ NO') . "\n";
echo "   Has moderator role: " . ($user->hasRole('moderator') ? '✅ YES' : '❌ NO') . "\n\n";

// Test permission checks
echo "🔐 PERMISSION CHECKS:\n";
echo "   Can create-admin: " . ($user->can('create-admin') ? '✅ YES' : '❌ NO') . "\n";
echo "   Can read-admin: " . ($user->can('read-admin') ? '✅ YES' : '❌ NO') . "\n";
echo "   Can update-admin: " . ($user->can('update-admin') ? '✅ YES' : '❌ NO') . "\n";
echo "   Can delete-admin: " . ($user->can('delete-admin') ? '✅ YES' : '❌ NO') . "\n\n";

// Test middleware simulation
echo "🛡️  MIDDLEWARE SIMULATION:\n";

if ($user->hasRole('super_admin')) {
    echo "   ✅ PASS: User can access admin management page\n";
    echo "   ✅ Route: /admin/admin-management\n";
    echo "   ✅ Middleware: 'auth', 'role:super_admin'\n";
} else {
    echo "   ❌ FAIL: User CANNOT access admin management page\n";
    echo "   ❌ Reason: Missing super_admin role\n";
}

echo "\n========================================\n";
echo "✅ TEST COMPLETE\n";
echo "========================================\n\n";
