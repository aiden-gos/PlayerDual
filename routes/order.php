<?php
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PreOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/rent', [OrderController::class, 'rent'])->name('rent');
    Route::post('/off', [OrderController::class, 'off'])->name('off');
    Route::post('/rent/accept', [OrderController::class, 'acceptRent'])->name('rent.accept');
    Route::post('/rent/reject', [OrderController::class, 'rejectRent'])->name('rent.reject');
    Route::post('/rent/end', [OrderController::class, 'endRent'])->name('rent.end');
});
