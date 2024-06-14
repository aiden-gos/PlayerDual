<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\StoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/comment/{id}', [CommentController::class, 'index'])->name('comment');
Route::middleware('auth')->group(function () {
    Route::post('/comment/{id}', [CommentController::class, 'store'])->name('comment.create');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.delete');
});
