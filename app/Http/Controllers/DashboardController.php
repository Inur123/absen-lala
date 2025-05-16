<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
{
    $pesertas = Peserta::all();

    $jumlahLakiLaki = $pesertas->where('jenis_kelamin', 'Laki-Laki')->count();
    $jumlahPerempuan = $pesertas->where('jenis_kelamin', 'Perempuan')->count();

    return view('dashboard', compact('pesertas', 'jumlahLakiLaki', 'jumlahPerempuan'));
}

}
