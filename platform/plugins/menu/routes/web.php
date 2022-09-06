<?php
Route::group([
  'prefix' => 'menu',
  'namespace' => 'Workable\Menu\Http\Controllers',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'MenuBaseController@index')->name('get.menu.index');
});
