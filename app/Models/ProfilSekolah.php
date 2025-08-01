<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'alamat',
        'no_telp',
        'email',
        'sejarah',
        'visi',
        'misi',
        'logo',
        'maps',
        'facebook_url',
        'instagram_url',
        'youtube_url',
    ];
}
