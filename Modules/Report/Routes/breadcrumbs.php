<?php

Breadcrumbs::for('seo_content', function ($trail) {
    $trail->push('Seo content', route('get.seo_content.index'));
});
