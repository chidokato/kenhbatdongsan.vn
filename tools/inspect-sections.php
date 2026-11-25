<?php
require_once dirname(__DIR__) . '/wp-load.php';

$p = get_post(398);
// Print all section headers and general layout
preg_match_all('/<!-- SECTION [^>]+ -->/is', $p->post_content, $m);
print_r($m[0]);

// Also check if there's any schema script in content
preg_match('/<script type="application\/ld\+json">.*?<\/script>/is', $p->post_content, $schema);
if (!empty($schema[0])) {
    echo "=== SCHEMA IN CONTENT ===\n" . $schema[0] . "\n";
}
