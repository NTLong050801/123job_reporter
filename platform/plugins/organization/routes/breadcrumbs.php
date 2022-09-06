<?php
// Công ty --------------------------------------------------------------------------
Breadcrumbs::for('company', function ($trail) {
    $trail->push('Danh sách Công ty', route('get.company.index'));
});

Breadcrumbs::for('company::edit', function ($trail) {
    $trail->parent('company');
    $trail->push('Sửa thông tin');
});

Breadcrumbs::for('company::add', function ($trail) {
    $trail->parent('company');
    $trail->push('Thêm mới');
});



// Phòng ban --------------------------------------------------------------------------
Breadcrumbs::for('department', function ($trail) {
    $trail->push('Danh sách phòng ban', route('get.department.index'));
});

Breadcrumbs::for('department::edit', function ($trail) {
    $trail->parent('department');
    $trail->push('Sửa thông tin');
});

Breadcrumbs::for('department::add', function ($trail) {
    $trail->parent('department');
    $trail->push('Thêm mới');
});



// Thông báo --------------------------------------------------------------------------
Breadcrumbs::for('announcement', function ($trail) {
    $trail->push('Danh sách thông báo', route('get.announcement.index'));
});

Breadcrumbs::for('announcement::show', function ($trail) {
    $trail->parent('announcement');
    $trail->push('Thông báo');
});

Breadcrumbs::for('announcement::edit', function ($trail) {
    $trail->parent('announcement');
    $trail->push('Sửa thông tin');
});

Breadcrumbs::for('announcement::add', function ($trail) {
    $trail->parent('announcement');
    $trail->push('Thêm mới');
});


// Product  --------------------------------------------------------------------------
Breadcrumbs::for('product', function ($trail) {
    $trail->push('Danh sách', route('get.product.index'));
});

Breadcrumbs::for('product::edit', function ($trail) {
    $trail->parent('product');
    $trail->push('Sửa thông tin');
});

Breadcrumbs::for('product::add', function ($trail) {
    $trail->parent('product');
    $trail->push('Thêm mới');
});
