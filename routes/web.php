<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'show' => 'users.show'
    ]);

    Route::resource('products', ProductController::class)->names([
        'index' => 'products.index',
        'show' => 'products.show'
    ]);

    Route::resource('orders', OrderController::class)->names([
        'index' => 'orders.index',
        'show' => 'orders.show'
    ]);

    Route::controller(PaymentController::class)->group(function () {
        Route::get('payment/process/{order}', 'process')->name('payment.process');
        Route::get('payment/success/{order}', 'success')->name('payment.success');
        Route::get('payment/cancel', 'cancel')->name('payment.cancel');
    });
});

require __DIR__ . '/auth.php';
