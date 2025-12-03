<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',           // String role (e.g. 'super_admin', 'admin')
        'admin_role_id',  // Foreign key to admin_roles table
        'image',
        'is_active',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke AdminRole
     */
    public function adminRole()
    {
        return $this->belongsTo(AdminRole::class, 'admin_role_id');
    }

    /**
     * Cek apakah user adalah Super Admin
     * @return bool
     */
    public function isSuperAdmin()
    {
        // Cek kolom 'role' legacy (support 'superadmin' dan 'super_admin')
        if ($this->role === 'superadmin' || $this->role === 'super_admin') {
            return true;
        }

        // Cek via relasi AdminRole jika menggunakan sistem role baru
        if ($this->adminRole && $this->adminRole->is_super_admin) {
            return true;
        }

        return false;
    }

    /**
     * Cek apakah user memiliki permission tertentu
     * @param string $permissionKey
     * @return bool
     */
    public function hasPermissionTo($permissionKey)
    {
        // Super admin selalu punya akses penuh
        if ($this->isSuperAdmin()) {
            return true;
        }

        // Jika tidak punya role, tolak akses
        if (!$this->adminRole) {
            return false;
        }

        // Cek permission spesifik via relasi role -> permissions
        return $this->adminRole->permissions()
                    ->where('permission_key', $permissionKey)
                    ->exists();
    }

    /**
     * Check if user is admin (including super admin)
     */
    public function isAdmin()
    {
        // Super admin is also admin
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        // Check admin_role relationship
        if ($this->adminRole && $this->adminRole->name === 'admin') {
            return true;
        }
        
        // Check role column
        if ($this->role === 'admin') {
            return true;
        }
        
        return false;
    }
}