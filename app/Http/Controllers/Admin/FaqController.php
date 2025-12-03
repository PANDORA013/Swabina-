<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FaqController extends Controller
{
    public function index()
    {
        // Check permission
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            abort(403, 'Unauthorized. Permission "read-faq" required.');
        }

        $faqs = Faq::orderBy('created_at', 'desc')->get();
        $layout = $user->role === 'super_admin' ? 'layouts.app' : 'layouts.app-professional';
        
        return view('admin.faq.index', compact('faqs', 'layout'));
    }

    public function store(Request $request)
    {
        // Check permission
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        Faq::create([
            'question' => $request->question,
            'answer'   => $request->answer
        ]);

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil ditambahkan'
        ]);
    }

    public function update(Request $request, $id)
    {
        // Check permission
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        $faq = Faq::findOrFail($id);
        
        $faq->update([
            'question' => $request->question,
            'answer'   => $request->answer
        ]);

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        // Check permission
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-content')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $faq = Faq::findOrFail($id);
        $faq->delete();

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil dihapus'
        ]);
    }
}


