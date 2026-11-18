<?php
/**
 * Dịch vụ Thông báo Khách hàng mới (Leads) cho Kênh Bất Động Sản (kenhbatdongsan.vn)
 *
 * Tính năng:
 * - Gửi Email tức thời tới Admin khi có khách đăng ký nhận bảng giá / tư vấn
 * - Báo cáo rõ ràng: Khách đăng ký từ Dự án nào, Link trang con / bài viết nào
 * - Tạo nút bấm gọi điện thoại & mở chat Zalo trực tiếp 1 chạm
 * - Hiển thị số lượng Lead mới chưa xử lý (Badge Counter) trên Menu Admin
 * - Gửi thông báo tức thời qua Telegram Bot Group với giao diện HTML & Nút bấm tương tác
 * - Trang Quản lý & Cài đặt Telegram Bot tích hợp ngay trong Menu CRM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Notification_Service {

	public static function init() {
		// Hiển thị số lượng Lead mới (Badge counter) trên Menu Admin 'Khách hàng (CRM)'
		add_action( 'admin_menu', array( __CLASS__, 'add_unread_lead_counter_badge' ), 99 );

		// Menu Cài đặt Telegram Bot cho Leads
		add_action( 'admin_menu', array( __CLASS__, 'add_telegram_admin_menu' ) );

		// Hiển thị thanh thông báo khẩn cấp (Notice) khi có khách hàng mới chờ tư vấn
		add_action( 'admin_notices', array( __CLASS__, 'display_new_leads_admin_notice' ) );

		// Đăng ký REST API cho Telegram Settings & Sync
		add_action( 'rest_api_init', array( __CLASS__, 'register_rest_routes' ) );
	}

	/**
	 * Đăng ký Menu con "Cài đặt Telegram" dưới Menu Khách hàng (CRM)
	 */
	public static function add_telegram_admin_menu() {
		add_submenu_page(
			'edit.php?post_type=bds_lead',
			'Cài đặt Thông báo Telegram - Kênh Bất Động Sản',
			'Cài đặt Telegram',
			'manage_options',
			'kbds-telegram-settings',
			array( __CLASS__, 'render_telegram_settings_page' )
		);
	}

	/**
	 * Đăng ký REST API cho Cài đặt Telegram
	 */
	public static function register_rest_routes() {
		register_rest_route( 'kbds/v1', '/telegram-settings', array(
			array(
				'methods'             => 'GET',
				'callback'            => array( __CLASS__, 'rest_get_telegram_settings' ),
				'permission_callback' => function() {
					return current_user_can( 'manage_options' );
				},
			),
			array(
				'methods'             => 'POST',
				'callback'            => array( __CLASS__, 'rest_save_telegram_settings' ),
				'permission_callback' => function() {
					return current_user_can( 'manage_options' );
				},
			),
		) );
	}

	/**
	 * REST Callback: Lấy thông tin cấu hình Telegram
	 */
	public static function rest_get_telegram_settings() {
		$token = get_option( 'kbds_telegram_bot_token', '' );
		$chat_id = get_option( 'kbds_telegram_chat_id', '' );
		$enabled = get_option( 'kbds_telegram_enable', '1' );

		// Mask token vì lý do bảo mật
		$masked_token = '';
		if ( ! empty( $token ) ) {
			$len = strlen( $token );
			$masked_token = substr( $token, 0, 6 ) . '...' . substr( $token, -5 );
		}

		return rest_ensure_response( array(
			'enabled'      => ( '1' === $enabled ),
			'is_configured'=> ( ! empty( $token ) && ! empty( $chat_id ) ),
			'masked_token' => $masked_token,
			'chat_id'      => $chat_id,
		) );
	}

	/**
	 * REST Callback: Lưu thông tin cấu hình Telegram
	 */
	public static function rest_save_telegram_settings( $request ) {
		$params = $request->get_json_params();
		if ( ! is_array( $params ) ) {
			$params = $request->get_params();
		}

		if ( isset( $params['bot_token'] ) && ! empty( $params['bot_token'] ) ) {
			update_option( 'kbds_telegram_bot_token', sanitize_text_field( trim( $params['bot_token'] ) ) );
		}

		if ( isset( $params['chat_id'] ) ) {
			update_option( 'kbds_telegram_chat_id', sanitize_text_field( trim( $params['chat_id'] ) ) );
		}

		if ( isset( $params['enabled'] ) ) {
			update_option( 'kbds_telegram_enable', $params['enabled'] ? '1' : '0' );
		}

		// Nếu có yêu cầu test
		$test_result = null;
		if ( ! empty( $params['test'] ) ) {
			$tok = get_option( 'kbds_telegram_bot_token', '' );
			$cid = get_option( 'kbds_telegram_chat_id', '' );
			$test_result = self::test_telegram_connection( $tok, $cid );
		}

		return rest_ensure_response( array(
			'success'     => true,
			'message'     => 'Đã lưu cấu hình Telegram thành công!',
			'test_result' => $test_result,
		) );
	}

	/**
	 * Gửi thông báo toàn diện khi có khách hàng đăng ký từ bất kỳ form nào
	 *
	 * @param int   $lead_id ID bài viết bds_lead
	 * @param array $data    Thông tin khách hàng
	 * @return bool
	 */
	public static function send_lead_alert( $lead_id, $data = array() ) {
		$name         = $data['name'] ?? get_the_title( $lead_id );
		$phone        = $data['phone'] ?? get_post_meta( $lead_id, '_kbds_lead_phone', true );
		$email        = $data['email'] ?? get_post_meta( $lead_id, '_kbds_lead_email', true );
		$project      = $data['project'] ?? get_post_meta( $lead_id, '_kbds_lead_project', true );
		$source_url   = $data['source_url'] ?? get_post_meta( $lead_id, '_kbds_lead_source_url', true );
		$source_title = $data['source_title'] ?? get_post_meta( $lead_id, '_kbds_lead_source_title', true );
		$demand       = $data['demand'] ?? get_post_meta( $lead_id, '_kbds_lead_demand', true );
		$ip           = $data['ip'] ?? get_post_meta( $lead_id, '_kbds_lead_ip', true );
		$time         = current_time( 'd/m/Y H:i:s' );

		$clean_phone  = preg_replace( '/[^0-9]/', '', $phone );
		$admin_crm_url = admin_url( 'post.php?post=' . $lead_id . '&action=edit' );

		// 1. GỬI EMAIL THÔNG BÁO CHO ADMIN
		self::send_email_notification( array(
			'lead_id'      => $lead_id,
			'name'         => $name,
			'phone'        => $phone,
			'clean_phone'  => $clean_phone,
			'email'        => $email,
			'project'      => $project ?: 'Tư vấn Kênh BĐS',
			'source_url'   => $source_url,
			'source_title' => $source_title ?: $project,
			'demand'       => $demand ?: 'Nhận trọn bộ bảng giá & chính sách',
			'ip'           => $ip ?: ( $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1' ),
			'time'         => $time,
			'admin_url'    => $admin_crm_url,
		) );

		// 2. GỬI THÔNG BÁO TELEGRAM (NẾU CÓ CẤU HÌNH)
		self::send_telegram_notification( array(
			'lead_id'      => $lead_id,
			'name'         => $name,
			'phone'        => $phone,
			'clean_phone'  => $clean_phone,
			'project'      => $project,
			'source_url'   => $source_url,
			'source_title' => $source_title,
			'demand'       => $demand,
			'ip'           => $ip ?: ( $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1' ),
			'time'         => $time,
			'admin_url'    => $admin_crm_url,
		) );

		// Hook cho các bên thứ ba / webhook
		do_action( 'kbds_after_lead_notification_sent', $lead_id, $data );

		return true;
	}

	/**
	 * Gửi Email HTML chuyên nghiệp đến Admin
	 */
	private static function send_email_notification( $lead ) {
		$to = apply_filters( 'kbds_lead_notification_recipient', get_option( 'admin_email' ) );
		if ( ! is_email( $to ) ) {
			return false;
		}

		$subject = sprintf(
			'🔥 [KHÁCH HÀNG MỚI] %s (%s) quan tâm dự án: %s',
			$lead['name'],
			$lead['phone'],
			$lead['project']
		);

		ob_start();
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Thông báo Khách hàng mới</title>
		</head>
		<body style="font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;background-color:#F0F4F8;margin:0;padding:24px;">
			<table width="100%" cellpadding="0" cellspacing="0" style="max-width:620px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
				<!-- Header -->
				<tr>
					<td style="background:linear-gradient(135deg, #0B2C4D 0%, #081B2E 100%);padding:24px 28px;text-align:center;">
						<span style="font-size:32px;display:inline-block;margin-bottom:8px;">🔥</span>
						<h1 style="color:#ffffff;font-size:22px;margin:0;font-weight:700;letter-spacing:0.5px;">CÓ KHÁCH HÀNG MỚI ĐĂNG KÝ!</h1>
						<p style="color:#C59B27;font-size:14px;margin:6px 0 0;font-weight:600;">Hệ thống CRM Kênh Bất Động Sản (kenhbatdongsan.vn)</p>
					</td>
				</tr>

				<!-- Content -->
				<tr>
					<td style="padding:28px;">
						<table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;font-size:14px;color:#1E293B;">
							<tr style="background:#F8FAFC;">
								<td width="35%" style="font-weight:700;border-bottom:1px solid #E2E8F0;color:#64748B;">👑 Dự án quan tâm:</td>
								<td style="border-bottom:1px solid #E2E8F0;font-weight:700;color:#0B2C4D;font-size:15px;"><?php echo esc_html( $lead['project'] ); ?></td>
							</tr>
							<tr>
								<td style="font-weight:700;border-bottom:1px solid #E2E8F0;color:#64748B;">👤 Họ tên khách:</td>
								<td style="border-bottom:1px solid #E2E8F0;font-weight:700;color:#0F172A;"><?php echo esc_html( $lead['name'] ); ?></td>
							</tr>
							<tr style="background:#F8FAFC;">
								<td style="font-weight:700;border-bottom:1px solid #E2E8F0;color:#64748B;">📞 Số điện thoại:</td>
								<td style="border-bottom:1px solid #E2E8F0;">
									<strong style="font-size:16px;color:#D97706;letter-spacing:0.5px;"><?php echo esc_html( $lead['phone'] ); ?></strong>
								</td>
							</tr>
							<?php if ( ! empty( $lead['email'] ) ) : ?>
							<tr>
								<td style="font-weight:700;border-bottom:1px solid #E2E8F0;color:#64748B;">✉️ Email:</td>
								<td style="border-bottom:1px solid #E2E8F0;"><?php echo esc_html( $lead['email'] ); ?></td>
							</tr>
							<?php endif; ?>
							<tr style="background:#F8FAFC;">
								<td style="font-weight:700;border-bottom:1px solid #E2E8F0;color:#64748B;">💬 Nhu cầu / Ghi chú:</td>
								<td style="border-bottom:1px solid #E2E8F0;"><?php echo esc_html( $lead['demand'] ); ?></td>
							</tr>
							<tr>
								<td style="font-weight:700;border-bottom:1px solid #E2E8F0;color:#64748B;">🌐 Trang nguồn đăng ký:</td>
								<td style="border-bottom:1px solid #E2E8F0;">
									<?php if ( ! empty( $lead['source_url'] ) ) : ?>
										<a href="<?php echo esc_url( $lead['source_url'] ); ?>" target="_blank" style="color:#0B2C4D;font-weight:600;text-decoration:none;">
											<?php echo esc_html( $lead['source_title'] ?: $lead['source_url'] ); ?> ↗
										</a>
									<?php else : ?>
										<span style="color:#94A3B8;">Trang chủ / Form chung</span>
									<?php endif; ?>
								</td>
							</tr>
							<tr style="background:#F8FAFC;">
								<td style="font-weight:700;color:#64748B;">⏱️ Thời gian gửi:</td>
								<td><?php echo esc_html( $lead['time'] ); ?> (IP: <?php echo esc_html( $lead['ip'] ); ?>)</td>
							</tr>
						</table>

						<!-- Nút bấm gọi & Zalo nhanh -->
						<div style="margin:28px 0 16px;text-align:center;">
							<a href="tel:<?php echo esc_attr( $lead['clean_phone'] ); ?>" style="display:inline-block;background:#0E8A4A;color:#ffffff;font-weight:700;padding:12px 24px;border-radius:8px;text-decoration:none;font-size:14px;margin-right:8px;box-shadow:0 4px 12px rgba(14,138,74,0.25);">
								📞 Gọi Ngay Cho Khách
							</a>
							<a href="https://zalo.me/<?php echo esc_attr( $lead['clean_phone'] ); ?>" target="_blank" style="display:inline-block;background:#0068FF;color:#ffffff;font-weight:700;padding:12px 24px;border-radius:8px;text-decoration:none;font-size:14px;margin-right:8px;box-shadow:0 4px 12px rgba(0,104,255,0.25);">
								💬 Chat Zalo Với Khách
							</a>
							<a href="<?php echo esc_url( $lead['admin_url'] ); ?>" target="_blank" style="display:inline-block;background:#0B2C4D;color:#ffffff;font-weight:700;padding:12px 20px;border-radius:8px;text-decoration:none;font-size:14px;">
								⚙️ Mở CRM Khách Hàng
							</a>
						</div>
					</td>
				</tr>

				<!-- Footer -->
				<tr>
					<td style="background:#F8FAFC;padding:16px 24px;text-align:center;font-size:12px;color:#94A3B8;border-top:1px solid #E2E8F0;">
						Email này được gửi tự động từ hệ thống website <a href="https://kenhbatdongsan.vn" style="color:#C59B27;text-decoration:none;">kenhbatdongsan.vn</a> khi có khách gửi biểu mẫu.
					</td>
				</tr>
			</table>
		</body>
		</html>
		<?php
		$body = ob_get_clean();

		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: Kênh Bất Động Sản CRM <noreply@kenhbatdongsan.vn>',
		);

		return wp_mail( $to, $subject, $body, $headers );
	}

	/**
	 * Gửi thông báo qua Telegram Bot chuẩn HTML & Nút bấm tương tác
	 */
	public static function send_telegram_notification( $lead ) {
		$enabled = get_option( 'kbds_telegram_enable', '1' );
		if ( '0' === $enabled ) {
			return false;
		}

		$bot_token = trim( get_option( 'kbds_telegram_bot_token', '' ) );
		$chat_id   = trim( get_option( 'kbds_telegram_chat_id', '' ) );

		if ( empty( $bot_token ) || empty( $chat_id ) ) {
			return false;
		}

		$project_name   = esc_html( $lead['project'] ?: 'Tư vấn Kênh Bất Động Sản' );
		$customer_name  = esc_html( $lead['name'] ?: 'Khách hàng ẩn danh' );
		$customer_phone = esc_html( $lead['phone'] ?: 'Chưa cung cấp' );
		$clean_phone    = preg_replace( '/[^0-9]/', '', $lead['phone'] ?? '' );
		$demand         = esc_html( $lead['demand'] ?: 'Nhận trọn bộ bảng giá & chính sách' );
		$time           = esc_html( $lead['time'] ?: current_time( 'd/m/Y H:i:s' ) );
		$source_title   = esc_html( $lead['source_title'] ?: 'Bấm để xem trang nguồn' );
		$source_url     = esc_url( $lead['source_url'] ?? '' );
		$admin_url      = esc_url( $lead['admin_url'] ?? admin_url( 'edit.php?post_type=bds_lead' ) );

		// Soạn thảo nội dung theo chuẩn HTML của Telegram
		$text  = "🔥 <b>[KHÁCH HÀNG MỚI ĐĂNG KÝ]</b> 🔥\n";
		$text .= "━━━━━━━━━━━━━━━━━━━━━━\n";
		$text .= "👑 <b>Dự án:</b> <code>" . $project_name . "</code>\n";
		if ( ! empty( $source_url ) ) {
			$text .= "🌐 <b>Trang nguồn:</b> <a href=\"" . $source_url . "\">" . $source_title . "</a>\n";
		}
		$text .= "👤 <b>Họ tên:</b> <b>" . $customer_name . "</b>\n";
		$text .= "📞 <b>SĐT / Zalo:</b> <code>" . $customer_phone . "</code>\n";
		$text .= "💬 <b>Nhu cầu:</b> " . $demand . "\n";
		$text .= "⏱️ <b>Thời gian:</b> " . $time . "\n";
		$text .= "━━━━━━━━━━━━━━━━━━━━━━\n";
		$text .= "👉 <a href=\"https://zalo.me/" . ( $clean_phone ?: '0942655111' ) . "\">Bấm Chat Zalo Ngay</a> | <a href=\"" . $admin_url . "\">Xem Trong Quản Trị CRM</a>";

		// Nút bấm inline dưới tin nhắn
		$inline_keyboard = array(
			'inline_keyboard' => array(
				array(
					array(
						'text' => '💬 Chat Zalo',
						'url'  => 'https://zalo.me/' . ( $clean_phone ?: '0942655111' ),
					),
					array(
						'text' => '📋 Mở Hồ Sơ CRM',
						'url'  => $admin_url,
					),
				),
			),
		);

		$url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
		$response = wp_remote_post( $url, array(
			'timeout' => 8,
			'headers' => array( 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode( array(
				'chat_id'                  => $chat_id,
				'text'                     => $text,
				'parse_mode'               => 'HTML',
				'disable_web_page_preview' => true,
				'reply_markup'             => $inline_keyboard,
			) ),
		) );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );
		return ! empty( $body['ok'] );
	}

	/**
	 * Hàm kiểm tra kết nối Telegram Bot và gửi tin nhắn Test
	 *
	 * @param string $bot_token
	 * @param string $chat_id
	 * @return array
	 */
	public static function test_telegram_connection( $bot_token, $chat_id ) {
		$bot_token = trim( $bot_token );
		$chat_id   = trim( $chat_id );

		if ( empty( $bot_token ) ) {
			return array(
				'ok'    => false,
				'error' => 'Vui lòng nhập Telegram Bot Token (lấy từ @BotFather).',
			);
		}

		if ( empty( $chat_id ) ) {
			return array(
				'ok'    => false,
				'error' => 'Vui lòng nhập Telegram Chat ID hoặc Group ID.',
			);
		}

		$site_name = get_bloginfo( 'name' );
		$site_url  = home_url();
		$time      = current_time( 'd/m/Y H:i:s' );

		$text  = "🔔 <b>KIỂM TRA KẾT NỐI TELEGRAM THÀNH CÔNG!</b>\n";
		$text .= "━━━━━━━━━━━━━━━━━━━━━━\n";
		$text .= "✅ Hệ thống website <b>" . esc_html( $site_name ) . "</b> đã kết nối thành công với Bot Telegram này.\n";
		$text .= "🌐 <b>Địa chỉ:</b> <a href=\"" . esc_url( $site_url ) . "\">" . esc_html( $site_url ) . "</a>\n";
		$text .= "⏱️ <b>Thời gian kiểm tra:</b> " . esc_html( $time ) . "\n";
		$text .= "━━━━━━━━━━━━━━━━━━━━━━\n";
		$text .= "🚀 <i>Từ bây giờ, mỗi khi có khách hàng điền form nhận bảng giá hoặc tư vấn dự án, thông báo sẽ được gửi ngay lập tức vào đây!</i>";

		$inline_keyboard = array(
			'inline_keyboard' => array(
				array(
					array(
						'text' => '🌐 Truy cập Kênh Bất Động Sản',
						'url'  => $site_url,
					),
				),
			),
		);

		$url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
		$response = wp_remote_post( $url, array(
			'timeout' => 10,
			'headers' => array( 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode( array(
				'chat_id'                  => $chat_id,
				'text'                     => $text,
				'parse_mode'               => 'HTML',
				'disable_web_page_preview' => true,
				'reply_markup'             => $inline_keyboard,
			) ),
		) );

		if ( is_wp_error( $response ) ) {
			return array(
				'ok'    => false,
				'error' => 'Lỗi kết nối máy chủ Telegram: ' . $response->get_error_message(),
			);
		}

		$status_code = wp_remote_retrieve_response_code( $response );
		$body        = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( 200 === $status_code && ! empty( $body['ok'] ) ) {
			return array(
				'ok'      => true,
				'message' => 'Tuyệt vời! Tin nhắn kiểm tra đã được gửi thành công vào Telegram của bạn.',
			);
		}

		$desc = $body['description'] ?? 'Không rõ lý do.';
		$hint = '';
		if ( false !== stripos( $desc, 'Not Found' ) || false !== stripos( $desc, 'Unauthorized' ) ) {
			$hint = ' (Gợi ý: Bot Token không đúng hoặc đã bị thu hồi từ @BotFather).';
		} elseif ( false !== stripos( $desc, 'chat not found' ) ) {
			$hint = ' (Gợi ý: Chat ID không tồn tại hoặc bạn chưa bấm nút START với Bot).';
		} elseif ( false !== stripos( $desc, 'bot was blocked' ) ) {
			$hint = ' (Gợi ý: Bạn đã chặn Bot, hãy mở chat với Bot và bấm Restart).';
		} elseif ( false !== stripos( $desc, 'bot is not a member' ) ) {
			$hint = ' (Gợi ý: Đây là ID Group nhưng Bot chưa được thêm vào nhóm chat).';
		}

		return array(
			'ok'    => false,
			'error' => 'Telegram báo lỗi [' . $status_code . ']: ' . $desc . $hint,
		);
	}

	/**
	 * Giao diện Cài đặt Telegram Bot trong Trang Quản trị WP
	 */
	public static function render_telegram_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Bạn không có quyền truy cập trang này.' );
		}

		$message = '';
		$error   = '';

		// Xử lý Lưu cài đặt & Kiểm tra
		if ( isset( $_POST['kbds_save_telegram'] ) ) {
			check_admin_referer( 'kbds_telegram_settings_verify', 'kbds_telegram_nonce' );

			$token   = sanitize_text_field( trim( $_POST['kbds_telegram_bot_token'] ?? '' ) );
			$chat_id = sanitize_text_field( trim( $_POST['kbds_telegram_chat_id'] ?? '' ) );
			$enabled = isset( $_POST['kbds_telegram_enable'] ) ? '1' : '0';

			update_option( 'kbds_telegram_bot_token', $token );
			update_option( 'kbds_telegram_chat_id', $chat_id );
			update_option( 'kbds_telegram_enable', $enabled );

			$message = 'Đã lưu cấu hình Telegram thành công!';

			// Nếu bấm nút Lưu & Gửi tin nhắn thử nghiệm
			if ( isset( $_POST['kbds_send_test'] ) ) {
				$test = self::test_telegram_connection( $token, $chat_id );
				if ( $test['ok'] ) {
					$message .= ' ' . $test['message'];
				} else {
					$error = $test['error'];
				}
			}
		}

		$current_token   = get_option( 'kbds_telegram_bot_token', '' );
		$current_chat_id = get_option( 'kbds_telegram_chat_id', '' );
		$current_enable  = get_option( 'kbds_telegram_enable', '1' );
		$is_configured   = ( ! empty( $current_token ) && ! empty( $current_chat_id ) );
		?>
		<div class="wrap" style="max-width:1100px;">
			<h1 style="display:flex;align-items:center;gap:10px;font-size:24px;font-weight:700;color:#0B2C4D;margin-bottom:20px;">
				<span style="font-size:28px;">✈️</span> Cài Đặt Thông Báo Telegram Cho Khách Hàng (Leads)
			</h1>

			<?php if ( ! empty( $message ) ) : ?>
				<div class="notice notice-success is-dismissible" style="border-left-color:#0E8A4A;padding:12px 16px;">
					<p style="font-size:14.5px;font-weight:600;color:#0E8A4A;margin:0;">✅ <?php echo esc_html( $message ); ?></p>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $error ) ) : ?>
				<div class="notice notice-error is-dismissible" style="border-left-color:#E53935;padding:12px 16px;">
					<p style="font-size:14.5px;font-weight:600;color:#E53935;margin:0;">❌ <?php echo esc_html( $error ); ?></p>
				</div>
			<?php endif; ?>

			<div style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap;margin-top:20px;">
				<!-- Cột Trái: Form Cài đặt -->
				<div style="flex:1;min-width:340px;background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #E2E8F0;">
					<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid #EDF2F7;">
						<h2 style="margin:0;font-size:18px;color:#1E293B;">⚙️ Cấu Hình Bot Telegram</h2>
						<?php if ( $is_configured && '1' === $current_enable ) : ?>
							<span style="background:#E6F4EA;color:#137333;font-weight:700;font-size:12px;padding:4px 10px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;">
								● Đang hoạt động
							</span>
						<?php else : ?>
							<span style="background:#FEECEB;color:#C5221F;font-weight:700;font-size:12px;padding:4px 10px;border-radius:20px;display:inline-flex;align-items:center;gap:4px;">
								○ Chưa kích hoạt
							</span>
						<?php endif; ?>
					</div>

					<form method="post" action="">
						<?php wp_nonce_field( 'kbds_telegram_settings_verify', 'kbds_telegram_nonce' ); ?>

						<table class="form-table" style="margin-top:0;">
							<tr>
								<th scope="row" style="padding-top:10px;">
									<label for="kbds_telegram_enable" style="font-weight:700;color:#1E293B;">Trạng thái:</label>
								</th>
								<td style="padding-top:10px;">
									<label style="font-weight:600;font-size:14px;cursor:pointer;">
										<input type="checkbox" name="kbds_telegram_enable" id="kbds_telegram_enable" value="1" <?php checked( '1', $current_enable ); ?> />
										Bật tự động gửi thông báo Telegram khi có khách đăng ký
									</label>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="kbds_telegram_bot_token" style="font-weight:700;color:#1E293B;">Bot Token:</label>
								</th>
								<td>
									<input type="text" name="kbds_telegram_bot_token" id="kbds_telegram_bot_token" value="<?php echo esc_attr( $current_token ); ?>" class="large-text" placeholder="Ví dụ: 7891234567:AAHxyzABC1234567890..." style="font-family:monospace;font-size:13.5px;" />
									<p class="description" style="margin-top:6px;">Lấy từ chat với <strong>@BotFather</strong> trên Telegram khi tạo Bot mới.</p>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="kbds_telegram_chat_id" style="font-weight:700;color:#1E293B;">Chat ID / Group ID:</label>
								</th>
								<td>
									<input type="text" name="kbds_telegram_chat_id" id="kbds_telegram_chat_id" value="<?php echo esc_attr( $current_chat_id ); ?>" class="large-text" placeholder="Ví dụ: 12345678 (Cá nhân) hoặc -1001234567890 (Nhóm)" style="font-family:monospace;font-size:13.5px;" />
									<p class="description" style="margin-top:6px;">ID tài khoản cá nhân nhận tin hoặc ID của Group Telegram tư vấn/sale.</p>
								</td>
							</tr>
						</table>

						<div style="margin-top:24px;padding-top:18px;border-top:1px solid #EDF2F7;display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
							<button type="submit" name="kbds_save_telegram" value="1" class="button button-primary" style="background:#0B2C4D;border-color:#0B2C4D;font-weight:700;height:40px;line-height:38px;padding:0 24px;">
								💾 Lưu Cài Đặt
							</button>

							<button type="submit" name="kbds_save_telegram" value="1" onclick="this.form.appendChild(Object.assign(document.createElement('input'),{type:'hidden',name:'kbds_send_test',value:'1'}));" class="button" style="background:#0E8A4A;color:#fff;border-color:#0E8A4A;font-weight:700;height:40px;line-height:38px;padding:0 20px;">
								🚀 Lưu &amp; Gửi Tin Nhắn Thử Nghiệm
							</button>
						</div>
					</form>
				</div>

				<!-- Cột Phải: Hướng dẫn chi tiết 3 bước -->
				<div style="width:380px;background:#F8FAFC;padding:24px;border-radius:10px;border:1px solid #E2E8F0;">
					<h3 style="margin-top:0;font-size:16px;color:#0B2C4D;display:flex;align-items:center;gap:6px;">
						📖 Hướng Dẫn Cài Đặt (3 Bước)
					</h3>

					<div style="margin-bottom:16px;">
						<strong style="color:#0B2C4D;display:block;margin-bottom:4px;">Bước 1: Tạo Bot &amp; Lấy Token</strong>
						<p style="font-size:13px;line-height:1.6;margin:0 0 6px;color:#475569;">
							1. Mở ứng dụng Telegram, tìm kiếm <strong>@BotFather</strong>.<br>
							2. Gửi lệnh <code>/newbot</code>.<br>
							3. Nhập tên hiển thị (VD: <em>KenhBDS Alert</em>) và username bot (kết thúc bằng từ <em>bot</em>, VD: <em>kenhbds_crm_bot</em>).<br>
							4. BotFather sẽ trả về <strong>HTTP API Token</strong> (dạng <code>123456:ABC...</code>). Dán mã đó vào ô <strong>Bot Token</strong> bên cạnh.
						</p>
					</div>

					<div style="margin-bottom:16px;">
						<strong style="color:#0B2C4D;display:block;margin-bottom:4px;">Bước 2: Lấy Chat ID hoặc Group ID</strong>
						<p style="font-size:13px;line-height:1.6;margin:0 0 6px;color:#475569;">
							• <strong>Nhận tin nhắn riêng cá nhân:</strong> Tìm bot <strong>@userinfobot</strong> trên Telegram và bấm <em>Start</em> để xem <code>Id</code> của bạn. <em>(Lưu ý: Bạn phải mở chat với Bot vừa tạo ở Bước 1 và bấm <strong>Start</strong> để cho phép Bot nhắn tin)</em>.<br><br>
							• <strong>Nhận trong Nhóm tư vấn/Sale:</strong><br>
							- Tạo nhóm Telegram &amp; mời Bot vừa tạo vào nhóm.<br>
							- Thăng quyền Quản trị viên (Admin) cho Bot.<br>
							- Thêm bot <strong>@RawDataBot</strong> vào nhóm để xem ID nhóm (ID nhóm bắt đầu bằng dấu trừ, ví dụ: <code>-1001987654321</code>). Dán ID này vào ô <strong>Chat ID</strong>.
						</p>
					</div>

					<div style="background:#FFFDF5;border:1px dashed #D97706;padding:12px;border-radius:6px;">
						<strong style="color:#B45309;font-size:13px;">💡 Mẹo chuyên nghiệp:</strong>
						<p style="font-size:12.5px;line-height:1.5;margin:4px 0 0;color:#78350F;">
							Bấm nút <strong>"Lưu &amp; Gửi Tin Nhắn Thử Nghiệm"</strong> để kiểm tra bot. Nếu thấy tin nhắn xuất hiện trong Telegram nghĩa là đã hoàn tất 100%!
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Hiển thị số lượng Lead mới (Badge counter) trên Menu Admin 'Khách hàng (CRM)'
	 */
	public static function add_unread_lead_counter_badge() {
		global $menu;
		$new_leads_count = self::get_new_leads_count();
		if ( $new_leads_count <= 0 ) {
			return;
		}

		foreach ( $menu as $key => $item ) {
			if ( isset( $item[2] ) && 'edit.php?post_type=bds_lead' === $item[2] ) {
				$badge = ' <span class="update-plugins count-' . $new_leads_count . '" style="background:#e53935;color:#fff;border-radius:10px;padding:2px 7px;font-size:10px;font-weight:700;margin-left:4px;"><span class="plugin-count">' . $new_leads_count . '</span></span>';
				$menu[ $key ][0] .= $badge;
				break;
			}
		}
	}

	/**
	 * Hiển thị Banner thông báo khi vào trang Admin nếu có Lead mới
	 */
	public static function display_new_leads_admin_notice() {
		$screen = get_current_screen();
		if ( ! $screen || 'edit-bds_lead' === $screen->id || 'bds_lead_page_kbds-telegram-settings' === $screen->id ) {
			return; // Không hiển thị lại khi đã ở trang quản lý leads hoặc trang cài đặt telegram
		}

		$count = self::get_new_leads_count();
		if ( $count > 0 ) {
			?>
			<div class="notice notice-warning is-dismissible" style="border-left-color:#C59B27;background:#FFFDF7;padding:12px 16px;">
				<p style="font-size:14px;margin:0;display:flex;align-items:center;gap:8px;">
					<span style="font-size:18px;">🔔</span>
					<span>Bạn có <strong><?php echo esc_html( $count ); ?> khách hàng mới</strong> vừa đăng ký từ các Dự án / Bài viết.</span>
					<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=bds_lead&lead_status=new' ) ); ?>" class="button button-primary" style="background:#0B2C4D;border-color:#0B2C4D;font-weight:700;margin-left:8px;">
						Xem &amp; Lọc Khách Mới →
					</a>
				</p>
			</div>
			<?php
		}
	}

	/**
	 * Đếm số lượng khách hàng mới (Trạng thái 'new')
	 */
	public static function get_new_leads_count() {
		$counts = wp_count_posts( 'bds_lead' );
		if ( ! $counts || ! $counts->publish ) {
			return 0;
		}

		global $wpdb;
		$count = $wpdb->get_var( "
			SELECT COUNT(DISTINCT p.ID) 
			FROM {$wpdb->posts} p
			LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_kbds_lead_status'
			WHERE p.post_type = 'bds_lead'
			  AND p.post_status = 'publish'
			  AND (pm.meta_value = 'new' OR pm.meta_value IS NULL)
		" );

		return (int) $count;
	}
}
