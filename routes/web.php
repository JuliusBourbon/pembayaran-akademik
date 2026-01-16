<?php

use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/table', [TableController::class, 'read'], function () {
    return view('table');
});
