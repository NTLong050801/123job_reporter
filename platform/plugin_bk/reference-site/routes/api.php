<?php
Route::group([

  'prefix' => '/api/reference-site',
  'namespace' => 'Workable\ReferenceSite\Http\Controllers\Api',
  'middleware' => ["web"]

], function () {

    Route::get('/index', 'ReferenceSiteApiBaseController@index');
    Route::post('/store', 'ReferenceSiteApiBaseController@store');

    // Report
    Route::get('/report', 'ReferenceSiteApiController@report');
});
