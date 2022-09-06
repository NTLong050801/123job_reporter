<?php
// Công ty --------------------------------------------------------------------------
Breadcrumbs::for('subscribe-overview', function ($trail) {
    $trail->push('subscribe-overview', route('get.subscribe-job.overview'));
});

Breadcrumbs::for('subscribe-overview-month', function ($trail) {
    $trail->parent('subscribe-overview');
    $trail->push('subscribe-overview-month', route('get.subscribe-job.overview_month'));
});


Breadcrumbs::for('subscribe-location', function ($trail) {
    $trail->parent('subscribe-overview');
    $trail->push('subscribe-location', route('get.subscribe-job.location'));
});

Breadcrumbs::for('subscribe-salary', function ($trail) {
    $trail->parent('subscribe-overview');
    $trail->push('subscribe-salary', route('get.subscribe-job.salary'));
});


Breadcrumbs::for('subscribe-position', function ($trail) {
    $trail->parent('subscribe-overview');
    $trail->push('subscribe-position', route('get.subscribe-job.position'));
});