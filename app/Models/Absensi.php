<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'peserta_id',
        'materi_id',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    // Relasi ke tabel peserta
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    // Relasi ke tabel materi
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
