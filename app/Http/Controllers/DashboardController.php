<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Peserta;
use App\Models\Absensi;

class DashboardController extends Controller
{
   public function index()
{
    $pesertas = Peserta::all();
    $materis = Materi::withCount(['absensis as total_hadir' => function($query) {
            $query->where('status', 'Hadir');
        }])
        ->latest()
        ->get();

    $jumlahLakiLaki = $pesertas->where('jenis_kelamin', 'Laki-Laki')->count();
    $jumlahPerempuan = $pesertas->where('jenis_kelamin', 'Perempuan')->count();

    // Calculate attendance percentage for each materi
    $totalPeserta = $pesertas->count();
    $totalAbsensi = Absensi::count(); // Add this line to get total attendance records

    $materis->each(function($materi) use ($totalPeserta) {
        $materi->persentase = $totalPeserta > 0
            ? round(($materi->total_hadir / $totalPeserta) * 100)
            : 0;
    });

    return view('dashboard', compact(
        'pesertas',
        'jumlahLakiLaki',
        'jumlahPerempuan',
        'materis',
        'totalAbsensi' // Add this to the compact function
    ));
}
}
