<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "=== CHECK TIN-TUC ===\n";
$page = get_page_by_path('tin-tuc');
if ($page) {
    echo "Page found: ID={$page->ID}, Title={$page->post_title}, Status={$page->post_status}, Type={$page->post_type}\n";
} else {
    echo "No page with slug tin-tuc\n";
}

$page_for_posts = get_option('page_for_posts');
echo "page_for_posts option: {$page_for_posts}\n";
if ($page_for_posts) {
    $p = get_post($page_for_posts);
    if ($p) {
        echo "Posts page: ID={$p->ID}, Slug={$p->post_name}, Title={$p->post_title}, Status={$p->post_status}\n";
    }
}

$cat = get_category_by_slug('tin-tuc');
if ($cat) {
    echo "Category tin-tuc: ID={$cat->term_id}, Name={$cat->name}, Count={$cat->count}\n";
} else {
    echo "No category tin-tuc\n";
}

// Check menu items
$locations = get_nav_menu_locations();
echo "Nav menu locations:\n";
print_r($locations);

// Let's check menu items for primary menu
if (!empty($locations['primary'])) {
    $menu_items = wp_get_nav_menu_items($locations['primary']);
    foreach ($menu_items as $item) {
        echo "Menu item: {$item->title} -> {$item->url} (Type: {$item->type}, Object: {$item->object}, Object ID: {$item->object_id})\n";
    }
}
