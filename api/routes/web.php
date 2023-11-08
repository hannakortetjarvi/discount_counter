<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/discounts', function () {
    return view('welcome', ['discounts' => App\Models\Discount::all()]);
});

Route::get('/sales', function () {
    return view('welcome', ['sales' => App\Models\Sales::all()]);
});
