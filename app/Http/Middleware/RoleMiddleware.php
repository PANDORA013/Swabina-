<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Unauthorized Access');
        }

        $user = auth()->user();

        // Check if user has any of the required roles using Spatie
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // If no role matches, redirect to home
        abort(403, 'Unauthorized Access - Insufficient permissions');
    }
}
