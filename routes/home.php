<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::get('/filterGame/{game}', [HomeController::class, 'filterGame'])->name('home.game');
