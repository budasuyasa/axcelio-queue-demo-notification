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

Route::get('/user', [MainController::class, 'getUser'])
    ->name('get-user');

Route::get('/user/add-dummy', [MainController::class, 'addDummyUser'])
    ->name('add-dummy-user');

Route::get('/user/ajax', [MainController::class, 'ajaxUser'])
    ->name('ajax-user');