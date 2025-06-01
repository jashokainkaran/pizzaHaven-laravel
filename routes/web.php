<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
}) -> name('home');

Route::get('/pizza', function(){
    return view('pizza');
}) -> name('pizza');

Route::get('/drinks', function(){
    return view('drinks');
}) -> name('drinks');

Route::get('/cart', function(){
    return view('cart');
}) -> name('cart');

Route::get('/orders', function(){
    return view('orders');
}) ->name('orders');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->get('/checkout', function(){
    return view('checkout');
})->name('checkout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/pizza', function () {
        return view('admin.ad-pizza');
    })->name('admin.pizza');
    Route::get('/admin/drinks', function () {
        return view('admin.ad-drinks');
    })->name('admin.drinks');
    Route::get('/admin/orders', function () {
        return view('admin.ad-orders');
    })->name('admin.orders');
    Route::get('/admin/users', function () {
        return view('admin.ad-users');
    })->name('admin.users');
});


require __DIR__.'/auth.php';
