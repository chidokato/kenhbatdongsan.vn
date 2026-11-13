<?php
/**
 * Trung tâm Quản lý, Sao lưu (Backup), Khôi phục (Restore) & Tối ưu Dữ liệu
 * Chuyên biệt cho Kênh Bất Động Sản (kenhbatdongsan.vn)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Backup_Manager {

	const CRON_HOOK = 'kbds_Automated_backup_cron';

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'register_admin_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'handle_admin_actions' ) );
		add_action( self::CRON_HOOK, array( __CLASS__, 'run_scheduled_backup' ) );
	}

	/**
	 * Đường dẫn thư mục lưu trữ Backup được bảo vệ
	 */
	public static function get_backup_dir() {
		$dir = WP_CONTENT_DIR . '/kenhbds-backups';
		if ( ! file_exists( $dir ) ) {
			wp_mkdir_p( $dir );
		}
		self::protect_backup_dir( $dir );
		return $dir;
	}

	/**
	 * Bảo mật tuyệt đối thư mục Backup khỏi truy cập trực tiếp qua trình duyệt
	 */
	public static function protect_backup_dir( $dir ) {
		$htaccess = $dir . '/.htaccess';
		if ( ! file_exists( $htaccess ) ) {
			file_put_contents( $htaccess, "Order deny,allow\nDeny from all\n<IfModule mod_authz_core.c>\nRequire all denied\n</IfModule>\n" );
		}
		$webconfig = $dir . '/web.config';
		if ( ! file_exists( $webconfig ) ) {
			file_put_contents( $webconfig, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<configuration><system.webServer><authorization><deny users=\"*\" /></authorization></system.webServer></configuration>" );
		}
		$index = $dir . '/index.php';
		if ( ! file_exists( $index ) ) {
			file_put_contents( $index, "<?php // Silence is golden.\n" );
		}
	}

	/**
	 * Đăng ký Menu Quản trị Trung tâm Dữ liệu & Backup
	 */
	public static function register_admin_menu() {
		add_menu_page(
			'Quản lý & Backup Dữ liệu - Kênh BĐS',
			'Backup & Dữ liệu',
			'manage_options',
			'kbds-data-backup',
			array( __CLASS__, 'render_admin_page' ),
			'dashicons-database-view',
			3
		);
	}

	/**
	 * Xử lý các thao tác của Admin (Backup SQL, JSON, CSV, ZIP, Restore, Optimize, Delete)
	 */
	public static function handle_admin_actions() {
		if ( ! isset( $_REQUEST['page'] ) || 'kbds-data-backup' !== $_REQUEST['page'] ) {
			return;
		}
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Tải file backup về máy
		if ( isset( $_GET['kbds_download'] ) && isset( $_GET['_wpnonce'] ) ) {
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'kbds_download_backup' ) ) {
				$filename = basename( sanitize_file_name( wp_unslash( $_GET['kbds_download'] ) ) );
				$filepath = self::get_backup_dir() . '/' . $filename;
				if ( file_exists( $filepath ) && is_file( $filepath ) ) {
					nocache_headers();
					header( 'Content-Description: File Transfer' );
					header( 'Content-Type: application/octet-stream' );
					header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
					header( 'Content-Length: ' . filesize( $filepath ) );
					readfile( $filepath );
					exit;
				}
			}
		}

		// Xóa file backup
		if ( isset( $_GET['kbds_delete'] ) && isset( $_GET['_wpnonce'] ) ) {
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'kbds_delete_backup' ) ) {
				$filename = basename( sanitize_file_name( wp_unslash( $_GET['kbds_delete'] ) ) );
				$filepath = self::get_backup_dir() . '/' . $filename;
				if ( file_exists( $filepath ) && is_file( $filepath ) ) {
					@unlink( $filepath );
				}
				wp_safe_redirect( admin_url( 'admin.php?page=kbds-data-backup&msg=deleted' ) );
				exit;
			}
		}

		if ( ! isset( $_POST['kbds_action'] ) || ! isset( $_POST['kbds_backup_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kbds_backup_nonce'] ) ), 'kbds_backup_action' ) ) {
			return;
		}

		$action = sanitize_text_field( wp_unslash( $_POST['kbds_action'] ) );

		switch ( $action ) {
			case 'backup_db':
				$file = self::create_database_backup( 'manual' );
				$msg  = $file ? 'db_created' : 'error';
				wp_safe_redirect( admin_url( 'admin.php?page=kbds-data-backup&msg=' . $msg ) );
				exit;

			case 'backup_json':
				$file = self::create_json_content_backup( 'manual' );
				$msg  = $file ? 'json_created' : 'error';
				wp_safe_redirect( admin_url( 'admin.php?page=kbds-data-backup&msg=' . $msg ) );
				exit;

			case 'backup_zip':
				$file = self::create_files_zip_backup();
				$msg  = $file ? 'zip_created' : 'error';
				wp_safe_redirect( admin_url( 'admin.php?page=kbds-data-backup&msg=' . $msg ) );
				exit;

			case 'export_csv':
				$type = isset( $_POST['csv_type'] ) ? sanitize_text_field( wp_unslash( $_POST['csv_type'] ) ) : 'du_an';
				self::export_csv_stream( $type );
				exit;

			case 'import_json':
				if ( ! empty( $_FILES['kbds_json_file']['tmp_name'] ) ) {
					$json_raw = file_get_contents( $_FILES['kbds_json_file']['tmp_name'] );
					$result   = self::import_json_content( $json_raw );
					$msg      = $result ? 'json_imported' : 'error';
					wp_safe_redirect( admin_url( 'admin.php?page=kbds-data-backup&msg=' . $msg ) );
					exit;
				}
				break;

			case 'optimize_db':
				self::optimize_and_clean_database();
				wp_safe_redirect( admin_url( 'admin.php?page=kbds-data-backup&msg=optimized' ) );
				exit;

			case 'save_schedule':
				$freq = isset( $_POST['backup_frequency'] ) ? sanitize_text_field( wp_unslash( $_POST['backup_frequency'] ) ) : 'daily';
				$keep = isset( $_POST['backup_retention'] ) ? max( 3, (int) $_POST['backup_retention'] ) : 10;
				update_option( 'kbds_backup_frequency', $freq );
				update_option( 'kbds_backup_retention', $keep );

				wp_clear_scheduled_hook( self::CRON_HOOK );
				if ( 'disabled' !== $freq ) {
					wp_schedule_event( time() + 60, $freq, self::CRON_HOOK );
				}
				wp_safe_redirect( admin_url( 'admin.php?page=kbds-data-backup&msg=schedule_saved' ) );
				exit;
		}
	}

	/**
	 * Tạo bản sao lưu toàn bộ Database MySQL (.sql) chuẩn UTF8MB4
	 */
	public static function create_database_backup( $prefix = 'auto' ) {
		global $wpdb;
		@set_time_limit( 300 );

		$dir      = self::get_backup_dir();
		$filename = sprintf( 'kenhbds_db_%s_%s.sql', $prefix, date( 'Ymd_His' ) );
		$filepath = $dir . '/' . $filename;

		$handle = @fopen( $filepath, 'w' );
		if ( ! $handle ) {
			return false;
		}

		$header  = "-- ==========================================================\n";
		$header .= "-- KÊNH BẤT ĐỘNG SẢN (kenhbatdongsan.vn) - DATABASE BACKUP\n";
		$header .= "-- Generated at: " . current_time( 'mysql' ) . "\n";
		$header .= "-- Database: " . DB_NAME . "\n";
		$header .= "-- ==========================================================\n\n";
		$header .= "SET NAMES utf8mb4;\n";
		$header .= "SET FOREIGN_KEY_CHECKS = 0;\n";
		$header .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n\n";
		fwrite( $handle, $header );

		$tables = $wpdb->get_col( 'SHOW TABLES' );
		foreach ( $tables as $table ) {
			$create_row = $wpdb->get_row( "SHOW CREATE TABLE `{$table}`", ARRAY_N );
			if ( ! $create_row ) {
				continue;
			}
			fwrite( $handle, "-- Cấu trúc bảng `{$table}`\n" );
			fwrite( $handle, "DROP TABLE IF EXISTS `{$table}`;\n" );
			fwrite( $handle, $create_row[1] . ";\n\n" );

			$rows = $wpdb->get_results( "SELECT * FROM `{$table}`", ARRAY_A );
			if ( ! empty( $rows ) ) {
				fwrite( $handle, "-- Dữ liệu bảng `{$table}` (" . count( $rows ) . " bản ghi)\n" );
				foreach ( $rows as $row ) {
					$vals = array();
					foreach ( $row as $val ) {
						if ( null === $val ) {
							$vals[] = 'NULL';
						} else {
							$vals[] = "'" . $wpdb->_real_escape( $val ) . "'";
						}
					}
					fwrite( $handle, "INSERT INTO `{$table}` VALUES (" . implode( ',', $vals ) . ");\n" );
				}
				fwrite( $handle, "\n" );
			}
		}

		fwrite( $handle, "SET FOREIGN_KEY_CHECKS = 1;\n" );
		fclose( $handle );

		update_option( 'kbds_last_backup_time', current_time( 'mysql' ) );
		self::enforce_retention_policy();

		return $filename;
	}

	/**
	 * Tạo bản sao lưu Nội dung có cấu trúc ra file JSON độc lập
	 * (Bao gồm: Dự án, Giỏ hàng, Khách hàng CRM, Bài viết SEO, Taxonomies, Cấu hình Theme)
	 */
	public static function create_json_content_backup( $prefix = 'manual' ) {
		$dir      = self::get_backup_dir();
		$filename = sprintf( 'kenhbds_content_%s_%s.json', $prefix, date( 'Ymd_His' ) );
		$filepath = $dir . '/' . $filename;

		$taxonomies_data = array();
		$tax_list        = array( 'category', 'post_tag', 'khu_vuc_bds', 'loai_hinh_bds', 'trang_thai_du_an', 'chu_dau_tu', 'loai_giao_dich' );
		foreach ( $tax_list as $tax ) {
			$terms = get_terms( array( 'taxonomy' => $tax, 'hide_empty' => false ) );
			if ( ! is_wp_error( $terms ) ) {
				foreach ( $terms as $t ) {
					$taxonomies_data[ $tax ][] = array(
						'name'        => $t->name,
						'slug'        => $t->slug,
						'description' => $t->description,
					);
				}
			}
		}

		$posts_data = array();
		$all_items  = get_posts( array(
			'post_type'      => array( 'du_an', 'bat_dong_san', 'bds_lead', 'post', 'page', 'blocks' ),
			'posts_per_page' => -1,
			'post_status'    => array( 'publish', 'draft', 'private', 'future' ),
		) );

		foreach ( $all_items as $item ) {
			$meta_raw = get_post_meta( $item->ID );
			$meta     = array();
			foreach ( $meta_raw as $k => $v ) {
				if ( '_edit_lock' === $k || '_edit_last' === $k ) {
					continue;
				}
				$meta[ $k ] = maybe_unserialize( $v[0] );
			}

			$item_terms = array();
			$obj_taxes  = get_object_taxonomies( $item->post_type );
			foreach ( $obj_taxes as $tx ) {
				$t_slugs = wp_get_object_terms( $item->ID, $tx, array( 'fields' => 'slugs' ) );
				if ( ! is_wp_error( $t_slugs ) && ! empty( $t_slugs ) ) {
					$item_terms[ $tx ] = $t_slugs;
				}
			}

			$posts_data[] = array(
				'ID'           => $item->ID,
				'post_type'    => $item->post_type,
				'post_status'  => $item->post_status,
				'post_title'   => $item->post_title,
				'post_name'    => $item->post_name,
				'post_excerpt' => $item->post_excerpt,
				'post_content' => $item->post_content,
				'post_date'    => $item->post_date,
				'meta'         => $meta,
				'terms'        => $item_terms,
			);
		}

		$payload = array(
			'site'         => 'kenhbatdongsan.vn',
			'exported_at'  => current_time( 'mysql' ),
			'version'      => '1.0',
			'theme_mods'   => get_theme_mods(),
			'taxonomies'   => $taxonomies_data,
			'items_count'  => count( $posts_data ),
			'items'        => $posts_data,
		);

		$written = file_put_contents( $filepath, wp_json_encode( $payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
		self::enforce_retention_policy();

		return $written ? $filename : false;
	}

	/**
	 * Khôi phục / Nhập dữ liệu từ file JSON Snapshot
	 */
	public static function import_json_content( $json_string ) {
		$data = json_decode( $json_string, true );
		if ( ! is_array( $data ) || empty( $data['items'] ) ) {
			return false;
		}

		// 1. Khôi phục Taxonomies
		if ( ! empty( $data['taxonomies'] ) && is_array( $data['taxonomies'] ) ) {
			foreach ( $data['taxonomies'] as $tax => $terms ) {
				if ( ! taxonomy_exists( $tax ) ) {
					continue;
				}
				foreach ( $terms as $t ) {
					if ( ! term_exists( $t['slug'], $tax ) ) {
						wp_insert_term( $t['name'], $tax, array(
							'slug'        => $t['slug'],
							'description' => isset( $t['description'] ) ? $t['description'] : '',
						) );
					}
				}
			}
		}

		// 2. Khôi phục Posts / Dự án / Giỏ hàng / Leads
		foreach ( $data['items'] as $item ) {
			$existing = get_page_by_path( $item['post_name'], OBJECT, $item['post_type'] );
			$postarr  = array(
				'post_type'    => $item['post_type'],
				'post_status'  => $item['post_status'],
				'post_title'   => $item['post_title'],
				'post_name'    => $item['post_name'],
				'post_excerpt' => isset( $item['post_excerpt'] ) ? $item['post_excerpt'] : '',
				'post_content' => isset( $item['post_content'] ) ? $item['post_content'] : '',
			);

			if ( $existing ) {
				$postarr['ID'] = $existing->ID;
				$post_id       = wp_update_post( $postarr );
			} else {
				$post_id = wp_insert_post( $postarr );
			}

			if ( ! is_wp_error( $post_id ) && $post_id ) {
				if ( ! empty( $item['meta'] ) && is_array( $item['meta'] ) ) {
					foreach ( $item['meta'] as $mk => $mv ) {
						update_post_meta( $post_id, $mk, $mv );
					}
				}
				if ( ! empty( $item['terms'] ) && is_array( $item['terms'] ) ) {
					foreach ( $item['terms'] as $tx => $slugs ) {
						if ( taxonomy_exists( $tx ) ) {
							wp_set_object_terms( $post_id, $slugs, $tx );
						}
					}
				}
			}
		}

		return true;
	}

	/**
	 * Đóng gói ZIP thư mục Uploads + Child Theme + Plugin quản lý dữ liệu
	 * Tự động hỗ trợ cả ZipArchive lẫn PclZip tích hợp sẵn của WordPress
	 */
	public static function create_files_zip_backup() {
		@set_time_limit( 300 );

		$dir      = self::get_backup_dir();
		$filename = sprintf( 'kenhbds_files_%s.zip', date( 'Ymd_His' ) );
		$filepath = $dir . '/' . $filename;

		$folders_to_backup = array(
			'uploads'                      => WP_CONTENT_DIR . '/uploads',
			'themes/flatsome-child'        => WP_CONTENT_DIR . '/themes/flatsome-child',
			'plugins/kenhbds-data-manager' => WP_CONTENT_DIR . '/plugins/kenhbds-data-manager',
		);

		if ( class_exists( 'ZipArchive' ) ) {
			$zip = new ZipArchive();
			if ( true !== $zip->open( $filepath, ZipArchive::CREATE | ZipArchive::OVERWRITE ) ) {
				return false;
			}
			foreach ( $folders_to_backup as $zip_prefix => $source_path ) {
				if ( ! is_dir( $source_path ) ) {
					continue;
				}
				$iterator = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator( $source_path, RecursiveDirectoryIterator::SKIP_DOTS ),
					RecursiveIteratorIterator::SELF_FIRST
				);
				foreach ( $iterator as $file ) {
					$real_path = $file->getRealPath();
					$rel_path  = $zip_prefix . '/' . substr( $real_path, strlen( $source_path ) + 1 );
					$rel_path  = str_replace( '\\', '/', $rel_path );
					if ( $file->isDir() ) {
						$zip->addEmptyDir( $rel_path );
					} else {
						$zip->addFile( $real_path, $rel_path );
					}
				}
			}
			$zip->close();
		} else {
			require_once ABSPATH . 'wp-admin/includes/class-pclzip.php';
			$archive    = new PclZip( $filepath );
			$valid_dirs = array();
			foreach ( $folders_to_backup as $source_path ) {
				if ( is_dir( $source_path ) ) {
					$valid_dirs[] = $source_path;
				}
			}
			if ( empty( $valid_dirs ) ) {
				return false;
			}
			$res = $archive->create( $valid_dirs, PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR );
			if ( 0 == $res ) {
				return false;
			}
		}

		self::enforce_retention_policy();
		return $filename;
	}

	/**
	 * Xuất dữ liệu Dự án / Giỏ hàng / Khách hàng CRM ra file CSV chuẩn Excel (UTF-8 BOM)
	 */
	public static function export_csv_stream( $type ) {
		nocache_headers();
		$filename = sprintf( 'kenhbds_%s_%s.csv', $type, date( 'Ymd_His' ) );
		header( 'Content-Type: text/csv; charset=UTF-8' );
		header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

		$out = fopen( 'php://output', 'w' );
		// Ghi UTF-8 BOM để Microsoft Excel đọc tiếng Việt không bị lỗi font
		fwrite( $out, "\xEF\xBB\xBF" );

		if ( 'du_an' === $type ) {
			fputcsv( $out, array( 'ID', 'Mã Dự Án', 'Tên Dự Án', 'Khu Vực', 'Loại Hình', 'Chủ Đầu Tư', 'Trạng Thái', 'Giá Tham Khảo', 'Quy Mô', 'Pháp Lý', 'Bàn Giao', 'Điểm Review', 'URL' ) );
			$items = get_posts( array( 'post_type' => 'du_an', 'posts_per_page' => -1, 'post_status' => 'any' ) );
			foreach ( $items as $p ) {
				fputcsv( $out, array(
					$p->ID,
					get_post_meta( $p->ID, '_kbds_project_code', true ),
					$p->post_title,
					 implode( ', ', wp_get_post_terms( $p->ID, 'khu_vuc_bds', array( 'fields' => 'names' ) ) ),
					 implode( ', ', wp_get_post_terms( $p->ID, 'loai_hinh_bds', array( 'fields' => 'names' ) ) ),
					 implode( ', ', wp_get_post_terms( $p->ID, 'chu_dau_tu', array( 'fields' => 'names' ) ) ),
					 implode( ', ', wp_get_post_terms( $p->ID, 'trang_thai_du_an', array( 'fields' => 'names' ) ) ),
					get_post_meta( $p->ID, '_kbds_price_from', true ),
					get_post_meta( $p->ID, '_kbds_total_area', true ),
					get_post_meta( $p->ID, '_kbds_legal_status', true ),
					get_post_meta( $p->ID, '_kbds_handover_time', true ),
					get_post_meta( $p->ID, '_kbds_review_score', true ),
					get_permalink( $p->ID ),
				) );
			}
		} elseif ( 'bat_dong_san' === $type ) {
			fputcsv( $out, array( 'ID', 'Mã Căn', 'Tiêu Đề', 'Thuộc Dự Án', 'Khu Vực', 'Loại Giao Dịch', 'Giá Bán', 'Diện Tích (m2)', 'Số PN', 'Hướng', 'Pháp Lý', 'Xác Thực', 'URL' ) );
			$items = get_posts( array( 'post_type' => 'bat_dong_san', 'posts_per_page' => -1, 'post_status' => 'any' ) );
			foreach ( $items as $p ) {
				$pid = (int) get_post_meta( $p->ID, '_kbds_parent_project_id', true );
				fputcsv( $out, array(
					$p->ID,
					get_post_meta( $p->ID, '_kbds_listing_code', true ),
					$p->post_title,
					$pid ? get_the_title( $pid ) : 'Độc lập',
					implode( ', ', wp_get_post_terms( $p->ID, 'khu_vuc_bds', array( 'fields' => 'names' ) ) ),
					implode( ', ', wp_get_post_terms( $p->ID, 'loai_giao_dich', array( 'fields' => 'names' ) ) ),
					get_post_meta( $p->ID, '_kbds_listing_price', true ),
					get_post_meta( $p->ID, '_kbds_area_m2', true ),
					get_post_meta( $p->ID, '_kbds_bedrooms', true ),
					get_post_meta( $p->ID, '_kbds_direction', true ),
					get_post_meta( $p->ID, '_kbds_listing_legal', true ),
					'1' === get_post_meta( $p->ID, '_kbds_is_verified', true ) ? 'Đã xác thực' : 'Chưa xác thực',
					get_permalink( $p->ID ),
				) );
			}
		} elseif ( 'bds_lead' === $type ) {
			fputcsv( $out, array( 'ID', 'Họ Tên Khách Hàng', 'Số Điện Thoại', 'Email', 'Dự Án Quan Tâm', 'Nhu Cầu', 'Trạng Thái', 'Ghi Chú Tư Vấn', 'Ngày Đăng Ký' ) );
			$items = get_posts( array( 'post_type' => 'bds_lead', 'posts_per_page' => -1, 'post_status' => 'any' ) );
			foreach ( $items as $p ) {
				fputcsv( $out, array(
					$p->ID,
					$p->post_title,
					get_post_meta( $p->ID, '_kbds_lead_phone', true ),
					get_post_meta( $p->ID, '_kbds_lead_email', true ),
					get_post_meta( $p->ID, '_kbds_lead_project', true ),
					get_post_meta( $p->ID, '_kbds_lead_demand', true ),
					get_post_meta( $p->ID, '_kbds_lead_status', true ),
					get_post_meta( $p->ID, '_kbds_lead_notes', true ),
					$p->post_date,
				) );
			}
		}

		fclose( $out );
	}

	/**
	 * Chạy Backup tự động theo lịch WP-Cron (Sao lưu cả SQL + JSON)
	 */
	public static function run_scheduled_backup() {
		self::create_database_backup( 'cron' );
		self::create_json_content_backup( 'cron' );
	}

	/**
	 * Chính sách xoay vòng bản sao lưu (Retention Policy)
	 * Giữ lại N bản mới nhất để không làm đầy dung lượng hosting
	 */
	public static function enforce_retention_policy() {
		$keep  = (int) get_option( 'kbds_backup_retention', 10 );
		$files = self::get_backup_files();
		if ( count( $files ) <= $keep ) {
			return;
		}
		$to_delete = array_slice( $files, $keep );
		foreach ( $to_delete as $f ) {
			@unlink( $f['path'] );
		}
	}

	/**
	 * Lấy danh sách các bản Backup hiện có
	 */
	public static function get_backup_files() {
		$dir   = self::get_backup_dir();
		$items = glob( $dir . '/kenhbds_*.*' );
		if ( ! $items ) {
			return array();
		}
		$list = array();
		foreach ( $items as $filepath ) {
			$list[] = array(
				'name' => basename( $filepath ),
				'path' => $filepath,
				'size' => filesize( $filepath ),
				'time' => filemtime( $filepath ),
				'ext'  => pathinfo( $filepath, PATHINFO_EXTENSION ),
			);
		}
		usort( $list, function( $a, $b ) {
			return $b['time'] - $a['time'];
		} );
		return $list;
	}

	/**
	 * Dọn dẹp rác & Tối ưu hóa các bảng MySQL (1-Click Optimizer)
	 */
	public static function optimize_and_clean_database() {
		global $wpdb;

		// 1. Xóa các bản auto-draft và bài trong thùng rác
		$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE post_status = 'auto-draft' OR post_status = 'trash'" );

		// 2. Dọn dẹp postmeta mồ côi (Orphaned Postmeta)
		$wpdb->query( "DELETE pm FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL" );

		// 3. Xóa Transients đã hết hạn
		$time = time();
		$wpdb->query( $wpdb->prepare(
			"DELETE a, b FROM {$wpdb->options} a, {$wpdb->options} b
			WHERE a.option_name LIKE %s
			AND a.option_name NOT LIKE %s
			AND b.option_name = CONCAT( '_transient_timeout_', SUBSTRING( a.option_name, 12 ) )
			AND b.option_value < %d",
			$wpdb->esc_like( '_transient_' ) . '%',
			$wpdb->esc_like( '_transient_timeout_' ) . '%',
			$time
		) );

		// 4. Tối ưu toàn bộ bảng MySQL
		$tables = $wpdb->get_col( 'SHOW TABLES' );
		foreach ( $tables as $table ) {
			$wpdb->query( "OPTIMIZE TABLE `{$table}`" );
		}
	}

	/**
	 * Giao diện Trang Quản trị Trung tâm Dữ liệu & Backup
	 */
	public static function render_admin_page() {
		global $wpdb;

		$count_projects = wp_count_posts( 'du_an' )->publish + wp_count_posts( 'du_an' )->draft;
		$count_listings = wp_count_posts( 'bat_dong_san' )->publish + wp_count_posts( 'bat_dong_san' )->draft;
		$count_leads    = wp_count_posts( 'bds_lead' )->publish + wp_count_posts( 'bds_lead' )->draft;
		$count_posts    = wp_count_posts( 'post' )->publish + wp_count_posts( 'post' )->draft;

		$db_size_row = $wpdb->get_row( $wpdb->prepare(
			"SELECT SUM(data_length + index_length) AS size FROM information_schema.TABLES WHERE table_schema = %s",
			DB_NAME
		) );
		$db_size_mb = $db_size_row ? round( $db_size_row->size / 1048576, 2 ) : 0;

		$backups   = self::get_backup_files();
		$freq      = get_option( 'kbds_backup_frequency', 'daily' );
		$retention = get_option( 'kbds_backup_retention', 10 );
		$last_bk   = get_option( 'kbds_last_backup_time', 'Chưa có' );
		?>
		<div class="wrap">
			<h1 style="font-weight:700;color:#0f3e6d;margin-bottom:15px;">
				🛡️ Trung tâm Quản lý & Sao lưu Dữ liệu — kenhbatdongsan.vn
			</h1>

			<?php if ( isset( $_GET['msg'] ) ) : ?>
				<div class="notice notice-success is-dismissible"><p><strong>
				<?php
				$messages = array(
					'db_created'     => '✔ Đã tạo bản sao lưu Cơ sở dữ liệu (.SQL) thành công!',
					'json_created'   => '✔ Đã xuất Snapshot toàn bộ Nội dung (.JSON) thành công!',
					'zip_created'    => '✔ Đã đóng gói Hình ảnh & Giao diện (.ZIP) thành công!',
					'json_imported'  => '✔ Đã khôi phục / nhập dữ liệu từ file JSON thành công!',
					'optimized'      => '✔ Đã dọn dẹp dữ liệu rác và tối ưu hóa toàn bộ bảng MySQL thành công!',
					'schedule_saved' => '✔ Đã lưu cấu hình lịch trình tự động Backup và chính sách lưu trữ!',
					'deleted'        => '✔ Đã xóa bản sao lưu.',
					'error'          => '⚠️ Có lỗi xảy ra trong quá trình xử lý. Vui lòng kiểm tra quyền ghi thư mục.',
				);
				$m = sanitize_text_field( wp_unslash( $_GET['msg'] ) );
				echo isset( $messages[ $m ] ) ? esc_html( $messages[ $m ] ) : '';
				?>
				</strong></p></div>
			<?php endif; ?>

			<!-- Thống kê tổng quan dữ liệu -->
			<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:24px;">
				<div style="background:#fff;padding:18px;border-radius:8px;border-left:4px solid #0f3e6d;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
					<div style="color:#666;font-size:13px;">Hồ sơ Dự án (Mô hình B)</div>
					<div style="font-size:26px;font-weight:700;color:#0f3e6d;margin-top:4px;"><?php echo esc_html( $count_projects ); ?></div>
				</div>
				<div style="background:#fff;padding:18px;border-radius:8px;border-left:4px solid #1b8a4b;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
					<div style="color:#666;font-size:13px;">Giỏ hàng BĐS (Mô hình D)</div>
					<div style="font-size:26px;font-weight:700;color:#1b8a4b;margin-top:4px;"><?php echo esc_html( $count_listings ); ?></div>
				</div>
				<div style="background:#fff;padding:18px;border-radius:8px;border-left:4px solid #d99b26;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
					<div style="color:#666;font-size:13px;">Bài viết Review / Quy hoạch</div>
					<div style="font-size:26px;font-weight:700;color:#d99b26;margin-top:4px;"><?php echo esc_html( $count_posts ); ?></div>
				</div>
				<div style="background:#fff;padding:18px;border-radius:8px;border-left:4px solid #e53935;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
					<div style="color:#666;font-size:13px;">Khách hàng Đăng ký (CRM)</div>
					<div style="font-size:26px;font-weight:700;color:#e53935;margin-top:4px;"><?php echo esc_html( $count_leads ); ?></div>
				</div>
				<div style="background:#fff;padding:18px;border-radius:8px;border-left:4px solid #6a1b9a;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
					<div style="color:#666;font-size:13px;">Dung lượng Database</div>
					<div style="font-size:24px;font-weight:700;color:#6a1b9a;margin-top:4px;"><?php echo esc_html( $db_size_mb ); ?> MB</div>
				</div>
			</div>

			<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;align-items:start;">
				<!-- CỘT TRÁI: Thao tác Sao lưu & Danh sách Bản sao lưu -->
				<div>
					<div style="background:#fff;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.08);margin-bottom:20px;">
						<h2 style="margin-top:0;">⚡ Sao lưu Nhanh 1-Click & Tối ưu Hóa</h2>
						<p style="color:#555;">Tạo bản sao lưu tức thì trước khi cập nhật giao diện, plugin hoặc chỉnh sửa dữ liệu lớn.</p>

						<div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:15px;">
							<form method="post" style="margin:0;">
								<?php wp_nonce_field( 'kbds_backup_action', 'kbds_backup_nonce' ); ?>
								<input type="hidden" name="kbds_action" value="backup_db" />
								<button type="submit" class="button button-primary button-hero">🗄️ Sao lưu Toàn bộ Database (.SQL)</button>
							</form>

							<form method="post" style="margin:0;">
								<?php wp_nonce_field( 'kbds_backup_action', 'kbds_backup_nonce' ); ?>
								<input type="hidden" name="kbds_action" value="backup_json" />
								<button type="submit" class="button button-secondary button-hero">📦 Xuất Snapshot Nội dung (.JSON)</button>
							</form>

							<form method="post" style="margin:0;">
								<?php wp_nonce_field( 'kbds_backup_action', 'kbds_backup_nonce' ); ?>
								<input type="hidden" name="kbds_action" value="backup_zip" />
								<button type="submit" class="button button-secondary button-hero">🖼️ Đóng gói Hình ảnh & Code (.ZIP)</button>
							</form>

							<form method="post" style="margin:0;">
								<?php wp_nonce_field( 'kbds_backup_action', 'kbds_backup_nonce' ); ?>
								<input type="hidden" name="kbds_action" value="optimize_db" />
								<button type="submit" class="button button-hero" style="border-color:#1b8a4b;color:#1b8a4b;">🧹 Dọn Rác & Tối ưu MySQL</button>
							</form>
						</div>
					</div>

					<!-- Danh sách các bản Backup -->
					<div style="background:#fff;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
						<h2 style="margin-top:0;">📂 Kho Lưu trữ Bản Sao lưu An toàn (<code>wp-content/kenhbds-backups/</code>)</h2>
						<p style="color:#666;margin-top:0;">Thư mục này đã được khóa bảo mật bằng <code>.htaccess</code> và <code>web.config</code> chống tải trái phép từ bên ngoài. Lần sao lưu gần nhất: <strong><?php echo esc_html( $last_bk ); ?></strong></p>

						<table class="wp-list-table widefat fixed striped">
							<thead>
								<tr>
									<th>Tên File Backup</th>
									<th style="width:110px;">Loại</th>
									<th style="width:110px;">Dung lượng</th>
									<th style="width:150px;">Thời gian tạo</th>
									<th style="width:170px;">Thao tác</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( empty( $backups ) ) : ?>
									<tr><td colspan="5">Chưa có bản sao lưu nào. Hãy bấm nút "Sao lưu Toàn bộ Database" ở trên để tạo bản đầu tiên.</td></tr>
								<?php else : ?>
									<?php foreach ( $backups as $bk ) : ?>
										<?php
										$dl_url = wp_nonce_url(
											admin_url( 'admin.php?page=kbds-data-backup&kbds_download=' . urlencode( $bk['name'] ) ),
											'kbds_download_backup'
										);
										$del_url = wp_nonce_url(
											admin_url( 'admin.php?page=kbds-data-backup&kbds_delete=' . urlencode( $bk['name'] ) ),
											'kbds_delete_backup'
										);
										?>
										<tr>
											<td><strong><?php echo esc_html( $bk['name'] ); ?></strong></td>
											<td><span class="badge" style="text-transform:uppercase;font-weight:700;"><?php echo esc_html( $bk['ext'] ); ?></span></td>
											<td><?php echo esc_html( size_format( $bk['size'], 2 ) ); ?></td>
											<td><?php echo esc_html( date_i18n( 'd/m/Y H:i:s', $bk['time'] ) ); ?></td>
											<td>
												<a href="<?php echo esc_url( $dl_url ); ?>" class="button button-small button-primary">⬇ Tải về</a>
												<a href="<?php echo esc_url( $del_url ); ?>" class="button button-small" style="color:#d32f2f;border-color:#d32f2f;" onclick="return confirm('Bạn chắc chắn muốn xóa bản backup này?');">Xóa</a>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- CỘT PHẢI: Xuất Excel CSV, Khôi phục JSON & Lịch Tự động -->
				<div>
					<!-- Xuất Excel / CSV -->
					<div style="background:#fff;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.08);margin-bottom:20px;">
						<h3 style="margin-top:0;">📊 Xuất Dữ liệu ra Excel (.CSV chuẩn Tiếng Việt)</h3>
						<p style="color:#666;">Xuất danh sách Dự án, Giỏ hàng hoặc Khách hàng đăng ký để quản lý và báo cáo trên Excel / Google Sheets.</p>
						<form method="post">
							<?php wp_nonce_field( 'kbds_backup_action', 'kbds_backup_nonce' ); ?>
							<input type="hidden" name="kbds_action" value="export_csv" />
							<select name="csv_type" style="width:100%;margin-bottom:12px;">
								<option value="du_an">🏢 Danh sách Hồ sơ Dự án BĐS</option>
								<option value="bat_dong_san">🏠 Danh sách Giỏ hàng Sản phẩm BĐS</option>
								<option value="bds_lead">👥 Danh sách Khách hàng đăng ký (CRM Leads)</option>
							</select>
							<button type="submit" class="button button-primary" style="width:100%;">📥 Tải File Excel (.CSV)</button>
						</form>
					</div>

					<!-- Cấu hình Auto-Backup -->
					<div style="background:#fff;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.08);margin-bottom:20px;">
						<h3 style="margin-top:0;">⏰ Lịch Tự động Backup & Xoay vòng</h3>
						<form method="post">
							<?php wp_nonce_field( 'kbds_backup_action', 'kbds_backup_nonce' ); ?>
							<input type="hidden" name="kbds_action" value="save_schedule" />
							<p>
								<label><strong>Tần suất tự động sao lưu:</strong></label><br/>
								<select name="backup_frequency" style="width:100%;margin-top:4px;">
									<option value="twicedaily" <?php selected( $freq, 'twicedaily' ); ?>>2 lần / ngày (12 giờ/lần)</option>
									<option value="daily" <?php selected( $freq, 'daily' ); ?>>Hàng ngày (Khuyên dùng)</option>
									<option value="weekly" <?php selected( $freq, 'weekly' ); ?>>Hàng tuần</option>
									<option value="disabled" <?php selected( $freq, 'disabled' ); ?>>Tắt tự động sao lưu</option>
								</select>
							</p>
							<p>
								<label><strong>Số bản sao lưu giữ lại tối đa (Tự xóa bản cũ):</strong></label><br/>
								<input type="number" name="backup_retention" value="<?php echo esc_attr( $retention ); ?>" min="3" max="60" style="width:100%;margin-top:4px;" />
							</p>
							<button type="submit" class="button button-primary" style="width:100%;">💾 Lưu Cấu hình Tự động</button>
						</form>
					</div>

					<!-- Khôi phục từ JSON -->
					<div style="background:#fff;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
						<h3 style="margin-top:0;">♻️ Khôi phục / Nhập Nội dung (.JSON)</h3>
						<p style="color:#666;">Chọn file <code>kenhbds_content_*.json</code> để khôi phục nhanh toàn bộ Dự án, Giỏ hàng, Bài viết và Danh mục.</p>
						<form method="post" enctype="multipart/form-data">
							<?php wp_nonce_field( 'kbds_backup_action', 'kbds_backup_nonce' ); ?>
							<input type="hidden" name="kbds_action" value="import_json" />
							<input type="file" name="kbds_json_file" accept=".json" required style="margin-bottom:12px;width:100%;" />
							<button type="submit" class="button" style="width:100%;">📤 Tải lên & Khôi phục Nội dung</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
