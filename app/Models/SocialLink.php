<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $table = 'social_links';
    protected $fillable = ['facebook', 'youtube', 'youtube_landing', 'whatsapp', 'instagram'];
    public $timestamps = true;
}
