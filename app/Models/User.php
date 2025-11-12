<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

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
     * Get all permissions for this user
     */
    public function getPermissions()
    {
        // If user has admin_role_id, get permissions from role
        if ($this->admin_role_id) {
            $rolePermissions = $this->adminRole()
                ->with('permissions')
                ->first()
                ?->permissions
                ?->pluck('name')
                ?->toArray() ?? [];
            
            // Merge with custom permissions if any
            $customPermissions = $this->permissions_json ?? [];
            return array_unique(array_merge($rolePermissions, $customPermissions));
        }

        return $this->permissions_json ?? [];
    }

    /**
     * Check if user has permission
     */
    public function hasPermission($permission)
    {
        return in_array($permission, $this->getPermissions());
    }

    /**
     * Check if user has any of the given permissions
     */
    public function hasAnyPermission($permissions)
    {
        $userPermissions = $this->getPermissions();
        return count(array_intersect($permissions, $userPermissions)) > 0;
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin()
    {
        return $this->adminRole?->name === 'super_admin';
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->adminRole?->name === 'admin' || $this->isSuperAdmin();
    }
}