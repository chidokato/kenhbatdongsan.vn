<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p237 = get_post(237);
echo "=== POST 237 first 600 chars ===\n" . substr($p237->post_content, 0, 600) . "\n\n";

$p29 = get_post(29);
echo "=== POST 29 first 600 chars ===\n" . substr($p29->post_content, 0, 600) . "\n\n";
