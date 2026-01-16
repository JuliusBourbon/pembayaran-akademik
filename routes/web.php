<?php

use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/table', [TableController::class, 'read'], function () {
    return view('table');
});
Route::get('/table/tambah', [ProdiController::class, 'addView'])->name('prodi');
Route::post('/table/tambah', [ProdiController::class, 'storeProdi'])->name('prodi.store');
Route::delete('/table/hapus/{id}', [ProdiController::class, 'deleteProdi'])->name('prodi.delete');
Route::get('/table/ubah/{id}', [ProdiController::class, 'editView'])->name('prodi.editpage');
Route::post('/table/ubah/{id}', [ProdiController::class, 'editProdi'])->name('prodi.update');
