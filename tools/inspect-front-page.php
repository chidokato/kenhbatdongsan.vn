<?php
require_once dirname(__DIR__) . '/wp-load.php';

$front_id = get_option('page_on_front');
echo "page_on_front: $front_id\n";
if ($front_id) {
    $p = get_post($front_id);
    echo "Title: {$p->post_title}\n";
    echo "Slug: {$p->post_name}\n";
    echo "Content:\n{$p->post_content}\n";
} else {
    echo "show_on_front is: " . get_option('show_on_front') . "\n";
}
