<?php
require_once dirname(__DIR__) . '/wp-load.php';

$blocks = get_posts([
    'post_type' => 'flatsome_block',
    'posts_per_page' => -1,
    'post_status' => 'any'
]);

echo "Total blocks: " . count($blocks) . "\n";
foreach ($blocks as $b) {
    echo "ID: {$b->ID} | Slug: {$b->post_name} | Title: {$b->post_title}\n";
}
