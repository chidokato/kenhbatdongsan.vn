<?php
require_once dirname(__DIR__) . '/wp-load.php';
$p = get_post(403);
echo "ID 403 first 600 chars:\n" . substr($p->post_content, 0, 600);
