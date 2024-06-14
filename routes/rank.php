<?php

use App\Http\Controllers\RankController;
use Illuminate\Support\Facades\Route;

Route::get('/rank/income', [RankController::class, 'getRankIncome'])->name('rank.income');
Route::get('/rank/outcome', [RankController::class, 'getRankOutcome'])->name('rank.outcome');
