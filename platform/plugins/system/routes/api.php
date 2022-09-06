<?php
Route::group([
  'prefix' => '/api/system',
  'namespace' => 'Workable\System\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'SystemApiBaseController@index')->name('api_get.system.index');
});
