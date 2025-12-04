<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Models\SekilasPerusahaan;
use App\Models\JejakLangkah;
use App\Models\Sertifikat;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Menampilkan halaman terintegrasi Tentang Kami.
     * Menggabungkan Sekilas, Jejak, Sertifikat, dll dalam satu halaman.
     */
    public function index()
    {
        // Ambil data dari semua model terkait
        $companyInfo = CompanyInfo::first();
        
        // Sekilas Perusahaan (ambil yang pertama/utama)
        $sekilas = SekilasPerusahaan::first(); 
        
        // Jejak Langkah (urutkan tahun terbaru)
        $jejakLangkahs = JejakLangkah::orderBy('year', 'desc')->get();
        
        // Sertifikat
        $sertifikats = Sertifikat::latest()->get();
        
        // Why Choose Us
        $whyChooseUs = WhyChooseUs::all();

        // Mengirim data ke view 'tentangkami.tentangkami'
        // Pastikan file resources/views/tentangkami/tentangkami.blade.php ada
        return view('tentangkami.tentangkami', compact(
            'companyInfo',
            'sekilas',
            'jejakLangkahs',
            'sertifikats',
            'whyChooseUs'
        ));
    }
}
