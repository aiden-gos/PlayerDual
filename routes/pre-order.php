<?php
use App\Http\Controllers\PreOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/pre-order', [PreOrderController::class, 'preOrder'])->name('pre-order');
    Route::post('/pre-order/accept', [PreOrderController::class, 'acceptRent'])->name('pre-order.accept');
    Route::post('/pre-order/reject', [PreOrderController::class, 'rejectRent'])->name('pre-order.reject');
    Route::post('/pre-order/end', [PreOrderController::class, 'endRent'])->name('pre-order.end');
});
