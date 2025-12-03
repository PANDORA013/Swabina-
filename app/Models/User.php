<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method bool isSuperAdmin()
 * @method bool hasPermissionTo(string $permission, $guardName = null)
 * @method bool hasAnyPermission(...$permissions)
 * @method bool hasAllPermissions(...$permissions)
 * @method bool hasRole($roles, string $guard = null)
 * @method self givePermissionTo(...$permissions)
 * @method self syncPermissions(...$permissions)
 * @method self revokePermissionTo($permission)
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'admin_role_id', 'permissions_json',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions_json' => 'array',
    ];

    /**
     * Get the admin role for this user
     */
    public function adminRole()
    {
        return $this->belongsTo(AdminRole::class, 'admin_role_id');
    }

    /**
     * Get all permissions for this user (using Spatie permission)
     */
    public function getPermissions()
    {
        // Get permissions from Spatie permission system
        return $this->getAllPermissions()->pluck('name')->toArray();
    }

    /**
     * Check if user has permission (using Spatie permission)
     * Super admin has access to ALL permissions
     */
    public function hasPermissionTo($permission)
    {
        // Super admin has ALL permissions
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        // Use Spatie default
        return parent::hasPermissionTo($permission);
    }

    /**
     * Check if user has permission (legacy method)
     */
    public function hasPermission($permission)
    {
        return $this->hasPermissionTo($permission);
    }

    /**
     * Check if user has any of the given permissions (using Spatie permission)
     */
    public function hasAnyPermission($permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->can($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if user is super admin
     * Check both Spatie role AND admin_role relationship (Spatie tables may not exist)
     */
    public function isSuperAdmin()
    {
        // Check role column first (primary check - no DB dependency on Spatie tables)
        if ($this->role === 'superadmin' || $this->role === 'super_admin') {
            return true;
        }
        
        // Check admin_role relationship
        if ($this->adminRole && $this->adminRole->name === 'super_admin') {
            return true;
        }
        
        // Check Spatie role only if table exists (to avoid errors if Spatie tables were dropped)
        try {
            if (method_exists($this, 'hasRole') && $this->hasRole('super_admin')) {
                return true;
            }
        } catch (\Exception $e) {
            // Spatie tables may not exist, ignore error
        }

        return false;
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
        
        // Check Spatie role
        if ($this->hasRole('admin')) {
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