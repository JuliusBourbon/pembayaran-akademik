<?php

use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/table', [TableController::class, 'read'], function () {
    return view('table');
});
Route::get('/table/tambahprodi', [ProdiController::class, 'addView'])->name('prodi.addview');
Route::post('/table/tambahprodi', [ProdiController::class, 'storeProdi'])->name('prodi.store');
Route::delete('/table/hapusprodi/{id}', [ProdiController::class, 'deleteProdi'])->name('prodi.delete');
Route::get('/table/ubahprodi/{id}', [ProdiController::class, 'editView'])->name('prodi.editview');
Route::post('/table/ubahprodi/{id}', [ProdiController::class, 'editProdi'])->name('prodi.update');

Route::get('/table/tambahfakul', [FakultasController::class, 'addView'])->name('fakul.addview');
Route::post('/table/tambahfakul', [FakultasController::class, 'storeFakul'])->name('fakul.store');
Route::delete('/table/hapusfakul/{id}', [FakultasController::class, 'deleteFakul'])->name('fakul.delete');
Route::get('/table/ubahFakul/{id}', [FakultasController::class, 'editView'])->name('fakul.editview');
Route::post('/table/ubahFakul/{id}', [FakultasController::class, 'editFakul'])->name('fakul.update');