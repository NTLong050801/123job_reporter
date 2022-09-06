<?php
Route::group([
  'namespace' => 'Workable\GoogleLog\Http\Controllers',
  'middleware' => ["web", 'auth.admin.logged']
], function () {
    Route::group(['prefix' => 'analytic',], function () {
        Route::group(['prefix' => 'google-analytic',], function () {
            Route::get('/user', 'GoogleAnalyticController@indexUser')->name('get.google_analytic.user');
            Route::get('/event', 'GoogleAnalyticController@indexEvent')->name('get.google_analytic.event');
            Route::get('/user-chart', 'GoogleAnalyticController@indexUserChart')->name('get.google_analytic.user_chart');
            Route::get('/event-chart', 'GoogleAnalyticController@indexEventChart')->name('get.google_analytic.event_chart');
        });
    });
});
