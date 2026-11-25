<?php
require_once dirname(__DIR__) . '/wp-load.php';

$local = get_page_by_path('lumi-hanoi', OBJECT, 'du_an');
echo "=== METAS ON LOCAL POST {$local->ID} ===\n";
foreach (get_post_meta($local->ID) as $k => $v) {
    if (strpos($k, '_kbds') === 0 || strpos($k, 'rank_math') === 0) {
        echo "  $k => " . substr($v[0], 0, 80) . "\n";
    }
}
