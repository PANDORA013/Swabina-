<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

// Get the admin user
$user = User::where('email', 'admin@swabinagatra.com')->first();

if (!$user) {
    echo "❌ User not found!\n";
    exit(1);
}

// Get or create super_admin role
$superAdminRole = Role::where('name', 'super_admin')->first();

if (!$superAdminRole) {
    echo "❌ Super Admin role not found!\n";
    exit(1);
}

// Assign role to user
$user->assignRole($superAdminRole);

echo "✅ Super Admin role assigned to: {$user->email}\n";
echo "✅ User Roles: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";
