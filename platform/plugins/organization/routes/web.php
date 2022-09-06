<?php
Route::group([
    'middleware' => ['web', 'auth.admin.logged', 'uri_permission'],
    // 'prefix'=>'/organization',
    'prefix' => '/company',
    'namespace' => 'Workable\Organization\Http\Controllers'
], function () {
    // Company - Done
    Route::group(['prefix' => 'company'], function () {
        Route::get('/index', 'CompanyController@index')->name('get.company.index');
        Route::get('/edit/{id}', 'CompanyController@edit')->name('get.company.edit');
        Route::post('/update/{id}', 'CompanyController@update')->name('get.company.update');
        Route::get('/create', 'CompanyController@create')->name('get.company.create');
        Route::post('/store', 'CompanyController@store')->name('get.company.store');
        Route::get('/delete/{id}', 'CompanyController@delete')->name('get.company.delete');
    });

    // Deportment - Done
    Route::group(['prefix' => 'departments'], function () {
        Route::get('/index', 'DepartmentController@index')->name('get.department.index');
        Route::get('/list-child', 'DepartmentController@listChildLevel')->name('get.department.list_child');
        Route::get('/edit/{id}', 'DepartmentController@edit')->name('get.department.edit');
        Route::post('/update/{id}', 'DepartmentController@update')->name('get.department.update');
        Route::get('/create', 'DepartmentController@create')->name('get.department.create');
        Route::post('/store', 'DepartmentController@store')->name('get.department.store');
        Route::get('/stop/{id}', 'DepartmentController@stop')->name('get.department.stop');
    });

    // Announcement
    Route::group(['prefix' => 'announcements'], function () {
        Route::get('/index', 'AnnouncementController@index')->name('get.announcement.index');
        Route::get('/index-hide', 'AnnouncementController@indexHide')->name('get.announcement.index-hide');
        Route::get('/edit/{id}', 'AnnouncementController@edit')->name('get.announcement.edit');
        Route::post('/update/{id}', 'AnnouncementController@update')->name('post.announcement.update');
        Route::get('/create', 'AnnouncementController@create')->name('get.announcement.create');
        Route::post('/store', 'AnnouncementController@store')->name('post.announcement.store');
        Route::post('/upload-image', 'AnnouncementController@uploadImageContent')->name('post.announcement.upload-image');
        Route::get('/show/{id}', 'AnnouncementController@show')->name('get.announcement.show');
    });

    // Product - Done
    Route::group(['prefix' => 'products'], function () {
        Route::get('/index', 'ProductController@index')->name('get.product.index');
        Route::get('/list-company', 'ProductController@listProduct')->name('get.product.list');
        Route::get('/edit/{id}', 'ProductController@edit')->name('get.product.edit');
        Route::post('/update/{id}', 'ProductController@update')->name('get.product.update');
        Route::get('/create', 'ProductController@create')->name('get.product.create');
        Route::post('/store', 'ProductController@store')->name('get.product.store');
        Route::get('/stop/{id}', 'ProductController@stop')->name('get.product.stop');
    });
});
