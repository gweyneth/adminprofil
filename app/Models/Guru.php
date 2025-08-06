<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nuptk', // <-- Diubah dari nip
        'jabatan',
        'foto',
        'jurusan_id',
        'instagram_url',
        'facebook_url',
        'linkedin_url',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
