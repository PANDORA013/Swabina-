<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedoman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PedomanController extends Controller
{
    public function index()
    {
        $pedomans = Pedoman::latest()->paginate(10);
        return view('admin.pedoman.index', compact('pedomans'));
    }

    public function create()
    {
        return view('admin.pedoman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_pdf'    => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file_pdf')) {
            $validated['file_path'] = $request->file('file_pdf')->store('pedoman', 'public');
        }

        Pedoman::create($validated);

        return redirect()->route('admin.pedoman.index')->with('success', 'Pedoman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pedoman = Pedoman::findOrFail($id);
        return view('admin.pedoman.edit', compact('pedoman'));
    }

    public function update(Request $request, $id)
    {
        $pedoman = Pedoman::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_pdf'    => 'nullable|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_pdf')) {
            if ($pedoman->file_path && Storage::disk('public')->exists($pedoman->file_path)) {
                Storage::disk('public')->delete($pedoman->file_path);
            }
            $validated['file_path'] = $request->file('file_pdf')->store('pedoman', 'public');
        } else {
            unset($validated['file_path']);
        }

        $pedoman->update($validated);

        return redirect()->route('admin.pedoman.index')->with('success', 'Pedoman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pedoman = Pedoman::findOrFail($id);

        if ($pedoman->file_path && Storage::disk('public')->exists($pedoman->file_path)) {
            Storage::disk('public')->delete($pedoman->file_path);
        }

        $pedoman->delete();

        return redirect()->route('admin.pedoman.index')->with('success', 'Pedoman berhasil dihapus.');
    }
}