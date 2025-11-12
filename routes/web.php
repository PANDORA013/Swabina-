<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\AdminController;
use App\Http\Controllers\Berita\BeritaController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\SocialMedia\SocialLinkController;
use App\Http\Controllers\pedoman\PedomanController;
use App\Http\Controllers\landingpage\JejakLangkahController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\KontakkamiController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// ============================================
// SEO ROUTES
// ============================================
Route::get('sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

// ============================================
// PUBLIC ROUTES
// ============================================

// Home
Route::get('/', [LandingPageController::class, 'index'])->name('beranda');

// News/Berita (Public)
Route::get('/berita', [BeritaController::class, 'publicIndex'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// FAQ
Route::get('/faq', function () {
    $faqs = \App\Models\Faq::orderBy('created_at', 'desc')->get();
    return view('kontakkami.faq-professional', compact('faqs'));
})->name('faq');

// About Us - Tentang Kami
Route::get('/tentang-kami', [LandingPageController::class, 'tentangkami'])->name('tentangkami');
Route::get('/sekilas', [LandingPageController::class, 'sekilas'])->name('sekilas');
Route::get('/jejak-langkah', [LandingPageController::class, 'jejaklangkah'])->name('jejaklangkah');
Route::get('/mengapa-memilih-kami', [LandingPageController::class, 'memilihkami'])->name('memilihkami');
Route::get('/sertifikat-penghargaan', [LandingPageController::class, 'sertifikatpenghargaan'])->name('sertif');

// Services - Layanan
Route::get('/layanan/swa-academy', [LandingPageController::class, 'layananss'])->name('swaacademy');
Route::get('/layanan/facility-management', [LandingPageController::class, 'layananfm'])->name('facility-management');
Route::get('/layanan/digital-solution', [LandingPageController::class, 'layananteknologi'])->name('digitalsolution');
Route::get('/layanan/tour-organizer', [LandingPageController::class, 'layanandownstream'])->name('swatour');
Route::get('/swasegar', [LandingPageController::class, 'swasegar'])->name('swasegar');

// Other Pages
Route::get('/kontak', [KontakkamiController::class, 'index'])->name('kontakkami');
Route::post('/kontak/kirim-pesan', [KontakkamiController::class, 'submitPesan'])->name('kirim-pesan.store');
Route::get('/kebijakan-pedoman', [LandingPageController::class, 'kebijakandanpedoman'])->name('kebijakandanpedoman');
Route::get('/karir', [LandingPageController::class, 'karir'])->name('karir');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

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
    
    // Dashboard 
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
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
        Route::put('/update/{id}', [PedomanController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PedomanController::class, 'destroy'])->name('destroy');
    });
    
    // Jejak Langkah (Company Milestones)
    Route::prefix('admin/jejak-langkah')->name('admin.jejak.')->group(function () {
        Route::get('/', [JejakLangkahController::class, 'index'])->name('index');
        Route::post('/store', [JejakLangkahController::class, 'store'])->name('store');
        Route::put('/update/{id}', [JejakLangkahController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [JejakLangkahController::class, 'destroy'])->name('destroy');
    });
    
    // Why Choose Us (Mengapa Memilih Kami)
    Route::prefix('admin/why-choose-us')->name('admin.why-choose-us.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'store'])->name('store');
        Route::get('/edit/{whyChooseUs}', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'edit'])->name('edit');
        Route::put('/update/{whyChooseUs}', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'update'])->name('update');
        Route::delete('/delete/{whyChooseUs}', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'destroy'])->name('destroy');
        Route::post('/reorder', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'reorder'])->name('reorder');
    });
});

// ============================================
// FALLBACK ROUTE (404)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
