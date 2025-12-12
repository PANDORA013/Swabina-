<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = LayananPage::latest()->paginate(10);
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:500',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'features'    => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        // Auto generate slug from title
        $validated['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('layanan', 'public');
        }

        LayananPage::create($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dibuat.');
    }

    public function edit($slug)
    {
        $layanan = LayananPage::where('slug', $slug)->firstOrFail();
        
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $slug)
    {
        $layanan = LayananPage::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:500',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'features'    => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        // Update slug if title changed
        if ($request->title !== $layanan->title) {
            $validated['slug'] = Str::slug($request->title);
        }

        // Handle Image Update
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama
            if ($layanan->image && Storage::disk('public')->exists($layanan->image)) {
                Storage::disk('public')->delete($layanan->image);
            }
            // 2. Simpan gambar baru
            $validated['image'] = $request->file('image')->store('layanan', 'public');
        } else {
            // Jika tidak ada gambar baru, hapus key 'image' dari array validated agar tidak menimpa data lama dengan null
            unset($validated['image']);
        }

        $layanan->update($validated);

        return redirect()
            ->route('admin.layanan.edit', $validated['slug'] ?? $slug)
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, $slug)
    {
        $validated = $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $layanan = LayananPage::where('slug', $slug)->firstOrFail();
        $layanan->update(['is_active' => $validated['is_active']]);

        return response()->json([
            'success' => true,
            'message' => 'Status layanan berhasil diupdate'
        ]);
    }

    public function destroy($slug)
    {
        $layanan = LayananPage::where('slug', $slug)->firstOrFail();
        
        // Hapus gambar jika ada
        if ($layanan->image && Storage::disk('public')->exists($layanan->image)) {
            Storage::disk('public')->delete($layanan->image);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}