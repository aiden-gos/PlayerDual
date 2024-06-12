<?php

use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/rate', [RateController::class, 'store'])->name('rate.create');
    Route::patch('/rate/{id}', [RateController::class, 'update'])->name('rate.update');
    Route::delete('/rate/{id}', [RateController::class, 'delete'])->name('rate.delete');
});
