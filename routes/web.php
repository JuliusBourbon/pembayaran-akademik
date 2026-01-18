<?php

use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembayaranContoller;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/table', [TableController::class, 'read'], function () {
//     return view('table');
// });
// Route::get('/table/tambahprodi', [ProdiController::class, 'createView'])->name('prodi.createview');
// Route::post('/table/tambahprodi', [ProdiController::class, 'store'])->name('prodi.store');
// Route::delete('/table/hapusprodi/{id}', [ProdiController::class, 'delete'])->name('prodi.delete');
// Route::get('/table/ubahprodi/{id}', [ProdiController::class, 'updateView'])->name('prodi.updateview');
// Route::post('/table/ubahprodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');