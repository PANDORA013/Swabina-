<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AdminPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected $superAdmin;
    protected $adminWithFaqAccess;
    protected $adminWithoutFaqAccess;

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
        $permissions = ['read-faq', 'create-faq', 'update-faq', 'delete-faq'];
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

        // Create Admin with FAQ access
        $this->adminWithFaqAccess = User::create([
            'name' => 'Admin FAQ Access',
            'email' => 'admin.faq@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        $this->adminWithFaqAccess->assignRole('admin');
        $this->adminWithFaqAccess->givePermissionTo(['read-faq', 'create-faq', 'update-faq', 'delete-faq']);

        // Create Admin without FAQ access
        $this->adminWithoutFaqAccess = User::create([
            'name' => 'Admin No FAQ',
            'email' => 'admin.nofaq@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        $this->adminWithoutFaqAccess->assignRole('admin');
    }

    // ============================================
    // AUTHENTICATION TESTS
    // ============================================

    /**
     * Test user can login
     */
    public function test_user_can_login()
    {
        $response = $this->post('/login', [
            'email' => 'superadmin@test.com',
            'password' => 'password123'
        ]);

        $this->assertAuthenticatedAs($this->superAdmin);
    }

    /**
     * Test user cannot login with wrong password
     */
    public function test_user_cannot_login_with_wrong_password()
    {
        $this->post('/login', [
            'email' => 'superadmin@test.com',
            'password' => 'wrongpassword'
        ]);

        $this->assertGuest();
    }

    /**
     * Test user can logout
     */
    public function test_user_can_logout()
    {
        $this->actingAs($this->superAdmin)->post('/logout');
        $this->assertGuest();
    }

    // ============================================
    // SUPER ADMIN PERMISSION TESTS
    // ============================================

    /**
     * Test Super Admin has super_admin role
     */
    public function test_super_admin_has_super_admin_role()
    {
        $this->assertTrue($this->superAdmin->hasRole('super_admin'));
    }

    /**
     * Test Super Admin is recognized as Super Admin
     */
    public function test_super_admin_is_recognized_as_super_admin()
    {
        $this->assertTrue($this->superAdmin->isSuperAdmin());
    }

    /**
     * Test Super Admin is also recognized as Admin
     */
    public function test_super_admin_is_also_recognized_as_admin()
    {
        $this->assertTrue($this->superAdmin->isAdmin());
    }

    /**
     * Test Super Admin can bypass permission checks
     */
    public function test_super_admin_can_bypass_permission_checks()
    {
        // Super Admin should be able to perform FAQ operations without explicit permission
        $this->assertTrue($this->superAdmin->isSuperAdmin());
        $this->assertTrue($this->superAdmin->isAdmin());
    }

    // ============================================
    // ADMIN PERMISSION TESTS
    // ============================================

    /**
     * Test Admin with FAQ permission has read-faq permission
     */
    public function test_admin_with_faq_permission_has_read_faq()
    {
        $this->assertTrue($this->adminWithFaqAccess->hasPermissionTo('read-faq'));
    }

    /**
     * Test Admin with FAQ permission has create-faq permission
     */
    public function test_admin_with_faq_permission_has_create_faq()
    {
        $this->assertTrue($this->adminWithFaqAccess->hasPermissionTo('create-faq'));
    }

    /**
     * Test Admin with FAQ permission has update-faq permission
     */
    public function test_admin_with_faq_permission_has_update_faq()
    {
        $this->assertTrue($this->adminWithFaqAccess->hasPermissionTo('update-faq'));
    }

    /**
     * Test Admin with FAQ permission has delete-faq permission
     */
    public function test_admin_with_faq_permission_has_delete_faq()
    {
        $this->assertTrue($this->adminWithFaqAccess->hasPermissionTo('delete-faq'));
    }

    /**
     * Test Admin without FAQ permission doesn't have read-faq
     */
    public function test_admin_without_faq_permission_doesnt_have_read_faq()
    {
        $this->assertFalse($this->adminWithoutFaqAccess->hasPermissionTo('read-faq'));
    }

    /**
     * Test Admin without FAQ permission doesn't have create-faq
     */
    public function test_admin_without_faq_permission_doesnt_have_create_faq()
    {
        $this->assertFalse($this->adminWithoutFaqAccess->hasPermissionTo('create-faq'));
    }

    /**
     * Test Admin without FAQ permission doesn't have update-faq
     */
    public function test_admin_without_faq_permission_doesnt_have_update_faq()
    {
        $this->assertFalse($this->adminWithoutFaqAccess->hasPermissionTo('update-faq'));
    }

    /**
     * Test Admin without FAQ permission doesn't have delete-faq
     */
    public function test_admin_without_faq_permission_doesnt_have_delete_faq()
    {
        $this->assertFalse($this->adminWithoutFaqAccess->hasPermissionTo('delete-faq'));
    }

    // ============================================
    // FAQ CRUD OPERATION TESTS
    // ============================================

    /**
     * Test Admin with FAQ permission can create FAQ
     */
    public function test_admin_with_faq_permission_can_create_faq()
    {
        $response = $this->actingAs($this->adminWithFaqAccess)->postJson('/admin/faq/store', [
            'pertanyaan_id' => 'Test Question',
            'jawaban_id' => 'Test Answer',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test Admin without FAQ permission cannot create FAQ
     */
    public function test_admin_without_faq_permission_cannot_create_faq()
    {
        $response = $this->actingAs($this->adminWithoutFaqAccess)->postJson('/admin/faq/store', [
            'pertanyaan_id' => 'Test Question',
            'jawaban_id' => 'Test Answer',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test Admin with FAQ permission can update FAQ
     */
    public function test_admin_with_faq_permission_can_update_faq()
    {
        $faq = Faq::create([
            'content' => [
                'id' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1'],
                'en' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1']
            ]
        ]);

        $response = $this->actingAs($this->adminWithFaqAccess)->putJson("/admin/faq/update/{$faq->id}", [
            'pertanyaan_id' => 'Updated Q',
            'jawaban_id' => 'Updated A',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test Admin without FAQ permission cannot update FAQ
     */
    public function test_admin_without_faq_permission_cannot_update_faq()
    {
        $faq = Faq::create([
            'content' => [
                'id' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1'],
                'en' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1']
            ]
        ]);

        $response = $this->actingAs($this->adminWithoutFaqAccess)->putJson("/admin/faq/update/{$faq->id}", [
            'pertanyaan_id' => 'Updated Q',
            'jawaban_id' => 'Updated A',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test Admin with FAQ permission can delete FAQ
     */
    public function test_admin_with_faq_permission_can_delete_faq()
    {
        $faq = Faq::create([
            'content' => [
                'id' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1'],
                'en' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1']
            ]
        ]);

        $response = $this->actingAs($this->adminWithFaqAccess)->deleteJson("/admin/faq/delete/{$faq->id}");

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test Admin without FAQ permission cannot delete FAQ
     */
    public function test_admin_without_faq_permission_cannot_delete_faq()
    {
        $faq = Faq::create([
            'content' => [
                'id' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1'],
                'en' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1']
            ]
        ]);

        $response = $this->actingAs($this->adminWithoutFaqAccess)->deleteJson("/admin/faq/delete/{$faq->id}");

        $response->assertStatus(403);
    }

    // ============================================
    // SUPER ADMIN CRUD TESTS
    // ============================================

    /**
     * Test Super Admin can create FAQ
     */
    public function test_super_admin_can_create_faq()
    {
        $response = $this->actingAs($this->superAdmin)->postJson('/admin/faq/store', [
            'pertanyaan_id' => 'Test Question',
            'jawaban_id' => 'Test Answer',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test Super Admin can update FAQ
     */
    public function test_super_admin_can_update_faq()
    {
        $faq = Faq::create([
            'content' => [
                'id' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1'],
                'en' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1']
            ]
        ]);

        $response = $this->actingAs($this->superAdmin)->putJson("/admin/faq/update/{$faq->id}", [
            'pertanyaan_id' => 'Updated Q',
            'jawaban_id' => 'Updated A',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    /**
     * Test Super Admin can delete FAQ
     */
    public function test_super_admin_can_delete_faq()
    {
        $faq = Faq::create([
            'content' => [
                'id' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1'],
                'en' => ['pertanyaan' => 'Q1', 'jawaban' => 'A1']
            ]
        ]);

        $response = $this->actingAs($this->superAdmin)->deleteJson("/admin/faq/delete/{$faq->id}");

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    // ============================================
    // PERMISSION GRANT/REVOKE TESTS
    // ============================================

    /**
     * Test Admin can be granted new permission
     */
    public function test_admin_can_be_granted_new_permission()
    {
        $this->assertFalse($this->adminWithoutFaqAccess->hasPermissionTo('read-faq'));
        
        $this->adminWithoutFaqAccess->givePermissionTo('read-faq');
        
        $this->assertTrue($this->adminWithoutFaqAccess->hasPermissionTo('read-faq'));
    }

    /**
     * Test Admin can have permission revoked
     */
    public function test_admin_can_have_permission_revoked()
    {
        $this->assertTrue($this->adminWithFaqAccess->hasPermissionTo('read-faq'));
        
        $this->adminWithFaqAccess->revokePermissionTo('read-faq');
        
        $this->assertFalse($this->adminWithFaqAccess->hasPermissionTo('read-faq'));
    }

    /**
     * Test Admin can have multiple permissions granted at once
     */
    public function test_admin_can_have_multiple_permissions_granted()
    {
        $this->adminWithoutFaqAccess->givePermissionTo(['read-faq', 'create-faq', 'update-faq']);
        
        $this->assertTrue($this->adminWithoutFaqAccess->hasPermissionTo('read-faq'));
        $this->assertTrue($this->adminWithoutFaqAccess->hasPermissionTo('create-faq'));
        $this->assertTrue($this->adminWithoutFaqAccess->hasPermissionTo('update-faq'));
        $this->assertFalse($this->adminWithoutFaqAccess->hasPermissionTo('delete-faq'));
    }

    /**
     * Test Admin can have multiple permissions revoked at once
     */
    public function test_admin_can_have_multiple_permissions_revoked()
    {
        $this->adminWithFaqAccess->revokePermissionTo(['read-faq', 'create-faq']);
        
        $this->assertFalse($this->adminWithFaqAccess->hasPermissionTo('read-faq'));
        $this->assertFalse($this->adminWithFaqAccess->hasPermissionTo('create-faq'));
        $this->assertTrue($this->adminWithFaqAccess->hasPermissionTo('update-faq'));
        $this->assertTrue($this->adminWithFaqAccess->hasPermissionTo('delete-faq'));
    }
}
