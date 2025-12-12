<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Pastikan user login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Cek apakah role-nya superadmin
        // Asumsi: kolom di database bernama 'role'
        if (Auth::user()->role === 'super_admin') {
            return $next($request);
        }

        // 3. Jika bukan, tolak akses (403 Forbidden)
        abort(403, 'AKSES DITOLAK: Halaman ini khusus Super Admin.');
    }
}
