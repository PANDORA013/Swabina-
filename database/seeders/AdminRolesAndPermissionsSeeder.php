<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin roles
        $superAdminRole = DB::table('admin_roles')->insertGetId([
            'name' => 'super_admin',
            'display_name' => 'Super Admin',
            'description' => 'Full access to all features and admin management',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $adminRole = DB::table('admin_roles')->insertGetId([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Full access to content management',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $moderatorRole = DB::table('admin_roles')->insertGetId([
            'name' => 'moderator',
            'display_name' => 'Moderator',
            'description' => 'Limited access to specific features',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create permissions
        $permissions = [
            // Admin Management
            ['name' => 'manage_admins', 'display_name' => 'Manage Admins', 'module' => 'admin', 'description' => 'Create, edit, delete admin users'],
            ['name' => 'view_admin_logs', 'display_name' => 'View Admin Logs', 'module' => 'admin', 'description' => 'View admin activity logs'],
            
            // Berita Management
            ['name' => 'manage_berita', 'display_name' => 'Manage Berita', 'module' => 'berita', 'description' => 'Create, edit, delete berita'],
            ['name' => 'view_berita', 'display_name' => 'View Berita', 'module' => 'berita', 'description' => 'View berita list'],
            
            // FAQ Management
            ['name' => 'manage_faq', 'display_name' => 'Manage FAQ', 'module' => 'faq', 'description' => 'Create, edit, delete FAQ'],
            ['name' => 'view_faq', 'display_name' => 'View FAQ', 'module' => 'faq', 'description' => 'View FAQ list'],
            
            // Pedoman Management
            ['name' => 'manage_pedoman', 'display_name' => 'Manage Pedoman', 'module' => 'pedoman', 'description' => 'Create, edit, delete pedoman'],
            ['name' => 'view_pedoman', 'display_name' => 'View Pedoman', 'module' => 'pedoman', 'description' => 'View pedoman list'],
            
            // Jejak Langkah Management
            ['name' => 'manage_jejak', 'display_name' => 'Manage Jejak Langkah', 'module' => 'jejak', 'description' => 'Create, edit, delete jejak langkah'],
            ['name' => 'view_jejak', 'display_name' => 'View Jejak Langkah', 'module' => 'jejak', 'description' => 'View jejak langkah list'],
            
            // Why Choose Us Management
            ['name' => 'manage_why_choose_us', 'display_name' => 'Manage Why Choose Us', 'module' => 'why_choose_us', 'description' => 'Create, edit, delete why choose us'],
            ['name' => 'view_why_choose_us', 'display_name' => 'View Why Choose Us', 'module' => 'why_choose_us', 'description' => 'View why choose us list'],
            
            // Sertifikat Management
            ['name' => 'manage_sertifikat', 'display_name' => 'Manage Sertifikat', 'module' => 'sertifikat', 'description' => 'Create, edit, delete sertifikat'],
            ['name' => 'view_sertifikat', 'display_name' => 'View Sertifikat', 'module' => 'sertifikat', 'description' => 'View sertifikat list'],
            
            // Sekilas Perusahaan Management
            ['name' => 'manage_sekilas', 'display_name' => 'Manage Sekilas Perusahaan', 'module' => 'sekilas', 'description' => 'Edit sekilas perusahaan'],
            ['name' => 'view_sekilas', 'display_name' => 'View Sekilas Perusahaan', 'module' => 'sekilas', 'description' => 'View sekilas perusahaan'],
            
            // Company Info Management
            ['name' => 'manage_company_info', 'display_name' => 'Manage Company Info', 'module' => 'company_info', 'description' => 'Edit company information'],
            ['name' => 'view_company_info', 'display_name' => 'View Company Info', 'module' => 'company_info', 'description' => 'View company information'],
            
            // Social Media Management
            ['name' => 'manage_social_media', 'display_name' => 'Manage Social Media', 'module' => 'social_media', 'description' => 'Manage social media links'],
            ['name' => 'view_social_media', 'display_name' => 'View Social Media', 'module' => 'social_media', 'description' => 'View social media links'],
            
            // Dashboard
            ['name' => 'view_dashboard', 'display_name' => 'View Dashboard', 'module' => 'dashboard', 'description' => 'Access admin dashboard'],
        ];

        $permissionIds = [];
        foreach ($permissions as $permission) {
            $id = DB::table('permissions')->insertGetId([
                'name' => $permission['name'],
                'display_name' => $permission['display_name'],
                'module' => $permission['module'],
                'description' => $permission['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $permissionIds[$permission['name']] = $id;
        }

        // Assign all permissions to super_admin
        foreach ($permissionIds as $permissionId) {
            DB::table('role_permission')->insert([
                'admin_role_id' => $superAdminRole,
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Assign permissions to admin (all except admin management)
        $adminPermissions = array_filter($permissionIds, function($key) {
            return !str_contains($key, 'manage_admins') && !str_contains($key, 'view_admin_logs');
        }, ARRAY_FILTER_USE_KEY);

        foreach ($adminPermissions as $permissionId) {
            DB::table('role_permission')->insert([
                'admin_role_id' => $adminRole,
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Assign limited permissions to moderator
        $moderatorPermissions = [
            'view_berita', 'view_faq', 'view_pedoman', 'view_jejak', 
            'view_why_choose_us', 'view_sertifikat', 'view_sekilas',
            'view_company_info', 'view_social_media', 'view_dashboard'
        ];

        foreach ($moderatorPermissions as $permissionName) {
            if (isset($permissionIds[$permissionName])) {
                DB::table('role_permission')->insert([
                    'admin_role_id' => $moderatorRole,
                    'permission_id' => $permissionIds[$permissionName],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Update existing admin user to super_admin
        DB::table('users')
            ->where('email', 'admin@swabinagatra.com')
            ->update([
                'admin_role_id' => $superAdminRole,
                'role' => 'admin'
            ]);

        // Verify the update
        $adminUser = DB::table('users')
            ->where('email', 'admin@swabinagatra.com')
            ->first();
        
        if ($adminUser) {
            echo "\n✅ Super Admin Set Successfully!\n";
            echo "Email: {$adminUser->email}\n";
            echo "Role ID: {$adminUser->admin_role_id}\n";
            echo "Status: Super Admin\n\n";
        }
    }
}
