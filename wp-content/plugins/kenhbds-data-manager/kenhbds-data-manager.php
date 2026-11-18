<?php
/**
 * Plugin Name: Kênh Bất Động Sản - Quản lý Dữ liệu & Backup Toàn diện (Core)
 * Plugin URI: https://kenhbatdongsan.vn
 * Description: Hệ thống lõi quản lý Dữ liệu Dự án (Mô hình B), Giỏ hàng xác thực & Phễu SEO (Mô hình D), CRM Khách hàng, Xuất/Nhập Excel-JSON và Sao lưu/Tối ưu Database tự động cho kenhbatdongsan.vn.
 * Version: 1.0.0
 * Author: KenhBatDongSan.vn
 * Text Domain: kenhbds-data-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'KBDS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'KBDS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-url-normalizer.php';
require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-post-types.php';
require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-backup-manager.php';
require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-shortcodes.php';
require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-seo-enhancer.php';
require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-homepage-sections.php';
require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-notification-service.php';
require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-chi-can-router.php';

// Khởi chạy các phân hệ giao diện & dữ liệu
KBDS_URL_Normalizer::init();
KBDS_Post_Types::init();
KBDS_Backup_Manager::init();
KBDS_Shortcodes::init();
KBDS_SEO_Enhancer::init();
KBDS_Homepage_Sections::init();
KBDS_Notification_Service::init();

/**
 * Tắt hoàn toàn việc WordPress tự động thay Emoji thành thẻ <img> SVG
 * Loại bỏ 100% lỗi Emoji bị phóng to thành ảnh khổng lồ (300px-400px) trên Mobile & Desktop
 */
add_action( 'init', 'kbds_disable_wp_emojis' );
function kbds_disable_wp_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', function( $plugins ) {
		return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
	} );
}

// Chỉ nạp Công cụ Auto-Publisher khi ở trong Trang Quản Trị (wp-admin) hoặc chạy lệnh CLI
// -> Đảm bảo 0% tải thừa cho khách truy cập ngoài giao diện trang chủ!
if ( is_admin() || PHP_SAPI === 'cli' ) {
	require_once KBDS_PLUGIN_DIR . 'includes/class-kbds-auto-publisher.php';
	KBDS_Auto_Publisher::init();
}

/**
 * Tích hợp Phân hệ Tool Tạo Phiếu Chỉ Căn BĐS vào Menu Quản trị & Admin Bar
 */
add_action( 'admin_menu', 'kbds_register_chi_can_tool_menu', 20 );
function kbds_register_chi_can_tool_menu() {
	add_submenu_page(
		'kbds-data-backup',
		'Tạo Phiếu Chỉ Căn BĐS',
		'🎯 Tạo Phiếu Chỉ Căn',
		'manage_options',
		'kbds-tool-chi-can',
		'kbds_render_chi_can_tool_page'
	);
}

function kbds_render_chi_can_tool_page() {
	$tool_url = home_url( '/chi-can/imperia-sky-park' );
	?>
	<div class="wrap" style="margin: 10px 20px 0 0;">
		<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
			<h1 style="font-weight: 700; color: #0b2b5e; margin: 0;">🎯 Tool Tạo Phiếu Chỉ Căn Căn Hộ BĐS</h1>
			<a href="<?php echo esc_url( $tool_url ); ?>" target="_blank" class="button button-primary" style="font-weight: 600;">
				Mở toàn màn hình tab mới ↗
			</a>
		</div>
		<iframe src="<?php echo esc_url( $tool_url ); ?>" style="width: 100%; height: calc(100vh - 110px); border: 1px solid #cbd5e1; border-radius: 12px; background: #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.06);"></iframe>
	</div>
	<?php
}

// Nút tắt trên Admin Bar trên cùng
add_action( 'admin_bar_menu', 'kbds_add_chi_can_tool_admin_bar', 100 );
function kbds_add_chi_can_tool_admin_bar( $admin_bar ) {
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	$admin_bar->add_node( array(
		'id'    => 'kbds_tool_chi_can',
		'title' => '<span class="ab-icon dashicons dashicons-layout" style="top:2px;"></span> <span class="ab-label" style="font-weight:bold;color:#fcd34d;">Tool Chỉ Căn</span>',
		'href'  => home_url( '/chi-can/imperia-sky-park' ),
		'meta'  => array(
			'target' => '_blank',
			'title'  => 'Mở Tool Tạo Phiếu Chỉ Căn BĐS',
		),
	) );
}

/**
 * Kích hoạt Plugin: Khởi tạo Danh mục chuẩn, Lịch Backup tự động và Rewrite Rules
 */
register_activation_hook( __FILE__, 'kbds_activate_plugin' );

function kbds_activate_plugin() {
	KBDS_Post_Types::seed_default_terms();
	KBDS_Backup_Manager::get_backup_dir();
	KBDS_SEO_Enhancer::configure_seo_plugins_defaults();

	if ( ! wp_next_scheduled( KBDS_Backup_Manager::CRON_HOOK ) ) {
		wp_schedule_event( time() + 300, 'daily', KBDS_Backup_Manager::CRON_HOOK );
	}

	flush_rewrite_rules();
}
