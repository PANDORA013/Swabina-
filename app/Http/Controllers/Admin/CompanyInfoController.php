<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyInfoController extends Controller
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

        $companyInfo = CompanyInfo::first() ?? new CompanyInfo();
        $layout = $user->role === 'admin' ? 'layouts.app' : 'layouts.app-professional';
        return view('admin.company-info.index', compact('companyInfo', 'layout'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            abort(403, 'Unauthorized. Permission "manage-settings" required.');
        }

        $companyInfo = CompanyInfo::first() ?? new CompanyInfo();
        $companyInfo->update($request->all());

        return redirect()->back()->with('success', 'Company info updated successfully');
    }

    public function uploadLogo(Request $request)
    {
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            abort(403, 'Unauthorized. Permission "manage-settings" required.');
        }

        $request->validate(['logo' => 'required|image|max:2048']);
        
        $companyInfo = CompanyInfo::first() ?? new CompanyInfo();
        
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company', 'public');
            $companyInfo->company_logo = $path;
            $companyInfo->save();
        }

        return redirect()->back()->with('success', 'Logo uploaded successfully');
    }

    public function uploadISOLogo(Request $request)
    {
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            abort(403, 'Unauthorized. Permission "manage-settings" required.');
        }

        $request->validate(['iso_logo' => 'required|image|max:2048', 'number' => 'required|in:1,2,3,4']);
        
        $companyInfo = CompanyInfo::first() ?? new CompanyInfo();
        
        if ($request->hasFile('iso_logo')) {
            $path = $request->file('iso_logo')->store('company/iso', 'public');
            $column = 'iso_logo_' . $request->number;
            $companyInfo->$column = $path;
            $companyInfo->save();
        }

        return redirect()->back()->with('success', 'ISO logo uploaded successfully');
    }

    public function deleteISOLogo($number)
    {
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            abort(403, 'Unauthorized. Permission "manage-settings" required.');
        }

        $companyInfo = CompanyInfo::first();
        if ($companyInfo) {
            $column = 'iso_logo_' . $number;
            $companyInfo->$column = null;
            $companyInfo->save();
        }

        return redirect()->back()->with('success', 'ISO logo deleted successfully');
    }
}
