<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AdminRole;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminManagementController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Middleware is already applied in routes
        // No need to re-apply here
    }

    /**
     * Display list of admin users
     */
    public function index()
    {
        try {
            $admins = User::where('role', 'admin')
                ->orWhere('role', 'superadmin')
                ->with('adminRole')
                ->latest()
                ->paginate(10);

            // Only show Admin role (Super Admin cannot be assigned to new users)
            $adminRoles = AdminRole::where('name', 'admin')->get();
            $layout = Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.app-professional';

            return view('admin.admin-management.index', compact('admins', 'adminRoles', 'layout'));
        } catch (\Exception $e) {
            // If Spatie tables don't exist, just get admins without relationship
            Log::error('Admin management index error', ['error' => $e->getMessage()]);
            
            $admins = User::where('role', 'admin')
                ->orWhere('role', 'superadmin')
                ->latest()
                ->paginate(10);

            $adminRoles = AdminRole::where('name', 'admin')->get();
            $layout = Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.app-professional';

            return view('admin.admin-management.index', compact('admins', 'adminRoles', 'layout'));
        }
    }

    /**
     * Show create admin form
     */
    public function create()
    {
        try {
            // Only show Admin role (Super Admin cannot be assigned to new users)
            $adminRoles = AdminRole::where('name', 'admin')->get();
            $permissions = Permission::groupedByModule();
            $layout = Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.app-professional';

            return view('admin.admin-management.create', compact('adminRoles', 'permissions', 'layout'));
        } catch (\Exception $e) {
            // If permission tables don't exist, provide empty array
            Log::error('Admin management create error', ['error' => $e->getMessage()]);
            
            $adminRoles = AdminRole::where('name', 'admin')->get();
            $permissions = [];
            $layout = Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.app-professional';

            return view('admin.admin-management.create', compact('adminRoles', 'permissions', 'layout'));
        }
    }

    /**
     * Store new admin user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'admin_role_id' => 'required|exists:admin_roles,id',
            'custom_permissions' => 'nullable|array',
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'admin',
                'admin_role_id' => $validated['admin_role_id'],
                'permissions_json' => $validated['custom_permissions'] ?? [],
            ]);

            // Assign permissions using Spatie Permission
            if (!empty($validated['custom_permissions'])) {
                $user->syncPermissions($validated['custom_permissions']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Admin user created successfully',
                'data' => $user->load('adminRole'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating admin user: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show edit admin form
     */
    public function edit(User $admin)
    {
        // Prevent editing super admin
        if ($admin->isSuperAdmin()) {
            return redirect()->route('admin.admin-management.index')
                ->with('error', 'Cannot edit super admin user');
        }

        // Only show Admin role (Super Admin cannot be assigned)
        $adminRoles = AdminRole::where('name', 'admin')->get();
        $permissions = Permission::groupedByModule();
        $userPermissions = $admin->permissions_json ?? [];
        $layout = Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.app-professional';

        return view('admin.admin-management.edit', compact('admin', 'adminRoles', 'permissions', 'userPermissions', 'layout'));
    }

    /**
     * Update admin user
     */
    public function update(Request $request, User $admin)
    {
        // Prevent editing super admin
        if ($admin->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot edit super admin user',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'admin_role_id' => 'required|exists:admin_roles,id',
            'custom_permissions' => 'nullable|array',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $admin->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'admin_role_id' => $validated['admin_role_id'],
                'permissions_json' => $validated['custom_permissions'] ?? [],
            ]);

            if (!empty($validated['password'])) {
                $admin->update(['password' => Hash::make($validated['password'])]);
            }

            // Sync permissions using Spatie Permission
            if (!empty($validated['custom_permissions'])) {
                $admin->syncPermissions($validated['custom_permissions']);
            } else {
                $admin->syncPermissions([]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Admin user updated successfully',
                'data' => $admin->load('adminRole'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating admin user: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete admin user
     */
    public function destroy(User $admin)
    {
        // Prevent deleting super admin
        if ($admin->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete super admin user',
            ], 403);
        }

        // Prevent deleting yourself
        if ($admin->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete your own account',
            ], 403);
        }

        try {
            $admin->delete();

            return response()->json([
                'success' => true,
                'message' => 'Admin user deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting admin user: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get admin roles with permissions
     */
    public function getRolesWithPermissions()
    {
        $roles = AdminRole::with('permissions')->get();

        return response()->json([
            'success' => true,
            'data' => $roles,
        ]);
    }

    /**
     * Get permissions for a specific role
     */
    public function getRolePermissions($roleId)
    {
        $role = AdminRole::with('permissions')->findOrFail($roleId);

        return response()->json([
            'success' => true,
            'data' => $role->permissions->pluck('name'),
        ]);
    }

    /**
     * Show privilege assignment page for an admin
     */
    public function showPrivileges(User $admin)
    {
        // Prevent editing super admin
        if ($admin->isSuperAdmin()) {
            return redirect()->route('admin.admin-management.index')
                ->with('error', 'Cannot manage privileges for super admin');
        }

        try {
            $allPermissions = Permission::groupedByModule();
            $userPermissions = $admin->permissions_json ?? [];
            $layout = Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.app-professional';

            return view('admin.admin-management.privileges', compact('admin', 'allPermissions', 'userPermissions', 'layout'));
        } catch (\Exception $e) {
            Log::error('Show admin privileges error', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.admin-management.index')
                ->with('error', 'Error loading privileges: ' . $e->getMessage());
        }
    }

    /**
     * Update privilege/permissions for an admin
     */
    public function updatePrivileges(Request $request, User $admin)
    {
        // Prevent editing super admin
        if ($admin->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot manage privileges for super admin',
            ], 403);
        }

        $validated = $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        try {
            $permissions = $validated['permissions'] ?? [];

            // Update permissions_json on user
            $admin->update([
                'permissions_json' => $permissions,
            ]);

            // Also sync with Spatie permission if available
            try {
                $admin->syncPermissions($permissions);
            } catch (\Exception $e) {
                // Spatie tables may not exist, ignore
                Log::warning('Could not sync Spatie permissions', ['error' => $e->getMessage()]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Admin privileges updated successfully',
                'data' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'permissions' => $permissions,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Update admin privileges error', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating privileges: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get all available permissions
     */
    public function getAvailablePermissions()
    {
        try {
            $permissions = Permission::groupedByModule();

            return response()->json([
                'success' => true,
                'data' => $permissions,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching permissions: ' . $e->getMessage(),
            ], 500);
        }
    }
}

