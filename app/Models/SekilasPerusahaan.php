<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekilasPerusahaan extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'tahun_berdiri', 'jumlah_karyawan', 'image'];

    protected $casts = [
        'tahun_berdiri' => 'integer',
        'jumlah_karyawan' => 'integer',
    ];
}
