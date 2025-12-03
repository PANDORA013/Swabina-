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

        // Super admin has all privileges
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Check permission in user's permissions_json
        $userPermissions = $user->permissions_json ?? [];
        
        if (is_array($userPermissions) && in_array($permission, $userPermissions)) {
            return true;
        }

        // Fallback to Spatie permission if available
        try {
            return $user->hasPermissionTo($permission);
        } catch (\Exception $e) {
            return false;
        }
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
            return \App\Models\Permission::pluck('name')->toArray();
        }

        // Return user's permissions from permissions_json
        return $user->permissions_json ?? [];
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
            return \App\Models\Permission::groupedByModule();
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
            return \App\Models\Permission::where('name', $permission)->exists();
        } catch (\Exception $e) {
            return false;
        }
    }
}
