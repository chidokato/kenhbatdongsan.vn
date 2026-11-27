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
		add_shortcode( 'kbds_lead_form_cao_tang', array( __CLASS__, 'shortcode_lead_form_cao_tang' ) );
		add_shortcode( 'kbds_lead_form_thap_tang', array( __CLASS__, 'shortcode_lead_form_thap_tang' ) );
		add_shortcode( 'kbds_quick_lead_card', array( __CLASS__, 'shortcode_quick_lead_card' ) );
		add_shortcode( 'kbds_quick_lead_card_cao_tang', array( __CLASS__, 'shortcode_quick_lead_card_cao_tang' ) );
		add_shortcode( 'kbds_quick_lead_card_thap_tang', array( __CLASS__, 'shortcode_quick_lead_card_thap_tang' ) );
		add_shortcode( 'kbds_project_news', array( __CLASS__, 'shortcode_project_news' ) );
		add_shortcode( 'kbds_project_subnav', array( __CLASS__, 'shortcode_project_subnav' ) );

		// Tự động gắn thông tin tổng quan & giỏ hàng vào cuối trang chi tiết Dự án nếu chưa chèn shortcode
		add_filter( 'the_content', array( __CLASS__, 'auto_append_project_sections' ) );

		// Đảm bảo responsive hoàn hảo trên Mobile cho tất cả trang Dự án
		add_action( 'wp_head', array( __CLASS__, 'render_global_responsive_styles' ), 99 );
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
	 * Tự động nhận diện loại hình BĐS (cao_tang hoặc thap_tang)
	 */
	public static function detect_property_type( $post_id = 0 ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! $post_id ) {
			return 'general';
		}

		$check_id = $post_id;
		$proj_ref = get_post_meta( $post_id, '_kbds_project_ref', true );
		if ( $proj_ref && is_numeric( $proj_ref ) ) {
			$check_id = (int) $proj_ref;
		}

		// 1. Kiểm tra taxonomy loai_hinh_bds
		$terms = wp_get_post_terms( $check_id, 'loai_hinh_bds', array( 'fields' => 'slugs' ) );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $slug ) {
				if ( in_array( $slug, array( 'biet-thu-nha-pho', 'khu-do-thi', 'biet-thu', 'nha-pho', 'shophouse', 'bds-nghi-duong' ), true ) ) {
					return 'thap_tang';
				}
				if ( in_array( $slug, array( 'can-ho-cao-cap', 'can-ho-chung-cu', 'chung-cu', 'can-ho' ), true ) ) {
					return 'cao_tang';
				}
			}
		}

		// 2. Kiểm tra từ khóa trong tiêu đề
		$title = mb_strtolower( get_the_title( $post_id ) . ' ' . get_the_title( $check_id ), 'UTF-8' );
		if ( preg_match( '/(biệt thự|liền kề|shophouse|nhà phố|dinh thự|thấp tầng)/iu', $title ) ) {
			return 'thap_tang';
		}
		if ( preg_match( '/(căn hộ|chung cư|officetel|studio|cao tầng)/iu', $title ) ) {
			return 'cao_tang';
		}

		return is_front_page() ? 'general' : 'cao_tang';
	}

	/**
	 * Wrapper: Form riêng biệt cho Dòng Sản Phẩm Cao Tầng
	 */
	public static function shortcode_lead_form_cao_tang( $atts ) {
		$atts = is_array( $atts ) ? $atts : array();
		$atts['type'] = 'cao_tang';
		return self::shortcode_lead_form( $atts );
	}

	/**
	 * Wrapper: Form riêng biệt cho Dòng Sản Phẩm Thấp Tầng
	 */
	public static function shortcode_lead_form_thap_tang( $atts ) {
		$atts = is_array( $atts ) ? $atts : array();
		$atts['type'] = 'thap_tang';
		return self::shortcode_lead_form( $atts );
	}

	/**
	 * Wrapper: Card nhanh riêng biệt cho Dòng Sản Phẩm Cao Tầng
	 */
	public static function shortcode_quick_lead_card_cao_tang( $atts ) {
		$atts = is_array( $atts ) ? $atts : array();
		$atts['type'] = 'cao_tang';
		return self::shortcode_quick_lead_card( $atts );
	}

	/**
	 * Wrapper: Card nhanh riêng biệt cho Dòng Sản Phẩm Thấp Tầng
	 */
	public static function shortcode_quick_lead_card_thap_tang( $atts ) {
		$atts = is_array( $atts ) ? $atts : array();
		$atts['type'] = 'thap_tang';
		return self::shortcode_quick_lead_card( $atts );
	}

	/**
	 * 4. Form Đăng ký Nhận Bảng giá / Pháp lý lưu thẳng vào CRM Database
	 * Hỗ trợ chuyên sâu cho:
	 * - Dòng cao tầng (Studio, Căn hộ 1PN, Căn hộ 2PN, Căn hộ 3PN)
	 * - Dòng thấp tầng (Liền kề, Biệt thự, Shophouse)
	 */
	public static function shortcode_lead_form( $atts ) {
		$default_title   = is_singular() ? get_the_title() : ( is_front_page() ? 'Trang Chủ - kenhbatdongsan.vn' : 'Tư vấn Kênh BĐS' );
		$default_url     = is_singular() ? get_permalink() : ( ! empty( $_SERVER['REQUEST_URI'] ) ? home_url( $_SERVER['REQUEST_URI'] ) : home_url( '/' ) );
		$default_type    = is_singular( 'du_an' ) ? 'Dự án con' : ( is_singular( 'post' ) ? 'Bài viết tin tức' : ( is_front_page() ? 'Trang chủ' : 'Trang đơn' ) );

		$atts = shortcode_atts( array(
			'type'         => '', // 'cao_tang' hoặc 'thap_tang'
			'title'        => '',
			'subtitle'     => '',
			'project'      => $default_title,
			'source_url'   => $default_url,
			'source_title' => $default_title,
			'source_type'  => $default_type,
			'button_text'  => '',
		), $atts );

		// Xác định loại sản phẩm
		$form_type = sanitize_key( $atts['type'] );
		if ( empty( $form_type ) || ! in_array( $form_type, array( 'cao_tang', 'thap_tang', 'general' ), true ) ) {
			$form_type = self::detect_property_type( get_the_ID() );
		}

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
				$demand       = sanitize_text_field( wp_unslash( $_POST['kbds_demand'] ?? '' ) );
				$ip           = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );

				if ( ! $project || 'Tư vấn dự án Kênh BĐS' === $project ) {
					$project = $source_title ?: $atts['project'];
				}

				if ( $name && $phone ) {
					$lead_id = wp_insert_post( array(
						'post_type'     => 'bds_lead',
						'post_status'   => 'publish',
						'post_title'    => $name . ' - ' . $phone,
						'post_date'     => current_time( 'mysql' ),
						'post_date_gmt' => current_time( 'mysql', 1 ),
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
						update_post_meta( $lead_id, '_kbds_lead_product_group', $form_type );
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

		// Thiết lập nội dung & màu sắc theo phân loại sản phẩm
		if ( 'thap_tang' === $form_type ) {
			$badge_text     = '🏡 DÀNH CHO DÒNG SẢN PHẨM THẤP TẦNG';
			$badge_bg       = 'rgba(212, 175, 55, 0.2)';
			$badge_color    = '#FDE68A';
			$box_bg         = 'linear-gradient(135deg, #0B241E 0%, #134338 50%, #1A5C4D 100%)';
			$box_border     = '1px solid rgba(212, 175, 55, 0.4)';
			$default_h3     = '📥 Đăng Ký Nhận Bảng Giá & Quỹ Căn Ngoại Giao Thấp Tầng';
			$default_p      = 'Chuyên viên Kênh BĐS sẽ gửi trực tiếp Mặt bằng phân lô 1/500, Hồ sơ pháp lý sở hữu & Bảng giá suất đẹp qua Zalo/Email trong 3 phút (Bảo mật 100%).';
			$default_btn    = 'NHẬN BẢNG GIÁ THẤP TẦNG ➔';
		} else {
			// Mặc định cao tầng
			$badge_text     = '🏢 DÀNH CHO DÒNG CĂN HỘ CAO TẦNG';
			$badge_bg       = 'rgba(212, 175, 55, 0.2)';
			$badge_color    = '#FDE68A';
			$box_bg         = 'linear-gradient(135deg, #071D36 0%, #0B2C4D 50%, #124375 100%)';
			$box_border     = '1px solid rgba(212, 175, 55, 0.4)';
			$default_h3     = '📥 Đăng Ký Nhận Bảng Giá Gốc & Mặt Bằng Căn Hộ Đợt 1';
			$default_p      = 'Chuyên viên Kênh BĐS sẽ gửi trực tiếp trọn bộ Layout 3D, Bảng giá gốc CĐT & Bảng tính dòng tiền qua Zalo/Email trong 3 phút (Bảo mật 100%).';
			$default_btn    = 'NHẬN BẢNG GIÁ CĂN HỘ ➔';
		}

		$title_text  = ! empty( $atts['title'] ) ? $atts['title'] : $default_h3;
		$sub_text    = ! empty( $atts['subtitle'] ) ? $atts['subtitle'] : $default_p;
		$btn_text    = ! empty( $atts['button_text'] ) ? $atts['button_text'] : $default_btn;

		ob_start();
		?>
		<div class="kbds-lead-box kbds-lead-box-<?php echo esc_attr( $form_type ); ?>" style="background:<?php echo esc_attr( $box_bg ); ?>;border:<?php echo esc_attr( $box_border ); ?>;color:#fff;padding:28px 24px;border-radius:14px;margin:28px 0;box-shadow:0 10px 30px rgba(0,0,0,0.18);box-sizing:border-box;">
			<div style="margin-bottom:14px;">
				<span style="display:inline-block;background:<?php echo esc_attr( $badge_bg ); ?>;color:<?php echo esc_attr( $badge_color ); ?>;border:1px solid #D4AF37;padding:4px 12px;border-radius:20px;font-size:11.5px;font-weight:700;letter-spacing:0.5px;text-transform:uppercase;">
					<?php echo esc_html( $badge_text ); ?>
				</span>
			</div>
			<h3 style="margin:0 0 8px;color:#fff;font-size:22px;font-weight:800;font-family:'Playfair Display',Georgia,serif;line-height:1.35;"><?php echo esc_html( $title_text ); ?></h3>
			<p style="color:#CBD5E1;margin:0 0 20px;font-size:14px;line-height:1.55;"><?php echo esc_html( $sub_text ); ?></p>

			<?php if ( $submitted ) : ?>
				<div style="background:#1b8a4b;color:#fff;padding:16px 20px;border-radius:8px;font-weight:700;font-size:15px;box-shadow:0 4px 12px rgba(27,138,75,0.3);">
					✔ Đăng ký thành công! Hệ thống Kênh BĐS đã ghi nhận yêu cầu và đang chuyển tài liệu cho bạn qua Zalo/Email.
				</div>
			<?php else : ?>
				<form method="post" class="kbds-lead-form-grid" style="display:grid;grid-template-columns:1fr 1fr 1.25fr auto;gap:12px;align-items:center;">
					<?php wp_nonce_field( 'kbds_submit_lead', 'kbds_lead_nonce' ); ?>
					<input type="hidden" name="kbds_project" value="<?php echo esc_attr( $atts['project'] ); ?>" />
					<input type="hidden" name="kbds_source_url" class="kbds-source-url-input" value="<?php echo esc_url( $atts['source_url'] ); ?>" />
					<input type="hidden" name="kbds_source_title" value="<?php echo esc_attr( $atts['source_title'] ); ?>" />
					<input type="hidden" name="kbds_source_type" value="<?php echo esc_attr( $atts['source_type'] ); ?>" />
					
					<input type="text" name="kbds_name" required placeholder="Họ và tên của bạn *" style="height:48px;margin:0;padding:0 14px;border-radius:8px;border:1px solid rgba(255,255,255,0.25);background:#ffffff;color:#0f172a;box-sizing:border-box;font-size:14px;" />
					<input type="tel" name="kbds_phone" required placeholder="Số điện thoại / Zalo nhận file *" style="height:48px;margin:0;padding:0 14px;border-radius:8px;border:1px solid rgba(255,255,255,0.25);background:#ffffff;color:#0f172a;box-sizing:border-box;font-size:14px;" />
					
					<select name="kbds_demand" required style="height:48px;margin:0;padding:0 12px;border-radius:8px;border:1px solid rgba(255,255,255,0.25);background:#ffffff;color:#0f172a;box-sizing:border-box;font-size:14px;cursor:pointer;">
						<?php if ( 'thap_tang' === $form_type ) : ?>
							<option value="" disabled selected>🏡 Chọn loại hình (Liền kề, Biệt thự, Shophouse) *</option>
							<option value="Liền kề">Liền kề</option>
							<option value="Biệt thự">Biệt thự</option>
							<option value="Shophouse">Shophouse</option>
						<?php elseif ( 'cao_tang' === $form_type ) : ?>
							<option value="" disabled selected>🏢 Chọn loại căn hộ (Studio, 1PN, 2PN, 3PN) *</option>
							<option value="Studio">Studio</option>
							<option value="Căn hộ 1PN">Căn hộ 1PN</option>
							<option value="Căn hộ 2PN">Căn hộ 2PN</option>
							<option value="Căn hộ 3PN">Căn hộ 3PN</option>
						<?php else : ?>
							<option value="" disabled selected>📌 Chọn nhu cầu quan tâm *</option>
							<optgroup label="🏢 Dòng sản phẩm Cao tầng">
								<option value="Studio">Studio</option>
								<option value="Căn hộ 1PN">Căn hộ 1PN</option>
								<option value="Căn hộ 2PN">Căn hộ 2PN</option>
								<option value="Căn hộ 3PN">Căn hộ 3PN</option>
							</optgroup>
							<optgroup label="🏡 Dòng sản phẩm Thấp tầng">
								<option value="Liền kề">Liền kề</option>
								<option value="Biệt thự">Biệt thự</option>
								<option value="Shophouse">Shophouse</option>
							</optgroup>
						<?php endif; ?>
					</select>

					<button type="submit" name="kbds_lead_submit" value="1" style="height:48px;line-height:48px;margin:0;background:linear-gradient(135deg,#D4AF37 0%,#AA8010 100%);color:#071931;font-weight:800;border:none;padding:0 24px;border-radius:8px;cursor:pointer;font-size:14px;white-space:nowrap;box-sizing:border-box;letter-spacing:0.3px;box-shadow:0 4px 14px rgba(212,175,55,0.35);">
						<?php echo esc_html( $btn_text ); ?>
					</button>
				</form>
				<p style="font-size:12px;color:rgba(255,255,255,0.75);text-align:center;margin:14px 0 0;line-height:1.5;">
					🔒 Cam kết bảo mật thông tin 100% theo <a href="<?php echo esc_url( home_url( '/chinh-sach-bao-mat/' ) ); ?>" target="_blank" style="color:#FDE68A;text-decoration:underline;font-weight:600;">Chính sách bảo mật</a> và <a href="<?php echo esc_url( home_url( '/tuyen-bo-mien-tru-trach-nhiem/' ) ); ?>" target="_blank" style="color:#FDE68A;text-decoration:underline;font-weight:600;">Tuyên bố miễn trừ</a> của Kênh Bất Động Sản.
				</p>
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
			'type'         => '',
			'title'        => '',
			'subtitle'     => '',
			'project'      => $default_title,
			'source_url'   => $default_url,
			'source_title' => $default_title,
			'source_type'  => $default_type,
			'button'       => '',
		), $atts );

		// Xác định loại sản phẩm
		$form_type = sanitize_key( $atts['type'] );
		if ( empty( $form_type ) || ! in_array( $form_type, array( 'cao_tang', 'thap_tang', 'general' ), true ) ) {
			$form_type = self::detect_property_type( get_the_ID() );
		}

		$submitted = false;
		if ( isset( $_POST['kbds_quick_lead_submit'] ) && isset( $_POST['kbds_lead_nonce'] ) ) {
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kbds_lead_nonce'] ) ), 'kbds_submit_lead' ) ) {
				$name         = sanitize_text_field( wp_unslash( $_POST['kbds_name'] ?? '' ) );
				$phone        = sanitize_text_field( wp_unslash( $_POST['kbds_phone'] ?? '' ) );
				$project      = sanitize_text_field( wp_unslash( $_POST['kbds_project'] ?? '' ) );
				$source_url   = sanitize_text_field( wp_unslash( $_POST['kbds_source_url'] ?? $_SERVER['HTTP_REFERER'] ?? '' ) );
				$source_title = sanitize_text_field( wp_unslash( $_POST['kbds_source_title'] ?? '' ) );
				$source_type  = sanitize_text_field( wp_unslash( $_POST['kbds_source_type'] ?? '' ) );
				$demand       = sanitize_text_field( wp_unslash( $_POST['kbds_demand'] ?? '' ) );
				$ip           = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );

				if ( ! $project || 'Tư vấn dự án Kênh BĐS' === $project ) {
					$project = $source_title ?: $atts['project'];
				}

				if ( $name && $phone ) {
					$lead_id = wp_insert_post( array(
						'post_type'     => 'bds_lead',
						'post_status'   => 'publish',
						'post_title'    => $name . ' - ' . $phone,
						'post_date'     => current_time( 'mysql' ),
						'post_date_gmt' => current_time( 'mysql', 1 ),
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
						update_post_meta( $lead_id, '_kbds_lead_product_group', $form_type );
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

		if ( 'thap_tang' === $form_type ) {
			$badge_label  = '⚡ BẤT ĐỘNG SẢN THẤP TẦNG';
			$default_h3   = 'NHẬN BẢNG GIÁ THẤP TẦNG';
			$default_sub  = 'Bảng giá Liền kề, Biệt thự, Shophouse • Mặt bằng 1/500 • Suất đẹp';
			$default_btn  = '📥 TẢI TRỌN BỘ TÀI LIỆU NGAY';
		} else {
			$badge_label  = '⚡ CĂN HỘ CAO TẦNG';
			$default_h3   = 'NHẬN TRỌN BỘ TÀI LIỆU GỐC';
			$default_sub  = 'Bảng giá dự kiến • Mặt bằng Studio, 1PN - 3PN • Chính sách Đợt 1';
			$default_btn  = '📥 TẢI BẢNG GIÁ CĂN HỘ NGAY';
		}

		$title_text = ! empty( $atts['title'] ) ? $atts['title'] : $default_h3;
		$sub_text   = ! empty( $atts['subtitle'] ) ? $atts['subtitle'] : $default_sub;
		$btn_text   = ! empty( $atts['button'] ) ? $atts['button'] : $default_btn;

		ob_start();
		?>
		<div class="kbds-quick-lead-card" style="background:#ffffff;border-radius:14px;padding:22px 18px;box-shadow:0 10px 30px rgba(11,44,77,0.14);border:1.5px solid #E5C158;color:#1e293b;text-align:left;box-sizing:border-box;">
			<div style="display:inline-block;background:#FDF8EC;color:#9A7312;border:1px solid #E5C158;padding:3px 10px;border-radius:99px;font-size:11px;font-weight:700;margin-bottom:8px;letter-spacing:0.3px;">
				<?php echo esc_html( $badge_label ); ?>
			</div>
			<h3 style="margin:0 0 6px;color:#0B2C4D;font-size:18px;font-weight:800;line-height:1.3;font-family:'Playfair Display',Georgia,serif;"><?php echo esc_html( $title_text ); ?></h3>
			<p style="margin:0 0 14px;color:#64748b;font-size:12.5px;line-height:1.45;"><?php echo esc_html( $sub_text ); ?></p>

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
						<select name="kbds_demand" required style="width:100% !important;height:42px;margin:0;padding:0 10px;border-radius:8px;border:1.5px solid #cbd5e1;background:#f8fafc;color:#0f172a;font-size:13px;box-sizing:border-box;display:block;cursor:pointer;">
							<?php if ( 'thap_tang' === $form_type ) : ?>
								<option value="" disabled selected>🏡 Chọn loại hình (Liền kề, Biệt thự, Shophouse) *</option>
								<option value="Liền kề">Liền kề</option>
								<option value="Biệt thự">Biệt thự</option>
								<option value="Shophouse">Shophouse</option>
							<?php elseif ( 'cao_tang' === $form_type ) : ?>
								<option value="" disabled selected>🏢 Chọn loại căn hộ (Studio, 1PN, 2PN, 3PN) *</option>
								<option value="Studio">Studio</option>
								<option value="Căn hộ 1PN">Căn hộ 1PN</option>
								<option value="Căn hộ 2PN">Căn hộ 2PN</option>
								<option value="Căn hộ 3PN">Căn hộ 3PN</option>
							<?php else : ?>
								<option value="" disabled selected>📌 Chọn nhu cầu tư vấn quan tâm *</option>
								<optgroup label="🏢 Dòng sản phẩm Cao tầng">
									<option value="Studio">Studio</option>
									<option value="Căn hộ 1PN">Căn hộ 1PN</option>
									<option value="Căn hộ 2PN">Căn hộ 2PN</option>
									<option value="Căn hộ 3PN">Căn hộ 3PN</option>
								</optgroup>
								<optgroup label="🏡 Dòng sản phẩm Thấp tầng">
									<option value="Liền kề">Liền kề</option>
									<option value="Biệt thự">Biệt thự</option>
									<option value="Shophouse">Shophouse</option>
								</optgroup>
							<?php endif; ?>
						</select>
					</div>
					<button type="submit" name="kbds_quick_lead_submit" value="1" style="width:100% !important;min-height:44px;margin:0;padding:10px 14px;background:linear-gradient(135deg,#C59B27 0%,#9E7812 100%);color:#ffffff;font-weight:800;border:none;border-radius:8px;cursor:pointer;font-size:13.5px;text-transform:uppercase;letter-spacing:0.3px;box-shadow:0 4px 12px rgba(197,155,39,0.3);box-sizing:border-box;white-space:normal;line-height:1.35;text-align:center;">
						<?php echo esc_html( $btn_text ); ?>
					</button>
					<div style="margin-top:10px;text-align:center;font-size:11px;color:#64748b;line-height:1.45;padding-top:8px;border-top:1px dashed #e2e8f0;">
						🔒 Bằng việc bấm đăng ký, bạn đồng ý với <a href="<?php echo esc_url( home_url( '/chinh-sach-bao-mat/' ) ); ?>" target="_blank" style="color:#C59B27;text-decoration:underline;font-weight:600;">Chính sách bảo mật</a> của chúng tôi.
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
			'limit'        => 12,
			'title'        => '',
		), $atts );

		$pid = (int) $atts['project_id'];
		$p_title = $atts['project_name'];
		if ( ! $p_title && $pid ) {
			$p_title = get_the_title( $pid );
		}
		$p_slug = $pid ? get_post_field( 'post_name', $pid ) : '';
		$limit  = (int) $atts['limit'];
		$section_title = $atts['title'] ?: 'Tin Tức, Phân Tích & Đánh Giá Dự Án ' . $p_title;

		$found_ids = array();

		// 1. Tìm bài viết theo meta liên kết _kbds_project_ref hoặc _kbds_project_slug
		if ( $pid || $p_slug ) {
			$meta_query = array( 'relation' => 'OR' );
			if ( $pid ) {
				$meta_query[] = array( 'key' => '_kbds_project_ref', 'value' => $pid );
			}
			if ( $p_slug ) {
				$meta_query[] = array( 'key' => '_kbds_project_slug', 'value' => $p_slug );
			}
			$meta_posts = get_posts( array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $limit,
				'meta_query'     => $meta_query,
				'orderby'        => 'date',
				'order'          => 'DESC',
			) );
			foreach ( $meta_posts as $mp ) {
				$found_ids[] = $mp->ID;
			}
		}

		// 2. Tìm bài viết theo tag hoặc từ khóa tên dự án trong tiêu đề
		if ( count( $found_ids ) < $limit && $p_title ) {
			$clean_name = trim( preg_replace( '/\s*(Bắc Ninh|Hà Nội|TP\.HCM|Bình Dương|Đà Nẵng|Đồng Nai).*/iu', '', $p_title ) );
			if ( strpos( $clean_name, '–' ) !== false ) {
				$clean_name = trim( explode( '–', $clean_name )[0] );
			}
			$core_name = trim( preg_replace( '/^(Chung Cư|Dự Án|Tổ Hợp|Khu Đô Thị|Căn Hộ|Đại Đô Thị)\s+/iu', '', $clean_name ) );

			$search_args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $limit - count( $found_ids ),
				'post__not_in'   => $found_ids,
				'orderby'        => 'date',
				'order'          => 'DESC',
			);

			$tag_obj = get_term_by( 'name', $core_name ?: $clean_name, 'post_tag' );
			if ( ! $tag_obj ) {
				$tag_obj = get_term_by( 'name', $clean_name, 'post_tag' );
			}
			if ( ! $tag_obj ) {
				$tag_obj = get_term_by( 'name', $p_title, 'post_tag' );
			}

			if ( $tag_obj ) {
				$search_args['tag_id'] = $tag_obj->term_id;
			} else {
				$search_args['s'] = $core_name ?: $clean_name ?: $p_title;
			}

			$search_posts = get_posts( $search_args );
			foreach ( $search_posts as $sp ) {
				$found_ids[] = $sp->ID;
			}
		}

		if ( empty( $found_ids ) ) {
			return '';
		}

		$news_posts = get_posts( array(
			'post_type'      => 'post',
			'post__in'       => $found_ids,
			'posts_per_page' => count( $found_ids ),
			'orderby'        => 'post__in',
		) );

		ob_start();
		?>
		<section class="kbds-project-news-section" id="tin-tuc-du-an" style="padding:60px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;border-bottom:1px solid #E2E8F0;">
			<div class="kbds-container">
				<!-- Header Section với Nút Điều Hướng Slider -->
				<div class="kbds-news-header-wrap" style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;gap:20px;flex-wrap:wrap;">
					<div style="max-width:760px;">
						<span style="display:inline-flex;align-items:center;gap:6px;background:rgba(194,86,43,0.12);color:#C2562B;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;padding:6px 16px;border-radius:20px;margin-bottom:10px;">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block;flex-shrink:0;"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path><path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6Z"></path></svg>
							TIN TỨC &amp; GÓC NHÌN CHUYÊN GIA
						</span>
						<h2 style="color:#0B2C4D;font-size:26px;font-weight:800;line-height:1.35;margin:0 0 8px;">
							<?php echo esc_html( $section_title ); ?>
						</h2>
						<p style="color:#64748B;font-size:14.5px;margin:0;line-height:1.6;">
							Tổng hợp các bài viết phân tích vị trí, mặt bằng, hệ thống tiện ích, thiết kế căn hộ và tiến độ dự án mới nhất do đội ngũ chuyên gia Kênh Bất Động Sản thực hiện.
						</p>
					</div>
					<div class="kbds-news-nav-buttons" style="display:flex;gap:10px;align-items:center;flex-shrink:0;">
						<button type="button" class="kbds-news-prev" aria-label="Bài trước" style="width:42px;height:42px;border-radius:50%;border:1.5px solid #CBD5E1;background:#FFFFFF;color:#0B2C4D;font-size:22px;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.06);transition:all 0.25s;user-select:none;">‹</button>
						<button type="button" class="kbds-news-next" aria-label="Bài tiếp" style="width:42px;height:42px;border-radius:50%;border:1.5px solid #CBD5E1;background:#FFFFFF;color:#0B2C4D;font-size:22px;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.06);transition:all 0.25s;user-select:none;">›</button>
					</div>
				</div>

				<!-- Track Slider 1 Hàng 4 Bài -->
				<div class="kbds-project-news-slider-wrap" style="position:relative;">
					<div class="kbds-project-news-track" style="display:flex;gap:20px;overflow-x:auto;scroll-behavior:smooth;scroll-snap-type:x mandatory;padding-bottom:16px;-webkit-overflow-scrolling:touch;scrollbar-width:none;-ms-overflow-style:none;">
						<?php foreach ( $news_posts as $post_item ) : ?>
							<?php
							$thumb_url = get_the_post_thumbnail_url( $post_item->ID, 'medium_large' ) ?: get_the_post_thumbnail_url( $post_item->ID, 'full' );
							$cats = get_the_category( $post_item->ID );
							$filtered_cats = array_filter( $cats, function( $c ) {
								return $c->slug !== 'chua-phan-loai';
							} );
							$cat_name = ! empty( $filtered_cats ) ? reset( $filtered_cats )->name : 'Review Dự Án';
							$date_str = get_the_date( 'd/m/Y', $post_item->ID );
							$excerpt  = $post_item->post_excerpt ?: wp_strip_all_tags( $post_item->post_content );
							?>
							<article class="kbds-card kbds-news-card kbds-slide-card" style="margin:0;background:#FFFFFF;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);display:flex;flex-direction:column;overflow:hidden;transition:transform 0.25s,box-shadow 0.25s;scroll-snap-align:start;">
								<div class="kbds-card-media" style="position:relative;height:175px;overflow:hidden;background:#F1F5F9;flex-shrink:0;">
									<a href="<?php echo esc_url( get_permalink( $post_item->ID ) ); ?>">
										<?php if ( $thumb_url ) : ?>
											<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $post_item->post_title ); ?>" style="width:100%;height:100%;object-fit:cover;transition:transform 0.4s ease;" loading="lazy" />
										<?php else : ?>
											<div style="width:100%;height:100%;background:linear-gradient(135deg,#0B2C4D 0%,#1A4670 100%);display:flex;align-items:center;justify-content:center;color:#FFF;font-weight:700;font-size:14px;">Kênh Bất Động Sản</div>
										<?php endif; ?>
									</a>
									<span style="position:absolute;top:10px;left:10px;background:#C2562B;color:#FFFFFF;padding:3px 10px;border-radius:6px;font-size:11px;font-weight:700;box-shadow:0 2px 6px rgba(0,0,0,0.2);">
										<?php echo esc_html( $cat_name ); ?>
									</span>
								</div>

								<div style="padding:16px 18px;display:flex;flex-direction:column;flex:1;">
									<div style="font-size:12px;color:#64748B;margin-bottom:6px;font-weight:600;display:flex;align-items:center;gap:6px;">
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" style="display:inline-block;flex-shrink:0;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
										<span><?php echo esc_html( $date_str ); ?></span>
										<span style="color:#CBD5E1;">•</span>
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" style="display:inline-block;flex-shrink:0;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
										<span>5 phút đọc</span>
									</div>
									<h3 style="margin:0 0 8px;font-size:15px;line-height:1.45;font-weight:700;height:44px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
										<a href="<?php echo esc_url( get_permalink( $post_item->ID ) ); ?>" style="color:#0B2C4D;text-decoration:none;transition:color 0.2s;">
											<?php echo esc_html( $post_item->post_title ); ?>
										</a>
									</h3>
									<p style="font-size:13px;color:#475569;line-height:1.55;margin:0 0 12px;height:40px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
										<?php echo esc_html( wp_trim_words( $excerpt, 18 ) ); ?>
									</p>
									<div style="margin-top:auto;padding-top:10px;border-top:1px solid #F1F5F9;display:flex;justify-content:space-between;align-items:center;">
										<a href="<?php echo esc_url( get_permalink( $post_item->ID ) ); ?>" style="color:#C2562B;font-weight:700;font-size:13px;text-decoration:none;">
											Đọc chi tiết →
										</a>
										<span style="font-size:11.5px;color:#94A3B8;">Kênh BĐS</span>
									</div>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>

				<style>
				.kbds-project-news-track::-webkit-scrollbar { display: none; }
				.kbds-slide-card {
					flex: 0 0 calc((100% - 60px) / 4);
					min-width: 250px;
				}
				.kbds-slide-card:hover {
					transform: translateY(-4px);
					box-shadow: 0 12px 25px rgba(0,0,0,0.08) !important;
				}
				.kbds-news-prev:hover, .kbds-news-next:hover {
					background: #C2562B !important;
					color: #FFFFFF !important;
					border-color: #C2562B !important;
					box-shadow: 0 4px 12px rgba(194,86,43,0.3) !important;
				}
				@media (max-width: 1150px) {
					.kbds-slide-card {
						flex: 0 0 calc((100% - 40px) / 3) !important;
					}
				}
				@media (max-width: 820px) {
					.kbds-slide-card {
						flex: 0 0 calc((100% - 20px) / 2) !important;
					}
				}
				@media (max-width: 560px) {
					.kbds-slide-card {
						flex: 0 0 85% !important;
					}
				}
				</style>

				<script>
				(function() {
					function initNewsSliders() {
						document.querySelectorAll('.kbds-project-news-section').forEach(function(sec) {
							if (sec.dataset.sliderInit) return;
							sec.dataset.sliderInit = '1';
							var track = sec.querySelector('.kbds-project-news-track');
							var prev = sec.querySelector('.kbds-news-prev');
							var next = sec.querySelector('.kbds-news-next');
							if (!track || !prev || !next) return;

							function getStep() {
								var card = track.querySelector('.kbds-slide-card');
								return card ? (card.offsetWidth + 20) : 300;
							}

							prev.addEventListener('click', function(e) {
								e.preventDefault();
								track.scrollBy({ left: -getStep(), behavior: 'smooth' });
							});

							next.addEventListener('click', function(e) {
								e.preventDefault();
								track.scrollBy({ left: getStep(), behavior: 'smooth' });
							});
						});
					}
					if (document.readyState === 'loading') {
						document.addEventListener('DOMContentLoaded', initNewsSliders);
					} else {
						initNewsSliders();
					}
				})();
				</script>
			</div>
		</section>
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
		static $running = false;
		if ( $running ) {
			return $content;
		}
		if ( function_exists( 'ux_builder_is_active' ) && ux_builder_is_active() ) {
			return $content;
		}
		if ( ! is_singular( 'du_an' ) || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}
		// Nếu người dùng tự thiết kế Landing Page bằng Section UX Builder hoặc HTML Section riêng thì tôn trọng bố cục riêng
		if ( false !== strpos( $content, '[section' ) || false !== strpos( $content, '[ux_banner' ) || false !== strpos( $content, '<section' ) || false !== strpos( $content, 'kbds-project-subnav' ) ) {
			return $content;
		}

		$running = true;
		$subnav   = has_shortcode( $content, 'kbds_project_subnav' ) ? '' : self::shortcode_project_subnav();
		$overview = has_shortcode( $content, 'kbds_project_overview' ) ? '' : '<div id="tong-quan"></div>' . self::shortcode_project_overview( array( 'id' => get_the_ID() ) );
		$listings = has_shortcode( $content, 'kbds_project_listings' ) ? '' : '<div id="san-pham"></div>' . self::shortcode_project_listings( array( 'project_id' => get_the_ID() ) );
		$calc     = has_shortcode( $content, 'kbds_loan_calculator' ) ? '' : self::shortcode_loan_calculator();
		$has_lead_form = has_shortcode( $content, 'kbds_lead_form' )
			|| has_shortcode( $content, 'kbds_lead_form_cao_tang' )
			|| has_shortcode( $content, 'kbds_lead_form_thap_tang' );
		$form = $has_lead_form ? '' : '<div id="nhan-bang-gia"></div>' . self::shortcode_lead_form( array( 'project' => get_the_title() ) );

		$running = false;
		return $subnav . $overview . $content . $listings . $calc . $form;
	}

	/**
	 * Render CSS tối ưu hiển thị Mobile toàn diện trực tiếp vào wp_head
	 * Đảm bảo 100% không bị trễ cache và ghi đè inline styles hoàn hảo trên di động
	 */
	public static function render_global_responsive_styles() {
		?>
		<style id="kbds-project-mobile-styles">
		/* Bảo vệ Emoji toàn trang: Không bao giờ bị phóng to làm vỡ layout */
		img.emoji, img.wp-smiley,
		.single-du_an img.emoji, .single-du_an img.wp-smiley,
		.single-du_an section img.emoji, .single-du_an article img.emoji {
			display: inline-block !important;
			width: 1.15em !important;
			height: 1.15em !important;
			min-width: unset !important;
			min-height: unset !important;
			max-width: 1.15em !important;
			max-height: 1.15em !important;
			vertical-align: -0.15em !important;
			margin: 0 0.15em !important;
			border: none !important;
			box-shadow: none !important;
			padding: 0 !important;
			background: transparent !important;
			object-fit: contain !important;
		}

		/* --- Thanh Subnav Cố Định Chuẩn Dự Án (Sticky Subnav Desktop & Mobile) --- */
		:root {
			--kbds-subnav-top: 70px;
			--kbds-scroll-offset: 125px;
		}
		body.admin-bar {
			--kbds-subnav-top: 102px;
		}
		@media (max-width: 782px) {
			body.admin-bar {
				--kbds-subnav-top: 116px;
			}
		}
		@media (max-width: 600px) {
			body.admin-bar {
				--kbds-subnav-top: 70px !important;
			}
		}
		.kbds-project-subnav {
			position: sticky !important;
			top: 70px !important;
			top: var(--kbds-subnav-top, 70px) !important;
			z-index: 99 !important;
			background: #0F172A !important;
			border-bottom: 1px solid #1E293B !important;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25) !important;
			width: 100% !important;
			margin: 0 !important;
		}
		.single-du_an .kbds-project-subnav,
		.single-du_an.admin-bar .kbds-project-subnav {
			top: 70px !important;
			top: var(--kbds-subnav-top, 70px) !important;
		}
		.kbds-project-subnav p {
			margin: 0 !important;
			padding: 0 !important;
			display: contents !important;
		}
		.kbds-project-subnav br {
			display: none !important;
		}
		.kbds-project-subnav .kbds-container,
		.kbds-subnav-container {
			display: flex !important;
			align-items: center !important;
			justify-content: space-between !important;
			padding: 10px 20px !important;
			gap: 14px !important;
			max-width: 1340px !important;
			margin: 0 auto !important;
			box-sizing: border-box !important;
		}
		.kbds-subnav-brand {
			order: 1 !important;
			font-weight: 800 !important;
			font-size: 15px !important;
			color: #F8FAFC !important;
			display: flex !important;
			align-items: center !important;
			gap: 8px !important;
			white-space: nowrap !important;
			flex-shrink: 0 !important;
		}
		.kbds-subnav-dot {
			display: inline-block !important;
			width: 9px !important;
			height: 9px !important;
			background: #D97706 !important;
			border-radius: 50% !important;
			box-shadow: 0 0 10px #F59E0B !important;
		}
		.kbds-subnav-links {
			order: 2 !important;
			display: flex !important;
			align-items: center !important;
			gap: 6px !important;
			overflow-x: auto !important;
			white-space: nowrap !important;
			scrollbar-width: none !important;
			-ms-overflow-style: none !important;
			-webkit-overflow-scrolling: touch !important;
			flex: 1 1 auto !important;
			justify-content: flex-start !important;
			margin: 0 14px !important;
		}
		.kbds-subnav-links::-webkit-scrollbar {
			display: none !important;
		}
		.kbds-subnav-link,
		.kbds-project-subnav [style*="display:flex;gap:18px"] > a,
		.kbds-project-subnav [style*="display: flex; gap: 18px"] > a {
			color: #CBD5E1 !important;
			text-decoration: none !important;
			font-size: 13px !important;
			font-weight: 600 !important;
			padding: 6px 12px !important;
			border-radius: 6px !important;
			transition: all 0.2s ease !important;
			white-space: nowrap !important;
			flex-shrink: 0 !important;
		}
		.kbds-subnav-link:hover,
		.kbds-subnav-link.active,
		.kbds-project-subnav [style*="display:flex;gap:18px"] > a:hover {
			color: #FBBF24 !important;
			background: rgba(251, 191, 36, 0.12) !important;
		}
		.kbds-subnav-cta,
		.kbds-project-subnav a[href="#dang-ky"] {
			order: 3 !important;
			margin-left: auto !important;
			background: linear-gradient(135deg, #D97706 0%, #B45309 100%) !important;
			color: #FFFFFF !important;
			padding: 8px 18px !important;
			border-radius: 24px !important;
			font-size: 12.5px !important;
			font-weight: 700 !important;
			text-decoration: none !important;
			white-space: nowrap !important;
			flex-shrink: 0 !important;
			box-shadow: 0 4px 12px rgba(217, 119, 6, 0.35) !important;
			transition: transform 0.2s, box-shadow 0.2s !important;
		}
		.kbds-subnav-cta:hover,
		.kbds-project-subnav a[href="#dang-ky"]:hover {
			transform: translateY(-1px) !important;
			box-shadow: 0 6px 16px rgba(217, 119, 6, 0.5) !important;
			color: #FFFFFF !important;
		}
		.single-du_an section[id],
		.single-du_an div[id],
		#tong-quan, #vi-tri, #phan-khu, #tien-ich, #mat-bang, #can-ho-mau, #can-ho-dual-key, #bang-gia, #tien-do, #tin-tuc-du-an, #dang-ky {
			scroll-margin-top: 135px !important;
		}

		@media (max-width: 820px) {
			/* Container tràn viền chuẩn & padding an toàn */
			.single-du_an .kbds-container,
			.post-type-archive-du_an .kbds-container {
				width: 100% !important;
				max-width: 100% !important;
				padding-left: 16px !important;
				padding-right: 16px !important;
				box-sizing: border-box !important;
			}

			/* Tự động chuyển toàn bộ layout đa cột (2 cột) sang 1 cột xếp chồng */
			.single-du_an [style*="grid-template-columns:1.15fr 0.85fr"],
			.single-du_an [style*="grid-template-columns: 1.15fr 0.85fr"],
			.single-du_an [style*="grid-template-columns:1.1fr 0.9fr"],
			.single-du_an [style*="grid-template-columns: 1.1fr 0.9fr"],
			.single-du_an [style*="grid-template-columns:1.2fr 0.8fr"],
			.single-du_an [style*="grid-template-columns: 1.2fr 0.8fr"],
			.single-du_an [style*="grid-template-columns:1fr 1fr"],
			.single-du_an [style*="grid-template-columns: 1fr 1fr"],
			.single-du_an [style*="grid-template-columns:1fr 1.2fr"],
			.single-du_an [style*="grid-template-columns: 1fr 1.2fr"],
			.single-du_an .kbds-2col-grid,
			.single-du_an .kbds-hero-grid {
				display: flex !important;
				flex-direction: column !important;
				gap: 26px !important;
			}

			/* Hero Banner padding & typography */
			.single-du_an section:first-of-type,
			.single-du_an .kbds-project-hero {
				padding: 34px 0 46px !important;
			}
			.single-du_an section:first-of-type h1,
			.single-du_an h1.kbds-hero-title,
			.single-du_an h1[style*="font-size:38px"],
			.single-du_an h1[style*="font-size: 38px"],
			.single-du_an h1[style*="font-size:36px"],
			.single-du_an h1[style*="font-size: 36px"] {
				font-size: 24px !important;
				line-height: 1.28 !important;
				margin-bottom: 10px !important;
				word-break: normal !important;
			}
			.single-du_an section:first-of-type h1 span,
			.single-du_an h1 span[style*="font-size:23px"],
			.single-du_an h1 span[style*="font-size: 23px"],
			.single-du_an h1 span[style*="font-size:22px"],
			.single-du_an h1 span[style*="font-size: 22px"],
			.single-du_an .kbds-hero-subtitle {
				font-size: 15px !important;
				line-height: 1.4 !important;
				margin-top: 6px !important;
			}
			.single-du_an section:first-of-type [style*="border-radius:30px"],
			.single-du_an section:first-of-type [style*="border-radius: 30px"],
			.single-du_an .kbds-hero-badge {
				font-size: 11px !important;
				padding: 4px 12px !important;
				margin-bottom: 12px !important;
				line-height: 1.4 !important;
				display: inline-flex !important;
			}
			.single-du_an section:first-of-type p,
			.single-du_an .kbds-hero-desc {
				font-size: 14px !important;
				line-height: 1.65 !important;
				margin-bottom: 22px !important;
			}
			.single-du_an section:first-of-type [style*="display:flex;gap:14px"],
			.single-du_an section:first-of-type [style*="display: flex; gap: 14px"],
			.single-du_an .kbds-hero-actions {
				display: flex !important;
				flex-direction: column !important;
				gap: 12px !important;
				width: 100% !important;
			}
			.single-du_an section:first-of-type [style*="display:flex;gap:14px"] > a,
			.single-du_an section:first-of-type [style*="display: flex; gap: 14px"] > a,
			.single-du_an .kbds-hero-actions > a {
				width: 100% !important;
				text-align: center !important;
				justify-content: center !important;
				box-sizing: border-box !important;
				padding: 12px 18px !important;
				font-size: 14px !important;
			}
			/* Chỉ tác động lên ảnh tòa tháp, không làm to emoji */
			.single-du_an .kbds-hero-img,
			.single-du_an .kbds-hero-media img:not(.emoji),
			.single-du_an section:first-of-type .kbds-hero-media img:not(.emoji) {
				width: 100% !important;
				height: 250px !important;
				object-fit: cover !important;
				border-radius: 14px !important;
				display: block !important;
			}
			.single-du_an img:not(.emoji) {
				max-width: 100% !important;
			}

			/* Thẻ nổi bật Hero */
			.single-du_an section:first-of-type [style*="position:absolute;bottom:"],
			.single-du_an section:first-of-type [style*="position: absolute; bottom:"],
			.single-du_an .kbds-hero-float-badge {
				position: static !important;
				margin-top: 14px !important;
				width: 100% !important;
				box-sizing: border-box !important;
				padding: 10px 16px !important;
				display: flex !important;
				align-items: center !important;
				gap: 12px !important;
				background: #0F172A !important;
				border-radius: 12px !important;
				border: 1px solid #D97706 !important;
			}
			.single-du_an .kbds-hero-float-badge > div:first-child {
				width: 38px !important;
				height: 38px !important;
				min-width: 38px !important;
				max-width: 38px !important;
				max-height: 38px !important;
				border-radius: 50% !important;
				overflow: hidden !important;
				flex-shrink: 0 !important;
				display: flex !important;
				align-items: center !important;
				justify-content: center !important;
				font-size: 16px !important;
			}

			/* Header News & Slider buttons trên mobile */
			.kbds-news-header-wrap {
				flex-direction: row !important;
				align-items: center !important;
				justify-content: space-between !important;
				margin-bottom: 18px !important;
			}
			.kbds-news-nav-buttons button {
				width: 36px !important;
				height: 36px !important;
				font-size: 18px !important;
			}
			.kbds-slide-card {
				flex: 0 0 85% !important;
				min-width: 260px !important;
				max-width: 85% !important;
			}
			.kbds-slide-card .kbds-card-media {
				height: 160px !important;
			}

			/* Quick Stats Bar gọn gàng 2x2 */
			.single-du_an [style*="repeat(auto-fit,minmax(200px,1fr))"],
			.single-du_an [style*="repeat(auto-fit, minmax(200px, 1fr))"],
			.single-du_an .kbds-stats-grid {
				grid-template-columns: repeat(2, 1fr) !important;
				gap: 10px !important;
				padding: 0 4px !important;
			}
			.single-du_an [style*="repeat(auto-fit,minmax(200px,1fr))"] > div,
			.single-du_an [style*="repeat(auto-fit, minmax(200px, 1fr))"] > div {
				border-right: none !important;
				border: 1px solid #334155 !important;
				border-radius: 10px !important;
				padding: 12px 8px !important;
				background: rgba(255, 255, 255, 0.03) !important;
				box-sizing: border-box !important;
			}
			.single-du_an [style*="repeat(auto-fit,minmax(200px,1fr))"] [style*="font-size:26px"],
			.single-du_an [style*="repeat(auto-fit, minmax(200px, 1fr))"] [style*="font-size:26px"] {
				font-size: 20px !important;
				line-height: 1.2 !important;
			}
			.single-du_an [style*="repeat(auto-fit,minmax(200px,1fr))"] [style*="font-size:13px"],
			.single-du_an [style*="repeat(auto-fit, minmax(200px, 1fr))"] [style*="font-size:13px"] {
				font-size: 11.5px !important;
			}

			/* Tiêu đề & Section chung */
			.single-du_an section {
				padding: 45px 0 !important;
			}
			.single-du_an section h2,
			.single-du_an h2[style*="font-size:32px"],
			.single-du_an h2[style*="font-size: 32px"],
			.single-du_an h2[style*="font-size:30px"],
			.single-du_an h2[style*="font-size: 30px"] {
				font-size: 21px !important;
				line-height: 1.35 !important;
				margin-bottom: 10px !important;
			}
			.single-du_an section h3,
			.single-du_an h3[style*="font-size:22px"],
			.single-du_an h3[style*="font-size: 22px"] {
				font-size: 17px !important;
				line-height: 1.4 !important;
			}
			.single-du_an section p {
				font-size: 14px !important;
				line-height: 1.65 !important;
			}

			/* Lưới thẻ Tiện ích & Cơ cấu căn hộ */
			.single-du_an [style*="repeat(auto-fit,minmax(260px,1fr))"],
			.single-du_an [style*="repeat(auto-fit, minmax(260px, 1fr))"],
			.single-du_an [style*="repeat(auto-fit,minmax(320px,1fr))"],
			.single-du_an [style*="repeat(auto-fit, minmax(320px, 1fr))"] {
				grid-template-columns: 1fr !important;
				gap: 14px !important;
			}
			.single-du_an [style*="repeat(auto-fit,minmax(220px,1fr))"],
			.single-du_an [style*="repeat(auto-fit, minmax(220px, 1fr))"] {
				grid-template-columns: 1fr !important;
				gap: 12px !important;
			}

			/* Bảng & Dual Key card */
			.single-du_an [style*="padding:32px"],
			.single-du_an [style*="padding: 32px"] {
				padding: 20px 14px !important;
				border-radius: 14px !important;
				box-sizing: border-box !important;
			}
			.single-du_an table {
				font-size: 13px !important;
				width: 100% !important;
			}
			.single-du_an table td,
			.single-du_an table th {
				padding: 8px 6px !important;
			}

			/* Subnav Mobile: Tối ưu 2 hàng (Hàng 1: Brand + CTA | Hàng 2: Tabs Scroll) */
			.kbds-project-subnav {
				top: 70px !important;
				top: var(--kbds-subnav-top, 70px) !important;
				z-index: 99 !important;
				margin: 0 !important;
				padding: 0 !important;
			}
			.admin-bar .kbds-project-subnav {
				top: 70px !important;
				top: var(--kbds-subnav-top, 70px) !important;
			}
			.kbds-project-subnav .kbds-container,
			.kbds-subnav-container {
				display: flex !important;
				flex-wrap: wrap !important;
				align-items: center !important;
				justify-content: space-between !important;
				padding: 7px 12px 6px !important;
				gap: 0 !important;
				overflow: visible !important;
				box-sizing: border-box !important;
			}
			.kbds-subnav-brand,
			.kbds-project-subnav .kbds-container > div:first-child,
			.kbds-project-subnav [style*="font-weight:800;font-size:16px"],
			.kbds-project-subnav [style*="font-weight: 800; font-size: 16px"] {
				order: 1 !important;
				display: flex !important;
				align-items: center !important;
				gap: 6px !important;
				font-size: 12.5px !important;
				font-weight: 800 !important;
				color: #F8FAFC !important;
				white-space: nowrap !important;
				overflow: hidden !important;
				text-overflow: ellipsis !important;
				max-width: calc(100% - 130px) !important;
				flex: 0 1 auto !important;
				margin: 0 !important;
				line-height: 1.2 !important;
			}
			.kbds-subnav-dot,
			.kbds-project-subnav [style*="border-radius:50%"] {
				width: 8px !important;
				height: 8px !important;
				flex-shrink: 0 !important;
			}
			.kbds-subnav-cta,
			.kbds-project-subnav a[href="#dang-ky"] {
				order: 2 !important;
				display: inline-flex !important;
				align-items: center !important;
				justify-content: center !important;
				padding: 5px 12px !important;
				font-size: 11px !important;
				font-weight: 700 !important;
				white-space: nowrap !important;
				border-radius: 18px !important;
				flex: 0 0 auto !important;
				margin: 0 !important;
				box-shadow: 0 3px 10px rgba(217, 119, 6, 0.3) !important;
				line-height: 1.3 !important;
			}
			.kbds-subnav-links,
			.kbds-project-subnav [style*="display:flex;gap:18px"],
			.kbds-project-subnav [style*="display: flex; gap: 18px"] {
				order: 3 !important;
				display: flex !important;
				flex: 0 0 100% !important;
				width: 100% !important;
				overflow-x: auto !important;
				white-space: nowrap !important;
				gap: 5px !important;
				padding: 6px 0 2px !important;
				margin-top: 6px !important;
				border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
				scrollbar-width: none !important;
				-webkit-overflow-scrolling: touch !important;
				justify-content: flex-start !important;
			}
			.kbds-subnav-links::-webkit-scrollbar,
			.kbds-project-subnav [style*="display:flex;gap:18px"]::-webkit-scrollbar,
			.kbds-project-subnav [style*="display: flex; gap: 18px"]::-webkit-scrollbar {
				display: none !important;
			}
			.kbds-subnav-link,
			.kbds-project-subnav [style*="display:flex;gap:18px"] > a,
			.kbds-project-subnav [style*="display: flex; gap: 18px"] > a {
				font-size: 11.5px !important;
				font-weight: 600 !important;
				padding: 5px 9px !important;
				border-radius: 6px !important;
				flex-shrink: 0 !important;
				white-space: nowrap !important;
				color: #CBD5E1 !important;
				background: rgba(255, 255, 255, 0.06) !important;
				transition: all 0.2s ease !important;
			}
			.kbds-subnav-link.active,
			.kbds-project-subnav [style*="display:flex;gap:18px"] > a.active,
			.kbds-project-subnav [style*="display: flex; gap: 18px"] > a.active {
				color: #F59E0B !important;
				background: rgba(245, 158, 11, 0.2) !important;
				font-weight: 700 !important;
			}
			.single-du_an section[id],
			.single-du_an div[id],
			#tong-quan, #vi-tri, #phan-khu, #tien-ich, #mat-bang, #can-ho-mau, #can-ho-dual-key, #bang-gia, #tien-do, #tin-tuc-du-an, #dang-ky {
				scroll-margin-top: 135px !important;
				scroll-margin-top: var(--kbds-scroll-offset, 135px) !important;
			}

			/* Form Đăng ký (#dang-ky) */
			#dang-ky {
				padding: 40px 0 !important;
			}
			#dang-ky [style*="padding:45px 35px"],
			#dang-ky [style*="padding: 45px 35px"] {
				padding: 24px 14px !important;
				border-radius: 16px !important;
				box-sizing: border-box !important;
			}
			#dang-ky h2 {
				font-size: 20px !important;
				line-height: 1.3 !important;
			}
			.kbds-lead-form-grid {
				grid-template-columns: 1fr !important;
				gap: 12px !important;
			}
			.kbds-lead-form-grid input,
			.kbds-lead-form-grid select,
			.kbds-lead-form-grid button {
				width: 100% !important;
				font-size: 14px !important;
				height: 46px !important;
				box-sizing: border-box !important;
			}

			/* Nút Gọi & Zalo nổi */
			.kbds-floating-contact {
				bottom: 18px !important;
				left: 14px !important;
				gap: 10px !important;
				z-index: 9999 !important;
			}
			.kbds-btn-circle {
				width: 42px !important;
				height: 42px !important;
			}
			.kbds-btn-circle svg {
				width: 20px !important;
				height: 20px !important;
			}
		}
		</style>
		<?php
	}
}