<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsensiReportController;

// Redirect root to /login
Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('peserta', PesertaController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::post('absensi/scan', [AbsensiController::class, 'scanQr'])->name('absensi.scan');
    Route::get('/absensi/scan/{materi}', [AbsensiController::class, 'showScanPage'])->name('absensi.scan.page');
    Route::get('/absensi-report', [AbsensiReportController::class, 'index'])->name('absensi-report.index');
});


