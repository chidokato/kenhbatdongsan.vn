<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "=== KHÔI PHỤC SECTION CHUYỂN NHƯỢNG TRÊN TRANG CHỦ ===\n";

$front_id = get_option('page_on_front');
if (!$front_id) {
    $p = get_page_by_path('trang-chu');
    $front_id = $p ? $p->ID : 42;
}

$page = get_post($front_id);
echo "Front page ID: {$front_id}, Title: {$page->post_title}\n";

$old_content = $page->post_content;
$new_content = str_replace(
    '<!-- [TAM_AN] sec-3-gio-hang-xac-thuc -->',
    '[block id="sec-3-gio-hang-xac-thuc"]',
    $old_content
);

if ($new_content !== $old_content) {
    wp_update_post([
        'ID' => $front_id,
        'post_content' => $new_content
    ]);
    echo "✔ Đã khôi phục [block id=\"sec-3-gio-hang-xac-thuc\"] trên trang chủ local!\n";
} else {
    // If not found, check if it was missing completely
    if (strpos($old_content, 'sec-3-gio-hang-xac-thuc') === false) {
        $new_content = str_replace(
            '[block id="sec-2c-du-an-tinh-thanh"]',
            "[block id=\"sec-2c-du-an-tinh-thanh\"]\n\n[block id=\"sec-3-gio-hang-xac-thuc\"]",
            $old_content
        );
        wp_update_post([
            'ID' => $front_id,
            'post_content' => $new_content
        ]);
        echo "✔ Đã thêm lại [block id=\"sec-3-gio-hang-xac-thuc\"] sau section 2c!\n";
    } else {
        echo "Section 3 đã có mặt trên trang chủ local.\n";
    }
}

// Ensure block 37 has limit=8 for better display
$b37 = get_post(37);
if ($b37) {
    wp_update_post([
        'ID' => 37,
        'post_content' => '[kbds_sec_listings subtitle="CAM KẾT HÌNH THẬT • GIÁ THẬT • PHÁP LÝ RÕ RÀNG" title="Giỏ Hàng Chuyển Nhượng &amp; Suất Ngoại Giao Chọn Lọc" limit="8"]'
    ]);
    echo "✔ Đã tối ưu Block 37 hiển thị 8 suất chuyển nhượng chọn lọc.\n";
}
