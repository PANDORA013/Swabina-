<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::all(); 
        $layout = 'layouts.app';
        return view('admin.social-media.index', compact('socialLinks', 'layout'));
    }

    public function create()
    {
        $layout = 'layouts.app';
        return view('admin.social-media.create', compact('layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string',
            'url' => 'required|url',
        ]);

        SocialLink::create([
            'platform' => $request->platform,
            'url' => $request->url,
            'icon' => $this->getIcon($request->platform),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.social-media.index')->with('success', 'Sosial media berhasil ditambahkan');
    }

    public function edit($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $layout = 'layouts.app';
        return view('admin.social-media.edit', compact('socialLink', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'platform' => 'required|string',
            'url' => 'required|url',
        ]);

        $socialLink = SocialLink::findOrFail($id);
        $socialLink->update([
            'platform' => $request->platform,
            'url' => $request->url,
            'icon' => $this->getIcon($request->platform),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.social-media.index')->with('success', 'Sosial media berhasil diperbarui');
    }

    public function destroy($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();

        return redirect()->route('admin.social-media.index')->with('success', 'Sosial media berhasil dihapus');
    }

    private function getIcon($platform)
    {
        $icons = [
            'facebook' => 'ti ti-brand-facebook',
            'instagram' => 'ti ti-brand-instagram',
            'twitter' => 'ti ti-brand-twitter',
            'linkedin' => 'ti ti-brand-linkedin',
            'youtube' => 'ti ti-brand-youtube',
            'tiktok' => 'ti ti-brand-tiktok',
        ];

        return $icons[strtolower($platform)] ?? 'ti ti-link';
    }
} 
