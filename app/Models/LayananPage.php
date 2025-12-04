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
