# 👥 ADMIN ROLE & PERMISSION SYSTEM GUIDE

**Date:** November 12, 2025  
**Status:** ✅ READY FOR IMPLEMENTATION  
**Version:** 1.0

---

## 🎯 OVERVIEW

Sistem role-based admin yang memungkinkan Super Admin untuk:
- ✅ Membuat admin baru dengan role tertentu
- ✅ Mengatur permissions untuk setiap admin
- ✅ Mengelola akses fitur per admin
- ✅ Edit dan delete admin (kecuali super admin)

---

## 📊 ROLE HIERARCHY

```
Super Admin (Full Access)
├── Manage Admins
├── View Admin Logs
└── All Content Management Permissions

Admin (Full Content Access)
├── Manage Berita
├── Manage FAQ
├── Manage Pedoman
├── Manage Jejak Langkah
├── Manage Why Choose Us
├── Manage Sertifikat
├── Manage Sekilas Perusahaan
├── Manage Company Info
└── Manage Social Media

Moderator (Limited Access)
├── View Berita
├── View FAQ
├── View Pedoman
├── View Jejak Langkah
├── View Why Choose Us
├── View Sertifikat
├── View Sekilas Perusahaan
├── View Company Info
└── View Social Media
```

---

## 🔧 IMPLEMENTATION STEPS

### Step 1: Run Migrations

```bash
php artisan migrate
```

**Creates:**
- `admin_roles` table
- `permissions` table
- `role_permission` pivot table
- Adds `admin_role_id` and `permissions_json` to `users` table

### Step 2: Run Seeder

```bash
php artisan db:seed --class=AdminRolesAndPermissionsSeeder
```

**Creates:**
- Super Admin role (with all permissions)
- Admin role (with content management permissions)
- Moderator role (with view-only permissions)
- All permissions for each module
- Assigns super admin role to existing admin user

### Step 3: Add Routes

Add to `routes/web.php`:

```php
Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::resource('admin/admin-management', AdminManagementController::class);
    Route::get('admin/admin-management/{role}/permissions', [AdminManagementController::class, 'getRolePermissions']);
});
```

### Step 4: Create Views

Create admin management views in `resources/views/admin/admin-management/`:
- `index.blade.php` - List admins
- `create.blade.php` - Create new admin
- `edit.blade.php` - Edit admin

---

## 📋 DATABASE STRUCTURE

### admin_roles Table
```sql
id | name | display_name | description | created_at | updated_at
1  | super_admin | Super Admin | Full access | ... | ...
2  | admin | Admin | Full content access | ... | ...
3  | moderator | Moderator | Limited access | ... | ...
```

### permissions Table
```sql
id | name | display_name | module | description | created_at | updated_at
1  | manage_admins | Manage Admins | admin | ... | ... | ...
2  | manage_berita | Manage Berita | berita | ... | ... | ...
...
```

### role_permission Table (Pivot)
```sql
id | admin_role_id | permission_id | created_at | updated_at
1  | 1 | 1 | ... | ...
2  | 1 | 2 | ... | ...
...
```

### users Table (Updated)
```sql
id | name | email | password | role | admin_role_id | permissions_json | ...
1  | Admin | admin@swabinagatra.com | ... | admin | 1 | null | ...
2  | Editor | editor@swabinagatra.com | ... | admin | 2 | null | ...
```

---

## 🔐 PERMISSION SYSTEM

### Available Permissions

**Admin Management:**
- `manage_admins` - Create, edit, delete admin users
- `view_admin_logs` - View admin activity logs

**Content Management:**
- `manage_berita` / `view_berita` - Berita & Artikel
- `manage_faq` / `view_faq` - FAQ
- `manage_pedoman` / `view_pedoman` - Kebijakan & Pedoman
- `manage_jejak` / `view_jejak` - Jejak Langkah
- `manage_why_choose_us` / `view_why_choose_us` - Mengapa Memilih Kami
- `manage_sertifikat` / `view_sertifikat` - Sertifikat & Penghargaan
- `manage_sekilas` / `view_sekilas` - Sekilas Perusahaan
- `manage_company_info` / `view_company_info` - Company Info
- `manage_social_media` / `view_social_media` - Social Media

**Dashboard:**
- `view_dashboard` - Access admin dashboard

---

## 💻 USAGE EXAMPLES

### Check User Permissions

```php
// Check single permission
if (auth()->user()->hasPermission('manage_berita')) {
    // User can manage berita
}

// Check multiple permissions
if (auth()->user()->hasAnyPermission(['manage_berita', 'manage_faq'])) {
    // User has at least one permission
}

// Check if super admin
if (auth()->user()->isSuperAdmin()) {
    // User is super admin
}

// Get all permissions
$permissions = auth()->user()->getPermissions();
```

### In Routes

```php
// Using middleware
Route::post('/berita', [BeritaController::class, 'store'])
    ->middleware('permission:manage_berita');

// Using super admin middleware
Route::resource('admin-management', AdminManagementController::class)
    ->middleware('super_admin');
```

### In Views

```blade
@if(auth()->user()->hasPermission('manage_berita'))
    <a href="{{ route('admin.berita.create') }}">Tambah Berita</a>
@endif

@if(auth()->user()->isSuperAdmin())
    <a href="{{ route('admin.admin-management.index') }}">Kelola Admin</a>
@endif
```

### In Blade Directives

```blade
@can('manage_berita')
    <!-- Show manage berita button -->
@endcan

@canany(['manage_berita', 'manage_faq'])
    <!-- Show content management section -->
@endcanany
```

---

## 🎯 CREATING NEW ADMIN

### Via Admin Panel (Super Admin Only)

1. Go to **Admin Management** page
2. Click **Tambah Admin Baru**
3. Fill in:
   - **Name:** Admin name
   - **Email:** Admin email
   - **Password:** Strong password
   - **Role:** Select role (Admin, Moderator, Custom)
   - **Custom Permissions:** Select specific permissions if needed
4. Click **Simpan**

### Via Code

```php
use App\Models\User;
use App\Models\AdminRole;

$adminRole = AdminRole::where('name', 'admin')->first();

$admin = User::create([
    'name' => 'New Admin',
    'email' => 'newadmin@example.com',
    'password' => Hash::make('password123'),
    'role' => 'admin',
    'admin_role_id' => $adminRole->id,
    'permissions_json' => null, // Use role permissions
]);
```

---

## 🔄 MANAGING PERMISSIONS

### Assign Permission to Role

```php
$role = AdminRole::find(1);
$role->givePermission('manage_berita');
```

### Remove Permission from Role

```php
$role = AdminRole::find(1);
$role->revokePermission('manage_berita');
```

### Check Role Has Permission

```php
$role = AdminRole::find(1);
if ($role->hasPermission('manage_berita')) {
    // Role has permission
}
```

### Get All Role Permissions

```php
$role = AdminRole::with('permissions')->find(1);
$permissions = $role->permissions; // Collection of permissions
```

---

## 🛡️ SECURITY FEATURES

### Protected Actions

- ✅ Cannot edit Super Admin user
- ✅ Cannot delete Super Admin user
- ✅ Cannot delete your own account
- ✅ Super Admin middleware protection
- ✅ Permission checking on routes
- ✅ CSRF protection
- ✅ Password hashing

### Audit Trail

All admin actions logged:
- Admin creation
- Admin updates
- Admin deletion
- Permission changes

---

## 📱 ADMIN MANAGEMENT INTERFACE

### List Admins Page

Shows:
- Admin name
- Email
- Role
- Created date
- Actions (Edit, Delete)

### Create Admin Page

Form with:
- Name input
- Email input
- Password input (with confirmation)
- Role dropdown
- Custom permissions checkboxes
- Submit button

### Edit Admin Page

Form with:
- Name input
- Email input
- Password input (optional)
- Role dropdown
- Custom permissions checkboxes
- Submit button
- Delete button

---

## ⚙️ CONFIGURATION

### Add Custom Permissions

```php
// In seeder or migration
DB::table('permissions')->insert([
    'name' => 'custom_permission',
    'display_name' => 'Custom Permission',
    'module' => 'custom',
    'description' => 'Description here',
    'created_at' => now(),
    'updated_at' => now(),
]);
```

### Create Custom Role

```php
$role = AdminRole::create([
    'name' => 'custom_role',
    'display_name' => 'Custom Role',
    'description' => 'Custom role description',
]);

// Assign permissions
$role->givePermission('manage_berita');
$role->givePermission('view_faq');
```

---

## 🧪 TESTING

### Test Super Admin Access

```php
// Login as super admin
$this->actingAs($superAdmin)
    ->get('/admin/admin-management')
    ->assertStatus(200);

// Try as regular admin (should fail)
$this->actingAs($admin)
    ->get('/admin/admin-management')
    ->assertStatus(403);
```

### Test Permissions

```php
// Check permission
$this->assertTrue($admin->hasPermission('manage_berita'));
$this->assertFalse($moderator->hasPermission('manage_berita'));
```

---

## 📊 MIGRATION CHECKLIST

- [ ] Run migrations: `php artisan migrate`
- [ ] Run seeder: `php artisan db:seed --class=AdminRolesAndPermissionsSeeder`
- [ ] Add routes to `routes/web.php`
- [ ] Create admin management views
- [ ] Update existing controllers to check permissions
- [ ] Test admin creation
- [ ] Test permission checking
- [ ] Test role assignment
- [ ] Verify super admin access
- [ ] Test regular admin limitations

---

## 🚀 NEXT STEPS

1. **Run Migrations & Seeders**
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminRolesAndPermissionsSeeder
   ```

2. **Create Admin Management Views**
   - Create `resources/views/admin/admin-management/` directory
   - Create `index.blade.php`, `create.blade.php`, `edit.blade.php`

3. **Add Routes**
   - Add admin management routes to `routes/web.php`

4. **Update Sidebar**
   - Add "Kelola Admin" link in admin sidebar (visible only to super admin)

5. **Test System**
   - Create new admin user
   - Test permission checking
   - Verify role assignment

---

## 📞 SUPPORT

**Common Issues:**

1. **Migration fails**
   - Check database connection
   - Ensure users table exists
   - Run `php artisan migrate:fresh` if needed

2. **Seeder fails**
   - Check admin_roles table exists
   - Verify permissions table created
   - Check existing admin user email

3. **Permission not working**
   - Clear cache: `php artisan cache:clear`
   - Check middleware registered in Kernel.php
   - Verify permission name is correct

---

**Status:** ✅ READY FOR IMPLEMENTATION  
**Complexity:** MEDIUM  
**Time Required:** 30-60 minutes  
**Dependencies:** Laravel 12, MySQL

