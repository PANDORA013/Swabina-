<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    protected $table = 'carousels';

    protected $fillable = [
        'title',
        'description',
        'image',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get active carousels ordered by position
     */
    public static function getActive()
    {
        return self::where('is_active', true)->orderBy('order')->get();
    }
}
