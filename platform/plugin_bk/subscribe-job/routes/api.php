<?php
Route::group([
  'prefix' => '/api/subscribe-job',
  'namespace' => 'Workable\SubscribeJob\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {

    Route::post('/store', 'SubscribeJobApiBaseController@store')->name('api_get.subscribe-job.store');

});
