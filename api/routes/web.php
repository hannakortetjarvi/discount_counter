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

Route::prefix('discounts')->group(function () {
    Route::get('/', 'App\Http\Controllers\DiscountController@index');
    Route::post('/', 'App\Http\Controllers\DiscountController@postDiscount');
    Route::get('/{id}', 'App\Http\Controllers\DiscountController@specificDiscount')->name('discount.show');
    Route::get('/{id}/edit', 'App\Http\Controllers\DiscountController@edit')->name('discounts.edit');
    Route::put('/{id}', 'App\Http\Controllers\DiscountController@update')->name('discounts.update');
});

Route::prefix('sales')->group(function () {
    Route::get('/', 'App\Http\Controllers\SaleController@index');
    Route::post('/', 'App\Http\Controllers\SaleController@postSale');
    Route::get('/{id}', 'App\Http\Controllers\SaleController@specificSale')->name('sale.show');
    Route::get('/{id}/edit', 'App\Http\Controllers\SaleController@edit')->name('sales.edit');
    Route::put('/{id}', 'App\Http\Controllers\SaleController@update')->name('sales.update');
});