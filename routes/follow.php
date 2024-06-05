<?php

use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;

Route::post('follow', [FollowController::class, 'store'])->name("follow.store");
Route::delete('follow', [FollowController::class, 'destroy'])->name("follow.destroy");
