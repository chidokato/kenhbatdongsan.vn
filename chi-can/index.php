<?php
/**
 * Chi Can BĐS - Friendly Project Router
 * Hỗ trợ URL:
 * - /chi-can/
 * - /chi-can/{du-an} (VD: /chi-can/imperia-sky-park)
 */

require_once dirname(__DIR__) . '/wp-load.php';

// Xác định slug dự án từ Query param hoặc REQUEST_URI
$slug = '';
if ( ! empty( $_GET['du_an'] ) ) {
	$slug = sanitize_title( $_GET['du_an'] );
} else {
	$path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
	$segments = explode( '/', $path );
	// Bỏ qua subfolder localhost nếu có (/www/kenhbds/chi-can/...)
	$idx = array_search( 'chi-can', $segments, true );
	if ( false !== $idx && isset( $segments[ $idx + 1 ] ) && ! empty( $segments[ $idx + 1 ] ) ) {
		$slug = sanitize_title( $segments[ $idx + 1 ] );
	}
}

if ( empty( $slug ) ) {
	$slug = 'imperia-sky-park';
}

global $kbds_project_slug, $kbds_project_title, $kbds_project_post;
$kbds_project_slug = $slug;

// Tìm trong Custom Post Type `du_an`
$projects = get_posts( array(
	'name'        => $slug,
	'post_type'   => 'du_an',
	'post_status' => 'publish',
	'numberposts' => 1,
) );

if ( ! empty( $projects ) ) {
	$kbds_project_title = $projects[0]->post_title;
	$kbds_project_post  = $projects[0];
} else {
	$words = explode( '-', $slug );
	$kbds_project_title = ucwords( implode( ' ', $words ) );
}

status_header( 200 );
include dirname(__DIR__) . '/tools/chi-can/index.php';
exit;
