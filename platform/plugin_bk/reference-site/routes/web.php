<?php
Route::group([
  'prefix' => 'product/reference',
  'namespace' => 'Workable\ReferenceSite\Http\Controllers',
  'middleware' => ["web",  'auth.admin.logged']
], function () {
    Route::get('overview', 'ReferenceSiteReportByDayController@overview')->name('get.reference-site.overview');
    Route::get('overview/month', 'ReferenceSiteReportByDayController@byMonth')->name('get.reference-site.month');
    Route::get('by-site', 'ReferenceSiteReportBySiteController@bySite')->name('get.reference-site.by-site');
    Route::get('by-category', 'ReferenceSiteReportBySiteController@byCategory')->name('get.reference-site.by-category');
    Route::get('by-location', 'ReferenceSiteReportBySiteController@byLocation')->name('get.reference-site.by-location');
    Route::get('by-salary', 'ReferenceSiteReportBySiteController@bySalary')->name('get.reference-site.by-salary');
});
