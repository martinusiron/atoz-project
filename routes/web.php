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
Route::name('login')->post('login', 'Auth\LoginController@login');
Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//prepaid-balance
Route::group(['prefix' => 'prepaid'], function(){
    Route::get('/', 'PrepaidController@index')->name('prepaid.index');
    Route::post('/', 'PrepaidController@store')->name('prepaid.store');
    Route::get('/{id}', 'PrepaidController@show')->name('prepaid.show');
});

//prouct
Route::group(['prefix' => 'product'], function(){
    Route::get('/', 'ProductController@index')->name('product.index');
    Route::post('/', 'ProductController@store')->name('product.store');
    Route::get('/{id}', 'ProductController@show')->name('product.show');
});


//prouct
Route::group(['prefix' => 'order'], function(){
    Route::get('/', 'OrderController@index')->name('order.index');
    Route::post('/', 'OrderController@store')->name('order.create');
    Route::get('/{id}', 'OrderController@show')->name('order.show');
    Route::get('/payment/{id}', 'OrderController@payment')->name('order.payment');
    Route::put('/payment/{id}', 'OrderController@update')->name('order.update');
});

Route::name('error')->get('error', 'ErrorController@error404');
Route::name('no-access')->get('maintenance', 'ErrorController@noAccess');