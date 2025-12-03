<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Models\JejakLangkah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JejakLangkahController extends Controller
{
    // Menampilkan daftar jejak langkah
    public function index()
    {
        $jejakLangkahs = JejakLangkah::orderBy('tahun', 'desc')->get();
        $layout = 'layouts.app';
        return view('admin.jejak_langkah.index', compact('jejakLangkahs', 'layout'));
    }

    // Menampilkan form tambah
    public function create()
    {
        $layout = 'layouts.app';
        return view('admin.jejak_langkah.create', compact('layout'));
    }

    // Menyimpan jejak langkah baru
    public function store(Request $request)
    {
        $request->validate([
            'tahun'      => 'required|integer|min:1900|max:2100',
            'deskripsi'  => 'required|string',
            'image'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        // Upload Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('jejak_langkah', $imageName, 'public');
            $data['image'] = 'jejak_langkah/' . $imageName;
        }

        JejakLangkah::create($data);
        return redirect()->route('admin.jejak.index')->with('success', 'Jejak Langkah berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $jejakLangkah = JejakLangkah::findOrFail($id);
        $layout = 'layouts.app';
        return view('admin.jejak_langkah.edit', compact('jejakLangkah', 'layout'));
    }

    // Mengupdate jejak langkah
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun'      => 'required|integer|min:1900|max:2100',
            'deskripsi'  => 'required|string',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $jejakLangkah = JejakLangkah::findOrFail($id);
        $data = $request->all();

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($jejakLangkah->image && Storage::disk('public')->exists($jejakLangkah->image)) {
                Storage::disk('public')->delete($jejakLangkah->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('jejak_langkah', $imageName, 'public');
            $data['image'] = 'jejak_langkah/' . $imageName;
        } else {
            // Jika tidak upload gambar, pakai gambar lama (jangan di-overwrite null)
            unset($data['image']);
        }

        $jejakLangkah->update($data);
        return redirect()->route('admin.jejak.index')->with('success', 'Jejak Langkah berhasil diperbarui');
    }

    // Menghapus jejak langkah
    public function destroy($id)
    {
        $jejakLangkah = JejakLangkah::findOrFail($id);

        // Hapus gambar dari storage
        if ($jejakLangkah->image && Storage::disk('public')->exists($jejakLangkah->image)) {
            Storage::disk('public')->delete($jejakLangkah->image);
        }

        $jejakLangkah->delete();
        return redirect()->route('admin.jejak.index')->with('success', 'Jejak Langkah berhasil dihapus');
    }
}


