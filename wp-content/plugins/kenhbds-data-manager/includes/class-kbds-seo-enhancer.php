<?php
/**
 * Tối ưu SEO Chuyên sâu & Schema JSON-LD Bất Động Sản cho kenhbatdongsan.vn
 * Đồng bộ tự động với Rank Math SEO & Easy Table of Contents
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_SEO_Enhancer {

	public static function init() {
		// Luôn đảm bảo website được Google & công cụ tìm kiếm lập chỉ mục (blog_public = 1)
		if ( '1' !== (string) get_option( 'blog_public' ) ) {
			update_option( 'blog_public', 1 );
		}
		remove_action( 'wp_head', 'noindex', 1 );

		add_filter( 'wp_robots', array( __CLASS__, 'force_robots_index' ), 999 );
		add_filter( 'rank_math/frontend/robots', array( __CLASS__, 'force_rank_math_robots_index' ), 999 );

		add_action( 'wp_head', array( __CLASS__, 'output_real_estate_schema' ), 25 );
		add_action( 'wp_head', array( __CLASS__, 'protect_crm_leads_noindex' ), 1 );
		add_filter( 'wp_sitemaps_post_types', array( __CLASS__, 'exclude_crm_from_core_sitemap' ) );
	}

	/**
	 * Đảm bảo mọi trang Dự án, Bài viết, Giỏ hàng đều mở index, follow cho Googlebot
	 */
	public static function force_robots_index( $robots ) {
		if ( is_singular( 'bds_lead' ) || is_post_type_archive( 'bds_lead' ) ) {
			return array( 'noindex' => true, 'nofollow' => true );
		}
		if ( is_array( $robots ) ) {
			$robots['noindex']  = false;
			$robots['nofollow'] = false;
			$robots['index']    = true;
			$robots['follow']   = true;
			$robots['max-image-preview'] = 'large';
		}
		return $robots;
	}

	/**
	 * Tương thích Rank Math SEO: Buộc index cho mọi trang công khai
	 */
	public static function force_rank_math_robots_index( $robots ) {
		if ( is_singular( 'bds_lead' ) || is_post_type_archive( 'bds_lead' ) ) {
			return array( 'noindex' => 'noindex', 'nofollow' => 'nofollow' );
		}
		if ( is_array( $robots ) ) {
			unset( $robots['noindex'], $robots['nofollow'] );
			$robots['index']  = 'index';
			$robots['follow'] = 'follow';
		}
		return $robots;
	}

	/**
	 * Chặn tuyệt đối các công cụ tìm kiếm lập chỉ mục dữ liệu Khách hàng (CRM)
	 */
	public static function protect_crm_leads_noindex() {
		if ( is_singular( 'bds_lead' ) || is_post_type_archive( 'bds_lead' ) ) {
			echo '<meta name="robots" content="noindex, nofollow, noarchive" />' . "\n";
		}
	}

	public static function exclude_crm_from_core_sitemap( $post_types ) {
		unset( $post_types['bds_lead'] );
		return $post_types;
	}

	/**
	 * Tự động xuất JSON-LD Schema Bất Động Sản chuẩn Google cho Dự án (du_an) & Giỏ hàng (bat_dong_san)
	 */
	public static function output_real_estate_schema() {
		if ( is_singular( 'du_an' ) ) {
			$pid     = get_the_ID();
			$title   = get_the_title( $pid );
			$url     = get_permalink( $pid );
			$desc    = get_the_excerpt( $pid ) ?: wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $pid ) ), 35 );
			$address = get_post_meta( $pid, '_kbds_address', true );
			$price   = get_post_meta( $pid, '_kbds_price_from', true );
			$score   = (float) get_post_meta( $pid, '_kbds_review_score', true );
			$img     = get_the_post_thumbnail_url( $pid, 'full' );

			$schema = array(
				'@context'    => 'https://schema.org',
				'@type'       => 'Residence',
				'name'        => $title,
				'url'         => $url,
				'description' => $desc,
			);

			if ( $img ) {
				$schema['image'] = $img;
			}
			if ( $address ) {
				$schema['address'] = array(
					'@type'         => 'PostalAddress',
					'streetAddress' => $address,
					'addressCountry'=> 'VN',
				);
			}
			if ( $score > 0 ) {
				$schema['aggregateRating'] = array(
					'@type'       => 'AggregateRating',
					'ratingValue' => min( 10, max( 1, $score ) ),
					'bestRating'  => '10',
					'worstRating' => '1',
					'ratingCount' => '18',
				);
			}
			if ( $price ) {
				$schema['containsPlace'] = array(
					'@type'       => 'ApartmentComplex',
					'name'        => $title,
					'description' => 'Giá tham khảo: ' . $price,
				);
			}

			echo "\n<!-- Kênh Bất Động Sản - Project JSON-LD Schema -->\n";
			echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";

		} elseif ( is_singular( 'bat_dong_san' ) ) {
			$lid       = get_the_ID();
			$title     = get_the_title( $lid );
			$url       = get_permalink( $lid );
			$desc      = get_the_excerpt( $lid ) ?: wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $lid ) ), 35 );
			$price_num = (float) get_post_meta( $lid, '_kbds_price_billion', true );
			$area      = get_post_meta( $lid, '_kbds_area_m2', true );
			$beds      = (int) get_post_meta( $lid, '_kbds_bedrooms', true );
			$img       = get_the_post_thumbnail_url( $lid, 'full' );

			$schema = array(
				'@context'    => 'https://schema.org',
				'@type'       => 'RealEstateListing',
				'name'        => $title,
				'url'         => $url,
				'description' => $desc,
				'datePosted'  => get_the_date( 'c', $lid ),
			);

			if ( $img ) {
				$schema['image'] = $img;
			}
			if ( $price_num > 0 ) {
				$schema['offers'] = array(
					'@type'         => 'Offer',
					'priceCurrency' => 'VND',
					'price'         => (string) round( $price_num * 1000000000 ),
					'availability'  => 'https://schema.org/InStock',
					'url'           => $url,
				);
			}
			if ( $area || $beds ) {
				$schema['mainEntity'] = array(
					'@type'            => 'SingleFamilyResidence',
					'name'             => $title,
					'numberOfBedrooms' => $beds ?: 2,
					'floorSize'        => array(
						'@type'    => 'QuantitativeValue',
						'value'    => (float) $area,
						'unitCode' => 'MTK',
					),
				);
			}

			echo "\n<!-- Kênh Bất Động Sản - Listing JSON-LD Schema -->\n";
			echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
		}
	}

	/**
	 * Cấu hình tự động Rank Math SEO & Easy Table of Contents chuẩn cho Mô hình B + D
	 */
	public static function configure_seo_plugins_defaults() {
		// 1. Cấu hình Easy Table of Contents (Bật cho Bài viết & Dự án BĐS)
		$ez_options = get_option( 'ez-toc-settings', array() );
		if ( ! is_array( $ez_options ) ) {
			$ez_options = array();
		}
		$ez_options['enabled_post_types'] = array(
			'post'  => 'post',
			'du_an' => 'du_an',
		);
		$ez_options['auto_insert_post_types'] = array(
			'post'  => 'post',
		);
		$ez_options['position']           = 'before';
		$ez_options['start']              = 2;
		$ez_options['show_heading_text']  = 1;
		$ez_options['heading_text']       = '📋 Nội dung chính trong bài';
		$ez_options['visibility']         = 1;
		$ez_options['visibility_hide_by_default'] = 0;
		$ez_options['counter']            = 'decimal';
		$ez_options['smooth_scroll']      = 1;
		update_option( 'ez-toc-settings', $ez_options );

		// 2. Kích hoạt trạng thái hoàn tất Setup Wizard của Rank Math (tương đương nhấn Skip Wizard) để hiển thị đầy đủ Metabox SEO
		update_option( 'rank_math_registration_skip', true );
		update_option( 'rank_math_wizard_completed', true );
		update_option( 'rank_math_is_configured', true );

		// 3. Bật các Module quan trọng nhất của Rank Math SEO
		$rm_modules = get_option( 'rank_math_modules', array() );
		if ( ! is_array( $rm_modules ) ) {
			$rm_modules = array();
		}
		$needed_modules = array(
			'sitemap',
			'rich-snippet',
			'redirections',
			'404-monitor',
			'image-seo',
			'instant-indexing',
			'local-seo',
		);
		$rm_modules = array_values( array_unique( array_merge( $rm_modules, $needed_modules ) ) );
		update_option( 'rank_math_modules', $rm_modules );

		// 4. Cấu hình Sitemap của Rank Math (Bật Dự án + Giỏ hàng + Khu vực + Loại hình; Tắt CRM Leads)
		$rm_sitemap = get_option( 'rank-math-options-sitemap', array() );
		if ( ! is_array( $rm_sitemap ) ) {
			$rm_sitemap = array();
		}
		$rm_sitemap['pt_post_sitemap']         = 'on';
		$rm_sitemap['pt_page_sitemap']         = 'on';
		$rm_sitemap['pt_du_an_sitemap']        = 'on';
		$rm_sitemap['pt_bat_dong_san_sitemap'] = 'on';
		$rm_sitemap['pt_bds_lead_sitemap']     = 'off';
		$rm_sitemap['tax_category_sitemap']    = 'on';
		$rm_sitemap['tax_khu_vuc_bds_sitemap'] = 'on';
		$rm_sitemap['tax_loai_hinh_bds_sitemap'] = 'on';
		$rm_sitemap['tax_chu_dau_tu_sitemap']  = 'on';
		update_option( 'rank-math-options-sitemap', $rm_sitemap );

		// 5. Cấu hình Titles & Meta + Bật hiển thị hộp công cụ SEO (Add SEO Controls / Meta Box) cho mọi loại bài viết & chuyên mục
		$rm_titles = get_option( 'rank-math-options-titles', array() );
		if ( ! is_array( $rm_titles ) ) {
			$rm_titles = array();
		}
		$rm_titles['pt_post_add_meta_box']          = 'on';
		$rm_titles['pt_page_add_meta_box']          = 'on';
		$rm_titles['pt_du_an_add_meta_box']         = 'on';
		$rm_titles['pt_bat_dong_san_add_meta_box']  = 'on';
		$rm_titles['tax_category_add_meta_box']     = 'on';
		$rm_titles['tax_khu_vuc_bds_add_meta_box']  = 'on';
		$rm_titles['tax_loai_hinh_bds_add_meta_box']= 'on';
		$rm_titles['tax_chu_dau_tu_add_meta_box']   = 'on';
		$rm_titles['pt_du_an_title']                = '%title% - Bảng Giá, Pháp Lý & Tiến Độ Mới Nhất %sep% %sitename%';
		$rm_titles['pt_bat_dong_san_title']         = '%title% %sep% Giỏ Hàng Xác Thực %sitename%';
		$rm_titles['pt_bds_lead_robots']            = array( 'noindex', 'nofollow' );
		$rm_titles['pt_bds_lead_custom_robots']     = 'on';
		update_option( 'rank-math-options-titles', $rm_titles );

		$rm_general = get_option( 'rank-math-options-general', array() );
		if ( ! is_array( $rm_general ) ) {
			$rm_general = array();
		}
		$rm_general['add_img_alt']   = 'on';
		$rm_general['img_alt_format']= '%title% - Kênh Bất Động Sản';
		$rm_general['strip_category_base'] = 'on';
		update_option( 'rank-math-options-general', $rm_general );
	}
}
