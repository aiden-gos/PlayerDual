<?php

use App\Http\Controllers\DonateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user/{id}', [UserController::class, 'get'])->name('user');

Route::post('/donate', [DonateController::class, 'donate'])->name('donate');

