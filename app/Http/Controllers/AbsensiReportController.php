<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Peserta;

class AbsensiReportController extends Controller
{
    public function index()
    {
        $materis = Materi::with(['absensis.peserta'])
            ->withCount([
                'absensis as total_hadir' => function($query) {
                    $query->where('status', 'Hadir');
                },
                'absensis as total_belum_hadir' => function($query) {
                    $query->where('status', 'Belum Hadir');
                }
            ])
            ->latest()
            ->get();

        // Get all participants
        $allPesertas = Peserta::all();

        return view('absensi-report.index', compact('materis', 'allPesertas'));
    }
}
