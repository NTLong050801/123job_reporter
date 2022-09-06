<?php
Route::group([
    'middleware' => ['web', 'auth.admin.logged', 'uri_permission'],
    'prefix'     => config('company::config.prefix') . '/company',
    'namespace'  => 'Modules\Company\Http\Controllers'
], function () {

    // Menu - Done
    Route::group(['prefix' => 'menus'], function () {
        Route:: get('/index', 'MenuController@index')->name('get.menu.index');
        Route:: get('/edit/{id}', 'MenuController@edit')->name('get.menu.edit');
        Route:: post('/update/{id}', 'MenuController@update')->name('get.menu.update');
        Route:: get('/create', 'MenuController@create')->name('get.menu.create');
        Route:: post('/store', 'MenuController@store')->name('get.menu.store');
        Route:: get('/delete/{id}', 'MenuController@delete')->name('get.menu.delete');
    });

    // Module
    Route::group(['prefix' => 'modules'], function () {
        Route:: get('/index', 'ModuleController@index')->name('get.module.index');
        Route:: get('/edit/{id}', 'ModuleController@edit')->name('get.module.edit');
        Route:: post('/update/{id}', 'ModuleController@update')->name('get.module.update');
        Route:: get('/sort', 'ModuleController@sort')->name('get.module.sort');
        Route:: get('/sort-data/{id}', 'ModuleController@ajaxGetMenu')->name('get.module.sort_data');
        Route:: post('/sort-update', 'ModuleController@ajaxUpdateModuleOrder')->name('get.module.sort_update');
    });
});

Route::get('403', 'ErrorController@denied')->name('error.403');

Route::group([
    'middleware' => ['web', 'auth.admin.logged'],
    'prefix'     => '/',
    'namespace'  => 'Modules\Company\Http\Controllers'
], function () {
    Route::get('template/index', 'TemplateController@index');
    Route::get('/profile/index', 'ProfileController@profile')->name('get.profile.show');
    Route::get('/profile/change_password', 'ProfileController@changePassword')->name('get.profile.change_password');
    Route::post('/profile/update_password', 'ProfileController@updatePassword')->name('post.profile.update_passsword');
    Route::get('/profile/change_info', 'ProfileController@changeInfo')->name('get.profile.change_info');
    Route::post('/profile/update_info', 'ProfileController@updateInfo')->name('post.profile.update_info');
    Route::post('/profile/upload_avatar', 'ProfileController@uploadAvatar')->name('post.profile.upload_avatar');
    Route::get('/profile/history', 'ProfileController@history')->name('get.profile.history');
    Route::get('/profile/login-history', 'ProfileController@loginHistory')->name('get.profile.login-history');

    Route::get('/403', 'ErrorController@denied')->name('error.403');
    Route::fallback('ErrorController@show404');

    Route::get('{slug}', 'MenuController@dashboard')->name('default');
//    Route::get('', function(){
//        return view('company::view');
//    });
});

