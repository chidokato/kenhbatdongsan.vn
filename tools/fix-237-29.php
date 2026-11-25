<?php
require_once dirname(__DIR__) . '/wp-load.php';

// Fix 237
$p237 = get_post(237);
$c237 = $p237->post_content;
$c237 = str_replace(
    'Vị trí dự án Hinode Solera số 28 Phạm Hùng',
    'Vị trí dự án <a href="https://kenhbatdongsan.vn/du-an/hinode-solera-pham-hung/" title="Chung Cư Hinode Solera Phạm Hùng" style="font-weight:700;color:#0B2C4D;text-decoration:underline;">Hinode Solera số 28 Phạm Hùng</a>',
    $c237
);
$c237 = str_replace(
    ['http://localhost/www/kenhbds', 'http:\/\/localhost\/www\/kenhbds'],
    ['https://kenhbatdongsan.vn', 'https:\/\/kenhbatdongsan.vn'],
    $c237
);
wp_update_post(['ID' => 237, 'post_content' => $c237]);
echo "✔ Đã fix bài 237\n";

// Fix 29
$p29 = get_post(29);
$c29 = $p29->post_content;
$intro = '<p class="lead">Khi phân tích thị trường bất động sản khu Đông TP.HCM năm 2026, hai siêu dự án tâm điểm là <a href="https://kenhbatdongsan.vn/du-an/eaton-park-gamuda-land/" title="Tổ hợp căn hộ Eaton Park" style="font-weight:700;color:#0B2C4D;text-decoration:underline;">Eaton Park Gamuda Land</a> và <a href="https://kenhbatdongsan.vn/du-an/the-global-city-masterise/" title="Đại đô thị The Global City" style="font-weight:700;color:#0B2C4D;text-decoration:underline;">The Global City</a> luôn là bài toán cân não của các nhà đầu tư về đơn giá, lịch thanh toán và tiềm năng tăng trưởng.</p>' . "\n\n";

if (strpos($c29, 'eaton-park-gamuda-land') === false) {
    $c29 = $intro . $c29;
}
$c29 = str_replace(
    ['http://localhost/www/kenhbds', 'http:\/\/localhost\/www\/kenhbds'],
    ['https://kenhbatdongsan.vn', 'https:\/\/kenhbatdongsan.vn'],
    $c29
);
wp_update_post(['ID' => 29, 'post_content' => $c29]);
echo "✔ Đã fix bài 29\n";
