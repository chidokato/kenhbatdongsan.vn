<?php
/**
 * Nâng cấp toàn diện Landing Page Dự án Lalalay Residences (Post ID 170)
 * - Tối ưu UX/UI theo Tone màu Terracotta Nung, Rose Gold, Sandstone & Warm Cream
 * - Bổ sung đầy đủ 10 phân khu nội dung chi tiết, chuẩn SEO chuyên sâu
 * - Đảm bảo liên kết mượt mà với bộ 11 hình ảnh độ phân giải cao đã import
 */

define( 'WP_USE_THEMES', false );
require_once __DIR__ . '/../wp-load.php';

$post_id = 170;
$post    = get_post( $post_id );
if ( ! $post ) {
	die( "Không tìm thấy post ID {$post_id}\n" );
}

// Lấy thông tin 11 ảnh đã import
$images_slug = array(
	'hero'       => 'phoi-canh-lalalay-residences-bac-an-khanh',
	'info'       => 'thong-tin-du-an-lalalay-residences',
	'location'   => 'vi-tri-du-an-lalalay-residences-dai-lo-thang-long',
	'connect'    => 'ket-noi-15-phut-lalalay-residences',
	'masterplan' => 'tong-mat-bang-tien-ich-lalalay-residences',
	'lala1'      => 'toa-lala-1-mo-ban-dau-tien-lalalay-residences',
	'amenity4'   => 'tien-ich-noi-khu-toa-lala-4-lalalay-residences',
	'mau1pn'     => 'can-ho-mau-1-phong-ngu-lalalay-residences',
	'mau2pn'     => 'can-ho-mau-2-phong-ngu-lalalay-residences',
	'mau3pn'     => 'can-ho-mau-3-phong-ngu-lalalay-residences',
	'handover'   => 'tieu-chuan-ban-giao-lalalay-residences',
);

$img = array();
foreach ( $images_slug as $k => $slug ) {
	$p = get_posts( array( 'post_type' => 'attachment', 'name' => $slug, 'posts_per_page' => 1, 'post_status' => 'inherit' ) );
	if ( ! empty( $p ) ) {
		$img[ $k ] = array(
			'id'  => $p[0]->ID,
			'url' => wp_get_attachment_url( $p[0]->ID ),
			'alt' => get_post_meta( $p[0]->ID, '_wp_attachment_image_alt', true ) ?: $p[0]->post_title,
			'cap' => $p[0]->post_excerpt ?: $p[0]->post_title,
		);
	}
}

function lala_figure( $img, $key, $caption = true ) {
	if ( empty( $img[ $key ] ) ) return '';
	$i   = $img[ $key ];
	$out = '<figure class="kbds-proj-figure" style="margin:0 0 18px;border-radius:14px;overflow:hidden;box-shadow:0 10px 30px rgba(194,86,43,0.12);border:1px solid #EFE4DC;">';
	$out .= '<img src="' . esc_url( $i['url'] ) . '" alt="' . esc_attr( $i['alt'] ) . '" loading="lazy" style="width:100%;height:auto;display:block;" />';
	if ( $caption && ! empty( $i['cap'] ) ) {
		$out .= '<figcaption style="background:#FFF9F5;text-align:center;font-size:13px;color:#7C2D12;padding:10px 14px;font-style:italic;border-top:1px solid #F3E5DC;font-weight:600;">' . esc_html( $i['cap'] ) . '</figcaption>';
	}
	$out .= '</figure>';
	return $out;
}

$P = array();
foreach ( $images_slug as $k => $slug ) {
	$P[ '{IMG_' . strtoupper( $k ) . '}' ] = lala_figure( $img, $k );
}
$P['{HERO_URL}'] = $img['hero']['url'];
$P['{PROJECT_ID}'] = $post_id;

$content = <<<'EOD'
[section label="1. Hero Banner Lalalay Residences" bg="{HERO_URL}" bg_size="original" bg_overlay="linear-gradient(135deg, rgba(28, 15, 10, 0.88) 0%, rgba(68, 28, 14, 0.76) 100%)" dark="true" padding="70px"]

[row style="large" v_align="middle"]

[col span="7" span__sm="12"]

<div class="kbds-lala-badge-dark">
	<span>🌇 BẮC AN KHÁNH • GIAO ĐIỂM ĐẠI LỘ THĂNG LONG &amp; VÀNH ĐAI 3.5</span>
</div>

<h1 style="font-size:38px;font-weight:900;line-height:1.24;color:#FFFFFF;margin:0 0 16px;letter-spacing:-0.5px">Lalalay Residences Bắc An Khánh – Tổ Hợp Căn Hộ Sống Đủ Đầy, Vui All Day Phía Tây Thủ Đô</h1>

<p style="font-size:16.5px;line-height:1.75;color:#FDEFE5;margin-bottom:26px">Tọa lạc tại vị trí vàng Bắc An Khánh, <strong>Lalalay Residences</strong> quy mô <strong>4 tòa tháp 20 tầng nổi, 3 tầng hầm và 2 khối đế thương mại dịch vụ</strong> trên khuôn viên <strong>27.793 m²</strong>. Cung cấp <strong>1.492 căn hộ Studio – 4PN sở hữu lâu dài</strong> được kiến tạo bởi <strong>Ramoori Holdings</strong>, tư vấn thiết kế <strong>STELLAR</strong> và bảo chứng chất lượng bởi Tổng thầu xây dựng số 1 <strong>Delta</strong>.</p>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:30px">
	<div class="kbds-lala-stat-box">
		<strong style="display:block;font-size:24px;font-weight:900;color:#F7B98B">4 Tòa</strong>
		<span style="font-size:12.5px;color:#FDEFE5">20 Tầng nổi • 3 Hầm</span>
	</div>
	<div class="kbds-lala-stat-box">
		<strong style="display:block;font-size:24px;font-weight:900;color:#FDE68A">1.492</strong>
		<span style="font-size:12.5px;color:#FDEFE5">Căn hộ Lâu dài</span>
	</div>
	<div class="kbds-lala-stat-box">
		<strong style="display:block;font-size:24px;font-weight:900;color:#A7F3D0">27.793 m²</strong>
		<span style="font-size:12.5px;color:#FDEFE5">Khuôn viên đất</span>
	</div>
	<div class="kbds-lala-stat-box">
		<strong style="display:block;font-size:24px;font-weight:900;color:#BAE6FD">Năm 2029</strong>
		<span style="font-size:12.5px;color:#FDEFE5">Dự kiến bàn giao</span>
	</div>
</div>

<div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">
	[button text="📥 Tải Bảng Giá &amp; Mặt Bằng LALA 1" color="secondary" size="larger" radius="10" link="#nhan-bang-gia"]
	[button text="📞 Hotline Tư Vấn: 0942.655.111" style="outline" color="white" size="larger" radius="10" link="tel:0942655111"]
</div>

[/col]

[col span="5" span__sm="12"]

[kbds_quick_lead_card title="ĐĂNG KÝ NHẬN BỘ TÀI LIỆU GỐC" subtitle="Nhận ngay Bảng giá dự kiến, Mặt bằng chi tiết tòa LALA 1, Chính sách ưu đãi &amp; Tiêu chuẩn bàn giao qua Zalo trong 3 phút:" project="Lalalay Residences"]

[/col]

[/row]

[/section]

[section label="2. Menu Phụ Điều Hướng Dự Án (Sticky Sub-Nav)" class="kbds-proj-sticky-subnav" bg_color="#FFFFFF" padding="0px"]

<div class="kbds-proj-nav-container">
	<nav class="kbds-proj-nav">
		<a href="#tong-quan">Tổng Quan</a>
		<a href="#vi-tri">Vị Trí &amp; Kết Nối</a>
		<a href="#tien-ich">16 Tiện Ích &amp; LALA 4</a>
		<a href="#mat-bang-lala1">Tòa LALA 1</a>
		<a href="#can-ho-mau">Căn Hộ Mẫu</a>
		<a href="#tieu-chuan-ban-giao">Bàn Giao</a>
		<a href="#ly-do-dau-tu">Lý Do Chọn Mua</a>
		<a href="#bang-gia-chinh-sach">Bảng Giá &amp; Lãi Vay</a>
		<a href="#faq">Hỏi Đáp</a>
		<a href="#nhan-bang-gia" class="kbds-proj-nav-cta">Nhận Bảng Giá Gốc</a>
	</nav>
</div>

[/section]

[section label="3. Tổng Quan Dự Án &amp; Thông Số Kỹ Thuật" bg_color="#FBF6F1" padding="64px"]

[row style="large" v_align="top"]

[col span="7" span__sm="12"]

<div id="tong-quan"></div>
<span class="kbds-lala-badge">01 | THÔNG TIN DỰ ÁN</span>
<h2 style="color:#2D241E;font-size:30px;font-weight:900;margin:0 0 16px;line-height:1.3">1. Tổng Quan Dự Án Lalalay Residences – Kiến Trúc Độc Bản Phía Tây Hà Nội</h2>

<p style="font-size:15.5px;line-height:1.8;color:#4A3B32"><strong>Lalalay Residences</strong> là tổ hợp căn hộ cao cấp tọa lạc tại <strong>Bắc An Khánh, Hà Nội</strong>, được quy hoạch đồng bộ trên tổng diện tích đất <strong>27.793 m²</strong> với mật độ cư dân lý tưởng (khoảng <strong>2.999 người</strong>). Dự án phát triển gồm <strong>4 tòa tháp cao 20 tầng nổi, 3 tầng hầm thông nhau và 2 khối đế thương mại dịch vụ</strong> sôi động, mang lại giải pháp an cư và đầu tư vượt trội.</p>

<p style="font-size:15.5px;line-height:1.8;color:#4A3B32">Về mặt ngôn ngữ kiến trúc, dự án gây ấn tượng thị giác mạnh mẽ với những dải ban công uốn lượn mềm mại theo hình sóng nước, tông màu đỏ đất nung (terracotta) ấm áp kết hợp sảnh đón vòm cột hình hoa nở rộ kiêu hãnh. Toàn bộ <strong>1.492 căn hộ</strong> có cơ cấu sản phẩm linh hoạt từ <strong>Studio, 1PN, 2PN, 3PN đến 4PN</strong>, 100% căn hộ đều có <strong>pháp lý sở hữu lâu dài</strong>.</p>

<div style="background:#FFFFFF;border-left:5px solid #C2562B;border-radius:12px;padding:20px 22px;margin:22px 0;box-shadow:0 4px 16px rgba(194,86,43,0.06)">
	<h3 style="color:#C2562B;font-size:18px;font-weight:800;margin:0 0 8px">⚖️ Pháp Lý Vững Chắc – Minh Bạch 100%</h3>
	<p style="margin:0;font-size:15px;line-height:1.7;color:#4A3B32">Dự án Lalalay Residences đã hoàn tất đầy đủ <strong>Quy hoạch chi tiết 1/500 được cơ quan nhà nước phê duyệt</strong> và có <strong>Quyết định chấp thuận chủ trương đầu tư</strong>. Khách hàng hoàn toàn yên tâm về tiến độ cấp sổ hồng sở hữu lâu dài.</p>
</div>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:20px">
	<div class="kbds-lala-card" style="padding:18px">
		<span style="font-size:24px;display:block;margin-bottom:8px">🏛️</span>
		<strong style="color:#2D241E;font-size:14.5px;display:block;margin-bottom:4px">Ramoori Holdings</strong>
		<span style="font-size:13px;color:#786558;line-height:1.5;display:block">Nhà đồng hành kiến tạo chiến lược, định hướng phong cách sống văn minh đa thế hệ.</span>
	</div>
	<div class="kbds-lala-card" style="padding:18px">
		<span style="font-size:24px;display:block;margin-bottom:8px">🎨</span>
		<strong style="color:#2D241E;font-size:14.5px;display:block;margin-bottom:4px">STELLAR Design</strong>
		<span style="font-size:13px;color:#786558;line-height:1.5;display:block">Đơn vị tư vấn &amp; thiết kế kiến trúc cảnh quan quốc tế, tạo nên những đường cong nghệ thuật.</span>
	</div>
	<div class="kbds-lala-card" style="padding:18px">
		<span style="font-size:24px;display:block;margin-bottom:8px">🏗️</span>
		<strong style="color:#2D241E;font-size:14.5px;display:block;margin-bottom:4px">Delta Group</strong>
		<span style="font-size:13px;color:#786558;line-height:1.5;display:block">Tổng thầu xây dựng số 1 Việt Nam, bảo chứng chất lượng kết cấu và tiến độ bàn giao năm 2029.</span>
	</div>
</div>

[/col]

[col span="5" span__sm="12"]

<div style="background:#FFFFFF;border:2px solid #C2562B;border-radius:16px;overflow:hidden;box-shadow:0 12px 36px rgba(194,86,43,0.12)">
	<div style="background:linear-gradient(135deg, #7A2E14 0%, #C2562B 100%);color:#FFFFFF;padding:20px 24px;display:flex;justify-content:space-between;align-items:center">
		<div>
			<span style="font-size:11.5px;color:#FFD9BF;font-weight:800;letter-spacing:0.8px;display:block">BẢNG THÔNG SỐ CHÍNH THỨC</span>
			<strong style="font-size:19px;letter-spacing:-0.2px">Hồ Sơ Dự Án Lalalay Residences</strong>
		</div>
		<span style="background:#FFD9BF;color:#7A2E14;padding:4px 10px;border-radius:8px;font-weight:900;font-size:12px">HOT 2026</span>
	</div>
	<div style="padding:10px 22px 22px">
		<table style="width:100%;border-collapse:collapse;font-size:14px">
			<tbody>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558;width:42%">Tên dự án:</td><td style="padding:11px 4px;font-weight:900;color:#C2562B">LALALAY RESIDENCES</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Vị trí:</td><td style="padding:11px 4px;font-weight:700;color:#2D241E">Bắc An Khánh, Hà Nội</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Quy mô xây dựng:</td><td style="padding:11px 4px;font-weight:700;color:#2D241E">4 tòa, 20 tầng nổi, 3 hầm, 2 khối đế TMDV</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Số lượng căn:</td><td style="padding:11px 4px;font-weight:900;color:#C2562B">1.492 căn hộ</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Tổng diện tích đất:</td><td style="padding:11px 4px;font-weight:800;color:#0E8A4A">27.793 m²</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Cơ cấu sản phẩm:</td><td style="padding:11px 4px;font-weight:700;color:#2D241E">Studio • 1PN • 2PN • 3PN • 4PN</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Cơ cấu dân số:</td><td style="padding:11px 4px;font-weight:700;color:#2D241E">2.999 người</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Đồng hành kiến tạo:</td><td style="padding:11px 4px;font-weight:700;color:#C2562B">Ramoori Holdings</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Tư vấn &amp; Thiết kế:</td><td style="padding:11px 4px;font-weight:700;color:#2D241E">STELLAR</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Tổng thầu xây dựng:</td><td style="padding:11px 4px;font-weight:700;color:#2D241E">Delta Group</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Pháp lý:</td><td style="padding:11px 4px;font-weight:700;color:#0E8A4A">QHCT 1/500 phê duyệt • Chấp thuận chủ trương</td></tr>
				<tr style="border-bottom:1px solid #F3E5DC"><td style="padding:11px 4px;font-weight:600;color:#786558">Hình thức sở hữu:</td><td style="padding:11px 4px;font-weight:800;color:#C2562B">Sở hữu lâu dài (Sổ hồng)</td></tr>
				<tr><td style="padding:11px 4px;font-weight:600;color:#786558">Bàn giao:</td><td style="padding:11px 4px;font-weight:900;color:#2D241E">Dự kiến Năm 2029</td></tr>
			</tbody>
		</table>
	</div>
</div>

[/col]

[/row]

[row style="large"]
[col span="12" span__sm="12"]
{IMG_INFO}
[/col]
[/row]

[/section]

[section label="4. Vị Trí Vàng &amp; Kết Nối 15 Phút" bg_color="#FFFFFF" padding="64px"]

[row style="large" v_align="middle"]

[col span="7" span__sm="12"]

<div id="vi-tri"></div>
{IMG_LOCATION}

[/col]

[col span="5" span__sm="12"]

<span class="kbds-lala-badge">VỊ TRÍ CHIẾN LƯỢC • TÂM ĐIỂM PHÍA TÂY</span>
<h2 style="color:#2D241E;font-size:30px;font-weight:900;margin:0 0 16px;line-height:1.3">2. Vị Trí Lalalay Residences – Giao Điểm Vàng Đại Lộ Thăng Long &amp; Vành Đai 3.5</h2>

<p style="font-size:15.5px;line-height:1.8;color:#4A3B32"><strong>Lalalay Residences</strong> nằm ngay cửa ngõ quần thể đô thị Bắc An Khánh, đón trọn hai trục giao thông huyết mạch của Thủ đô: <strong>Đại lộ Thăng Long rộng 140m</strong> và <strong>Đường Vành đai 3.5</strong> đang hoàn thiện kết nối xuyên suốt từ Bắc Từ Liêm, Hoài Đức tới Hà Đông.</p>

<p style="font-size:15.5px;line-height:1.8;color:#4A3B32">Đặc biệt, dự án nằm kế sát <strong>Ga Metro số 7</strong> và chỉ cách <strong>Tuyến Metro số 5 (Văn Cao – Ngọc Khánh – Hòa Lạc)</strong> vài phút di chuyển. Đây chính là yếu tố bảo chứng cho tốc độ tăng giá bất động sản vượt trội theo mô hình phát triển đô thị định hướng giao thông công cộng (TOD).</p>

[button text="🗺️ Nhận Bản Đồ Quy Hoạch Vị Trí &amp; Metro 7" color="secondary" size="large" radius="8" link="#nhan-bang-gia"]

[/col]

[/row]

[row style="large" v_align="middle"]

[col span="6" span__sm="12"]

<div class="kbds-lala-step-card" style="margin-bottom:14px">
	<div class="kbds-lala-step-num">5'</div>
	<div>
		<strong style="color:#C2562B;font-size:16px;display:block;margin-bottom:4px">5 Phút Kết Nối Hệ Thống Metro &amp; Giáo Dục Quốc Tế</strong>
		<p style="margin:0;font-size:14px;color:#4A3B32;line-height:1.6">Ga Metro số 5 &amp; Ga Metro số 7 • Trường Quốc tế St. Paul American School • Hệ thống Vinschool Thăng Long • Công viên Thiên Đường Bảo Sơn.</p>
	</div>
</div>

<div class="kbds-lala-step-card" style="margin-bottom:14px">
	<div class="kbds-lala-step-num">10'</div>
	<div>
		<strong style="color:#C2562B;font-size:16px;display:block;margin-bottom:4px">10 Phút Tới Trung Tâm Hành Chính &amp; Mua Sắm Lớn</strong>
		<p style="margin:0;font-size:14px;color:#4A3B32;line-height:1.6">KĐT đa mục tiêu • Bảo tàng Lịch sử Quân sự Việt Nam • SVĐ Quốc gia Mỹ Đình • Bệnh viện Đa khoa Quốc tế Vinmec &amp; Hồng Ngọc • Vincom Mega Mall Smart City • Trung tâm Hội nghị Quốc gia.</p>
	</div>
</div>

<div class="kbds-lala-step-card">
	<div class="kbds-lala-step-num">15'</div>
	<div>
		<strong style="color:#C2562B;font-size:16px;display:block;margin-bottom:4px">15 Phút Nối Liền Khu Công Nghệ Cao &amp; Trung Tâm Y Tế</strong>
		<p style="margin:0;font-size:14px;color:#4A3B32;line-height:1.6">Đại siêu thị Aeon Mall Hà Đông • Viện Huyết học TW • Bệnh viện Đa khoa Hoài Đức • Bến xe Mỹ Đình • Khu công nghệ cao Hòa Lạc (ĐHQG Hà Nội, FPT Software, Viettel R&amp;D).</p>
	</div>
</div>

[/col]

[col span="6" span__sm="12"]

{IMG_CONNECT}

[/col]

[/row]

[/section]

[section label="5. Tổng Mặt Bằng &amp; 16 Tiện Ích Sống Đủ Đầy" bg_color="#24140D" dark="true" padding="70px"]

[row]
[col span="12" span__sm="12"]
<div id="tien-ich" style="text-align:center;max-width:880px;margin:0 auto 36px">
	<span class="kbds-lala-badge-dark">SỐNG ĐỦ ĐẦY – VUI ALL DAY</span>
	<h2 style="color:#FFFFFF;font-size:32px;font-weight:900;margin:0 0 14px">3. Tổng Mặt Bằng &amp; Hệ Thống 16 Tiện Ích Đỉnh Cao</h2>
	<p style="color:#FDEFE5;font-size:16px;line-height:1.7;margin:0">Mỗi ngày tại Lalalay Residences là một chuyến phiêu lưu ngập tràn niềm vui với chuỗi 16 tiện ích ngoài trời kết nối hài hòa giữa 4 tòa tháp LALA 1 – LALA 4 cùng Công viên Thành phố và Nhà để xe nổi thành phố.</p>
</div>
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]
{IMG_MASTERPLAN}
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]
<h3 style="color:#F7B98B;font-size:20px;font-weight:800;margin:0 0 18px;text-align:center">DANH MỤC 16 TIỆN ÍCH NGOÀI TRỜI ĐƯỢC ĐÁNH SỐ CHI TIẾT</h3>
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px">
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">1</span> Thác nước Thư Thái</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">2</span> Quảng trường Rong Chơi</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">3</span> Khu nghỉ chân thư thái</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">4</span> Đường dạo massage chân</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">5</span> Khu vui chơi trẻ em #1</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">6</span> Màn nước Sắc Màu</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">7</span> Đường dạo bộ Thảnh Thơi</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">8</span> Biểu tượng Miền hoa đá</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">9</span> Biểu tượng Miền khởi sinh</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">10</span> Khu gym ngoài trời</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">11</span> Đài Ngắm Vàng</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">12</span> Khu vui chơi trẻ em #2</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">13</span> Đường dạo bộ Tiết Tấu</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">14</span> Vườn cảnh quan Phiêu Nhịp</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">15</span> Quảng trường Giao Hưởng</div>
	<div class="kbds-lala-amenity-pill"><span class="kbds-lala-amenity-num">16</span> Biển hiệu nghệ thuật Lalalay</div>
</div>
[/col]
[/row]

[row style="large" v_align="middle"]
[col span="12" span__sm="12"]
<div style="background:rgba(255,255,255,0.06);border:1px solid rgba(247,185,139,0.3);border-radius:18px;padding:28px;margin-top:10px">
	<div style="text-align:center;margin-bottom:20px">
		<span style="color:#F7B98B;font-size:12px;font-weight:800;letter-spacing:1px;text-transform:uppercase">ĐẶC QUYỀN ĐỘC BẢN</span>
		<h3 style="color:#FFFFFF;font-size:24px;font-weight:900;margin:6px 0 0">Tiện Ích Nội Khu Tòa LALA 4: Gym &amp; Yoga • Bắn Cung Trong Nhà • Kid Zone</h3>
	</div>
	{IMG_AMENITY4}
	<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:16px">
		<div style="background:rgba(0,0,0,0.3);padding:18px;border-radius:12px">
			<strong style="color:#F7B98B;font-size:16px;display:block;margin-bottom:6px">🎯 Bắn Cung Trong Nhà (Indoor Archery)</strong>
			<span style="color:#E7D6CC;font-size:13.5px;line-height:1.6;display:block">Tiện ích thể thao quý tộc lần đầu tiên có mặt trong tòa căn hộ, trang bị bia tập chuẩn và hệ thống an toàn tối ưu.</span>
		</div>
		<div style="background:rgba(0,0,0,0.3);padding:18px;border-radius:12px">
			<strong style="color:#FDE68A;font-size:16px;display:block;margin-bottom:6px">🧘 Tổ Hợp Gym &amp; Yoga Cao Cấp</strong>
			<span style="color:#E7D6CC;font-size:13.5px;line-height:1.6;display:block">Cửa kính panorama chạm sàn đón ánh sáng tự nhiên, sàn gỗ chống trơn và thiết bị tập chuyên nghiệp.</span>
		</div>
		<div style="background:rgba(0,0,0,0.3);padding:18px;border-radius:12px">
			<strong style="color:#A7F3D0;font-size:16px;display:block;margin-bottom:6px">🎪 Kid Zone Sáng Tạo</strong>
			<span style="color:#E7D6CC;font-size:13.5px;line-height:1.6;display:block">Không gian vui chơi trong nhà ấm áp, an toàn, giúp trẻ tự do sáng tạo và giao lưu cùng bạn bè đồng trang lứa.</span>
		</div>
	</div>
</div>
[/col]
[/row]

[/section]

[section label="6. Phân Tích Chuyên Sâu Tòa LALA 1" bg_color="#FFFFFF" padding="64px"]

[row]
[col span="12" span__sm="12"]
<div id="mat-bang-lala1" style="text-align:center;max-width:840px;margin:0 auto 34px">
	<span class="kbds-lala-badge">02 | TÒA MỞ BÁN ĐẦU TIÊN</span>
	<h2 style="color:#2D241E;font-size:30px;font-weight:900;margin:0 0 14px">4. Tòa LALA 1 – Mặt Bằng Điển Hình &amp; Cơ Cấu Căn Hộ</h2>
	<p style="color:#786558;font-size:16px;line-height:1.7;margin:0">Là tòa tháp được lựa chọn ra mắt đầu tiên, <strong>LALA 1</strong> sở hữu mật độ lý tưởng chỉ <strong>14 căn/sàn</strong> với 100% căn hộ vuông vắn, tối ưu mặt thoáng và ban công rộng mở.</p>
</div>
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]
{IMG_LALA1}
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]

<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:14px;margin-bottom:30px">
	<div class="kbds-lala-card" style="padding:18px;text-align:center">
		<strong style="display:block;font-size:26px;color:#C2562B;font-weight:900">20 Tầng</strong>
		<span style="font-size:13px;color:#786558">Chiều cao tòa</span>
	</div>
	<div class="kbds-lala-card" style="padding:18px;text-align:center">
		<strong style="display:block;font-size:26px;color:#C2562B;font-weight:900">252 Căn</strong>
		<span style="font-size:13px;color:#786558">Tổng số căn hộ</span>
	</div>
	<div class="kbds-lala-card" style="padding:18px;text-align:center">
		<strong style="display:block;font-size:26px;color:#C2562B;font-weight:900">14 Căn/Sàn</strong>
		<span style="font-size:13px;color:#786558">Mật độ thông thoáng</span>
	</div>
	<div class="kbds-lala-card" style="padding:18px;text-align:center">
		<strong style="display:block;font-size:24px;color:#C2562B;font-weight:900">36 – 100 m²</strong>
		<span style="font-size:13px;color:#786558">Diện tích đa dạng</span>
	</div>
	<div class="kbds-lala-card" style="padding:18px;text-align:center">
		<strong style="display:block;font-size:22px;color:#C2562B;font-weight:900">Studio – 3PN</strong>
		<span style="font-size:13px;color:#786558">Loại hình căn hộ</span>
	</div>
</div>

<div class="kbds-lala-card" style="padding:28px">
	<h3 style="color:#2D241E;font-size:20px;font-weight:800;margin:0 0 16px">Phân Tích Chi Tiết Layout Các Loại Căn Hộ Tòa LALA 1:</h3>
	<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:18px">
		<div style="background:#FFF9F5;border:1px solid #F3E5DC;border-radius:12px;padding:16px 18px">
			<strong style="color:#C2562B;font-size:16px;display:block;margin-bottom:6px">🏠 Căn Studio &amp; 1 Phòng Ngủ (36m² – 45m²)</strong>
			<p style="margin:0;font-size:14px;color:#4A3B32;line-height:1.65">Thiết kế thông minh không góc chết, bếp chữ I gọn gàng nối liền phòng khách và ban công. Lựa chọn số 1 cho người độc thân năng động và nhà đầu tư khai thác cho thuê với dòng vốn ban đầu thấp.</p>
		</div>
		<div style="background:#FFF9F5;border:1px solid #F3E5DC;border-radius:12px;padding:16px 18px">
			<strong style="color:#C2562B;font-size:16px;display:block;margin-bottom:6px">🏡 Căn 2 Phòng Ngủ (60m² – 75m²)</strong>
			<p style="margin:0;font-size:14px;color:#4A3B32;line-height:1.65">Phòng khách rộng rãi làm tâm điểm sinh hoạt, 2 phòng ngủ bố trí tách biệt đảm bảo sự riêng tư. Là loại hình có tính thanh khoản cao nhất, phục vụ nhu cầu định cư của đại đa số gia đình trẻ.</p>
		</div>
		<div style="background:#FFF9F5;border:1px solid #F3E5DC;border-radius:12px;padding:16px 18px">
			<strong style="color:#C2562B;font-size:16px;display:block;margin-bottom:6px">🏢 Căn 3 Phòng Ngủ (85m² – 100m²)</strong>
			<p style="margin:0;font-size:14px;color:#4A3B32;line-height:1.65">Căn góc đắt giá sở hữu 2 – 3 mặt thoáng view trực diện Đại lộ Thăng Long và công viên nội khu. Không gian sống đẳng cấp dành cho gia đình đa thế hệ cần sự tiện nghi trọn vẹn.</p>
		</div>
		<div style="background:#FFF9F5;border:1px solid #F3E5DC;border-radius:12px;padding:16px 18px">
			<strong style="color:#C2562B;font-size:16px;display:block;margin-bottom:6px">✨ Cơ Hội Đón Đầu Đợt 1 Tòa LALA 1</strong>
			<p style="margin:0;font-size:14px;color:#4A3B32;line-height:1.65">Mua ở đợt mở bán đầu tiên luôn được hưởng mức giá gốc ưu đãi nhất, quỹ căn tầng đẹp đa dạng nhất và biên độ tăng trưởng vốn cao nhất khi các tòa tiếp theo ra mắt.</p>
		</div>
	</div>
	<div style="text-align:center;margin-top:24px">
		[button text="📥 Tải Bản Vẽ Mặt Bằng Từng Căn Tòa LALA 1 (PDF Chuẩn 1/500)" color="secondary" size="large" radius="8" link="#nhan-bang-gia"]
	</div>
</div>

[/col]
[/row]

[/section]

[section label="7. Bộ Sưu Tập Căn Hộ Mẫu" bg_color="#FBF6F1" padding="64px"]

[row]
[col span="12" span__sm="12"]
<div id="can-ho-mau" style="text-align:center;max-width:840px;margin:0 auto 34px">
	<span class="kbds-lala-badge">KHÔNG GIAN NGHỆ THUẬT</span>
	<h2 style="color:#2D241E;font-size:30px;font-weight:900;margin:0 0 14px">5. Trải Nghiệm 3 Phong Cách Căn Hộ Mẫu Lalalay Residences</h2>
	<p style="color:#786558;font-size:16px;line-height:1.7;margin:0">Mỗi căn hộ mẫu tại Lalalay là một câu chuyện phong cách sống riêng biệt, truyền cảm hứng cho gia chủ kiến tạo tổ ấm mơ ước.</p>
</div>
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]

<div class="kbds-lala-card" style="padding:28px;margin-bottom:30px">
	<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;flex-wrap:wrap;gap:10px">
		<div>
			<span style="color:#C2562B;font-weight:800;font-size:12px;letter-spacing:1px;text-transform:uppercase">PHONG CÁCH TỐI GIẢN HIỆN ĐẠI (MODERN JAPANDI)</span>
			<h3 style="color:#2D241E;font-size:22px;font-weight:900;margin:4px 0 0">🛋️ Căn Hộ Mẫu 1 Phòng Ngủ – Thanh Lịch &amp; Tối Ưu Từng Mét Vuông</h3>
		</div>
		<span style="background:#FFF9F5;color:#C2562B;border:1px solid #F3E5DC;padding:5px 14px;border-radius:99px;font-size:13px;font-weight:700">Diện tích: ~45 m²</span>
	</div>
	<p style="font-size:14.5px;color:#4A3B32;line-height:1.7;margin-bottom:16px">Căn 1 phòng ngủ mẫu gây ấn tượng với hệ thống kệ sách kịch trần đa năng, bàn làm việc view ban công đón gió và tông màu be gỗ sáng thanh thoát. Đèn thả giọt nước tinh tế tạo điểm nhấn nghệ thuật cho phòng khách.</p>
	{IMG_MAU1PN}
</div>

<div class="kbds-lala-card" style="padding:28px;margin-bottom:30px">
	<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;flex-wrap:wrap;gap:10px">
		<div>
			<span style="color:#C2562B;font-weight:800;font-size:12px;letter-spacing:1px;text-transform:uppercase">PHONG CÁCH ẤM ÁP NĂNG ĐỘNG (RETRO CHIC)</span>
			<h3 style="color:#2D241E;font-size:22px;font-weight:900;margin:4px 0 0">🎨 Căn Hộ Mẫu 2 Phòng Ngủ – Trẻ Trung, Sắc Màu &amp; Gắn Kết Gia Đình</h3>
		</div>
		<span style="background:#FFF9F5;color:#C2562B;border:1px solid #F3E5DC;padding:5px 14px;border-radius:99px;font-size:13px;font-weight:700">Diện tích: ~68 m²</span>
	</div>
	<p style="font-size:14.5px;color:#4A3B32;line-height:1.7;margin-bottom:16px">Phối trộn hài hòa giữa sofa vàng mù tạt, tủ lạnh Smeg retro đỏ ruby và gạch ốp carô nghệ thuật. Phòng ngủ trẻ em phong cách safari xanh lá pastel mang lại không gian vui tươi kích thích sáng tạo cho con trẻ.</p>
	{IMG_MAU2PN}
</div>

<div class="kbds-lala-card" style="padding:28px">
	<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;flex-wrap:wrap;gap:10px">
		<div>
			<span style="color:#C2562B;font-weight:800;font-size:12px;letter-spacing:1px;text-transform:uppercase">PHONG CÁCH SANG TRỌNG THƯỢNG LƯU (LUXURY CONTEMPORARY)</span>
			<h3 style="color:#2D241E;font-size:22px;font-weight:900;margin:4px 0 0">👨‍👩‍👧 Căn Hộ Mẫu 3 Phòng Ngủ – Xứng Tầm Vị Thế Chủ Nhân</h3>
		</div>
		<span style="background:#FFF9F5;color:#C2562B;border:1px solid #F3E5DC;padding:5px 14px;border-radius:99px;font-size:13px;font-weight:700">Diện tích: ~95 m²</span>
	</div>
	<p style="font-size:14.5px;color:#4A3B32;line-height:1.7;margin-bottom:16px">Sử dụng đá marble cẩm thạch trắng mây ốp vách TV và bàn ăn, đèn chùm pha lê cao cấp tỏa sáng ấm áp. Phòng ngủ master góc kính panorama 180 độ view trọn vẹn đường chân trời phía Tây Hà Nội.</p>
	{IMG_MAU3PN}
</div>

[/col]
[/row]

[/section]

[section label="8. Tiêu Chuẩn Bàn Giao Cao Cấp" bg_color="#FFFFFF" padding="64px"]

[row]
[col span="12" span__sm="12"]
<div id="tieu-chuan-ban-giao" style="text-align:center;max-width:840px;margin:0 auto 34px">
	<span class="kbds-lala-badge">03 | TIÊU CHUẨN BÀN GIAO DỰ KIẾN</span>
	<h2 style="color:#2D241E;font-size:30px;font-weight:900;margin:0 0 14px">6. Danh Mục Tiêu Chuẩn Bàn Giao Căn Hộ Lalalay Residences</h2>
	<p style="color:#786558;font-size:16px;line-height:1.7;margin:0">Mỗi căn hộ khi bàn giao đều được kiểm định khắt khe theo các tiêu chuẩn kỹ thuật cao cấp nhất, sẵn sàng dọn về ở ngay.</p>
</div>
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]
{IMG_HANDOVER}
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:14px">
	<div class="kbds-lala-handover-item">
		<strong style="font-size:28px;color:#C2562B;display:block;margin-bottom:4px">01</strong>
		<h4 style="color:#2D241E;font-size:15px;margin:0 0 6px">Cửa Nhôm Kính Xingfa</h4>
		<p style="font-size:13.5px;color:#4A3B32;line-height:1.55;margin:0">Khung nhôm Xingfa nhập khẩu, kính dán an toàn 2 lớp cách âm và chống bức xạ nhiệt.</p>
	</div>
	<div class="kbds-lala-handover-item">
		<strong style="font-size:28px;color:#C2562B;display:block;margin-bottom:4px">02</strong>
		<h4 style="color:#2D241E;font-size:15px;margin:0 0 6px">Khóa Cửa Thông Minh 4-in-1</h4>
		<p style="font-size:13.5px;color:#4A3B32;line-height:1.55;margin:0">Cửa gỗ chống cháy cao cấp, khóa thông minh tích hợp vân tay, mã số, thẻ từ và chìa cơ.</p>
	</div>
	<div class="kbds-lala-handover-item">
		<strong style="font-size:28px;color:#C2562B;display:block;margin-bottom:4px">03</strong>
		<h4 style="color:#2D241E;font-size:15px;margin:0 0 6px">Điều Hòa Âm Trần</h4>
		<p style="font-size:13.5px;color:#4A3B32;line-height:1.55;margin:0">Hệ thống điều hòa âm trần nhập khẩu lắp sẵn, làm mát dịu nhẹ và tối ưu thẩm mỹ trần thạch cao.</p>
	</div>
	<div class="kbds-lala-handover-item">
		<strong style="font-size:28px;color:#C2562B;display:block;margin-bottom:4px">04</strong>
		<h4 style="color:#2D241E;font-size:15px;margin:0 0 6px">Full Bếp Nhập Khẩu</h4>
		<p style="font-size:13.5px;color:#4A3B32;line-height:1.55;margin:0">Bàn giao đầy đủ hệ tủ bếp trên &amp; dưới chống ẩm, bếp từ cao cấp và máy hút mùi chính hãng.</p>
	</div>
	<div class="kbds-lala-handover-item">
		<strong style="font-size:28px;color:#C2562B;display:block;margin-bottom:4px">05</strong>
		<h4 style="color:#2D241E;font-size:15px;margin:0 0 6px">Thiết Bị Vệ Sinh Cao Cấp</h4>
		<p style="font-size:13.5px;color:#4A3B32;line-height:1.55;margin:0">Phòng WC hoàn thiện với bồn cầu, lavabo, gương LED, vách tắm kính đứng nhập khẩu.</p>
	</div>
</div>
[/col]
[/row]

[/section]

[section label="9. 5 Lý Do Chọn Mua &amp; Đầu Tư Lalalay" bg_color="#FBF6F1" padding="64px"]

[row]
[col span="12" span__sm="12"]
<div id="ly-do-dau-tu" style="text-align:center;max-width:840px;margin:0 auto 34px">
	<span class="kbds-lala-badge">PHÂN TÍCH CHUYÊN GIA</span>
	<h2 style="color:#2D241E;font-size:30px;font-weight:900;margin:0 0 14px">7. 5 Lý Do Khách Hàng &amp; Nhà Đầu Tư Nên Chọn Lalalay Residences</h2>
	<p style="color:#786558;font-size:16px;line-height:1.7;margin:0">Tổng hòa giữa vị trí đắc địa, pháp lý lâu dài và chất lượng thi công đỉnh cao tạo nên tài sản truyền đời đắt giá.</p>
</div>
[/col]
[/row]

[row style="large"]
[col span="4" span__sm="12"]
<div class="kbds-lala-card">
	<span style="font-size:32px;display:block;margin-bottom:12px">💎</span>
	<h3 style="color:#C2562B;font-size:18px;font-weight:800;margin:0 0 10px">1. Pháp Lý Sở Hữu Lâu Dài Cực Hiếm</h3>
	<p style="color:#4A3B32;font-size:14.5px;line-height:1.7;margin:0">Trong bối cảnh quỹ đất nội đô cạn kiệt, dự án căn hộ sở hữu lâu dài, có quy hoạch 1/500 phê duyệt đầy đủ tại Hà Nội là tài sản tích sản gia tăng giá trị bền vững qua từng năm.</p>
</div>
[/col]

[col span="4" span__sm="12"]
<div class="kbds-lala-card">
	<span style="font-size:32px;display:block;margin-bottom:12px">🚇</span>
	<h3 style="color:#C2562B;font-size:18px;font-weight:800;margin:0 0 10px">2. Đòn Bẩy Hạ Tầng Metro 7 &amp; Vành Đai 3.5</h3>
	<p style="color:#4A3B32;font-size:14.5px;line-height:1.7;margin:0">Kề cận trực tiếp Ga Metro số 7 và tuyến Vành đai 3.5 giúp kết nối siêu tốc về Mỹ Đình chỉ 10 phút. Bất động sản kế cận ga Metro luôn có mức tăng giá từ 15% – 30% khi tuyến tàu điện đi vào vận hành.</p>
</div>
[/col]

[col span="4" span__sm="12"]
<div class="kbds-lala-card">
	<span style="font-size:32px;display:block;margin-bottom:12px">🛡️</span>
	<h3 style="color:#C2562B;font-size:18px;font-weight:800;margin:0 0 10px">3. Bảo Chứng Từ Tổng Thầu Delta</h3>
	<p style="color:#4A3B32;font-size:14.5px;line-height:1.7;margin:0">Delta Group là tổng thầu danh tiếng hàng đầu Việt Nam. Việc Delta thi công đảm bảo tuyệt đối về độ an toàn kết cấu, tính thẩm mỹ hoàn thiện và cam kết bàn giao đúng tiến độ năm 2029.</p>
</div>
[/col]
[/row]

[row style="large"]
[col span="6" span__sm="12"]
<div class="kbds-lala-card">
	<span style="font-size:32px;display:block;margin-bottom:12px">📈</span>
	<h3 style="color:#C2562B;font-size:18px;font-weight:800;margin:0 0 10px">4. Mức Giá Mở Bán Đợt 1 Tốt Nhất Tại Tòa LALA 1</h3>
	<p style="color:#4A3B32;font-size:14.5px;line-height:1.7;margin:0">Mua trong đợt mở bán đầu tiên tòa LALA 1 cho phép nhà đầu tư đón đầu nhịp sóng tăng giá ở các đợt mở bán tiếp theo (LALA 2, 3, 4). Tiến độ đóng tiền linh hoạt kéo dài đến năm 2029 giúp tối ưu đòn bẩy tài chính.</p>
</div>
[/col]

[col span="6" span__sm="12"]
<div class="kbds-lala-card">
	<span style="font-size:32px;display:block;margin-bottom:12px">💼</span>
	<h3 style="color:#C2562B;font-size:18px;font-weight:800;margin:0 0 10px">5. Nguồn Cầu Thuê Chuyên Gia Quốc Tế Dồi Dào</h3>
	<p style="color:#4A3B32;font-size:14.5px;line-height:1.7;margin:0">Nằm giữa Khu Công nghệ cao Hòa Lạc và trung tâm Mỹ Đình, Lalalay Residences là điểm đến lý tưởng của các chuyên gia, giảng viên, kỹ sư công nghệ với tỷ suất cho thuê dự kiến đạt 6% – 8%/năm.</p>
</div>
[/col]
[/row]

[/section]

[section label="10. Giỏ Hàng &amp; Bảng Tính Lãi Vay" bg_color="#FFFFFF" padding="64px"]

[row]
[col span="12" span__sm="12"]
<div id="bang-gia-chinh-sach"></div>
<span class="kbds-lala-badge">GIỎ HÀNG XÁC THỰC &amp; DÒNG TIỀN</span>
<h2 style="color:#2D241E;font-size:30px;font-weight:900;margin:0 0 20px">8. Giỏ Hàng Mở Bán Lalalay Residences &amp; Công Cụ Tính Lãi Vay Ngân Hàng</h2>

[kbds_project_listings project_id="{PROJECT_ID}" limit="6"]

[kbds_loan_calculator]
[/col]
[/row]

[/section]

[section label="11. Câu Hỏi Thường Gặp (FAQ Chuẩn SEO Schema)" bg_color="#FBF6F1" padding="64px"]

[row]
[col span="12" span__sm="12"]
<div id="faq"></div>
<span class="kbds-lala-badge">HỎI ĐÁP KHÁCH HÀNG</span>
<h2 style="color:#2D241E;font-size:30px;font-weight:900;margin:0 0 20px">9. Câu Hỏi Thường Gặp Về Dự Án Lalalay Residences Bắc An Khánh</h2>

[accordion]

[accordion-item title="1. Dự án Lalalay Residences nằm ở vị trí nào và kết nối giao thông ra sao?"]
<p>Dự án <strong>Lalalay Residences</strong> tọa lạc tại <strong>Bắc An Khánh, Hà Nội</strong>, nằm tại vị trí giao nhau đắc địa giữa <strong>Đại lộ Thăng Long (140m)</strong> và <strong>Đường Vành đai 3.5</strong>. Đặc biệt dự án kế cận <strong>Ga Metro số 7</strong> và gần <strong>Metro số 5</strong>, giúp cư dân dễ dàng di chuyển vào Mỹ Đình (10 phút), Cầu Giấy (15 phút) hoặc Khu công nghệ cao Hòa Lạc.</p>
[/accordion-item]

[accordion-item title="2. Quy mô dự án và số lượng căn hộ Lalalay Residences là bao nhiêu?"]
<p>Lalalay Residences được xây dựng trên khu đất rộng <strong>27.793 m²</strong>, gồm <strong>4 tòa tháp (LALA 1, LALA 2, LALA 3, LALA 4)</strong> cao <strong>20 tầng nổi, 3 tầng hầm thông nhau và 2 khối đế thương mại</strong>. Tổng số lượng căn hộ toàn dự án là <strong>1.492 căn</strong>, phục vụ quy mô dân số khoảng 2.999 người.</p>
[/accordion-item]

[accordion-item title="3. Dự án có những loại hình căn hộ nào và hình thức sở hữu ra sao?"]
<p>Dự án cung cấp cơ cấu căn hộ đa dạng: <strong>Studio (36m²), 1PN (45m²), 2PN (65m² – 75m²), 3PN (85m² – 100m²) và 4PN</strong>. Toàn bộ căn hộ tại Lalalay Residences đều có <strong>hình thức sở hữu lâu dài (Sổ hồng vĩnh viễn)</strong>.</p>
[/accordion-item]

[accordion-item title="4. Tòa nào mở bán đầu tiên và mật độ căn hộ như thế nào?"]
<p>Tòa mở bán đầu tiên là <strong>Tòa LALA 1</strong> có chiều cao <strong>20 tầng nổi, tổng 252 căn hộ</strong> với mật độ cực thoáng chỉ <strong>14 căn/sàn</strong>, đa dạng diện tích từ 36m² đến 100m².</p>
[/accordion-item]

[accordion-item title="5. Các đơn vị phát triển, thiết kế và thi công Lalalay Residences là ai?"]
<p>Dự án được đồng hành kiến tạo bởi <strong>Ramoori Holdings</strong>, tư vấn &amp; thiết kế bởi đơn vị quốc tế <strong>STELLAR</strong>, và được thi công bởi Tổng thầu xây dựng số 1 Việt Nam <strong>Delta Group</strong>, bảo chứng tuyệt đối cho tiến độ và chất lượng công trình.</p>
[/accordion-item]

[accordion-item title="6. Tiêu chuẩn bàn giao căn hộ Lalalay Residences gồm những gì?"]
<p>Căn hộ được bàn giao tiêu chuẩn cao cấp gồm: <strong>Cửa nhôm kính Xingfa</strong> cách âm 2 lớp; <strong>Cửa chống cháy</strong> kèm <strong>khóa thông minh 4 tính năng</strong>; <strong>Điều hòa âm trần</strong> lắp sẵn; <strong>Full hệ tủ bếp, bếp từ, máy hút mùi nhập khẩu</strong>; <strong>Phòng tắm &amp; WC hoàn thiện full thiết bị vệ sinh nhập khẩu</strong>.</p>
[/accordion-item]

[accordion-item title="7. Khi nào dự án Lalalay Residences được bàn giao nhà?"]
<p>Theo kế hoạch triển khai của chủ đầu tư và tổng thầu Delta, dự án dự kiến sẽ hoàn thiện và bàn giao nhà cho cư dân vào <strong>Năm 2029</strong> với đầy đủ hệ sinh thái 16 tiện ích và tiện ích tòa LALA 4.</p>
[/accordion-item]

[/accordion]
[/col]
[/row]

[/section]

[section label="12. Form Đăng Ký Nhận Bảng Giá &amp; Tham Quan Nhà Mẫu" bg_color="#FFFFFF" padding="60px"]

[row]
[col span="12" span__sm="12"]
<div id="nhan-bang-gia"></div>
[kbds_lead_form title="📥 Đăng Ký Nhận Bảng Giá Gốc, Mặt Bằng 1/500 &amp; Lịch Xem Căn Hộ Mẫu Lalalay Residences" project="Lalalay Residences"]
[/col]
[/row]

[/section]
EOD;

$content = strtr( $content, $P );

// Cập nhật post_content
wp_update_post( array(
	'ID'           => $post_id,
	'post_content' => $content,
) );

// Cập nhật Meta SEO & Thông số dự án
$meta = array(
	'_kbds_project_code'       => 'DA-LALALAY-HN',
	'_kbds_price_from'         => 'Đang cập nhật (Mở bán Đợt 1 Tòa LALA 1)',
	'_kbds_address'            => 'Bắc An Khánh, Hà Nội (Giao điểm Đại lộ Thăng Long × Vành đai 3.5)',
	'_kbds_total_area'         => '27.793 m² (Quy mô dân số 2.999 người)',
	'_kbds_scale'              => '4 tòa tháp (LALA 1 - 4), 20 tầng nổi, 3 hầm, 2 khối đế TMDV • 1.492 căn hộ (Studio – 4PN)',
	'_kbds_legal_status'       => 'QHCT 1/500 đã phê duyệt • Chấp thuận chủ trương đầu tư • Sở hữu lâu dài',
	'_kbds_handover_time'      => 'Dự kiến Năm 2029 • Mở bán Tòa LALA 1 đầu tiên',
	'_kbds_bank_support'       => 'Hỗ trợ vay ngân hàng lên tới 70% • Ân hạn nợ gốc & Lãi suất 0%',
	'_kbds_review_score'       => '9.4',
	'_kbds_pros_cons'          => "+ Vị trí giao điểm vàng Đại lộ Thăng Long & Vành đai 3.5, sát Ga Metro số 7.\n+ Pháp lý hoàn chỉnh: QHCT 1/500 phê duyệt, sở hữu lâu dài sổ hồng.\n+ Mở bán đợt 1 tòa LALA 1 mật độ thoáng chỉ 14 căn/sàn.\n+ Tổng thầu Delta Group bảo chứng chất lượng và tiến độ thi công.\n+ Chuỗi 16 tiện ích ngoài trời và đặc quyền tòa LALA 4 (Bắn cung trong nhà, Gym & Yoga).",
	'rank_math_focus_keyword'  => 'Lalalay Residences,dự án Lalalay Residences,Lalalay Bắc An Khánh,căn hộ Lalalay,tòa LALA 1,giá bán Lalalay Residences',
	'rank_math_title'          => 'Lalalay Residences Bắc An Khánh: Bảng Giá, Mặt Bằng Tòa LALA 1 & Pháp Lý 2026',
	'rank_math_description'    => 'Thông tin chính thức dự án Lalalay Residences Bắc An Khánh, Hà Nội: 4 tòa 20 tầng, 1.492 căn hộ Studio - 4PN sở hữu lâu dài. Tòa LALA 1 mở bán đợt 1 giá gốc, sát Ga Metro số 7.',
	'rank_math_pillar_content' => 'on',
	'rank_math_seo_score'      => 95,
);

foreach ( $meta as $k => $v ) {
	update_post_meta( $post_id, $k, $v );
}

echo "✔ ĐÃ NÂNG CẤP THÀNH CÔNG TRANG DỰ ÁN LALALAY RESIDENCES (POST ID {$post_id})!\n";
echo "URL xem thử: " . get_permalink( $post_id ) . "\n";
