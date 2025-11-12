<?php

namespace App\Http\Controllers;

use App\Models\JejakLangkah;
use App\Models\SocialLink;
use App\Models\CompanyInfo;
use App\Models\Berita;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $jejakLangkahs = JejakLangkah::all();
        $social = SocialLink::first();
        $companyInfo = CompanyInfo::first();
        $beritas = Berita::orderBy('created_at', 'desc')->limit(3)->get();
        $whyChooseUs = WhyChooseUs::getActive();

        return view('beranda.landingpage-professional', compact('jejakLangkahs', 'social', 'companyInfo', 'beritas', 'whyChooseUs'));
    }
    
    public function indexEng()
    {
        $jejakLangkahs = JejakLangkah::all();
        $social = SocialLink::first();
        $companyInfo = CompanyInfo::first();
        
        return view('eng.beranda-eng.landingpage-eng', compact('jejakLangkahs', 'social', 'companyInfo'));
    }

    
    // About Us Pages
    public function sekilas()
    {
        $companyInfo = CompanyInfo::first();
        return view('tentangkami.sekilas-professional', compact('companyInfo'));
    }
    
    // General About Us page (redirect/consolidate)
    public function tentangkami()
    {
        $companyInfo = CompanyInfo::first();
        $jejakLangkahs = JejakLangkah::orderBy('created_at', 'desc')->get();
        return view('tentangkami.tentangkami', compact('companyInfo', 'jejakLangkahs'));
    }
    
    public function jejaklangkah()
    {
        $companyInfo = CompanyInfo::first();
        $jejakLangkahs = JejakLangkah::orderBy('created_at', 'desc')->get();
        return view('tentangkami.jejaklangkah-professional', compact('companyInfo', 'jejakLangkahs'));
    }
    
    public function memilihkami()
    {
        $companyInfo = CompanyInfo::first();
        $MK = WhyChooseUs::getActive();
        return view('memilihkami.mengapa-professional', compact('companyInfo', 'MK'));
    }
    
    public function sertifikatpenghargaan()
    {
        $companyInfo = CompanyInfo::first();
        $sertifikatPenghargaan = collect([]);
        return view('tentangkami.sertifikat-professional', compact('companyInfo', 'sertifikatPenghargaan'));
    }
    
    // Services Pages
    public function layananss()
    {
        $companyInfo = CompanyInfo::first();
        return view('produkdanlayanan.swaacademy-page', compact('companyInfo'));
    }
    
    public function layananfm()
    {
        $companyInfo = CompanyInfo::first();
        return view('produkdanlayanan.facility-management-page', compact('companyInfo'));
    }
    
    public function layananteknologi()
    {
        $companyInfo = CompanyInfo::first();
        $title = 'Digital Solution';
        $subtitle = 'Solusi Teknologi Digital untuk Transformasi Bisnis';
        $icon = 'bi-cpu';
        $description = 'Layanan teknologi informasi dan solusi digital untuk transformasi bisnis dan optimasi operasional.';
        $keywords = ['digital solution', 'teknologi', 'IT solutions', 'transformasi digital'];
        return view('produkdanlayanan.layanan-template', compact('companyInfo', 'title', 'subtitle', 'icon', 'description', 'keywords'));
    }
    
    public function layanandownstream()
    {
        $companyInfo = CompanyInfo::first();
        $title = 'SWA Tour Organizer';
        $subtitle = 'Layanan Perjalanan Wisata & Incentive Travel';
        $icon = 'bi-airplane';
        $description = 'Layanan tour organizer profesional untuk perjalanan bisnis, wisata, dan incentive travel dengan paket lengkap.';
        $keywords = ['tour organizer', 'travel', 'wisata', 'incentive travel'];
        return view('produkdanlayanan.layanan-template', compact('companyInfo', 'title', 'subtitle', 'icon', 'description', 'keywords'));
    }
    
    public function swasegar()
    {
        $companyInfo = CompanyInfo::first();
        $title = 'SWA Segar AMDK';
        $subtitle = 'Air Minum Dalam Kemasan Berkualitas Premium';
        $icon = 'bi-cup-straw';
        $description = 'Produk air minum dalam kemasan dengan kualitas premium, higienis, dan tersertifikasi untuk konsumsi keluarga dan perusahaan.';
        $keywords = ['AMDK', 'air minum', 'swasegar', 'air mineral'];
        return view('produkdanlayanan.layanan-template', compact('companyInfo', 'title', 'subtitle', 'icon', 'description', 'keywords'));
    }
    
    // Contact Page
    public function kontakkami()
    {
        $companyInfo = CompanyInfo::first();
        $social = SocialLink::first();
        return view('kontak.kontak-professional', compact('companyInfo', 'social'));
    }
    
    // Guidelines & Policies
    public function kebijakandanpedoman()
    {
        $companyInfo = CompanyInfo::first();
        return view('tentangkami.tentangkami', compact('companyInfo'));
    }
    
    // Career page
    public function karir()
    {
        $companyInfo = CompanyInfo::first();
        return view('karir.karir-professional', compact('companyInfo'));
    }
}
