<?php

use App\Http\Controllers\SalesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', [SalesController::class, 'index']);
Route::post('/upload', [SalesController::class, 'store']);
