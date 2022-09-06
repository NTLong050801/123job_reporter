<?php
Route::group([
  'prefix' => '/api/attribute',
  'namespace' => 'Workable\Attribute\Http\Controllers\Api'
], function () {
    Route::get('/', 'AttributeApiController@index');
});
