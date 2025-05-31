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


require __DIR__.'/auth.php';
