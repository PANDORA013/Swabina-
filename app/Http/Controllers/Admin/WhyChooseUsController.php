<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        $items = WhyChooseUs::orderBy('order')->paginate(10);
        return view('admin.why-choose-us.index', compact('items'));
    }

    public function create()
    {
        return view('admin.why-choose-us.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'order'       => 'nullable|integer',
            'status'      => 'nullable|in:active,inactive',
        ]);

        $validated['status'] = $validated['status'] ?? 'active';

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('why_choose_us', 'public');
        }

        WhyChooseUs::create($validated);

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = WhyChooseUs::findOrFail($id);
        return view('admin.why-choose-us.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = WhyChooseUs::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'order'       => 'nullable|integer',
            'status'      => 'nullable|in:active,inactive',
        ]);

        $validated['status'] = $validated['status'] ?? $item->status;

        if ($request->hasFile('icon')) {
            if ($item->icon && Storage::disk('public')->exists($item->icon)) {
                Storage::disk('public')->delete($item->icon);
            }
            $validated['icon'] = $request->file('icon')->store('why_choose_us', 'public');
        } else {
            unset($validated['icon']);
        }

        $item->update($validated);

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = WhyChooseUs::findOrFail($id);

        if ($item->icon && Storage::disk('public')->exists($item->icon)) {
            Storage::disk('public')->delete($item->icon);
        }

        $item->delete();

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Why Choose Us berhasil dihapus.');
    }
}
