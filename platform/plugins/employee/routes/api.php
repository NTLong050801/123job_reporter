<?php
Route::group([
  'prefix' => '/api/employee',
  'namespace' => 'Workable\Employee\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'EmployeeApiBaseController@index')->name('api_get.employee.index');
});
