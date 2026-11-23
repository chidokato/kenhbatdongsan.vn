<?php
require_once dirname(__DIR__) . '/wp-load.php';
$posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1]);
foreach ($posts as $p) {
    if (!get_post_meta($p->ID, '_kbds_project_ref', true)) {
        echo "Post ID: {$p->ID} | {$p->post_title}\n";
    }
}
