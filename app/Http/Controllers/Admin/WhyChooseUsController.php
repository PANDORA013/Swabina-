<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyChooseUsController extends Controller
{
    // Menampilkan daftar why choose us
    public function index()
    {
        $items = WhyChooseUs::orderBy('order')->get();
        $layout = 'layouts.app';
        return view('admin.why-choose-us.index', compact('items', 'layout'));
    }

    // Menampilkan form tambah
    public function create()
    {
        $layout = 'layouts.app';
        return view('admin.why-choose-us.create', compact('layout'));
    }

    // Menyimpan why choose us baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order'       => 'nullable|integer',
            'status'      => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $data['status'] = $data['status'] ?? 'active';

        // Upload Icon
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_' . $icon->getClientOriginalName();
            $icon->storeAs('why_choose_us', $iconName, 'public');
            $data['icon'] = 'why_choose_us/' . $iconName;
        }

        WhyChooseUs::create($data);
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $item = WhyChooseUs::findOrFail($id);
        $layout = 'layouts.app';
        return view('admin.why-choose-us.edit', compact('item', 'layout'));
    }

    // Mengupdate why choose us
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order'       => 'nullable|integer',
            'status'      => 'nullable|in:active,inactive',
        ]);

        $item = WhyChooseUs::findOrFail($id);
        $data = $request->all();
        $data['status'] = $data['status'] ?? $item->status;

        // Cek jika ada upload icon baru
        if ($request->hasFile('icon')) {
            // Hapus icon lama jika ada
            if ($item->icon && Storage::disk('public')->exists($item->icon)) {
                Storage::disk('public')->delete($item->icon);
            }

            $icon = $request->file('icon');
            $iconName = time() . '_' . $icon->getClientOriginalName();
            $icon->storeAs('why_choose_us', $iconName, 'public');
            $data['icon'] = 'why_choose_us/' . $iconName;
        } else {
            // Jika tidak upload icon, pakai icon lama (jangan di-overwrite null)
            unset($data['icon']);
        }

        $item->update($data);
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us berhasil diperbarui');
    }

    // Menghapus why choose us
    public function destroy($id)
    {
        $item = WhyChooseUs::findOrFail($id);

        // Hapus icon dari storage
        if ($item->icon && Storage::disk('public')->exists($item->icon)) {
            Storage::disk('public')->delete($item->icon);
        }

        $item->delete();
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us berhasil dihapus');
    }
}
