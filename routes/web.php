<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/cari-mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/transaksi/bayar/{no_reg}', [TransaksiController::class, 'create']);
Route::post('/transaksi/proses', [TransaksiController::class, 'store']);

// Route::get('/table', [TableController::class, 'read'], function () {
//     return view('table');
// });
// Route::get('/table/tambahprodi', [ProdiController::class, 'createView'])->name('prodi.createview');
// Route::post('/table/tambahprodi', [ProdiController::class, 'store'])->name('prodi.store');
// Route::delete('/table/hapusprodi/{id}', [ProdiController::class, 'delete'])->name('prodi.delete');
// Route::get('/table/ubahprodi/{id}', [ProdiController::class, 'updateView'])->name('prodi.updateview');
// Route::post('/table/ubahprodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');