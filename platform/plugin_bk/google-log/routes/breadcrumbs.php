<?php
Route::group([
  'prefix' => 'google-log',
  'namespace' => 'Workable\GoogleLog\Http\Controllers',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'GoogleLogBaseController@index')->name('get.google-log.index');
});
