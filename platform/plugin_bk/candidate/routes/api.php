<?php
Route::group([
    'middleware' => ["web"],
    'prefix' => '/api/product',
    'namespace' => 'Workable\Candidate\Http\Controllers\Api',
], function () {
    Route::get('/', 'CandidateApiBaseController@index')->name('api_get.candidate.index');
    Route::post('/store', 'CandidateApiController@store')->name('api_post.candidate.store');
});
