<?php
Route::group([
  'prefix' => 'product/apply-job',
  'namespace' => 'Workable\ApplyJob\Http\Controllers',
  'middleware' => ["web",  'auth.admin.logged']
], function () {

    Route::get('/overview', 'ApplyJobOverviewController@overview')->name('get.apply-job.overview');
    Route::get('/overview/month', 'ApplyJobOverviewController@byMonth')->name('get.apply-job.by_month');
    Route::get('/by-category', 'ApplyJobReportController@category')->name('get.apply-job.category');
    Route::get('/by-location', 'ApplyJobReportController@location')->name('get.apply-job.location');
    Route::get('/by-salary', 'ApplyJobReportController@salary')->name('get.apply-job.salary');
    Route::get('/by-attribute', 'ApplyJobReportController@attribute')->name('get.apply-job.attribute');

});
