<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SekilasPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SekilasPerusahaanController extends Controller
{
    public function index()
    {
        $sekilas = SekilasPerusahaan::first();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.sekilas_perusahaan.index', compact('sekilas', 'layout'));
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
            $path = 'sekilas_perusahaan/' . $fileName;

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
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tahun_berdiri' => 'nullable|integer|min:1900|max:2100',
                'jumlah_karyawan' => 'nullable|integer|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tahun_berdiri' => $request->tahun_berdiri,
                'jumlah_karyawan' => $request->jumlah_karyawan,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $this->compressAndSaveImage($request->file('image'));
            }

            SekilasPerusahaan::create($data);

            return response()->json(['success' => true, 'message' => 'Sekilas perusahaan berhasil ditambahkan.']);
        } catch (\Exception $e) {
            Log::error('Error in SekilasPerusahaan store', [
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
                'judul' => 'nullable|string|max:255',
                'deskripsi' => 'nullable|string',
                'tahun_berdiri' => 'nullable|integer|min:1900|max:2100',
                'jumlah_karyawan' => 'nullable|integer|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            $sekilas = SekilasPerusahaan::findOrFail($id);

            if ($request->filled('judul')) {
                $sekilas->judul = $request->judul;
            }

            if ($request->filled('deskripsi')) {
                $sekilas->deskripsi = $request->deskripsi;
            }

            if ($request->filled('tahun_berdiri')) {
                $sekilas->tahun_berdiri = $request->tahun_berdiri;
            }

            if ($request->filled('jumlah_karyawan')) {
                $sekilas->jumlah_karyawan = $request->jumlah_karyawan;
            }

            if ($request->hasFile('image')) {
                if ($sekilas->image) {
                    Storage::disk('public')->delete($sekilas->image);
                }
                $sekilas->image = $this->compressAndSaveImage($request->file('image'));
            }

            $sekilas->save();

            return response()->json(['success' => true, 'message' => 'Sekilas perusahaan berhasil diperbarui.']);
        } catch (\Exception $e) {
            Log::error('Error in SekilasPerusahaan update', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
