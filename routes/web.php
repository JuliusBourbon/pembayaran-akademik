<?php

use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/table', [TableController::class, 'read'], function () {
    return view('table');
});
Route::get('/table/tambahprodi', [ProdiController::class, 'createView'])->name('prodi.createview');
Route::post('/table/tambahprodi', [ProdiController::class, 'store'])->name('prodi.store');
Route::delete('/table/hapusprodi/{id}', [ProdiController::class, 'delete'])->name('prodi.delete');
Route::get('/table/ubahprodi/{id}', [ProdiController::class, 'updateView'])->name('prodi.updateview');
Route::post('/table/ubahprodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');

Route::get('/table/tambahfakul', [FakultasController::class, 'createView'])->name('fakul.createview');
Route::post('/table/tambahfakul', [FakultasController::class, 'store'])->name('fakul.store');
Route::delete('/table/hapusfakul/{id}', [FakultasController::class, 'delete'])->name('fakul.delete');
Route::get('/table/ubahfakul/{id}', [FakultasController::class, 'updateView'])->name('fakul.updateview');
Route::post('/table/ubahfakul/{id}', [FakultasController::class, 'update'])->name('fakul.update');

Route::get('/table/tambahmhs', [MahasiswaController::class, 'createView'])->name('mhs.createview');
Route::post('/table/tambahmhs', [MahasiswaController::class, 'store'])->name('mhs.store');
Route::delete('/table/hapusmhs/{id}', [MahasiswaController::class, 'delete'])->name('mhs.delete');
Route::get('/table/ubahmhs/{id}', [MahasiswaController::class, 'updateView'])->name('mhs.updateview');
Route::post('/table/ubahmhs/{id}', [MahasiswaController::class, 'update'])->name('mhs.update');

Route::get('/table/tambahbdh', [BendaharaController::class, 'createView'])->name('bdh.createview');
Route::post('/table/tambahbdh', [BendaharaController::class, 'store'])->name('bdh.store');
Route::delete('/table/hapusbdh/{id}', [BendaharaController::class, 'delete'])->name('bdh.delete');
Route::get('/table/ubahbdh/{id}', [BendaharaController::class, 'updateView'])->name('bdh.updateview');
Route::post('/table/ubahbdh/{id}', [BendaharaController::class, 'update'])->name('bdh.update');

Route::get('/table/tambahjenis', [JenisController::class, 'createView'])->name('jenis.createview');
Route::post('/table/tambahjenis', [JenisController::class, 'store'])->name('jenis.store');
Route::delete('/table/hapusjenis/{id}', [JenisController::class, 'delete'])->name('jenis.delete');
Route::get('/table/ubahjenis/{id}', [JenisController::class, 'updateView'])->name('jenis.updateview');
Route::post('/table/ubahjenis/{id}', [JenisController::class, 'update'])->name('jenis.update');