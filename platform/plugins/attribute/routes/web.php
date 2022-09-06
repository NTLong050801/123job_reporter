<?php
// Done
Route::group([
    'prefix' => 'setting/attribute',
    'namespace' => 'Workable\Attribute\Http\Controllers',
    'middleware' => 'web'
], function () {
    Route::get('/index', 'AttributeController@index')->name('get.adm_attr.index');
    Route::get('/edit/{id}', 'AttributeController@edit')->name('get.adm_attr.edit');
    Route::post('/update/{id}', 'AttributeController@update')->name('get.adm_attr.update');
    Route::get('/create', 'AttributeController@create')->name('get.adm_attr.create');
    Route::post('store', 'AttributeController@store')->name('get.adm_attr.store');
    Route::get('status/{id}', 'AttributeController@status')->name('get.adm_attr.status');
});
