<?php

use App\Http\Controllers\StoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/stories', [StoriesController::class, 'index'])->name('stories');
