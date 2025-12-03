<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $table = 'why_choose_us';
    protected $fillable = ['title', 'description', 'icon', 'image', 'order', 'status'];
    public $timestamps = true;

    public static function getActive()
    {
        return self::where('status', 'active')->orderBy('order')->get();
    }
}
