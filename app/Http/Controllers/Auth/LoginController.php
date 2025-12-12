<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // FIX: Kirim variable $email untuk mencegah error 'Undefined variable'
        return view('auth.login', ['email' => '']);
    }

    /**
     * Logika Redirect Dinamis setelah Login
     */
    protected function authenticated(Request $request, $user)
    {
        // 1. Cek Role (Pastikan kolom 'role' ada di tabel users)
        $role = $user->role;

        // 2. Arahkan Admin & Super Admin ke Dashboard
        if (in_array($role, ['super_admin', 'admin'])) {
            return redirect()->route('admin.dashboard');
        }

        // 3. Arahkan User Biasa ke Home
        return redirect()->route('beranda');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
