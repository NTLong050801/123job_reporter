<?php
Route::group([
  'prefix' => '/api/job-recruit',
  'namespace' => 'Workable\JobRecruit\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'JobRecruitApiBaseController@index')->name('api_get.job-recruit.index');
});
