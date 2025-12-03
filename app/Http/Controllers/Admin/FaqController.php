<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Menampilkan daftar FAQ
    public function index()
    {
        $faqs = Faq::latest()->get();
        $layout = 'layouts.app';
        return view('admin.faq.index', compact('faqs', 'layout'));
    }

    // Menampilkan form tambah
    public function create()
    {
        $layout = 'layouts.app';
        return view('admin.faq.create', compact('layout'));
    }

    // Menyimpan FAQ baru
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
        ]);

        Faq::create($request->all());
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $layout = 'layouts.app';
        return view('admin.faq.edit', compact('faq', 'layout'));
    }

    // Mengupdate FAQ
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($request->all());
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui');
    }

    // Menghapus FAQ
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus');
    }
}
