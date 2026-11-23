<?php
require_once dirname(__DIR__) . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$images = [
    [
        'source'   => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795420625267_3f8def88.jpg',
        'filename' => 'chinh-sach-ban-hang-du-kien-lalalay-residences.jpg',
        'title'    => 'Chính Sách Bán Hàng Dự Kiến Lalalay Residences',
        'alt'      => 'Chính sách bán hàng dự kiến dự án căn hộ Lalalay Residences Bắc An Khánh',
        'caption'  => 'Đặc quyền áp dụng chung và ưu đãi theo quỹ thường và quỹ Lalakey dự án Lalalay Residences',
    ],
    [
        'source'   => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795420625267_e4395365.jpg',
        'filename' => 'tien-do-thanh-toan-chuan-quy-thuong-lalalay-residences.jpg',
        'title'    => 'Tiến Độ Thanh Toán Chuẩn Quỹ Thường Lalalay Residences',
        'alt'      => 'Tiến độ thanh toán chuẩn quỹ thường 16 đợt căn hộ Lalalay Residences',
        'caption'  => 'Sơ đồ tiến độ thanh toán chuẩn Quỹ Thường chia làm 16 đợt đến năm 2029',
    ],
    [
        'source'   => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795420625267_b0ff27c2.jpg',
        'filename' => 'tien-do-thanh-toan-som-quy-lalakey-lalalay-residences.jpg',
        'title'    => 'Tiến Độ Thanh Toán Sớm Quỹ Lalakey Lalalay Residences',
        'alt'      => 'Tiến độ thanh toán sớm quỹ Lalakey căn hộ Lalalay Residences',
        'caption'  => 'Phương án tiến độ thanh toán sớm quỹ Lalakey nhận chiết khấu 2.5%',
    ],
    [
        'source'   => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795420625267_52aabedc.jpg',
        'filename' => 'tien-do-thanh-toan-sieu-gian-quy-lalakey-lalalay-residences.jpg',
        'title'    => 'Tiến Độ Thanh Toán Siêu Giãn Quỹ Lalakey Lalalay Residences',
        'alt'      => 'Tiến độ thanh toán siêu giãn quỹ Lalakey dự án Lalalay Residences',
        'caption'  => 'Phương án thanh toán siêu giãn quỹ Lalakey kéo dài đến năm 2032',
    ],
];

$upload_dir = wp_upload_dir();
$results = [];

foreach ($images as $img) {
    if (!file_exists($img['source'])) {
        echo "❌ File không tồn tại: {$img['source']}\n";
        continue;
    }

    $dest_path = $upload_dir['path'] . '/' . $img['filename'];
    copy($img['source'], $dest_path);

    $filetype = wp_check_filetype(basename($dest_path), null);
    $attachment = [
        'post_mime_type' => $filetype['type'],
        'post_title'     => $img['title'],
        'post_content'   => $img['caption'],
        'post_excerpt'   => $img['caption'],
        'post_status'    => 'inherit'
    ];

    $attach_id = wp_insert_attachment($attachment, $dest_path, 170); // Parent là post ID 170 (Lalalay Residences)
    $attach_data = wp_generate_attachment_metadata($attach_id, $dest_path);
    wp_update_attachment_metadata($attach_id, $attach_data);
    update_post_meta($attach_id, '_wp_attachment_image_alt', $img['alt']);

    $url = wp_get_attachment_url($attach_id);
    $results[$img['filename']] = [
        'id'  => $attach_id,
        'url' => $url,
        'alt' => $img['alt'],
        'title' => $img['title']
    ];

    echo "✔ Đã import: {$img['filename']} -> ID {$attach_id} ({$url})\n";
}

file_put_contents(__DIR__ . '/lalalay-policy-media-map.json', json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "\n🎉 Hoàn thành import 4 ảnh chính sách & tiến độ thanh toán Lalalay Residences!\n";
