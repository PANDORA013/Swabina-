<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\AdminController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\PedomanController;
use App\Http\Controllers\Admin\SekilasPerusahaanController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\SocialMedia\SocialLinkController;
use App\Http\Controllers\About\JejakLangkahController;
use App\Http\Controllers\Public\LandingPageController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\LayananController as PublicLayananController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Public\SeoController;
use App\Http\Controllers\Public\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

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
Route::get('/berita', [NewsController::class, 'publicIndex'])->name('berita');
Route::get('/berita/{id}', [NewsController::class, 'show'])->name('berita.show');

// FAQ
Route::get('/faq', function () {
    $faqs = \App\Models\Faq::orderBy('created_at', 'desc')->get();
    return view('kontakkami.faq-professional', compact('faqs'));
})->name('faq');

// ============================================
// ABOUT US - Consolidated (NEW Architecture)
// ============================================
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('tentangkami');

// SEO-Friendly Redirects (Old URLs → New Consolidated Page with Anchors)
Route::redirect('/sekilas', '/tentang-kami#sekilas', 301)->name('sekilas');
Route::redirect('/jejak-langkah', '/tentang-kami#jejaklangkah', 301)->name('jejaklangkah');
Route::redirect('/sertifikat-penghargaan', '/tentang-kami#sertif', 301)->name('sertif');
Route::redirect('/mengapa-memilih-kami', '/tentang-kami#memilihkami', 301)->name('memilihkami');

// ============================================
// SERVICES - Dynamic Pages (NEW Architecture)
// ============================================
Route::get('/layanan', [PublicLayananController::class, 'index'])->name('layanan.index');

// SEO-Friendly Redirect for Swasegar (short URL → dynamic page)
Route::redirect('/swasegar', '/layanan/swasegar-amdk', 301)->name('swasegar');

// Dynamic service route (must be last to avoid conflicts)
Route::get('/layanan/{slug}', [PublicLayananController::class, 'show'])->name('layanan.show');

// Other Pages
Route::get('/kontak', [ContactController::class, 'index'])->name('kontakkami');
Route::post('/kontak/kirim-pesan', [ContactController::class, 'submitPesan'])->name('kirim-pesan.store');
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

// --- BLOK 1: SUPER ADMIN ONLY (User Management) ---
Route::middleware(['auth', \App\Http\Middleware\SuperAdminMiddleware::class])
    ->prefix('admin/admin-management')->name('admin.admin-management.')->group(function () {
    
    Route::get('/', [AdminManagementController::class, 'index'])->name('index');
    Route::get('/create', [AdminManagementController::class, 'create'])->name('create');
    Route::post('/store', [AdminManagementController::class, 'store'])->name('store');
    Route::get('/{admin}/edit', [AdminManagementController::class, 'edit'])->name('edit');
    Route::put('/{admin}', [AdminManagementController::class, 'update'])->name('update');
    Route::delete('/{admin}', [AdminManagementController::class, 'destroy'])->name('destroy');
    Route::get('/{admin}/privileges', [AdminManagementController::class, 'showPrivileges'])->name('privileges');
    Route::post('/{admin}/privileges', [AdminManagementController::class, 'updatePrivileges'])->name('update-privileges');
});

// --- BLOK 2: ADMIN CONTENT AREA (Admin + Super Admin) ---
Route::middleware(['auth', \App\Http\Middleware\CheckAdminPrivilege::class])
    ->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Content Modules (CRUD Resources)
    Route::resource('berita', NewsController::class)->names([
        'index' => 'berita.index',
        'create' => 'berita.create',
        'store' => 'berita.store',
        'show' => 'berita.show',
        'edit' => 'berita.edit',
        'update' => 'berita.update',
        'destroy' => 'berita.destroy',
    ]);
    
    Route::resource('faq', FaqController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::resource('why-choose-us', WhyChooseUsController::class);
    Route::resource('pedoman', PedomanController::class);
    Route::resource('sekilas', SekilasPerusahaanController::class);
    Route::resource('jejak', JejakLangkahController::class);
    
    // Layanan (with custom slug parameter)
    Route::resource('layanan', LayananController::class)->parameters(['layanan' => 'slug']);
    Route::put('layanan/{slug}/status', [LayananController::class, 'updateStatus'])->name('layanan.updateStatus');
    
    // --- BLOK 3: ADMIN SETTINGS (Minimal Routes) ---
    
    // Company Info (Only Index & Update - No Create/Delete)
    Route::controller(CompanyInfoController::class)->prefix('company-info')->name('company-info.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
    });
    
    // Contact Page
    Route::controller(ContactPageController::class)->prefix('contact-page')->name('contact-page.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
    
    // Social Media Links
    Route::controller(SocialLinkController::class)->prefix('social-media')->name('social-media.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
    
    // Website Settings (Only Edit & Update)
    Route::controller(\App\Http\Controllers\Admin\SettingController::class)->prefix('settings')->name('settings.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::post('/', 'update')->name('update');
    });
});

// ============================================
// FALLBACK ROUTE (404)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
