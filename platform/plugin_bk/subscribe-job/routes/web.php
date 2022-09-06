<?php
Route::group([
  'prefix' => '/product/subscribe-job',
  'namespace' => 'Workable\SubscribeJob\Http\Controllers',
  'middleware' => ["web",  'auth.admin.logged']
], function ()
{
    Route::get('/overview', 'SubscribeJobOverviewController@overview')->name('get.subscribe-job.overview');
    Route::get('/overview/month', 'SubscribeJobOverviewController@overviewMonth')->name('get.subscribe-job.overview_month');
    Route::get('/location', 'SubscribeJobReportController@location')->name('get.subscribe-job.location');
    Route::get('/salary', 'SubscribeJobReportController@salary')->name('get.subscribe-job.salary');
    Route::get('/position', 'SubscribeJobReportController@position')->name('get.subscribe-job.position');
    Route::get('/attribute', 'SubscribeJobReportController@attribute')->name('get.subscribe-job.attribute');

});
