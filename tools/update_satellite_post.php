<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/../wp-load.php';

$post_id = 126;
set_post_thumbnail($post_id, 145);

$content = get_post_field('post_content', $post_id);

// Thay thế thẻ figure SVG cũ bằng thẻ figure của ảnh ID 145 (Sân golf)
$old_figure_pattern = '/<figure class="wp-block-image size-large kbds-seo-figure".*?<\/figure>/s';
$new_figure = sprintf(
    '<figure class="wp-block-image size-large kbds-seo-figure" style="margin:24px 0;text-align:center;"><img src="%s" alt="%s" title="%s" class="wp-image-%d" style="width:100%%;height:auto;border-radius:10px;box-shadow:0 4px 16px rgba(11,44,77,0.08);" loading="lazy" /><figcaption style="font-size:13.5px;color:#64748B;font-style:italic;margin-top:8px;">%s</figcaption></figure>',
    esc_url(wp_get_attachment_url(145)),
    'Phối cảnh cầu cảnh quan sang đảo sân golf 18 lỗ quốc tế 90ha tại Vinhomes King Park Bắc Ninh',
    'Phối Cảnh Cầu Đi Bộ Cảnh Quan Nối Đảo Sân Golf 18 Lỗ Vinhomes King Park',
    145,
    'Cầu đi bộ cảnh quan biểu tượng dẫn lối sang ốc đảo sân golf 18 lỗ quốc tế 90ha đẳng cấp quý tộc.'
);

$updated_content = preg_replace($old_figure_pattern, $new_figure, $content, 1);

// Chèn thêm ảnh TTTM Vincom & Shophouse (ID 143) vào trước mục Vincom hoặc All-in-one nếu có
$vincom_figure = sprintf(
    '<figure class="wp-block-image size-large kbds-seo-figure" style="margin:24px 0;text-align:center;"><img src="%s" alt="%s" title="%s" class="wp-image-%d" style="width:100%%;height:auto;border-radius:10px;box-shadow:0 4px 16px rgba(11,44,77,0.08);" loading="lazy" /><figcaption style="font-size:13.5px;color:#64748B;font-style:italic;margin-top:8px;">%s</figcaption></figure>',
    esc_url(wp_get_attachment_url(143)),
    'Phối cảnh trung tâm thương mại Vincom Mega Mall và chuỗi shophouse Vinhomes King Park',
    'Phối Cảnh TTTM Vincom Mega Mall & Tuyến Phố Shophouse Vinhomes King Park',
    143,
    'Đại lộ sầm uất cùng Trung tâm thương mại Vincom Mega Mall và chuỗi Shophouse phục vụ cư dân.'
);

if (strpos($updated_content, '<h2>3. Hệ sinh thái tiện ích "All-in-one"') !== false) {
    $updated_content = str_replace(
        '<h2>3. Hệ sinh thái tiện ích "All-in-one"',
        $vincom_figure . "\n<h2>3. Hệ sinh thái tiện ích \"All-in-one\"",
        $updated_content
    );
}

// Chèn ảnh công viên hồ điều hòa (ID 144) trước phần 101,69 ha cây xanh
$park_figure = sprintf(
    '<figure class="wp-block-image size-large kbds-seo-figure" style="margin:24px 0;text-align:center;"><img src="%s" alt="%s" title="%s" class="wp-image-%d" style="width:100%%;height:auto;border-radius:10px;box-shadow:0 4px 16px rgba(11,44,77,0.08);" loading="lazy" /><figcaption style="font-size:13.5px;color:#64748B;font-style:italic;margin-top:8px;">%s</figcaption></figure>',
    esc_url(wp_get_attachment_url(144)),
    'Phối cảnh công viên hồ điều hòa và đường dạo bộ ven sông Vinhomes King Park',
    'Phối Cảnh Công Viên Hồ Điều Hòa & Đường Dạo Bộ Ven Sông Vinhomes King Park',
    144,
    'Đường dạo bộ ven hồ rộng thênh thang trong không gian sinh thái 101,69 ha cây xanh mặt nước.'
);

if (strpos($updated_content, '<h2>2. Điểm nhấn Sân Golf 18 lỗ 90 ha') !== false) {
    $updated_content = str_replace(
        '<h2>2. Điểm nhấn Sân Golf 18 lỗ 90 ha',
        $park_figure . "\n<h2>2. Điểm nhấn Sân Golf 18 lỗ 90 ha",
        $updated_content
    );
}

wp_update_post(array(
    'ID'           => $post_id,
    'post_content' => $updated_content,
));

echo "[+] Đã cập nhật bài viết vệ tinh ID 126 với các hình ảnh phối cảnh chất lượng cao mới!\n";
