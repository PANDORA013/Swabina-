<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function index()
    {
        $layout = 'vertical';
        // Ambil data pertama, jika tidak ada buat baru (dummy) agar tidak error
        $info = CompanyInfo::first() ?? new CompanyInfo();
        return view('admin.company-info.index', compact('info', 'layout'));
    }

    // Kita gunakan store/update untuk menyimpan data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'nullable',
        ]);

        // Update or Create (Id 1 selalu dipakai)
        CompanyInfo::updateOrCreate(
            ['id' => 1], // Kondisi cari
            $request->except(['_token', '_method']) // Data update
        );

        return redirect()->route('admin.company-info.index')->with('success', 'Informasi perusahaan berhasil diperbarui');
    }
    
    // Untuk kompatibilitas resource route, jika ada method update/create/edit lain
    public function create() { return $this->index(); }
    public function edit($id) { return $this->index(); }
    public function update(Request $request, $id) { return $this->store($request); }
}
