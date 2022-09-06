<?php


// Thuộc tính --------------------------------------------------------------------------
Breadcrumbs::for('attribute', function ($trail) {
    $trail->push('Danh sách thuộc tính', route('get.adm_attr.index'));
});

Breadcrumbs::for('attribute::edit', function ($trail) {
    $trail->parent('attribute');
    $trail->push('Sửa thông tin');
});

Breadcrumbs::for('attribute::add', function ($trail) {
    $trail->parent('attribute');
    $trail->push('Thêm mới');
});
