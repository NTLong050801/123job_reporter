<?php
// Công ty --------------------------------------------------------------------------
Breadcrumbs::for('employee', function ($trail) {
    $trail->push('Danh sách nhân sự', route('get.employee.index'));
});

Breadcrumbs::for('employee::edit', function ($trail) {
    $trail->parent('employee');
    $trail->push('Sửa thông tin');
});

Breadcrumbs::for('employee::add', function ($trail) {
    $trail->parent('employee');
    $trail->push('Thêm mới');
});
