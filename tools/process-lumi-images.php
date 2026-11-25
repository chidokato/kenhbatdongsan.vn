<?php
require_once dirname(__DIR__) . '/wp-load.php';

$upload_dir = wp_upload_dir();
$target_dir = $upload_dir['basedir'] . '/2026/11';
if (!file_exists($target_dir)) {
    wp_mkdir_p($target_dir);
}

$images = [
    'phoi-canh-tong-the-lumi-hanoi-capitaland.jpg' => 'media_1795574791540_a3f90979.jpg',
    'phoi-canh-dem-ruc-ro-lumi-hanoi.jpg' => 'media_1795574791546_5a6f2b43.jpg',
    'mat-bang-tong-the-du-an-lumi-hanoi.webp' => 'media_1795574791568_395e7ff6.webp',
    'mat-bang-toa-prestige-1-lumi-hanoi.jpg' => 'media_1795574791563_c9433733.jpg',
    'kien-truc-mat-ngoai-lumi-elite-capitaland.jpg' => 'media_1795574791562_be19d322.jpg',
    'san-vuon-tren-cao-rooftop-lumi-elite.jpg' => 'media_1795574791567_4f74cffc.jpg',
    'be-boi-resort-sole-lap-pool-lumi-hanoi.jpg' => 'media_1795574791576_ecdd6bc5.jpg',
    'san-choi-nuoc-adventure-waterplay-lumi-hanoi.jpg' => 'media_1795574791517_6adf608d.jpg',
    'vuon-bbq-sole-ngoai-troi-lumi-hanoi.jpg' => 'media_1795574791524_96e4f0f1.jpg',
    'cong-vien-la-phoi-xanh-green-lung-lumi-hanoi.jpg' => 'media_1795574791537_6b3f08dc.jpg',
    'dai-sanh-grand-lobby-signature-1-lumi-hanoi.jpg' => 'media_1795574791504_bb87322f.jpg',
    'phong-tiec-cu-dan-party-house-lumi-hanoi.jpg' => 'media_1795574791497_1e76ab72.jpg',
    'khu-vui-choi-tre-em-toddlers-playroom-lumi-hanoi.jpg' => 'media_1795574791502_da2ad945.jpg',
    'san-choi-kham-pha-kids-adventure-lumi-hanoi.jpg' => 'media_1795574791508_d5ae7f28.jpg',
];

$source_dir = 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/';
$uploaded_urls = [];

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

foreach ($images as $clean_name => $orig_name) {
    $src = $source_dir . $orig_name;
    $dst = $target_dir . '/' . $clean_name;
    if (file_exists($src)) {
        copy($src, $dst);
        $filetype = wp_check_filetype(basename($dst), null);
        $attachment = [
            'guid'           => $upload_dir['baseurl'] . '/2026/11/' . $clean_name,
            'post_mime_type' => $filetype['type'],
            'post_title'     => preg_replace('/\.[^.]+$/', '', $clean_name),
            'post_content'   => '',
            'post_status'    => 'inherit'
        ];
        $attach_id = wp_insert_attachment($attachment, $dst);
        $attach_data = wp_generate_attachment_metadata($attach_id, $dst);
        wp_update_attachment_metadata($attach_id, $attach_data);
        $uploaded_urls[$clean_name] = [
            'id' => $attach_id,
            'url' => 'https://kenhbatdongsan.vn/wp-content/uploads/2026/11/' . $clean_name
        ];
        echo "Copied & registered: $clean_name (Attach ID: $attach_id)\n";
    } else {
        echo "Missing source: $src\n";
    }
}

file_put_contents(__DIR__ . '/lumi-images.json', json_encode($uploaded_urls, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "Done saving image map.\n";
