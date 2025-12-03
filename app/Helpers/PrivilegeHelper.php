<?php

/**
 * Check if current user has a specific privilege/permission
 *
 * @param string $permission
 * @return bool
 */
if (!function_exists('userHasPrivilege')) {
    function userHasPrivilege($permission)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        if (!$user) {
            return false;
        }

        // Use the simplified hasPermissionTo method from User model
        return $user->hasPermissionTo($permission);
    }
}

/**
 * Get all privileges/permissions for current user
 *
 * @return array
 */
if (!function_exists('getUserPrivileges')) {
    function getUserPrivileges()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        if (!$user) {
            return [];
        }

        // Super admin has all privileges
        if ($user->isSuperAdmin()) {
            try {
                return \App\Models\AdminRole::where('is_super_admin', true)
                    ->first()
                    ?->permissions()
                    ?->pluck('permission_key')
                    ?->toArray() ?? [];
            } catch (\Exception $e) {
                return [];
            }
        }

        // Return user's permissions via admin role
        try {
            return $user->adminRole?->permissions()
                ->pluck('permission_key')
                ->toArray() ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }
}

/**
 * Get all available privileges/permissions grouped by module
 *
 * @return array
 */
if (!function_exists('getAvailablePrivileges')) {
    function getAvailablePrivileges()
    {
        try {
            $permissions = \App\Models\Permission::all()->groupBy('module');
            return $permissions->map(function($items) {
                return $items->map(function($item) {
                    return [
                        'key' => $item->permission_key,
                        'name' => $item->name,
                        'description' => $item->description,
                    ];
                })->toArray();
            })->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
}

/**
 * Check if a specific privilege is available in the system
 *
 * @param string $permission
 * @return bool
 */
if (!function_exists('privilegeExists')) {
    function privilegeExists($permission)
    {
        try {
            return \App\Models\Permission::where('permission_key', $permission)->exists();
        } catch (\Exception $e) {
            return false;
        }
    }
}
