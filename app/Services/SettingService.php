<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingService
{
    private $settings;
    private const CACHE_KEY = 'app_settings';
    private const CACHE_DURATION = 86400 * 30; // 30 days

    public function __construct()
    {
        // Ambil semua settings dari cache, ATAU
        // jika tidak ada di cache, ambil dari DB lalu simpan di cache
        $this->settings = Cache::rememberForever(self::CACHE_KEY, function () {
            return DB::table('settings')
                ->get()
                ->keyBy('key') // Jadikan 'key' sebagai index
                ->map(function ($item) {
                    return json_decode($item->value, false); // Decode JSON sebagai object
                });
        });
    }

    /**
     * Get single setting by key
     */
    public function get($key, $default = null)
    {
        return $this->settings->get($key, $default);
    }

    /**
     * Get all settings
     */
    public function all()
    {
        return $this->settings;
    }

    /**
     * Get company profile (visi, misi, budaya)
     */
    public function getCompanyProfile()
    {
        return $this->get('company_profile', (object)[
            'visi' => '',
            'misi' => [],
            'budaya' => ''
        ]);
    }

    /**
     * Get social links
     */
    public function getSocialLinks()
    {
        return $this->get('social_links', (object)[
            'facebook' => '',
            'instagram' => '',
            'linkedin' => '',
            'youtube' => '',
            'whatsapp' => ''
        ]);
    }

    /**
     * Get company contact info
     */
    public function getCompanyContact()
    {
        return $this->get('company_contact', (object)[
            'telepon' => '',
            'email' => '',
            'alamat' => '',
            'jam_operasional' => ''
        ]);
    }

    /**
     * Get why choose us
     */
    public function getWhyChooseUs()
    {
        return $this->get('why_choose_us', []);
    }

    /**
     * Get jejak langkahs (company milestones)
     */
    public function getJejakLangkahs()
    {
        return $this->get('jejak_langkahs', []);
    }

    /**
     * Set/Update setting
     */
    public function set($key, $value)
    {
        $jsonValue = is_array($value) || is_object($value) 
            ? json_encode($value) 
            : $value;

        DB::table('settings')->updateOrCreate(
            ['key' => $key],
            ['value' => $jsonValue, 'updated_at' => now()]
        );

        // Refresh cache
        self::refreshCache();

        return true;
    }

    /**
     * Refresh cache (panggil ini setelah update data)
     */
    public static function refreshCache()
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Clear all cache
     */
    public static function clearCache()
    {
        Cache::forget(self::CACHE_KEY);
    }
}
