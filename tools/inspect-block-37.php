<?php
require_once dirname(__DIR__) . '/wp-load.php';

$block = get_post(37);
echo "=== TITLE ===\n" . $block->post_title . "\n";
echo "=== SLUG ===\n" . $block->post_name . "\n";
echo "=== CONTENT ===\n" . $block->post_content . "\n";
