<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p = get_post(29);
$fixed = str_replace('http://localhost/www/kenhbds/', 'https://kenhbatdongsan.vn/', $p->post_content);
if ($fixed !== $p->post_content) {
    wp_update_post(['ID' => 29, 'post_content' => $fixed]);
    echo "Fixed post 29 localhost link!\n";
} else {
    echo "No localhost link in post 29.\n";
}
