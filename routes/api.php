<?php

use Illuminate\Support\Facades\Route;

Route::post('/users/login', [App\Http\Controllers\UsersController::class, 'login']);

Route::get('/cities', [App\Http\Controllers\CitiesController::class, 'index']);
Route::post('/cities', [App\Http\Controllers\CitiesController::class, 'store'])
        ->middleware('auth:sanctum');
Route::patch('/cities/{id}', [App\Http\Controllers\CitiesController::class, 'update'])
        ->middleware('auth:sanctum');
Route::delete('/cities/{id}', [App\Http\Controllers\CitiesController::class, 'destroy'])
        ->middleware('auth:sanctum');

Route::get('/counties', [App\Http\Controllers\CountiesController::class, 'index']);
Route::post('/counties', [App\Http\Controllers\CountiesController::class, 'store'])
        ->middleware('auth:sanctum');
Route::patch('/counties/{id}', [App\Http\Controllers\CountiesController::class, 'update'])
        ->middleware('auth:sanctum');
Route::delete('/counties/{id}', [App\Http\Controllers\CountiesController::class, 'destroy'])
        ->middleware('auth:sanctum');

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])
    ->middleware('auth:sanctum');