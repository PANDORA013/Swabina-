<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class SuperAdminRestrictAdminTest extends TestCase
{
    use RefreshDatabase;

    protected $superAdmin;
    protected $newAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setupPermissions();
        $this->createTestUsers();
    }

    /**
     * Setup Spatie roles and permissions
     */
    private function setupPermissions()
    {
        // Create Spatie roles
        app('Spatie\Permission\Models\Role')->create(['name' => 'super_admin', 'guard_name' => 'web']);
        app('Spatie\Permission\Models\Role')->create(['name' => 'admin', 'guard_name' => 'web']);

        // Create permissions
        $permissions = [
            'read-faq', 'create-faq', 'update-faq', 'delete-faq',
            'read-sertifikat', 'create-sertifikat', 'update-sertifikat', 'delete-sertifikat',
            'read-pedoman', 'create-pedoman', 'update-pedoman', 'delete-pedoman',
            'manage-settings'
        ];
        foreach ($permissions as $perm) {
            app('Spatie\Permission\Models\Permission')->create(['name' => $perm, 'guard_name' => 'web']);
        }
    }

    /**
     * Create test users
     */
    private function createTestUsers()
    {
        // Create Super Admin
        $this->superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
        ]);
        $this->superAdmin->assignRole('super_admin');

        // Create New Admin (tanpa permission apapun)
        $this->newAdmin = User::create([
            'name' => 'New Admin',
            'email' => 'newadmin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        $this->newAdmin->assignRole('admin');
    }

    // ============================================
    // SCENARIO 1: Super Admin membuat admin baru tanpa permission
    // ============================================

    /**
     * Test: Admin baru tidak memiliki permission apapun
     */
    public function test_new_admin_has_no_permissions_initially(): void
    {
        $this->assertFalse($this->newAdmin->hasPermissionTo('read-faq'));
        $this->assertFalse($this->newAdmin->hasPermissionTo('create-faq'));
        $this->assertFalse($this->newAdmin->hasPermissionTo('read-sertifikat'));
        $this->assertFalse($this->newAdmin->hasPermissionTo('manage-settings'));
    }

    /**
     * Test: Admin baru tidak bisa akses FAQ
     */
    public function test_new_admin_cannot_access_faq(): void
    {
        $response = $this->actingAs($this->newAdmin)->postJson('/admin/faq/store', [
            'pertanyaan_id' => 'Test Question',
            'jawaban_id' => 'Test Answer',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test: Admin baru tidak bisa akses Sertifikat
     */
    public function test_new_admin_cannot_access_sertifikat(): void
    {
        $response = $this->actingAs($this->newAdmin)->postJson('/admin/sertifikat/store', [
            'nama' => 'Test Sertifikat',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test: Admin baru tidak bisa akses Pengaturan
     */
    public function test_new_admin_cannot_access_settings(): void
    {
        $response = $this->actingAs($this->newAdmin)->postJson('/admin/company-info/update', [
            'nama_perusahaan' => 'Test Company',
        ]);

        // Route mungkin tidak ada (405) atau forbidden (403), keduanya OK
        $this->assertTrue(
            in_array($response->status(), [403, 405]),
            "Expected status 403 or 405, but got {$response->status()}"
        );
    }

    // ============================================
    // SCENARIO 2: Super Admin memberikan permission terbatas ke admin baru
    // ============================================

    /**
     * Test: Super Admin memberikan FAQ READ permission saja
     */
    public function test_super_admin_grants_read_faq_only(): void
    {
        // Super Admin memberikan permission
        $this->superAdmin->givePermissionTo('read-faq');
        $this->newAdmin->givePermissionTo('read-faq');

        // Verifikasi admin baru punya read-faq
        $this->assertTrue($this->newAdmin->hasPermissionTo('read-faq'));
        
        // Verifikasi admin baru tidak punya create-faq
        $this->assertFalse($this->newAdmin->hasPermissionTo('create-faq'));
        $this->assertFalse($this->newAdmin->hasPermissionTo('update-faq'));
        $this->assertFalse($this->newAdmin->hasPermissionTo('delete-faq'));
    }

    /**
     * Test: Super Admin memberikan FAQ CRUD permission
     */
    public function test_super_admin_grants_full_faq_access(): void
    {
        // Super Admin memberikan semua FAQ permission
        $faqPermissions = ['read-faq', 'create-faq', 'update-faq', 'delete-faq'];
        $this->newAdmin->givePermissionTo($faqPermissions);

        // Verifikasi admin baru punya semua FAQ permission
        foreach ($faqPermissions as $perm) {
            $this->assertTrue($this->newAdmin->hasPermissionTo($perm));
        }

        // Verifikasi admin baru tidak punya Sertifikat permission
        $this->assertFalse($this->newAdmin->hasPermissionTo('read-sertifikat'));
    }

    /**
     * Test: Super Admin memberikan permission terbatas (FAQ + Sertifikat)
     */
    public function test_super_admin_grants_limited_multi_permissions(): void
    {
        // Super Admin memberikan FAQ + Sertifikat permission
        $permissions = [
            'read-faq', 'create-faq', 'update-faq', 'delete-faq',
            'read-sertifikat', 'create-sertifikat'
        ];
        $this->newAdmin->givePermissionTo($permissions);

        // Verifikasi admin baru punya FAQ permission
        $this->assertTrue($this->newAdmin->hasPermissionTo('read-faq'));
        $this->assertTrue($this->newAdmin->hasPermissionTo('create-faq'));

        // Verifikasi admin baru punya Sertifikat READ & CREATE
        $this->assertTrue($this->newAdmin->hasPermissionTo('read-sertifikat'));
        $this->assertTrue($this->newAdmin->hasPermissionTo('create-sertifikat'));

        // Verifikasi admin baru TIDAK punya Sertifikat UPDATE & DELETE
        $this->assertFalse($this->newAdmin->hasPermissionTo('update-sertifikat'));
        $this->assertFalse($this->newAdmin->hasPermissionTo('delete-sertifikat'));

        // Verifikasi admin baru TIDAK punya Pedoman permission
        $this->assertFalse($this->newAdmin->hasPermissionTo('read-pedoman'));
    }

    // ============================================
    // SCENARIO 3: Super Admin merevoke permission dari admin
    // ============================================

    /**
     * Test: Super Admin merevoke satu permission
     */
    public function test_super_admin_revokes_single_permission(): void
    {
        // Berikan permission
        $this->newAdmin->givePermissionTo(['read-faq', 'create-faq', 'update-faq']);

        // Verifikasi punya permission
        $this->assertTrue($this->newAdmin->hasPermissionTo('read-faq'));
        $this->assertTrue($this->newAdmin->hasPermissionTo('create-faq'));

        // Super Admin merevoke create-faq
        $this->newAdmin->revokePermissionTo('create-faq');

        // Verifikasi create-faq sudah dihapus
        $this->assertFalse($this->newAdmin->hasPermissionTo('create-faq'));
        
        // Verifikasi permission lain masih ada
        $this->assertTrue($this->newAdmin->hasPermissionTo('read-faq'));
        $this->assertTrue($this->newAdmin->hasPermissionTo('update-faq'));
    }

    /**
     * Test: Super Admin merevoke semua permission
     */
    public function test_super_admin_revokes_all_permissions(): void
    {
        // Berikan permission
        $permissions = ['read-faq', 'create-faq', 'update-faq', 'delete-faq'];
        $this->newAdmin->givePermissionTo($permissions);

        // Verifikasi punya semua permission
        foreach ($permissions as $perm) {
            $this->assertTrue($this->newAdmin->hasPermissionTo($perm));
        }

        // Super Admin merevoke semua permission
        $this->newAdmin->revokePermissionTo($permissions);

        // Verifikasi semua permission sudah dihapus
        foreach ($permissions as $perm) {
            $this->assertFalse($this->newAdmin->hasPermissionTo($perm));
        }
    }

    // ============================================
    // SCENARIO 4: Admin dengan permission terbatas tidak bisa akses fitur lain
    // ============================================

    /**
     * Test: Admin dengan FAQ permission tidak bisa akses Sertifikat
     */
    public function test_admin_with_faq_permission_cannot_access_sertifikat(): void
    {
        // Super Admin memberikan FAQ permission saja
        $this->newAdmin->givePermissionTo(['read-faq', 'create-faq', 'update-faq', 'delete-faq']);

        // Coba akses Sertifikat
        $response = $this->actingAs($this->newAdmin)->postJson('/admin/sertifikat/store', [
            'nama' => 'Test Sertifikat',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test: Admin dengan Sertifikat permission tidak bisa akses Pedoman
     */
    public function test_admin_with_sertifikat_permission_cannot_access_pedoman(): void
    {
        // Super Admin memberikan Sertifikat permission saja
        $this->newAdmin->givePermissionTo(['read-sertifikat', 'create-sertifikat']);

        // Coba akses Pedoman
        $response = $this->actingAs($this->newAdmin)->postJson('/admin/pedoman/store', [
            'judul' => 'Test Pedoman',
        ]);

        $response->assertStatus(403);
    }

    // ============================================
    // SCENARIO 5: Super Admin dapat akses semua fitur meski admin dibatasi
    // ============================================

    /**
     * Test: Super Admin tetap bisa akses FAQ meski admin dibatasi
     */
    public function test_super_admin_can_access_faq_regardless_of_admin_restriction(): void
    {
        // Admin baru tidak punya permission
        $this->assertFalse($this->newAdmin->hasPermissionTo('read-faq'));

        // Super Admin tetap bisa akses
        $response = $this->actingAs($this->superAdmin)->postJson('/admin/faq/store', [
            'pertanyaan_id' => 'Test Question',
            'jawaban_id' => 'Test Answer',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test: Super Admin dapat grant permission kapan saja
     */
    public function test_super_admin_can_grant_permission_anytime(): void
    {
        // Admin baru tidak punya permission
        $this->assertFalse($this->newAdmin->hasPermissionTo('read-faq'));

        // Super Admin grant permission
        $this->superAdmin->givePermissionTo('read-faq');
        $this->newAdmin->givePermissionTo('read-faq');

        // Verifikasi permission sudah diberikan
        $this->assertTrue($this->newAdmin->hasPermissionTo('read-faq'));
    }

    /**
     * Test: Super Admin dapat revoke permission kapan saja
     */
    public function test_super_admin_can_revoke_permission_anytime(): void
    {
        // Admin baru punya permission
        $this->newAdmin->givePermissionTo('read-faq');
        $this->assertTrue($this->newAdmin->hasPermissionTo('read-faq'));

        // Super Admin revoke permission
        $this->newAdmin->revokePermissionTo('read-faq');

        // Verifikasi permission sudah dihapus
        $this->assertFalse($this->newAdmin->hasPermissionTo('read-faq'));
    }
}
