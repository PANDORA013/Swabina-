<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            abort(403, 'Unauthorized. Permission "manage-settings" required.');
        }

        $page = Page::where('type', 'kontak')->first() ?? new Page();
        $layout = $user->role === 'admin' ? 'layouts.app' : 'layouts.app-professional';
        return view('admin.contact-page.index', compact('page', 'layout'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            abort(403, 'Unauthorized. Permission "manage-settings" required.');
        }

        $page = Page::where('type', 'kontak')->first() ?? new Page();
        $page->type = 'kontak';
        $page->slug = 'kontak';
        $page->title = $request->title ?? 'Kontak Kami';
        $page->content = $request->input('content');
        $page->metadata = json_encode($request->metadata ?? []);
        $page->is_active = $request->is_active ?? true;
        $page->save();

        return redirect()->back()->with('success', 'Contact page updated successfully');
    }
}
