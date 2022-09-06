<?php
// Vai trò  --------------------------------------------------------------------------
Breadcrumbs::for('role', function ($trail) {
    $trail->push('Danh sách vai trò', route('get.role.index'));
});

Breadcrumbs::for('role::edit', function ($trail) {
    $trail->parent('role');
    $trail->push('Sửa vai trò');
});

Breadcrumbs::for('role::add', function ($trail) {
    $trail->parent('role');
    $trail->push('Thêm mới vai trò');
});
