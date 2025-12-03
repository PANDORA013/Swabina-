<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\AdminController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\SocialMedia\SocialLinkController;
use App\Http\Controllers\Public\PedomanController;
use App\Http\Controllers\About\JejakLangkahController;
use App\Http\Controllers\Public\LandingPageController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Public\SeoController;
use App\Http\Controllers\Public\SearchController;
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
Route::get('/berita', [NewsController::class, 'publicIndex'])->name('berita');
Route::get('/berita/{id}', [NewsController::class, 'show'])->name('berita.show');

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
Route::middleware(['auth'])->group(function () {
    
    // Dashboard (Accessible to all authenticated admins)
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Company Info Management (Requires: manage_company_info)
    Route::middleware(['check.privilege:manage_company_info'])
         ->prefix('admin/company-info')
         ->name('admin.company-info.')
         ->group(function () {
             Route::get('/', [CompanyInfoController::class, 'index'])->name('index');
             Route::put('/update', [CompanyInfoController::class, 'update'])->name('update');
             Route::post('/upload-logo', [CompanyInfoController::class, 'uploadLogo'])->name('upload-logo');
             Route::post('/upload-iso-logo', [CompanyInfoController::class, 'uploadISOLogo'])->name('upload-iso-logo');
             Route::delete('/delete-iso-logo/{number}', [CompanyInfoController::class, 'deleteISOLogo'])->name('delete-iso-logo');
         });
    
    // Social Media Links (Requires: manage_settings)
    Route::middleware(['check.privilege:manage_settings'])
         ->prefix('admin/social-media')
         ->name('admin.social-media.')
         ->group(function () {
             Route::get('/', [SocialLinkController::class, 'index'])->name('index');
             Route::get('/create', [SocialLinkController::class, 'create'])->name('create');
             Route::post('/', [SocialLinkController::class, 'store'])->name('store');
             Route::get('/{id}/edit', [SocialLinkController::class, 'edit'])->name('edit');
             Route::put('/{id}', [SocialLinkController::class, 'update'])->name('update');
             Route::delete('/{id}', [SocialLinkController::class, 'destroy'])->name('destroy');
         });
    
    // Berita/News Management (Requires: manage_news)
    Route::middleware(['check.privilege:manage_news'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
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
    
    // FAQ Management (Requires: manage_faq)
    Route::middleware(['check.privilege:manage_faq'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::resource('faq', AdminFaqController::class, [
                 'names' => [
                     'index' => 'faq.index',
                     'create' => 'faq.create',
                     'store' => 'faq.store',
                     'show' => 'faq.show',
                     'edit' => 'faq.edit',
                     'update' => 'faq.update',
                     'destroy' => 'faq.destroy',
                 ]
             ]);
         });
    
    // Layanan Pages Management (Requires: manage_services)
    Route::middleware(['check.privilege:manage_services'])
         ->prefix('admin/layanan')
         ->name('admin.layanan.')
         ->group(function () {
             Route::get('/', [\App\Http\Controllers\Admin\LayananController::class, 'index'])->name('index');
             Route::get('/create', [\App\Http\Controllers\Admin\LayananController::class, 'create'])->name('create');
             Route::post('/', [\App\Http\Controllers\Admin\LayananController::class, 'store'])->name('store');
             Route::get('/{slug}/edit', [\App\Http\Controllers\Admin\LayananController::class, 'edit'])->name('edit');
             Route::put('/{slug}', [\App\Http\Controllers\Admin\LayananController::class, 'update'])->name('update');
             Route::put('/{slug}/status', [\App\Http\Controllers\Admin\LayananController::class, 'updateStatus'])->name('updateStatus');
             Route::delete('/{slug}', [\App\Http\Controllers\Admin\LayananController::class, 'destroy'])->name('destroy');
         });
    
    // Pedoman/Guidelines Management (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])
         ->prefix('admin/pedoman')
         ->name('admin.pedoman.')
         ->group(function () {
             Route::get('/', [PedomanController::class, 'index'])->name('index');
             Route::get('/create', [PedomanController::class, 'create'])->name('create');
             Route::post('/', [PedomanController::class, 'store'])->name('store');
             Route::get('/{id}/edit', [PedomanController::class, 'edit'])->name('edit');
             Route::put('/{id}', [PedomanController::class, 'update'])->name('update');
             Route::delete('/{id}', [PedomanController::class, 'destroy'])->name('destroy');
         });
    
    // Jejak Langkah Management (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::resource('jejak-langkah', JejakLangkahController::class, [
                 'names' => [
                     'index' => 'jejak-langkah.index',
                     'create' => 'jejak-langkah.create',
                     'store' => 'jejak-langkah.store',
                     'show' => 'jejak-langkah.show',
                     'edit' => 'jejak-langkah.edit',
                     'update' => 'jejak-langkah.update',
                     'destroy' => 'jejak-langkah.destroy',
                 ]
             ]);
         });
    
    // Why Choose Us Management (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::resource('why-choose-us', WhyChooseUsController::class, [
                 'names' => [
                     'index' => 'why-choose-us.index',
                     'create' => 'why-choose-us.create',
                     'store' => 'why-choose-us.store',
                     'show' => 'why-choose-us.show',
                     'edit' => 'why-choose-us.edit',
                     'update' => 'why-choose-us.update',
                     'destroy' => 'why-choose-us.destroy',
                 ]
             ]);
         });
    
    // Sekilas Perusahaan Management (Requires: manage_company_info)
    Route::middleware(['check.privilege:manage_company_info'])
         ->prefix('admin/sekilas')
         ->name('admin.sekilas.')
         ->group(function () {
             Route::get('/', [PedomanController::class, 'index'])->name('index');
             Route::get('/create', [PedomanController::class, 'create'])->name('create');
             Route::post('/', [PedomanController::class, 'store'])->name('store');
             Route::get('/{id}/edit', [PedomanController::class, 'edit'])->name('edit');
             Route::put('/{id}', [PedomanController::class, 'update'])->name('update');
             Route::delete('/{id}', [PedomanController::class, 'destroy'])->name('destroy');
         });
    
    // Contact Page Management (Requires: manage_settings)
    Route::middleware(['check.privilege:manage_settings'])
         ->prefix('admin/contact-page')
         ->name('admin.contact-page.')
         ->group(function () {
             Route::get('/', [\App\Http\Controllers\Admin\ContactPageController::class, 'index'])->name('index');
             Route::get('/create', [\App\Http\Controllers\Admin\ContactPageController::class, 'create'])->name('create');
             Route::post('/', [\App\Http\Controllers\Admin\ContactPageController::class, 'store'])->name('store');
             Route::get('/{id}/edit', [\App\Http\Controllers\Admin\ContactPageController::class, 'edit'])->name('edit');
             Route::put('/{id}', [\App\Http\Controllers\Admin\ContactPageController::class, 'update'])->name('update');
             Route::delete('/{id}', [\App\Http\Controllers\Admin\ContactPageController::class, 'destroy'])->name('destroy');
         });
    
    // Sertifikat & Penghargaan Management (Requires: manage_content)
    Route::middleware(['check.privilege:manage_content'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::resource('sertifikat', \App\Http\Controllers\Admin\SertifikatController::class, [
                 'names' => [
                     'index' => 'sertifikat.index',
                     'create' => 'sertifikat.create',
                     'store' => 'sertifikat.store',
                     'show' => 'sertifikat.show',
                     'edit' => 'sertifikat.edit',
                     'update' => 'sertifikat.update',
                     'destroy' => 'sertifikat.destroy',
                 ]
             ]);
         });

    // Website Settings Management (Requires: manage_settings)
    Route::middleware(['check.privilege:manage_settings'])
         ->prefix('admin/settings')
         ->name('admin.settings.')
         ->group(function () {
             Route::get('/', [\App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('edit');
             Route::post('/', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('update');
         });

    // Admin Management (Super Admin Only)
    Route::middleware(['super_admin'])->group(function () {
        Route::prefix('admin/admin-management')->name('admin.admin-management.')->group(function () {
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
});

// ============================================
// FALLBACK ROUTE (404)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
