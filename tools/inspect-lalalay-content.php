<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p = get_post(170);
$content = $p->post_content;

// Show Section 2 (Sub-Nav)
if (preg_match('/\[section label="2\. Menu Phụ[^\]]*\].*?\[\/section\]/s', $content, $m)) {
    echo "=== SUB-NAV ===\n" . $m[0] . "\n\n";
}

// Show Section 10 (Giỏ Hàng & Bảng Tính Lãi Vay)
if (preg_match('/\[section label="10\. Giỏ Hàng[^\]]*\].*?\[\/section\]/s', $content, $m)) {
    echo "=== SECTION 10 ===\n" . substr($m[0], 0, 1500) . "\n\n";
}
