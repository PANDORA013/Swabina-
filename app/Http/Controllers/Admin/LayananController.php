<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = DB::table('layanan_pages')->orderBy('order')->get();
        $layout = 'layouts.app';
        
        return view('admin.layanan.index', compact('layanan', 'layout'));
    }

    public function edit($slug)
    {
        $layanan = DB::table('layanan_pages')->where('slug', $slug)->first();
        $layout = 'layouts.app';
        
        if (!$layanan) {
            return redirect()->route('admin.layanan.index')->with('error', 'Layanan tidak ditemukan');
        }
        
        return view('admin.layanan.edit', compact('layanan', 'layout'));
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
            ]);

            $layanan = DB::table('layanan_pages')->where('slug', $slug)->first();
            
            // Delete old image
            if ($layanan && $layanan->image) {
                Storage::disk('public')->delete($layanan->image);
            }

            $imagePath = $request->file('image')->store('layanan', 'public');
            $validated['image'] = $imagePath;
        }

        DB::table('layanan_pages')
            ->where('slug', $slug)
            ->update(array_merge($validated, [
                'updated_at' => now()
            ]));

        return redirect()
            ->route('admin.layanan.edit', $slug)
            ->with('success', 'Layanan berhasil diupdate');
    }

    public function updateStatus(Request $request, $slug)
    {
        $validated = $request->validate([
            'is_active' => 'required|boolean'
        ]);

        DB::table('layanan_pages')
            ->where('slug', $slug)
            ->update([
                'is_active' => $validated['is_active'],
                'updated_at' => now()
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Status layanan berhasil diupdate'
        ]);
    }

    // Menghapus layanan
    public function destroy($slug)
    {
        $layanan = DB::table('layanan_pages')->where('slug', $slug)->first();
        
        if (!$layanan) {
            return redirect()->route('admin.layanan.index')->with('error', 'Layanan tidak ditemukan');
        }

        // Hapus gambar jika ada
        if ($layanan->image && Storage::disk('public')->exists($layanan->image)) {
            Storage::disk('public')->delete($layanan->image);
        }

        // Hapus data dari database
        DB::table('layanan_pages')->where('slug', $slug)->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus');
    }
}