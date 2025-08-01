<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_eskul',
        'deskripsi',
        'nama_pembina',
        'gambar',
    ];

    public function posts()
    {
        return $this->hasMany(PostEkstrakurikuler::class);
    }
}
