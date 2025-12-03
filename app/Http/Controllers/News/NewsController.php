<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    // Public pages
    public function publicIndex()
    {
        $beritas = Berita::all(); 
        return view('berita.berita-professional', compact('beritas'));
    }

    public function publicIndexEng()
    {
        $beritas = Berita::all(); 
        return view('eng.berita-eng.berita-eng', compact('beritas'));
    }

    // Admin management page
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Super Admin: bypass permission, Admin: must have permission
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-news')) {
            abort(403, 'Unauthorized. Permission "manage-news" required.');
        }

        $beritas = Berita::latest()->get();
        // Fix layout logic: super_admin gets layouts.app, admin gets layouts.app-professional
        $layout = $user->role === 'super_admin' ? 'layouts.app' : 'layouts.app-professional';
        
        return view('admin.news.index', compact('beritas', 'layout'));
    }

    // Create page (not used in modal, but required by routes)
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-news')) {
            abort(403, 'Unauthorized. Permission "manage-news" required.');
        }

        $layout = $user->role === 'super_admin' ? 'layouts.app' : 'layouts.app-professional';
        return view('admin.news.create', compact('layout'));
    }

    // Edit page (not used in modal, but required by routes)
    public function edit($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-news')) {
            abort(403, 'Unauthorized. Permission "manage-news" required.');
        }

        $berita = Berita::findOrFail($id);
        $layout = $user->role === 'super_admin' ? 'layouts.app' : 'layouts.app-professional';
        return view('admin.news.edit', compact('berita', 'layout'));
    }

    // Public detail page
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('news.detail', compact('berita'));
    }

    private function compressAndSaveImage($file)
    {
        try {
            Log::info('Starting image compression', ['original_size' => $file->getSize()]);
            
            // Create directory if it doesn't exist
            $storagePath = storage_path('app/public/beritas');
            if (!file_exists($storagePath)) {
                if (!mkdir($storagePath, 0755, true)) {
                    throw new \Exception("Failed to create directory: {$storagePath}");
                }
                Log::info('Created beritas directory', ['path' => $storagePath]);
            }
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            $image->scaleDown(1200);

            $extension = strtolower($file->getClientOriginalExtension());
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = in_array($extension, $allowedExtensions) ? $extension : 'jpg';

            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $path = 'beritas/' . $fileName;

            $fullPath = storage_path('app/public/' . $path);
            
            Log::info('Saving image', ['fullPath' => $fullPath, 'extension' => $extension]);
            
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

            Log::info('Image compression completed', ['compressed_size' => filesize($fullPath), 'path' => $path]);

            return $path;
        } catch (\Exception $e) {
            Log::error('Error in compressAndSaveImage', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file_name' => $file->getClientOriginalName() ?? 'unknown'
            ]);
            throw $e;
        }
    }

    private function formatDescription($text)
    {
        // Menghapus karakter kontrol kecuali newline
        $text = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $text);
        // Mengganti berbagai jenis newline menjadi \n
        return preg_replace('/\r\n|\r|\n/', "\n", $text);
    }

    public function store(Request $request)
    {
        Log::info('=== BERITA STORE METHOD CALLED ===');
        Log::info('Request data', [
            'method' => $request->method(),
            'path' => $request->path(),
            'has_file' => $request->hasFile('image'),
            'title' => $request->input('title'),
            'description_length' => strlen($request->input('description', '')),
            'all_inputs' => $request->except('image')
        ]);
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Log::info('User info', [
            'id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            'is_super_admin' => $user->isSuperAdmin()
        ]);
        
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-news')) {
            Log::warning('Permission denied for user', ['user_id' => $user->id]);
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
                'title' => 'required|string|max:255',
                'description' => 'required|string|min:10',
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed for berita store', ['errors' => $validator->errors()]);
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }

            Log::info('Validation passed, starting image compression');
            $path = $this->compressAndSaveImage($request->file('image'));
            Log::info('Image saved', ['path' => $path]);

            // Save single-language content
            $berita = Berita::create([
                'image' => $path,
                'title' => $request->title,
                'description' => $this->formatDescription($request->description),
            ]);

            Log::info('=== BERITA CREATED SUCCESSFULLY ===', [
                'id' => $berita->id,
                'title' => $berita->title,
                'image' => $berita->image
            ]);
            return response()->json(['success' => true, 'message' => 'Berita berhasil ditambahkan']);
        } catch (\Exception $e) {
            Log::error('=== ERROR IN BERITA STORE ===', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-news')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $berita = Berita::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }

            if ($request->hasFile('image')) {
                if ($berita->image) {
                    Storage::disk('public')->delete($berita->image);
                }
                $berita->image = $this->compressAndSaveImage($request->file('image'));
            }

            // Update single-language content
            if ($request->has('title')) {
                $berita->title = $request->title;
            }

            if ($request->has('description')) {
                $berita->description = $this->formatDescription($request->description);
            }

            $berita->save();

            return response()->json(['success' => true, 'message' => 'Berita berhasil diperbarui']);
        } catch (\Exception $e) {
            Log::error('Error in berita update', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-news')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $berita = Berita::findOrFail($id);

            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }

            $berita->delete();

            return response()->json(['success' => true, 'message' => 'Berita berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error in berita destroy: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
