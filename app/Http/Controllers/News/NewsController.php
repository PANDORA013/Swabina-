<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    // ============================================
    // ADMIN METHODS (Protected by middleware)
    // ============================================

    // Menampilkan daftar berita di admin panel
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.news.index', compact('beritas'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('admin.news.create');
    }

    // Menyimpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        
        // Generate slug dari title
        $data['slug'] = Str::slug($request->title);

        // Upload Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Simpan ke folder public/assets/gambar_berita
            $image->move(public_path('assets/gambar_berita'), $imageName);
            $data['image'] = $imageName;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.news.edit', compact('berita'));
    }

    // Mengupdate berita
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $berita = Berita::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($berita->image && File::exists(public_path('assets/gambar_berita/' . $berita->image))) {
                File::delete(public_path('assets/gambar_berita/' . $berita->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/gambar_berita'), $imageName);
            $data['image'] = $imageName;
        } else {
            // Jika tidak upload gambar, pakai gambar lama (jangan di-overwrite null)
            unset($data['image']);
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    // Menghapus berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar dari folder
        if ($berita->image && File::exists(public_path('assets/gambar_berita/' . $berita->image))) {
            File::delete(public_path('assets/gambar_berita/' . $berita->image));
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }

    // ============================================
    // PUBLIC METHODS (Without authentication)
    // ============================================

    // Menampilkan daftar berita untuk publik
    public function publicIndex()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('news.index', compact('beritas'));
    }

    // Menampilkan detail berita publik
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Ambil berita terkait (exclude berita saat ini)
        $relatedBerita = Berita::where('id', '!=', $id)
                               ->latest()
                               ->limit(3)
                               ->get();
        
        return view('news.show', compact('berita', 'relatedBerita'));
    }
}