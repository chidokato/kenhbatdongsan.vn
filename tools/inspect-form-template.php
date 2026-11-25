<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p = get_post(398); // An Bình Homeland
preg_match('/<section[^>]*id="dang-ky"[^>]*>.*?<\/section>/is', $p->post_content, $matches);
if (!empty($matches[0])) {
    echo "=== FORM IN POST 398 ===\n";
    echo $matches[0] . "\n";
} else {
    echo "No form found with id dang-ky\n";
    // Search for form
    preg_match('/<form[^>]*>.*?<\/form>/is', $p->post_content, $matches_form);
    if (!empty($matches_form[0])) {
        echo $matches_form[0] . "\n";
    }
}
