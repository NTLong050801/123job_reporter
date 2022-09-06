<?php
// Công ty --------------------------------------------------------------------------
Breadcrumbs::for('apply-job-overview', function ($trail) {
    $trail->push('Apply overview', route('get.apply-job.overview'));
});


Breadcrumbs::for('apply-job-category', function ($trail) {
    $trail->parent('apply-job-overview');
    $trail->push('Apply by category', route('get.apply-job.category'));
});

Breadcrumbs::for('apply-job-location', function ($trail) {
    $trail->parent('apply-job-overview');
    $trail->push('Apply by location', route('get.apply-job.location'));
});

Breadcrumbs::for('apply-job-salary', function ($trail) {
    $trail->parent('apply-job-overview');
    $trail->push('Apply by salary', route('get.apply-job.salary'));
});

Breadcrumbs::for('apply-job-attribute', function ($trail) {
    $trail->parent('apply-job-overview');
    $trail->push('Apply by attribute', route('get.apply-job.attribute'));
});