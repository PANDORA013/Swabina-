<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikats = Sertifikat::all();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.sertifikat.index', compact('sertifikats', 'layout'));
    }

    private function compressAndSaveImage($file)
    {
        try {
            Log::info('Starting image compression', ['original_size' => $file->getSize()]);
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            $image->scaleDown(1200);

            $extension = strtolower($file->getClientOriginalExtension());
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = in_array($extension, $allowedExtensions) ? $extension : 'jpg';

            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $path = 'sertifikats/' . $fileName;

            $fullPath = storage_path('app/public/' . $path);
            
            $directory = dirname($fullPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            switch ($extension) {
                case 'gif':
                    $image->toGif()->save($fullPath);
                    break;
                case 'png':
                    $image->toPng()->save($fullPath);
                    break;
                default:
                    $image->toJpeg(80)->save($fullPath);
            }

            if (!file_exists($fullPath)) {
                throw new \Exception("Failed to save image to {$fullPath}");
            }

            Log::info('Image compression completed', ['compressed_size' => filesize($fullPath)]);

            return $path;
        } catch (\Exception $e) {
            Log::error('Error in compressAndSaveImage', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            $imagePath = $this->compressAndSaveImage($request->file('image'));

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
                    Storage::disk('public')->delete($sertifikat->image);
                }
                $sertifikat->image = $this->compressAndSaveImage($request->file('image'));
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
        try {
            $sertifikat = Sertifikat::findOrFail($id);

            if ($sertifikat->image) {
                Storage::disk('public')->delete($sertifikat->image);
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
