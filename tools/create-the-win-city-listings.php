<?php
require_once dirname(__DIR__) . '/wp-load.php';

$map_file = __DIR__ . '/the-win-city-media-map.json';
$m = json_decode(file_get_contents($map_file), true);

$project = get_page_by_path('the-win-city-long-an', OBJECT, 'du_an');
$project_id = $project ? $project->ID : 284;

$listings = [
    [
        'title' => 'Căn Hộ 2PN-1WC Tầng Trung Tháp VIC 1.2 Phân Khu Victory Heights – The Win City',
        'slug'  => 'can-ho-2pn-vic12-victory-heights-the-win-city',
        'price' => '1.68 Tỷ (Bao toàn bộ thuế phí)',
        'price_bil' => '1.68',
        'area'  => '50.2',
        'bedrooms' => 2,
        'code'  => 'WIN-VIC12-1208',
        'thumb' => $m['phong_khach_mau_2']['id'],
        'desc'  => 'Suất ngoại giao căn 2 phòng ngủ tầng 12 tháp VIC 1.2 phân khu Victory Heights The Win City. Bàn giao full nội thất liền tường An Cường cao cấp, ban công thoáng đãng.',
    ],
    [
        'title' => 'Căn Góc 2PN-2WC Tầng Cao View Trực Diện Công Viên Victory Central – The Win City',
        'slug'  => 'can-goc-2pn-view-cong-vien-victory-heights-the-win-city',
        'price' => '2.18 Tỷ (Giá gốc CĐT đợt 1)',
        'price_bil' => '2.18',
        'area'  => '65.0',
        'bedrooms' => 2,
        'code'  => 'WIN-VIC12-1802',
        'thumb' => $m['phong_khach_mau_1']['id'],
        'desc'  => 'Căn góc 2 phòng ngủ 2WC tầng 18 tháp VIC 1.2 The Win City. Sở hữu 2 mặt thoáng view trọn vẹn công viên Victory Central 5.500m², đón gió mát tự nhiên.',
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
        'post_content' => $item['desc'] . "\n\n[kbds_lead_form project=\"The Win City Đức Hòa\"]",
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

    wp_set_object_terms($lid, 'Long An', 'khu_vuc_bds');
    wp_set_object_terms($lid, 'can-ho-chung-cu', 'loai_hinh_bds');
    wp_set_object_terms($lid, 'chuyen-nhuong', 'loai_giao_dich');
}
echo "Hoàn thành tạo Giỏ hàng The Win City!\n";
