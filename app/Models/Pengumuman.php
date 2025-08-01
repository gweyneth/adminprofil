<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    // Nama tabel secara eksplisit
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul_pengumuman',
        'isi_pengumuman',
        'tanggal_publikasi',
        'tanggal_kadaluarsa',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'tanggal_kadaluarsa' => 'date',
    ];
}
