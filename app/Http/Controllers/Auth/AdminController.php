<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\User;
use App\Models\LayananPage;
use App\Models\Faq;
use App\Models\Sertifikat;
use App\Models\Pedoman;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with statistics and data.
     */
    public function index()
    {
        // Ambil data collections untuk dashboard
        $beritas = Berita::latest()->limit(10)->get();
        $users = User::latest()->limit(10)->get();
        $faqs = Faq::latest()->limit(10)->get();
        $layanan = LayananPage::where('is_active', true)->orderBy('order')->get();
        $sertifikats = Sertifikat::latest()->limit(10)->get();
        $pedomans = Pedoman::latest()->limit(10)->get();

        // Kirim semua data ke view
        return view('admin.dashboard', compact('beritas', 'users', 'faqs', 'layanan', 'sertifikats', 'pedomans'));
    }
}
