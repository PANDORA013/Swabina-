<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    // Menampilkan daftar sertifikat
    public function index()
    {
        $sertifikats = Sertifikat::latest()->get();
        $layout = 'layouts.app';
        return view('admin.sertifikat.index', compact('sertifikats', 'layout'));
    }

    // Menampilkan form tambah
    public function create()
    {
        $layout = 'layouts.app';
        return view('admin.sertifikat.create', compact('layout'));
    }

    // Menyimpan sertifikat baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'image'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        // Upload Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('sertifikats', $imageName, 'public');
            $data['image'] = 'sertifikats/' . $imageName;
        }

        Sertifikat::create($data);
        return redirect()->route('admin.sertifikat.index')->with('success', 'Sertifikat berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $layout = 'layouts.app';
        return view('admin.sertifikat.edit', compact('sertifikat', 'layout'));
    }

    // Mengupdate sertifikat
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $sertifikat = Sertifikat::findOrFail($id);
        $data = $request->all();

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($sertifikat->image && Storage::disk('public')->exists($sertifikat->image)) {
                Storage::disk('public')->delete($sertifikat->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('sertifikats', $imageName, 'public');
            $data['image'] = 'sertifikats/' . $imageName;
        } else {
            // Jika tidak upload gambar, pakai gambar lama (jangan di-overwrite null)
            unset($data['image']);
        }

        $sertifikat->update($data);
        return redirect()->route('admin.sertifikat.index')->with('success', 'Sertifikat berhasil diperbarui');
    }

    // Menghapus sertifikat
    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        // Hapus gambar dari storage
        if ($sertifikat->image && Storage::disk('public')->exists($sertifikat->image)) {
            Storage::disk('public')->delete($sertifikat->image);
        }

        $sertifikat->delete();
        return redirect()->route('admin.sertifikat.index')->with('success', 'Sertifikat berhasil dihapus');
    }
}


