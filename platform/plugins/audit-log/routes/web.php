<?php
Route::group([
    'middleware' => ['web', 'auth.admin.logged', 'uri_permission'],
    'prefix' => config('company::config.prefix') . '/company',
    'namespace' => 'Workable\AuditLog\Http\Controllers'
], function () {
    Route::group(['prefix' => '/history'], function () {
        Route::get('/index', 'ActivityController@active')->name('get.employee.activity');
        Route::get('/history-login', 'HistoryLoginController@index')->name('get.employee.history-login');
    });
});
