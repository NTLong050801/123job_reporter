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
    Route::get('/seo_content/index', 'ReportSeoController@index')->name('get.seo_content.index');
    Route::get('/show/data', 'ReportSeoController@getDataForChart')->name('get.data.seo');

    Route::get('/upload/index', 'UploadPublicController@index')->name('get.upload.index');
    Route::get('/show/data/upload', 'UploadPublicController@getDataForChart')->name('get.data.upload.public');

    Route::get('/reference/index', 'ReferenceController@index')->name('get.reference.index');
    Route::get('reference/show/data', 'ReferenceController@getDataForChart')->name('get.data.reference');

    Route::get('/robot/index', 'RobotController@index')->name('get.robot.index');
    Route::get('robot/show/data', 'RobotController@getDataForChart')->name('get.data.robot');


});
