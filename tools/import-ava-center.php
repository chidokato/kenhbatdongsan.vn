<?php
/**
 * Import 11 hình ảnh dự án AVA Center (Thuận An - Bình Dương) vào WordPress Media Library
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$images_info = [
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072580948_0bc44d3d.jpg',
        'slug' => 'ava-center-diem-hen-cong-dong-tinh-hoa-van-minh',
        'title' => 'AVA Center - Điểm Hẹn Cộng Đồng Tinh Hoa Văn Minh Thuận An Bình Dương',
        'alt' => 'Phối cảnh tòa tháp căn hộ AVA Center Bình Dương điểm hẹn của cộng đồng cư dân tinh hoa và văn minh',
        'caption' => 'AVA Center Thuận An – Kiến tạo chuẩn mực sống văn minh đỉnh cao cho cộng đồng tinh hoa',
        'key' => 'poster_cong_dong_tinh_hoa'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072580949_10e4d480.jpg',
        'slug' => 'thiet-ke-can-ho-modern-vibes-ava-center-full-noi-that',
        'title' => 'Thiết Kế Căn Hộ Modern Vibes AVA Center Bàn Giao Full Nội Thất',
        'alt' => 'Không gian phòng khách và bếp căn hộ mẫu AVA Center phong cách Modern Vibes bàn giao full nội thất cao cấp',
        'caption' => 'Căn hộ AVA Center bàn giao full nội thất chuẩn phong cách Modern Vibes tinh tế',
        'key' => 'noi_that_modern_vibes'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072580953_dc7be0f5.jpg',
        'slug' => 'phong-cach-duong-dai-can-ho-ava-center-thuan-an',
        'title' => 'Phong Cách Đương Đại Căn Hộ AVA Center Thuận An',
        'alt' => 'Phòng khách căn hộ AVA Center thiết kế phong cách Đương đại với kính thép bê tông trần và gỗ tự nhiên',
        'caption' => 'Phong cách đương đại phóng khoáng mang lại cảm giác mạnh mẽ và ấm cúng cho căn hộ AVA Center',
        'key' => 'phong_cach_duong_dai'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072580957_56e3f477.jpg',
        'slug' => 'phong-cach-toi-gian-phong-ngu-master-ava-center',
        'title' => 'Phong Cách Tối Giản Phòng Ngủ Master Căn Hộ AVA Center',
        'alt' => 'Phòng ngủ master phong cách tối giản thanh lịch tại căn hộ AVA Center với gam màu trung tính xanh pastel',
        'caption' => 'Phòng ngủ master tối giản chắt lọc tinh túy, mở rộng khoảng thở đắt giá cho căn nhà',
        'key' => 'phong_cach_toi_gian'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072580959_f0be7534.jpg',
        'slug' => 'thiet-bi-tien-nghi-smart-home-can-ho-ava-center',
        'title' => 'Thiết Bị Tiện Nghi & Smart Home Thông Minh Căn Hộ AVA Center',
        'alt' => 'Không gian bếp và bàn ăn căn hộ AVA Center tích hợp công nghệ Smart Home và nội thất thông minh đa năng',
        'caption' => 'Tiện nghi ứng dụng thực tế cao kết hợp hệ thống Smart Home tự động hóa tại AVA Center',
        'key' => 'tien_nghi_smart_home'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072581003_e6342de8.jpg',
        'slug' => 'ho-boi-vo-cuc-infinity-sky-pool-ava-center',
        'title' => 'Hồ Bơi Vô Cực Infinity Sky Pool View Hoàng Hôn AVA Center',
        'alt' => 'Hồ bơi vô cực trên cao Infinity Sky Pool tại AVA Center view ngắm hoàng hôn và toàn cảnh thành phố',
        'caption' => 'Hồ bơi vô cực trên cao ngắm trọn hoàng hôn rực rỡ và chân trời thành phố tại AVA Center',
        'key' => 'ho_boi_vo_cuc'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072581011_7895e4d4.jpg',
        'slug' => 'phoi-canh-toan-canh-toa-thap-40-tang-ava-center',
        'title' => 'Phối Cảnh Toàn Cảnh Tòa Tháp Căn Hộ 40 Tầng AVA Center Thuận An',
        'alt' => 'Toàn cảnh tòa tháp căn hộ cao cấp 40 tầng AVA Center mặt tiền Thủ Khoa Huân Bình Dương kề cận tuyến Metro',
        'caption' => 'Tòa tháp biểu tượng 40 tầng AVA Center sừng sững tại cửa ngõ giao thương TP. Thuận An',
        'key' => 'phoi_canh_tong_the'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072581014_9aa8a54b.jpg',
        'slug' => 'banner-tong-quan-du-an-can-ho-ava-center-binh-duong',
        'title' => 'Banner Tổng Quan Dự Án Căn Hộ AVA Center Bình Dương',
        'alt' => 'Banner tổng quan chính sách và tiện ích dự án căn hộ AVA Center bàn giao full nội thất cách Metro 300m vốn từ 186 triệu',
        'caption' => 'AVA Center – Bàn giao full nội thất, cách ga Metro số 6 chỉ 300m, vốn ban đầu từ 186 triệu đồng',
        'key' => 'banner_tong_quan'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072652449_6d607718.jpg',
        'slug' => 'so-do-vi-tri-dac-dia-ket-noi-metro-ava-center',
        'title' => 'Sơ Đồ Vị Trí Đắc Địa & Mạng Lưới Kết Nối Tuyến Metro AVA Center',
        'alt' => 'Sơ đồ vị trí dự án AVA Center mặt tiền Thủ Khoa Huân kết nối Quốc lộ 13 ga Metro và các KCN lớn Bình Dương',
        'caption' => 'Vị trí đắc địa kết nối trực tiếp Quốc lộ 13, Đại lộ Mỹ Phước Tân Vạn và tuyến Metro tương lai',
        'key' => 'so_do_vi_tri'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072652457_498b26c1.jpg',
        'slug' => 'sanh-don-grand-lobby-5-sao-ava-center',
        'title' => 'Sảnh Đón Grand Lobby Chuẩn Khách Sạn 5 Sao AVA Center',
        'alt' => 'Sảnh đón Grand Lobby cao cấp chuẩn khách sạn 5 sao với trần cao thông tầng và đá Marble sang trọng tại AVA Center',
        'caption' => 'Sảnh đón Grand Lobby sang trọng khẳng định đẳng cấp gia chủ ngay từ bước chân đầu tiên',
        'key' => 'sanh_don_grand_lobby'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795072652464_03c881b1.jpg',
        'slug' => 'mat-bang-to-hop-36-tien-ich-doc-ban-ava-center',
        'title' => 'Mặt Bằng Tổ Hợp 36 Tiện Ích Độc Bản Dự Án AVA Center',
        'alt' => 'Bản đồ quy hoạch mặt bằng tổ hợp 36 tiện ích độc bản tại AVA Center Bình Dương',
        'caption' => 'Quy hoạch tổ hợp 36 tiện ích trọn vẹn mọi trải nghiệm sống, học tập và thư giãn tại AVA Center',
        'key' => 'to_hop_36_tien_ich'
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

file_put_contents(__DIR__ . '/ava-center-media-map.json', json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "Hoàn thành import media AVA Center!\n";
