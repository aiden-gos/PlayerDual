<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use Dcblogdev\Dropbox\Facades\Dropbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/password', [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::get('/account', [ProfileController::class, 'account'])->name('profile.account');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/gallery', [ProfileController::class, 'gallery'])->name('profile.gallery');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::post('/gallery', [ProfileController::class, 'uploadGallery'])->name('profile.gallery.upload');
    Route::post('/gallerydropbox', [ProfileController::class, 'uploadDropbox'])->name('profile.gallery.dropbox');
    Route::patch('/payment', [ProfileController::class, 'updatePayment'])->name('profile.payment.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/payment', [ProfileController::class, 'payment'])->name('profile.payment');
    Route::get('/add_payment', [StripeController::class, 'paymentMethod'])->name('payment.add');
    Route::post('/checkout', [StripeController::class, 'checkout'])->name('payment.checkout');

    Route::get('dropbox/connect', function () {
        return Dropbox::connect();
    });

    Route::get('dropbox/disconnect', function () {
        return Dropbox::disconnect('app/dropbox');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/home.php';
require __DIR__ . '/user.php';
require __DIR__ . '/follow.php';
require __DIR__ . '/order.php';
require __DIR__ . '/pre-order.php';
require __DIR__ . '/notification.php';
require __DIR__ . '/rate.php';
require __DIR__ . '/rank.php';
require __DIR__ . '/stories.php';
require __DIR__ . '/comment.php';
