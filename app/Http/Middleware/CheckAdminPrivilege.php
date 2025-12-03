<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $permission
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
        $user = Auth::user();

        // Super Admin has access to everything
        if ($user && $user->isSuperAdmin()) {
            return $next($request);
        }

        // Check if permission is required
        if ($permission) {
            // Check if user has permission
            if ($user && $user->hasPermissionTo($permission)) {
                return $next($request);
            }

            // If no permission, abort
            abort(403, 'Unauthorized. Permission "' . $permission . '" required.');
        }

        return $next($request);
    }
}
