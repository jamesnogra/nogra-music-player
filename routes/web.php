<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SongController;

Route::get('/', function () {
    return view('music');
});

/** Users */
Route::get('/register', [UserController::class, 'registerForm']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'loginForm']);
Route::post('/login', [UserController::class, 'login']);

/** Music */
Route::get('/song', [SongController::class, 'song']);
Route::get('/all-songs', [SongController::class, 'allSongs']);
