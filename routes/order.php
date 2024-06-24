<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/rent', [OrderController::class, 'rent'])->name('rent');
    Route::post('/off', [OrderController::class, 'off'])->name('off');
    Route::post('/rent/accept', [OrderController::class, 'acceptRent'])->name('rent.accept');
    Route::post('/rent/reject', [OrderController::class, 'rejectRent'])->name('rent.reject');
    Route::post('/rent/end', [OrderController::class, 'endRent'])->name('rent.end');
    Route::get('/rent/request', [OrderController::class, 'requestOrder'])->name('rent.request');
    Route::get('/rent/listRequest', [OrderController::class, 'listRequest'])->name('rent.list.request');
});
