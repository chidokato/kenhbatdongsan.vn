<?php
require_once dirname(__DIR__) . '/wp-load.php';

function list_terms($tax) {
    echo "=== TAXONOMY: $tax ===\n";
    $terms = get_terms(['taxonomy' => $tax, 'hide_empty' => false]);
    foreach ($terms as $t) {
        echo "  - ID: {$t->term_id}, Name: {$t->name}, Slug: {$t->slug}\n";
    }
}

list_terms('chu_dau_tu');
list_terms('khu_vuc_bds');
list_terms('loai_hinh_bds');
