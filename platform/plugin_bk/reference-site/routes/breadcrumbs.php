<?php
// Công ty --------------------------------------------------------------------------
Breadcrumbs::for('reference-job-day', function ($trail) {
    $trail->push('Report refer by day', route('get.reference-site.overview'));
});

Breadcrumbs::for('reference-job-site', function ($trail) {
    $trail->push('Report refer by website', route('get.reference-site.by-site'));
});

Breadcrumbs::for('reference-job-category', function ($trail) {
    $trail->push('Report refer by category', route('get.reference-site.by-site'));
});

Breadcrumbs::for('reference-job-city', function ($trail) {
    $trail->push('Report refer by city', route('get.reference-site.by-site'));
});

Breadcrumbs::for('reference-job-salary', function ($trail) {
    $trail->push('Report refer by salary', route('get.reference-site.by-site'));
});