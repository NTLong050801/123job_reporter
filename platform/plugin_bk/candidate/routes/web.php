<?php
Route::group([
    'prefix'     => 'product/report',
    'namespace'  => 'Workable\Candidate\Http\Controllers',
    'middleware' => ["web"]
], function ()
{

    //Report
    Route::group(['prefix' => 'cv',], function ()
    {
        Route::get('/list', 'ReportCvController@reportList')->name('get.report_cv.list');
        Route::get('detail', 'ReportCvController@detail')->name('get.report_cv.detail');
        Route::get('/amount', 'ReportCvController@reportAmount')->name('get.report_cv.amount');
    });

    //Multi
    Route::group(['prefix' => 'static',], function ()
    {
        Route::get('/list-career', 'ReportStaticController@reportListCareer')->name('get.report_static.list_career');
        Route::get('/list-rank', 'ReportStaticController@reportListRank')->name('get.report_static.list_rank');
        Route::get('/list-degree', 'ReportStaticController@reportListDegree')->name('get.report_static.list_degree');
        Route::get('/chart', 'ReportStaticController@reportChart')->name('get.report_static.chart');
        Route::get('/chart-career', 'ReportStaticController@reportChartCareer')->name('get.report_static.chart_career');
        Route::get('/chart-rank', 'ReportStaticController@reportChartRank')->name('get.report_static.chart_rank');
        Route::get('/chart-degree', 'ReportStaticController@reportChartDegree')->name('get.report_static.chart_degree');
    });

});
