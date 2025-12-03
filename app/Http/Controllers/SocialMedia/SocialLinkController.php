<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SocialLinkController extends Controller
{
    // Method publik untuk mengambil social links yang aman
    public function getPublicSocialLinks()
    {
        $social = SocialLink::select('facebook', 'youtube', 'instagram')
            ->firstOrCreate(['id' => 1]);
            
        return response()->json([
            'facebook' => $social->facebook,
            'youtube' => $social->youtube,
            'instagram' => $social->instagram
        ]);
    }

    // Menampilkan daftar social media links
    public function index()
    {
        $social = SocialLink::firstOrCreate(['id' => 1]);
        $layout = 'layouts.app';
        return view('admin.social-media.index', compact('social', 'layout'));
    }

    // Menampilkan form edit (SocialLink is a single row table)
    public function edit($id)
    {
        $social = SocialLink::findOrFail($id);
        $layout = 'layouts.app';
        return view('admin.social-media.edit', compact('social', 'layout'));
    }

    // Mengupdate social media links
    public function update(Request $request, $id)
    {
        $request->validate([
            'facebook'       => 'nullable|url',
            'instagram'      => 'nullable|url',
            'youtube'        => 'nullable|url',
            'youtube_landing' => 'nullable|url',
            'whatsapp'       => 'nullable|string',
            'linkedin'       => 'nullable|url',
        ]);

        $social = SocialLink::findOrFail($id);
        $data = $request->all();

        $social->update($data);

        // Clear view cache after update
        View::clearCache();

        return redirect()->route('admin.social-media.index')->with('success', 'Social media links berhasil diperbarui');
    }
} 
