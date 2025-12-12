<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikats = Sertifikat::latest()->paginate(10);
        return view('admin.sertifikat.index', compact('sertifikats'));
    }

    public function create()
    {
        return view('admin.sertifikat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'issued_date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sertifikats', 'public');
        }

        Sertifikat::create($validated);

        return redirect()->route('admin.sertifikat.index')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        return view('admin.sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'issued_date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($sertifikat->image && Storage::disk('public')->exists($sertifikat->image)) {
                Storage::disk('public')->delete($sertifikat->image);
            }
            $validated['image'] = $request->file('image')->store('sertifikats', 'public');
        } else {
            unset($validated['image']);
        }

        $sertifikat->update($validated);

        return redirect()->route('admin.sertifikat.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        if ($sertifikat->image && Storage::disk('public')->exists($sertifikat->image)) {
            Storage::disk('public')->delete($sertifikat->image);
        }
        $sertifikat->delete();
        return redirect()->route('admin.sertifikat.index')->with('success', 'Sertifikat dihapus.');
    }
}


