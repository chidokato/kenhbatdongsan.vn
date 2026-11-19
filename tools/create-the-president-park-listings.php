<?php
/**
 * Tạo 2 Giỏ Hàng Xác Thực (bat_dong_san) cho Dự Án The President Park
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

$map_file = __DIR__ . '/the-president-park-media-map.json';
$m = json_decode(file_get_contents($map_file), true);

$project = get_page_by_path('the-president-park-ha-noi', OBJECT, 'du_an');
$project_id = $project ? $project->ID : 0;

$listings = [
    [
        'title' => 'Biệt Thự Song Lập 220m² 3 Mặt Thoáng Kiến Trúc Tân Cổ Điển The President Park Mễ Trì',
        'slug'  => 'biet-thu-song-lap-220m-the-president-park-me-tri',
        'price' => '68 Tỷ (Giá gốc CĐT đợt 1)',
        'price_bil' => '68.0',
        'area'  => '220.0',
        'bedrooms' => 5,
        'code'  => 'PR-SL-08',
        'thumb' => $m['quang_truong_colosseum_dem']['id'],
        'desc'  => 'Căn Biệt thự Song lập tuyệt đẹp diện tích 220m² xây 3 tầng 1 tum tại The President Park Mễ Trì. Thiết kế 3 mặt thoáng, sân vườn rộng rãi, hướng nhìn thoáng mát về công viên sinh thái và quảng trường La Mã.',
    ],
    [
        'title' => 'Nhà Phố Shophouse Mặt Tiền Đường Cương Kiên 120m² Tiện Kinh Doanh The President Park',
        'slug'  => 'shophouse-mat-tien-cuong-kien-120m-the-president-park',
        'price' => '42 Tỷ (Bao gồm VAT & Hoàn thiện ngoài)',
        'price_bil' => '42.0',
        'area'  => '120.0',
        'bedrooms' => 4,
        'code'  => 'PR-SH-16',
        'thumb' => $m['poster_tong_the']['id'],
        'desc'  => 'Căn Shophouse nhà phố thương mại mặt tiền đường Cương Kiên đắt giá quy mô 120m² đất, xây dựng 5 tầng đồng bộ kiến trúc Tân Cổ Điển quý phái. Vị trí vàng kinh doanh showroom, văn phòng đại diện hoặc ẩm thực cao cấp.',
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
        'post_content' => $item['desc'] . "\n\n[kbds_lead_form project=\"The President Park Mễ Trì\"]",
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

    wp_set_object_terms($lid, ['ha-noi', 'nam-tu-liem'], 'khu_vuc_bds');
    wp_set_object_terms($lid, ['khu-do-thi-biet-thu', 'nha-pho-shophouse'], 'loai_hinh_bds');
    wp_set_object_terms($lid, 'chuyen-nhuong', 'loai_giao_dich');
}

echo "Hoàn thành tạo giỏ hàng The President Park!\n";
