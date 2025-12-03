<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JejakLangkah extends Model
{
    protected $table = 'jejak_langkahs';
    protected $fillable = ['tahun', 'deskripsi', 'image'];
    public $timestamps = true;
}
