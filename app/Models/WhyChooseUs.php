<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    use HasFactory;

    protected $table = 'why_choose_us';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get active records ordered by custom order
     */
    public static function getActive()
    {
        return self::where('status', 'active')
            ->orderBy('order', 'asc')
            ->get();
    }
}
