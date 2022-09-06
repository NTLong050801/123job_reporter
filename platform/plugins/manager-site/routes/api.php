<?php
Route::group([
  'prefix' => '/api/manager-site',
  'namespace' => 'Workable\ManagerSite\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'ManagerSiteApiBaseController@index')->name('api_get.manager-site.index');
});
