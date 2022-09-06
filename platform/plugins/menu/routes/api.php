<?php
Route::group([
  'prefix' => '/api/menu',
  'namespace' => 'Workable\Menu\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'MenuApiBaseController@index')->name('api_get.menu.index');
});
