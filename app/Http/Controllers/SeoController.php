<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SeoController extends Controller
{
    /**
     * Generate sitemap.xml for SEO
     */
    public function sitemap()
    {
        // Get all your routes/pages that should be in sitemap
        $urls = [
            [
                'url' => route('beranda'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ],
            [
                'url' => route('tentang-kami'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'url' => route('produk-layanan'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('facility-management'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('swasegar'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('digital-solution'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('tour-event'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('academy'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('memilih-kami'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'url' => route('kontak-kami'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ],
            [
                'url' => route('karir'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.6'
            ],
            [
                'url' => route('kebijakan-pedoman'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'yearly',
                'priority' => '0.3'
            ],
        ];

        // Add English versions if available
        $englishUrls = [
            [
                'url' => route('beranda-eng'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ],
            // Add other English routes...
        ];

        $urls = array_merge($urls, $englishUrls);

        $sitemap = view('seo.sitemap', compact('urls'))->render();

        return Response::make($sitemap, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    /**
     * Generate robots.txt for SEO
     */
    public function robots()
    {
        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /login\n";
        $robots .= "Disallow: /storage/\n";
        $robots .= "Disallow: /*.json$\n";
        $robots .= "\n";
        $robots .= "Sitemap: " . route('sitemap') . "\n";

        return Response::make($robots, 200, [
            'Content-Type' => 'text/plain'
        ]);
    }

    /**
     * Handle 404 errors with SEO-friendly page
     */
    public function notFound()
    {
        return response()->view('errors.404', [], 404);
    }
}
