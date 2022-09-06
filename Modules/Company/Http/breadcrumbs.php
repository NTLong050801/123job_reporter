<?php

// Module  --------------------------------------------------------------------------
Breadcrumbs::for('module', function ($trail) {
    $trail->push('Danh sách module', route('get.module.index'));
});

Breadcrumbs::for('module::edit', function ($trail) {
    $trail->parent('module');
    $trail->push('Sửa module');
});

Breadcrumbs::for('module::sort', function ($trail) {
    $trail->parent('module');
    $trail->push('Sắp xếp module');
});

// Menu  --------------------------------------------------------------------------
Breadcrumbs::for('menu', function ($trail) {
    $trail->push('Danh sách menu', route('get.menu.index'));
});

Breadcrumbs::for('menu::edit', function ($trail) {
    $trail->parent('menu');
    $trail->push('Sửa menu');
});

Breadcrumbs::for('menu::add', function ($trail) {
    $trail->parent('menu');
    $trail->push('Thêm menu');
});
