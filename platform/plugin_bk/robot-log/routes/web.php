<?php
Route::group([
    'prefix' => 'analytic/robot',
    'namespace' => 'Workable\RobotLog\Http\Controllers',
    'middleware' => ["web", 'auth.admin.logged']
], function () {
    Route::get('visit-index', 'RobotVisitController@index')->name('get.robot_visit.index');
    Route::get('counter-by-day', 'RobotCounterController@indexByDay')->name('get.robot_counter.by_day');
    Route::get('counter-chart', 'RobotCounterController@indexChart')->name('get.robot_counter.chart');
});
