<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "=== PAGES ===\n";
$pages = get_posts(['post_type' => 'page', 'posts_per_page' => -1, 'post_status' => 'any']);
foreach ($pages as $p) {
    echo "ID: {$p->ID} | Title: {$p->post_title} | Slug: {$p->post_name} | Status: {$p->post_status}\n";
}

echo "\n=== UX BLOCKS ===\n";
$blocks = get_posts(['post_type' => 'blocks', 'posts_per_page' => -1, 'post_status' => 'any']);
foreach ($blocks as $b) {
    echo "ID: {$b->ID} | Title: {$b->post_title} | Slug: {$b->post_name}\n";
}

echo "\n=== ACTIVE PLUGINS ===\n";
$active_plugins = get_option('active_plugins');
print_r($active_plugins);

echo "\n=== THEME & FOOTER SETTINGS ===\n";
$theme_mods = get_theme_mods();
echo "Footer setting:\n";
if (isset($theme_mods['footer_block'])) echo "footer_block: " . $theme_mods['footer_block'] . "\n";
if (isset($theme_mods['footer_1'])) echo "footer_1: " . $theme_mods['footer_1'] . "\n";
if (isset($theme_mods['footer_2'])) echo "footer_2: " . $theme_mods['footer_2'] . "\n";
if (isset($theme_mods['footer_bottom_text'])) echo "footer_bottom_text: " . $theme_mods['footer_bottom_text'] . "\n";

echo "\n=== MENUS ===\n";
$menus = wp_get_nav_menus();
foreach ($menus as $m) {
    echo "Menu ID: {$m->term_id} | Name: {$m->name} | Slug: {$m->slug}\n";
}
