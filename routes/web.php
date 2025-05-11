<?php

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
