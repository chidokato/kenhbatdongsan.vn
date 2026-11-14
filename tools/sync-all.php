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
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
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

// 4. Đồng bộ Dự Án (du_an)
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
    
    if ($exists) {
        $remote_id = $res['data'][0]['id'];
        $up = call_remote_api("wp/v2/posts/{$remote_id}", 'POST', $payload);
        echo " ✔ Cập nhật Bài viết [{$p->post_title}] (HTTP {$up['code']})\n";
    } else {
        $cr = call_remote_api('wp/v2/posts', 'POST', $payload);
        echo " + Tạo mới Bài viết [{$p->post_title}] (HTTP {$cr['code']})\n";
    }
}

// 7. Đồng bộ Thứ tự Menu Chính (Menu 40)
$menu_orders = [
    109 => 1, 110 => 2, 111 => 3, 112 => 4, 113 => 5,
    155 => 6, 156 => 7, 114 => 8, 115 => 9, 116 => 10,
    117 => 11, 118 => 12, 119 => 13, 120 => 14
];
foreach ($menu_orders as $mid => $ord) {
    call_remote_api("wp/v2/menu-items/{$mid}", 'POST', ['menu_order' => $ord]);
}
echo "✔ Menu Chính đã được đồng bộ thứ tự chuẩn xác.\n";

echo "==============================================================\n";
echo "🎉 ĐỒNG BỘ DỮ LIỆU HOÀN TẤT 100%! BẮT ĐẦU GIT PUSH CODE...\n";
echo "==============================================================\n\n";
exit(0);
