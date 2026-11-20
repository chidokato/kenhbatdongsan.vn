<?php
/**
 * Import 4 ảnh thực tế do người dùng cung cấp cho dự án Hinode Solera Phạm Hùng
 */
$root = dirname(__DIR__);
require_once $root . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$user_media_dir = 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded';
$upload_dir = wp_upload_dir();
$target_dir = $upload_dir['basedir'] . '/2026/11';
if (!file_exists($target_dir)) {
    wp_mkdir_p($target_dir);
}

$images_to_import = [
    'view_ho_cau_giay_panorama' => [
        'source' => $user_media_dir . '/media_1795141729080_1498364d.jpg',
        'filename' => 'tam-nhin-panorama-view-ho-dieu-hoa-cau-giay-tu-hinode-solera.jpg',
        'title' => 'Tầm Nhìn Panorama View Hồ Điều Hòa Cầu Giấy 32ha Và Tuyến Đường Phạm Hùng Từ Hinode Solera',
        'alt' => 'Tầm nhìn panorama thực tế hướng trọn công viên hồ điều hòa Cầu Giấy 32ha và Cung thiếu nhi Hà Nội từ Hinode Solera 28 Phạm Hùng',
        'caption' => 'Tầm nhìn không giới hạn hướng trọn công viên hồ điều hòa Cầu Giấy 32ha và tuyến Vành đai 3 trên cao từ Hinode Solera 28 Phạm Hùng'
    ],
    'thuc_te_cat_noc_toa_thap' => [
        'source' => $user_media_dir . '/media_1795141729082_cc618ecc.jpg',
        'filename' => 'tien-do-thuc-te-cat-noc-toa-thap-hinode-solera-28-pham-hung.jpg',
        'title' => 'Tiến Độ Thực Tế Tòa Tháp Hinode Solera 28 Phạm Hùng Đã Cất Nóc Hoàn Thiện Phần Thô',
        'alt' => 'Hình ảnh thực tế tòa nhà Hinode Solera 28 Phạm Hùng đã cất nóc xong phần thô đang tiến hành hoàn thiện mặt ngoài và nội thất',
        'caption' => 'Hình ảnh thực tế công trường Hinode Solera số 28 Phạm Hùng: Tòa tháp đã cất nóc hoàn thiện phần thô và đang lắp đặt hoàn thiện'
    ],
    'ha_tang_khu_vuc_my_dinh' => [
        'source' => $user_media_dir . '/media_1795141729091_b6acc43e.jpg',
        'filename' => 'khu-do-thi-my-dinh-me-tri-ke-can-hinode-solera-pham-hung.jpg',
        'title' => 'Khu Đô Thị Mỹ Đình - Mễ Trì Và Hệ Thống Hạ Tầng Kề Cận Hinode Solera Phạm Hùng',
        'alt' => 'Quần thể khu đô thị Mỹ Đình Mễ Trì với hạ tầng đồng bộ kế cận dự án Hinode Solera 28 Phạm Hùng',
        'caption' => 'Hệ thống hạ tầng giao thông và khu đô thị Mỹ Đình - Mễ Trì sầm uất kế cận dự án Hinode Solera'
    ],
    'toan_canh_toa_thap_pham_hung' => [
        'source' => $user_media_dir . '/media_1795141729096_bf534cf1.jpg',
        'filename' => 'toan-canh-thuc-te-toa-thap-hinode-solera-28-pham-hung-my-dinh.jpg',
        'title' => 'Toàn Cảnh Thực Tế Tòa Tháp Hinode Solera 28 Phạm Hùng Kế Cận Tòa Nhà VNPT Net',
        'alt' => 'Toàn cảnh thực tế từ trên cao tòa tháp chung cư cao cấp Hinode Solera số 28 Phạm Hùng kế cận tòa nhà VNPT Net và trục đường vành đai 3',
        'caption' => 'Góc nhìn toàn cảnh từ trên cao tòa tháp Hinode Solera 28 Phạm Hùng tọa lạc ngay mặt tiền đại lộ huyết mạch phía Tây Hà Nội'
    ]
];

$map_file = __DIR__ . '/hinode-media-map.json';
$media_map = file_exists($map_file) ? json_decode(file_get_contents($map_file), true) : [];

foreach ($images_to_import as $key => $img) {
    if (!file_exists($img['source'])) {
        echo "❌ Không tìm thấy nguồn ảnh: {$img['source']}\n";
        continue;
    }
    
    $dest_path = $target_dir . '/' . $img['filename'];
    copy($img['source'], $dest_path);
    
    $file_url = $upload_dir['baseurl'] . '/2026/11/' . $img['filename'];
    $filetype = wp_check_filetype(basename($dest_path), null);
    
    $attachment = [
        'guid'           => $file_url,
        'post_mime_type' => $filetype['type'],
        'post_title'     => $img['title'],
        'post_content'   => '',
        'post_excerpt'   => $img['caption'],
        'post_status'    => 'inherit'
    ];
    
    $attach_id = wp_insert_attachment($attachment, $dest_path);
    $attach_data = wp_generate_attachment_metadata($attach_id, $dest_path);
    wp_update_attachment_metadata($attach_id, $attach_data);
    update_post_meta($attach_id, '_wp_attachment_image_alt', $img['alt']);
    
    $media_map[$key] = [
        'id'      => $attach_id,
        'url'     => $file_url,
        'title'   => $img['title'],
        'alt'     => $img['alt'],
        'caption' => $img['caption'],
        'slug'    => sanitize_title($img['filename'])
    ];
    
    echo "✔ Đã import thành công: [{$key}] ID: {$attach_id} -> {$img['filename']}\n";
}

file_put_contents($map_file, json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "✔ Đã cập nhật media map tại: {$map_file}\n";
