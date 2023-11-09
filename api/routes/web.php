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
    Route::get('/', 'App\Http\Controllers\DiscountController@index')->name('discount.index');
    Route::post('/', 'App\Http\Controllers\DiscountController@postDiscount')->name('discount.post');
    Route::get('/{id}', 'App\Http\Controllers\DiscountController@specificDiscount')->name('discount.show');
    Route::get('/{id}/edit', 'App\Http\Controllers\DiscountController@edit')->name('discounts.edit');
    Route::put('/{id}', 'App\Http\Controllers\DiscountController@update')->name('discounts.update');
    Route::delete('/{id}', 'App\Http\Controllers\DiscountController@delete')->name('discounts.delete');
});

Route::prefix('sales')->group(function () {
    Route::get('/', 'App\Http\Controllers\SaleController@index')->name('sale.index');
    Route::post('/', 'App\Http\Controllers\SaleController@postSale')->name('sale.post');
    Route::get('/{id}', 'App\Http\Controllers\SaleController@specificSale')->name('sale.show');
    Route::get('/{id}/edit', 'App\Http\Controllers\SaleController@edit')->name('sales.edit');
    Route::put('/{id}', 'App\Http\Controllers\SaleController@update')->name('sales.update');
    Route::delete('/{id}', 'App\Http\Controllers\SaleController@delete')->name('sales.delete');
});