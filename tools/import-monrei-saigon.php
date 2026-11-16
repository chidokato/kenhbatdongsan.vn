<?php
/**
 * Import 7 hình ảnh dự án Monrei Saigon vào WordPress Media Library
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$images_info = [
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794820762054_c524621c.jpg',
        'slug' => 'ho-boi-resort-dong-song-luoi-monrei-saigon',
        'title' => 'Hồ Bơi Resort Dòng Sông Lười Monrei Saigon',
        'alt' => 'Phối cảnh hồ bơi nhiệt đới dòng sông lười uốn lượn tại dự án Monrei Saigon',
        'caption' => 'Tổ hợp hồ bơi resort dòng sông lười phong cách nhiệt đới xanh mát tại Monrei Saigon',
        'key' => 'song_luoi'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794820762046_bdec5a31.jpg',
        'slug' => 'thac-nuoc-may-mua-monrei-saigon',
        'title' => 'Thác Nước Mây Mưa Monrei Saigon',
        'alt' => 'Thác nước mây mưa biểu tượng cảnh quan thư giãn tại Monrei Saigon',
        'caption' => 'Thác nước mây mưa độc đáo tại quảng trường nội khu dự án Monrei Saigon',
        'key' => 'thac_nuoc_may_mua'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794820762058_f19b1215.jpg',
        'slug' => 'aqua-massage-thuy-lieu-monrei-saigon',
        'title' => 'Aqua Massage Thủy Liệu Monrei Saigon',
        'alt' => 'Hồ thủy liệu trị liệu Aqua Massage Bed tại Monrei Saigon',
        'caption' => 'Giường massage thủy liệu Aqua Massage Bed giúp thư giãn cơ thể và tăng tuần hoàn máu',
        'key' => 'aqua_massage'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794820762066_45008b71.jpg',
        'slug' => 'be-suc-nuoc-am-sento-mitsubishi-monrei-saigon',
        'title' => 'Bể Sục Nước Ấm Sento Mitsubishi Monrei Saigon',
        'alt' => 'Bể sục nước ấm Sento tái tạo năng lượng mang thương hiệu Mitsubishi tại Monrei Saigon',
        'caption' => 'Bể sục nước ấm Sento phong cách Nhật Bản tái tạo nguồn năng lượng sống dồi dào',
        'key' => 'be_suc_sento'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794820762073_c86beff6.jpg',
        'slug' => 'to-hop-khoang-nong-onsen-monrei-saigon',
        'title' => 'Tổ Hợp Khoáng Nóng Onsen Monrei Saigon',
        'alt' => 'Tổ hợp suối khoáng nóng Onsen Nhật Bản phục hồi tuần hoàn sâu tại Monrei Saigon',
        'caption' => 'Tổ hợp khoáng nóng Onsen view hoàng hôn tuyệt mỹ phục hồi thể chất và tinh thần',
        'key' => 'khoang_nong_onsen'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794820762075_f3d9866b.jpg',
        'slug' => 'san-choi-nuoc-kodomo-monrei-saigon',
        'title' => 'Sân Chơi Nước Kodomo Monrei Saigon',
        'alt' => 'Sân chơi nước trẻ em Kodomo rực rỡ sắc màu hoa anh đào tại Monrei Saigon',
        'caption' => 'Sân chơi nước Kodomo và công viên hoa anh đào Sakura dành riêng cho cư dân nhí',
        'key' => 'san_choi_kodomo'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794820762086_e46561d5.jpg',
        'slug' => 'hinh-anh-thuc-te-tien-do-thi-cong-monrei-saigon',
        'title' => 'Hình Ảnh Thực Tế Tiến Độ Thi Công Monrei Saigon',
        'alt' => 'Toàn cảnh hình ảnh thực tế công trường thi công dự án Monrei Saigon năm 2026',
        'caption' => 'Tiến độ thi công thực tế tại công trường dự án Monrei Saigon với hệ thống cẩu tháp hiện đại',
        'key' => 'tien_do_thuc_te'
    ]
];

$media_map = [];

foreach ($images_info as $item) {
    if (!file_exists($item['src'])) {
        echo "❌ File không tồn tại: " . $item['src'] . "\n";
        continue;
    }

    $ext = pathinfo($item['src'], PATHINFO_EXTENSION);
    $filename = $item['slug'] . '.' . $ext;

    // Kiểm tra xem attachment đã tồn tại chưa theo slug
    $existing = get_posts([
        'post_type' => 'attachment',
        'name' => $item['slug'],
        'posts_per_page' => 1,
        'post_status' => 'inherit'
    ]);

    if (!empty($existing)) {
        $att_id = $existing[0]->ID;
        echo " ✔ Đã tồn tại ảnh: {$item['title']} (ID: {$att_id})\n";
    } else {
        $upload_dir = wp_upload_dir();
        $target_path = $upload_dir['path'] . '/' . $filename;
        copy($item['src'], $target_path);

        $filetype = wp_check_filetype($filename, null);
        $attachment = [
            'guid'           => $upload_dir['url'] . '/' . $filename,
            'post_mime_type' => $filetype['type'],
            'post_title'     => $item['title'],
            'post_name'      => $item['slug'],
            'post_content'   => $item['caption'],
            'post_excerpt'   => $item['caption'],
            'post_status'    => 'inherit'
        ];

        $att_id = wp_insert_attachment($attachment, $target_path);
        $attach_data = wp_generate_attachment_metadata($att_id, $target_path);
        wp_update_attachment_metadata($att_id, $attach_data);
        update_post_meta($att_id, '_wp_attachment_image_alt', $item['alt']);

        echo " + Đã import ảnh mới: {$item['title']} (ID: {$att_id})\n";
    }

    $media_map[$item['key']] = [
        'id'  => $att_id,
        'url' => wp_get_attachment_url($att_id),
        'title' => $item['title'],
        'alt' => $item['alt'],
        'caption' => $item['caption']
    ];
}

file_put_contents(__DIR__ . '/monrei-media-map.json', json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "✔ Đã lưu mapping ảnh vào tools/monrei-media-map.json\n";
