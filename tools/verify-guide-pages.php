<?php
$urls = [
    'https://kenhbatdongsan.vn/gioi-thieu/',
    'https://kenhbatdongsan.vn/lien-he/',
    'https://kenhbatdongsan.vn/bao-gia-va-tu-van-du-an/',
    'https://kenhbatdongsan.vn/cam-nang-dau-tu-phap-ly/',
    'https://kenhbatdongsan.vn/so-do-website/'
];

foreach ($urls as $u) {
    $ch = curl_init($u);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    preg_match('/<title>(.*?)<\/title>/i', $html, $m);
    preg_match('/<meta name="robots" content="([^"]+)"/i', $html, $rm);
    $title = $m[1] ?? 'No title';
    $robots = $rm[1] ?? 'none';
    echo "HTTP {$code} | Robots: {$robots} | Title: {$title}\n   -> {$u}\n";
}

echo "\n--- CHECK FOOTER ON HOMEPAGE ---\n";
$home = file_get_contents('https://kenhbatdongsan.vn/');
foreach ($urls as $u) {
    $path = parse_url($u, PHP_URL_PATH);
    $found = strpos($home, $path) !== false ? "YES" : "NO";
    echo "Footer has {$path}: {$found}\n";
}

