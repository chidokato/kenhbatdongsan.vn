<?php
/**
 * Dịch vụ Thông báo Khách hàng mới (Leads) cho Kênh Bất Động Sản (kenhbatdongsan.vn)
 *
 * Tính năng:
 * - Gửi Email tức thời tới Admin khi có khách đăng ký nhận bảng giá / tư vấn
 * - Báo cáo rõ ràng: Khách đăng ký từ Dự án nào, Link trang con / bài viết nào
 * - Tạo nút bấm gọi điện thoại & mở chat Zalo trực tiếp 1 chạm
 * - Hiển thị số lượng Lead mới chưa xử lý (Badge Counter) trên Menu Admin
 * - Hỗ trợ gửi thông báo tức thời qua Telegram Bot Group (nếu cấu hình)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Notification_Service {

	public static function init() {
		// Hiển thị số lượng Lead mới (Badge counter) trên Menu Admin 'Khách hàng (CRM)'
		add_action( 'admin_menu', array( __CLASS__, 'add_unread_lead_counter_badge' ), 99 );

		// Hiển thị thanh thông báo khẩn cấp (Notice) khi có khách hàng mới chờ tư vấn
		add_action( 'admin_notices', array( __CLASS__, 'display_new_leads_admin_notice' ) );
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
			'ip'           => $ip ?: $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
			'time'         => $time,
			'admin_url'    => $admin_crm_url,
		) );

		// 2. GỬI THÔNG BÁO TELEGRAM (NẾU CÓ CẤU HÌNH)
		self::send_telegram_notification( array(
			'name'         => $name,
			'phone'        => $phone,
			'clean_phone'  => $clean_phone,
			'project'      => $project,
			'source_url'   => $source_url,
			'source_title' => $source_title,
			'demand'       => $demand,
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
			<title>Thông báo khách hàng mới</title>
		</head>
		<body style="font-family:Arial,Helvetica,sans-serif;background-color:#F4F6F8;margin:0;padding:24px;color:#333333;line-height:1.6;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width:620px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
				<!-- Header -->
				<tr>
					<td style="background:linear-gradient(135deg,#0B2C4D 0%,#164B7D 100%);padding:24px;text-align:center;color:#ffffff;">
						<span style="font-size:11px;font-weight:700;color:#E5C158;letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:6px;">KENHBATDONGSAN.VN • HỆ THỐNG CRM</span>
						<h1 style="margin:0;font-size:22px;font-weight:800;color:#ffffff;">⚡ CÓ KHÁCH HÀNG MỚI ĐĂNG KÝ!</h1>
						<p style="margin:6px 0 0;font-size:13.5px;color:#E2E8F0;">Khách vừa gửi yêu cầu nhận bảng giá & tài liệu qua website</p>
					</td>
				</tr>

				<!-- Content -->
				<tr>
					<td style="padding:28px 24px;">
						<!-- Hộp nổi bật Dự án & Nguồn -->
						<div style="background:#FDF8EC;border-left:4px solid #C59B27;border-radius:6px;padding:14px 18px;margin-bottom:24px;">
							<span style="font-size:12px;color:#9A7312;font-weight:700;text-transform:uppercase;display:block;">🎯 DỰ ÁN QUAN TÂM:</span>
							<strong style="font-size:18px;color:#0B2C4D;display:block;margin-top:2px;"><?php echo esc_html( $lead['project'] ); ?></strong>
							<?php if ( ! empty( $lead['source_url'] ) ) : ?>
								<div style="margin-top:8px;font-size:13px;color:#64748B;">
									🌐 <strong>Link trang đăng ký:</strong>
									<a href="<?php echo esc_url( $lead['source_url'] ); ?>" target="_blank" style="color:#1565C0;text-decoration:underline;word-break:break-all;">
										<?php echo esc_html( $lead['source_title'] ?: $lead['source_url'] ); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>

						<!-- Thông tin chi tiết khách -->
						<h3 style="font-size:16px;color:#0B2C4D;margin:0 0 12px;border-bottom:2px solid #F1F5F9;padding-bottom:8px;">
							📋 Chi Tiết Thông Tin Khách Hàng
						</h3>
						<table width="100%" cellpadding="8" cellspacing="0" style="font-size:14px;border-collapse:collapse;">
							<tr style="border-bottom:1px solid #F1F5F9;">
								<td width="35%" style="color:#64748B;font-weight:600;">Họ và tên:</td>
								<td style="color:#0B2C4D;font-weight:800;font-size:15px;"><?php echo esc_html( $lead['name'] ); ?></td>
							</tr>
							<tr style="border-bottom:1px solid #F1F5F9;">
								<td style="color:#64748B;font-weight:600;">Số điện thoại / Zalo:</td>
								<td>
									<strong style="color:#0E8A4A;font-size:17px;"><?php echo esc_html( $lead['phone'] ); ?></strong>
								</td>
							</tr>
							<?php if ( ! empty( $lead['email'] ) ) : ?>
								<tr style="border-bottom:1px solid #F1F5F9;">
									<td style="color:#64748B;font-weight:600;">Email:</td>
									<td><a href="mailto:<?php echo esc_attr( $lead['email'] ); ?>" style="color:#1565C0;"><?php echo esc_html( $lead['email'] ); ?></a></td>
								</tr>
							<?php endif; ?>
							<tr style="border-bottom:1px solid #F1F5F9;">
								<td style="color:#64748B;font-weight:600;">Nhu cầu / Sản phẩm:</td>
								<td style="color:#334155;"><?php echo nl2br( esc_html( $lead['demand'] ) ); ?></td>
							</tr>
							<tr style="border-bottom:1px solid #F1F5F9;">
								<td style="color:#64748B;font-weight:600;">Thời gian đăng ký:</td>
								<td style="color:#64748B;"><?php echo esc_html( $lead['time'] ); ?></td>
							</tr>
							<tr>
								<td style="color:#64748B;font-weight:600;">Địa chỉ IP khách:</td>
								<td style="color:#94A3B8;font-size:12.5px;"><?php echo esc_html( $lead['ip'] ); ?></td>
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
	 * Gửi thông báo qua Telegram Bot (Nếu người dùng cấu hình Token & Chat ID)
	 */
	private static function send_telegram_notification( $lead ) {
		$bot_token = get_option( 'kbds_telegram_bot_token', '' );
		$chat_id   = get_option( 'kbds_telegram_chat_id', '' );

		if ( ! $bot_token || ! $chat_id ) {
			return false;
		}

		$text  = "🔥 *CÓ KHÁCH HÀNG MỚI ĐĂNG KÝ!* 🔥\n";
		$text .= "━━━━━━━━━━━━━━━━━━━━\n";
		$text .= "👑 *Dự án:* " . $lead['project'] . "\n";
		if ( ! empty( $lead['source_url'] ) ) {
			$text .= "🌐 *Trang nguồn:* [" . ( $lead['source_title'] ?: 'Bấm xem link' ) . "](" . $lead['source_url'] . ")\n";
		}
		$text .= "👤 *Họ tên:* " . $lead['name'] . "\n";
		$text .= "📞 *SĐT / Zalo:* `" . $lead['phone'] . "`\n";
		$text .= "💬 *Nhu cầu:* " . $lead['demand'] . "\n";
		$text .= "⏱️ *Thời gian:* " . $lead['time'] . "\n";
		$text .= "━━━━━━━━━━━━━━━━━━━━\n";
		$text .= "👉 [Bấm mở Zalo Chat](https://zalo.me/" . $lead['clean_phone'] . ") | [Mở CRM WP](" . $lead['admin_url'] . ")";

		$url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
		wp_remote_post( $url, array(
			'timeout' => 5,
			'body'    => array(
				'chat_id'                  => $chat_id,
				'text'                     => $text,
				'parse_mode'               => 'Markdown',
				'disable_web_page_preview' => true,
			),
		) );

		return true;
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
		if ( ! $screen || 'edit-bds_lead' === $screen->id ) {
			return; // Không hiển thị lại khi đã ở trang quản lý leads
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
