<?php
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/rent', [OrderController::class, 'rent'])->name('rent');
    Route::post('/rent/accept', [OrderController::class, 'acceptRent'])->name('rent.accept');
    Route::post('/rent/reject', [OrderController::class, 'rejectRent'])->name('rent.reject');
});
