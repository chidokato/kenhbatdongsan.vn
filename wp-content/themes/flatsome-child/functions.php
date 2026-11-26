<?php
/**
 * Flatsome Child Theme Functions - Kênh Bất Động Sản (kenhbatdongsan.vn)
 *
 * Lưu ý quan trọng: Toàn bộ cấu trúc dữ liệu (Dự án, Giỏ hàng, Khách hàng, Backup, Sections)
 * được tách độc lập tại plugin `kenhbds-data-manager` để đảm bảo an toàn dữ liệu 100%
 * khi nâng cấp hoặc thay đổi giao diện.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Nạp Google Font 'Be Vietnam Pro' & 'Playfair Display' (Phong cách 1: Luxury & Heritage) & CSS Child Theme
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style(
		'kbds-google-fonts',
		'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;0,900;1,600;1,700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'flatsome-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'flatsome-main', 'kbds-google-fonts' ),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);
}, 30 );

/**
 * 2. Kích hoạt Trình kéo thả UX Builder của Flatsome cho Dự án BĐS (`du_an`) & Giỏ hàng (`bat_dong_san`)
 */
add_action( 'init', function() {
	if ( function_exists( 'add_ux_builder_post_type' ) ) {
		add_ux_builder_post_type( 'du_an' );
		add_ux_builder_post_type( 'bat_dong_san' );
	}
}, 20 );

/**
 * Sử dụng trình soạn thảo chuẩn của Flatsome để nút "Edit with UX Builder" luôn hiển thị rõ ràng
 */
add_filter( 'use_block_editor_for_post_type', function( $use_block_editor, $post_type ) {
	if ( in_array( $post_type, array( 'du_an', 'bat_dong_san', 'page', 'blocks' ), true ) ) {
		return false;
	}
	return $use_block_editor;
}, 10, 2 );

/**
 * 3. Hỗ trợ Bộ lọc Tìm kiếm Dự án & Giỏ hàng từ Hero Search Box
 */
add_action( 'pre_get_posts', function( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_search() ) {
		$query->set( 'post_type', array( 'du_an', 'bat_dong_san', 'post' ) );
	}
} );

/**
 * 4. Tối ưu Giao diện Bài Viết (Single Post) Chuẩn SEO Bất Động Sản Cao Cấp:
 * - Tắt triệt để khung bình luận rác (Comments)
 * - Ẩn avatar tác giả trống / ngày đăng cũ
 * - Tự động thêm Lưới bài viết liên quan (Related Posts) & Form tư vấn BĐS ở cuối bài
 */
add_filter( 'comments_open', function( $open, $post_id ) {
	return false;
}, 20, 2 );

add_filter( 'pings_open', function( $open, $post_id ) {
	return false;
}, 20, 2 );

add_action( 'flatsome_after_blog_post', function() {
	if ( ! is_single() || 'post' !== get_post_type() ) {
		return;
	}

	$current_id = get_the_ID();
	$categories = wp_get_post_categories( $current_id );

	$related_args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post__not_in'   => array( $current_id ),
		'category__in'   => $categories,
		'post_status'    => 'publish',
	);

	$related = get_posts( $related_args );
	if ( empty( $related ) ) {
		return;
	}
	?>
	<div class="kbds-related-posts-section" style="margin-top:40px;padding-top:32px;border-top:2px solid #E2E8F0;">
		<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
			<h3 style="color:#0B2C4D;font-size:22px;font-weight:800;margin:0;">
				📰 Bài Viết Phân Tích Cùng Chuyên Mục
			</h3>
			<span style="font-size:13px;color:#64748B;font-weight:600;">Xem thêm để nắm bắt thị trường</span>
		</div>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px;">
			<?php foreach ( $related as $rel_post ) : ?>
				<?php
				$thumb = get_the_post_thumbnail_url( $rel_post->ID, 'medium_large' ) ?: get_the_post_thumbnail_url( $rel_post->ID, 'full' );
				$cat_list = get_the_category( $rel_post->ID );
				$cat_badge = ! empty( $cat_list ) ? $cat_list[0]->name : 'Tin tức BĐS';
				?>
				<div class="kbds-card" style="margin:0;">
					<div class="kbds-card-media" style="height:170px;">
						<a href="<?php echo esc_url( get_permalink( $rel_post->ID ) ); ?>">
							<?php if ( $thumb ) : ?>
								<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $rel_post->post_title ); ?>" style="width:100%;height:100%;object-fit:cover;" />
							<?php else : ?>
								<div style="width:100%;height:100%;background:#0B2C4D;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:13px;">Kênh Bất Động Sản</div>
							<?php endif; ?>
						</a>
						<span style="position:absolute;top:10px;left:10px;background:#C59B27;color:#fff;padding:3px 9px;border-radius:4px;font-size:11px;font-weight:700;">
							<?php echo esc_html( $cat_badge ); ?>
						</span>
					</div>
					<div style="padding:16px;display:flex;flex-direction:column;flex:1;">
						<h4 style="margin:0 0 10px;font-size:15px;line-height:1.45;font-weight:700;">
							<a href="<?php echo esc_url( get_permalink( $rel_post->ID ) ); ?>" style="color:#0B2C4D;text-decoration:none;">
								<?php echo esc_html( $rel_post->post_title ); ?>
							</a>
						</h4>
						<p style="font-size:13px;color:#475569;line-height:1.55;margin:0 0 14px;flex:1;">
							<?php echo esc_html( wp_trim_words( get_the_excerpt( $rel_post->ID ) ?: wp_strip_all_tags( $rel_post->post_content ), 16 ) ); ?>
						</p>
						<a href="<?php echo esc_url( get_permalink( $rel_post->ID ) ); ?>" style="color:#C59B27;font-weight:700;font-size:13px;text-decoration:none;">
							Xem chi tiết →
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
} );


/**
 * 5. Nút Bấm Liên Hệ Nổi Chạy Theo Sườn Website (Hotline & Zalo 0942.655.111)
 * - Tự động hiển thị cố định ở sườn góc dưới bên trái màn hình trên toàn bộ website
 * - Hiệu ứng sóng lan tỏa (wave pulse) và rung chuông thu hút sự chú ý của khách hàng
 * - Nhấp 1 chạm để gọi ngay hoặc mở trực tiếp app Zalo
 */
add_action( 'wp_footer', function() {
	$hotline_raw     = '0942655111';
	$hotline_display = '0942.655.111';
	$zalo_url        = 'https://zalo.me/' . $hotline_raw;
	?>
	<div class="kbds-floating-contact" id="kbds-floating-contact">
		<!-- Nút Hotline -->
		<a href="tel:<?php echo esc_attr( $hotline_raw ); ?>" class="kbds-contact-btn kbds-btn-phone" title="Gọi Hotline: <?php echo esc_attr( $hotline_display ); ?>" aria-label="Gọi Hotline <?php echo esc_attr( $hotline_display ); ?>">
			<div class="kbds-btn-circle">
				<span class="kbds-btn-wave"></span>
				<span class="kbds-btn-wave kbds-wave-delay"></span>
				<div class="kbds-btn-icon kbds-phone-ring">
					<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#FFFFFF" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
						<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
					</svg>
				</div>
			</div>
		</a>

		<!-- Nút Zalo -->
		<a href="<?php echo esc_url( $zalo_url ); ?>" target="_blank" rel="noopener noreferrer" class="kbds-contact-btn kbds-btn-zalo" title="Chat Zalo: <?php echo esc_attr( $hotline_display ); ?>" aria-label="Chat Zalo <?php echo esc_attr( $hotline_display ); ?>">
			<div class="kbds-btn-circle">
				<span class="kbds-btn-wave"></span>
				<span class="kbds-btn-wave kbds-wave-delay"></span>
				<div class="kbds-btn-icon">
					<svg viewBox="0 0 48 48" width="28" height="28" fill="#FFFFFF" xmlns="http://www.w3.org/2000/svg">
						<path d="M24 4C12.95 4 4 12.95 4 24c0 3.73 1.02 7.22 2.8 10.22L4 44l10.15-2.67C17.04 43.08 20.41 44 24 44c11.05 0 20-8.95 20-20S35.05 4 24 4zm-9.35 24.3l4.74-6.31h-4.6v-2.34h7.94v2.09l-4.75 6.31h4.89v2.34H14.65v-2.09zm10.42 2.09c-.83 0-1.54-.26-2.12-.78s-.88-1.25-.88-2.19c0-.98.31-1.74.92-2.28s1.46-.81 2.54-.81h1.33v-.49c0-.62-.16-1.07-.49-1.35-.33-.28-.84-.42-1.53-.42-.62 0-1.12.11-1.51.34-.39.22-.68.53-.88.92l-1.92-1.28c.38-.67.92-1.2 1.62-1.61.7-.4 1.61-.6 2.72-.6 1.48 0 2.58.35 3.3 1.05s1.08 1.74 1.08 3.12v5.77h-2.31v-1.44c-.66 1.03-1.68 1.55-3.07 1.55zm.6-2.04c.64 0 1.17-.22 1.58-.65.41-.43.62-1.01.62-1.74v-.75h-1.32c-.52 0-.91.11-1.18.34-.27.23-.4.57-.4 1.01 0 .42.13.76.38 1.01.26.25.64.38 1.13.38zm7.53 1.94v-11.8h2.36v11.8h-2.36zm6.34.1c-1.21 0-2.21-.43-3-1.28s-1.19-1.97-1.19-3.35c0-1.38.4-2.5 1.19-3.35s1.79-1.28 3-1.28 2.21.43 3 1.28 1.19 1.97 1.19 3.35c0 1.38-.4 2.5-1.19 3.35s-1.79-1.28-3-1.28zm0-2.13c.6 0 1.08-.23 1.44-.7s.54-1.15.54-2.04c0-.9-.18-1.58-.54-2.04s-.84-.7-1.44-.7-1.08.23-1.44.7-.54 1.14-.54 2.04c0 .89.18 1.57.54 2.04s.84.7 1.44.7z"/>
					</svg>
				</div>
			</div>
		</a>
	</div>
	<?php
}, 100 );

/**
 * 6. Loại bỏ tiền tố "Lưu trữ danh mục:", "Chuyên mục:", "Category:" trên toàn bộ trang danh mục
 */
add_filter( 'get_the_archive_title', function ( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}
	return $title;
} );

add_filter( 'gettext', function( $translation, $text, $domain ) {
	if ( 'Category Archives: %s' === $text || 'Category: %s' === $text ) {
		return '%s';
	}
	if ( 'Tag Archives: %s' === $text || 'Tag: %s' === $text ) {
		return '%s';
	}
	return $translation;
}, 20, 3 );

/**
 * 7. Tối ưu ScrollSpy & Cố định Menu phụ Subnav chính xác 100% dưới Header (Desktop & Mobile)
 */
add_action( 'wp_footer', function() {
	if ( ! is_singular( 'du_an' ) ) {
		return;
	}
	?>
	<script id="kbds-subnav-scrollspy">
	document.addEventListener('DOMContentLoaded', function() {
		var subnav = document.querySelector('.kbds-project-subnav');
		if (!subnav) return;
		var links = subnav.querySelectorAll('a[href^="#"]');
		if (!links.length) return;

		// Đo chính xác vị trí đáy Header để triệt tiêu 100% khoảng trống (Zero Gap) trên mọi màn hình
		function syncSubnavTop() {
			var stuckHeader = document.querySelector('.header-wrapper.stuck')
						   || document.querySelector('.header.sticky.stuck')
						   || document.querySelector('#header.stuck');

			var adminBar = document.getElementById('wpadminbar');
			var adminBarH = 0;
			if (adminBar && window.getComputedStyle(adminBar).position === 'fixed') {
				adminBarH = adminBar.offsetHeight || 0;
			}

			var headerH = 0;
			if (stuckHeader) {
				var headerPos = window.getComputedStyle(stuckHeader).position;
				if (headerPos === 'fixed' || headerPos === 'sticky') {
					headerH = stuckHeader.offsetHeight || 0;
				}
			}

			var totalTop = adminBarH + headerH;
			subnav.style.top = totalTop + 'px';
			document.documentElement.style.setProperty('--kbds-subnav-top', totalTop + 'px');

			var subnavH = subnav.offsetHeight || 42;
			var totalOffset = totalTop + subnavH + 8;
			document.documentElement.style.setProperty('--kbds-scroll-offset', totalOffset + 'px');
		}

		window.addEventListener('scroll', syncSubnavTop, { passive: true });
		window.addEventListener('resize', syncSubnavTop);
		syncSubnavTop();
		setTimeout(syncSubnavTop, 200);
		setTimeout(syncSubnavTop, 800);

		// Cuộn mượt với độ lệch (offset) chính xác dưới Header & Subnav cố định
		links.forEach(function(link) {
			link.addEventListener('click', function(e) {
				var targetId = this.getAttribute('href');
				if (targetId === '#' || targetId === '') return;
				var target = document.querySelector(targetId);
				if (target) {
					e.preventDefault();
					syncSubnavTop();
					var headerOffset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--kbds-scroll-offset')) || (window.innerWidth <= 849 ? 115 : 125);
					var elementPosition = target.getBoundingClientRect().top;
					var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
					window.scrollTo({
						top: offsetPosition,
						behavior: 'smooth'
					});
					links.forEach(function(l) { l.classList.remove('active'); });
					link.classList.add('active');
					if (history.pushState) {
						history.pushState(null, null, targetId);
					}
				}
			});
		});

		// ScrollSpy: Tự động đánh dấu mục đang xem khi cuộn trang và căn chỉnh menu mobile
		var sections = [];
		links.forEach(function(link) {
			var targetId = link.getAttribute('href');
			if (targetId && targetId.indexOf('#') === 0 && targetId.length > 1) {
				var sec = document.querySelector(targetId);
				if (sec) {
					sections.push({ el: sec, link: link });
				}
			}
		});

		if (sections.length) {
			window.addEventListener('scroll', function() {
				var offset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--kbds-scroll-offset')) || (window.innerWidth <= 849 ? 120 : 130);
				var scrollPos = window.pageYOffset + offset + 20;
				var current = null;
				for (var i = 0; i < sections.length; i++) {
					var top = sections[i].el.offsetTop;
					var height = sections[i].el.offsetHeight;
					if (scrollPos >= top && scrollPos < top + height) {
						current = sections[i].link;
						break;
					}
				}
				if (current) {
					links.forEach(function(l) { l.classList.remove('active'); });
					current.classList.add('active');
					if (window.innerWidth <= 768 && current.scrollIntoView) {
						current.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
					}
				}
			}, { passive: true });
		}
	});
	</script>
	<?php
}, 99 );

/**
 * 8. Cấu hình hiển thị 3 bài / hàng chuẩn Grid Card cho toàn bộ Chuyên mục & Lưu trữ bài viết
 */
add_filter( 'theme_mod_blog_style', function( $val ) {
	return '3-col';
} );
add_filter( 'theme_mod_blog_style_archive', function( $val ) {
	return '3-col';
} );
add_filter( 'theme_mod_blog_style_type', function( $val ) {
	return 'row';
} );
add_filter( 'theme_mod_blog_badge', function( $val ) {
	return 0; // Tắt khối lịch ngày tháng to đè lên ảnh
} );
add_filter( 'theme_mod_blog_show_excerpt', function( $val ) {
	return 1;
} );

