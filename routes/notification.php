<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::middleware('auth')->group(function () {
    Route::get('/notification/all', [NotificationController::class, 'readAllNotify'])->name('notification.readAll');
    Route::get('/notification/{id}', [NotificationController::class, 'readNotify'])->name('notification.read');
});
