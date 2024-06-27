<?php

use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/rate', [RateController::class, 'store'])->name('rate.create');
});
