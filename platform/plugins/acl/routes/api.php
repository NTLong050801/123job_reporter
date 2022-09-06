<?php
Route::group([
  'prefix' => '/api/acl',
  'namespace' => 'Workable\Acl\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'AclApiBaseController@index')->name('api_get.acl.index');
});
