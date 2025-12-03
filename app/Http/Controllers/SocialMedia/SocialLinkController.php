<?php

namespace App\Http\Controllers\SocialMedia;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SocialLinkController extends Controller
{
    public function __construct()
    {
        // Terapkan middleware auth untuk semua method kecuali yang explicit di-skip
        $this->middleware('auth')->except(['getPublicSocialLinks']);
    }

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

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Super Admin: bypass permission, Admin: must have permission
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            abort(403, 'Unauthorized. Permission "manage-settings" required.');
        }

        // Fix layout logic: super_admin gets layouts.app, admin gets layouts.app-professional
        $layout = $user->role === 'super_admin' ? 'layouts.app' : 'layouts.app-professional';
        $social = SocialLink::firstOrCreate(['id' => 1]);
        
        return view('admin.social-media.index', compact('layout', 'social'));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $request->validate([
                'type' => 'required|in:facebook,youtube,youtube_landing,whatsapp,instagram,linkedin',
                'url' => 'required|url'
            ]);

            if (!SocialLink::validateUrl($request->type, $request->url)) {
                return response()->json([
                    'success' => false,
                    'message' => 'URL tidak valid untuk tipe yang dipilih'
                ]);
            }

            $social = SocialLink::firstOrCreate(['id' => 1]);
            $social->update([$request->type => $request->url]);

            // Clear view cache setelah update
            View::clearCache();

            return response()->json([
                'success' => true,
                'message' => 'Link berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses permintaan'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $request->validate([
                'type' => 'required|in:facebook,youtube,youtube_landing,whatsapp,instagram,linkedin',
                'url' => 'required|url'
            ]);

            if (!SocialLink::validateUrl($request->type, $request->url)) {
                return response()->json([
                    'success' => false,
                    'message' => 'URL tidak valid untuk tipe yang dipilih'
                ]);
            }

            $social = SocialLink::findOrFail($id);
            $social->update([$request->type => $request->url]);

            return response()->json([
                'success' => true,
                'message' => 'Link berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $request->validate([
                'type' => 'required|in:facebook,youtube,youtube_landing,whatsapp,instagram'
            ]);

            $social = SocialLink::findOrFail($id);
            $social->update([$request->type => null]);

            return response()->json([
                'success' => true,
                'message' => 'Link berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
} 
