<?php
$root_dir = dirname(__DIR__);
require_once $root_dir . '/wp-load.php';

echo "=== FIXING LUMI HANOI SCHEMA CRASH ===\n";

// 1. Localhost fix
$local = get_page_by_path('lumi-hanoi', OBJECT, 'du_an');
if ($local) {
    delete_post_meta($local->ID, 'rank_math_schema_ApartmentComplex');
    echo "✔ Deleted rank_math_schema_ApartmentComplex from local post ID: {$local->ID}\n";
}

// 2. Live API fix
$remote_domain = 'https://kenhbatdongsan.vn';
$username      = 'admin';
$password      = 'TX19 uHVR KuI5 PtLd SgjS cGpX';
$auth_header   = 'Authorization: Basic ' . base64_encode("$username:$password");

// Find remote ID of lumi-hanoi
$ch = curl_init($remote_domain . '/wp-json/wp/v2/du_an?slug=lumi-hanoi');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth_header, 'Content-Type: application/json']);
$res = curl_exec($ch);
$remote_posts = json_decode($res, true);
curl_close($ch);

if (!empty($remote_posts) && isset($remote_posts[0]['id'])) {
    $remote_id = $remote_posts[0]['id'];
    echo "Found remote project ID: $remote_id\n";
    
    // Update meta on remote to clear rank_math_schema_ApartmentComplex
    $ch2 = curl_init($remote_domain . "/wp-json/wp/v2/du_an/{$remote_id}");
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch2, CURLOPT_HTTPHEADER, [$auth_header, 'Content-Type: application/json']);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode([
        'meta' => [
            'rank_math_schema_ApartmentComplex' => ''
        ]
    ]));
    $res2 = curl_exec($ch2);
    $code2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
    curl_close($ch2);
    echo "Remote update response: HTTP $code2\n";
} else {
    echo "Could not find remote project with slug lumi-hanoi\n";
}
