<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login dengan redirect dinamis berdasarkan role.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Cek kredensial
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            return $this->authenticated($request, Auth::user());
        }

        // Jika login gagal
        throw ValidationException::withMessages([
            'email' => ['Email atau password salah.'],
        ]);
    }

    /**
     * Logika redirect setelah user berhasil login.
     * Menggantikan property $redirectTo agar dinamis berdasarkan role.
     */
    protected function authenticated(Request $request, $user)
    {
        // Jika role adalah Admin atau Super Admin -> Ke Dashboard
        if (in_array($user->role, ['admin', 'super_admin'])) {
            return redirect()->route('admin.dashboard');
        }

        // Jika user biasa -> Ke Homepage (atau redirect ke halaman lain sesuai kebutuhan)
        return redirect()->route('beranda');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
