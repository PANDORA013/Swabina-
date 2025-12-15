<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananPage extends Model
{
    use HasFactory;

    protected $table = 'layanan_pages';

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'description',
        'icon',
        'image',
        'features',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'features' => 'array',
        'order' => 'integer'
    ];

    /**
     * FIX: Accessor untuk memastikan features selalu me-return Array.
     * Mencegah error "foreach() argument must be of type array, string given".
     */
    public function getFeaturesAttribute($value)
    {
        // 1. Jika value null, kembalikan array kosong
        if (is_null($value)) {
            return [];
        }

        // 2. Jika value sudah berupa array (hasil casting Laravel), kembalikan langsung
        if (is_array($value)) {
            return $value;
        }

        // 3. Jika value adalah string
        if (is_string($value)) {
            // Coba decode sebagai JSON
            $decoded = json_decode($value, true);
            
            // Jika valid JSON array, pakai itu. 
            // Jika tidak (teks biasa), bungkus teks tersebut dalam array.
            return (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) 
                ? $decoded 
                : [$value];
        }

        return [];
    }

    /**
     * Get only active layanan pages
     */
    public static function getActive()
    {
        return self::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get layanan by slug
     */
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    /**
     * Get for menu/navigation
     */
    public static function getForMenu()
    {
        return self::where('is_active', true)
            ->orderBy('order')
            ->select('slug', 'title', 'icon')
            ->get();
    }
}
