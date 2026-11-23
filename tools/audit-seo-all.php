<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "=== AUDIT TỔNG QUAN WEBSITE KENHBATDONGSAN.VN ===\n\n";

// 1. Audit Projects (du_an)
$projects = get_posts([
    'post_type'      => 'du_an',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
]);
echo "1. TỔNG SỐ DỰ ÁN (PILLAR PAGES): " . count($projects) . "\n";
foreach ($projects as $proj) {
    $rm_kw = get_post_meta($proj->ID, 'rank_math_focus_keyword', true);
    $rm_title = get_post_meta($proj->ID, 'rank_math_title', true);
    $rm_desc = get_post_meta($proj->ID, 'rank_math_description', true);
    $has_localhost = strpos($proj->post_content, 'localhost') !== false;
    echo "  - [ID {$proj->ID}] {$proj->post_title}\n";
    echo "    Slug: {$proj->post_name}\n";
    echo "    Focus KW: " . ($rm_kw ?: 'CHƯA CÓ') . "\n";
    echo "    SEO Title: " . ($rm_title ?: 'CHƯA CÓ') . "\n";
    echo "    Meta Desc: " . ($rm_desc ? mb_substr($rm_desc, 0, 80) . '...' : 'CHƯA CÓ') . "\n";
    echo "    Localhost found: " . ($has_localhost ? 'CÓ ❌' : 'KHÔNG ✔') . "\n";
    echo "\n";
}

// 2. Audit Satellite Posts (post)
$posts = get_posts([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
]);
echo "\n2. TỔNG SỐ BÀI VIẾT VỆ TINH & TIN TỨC: " . count($posts) . "\n";
$no_ref_count = 0;
$localhost_count = 0;
$no_seo_count = 0;

foreach ($posts as $p) {
    $ref_id = get_post_meta($p->ID, '_kbds_project_ref', true);
    $rm_kw = get_post_meta($p->ID, 'rank_math_focus_keyword', true);
    $rm_title = get_post_meta($p->ID, 'rank_math_title', true);
    $rm_desc = get_post_meta($p->ID, 'rank_math_description', true);
    $has_localhost = strpos($p->post_content, 'localhost') !== false;

    if (!$ref_id) $no_ref_count++;
    if ($has_localhost) $localhost_count++;
    if (!$rm_kw || !$rm_title || !$rm_desc) $no_seo_count++;
}
echo "  - Bài viết thiếu liên kết Dự án (_kbds_project_ref): {$no_ref_count}\n";
echo "  - Bài viết còn chứa localhost: {$localhost_count}\n";
echo "  - Bài viết thiếu cấu hình SEO Rank Math: {$no_seo_count}\n";

// 3. Homepage check
$front_id = get_option('page_on_front');
echo "\n3. TRANG CHỦ (FRONT PAGE ID: {$front_id}):\n";
if ($front_id) {
    $fp = get_post($front_id);
    echo "  Title: {$fp->post_title}\n";
    echo "  Focus KW: " . get_post_meta($front_id, 'rank_math_focus_keyword', true) . "\n";
    echo "  SEO Title: " . get_post_meta($front_id, 'rank_math_title', true) . "\n";
    echo "  Meta Desc: " . get_post_meta($front_id, 'rank_math_description', true) . "\n";
    echo "  Localhost found: " . (strpos($fp->post_content, 'localhost') !== false ? 'CÓ ❌' : 'KHÔNG ✔') . "\n";
}
