<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p = get_post(398);
echo "=== TITLE ===\n" . $p->post_title . "\n";
echo "=== CONTENT PREVIEW ===\n";
echo substr($p->post_content, 0, 1500) . "\n...\n";
echo "=== CONTENT LENGTH ===\n" . strlen($p->post_content) . " chars\n";
