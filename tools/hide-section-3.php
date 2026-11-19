<?php
/**
 * Tạm thời ẩn Section 3: Giỏ hàng Chuyển nhượng & Suất đẹp Xác thực trên Trang Chủ
 */
require_once dirname(__DIR__) . '/wp-load.php';

$page_id = 42;
$page = get_post($page_id);

if (!$page) {
    echo "❌ Không tìm thấy Trang chủ ID 42\n";
    exit(1);
}

echo "Current content:\n" . $page->post_content . "\n---\n";

// Bỏ [block id="sec-3-gio-hang-xac-thuc"]
$new_content = preg_replace(
    '/\[block\s+id=["\']sec-3-gio-hang-xac-thuc["\']\]\s*/i',
    "<!-- [TAM_AN] sec-3-gio-hang-xac-thuc -->\n\n",
    $page->post_content
);

wp_update_post([
    'ID' => $page_id,
    'post_content' => $new_content
]);

echo "✔ Đã cập nhật Trang chủ (Page ID 42):\n" . $new_content . "\n";
