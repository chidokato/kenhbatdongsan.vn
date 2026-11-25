<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p = get_post(398);
file_put_contents(__DIR__ . '/an-binh-homeland-content.html', $p->post_content);
echo "Written an-binh-homeland-content.html: " . strlen($p->post_content) . " bytes\n";
