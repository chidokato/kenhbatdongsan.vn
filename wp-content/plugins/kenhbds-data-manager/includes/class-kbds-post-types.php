<?php
/**
 * Quản lý Cấu trúc Dữ liệu Bất Động Sản (Mô hình B + D)
 * - Custom Post Types: Dự án (du_an), Giỏ hàng BĐS (bat_dong_san), Khách hàng/Lead (bds_lead)
 * - Custom Taxonomies: Khu vực, Loại hình, Chủ đầu tư, Trạng thái
 * - Custom Meta Boxes & Admin Filters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KBDS_Post_Types {

	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 6 );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'save_post', array( __CLASS__, 'save_meta_boxes' ), 10, 2 );

		// Cột quản trị thông minh & Bộ lọc nhanh trong Admin
		add_filter( 'manage_du_an_posts_columns', array( __CLASS__, 'project_columns' ) );
		add_action( 'manage_du_an_posts_custom_column', array( __CLASS__, 'project_column_content' ), 10, 2 );

		add_filter( 'manage_bat_dong_san_posts_columns', array( __CLASS__, 'listing_columns' ) );
		add_action( 'manage_bat_dong_san_posts_custom_column', array( __CLASS__, 'listing_column_content' ), 10, 2 );

		add_filter( 'manage_bds_lead_posts_columns', array( __CLASS__, 'lead_columns' ) );
		add_action( 'manage_bds_lead_posts_custom_column', array( __CLASS__, 'lead_column_content' ), 10, 2 );

		add_action( 'restrict_manage_posts', array( __CLASS__, 'admin_taxonomy_filters' ) );
		add_action( 'pre_get_posts', array( __CLASS__, 'filter_leads_in_admin' ) );

		// Trường Upload Logo cho Chủ đầu tư (`chu_dau_tu`)
		add_action( 'chu_dau_tu_add_form_fields', array( __CLASS__, 'add_developer_logo_field' ) );
		add_action( 'chu_dau_tu_edit_form_fields', array( __CLASS__, 'edit_developer_logo_field' ), 10, 2 );
		add_action( 'created_chu_dau_tu', array( __CLASS__, 'save_developer_logo_field' ) );
		add_action( 'edited_chu_dau_tu', array( __CLASS__, 'save_developer_logo_field' ) );
		add_filter( 'manage_edit-chu_dau_tu_columns', array( __CLASS__, 'developer_tax_columns' ) );
		add_filter( 'manage_chu_dau_tu_custom_column', array( __CLASS__, 'developer_tax_column_content' ), 10, 3 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_media_for_developer_tax' ) );

		// REST field `kbds_meta`: cho phép đồng bộ meta Dự án / Giỏ hàng từ Localhost lên Live qua API
		add_action( 'rest_api_init', array( __CLASS__, 'register_rest_meta_field' ) );
	}

	/**
	 * Đăng ký REST field `kbds_meta` (đọc/ghi các meta `_kbds_*` và SEO Rank Math)
	 */
	public static function register_rest_meta_field() {
		foreach ( array( 'du_an', 'bat_dong_san', 'post', 'page' ) as $pt ) {
			register_rest_field( $pt, 'kbds_meta', array(
				'get_callback'    => function ( $obj ) {
					if ( ! current_user_can( 'edit_post', $obj['id'] ) ) {
						return null;
					}
					$out = array();
					foreach ( get_post_meta( $obj['id'] ) as $k => $v ) {
						if ( self::is_syncable_meta_key( $k ) ) {
							$out[ $k ] = maybe_unserialize( $v[0] );
						}
					}
					return $out;
				},
				'update_callback' => function ( $value, $post ) {
					if ( ! is_array( $value ) || ! current_user_can( 'edit_post', $post->ID ) ) {
						return;
					}
					foreach ( $value as $k => $v ) {
						if ( self::is_syncable_meta_key( $k ) ) {
							if ( is_array( $v ) ) {
								update_post_meta( $post->ID, sanitize_key( $k ), $v );
							} else {
								update_post_meta( $post->ID, sanitize_key( $k ), wp_kses_post( (string) $v ) );
							}
						}
					}
				},
				'schema'          => array( 'type' => 'object', 'context' => array( 'edit' ) ),
			) );
		}
	}

	private static function is_syncable_meta_key( $key ) {
		return 0 === strpos( $key, '_kbds_' ) || 0 === strpos( $key, 'rank_math_' );
	}

	/**
	 * Đăng ký Custom Post Types
	 */
	public static function register_post_types() {
		// 1. DỰ ÁN BĐS (Mô hình B - Project Portal)
		register_post_type( 'du_an', array(
			'labels' => array(
				'name'               => 'Dự án BĐS',
				'singular_name'      => 'Dự án',
				'menu_name'          => 'Dự án BĐS',
				'add_new'            => 'Thêm Dự án mới',
				'add_new_item'       => 'Thêm Hồ sơ Dự án mới',
				'edit_item'          => 'Chỉnh sửa Dự án',
				'new_item'           => 'Dự án mới',
				'view_item'          => 'Xem Dự án',
				'search_items'       => 'Tìm kiếm Dự án',
				'not_found'          => 'Chưa có dự án nào',
			),
			'public'              => true,
			'has_archive'         => true,
			'rewrite'             => array( 'slug' => 'du-an', 'with_front' => false ),
			'menu_icon'           => 'dashicons-building',
			'menu_position'       => 5,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
			'show_in_rest'        => true,
		) );

		// 2. GIỎ HÀNG CHỌN LỌC / KÝ GỬI (Mô hình D - Verified Listings)
		register_post_type( 'bat_dong_san', array(
			'labels' => array(
				'name'               => 'Giỏ hàng BĐS',
				'singular_name'      => 'Sản phẩm BĐS',
				'menu_name'          => 'Giỏ hàng BĐS',
				'add_new'            => 'Thêm Sản phẩm',
				'add_new_item'       => 'Thêm Sản phẩm vào Giỏ hàng',
				'edit_item'          => 'Chỉnh sửa Sản phẩm BĐS',
				'new_item'           => 'Sản phẩm mới',
				'view_item'          => 'Xem Sản phẩm',
				'search_items'       => 'Tìm trong Giỏ hàng',
				'not_found'          => 'Chưa có sản phẩm nào trong giỏ hàng',
			),
			'public'              => true,
			'has_archive'         => true,
			'rewrite'             => array( 'slug' => 'mua-ban', 'with_front' => false ),
			'menu_icon'           => 'dashicons-admin-home',
			'menu_position'       => 6,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
			'show_in_rest'        => true,
		) );

		// 3. QUẢN LÝ KHÁCH HÀNG / LEADS (CRM nội bộ chống thất thoát khách)
		register_post_type( 'bds_lead', array(
			'labels' => array(
				'name'               => 'Khách hàng (Leads)',
				'singular_name'      => 'Khách hàng',
				'menu_name'          => 'Khách hàng (CRM)',
				'add_new'            => 'Thêm Khách hàng',
				'add_new_item'       => 'Thêm thông tin Khách hàng',
				'edit_item'          => 'Chi tiết Khách hàng',
				'search_items'       => 'Tìm SĐT / Tên khách hàng',
				'not_found'          => 'Chưa có dữ liệu khách hàng',
			),
			'public'              => false,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-groups',
			'menu_position'       => 7,
			'supports'            => array( 'title' ),
		) );
	}

	/**
	 * Đăng ký Taxonomies dùng chung & riêng cho Dự án và Giỏ hàng
	 */
	public static function register_taxonomies() {
		// 1. Khu vực địa lý (Dùng cho cả Dự án & Giỏ hàng)
		register_taxonomy( 'khu_vuc_bds', array( 'du_an', 'bat_dong_san' ), array(
			'labels' => array(
				'name'          => 'Khu vực / Tỉnh thành',
				'singular_name' => 'Khu vực',
				'menu_name'     => 'Khu vực',
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'khu-vuc', 'with_front' => false ),
		) );

		// 2. Loại hình BĐS (Căn hộ, Biệt thự, Đất nền, Nghỉ dưỡng...)
		register_taxonomy( 'loai_hinh_bds', array( 'du_an', 'bat_dong_san' ), array(
			'labels' => array(
				'name'          => 'Loại hình BĐS',
				'singular_name' => 'Loại hình',
				'menu_name'     => 'Loại hình BĐS',
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'loai-hinh', 'with_front' => false ),
		) );

		// 3. Trạng thái Dự án (Đang mở bán, Sắp mở bán, Đã bàn giao)
		register_taxonomy( 'trang_thai_du_an', array( 'du_an' ), array(
			'labels' => array(
				'name'          => 'Trạng thái Dự án',
				'singular_name' => 'Trạng thái',
				'menu_name'     => 'Trạng thái',
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'trang-thai-du-an', 'with_front' => false ),
		) );

		// 4. Chủ đầu tư
		register_taxonomy( 'chu_dau_tu', array( 'du_an' ), array(
			'labels' => array(
				'name'          => 'Chủ đầu tư',
				'singular_name' => 'Chủ đầu tư',
				'menu_name'     => 'Chủ đầu tư',
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'chu-dau-tu', 'with_front' => false ),
		) );

		// 5. Loại giao dịch cho Giỏ hàng (Bán mới CĐT, Chuyển nhượng, Cho thuê)
		register_taxonomy( 'loai_giao_dich', array( 'bat_dong_san' ), array(
			'labels' => array(
				'name'          => 'Loại giao dịch',
				'singular_name' => 'Giao dịch',
				'menu_name'     => 'Loại giao dịch',
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'giao-dich', 'with_front' => false ),
		) );
	}

	/**
	 * Khởi tạo dữ liệu Danh mục chuẩn cho Mô hình B + D khi kích hoạt
	 */
	public static function seed_default_terms() {
		self::register_post_types();
		self::register_taxonomies();

		// 1. Chuyên mục Bài viết (Categories - Phễu SEO Mô hình D)
		$post_categories = array(
			'Review & Phân tích Dự án' => array(
				'slug' => 'review-du-an',
				'desc' => 'Đánh giá khách quan ưu nhược điểm, so sánh và phân tích chuyên sâu các dự án bất động sản.',
			),
			'Quy hoạch & Hạ tầng' => array(
				'slug' => 'quy-hoach-ha-tang',
				'desc' => 'Bản đồ quy hoạch sử dụng đất, thông tin tiến độ hạ tầng giao thông trọng điểm toàn quốc.',
			),
			'Tin tức Thị trường' => array(
				'slug' => 'thi-truong-tai-chinh',
				'desc' => 'Toàn cảnh chuyển động thị trường BĐS, biến động giá và bảng lãi suất vay mua nhà ngân hàng.',
			),
			'Cẩm nang & Pháp lý' => array(
				'slug' => 'cam-nang-phap-ly',
				'desc' => 'Kiến thức pháp lý nhà đất, thủ tục sang tên sổ đỏ, tính thuế phí, kinh nghiệm đầu tư & phong thủy.',
			),
		);

		foreach ( $post_categories as $name => $info ) {
			if ( ! term_exists( $info['slug'], 'category' ) ) {
				wp_insert_term( $name, 'category', array(
					'slug'        => $info['slug'],
					'description' => $info['desc'],
				) );
			}
		}

		// 2. Loại hình BĐS
		$loai_hinh = array(
			'Căn hộ chung cư'           => 'can-ho-chung-cu',
			'Khu đô thị & Biệt thự'     => 'khu-do-thi-biet-thu',
			'BĐS Nghỉ dưỡng'            => 'bds-nghi-duong',
		);
		foreach ( $loai_hinh as $name => $slug ) {
			if ( ! term_exists( $slug, 'loai_hinh_bds' ) ) {
				wp_insert_term( $name, 'loai_hinh_bds', array( 'slug' => $slug ) );
			}
		}

		// 3. Trạng thái Dự án
		$trang_thai = array(
			'Đang mở bán'  => 'dang-mo-ban',
			'Sắp mở bán'   => 'sap-mo-ban',
			'Đã bàn giao'  => 'da-ban-giao',
		);
		foreach ( $trang_thai as $name => $slug ) {
			if ( ! term_exists( $slug, 'trang_thai_du_an' ) ) {
				wp_insert_term( $name, 'trang_thai_du_an', array( 'slug' => $slug ) );
			}
		}

		// 4. Khu vực trọng điểm
		$khu_vuc = array(
			'TP. Hồ Chí Minh' => 'tp-hcm',
			'Hà Nội'          => 'ha-noi',
			'Bình Dương'      => 'binh-duong',
			'Đồng Nai'        => 'dong-nai',
			'Long An'         => 'long-an',
			'Hải Phòng'       => 'hai-phong',
			'Quảng Ninh'      => 'quang-ninh',
			'Đà Nẵng'         => 'da-nang',
			'Khánh Hòa'       => 'khanh-hoa',
		);
		foreach ( $khu_vuc as $name => $slug ) {
			if ( ! term_exists( $slug, 'khu_vuc_bds' ) ) {
				wp_insert_term( $name, 'khu_vuc_bds', array( 'slug' => $slug ) );
			}
		}

		// 5. Loại giao dịch
		$giao_dich = array(
			'Chuyển nhượng Giá tốt'    => 'chuyen-nhuong',
			'Bất động sản Cho thuê'    => 'cho-thue',
		);
		foreach ( $giao_dich as $name => $slug ) {
			if ( ! term_exists( $slug, 'loai_giao_dich' ) ) {
				wp_insert_term( $name, 'loai_giao_dich', array( 'slug' => $slug ) );
			}
		}

		// 6. Chủ đầu tư tiêu biểu
		$cdt = array(
			'Vinhomes'        => 'vinhomes',
			'Masterise Homes' => 'masterise-homes',
			'Sun Group'       => 'sun-group',
			'Ecopark'         => 'ecopark',
			'Nam Long'        => 'nam-long',
			'Khang Điền'      => 'khang-dien',
			'Gamuda Land'     => 'gamuda-land',
		);
		foreach ( $cdt as $name => $slug ) {
			if ( ! term_exists( $slug, 'chu_dau_tu' ) ) {
				wp_insert_term( $name, 'chu_dau_tu', array( 'slug' => $slug ) );
			}
		}
	}

	/**
	 * Đăng ký Meta Boxes cho Dự án, Giỏ hàng và Khách hàng
	 */
	public static function add_meta_boxes() {
		add_meta_box(
			'kbds_project_details',
			'Thông số Hồ sơ Dự án (Chuẩn hóa Dữ liệu Mô hình B)',
			array( __CLASS__, 'render_project_meta_box' ),
			'du_an',
			'normal',
			'high'
		);

		add_meta_box(
			'kbds_listing_details',
			'Thông tin Chi tiết Sản phẩm BĐS (Giỏ hàng Xác thực)',
			array( __CLASS__, 'render_listing_meta_box' ),
			'bat_dong_san',
			'normal',
			'high'
		);

		add_meta_box(
			'kbds_lead_details',
			'Thông tin Khách hàng & Trạng thái Chăm sóc (CRM)',
			array( __CLASS__, 'render_lead_meta_box' ),
			'bds_lead',
			'normal',
			'high'
		);
	}

	/**
	 * Giao diện nhập dữ liệu Dự án
	 */
	public static function render_project_meta_box( $post ) {
		wp_nonce_field( 'kbds_save_meta', 'kbds_meta_nonce' );
		$fields = array(
			'_kbds_project_code'      => array( 'label' => 'Mã dự án (VD: DA-001)', 'type' => 'text', 'placeholder' => 'DA-001' ),
			'_kbds_price_from'        => array( 'label' => 'Giá bán tham khảo (Hiển thị)', 'type' => 'text', 'placeholder' => 'Từ 55 triệu/m² (hoặc Từ 3.2 tỷ/căn)' ),
			'_kbds_price_min_num'     => array( 'label' => 'Đơn giá thấp nhất (Triệu/m² - dùng để lọc/sắp xếp)', 'type' => 'number', 'placeholder' => '55' ),
			'_kbds_address'           => array( 'label' => 'Vị trí / Địa chỉ chính xác', 'type' => 'text', 'placeholder' => 'Phường Long Bình, TP. Thủ Đức, TP.HCM' ),
			'_kbds_total_area'        => array( 'label' => 'Quy mô diện tích', 'type' => 'text', 'placeholder' => '271 ha (Mật độ xây dựng 22.5%)' ),
			'_kbds_scale'             => array( 'label' => 'Quy mô sản phẩm', 'type' => 'text', 'placeholder' => '71 tòa căn hộ, 1.350 biệt thự & shophouse' ),
			'_kbds_legal_status'      => array( 'label' => 'Pháp lý hiện tại', 'type' => 'text', 'placeholder' => 'Đã có GPXD, Quy hoạch 1/500, Sổ hồng lâu dài' ),
			'_kbds_handover_time'     => array( 'label' => 'Thời gian bàn giao dự kiến', 'type' => 'text', 'placeholder' => 'Quý IV/2026' ),
			'_kbds_bank_support'      => array( 'label' => 'Ngân hàng bảo lãnh & Ưu đãi vay', 'type' => 'text', 'placeholder' => 'Vietcombank, Techcombank - Hỗ trợ vay 70%, LS 0% 24 tháng' ),
			'_kbds_brochure_url'      => array( 'label' => 'Link tải Trọn bộ Tài liệu / Bảng giá (PDF/Drive)', 'type' => 'url', 'placeholder' => 'https://...' ),
			'_kbds_review_score'      => array( 'label' => 'Điểm Đánh giá của Kênh BĐS (Thang 10)', 'type' => 'text', 'placeholder' => '9.2' ),
			'_kbds_pros_cons'         => array( 'label' => 'Tóm tắt Điểm mạnh / Lưu ý đầu tư (Mỗi ý 1 dòng)', 'type' => 'textarea', 'placeholder' => '+ Vị trí kết nối trực tiếp Vành Đai 3\n+ Pháp lý hoàn chỉnh, chủ đầu tư uy tín\n- Giá bán cao hơn mặt bằng khu vực khoảng 10%' ),
		);
		self::render_fields_table( $post->ID, $fields );
		echo '<p style="background:#eef6ff;padding:10px 14px;border-radius:4px;margin-top:12px;">💡 <strong>Mẹo sử dụng Shortcode trong bài viết/Dự án:</strong> Chèn <code>[kbds_project_overview]</code> để hiển thị bảng thông số dự án, <code>[kbds_project_listings]</code> để hiển thị các căn đang bán của dự án này, <code>[kbds_loan_calculator]</code> để chèn bảng tính lãi vay, và <code>[kbds_lead_form]</code> để chèn form thu thập SĐT khách hàng.</p>';
	}

	/**
	 * Giao diện nhập dữ liệu Giỏ hàng BĐS
	 */
	public static function render_listing_meta_box( $post ) {
		wp_nonce_field( 'kbds_save_meta', 'kbds_meta_nonce' );
		$projects = get_posts( array(
			'post_type'      => 'du_an',
			'posts_per_page' => -1,
			'post_status'    => array( 'publish', 'draft' ),
			'orderby'        => 'title',
			'order'          => 'ASC',
		) );
		$project_Id = get_post_meta( $post->ID, '_kbds_parent_project_id', true );
		$verified   = get_post_meta( $post->ID, '_kbds_is_verified', true );
		?>
		<table class="form-table">
			<tr>
				<th><label for="_kbds_parent_project_id">Thuộc Dự án BĐS</label></th>
				<td>
					<select name="_kbds_parent_project_id" id="_kbds_parent_project_id" style="min-width:320px;">
						<option value="0">-- BĐS Độc lập / Không thuộc dự án --</option>
						<?php foreach ( $projects as $proj ) : ?>
							<option value="<?php echo esc_attr( $proj->ID ); ?>" <?php selected( $project_Id, $proj->ID ); ?>>
								<?php echo esc_html( $proj->post_title ); ?> (ID: <?php echo esc_html( $proj->ID ); ?>)
							</option>
						<?php endforeach; ?>
					</select>
					<p class="description">Liên kết sản phẩm này với Dự án để tự động hiển thị trong phần "Giỏ hàng Dự án".</p>
				</td>
			</tr>
			<tr>
				<th><label for="_kbds_is_verified">Trạng thái Xác thực</label></th>
				<td>
					<label>
						<input type="checkbox" name="_kbds_is_verified" id="_kbds_is_verified" value="1" <?php checked( $verified, '1' ); ?> />
						<strong>Đã xác thực (Hình thật - Giá thật - Pháp lý chuẩn)</strong>
					</label>
				</td>
			</tr>
		</table>
		<?php
		$fields = array(
			'_kbds_listing_code'  => array( 'label' => 'Mã sản phẩm / Mã căn', 'type' => 'text', 'placeholder' => 'GH-S205-1208' ),
			'_kbds_listing_price' => array( 'label' => 'Giá bán / Cho thuê (Hiển thị)', 'type' => 'text', 'placeholder' => '4.35 tỷ (Bao thuế phí)' ),
			'_kbds_price_billion' => array( 'label' => 'Giá trị quy đổi (Tỷ VNĐ - Dùng để lọc)', 'type' => 'text', 'placeholder' => '4.35' ),
			'_kbds_area_m2'       => array( 'label' => 'Diện tích (m²)', 'type' => 'text', 'placeholder' => '75.5' ),
			'_kbds_bedrooms'      => array( 'label' => 'Số phòng ngủ (PN)', 'type' => 'number', 'placeholder' => '2' ),
			'_kbds_bathrooms'     => array( 'label' => 'Số WC', 'type' => 'number', 'placeholder' => '2' ),
			'_kbds_direction'     => array( 'label' => 'Hướng ban công / Hướng cửa', 'type' => 'text', 'placeholder' => 'Đông Nam (Mát mẻ, view công viên)' ),
			'_kbds_listing_legal' => array( 'label' => 'Pháp lý sản phẩm', 'type' => 'text', 'placeholder' => 'Sổ hồng sẵn sàng giao dịch' ),
			'_kbds_contact_phone' => array( 'label' => 'SĐT Chuyên viên phụ trách', 'type' => 'text', 'placeholder' => '0909.xxx.xxx' ),
		);
		self::render_fields_table( $post->ID, $fields );
	}

	/**
	 * Giao diện quản lý Khách hàng (CRM Lead)
	 */
	public static function render_lead_meta_box( $post ) {
		wp_nonce_field( 'kbds_save_meta', 'kbds_meta_nonce' );
		$status       = get_post_meta( $post->ID, '_kbds_lead_status', true ) ?: 'new';
		$source_url   = get_post_meta( $post->ID, '_kbds_lead_source_url', true );
		$source_title = get_post_meta( $post->ID, '_kbds_lead_source_title', true );
		$source_type  = get_post_meta( $post->ID, '_kbds_lead_source_type', true );
		$ip           = get_post_meta( $post->ID, '_kbds_lead_ip', true );
		$phone        = get_post_meta( $post->ID, '_kbds_lead_phone', true );
		$clean_phone  = preg_replace( '/[^0-9]/', '', $phone );
		?>
		<div style="background:#FDF8EC;border:1px solid #E5C158;padding:12px 16px;border-radius:8px;margin-bottom:18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
			<div>
				<span style="font-size:11px;font-weight:700;color:#9A7312;text-transform:uppercase;display:block;">⚡ THAO TÁC NHANH VỚI KHÁCH HÀNG:</span>
				<strong style="font-size:16px;color:#0B2C4D;"><?php echo esc_html( $post->post_title ); ?></strong>
			</div>
			<div>
				<?php if ( $clean_phone ) : ?>
					<a href="tel:<?php echo esc_attr( $clean_phone ); ?>" class="button button-primary" style="background:#0E8A4A;border-color:#0E8A4A;font-weight:700;">📞 Gọi Ngay</a>
					<a href="https://zalo.me/<?php echo esc_attr( $clean_phone ); ?>" target="_blank" class="button" style="background:#0068FF;border-color:#0068FF;color:#fff;font-weight:700;">💬 Chat Zalo</a>
				<?php endif; ?>
				<?php if ( $source_url ) : ?>
					<a href="<?php echo esc_url( $source_url ); ?>" target="_blank" class="button" style="font-weight:700;">🌐 Xem Trang Đăng Ký ↗</a>
				<?php endif; ?>
			</div>
		</div>

		<table class="form-table">
			<tr>
				<th><label for="_kbds_lead_status">Trạng thái chăm sóc</label></th>
				<td>
					<select name="_kbds_lead_status" id="_kbds_lead_status" style="font-weight:700;font-size:14px;">
						<option value="new" <?php selected( $status, 'new' ); ?>>🟢 Mới đăng ký (Chưa gọi)</option>
						<option value="contacted" <?php selected( $status, 'contacted' ); ?>>🔵 Đang tư vấn / Đã gửi bảng giá</option>
						<option value="qualified" <?php selected( $status, 'qualified' ); ?>>⭐ Khách nét / Hẹn đi xem thực tế</option>
						<option value="closed" <?php selected( $status, 'closed' ); ?>>🏆 Đã giao dịch thành công</option>
						<option value="archived" <?php selected( $status, 'archived' ); ?>>⚪ Tạm hoãn / Không nghe máy</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label>Dự án &amp; Nguồn gửi Form</label></th>
				<td>
					<?php if ( $source_url ) : ?>
						<p style="margin:0 0 6px;">
							<strong>Link trang khách đăng ký:</strong>
							<a href="<?php echo esc_url( $source_url ); ?>" target="_blank" style="color:#1565C0;text-decoration:underline;">
								<?php echo esc_html( $source_title ?: $source_url ); ?> ↗
							</a>
						</p>
					<?php endif; ?>
					<input type="text" name="_kbds_lead_source_url" value="<?php echo esc_attr( $source_url ); ?>" class="large-text" placeholder="URL trang nguồn đăng ký" style="margin-bottom:6px;" />
					<div style="display:flex;gap:10px;">
						<input type="text" name="_kbds_lead_source_title" value="<?php echo esc_attr( $source_title ); ?>" placeholder="Tiêu đề trang nguồn" style="flex:1;" />
						<input type="text" name="_kbds_lead_source_type" value="<?php echo esc_attr( $source_type ); ?>" placeholder="Loại trang (Dự án con / Bài viết)" style="width:200px;" />
					</div>
				</td>
			</tr>
		</table>
		<?php
		$fields = array(
			'_kbds_lead_phone'   => array( 'label' => 'Số điện thoại / Zalo', 'type' => 'text', 'placeholder' => '0909...' ),
			'_kbds_lead_email'   => array( 'label' => 'Email khách hàng', 'type' => 'text', 'placeholder' => 'khachhang@email.com' ),
			'_kbds_lead_project' => array( 'label' => 'Dự án / Sản phẩm quan tâm', 'type' => 'text', 'placeholder' => 'Tên dự án hoặc link trang khách đăng ký' ),
			'_kbds_lead_demand'  => array( 'label' => 'Nhu cầu / Yêu cầu của khách', 'type' => 'textarea', 'placeholder' => 'Nhận bảng giá & chính sách ưu đãi...' ),
			'_kbds_lead_notes'   => array( 'label' => 'Ghi chú của Chuyên viên tư vấn', 'type' => 'textarea', 'placeholder' => 'Khách quan tâm căn 2PN, tài chính tự có 2 tỷ...' ),
			'_kbds_lead_ip'      => array( 'label' => 'Địa chỉ IP khách', 'type' => 'text', 'placeholder' => '127.0.0.1' ),
		);
		self::render_fields_table( $post->ID, $fields );
	}

	private static function render_fields_table( $post_id, $fields ) {
		echo '<table class="form-table">';
		foreach ( $fields as $key => $field ) {
			$val = get_post_meta( $post_id, $key, true );
			echo '<tr>';
			echo '<th style="width:240px;"><label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label></th>';
			echo '<td>';
			if ( 'textarea' === $field['type'] ) {
				echo '<textarea name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" rows="4" class="large-text" placeholder="' . esc_attr( $field['placeholder'] ) . '">' . esc_textarea( $val ) . '</textarea>';
			} else {
				echo '<input type="' . esc_attr( $field['type'] ) . '" step="any" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" class="regular-text" style="width:100%;max-width:520px;" placeholder="' . esc_attr( $field['placeholder'] ) . '" />';
			}
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}

	/**
	 * Lưu dữ liệu Meta Boxes an toàn
	 */
	public static function save_meta_boxes( $post_id, $post ) {
		if ( ! isset( $_POST['kbds_meta_nonce'] ) || ! wp_verify_nonce( $_POST['kbds_meta_nonce'], 'kbds_save_meta' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$meta_keys = array(
			// Dự án
			'_kbds_project_code', '_kbds_price_from', '_kbds_price_min_num', '_kbds_address',
			'_kbds_total_area', '_kbds_scale', '_kbds_legal_status', '_kbds_handover_time',
			'_kbds_bank_support', '_kbds_brochure_url', '_kbds_review_score', '_kbds_pros_cons',
			// Giỏ hàng
			'_kbds_parent_project_id', '_kbds_listing_code', '_kbds_listing_price', '_kbds_price_billion',
			'_kbds_area_m2', '_kbds_bedrooms', '_kbds_bathrooms', '_kbds_direction',
			'_kbds_listing_legal', '_kbds_contact_phone',
			// Khách hàng (Lead)
			'_kbds_lead_status', '_kbds_lead_phone', '_kbds_lead_email', '_kbds_lead_project',
			'_kbds_lead_source_url', '_kbds_lead_source_title', '_kbds_lead_source_type',
			'_kbds_lead_demand', '_kbds_lead_notes', '_kbds_lead_ip',
		);

		foreach ( $meta_keys as $key ) {
			if ( isset( $_POST[ $key ] ) ) {
				if ( in_array( $key, array( '_kbds_pros_cons', '_kbds_lead_demand', '_kbds_lead_notes' ), true ) ) {
					update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
				} else {
					update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
				}
			}
		}

		if ( 'bat_dong_san' === $post->post_type ) {
			$verified = isset( $_POST['_kbds_is_verified'] ) ? '1' : '0';
			update_post_meta( $post_id, '_kbds_is_verified', $verified );
		}
	}

	/**
	 * Cột hiển thị trong Admin cho Dự án
	 */
	public static function project_columns( $columns ) {
		$new = array();
		foreach ( $columns as $key => $label ) {
			$new[ $key ] = $label;
			if ( 'title' === $key ) {
				$new['kbds_code']  = 'Mã DA';
				$new['kbds_price'] = 'Giá tham khảo';
				$new['kbds_score'] = 'Điểm Review';
			}
		}
		return $new;
	}

	public static function project_column_content( $column, $post_id ) {
		if ( 'kbds_code' === $column ) {
			echo '<code>' . esc_html( get_post_meta( $post_id, '_kbds_project_code', true ) ?: '—' ) . '</code>';
		} elseif ( 'kbds_price' === $column ) {
			echo '<strong>' . esc_html( get_post_meta( $post_id, '_kbds_price_from', true ) ?: 'Đang cập nhật' ) . '</strong>';
		} elseif ( 'kbds_score' === $column ) {
			$score = get_post_meta( $post_id, '_kbds_review_score', true );
			echo $score ? '<span style="background:#0f3e6d;color:#fff;padding:2px 8px;border-radius:4px;font-weight:bold;">' . esc_html( $score ) . '/10</span>' : '—';
		}
	}

	/**
	 * Cột hiển thị trong Admin cho Giỏ hàng
	 */
	public static function listing_columns( $columns ) {
		$new = array();
		foreach ( $columns as $key => $label ) {
			$new[ $key ] = $label;
			if ( 'title' === $key ) {
				$new['kbds_l_code']    = 'Mã căn';
				$new['kbds_l_project'] = 'Thuộc Dự án';
				$new['kbds_l_price']   = 'Giá bán';
				$new['kbds_l_area']    = 'Diện tích';
				$new['kbds_verified']  = 'Xác thực';
			}
		}
		return $new;
	}

	public static function listing_column_content( $column, $post_id ) {
		switch ( $column ) {
			case 'kbds_l_code':
				echo '<code>' . esc_html( get_post_meta( $post_id, '_kbds_listing_code', true ) ?: '—' ) . '</code>';
				break;
			case 'kbds_l_project':
				$pid = (int) get_post_meta( $post_id, '_kbds_parent_project_id', true );
				echo $pid ? '<a href="' . esc_url( get_edit_post_link( $pid ) ) . '">' . esc_html( get_the_title( $pid ) ) . '</a>' : '<em>BĐS độc lập</em>';
				break;
			case 'kbds_l_price':
				echo '<strong style="color:#d32f2f;">' . esc_html( get_post_meta( $post_id, '_kbds_listing_price', true ) ?: 'Liên hệ' ) . '</strong>';
				break;
			case 'kbds_l_area':
				$area = get_post_meta( $post_id, '_kbds_area_m2', true );
				echo $area ? esc_html( $area ) . ' m²' : '—';
				break;
			case 'kbds_verified':
				$v = get_post_meta( $post_id, '_kbds_is_verified', true );
				echo '1' === $v ? '<span style="color:#1b8a4b;font-weight:bold;">✔ Đã xác thực</span>' : '<span style="color:#999;">Chưa xác thực</span>';
				break;
		}
	}

	/**
	 * Cột hiển thị trong Admin cho Khách hàng (CRM)
	 */
	public static function lead_columns( $columns ) {
		return array(
			'cb'           => '<input type="checkbox" />',
			'title'        => 'Họ tên Khách hàng',
			'lead_phone'   => 'Số điện thoại / Zalo',
			'lead_project' => 'Dự án & Nguồn đăng ký (Link)',
			'lead_demand'  => 'Nhu cầu',
			'lead_status'  => 'Trạng thái chăm sóc',
			'date'         => 'Thời gian đăng ký',
		);
	}

	public static function lead_column_content( $column, $post_id ) {
		switch ( $column ) {
			case 'lead_phone':
				$phone       = get_post_meta( $post_id, '_kbds_lead_phone', true );
				$clean_phone = preg_replace( '/[^0-9]/', '', $phone );
				echo '<strong><a href="tel:' . esc_attr( $clean_phone ) . '" style="color:#0B2C4D;font-size:14px;font-weight:800;">' . esc_html( $phone ) . '</a></strong>';
				if ( $clean_phone ) {
					echo '<br/><a href="https://zalo.me/' . esc_attr( $clean_phone ) . '" target="_blank" style="display:inline-block;margin-top:4px;background:#0068FF;color:#fff;font-size:11px;font-weight:700;padding:2px 7px;border-radius:4px;text-decoration:none;">💬 Chat Zalo</a>';
				}
				break;
			case 'lead_project':
				$proj  = get_post_meta( $post_id, '_kbds_lead_project', true ) ?: 'Chung';
				$url   = get_post_meta( $post_id, '_kbds_lead_source_url', true );
				$title = get_post_meta( $post_id, '_kbds_lead_source_title', true );
				$type  = get_post_meta( $post_id, '_kbds_lead_source_type', true );

				echo '<div style="margin-bottom:4px;">';
				echo '<strong style="background:#FDF8EC;color:#9A7312;border:1px solid #E5C158;padding:2px 8px;border-radius:4px;font-size:12px;display:inline-block;">👑 ' . esc_html( $proj ) . '</strong>';
				if ( $type ) {
					echo ' <span style="background:#F1F5F9;color:#475569;padding:2px 6px;border-radius:4px;font-size:10.5px;">' . esc_html( $type ) . '</span>';
				}
				echo '</div>';

				if ( $url ) {
					$display_title = $title ?: wp_trim_words( $url, 6 );
					echo '<a href="' . esc_url( $url ) . '" target="_blank" style="font-size:12px;color:#1565C0;text-decoration:underline;display:inline-flex;align-items:center;gap:3px;word-break:break-all;" title="' . esc_attr( $url ) . '">';
					echo '🔗 ' . esc_html( wp_trim_words( $display_title, 8 ) );
					echo '</a>';
				} else {
					echo '<span style="color:#94A3B8;font-size:11.5px;">Form trực tiếp</span>';
				}
				break;
			case 'lead_demand':
				echo esc_html( wp_trim_words( get_post_meta( $post_id, '_kbds_lead_demand', true ), 12 ) );
				break;
			case 'lead_status':
				$st = get_post_meta( $post_id, '_kbds_lead_status', true ) ?: 'new';
				$labels = array(
					'new'       => '<span style="background:#e8f5e9;color:#2e7d32;padding:3px 8px;border-radius:4px;font-weight:600;">🟢 Mới đăng ký</span>',
					'contacted' => '<span style="background:#e3f2fd;color:#1565c0;padding:3px 8px;border-radius:4px;font-weight:600;">🔵 Đang tư vấn</span>',
					'qualified' => '<span style="background:#fff8e1;color:#f57f17;padding:3px 8px;border-radius:4px;font-weight:600;">⭐ Khách nét</span>',
					'closed'    => '<span style="background:#fce4ec;color:#c2185b;padding:3px 8px;border-radius:4px;font-weight:600;">🏆 Đã chốt</span>',
					'archived'  => '<span style="background:#f5f5f5;color:#616161;padding:3px 8px;border-radius:4px;">⚪ Tạm hoãn</span>',
				);
				echo isset( $labels[ $st ] ) ? $labels[ $st ] : esc_html( $st );
				break;
		}
	}

	/**
	 * Bộ lọc thả xuống theo Taxonomy và theo Dự án trong trang danh sách Admin
	 */
	public static function admin_taxonomy_filters( $post_type ) {
		if ( 'bds_lead' === $post_type ) {
			global $wpdb;
			$projects = $wpdb->get_col( "
				SELECT DISTINCT meta_value 
				FROM {$wpdb->postmeta} 
				WHERE meta_key = '_kbds_lead_project' 
				  AND meta_value != ''
				ORDER BY meta_value ASC
			" );

			$selected_project = isset( $_GET['filter_kbds_project'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_kbds_project'] ) ) : '';
			echo '<select name="filter_kbds_project" id="filter_kbds_project" style="font-weight:600;">';
			echo '<option value="">🎯 Tất cả Dự án / Nguồn đăng ký</option>';
			foreach ( $projects as $p_name ) {
				printf(
					'<option value="%s" %s>%s</option>',
					esc_attr( $p_name ),
					selected( $selected_project, $p_name, false ),
					esc_html( $p_name )
				);
			}
			echo '</select>';

			$statuses = array(
				'new'       => '🟢 Mới đăng ký',
				'contacted' => '🔵 Đang tư vấn',
				'qualified' => '⭐ Khách nét',
				'closed'    => '🏆 Đã chốt',
				'archived'  => '⚪ Tạm hoãn',
			);
			$selected_st = isset( $_GET['filter_kbds_status'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_kbds_status'] ) ) : '';
			echo '<select name="filter_kbds_status" id="filter_kbds_status" style="font-weight:600;">';
			echo '<option value="">📋 Tất cả trạng thái</option>';
			foreach ( $statuses as $st_key => $st_name ) {
				printf(
					'<option value="%s" %s>%s</option>',
					esc_attr( $st_key ),
					selected( $selected_st, $st_key, false ),
					esc_html( $st_name )
				);
			}
			echo '</select>';
			return;
		}

		$taxonomies = array();
		if ( 'du_an' === $post_type ) {
			$taxonomies = array( 'khu_vuc_bds', 'loai_hinh_bds', 'trang_thai_du_an', 'chu_dau_tu' );
		} elseif ( 'bat_dong_san' === $post_type ) {
			$taxonomies = array( 'khu_vuc_bds', 'loai_hinh_bds', 'loai_giao_dich' );
		}

		foreach ( $taxonomies as $tax_slug ) {
			$tax_obj = get_taxonomy( $tax_slug );
			if ( ! $tax_obj ) {
				continue;
			}
			$selected = isset( $_GET[ $tax_slug ] ) ? sanitize_text_field( wp_unslash( $_GET[ $tax_slug ] ) ) : '';
			wp_dropdown_categories( array(
				'show_option_all' => 'Tất cả ' . $tax_obj->labels->name,
				'taxonomy'        => $tax_slug,
				'name'            => $tax_slug,
				'orderby'         => 'name',
				'selected'        => $selected,
				'hierarchical'    => true,
				'value_field'     => 'slug',
				'hide_empty'      => false,
			) );
		}
	}

	/**
	 * Áp dụng điều kiện lọc Khách hàng theo Dự án hoặc Trạng thái trong Admin
	 */
	public static function filter_leads_in_admin( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}
		if ( 'bds_lead' !== $query->get( 'post_type' ) ) {
			return;
		}

		$meta_query = $query->get( 'meta_query' ) ?: array();

		if ( ! empty( $_GET['filter_kbds_project'] ) ) {
			$meta_query[] = array(
				'key'     => '_kbds_lead_project',
				'value'   => sanitize_text_field( wp_unslash( $_GET['filter_kbds_project'] ) ),
				'compare' => '=',
			);
		}

		if ( ! empty( $_GET['filter_kbds_status'] ) ) {
			$meta_query[] = array(
				'key'     => '_kbds_lead_status',
				'value'   => sanitize_text_field( wp_unslash( $_GET['filter_kbds_status'] ) ),
				'compare' => '=',
			);
		}

		if ( ! empty( $meta_query ) ) {
			$query->set( 'meta_query', $meta_query );
		}
	}

	/**
	 * Nạp thư viện Media Uploader trong trang Quản lý Chủ đầu tư
	 */
	public static function enqueue_media_for_developer_tax( $hook ) {
		if ( in_array( $hook, array( 'edit-tags.php', 'term.php' ), true ) && isset( $_GET['taxonomy'] ) && 'chu_dau_tu' === $_GET['taxonomy'] ) {
			wp_enqueue_media();
		}
	}

	/**
	 * Ô chọn Ảnh Logo khi Thêm mới Chủ đầu tư
	 */
	public static function add_developer_logo_field() {
		?>
		<div class="form-field term-logo-wrap">
			<label for="kbds_dev_logo_url">Ảnh Logo Chủ đầu tư / Đối tác</label>
			<div style="display:flex;gap:8px;align-items:center;">
				<input type="text" name="kbds_dev_logo_url" id="kbds_dev_logo_url" value="" placeholder="Dán link ảnh hoặc bấm nút Chọn ảnh..." style="flex:1;" />
				<button type="button" class="button button-secondary kbds-upload-logo-btn">📷 Chọn Ảnh Logo</button>
			</div>
			<div id="kbds_dev_logo_preview" style="margin-top:10px;"></div>
			<p class="description">Tải ảnh Logo (PNG/SVG/JPG/WebP nền trong suốt hoặc nền trắng) để hiển thị trên thanh Slide Logo ngoài Trang chủ.</p>
		</div>
		<?php
		self::print_media_uploader_script();
	}

	/**
	 * Ô chọn Ảnh Logo khi Chỉnh sửa Chủ đầu tư
	 */
	public static function edit_developer_logo_field( $term ) {
		$logo_url = get_term_meta( $term->term_id, '_kbds_dev_logo_url', true );
		$sub_text = get_term_meta( $term->term_id, '_kbds_dev_subtitle', true );
		?>
		<tr class="form-field term-logo-wrap">
			<th scope="row"><label for="kbds_dev_logo_url">Ảnh Logo Chủ đầu tư</label></th>
			<td>
				<div style="display:flex;gap:8px;align-items:center;max-width:520px;">
					<input type="text" name="kbds_dev_logo_url" id="kbds_dev_logo_url" value="<?php echo esc_attr( $logo_url ); ?>" placeholder="Dán link ảnh hoặc bấm nút Chọn ảnh..." style="flex:1;" />
					<button type="button" class="button button-primary kbds-upload-logo-btn">📷 Chọn / Thay Ảnh Logo</button>
					<button type="button" class="button kbds-remove-logo-btn">Xóa ảnh</button>
				</div>
				<div id="kbds_dev_logo_preview" style="margin-top:12px;">
					<?php if ( $logo_url ) : ?>
						<img src="<?php echo esc_url( $logo_url ); ?>" style="max-height:64px;background:#fff;padding:8px 14px;border:1px solid #cbd5e1;border-radius:8px;" />
					<?php endif; ?>
				</div>
				<p class="description">Khi bạn tải ảnh Logo lên đây, ngoài Trang chủ (Section 5: Slide Logo Đối tác & Chủ đầu tư) sẽ hiển thị chính xác ảnh Logo này.</p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="kbds_dev_subtitle">Dòng chữ phụ (Tùy chọn)</label></th>
			<td>
				<input type="text" name="kbds_dev_subtitle" id="kbds_dev_subtitle" value="<?php echo esc_attr( $sub_text ); ?>" placeholder="VD: VINGROUP, MASTERISE GROUP, MALAYSIA..." style="max-width:350px;" />
				<p class="description">Hiển thị bên dưới tên đơn vị nếu bạn chưa tải ảnh Logo riêng.</p>
			</td>
		</tr>
		<?php
		self::print_media_uploader_script();
	}

	private static function print_media_uploader_script() {
		?>
		<script>
		jQuery(document).ready(function($){
			var frame;
			$(document).on('click', '.kbds-upload-logo-btn', function(e){
				e.preventDefault();
				if (frame) { frame.open(); return; }
				frame = wp.media({
					title: 'Chọn hoặc Tải lên Logo Chủ Đầu Tư',
					button: { text: 'Sử dụng Logo này' },
					multiple: false
				});
				frame.on('select', function(){
					var attachment = frame.state().get('selection').first().toJSON();
					$('#kbds_dev_logo_url').val(attachment.url);
					$('#kbds_dev_logo_preview').html('<img src="'+attachment.url+'" style="max-height:64px;background:#fff;padding:8px 14px;border:1px solid #cbd5e1;border-radius:8px;" />');
				});
				frame.open();
			});
			$(document).on('click', '.kbds-remove-logo-btn', function(e){
				e.preventDefault();
				$('#kbds_dev_logo_url').val('');
				$('#kbds_dev_logo_preview').empty();
			});
		});
		</script>
		<?php
	}

	public static function save_developer_logo_field( $term_id ) {
		if ( isset( $_POST['kbds_dev_logo_url'] ) ) {
			update_term_meta( $term_id, '_kbds_dev_logo_url', esc_url_raw( wp_unslash( $_POST['kbds_dev_logo_url'] ) ) );
		}
		if ( isset( $_POST['kbds_dev_subtitle'] ) ) {
			update_term_meta( $term_id, '_kbds_dev_subtitle', sanitize_text_field( wp_unslash( $_POST['kbds_dev_subtitle'] ) ) );
		}
	}

	public static function developer_tax_columns( $columns ) {
		$new = array();
		foreach ( $columns as $k => $v ) {
			if ( 'name' === $k ) {
				$new['dev_logo'] = 'Ảnh Logo';
			}
			$new[ $k ] = $v;
		}
		return $new;
	}

	public static function developer_tax_column_content( $content, $column_name, $term_id ) {
		if ( 'dev_logo' === $column_name ) {
			$logo = get_term_meta( $term_id, '_kbds_dev_logo_url', true );
			if ( $logo ) {
				return '<img src="' . esc_url( $logo ) . '" style="max-height:38px;max-width:110px;object-fit:contain;background:#fff;padding:4px 8px;border:1px solid #e2e8f0;border-radius:6px;" />';
			}
			return '<span style="color:#64748b;font-size:12px;">Logo tự động</span>';
		}
		return $content;
	}
}
