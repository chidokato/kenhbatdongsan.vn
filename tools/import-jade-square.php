<?php
/**
 * Import 10 ảnh của dự án Jade Square vào WordPress Media Library
 */
require_once __DIR__ . '/../wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$appDataDir = 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/';

$images_to_import = [
    [
        'file' => $appDataDir . 'media_1794812835759_21abfa96.jpg',
        'slug' => 'phoi-canh-toan-canh-chung-cu-jade-square-bac-tu-liem',
        'title' => 'Phối Cảnh Toàn Cảnh Tổ Hợp Chung Cư Jade Square Bắc Từ Liêm',
        'alt' => 'Phối cảnh flycam trên cao tổ hợp dự án Jade Square Phạm Văn Đồng Bắc Từ Liêm',
    ],
    [
        'file' => $appDataDir . 'media_1794812835732_a4619ce5.jpg',
        'slug' => 'phoi-canh-toa-can-ho-sapphire-jade-square',
        'title' => 'Phối Cảnh Tòa Căn Hộ Sapphire Dự Án Jade Square',
        'alt' => 'Phối cảnh mặt đứng kính tràn sang trọng Tòa Sapphire chung cư Jade Square',
    ],
    [
        'file' => $appDataDir . 'media_1794812816004_f40dbc60.jpg',
        'slug' => 'vi-tri-toa-do-sieu-ket-noi-jade-square-tay-ho-tay',
        'title' => 'Vị Trí Tọa Độ Siêu Kết Nối Dự Án Jade Square Tây Hồ Tây',
        'alt' => 'Bản đồ vị trí tọa độ siêu kết nối dự án Jade Square đón sóng tăng trưởng Tây Hồ Tây',
    ],
    [
        'file' => $appDataDir . 'media_1794812816056_a5eb4e6c.jpg',
        'slug' => 'tong-mat-bang-39-tien-ich-dang-cap-jade-square',
        'title' => 'Tổng Mặt Bằng 39 Tiện Ích Đẳng Cấp Đa Tầng Jade Square',
        'alt' => 'Sơ đồ bố trí 39 tiện ích đẳng cấp đa tầng phong cách sống nghỉ dưỡng Jade Square',
    ],
    [
        'file' => $appDataDir . 'media_1794812816004_84cb4c77.jpg',
        'slug' => 'mat-bang-tang-dien-hinh-tang-04-24-toa-sapphire-jade-square',
        'title' => 'Mặt Bằng Tầng Điển Hình Tầng 04-24 Tòa Sapphire Jade Square',
        'alt' => 'Mặt bằng tầng 04-24 tòa Sapphire dự án Jade Square 11 căn trên sàn',
    ],
    [
        'file' => $appDataDir . 'media_1794812815996_1fd31782.jpg',
        'slug' => 'mat-bang-tang-dien-hinh-tang-25-26-toa-sapphire-jade-square',
        'title' => 'Mặt Bằng Tầng Điển Hình Tầng 25-26 Tòa Sapphire Jade Square',
        'alt' => 'Mặt bằng tầng 25-26 tòa Sapphire dự án Jade Square 9 căn trên sàn',
    ],
    [
        'file' => $appDataDir . 'media_1794812815988_d114f0af.jpg',
        'slug' => 'thiet-ke-layout-can-ho-2-phong-ngu-jade-square',
        'title' => 'Layout Thiết Kế Căn Hộ 2 Phòng Ngủ Tòa Sapphire Jade Square',
        'alt' => 'Bản vẽ layout thiết kế căn hộ 2 phòng ngủ 71.41m2 đến 85.55m2 chung cư Jade Square',
    ],
    [
        'file' => $appDataDir . 'media_1794812815984_53c33691.jpg',
        'slug' => 'thiet-ke-layout-can-ho-2-phong-ngu-goc-jade-square',
        'title' => 'Layout Thiết Kế Căn Hộ 2 Phòng Ngủ Góc Tòa Sapphire Jade Square',
        'alt' => 'Bản vẽ layout thiết kế căn hộ 2 phòng ngủ góc 79.91m2 tòa Sapphire Jade Square',
    ],
    [
        'file' => $appDataDir . 'media_1794812815985_7882ad07.jpg',
        'slug' => 'thiet-ke-layout-can-ho-3-phong-ngu-jade-square',
        'title' => 'Layout Thiết Kế Căn Hộ 3 Phòng Ngủ Tòa Sapphire Jade Square',
        'alt' => 'Bản vẽ layout thiết kế căn hộ 3 phòng ngủ 127.43m2 đến 127.86m2 tòa Sapphire Jade Square',
    ],
    [
        'file' => $appDataDir . 'media_1794812815992_36481527.jpg',
        'slug' => 'thiet-ke-layout-can-ho-4-phong-ngu-jade-square',
        'title' => 'Layout Thiết Kế Căn Hộ 4 Phòng Ngủ Tòa Sapphire Jade Square',
        'alt' => 'Bản vẽ layout thiết kế căn hộ 4 phòng ngủ rộng 154.02m2 tòa Sapphire Jade Square',
    ],
];

$upload_dir = wp_upload_dir();
$imported_ids = [];

foreach ($images_to_import as $img) {
    if (!file_exists($img['file'])) {
        echo "❌ File không tồn tại: {$img['file']}\n";
        continue;
    }

    $filename = $img['slug'] . '.jpg';
    $target_path = $upload_dir['path'] . '/' . $filename;
    copy($img['file'], $target_path);

    // Kiểm tra xem attachment đã tồn tại chưa
    $existing = get_page_by_path($img['slug'], OBJECT, 'attachment');
    if ($existing) {
        $attach_id = $existing->ID;
        update_attached_file($attach_id, $target_path);
        wp_update_post([
            'ID' => $attach_id,
            'post_title' => $img['title'],
        ]);
        update_post_meta($attach_id, '_wp_attachment_image_alt', $img['alt']);
        $attach_data = wp_generate_attachment_metadata($attach_id, $target_path);
        wp_update_attachment_metadata($attach_id, $attach_data);
        echo " ✔ Đã cập nhật ảnh: [{$img['slug']}] -> ID {$attach_id}\n";
    } else {
        $attachment = [
            'guid'           => $upload_dir['url'] . '/' . $filename,
            'post_mime_type' => 'image/jpeg',
            'post_title'     => $img['title'],
            'post_name'      => $img['slug'],
            'post_content'   => '',
            'post_status'    => 'inherit'
        ];
        $attach_id = wp_insert_attachment($attachment, $target_path);
        $attach_data = wp_generate_attachment_metadata($attach_id, $target_path);
        wp_update_attachment_metadata($attach_id, $attach_data);
        update_post_meta($attach_id, '_wp_attachment_image_alt', $img['alt']);
        echo " + Đã import ảnh mới: [{$img['slug']}] -> ID {$attach_id}\n";
    }

    $imported_ids[$img['slug']] = $attach_id;
}

file_put_contents(__DIR__ . '/jade-media-map.json', json_encode($imported_ids, JSON_PRETTY_PRINT));
echo "🎉 Import Media Jade Square hoàn tất!\n";
