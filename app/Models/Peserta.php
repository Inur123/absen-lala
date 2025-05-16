<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'asal_delegasi',
        'jenis_kelamin',
        'qrcode'
    ];

  protected static function booted()
{
    static::created(function ($peserta) {
        $content = route('peserta.show', $peserta->id);
        $fileName = 'qrcodes/' . $peserta->id . '.png';

        // Generate QR Code
        $qrCode = QrCode::format('png')
                ->size(800) // Ukuran lebih besar
                ->margin(4)
                ->errorCorrection('H')
                ->generate($content);

        // Simpan langsung ke storage
        Storage::disk('public')->put($fileName, $qrCode);

        $peserta->update(['qrcode' => $fileName]);
    });
}
}
