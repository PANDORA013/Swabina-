<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectLanguage
{
    /**
     * Deteksi bahasa dari Accept-Language header perangkat user
     * dan set ke session
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get Accept-Language header dari browser
        $acceptLanguage = $request->header('Accept-Language', 'id');
        
        // Parse bahasa dari header (format: en-US,en;q=0.9,id;q=0.8)
        $languages = $this->parseLanguage($acceptLanguage);
        
        // Tentukan bahasa yang digunakan (default: id - Indonesia)
        $locale = 'id'; // Default Indonesia
        
        foreach ($languages as $lang => $weight) {
            // Cek apakah bahasa dimulai dengan 'en' untuk English
            if (strpos($lang, 'en') === 0) {
                $locale = 'en';
                break;
            }
            // Cek apakah bahasa adalah 'id' untuk Indonesia
            if (strpos($lang, 'id') === 0) {
                $locale = 'id';
                break;
            }
        }
        
        // Set bahasa ke session jika belum ada
        if (!$request->session()->has('locale')) {
            $request->session()->put('locale', $locale);
        }
        
        // Set bahasa ke config Laravel
        app()->setLocale($request->session()->get('locale', $locale));
        
        return $next($request);
    }
    
    /**
     * Parse Accept-Language header dan return array sorted by quality
     * Format: en-US,en;q=0.9,id;q=0.8
     * Return: ['en-us' => 1.0, 'en' => 0.9, 'id' => 0.8]
     */
    private function parseLanguage(string $header): array
    {
        $languages = [];
        
        $parts = explode(',', $header);
        
        foreach ($parts as $part) {
            $part = trim($part);
            
            // Split bahasa dan weight
            if (strpos($part, ';') !== false) {
                [$lang, $weight] = explode(';', $part, 2);
                $lang = trim($lang);
                // Extract q value dari "q=0.9"
                $weight = (float)str_replace('q=', '', trim($weight));
            } else {
                $lang = trim($part);
                $weight = 1.0; // Default weight untuk bahasa pertama
            }
            
            $languages[strtolower($lang)] = $weight;
        }
        
        // Sort by weight (descending)
        arsort($languages);
        
        return $languages;
    }
}
