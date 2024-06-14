<?php

use App\Http\Controllers\StoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/stories', [StoriesController::class, 'index'])->name('stories');
Route::middleware('auth')->group(function () {
    Route::post('/stories', [StoriesController::class, 'store'])->name('stories.up');
    Route::get('/stories/view/{id}', [StoriesController::class, 'updateView'])->name('stories.view');
    Route::get('/stories/like/{id}', [StoriesController::class, 'updateLike'])->name('stories.like');
});
