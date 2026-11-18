<?php
require_once dirname(__DIR__) . '/wp-load.php';

$b = get_post(123);
echo "=== UX BLOCK 123 CONTENT ===\n";
echo $b->post_content;
