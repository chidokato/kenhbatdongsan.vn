<?php
require_once dirname(__DIR__) . '/wp-load.php';

// 1. Local fix
echo "=== FIXING LOCAL SLUGS ===\n";
$draft_3 = get_post(3);
if ($draft_3) {
    wp_delete_post(3, true);
    echo "✔ Đã xóa draft ID 3 trên Localhost\n";
}
$p255 = get_post(255);
if ($p255) {
    wp_update_post([
        'ID' => 255,
        'post_name' => 'chinh-sach-bao-mat'
    ]);
    echo "✔ Đã đổi slug page 255 thành 'chinh-sach-bao-mat' trên Localhost\n";
}

// 2. Remote fix via REST API
echo "\n=== FIXING REMOTE SLUGS ===\n";
$remote_domain = 'https://kenhbatdongsan.vn';
$username      = 'admin';
$password      = 'TX19 uHVR KuI5 PtLd SgjS cGpX';
$auth_header   = 'Authorization: Basic ' . base64_encode("$username:$password");

// Delete remote draft 3
$ch = curl_init($remote_domain . '/wp-json/wp/v2/pages/3?force=true');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth_header]);
$res3 = json_decode(curl_exec($ch), true);
$code3 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "✔ Xóa Remote ID 3: HTTP $code3\n";

// Update remote page 303 slug
$ch = curl_init($remote_domain . '/wp-json/wp/v2/pages/303');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['slug' => 'chinh-sach-bao-mat']));
curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth_header, 'Content-Type: application/json']);
$res303 = json_decode(curl_exec($ch), true);
$code303 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "✔ Cập nhật Remote ID 303 slug='chinh-sach-bao-mat': HTTP $code303 (Slug mới: " . ($res303['slug'] ?? 'N/A') . ")\n";

// Delete sample page ID 2 on remote as well
$ch = curl_init($remote_domain . '/wp-json/wp/v2/pages/2?force=true');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth_header]);
curl_exec($ch);
curl_close($ch);
echo "✔ Đã xóa trang mẫu ID 2 trên Remote\n";
