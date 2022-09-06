<?php
Route::group([
  'prefix' => 'job-recruit',
  'namespace' => 'Workable\JobRecruit\Http\Controllers',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'JobRecruitBaseController@index')->name('get.job-recruit.index');
});
