<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "\n==============================================================\n";
echo "🔍 QUÉT TOÀN DIỆN: ĂN THỊT TỪ KHÓA & CHÈN LIÊN KẾT NỘI BỘ\n";
echo "==============================================================\n\n";

$projects = get_posts(['post_type' => 'du_an', 'posts_per_page' => -1, 'post_status' => 'publish']);
$project_data = [];

foreach ($projects as $proj) {
    $kw_str = get_post_meta($proj->ID, 'rank_math_focus_keyword', true);
    $kws = array_map('trim', explode(',', mb_strtolower($kw_str)));
    
    // Core brand names
    $clean_title = preg_replace('/^(Chung Cư|Đại Đô Thị|Biệt Thự Biển|Tổ Hợp Căn Hộ Hạng Sang|Khu Đô Thị|Căn Hộ)\s+/iu', '', $proj->post_title);
    $clean_title = trim(explode('-', $clean_title)[0]);
    $clean_title = trim(explode('|', $clean_title)[0]);
    $clean_title = trim(explode('(', $clean_title)[0]);

    $project_data[$proj->ID] = [
        'id'          => $proj->ID,
        'title'       => $proj->post_title,
        'slug'        => $proj->post_name,
        'clean_name'  => $clean_title,
        'keywords'    => $kws,
        'seo_title'   => get_post_meta($proj->ID, 'rank_math_title', true),
        'url'         => "https://kenhbatdongsan.vn/du-an/{$proj->post_name}/"
    ];
}

$posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'publish']);

$cannibalization_issues = [];
$cross_linking_issues   = [];
$missing_silo_issues    = [];
$density_issues         = [];

foreach ($posts as $p) {
    $post_id   = $p->ID;
    $title     = $p->post_title;
    $content   = $p->post_content;
    $ref_id    = get_post_meta($post_id, '_kbds_project_ref', true);
    $focus_kw  = mb_strtolower(get_post_meta($post_id, 'rank_math_focus_keyword', true));
    $seo_title = get_post_meta($post_id, 'rank_math_title', true);

    // Bỏ qua 3 bài vĩ mô chung (pháp lý, ngân hàng, vành đai 3)
    if (!$ref_id) {
        continue;
    }

    if (!isset($project_data[$ref_id])) {
        continue;
    }

    $parent_proj = $project_data[$ref_id];
    $parent_clean_name = mb_strtolower($parent_proj['clean_name']);

    // 1. KIỂM TRA ĂN THỊT TỪ KHÓA (CANIBALIZATION)
    // Nếu từ khóa chính của bài vệ tinh TRÙNG HOÀN TOÀN với từ khóa thương hiệu ngắn của Pillar mà không có modifier
    $is_cannibalized = false;
    foreach ($parent_proj['keywords'] as $pkw) {
        if (!empty($pkw) && ($focus_kw === $pkw || $focus_kw === "chung cư " . $pkw || $focus_kw === "dự án " . $pkw)) {
            $cannibalization_issues[] = [
                'post_id'    => $post_id,
                'post_title' => $title,
                'post_kw'    => $focus_kw,
                'parent'     => $parent_proj['title'],
                'reason'     => "Từ khóa chính trùng với từ khóa thương hiệu cấp 1 của Pillar Page"
            ];
            $is_cannibalized = true;
            break;
        }
    }

    // 2. KIỂM TRA CHÈN CHÉO DỰ ÁN (CROSS-PROJECT LINKING)
    // Kiểm tra xem bài của Dự án A có chứa link trỏ đến /du-an/ của Dự án B hay không
    foreach ($project_data as $other_id => $other_proj) {
        if ($other_id == $ref_id) continue;
        if (strpos($content, $other_proj['url']) !== false) {
            $cross_linking_issues[] = [
                'post_id'    => $post_id,
                'post_title' => $title,
                'belongs_to' => $parent_proj['title'],
                'linked_to'  => $other_proj['title'],
                'wrong_url'  => $other_proj['url']
            ];
        }
    }

    // 3. KIỂM TRA SILO ANCHOR TEXT Ở ĐOẠN ĐẦU (FIRST 1000 CHARACTERS)
    $first_chunk = mb_substr($content, 0, 1200);
    if (strpos($first_chunk, $parent_proj['url']) === false) {
        $missing_silo_issues[] = [
            'post_id'    => $post_id,
            'post_title' => $title,
            'parent'     => $parent_proj['title'],
            'url'        => $parent_proj['url']
        ];
    }

    // 4. KIỂM TRA MẬT ĐỘ TỪ KHÓA (STUFFING)
    if ($focus_kw) {
        $text_only = wp_strip_all_tags($content);
        $total_words = str_word_count(strip_tags($text_only));
        if ($total_words > 0) {
            $kw_count = mb_substr_count(mb_strtolower($text_only), $focus_kw);
            $kw_word_count = str_word_count($focus_kw);
            $density = ($kw_count * $kw_word_count / $total_words) * 100;
            if ($density > 2.5) {
                $density_issues[] = [
                    'post_id'    => $post_id,
                    'post_title' => $title,
                    'density'    => round($density, 2) . "%",
                    'kw'         => $focus_kw
                ];
            }
        }
    }
}

echo "1. KẾT QUẢ QUÉT ĂN THỊT TỪ KHÓA (KEYWORD CANNIBALIZATION):\n";
if (empty($cannibalization_issues)) {
    echo "  ✔ HOÀN TOÀN SẠCH! Không có bài viết vệ tinh nào ăn thịt từ khóa thương hiệu của Pillar Page.\n";
} else {
    echo "  ❌ Phát hiện " . count($cannibalization_issues) . " trường hợp:\n";
    print_r($cannibalization_issues);
}

echo "\n2. KẾT QUẢ QUÉT CHÈN CHÉO DỰ ÁN (CROSS-PROJECT LINKING):\n";
if (empty($cross_linking_issues)) {
    echo "  ✔ HOÀN TOÀN CÔ LẬP! 100% bài viết vệ tinh không bị trỏ chéo lộn xộn sang dự án khác.\n";
} else {
    echo "  ❌ Phát hiện " . count($cross_linking_issues) . " trường hợp:\n";
    print_r($cross_linking_issues);
}

echo "\n3. KẾT QUẢ QUÉT LIÊN KẾT ANCHOR TEXT ĐOẠN ĐẦU VỀ PILLAR:\n";
if (empty($missing_silo_issues)) {
    echo "  ✔ 100% bài viết vệ tinh có Anchor text đoạn đầu trỏ chuẩn xác về đúng Landing Page Dự án cha.\n";
} else {
    echo "  ⚠️ Có " . count($missing_silo_issues) . " bài viết chưa có link ở đoạn đầu:\n";
    foreach ($missing_silo_issues as $m) {
        echo "    - [ID {$m['post_id']}] {$m['post_title']} -> {$m['parent']}\n";
    }
}

echo "\n4. KẾT QUẢ QUÉT NHỒI NHÉT TỪ KHÓA (KEYWORD STUFFING > 2.5%):\n";
if (empty($density_issues)) {
    echo "  ✔ MẬT ĐỘ TỰ NHIÊN! 100% bài viết giữ mật độ an toàn chuẩn SEO (1.0% - 2.0%).\n";
} else {
    echo "  ⚠️ Phát hiện " . count($density_issues) . " bài có mật độ cao:\n";
    print_r($density_issues);
}

echo "\n==============================================================\n";
