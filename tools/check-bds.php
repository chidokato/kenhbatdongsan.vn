<?php
require_once dirname(__DIR__) . '/wp-load.php';

$posts = get_posts(['post_type' => 'bat_dong_san', 'posts_per_page' => 2]);
foreach ($posts as $p) {
    echo "ID: {$p->ID} - {$p->post_title}\n";
    foreach (get_post_meta($p->ID) as $k => $v) {
        if (strpos($k, '_kbds') === 0) {
            echo "  $k => {$v[0]}\n";
        }
    }
}
