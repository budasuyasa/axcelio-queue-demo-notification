<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/export-pdf', [MainController::class, 'exportPDF'])
    ->name('export.pdf');
Route::get('notifikasi', [MainController::class, 'notifikasi'])
    ->name('notifikasi');
