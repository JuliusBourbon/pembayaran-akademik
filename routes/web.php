<?php

use App\Http\Controllers\FakultasController;
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