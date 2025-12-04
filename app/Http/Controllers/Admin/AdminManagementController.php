<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function index()
    {
        $layout = 'vertical';
        // Ambil semua user kecuali yang sedang login (opsional) atau tampilkan semua
        $admins = User::latest()->get();
        return view('admin.admin-management.index', compact('admins', 'layout'));
    }

    public function create()
    {
        $layout = 'vertical';
        return view('admin.admin-management.create', compact('layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('admin.admin-management.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $layout = 'vertical';
        return view('admin.admin-management.edit', compact('admin', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
            'password' => 'nullable|min:8' // Password opsional saat edit
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admin-management.index')->with('success', 'Data admin berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cek apakah user mencoba hapus akun sendiri
        if ($id == Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }
        
        User::findOrFail($id)->delete();
        return redirect()->route('admin.admin-management.index')->with('success', 'Admin berhasil dihapus');
    }
}

