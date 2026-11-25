<?php
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

// 1. Update listings to parent ID 591
$l1 = call_remote_api('wp/v2/bat_dong_san?slug=can-ho-2pn-toa-prestige-1-lumi-hanoi');
if (!empty($l1['data'][0]['id'])) {
    $id = $l1['data'][0]['id'];
    call_remote_api("wp/v2/bat_dong_san/$id", 'POST', ['kbds_meta' => ['_kbds_parent_project_id' => 591]]);
    echo "Updated listing 1 (ID: $id) parent to 591\n";
}

$l2 = call_remote_api('wp/v2/bat_dong_san?slug=can-ho-goc-3pn-toa-prestige-1-lumi-hanoi');
if (!empty($l2['data'][0]['id'])) {
    $id = $l2['data'][0]['id'];
    call_remote_api("wp/v2/bat_dong_san/$id", 'POST', ['kbds_meta' => ['_kbds_parent_project_id' => 591]]);
    echo "Updated listing 2 (ID: $id) parent to 591\n";
}

// 2. Update satellite posts _kbds_project_ref to 591
$p1 = call_remote_api('wp/v2/posts?slug=mat-bang-toa-prestige-1-du-an-lumi-hanoi');
if (!empty($p1['data'][0]['id'])) {
    $id = $p1['data'][0]['id'];
    call_remote_api("wp/v2/posts/$id", 'POST', ['kbds_meta' => ['_kbds_project_ref' => 591]]);
    echo "Updated satellite post 1 (ID: $id) project ref to 591\n";
}

$p2 = call_remote_api('wp/v2/posts?slug=he-thong-tien-ich-dang-cap-lumi-hanoi');
if (!empty($p2['data'][0]['id'])) {
    $id = $p2['data'][0]['id'];
    call_remote_api("wp/v2/posts/$id", 'POST', ['kbds_meta' => ['_kbds_project_ref' => 591]]);
    echo "Updated satellite post 2 (ID: $id) project ref to 591\n";
}

echo "All remote relations updated to 591 successfully!\n";
