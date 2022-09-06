<?php
Route::group([
    'prefix' => 'api/robot-visit',
    'namespace' => 'Workable\RobotLog\Http\Controllers\Api',
    // 'middleware' => ["web"]
], function () {

    Route::post('/store-multi', 'RobotVisitApiController@storeMulti')->name('api_post.robot_visit.store_multi');

});
