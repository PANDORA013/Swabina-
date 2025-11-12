<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

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
     * Get all permissions for this user (using Spatie permission)
     */
    public function getPermissions()
    {
        // Get permissions from Spatie permission system
        return $this->getAllPermissions()->pluck('name')->toArray();
    }

    /**
     * Check if user has permission (using Spatie permission)
     */
    public function hasPermission($permission)
    {
        return $this->can($permission);
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
     * Check if user is super admin (using Spatie permission)
     */
    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    /**
     * Check if user is admin (using Spatie permission)
     */
    public function isAdmin()
    {
        return $this->hasRole('admin') || $this->isSuperAdmin();
    }
}