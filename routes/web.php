<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['user'])->group(function () {
        Route::get('/cart', [CartController::class, 'cart'])->name('cart');
        Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('add-to-cart');
        Route::patch('/cart/{cart}', [CartController::class, 'updateCart'])->name('update-cart');
        Route::get('/cart/{cart}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/order', [CartController::class, 'order'])->name('order');
        Route::get('my-orders', [OrderController::class, 'userOrders'])->name('my-orders');
    });
    Route::middleware(['admin'])->group(function () {
        Route::resource('products', ProductController::class)->except(['show', 'index']);
        Route::get('orders', [OrderController::class, 'orders'])->name('orders');
        Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::resource('products', ProductController::class)->only(['show', 'index']);
