<?php
/**
 * Bộ Shortcode Chuyên dụng cho Mô hình B + D (kenhbatdongsan.vn)
 * - [kbds_project_overview]   : Bảng tổng quan dự án + Đánh giá chuyên gia
 * - [kbds_project_listings]   : Giỏ hàng các căn đang bán thuộc dự án
 * - [kbds_loan_calculator]    : Công cụ tính lãi vay mua nhà trả góp
 * - [kbds_lead_form]          : Form nhận bảng giá / ký gửi lưu thẳng vào CRM Database
 * - [kbds_quick_lead_card]    : Form đăng ký dọc trong hero banner
 * - [kbds_project_news]        : Danh sách bài viết vệ tinh / tin tức của riêng dự án
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Shortcodes {

	public static function init() {
		add_shortcode( 'kbds_project_overview', array( __CLASS__, 'shortcode_project_overview' ) );
		add_shortcode( 'kbds_project_listings', array( __CLASS__, 'shortcode_project_listings' ) );
		add_shortcode( 'kbds_loan_calculator', array( __CLASS__, 'shortcode_loan_calculator' ) );
		add_shortcode( 'kbds_lead_form', array( __CLASS__, 'shortcode_lead_form' ) );
		add_shortcode( 'kbds_quick_lead_card', array( __CLASS__, 'shortcode_quick_lead_card' ) );
		add_shortcode( 'kbds_project_news', array( __CLASS__, 'shortcode_project_news' ) );
		add_shortcode( 'kbds_project_subnav', array( __CLASS__, 'shortcode_project_subnav' ) );

		// Tự động gắn thông tin tổng quan & giỏ hàng vào cuối trang chi tiết Dự án nếu chưa chèn shortcode
		add_filter( 'the_content', array( __CLASS__, 'auto_append_project_sections' ) );
	}

	/**
	 * 1. Bảng Tổng quan Hồ sơ Dự án
	 */
	public static function shortcode_project_overview( $atts ) {
		$atts = shortcode_atts( array( 'id' => get_the_ID() ), $atts );
		$pid  = (int) $atts['id'];
		if ( ! $pid ) {
			return '';
		}

		$code     = get_post_meta( $pid, '_kbds_project_code', true );
		$price    = get_post_meta( $pid, '_kbds_price_from', true );
		$address  = get_post_meta( $pid, '_kbds_address', true );
		$area     = get_post_meta( $pid, '_kbds_total_area', true );
		$scale    = get_post_meta( $pid, '_kbds_scale', true );
		$legal    = get_post_meta( $pid, '_kbds_legal_status', true );
		$handover = get_post_meta( $pid, '_kbds_handover_time', true );
		$bank     = get_post_meta( $pid, '_kbds_bank_support', true );
		$score    = get_post_meta( $pid, '_kbds_review_score', true );
		$pros     = get_post_meta( $pid, '_kbds_pros_cons', true );

		$cdt_terms    = wp_get_post_terms( $pid, 'chu_dau_tu', array( 'fields' => 'names' ) );
		$status_terms = wp_get_post_terms( $pid, 'trang_thai_du_an', array( 'fields' => 'names' ) );

		ob_start();
		?>
		<div class="kbds-overview-card" style="background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:24px;margin:24px 0;box-shadow:0 2px 8px rgba(15,62,109,0.06);">
			<div style="display:flex;justify-content:space-between;align-items:center;border-bottom:2px solid #0f3e6d;padding-bottom:12px;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
				<h3 style="margin:0;color:#0f3e6d;font-size:20px;">🏢 Thông tin Tổng quan Dự án <?php echo esc_html( get_the_title( $pid ) ); ?></h3>
				<?php if ( $score ) : ?>
					<span style="background:#0f3e6d;color:#fff;padding:6px 14px;border-radius:6px;font-weight:700;font-size:14px;">
						⭐ Đánh giá Kênh BĐS: <?php echo esc_html( $score ); ?>/10
					</span>
				<?php endif; ?>
			</div>

			<table style="width:100%;border-collapse:collapse;font-size:15px;">
				<tbody>
					<?php if ( $price ) : ?>
					<tr style="border-bottom:1px solid #f1f5f9;">
						<td style="padding:10px 8px;font-weight:600;color:#475569;width:35%;">💰 Giá bán tham khảo:</td>
						<td style="padding:10px 8px;font-weight:700;color:#e53935;font-size:17px;"><?php echo esc_html( $price ); ?></td>
					</tr>
					<?php endif; ?>
					<?php if ( ! empty( $status_terms ) ) : ?>
					<tr style="border-bottom:1px solid #f1f5f9;">
						<td style="padding:10px 8px;font-weight:600;color:#475569;">📌 Trạng thái:</td>
						<td style="padding:10px 8px;"><span style="background:#e8f5e9;color:#1b8a4b;padding:3px 10px;border-radius:4px;font-weight:600;"><?php echo esc_html( implode( ', ', $status_terms ) ); ?></span></td>
					</tr>
					<?php endif; ?>
					<?php if ( ! empty( $cdt_terms ) ) : ?>
					<tr style="border-bottom:1px solid #f1f5f9;">
						<td style="padding:10px 8px;font-weight:600;color:#475569;">🏛️ Chủ đầu tư:</td>
						<td style="padding:10px 8px;font-weight:600;"><?php echo esc_html( implode( ', ', $cdt_terms ) ); ?></td>
					</tr>
					<?php endif; ?>
					<?php if ( $address ) : ?>
					<tr style="border-bottom:1px solid #f1f5f9;">
						<td style="padding:10px 8px;font-weight:600;color:#475569;">📍 Vị trí dự án:</td>
						<td style="padding:10px 8px;"><?php echo esc_html( $address ); ?></td>
					</tr>
					<?php endif; ?>
					<?php if ( $area ) : ?>
					<tr style="border-bottom:1px solid #f1f5f9;">
						<td style="padding:10px 8px;font-weight:600;color:#475569;">📐 Quy mô diện tích:</td>
						<td style="padding:10px 8px;"><?php echo esc_html( $area ); ?></td>
					</tr>
					<?php endif; ?>
					<?php if ( $scale ) : ?>
					<tr style="border-bottom:1px solid #f1f5f9;">
						<td style="padding:10px 8px;font-weight:600;color:#475569;">🏙️ Quy mô sản phẩm:</td>
						<td style="padding:10px 8px;"><?php echo esc_html( $scale ); ?></td>
					</tr>
					<?php endif; ?>
					<?php if ( $legal ) : ?>
					<tr style="border-bottom:1px solid #f1f5f9;">
						<td style="padding:10px 8px;font-weight:600;color:#475569;">⚖️ Pháp lý:</td>
						<td style="padding:10px 8px;"><?php echo esc_html( $legal ); ?></td>
					</tr>
					<?php endif; ?>
					<?php if ( $handover ) : ?>
					<tr style="border-bottom:1px solid #f1f5f9;">
						<td style="padding:10px 8px;font-weight:600;color:#475569;">🔑 Thời gian bàn giao:</td>
						<td style="padding:10px 8px;"><?php echo esc_html( $handover ); ?></td>
					</tr>
					<?php endif; ?>
					<?php if ( $bank ) : ?>
					<tr>
						<td style="padding:10px 8px;font-weight:600;color:#475569;">🏦 Hỗ trợ tài chính:</td>
						<td style="padding:10px 8px;"><?php echo esc_html( $bank ); ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>

			<?php if ( $pros ) : ?>
				<div style="background:#f8fafc;border-left:4px solid #d99b26;padding:14px 18px;margin-top:16px;border-radius:4px;">
					<strong style="color:#0f3e6d;display:block;margin-bottom:6px;">💡 Nhận định nhanh từ Chuyên gia Kênh BĐS:</strong>
					<div style="white-space:pre-line;line-height:1.6;color:#334155;"><?php echo esc_html( $pros ); ?></div>
				</div>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * 2. Hiển thị Giỏ hàng các sản phẩm đang bán của Dự án
	 */
	public static function shortcode_project_listings( $atts ) {
		$atts = shortcode_atts( array(
			'project_id' => get_the_ID(),
			'limit'      => 6,
		), $atts );

		$args = array(
			'post_type'      => 'bat_dong_san',
			'posts_per_page' => (int) $atts['limit'],
			'post_status'    => 'publish',
		);

		if ( ! empty( $atts['project_id'] ) && 'du_an' === get_post_type( (int) $atts['project_id'] ) ) {
			$args['meta_query'] = array(
				array(
					'key'   => '_kbds_parent_project_id',
					'value' => (int) $atts['project_id'],
				),
			);
		}

		$listings = get_posts( $args );
		if ( empty( $listings ) ) {
			return '';
		}

		ob_start();
		?>
		<div class="kbds-listings-section" style="margin:28px 0;">
			<h3 style="color:#0f3e6d;border-bottom:2px solid #0f3e6d;padding-bottom:10px;">
				🏠 Giỏ hàng Chuyển nhượng & Suất đẹp Đang bán (Đã xác thực)
			</h3>
			<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px;margin-top:16px;">
				<?php foreach ( $listings as $item ) : ?>
					<?php
					$code     = get_post_meta( $item->ID, '_kbds_listing_code', true );
					$price    = get_post_meta( $item->ID, '_kbds_listing_price', true );
					$area     = get_post_meta( $item->ID, '_kbds_area_m2', true );
					$beds     = get_post_meta( $item->ID, '_kbds_bedrooms', true );
					$dir      = get_post_meta( $item->ID, '_kbds_direction', true );
					$verified = get_post_meta( $item->ID, '_kbds_is_verified', true );
					?>
					<div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:18px;box-shadow:0 1px 4px rgba(0,0,0,0.05);">
						<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
							<span style="font-size:12px;color:#64748b;font-weight:600;">Mã: <?php echo esc_html( $code ?: '#' . $item->ID ); ?></span>
							<?php if ( '1' === $verified ) : ?>
								<span style="background:#e8f5e9;color:#1b8a4b;font-size:11px;font-weight:700;padding:2px 8px;border-radius:4px;">✔ Đã xác thực</span>
							<?php endif; ?>
						</div>
						<h4 style="margin:0 0 10px;font-size:16px;"><a href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>" style="color:#0f3e6d;text-decoration:none;"><?php echo esc_html( $item->post_title ); ?></a></h4>
						<div style="font-size:18px;font-weight:700;color:#e53935;margin-bottom:10px;"><?php echo esc_html( $price ?: 'Giá liên hệ' ); ?></div>
						<div style="font-size:13px;color:#475569;display:flex;gap:12px;flex-wrap:wrap;">
							<?php if ( $area ) : ?><span>📐 <?php echo esc_html( $area ); ?> m²</span><?php endif; ?>
							<?php if ( $beds ) : ?><span>🛏️ <?php echo esc_html( $beds ); ?> PN</span><?php endif; ?>
							<?php if ( $dir ) : ?><span>🧭 <?php echo esc_html( $dir ); ?></span><?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * 3. Công cụ Tính khoản vay mua nhà trả góp (Interactive Calculator)
	 */
	public static function shortcode_loan_calculator() {
		ob_start();
		?>
		<div class="kbds-loan-calc" style="background:#f8fafc;border:1px solid #cbd5e1;border-radius:10px;padding:24px;margin:24px 0;">
			<h3 style="margin-top:0;color:#0f3e6d;">🧮 Công cụ Tính Lãi Vay Mua Bất Động Sản Hàng Tháng</h3>
			<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
				<div>
					<label style="font-weight:600;font-size:14px;">Giá trị BĐS (Tỷ VNĐ):</label>
					<input type="number" id="kbds_calc_price" value="3.5" step="0.1" style="width:100%;padding:8px;margin-top:4px;" oninput="kbdsCalculateLoan()" />
				</div>
				<div>
					<label style="font-weight:600;font-size:14px;">Tỷ lệ vay (%):</label>
					<input type="number" id="kbds_calc_ratio" value="70" min="10" max="90" style="width:100%;padding:8px;margin-top:4px;" oninput="kbdsCalculateLoan()" />
				</div>
				<div>
					<label style="font-weight:600;font-size:14px;">Thời hạn vay (Năm):</label>
					<input type="number" id="kbds_calc_years" value="20" min="1" max="35" style="width:100%;padding:8px;margin-top:4px;" oninput="kbdsCalculateLoan()" />
				</div>
				<div>
					<label style="font-weight:600;font-size:14px;">Lãi suất (%/năm):</label>
					<input type="number" id="kbds_calc_rate" value="7.5" step="0.1" style="width:100%;padding:8px;margin-top:4px;" oninput="kbdsCalculateLoan()" />
				</div>
			</div>
			<div id="kbds_calc_result" style="background:#fff;padding:16px;border-radius:8px;margin-top:16px;display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;border-left:4px solid #0f3e6d;">
				<div><span style="color:#64748b;font-size:13px;">Vốn tự có cần chuẩn bị:</span><br/><strong id="kbds_res_equity" style="font-size:18px;color:#0f3e6d;">1.05 tỷ</strong></div>
				<div><span style="color:#64748b;font-size:13px;">Số tiền vay ngân hàng:</span><br/><strong id="kbds_res_loan" style="font-size:18px;color:#1b8a4b;">2.45 tỷ</strong></div>
				<div><span style="color:#64748b;font-size:13px;">Gốc + Lãi tháng cao nhất:</span><br/><strong id="kbds_res_monthly" style="font-size:18px;color:#e53935;">25.52 triệu/tháng</strong></div>
			</div>
			<script>
			function kbdsCalculateLoan() {
				var price = parseFloat(document.getElementById('kbds_calc_price').value) || 0;
				var ratio = parseFloat(document.getElementById('kbds_calc_ratio').value) || 0;
				var years = parseFloat(document.getElementById('kbds_calc_years').value) || 1;
				var rate  = parseFloat(document.getElementById('kbds_calc_rate').value) || 0;

				var loanBillion = price * (ratio / 100);
				var equityBillion = price - loanBillion;
				var months = years * 12;
				var principalMillion = (loanBillion * 1000) / months;
				var firstInterestMillion = (loanBillion * 1000) * (rate / 100 / 12);
				var firstMonthTotal = principalMillion + firstInterestMillion;

				document.getElementById('kbds_res_equity').innerText = equityBillion.toFixed(2) + ' tỷ';
				document.getElementById('kbds_res_loan').innerText = loanBillion.toFixed(2) + ' tỷ';
				document.getElementById('kbds_res_monthly').innerText = firstMonthTotal.toFixed(2) + ' triệu/tháng';
			}
			</script>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * 4. Form Đăng ký Nhận Bảng giá / Pháp lý lưu thẳng vào CRM Database
	 */
	public static function shortcode_lead_form( $atts ) {
		$default_title   = is_singular() ? get_the_title() : ( is_front_page() ? 'Trang Chủ - kenhbatdongsan.vn' : 'Tư vấn Kênh BĐS' );
		$default_url     = is_singular() ? get_permalink() : ( ! empty( $_SERVER['REQUEST_URI'] ) ? home_url( $_SERVER['REQUEST_URI'] ) : home_url( '/' ) );
		$default_type    = is_singular( 'du_an' ) ? 'Dự án con' : ( is_singular( 'post' ) ? 'Bài viết tin tức' : ( is_front_page() ? 'Trang chủ' : 'Trang đơn' ) );

		$atts = shortcode_atts( array(
			'title'        => '📥 Tải Trọn Bộ Bảng Giá, Mặt Bằng & Pháp Lý Mới Nhất',
			'project'      => $default_title,
			'source_url'   => $default_url,
			'source_title' => $default_title,
			'source_type'  => $default_type,
		), $atts );

		$submitted = false;
		if ( isset( $_POST['kbds_lead_submit'] ) && isset( $_POST['kbds_lead_nonce'] ) ) {
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kbds_lead_nonce'] ) ), 'kbds_submit_lead' ) ) {
				$name         = sanitize_text_field( wp_unslash( $_POST['kbds_name'] ?? '' ) );
				$phone        = sanitize_text_field( wp_unslash( $_POST['kbds_phone'] ?? '' ) );
				$email        = sanitize_email( wp_unslash( $_POST['kbds_email'] ?? '' ) );
				$project      = sanitize_text_field( wp_unslash( $_POST['kbds_project'] ?? '' ) );
				$source_url   = sanitize_text_field( wp_unslash( $_POST['kbds_source_url'] ?? $_SERVER['HTTP_REFERER'] ?? '' ) );
				$source_title = sanitize_text_field( wp_unslash( $_POST['kbds_source_title'] ?? '' ) );
				$source_type  = sanitize_text_field( wp_unslash( $_POST['kbds_source_type'] ?? '' ) );
				$demand       = sanitize_textarea_field( wp_unslash( $_POST['kbds_demand'] ?? '' ) );
				$ip           = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );

				if ( ! $project || 'Tư vấn dự án Kênh BĐS' === $project ) {
					$project = $source_title ?: $atts['project'];
				}

				if ( $name && $phone ) {
					$lead_id = wp_insert_post( array(
						'post_type'   => 'bds_lead',
						'post_status' => 'publish',
						'post_title'  => $name . ' - ' . $phone,
					) );
					if ( $lead_id && ! is_wp_error( $lead_id ) ) {
						update_post_meta( $lead_id, '_kbds_lead_phone', $phone );
						update_post_meta( $lead_id, '_kbds_lead_email', $email );
						update_post_meta( $lead_id, '_kbds_lead_project', $project );
						update_post_meta( $lead_id, '_kbds_lead_source_url', $source_url );
						update_post_meta( $lead_id, '_kbds_lead_source_title', $source_title );
						update_post_meta( $lead_id, '_kbds_lead_source_type', $source_type );
						update_post_meta( $lead_id, '_kbds_lead_demand', $demand );
						update_post_meta( $lead_id, '_kbds_lead_status', 'new' );
						update_post_meta( $lead_id, '_kbds_lead_ip', $ip );
						$submitted = true;

						// GỬI THÔNG BÁO TỨC THỜI (EMAIL ADMIN + TELEGRAM)
						if ( class_exists( 'KBDS_Notification_Service' ) ) {
							KBDS_Notification_Service::send_lead_alert( $lead_id, array(
								'name'         => $name,
								'phone'        => $phone,
								'email'        => $email,
								'project'      => $project,
								'source_url'   => $source_url,
								'source_title' => $source_title,
								'source_type'  => $source_type,
								'demand'       => $demand,
								'ip'           => $ip,
							) );
						}
					}
				}
			}
		}

		ob_start();
		?>
		<div class="kbds-lead-box" style="background:linear-gradient(135deg,#0f3e6d 0%,#16538f 100%);color:#fff;padding:28px;border-radius:12px;margin:28px 0;">
			<h3 style="margin-top:0;color:#fff;font-size:20px;"><?php echo esc_html( $atts['title'] ); ?></h3>
			<p style="color:#e2e8f0;margin-bottom:18px;">Chuyên viên Kênh BĐS sẽ gửi trực tiếp bộ tài liệu PDF nét cao & Bảng tính dòng tiền qua Zalo/Email trong 3 phút (Cam kết bảo mật 100%).</p>

			<?php if ( $submitted ) : ?>
				<div style="background:#1b8a4b;color:#fff;padding:16px;border-radius:8px;font-weight:600;">
					✔ Đăng ký thành công! Hệ thống đã ghi nhận yêu cầu và sẽ gửi bộ tài liệu cho bạn ngay lập tức.
				</div>
			<?php else : ?>
				<form method="post" style="display:grid;grid-template-columns:1fr 1fr 1.2fr auto;gap:12px;align-items:center;">
					<?php wp_nonce_field( 'kbds_submit_lead', 'kbds_lead_nonce' ); ?>
					<input type="hidden" name="kbds_project" value="<?php echo esc_attr( $atts['project'] ); ?>" />
					<input type="hidden" name="kbds_source_url" class="kbds-source-url-input" value="<?php echo esc_url( $atts['source_url'] ); ?>" />
					<input type="hidden" name="kbds_source_title" value="<?php echo esc_attr( $atts['source_title'] ); ?>" />
					<input type="hidden" name="kbds_source_type" value="<?php echo esc_attr( $atts['source_type'] ); ?>" />
					<input type="text" name="kbds_name" required placeholder="Họ và tên của bạn *" style="height:46px;margin:0;padding:0 14px;border-radius:8px;border:none;color:#111;box-sizing:border-box;" />
					<input type="tel" name="kbds_phone" required placeholder="Số điện thoại / Zalo nhận file *" style="height:46px;margin:0;padding:0 14px;border-radius:8px;border:none;color:#111;box-sizing:border-box;" />
					<input type="text" name="kbds_demand" placeholder="Nhu cầu (VD: Căn 2PN, Giỏ hàng cắt lỗ...)" style="height:46px;margin:0;padding:0 14px;border-radius:8px;border:none;color:#111;box-sizing:border-box;" />
					<button type="submit" name="kbds_lead_submit" value="1" style="height:46px;line-height:46px;margin:0;background:#d99b26;color:#fff;font-weight:700;border:none;padding:0 24px;border-radius:8px;cursor:pointer;font-size:14.5px;white-space:nowrap;box-sizing:border-box;">
						NHẬN BẢNG GIÁ NGAY
					</button>
				</form>
				<script>
				(function(){
					function setKbdsUrls() {
						document.querySelectorAll('.kbds-source-url-input').forEach(function(el){
							if (!el.value || el.value.indexOf('http') === -1) { el.value = window.location.href; }
						});
					}
					if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', setKbdsUrls); } else { setKbdsUrls(); }
				})();
				</script>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * 5. Card Đăng ký Nhanh (Dọc) dùng trong cột phải Hero Landing Page Dự án & Sidebar
	 */
	public static function shortcode_quick_lead_card( $atts ) {
		$default_title   = is_singular() ? get_the_title() : ( is_front_page() ? 'Trang Chủ - kenhbatdongsan.vn' : 'Tư vấn Kênh BĐS' );
		$default_url     = is_singular() ? get_permalink() : ( ! empty( $_SERVER['REQUEST_URI'] ) ? home_url( $_SERVER['REQUEST_URI'] ) : home_url( '/' ) );
		$default_type    = is_singular( 'du_an' ) ? 'Dự án con' : ( is_singular( 'post' ) ? 'Bài viết tin tức' : ( is_front_page() ? 'Trang chủ' : 'Trang đơn' ) );

		$atts = shortcode_atts( array(
			'title'        => 'NHẬN TRỌN BỘ TÀI LIỆU GỐC',
			'subtitle'     => 'Bảng giá dự kiến • Mặt bằng 1/500 • Chính sách Ưu đãi Quý III/2026',
			'project'      => $default_title,
			'source_url'   => $default_url,
			'source_title' => $default_title,
			'source_type'  => $default_type,
			'button'       => '📥 TẢI TRỌN BỘ TÀI LIỆU NGAY',
		), $atts );

		$submitted = false;
		if ( isset( $_POST['kbds_quick_lead_submit'] ) && isset( $_POST['kbds_lead_nonce'] ) ) {
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kbds_lead_nonce'] ) ), 'kbds_submit_lead' ) ) {
				$name         = sanitize_text_field( wp_unslash( $_POST['kbds_name'] ?? '' ) );
				$phone        = sanitize_text_field( wp_unslash( $_POST['kbds_phone'] ?? '' ) );
				$project      = sanitize_text_field( wp_unslash( $_POST['kbds_project'] ?? '' ) );
				$source_url   = sanitize_text_field( wp_unslash( $_POST['kbds_source_url'] ?? $_SERVER['HTTP_REFERER'] ?? '' ) );
				$source_title = sanitize_text_field( wp_unslash( $_POST['kbds_source_title'] ?? '' ) );
				$source_type  = sanitize_text_field( wp_unslash( $_POST['kbds_source_type'] ?? '' ) );
				$demand       = sanitize_textarea_field( wp_unslash( $_POST['kbds_demand'] ?? '' ) );
				$ip           = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );

				if ( ! $project || 'Tư vấn dự án Kênh BĐS' === $project ) {
					$project = $source_title ?: $atts['project'];
				}

				if ( $name && $phone ) {
					$lead_id = wp_insert_post( array(
						'post_type'   => 'bds_lead',
						'post_status' => 'publish',
						'post_title'  => $name . ' - ' . $phone,
					) );
					if ( $lead_id && ! is_wp_error( $lead_id ) ) {
						update_post_meta( $lead_id, '_kbds_lead_phone', $phone );
						update_post_meta( $lead_id, '_kbds_lead_project', $project );
						update_post_meta( $lead_id, '_kbds_lead_source_url', $source_url );
						update_post_meta( $lead_id, '_kbds_lead_source_title', $source_title );
						update_post_meta( $lead_id, '_kbds_lead_source_type', $source_type );
						update_post_meta( $lead_id, '_kbds_lead_demand', $demand );
						update_post_meta( $lead_id, '_kbds_lead_status', 'new' );
						update_post_meta( $lead_id, '_kbds_lead_ip', $ip );
						$submitted = true;

						// GỬI THÔNG BÁO TỨC THỜI (EMAIL ADMIN + TELEGRAM)
						if ( class_exists( 'KBDS_Notification_Service' ) ) {
							KBDS_Notification_Service::send_lead_alert( $lead_id, array(
								'name'         => $name,
								'phone'        => $phone,
								'project'      => $project,
								'source_url'   => $source_url,
								'source_title' => $source_title,
								'source_type'  => $source_type,
								'demand'       => $demand,
								'ip'           => $ip,
							) );
						}
					}
				}
			}
		}

		ob_start();
		?>
		<div class="kbds-quick-lead-card" style="background:#ffffff;border-radius:14px;padding:22px 18px;box-shadow:0 10px 30px rgba(11,44,77,0.14);border:1.5px solid #E5C158;color:#1e293b;text-align:left;box-sizing:border-box;">
			<div style="display:inline-block;background:#FDF8EC;color:#9A7312;border:1px solid #E5C158;padding:3px 10px;border-radius:99px;font-size:11px;font-weight:700;margin-bottom:8px;letter-spacing:0.3px;">
				⚡ CẬP NHẬT TRỰC TIẾP TỪ CĐT
			</div>
			<h3 style="margin:0 0 6px;color:#0B2C4D;font-size:18px;font-weight:800;line-height:1.3;"><?php echo esc_html( $atts['title'] ); ?></h3>
			<p style="margin:0 0 14px;color:#64748b;font-size:12.5px;line-height:1.45;"><?php echo esc_html( $atts['subtitle'] ); ?></p>

			<?php if ( $submitted ) : ?>
				<div style="background:#0E8A4A;color:#fff;padding:14px;border-radius:8px;font-weight:600;font-size:13.5px;line-height:1.5;">
					✔ Đã nhận thông tin! Chuyên viên Dự án sẽ gửi bộ file PDF qua Zalo của bạn trong 3 phút.
				</div>
			<?php else : ?>
				<form method="post" style="margin:0;">
					<?php wp_nonce_field( 'kbds_submit_lead', 'kbds_lead_nonce' ); ?>
					<input type="hidden" name="kbds_project" value="<?php echo esc_attr( $atts['project'] ); ?>" />
					<input type="hidden" name="kbds_source_url" class="kbds-source-url-input" value="<?php echo esc_url( $atts['source_url'] ); ?>" />
					<input type="hidden" name="kbds_source_title" value="<?php echo esc_attr( $atts['source_title'] ); ?>" />
					<input type="hidden" name="kbds_source_type" value="<?php echo esc_attr( $atts['source_type'] ); ?>" />
					<div style="margin-bottom:10px;">
						<input type="text" name="kbds_name" required placeholder="Họ và tên Quý khách *" style="width:100% !important;height:42px;margin:0;padding:0 12px;border-radius:8px;border:1.5px solid #cbd5e1;background:#f8fafc;color:#0f172a;font-size:13.5px;box-sizing:border-box;display:block;" />
					</div>
					<div style="margin-bottom:10px;">
						<input type="tel" name="kbds_phone" required placeholder="Số điện thoại / Zalo nhận file *" style="width:100% !important;height:42px;margin:0;padding:0 12px;border-radius:8px;border:1.5px solid #cbd5e1;background:#f8fafc;color:#0f172a;font-size:13.5px;box-sizing:border-box;display:block;" />
					</div>
					<div style="margin-bottom:12px;">
						<select name="kbds_demand" style="width:100% !important;height:42px;margin:0;padding:0 10px;border-radius:8px;border:1.5px solid #cbd5e1;background:#f8fafc;color:#0f172a;font-size:13px;box-sizing:border-box;display:block;">
							<option value="Quan tâm Bảng giá & Mặt bằng tổng thể">📌 Chọn nhu cầu tư vấn...</option>
							<option value="Căn hộ Cao tầng (Studio, 1PN, 2PN, 3PN)">🏢 Căn hộ Cao tầng (Studio, 1PN – 3PN)</option>
							<option value="Biệt thự Đơn lập / Song lập View Sân Golf 90ha">⛳ Biệt thự Đơn lập / Song lập View Sân Golf</option>
							<option value="Liền kề & Nhà phố thương mại Shophouse">🏬 Liền kề & Nhà phố Shophouse</option>
							<option value="Tư vấn Đầu tư & Chính sách vay vốn">💰 Tư vấn Đầu tư & Dòng tiền</option>
						</select>
					</div>
					<button type="submit" name="kbds_quick_lead_submit" value="1" style="width:100% !important;min-height:44px;margin:0;padding:10px 14px;background:linear-gradient(135deg,#C59B27 0%,#9E7812 100%);color:#ffffff;font-weight:800;border:none;border-radius:8px;cursor:pointer;font-size:13.5px;text-transform:uppercase;letter-spacing:0.3px;box-shadow:0 4px 12px rgba(197,155,39,0.3);box-sizing:border-box;white-space:normal;line-height:1.35;text-align:center;">
						<?php echo esc_html( $atts['button'] ); ?>
					</button>
					<div style="margin-top:10px;display:flex;justify-content:center;align-items:center;gap:12px;font-size:11.5px;color:#64748b;padding-top:8px;border-top:1px dashed #e2e8f0;text-align:center;">
						<span>🔒 Bảo mật 100%</span>
						<span>•</span>
						<span>⏱️ Phản hồi trong 3 phút</span>
					</div>
				</form>
				<script>
				(function(){
					function setKbdsUrls() {
						document.querySelectorAll('.kbds-source-url-input').forEach(function(el){
							if (!el.value || el.value.indexOf('http') === -1) { el.value = window.location.href; }
						});
					}
					if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', setKbdsUrls); } else { setKbdsUrls(); }
				})();
				</script>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * 6. Hiển thị Bài viết Vệ tinh / Tin tức & Đánh giá liên quan trực tiếp tới Dự án
	 */
	public static function shortcode_project_news( $atts ) {
		$atts = shortcode_atts( array(
			'project_id'   => get_the_ID(),
			'project_name' => get_the_title(),
			'limit'        => 4,
			'title'        => '📰 Tin Tức, Phân Tích & Đánh Giá Về Dự Án',
		), $atts );

		$pid = (int) $atts['project_id'];
		$p_title = $atts['project_name'];
		if ( ! $p_title && $pid ) {
			$p_title = get_the_title( $pid );
		}

		// Lấy từ khóa ngắn của tên dự án để tìm kiếm bài liên quan
		$clean_name = trim( preg_replace( '/\s*(Bắc Ninh|Hà Nội|TP\.HCM|Bình Dương|Đà Nẵng|Đồng Nai).*/iu', '', $p_title ) );

		$args = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => (int) $atts['limit'],
		);

		// Ưu tiên tìm theo Tag trùng tên dự án, nếu chưa có thì tìm theo từ khóa tên dự án
		$tag_obj = get_term_by( 'name', $clean_name, 'post_tag' );
		if ( ! $tag_obj ) {
			$tag_obj = get_term_by( 'name', $p_title, 'post_tag' );
		}

		if ( $tag_obj ) {
			$args['tag_id'] = $tag_obj->term_id;
		} else {
			$args['s'] = $clean_name ?: $p_title;
		}

		$news_posts = get_posts( $args );
		if ( empty( $news_posts ) ) {
			return '';
		}

		ob_start();
		?>
		<div class="kbds-project-news-wrapper" style="margin:24px 0;">
			<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
				<h3 style="color:#0B2C4D;font-size:22px;font-weight:800;margin:0;">
					<?php echo esc_html( $atts['title'] ); ?>
				</h3>
				<span style="font-size:13px;color:#64748B;font-weight:600;">
					Cập nhật liên tục từ Chuyên gia Kênh BĐS
				</span>
			</div>

			<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;">
				<?php foreach ( $news_posts as $post_item ) : ?>
					<?php
					$thumb_url = get_the_post_thumbnail_url( $post_item->ID, 'medium_large' );
					if ( ! $thumb_url ) {
						$thumb_url = get_the_post_thumbnail_url( $post_item->ID, 'full' );
					}
					$cats = get_the_category( $post_item->ID );
					$cat_name = ! empty( $cats ) ? $cats[0]->name : 'Review Dự án';
					$date_str = get_the_date( 'd/m/Y', $post_item->ID );
					?>
					<div class="kbds-card" style="margin:0;">
						<div class="kbds-card-media" style="height:185px;">
							<a href="<?php echo esc_url( get_permalink( $post_item->ID ) ); ?>">
								<?php if ( $thumb_url ) : ?>
									<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $post_item->post_title ); ?>" style="width:100%;height:100%;object-fit:cover;" />
								<?php else : ?>
									<div style="width:100%;height:100%;background:#0B2C4D;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;">Kênh Bất Động Sản</div>
								<?php endif; ?>
							</a>
							<span style="position:absolute;top:10px;left:10px;background:#C59B27;color:#fff;padding:3px 10px;border-radius:4px;font-size:11px;font-weight:700;">
								<?php echo esc_html( $cat_name ); ?>
							</span>
						</div>
						<div style="padding:16px;display:flex;flex-direction:column;flex:1;">
							<div style="font-size:12px;color:#64748B;margin-bottom:6px;">📅 <?php echo esc_html( $date_str ); ?></div>
							<h4 style="margin:0 0 10px;font-size:15.5px;line-height:1.45;font-weight:700;">
								<a href="<?php echo esc_url( get_permalink( $post_item->ID ) ); ?>" style="color:#0B2C4D;text-decoration:none;">
									<?php echo esc_html( $post_item->post_title ); ?>
								</a>
							</h4>
							<p style="font-size:13px;color:#475569;line-height:1.55;margin:0 0 14px;flex:1;">
								<?php echo esc_html( wp_trim_words( get_the_excerpt( $post_item->ID ) ?: wp_strip_all_tags( $post_item->post_content ), 18 ) ); ?>
							</p>
							<a href="<?php echo esc_url( get_permalink( $post_item->ID ) ); ?>" style="color:#C59B27;font-weight:700;font-size:13px;text-decoration:none;">
								Đọc bài viết chi tiết →
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * 7. Shortcode Thanh Menu Phụ 1 Hàng Ngang (Sticky Sub-Nav)
	 */
	public static function shortcode_project_subnav() {
		ob_start();
		?>
		<div class="kbds-proj-sticky-subnav">
			<div class="kbds-proj-nav-container">
				<nav class="kbds-proj-nav">
					<a href="#tong-quan">Tổng Quan</a>
					<a href="#vi-tri">Vị Trí</a>
					<a href="#san-pham">Mặt Bằng</a>
					<a href="#tien-ich">Tiện Ích</a>
					<a href="#tin-tuc-du-an">Tin Tức</a>
					<a href="#nhan-bang-gia" class="kbds-proj-nav-cta">Nhận Bảng Giá Gốc</a>
				</nav>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Tự động hiển thị Bảng tổng quan, Giỏ hàng, Tính lãi vay và Form thu Lead trên trang Dự án (`du_an`)
	 * (Tự động tắt khi đang mở trình kéo thả UX Builder hoặc khi bài viết tự thiết kế bằng [section] UX Builder)
	 */
	public static function auto_append_project_sections( $content ) {
		if ( function_exists( 'ux_builder_is_active' ) && ux_builder_is_active() ) {
			return $content;
		}
		if ( ! is_singular( 'du_an' ) || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}
		// Nếu người dùng tự thiết kế Landing Page bằng Section của UX Builder thì tôn trọng bố cục riêng
		if ( false !== strpos( $content, '[section' ) || false !== strpos( $content, '[ux_banner' ) ) {
			return $content;
		}

		$subnav   = has_shortcode( $content, 'kbds_project_subnav' ) ? '' : self::shortcode_project_subnav();
		$overview = has_shortcode( $content, 'kbds_project_overview' ) ? '' : '<div id="tong-quan"></div>' . self::shortcode_project_overview( array( 'id' => get_the_ID() ) );
		$listings = has_shortcode( $content, 'kbds_project_listings' ) ? '' : '<div id="san-pham"></div>' . self::shortcode_project_listings( array( 'project_id' => get_the_ID() ) );
		$calc     = has_shortcode( $content, 'kbds_loan_calculator' ) ? '' : self::shortcode_loan_calculator();
		$news     = has_shortcode( $content, 'kbds_project_news' ) ? '' : '<div id="tin-tuc-du-an"></div>' . self::shortcode_project_news( array( 'project_id' => get_the_ID() ) );
		$form     = has_shortcode( $content, 'kbds_lead_form' ) ? '' : '<div id="nhan-bang-gia"></div>' . self::shortcode_lead_form( array( 'project' => get_the_title() ) );

		return $subnav . $overview . $content . $listings . $calc . $news . $form;
	}
}