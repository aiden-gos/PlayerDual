<?php

use App\Http\Controllers\DonateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user/{id}', [UserController::class, 'get'])->name('user');

Route::middleware('auth')->group(function () {
    Route::post('/donate', [DonateController::class, 'donate'])->name('donate');

    Route::get('/listfollow', [UserController::class, 'follow'])->name('following.list');

    Route::get('/listdonate', [UserController::class, 'donateHistory'])->name('donating.list');

    Route::get('/listrent', [UserController::class, 'rentHistory'])->name('renting.list');

    Route::post(
        'stripe/webhook',
        [\App\Http\Controllers\StripeController::class, 'handleWebhook']
    );
});
