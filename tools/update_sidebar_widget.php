<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/../wp-load.php';

$widgets = get_option('widget_block');
if (isset($widgets[2])) {
    $content = '<!-- wp:html -->
<div class="kbds-sidebar-lead-box" style="margin-bottom:24px;">
    ' . do_shortcode('[kbds_quick_lead_card title="ĐĂNG KÝ NHẬN BẢNG GIÁ" subtitle="Tài liệu cập nhật trực tiếp từ Chủ đầu tư, gửi bảo mật qua Zalo trong 3 phút:"]') . '
</div>
<!-- /wp:html -->';
    
    $widgets[2]['content'] = $content;
    update_option('widget_block', $widgets);
    echo "[+] Đã cập nhật Widget Block 2 đồng bộ với hệ thống shortcode & tracking URL!\n";
} else {
    echo "[-] Không tìm thấy widget_block 2\n";
}
