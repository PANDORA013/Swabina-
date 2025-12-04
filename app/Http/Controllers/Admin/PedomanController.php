<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedoman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PedomanController extends Controller
{
    public function index()
    {
        $layout = 'vertical';
        $pedomans = Pedoman::latest()->get();
        return view('admin.pedoman.pedoman', compact('pedomans', 'layout')); // Sesuai nama file view Anda 'pedoman.blade.php'
    }

    public function create()
    {
        $layout = 'vertical';
        return view('admin.pedoman.create', compact('layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:10000' // max 10MB
        ]);

        $data = $request->all();

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/file_pdf'), $name);
            $data['file_path'] = $name; // Sesuaikan nama kolom di database, misal 'file_path' atau 'file_pdf'
        }

        Pedoman::create($data);
        return redirect()->route('admin.pedoman.index')->with('success', 'Pedoman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pedoman = Pedoman::findOrFail($id);
        $layout = 'vertical';
        return view('admin.pedoman.edit', compact('pedoman', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $pedoman = Pedoman::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'file_pdf' => 'nullable|mimes:pdf|max:10000'
        ]);

        $data = $request->all();

        if ($request->hasFile('file_pdf')) {
            if ($pedoman->file_path && File::exists(public_path('assets/file_pdf/' . $pedoman->file_path))) {
                File::delete(public_path('assets/file_pdf/' . $pedoman->file_path));
            }
            $file = $request->file('file_pdf');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/file_pdf'), $name);
            $data['file_path'] = $name;
        }

        $pedoman->update($data);
        return redirect()->route('admin.pedoman.index')->with('success', 'Pedoman berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pedoman = Pedoman::findOrFail($id);
        if ($pedoman->file_path && File::exists(public_path('assets/file_pdf/' . $pedoman->file_path))) {
            File::delete(public_path('assets/file_pdf/' . $pedoman->file_path));
        }
        $pedoman->delete();
        return redirect()->route('admin.pedoman.index')->with('success', 'Pedoman berhasil dihapus');
    }
}