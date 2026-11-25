<?php
$remote_domain = 'https://kenhbatdongsan.vn';
$username      = 'admin';
$password      = 'TX19 uHVR KuI5 PtLd SgjS cGpX';
$auth_header   = 'Authorization: Basic ' . base64_encode("$username:$password");

$ch = curl_init($remote_domain . '/wp-json/wp/v2/du_an/581?context=edit');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth_header, 'Content-Type: application/json']);
$res = curl_exec($ch);
curl_close($ch);

$data = json_decode($res, true);
echo "=== REMOTE 581 META ===\n";
if (!empty($data['meta'])) {
    foreach ($data['meta'] as $k => $v) {
        echo "$k => " . (is_array($v) ? json_encode($v) : substr($v, 0, 100)) . "\n";
    }
} else {
    echo "No meta or error: " . substr($res, 0, 500) . "\n";
}
