<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Models\VisiMisiBudaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisionMissionController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            abort(403, 'Unauthorized. Permission "manage-content" required.');
        }

        $visi   = VisiMisiBudaya::where('type', 'visi')->get();
        $misi   = VisiMisiBudaya::where('type', 'misi')->get();
        $budaya = VisiMisiBudaya::where('type', 'budaya')->get();

        $layout = $user->role === 'super_admin' ? 'layouts.app' : 'layouts.app-professional';

        return view('admin.visi-misi.index', compact('visi', 'misi', 'budaya', 'layout'));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'type'       => 'required|in:visi,misi,budaya',
            'content'    => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $item = VisiMisiBudaya::create([
            'type'       => $request->type,
            'content'    => $request->content, // plain text
            'text_align' => $request->text_align,
        ]);

        return response()->json([
            'success' => true,
            'message' => ucfirst($item->type) . ' berhasil ditambahkan'
        ]);
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content'    => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        try {
            $item = VisiMisiBudaya::findOrFail($id);
            $item->update([
                'content'    => $request->content,
                'text_align' => $request->text_align,
            ]);

            return response()->json([
                'success' => true,
                'message' => ucfirst($item->type) . ' berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data'
            ], 500);
        }
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $item = VisiMisiBudaya::findOrFail($id);
            $type = $item->type;
            $item->delete();

            return response()->json([
                'success' => true,
                'message' => ucfirst($type) . ' berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data'
            ], 500);
        }
    }
}
