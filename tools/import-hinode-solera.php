<?php
/**
 * Import 3 hình ảnh dự án Hinode Solera Phạm Hùng vào WordPress Media Library
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$images_info = [
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794879845276_410b7046.jpg',
        'slug' => 'phoi-canh-toa-thap-can-ho-cao-cap-hinode-solera-pham-hung',
        'title' => 'Phối Cảnh Tòa Tháp Căn Hộ Cao Cấp Hinode Solera Phạm Hùng',
        'alt' => 'Phối cảnh tòa tháp căn hộ hạng sang Hinode Solera 28 Phạm Hùng Nam Từ Liêm Hà Nội',
        'caption' => 'Phối cảnh kiến trúc hiện đại, sang trọng của tòa tháp căn hộ Hinode Solera Phạm Hùng',
        'key' => 'phoi_canh_toa_thap'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794879845267_3d549148.jpg',
        'slug' => 'vi-tri-du-an-hinode-solera-28-pham-hung-view-ho-cau-giay',
        'title' => 'Vị Trí Dự Án Hinode Solera Số 28 Phạm Hùng Đối Diện Công Viên Hồ Cầu Giấy 32ha',
        'alt' => 'Vị trí dự án Hinode Solera số 28 Phạm Hùng nhìn từ công viên hồ điều hòa Cầu Giấy 32ha đối diện Keangnam và Skylake',
        'caption' => 'Vị trí thực tế dự án Hinode Solera số 28 Phạm Hùng kế cận Keangnam Landmark 72, Vinhomes Skylake và hồ Cầu Giấy 32ha',
        'key' => 'vi_tri_ho_cau_giay'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794879845280_6c08c432.jpg',
        'slug' => 'mat-bang-tang-dien-hinh-can-ho-hinode-solera-pham-hung',
        'title' => 'Mặt Bằng Tầng Điển Hình Dự Án Hinode Solera Phạm Hùng',
        'alt' => 'Mặt bằng tầng điển hình 16 căn hộ Hinode Solera Phạm Hùng gồm căn 1PN, 2PN, 3PN và Dual Key',
        'caption' => 'Mặt bằng tầng điển hình căn hộ cao cấp và Dual Key tại dự án Hinode Solera Phạm Hùng',
        'key' => 'mat_bang_dien_hinh'
    ]
];

$upload_dir = wp_upload_dir();
$media_map = [];

foreach ($images_info as $item) {
    if (!file_exists($item['src'])) {
        echo "❌ File không tồn tại: " . $item['src'] . "\n";
        continue;
    }

    $ext = pathinfo($item['src'], PATHINFO_EXTENSION);
    $filename = $item['slug'] . '.' . $ext;
    $target_path = $upload_dir['path'] . '/' . $filename;

    copy($item['src'], $target_path);

    // Kiểm tra xem attachment đã tồn tại chưa
    $existing = get_posts([
        'post_type' => 'attachment',
        'name' => $item['slug'],
        'posts_per_page' => 1,
        'post_status' => 'inherit'
    ]);

    if (!empty($existing)) {
        $attachment_id = $existing[0]->ID;
        echo "✔ Đã tồn tại media ID: {$attachment_id} - " . $item['slug'] . "\n";
    } else {
        $filetype = wp_check_filetype($filename, null);
        $attachment = [
            'post_mime_type' => $filetype['type'],
            'post_title'     => $item['title'],
            'post_content'   => $item['caption'],
            'post_excerpt'   => $item['caption'],
            'post_status'    => 'inherit',
            'post_name'      => $item['slug']
        ];

        $attachment_id = wp_insert_attachment($attachment, $target_path);
        $attach_data = wp_generate_attachment_metadata($attachment_id, $target_path);
        wp_update_attachment_metadata($attachment_id, $attach_data);
        update_post_meta($attachment_id, '_wp_attachment_image_alt', $item['alt']);
        echo "✔ Đã tạo mới media ID: {$attachment_id} - " . $item['slug'] . "\n";
    }

    $media_map[$item['key']] = [
        'id' => $attachment_id,
        'url' => wp_get_attachment_url($attachment_id),
        'title' => $item['title'],
        'alt' => $item['alt'],
        'caption' => $item['caption'],
        'slug' => $item['slug']
    ];
}

file_put_contents(__DIR__ . '/hinode-media-map.json', json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
echo "🎉 Đã lưu media map vào tools/hinode-media-map.json\n";
