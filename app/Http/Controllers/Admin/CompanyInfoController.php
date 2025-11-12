<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Services\ImageOptimizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CompanyInfoController extends Controller
{
    public function index()
    {
        $companyInfo = CompanyInfo::getInstance();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        
        return view('admin.company-info.index', compact('companyInfo', 'userRole', 'layout'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_tagline' => 'nullable|string',
            'company_description' => 'nullable|string',
            'head_office_address' => 'required|string',
            'head_office_city' => 'required|string|max:100',
            'head_office_province' => 'required|string|max:100',
            'head_office_postal_code' => 'required|string|max:10',
            'email_primary' => 'required|email',
            'email_secondary' => 'nullable|email',
            'phone_primary' => 'required|string|max:20',
            'phone_secondary' => 'nullable|string|max:20',
            'branch_phone_primary' => 'nullable|string|max:20',
            'branch_phone_secondary' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $companyInfo = CompanyInfo::getInstance();
        
        // Update basic info
        $companyInfo->update([
            'company_name' => $request->company_name,
            'company_tagline' => $request->company_tagline,
            'company_description' => $request->company_description,
            'head_office_address' => $request->head_office_address,
            'head_office_city' => $request->head_office_city,
            'head_office_province' => $request->head_office_province,
            'head_office_postal_code' => $request->head_office_postal_code,
            'branch_office_address' => $request->branch_office_address,
            'branch_office_city' => $request->branch_office_city,
            'branch_office_province' => $request->branch_office_province,
            'branch_office_postal_code' => $request->branch_office_postal_code,
            'email_primary' => $request->email_primary,
            'email_secondary' => $request->email_secondary,
            'phone_primary' => $request->phone_primary,
            'phone_secondary' => $request->phone_secondary,
            'branch_phone_primary' => $request->branch_phone_primary,
            'branch_phone_secondary' => $request->branch_phone_secondary,
        ]);

        // Update operating hours if provided
        if ($request->filled('operating_hours_weekday_days')) {
            $companyInfo->update([
                'operating_hours_weekday' => [
                    'days' => $request->operating_hours_weekday_days,
                    'from' => $request->operating_hours_weekday_from,
                    'to' => $request->operating_hours_weekday_to,
                    'timezone' => $request->operating_hours_weekday_timezone ?? 'WIB'
                ]
            ]);
        }

        if ($request->filled('operating_hours_weekend_days')) {
            $companyInfo->update([
                'operating_hours_weekend' => [
                    'days' => $request->operating_hours_weekend_days,
                    'from' => $request->operating_hours_weekend_from,
                    'to' => $request->operating_hours_weekend_to,
                    'timezone' => $request->operating_hours_weekend_timezone ?? 'WIB'
                ]
            ]);
        }

        return back()->with('success', 'Company information updated successfully!');
    }

    public function uploadLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            $imageService = new ImageOptimizationService();
            $imageData = $imageService->optimize($request->file('company_logo'), 'company');

            $companyInfo = CompanyInfo::getInstance();

            // Delete old logo
            if ($companyInfo->company_logo) {
                $oldFilename = basename($companyInfo->company_logo, '.jpg');
                $imageService->delete($oldFilename, 'company');
            }

            // Save the new filenames (store both jpeg and webp reference)
            $companyInfo->update(['company_logo' => $imageData['filename']]);

            View::clearCache();

            return response()->json([
                'success' => true, 
                'message' => 'Logo uploaded and optimized successfully! Compression: ' . $imageData['compression'] . '%',
                'filename' => $imageData['filename']
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Upload failed: ' . $e->getMessage()], 500);
        }
    }

    public function uploadIsoLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo_number' => 'required|in:1,2,3,4',
            'iso_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            $imageService = new ImageOptimizationService();
            $imageData = $imageService->optimize($request->file('iso_logo'), 'iso_logos');

            $companyInfo = CompanyInfo::getInstance();
            $logoField = 'iso_logo_' . $request->logo_number;

            // Delete old ISO logo
            if ($companyInfo->$logoField) {
                $oldFilename = basename($companyInfo->$logoField, '.jpg');
                $imageService->delete($oldFilename, 'iso_logos');
            }

            $companyInfo->update([$logoField => $imageData['filename']]);

            View::clearCache();

            return response()->json([
                'success' => true, 
                'message' => 'ISO Logo ' . $request->logo_number . ' uploaded and optimized! Compression: ' . $imageData['compression'] . '%',
                'filename' => $imageData['filename']
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Upload failed: ' . $e->getMessage()], 500);
        }
    }
}
