<?php
Route::group([
  'prefix' => '/api/audit-log',
  'namespace' => 'Workable\AuditLog\Http\Controllers\Api',
  'middleware' => ["web"]
], function () {
    Route::get('/', 'AuditLogApiBaseController@index')->name('api_get.audit-log.index');
});
