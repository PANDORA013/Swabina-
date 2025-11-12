<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Faq;
use App\Models\Pedoman;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $beritas = Berita::latest()->get();
            $faqs = Faq::all();
            $pedomans = Pedoman::all();

            return view('admin.dashboard', compact(
                'beritas',
                'faqs',
                'pedomans'
            ));
        } catch (\Exception $e) {
            return view('admin.dashboard')->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }
}
