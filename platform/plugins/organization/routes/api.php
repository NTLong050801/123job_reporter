<?php
Route::group([
  'prefix' => '/api/organization',
  'namespace' => 'Workable\Organization\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'OrganizationApiBaseController@index')->name('api_get.organization.index');
});
