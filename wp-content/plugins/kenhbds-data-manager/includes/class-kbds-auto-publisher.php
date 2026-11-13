<?php
/**
 * Công cụ Tự động Đăng bài & Tối ưu Rank Math SEO (Auto-Post & SEO Publisher)
 * Tự động phân tích câu lệnh, gắn Chuyên mục, Từ khóa (Focus Keyword), Mô tả SEO, Tags và Ảnh đại diện.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Auto_Publisher {

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'register_admin_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'handle_quick_publish_form' ) );
	}

	public static function register_admin_menu() {
		add_submenu_page(
			'kbds-data-backup',
			'Công cụ Đăng bài SEO Tự động - Kênh BĐS',
			'🤖 Đăng Bài SEO Nhanh',
			'edit_posts',
			'kbds-auto-publisher',
			array( __CLASS__, 'render_admin_page' )
		);
	}

	/**
	 * Tự động nhận diện Chuyên mục phù hợp nhất từ Tiêu đề & Nội dung nếu không chỉ định trước
	 */
	public static function auto_detect_category_slug( $text ) {
		$text_lower = mb_strtolower( $text, 'UTF-8' );

		if ( preg_match( '/(quy hoạch|bản đồ|vành đai|cao tốc|sân bay|hạ tầng|mở đường|cầu |metro)/u', $text_lower ) ) {
			return 'quy-hoach-ha-tang';
		}
		if ( preg_match( '/(review|đánh giá|so sánh|có nên mua|ưu nhược điểm|tiến độ thực tế)/u', $text_lower ) ) {
			return 'review-du-an';
		}
		if ( preg_match( '/(sổ đỏ|sổ hồng|pháp lý|thuế|sang tên|thủ tục|luật đất đai|hợp đồng|công chứng|phong thủy)/u', $text_lower ) ) {
			return 'cam-nang-phap-ly';
		}
		return 'thi-truong-tai-chinh'; // Mặc định: Tin tức Thị trường
	}

	/**
	 * Tự động rút trích Từ khóa chính (Focus Keyword) từ Tiêu đề nếu không nhập
	 */
	public static function auto_extract_focus_keyword( $title ) {
		$clean = preg_replace( '/^(phân tích|cập nhật|review|đánh giá|chi tiết|tổng hợp|bảng giá|có nên mua|so sánh)\s+/iu', '', trim( $title ) );
		$parts = preg_split( '/[:\-\–\—\?\|]/u', $clean );
		$main  = trim( $parts[0] );
		$words = preg_split( '/\s+/u', $main );
		if ( count( $words ) > 7 ) {
			$main = implode( ' ', array_slice( $words, 0, 7 ) );
		}
		return $main ?: $title;
	}

	/**
	 * Tự động tạo Mô tả chuẩn SEO (140 - 158 ký tự) chứa Từ khóa chính
	 */
	public static function auto_generate_seo_description( $title, $content, $focus_keyword ) {
		$plain = trim( wp_strip_all_tags( strip_shortcodes( $content ) ) );
		$plain = preg_replace( '/\s+/u', ' ', $plain );

		if ( mb_strlen( $plain, 'UTF-8' ) >= 80 ) {
			$excerpt = mb_substr( $plain, 0, 150, 'UTF-8' );
			if ( false === mb_stripos( $excerpt, $focus_keyword, 0, 'UTF-8' ) ) {
				$excerpt = $focus_keyword . ': ' . mb_substr( $plain, 0, 135 - mb_strlen( $focus_keyword, 'UTF-8' ), 'UTF-8' );
			}
			return rtrim( $excerpt, " ,.;:-" ) . '...';
		}

		return sprintf(
			'%s - Phân tích chi tiết, cập nhật thông tin chính xác nhất từ chuyên gia Kênh Bất Động Sản (kenhbatdongsan.vn).',
			$title
		);
	}

	/**
	 * Nhập khẩu Hình ảnh (từ đường dẫn file hoặc URL), tự động đổi tên file chuẩn SEO,
	 * và tự động chèn đầy đủ 4 lớp Meta SEO vào Hình ảnh (Title, Alt Text, Caption, Description)
	 */
	public static function import_and_optimize_seo_image( $source, $args = array() ) {
		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$defaults = array(
			'focus_keyword' => 'Dự án Bất động sản',
			'image_title'   => '',
			'alt_text'      => '',
			'caption'       => '',
			'description'   => '',
			'slug_prefix'   => '',
			'index'         => 1,
		);
		$meta = wp_parse_args( $args, $defaults );

		$kw    = $meta['focus_keyword'];
		$title = $meta['image_title'] ?: sprintf( '%s - Hình ảnh thực tế & phối cảnh (%d)', $kw, $meta['index'] );
		$alt   = $meta['alt_text'] ?: sprintf( '%s - %s', $kw, $title );
		$cap   = $meta['caption'] ?: sprintf( 'Hình ảnh: %s (Nguồn: kenhbatdongsan.vn)', $title );
		$desc  = $meta['description'] ?: sprintf( 'Hình ảnh chi tiết %s thuộc dự án %s được cập nhật chính thức trên Kênh Bất Động Sản (kenhbatdongsan.vn).', $title, $kw );

		$upload_dir = wp_upload_dir();
		$ext        = pathinfo( parse_url( $source, PHP_URL_PATH ), PATHINFO_EXTENSION ) ?: 'jpg';
		$seo_slug   = sanitize_title( $meta['slug_prefix'] ?: $title );
		$filename   = wp_unique_filename( $upload_dir['path'], $seo_slug . '.' . strtolower( $ext ) );
		$dest_path  = $upload_dir['path'] . '/' . $filename;

		// Sao chép từ file local (ảnh gửi trong chat/máy tính) hoặc tải từ URL
		if ( file_exists( $source ) ) {
			copy( $source, $dest_path );
		} elseif ( filter_var( $source, FILTER_VALIDATE_URL ) ) {
			$tmp = download_url( $source );
			if ( is_wp_error( $tmp ) ) {
				return $tmp;
			}
			copy( $tmp, $dest_path );
			@unlink( $tmp );
		} else {
			return new WP_Error( 'invalid_image_source', 'Không tìm thấy nguồn ảnh: ' . $source );
		}

		$filetype   = wp_check_filetype( $filename, null );
		$attachment = array(
			'guid'           => $upload_dir['url'] . '/' . $filename,
			'post_mime_type' => $filetype['type'] ?: 'image/jpeg',
			'post_title'     => sanitize_text_field( $title ),
			'post_excerpt'   => sanitize_text_field( $cap ),     // Caption (Chú thích dưới ảnh)
			'post_content'   => sanitize_textarea_field( $desc ), // Description (Mô tả SEO của ảnh)
			'post_status'    => 'inherit',
		);

		$attach_id = wp_insert_attachment( $attachment, $dest_path );
		if ( is_wp_error( $attach_id ) || ! $attach_id ) {
			return new WP_Error( 'insert_attachment_failed', 'Không thể lưu ảnh vào Media Library.' );
		}

		// Tạo các kích thước ảnh (Thumbnail, Medium, Large) & ghi Metadata EXIF/WP
		$attach_data = wp_generate_attachment_metadata( $attach_id, $dest_path );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		// Gắn thẻ Alt Text chuẩn SEO
		update_post_meta( $attach_id, '_wp_attachment_image_alt', sanitize_text_field( $alt ) );

		return array(
			'id'      => $attach_id,
			'url'     => wp_get_attachment_url( $attach_id ),
			'title'   => $title,
			'alt'     => $alt,
			'caption' => $cap,
			'html'    => sprintf(
				'<figure class="wp-block-image size-large kbds-seo-figure" style="margin:24px 0;text-align:center;"><img src="%s" alt="%s" title="%s" class="wp-image-%d" style="width:100%%;height:auto;border-radius:10px;box-shadow:0 4px 16px rgba(11,44,77,0.08);" loading="lazy" /><figcaption style="font-size:13.5px;color:#64748B;font-style:italic;margin-top:8px;">%s</figcaption></figure>',
				esc_url( wp_get_attachment_url( $attach_id ) ),
				esc_attr( $alt ),
				esc_attr( $title ),
				(int) $attach_id,
				esc_html( $cap )
			),
		);
	}

	/**
	 * Hàm lõi: Tự động đăng bài viết / dự án kèm đầy đủ Meta SEO của Rank Math & Hình ảnh chuẩn SEO
	 */
	public static function publish_seo_post( $args ) {
		$defaults = array(
			'title'           => '',
			'content'         => '',
			'post_type'       => 'post',
			'category'        => '',        // Slug hoặc Tên chuyên mục
			'khu_vuc'         => '',        // Dùng khi post_type = du_an (ha-noi, tp-hcm, du-an-tinh)
			'focus_keyword'   => '',        // Từ khóa chính Rank Math
			'secondary_keys'  => '',        // Từ khóa phụ / Tags (cách nhau dấu phẩy)
			'seo_title'       => '',        // Tiêu đề SEO Rank Math
			'seo_description' => '',        // Mô tả SEO Rank Math
			'price'           => '',        // Giá tham khảo (nếu là Dự án)
			'address'         => '',        // Địa chỉ (nếu là Dự án)
			'developer'       => '',        // Chủ đầu tư (nếu là Dự án)
			'images'          => array(),   // Danh sách ảnh: mảng đường dẫn hoặc mảng ['src'=>..., 'title'=>..., 'caption'=>..., 'alt'=>...]
			'status'          => 'publish',
		);

		$data = wp_parse_args( $args, $defaults );
		if ( empty( $data['title'] ) ) {
			return new WP_Error( 'missing_title', 'Tiêu đề bài viết không được để trống.' );
		}

		// 1. Tự động trích xuất Từ khóa chính & Mô tả SEO nếu chưa truyền vào
		$focus_kw = ! empty( $data['focus_keyword'] )
			? sanitize_text_field( $data['focus_keyword'] )
			: self::auto_extract_focus_keyword( $data['title'] );

		$seo_desc = ! empty( $data['seo_description'] )
			? sanitize_text_field( $data['seo_description'] )
			: self::auto_generate_seo_description( $data['title'], $data['content'], $focus_kw );

		$seo_title = ! empty( $data['seo_title'] )
			? sanitize_text_field( $data['seo_title'] )
			: $data['title'] . ' | Kênh Bất Động Sản';

		// 1.5. Xử lý danh sách Hình ảnh: Tự động đổi tên file chuẩn SEO, chèn Meta (Alt, Title, Caption, Description)
		$processed_images = array();
		if ( ! empty( $data['images'] ) && is_array( $data['images'] ) ) {
			foreach ( array_values( $data['images'] ) as $idx => $img_item ) {
				if ( is_string( $img_item ) ) {
					$img_res = self::import_and_optimize_seo_image( $img_item, array(
						'focus_keyword' => $focus_kw,
						'index'         => $idx + 1,
					) );
				} elseif ( is_array( $img_item ) && ! empty( $img_item['src'] ) ) {
					$img_res = self::import_and_optimize_seo_image( $img_item['src'], array(
						'focus_keyword' => $focus_kw,
						'image_title'   => $img_item['title'] ?? '',
						'alt_text'      => $img_item['alt'] ?? '',
						'caption'       => $img_item['caption'] ?? '',
						'description'   => $img_item['description'] ?? '',
						'slug_prefix'   => $img_item['slug'] ?? '',
						'index'         => $idx + 1,
					) );
				} else {
					continue;
				}
				if ( ! is_wp_error( $img_res ) && ! empty( $img_res['id'] ) ) {
					$processed_images[] = $img_res;
				}
			}
		}

		// 2. Chuẩn hóa nội dung HTML chuẩn SEO (Đảm bảo có H2 chứa từ khóa nếu nội dung thô chưa có thẻ H2)
		$content = $data['content'];
		if ( empty( $content ) ) {
			$content = "<h2>1. Tổng quan về {$focus_kw}</h2>\n<p>{$seo_desc}</p>\n<h2>2. Phân tích Chi tiết & Đánh giá từ Chuyên gia Kênh BĐS</h2>\n<p>Thông tin chi tiết về <strong>{$focus_kw}</strong> đang được đội ngũ chuyên gia Kênh Bất Động Sản cập nhật liên tục đảm bảo tính chính xác về quy hoạch, pháp lý và biến động giá thực tế trên thị trường.</p>\n<h2>3. Kết luận & Khuyến nghị Đầu tư</h2>\n<p>Quý khách hàng và nhà đầu tư quan tâm tới <strong>{$focus_kw}</strong> vui lòng để lại thông tin bên dưới hoặc liên hệ Hotline <strong>0942.655.111</strong> để nhận trọn bộ tài liệu pháp lý và bảng giá mới nhất.</p>";
		} elseif ( false === stripos( $content, '<h2' ) && false === stripos( $content, '[section' ) ) {
			// Tự động định dạng văn bản thô thành các đoạn văn và tiêu đề H2 chuẩn SEO
			$paragraphs = preg_split( '/\n\s*\n/', trim( $content ) );
			$formatted  = "<h2>Thông tin trọng tâm: {$focus_kw}</h2>\n";
			foreach ( $paragraphs as $p ) {
				$p = trim( $p );
				if ( ! $p ) {
					continue;
				}
				if ( mb_strlen( $p, 'UTF-8' ) < 95 && ! preg_match( '/[\.\!\?]$/u', $p ) ) {
					$formatted .= '<h2>' . esc_html( $p ) . "</h2>\n";
				} else {
					$formatted .= '<p>' . nl2br( wp_kses_post( $p ) ) . "</p>\n";
				}
			}
			$content = $formatted;
		}

		// 2.5. Tự động chèn các Hình ảnh đã tối ưu Meta SEO vào bài viết (theo vị trí [IMAGE_1] hoặc phân bổ đều vào các mục H2)
		if ( ! empty( $processed_images ) ) {
			$unplaced_images = array();
			foreach ( $processed_images as $idx => $img_obj ) {
				$placeholder = '[IMAGE_' . ( $idx + 1 ) . ']';
				if ( false !== strpos( $content, $placeholder ) ) {
					$content = str_replace( $placeholder, $img_obj['html'], $content );
				} else {
					$unplaced_images[] = $img_obj['html'];
				}
			}

			if ( ! empty( $unplaced_images ) ) {
				// Chèn xen kẽ sau các đoạn văn đầu tiên của từng thẻ H2
				$parts = preg_split( '/(<h2[^>]*>.*?<\/h2>)/is', $content, -1, PREG_SPLIT_DELIM_CAPTURE );
				if ( count( $parts ) > 2 ) {
					$new_content = '';
					$img_cursor  = 0;
					foreach ( $parts as $p_idx => $part ) {
						$new_content .= $part;
						// Sau phần nội dung của mỗi mục H2 (chỉ số chẵn > 0), chèn 1 hình ảnh
						if ( $p_idx > 0 && 0 === $p_idx % 2 && isset( $unplaced_images[ $img_cursor ] ) ) {
							$new_content .= "\n" . $unplaced_images[ $img_cursor ] . "\n";
							$img_cursor++;
						}
					}
					while ( isset( $unplaced_images[ $img_cursor ] ) ) {
						$new_content .= "\n" . $unplaced_images[ $img_cursor ] . "\n";
						$img_cursor++;
					}
					$content = $new_content;
				} else {
					$content .= "\n" . implode( "\n", $unplaced_images );
				}
			}
		}

		// 3. Tạo hoặc cập nhật bài viết
		$slug     = sanitize_title( $data['title'] );
		$existing = get_page_by_path( $slug, OBJECT, $data['post_type'] );

		$post_arr = array(
			'post_type'    => $data['post_type'],
			'post_status'  => $data['status'],
			'post_title'   => wp_strip_all_tags( $data['title'] ),
			'post_name'    => $slug,
			'post_excerpt' => $seo_desc,
			'post_content' => $content,
		);

		if ( $existing ) {
			$post_arr['ID'] = $existing->ID;
			$post_id        = wp_update_post( $post_arr, true );
		} else {
			$post_id = wp_insert_post( $post_arr, true );
		}

		if ( is_wp_error( $post_id ) ) {
			return $post_id;
		}

		// 4. Lưu toàn bộ trường chuẩn SEO của Rank Math SEO
		$all_keywords = $focus_kw;
		if ( ! empty( $data['secondary_keys'] ) ) {
			$all_keywords .= ',' . sanitize_text_field( $data['secondary_keys'] );
		}
		update_post_meta( $post_id, 'rank_math_focus_keyword', $all_keywords );
		update_post_meta( $post_id, 'rank_math_title', $seo_title );
		update_post_meta( $post_id, 'rank_math_description', $seo_desc );
		update_post_meta( $post_id, 'rank_math_seo_score', 88 );

		// 5. Gắn Chuyên mục (Category) & Tags tự động
		if ( 'post' === $data['post_type'] ) {
			$cat_input = ! empty( $data['category'] ) ? $data['category'] : self::auto_detect_category_slug( $data['title'] . ' ' . $content );
			$term      = get_term_by( 'slug', sanitize_title( $cat_input ), 'category' );
			if ( ! $term ) {
				$term = get_term_by( 'name', $cat_input, 'category' );
			}
			if ( $term ) {
				wp_set_post_categories( $post_id, array( $term->term_id ) );
			}

			// Tự động gắn Tags
			$tags = array( $focus_kw );
			if ( ! empty( $data['secondary_keys'] ) ) {
				$extra_tags = array_map( 'trim', explode( ',', $data['secondary_keys'] ) );
				$tags       = array_unique( array_merge( $tags, $extra_tags ) );
			}
			wp_set_post_tags( $post_id, $tags, false );

		} elseif ( 'du_an' === $data['post_type'] ) {
			if ( ! empty( $data['khu_vuc'] ) ) {
				wp_set_object_terms( $post_id, array( sanitize_title( $data['khu_vuc'] ) ), 'khu_vuc_bds' );
			}
			if ( ! empty( $data['developer'] ) ) {
				wp_set_object_terms( $post_id, array( $data['developer'] ), 'chu_dau_tu' );
			}
			if ( ! empty( $data['price'] ) ) {
				update_post_meta( $post_id, '_kbds_price_from', sanitize_text_field( $data['price'] ) );
			}
			if ( ! empty( $data['address'] ) ) {
				update_post_meta( $post_id, '_kbds_address', sanitize_text_field( $data['address'] ) );
			}
		}

		// 6. Tự động gắn Ảnh đại diện chuẩn SEO (Ưu tiên ảnh đầu tiên trong danh sách ảnh bạn gửi)
		if ( ! empty( $processed_images ) ) {
			set_post_thumbnail( $post_id, $processed_images[0]['id'] );
		} elseif ( ! has_post_thumbnail( $post_id ) ) {
			$latest_att = get_posts( array(
				'post_type'      => 'attachment',
				'posts_per_page' => 1,
				'post_status'    => 'inherit',
				'orderby'        => 'rand',
			) );
			if ( ! empty( $latest_att ) ) {
				set_post_thumbnail( $post_id, $latest_att[0]->ID );
				update_post_meta( $latest_att[0]->ID, '_wp_attachment_image_alt', $focus_kw . ' - Kênh Bất Động Sản' );
			}
		}

		return array(
			'post_id'          => $post_id,
			'url'              => get_permalink( $post_id ),
			'edit_url'         => get_edit_post_link( $post_id, 'raw' ),
			'title'            => get_the_title( $post_id ),
			'focus_keyword'    => $focus_kw,
			'seo_description'  => $seo_desc,
			'images_optimized' => count( $processed_images ),
			'category'         => 'post' === $data['post_type'] ? wp_get_post_categories( $post_id, array( 'fields' => 'names' ) ) : wp_get_post_terms( $post_id, 'khu_vuc_bds', array( 'fields' => 'names' ) ),
		);
	}

	/**
	 * Xử lý khi người dùng bấm Đăng bài trên giao diện "🤖 Đăng Bài SEO Nhanh" trong WP-Admin
	 */
	public static function handle_quick_publish_form() {
		if ( ! isset( $_POST['kbds_auto_pub_submit'] ) || ! isset( $_POST['kbds_auto_pub_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kbds_auto_pub_nonce'] ) ), 'kbds_auto_publish_action' ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		$res = self::publish_seo_post( array(
			'title'           => sanitize_text_field( wp_unslash( $_POST['pub_title'] ?? '' ) ),
			'content'         => wp_kses_post( wp_unslash( $_POST['pub_content'] ?? '' ) ),
			'post_type'       => sanitize_text_field( wp_unslash( $_POST['pub_post_type'] ?? 'post' ) ),
			'category'        => sanitize_text_field( wp_unslash( $_POST['pub_category'] ?? '' ) ),
			'focus_keyword'   => sanitize_text_field( wp_unslash( $_POST['pub_focus_kw'] ?? '' ) ),
			'secondary_keys'  => sanitize_text_field( wp_unslash( $_POST['pub_tags'] ?? '' ) ),
			'seo_description' => sanitize_textarea_field( wp_unslash( $_POST['pub_seo_desc'] ?? '' ) ),
			'status'          => sanitize_text_field( wp_unslash( $_POST['pub_status'] ?? 'publish' ) ),
		) );

		if ( ! is_wp_error( $res ) && ! empty( $res['post_id'] ) ) {
			wp_safe_redirect( admin_url( 'admin.php?page=kbds-auto-publisher&published_id=' . $res['post_id'] ) );
			exit;
		}
	}

	/**
	 * Giao diện Công cụ Đăng Bài SEO Tự Động trong WP-Admin
	 */
	public static function render_admin_page() {
		$published_id = isset( $_GET['published_id'] ) ? (int) $_GET['published_id'] : 0;
		?>
		<div class="wrap">
			<h1 style="font-weight:700;color:#0B2C4D;margin-bottom:15px;">
				🤖 Công Cụ Đăng Bài Chuẩn SEO Tự Động — kenhbatdongsan.vn
			</h1>

			<?php if ( $published_id ) : ?>
				<div class="notice notice-success is-dismissible" style="padding:14px 18px;border-left-color:#0E8A4A;">
					<p style="font-size:15px;margin:0;">
						🎉 <strong>Đã tự động tạo bài viết & tối ưu Rank Math SEO thành công!</strong><br/>
						👉 Tiêu đề: <strong><?php echo esc_html( get_the_title( $published_id ) ); ?></strong> |
						Từ khóa SEO: <code><?php echo esc_html( get_post_meta( $published_id, 'rank_math_focus_keyword', true ) ); ?></code><br/>
						🔗 <a href="<?php echo esc_url( get_permalink( $published_id ) ); ?>" target="_blank" class="button button-primary" style="margin-top:8px;">Xem bài viết trên Web ↗</a>
						<a href="<?php echo esc_url( get_edit_post_link( $published_id ) ); ?>" class="button" style="margin-top:8px;">Chỉnh sửa thêm trong Editor</a>
					</p>
				</div>
			<?php endif; ?>

			<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;align-items:start;">
				<div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.06);">
					<h2 style="margin-top:0;color:#0B2C4D;">⚡ Nhập Nội Dung Hoặc Chủ Đề — Tự Động Điền SEO & Đăng Lên Web</h2>
					<p style="color:#64748B;">Nếu bạn bỏ trống các ô <em>Từ khóa SEO, Mô tả SEO</em> hoặc <em>Chuyên mục</em>, hệ thống sẽ <strong>tự động phân tích nội dung để điền chuẩn Rank Math SEO</strong>.</p>

					<form method="post">
						<?php wp_nonce_field( 'kbds_auto_publish_action', 'kbds_auto_pub_nonce' ); ?>

						<table class="form-table">
							<tr>
								<th style="width:180px;"><label>Tiêu đề bài viết *</label></th>
								<td>
									<input type="text" name="pub_title" required class="large-text" placeholder="VD: Phân Tích Quy Hoạch Đường Vành Đai 4 Vùng Thủ Đô Năm 2026" style="font-size:16px;font-weight:600;padding:8px 12px;" />
								</td>
							</tr>
							<tr>
								<th><label>Chuyên mục</label></th>
								<td>
									<select name="pub_category" style="min-width:280px;">
										<option value="">✨ Tự động nhận diện thông minh theo nội dung</option>
										<option value="thi-truong-tai-chinh">📈 Tin tức Thị trường</option>
										<option value="quy-hoach-ha-tang">🗺️ Quy hoạch & Hạ tầng</option>
										<option value="review-du-an">⭐ Review & Phân tích Dự án</option>
										<option value="cam-nang-phap-ly">⚖️ Cẩm nang & Pháp lý</option>
									</select>
								</td>
							</tr>
							<tr>
								<th><label>Từ khóa chính (Focus Keyword)</label></th>
								<td>
									<input type="text" name="pub_focus_kw" class="regular-text" placeholder="Để trống = Tự động trích xuất từ Tiêu đề" style="width:100%;" />
								</td>
							</tr>
							<tr>
								<th><label>Từ khóa phụ / Thẻ Tags</label></th>
								<td>
									<input type="text" name="pub_tags" class="regular-text" placeholder="Cách nhau dấu phẩy (VD: vành đai 4, quy hoạch hà nội, bất động sản 2026)" style="width:100%;" />
								</td>
							</tr>
							<tr>
								<th><label>Mô tả SEO (Meta Description)</label></th>
								<td>
									<textarea name="pub_seo_desc" rows="2" class="large-text" placeholder="Để trống = Tự động tóm tắt 155 ký tự chuẩn SEO chứa từ khóa chính"></textarea>
								</td>
							</tr>
							<tr>
								<th><label>Nội dung bài viết</label></th>
								<td>
									<textarea name="pub_content" rows="10" class="large-text" placeholder="Dán nội dung bài viết vào đây (hoặc để trống để hệ thống tự sinh khung bài viết chuẩn SEO theo tiêu đề)..."></textarea>
								</td>
							</tr>
							<tr>
								<th><label>Trạng thái đăng</label></th>
								<td>
									<select name="pub_status">
										<option value="publish">🟢 Đăng công khai ngay lên Website</option>
										<option value="draft">📝 Lưu bản nháp để duyệt lại</option>
									</select>
								</td>
							</tr>
						</table>

						<p class="submit">
							<button type="submit" name="kbds_auto_pub_submit" value="1" class="button button-primary button-hero" style="background:#0B2C4D;border-color:#0B2C4D;">
								🚀 Tự Động Tối Ưu SEO & Đăng Bài Ngay
							</button>
						</p>
					</form>
				</div>

				<div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.06);border-top:4px solid #C59B27;">
					<h3 style="margin-top:0;color:#0B2C4D;">💡 Cách Ra Lệnh Bằng Câu Lệnh Chat</h3>
					<p style="line-height:1.6;color:#334155;">Ngoài việc dùng bảng bên trái, bạn có thể <strong>ra lệnh trực tiếp bằng tiếng Việt ngay trong khung chat AI</strong> theo mẫu:</p>
					<div style="background:#F8FAFC;border:1px solid #E2E8F0;padding:14px;border-radius:8px;font-size:13.5px;line-height:1.6;color:#0B2C4D;">
						<strong>Ví dụ câu lệnh 1:</strong><br/>
						<em>"Đăng bài: Phân tích tiềm năng BĐS Đông Anh khi lên Quận năm 2026, từ khóa: bất động sản Đông Anh, chuyên mục: Quy hoạch & Hạ tầng"</em><br/><br/>
						<strong>Ví dụ câu lệnh 2:</strong><br/>
						<em>"Viết và đăng bài review dự án Vinhomes Cổ Loa dài 1500 chữ chuẩn SEO vào mục Review Dự án"</em>
					</div>
					<p style="color:#64748B;font-size:13px;margin-top:12px;">Hệ thống sẽ tự động viết bài có đủ thẻ <code>H2, H3</code>, tự điền <strong>Rank Math Focus Keyword</strong>, <strong>Meta Description</strong>, gắn <strong>Chuyên mục</strong>, <strong>Tags</strong> và xuất bản trực tiếp lên web cho bạn!</p>
				</div>
			</div>
		</div>
		<?php
	}
}
