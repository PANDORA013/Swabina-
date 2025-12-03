<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Faq;
use App\Models\Sertifikat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AdminAccessRestrictedFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected $superAdmin;
    protected $restrictedAdmin;

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

        // Create Restricted Admin (hanya punya FAQ permission)
        $this->restrictedAdmin = User::create([
            'name' => 'Restricted Admin',
            'email' => 'restricted@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        $this->restrictedAdmin->assignRole('admin');
        // Hanya berikan FAQ permission
        $this->restrictedAdmin->givePermissionTo(['read-faq', 'create-faq', 'update-faq', 'delete-faq']);
    }

    // ============================================
    // SCENARIO 1: Admin mencoba akses FAQ (ALLOWED)
    // ============================================

    /**
     * Test: Admin dengan FAQ permission bisa READ FAQ
     */
    public function test_admin_can_read_faq_with_permission(): void
    {
        $this->assertTrue($this->restrictedAdmin->hasPermissionTo('read-faq'));
    }

    /**
     * Test: Admin dengan FAQ permission bisa CREATE FAQ
     */
    public function test_admin_can_create_faq_with_permission(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->postJson('/admin/faq/store', [
            'pertanyaan_id' => 'Pertanyaan Test',
            'jawaban_id' => 'Jawaban Test',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test: Admin dengan FAQ permission bisa UPDATE FAQ
     */
    public function test_admin_can_update_faq_with_permission(): void
    {
        $faq = Faq::create([
            'content' => [
                'id' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1'],
                'en' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1']
            ]
        ]);

        $response = $this->actingAs($this->restrictedAdmin)->putJson("/admin/faq/update/{$faq->id}", [
            'pertanyaan_id' => 'Updated Q',
            'jawaban_id' => 'Updated A',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test: Admin dengan FAQ permission bisa DELETE FAQ
     */
    public function test_admin_can_delete_faq_with_permission(): void
    {
        $faq = Faq::create([
            'content' => [
                'id' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1'],
                'en' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1']
            ]
        ]);

        $response = $this->actingAs($this->restrictedAdmin)->deleteJson("/admin/faq/delete/{$faq->id}");

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    // ============================================
    // SCENARIO 2: Admin mencoba akses Sertifikat (FORBIDDEN)
    // ============================================

    /**
     * Test: Admin TIDAK punya Sertifikat permission
     */
    public function test_admin_does_not_have_sertifikat_permission(): void
    {
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('read-sertifikat'));
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('create-sertifikat'));
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('update-sertifikat'));
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('delete-sertifikat'));
    }

    /**
     * Test: Admin mencoba CREATE Sertifikat (FORBIDDEN)
     */
    public function test_admin_cannot_create_sertifikat_without_permission(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->postJson('/admin/sertifikat/store', [
            'nama' => 'Test Sertifikat',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test: Admin mencoba READ Sertifikat (FORBIDDEN)
     */
    public function test_admin_cannot_read_sertifikat_without_permission(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->getJson('/admin/sertifikat');

        $response->assertStatus(403);
    }

    /**
     * Test: Admin mencoba UPDATE Sertifikat (FORBIDDEN)
     */
    public function test_admin_cannot_update_sertifikat_without_permission(): void
    {
        $sertifikat = Sertifikat::create([
            'nama' => 'Test Sertifikat',
            'file' => 'test.pdf'
        ]);

        $response = $this->actingAs($this->restrictedAdmin)->putJson("/admin/sertifikat/update/{$sertifikat->id}", [
            'nama' => 'Updated Sertifikat',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test: Admin mencoba DELETE Sertifikat (FORBIDDEN)
     */
    public function test_admin_cannot_delete_sertifikat_without_permission(): void
    {
        $sertifikat = Sertifikat::create([
            'nama' => 'Test Sertifikat',
            'file' => 'test.pdf'
        ]);

        $response = $this->actingAs($this->restrictedAdmin)->deleteJson("/admin/sertifikat/delete/{$sertifikat->id}");

        $response->assertStatus(403);
    }

    // ============================================
    // SCENARIO 3: Admin mencoba akses Pedoman (FORBIDDEN)
    // ============================================

    /**
     * Test: Admin TIDAK punya Pedoman permission
     */
    public function test_admin_does_not_have_pedoman_permission(): void
    {
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('read-pedoman'));
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('create-pedoman'));
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('update-pedoman'));
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('delete-pedoman'));
    }

    /**
     * Test: Admin mencoba CREATE Pedoman (FORBIDDEN)
     */
    public function test_admin_cannot_create_pedoman_without_permission(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->postJson('/admin/pedoman/store', [
            'judul' => 'Test Pedoman',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test: Admin mencoba READ Pedoman (FORBIDDEN)
     */
    public function test_admin_cannot_read_pedoman_without_permission(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->getJson('/admin/pedoman');

        $response->assertStatus(403);
    }

    /**
     * Test: Admin mencoba UPDATE Pedoman (FORBIDDEN)
     */
    public function test_admin_cannot_update_pedoman_without_permission(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->putJson('/admin/pedoman/update/1', [
            'judul' => 'Updated Pedoman',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test: Admin mencoba DELETE Pedoman (FORBIDDEN)
     */
    public function test_admin_cannot_delete_pedoman_without_permission(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->deleteJson('/admin/pedoman/delete/1');

        $response->assertStatus(403);
    }

    // ============================================
    // SCENARIO 4: Admin mencoba akses Settings (FORBIDDEN)
    // ============================================

    /**
     * Test: Admin TIDAK punya Settings permission
     */
    public function test_admin_does_not_have_settings_permission(): void
    {
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('manage-settings'));
    }

    /**
     * Test: Admin mencoba UPDATE Settings (FORBIDDEN)
     */
    public function test_admin_cannot_update_settings_without_permission(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->postJson('/admin/company-info/update', [
            'nama_perusahaan' => 'Test Company',
        ]);

        $this->assertTrue(
            in_array($response->status(), [403, 405]),
            "Expected status 403 or 405, but got {$response->status()}"
        );
    }

    // ============================================
    // SCENARIO 5: Admin mencoba bypass permission (FAILED)
    // ============================================

    /**
     * Test: Admin TIDAK bisa bypass permission check
     */
    public function test_admin_cannot_bypass_permission_check(): void
    {
        // Admin bukan super admin
        $this->assertFalse($this->restrictedAdmin->isSuperAdmin());
        
        // Admin hanya punya FAQ permission
        $this->assertTrue($this->restrictedAdmin->hasPermissionTo('read-faq'));
        
        // Admin TIDAK punya Sertifikat permission
        $this->assertFalse($this->restrictedAdmin->hasPermissionTo('read-sertifikat'));
    }

    /**
     * Test: Admin tidak bisa akses fitur meski sudah login
     */
    public function test_admin_cannot_access_restricted_feature_even_when_logged_in(): void
    {
        // Admin sudah login
        $this->actingAs($this->restrictedAdmin);

        // Tapi tetap tidak bisa akses Sertifikat
        $response = $this->postJson('/admin/sertifikat/store', [
            'nama' => 'Test Sertifikat',
        ]);

        $response->assertStatus(403);
    }

    // ============================================
    // SCENARIO 6: Super Admin masih bisa akses semua
    // ============================================

    /**
     * Test: Super Admin bisa akses FAQ
     */
    public function test_super_admin_can_access_faq(): void
    {
        $response = $this->actingAs($this->superAdmin)->postJson('/admin/faq/store', [
            'pertanyaan_id' => 'Test Question',
            'jawaban_id' => 'Test Answer',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test: Super Admin bisa akses Sertifikat
     */
    public function test_super_admin_can_access_sertifikat(): void
    {
        $response = $this->actingAs($this->superAdmin)->postJson('/admin/sertifikat/store', [
            'nama' => 'Test Sertifikat',
        ]);

        // Bisa 200 (success) atau 422 (validation error) - yang penting bukan 403
        $this->assertNotEquals(403, $response->status());
    }

    /**
     * Test: Super Admin bisa akses Pedoman
     */
    public function test_super_admin_can_access_pedoman(): void
    {
        $response = $this->actingAs($this->superAdmin)->postJson('/admin/pedoman/store', [
            'judul' => 'Test Pedoman',
            'file' => 'test.pdf',
            'text_align' => 'left',
        ]);

        // Bisa 200 (success) atau 422 (validation error) - yang penting bukan 403
        $this->assertNotEquals(403, $response->status());
    }

    // ============================================
    // SCENARIO 7: Error message ketika akses dibatasi
    // ============================================

    /**
     * Test: Admin mendapat error message 403 Forbidden
     */
    public function test_admin_gets_403_forbidden_error(): void
    {
        $response = $this->actingAs($this->restrictedAdmin)->postJson('/admin/sertifikat/store', [
            'nama' => 'Test Sertifikat',
        ]);

        $response->assertStatus(403);
        // Response harus berisi error message
        $this->assertTrue(
            $response->status() === 403,
            'Admin should get 403 Forbidden error'
        );
    }

    /**
     * Test: Admin tidak bisa manipulasi permission via request
     */
    public function test_admin_cannot_manipulate_permission_via_request(): void
    {
        // Admin mencoba akses Sertifikat dengan berbagai method
        $methods = [
            'get' => '/admin/sertifikat',
            'post' => '/admin/sertifikat/store',
            'put' => '/admin/sertifikat/update/1',
            'delete' => '/admin/sertifikat/delete/1',
        ];

        foreach ($methods as $method => $endpoint) {
            $response = $this->actingAs($this->restrictedAdmin)->{$method . 'Json'}($endpoint);
            
            $this->assertTrue(
                in_array($response->status(), [403, 405]),
                "Expected 403 or 405 for {$method} {$endpoint}, got {$response->status()}"
            );
        }
    }
}
