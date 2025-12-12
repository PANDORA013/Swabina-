<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\SocialLink;

class ShareSocialLinks
{
    public function handle(Request $request, Closure $next)
    {
        if (Schema::hasTable('social_links')) {
            $social_links = SocialLink::where('is_active', true)->get();
            View::share('global_social_links', $social_links);
        }

        return $next($request);
    }
}