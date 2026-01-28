<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TransaksiController;

Route::get('/', [MahasiswaController::class, 'getprodi'], function () {
    return view('landing_page');
});
Route::post('/', [MahasiswaController::class, 'store'])->name('mhs.store');

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cari-mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/transaksi/bayar/{no_reg}', [TransaksiController::class, 'create']);
Route::post('/transaksi/proses', [TransaksiController::class, 'store']);
Route::get('/detail/{no_reg}', [MahasiswaController::class, 'detail'])->name('detail');
Route::get('/detail/{no_reg}/edit', [MahasiswaController::class, 'updateview'])->name('updatemhs');
Route::post('/detail/{no_reg}/edit', [MahasiswaController::class, 'update'])->name('updatemhs.store');
Route::get('/transaksi/cetak/{no_transaksi}', [TransaksiController::class, 'cetak']);
Route::get('/pendaftaran-berhasil', [MahasiswaController::class, 'successview'])->name('daftar.sukses');
Route::delete('/detail/{no_reg}/delete', [MahasiswaController::class, 'delete'])->name('deletemhs');

Route::get('/mahasiswa/login', [AuthController::class, 'loginMahasiswaForm']);
Route::post('/mahasiswa/login', [AuthController::class, 'loginMahasiswa']);
Route::get('/mahasiswa/logout', [AuthController::class, 'logoutMahasiswa']);
Route::get('/mahasiswa/dashboard', function () {
    if (!Session::has('mhs_logged_in')) {
        return redirect('/mahasiswa/login')->with('error', 'Silakan login terlebih dahulu.');
    }
    return view('mahasiswa.dashboard');
});
Route::post('/mahasiswa/dashboard/{no_reg}', [MahasiswaController::class, 'updateByMhs'])->name('updateByMhs');