<?php

/**
 * Helper untuk mengelola multi-bahasa
 */

if (!function_exists('getLocalizedContent')) {
    /**
     * Dapatkan bahasa saat ini dari session atau config
     * 
     * @return string 'id' atau 'en'
     */
    function getCurrentLanguage(): string
    {
        return session('locale', app()->getLocale());
    }
}

if (!function_exists('translateContent')) {
    /**
     * Ambil konten dari array bilingual
     * 
     * @param array $content Array dengan key 'id' dan 'en'
     * @param string|null $language Bahasa (default: current language)
     * @return string
     */
    function translateContent(array $content, ?string $language = null): string
    {
        $lang = $language ?? getCurrentLanguage();
        
        // Pastikan bahasa valid
        if (!in_array($lang, ['id', 'en'])) {
            $lang = 'id'; // Default ke Indonesia
        }
        
        // Return konten sesuai bahasa, fallback ke bahasa default
        return $content[$lang] ?? $content['id'] ?? '';
    }
}

if (!function_exists('isLanguage')) {
    /**
     * Check apakah current language sesuai dengan parameter
     * 
     * @param string $lang Bahasa yang di-check ('id' atau 'en')
     * @return bool
     */
    function isLanguage(string $lang): bool
    {
        return getCurrentLanguage() === $lang;
    }
}

if (!function_exists('setLanguage')) {
    /**
     * Set bahasa untuk session
     * 
     * @param string $lang Bahasa ('id' atau 'en')
     * @return void
     */
    function setLanguage(string $lang): void
    {
        if (in_array($lang, ['id', 'en'])) {
            session(['locale' => $lang]);
            app()->setLocale($lang);
        }
    }
}

if (!function_exists('getLanguageFlag')) {
    /**
     * Dapatkan flag emoji atau icon untuk bahasa
     * 
     * @param string|null $lang Bahasa (default: current)
     * @return string
     */
    function getLanguageFlag(?string $lang = null): string
    {
        $language = $lang ?? getCurrentLanguage();
        
        return match($language) {
            'en' => '🇺🇸',
            'id' => '🇮🇩',
            default => '🌐'
        };
    }
}

if (!function_exists('getLanguageName')) {
    /**
     * Dapatkan nama bahasa dalam bahasa tersebut
     * 
     * @param string|null $lang Bahasa (default: current)
     * @return string
     */
    function getLanguageName(?string $lang = null): string
    {
        $language = $lang ?? getCurrentLanguage();
        
        return match($language) {
            'en' => 'English',
            'id' => 'Bahasa Indonesia',
            default => 'Unknown'
        };
    }
}
