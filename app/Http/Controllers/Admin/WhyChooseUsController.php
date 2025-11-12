<?php

namespace App\Http\Controllers\Admin;

use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = WhyChooseUs::orderBy('order', 'asc')->get();
        return view('admin.why-choose-us.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.why-choose-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('why-choose-us', 'public');
            $data['image'] = basename($path);
        }

        WhyChooseUs::create($data);

        return redirect()->route('admin.why-choose-us.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WhyChooseUs $whyChooseUs)
    {
        return view('admin.why-choose-us.edit', compact('whyChooseUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WhyChooseUs $whyChooseUs)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($whyChooseUs->image && file_exists(storage_path('app/public/why-choose-us/' . $whyChooseUs->image))) {
                unlink(storage_path('app/public/why-choose-us/' . $whyChooseUs->image));
            }
            
            $path = $request->file('image')->store('why-choose-us', 'public');
            $data['image'] = basename($path);
        }

        $whyChooseUs->update($data);

        return redirect()->route('admin.why-choose-us.index')
            ->with('success', 'Item berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WhyChooseUs $whyChooseUs)
    {
        // Delete image if exists
        if ($whyChooseUs->image && file_exists(storage_path('app/public/why-choose-us/' . $whyChooseUs->image))) {
            unlink(storage_path('app/public/why-choose-us/' . $whyChooseUs->image));
        }

        $whyChooseUs->delete();

        return redirect()->route('admin.why-choose-us.index')
            ->with('success', 'Item berhasil dihapus');
    }

    /**
     * Reorder items
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:why_choose_us,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($request->items as $item) {
            WhyChooseUs::find($item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan berhasil diperbarui']);
    }
}
