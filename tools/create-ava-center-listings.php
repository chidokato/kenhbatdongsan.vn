<?php
/**
 * Tạo 2 Giỏ Hàng Xác Thực (bat_dong_san) cho Dự Án AVA Center
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

$map_file = __DIR__ . '/ava-center-media-map.json';
$m = json_decode(file_get_contents($map_file), true);

$project = get_page_by_path('ava-center-binh-duong', OBJECT, 'du_an');
$project_id = $project ? $project->ID : 0;

$listings = [
    [
        'title' => 'Căn Hộ 2PN Phong Cách Modern Vibes 62m² Bàn Giao Full Nội Thất AVA Center',
        'slug'  => 'can-ho-2pn-modern-vibes-62m-ava-center-thuan-an',
        'price' => '2.15 Tỷ (Full nội thất cao cấp)',
        'price_bil' => '2.15',
        'area'  => '62.0',
        'bedrooms' => 2,
        'code'  => 'AVA-A-1608',
        'thumb' => $m['noi_that_modern_vibes']['id'],
        'desc'  => 'Suất ngoại giao căn 2 phòng ngủ 2WC tầng 16 tháp A dự án AVA Center Thuận An Bình Dương. Bàn giao Full nội thất chuẩn phong cách Modern Vibes tinh tế, tích hợp Smart Home thông minh, view sân Golf Sông Bé thoáng mát.',
    ],
    [
        'title' => 'Căn Hộ Officetel Đa Năng 38m² Smart Home AVA Center Cạnh Ga Metro',
        'slug'  => 'can-ho-officetel-thong-minh-38m-ava-center-binh-duong',
        'price' => '1.38 Tỷ (Vốn ban đầu từ 186 triệu)',
        'price_bil' => '1.38',
        'area'  => '38.0',
        'bedrooms' => 1,
        'code'  => 'AVA-A-0812',
        'thumb' => $m['tien_nghi_smart_home']['id'],
        'desc'  => 'Căn hộ Officetel thông minh 38m² tầng 8 tháp A dự án AVA Center. Tối ưu công năng vừa ở vừa làm văn phòng, bàn giao full nội thất thông minh, cách nhà ga số 6 Metro chỉ 300m, tiềm năng cho thuê chuyên gia cực cao.',
    ]
];

foreach ($listings as $item) {
    $existing = get_posts([
        'post_type' => 'bat_dong_san',
        'name'      => $item['slug'],
        'posts_per_page' => 1,
        'post_status' => 'any'
    ]);

    $post_data = [
        'post_title'   => $item['title'],
        'post_name'    => $item['slug'],
        'post_content' => $item['desc'] . "\n\n[kbds_lead_form project=\"AVA Center Bình Dương\"]",
        'post_status'  => 'publish',
        'post_type'    => 'bat_dong_san',
        'post_excerpt' => $item['desc'],
    ];

    if (!empty($existing)) {
        $post_data['ID'] = $existing[0]->ID;
        $lid = wp_update_post($post_data);
        echo " ✔ Đã cập nhật Giỏ hàng: {$item['title']} (ID: {$lid})\n";
    } else {
        $lid = wp_insert_post($post_data);
        echo " + Đã tạo Giỏ hàng mới: {$item['title']} (ID: {$lid})\n";
    }

    if (!empty($item['thumb'])) {
        set_post_thumbnail($lid, $item['thumb']);
    }

    update_post_meta($lid, '_kbds_parent_project_id', $project_id);
    update_post_meta($lid, '_kbds_is_verified', '1');
    update_post_meta($lid, '_kbds_listing_code', $item['code']);
    update_post_meta($lid, '_kbds_listing_price', $item['price']);
    update_post_meta($lid, '_kbds_price_billion', $item['price_bil']);
    update_post_meta($lid, '_kbds_area_m2', $item['area']);
    update_post_meta($lid, '_kbds_bedrooms', $item['bedrooms']);

    wp_set_object_terms($lid, ['binh-duong', 'thuan-an'], 'khu_vuc_bds');
    wp_set_object_terms($lid, ['can-ho-chung-cu'], 'loai_hinh_bds');
    wp_set_object_terms($lid, 'chuyen-nhuong', 'loai_giao_dich');
}

echo "Hoàn thành tạo giỏ hàng AVA Center!\n";
