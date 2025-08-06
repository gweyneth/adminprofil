<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_agenda',
        'isi_agenda',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',      // <-- Kolom baru
        'jam_selesai',    // <-- Kolom baru
        'lokasi',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',   // <-- Diubah menjadi date
        'tanggal_selesai' => 'date', // <-- Diubah menjadi date
    ];
}
