<?php
Route::group([
  'prefix' => '/api/google-log',
  'namespace' => 'Workable\GoogleLog\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'GoogleLogApiBaseController@index')->name('api_get.google-log.index');
});
