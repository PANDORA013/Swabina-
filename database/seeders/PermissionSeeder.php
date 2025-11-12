<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Admin Management
            'create-admin',
            'read-admin',
            'update-admin',
            'delete-admin',
            
            // Content Management
            'create-berita',
            'read-berita',
            'update-berita',
            'delete-berita',
            
            'create-sertifikat',
            'read-sertifikat',
            'update-sertifikat',
            'delete-sertifikat',
            
            'create-faq',
            'read-faq',
            'update-faq',
            'delete-faq',
            
            'create-pedoman',
            'read-pedoman',
            'update-pedoman',
            'delete-pedoman',
            
            // Settings
            'manage-settings',
            'manage-roles',
            'view-analytics',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator', 'guard_name' => 'web']);

        // Assign all permissions to Super Admin
        $superAdminRole->syncPermissions($permissions);

        // Assign limited permissions to Admin
        $adminPermissions = [
            'read-berita', 'create-berita', 'update-berita',
            'read-sertifikat', 'create-sertifikat', 'update-sertifikat',
            'read-faq', 'create-faq', 'update-faq',
            'read-pedoman', 'create-pedoman', 'update-pedoman',
            'view-analytics',
        ];
        $adminRole->syncPermissions($adminPermissions);

        // Assign read-only permissions to Moderator
        $moderatorPermissions = [
            'read-berita',
            'read-sertifikat',
            'read-faq',
            'read-pedoman',
            'view-analytics',
        ];
        $moderatorRole->syncPermissions($moderatorPermissions);

        echo "✅ Permissions and Roles created successfully!\n";
    }
}
