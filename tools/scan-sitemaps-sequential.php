<?php
/**
 * Quét tuần tự toàn bộ sitemap và menu trên kenhbatdongsan.vn
 */
set_time_limit(0);

$base = 'https://kenhbatdongsan.vn';
$sitemaps = [
    '/post-sitemap.xml',
    '/page-sitemap.xml',
    '/du_an-sitemap.xml',
    '/bat_dong_san-sitemap.xml',
    '/category-sitemap.xml',
    '/khu_vuc_bds-sitemap.xml',
    '/loai_hinh_bds-sitemap.xml',
    '/chu_dau_tu-sitemap.xml'
];

$urls = [];

foreach ($sitemaps as $sm) {
    $ch = curl_init($base . $sm);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $xml = curl_exec($ch);
    curl_close($ch);
    if ($xml && preg_match_all('/<loc>(.*?)<\/loc>/', $xml, $m)) {
        foreach ($m[1] as $u) {
            $urls[trim($u)] = $sm;
        }
    }
}

// Thêm các link menu chính
require_once __DIR__ . '/../wp-load.php';
while (ob_get_level()) ob_end_clean();
$menu_items = wp_get_nav_menu_items(40);
if ($menu_items) {
    foreach ($menu_items as $m) {
        if (!empty($m->url) && strpos($m->url, 'kenhbatdongsan.vn') !== false) {
            $urls[trim($m->url)] = 'Menu chính';
        }
    }
}

echo "Tổng cộng " . count($urls) . " URLs thực tế cần kiểm tra trên kenhbatdongsan.vn...\n";

$errors = [];
$count = 0;
foreach ($urls as $url => $src) {
    $count++;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0');
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $eff = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);

    if ($code >= 400 || $code === 0) {
        $errors[] = ['url' => $url, 'code' => $code, 'src' => $src];
        echo "[$count/" . count($urls) . "] ❌ HTTP $code: $url ($src)\n";
    } else {
        // echo "[$count/" . count($urls) . "] ✔ HTTP $code: $url\n";
    }
    usleep(80000); // 80ms delay để không bị LiteSpeed chặn
}

echo "\n--- KẾT QUẢ CUỐI CÙNG ---\n";
echo "Tổng URLs đã test: " . count($urls) . "\n";
echo "Số link lỗi 4xx/5xx: " . count($errors) . "\n";
foreach ($errors as $e) {
    echo "- HTTP {$e['code']}: {$e['url']} ({$e['src']})\n";
}
