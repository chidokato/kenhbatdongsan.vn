<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "=== ĐỒNG BỘ TRANG CHỦ & SECTION 3 LÊN KENHBATDONGSAN.VN ===\n";

$remote_domain = 'https://kenhbatdongsan.vn';
$username      = 'admin';
$password      = 'TX19 uHVR KuI5 PtLd SgjS cGpX';
$auth_header   = 'Authorization: Basic ' . base64_encode("$username:$password");

function call_remote_api($endpoint, $method = 'GET', $payload = null) {
    global $remote_domain, $auth_header;
    $url = $remote_domain . '/wp-json/' . ltrim($endpoint, '/');
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $headers = [$auth_header, 'Content-Type: application/json'];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if ($payload !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ['code' => $code, 'data' => json_decode($res, true)];
}

// 1. Update Block 37 on Remote
$b37 = get_post(37);
$remote_block = call_remote_api('wp/v2/ux-blocks?slug=sec-3-gio-hang-xac-thuc');
if (!empty($remote_block['data'][0]['id'])) {
    $r_bid = $remote_block['data'][0]['id'];
    $u1 = call_remote_api("wp/v2/ux-blocks/$r_bid", 'POST', [
        'title'   => $b37->post_title,
        'content' => $b37->post_content,
        'status'  => 'publish'
    ]);
    echo "✔ Đã cập nhật UX Block 37 (ID: $r_bid) trên Live: HTTP {$u1['code']}\n";
} else {
    $c1 = call_remote_api('wp/v2/ux-blocks', 'POST', [
        'title'   => $b37->post_title,
        'slug'    => $b37->post_name,
        'content' => $b37->post_content,
        'status'  => 'publish'
    ]);
    echo "✔ Đã tạo mới UX Block 37 trên Live: HTTP {$c1['code']}\n";
}

// 2. Update Front Page (page 42 / trang-chu) on Remote
$front_local = get_post(42);
$remote_page = call_remote_api('wp/v2/pages?slug=trang-chu');
if (!empty($remote_page['data'][0]['id'])) {
    $r_pid = $remote_page['data'][0]['id'];
    $u2 = call_remote_api("wp/v2/pages/$r_pid", 'POST', [
        'title'   => $front_local->post_title,
        'content' => $front_local->post_content,
        'status'  => 'publish'
    ]);
    echo "✔ Đã khôi phục Section Chuyển Nhượng trên Trang Chủ Live (ID: $r_pid): HTTP {$u2['code']}\n";
} else {
    echo "Không tìm thấy trang-chu trên remote!\n";
}
