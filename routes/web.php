<?php
Route::group([
    'middleware' => ['web'],
    'prefix'     => 'authenticate',
    'namespace'  => 'AuthAdmin',
], function ()
{
    //giao diện login
    Route::get('/login', 'LoginController@getLogin')->name('get.admin.login');
    //submit login
    Route::post('/login', 'LoginController@postLogin')->name('post.admin.login');

    Route::get('/logout', 'LoginController@getLogout')->name('get.admin.logout');
});


