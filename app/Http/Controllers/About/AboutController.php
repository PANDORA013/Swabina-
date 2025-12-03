<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Models\VisiMisiBudaya;
use App\Models\SekilasPerusahaan;
use App\Models\Sertifikat;

use App\Models\JejakLangkah;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function sekilasPerusahaan()
    {
        $sekilas = SekilasPerusahaan::all();
        return view('tentangkami.sekilas-professional', compact('sekilas'));
    }
    public function visiMisiBudaya()
    {
        $visiMisiBudaya = VisiMisiBudaya::all();
        
        return view('tentangkami.visimisi-professional', compact('visiMisiBudaya'));
    }
    public function sertifikat()
    {
        $sertifikat = Sertifikat::all();
        return view('tentangkami.sertifikat-professional', compact('sertifikat'));
    }
    
    public function jejakLangkah()
    {
        $jejakLangkahs = JejakLangkah::all();
        return view('tentangkami.jejaklangkah-professional', compact('jejakLangkahs'));
    }
}

