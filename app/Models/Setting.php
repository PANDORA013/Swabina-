<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];

    /**
     * Get setting by key
     */
    public static function get($key, $default = null)
    {
        $setting = self::find($key);
        return $setting ? $setting->value : $default;
    }

    /**
     * Set setting by key
     */
    public static function set($key, $value)
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => is_array($value) ? $value : json_encode($value)]
        );
    }

    /**
     * Get company info
     */
    public static function getCompanyInfo()
    {
        return self::get('company_info', []);
    }

    /**
     * Get social links
     */
    public static function getSocialLinks()
    {
        return self::get('social_links', []);
    }

    /**
     * Get jejak langkahs
     */
    public static function getJejakLangkahs()
    {
        return self::get('jejak_langkahs', []);
    }

    /**
     * Set company info
     */
    public static function setCompanyInfo($data)
    {
        return self::set('company_info', $data);
    }

    /**
     * Set social links
     */
    public static function setSocialLinks($data)
    {
        return self::set('social_links', $data);
    }

    /**
     * Set jejak langkahs
     */
    public static function setJejakLangkahs($data)
    {
        return self::set('jejak_langkahs', $data);
    }
}
