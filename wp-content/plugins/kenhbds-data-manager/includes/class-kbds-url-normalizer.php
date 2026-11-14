<?php
/**
 * Dynamic URL Normalizer for KenhBatDongSan.vn
 * Đảm bảo 100% không bao giờ bị dính hoặc quay về link localhost khi push lên hosting,
 * đồng thời chạy mượt mà trên môi trường Localhost (XAMPP).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_URL_Normalizer {

	const PRODUCTION_DOMAIN = 'kenhbatdongsan.vn';
	const PRODUCTION_URL    = 'https://kenhbatdongsan.vn';

	/**
	 * Khởi tạo các hook chuẩn hóa URL
	 */
	public static function init() {
		// 1. Chuẩn hóa siteurl & home động
		add_filter( 'option_siteurl', array( __CLASS__, 'filter_siteurl' ), 999 );
		add_filter( 'option_home', array( __CLASS__, 'filter_home' ), 999 );

		// 2. Chuẩn hóa thư mục uploads media
		add_filter( 'upload_dir', array( __CLASS__, 'filter_upload_dir' ), 999 );

		// 3. Chuẩn hóa nội dung bài viết và menu
		add_filter( 'the_content', array( __CLASS__, 'filter_content_urls' ), 999 );
		add_filter( 'widget_text', array( __CLASS__, 'filter_content_urls' ), 999 );
		add_filter( 'wp_nav_menu', array( __CLASS__, 'filter_content_urls' ), 999 );

		// 4. Ngăn chặn chuyển hướng (redirect) về localhost khi ở trên hosting
		add_filter( 'wp_redirect', array( __CLASS__, 'filter_redirect' ), 999 );

		// 5. Tự động kiểm tra và đảm bảo Database options luôn lưu domain chuẩn
		add_action( 'admin_init', array( __CLASS__, 'ensure_database_options' ) );
		add_action( 'admin_init', array( __CLASS__, 'ensure_chi_can_menu' ) );
	}

	/**
	 * Kiểm tra xem môi trường hiện tại có phải là Localhost không
	 */
	public static function is_local() {
		$host = $_SERVER['HTTP_HOST'] ?? '';
		if ( empty( $host ) && PHP_SAPI === 'cli' ) {
			return true;
		}
		return ( 'localhost' === $host || '127.0.0.1' === $host || false !== strpos( $host, '192.168.' ) || false !== strpos( $host, '.local' ) );
	}

	/**
	 * Lấy base URL phù hợp theo môi trường truy cập
	 */
	public static function get_current_base_url() {
		if ( self::is_local() ) {
			$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
			return 'http://' . $host . '/www/kenhbds';
		}
		return self::PRODUCTION_URL;
	}

	public static function filter_siteurl( $url ) {
		return self::get_current_base_url();
	}

	public static function filter_home( $url ) {
		return self::get_current_base_url();
	}

	public static function filter_upload_dir( $uploads ) {
		$base_url = self::get_current_base_url();
		$uploads['baseurl'] = $base_url . '/wp-content/uploads';
		$uploads['url']     = $base_url . '/wp-content/uploads' . $uploads['subdir'];
		return $uploads;
	}

	/**
	 * Tự động chuyển đổi link trong nội dung:
	 * - Khi ở hosting: chuyển mọi link localhost còn sót thành domain chính thức
	 * - Khi ở local: chuyển link domain chính thức thành localhost để test không bị nhảy ra ngoài
	 */
	public static function filter_content_urls( $content ) {
		if ( empty( $content ) || ! is_string( $content ) ) {
			return $content;
		}

		if ( self::is_local() ) {
			$local_url = self::get_current_base_url();
			return str_replace( self::PRODUCTION_URL, $local_url, $content );
		} else {
			// Đang ở hosting: Tuyệt đối không để sót link localhost
			$search = array(
				'http://localhost/www/kenhbds',
				'https://localhost/www/kenhbds',
				'http://127.0.0.1/www/kenhbds',
			);
			return str_replace( $search, self::PRODUCTION_URL, $content );
		}
	}

	/**
	 * Ngăn chặn lỗi nhảy về localhost khi đăng nhập hoặc chuyển hướng trên hosting
	 */
	public static function filter_redirect( $location ) {
		if ( ! self::is_local() ) {
			$search = array(
				'http://localhost/www/kenhbds',
				'https://localhost/www/kenhbds',
				'http://127.0.0.1/www/kenhbds',
			);
			$location = str_replace( $search, self::PRODUCTION_URL, $location );
		}
		return $location;
	}

	/**
	 * Đảm bảo Database lưu 100% domain chính thức https://kenhbatdongsan.vn
	 */
	public static function ensure_database_options() {
		// Chỉ admin mới kích hoạt kiểm tra ngầm
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		global $wpdb;
		$db_siteurl = $wpdb->get_var( "SELECT option_value FROM {$wpdb->options} WHERE option_name = 'siteurl'" );
		$db_home    = $wpdb->get_var( "SELECT option_value FROM {$wpdb->options} WHERE option_name = 'home'" );

		if ( $db_siteurl !== self::PRODUCTION_URL || $db_home !== self::PRODUCTION_URL ) {
			$wpdb->update( $wpdb->options, array( 'option_value' => self::PRODUCTION_URL ), array( 'option_name' => 'siteurl' ) );
			$wpdb->update( $wpdb->options, array( 'option_value' => self::PRODUCTION_URL ), array( 'option_name' => 'home' ) );
		}
	}

	/**
	 * Tự động đảm bảo menu 'Chỉ Căn BĐS' -> 'Imperia Sky Park' luôn tồn tại trên mọi môi trường
	 */
	public static function ensure_chi_can_menu() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$menu = wp_get_nav_menu_object( 'Menu Chính - Kênh BĐS' );
		if ( ! $menu ) {
			$locations = get_nav_menu_locations();
			if ( ! empty( $locations['primary'] ) ) {
				$menu = wp_get_nav_menu_object( $locations['primary'] );
			}
		}
		if ( ! $menu ) {
			return;
		}

		$items       = wp_get_nav_menu_items( $menu->term_id );
		$parent_id   = 0;
		$has_imperia = false;

		if ( $items ) {
			foreach ( $items as $item ) {
				if ( trim( $item->title ) === 'Chỉ Căn BĐS' ) {
					$parent_id = $item->ID;
				}
				if ( trim( $item->title ) === 'Imperia Sky Park' ) {
					$has_imperia = true;
				}
			}
		}

		$tool_url = self::PRODUCTION_URL . '/tools/chi-can/';

		if ( ! $parent_id ) {
			$parent_id = wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'   => 'Chỉ Căn BĐS',
				'menu-item-url'     => $tool_url,
				'menu-item-status'  => 'publish',
				'menu-item-type'    => 'custom',
				'menu-item-classes' => 'menu-item-chi-can',
			) );
		}

		if ( $parent_id && ! $has_imperia ) {
			wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'     => 'Imperia Sky Park',
				'menu-item-url'       => $tool_url,
				'menu-item-status'    => 'publish',
				'menu-item-type'      => 'custom',
				'menu-item-parent-id' => $parent_id,
			) );
		}
	}
}
