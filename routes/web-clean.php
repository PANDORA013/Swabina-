<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\AdminController;
use App\Http\Controllers\auth\MarketingController;
use App\Http\Controllers\auth\SDMController;
use App\Http\Controllers\Berita\BeritaController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\SocialMedia\SocialLinkController;
use App\Http\Controllers\pedoman\PedomanController;
use App\Http\Controllers\karir\KarirController;
use App\Http\Controllers\landingpage\JejakLangkahController;
use App\Http\Controllers\landingpage\VisiMisiBudayaController;
use App\Http\Controllers\kontakkami\FaqController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TentangkamiController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// ============================================
// SEO ROUTES
// ============================================
Route::get('sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

// ============================================
// LANGUAGE SWITCHER
// ============================================
Route::get('/lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// ============================================
// PUBLIC ROUTES
// ============================================
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/tentang-kami', [TentangkamiController::class, 'index'])->name('tentangkami');
Route::get('/berita', [BeritaController::class, 'publicIndex'])->name('berita.public');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/karir', [KarirController::class, 'index'])->name('karir');

// ============================================
// AUTHENTICATION
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================
// ADMIN ROUTES (Protected by Auth)
// ============================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard per role
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/marketing/dashboard', [MarketingController::class, 'index'])->name('marketing.dashboard');
    Route::get('/sdm/dashboard', [SDMController::class, 'index'])->name('sdm.dashboard');
    
    // Company Info Management
    Route::prefix('company-info')->name('admin.company-info.')->group(function () {
        Route::get('/', [CompanyInfoController::class, 'index'])->name('index');
        Route::put('/update', [CompanyInfoController::class, 'update'])->name('update');
        Route::post('/upload-logo', [CompanyInfoController::class, 'uploadLogo'])->name('upload-logo');
        Route::post('/upload-iso-logo', [CompanyInfoController::class, 'uploadISOLogo'])->name('upload-iso-logo');
        Route::delete('/delete-iso-logo/{number}', [CompanyInfoController::class, 'deleteISOLogo'])->name('delete-iso-logo');
    });
    
    // Social Media Links
    Route::prefix('admin/social-media')->name('admin.sosmed.')->group(function () {
        Route::get('/', [SocialLinkController::class, 'index'])->name('index');
        Route::post('/store', [SocialLinkController::class, 'store'])->name('store');
        Route::put('/update/{id}', [SocialLinkController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SocialLinkController::class, 'destroy'])->name('destroy');
    });
    
    // Berita/News Management
    Route::prefix('admin/berita')->name('admin.berita.')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::get('/create', [BeritaController::class, 'create'])->name('create');
        Route::post('/store', [BeritaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BeritaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BeritaController::class, 'destroy'])->name('destroy');
    });
    
    // FAQ Management
    Route::prefix('admin/faq')->name('admin.faq.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::post('/store', [FaqController::class, 'store'])->name('store');
        Route::put('/update/{id}', [FaqController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [FaqController::class, 'destroy'])->name('destroy');
    });
    
    // Pedoman/Guidelines Management
    Route::prefix('admin/pedoman')->name('admin.pedoman.')->group(function () {
        Route::get('/', [PedomanController::class, 'index'])->name('index');
        Route::post('/store', [PedomanController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [PedomanController::class, 'destroy'])->name('destroy');
    });
    
    // Jejak Langkah (Company Milestones)
    Route::prefix('admin/jejak-langkah')->name('admin.jejak.')->group(function () {
        Route::get('/', [JejakLangkahController::class, 'index'])->name('index');
        Route::post('/store', [JejakLangkahController::class, 'store'])->name('store');
        Route::put('/update/{id}', [JejakLangkahController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [JejakLangkahController::class, 'destroy'])->name('destroy');
    });
    
    // Visi Misi Budaya
    Route::prefix('admin/visi-misi')->name('admin.visi.')->group(function () {
        Route::get('/', [VisiMisiBudayaController::class, 'index'])->name('index');
        Route::put('/update', [VisiMisiBudayaController::class, 'update'])->name('update');
    });
});

// ============================================
// FALLBACK ROUTE (404)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
