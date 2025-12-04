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
     * Display the consolidated About Us page
     * Menggabungkan: Sekilas, Visi-Misi, Jejak Langkah, Sertifikat, Why Choose Us
     */
    public function index()
    {
        $companyInfo = CompanyInfo::first();
        
        // Sekilas Perusahaan
        $sekilasPerusahaan = SekilasPerusahaan::all();
        
        // Jejak Langkah (Timeline)
        $jejakLangkahs = JejakLangkah::orderBy('year', 'desc')->get();
        
        // Sertifikat & Penghargaan
        $sertifikats = Sertifikat::where('is_active', true)
            ->orderBy('year', 'desc')
            ->get();
        
        // Why Choose Us
        $whyChooseUs = WhyChooseUs::getActive();
        
        return view('about.index', compact(
            'companyInfo',
            'sekilasPerusahaan',
            'jejakLangkahs',
            'sertifikats',
            'whyChooseUs'
        ));
    }
}
