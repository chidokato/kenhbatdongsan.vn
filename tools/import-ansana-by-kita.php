<?php
/**
 * Import 4 hình ảnh dự án Ansana by Kita (Võ Văn Kiệt - Bình Tân - TP.HCM) vào WordPress Media Library
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$images_info = [
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795078149982_f3a63a9d.jpg',
        'slug' => 'phoi-canh-toan-canh-toa-thap-ban-dem-ansana-by-kita',
        'title' => 'Phối Cảnh Toàn Cảnh Các Tòa Tháp Ban Đêm Ansana by Kita Võ Văn Kiệt',
        'alt' => 'Phối cảnh ban đêm toàn cảnh quần thể các tòa tháp căn hộ Ansana by Kita rực sáng trên mặt tiền Đại lộ Võ Văn Kiệt',
        'caption' => 'Quần thể tháp căn hộ biểu tượng cao 24 tầng Ansana by Kita rực sáng lộng lẫy tại cửa ngõ phía Tây TP.HCM',
        'key' => 'phoi_canh_dem_tong_the'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795078149964_3d19402d.jpg',
        'slug' => 'mat-bang-tong-the-masterplan-ansana-by-kita-vo-van-kiet',
        'title' => 'Mặt Bằng Tổng Thể Masterplan Dự Án Ansana by Kita Mặt Tiền Võ Văn Kiệt',
        'alt' => 'Mặt bằng quy hoạch tổng thể Masterplan dự án căn hộ Ansana by Kita mặt tiền Đại lộ Võ Văn Kiệt Bình Tân TP.HCM',
        'caption' => 'Mặt bằng tổng thể 2,43ha dự án Ansana by Kita với hệ sinh thái công viên, hồ bơi resort và các khối tháp hiện đại',
        'key' => 'masterplan_tong_the'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795078149972_844711fc.jpg',
        'slug' => 'ho-boi-tran-bo-resort-ansana-by-kita',
        'title' => 'Hồ Bơi Tràn Bờ Phong Cách Resort Nhiệt Đới Ansana by Kita',
        'alt' => 'Phối cảnh hồ bơi tràn bờ phong cách resort nhiệt đới tại tầng tiện ích khối đế dự án Ansana by Kita Bình Tân',
        'caption' => 'Hồ bơi tràn bờ phong cách resort xanh mát mang lại đặc quyền thư giãn chuẩn Wellness cho cư dân Ansana by Kita',
        'key' => 'ho_boi_resort'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795078149983_77ae028b.jpg',
        'slug' => 'so-do-vi-tri-mat-tien-vo-van-kiet-ansana-by-kita',
        'title' => 'Sơ Đồ Vị Trí Kim Cương Mặt Tiền Đại Lộ Võ Văn Kiệt Ansana by Kita',
        'alt' => 'Sơ đồ vị trí dự án Ansana by Kita mặt tiền Đại lộ Võ Văn Kiệt kết nối Quận 1 Quận 5 Quận 6 và Aeon Mall Bình Tân',
        'caption' => 'Vị trí kim cương mặt tiền Đại lộ Võ Văn Kiệt, tâm điểm siêu kết nối giao thương giữa trung tâm TP.HCM và khu Tây',
        'key' => 'so_do_vi_tri'
    ]
];

$upload_dir = wp_upload_dir();
$target_dir = $upload_dir['path'];
$target_url = $upload_dir['url'];

$media_map = [];

foreach ($images_info as $item) {
    $src = $item['src'];
    if (!file_exists($src)) {
        echo "File không tồn tại: $src\n";
        continue;
    }

    $ext = pathinfo($src, PATHINFO_EXTENSION);
    $filename = $item['slug'] . '.' . $ext;
    $target_file = $target_dir . '/' . $filename;

    // Check if attachment with same slug exists
    $existing = get_posts([
        'post_type' => 'attachment',
        'name' => $item['slug'],
        'posts_per_page' => 1,
        'post_status' => 'inherit'
    ]);

    if (!empty($existing)) {
        $attach_id = $existing[0]->ID;
        echo "Attachment đã tồn tại: ID $attach_id - " . $item['slug'] . "\n";
        $media_map[$item['key']] = [
            'id' => $attach_id,
            'url' => wp_get_attachment_url($attach_id),
            'title' => $item['title'],
            'alt' => $item['alt'],
            'caption' => $item['caption']
        ];
        continue;
    }

    copy($src, $target_file);

    $filetype = wp_check_filetype($filename, null);
    $attachment = [
        'post_mime_type' => $filetype['type'],
        'post_title' => $item['title'],
        'post_name' => $item['slug'],
        'post_content' => $item['alt'],
        'post_excerpt' => $item['caption'],
        'post_status' => 'inherit'
    ];

    $attach_id = wp_insert_attachment($attachment, $target_file);
    $attach_data = wp_generate_attachment_metadata($attach_id, $target_file);
    wp_update_attachment_metadata($attach_id, $attach_data);

    update_post_meta($attach_id, '_wp_attachment_image_alt', $item['alt']);

    echo "Đã import thành công: ID $attach_id - " . $item['slug'] . "\n";
    $media_map[$item['key']] = [
        'id' => $attach_id,
        'url' => wp_get_attachment_url($attach_id),
        'title' => $item['title'],
        'alt' => $item['alt'],
        'caption' => $item['caption']
    ];
}

file_put_contents(__DIR__ . '/ansana-by-kita-media-map.json', json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "Hoàn thành import media Ansana by Kita!\n";
