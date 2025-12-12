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
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard (Accessible to all authenticated admins)
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // 1. Module Berita/News (Requires: manage_news)
    Route::middleware(['check.privilege:manage_news'])->group(function () {
        Route::resource('berita', NewsController::class, [
            'names' => [
                'index' => 'berita.index',
                'create' => 'berita.create',
                'store' => 'berita.store',
                'show' => 'berita.show',
                'edit' => 'berita.edit',
                'update' => 'berita.update',
                'destroy' => 'berita.destroy',
            ]
        ]);
    });

    // 2. Module FAQ (Requires: manage_faq)
    Route::middleware(['check.privilege:manage_faq'])->group(function () {
        Route::resource('faq', FaqController::class);
    });

    // 3. Module Layanan (Requires: manage_services)
    Route::middleware(['check.privilege:manage_services'])->group(function () {
        Route::resource('layanan', LayananController::class, [
            'parameters' => ['layanan' => 'slug']
        ]);
        Route::put('layanan/{slug}/status', [LayananController::class, 'updateStatus'])->name('layanan.updateStatus');
    });

    // 4. Module Sertifikat & Penghargaan (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])->group(function () {
        Route::resource('sertifikat', SertifikatController::class);
    });

    // 5. Module Why Choose Us (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])->group(function () {
        Route::resource('why-choose-us', WhyChooseUsController::class);
    });

    // 6. Module Pedoman/Guidelines (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])->group(function () {
        Route::resource('pedoman', PedomanController::class);
    });

    // 7. Module Sekilas Perusahaan (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])->group(function () {
        Route::resource('sekilas', SekilasPerusahaanController::class);
    });

    // 8. Module Jejak Langkah (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])->group(function () {
        Route::resource('jejak', JejakLangkahController::class);
    });

    // 9. Module Company Info (Requires: manage_company_info)
    Route::middleware(['check.privilege:manage_company_info'])->prefix('company-info')->name('company-info.')->group(function () {
        Route::get('/', [CompanyInfoController::class, 'index'])->name('index');
        Route::post('/store', [CompanyInfoController::class, 'store'])->name('store');
        Route::get('/create', [CompanyInfoController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [CompanyInfoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CompanyInfoController::class, 'update'])->name('update');
    });

    // 10. Module Contact Page (Requires: manage_settings)
    Route::middleware(['check.privilege:manage_settings'])->prefix('contact-page')->name('contact-page.')->group(function () {
        Route::get('/', [ContactPageController::class, 'index'])->name('index');
        Route::get('/create', [ContactPageController::class, 'create'])->name('create');
        Route::post('/', [ContactPageController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ContactPageController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ContactPageController::class, 'update'])->name('update');
        Route::delete('/{id}', [ContactPageController::class, 'destroy'])->name('destroy');
    });

    // 11. Module Social Media Links (Requires: manage_settings)
    Route::middleware(['check.privilege:manage_settings'])->prefix('social-media')->name('social-media.')->group(function () {
        Route::get('/', [SocialLinkController::class, 'index'])->name('index');
        Route::get('/create', [SocialLinkController::class, 'create'])->name('create');
        Route::post('/', [SocialLinkController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SocialLinkController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SocialLinkController::class, 'update'])->name('update');
        Route::delete('/{id}', [SocialLinkController::class, 'destroy'])->name('destroy');
    });

    // 12. Website Settings (Requires: manage_settings)
    Route::middleware(['check.privilege:manage_settings'])->prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('edit');
        Route::post('/', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('update');
    });

    // 13. Admin Management (Super Admin Only)
    Route::middleware(['super_admin'])->prefix('admin-management')->name('admin-management.')->group(function () {
        Route::get('/', [AdminManagementController::class, 'index'])->name('index');
        Route::get('/create', [AdminManagementController::class, 'create'])->name('create');
        Route::post('/store', [AdminManagementController::class, 'store'])->name('store');
        Route::get('/{admin}/edit', [AdminManagementController::class, 'edit'])->name('edit');
        Route::put('/{admin}', [AdminManagementController::class, 'update'])->name('update');
        Route::delete('/{admin}', [AdminManagementController::class, 'destroy'])->name('destroy');
        Route::get('/{role}/permissions', [AdminManagementController::class, 'getRolePermissions'])->name('get-permissions');
        
        // Privilege Management Routes
        Route::get('/{admin}/privileges', [AdminManagementController::class, 'showPrivileges'])->name('privileges');
        Route::post('/{admin}/privileges', [AdminManagementController::class, 'updatePrivileges'])->name('update-privileges');
        Route::get('/api/permissions', [AdminManagementController::class, 'getAvailablePermissions'])->name('api-permissions');
    });
});

// ============================================
// FALLBACK ROUTE (404)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
