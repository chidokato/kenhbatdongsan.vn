<?php
/**
 * Import 6 hình ảnh dự án The President Park (Mễ Trì - Nam Từ Liêm - Hà Nội) vào WordPress Media Library
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$images_info = [
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795070472184_ed1f6e96.jpg',
        'slug' => 'phoi-canh-tong-the-the-president-park-me-tri-ha-noi',
        'title' => 'The President Park - Biểu Tượng Phong Cách Sống Trường Tồn Tại Mễ Trì Hà Nội',
        'alt' => 'Phối cảnh tổng thể dự án biệt thự dinh thự The President Park Mễ Trì Hà Nội kiến trúc Tân Cổ Điển sang trọng',
        'caption' => 'The President Park Mễ Trì - Biểu tượng phong cách sống trường tồn tại tâm điểm phía Tây Hà Nội',
        'key' => 'poster_tong_the'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795070472205_6862b6b1.jpg',
        'slug' => 'quang-truong-la-ma-dai-phun-nuoc-ban-dem-the-president-park',
        'title' => 'Quảng Trường La Mã Vòm Colosseum & Đài Phun Nước Ban Đêm The President Park',
        'alt' => 'Toàn cảnh quảng trường La Mã kiến trúc vòm Colosseum và quần thể biệt thự The President Park Mễ Trì lung linh ban đêm',
        'caption' => 'Không gian quảng trường La Mã tráng lệ và quần thể biệt thự compound khép kín tại The President Park',
        'key' => 'quang_truong_colosseum_dem'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795070472207_9cb5b0c1.jpg',
        'slug' => 'thap-obelisk-dai-phun-nuoc-hoang-gia-the-president-park',
        'title' => 'Cột Tháp Obelisk Hoàng Gia & Đài Phun Nước Nghệ Thuật The President Park',
        'alt' => 'Cột tháp Obelisk hoàng gia và đài phun nước phong cách châu Âu tại trung tâm The President Park Mễ Trì',
        'caption' => 'Quảng trường trung tâm với cột tháp Obelisk vương giả và đài phun nước biểu tượng thịnh vượng',
        'key' => 'thap_obelisk_dai_phun_nuoc'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795070472163_6d0b3945.jpg',
        'slug' => 'to-hop-clubhouse-5-sao-golf-3d-the-president-park',
        'title' => 'Tổ Hợp Clubhouse 5 Sao Sang Trọng & Phòng Tập Golf 3D The President Park',
        'alt' => 'Tổ hợp Clubhouse 5 sao The President Park gồm phòng tập Golf 3D màn hình vòm, Gym Yoga Spa, bể bơi tràn bờ ngoài trời và trường mầm non 500 cháu',
        'caption' => 'Tổ hợp Clubhouse 5 sao sang trọng tại lõi xanh trung tâm The President Park Mễ Trì',
        'key' => 'clubhouse_5_sao'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795070472176_e65a91fb.jpg',
        'slug' => 'ham-do-xe-ngam-thong-minh-sieu-xe-the-president-park',
        'title' => 'Hệ Thống Hầm Đỗ Xe Ngầm Thông Minh Cho Siêu Xe Dưới Công Viên Sinh Thái The President Park',
        'alt' => 'Mặt cắt hệ thống hầm đỗ xe ngầm thông minh ẩn mình dưới công viên sinh thái The President Park độc lập hoàn toàn không liên quan đất nhà dân',
        'caption' => 'Hầm đỗ xe ngầm sinh thái thông minh cơ cấu thang nâng 2 tầng độc quyền cho dàn siêu xe của cư dân',
        'key' => 'ham_ngam_sieu_xe'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795070472389_72506682.jpg',
        'slug' => 'vi-tri-kim-cuong-nga-tu-cuong-kien-luong-the-vinh-the-president-park',
        'title' => 'Sơ Đồ Vị Trí Kim Cương Ngã Tư Cương Kiên - Lương Thế Vinh Kéo Dài The President Park',
        'alt' => 'Sơ đồ vị trí dự án The President Park tại ngã tư Cương Kiên và Lương Thế Vinh kéo dài đối diện Vinhomes Green Bay Mễ Trì',
        'caption' => 'Vị trí kim cương kết nối trực tiếp Cương Kiên, Lương Thế Vinh kéo dài, Đại lộ Thăng Long và Tố Hữu',
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

file_put_contents(__DIR__ . '/the-president-park-media-map.json', json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "Hoàn thành import media The President Park!\n";
