<?php
/**
 * Import 15 ảnh dự án An Bình Homeland vào WordPress Media Library
 */
require_once __DIR__ . '/../wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$upload_dir = wp_upload_dir();
$dest_dir = $upload_dir['basedir'] . '/2026/11';
if (!is_dir($dest_dir)) {
    wp_mkdir_p($dest_dir);
}

$images = [
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725910_eae6a9e6.jpg',
        'slug'   => 'thiet-ke-phong-ngu-master-an-binh-homeland-1',
        'title'  => 'Thiết Kế Phòng Ngủ Master Sang Trọng Chung Cư An Bình Homeland',
        'alt'    => 'Thiết kế nội thất phòng ngủ master view thành phố thoáng đãng căn hộ An Bình Homeland Lê Trọng Tấn'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725915_16b403c9.jpg',
        'slug'   => 'thiet-ke-phong-ngu-hien-dai-an-binh-homeland-2',
        'title'  => 'Phòng Ngủ Căn Hộ Chung Cư An Bình Homeland Phong Cách Hiện Đại',
        'alt'    => 'Không gian phòng ngủ tinh tế với hệ tủ kính và đèn led sang trọng tại An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725921_a7f57919.jpg',
        'slug'   => 'phong-khach-bep-an-binh-homeland',
        'title'  => 'Không Gian Phòng Khách Liền Bếp Chung Cư An Bình Homeland',
        'alt'    => 'Khu vực phòng ăn và phòng khách liên thông tối ưu công năng tại chung cư An Bình Homeland Hà Đông'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725924_f3c0e6bc.jpg',
        'slug'   => 'phong-khach-sang-trong-an-binh-homeland',
        'title'  => 'Phòng Khách Căn Hộ Cao Cấp An Bình Homeland Geleximco',
        'alt'    => 'Nội thất phòng khách rộng thoáng với ban công kính tràn viền dự án An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725925_46892cae.jpg',
        'slug'   => 'phong-khach-view-panorama-an-binh-homeland',
        'title'  => 'Phòng Khách Ban Công Panorama Chung Cư An Bình Homeland',
        'alt'    => 'Tầm view khoáng đạt từ ban công phòng khách căn hộ góc An Bình Homeland Lê Trọng Tấn'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725933_a021da4c.jpg',
        'slug'   => 'phoi-canh-tong-the-4-toa-an-binh-homeland',
        'title'  => 'Phối Cảnh Toàn Cảnh 4 Tòa Tháp Chung Cư An Bình Homeland Mặt Đường Lê Trọng Tấn',
        'alt'    => 'Phối cảnh 4 tòa căn hộ cao 25 tầng An Bình Homeland Geleximco tại KĐT Geleximco Lê Trọng Tấn'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725941_e0ab73bb.jpg',
        'slug'   => 'quang-truong-cong-vien-noi-khu-an-binh-homeland',
        'title'  => 'Quảng Trường Ánh Sáng & Biểu Tượng Cổng Chào An Bình Homeland',
        'alt'    => 'Khuôn viên quảng trường trung tâm kết nối 4 tòa tháp chung cư An Bình Homeland về đêm'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725947_9057716a.jpg',
        'slug'   => 'phoi-canh-tren-cao-4-toa-an-binh-homeland',
        'title'  => 'Phối Cảnh Chim Bay Tổ Hợp Chung Cư An Bình Homeland Geleximco',
        'alt'    => 'Tổng thể quy hoạch hình chữ U ôm trọn công viên và hồ bơi dự án An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725953_353b9043.jpg',
        'slug'   => 'phong-an-can-ho-mau-an-binh-homeland',
        'title'  => 'Khu Vực Bàn Ăn Ấm Cúng Căn Hộ Mẫu Chung Cư An Bình Homeland',
        'alt'    => 'Không gian phòng ăn thiết kế hiện đại sang trọng căn hộ An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725953_61d15982.jpg',
        'slug'   => 'phong-ngu-nho-an-binh-homeland',
        'title'  => 'Thiết Kế Phòng Ngủ Nhỏ Tối Ưu Ánh Sáng Tự Nhiên An Bình Homeland',
        'alt'    => 'Phòng ngủ phụ với cửa sổ kính đón ánh sáng tự nhiên tại dự án An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725956_90069483.jpg',
        'slug'   => 'phong-ngu-tre-em-giuong-tang-an-binh-homeland',
        'title'  => 'Phòng Ngủ Trẻ Em Thông Minh Giường Tầng An Bình Homeland',
        'alt'    => 'Thiết kế phòng ngủ trẻ em tone xanh pastel sáng tạo với giường tầng và bàn học đôi An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725962_9d5fb02d.jpg',
        'slug'   => 'phong-ve-sinh-hien-dai-an-binh-homeland',
        'title'  => 'Phòng Vệ Sinh Bàn Giao Thiết Bị Cao Cấp An Bình Homeland',
        'alt'    => 'Nội thất phòng tắm ốp đá cao cấp có vách kính tắm đứng tại chung cư An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725965_00333b6b.jpg',
        'slug'   => 'mat-bang-tong-the-tang-1-an-binh-homeland',
        'title'  => 'Mặt Bằng Tổng Thể Tầng 1 Tổ Hợp 4 Tòa C1 C2 C3 C4 An Bình Homeland',
        'alt'    => 'Bản đồ quy hoạch mặt bằng tầng 1 với công viên cây xanh 3840m2 dự án An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725968_f3f60bb0.jpg',
        'slug'   => 'mat-bang-tang-dien-hinh-toa-c1-an-binh-homeland',
        'title'  => 'Mặt Bằng Căn Hộ Tầng Điển Hình 6-23 Tòa C1 Chung Cư An Bình Homeland',
        'alt'    => 'Chi tiết mặt bằng tầng điển hình tòa C1 từ tầng 6 đến 23 gồm 14 căn hộ An Bình Homeland'
    ],
    [
        'source' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1795403725973_c1665fa8.jpg',
        'slug'   => 'phoi-canh-ho-boi-resort-an-binh-homeland',
        'title'  => 'Phối Cảnh Hồ Bơi Resort & Công Viên Cảnh Quan Nội Khu An Bình Homeland',
        'alt'    => 'Hồ bơi nhiệt đới uốn lượn phong cách nghỉ dưỡng giữa lõi 4 tòa tháp An Bình Homeland'
    ]
];

$media_map = [];

foreach ($images as $img) {
    if (!file_exists($img['source'])) {
        echo "❌ File không tồn tại: {$img['source']}\n";
        continue;
    }

    $filename = $img['slug'] . '.jpg';
    $dest_file = $dest_dir . '/' . $filename;
    copy($img['source'], $dest_file);

    // Kiểm tra xem đã tồn tại attachment với slug này chưa
    $existing = get_posts([
        'post_type'      => 'attachment',
        'name'           => $img['slug'],
        'posts_per_page' => 1,
        'post_status'    => 'inherit'
    ]);

    if (!empty($existing)) {
        $attach_id = $existing[0]->ID;
        wp_update_post([
            'ID'         => $attach_id,
            'post_title' => $img['title']
        ]);
        update_post_meta($attach_id, '_wp_attachment_image_alt', $img['alt']);
        echo "✔ Cập nhật media ID {$attach_id}: {$img['slug']}\n";
    } else {
        $wp_filetype = wp_check_filetype($dest_file, null);
        $attachment = [
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => $img['title'],
            'post_name'      => $img['slug'],
            'post_content'   => '',
            'post_status'    => 'inherit'
        ];
        $attach_id = wp_insert_attachment($attachment, $dest_file);
        $attach_data = wp_generate_attachment_metadata($attach_id, $dest_file);
        wp_update_attachment_metadata($attach_id, $attach_data);
        update_post_meta($attach_id, '_wp_attachment_image_alt', $img['alt']);
        echo "✔ Đã import media ID {$attach_id}: {$img['slug']}\n";
    }

    $media_map[$img['slug']] = [
        'id'   => $attach_id,
        'url'  => wp_get_attachment_url($attach_id),
        'alt'  => $img['alt'],
        'title'=> $img['title']
    ];
}

file_put_contents(__DIR__ . '/an-binh-homeland-media-map.json', json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "\n🎉 Hoàn thành import " . count($media_map) . " ảnh vào Media Library!\n";
