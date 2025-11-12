<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\CompanyInfo;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class KontakkamiController extends Controller
{
    public function index()
    {
        $companyInfo = CompanyInfo::first();
        $social = SocialLink::first();
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('kontak.kontak-professional', compact('companyInfo', 'social', 'faqs'));
    }
    
    public function indexEng()
    {
        $companyInfo = CompanyInfo::first();
        $social = SocialLink::first();
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('eng.kontak-eng.kontak-kami-eng', compact('companyInfo', 'social', 'faqs'));
    }
    
    public function kirimPesan()
    {
        return view('kontak.kirim-pesan');
    }
    
    public function submitPesan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'subjek' => 'required|string',
            'pesan' => 'required|string|max:500',
            'privacy' => 'accepted'
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'telepon.required' => 'Nomor telepon wajib diisi',
            'subjek.required' => 'Subjek wajib dipilih',
            'pesan.required' => 'Pesan wajib diisi',
            'pesan.max' => 'Pesan maksimal 500 karakter',
            'privacy.accepted' => 'Anda harus menyetujui kebijakan privasi'
        ]);
        
        // TODO: Send email notification
        // Mail::to('info@swabinagatra.co.id')->send(new ContactMessage($validated));
        
        return redirect()->route('kirim-pesan')->with('success', 'Terima kasih! Pesan Anda telah terkirim. Tim kami akan segera menghubungi Anda.');
    }
}
