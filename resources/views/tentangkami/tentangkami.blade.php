<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Public\LandingPageController;
use App\Http\Controllers\Public\SeoController;
use App\Http\Controllers\Public\SearchController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Public\AboutController as PublicAboutController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\SocialMedia\SocialLinkController;
use App\Http\Controllers\About\AboutController as AdminAboutController;
use App\Http\Controllers\About\JejakLangkahController;
use App\Http\Controllers\About\VisionMissionController;
use App\Http\Controllers\Career\CareerController;
use App\Http\Controllers\Admin\PedomanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================================================
// PUBLIC ROUTES (Frontend - Bebas Akses)
// ====================================================

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/sitemap', [SeoController::class, 'sitemap'])->name('sitemap');

// Berita Publik
Route::get('/berita', [NewsController::class, 'publicIndex'])->name('berita.index');
Route::get('/berita/{slug}', [NewsController::class, 'detail'])->name('berita.detail');

// Tentang Kami (Consolidated Page)
// Rute ini mengatasi error "Route [sekilas] not defined"
Route::controller(PublicAboutController::class)->group(function () {
    Route::get('/tentang-kami', 'index')->name('tentang-kami');
    
    // Alias route agar navbar tidak error
    Route::get('/tentang-kami#sekilas', 'index')->name('sekilas');
    Route::get('/tentang-kami#jejaklangkah', 'index')->name('jejaklangkah');
    Route::get('/tentang-kami#sertif', 'index')->name('sertif');
    Route::get('/tentang-kami#memilihkami', 'index')->name('memilihkami');
});

// Layanan Publik
// Route khusus Swasegar AMDK (hardcoded slug)
Route::get('/layanan/swasegar-amdk', [LayananController::class, 'showSwasegar'])->name('swasegar');
// Route dinamis untuk layanan lain
Route::get('/layanan/{slug}', [LayananController::class, 'showPublic'])->name('layanan.show');


// ====================================================
// AUTH ROUTES
// ====================================================
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// ====================================================
// ADMIN ROUTES (Backend - Wajib Login)
// ====================================================
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'check.admin.privilege'], 'as' => 'admin.'], function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Content Modules
    Route::resource('berita', NewsController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('pedoman', PedomanController::class);
    
    // Perbaikan parameter resource agar sesuai view
    Route::resource('jejak', JejakLangkahController::class)->parameters(['jejak' => 'jejak_langkah']);
    Route::resource('sekilas', AdminAboutController::class)->parameters(['sekilas' => 'sekilas_perusahaan']);
    
    Route::resource('why-choose-us', WhyChooseUsController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::resource('contact-page', ContactPageController::class);
    Route::resource('layanan', LayananController::class);
    
    // System Modules
    Route::resource('admin-management', AdminManagementController::class);
    Route::get('admin-management/{id}/privileges', [AdminManagementController::class, 'privileges'])->name('admin-management.privileges');
    Route::put('admin-management/{id}/privileges', [AdminManagementController::class, 'updatePrivileges'])->name('admin-management.update_privileges');

    Route::resource('company-info', CompanyInfoController::class);
    Route::resource('social-media', SocialLinkController::class);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('visi-misi', VisionMissionController::class);
    Route::resource('career', CareerController::class);
});

// Fallback Route
Route::fallback(function () {
    return view('errors.404');
});<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Public\LandingPageController;
use App\Http\Controllers\Public\SeoController;
use App\Http\Controllers\Public\SearchController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Public\AboutController as PublicAboutController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\SocialMedia\SocialLinkController;
use App\Http\Controllers\About\AboutController as AdminAboutController;
use App\Http\Controllers\About\JejakLangkahController;
use App\Http\Controllers\About\VisionMissionController;
use App\Http\Controllers\Career\CareerController;
use App\Http\Controllers\Admin\PedomanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================================================
// PUBLIC ROUTES (Frontend - Bebas Akses)
// ====================================================

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/sitemap', [SeoController::class, 'sitemap'])->name('sitemap');

// Berita Publik
Route::get('/berita', [NewsController::class, 'publicIndex'])->name('berita.index');
Route::get('/berita/{slug}', [NewsController::class, 'detail'])->name('berita.detail');

// Tentang Kami (Consolidated Page)
// Rute ini mengatasi error "Route [sekilas] not defined"
Route::controller(PublicAboutController::class)->group(function () {
    Route::get('/tentang-kami', 'index')->name('tentang-kami');
    
    // Alias route agar navbar tidak error
    Route::get('/tentang-kami#sekilas', 'index')->name('sekilas');
    Route::get('/tentang-kami#jejaklangkah', 'index')->name('jejaklangkah');
    Route::get('/tentang-kami#sertif', 'index')->name('sertif');
    Route::get('/tentang-kami#memilihkami', 'index')->name('memilihkami');
});

// Layanan Publik
// Route khusus Swasegar AMDK (hardcoded slug)
Route::get('/layanan/swasegar-amdk', [LayananController::class, 'showSwasegar'])->name('swasegar');
// Route dinamis untuk layanan lain
Route::get('/layanan/{slug}', [LayananController::class, 'showPublic'])->name('layanan.show');


// ====================================================
// AUTH ROUTES
// ====================================================
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// ====================================================
// ADMIN ROUTES (Backend - Wajib Login)
// ====================================================
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'check.admin.privilege'], 'as' => 'admin.'], function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Content Modules
    Route::resource('berita', NewsController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('pedoman', PedomanController::class);
    
    // Perbaikan parameter resource agar sesuai view
    Route::resource('jejak', JejakLangkahController::class)->parameters(['jejak' => 'jejak_langkah']);
    Route::resource('sekilas', AdminAboutController::class)->parameters(['sekilas' => 'sekilas_perusahaan']);
    
    Route::resource('why-choose-us', WhyChooseUsController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::resource('contact-page', ContactPageController::class);
    Route::resource('layanan', LayananController::class);
    
    // System Modules
    Route::resource('admin-management', AdminManagementController::class);
    Route::get('admin-management/{id}/privileges', [AdminManagementController::class, 'privileges'])->name('admin-management.privileges');
    Route::put('admin-management/{id}/privileges', [AdminManagementController::class, 'updatePrivileges'])->name('admin-management.update_privileges');

    Route::resource('company-info', CompanyInfoController::class);
    Route::resource('social-media', SocialLinkController::class);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('visi-misi', VisionMissionController::class);
    Route::resource('career', CareerController::class);
});

// Fallback Route
Route::fallback(function () {
    return view('errors.404');
});@extends('layouts.app-professional')

@section('title', 'Tentang Kami | PT Swabina Gatra')

@section('content')

{{-- Hero Section --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold display-5 mb-4">Tentang Kami</h1>
                <p class="lead text-muted mb-4">Mengenal lebih dekat PT Swabina Gatra, sejarah perjalanan, dan komitmen kami.</p>
            </div>
            <div class="col-lg-6">
                {{-- Breadcrumb jika ada --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

{{-- ID Anchor untuk navigasi scroll --}}
<div id="sekilas"></div>

{{-- SECTION 1: Sekilas Perusahaan --}}
@if($sekilas)
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                @if($sekilas->image)
                    <img src="{{ asset('assets/gambar_sekilas/' . $sekilas->image) }}" alt="Sekilas Perusahaan" class="img-fluid rounded shadow-lg w-100" loading="lazy">
                @else
                    <img src="https://via.placeholder.com/600x400?text=Company+Overview" alt="Placeholder" class="img-fluid rounded shadow">
                @endif
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">{{ $sekilas->title }}</h2>
                <div class="text-muted">
                    {!! $sekilas->description !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<div id="memilihkami"></div>
{{-- SECTION 2: Mengapa Memilih Kami --}}
@if($whyChooseUs->count() > 0)
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Memilih Kami?</h2>
        </div>
        <div class="row g-4">
            @foreach($whyChooseUs as $item)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3 text-primary">
                        @if($item->icon)
                             {{-- Jika pakai image icon --}}
                             <img src="{{ asset('assets/icons/' . $item->icon) }}" style="height: 50px;" alt="Icon">
                        @else
                             <i class="bi bi-check-circle fs-1"></i>
                        @endif
                    </div>
                    <h4 class="card-title fw-bold">{{ $item->title }}</h4>
                    <p class="card-text text-muted">{{ $item->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<div id="jejaklangkah"></div>
{{-- SECTION 3: Jejak Langkah (Timeline) --}}
@if($jejakLangkahs->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Jejak Langkah</h2>
            <p class="text-muted">Perjalanan kami dari masa ke masa</p>
        </div>
        <div class="timeline">
            @foreach($jejakLangkahs as $jejak)
            <div class="row mb-4 border-bottom pb-4">
                <div class="col-md-2 text-center">
                    <div class="h2 fw-bold text-primary">{{ $jejak->year }}</div>
                </div>
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    @if($jejak->image)
                        <img src="{{ asset('assets/gambar_jejak/' . $jejak->image) }}" class="img-fluid rounded" style="max-height: 150px;" loading="lazy" alt="Jejak {{ $jejak->year }}">
                    @endif
                </div>
                <div class="col-md-7">
                    <p class="mb-0">{{ $jejak->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<div id="sertif"></div>
{{-- SECTION 4: Sertifikat --}}
@if($sertifikats->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Sertifikat & Penghargaan</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($sertifikats as $sertif)
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        @if($sertif->image)
                            <img src="{{ asset('assets/gambar_sertifikat/' . $sertif->image) }}" class="img-fluid mb-3" style="max-height: 120px;" loading="lazy" alt="{{ $sertif->title }}">
                        @endif
                        <h6 class="card-title fw-semibold small">{{ $sertif->title }}</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
