<?php
$root_dir = dirname(__DIR__);
require_once $root_dir . '/wp-load.php';

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

$local = get_page_by_path('lumi-hanoi', OBJECT, 'du_an');
if (!$local) {
    echo "Local post lumi-hanoi not found\n";
    exit;
}

$payload = [
    'title'   => $local->post_title,
    'content' => $local->post_content,
    'excerpt' => $local->post_excerpt,
    'status'  => $local->post_status,
    'slug'    => $local->post_name,
];

// Meta
$meta = [];
foreach (get_post_meta($local->ID) as $mk => $mv) {
    if (strpos($mk, '_kbds_') === 0 || strpos($mk, 'rank_math_') === 0) {
        $meta[$mk] = $mv[0];
    }
}
if ($meta) {
    $payload['kbds_meta'] = $meta;
}

// Taxonomies
$cdt_res = call_remote_api('wp/v2/chu_dau_tu?slug=capitaland-development');
if (!empty($cdt_res['data'][0]['id'])) {
    $payload['chu_dau_tu'] = [(int)$cdt_res['data'][0]['id']];
}

$payload['khu_vuc_bds'] = [16, 62];
$payload['loai_hinh_bds'] = [6, 89];

// Media
$media_res = call_remote_api('wp/v2/media?slug=phoi-canh-tong-the-lumi-hanoi-capitaland');
if (!empty($media_res['data'][0]['id'])) {
    $payload['featured_media'] = (int)$media_res['data'][0]['id'];
}

echo "=== CREATING LUMI HANOI ON REMOTE ===\n";
$cr = call_remote_api('wp/v2/du_an', 'POST', $payload);
echo "Create response: HTTP {$cr['code']}\n";
if (!empty($cr['data']['id'])) {
    echo "New remote ID: {$cr['data']['id']}\n";
} else {
    print_r($cr['data']);
}
