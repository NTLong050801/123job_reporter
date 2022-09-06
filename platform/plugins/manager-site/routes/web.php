<?php
Route::group([
    'prefix' => 'company/manager-site',
    'namespace' => 'Workable\ManagerSite\Http\Controllers',
    'middleware' => ["web"]
], function () {

    Route::get('/index', 'ManagerSiteBaseController@index')->name('get.manager-site.index');
    Route::get('/add', 'ManagerSiteBaseController@create')->name('get.manager-site.add');
    Route::post('/store', 'ManagerSiteBaseController@store')->name('post.manager-site.store');
    Route::post('/update{id}', 'ManagerSiteBaseController@update')->name('post.manager-site.update');
    Route::get('/edit{id}', 'ManagerSiteBaseController@edit')->name('get.manager-site.edit');
    Route::get('/delete{id}', 'ManagerSiteBaseController@delete')->name('get.manager-site.delete');



});
