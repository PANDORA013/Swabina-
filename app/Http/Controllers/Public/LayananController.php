<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\LayananPage;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of all services
     */
    public function index()
    {
        $companyInfo = CompanyInfo::first();
        $services = LayananPage::getActive();
        
        return view('layanan.index', compact('companyInfo', 'services'));
    }

    /**
     * Display the specified service by slug (Dynamic)
     */
    public function show($slug)
    {
        $companyInfo = CompanyInfo::first();
        $service = LayananPage::findBySlug($slug);
        
        // Get related services (for "Other Services" section)
        $relatedServices = LayananPage::where('is_active', true)
            ->where('slug', '!=', $slug)
            ->orderBy('order')
            ->limit(3)
            ->get();
        
        return view('layanan.show', compact('companyInfo', 'service', 'relatedServices'));
    }
}
