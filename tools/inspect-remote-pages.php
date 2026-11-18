<?php
$remote_domain = 'https://kenhbatdongsan.vn';
$username      = 'admin';
$password      = 'TX19 uHVR KuI5 PtLd SgjS cGpX';
$auth_header   = 'Authorization: Basic ' . base64_encode("$username:$password");

$ch = curl_init($remote_domain . '/wp-json/wp/v2/pages?per_page=100&status=any');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth_header]);
$res = json_decode(curl_exec($ch), true);
curl_close($ch);

echo "=== REMOTE PAGES ===\n";
if (is_array($res)) {
    foreach ($res as $p) {
        echo "ID: {$p['id']} | Slug: {$p['slug']} | Title: {$p['title']['rendered']} | Status: {$p['status']}\n";
    }
} else {
    echo "Failed to load remote pages.\n";
}
