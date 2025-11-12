<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        
        return view('admin.faq.index', compact('faqs', 'layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan_id' => 'required|string',
            'jawaban_id' => 'required|string'
        ]);

        $content = [
            'id' => [
                'pertanyaan' => $request->pertanyaan_id,
                'jawaban' => $request->jawaban_id
            ],
            'en' => [
                'pertanyaan' => $request->pertanyaan_en ?? '',
                'jawaban' => $request->jawaban_en ?? ''
            ]
        ];

        Faq::create([
            'content' => $content
        ]);

        View::clearCache();

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil ditambahkan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan_id' => 'required|string',
            'jawaban_id' => 'required|string'
        ]);

        $faq = Faq::findOrFail($id);
        
        $content = [
            'id' => [
                'pertanyaan' => $request->pertanyaan_id,
                'jawaban' => $request->jawaban_id
            ],
            'en' => [
                'pertanyaan' => $request->pertanyaan_en ?? '',
                'jawaban' => $request->jawaban_en ?? ''
            ]
        ];

        $faq->update([
            'content' => $content
        ]);

        View::clearCache();

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        View::clearCache();

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil dihapus'
        ]);
    }
}
