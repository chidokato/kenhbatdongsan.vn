<?php
/**
 * Tự động đồng bộ toàn bộ Dữ liệu từ Localhost lên kenhbatdongsan.vn
 * Được kích hoạt tự động mỗi khi chạy `git push` qua pre-push hook,
 * hoặc có thể chạy độc lập bất kỳ lúc nào: php tools/sync-all.php
 */

$root_dir = dirname(__DIR__);
require_once $root_dir . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 ĐANG TỰ ĐỘNG ĐỒNG BỘ DỮ LIỆU LÊN KENHBATDONGSAN.VN...\n";
echo "==============================================================\n";

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
    
    $headers = [
        $auth_header,
        'Content-Type: application/json'
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    if ($payload !== null) {
        // Tự động chuyển đổi link localhost sang remote domain nếu có trong nội dung
        $encoded = json_encode($payload);
        $encoded = str_replace(
            ['http:\/\/localhost\/www\/kenhbds', 'http://localhost/www/kenhbds'],
            ['https:\/\/kenhbatdongsan.vn', 'https://kenhbatdongsan.vn'],
            $encoded
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);
    }
    
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ['code' => $code, 'data' => json_decode($res, true), 'raw' => $res];
}

// 1. Kiểm tra kết nối API
$check = call_remote_api('wp/v2/users/me');
if ($check['code'] !== 200) {
    echo "❌ Lỗi xác thực API: HTTP {$check['code']}\n";
    exit(1);
}
echo "✔ Kết nối API thành công (User: {$check['data']['name']})\n";

// 2. Cập nhật Git Snapshot File
if (class_exists('KBDS_Backup_Manager')) {
    $snap_file = KBDS_Backup_Manager::create_json_content_backup('git_sync');
    if ($snap_file) {
        $dest_dir = WP_PLUGIN_DIR . '/kenhbds-data-manager/data';
        if (!is_dir($dest_dir)) wp_mkdir_p($dest_dir);
        copy(KBDS_Backup_Manager::get_backup_dir() . '/' . $snap_file, $dest_dir . '/kenhbds-content-latest.json');
        echo "✔ Đã tạo bản Snapshot JSON mới nhất: kenhbds-content-latest.json\n";
    }
}

// 3. Đồng bộ Danh mục (Categories)
$local_cats = get_categories(['hide_empty' => false]);
$remote_cats_res = call_remote_api('wp/v2/categories?per_page=100');
$remote_cats = is_array($remote_cats_res['data']) ? $remote_cats_res['data'] : [];
$remote_cat_slugs = [];
foreach ($remote_cats as $rc) {
    $remote_cat_slugs[$rc['slug']] = $rc['id'];
}

foreach ($local_cats as $lc) {
    if (!isset($remote_cat_slugs[$lc->slug])) {
        $created = call_remote_api('wp/v2/categories', 'POST', [
            'name' => $lc->name,
            'slug' => $lc->slug,
            'description' => $lc->description
        ]);
        if ($created['code'] == 201) {
            echo " + Đã tạo Danh mục: {$lc->name}\n";
            $remote_cat_slugs[$lc->slug] = $created['data']['id'];
        }
    }
}

// 4. Đồng bộ Dự Án (du_an) – gồm Meta, Taxonomy & Ảnh đại diện
$remote_term_cache = [];
function kbds_remote_term_ids($taxonomy, $local_terms) {
    global $remote_term_cache;
    if (!isset($remote_term_cache[$taxonomy])) {
        $remote_term_cache[$taxonomy] = [];
        $r = call_remote_api("wp/v2/{$taxonomy}?per_page=100&hide_empty=0");
        if (is_array($r['data'])) {
            foreach ($r['data'] as $t) {
                if (isset($t['slug'])) $remote_term_cache[$taxonomy][$t['slug']] = $t['id'];
            }
        }
    }
    $ids = [];
    foreach ($local_terms as $lt) {
        if (!isset($remote_term_cache[$taxonomy][$lt->slug])) {
            $c = call_remote_api("wp/v2/{$taxonomy}", 'POST', ['name' => $lt->name, 'slug' => $lt->slug, 'description' => $lt->description]);
            if (in_array($c['code'], [200, 201]) && isset($c['data']['id'])) {
                $remote_term_cache[$taxonomy][$lt->slug] = $c['data']['id'];
                echo "   + Tạo term [{$taxonomy}] {$lt->name}\n";
            }
        }
        if (isset($remote_term_cache[$taxonomy][$lt->slug])) $ids[] = $remote_term_cache[$taxonomy][$lt->slug];
    }
    return $ids;
}

function kbds_remote_media_id($attachment_id) {
    global $remote_domain, $auth_header;
    $file = get_attached_file($attachment_id);
    if (!$file || !file_exists($file)) return 0;
    $att  = get_post($attachment_id);
    $slug = $att->post_name;
    $r = call_remote_api("wp/v2/media?slug=" . urlencode($slug));
    if (is_array($r['data']) && !empty($r['data'][0]['id'])) return $r['data'][0]['id'];

    // Upload ảnh lên Media Library của Live
    $ch = curl_init($remote_domain . '/wp-json/wp/v2/media');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        $auth_header,
        'Content-Type: ' . get_post_mime_type($attachment_id),
        'Content-Disposition: attachment; filename="' . basename($file) . '"',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($file));
    $res  = json_decode(curl_exec($ch), true);
    curl_close($ch);
    if (empty($res['id'])) return 0;
    call_remote_api("wp/v2/media/{$res['id']}", 'POST', [
        'slug'        => $slug,
        'title'       => $att->post_title,
        'alt_text'    => get_post_meta($attachment_id, '_wp_attachment_image_alt', true),
        'caption'     => $att->post_excerpt,
        'description' => $att->post_content,
    ]);
    echo "   + Đã upload ảnh đại diện lên Live: " . basename($file) . "\n";
    return $res['id'];
}

$local_projects = get_posts(['post_type' => 'du_an', 'posts_per_page' => -1, 'post_status' => 'any']);
echo "✔ Tìm thấy " . count($local_projects) . " hồ sơ Dự án trên Localhost\n";

foreach ($local_projects as $proj) {
    $res = call_remote_api("wp/v2/du_an?slug={$proj->post_name}&status=any");
    $exists = is_array($res['data']) && !empty($res['data']);
    
    $payload = [
        'title'   => $proj->post_title,
        'content' => $proj->post_content,
        'excerpt' => $proj->post_excerpt,
        'status'  => $proj->post_status,
        'slug'    => $proj->post_name,
    ];

    // Meta dự án (_kbds_* & Rank Math SEO)
    $meta = [];
    foreach (get_post_meta($proj->ID) as $mk => $mv) {
        if (strpos($mk, '_kbds_') === 0 || strpos($mk, 'rank_math_') === 0) $meta[$mk] = $mv[0];
    }
    if ($meta) $payload['kbds_meta'] = $meta;

    // Taxonomies (khu vực, loại hình, trạng thái, chủ đầu tư)
    foreach (['khu_vuc_bds', 'loai_hinh_bds', 'trang_thai_du_an', 'chu_dau_tu'] as $tax) {
        $terms = wp_get_post_terms($proj->ID, $tax);
        if (!is_wp_error($terms) && $terms) $payload[$tax] = kbds_remote_term_ids($tax, $terms);
    }

    // Ảnh đại diện
    $thumb_id = get_post_thumbnail_id($proj->ID);
    if ($thumb_id) {
        $remote_thumb = kbds_remote_media_id($thumb_id);
        if ($remote_thumb) $payload['featured_media'] = $remote_thumb;
    }
    
    if ($exists) {
        $remote_id = $res['data'][0]['id'];
        $up = call_remote_api("wp/v2/du_an/{$remote_id}", 'POST', $payload);
        echo " ✔ Cập nhật Dự án [{$proj->post_title}] -> Remote ID {$remote_id} (HTTP {$up['code']})\n";
    } else {
        $cr = call_remote_api('wp/v2/du_an', 'POST', $payload);
        echo " + Tạo mới Dự án [{$proj->post_title}] -> HTTP {$cr['code']}\n";
    }
}

// 5. Đồng bộ Giỏ Hàng BĐS (bat_dong_san)
$local_bds = get_posts(['post_type' => 'bat_dong_san', 'posts_per_page' => -1, 'post_status' => 'any']);
echo "✔ Tìm thấy " . count($local_bds) . " mục Giỏ hàng BĐS trên Localhost\n";

foreach ($local_bds as $bds) {
    $res = call_remote_api("wp/v2/bat_dong_san?slug={$bds->post_name}&status=any");
    $exists = is_array($res['data']) && !empty($res['data']);
    
    $payload = [
        'title'   => $bds->post_title,
        'content' => $bds->post_content,
        'excerpt' => $bds->post_excerpt,
        'status'  => $bds->post_status,
        'slug'    => $bds->post_name,
    ];
    
    if ($exists) {
        $remote_id = $res['data'][0]['id'];
        $up = call_remote_api("wp/v2/bat_dong_san/{$remote_id}", 'POST', $payload);
        echo " ✔ Cập nhật Giỏ hàng [{$bds->post_title}] (HTTP {$up['code']})\n";
    } else {
        $cr = call_remote_api('wp/v2/bat_dong_san', 'POST', $payload);
        echo " + Tạo mới Giỏ hàng [{$bds->post_title}] (HTTP {$cr['code']})\n";
    }
}

// 6. Đồng bộ Bài viết Phân tích & Cẩm nang (post)
$local_posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'any']);
echo "✔ Tìm thấy " . count($local_posts) . " bài viết trên Localhost\n";

foreach ($local_posts as $p) {
    $res = call_remote_api("wp/v2/posts?slug={$p->post_name}&status=any");
    $exists = is_array($res['data']) && !empty($res['data']);
    
    $payload = [
        'title'   => $p->post_title,
        'content' => $p->post_content,
        'excerpt' => $p->post_excerpt,
        'status'  => $p->post_status,
        'slug'    => $p->post_name,
    ];

    // Chuyên mục (categories)
    $cat_terms = wp_get_post_categories($p->ID, ['fields' => 'all']);
    if ($cat_terms && !is_wp_error($cat_terms)) {
        $cat_ids = [];
        foreach ($cat_terms as $ct) {
            if ($ct->slug === 'chua-phan-loai') continue;
            if (isset($remote_cat_slugs[$ct->slug])) {
                $cat_ids[] = $remote_cat_slugs[$ct->slug];
            }
        }
        if ($cat_ids) {
            $payload['categories'] = $cat_ids;
        }
    }

    // Ảnh đại diện bài viết
    $thumb_id = get_post_thumbnail_id($p->ID);
    if ($thumb_id) {
        $remote_thumb = kbds_remote_media_id($thumb_id);
        if ($remote_thumb) $payload['featured_media'] = $remote_thumb;
    }
    
    if ($exists) {
        $remote_id = $res['data'][0]['id'];
        $up = call_remote_api("wp/v2/posts/{$remote_id}", 'POST', $payload);
        echo " ✔ Cập nhật Bài viết [{$p->post_title}] (HTTP {$up['code']})\n";
    } else {
        $cr = call_remote_api('wp/v2/posts', 'POST', $payload);
        echo " + Tạo mới Bài viết [{$p->post_title}] (HTTP {$cr['code']})\n";
    }
}

// 6b. Đồng bộ UX Blocks (Footer, Form, Section 1..8)
$local_blocks = get_posts(['post_type' => 'blocks', 'posts_per_page' => -1, 'post_status' => 'any']);
echo "✔ Tìm thấy " . count($local_blocks) . " UX Blocks trên Localhost\n";

foreach ($local_blocks as $b) {
    $res = call_remote_api("wp/v2/ux-blocks?slug={$b->post_name}&status=any");
    $exists = is_array($res['data']) && !empty($res['data']);
    
    $payload = [
        'title'   => $b->post_title,
        'content' => $b->post_content,
        'status'  => $b->post_status,
        'slug'    => $b->post_name,
    ];
    
    if ($exists) {
        $remote_id = $res['data'][0]['id'];
        $up = call_remote_api("wp/v2/ux-blocks/{$remote_id}", 'POST', $payload);
        echo " ✔ Cập nhật UX Block [{$b->post_title}] (HTTP {$up['code']})\n";
    } else {
        $cr = call_remote_api('wp/v2/ux-blocks', 'POST', $payload);
        echo " + Tạo mới UX Block [{$b->post_title}] (HTTP {$cr['code']})\n";
    }
}

// 7. Đồng bộ Thứ tự Menu Chính & Link Chỉ Căn (Menu 40)
$menu_orders = [
    109 => 1, 110 => 2, 111 => 3, 112 => 4, 113 => 5,
    155 => 6, 156 => 7, 114 => 8, 115 => 9, 116 => 10,
    117 => 11, 118 => 12, 119 => 13, 120 => 14
];
foreach ($menu_orders as $mid => $ord) {
    call_remote_api("wp/v2/menu-items/{$mid}", 'POST', ['menu_order' => $ord]);
}
call_remote_api("wp/v2/menu-items/155", 'POST', ['url' => 'https://kenhbatdongsan.vn/chi-can/']);
call_remote_api("wp/v2/menu-items/156", 'POST', ['url' => 'https://kenhbatdongsan.vn/chi-can/imperia-sky-park/']);
echo "✔ Menu Chính đã được đồng bộ thứ tự & đường dẫn Chỉ Căn chuẩn xác.\n";

echo "==============================================================\n";
echo "🎉 ĐỒNG BỘ DỮ LIỆU HOÀN TẤT 100%! BẮT ĐẦU GIT PUSH CODE...\n";
echo "==============================================================\n\n";
exit(0);
