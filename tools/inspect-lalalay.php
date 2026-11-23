<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p = get_page_by_path('lalalay-residences', OBJECT, 'du_an');
if ($p) {
    echo "Project ID: {$p->ID}, Title: {$p->post_title}\n";
    echo "Content Length: " . strlen($p->post_content) . "\n";
    echo "Meta:\n";
    print_r(get_post_meta($p->ID));
} else {
    echo "Not found by path lalalay-residences\n";
    $posts = get_posts(['post_type' => 'any', 's' => 'Lalalay', 'posts_per_page' => 10]);
    foreach ($posts as $item) {
        echo "Found: {$item->ID} - {$item->post_title} (type: {$item->post_type}, slug: {$item->post_name})\n";
    }
}
