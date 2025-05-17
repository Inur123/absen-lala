<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Peserta;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    // Menampilkan daftar absensi
   public function index()
{
    $materis = Materi::all();

    // Total peserta (sama untuk semua materi)
    $totalPeserta = Peserta::count();

    // Siapkan array untuk menyimpan data persentase per materi
    $persentasePerMateri = [];
    $jumlahHadirPerMateri = [];

    foreach ($materis as $materi) {
        // Hitung jumlah peserta yang hadir untuk materi ini (status = Hadir dan materi_id sesuai)
        $jumlahHadir = Absensi::where('status', 'Hadir')
                              ->where('materi_id', $materi->id)
                              ->distinct('peserta_id')
                              ->count('peserta_id');

        // Simpan jumlah hadir per materi
        $jumlahHadirPerMateri[$materi->id] = $jumlahHadir;

        // Hitung persentase hadir untuk materi ini
        $persentasePerMateri[$materi->id] = $totalPeserta > 0 ? round(($jumlahHadir / $totalPeserta) * 100) : 0;
    }

    // Ambil semua absensi (bisa dipakai kalau mau menampilkan data detail absensi)
    $absensis = Absensi::with(['peserta', 'materi'])->get();

    return view('absensi.index', compact('absensis', 'materis', 'totalPeserta', 'jumlahHadirPerMateri', 'persentasePerMateri'));
}


    // Menampilkan halaman scan untuk materi tertentu
    public function showScanPage($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);

        // Ambil peserta, bisa disesuaikan filter jika perlu
        $pesertas = Peserta::all();

        // Ambil absensi peserta untuk materi ini (filter materi_id)
        $absensis = Absensi::where('materi_id', $materi_id)->get();

        return view('absensi.scan', compact('materi', 'pesertas', 'absensis'));
    }

    // Menyimpan absensi baru (via QR code scan)
    public function store(Request $request)
    {
        $request->validate([
            'peserta_id' => 'required|exists:pesertas,id',
            'materi_id' => 'required|exists:materis,id'
        ]);

        // Cek apakah sudah absen
        if (Absensi::where('peserta_id', $request->peserta_id)
            ->where('materi_id', $request->materi_id)
            ->exists()
        ) {
            return back()->with('error', 'Anda sudah melakukan absen untuk materi ini');
        }

        Absensi::create([
            'peserta_id' => $request->peserta_id,
            'materi_id' => $request->materi_id,
            'status' => 'Hadir'
        ]);

        return back()->with('success', 'Absensi berhasil dicatat');
    }

    // Update status absensi
    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'status' => 'required|in:Hadir,Tidak Hadir'
        ]);

        $absensi->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status absensi berhasil diperbarui');
    }

    // Hapus absensi
    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return back()->with('success', 'Absensi berhasil dihapus');
    }

   public function scanQr(Request $request)
{
    $request->validate([
        'qrcode' => 'required',
        'materi_id' => 'required|exists:materis,id'
    ]);
    // Try different methods to find the participant
    $peserta = Peserta::find($request->qrcode);

    if (!$peserta && preg_match('/\/peserta\/(\d+)/', $request->qrcode, $matches)) {
        $id = $matches[1];
        $peserta = Peserta::find($id);
    }

    if (!$peserta) {
        $peserta = Peserta::where('qrcode', 'like', '%' . $request->qrcode . '%')->first();
    }

    if (!$peserta) {
        $peserta = Peserta::where('qrcode', 'qrcodes/' . $request->qrcode . '.png')->first();
    }

    if (!$peserta && preg_match('/(\d+)\.png$/', $request->qrcode, $matches)) {
        $id = $matches[1];
        $peserta = Peserta::find($id);
    }

    if (!$peserta) {
        return response()->json([
            'success' => false,
            'message' => 'Peserta tidak ditemukan',
            'qrcode' => $request->qrcode
        ], 404);
    }

    $materi = Materi::find($request->materi_id);

    // Check if attendance already exists
    $existingAbsensi = Absensi::where('peserta_id', $peserta->id)
                            ->where('materi_id', $request->materi_id)
                            ->first();

    if ($existingAbsensi) {
        return response()->json([
            'success' => false,
            'message' => 'Anda sudah melakukan absen untuk materi ini',
            'peserta' => $peserta,
            'materi' => $materi
        ], 400);
    }

    // Create new attendance record
    $absensi = Absensi::create([
        'peserta_id' => $peserta->id,
        'materi_id' => $request->materi_id,
        'status' => 'Hadir'
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Absensi berhasil dicatat',
        'peserta' => $peserta,
        'materi' => $materi,
        'absensi' => $absensi
    ]);
}

    // API untuk scan QR code - IMPROVED VERSION
    // public function scanQr(Request $request)
    // {
    //     $request->validate([
    //         'qrcode' => 'required',
    //         'materi_id' => 'required|exists:materis,id'
    //     ]);

    //     // Log untuk debugging
    //     Log::info('QR Code scan request received', [
    //         'qrcode' => $request->qrcode,
    //         'materi_id' => $request->materi_id
    //     ]);

    //     // Coba berbagai metode untuk menemukan peserta

    //     // 1. Coba cari berdasarkan ID peserta langsung
    //     $peserta = Peserta::find($request->qrcode);

    //     // 2. Jika tidak ditemukan, coba ekstrak ID dari URL
    //     if (!$peserta && preg_match('/\/peserta\/(\d+)/', $request->qrcode, $matches)) {
    //         $id = $matches[1];
    //         Log::info('Extracted ID from URL', ['id' => $id]);
    //         $peserta = Peserta::find($id);
    //     }

    //     // 3. Jika masih tidak ditemukan, coba cari berdasarkan path QR code
    //     if (!$peserta) {
    //         $peserta = Peserta::where('qrcode', 'like', '%' . $request->qrcode . '%')->first();
    //     }

    //     // 4. Jika masih tidak ditemukan, coba cari berdasarkan path QR code lengkap
    //     if (!$peserta) {
    //         $peserta = Peserta::where('qrcode', 'qrcodes/' . $request->qrcode . '.png')->first();
    //     }

    //     // 5. Jika masih tidak ditemukan, coba cari berdasarkan nama file QR code
    //     if (!$peserta && preg_match('/(\d+)\.png$/', $request->qrcode, $matches)) {
    //         $id = $matches[1];
    //         Log::info('Extracted ID from filename', ['id' => $id]);
    //         $peserta = Peserta::find($id);
    //     }

    //     // Jika peserta tidak ditemukan
    //     if (!$peserta) {
    //         Log::warning('Peserta not found', ['qrcode' => $request->qrcode]);
    //         return response()->json([
    //             'success' => false,
    //             'error' => 'Peserta tidak ditemukan',
    //             'qrcode' => $request->qrcode
    //         ], 404);
    //     }

    //     Log::info('Peserta found', ['id' => $peserta->id, 'nama' => $peserta->nama]);

    //     // Cek apakah sudah absen
    //     $existingAbsensi = Absensi::where('peserta_id', $peserta->id)
    //         ->where('materi_id', $request->materi_id)
    //         ->first();

    //     if ($existingAbsensi) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => 'Peserta sudah melakukan absen untuk materi ini',
    //             'peserta' => $peserta,
    //             'absensi' => $existingAbsensi
    //         ], 400);
    //     }

    //     // Buat absensi baru
    //     $absensi = Absensi::create([
    //         'peserta_id' => $peserta->id,
    //         'materi_id' => $request->materi_id,
    //         'status' => 'Hadir'
    //     ]);

    //     Log::info('Absensi created', ['absensi_id' => $absensi->id]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Absensi berhasil dicatat',
    //         'peserta' => $peserta,
    //         'absensi' => $absensi
    //     ]);
    // }
}
