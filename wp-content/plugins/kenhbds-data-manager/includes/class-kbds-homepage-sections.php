<?php
/**
 * Hệ thống Các Section Trang Chủ Module Hóa (Mô hình B + D) - kenhbatdongsan.vn
 * Mỗi Section được tách độc lập để dễ dàng quản lý, sắp xếp hoặc chỉnh sửa trong UX Builder / Blocks.
 *
 * Danh sách 7 Section độc lập:
 * 1. [kbds_sec_hero]       : Hero Banner sang trọng + Bộ lọc Tìm kiếm Dự án / Giỏ hàng thông minh
 * 2. [kbds_sec_projects]   : Tổ hợp Dự án BĐS Tâm điểm (Mô hình B - Project Portal)
 * 3. [kbds_sec_listings]   : Giỏ hàng Chuyển nhượng & Suất Ngoại giao Đã xác thực (Mô hình D)
 * 4. [kbds_sec_news]       : Chuyên trang Review Dự án, Quy hoạch Hạ tầng & Tài chính (Phễu SEO)
 * 5. [kbds_sec_Explorer]   : Khám phá BĐS theo Khu vực Trọng điểm & Chủ đầu tư Uy tín
 * 6. [kbds_sec_tools]      : Công cụ Tính Lãi suất Vay & Bảng Lãi suất Ngân hàng mới nhất
 * 7. [kbds_sec_cta_lead]   : Khu vực Đăng ký Nhận Bảng giá / Ký gửi BĐS Nhanh (CRM)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Homepage_Sections {

	public static function init() {
		add_shortcode( 'kbds_sec_hero', array( __CLASS__, 'render_section_hero' ) );
		add_shortcode( 'kbds_sec_projects', array( __CLASS__, 'render_section_projects' ) );
		add_shortcode( 'kbds_sec_listings', array( __CLASS__, 'render_section_listings' ) );
		add_shortcode( 'kbds_sec_news', array( __CLASS__, 'render_section_news' ) );
		add_shortcode( 'kbds_sec_explorer', array( __CLASS__, 'render_section_explorer' ) );
		add_shortcode( 'kbds_sec_tools', array( __CLASS__, 'render_section_tools' ) );
		add_shortcode( 'kbds_sec_cta_lead', array( __CLASS__, 'render_section_cta_lead' ) );
		add_shortcode( 'kbds_sec_footer', array( __CLASS__, 'render_section_footer' ) );
	}

	/**
	 * SECTION 1: HERO BANNER + BỘ LỌC TÌM KIẾM ĐA NĂNG
	 */
	public static function render_section_hero( $atts ) {
		$atts = shortcode_atts( array(
			'badge'    => 'CỔNG THÔNG TIN DỰ ÁN & PHÂN TÍCH ĐẦU Tư BẤT ĐỘNG SẢN',
			'title'    => 'Kênh Dữ Liệu Dự Án, Quy Hoạch & Giỏ Hàng Xác Thực',
			'subtitle' => 'Tra cứu thông tin pháp lý, bảng giá gốc Chủ đầu tư, đánh giá chuyên sâu và giỏ hàng chuyển nhượng giá tốt nhất trên thị trường.',
		), $atts );

		$khu_vuc   = get_terms( array( 'taxonomy' => 'khu_vuc_bds', 'hide_empty' => false ) );
		$loai_hinh = get_terms( array( 'taxonomy' => 'loai_hinh_bds', 'hide_empty' => false ) );

		$count_projects = wp_count_posts( 'du_an' )->publish;
		$count_listings = wp_count_posts( 'bat_dong_san' )->publish;

		ob_start();
		?>
		<section class="kbds-section kbds-sec-hero" id="kbds-section-hero">
			<div class="kbds-container">
				<div class="kbds-hero-inner">
					<span class="kbds-hero-badge">✦ <?php echo esc_html( $atts['badge'] ); ?></span>
					<h1 class="kbds-hero-title"><?php echo esc_html( $atts['title'] ); ?></h1>
					<p class="kbds-hero-subtitle"><?php echo esc_html( $atts['subtitle'] ); ?></p>

					<!-- Hộp Tìm kiếm Tối giản & Sang trọng -->
					<div class="kbds-search-box">
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="kbds-search-form">
							<div class="kbds-search-field kbds-field-keyword">
								<input type="text" name="s" placeholder="Nhập tên dự án, chủ đầu tư, khu vực hoặc từ khóa cần tra cứu..." value="<?php echo esc_attr( get_search_query() ); ?>" />
							</div>

							<div class="kbds-search-action">
								<button type="submit" class="kbds-btn-gold">
									🔍 Tìm kiếm ngay
								</button>
							</div>
						</form>
					</div>

					<!-- Thanh chỉ số uy tín -->
					<div class="kbds-hero-stats">
						<div class="kbds-stat-item">
							<strong><?php echo esc_html( max( 150, $count_projects * 35 ) ); ?>+</strong>
							<span>Hồ sơ Dự án & Pháp lý</span>
						</div>
						<div class="kbds-stat-item">
							<strong>100%</strong>
							<span>Giỏ hàng Xác thực Giá thật</span>
						</div>
						<div class="kbds-stat-item">
							<strong>24/7</strong>
							<span>Cập nhật Quy hoạch & Lãi suất</span>
						</div>
						<div class="kbds-stat-item">
							<strong>Miễn phí</strong>
							<span>Tải Bảng giá & Tư vấn Dòng tiền</span>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * SECTION 2: DỰ ÁN BẤT ĐỘNG SẢN THEO KHU VỰC (HÀ NỘI / TP.HCM / TỈNH THÀNH)
	 */
	public static function render_section_projects( $atts ) {
		$atts = shortcode_atts( array(
			'subtitle' => 'TÂM ĐIỂM ĐẦU TƯ & AN CƯ',
			'title'    => 'Dự Án Bất Động Sản Nổi Bật',
			'desc'     => 'Tổng hợp các dự án có pháp lý minh bạch, chủ đầu tư uy tín kèm đánh giá độc lập từ đội ngũ chuyên gia Kênh BĐS.',
			'khu_vuc'  => '',
			'bg'       => 'light',
			'limit'    => 4,
			'btn_text' => 'Xem toàn bộ Dự án →',
		), $atts );

		$query_args = array(
			'post_type'      => 'du_an',
			'posts_per_page' => (int) $atts['limit'],
			'post_status'    => 'publish',
		);

		$more_url = get_post_type_archive_link( 'du_an' );

		if ( ! empty( $atts['khu_vuc'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy'         => 'khu_vuc_bds',
					'field'            => 'slug',
					'terms'            => sanitize_text_field( $atts['khu_vuc'] ),
					'include_children' => true,
				),
			);
			$term_link = get_term_link( $atts['khu_vuc'], 'khu_vuc_bds' );
			if ( ! is_wp_error( $term_link ) ) {
				$more_url = $term_link;
			}
		}

		$projects  = get_posts( $query_args );
		$sec_class = ( 'ivory' === $atts['bg'] ) ? 'kbds-sec-ivory' : 'kbds-sec-light';

		ob_start();
		?>
		<section class="kbds-section <?php echo esc_attr( $sec_class ); ?>">
			<div class="kbds-container">
				<div class="kbds-sec-header">
					<div>
						<span class="kbds-sec-tag"><?php echo esc_html( $atts['subtitle'] ); ?></span>
						<h2 class="kbds-sec-title"><?php echo esc_html( $atts['title'] ); ?></h2>
						<?php if ( ! empty( $atts['desc'] ) ) : ?>
							<p class="kbds-sec-desc"><?php echo esc_html( $atts['desc'] ); ?></p>
						<?php endif; ?>
					</div>
					<a href="<?php echo esc_url( $more_url ); ?>" class="kbds-btn-outline">
						<?php echo esc_html( $atts['btn_text'] ); ?>
					</a>
				</div>

				<?php if ( empty( $projects ) ) : ?>
					<p style="color:#64748B;font-style:italic;">Đang cập nhật các dự án mới tại khu vực này...</p>
				<?php else : ?>
				<div class="kbds-grid-4">
					<?php foreach ( $projects as $proj ) : ?>
						<?php
						$pid       = $proj->ID;
						$price     = get_post_meta( $pid, '_kbds_price_from', true ) ?: 'Đang cập nhật';
						$address   = get_post_meta( $pid, '_kbds_address', true );
						$thumb     = get_the_post_thumbnail_url( $pid, 'large' );
						$cdts      = wp_get_post_terms( $pid, 'chu_dau_tu', array( 'fields' => 'names' ) );
						$cdt_label = ! empty( $cdts ) ? $cdts[0] : 'Chủ đầu tư uy tín';
						?>
						<article class="kbds-card kbds-project-card">
							<div class="kbds-card-media">
								<a href="<?php echo esc_url( get_permalink( $pid ) ); ?>">
									<?php if ( $thumb ) : ?>
										<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $proj->post_title ); ?>" loading="lazy" />
									<?php else : ?>
										<div class="kbds-img-placeholder" style="width:100%;height:100%;background:linear-gradient(135deg,#0B2C4D 0%,#1E5F74 100%);"></div>
									<?php endif; ?>
								</a>
							</div>

							<div class="kbds-card-body">
								<div class="kbds-card-meta-top">
									<span class="kbds-developer-tag">🏛️ <?php echo esc_html( $cdt_label ); ?></span>
								</div>
								<h3 class="kbds-card-title">
									<a href="<?php echo esc_url( get_permalink( $pid ) ); ?>"><?php echo esc_html( $proj->post_title ); ?></a>
								</h3>
								<?php if ( $address ) : ?>
									<p class="kbds-card-location">📍 <?php echo esc_html( $address ); ?></p>
								<?php endif; ?>

								<div class="kbds-card-footer">
									<div class="kbds-price-block">
										<span class="kbds-price-label">Giá tham khảo</span>
										<strong class="kbds-price-value"><?php echo esc_html( $price ); ?></strong>
									</div>
									<a href="<?php echo esc_url( get_permalink( $pid ) ); ?>" class="kbds-btn-card">Chi tiết →</a>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * SECTION 3: GIỎ HÀNG CHỌN LỌC & CHUYỂN NHƯỢNG ĐÃ XÁC THỰC (MÔ HÌNH D)
	 */
	public static function render_section_listings( $atts ) {
		$atts = shortcode_atts( array(
			'subtitle' => 'CAM KẾT HÌNH THẬT • GIÁ THẬT • PHÁP LÝ RÕ RÀNG',
			'title'    => 'Giỏ Hàng Chuyển Nhượng & Suất Đẹp Chọn Lọc',
			'desc'     => 'Danh sách các căn hộ, nhà phố, biệt thự có mức giá tốt nhất thuộc các dự án trọng điểm đã được đội ngũ Kênh BĐS kiểm duyệt.',
			'limit'    => 4,
		), $atts );

		$listings = get_posts( array(
			'post_type'      => 'bat_dong_san',
			'posts_per_page' => (int) $atts['limit'],
			'post_status'    => 'publish',
		) );

		ob_start();
		?>
		<section class="kbds-section kbds-sec-ivory" id="kbds-section-listings">
			<div class="kbds-container">
				<div class="kbds-sec-header">
					<div>
						<span class="kbds-sec-tag"><?php echo esc_html( $atts['subtitle'] ); ?></span>
						<h2 class="kbds-sec-title"><?php echo esc_html( $atts['title'] ); ?></h2>
						<p class="kbds-sec-desc"><?php echo esc_html( $atts['desc'] ); ?></p>
					</div>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'bat_dong_san' ) ); ?>" class="kbds-btn-outline">
						Xem toàn bộ Giỏ hàng →
					</a>
				</div>

				<div class="kbds-grid-4">
					<?php foreach ( $listings as $item ) : ?>
						<?php
						$lid       = $item->ID;
						$code      = get_post_meta( $lid, '_kbds_listing_code', true );
						$price     = get_post_meta( $lid, '_kbds_listing_price', true );
						$area      = get_post_meta( $lid, '_kbds_area_m2', true );
						$beds      = get_post_meta( $lid, '_kbds_bedrooms', true );
						$baths     = get_post_meta( $lid, '_kbds_bathrooms', true );
						$dir       = get_post_meta( $lid, '_kbds_direction', true );
						$legal     = get_post_meta( $lid, '_kbds_listing_legal', true );
						$verified  = get_post_meta( $lid, '_kbds_is_verified', true );
						$parent_id = (int) get_post_meta( $lid, '_kbds_parent_project_id', true );
						$thumb     = get_the_post_thumbnail_url( $lid, 'large' );
						$tx_types  = wp_get_post_terms( $lid, 'loai_giao_dich', array( 'fields' => 'names' ) );
						$tx_label  = ! empty( $tx_types ) ? $tx_types[0] : 'Giỏ hàng chọn lọc';
						?>
						<article class="kbds-card kbds-listing-card">
							<div class="kbds-card-media">
								<a href="<?php echo esc_url( get_permalink( $lid ) ); ?>">
									<?php if ( $thumb ) : ?>
										<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $item->post_title ); ?>" loading="lazy" />
									<?php else : ?>
										<div class="kbds-img-placeholder">🏠 <?php echo esc_html( $item->post_title ); ?></div>
									<?php endif; ?>
								</a>
								<?php if ( '1' === $verified ) : ?>
									<span class="kbds-badge-verified-top">✔ Đã xác thực</span>
								<?php endif; ?>
								<span class="kbds-badge-tx"><?php echo esc_html( $tx_label ); ?></span>
							</div>

							<div class="kbds-card-body">
								<div class="kbds-card-meta-top">
									<?php if ( $parent_id ) : ?>
										<a href="<?php echo esc_url( get_permalink( $parent_id ) ); ?>" class="kbds-project-link">
											🏢 <?php echo esc_html( get_the_title( $parent_id ) ); ?>
										</a>
									<?php else : ?>
										<span class="kbds-project-link">🏠 BĐS Độc lập</span>
									<?php endif; ?>
									<?php if ( $code ) : ?>
										<span class="kbds-code-tag"><?php echo esc_html( $code ); ?></span>
									<?php endif; ?>
								</div>

								<h3 class="kbds-card-title">
									<a href="<?php echo esc_url( get_permalink( $lid ) ); ?>"><?php echo esc_html( $item->post_title ); ?></a>
								</h3>

								<div class="kbds-listing-specs">
									<?php if ( $area ) : ?><span>📐 <strong><?php echo esc_html( $area ); ?> m²</strong></span><?php endif; ?>
									<?php if ( $beds ) : ?><span>🛏️ <strong><?php echo esc_html( $beds ); ?> PN</strong></span><?php endif; ?>
									<?php if ( $baths ) : ?><span>🚿 <strong><?php echo esc_html( $baths ); ?> WC</strong></span><?php endif; ?>
									<?php if ( $dir ) : ?><span>🧭 <strong><?php echo esc_html( $dir ); ?></strong></span><?php endif; ?>
								</div>

								<?php if ( $legal ) : ?>
									<div class="kbds-listing-legal">⚖️ Pháp lý: <?php echo esc_html( $legal ); ?></div>
								<?php endif; ?>

								<div class="kbds-card-footer">
									<div class="kbds-price-block">
										<span class="kbds-price-label">Giá chào bán</span>
										<strong class="kbds-price-value kbds-price-red"><?php echo esc_html( $price ?: 'Liên hệ' ); ?></strong>
									</div>
									<a href="<?php echo esc_url( get_permalink( $lid ) ); ?>" class="kbds-btn-card-gold">Xem căn →</a>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * SECTION 4: CHUYÊN TRANG REVIEW DỰ ÁN, QUY HOẠCH HẠ TẦNG & CẨM NANG (PHỄU SEO MÔ HÌNH D)
	 */
	public static function render_section_news( $atts ) {
		$atts = shortcode_atts( array(
			'subtitle' => 'GÓC NHÌN CHUYÊN GIA & THÔNG TIN ĐA CHIỀU',
			'title'    => 'Phân Tích Dự Án, Bản Đồ Quy Hoạch & Thị Trường 24/7',
			'desc'     => 'Cập nhật thông tin quy hoạch hạ tầng chính thống, bài toán dòng tiền và cẩm nang pháp lý dành cho nhà đầu tư.',
			'limit'    => 4,
		), $atts );

		$posts = get_posts( array(
			'post_type'      => 'post',
			'posts_per_page' => (int) $atts['limit'],
			'post_status'    => 'publish',
		) );

		ob_start();
		?>
		<section class="kbds-section kbds-sec-light" id="kbds-section-news">
			<div class="kbds-container">
				<div class="kbds-sec-header">
					<div>
						<span class="kbds-sec-tag"><?php echo esc_html( $atts['subtitle'] ); ?></span>
						<h2 class="kbds-sec-title"><?php echo esc_html( $atts['title'] ); ?></h2>
						<p class="kbds-sec-desc"><?php echo esc_html( $atts['desc'] ); ?></p>
					</div>
					<div class="kbds-news-pills">
						<a href="<?php echo esc_url( home_url( '/review-du-an/' ) ); ?>">Review Dự án</a>
						<a href="<?php echo esc_url( home_url( '/quy-hoach-ha-tang/' ) ); ?>">Quy hoạch & Hạ tầng</a>
						<a href="<?php echo esc_url( home_url( '/thi-truong-tai-chinh/' ) ); ?>">Tin tức Thị trường</a>
						<a href="<?php echo esc_url( home_url( '/cam-nang-phap-ly/' ) ); ?>">Pháp lý BĐS</a>
					</div>
				</div>

				<div class="kbds-grid-4">
					<?php foreach ( $posts as $p ) : ?>
						<?php
						$thumb = get_the_post_thumbnail_url( $p->ID, 'large' );
						$cats  = get_the_category( $p->ID );
						$cat_name = ! empty( $cats ) ? $cats[0]->name : 'Tin tức BĐS';
						?>
						<article class="kbds-card kbds-news-card">
							<div class="kbds-card-media">
								<a href="<?php echo esc_url( get_permalink( $p->ID ) ); ?>">
									<?php if ( $thumb ) : ?>
										<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $p->post_title ); ?>" loading="lazy" />
									<?php else : ?>
										<div class="kbds-img-placeholder">📰 <?php echo esc_html( $cat_name ); ?></div>
									<?php endif; ?>
								</a>
								<span class="kbds-badge-cat"><?php echo esc_html( $cat_name ); ?></span>
							</div>
							<div class="kbds-card-body">
								<div class="kbds-news-date">📅 <?php echo esc_html( get_the_date( 'd/m/Y', $p->ID ) ); ?></div>
								<h3 class="kbds-card-title">
									<a href="<?php echo esc_url( get_permalink( $p->ID ) ); ?>"><?php echo esc_html( $p->post_title ); ?></a>
								</h3>
								<p class="kbds-news-excerpt">
									<?php echo esc_html( wp_trim_words( $p->post_excerpt ?: wp_strip_all_tags( $p->post_content ), 22 ) ); ?>
								</p>
								<a href="<?php echo esc_url( get_permalink( $p->ID ) ); ?>" class="kbds-readmore">Xem thêm →</a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * SECTION 5: SLIDE LOGO ĐỐI TÁC & CHỦ ĐẦU TƯ HÀNG ĐẦU
	 * Tự động lấy dữ liệu từ menu "Dự án BĐS -> Chủ đầu tư" (hỗ trợ cả Ảnh Logo tải lên lẫn Logo SVG tự động)
	 */
	public static function render_section_explorer( $atts ) {
		$atts = shortcode_atts( array(
			'subtitle' => 'ĐỐI TÁC CHIẾN LƯỢC & PHÁT TRIỂN DỰ ÁN',
			'title'    => 'Đối Tác & Chủ Đầu Tư Hàng Đầu',
		), $atts );

		$default_styles = array(
			'vinhomes'        => array( 'sub' => 'VINGROUP',            'color' => '#0B2C4D', 'accent' => '#C59B27' ),
			'masterise-homes' => array( 'sub' => 'MASTERISE GROUP',     'color' => '#8B1E3F', 'accent' => '#D4AF37' ),
			'sun-group'       => array( 'sub' => 'SUN PROPERTY',        'color' => '#B8860B', 'accent' => '#0B2C4D' ),
			'ecopark'         => array( 'sub' => 'GREEN CITY',          'color' => '#1B7A43', 'accent' => '#8BC34A' ),
			'gamuda-land'     => array( 'sub' => 'MALAYSIA',            'color' => '#0F4C81', 'accent' => '#E53935' ),
			'khang-dien'      => array( 'sub' => 'REAL ESTATE',         'color' => '#D96B27', 'accent' => '#0B2C4D' ),
			'nam-long'        => array( 'sub' => 'INTEGRATED TOWNSHIP', 'color' => '#1E5631', 'accent' => '#C59B27' ),
		);

		$terms = get_terms( array(
			'taxonomy'   => 'chu_dau_tu',
			'hide_empty' => false,
		) );

		$developers = array();
		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			foreach ( $terms as $idx => $t ) {
				$logo_url = get_term_meta( $t->term_id, '_kbds_dev_logo_url', true );
				$sub_meta = get_term_meta( $t->term_id, '_kbds_dev_subtitle', true );
				$st       = isset( $default_styles[ $t->slug ] ) ? $default_styles[ $t->slug ] : array(
					'sub'    => 'REAL ESTATE PARTNER',
					'color'  => '#0B2C4D',
					'accent' => '#C59B27',
				);
				$t_link = get_term_link( $t );
				$developers[] = array(
					'name'     => mb_strtoupper( $t->name, 'UTF-8' ),
					'sub'      => $sub_meta ? mb_strtoupper( $sub_meta, 'UTF-8' ) : $st['sub'],
					'logo_url' => $logo_url,
					'color'    => $st['color'],
					'accent'   => $st['accent'],
					'url'      => ! is_wp_error( $t_link ) ? $t_link : get_post_type_archive_link( 'du_an' ),
				);
			}
		}

		ob_start();
		?>
		<section class="kbds-section kbds-sec-ivory" id="kbds-section-explorer">
			<div class="kbds-container">
				<div class="kbds-sec-header-center">
					<span class="kbds-sec-tag"><?php echo esc_html( $atts['subtitle'] ); ?></span>
					<h2 class="kbds-sec-title"><?php echo esc_html( $atts['title'] ); ?></h2>
				</div>

				<!-- Slide Logo Chủ Đầu Tư Chạy Tự Động Mượt Mà -->
				<div class="kbds-logo-slider-wrap">
					<div class="kbds-logo-track">
						<?php
						// Nhân đôi danh sách để tạo hiệu ứng chạy slide vòng lặp vô tận
						$loop_devs = array_merge( $developers, $developers );
						foreach ( $loop_devs as $dev ) :
						?>
							<a href="<?php echo esc_url( $dev['url'] ); ?>" class="kbds-logo-card" title="<?php echo esc_attr( $dev['name'] ); ?>">
								<?php if ( ! empty( $dev['logo_url'] ) ) : ?>
									<img src="<?php echo esc_url( $dev['logo_url'] ); ?>" alt="<?php echo esc_attr( $dev['name'] ); ?>" style="height:54px;width:auto;max-width:175px;object-fit:contain;display:block;" loading="lazy" />
								<?php else : ?>
									<svg viewBox="0 0 220 76" width="185" height="64" xmlns="http://www.w3.org/2000/svg">
										<rect x="8" y="14" width="44" height="48" rx="10" fill="<?php echo esc_attr( $dev['color'] ); ?>" opacity="0.1"/>
										<path d="M20 48 V28 L30 20 L40 28 V48 H33 V36 H27 V48 Z" fill="<?php echo esc_attr( $dev['color'] ); ?>"/>
										<circle cx="30" cy="17" r="3" fill="<?php echo esc_attr( $dev['accent'] ); ?>"/>
										<text x="62" y="38" font-family="'Be Vietnam Pro', sans-serif" font-size="14.5" font-weight="800" fill="<?php echo esc_attr( $dev['color'] ); ?>" letter-spacing="0.4"><?php echo esc_html( $dev['name'] ); ?></text>
										<text x="62" y="54" font-family="'Be Vietnam Pro', sans-serif" font-size="9.5" font-weight="600" fill="#64748B" letter-spacing="1.4"><?php echo esc_html( $dev['sub'] ); ?></text>
									</svg>
								<?php endif; ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * SECTION 6: CÔNG CỤ TÍNH LÃI SUẤT VAY & BẢNG LÃI SUẤT NGÂN HÀNG THAM KHẢO
	 */
	public static function render_section_tools( $atts ) {
		$atts = shortcode_atts( array(
			'subtitle' => 'TIỆN ÍCH TÀI CHÍNH BẤT ĐỘNG SẢN',
			'title'    => 'Công Cụ Tính Khoản Vay & Lãi Suất Mua Nhà Mới Nhất',
		), $atts );

		ob_start();
		?>
		<section class="kbds-section kbds-sec-light" id="kbds-section-tools">
			<div class="kbds-container">
				<div class="kbds-sec-header">
					<div>
						<span class="kbds-sec-tag"><?php echo esc_html( $atts['subtitle'] ); ?></span>
						<h2 class="kbds-sec-title"><?php echo esc_html( $atts['title'] ); ?></h2>
					</div>
				</div>

				<div class="kbds-tools-grid">
					<div class="kbds-tools-col-calc">
						<?php echo do_shortcode( '[kbds_loan_calculator]' ); ?>
					</div>
					<div class="kbds-tools-col-rates">
						<div class="kbds-bank-rates-box">
							<h3>🏦 Lãi Suất Vay Mua Nhà Ưu Đãi Tham Khảo</h3>
							<p>Cập nhật biểu lãi suất ưu đãi năm đầu tại các ngân hàng thương mại lớn:</p>
							<table class="kbds-rates-table">
								<thead>
									<tr>
										<th>Ngân hàng</th>
										<th>LS Ưu đãi</th>
										<th>Tỷ lệ vay</th>
										<th>Thời hạn</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><strong>Vietcombank</strong></td>
										<td class="kbds-rate-highlight">5.5% - 6.2%/năm</td>
										<td>70%</td>
										<td>25 năm</td>
									</tr>
									<tr>
										<td><strong>BIDV</strong></td>
										<td class="kbds-rate-highlight">5.6% - 6.5%/năm</td>
										<td>75%</td>
										<td>30 năm</td>
									</tr>
									<tr>
										<td><strong>Techcombank</strong></td>
										<td class="kbds-rate-highlight">6.3% - 6.8%/năm</td>
										<td>80%</td>
										<td>35 năm</td>
									</tr>
									<tr>
										<td><strong>VPBank / MB</strong></td>
										<td class="kbds-rate-highlight">6.5% - 7.2%/năm</td>
										<td>75%</td>
										<td>25 năm</td>
									</tr>
									<tr>
										<td><strong>Shinhan / Woori</strong></td>
										<td class="kbds-rate-highlight">5.8% - 6.4%/năm</td>
										<td>70%</td>
										<td>25 năm</td>
									</tr>
								</tbody>
							</table>
							<p class="kbds-rate-note">* Lưu ý: Nhiều dự án F1 trên Kênh BĐS được Chủ đầu tư hỗ trợ lãi suất 0% và ân hạn nợ gốc từ 18 – 24 tháng.</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * SECTION 7: FORM ĐĂNG KÝ NHẬN BẢNG GIÁ & KÝ GỬI NHÀ ĐẤT (CRM LEAD CAPTURE)
	 */
	public static function render_section_cta_lead( $atts ) {
		ob_start();
		?>
		<section class="kbds-section kbds-sec-ivory" id="kbds-section-cta">
			<div class="kbds-container">
				<?php echo do_shortcode( '[kbds_lead_form title="📥 Đăng Ký Nhận Trọn Bộ Bảng Giá Gốc CĐT, Giỏ Hàng Cắt Lỗ & Bản Đồ Quy Hoạch" project="Trang Chủ - kenhbatdongsan.vn"]' ); ?>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}

	/**
	 * SECTION 8: CHÂN TRANG (FOOTER) CHUẨN BỐ CỤC INDOCHINE - KENHBATDONGSAN.VN
	 */
	public static function render_section_footer( $atts ) {
		$atts = shortcode_atts( array(
			'company'      => 'CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE',
			'address_hcm'  => 'Trụ sở TP.HCM: Số 45 Thạch Thị Thanh, phường Tân Định, TP Hồ Chí Minh, Việt Nam.',
			'address_hn'   => 'Trụ sở Hà Nội: Tầng 2 tòa nhà Capital Elite 18 Phạm Hùng, Mỹ Đình, Hà Nội.',
			'hotline'      => '0942.655.111',
			'support_web'  => 'kenhbatdongsan.vn',
			'email'        => 'suport@kenhbatdongsan.vn',
			'dkkd'         => '0317401603',
		), $atts );

		$upload_dir = wp_upload_dir();
		$logo_url   = $upload_dir['baseurl'] . '/kbds-brand-logo.svg';

		ob_start();
		?>
		<div class="kbds-footer-main">
			<div class="kbds-container">
				<!-- TẦNG 1: LOGO & 3 CỘT HOTLINE / HỖ TRỢ / CHĂM SÓC KHÁCH HÀNG -->
				<div class="kbds-footer-top">
					<div class="kbds-footer-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( $logo_url ); ?>" alt="KenhBatDongSan.vn" style="height:56px;width:auto;" />
						</a>
					</div>

					<div class="kbds-footer-contacts">
						<div class="kbds-f-contact-item">
							<div class="kbds-f-icon">
								<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1E293B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
							</div>
							<div>
								<span>Hotline</span>
								<strong><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $atts['hotline'] ) ); ?>"><?php echo esc_html( $atts['hotline'] ); ?></a></strong>
							</div>
						</div>

						<div class="kbds-f-contact-item">
							<div class="kbds-f-icon">
								<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1E293B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
							</div>
							<div>
								<span>Hỗ trợ khách hàng</span>
								<strong><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $atts['support_web'] ); ?></a></strong>
							</div>
						</div>

						<div class="kbds-f-contact-item">
							<div class="kbds-f-icon">
								<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1E293B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
							</div>
							<div>
								<span>Chăm sóc khách hàng</span>
								<strong><a href="mailto:<?php echo esc_attr( $atts['email'] ); ?>"><?php echo esc_html( $atts['email'] ); ?></a></strong>
							</div>
						</div>
					</div>
				</div>

				<!-- TẦNG 2: 4 CỘT THÔNG TIN CÔNG TY, HƯỚNG DẪN, QUY ĐỊNH & QUỐC GIA -->
				<div class="kbds-footer-middle">
					<!-- Cột 1: Thông tin Công ty Indochine -->
					<div class="kbds-f-col kbds-f-col-company">
						<h4><?php echo esc_html( $atts['company'] ); ?></h4>
						<div class="kbds-f-info-row">
							<span class="kbds-f-pin">📍</span>
							<p><strong><?php echo esc_html( $atts['address_hcm'] ); ?></strong></p>
						</div>
						<div class="kbds-f-info-row">
							<span class="kbds-f-pin">📍</span>
							<p><strong><?php echo esc_html( $atts['address_hn'] ); ?></strong></p>
						</div>
						<div class="kbds-f-info-row">
							<span class="kbds-f-pin">📞</span>
							<p><strong><?php echo esc_html( $atts['hotline'] ); ?> — <?php echo esc_html( $atts['email'] ); ?></strong></p>
						</div>
					</div>

					<!-- Cột 2: Hướng dẫn -->
					<div class="kbds-f-col">
						<h4>HƯỚNG DẪN</h4>
						<ul class="kbds-f-links">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Về chúng tôi</a></li>
							<li><a href="#kbds-section-cta">Báo giá và hỗ trợ</a></li>
							<li><a href="<?php echo esc_url( home_url( '/cam-nang-phap-ly/' ) ); ?>">Câu hỏi thường gặp</a></li>
							<li><a href="#kbds-section-cta">Góp ý báo lỗi</a></li>
							<li><a href="<?php echo esc_url( home_url( '/sitemap_index.xml' ) ); ?>">Sitemap</a></li>
						</ul>
					</div>

					<!-- Cột 3: Quy định -->
					<div class="kbds-f-col">
						<h4>QUY ĐỊNH</h4>
						<ul class="kbds-f-links">
							<li><a href="<?php echo esc_url( home_url( '/cam-nang-phap-ly/' ) ); ?>">Quy định đăng tin</a></li>
							<li><a href="<?php echo esc_url( home_url( '/cam-nang-phap-ly/' ) ); ?>">Quy chế hoạt động</a></li>
							<li><a href="<?php echo esc_url( home_url( '/cam-nang-phap-ly/' ) ); ?>">Điều khoản thỏa thuận</a></li>
							<li><a href="<?php echo esc_url( home_url( '/chinh-sach-bao-mat/' ) ); ?>">Chính sách bảo mật</a></li>
							<li><a href="#kbds-section-cta">Giải quyết khiếu nại</a></li>
						</ul>
					</div>

					<!-- Cột 4: Quốc gia & Ngôn ngữ -->
					<div class="kbds-f-col">
						<h4>QUỐC GIA & NGÔN NGỮ</h4>
						<div class="kbds-f-lang-select">
							<span>🌐 Việt Nam</span>
							<span>▾</span>
						</div>
					</div>
				</div>

				<!-- TẦNG 3: BẢN QUYỀN & GIẤY ĐKKD -->
				<div class="kbds-footer-bottom">
					<div class="kbds-fb-left">
						<p>Copyright © <?php echo esc_html( date( 'Y' ) ); ?> <strong>kenhbatdongsan.vn</strong></p>
						<p>Đơn vị chủ quản: <strong><?php echo esc_html( $atts['company'] ); ?></strong></p>
						<p>Giấy ĐKKD số: <strong><?php echo esc_html( $atts['dkkd'] ); ?></strong></p>
					</div>

					<div class="kbds-fb-center">
						<p>Hotline hỗ trợ: <strong><?php echo esc_html( $atts['hotline'] ); ?></strong> • CSKH: <strong><?php echo esc_html( $atts['email'] ); ?></strong></p>
						<p>Quy chế, quy định giao dịch có hiệu lực theo quy định pháp luật hiện hành.</p>
						<p>Ghi rõ nguồn "kenhbatdongsan.vn" khi phát hành lại thông tin từ website này.</p>
					</div>

					<div class="kbds-fb-right">
						<div class="kbds-bct-badge">
							<span class="kbds-bct-check">✔</span>
							<div>
								<strong>ĐÃ ĐĂNG KÝ</strong>
								<span>BỘ CÔNG THƯƠNG</span>
							</div>
						</div>
						<div class="kbds-f-socials">
							<a href="#" aria-label="Facebook" title="Facebook">f</a>
							<a href="#" aria-label="YouTube" title="YouTube">▶</a>
							<a href="https://zalo.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $atts['hotline'] ) ); ?>" aria-label="Zalo" title="Zalo">Zalo</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
