<?php

namespace App\Http\Controllers;
use App\Models\VisiMisiBudaya;
use App\Models\SekilasPerusahaan;
use App\Models\SertifikatPenghargaan;
use App\Models\FotoLayanan;
use App\Models\JejakLangkah;
use Illuminate\Http\Request;

class TentangkamiController extends Controller
{
    public function sekilasPerusahaan()
    {
        $sekilas = SekilasPerusahaan::all();
        $fotolayanan = FotoLayanan::all();
        
        return view('tentangkami.sekilas-professional', compact('sekilas', 'fotolayanan'));
    }
    public function visiMisiBudaya()
    {
        $visiMisiBudaya = VisiMisiBudaya::all();
        
        return view('tentangkami.visimisi-professional', compact('visiMisiBudaya'));
    }
    public function sertifikat()
    {
        $sertifikatPenghargaan = SertifikatPenghargaan::all();
        return view('tentangkami.sertifikat-professional', compact('sertifikatPenghargaan'));
    }
    
    public function jejakLangkah()
    {
        $jejakLangkahs = JejakLangkah::all();
        return view('tentangkami.jejaklangkah-professional', compact('jejakLangkahs'));
    }

    //Controller English
    public function sekilasPerusahaanEng()
    {
        $sekilas = SekilasPerusahaan::all();
        $fotolayanan = FotoLayanan::all();
        
        return view('eng.tentangkami-eng.sekilas-eng', compact('sekilas', 'fotolayanan'));
    }
    public function visiMisiBudayaEng()
    {
        $visiMisiBudaya = VisiMisiBudaya::all();
        
        return view('eng.tentangkami-eng.visimisi-eng', compact('visiMisiBudaya'));
    }
    public function sertifikatEng()
    {
        $sertifikatPenghargaan = SertifikatPenghargaan::all();
        return view('eng.tentangkami-eng.sertifikat-eng', compact('sertifikatPenghargaan'));
    }
}
