<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Materi;

use App\Models\Peserta;
use Barryvdh\DomPDF\Facade\Pdf; // Correct facade import

class AbsensiReportController extends Controller
{
    public function index()
    {
        $materis = Materi::with(['absensis.peserta'])
            ->withCount([
                'absensis as total_hadir' => function ($query) {
                    $query->where('status', 'Hadir');
                },
                'absensis as total_belum_hadir' => function ($query) {
                    $query->where('status', 'Belum Hadir');
                }
            ])
            ->latest()
            ->get();

        $allPesertas = Peserta::all();

        return view('absensi-report.index', compact('materis', 'allPesertas'));
    }



    public function exportPdf($materi_id)
    {
        $materi = Materi::with(['absensis'])->findOrFail($materi_id);
        $allPesertas = Peserta::all();

        // Ambil ID peserta yang hadir atau tidak hadir pada materi ini
        $absensiPesertaIDs = $materi->absensis->pluck('peserta_id')->toArray();

        // Hitung total hadir dari absensis
        $totalHadir = $materi->absensis->where('status', 'Hadir')->count();

        // Total tidak hadir = peserta yang belum absen + peserta dengan status "Tidak Hadir"
        $totalTidakHadir = $allPesertas->count() - $totalHadir;

        $currentDateTime = Carbon::now()->translatedFormat('d F Y H:i') . ' WIB';

        // Kirim ke view
        $pdf = PDF::loadView('absensi-report.export', [
            'materi' => $materi,
            'allPesertas' => $allPesertas,
            'currentDateTime' => $currentDateTime,
            'totalHadir' => $totalHadir,
            'totalTidakHadir' => $totalTidakHadir,
        ]);

        return $pdf->download('absensi-report-' . $materi->nama . '.pdf');
    }
}
