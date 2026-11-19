<?php
/**
 * Tạo 2 Giỏ Hàng Xác Thực (bat_dong_san) cho Dự Án Ansana by Kita
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

$map_file = __DIR__ . '/ansana-by-kita-media-map.json';
$m = json_decode(file_get_contents($map_file), true);

$project = get_page_by_path('ansana-by-kita', OBJECT, 'du_an');
$project_id = $project ? $project->ID : 0;

$listings = [
    [
        'title' => 'Căn Hộ 2PN-2WC View Trực Diện Hồ Bơi Resort Tầng Trung Ansana by Kita Võ Văn Kiệt',
        'slug'  => 'can-ho-2pn-view-ho-boi-resort-ansana-by-kita',
        'price' => '6.8 Tỷ (Giá gốc CĐT đợt 1)',
        'price_bil' => '6.8',
        'area'  => '68.0',
        'bedrooms' => 2,
        'code'  => 'ANS-A-1206',
        'thumb' => $m['ho_boi_resort']['id'],
        'desc'  => 'Căn hộ 2 phòng ngủ 2WC tầng 12 tháp A dự án Ansana by Kita mặt tiền Đại lộ Võ Văn Kiệt. Ban công hướng Nam thoáng mát view trọn hồ bơi resort nhiệt đới, thiết kế chuẩn Wellness Luxury sang trọng.',
    ],
    [
        'title' => 'Căn Hộ 1PN+1 Đa Năng Thiết Kế Wellness Sang Trọng Ansana by Kita',
        'slug'  => 'can-ho-1pn1-thiet-ke-wellness-ansana-by-kita',
        'price' => '5.3 Tỷ (Hỗ trợ vay 70% LS 0%)',
        'price_bil' => '5.3',
        'area'  => '54.0',
        'bedrooms' => 1,
        'code'  => 'ANS-B-0805',
        'thumb' => $m['phoi_canh_dem_tong_the']['id'],
        'desc'  => 'Suất ngoại giao căn 1PN+1 diện tích 54m² tháp B Ansana by Kita. Thiết kế không gian mở đa năng có thể làm phòng làm việc hoặc phòng ngủ thứ 2, tối ưu công năng cho gia đình trẻ và chuyên gia.',
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
        'post_content' => $item['desc'] . "\n\n[kbds_lead_form project=\"Ansana by Kita Võ Văn Kiệt\"]",
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

    wp_set_object_terms($lid, ['tp-ho-chi-minh', 'binh-tan'], 'khu_vuc_bds');
    wp_set_object_terms($lid, ['can-ho-chung-cu'], 'loai_hinh_bds');
    wp_set_object_terms($lid, 'chuyen-nhuong', 'loai_giao_dich');
}

echo "Hoàn thành tạo giỏ hàng Ansana by Kita!\n";
