<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SocialLink;
use App\Services\SettingService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register SettingService as singleton
        $this->app->singleton(SettingService::class, function ($app) {
            return new SettingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['partial.footer', 'partial-eng.footer-eng'], function ($view) {
            try {
                $social = SocialLink::select('facebook', 'youtube', 'instagram')
                    ->firstOrCreate(['id' => 1]);
                $view->with('social', $social);
            } catch (\Exception $e) {
                // Fallback jika database error
                $view->with('social', new SocialLink());
            }
        });

        // Register Blade directives for lazy loading
        Blade::directive('lazyload', function ($expression) {
            return "<?php echo 'loading=\"lazy\" decoding=\"async\"'; ?>";
        });

        // Register optimized image component
        Blade::component('optimized-image', \App\View\Components\OptimizedImage::class);
    }
}
