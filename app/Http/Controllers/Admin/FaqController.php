<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255|unique:faqs,question',
            'answer'   => 'required|string',
            'kategori' => 'nullable|string', // Opsional jika ada grouping
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        // FIX: Ignore ID saat validasi unique agar tidak error saat save tanpa ubah judul
        $validated = $request->validate([
            'question' => 'required|string|max:255|unique:faqs,question,' . $id,
            'answer'   => 'required|string',
            'kategori' => 'nullable|string',
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
