<?php
Route::group([
  'middleware' => ['web', 'auth.admin.logged', 'uri_permission'],
  'prefix' => config('company::config.prefix') . '/company',
  'namespace' => 'Workable\Acl\Http\Controllers',
], function () {
    // Role - Done
    Route::group(['prefix' => 'roles'], function () {
      Route::get('/index', 'RoleController@index')->name('get.role.index');
      Route::get('/edit/{id}', 'RoleController@edit')->name('get.role.edit');
      Route::post('/update/{id}', 'RoleController@update')->name('get.role.update');
      Route::get('/create', 'RoleController@create')->name('get.role.create');
      Route::post('/store', 'RoleController@store')->name('get.role.store');
      Route::get('/role-admin/{id}', 'RoleController@roleAdmin')->name('get.role.admin');
      Route::get('/role-permission/{id}', 'RoleController@rolePermission')->name('get.role.permission');
      Route::get('/role-admin/{role}/{user}', 'RoleController@roleAdminUpdate')->name('get.role.admin_update');
  });
  // Permission
  Route::group(['prefix' => 'permission'], function () {
    Route::get('/index', 'PermissionController@index')->name('get.permission.index');
    Route::get('/assign-role', 'PermissionController@assignRole')->name('get.permission.assign_role');
    Route::post('/ajax-assign-role', 'PermissionController@ajaxAssignRole')->name('ajax_post.permission.assign_role');
    Route::get('/assign-admin', 'PermissionController@assignAdmin')->name('get.permission.assign_admin');
    Route::post('/ajax-assign-admin', 'PermissionController@ajaxAssignAdmin')->name('ajax_post.permission.assign_admin');
    Route::get('/permission-role/{id}', 'PermissionController@permissionRole')->name('get.permission.role');
    Route::get('/permission-admin/{id}', 'PermissionController@permissionAdmin')->name('get.permission.admin');
    Route::get('/permission-role-update/{permission}/{role}', 'PermissionController@permissionRoleUpdate')->name('get.permission.role_update');
    Route::get('/permission-admin-update/{permission}/{user}', 'PermissionController@permissionAdminUpdate')->name('get.permission.admin_update');
});
});
