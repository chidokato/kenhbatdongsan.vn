<?php
/**
 * ĐỒNG BỘ NHANH 8 TRANG PHÁP LÝ & UX BLOCK 123 (FOOTER) LÊN LIVE
 */
$root_dir = dirname(__DIR__);
require_once $root_dir . '/wp-load.php';

$remote_domain = 'https://kenhbatdongsan.vn';
$username      = 'admin';
$password      = 'TX19 uHVR KuI5 PtLd SgjS cGpX';
$auth_header   = 'Authorization: Basic ' . base64_encode("$username:$password");

function fast_remote_api($endpoint, $method = 'GET', $payload = null) {
    global $remote_domain, $auth_header;
    $url = $remote_domain . '/wp-json/' . ltrim($endpoint, '/');
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $headers = [
        $auth_header,
        'Content-Type: application/json'
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    if ($payload !== null) {
        $encoded = json_encode($payload);
        $encoded = str_replace(
            ['http:\/\/localhost\/www\/kenhbds', 'http://localhost/www/kenhbds'],
            ['https:\/\/kenhbatdongsan.vn', 'https://kenhbatdongsan.vn'],
            $encoded
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);
    }
    
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ['code' => $code, 'data' => json_decode($res, true), 'raw' => $res];
}

echo "=== ĐỒNG BỘ 8 TRANG LÊN KENHBATDONGSAN.VN ===\n";
$target_slugs = [
    'chinh-sach-bao-mat',
    'dieu-khoan-su-dung',
    'tuyen-bo-mien-tru-trach-nhiem',
    'quy-che-hoat-dong',
    'che-tai-xu-ly-vi-pham',
    'giai-quyet-tranh-chap-khieu-nai',
    'gioi-thieu',
    'lien-he'
];

foreach ($target_slugs as $slug) {
    $local = get_posts([
        'post_type'      => 'page',
        'name'           => $slug,
        'posts_per_page' => 1,
        'post_status'    => 'any'
    ]);
    if (empty($local)) {
        echo " ❌ Không tìm thấy trang local slug: $slug\n";
        continue;
    }
    $page = $local[0];

    // Kiểm tra trên Remote
    $check = fast_remote_api("wp/v2/pages?slug={$slug}&status=any");
    $exists = is_array($check['data']) && !empty($check['data']);

    $payload = [
        'title'   => $page->post_title,
        'content' => $page->post_content,
        'status'  => 'publish',
        'slug'    => $page->post_name,
        'template'=> 'page-blank.php'
    ];

    $meta = [];
    foreach (get_post_meta($page->ID) as $mk => $mv) {
        if (strpos($mk, 'rank_math_') === 0 || strpos($mk, '_kbds_') === 0) {
            $meta[$mk] = maybe_unserialize($mv[0]);
        }
    }
    if ($meta) {
        $payload['kbds_meta'] = $meta;
    }

    if ($exists) {
        $remote_id = $check['data'][0]['id'];
        $up = fast_remote_api("wp/v2/pages/{$remote_id}", 'POST', $payload);
        echo " ✔ Cập nhật trang [{$slug}] -> Remote ID: {$remote_id} (HTTP {$up['code']})\n";
    } else {
        $cr = fast_remote_api("wp/v2/pages", 'POST', $payload);
        echo " + Tạo mới trang [{$slug}] -> Remote ID: " . ($cr['data']['id'] ?? 'N/A') . " (HTTP {$cr['code']})\n";
    }
}

echo "\n=== ĐỒNG BỘ UX BLOCK 123 (FOOTER) ===\n";
$b123 = get_post(123);
if ($b123) {
    $res = fast_remote_api("wp/v2/ux-blocks?slug={$b123->post_name}&status=any");
    $exists = is_array($res['data']) && !empty($res['data']);
    $payload = [
        'title'   => $b123->post_title,
        'content' => $b123->post_content,
        'status'  => $b123->post_status,
        'slug'    => $b123->post_name,
    ];
    if ($exists) {
        $remote_id = $res['data'][0]['id'];
        $up = fast_remote_api("wp/v2/ux-blocks/{$remote_id}", 'POST', $payload);
        echo " ✔ Cập nhật UX Block 123 (Footer) -> Remote ID {$remote_id} (HTTP {$up['code']})\n";
    } else {
        $cr = fast_remote_api("wp/v2/ux-blocks", 'POST', $payload);
        echo " + Tạo mới UX Block 123 (Footer) -> (HTTP {$cr['code']})\n";
    }
}

echo "\n🎉 HOÀN TẤT ĐỒNG BỘ LÊN KENHBATDONGSAN.VN!\n";
