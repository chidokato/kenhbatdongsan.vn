<?php
require_once dirname(__DIR__) . '/wp-load.php';

$block = get_page_by_path('sec-3-gio-hang-xac-thuc', OBJECT, 'flatsome_block');
if (!$block) {
    // Try search
    $blocks = get_posts([
        'post_type' => 'flatsome_block',
        'posts_per_page' => -1
    ]);
    foreach ($blocks as $b) {
        if (strpos($b->post_name, 'sec-3') !== false || strpos($b->post_title, 'Section 3') !== false) {
            $block = $b;
            break;
        }
    }
}

if ($block) {
    echo "Found block: ID={$block->ID}, Title={$block->post_title}, Slug={$block->post_name}\n";
    echo "Content preview:\n" . substr($block->post_content, 0, 1000) . "\n";
} else {
    echo "Block not found!\n";
}
