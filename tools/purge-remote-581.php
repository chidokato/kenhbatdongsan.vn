<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "=== CLEANING LOCAL POST 511 META ===\n";
$local = get_page_by_path('lumi-hanoi', OBJECT, 'du_an');
if ($local) {
    delete_post_meta($local->ID, 'rank_math_schema_ApartmentComplex');
    delete_post_meta($local->ID, 'rank_math_schema_apartmentcomplex');
    delete_post_meta($local->ID, 'rank_math_robots');
    echo "✔ Cleaned harmful metas from local post {$local->ID}\n";
}

echo "=== DELETING REMOTE POST 581 ===\n";
$remote_domain = 'https://kenhbatdongsan.vn';
$username      = 'admin';
$password      = 'TX19 uHVR KuI5 PtLd SgjS cGpX';
$auth_header   = 'Authorization: Basic ' . base64_encode("$username:$password");

// Delete remote post 581 with force=true
$ch = curl_init($remote_domain . '/wp-json/wp/v2/du_an/581?force=true');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth_header, 'Content-Type: application/json']);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "DELETE response: HTTP $code\n";
$data = json_decode($res, true);
echo "Deleted post ID: " . ($data['id'] ?? 'none') . "\n";
