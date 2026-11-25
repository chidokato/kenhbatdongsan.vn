<?php
require_once dirname(__DIR__) . '/wp-load.php';

$projects = get_posts([
    'post_type' => 'du_an',
    'posts_per_page' => 2,
    'post_status' => 'publish'
]);

foreach ($projects as $p) {
    echo "====================================\n";
    echo "ID: {$p->ID} | Slug: {$p->post_name}\n";
    echo "Title: {$p->post_title}\n";
    echo "Taxonomies:\n";
    $taxonomies = get_object_taxonomies('du_an');
    foreach ($taxonomies as $tax) {
        $terms = wp_get_post_terms($p->ID, $tax, ['fields' => 'names']);
        if (!empty($terms)) {
            echo "  $tax: " . implode(', ', $terms) . "\n";
        }
    }
    echo "Meta fields:\n";
    $metas = get_post_meta($p->ID);
    foreach ($metas as $k => $v) {
        if (strpos($k, '_kbds') === 0 || strpos($k, 'rank_math') === 0 || strpos($k, 'du_an') === 0 || in_array($k, ['gia', 'dien_tich', 'vi_tri', 'chu_dau_tu', 'quy_mo', 'loai_hinh', 'tien_do'])) {
            echo "  $k: " . substr($v[0], 0, 100) . "\n";
        }
    }
}
