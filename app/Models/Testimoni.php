<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemberi',
        'jabatan_atau_asal',
        'isi_testimoni',
        'foto',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
