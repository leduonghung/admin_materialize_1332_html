<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Route::post('domain/extension/exists}', 'exists')->name('.exists');
// Route::get('/user', [UserController::class, 'exists']);