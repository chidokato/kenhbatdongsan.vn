<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p = get_post(3);
if ($p) {
    echo "STATUS: {$p->post_status}\n";
    echo "CONTENT:\n{$p->post_content}\n";
} else {
    echo "Page 3 not found.\n";
}
