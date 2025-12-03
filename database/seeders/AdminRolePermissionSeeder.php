<?php

namespace Database\Seeders;

use App\Models\AdminRole;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "\n=== SEEDING ADMIN ROLES & PERMISSIONS ===\n";

        // 1. Create Permissions for custom system
        $permissions = [
            // Berita/News
            ['name' => 'manage-news', 'display_name' => 'Manage News', 'module' => 'berita'],
            ['name' => 'read-berita', 'display_name' => 'Read Berita', 'module' => 'berita'],
            ['name' => 'create-berita', 'display_name' => 'Create Berita', 'module' => 'berita'],
            ['name' => 'update-berita', 'display_name' => 'Update Berita', 'module' => 'berita'],
            ['name' => 'delete-berita', 'display_name' => 'Delete Berita', 'module' => 'berita'],

            // Sertifikat
            ['name' => 'manage-sertifikat', 'display_name' => 'Manage Sertifikat', 'module' => 'sertifikat'],
            ['name' => 'read-sertifikat', 'display_name' => 'Read Sertifikat', 'module' => 'sertifikat'],
            ['name' => 'create-sertifikat', 'display_name' => 'Create Sertifikat', 'module' => 'sertifikat'],
            ['name' => 'update-sertifikat', 'display_name' => 'Update Sertifikat', 'module' => 'sertifikat'],
            ['name' => 'delete-sertifikat', 'display_name' => 'Delete Sertifikat', 'module' => 'sertifikat'],

            // FAQ
            ['name' => 'manage-faq', 'display_name' => 'Manage FAQ', 'module' => 'faq'],
            ['name' => 'read-faq', 'display_name' => 'Read FAQ', 'module' => 'faq'],
            ['name' => 'create-faq', 'display_name' => 'Create FAQ', 'module' => 'faq'],
            ['name' => 'update-faq', 'display_name' => 'Update FAQ', 'module' => 'faq'],
            ['name' => 'delete-faq', 'display_name' => 'Delete FAQ', 'module' => 'faq'],

            // Pedoman
            ['name' => 'manage-pedoman', 'display_name' => 'Manage Pedoman', 'module' => 'pedoman'],
            ['name' => 'read-pedoman', 'display_name' => 'Read Pedoman', 'module' => 'pedoman'],
            ['name' => 'create-pedoman', 'display_name' => 'Create Pedoman', 'module' => 'pedoman'],
            ['name' => 'update-pedoman', 'display_name' => 'Update Pedoman', 'module' => 'pedoman'],
            ['name' => 'delete-pedoman', 'display_name' => 'Delete Pedoman', 'module' => 'pedoman'],

            // Settings
            ['name' => 'manage-settings', 'display_name' => 'Manage Settings', 'module' => 'settings'],
            ['name' => 'manage-company-info', 'display_name' => 'Manage Company Info', 'module' => 'settings'],
            ['name' => 'manage-social-links', 'display_name' => 'Manage Social Links', 'module' => 'settings'],

            // Admin Management
            ['name' => 'manage-admins', 'display_name' => 'Manage Admins', 'module' => 'admin'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm['name']],
                ['display_name' => $perm['display_name'], 'module' => $perm['module']]
            );
        }
        echo "✅ Created " . count($permissions) . " permissions\n";

        // 2. Get or create Admin Roles (Only 2 roles: Super Admin and Admin)
        $superAdminRole = AdminRole::firstOrCreate(
            ['name' => 'super_admin'],
            ['display_name' => 'Super Admin', 'description' => 'Full access to all features and can manage admins']
        );
        echo "✅ Super Admin Role: {$superAdminRole->id}\n";

        $adminRole = AdminRole::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'Admin', 'description' => 'Limited access based on assigned permissions']
        );
        echo "✅ Admin Role: {$adminRole->id}\n";

        // 3. Assign permissions to Super Admin (all permissions)
        $allPermissions = Permission::all();
        foreach ($allPermissions as $perm) {
            $superAdminRole->permissions()->syncWithoutDetaching($perm->id);
        }
        echo "✅ Assigned " . count($allPermissions) . " permissions to Super Admin\n";

        // 4. Assign limited permissions to Administrator
        $adminPermissions = Permission::whereIn('name', [
            'manage-news', 'read-berita', 'create-berita', 'update-berita',
            'manage-sertifikat', 'read-sertifikat', 'create-sertifikat', 'update-sertifikat',
            'manage-faq', 'read-faq', 'create-faq', 'update-faq',
            'manage-pedoman', 'read-pedoman', 'create-pedoman', 'update-pedoman',
        ])->get();

        foreach ($adminPermissions as $perm) {
            $adminRole->permissions()->syncWithoutDetaching($perm->id);
        }
        echo "✅ Assigned " . count($adminPermissions) . " permissions to Administrator\n";

        echo "\n=== SEEDING COMPLETE ===\n";
    }
}
