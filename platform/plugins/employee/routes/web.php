<?php
Route::group([
    'middleware' => ['web', 'auth.admin.logged', 'uri_permission'],
    'prefix' => config('company::config.prefix') . '/company',
    'namespace' => 'Workable\Employee\Http\Controllers'
], function () {

    Route::group(['prefix' => '/employee'], function () {
        Route::get('/index', 'EmployeeController@index')->name('get.employee.index');
        Route::get('/end', 'EmployeeController@end')->name('get.employee.end');
        Route::get('/create', 'EmployeeController@create')->name('get.employee.create');
        Route::post('/store', 'EmployeeController@store')->name('post.employee.store');
        Route::get('/edit/{id}', 'EmployeeController@edit')->name('get.employee.edit');
        Route::post('/update/{id}', 'EmployeeController@update')->name('post.employee.update');
        Route::get('/edit-password/{id}', 'EmployeeController@editPwd')->name('get.employee.edit_pwd');
        Route::post('/update-password/{id}', 'EmployeeController@updatePwd')->name('post.employee.update_pwd');
        Route::get('/update/{id}', 'EmployeeController@updateStatus')->name('get.employee.status');
        Route::get('/fake-login/{id}', 'EmployeeController@fakeLogin')->name('get.employee.fake_login');
    });
});
