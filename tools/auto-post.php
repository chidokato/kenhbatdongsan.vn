<?php
/**
 * CLI Tool: Tự động Đăng bài chuẩn SEO từ câu lệnh / JSON payload
 * Cách gọi: c:\xampp\php\php.exe c:\xampp\htdocs\www\kenhbds\tools\auto-post.php <json_file>
 */

require 'c:/xampp/htdocs/www/kenhbds/wp-load.php';

if ( empty( $argv[1] ) ) {
	echo "Usage: php auto-post.php <path-to-json-payload>\n";
	exit( 1 );
}

$json_path = $argv[1];
$payload   = file_exists( $json_path ) ? json_decode( file_get_contents( $json_path ), true ) : json_decode( $json_path, true );

if ( ! is_array( $payload ) ) {
	echo "Invalid JSON payload.\n";
	exit( 1 );
}

$result = KBDS_Auto_Publisher::publish_seo_post( $payload );

if ( is_wp_error( $result ) ) {
	echo "ERROR: " . $result->get_error_message() . "\n";
	exit( 1 );
}

echo wp_json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . "\n";
