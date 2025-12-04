<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AdminRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateSpecificSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Membuat akun Super Admin dengan akses mutlak ke seluruh sistem.
     * Super Admin akan bypass semua permission checks.
     */
    public function run(): void
    {
        DB::beginTransaction();
        
        try {
            // 1. Pastikan Role 'Super Admin' dengan akses mutlak (is_super_admin = 1) tersedia
            // Kita gunakan firstOrCreate agar tidak duplikat
            $superAdminRole = AdminRole::firstOrCreate(
                ['name' => 'Super Admin'], // Cari berdasarkan nama
                [
                    'description' => 'Role dengan akses mutlak ke seluruh sistem',
                    'is_super_admin' => true, // Kunci akses mutlak
                    'is_active' => true,
                ]
            );

            // Pastikan flag is_super_admin benar-benar true (jika role sudah ada sebelumnya tapi salah set)
            if (!$superAdminRole->is_super_admin) {
                $superAdminRole->update([
                    'is_super_admin' => true,
                    'is_active' => true
                ]);
                $this->command->warn('Role Super Admin sudah ada, tapi flag is_super_admin diupdate ke TRUE');
            }

            // 2. Buat atau Update User Super Admin
            $user = User::updateOrCreate(
                ['email' => 'superadmin@swabinagatra.com'], // Kunci pencarian (Email Unik)
                [
                    'name' => 'Super Administrator',
                    'password' => Hash::make('12345678'),
                    'admin_role_id' => $superAdminRole->id, // Relasi ke Role Mutlak
                    'email_verified_at' => now(),
                ]
            );
            
            DB::commit();
            
            // Output Success Information
            $this->command->info('');
            $this->command->info('=========================================');
            $this->command->info('✅ AKUN SUPER ADMIN MUTLAK BERHASIL DIBUAT');
            $this->command->info('=========================================');
            $this->command->info('Email    : superadmin@swabinagatra.com');
            $this->command->info('Password : 12345678');
            $this->command->info('Role     : Super Admin (ID: ' . $superAdminRole->id . ')');
            $this->command->info('Status   : ✅ Akses Penuh / All Permissions');
            $this->command->info('=========================================');
            $this->command->info('');
            $this->command->warn('⚠️  PENTING: Ganti password default setelah login pertama!');
            $this->command->info('');
            
            // Verify Super Admin Privileges
            $this->command->info('🔍 Verifikasi Privilege:');
            $this->command->info('   - admin_role_id: ' . $user->admin_role_id);
            
            // Check if adminRole relationship exists
            if (method_exists($user, 'adminRole')) {
                $adminRole = $user->adminRole;
                if ($adminRole) {
                    $this->command->info('   - Role Name: ' . $adminRole->name);
                    $this->command->info('   - is_super_admin flag: ' . ($adminRole->is_super_admin ? '✅ TRUE' : '❌ FALSE'));
                }
            }
            
            // Check if isSuperAdmin method exists
            if (method_exists($user, 'isSuperAdmin')) {
                $this->command->info('   - isSuperAdmin(): ' . ($user->isSuperAdmin() ? '✅ TRUE' : '❌ FALSE'));
            }
            
            $this->command->info('');
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('❌ Error membuat Super Admin: ' . $e->getMessage());
            $this->command->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
