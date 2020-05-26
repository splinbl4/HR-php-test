<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', 'Weather\WeatherController@index')->name('weather.index');

Route::group([
    'prefix' => 'orders',
    'as' => 'orders.',
    'namespace' => 'Order',
], function () {
    Route::get('/', 'OrderController@index')->name('index');
    Route::get('{id}', 'OrderController@edit')->name('edit');
    Route::put('{id}', 'OrderController@update')->name('update');
});

Route::group([
    'prefix' => 'products',
    'as' => 'products.',
    'namespace' => 'Product',
], function () {
    Route::get('/', 'ProductController@index')->name('index');
    Route::put('{id}/updatePrice', 'ProductController@updatePrice')->name('update.price');
});
