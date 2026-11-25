<?php
$remote_domain = 'https://kenhbatdongsan.vn';
$username      = 'admin';
$password      = 'TX19 uHVR KuI5 PtLd SgjS cGpX';
$auth_header   = 'Authorization: Basic ' . base64_encode("$username:$password");

// An Bình Homeland is remote ID 473
$ch = curl_init($remote_domain . '/wp-json/wp/v2/du_an/473?context=edit');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth_header, 'Content-Type: application/json']);
$res = curl_exec($ch);
curl_close($ch);

$d = json_decode($res, true);
echo "=== KBDS_META OF AN BINH HOMELAND (473) ===\n";
print_r($d['kbds_meta'] ?? 'NO KBDS_META');
