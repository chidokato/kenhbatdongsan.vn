<?php
/**
 * Công cụ quét toàn bộ liên kết nội bộ trên kenhbatdongsan.vn để tìm lỗi 404
 */
set_time_limit(0);
ini_set('memory_limit', '512M');

require_once __DIR__ . '/../wp-load.php';
while (ob_get_level()) ob_end_clean(); // Gỡ bỏ output buffer của Normalizer để không bị rewrite console output

define('KBDS_LIVE_DOMAIN', 'https://kenhbatdongsan.vn');

$sitemap_url = KBDS_LIVE_DOMAIN . '/sitemap_index.xml';
$broken_links = [];
$urls_to_check = [];

function to_clean_live_url($url) {
    $clean = str_replace(
        ['http://localhost/www/kenhbds', 'https://localhost/www/kenhbds', 'http://127.0.0.1/www/kenhbds'],
        KBDS_LIVE_DOMAIN,
        $url
    );
    return strtok($clean, '#');
}

echo "1. Đang thu thập danh sách URL từ WordPress Core...\n";

// Trang chủ
$urls_to_check[KBDS_LIVE_DOMAIN . '/'] = 'Trang chủ';

// Pages
$pages = get_posts(['post_type' => 'page', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($pages as $p) {
    if ($p->post_name === 'trang-mau') continue;
    $u = to_clean_live_url(get_permalink($p->ID));
    $urls_to_check[$u] = 'Trang đơn (Page): ' . $p->post_title;
}

// Posts
$posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($posts as $p) {
    $u = to_clean_live_url(get_permalink($p->ID));
    $urls_to_check[$u] = 'Bài viết (Post): ' . $p->post_title;
}

// Dự án (du_an)
$du_an = get_posts(['post_type' => 'du_an', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($du_an as $p) {
    $u = to_clean_live_url(get_permalink($p->ID));
    $urls_to_check[$u] = 'Dự án (du_an): ' . $p->post_title;
}

// Bất động sản (bat_dong_san)
$bds = get_posts(['post_type' => 'bat_dong_san', 'posts_per_page' => -1, 'post_status' => 'publish']);
foreach ($bds as $p) {
    $u = to_clean_live_url(get_permalink($p->ID));
    $urls_to_check[$u] = 'Bất động sản: ' . $p->post_title;
}

// Taxonomies & Categories
$taxonomies = ['category', 'loai_hinh_bds', 'khu_vuc', 'muc_gia', 'chu_dau_tu'];
foreach ($taxonomies as $tax) {
    $terms = get_terms(['taxonomy' => $tax, 'hide_empty' => false]);
    if (!is_wp_error($terms)) {
        foreach ($terms as $t) {
            $link = get_term_link($t);
            if (!is_wp_error($link)) {
                $u = to_clean_live_url($link);
                $urls_to_check[$u] = "Taxonomy [{$tax}]: " . $t->name;
            }
        }
    }
}

// Header & Footer Menu items
$menu_items = wp_get_nav_menu_items(40);
if ($menu_items) {
    foreach ($menu_items as $m) {
        if (!empty($m->url)) {
            $u = to_clean_live_url($m->url);
            if (strpos($u, KBDS_LIVE_DOMAIN) === 0) {
                $urls_to_check[$u] = 'Menu: ' . $m->title;
            }
        }
    }
}

echo "✔ Tìm thấy " . count($urls_to_check) . " URL chính từ dữ liệu hệ thống.\n";

// 2. Thu thập link từ live Sitemaps
echo "2. Đang kiểm tra sitemap_index.xml trên live...\n";
$ch = curl_init($sitemap_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
$sitemap_content = curl_exec($ch);
curl_close($ch);

if ($sitemap_content && preg_match_all('/<loc>(.*?)<\/loc>/', $sitemap_content, $sub_sitemaps)) {
    foreach ($sub_sitemaps[1] as $sub_url) {
        $ch2 = curl_init($sub_url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 15);
        $sub_content = curl_exec($ch2);
        curl_close($ch2);
        if ($sub_content && preg_match_all('/<loc>(.*?)<\/loc>/', $sub_content, $locs)) {
            foreach ($locs[1] as $loc_u) {
                $loc_u = trim($loc_u);
                if (!isset($urls_to_check[$loc_u])) {
                    $urls_to_check[$loc_u] = 'Sitemap XML (' . basename($sub_url) . ')';
                }
            }
        }
    }
}

// 3. Thu thập thêm các liên kết <a> xuất hiện trên HTML Trang chủ
echo "3. Quét thêm toàn bộ liên kết href xuất hiện trên Trang chủ HTML...\n";
$ch = curl_init(KBDS_LIVE_DOMAIN . '/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
$home_html = curl_exec($ch);
curl_close($ch);

if ($home_html && preg_match_all('/href=["\']([^"\']+)["\']/i', $home_html, $matches)) {
    foreach ($matches[1] as $href) {
        $href = trim($href);
        if (strpos($href, '#') === 0 || strpos($href, 'tel:') === 0 || strpos($href, 'mailto:') === 0 || strpos($href, 'javascript:') === 0) continue;
        if (strpos($href, '//') === 0) continue;
        
        if (strpos($href, '/') === 0) {
            $full_url = KBDS_LIVE_DOMAIN . $href;
        } elseif (strpos($href, 'http') === 0) {
            $full_url = $href;
        } else {
            continue;
        }

        if (strpos($full_url, KBDS_LIVE_DOMAIN) !== 0) continue; // Bỏ qua link ngoài

        $clean_u = to_clean_live_url($full_url);
        if (!isset($urls_to_check[$clean_u])) {
            $urls_to_check[$clean_u] = 'Href xuất hiện trên trang chủ';
        }
    }
}

echo "✔ Tổng số URL cần kiểm tra HTTP code: " . count($urls_to_check) . "\n";

// 4. Quét HTTP Code (Multi-cURL)
echo "4. Bắt đầu quét phản hồi HTTP trên https://kenhbatdongsan.vn ...\n";

$all_urls = array_keys($urls_to_check);
$chunks = array_chunk($all_urls, 15);
$success_count = 0;

foreach ($chunks as $chunk_idx => $chunk) {
    $mh = curl_multi_init();
    $handles = [];
    foreach ($chunk as $url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true); // HEAD request
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) KenhBDS-LinkChecker/1.0');
        curl_multi_add_handle($mh, $ch);
        $handles[$url] = $ch;
    }

    $running = null;
    do {
        curl_multi_exec($mh, $running);
        curl_multi_select($mh);
    } while ($running > 0);

    foreach ($handles as $url => $ch) {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $source = $urls_to_check[$url];
        
        if ($http_code == 404 || $http_code >= 400 || $http_code == 0) {
            $broken_links[] = [
                'url' => $url,
                'source' => $source,
                'http_code' => $http_code
            ];
            echo " ❌ [HTTP $http_code] $url ($source)\n";
        } else {
            $success_count++;
            // echo " ✔ [HTTP $http_code] $url\n";
        }
        curl_multi_remove_handle($mh, $ch);
        curl_close($ch);
    }
    curl_multi_close($mh);
}

echo "\n==============================================================\n";
echo "📊 KẾT QUẢ TỔNG HỢP KIỂM TRA TOÀN BỘ WEBSITE KENHBATDONGSAN.VN\n";
echo "==============================================================\n";
echo "✔ Số URL hoạt động tốt (HTTP 200/301): {$success_count}\n";
echo "⚠️ Số URL lỗi (HTTP 404 hoặc 4xx/5xx): " . count($broken_links) . "\n\n";

if (empty($broken_links)) {
    echo "🎉 TUYỆT VỜI! WEBSITE HOÀN TOÀN SẠCH LỖI 404! KHÔNG CÓ BẤT KỲ LINK HỎNG NÀO.\n";
} else {
    echo "DANH SÁCH CHI TIẾT CÁC LINK CẦN XỬ LÝ:\n";
    foreach ($broken_links as $b) {
        echo "- [HTTP {$b['http_code']}] {$b['url']} -> Nguồn: {$b['source']}\n";
    }
}
