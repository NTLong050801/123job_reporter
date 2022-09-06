<?php
Route::group([
  'prefix' => 'robot-log',
  'namespace' => 'Workable\RobotLog\Http\Controllers',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'RobotLogBaseController@index')->name('get.robot-log.index');
});
