<?php
require_once __DIR__ . '/../wp-load.php';
while (ob_get_level()) ob_end_clean();

$base = 'https://kenhbatdongsan.vn';

$urls = [];

// Posts
$posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($posts as $p) {
    $urls[$base . '/' . $p->post_name . '/'] = 'Post: ' . $p->post_title;
}

// Du an
$du_an = get_posts(['post_type' => 'du_an', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($du_an as $d) {
    $urls[$base . '/du-an/' . $d->post_name . '/'] = 'Du An: ' . $d->post_title;
}

// Pages
$pages = get_posts(['post_type' => 'page', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($pages as $pg) {
    if ($pg->post_name === 'trang-mau') continue;
    $urls[$base . '/' . $pg->post_name . '/'] = 'Page: ' . $pg->post_title;
}

echo "Kiểm tra " . count($urls) . " bài viết, dự án và trang trên live...\n";

$errors = [];
$c = 0;
foreach ($urls as $url => $label) {
    $c++;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 Chrome/120.0.0.0');
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code !== 200) {
        $errors[] = ['url' => $url, 'code' => $code, 'label' => $label];
        echo " ❌ [HTTP $code] $url ($label)\n";
    }
    usleep(60000); // 60ms delay
}

echo "\n--- TỔNG KẾT ---\n";
echo "Tổng kiểm tra: " . count($urls) . "\n";
echo "Số lỗi: " . count($errors) . "\n";
foreach ($errors as $e) {
    echo "- HTTP {$e['code']}: {$e['url']}\n";
}
