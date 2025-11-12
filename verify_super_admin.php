<?php

// Load Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\User;

echo "\n========================================\n";
echo "🔍 VERIFYING SUPER ADMIN SETUP\n";
echo "========================================\n\n";

// Check admin user
$admin = User::where('email', 'admin@swabinagatra.com')->first();

if ($admin) {
    echo "✅ Admin User Found!\n";
    echo "   ID: {$admin->id}\n";
    echo "   Name: {$admin->name}\n";
    echo "   Email: {$admin->email}\n";
    echo "   Role: {$admin->role}\n";
    echo "   Admin Role ID: {$admin->admin_role_id}\n";
    
    // Check admin role
    if ($admin->adminRole) {
        echo "\n✅ Admin Role Found!\n";
        echo "   Role Name: {$admin->adminRole->name}\n";
        echo "   Display Name: {$admin->adminRole->display_name}\n";
        echo "   Description: {$admin->adminRole->description}\n";
        
        // Check permissions
        $permissions = $admin->adminRole->permissions;
        echo "\n✅ Permissions: {$permissions->count()} total\n";
        
        // Check if super admin
        if ($admin->isSuperAdmin()) {
            echo "\n🎉 STATUS: SUPER ADMIN ✅\n";
        } else {
            echo "\n⚠️  STATUS: NOT SUPER ADMIN\n";
        }
    } else {
        echo "\n❌ Admin Role NOT Found!\n";
    }
} else {
    echo "❌ Admin User NOT Found!\n";
}

// Check admin roles table
echo "\n========================================\n";
echo "📊 ADMIN ROLES TABLE\n";
echo "========================================\n\n";

$roles = DB::table('admin_roles')->get();
foreach ($roles as $role) {
    echo "ID: {$role->id} | Name: {$role->name} | Display: {$role->display_name}\n";
}

// Check permissions count
echo "\n========================================\n";
echo "📊 PERMISSIONS TABLE\n";
echo "========================================\n\n";

$permCount = DB::table('permissions')->count();
echo "Total Permissions: {$permCount}\n";

// Check role_permission
echo "\n========================================\n";
echo "📊 ROLE PERMISSIONS MAPPING\n";
echo "========================================\n\n";

$rolePerms = DB::table('role_permission')
    ->where('admin_role_id', 1)
    ->count();
echo "Super Admin Permissions: {$rolePerms}\n";

echo "\n========================================\n";
echo "✅ VERIFICATION COMPLETE!\n";
echo "========================================\n\n";

echo "🔐 Login Credentials:\n";
echo "   Email: admin@swabinagatra.com\n";
echo "   Password: admin123\n\n";

echo "🌐 Access Admin Panel:\n";
echo "   URL: http://localhost:8000/admin/dashboard\n\n";

echo "👥 Manage Admins:\n";
echo "   URL: http://localhost:8000/admin/admin-management\n\n";
