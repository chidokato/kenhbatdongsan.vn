<?php
/**
 * Import 13 hình ảnh dự án The Win City (Đức Hòa - Long An) vào WordPress Media Library
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$images_info = [
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746482_6fe3f03f.jpg',
        'slug' => 'phoi-canh-tong-the-dai-do-thi-the-win-city-duc-hoa-long-an',
        'title' => 'Phối Cảnh Toàn Cảnh Đại Đô Thị The Win City Đức Hòa Long An (13,18ha)',
        'alt' => 'Phối cảnh toàn cảnh hoàng hôn đại đô thị The Win City 13,18ha gồm 18 block tháp và tháp Win Mark 42 tầng tại Đức Hòa Long An',
        'caption' => 'Phối cảnh tổng thể đại đô thị The Win City quy mô 13,18 ha mặt tiền Tỉnh Lộ 10 giáp ranh TP.HCM',
        'key' => 'tong_the_hoang_hon'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746457_993fd5dc.jpg',
        'slug' => 'quy-hoach-tong-the-3-phan-khu-thap-victory-hermes-the-win-city',
        'title' => 'Quy Hoạch Tổng Thể 3 Phân Khu & Tháp Hoàng Hậu Victory Hermes The Win City',
        'alt' => 'Phối cảnh ban đêm 3 phân khu Victory Heights, Glory Sky, Prime Majestic và tháp Victory Hermes The Win City',
        'caption' => 'Sơ đồ vị trí 3 phân khu cùng hệ thống tiện ích: Tháp Win Mark 42 tầng, Victory Central 5.500m2, Win Edu',
        'key' => 'quy_hoach_3_phan_khu'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746426_f769813e.jpg',
        'slug' => 'mat-bang-dien-hinh-tang-05-22-phan-khu-victory-heights-vic12-the-win-city',
        'title' => 'Mặt Bằng Điển Hình Tầng 05 - 22 Tháp VIC 1.2 Phân Khu Victory Heights The Win City',
        'alt' => 'Mặt bằng tầng 05-22 tháp VIC 1.2 phân khu Victory Heights The Win City gồm 22 căn hộ 1PN, 1PN+, 2PN-1WC, 2PN-2WC',
        'caption' => 'Mặt bằng điển hình tầng 05 đến 22 tháp VIC 1.2 thuộc phân khu Victory Heights The Win City',
        'key' => 'mat_bang_vic12'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746478_1fa39317.jpg',
        'slug' => 'pho-thuong-mai-shophouse-khoi-de-sam-uat-the-win-city',
        'title' => 'Phố Thương Mại Shophouse Khối Đế Sầm Uất The Win City',
        'alt' => 'Phối cảnh tuyến phố shophouse mua sắm, ẩm thực và dịch vụ giải trí sầm uất tại khối đế The Win City',
        'caption' => 'Tuyến phố thương mại shophouse khối đế quy tụ chuỗi F&B, thời trang và siêu thị tiện lợi',
        'key' => 'pho_shophouse'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746448_fe50ae3f.jpg',
        'slug' => 'cong-vien-vuon-hoa-noi-khu-lang-man-the-win-city',
        'title' => 'Công Viên Vườn Hoa Nội Khu Lãng Mạn The Win City',
        'alt' => 'Công viên cảnh quan vườn hoa rực rỡ và đường dạo bộ giữa các tòa tháp căn hộ The Win City',
        'caption' => 'Không gian sống xanh ngát và thi vị với công viên ngập tràn sắc hoa dành cho cư dân The Win City',
        'key' => 'vuon_hoa_noi_khu'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746464_16d38c1a.jpg',
        'slug' => 'quang-truong-cong-vien-xanh-the-win-city',
        'title' => 'Quảng Trường Công Viên Xanh & Khu Vui Chơi Gia Đình The Win City',
        'alt' => 'Quảng trường cảnh quan công viên xanh rộng lớn cho gia đình dạo bộ thư giãn tại The Win City',
        'caption' => 'Hệ thống cây xanh cảnh quan và công viên nội khu mang lại không khí trong lành quanh năm',
        'key' => 'cong_vien_canh_quan'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746470_089062e9.jpg',
        'slug' => 'sky-garden-ban-cong-xanh-thu-gian-the-win-city',
        'title' => 'Thiết Kế Ban Công Xanh Sky Garden Thoáng Đãng The Win City',
        'alt' => 'Phối cảnh thiết kế ban công rộng mở ngập tràn mảng xanh Sky Garden tại căn hộ The Win City',
        'caption' => 'Ban công rộng mở kết nối thiên nhiên, nơi gia chủ thư giãn ngắm nhìn thành phố sau ngày dài',
        'key' => 'ban_cong_sky_garden'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746434_555f7fb5.jpg',
        'slug' => 'can-ho-mau-phong-khach-sang-trong-the-win-city',
        'title' => 'Không Gian Phòng Khách Căn Hộ Mẫu The Win City',
        'alt' => 'Nội thất phòng khách căn hộ mẫu The Win City tràn ngập ánh sáng tự nhiên với view ban công thoáng đạt',
        'caption' => 'Phòng khách căn hộ mẫu The Win City phong cách tối giản thanh lịch, đón trọn ánh sáng tự nhiên',
        'key' => 'phong_khach_mau_1'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746467_6e34f654.jpg',
        'slug' => 'can-ho-mau-phong-sinh-hoat-chung-hien-dai-the-win-city',
        'title' => 'Không Gian Sinh Hoạt Chung Hiện Đại Căn Hộ The Win City',
        'alt' => 'Không gian sinh hoạt chung hiện đại với smart TV lớn và sofa êm ái tại căn hộ The Win City',
        'caption' => 'Góc nhìn ấm cúng kết nối phòng khách, khu ăn uống và không gian nghỉ ngơi tiện nghi',
        'key' => 'phong_khach_mau_2'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746451_1d85d688.jpg',
        'slug' => 'thiet-ke-can-ho-studio-1pn-khong-gian-mo-the-win-city',
        'title' => 'Thiết Kế Căn Hộ Studio & 1 Phòng Ngủ Không Gian Mở The Win City',
        'alt' => 'Thiết kế căn hộ Studio và 1 phòng ngủ không gian mở thông minh, tối ưu công năng tại The Win City',
        'caption' => 'Layout căn hộ Studio / 1PN thiết kế mở, đón trọn gió trời và ánh sáng tự nhiên',
        'key' => 'can_ho_studio_1pn'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746436_96694c32.jpg',
        'slug' => 'phong-ngu-master-noi-that-go-an-cuong-the-win-city',
        'title' => 'Phòng Ngủ Master Bàn Giao Nội Thất Gỗ An Cường The Win City',
        'alt' => 'Phòng ngủ Master ấm áp với hệ tủ quần áo và bàn trang điểm gỗ An Cường cao cấp tại The Win City',
        'caption' => 'Phòng ngủ Master bố trí khoa học, sử dụng vật liệu gỗ công nghiệp cao cấp từ đối tác Gỗ An Cường',
        'key' => 'phong_ngu_master'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746440_5a585f62.jpg',
        'slug' => 'goc-ban-an-trang-tri-tinh-te-can-ho-the-win-city',
        'title' => 'Góc Bàn Ăn Ấm Cúng & Trang Trí Tinh Tế Căn Hộ The Win City',
        'alt' => 'Khu vực bàn ăn gia đình nhỏ thiết kế trang nhã phong cách hiện đại tại căn hộ The Win City',
        'caption' => 'Khu vực bàn ăn xinh xắn, tối ưu diện tích cho các gia đình trẻ an cư',
        'key' => 'ban_an_can_ho'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795055746551_e9171a09.jpg',
        'slug' => 'khu-bep-tien-nghi-vat-lieu-an-cuong-the-win-city',
        'title' => 'Khu Bếp Tiện Nghi Bàn Giao Vật Liệu Gỗ An Cường The Win City',
        'alt' => 'Khu bếp nấu tiện nghi hiện đại với tủ bếp gỗ An Cường bề mặt Melamine chống ẩm tại The Win City',
        'caption' => 'Hệ tủ bếp hiện đại, thiết kế công thái học từ thương hiệu hàng đầu Gỗ An Cường',
        'key' => 'khu_bep_an_cuong'
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
        $target_path = $upload_dir['path'] . '/' . $filename;
        copy($item['src'], $target_path);

        $filetype = wp_check_filetype($filename, null);
        $attachment = [
            'guid'           => $upload_dir['url'] . '/' . $filename,
            'post_mime_type' => $filetype['type'],
            'post_title'     => $item['title'],
            'post_name'      => $item['slug'],
            'post_content'   => '',
            'post_excerpt'   => $item['caption'],
            'post_status'    => 'inherit'
        ];

        $att_id = wp_insert_attachment($attachment, $target_path);
        $attach_data = wp_generate_attachment_metadata($att_id, $target_path);
        wp_update_attachment_metadata($att_id, $attach_data);
        update_post_meta($att_id, '_wp_attachment_image_alt', $item['alt']);

        echo " + Đã tải lên ảnh mới: {$item['title']} (ID: {$att_id})\n";
    }

    $media_map[$item['key']] = [
        'id'  => $att_id,
        'url' => wp_get_attachment_url($att_id),
        'title' => $item['title'],
        'alt' => $item['alt'],
        'caption' => $item['caption']
    ];
}

$output_file = __DIR__ . '/the-win-city-media-map.json';
file_put_contents($output_file, json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "\n🎉 HOÀN TẤT IMPORT! Đã lưu ánh xạ ảnh vào: {$output_file}\n";
