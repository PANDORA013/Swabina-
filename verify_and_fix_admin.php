<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

echo "\n========================================\n";
echo "🔍 VERIFYING ADMIN USER\n";
echo "========================================\n\n";

// Get the admin user
$user = User::where('email', 'admin@swabinagatra.com')->first();

if (!$user) {
    echo "❌ User not found!\n";
    exit(1);
}

echo "✅ User Found:\n";
echo "   Email: {$user->email}\n";
echo "   Name: {$user->name}\n";
echo "   Current Roles: " . implode(', ', $user->getRoleNames()->toArray() ?: ['NONE']) . "\n\n";

// Get or create super_admin role
$superAdminRole = Role::where('name', 'super_admin')->first();

if (!$superAdminRole) {
    echo "❌ Super Admin role not found!\n";
    exit(1);
}

echo "✅ Super Admin Role Found\n\n";

// Remove all existing roles
$user->syncRoles([]);
echo "✅ Cleared all existing roles\n";

// Assign super_admin role
$user->assignRole($superAdminRole);
echo "✅ Assigned super_admin role\n\n";

// Verify
$user->refresh();
echo "========================================\n";
echo "✅ VERIFICATION COMPLETE\n";
echo "========================================\n\n";
echo "User Roles: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";
echo "Has super_admin role: " . ($user->hasRole('super_admin') ? 'YES ✅' : 'NO ❌') . "\n";
echo "Can access admin management: " . ($user->hasRole('super_admin') ? 'YES ✅' : 'NO ❌') . "\n\n";
