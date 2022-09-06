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


Route::prefix('home')->group(function() {
    Route::get('/dashboard','MonitorController@dashBoard')->name('get.monitor.index');
    Route::prefix('/monitor')->group(function() {
        Route::get('index/','MonitorController@index')->name('get.monitor.index');
        Route::get('/create','MonitorController@create')->name('get.monitor.create');
        Route::post('/store','MonitorController@store')->name('get.monitor.store');
        Route::get('/edit/{id}','MonitorController@edit')->name('get.monitor.edit');
        Route::post('/update/{id}','MonitorController@update')->name('get.monitor.update');
        Route::get('/delete/{id}','MonitorController@destroy')->name('get.monitor.destroy');
    });

});
