<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SekilasPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SekilasPerusahaanController extends Controller
{
    public function index()
    {
        $layout = 'vertical';
        $items = SekilasPerusahaan::latest()->get();
        return view('admin.sekilas_perusahaan.index', compact('items', 'layout'));
    }

    public function create()
    {
        $layout = 'vertical';
        return view('admin.sekilas_perusahaan.create', compact('layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/gambar_sekilas'), $name);
            $data['image'] = $name;
        }

        SekilasPerusahaan::create($data);

        return redirect()->route('admin.sekilas.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = SekilasPerusahaan::findOrFail($id);
        $layout = 'vertical';
        return view('admin.sekilas_perusahaan.edit', compact('item', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $item = SekilasPerusahaan::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image && File::exists(public_path('assets/gambar_sekilas/' . $item->image))) {
                File::delete(public_path('assets/gambar_sekilas/' . $item->image));
            }
            
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/gambar_sekilas'), $name);
            $data['image'] = $name;
        }

        $item->update($data);

        return redirect()->route('admin.sekilas.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $item = SekilasPerusahaan::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($item->image && File::exists(public_path('assets/gambar_sekilas/' . $item->image))) {
            File::delete(public_path('assets/gambar_sekilas/' . $item->image));
        }

        $item->delete();

        return redirect()->route('admin.sekilas.index')->with('success', 'Data berhasil dihapus');
    }
}
