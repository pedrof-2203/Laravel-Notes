<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckNotLogged;
use Illuminate\Support\Facades\Route;

// auth routes - user not logged-in
Route::middleware([CheckNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

// app routes - user logged-in
Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/newNote', [MainController::class, 'newNote']);
});
