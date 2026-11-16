<?php
/**
 * Import 11 hình ảnh dự án La Tiên Villa Nha Trang vào WordPress Media Library
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$images_info = [
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742514_6ae4fff5.jpg',
        'slug' => 'yacht-clubhouse-la-tien-villa-libera-nha-trang',
        'title' => 'Yacht Clubhouse La Tiên Villa Libera Nha Trang',
        'alt' => 'Phối cảnh Yacht Clubhouse và bến du thuyền dự án La Tiên Villa Libera Nha Trang',
        'caption' => 'Yacht Clubhouse sang trọng với bến đỗ du thuyền phong cách đương đại tôn vinh biển Bãi Tiên',
        'key' => 'yacht_clubhouse'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742495_a9917ad7.jpg',
        'slug' => 'quang-truong-am-nhac-10-cay-bao-bap-la-tien-villa',
        'title' => 'Quảng Trường Âm Nhạc 10 Cây Bao Báp La Tiên Villa',
        'alt' => 'Quảng trường âm nhạc với 10 cây bao báp biểu tượng tại La Tiên Villa Nha Trang',
        'caption' => 'Quảng trường âm nhạc dân tộc với 10 cây bao báp có sức chứa lên tới 6.000 khán giả',
        'key' => 'quang_truong_am_nhac'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742521_17c39550.jpg',
        'slug' => 'cong-trinh-bieu-tuong-trong-dong-viet-nam-la-tien-villa',
        'title' => 'Công Trình Biểu Tượng Trống Đồng Việt Nam La Tiên Villa',
        'alt' => 'Công trình biểu tượng Trống Đồng Việt Nam lung linh huyền ảo tại La Tiên Villa Nha Trang',
        'caption' => 'Công trình kiến trúc biểu tượng Trống Đồng Việt Nam kết hợp nhạc nước nghệ thuật',
        'key' => 'trong_dong'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742489_3afd7c57.jpg',
        'slug' => 'ho-vay-noi-khu-an-toan-cho-be-la-tien-villa',
        'title' => 'Hồ Vầy Nội Khu An Toàn Cho Bé La Tiên Villa',
        'alt' => 'Hồ vầy nước nông nội khu an toàn cho trẻ em tại phân khu La Tiên Villa',
        'caption' => 'Hồ bơi vầy phong cách ốc đảo nhiệt đới an toàn tuyệt đối cho các thiên thần nhỏ',
        'key' => 'ho_vay'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742505_05719acc.jpg',
        'slug' => 'san-choi-tre-em-eco-friendly-la-tien-villa',
        'title' => 'Sân Chơi Trẻ Em Eco-Friendly La Tiên Villa',
        'alt' => 'Sân chơi trẻ em Eco-Friendly núp lùm dưới những tán cây xanh tại La Tiên Villa',
        'caption' => 'Khu vui chơi trẻ em hòa mình cùng thiên nhiên với tượng Vooc chà vá đa giác ấn tượng',
        'key' => 'san_choi_tre_em'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742512_9d754633.jpg',
        'slug' => 'boutique-house-pho-thuong-mai-la-tien-villa',
        'title' => 'Boutique House Phố Thương Mại La Tiên Villa',
        'alt' => 'Phố thương mại sầm uất Boutique House kề cận quảng trường La Tiên Villa',
        'caption' => 'Dãy Boutique House phố thương mại hướng biển với kiến trúc uốn lượn hòa cùng thiên nhiên',
        'key' => 'boutique_house'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817824180_bde891b4.webp',
        'slug' => 'vi-tri-toa-do-ket-noi-la-tien-villa-bai-tien-nha-trang',
        'title' => 'Vị Trí Tọa Độ Kết Nối La Tiên Villa Bãi Tiên Nha Trang',
        'alt' => 'Bản đồ vị trí tọa độ siêu kết nối dự án La Tiên Villa Bãi Tiên Nha Trang',
        'caption' => 'Tọa độ kim cương tại Bãi Tiên - chỉ 15 phút tới Tháp Trầm Hương và kết nối sân bay Quốc tế Cam Ranh',
        'key' => 'ban_do_vi_tri'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742524_07689b6a.jpg',
        'slug' => 'hoang-hon-tuyet-dep-tren-vinh-bien-bai-tien-la-tien-villa',
        'title' => 'Hoàng Hôn Tuyệt Đẹp Trên Vịnh Biển Bãi Tiên La Tiên Villa',
        'alt' => 'Khung cảnh hoàng hôn thanh bình trên bãi biển Bãi Tiên cạnh La Tiên Villa',
        'caption' => 'Khoảnh khắc hoàng hôn buông xuống vịnh Bãi Tiên nguyên sơ và yên bình',
        'key' => 'hoang_hon_bien'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742527_e7cdf255.jpg',
        'slug' => 'anh-chieu-ta-nhuom-do-vinh-nha-trang-la-tien-villa',
        'title' => 'Ánh Chiều Tà Nhuộm Đỏ Vịnh Nha Trang La Tiên Villa',
        'alt' => 'Ánh hoàng hôn rực rỡ nhuộm sắc cam đỏ trên mặt biển vịnh Nha Trang từ La Tiên Villa',
        'caption' => 'Bầu trời rực lửa huyền ảo khi chiều tà bao phủ đại dương Nha Trang',
        'key' => 'chieu_ta_do'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742532_338f2b71.jpg',
        'slug' => 'binh-minh-tren-bien-bai-tien-la-tien-villa',
        'title' => 'Bình Minh Trên Biển Bãi Tiên La Tiên Villa',
        'alt' => 'Bình minh rạng ngời với những áng mây vảy cá tuyệt mỹ tại biển Bãi Tiên La Tiên Villa',
        'caption' => 'Đón chào ngày mới tràn đầy năng lượng cùng làn nước biển trong xanh như ngọc bích',
        'key' => 'binh_minh'
    ],
    [
        'src' => 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/media_1794817742536_eec9ce73.jpg',
        'slug' => 'toan-canh-vinh-bien-bai-tien-tu-tren-cao-la-tien-villa',
        'title' => 'Toàn Cảnh Vịnh Biển Bãi Tiên Từ Trên Cao La Tiên Villa',
        'alt' => 'Toàn cảnh đường bờ biển hình cánh cung ôm trọn vịnh Bãi Tiên tại La Tiên Villa',
        'caption' => 'Tầm nhìn panorama triệu đô thu trọn cảnh sắc núi non và bờ biển thơ mộng của Bãi Tiên',
        'key' => 'toan_canh_vinh'
    ]
];

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
        $upload_dir = wp_upload_dir();
        $target_path = $upload_dir['path'] . '/' . $filename;
        copy($item['src'], $target_path);

        $filetype = wp_check_filetype($filename, null);
        $attachment = [
            'guid'           => $upload_dir['url'] . '/' . $filename,
            'post_mime_type' => $filetype['type'],
            'post_title'     => $item['title'],
            'post_name'      => $item['slug'],
            'post_content'   => $item['caption'],
            'post_excerpt'   => $item['caption'],
            'post_status'    => 'inherit'
        ];

        $att_id = wp_insert_attachment($attachment, $target_path);
        $attach_data = wp_generate_attachment_metadata($att_id, $target_path);
        wp_update_attachment_metadata($att_id, $attach_data);
        update_post_meta($att_id, '_wp_attachment_image_alt', $item['alt']);

        echo " + Đã import ảnh mới: {$item['title']} (ID: {$att_id})\n";
    }

    $media_map[$item['key']] = [
        'id'  => $att_id,
        'url' => wp_get_attachment_url($att_id),
        'title' => $item['title'],
        'alt' => $item['alt'],
        'caption' => $item['caption']
    ];
}

file_put_contents(__DIR__ . '/la-tien-media-map.json', json_encode($media_map, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "✔ Đã lưu mapping ảnh vào tools/la-tien-media-map.json\n";
