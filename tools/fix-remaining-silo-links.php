<?php
require_once dirname(__DIR__) . '/wp-load.php';

$posts_to_fix = [403, 401, 237, 213, 212, 211, 196, 195, 194, 193, 29];

$project_map = [
    403 => ['slug' => 'an-binh-homeland', 'name' => 'Chung cư An Bình Homeland', 'variants' => ['Chung cư An Bình Homeland', 'An Bình Homeland']],
    401 => ['slug' => 'an-binh-homeland', 'name' => 'Chung cư An Bình Homeland', 'variants' => ['Chung cư An Bình Homeland', 'An Bình Homeland']],
    237 => ['slug' => 'hinode-solera-pham-hung', 'name' => 'Hinode Solera Phạm Hùng', 'variants' => ['Hinode Solera 28 Phạm Hùng', 'Hinode Solera', 'Hinode Suite']],
    213 => ['slug' => 'la-tien-villa', 'name' => 'La Tiên Villa', 'variants' => ['La Tiên Villa', 'Libera Nha Trang']],
    212 => ['slug' => 'la-tien-villa', 'name' => 'La Tiên Villa', 'variants' => ['La Tiên Villa', 'Libera Nha Trang']],
    211 => ['slug' => 'la-tien-villa', 'name' => 'La Tiên Villa', 'variants' => ['La Tiên Villa', 'Libera Nha Trang']],
    196 => ['slug' => 'jade-square', 'name' => 'Jade Square', 'variants' => ['Jade Square', 'Chung cư Jade Square']],
    195 => ['slug' => 'jade-square', 'name' => 'Jade Square', 'variants' => ['Jade Square', 'Chung cư Jade Square']],
    194 => ['slug' => 'jade-square', 'name' => 'Jade Square', 'variants' => ['Jade Square', 'Chung cư Jade Square']],
    193 => ['slug' => 'jade-square', 'name' => 'Jade Square', 'variants' => ['Jade Square', 'Chung cư Jade Square']],
    29  => ['slug' => 'eaton-park-gamuda-land', 'name' => 'Eaton Park', 'variants' => ['Eaton Park', 'The Global City']],
];

foreach ($posts_to_fix as $pid) {
    $p = get_post($pid);
    if (!$p) continue;
    $content = $p->post_content;
    
    // Khử localhost nếu còn
    $content = str_replace(
        ['http://localhost/www/kenhbds', 'http:\/\/localhost\/www\/kenhbds'],
        ['https://kenhbatdongsan.vn', 'https:\/\/kenhbatdongsan.vn'],
        $content
    );

    $info = $project_map[$pid];
    $target_url = "https://kenhbatdongsan.vn/du-an/{$info['slug']}/";

    // Tìm và thay thế biến thể đầu tiên ở đoạn đầu thành link
    foreach ($info['variants'] as $v) {
        $pattern = '/(<strong>)?(' . preg_quote($v, '/') . ')(<\/strong>)?/iu';
        if (preg_match($pattern, mb_substr($content, 0, 1500), $m)) {
            $replacement = '<a href="' . esc_url($target_url) . '" title="' . esc_attr($info['name']) . '" style="font-weight:700;color:#0B2C4D;text-decoration:underline;">$2</a>';
            $content = preg_replace($pattern, $replacement, $content, 1);
            echo "✔ Đã chèn link Silo cho bài [{$pid}] {$p->post_title} -> {$target_url}\n";
            break;
        }
    }

    wp_update_post([
        'ID'           => $pid,
        'post_content' => $content
    ]);
}

echo "\n🎉 Hoàn thành xử lý 11 bài viết còn lại!\n";
