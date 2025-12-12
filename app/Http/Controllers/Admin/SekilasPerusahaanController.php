<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SekilasPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SekilasPerusahaanController extends Controller
{
    public function index()
    {
        $items = SekilasPerusahaan::latest()->paginate(10);
        return view('admin.sekilas_perusahaan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.sekilas_perusahaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sekilas', 'public');
        }

        SekilasPerusahaan::create($validated);

        return redirect()->route('admin.sekilas.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = SekilasPerusahaan::findOrFail($id);
        return view('admin.sekilas_perusahaan.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = SekilasPerusahaan::findOrFail($id);
        
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('sekilas', 'public');
        } else {
            unset($validated['image']);
        }

        $item->update($validated);

        return redirect()->route('admin.sekilas.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = SekilasPerusahaan::findOrFail($id);
        
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('admin.sekilas.index')->with('success', 'Data berhasil dihapus.');
    }
}
