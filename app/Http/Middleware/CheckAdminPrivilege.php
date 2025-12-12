<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminPrivilege
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Izinkan jika role adalah 'super_admin' ATAU 'admin'
        // Sesuaikan string ini dengan isi database kolom 'role' Anda
        if (in_array($user->role, ['super_admin', 'admin'])) {
            return $next($request);
        }

        abort(403, 'AKSES DITOLAK: Anda tidak memiliki akses admin.');
    }
}
