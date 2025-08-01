<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostEkstrakurikuler extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'foto_kegiatan',
        'ekstrakurikuler_id',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model Ekstrakurikuler.
     */
    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class);
    }
}
