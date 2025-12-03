<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SertifikatController extends Controller
{
    protected $imageCompressionService;

    public function __construct(ImageCompressionService $imageCompressionService)
    {
        $this->imageCompressionService = $imageCompressionService;
    }
    public function index()
    {
        // Check permission
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            abort(403, 'Unauthorized. Permission "read-sertifikat" required.');
        }

        $sertifikats = Sertifikat::all();
        $layout = $user->role === 'super_admin' ? 'layouts.app' : 'layouts.app-professional';
        return view('admin.sertifikat.index', compact('sertifikats', 'layout'));
    }

    public function store(Request $request)
    {
        // Check permission
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            $imagePath = $this->imageCompressionService->compressAndSaveImage($request->file('image'), 'sertifikats');

            Sertifikat::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'image' => $imagePath,
            ]);

            return response()->json(['success' => true, 'message' => 'Sertifikat berhasil ditambahkan.']);
        } catch (\Exception $e) {
            Log::error('Error in Sertifikat store', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        // Check permission
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $request->validate([
                'nama' => 'nullable|string|max:255',
                'deskripsi' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            $sertifikat = Sertifikat::findOrFail($id);

            if ($request->filled('nama')) {
                $sertifikat->nama = $request->nama;
            }

            if ($request->filled('deskripsi')) {
                $sertifikat->deskripsi = $request->deskripsi;
            }

            if ($request->hasFile('image')) {
                if ($sertifikat->image) {
                    $this->imageCompressionService->deleteImage($sertifikat->image);
                }
                $sertifikat->image = $this->imageCompressionService->compressAndSaveImage($request->file('image'), 'sertifikats');
            }

            $sertifikat->save();

            return response()->json(['success' => true, 'message' => 'Sertifikat berhasil diperbarui.']);
        } catch (\Exception $e) {
            Log::error('Error in Sertifikat update', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        // Check permission
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $sertifikat = Sertifikat::findOrFail($id);

            if ($sertifikat->image) {
                $this->imageCompressionService->deleteImage($sertifikat->image);
            }

            $sertifikat->delete();

            return response()->json(['success' => true, 'message' => 'Sertifikat berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error in Sertifikat destroy', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}


