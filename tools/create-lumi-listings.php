<?php
require_once dirname(__DIR__) . '/wp-load.php';

$parent_id = 511; // Lumi Hanoi

$listings = [
    [
        'title' => 'Căn Hộ 2PN-2WC 62.1m² Tầng Trung Tòa Prestige 1 View Hồ Bơi Resort Sole Lap Pool Lumi Hanoi',
        'slug'  => 'can-ho-2pn-toa-prestige-1-lumi-hanoi',
        'code'  => 'LM-PR1-1510',
        'price' => '4.35 Tỷ',
        'area'  => 62.1,
        'bed'   => 2,
        'bath'  => 2,
        'dir'   => 'Đông Nam',
        'img'   => 503 // be-boi
    ],
    [
        'title' => 'Căn Hộ Góc 3PN-2WC 106.9m² Tòa Prestige 1 View Panorama Công Viên Sinh Thái Lumi Hanoi',
        'slug'  => 'can-ho-goc-3pn-toa-prestige-1-lumi-hanoi',
        'code'  => 'LM-PR1-2208',
        'price' => '7.48 Tỷ',
        'area'  => 106.9,
        'bed'   => 3,
        'bath'  => 2,
        'dir'   => 'Đông Bắc - Đông Nam',
        'img'   => 506 // la-phoi
    ]
];

foreach ($listings as $item) {
    $existing = get_page_by_path($item['slug'], OBJECT, 'bat_dong_san');
    $id = $existing ? $existing->ID : 0;
    
    $post_data = [
        'post_title'   => $item['title'],
        'post_name'    => $item['slug'],
        'post_content' => 'Suất ngoại giao căn hộ cao cấp tại tháp Prestige 1 dự án Lumi Hanoi CapitaLand. Vị trí tầng đẹp, tầm nhìn khoáng đạt, pháp lý minh bạch sổ hồng lâu dài.',
        'post_status'  => 'publish',
        'post_type'    => 'bat_dong_san',
        'post_author'  => 1
    ];
    
    if ($id > 0) {
        $post_data['ID'] = $id;
        wp_update_post($post_data);
        echo "Updated listing ID: $id\n";
    } else {
        $id = wp_insert_post($post_data);
        echo "Created listing ID: $id\n";
    }
    
    set_post_thumbnail($id, $item['img']);
    update_post_meta($id, '_kbds_parent_project_id', $parent_id);
    update_post_meta($id, '_kbds_listing_code', $item['code']);
    update_post_meta($id, '_kbds_listing_price', $item['price']);
    update_post_meta($id, '_kbds_area_m2', $item['area']);
    update_post_meta($id, '_kbds_bedrooms', $item['bed']);
    update_post_meta($id, '_kbds_bathrooms', $item['bath']);
    update_post_meta($id, '_kbds_direction', $item['dir']);
    update_post_meta($id, '_kbds_is_verified', 1);
    update_post_meta($id, '_kbds_listing_status', 'active');
    
    // Taxonomies
    wp_set_object_terms($id, [16, 62], 'khu_vuc_bds');
    wp_set_object_terms($id, [6, 89], 'loai_hinh_bds');
}

echo "Created/Updated Lumi Hanoi listings successfully!\n";
