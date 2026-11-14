<?php
/**
 * KBDS Chi Can Router
 * Định tuyến URL thân thiện cho Tool Chỉ Căn BĐS:
 * /chi-can/ -> Tool mặc định
 * /chi-can/{slug-du-an}/ -> Tool tùy biến riêng theo từng dự án BĐS
 * Tự động chuyển hướng 301 loại bỏ /tools/chi-can/ cũ
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Chi_Can_Router {

	public static function init() {
		add_action( 'init', array( __CLASS__, 'add_rewrite_rules' ) );
		add_filter( 'query_vars', array( __CLASS__, 'register_query_vars' ) );
		add_action( 'template_redirect', array( __CLASS__, 'handle_chi_can_template' ) );
	}

	public static function add_rewrite_rules() {
		// Khớp /chi-can/ hoặc /chi-can/ten-du-an/
		add_rewrite_rule( '^chi-can/?$', 'index.php?kbds_chi_can=1', 'top' );
		add_rewrite_rule( '^chi-can/([^/]+)/?$', 'index.php?kbds_chi_can=1&kbds_project_slug=$matches[1]', 'top' );

		// Kiểm tra nếu chưa nạp rewrite rules thì flush một lần tự động
		$rules = get_option( 'rewrite_rules' );
		if ( ! isset( $rules['^chi-can/?$'] ) ) {
			flush_rewrite_rules( false );
		}
	}

	public static function register_query_vars( $vars ) {
		$vars[] = 'kbds_chi_can';
		$vars[] = 'kbds_project_slug';
		return $vars;
	}

	public static function handle_chi_can_template() {
		$is_chi_can = get_query_var( 'kbds_chi_can' );

		// 1. Chuyển hướng 301 các link cũ có chứa /tools/chi-can/
		if ( ! $is_chi_can && isset( $_SERVER['REQUEST_URI'] ) && strpos( $_SERVER['REQUEST_URI'], '/tools/chi-can' ) !== false ) {
			wp_redirect( home_url( '/chi-can/imperia-sky-park' ), 301 );
			exit;
		}

		if ( ! $is_chi_can ) {
			return;
		}

		// 2. Xác định Dự án hiện tại
		global $kbds_project_slug, $kbds_project_title, $kbds_project_post;

		$slug = get_query_var( 'kbds_project_slug' );
		if ( empty( $slug ) ) {
			$slug = 'imperia-sky-park';
		}

		$kbds_project_slug = sanitize_title( $slug );

		// Tìm kiếm trong Custom Post Type `du_an`
		$args = array(
			'name'        => $kbds_project_slug,
			'post_type'   => 'du_an',
			'post_status' => 'publish',
			'numberposts' => 1,
		);
		$projects = get_posts( $args );

		if ( ! empty( $projects ) ) {
			$kbds_project_post  = $projects[0];
			$kbds_project_title = $projects[0]->post_title;
		} else {
			// Dự án nhập tự do (ví dụ: imperia-sky-park -> Imperia Sky Park)
			$words = explode( '-', $kbds_project_slug );
			$kbds_project_title = ucwords( implode( ' ', $words ) );
		}

		// Nạp file giao diện Tool Chỉ Căn
		$tool_file = ABSPATH . 'tools/chi-can/index.php';
		if ( file_exists( $tool_file ) ) {
			status_header( 200 );
			include $tool_file;
			exit;
		}
	}
}

KBDS_Chi_Can_Router::init();
