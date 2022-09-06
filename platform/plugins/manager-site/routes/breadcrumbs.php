<?php
// ManagerSite --------------------------------------------------------------------------
Breadcrumbs::for('site', function ($trail) {
    $trail->push('Danh sách', route('get.manager-site.index'));
});

Breadcrumbs::for('site::add', function ($trail) {
    $trail->parent('site');
    $trail->push('Thêm mới');
});

Breadcrumbs::for('site::edit', function ($trail) {
    $trail->parent('site');
    $trail->push('Chỉnh sửa');
});
