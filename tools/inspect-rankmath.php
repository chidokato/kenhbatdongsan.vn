<?php
require_once dirname(__DIR__) . '/wp-load.php';

$posts = get_posts(['posts_per_page' => 5, 'post_type' => ['post', 'du_an', 'page']]);
foreach ($posts as $p) {
    echo "--- Post ID: {$p->ID} ({$p->post_title}) ---\n";
    $m = get_post_meta($p->ID);
    foreach ($m as $k => $v) {
        if (strpos($k, 'rank_math') !== false) {
            echo "  $k => " . print_r(maybe_unserialize($v[0]), true) . "\n";
        }
    }
}
