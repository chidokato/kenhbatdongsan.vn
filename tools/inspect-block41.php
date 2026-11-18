<?php
require_once dirname(__DIR__) . '/wp-load.php';

$b = get_post(41);
if ($b) {
    echo "=== BLOCK 41 CONTENT ===\n";
    echo $b->post_content;
}
