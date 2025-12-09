<?php

namespace App\Helpers;

class LanguageHelper
{
    public static function current()
    {
        return 'id';
    }

    public static function getLocale()
    {
        return 'id';
    }
}

if (!function_exists('getCurrentLanguage')) {
    function getCurrentLanguage(): string
    {
        return 'id';
    }
}

if (!function_exists('translateContent')) {
    function translateContent(array $content, ?string $language = null): string
    {
        return $content['id'] ?? '';
    }
}

if (!function_exists('isLanguage')) {
    function isLanguage(string $lang): bool
    {
        return $lang === 'id';
    }
}

if (!function_exists('setLanguage')) {
    function setLanguage(string $lang): void
    {
        // No-op
    }
}

if (!function_exists('getLanguageFlag')) {
    function getLanguageFlag(?string $lang = null): string
    {
        return '🇩';
    }
}

if (!function_exists('getLanguageName')) {
    function getLanguageName(?string $lang = null): string
    {
        return 'Bahasa Indonesia';
    }
}
