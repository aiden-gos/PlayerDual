<?php

use App\Http\Controllers\RankController;
use Illuminate\Support\Facades\Route;

Route::get('/rank/income/{day}', [RankController::class, 'getRankIncome'])->name('rank.income');
Route::get('/rank/outcome/{day}', [RankController::class, 'getRankOutcome'])->name('rank.outcome');
