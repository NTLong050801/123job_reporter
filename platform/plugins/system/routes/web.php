<?php
Route::group([
  'prefix' => 'system',
  'namespace' => 'Workable\System\Http\Controllers',
  'middleware' => ["web"]
], function () {
    Route::prefix('logs')->group(function () {
        Route::get('index', 'LogController@index')->name('get.system.logs.index');
        Route::get('main', 'LogController@indexMain')->name('get.system.logs.main');
    });
});
