<?php
require_once dirname(__DIR__) . '/wp-load.php';

$listings = get_posts([
    'post_type' => 'bat_dong_san',
    'posts_per_page' => 2,
    'meta_query' => [
        [
            'key' => '_kbds_project_ref',
            'value' => 398, // An Bình Homeland
            'compare' => '='
        ]
    ]
]);

foreach ($listings as $l) {
    echo "Listing ID: {$l->ID} | Title: {$l->post_title}\n";
    $metas = get_post_meta($l->ID);
    foreach ($metas as $k => $v) {
        if (strpos($k, '_kbds') === 0 || strpos($k, 'gia') !== false) {
            echo "  $k => {$v[0]}\n";
        }
    }
}
