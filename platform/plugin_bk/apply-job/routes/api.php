<?php
Route::group([
  'prefix' => '/api/apply-job',
  'namespace' => 'Workable\ApplyJob\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {

    Route::post('/store', 'ApplyJobApiBaseController@store');

    // Report
    Route::get('/report', 'ApplyJobApiController@report');
});
