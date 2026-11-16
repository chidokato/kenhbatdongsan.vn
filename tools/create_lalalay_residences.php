<?php
/**
 * Tạo / cập nhật Landing Page dự án LALALAY RESIDENCES (Bắc An Khánh, Hà Nội)
 * - Import 11 ảnh chuẩn SEO vào Media Library
 * - Tạo hồ sơ Dự án (du_an) đầy đủ meta, taxonomy, ảnh đại diện, nội dung UX Builder
 * Chạy: C:\xampp\php\php.exe tools\create_lalalay_residences.php
 */

define( 'WP_USE_THEMES', false );
require_once __DIR__ . '/../wp-load.php';
require_once ABSPATH . 'wp-content/plugins/kenhbds-data-manager/includes/class-kbds-auto-publisher.php';

$src_dir = 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/';
$kw      = 'Lalalay Residences';

$images = array(
	'hero'      => array( 'media_1794798516093_b5ce3101.jpg', 'phoi-canh-lalalay-residences-bac-an-khanh', 'Phối Cảnh Dự Án Lalalay Residences Bắc An Khánh Hà Nội', 'Phối cảnh mặt tiền tòa tháp và biển hiệu dự án Lalalay Residences Bắc An Khánh Hà Nội lúc hoàng hôn', 'Phối cảnh tổng thể mặt tiền dự án Lalalay Residences.' ),
	'info'      => array( 'media_1794798515916_3bc80983.jpg', 'thong-tin-du-an-lalalay-residences', 'Thông Tin Tổng Quan Dự Án Lalalay Residences', 'Bảng thông tin tổng quan dự án Lalalay Residences 4 tòa 1.492 căn hộ Bắc An Khánh', 'Thông tin tổng quan dự án Lalalay Residences.' ),
	'location'  => array( 'media_1794798516082_41819ad3.jpg', 'vi-tri-du-an-lalalay-residences-dai-lo-thang-long', 'Vị Trí Dự Án Lalalay Residences Đại Lộ Thăng Long', 'Bản đồ vị trí dự án Lalalay Residences giao Đại lộ Thăng Long và Vành đai 3.5 gần Ga Metro số 7', 'Vị trí Lalalay Residences – giao điểm Đại lộ Thăng Long & Vành đai 3.5.' ),
	'connect'   => array( 'media_1794798516073_00e79d8f.jpg', 'ket-noi-15-phut-lalalay-residences', 'Lalalay Residences 15 Phút Nối Liền Mọi Tiện Ích', 'Sơ đồ kết nối 5 10 15 phút từ dự án Lalalay Residences tới Metro trường học bệnh viện TTTM', '15 phút nối liền mọi tiện ích từ Lalalay Residences.' ),
	'masterplan'=> array( 'media_1794798516085_ab598135.jpg', 'tong-mat-bang-tien-ich-lalalay-residences', 'Tổng Mặt Bằng Tiện Ích Dự Án Lalalay Residences', 'Tổng mặt bằng tiện ích 4 tòa LALA 1 LALA 2 LALA 3 LALA 4 dự án Lalalay Residences', 'Tổng mặt bằng tiện ích dự án Lalalay Residences (4 tòa LALA 1 – LALA 4).' ),
	'lala1'     => array( 'media_1794798516064_18c3c47d.jpg', 'toa-lala-1-mo-ban-dau-tien-lalalay-residences', 'Tòa LALA 1 Mở Bán Đầu Tiên Lalalay Residences', 'Tòa LALA 1 mở bán đầu tiên dự án Lalalay Residences 20 tầng 252 căn hộ mặt bằng tầng điển hình', 'Tòa LALA 1 – tòa mở bán đầu tiên: 20 tầng, 252 căn hộ.' ),
	'amenity4'  => array( 'media_1794798516078_d4e8be92.jpg', 'tien-ich-noi-khu-toa-lala-4-lalalay-residences', 'Tiện Ích Nội Khu Tòa LALA 4 Lalalay Residences', 'Tiện ích nội khu tòa LALA 4 Lalalay Residences phòng gym yoga bắn cung trong nhà kid zone', 'Tiện ích nội khu tòa LALA 4: Gym & Yoga, bắn cung trong nhà, Kid zone.' ),
	'mau1pn'    => array( 'media_1794798516061_2e5b6e4f.jpg', 'can-ho-mau-1-phong-ngu-lalalay-residences', 'Căn Hộ Mẫu 1 Phòng Ngủ Lalalay Residences', 'Thiết kế nội thất căn hộ mẫu 1 phòng ngủ dự án Lalalay Residences', 'Căn hộ mẫu 1 phòng ngủ Lalalay Residences.' ),
	'mau2pn'    => array( 'media_1794798516068_30a76724.jpg', 'can-ho-mau-2-phong-ngu-lalalay-residences', 'Căn Hộ Mẫu 2 Phòng Ngủ Lalalay Residences', 'Thiết kế nội thất căn hộ mẫu 2 phòng ngủ dự án Lalalay Residences', 'Căn hộ mẫu 2 phòng ngủ Lalalay Residences.' ),
	'mau3pn'    => array( 'media_1794798515918_375d237e.jpg', 'can-ho-mau-3-phong-ngu-lalalay-residences', 'Căn Hộ Mẫu 3 Phòng Ngủ Lalalay Residences', 'Thiết kế nội thất căn hộ mẫu 3 phòng ngủ dự án Lalalay Residences', 'Căn hộ mẫu 3 phòng ngủ Lalalay Residences.' ),
	'handover'  => array( 'media_1794798516056_dd7c6bfa.jpg', 'tieu-chuan-ban-giao-lalalay-residences', 'Tiêu Chuẩn Bàn Giao Căn Hộ Lalalay Residences', 'Tiêu chuẩn bàn giao dự kiến căn hộ Lalalay Residences cửa Xingfa khóa thông minh điều hòa âm trần', 'Tiêu chuẩn bàn giao dự kiến căn hộ Lalalay Residences.' ),
);

// ---------- 1. Import ảnh (bỏ qua nếu đã import trước đó) ----------
$img = array();
$idx = 1;
foreach ( $images as $key => $d ) {
	list( $file, $slug, $title, $alt, $caption ) = $d;
	$existing = get_posts( array( 'post_type' => 'attachment', 'name' => $slug, 'posts_per_page' => 1, 'post_status' => 'inherit' ) );
	if ( $existing ) {
		$id = $existing[0]->ID;
	} else {
		$res = KBDS_Auto_Publisher::import_and_optimize_seo_image( $src_dir . $file, array(
			'focus_keyword' => $kw,
			'image_title'   => $title,
			'alt_text'      => $alt,
			'caption'       => $caption,
			'description'   => $caption,
			'slug_prefix'   => $slug,
			'index'         => $idx,
		) );
		if ( is_wp_error( $res ) ) {
			die( "[-] Lỗi import {$file}: " . $res->get_error_message() . "\n" );
		}
		$id = $res['id'];
		wp_update_post( array( 'ID' => $id, 'post_name' => $slug ) );
	}
	$img[ $key ] = array(
		'id'  => $id,
		'url' => wp_get_attachment_url( $id ),
		'alt' => $alt,
		'cap' => $caption,
	);
	echo "[+] Ảnh {$key}: ID {$id}\n";
	$idx++;
}

function lala_img( $img, $key, $caption = true ) {
	$i   = $img[ $key ];
	$out = '<figure class="kbds-proj-figure" style="margin:0 0 18px"><img src="' . esc_url( $i['url'] ) . '" alt="' . esc_attr( $i['alt'] ) . '" loading="lazy" style="width:100%;height:auto;display:block;border-radius:14px;box-shadow:0 8px 28px rgba(11,44,77,.12)" />';
	if ( $caption ) {
		$out .= '<figcaption style="text-align:center;font-size:13px;color:#64748b;margin-top:8px;font-style:italic">' . esc_html( $i['cap'] ) . '</figcaption>';
	}
	return $out . '</figure>';
}

// ---------- 2. Nội dung trang dự án ----------
$P = array();
foreach ( $img as $k => $v ) {
	$P[ '{IMG_' . strtoupper( $k ) . '}' ] = lala_img( $img, $k );
}
$P['{HERO_URL}'] = $img['hero']['url'];

$content = <<<'EOD'
[section label="1. Hero Banner Lalalay Residences" bg="{HERO_URL}" bg_size="original" bg_overlay="rgba(40, 18, 10, 0.72)" dark="true" padding="60px"]

[row style="large" v_align="middle"]

[col span="7" span__sm="12"]

<div style="display:inline-flex;align-items:center;gap:8px;border:1px solid #F0B48A;color:#FFD9BF;padding:6px 16px;border-radius:99px;font-size:12.5px;font-weight:700;letter-spacing:0.6px;margin-bottom:16px">
	<span>🌇 BẮC AN KHÁNH • GIAO ĐIỂM ĐẠI LỘ THĂNG LONG &amp; VÀNH ĐAI 3.5</span>
</div>

<h1 style="font-size:36px;font-weight:800;line-height:1.25;color:#ffffff;margin:0 0 16px">Lalalay Residences – Tổ Hợp 4 Tòa Căn Hộ Sở Hữu Lâu Dài Tại Bắc An Khánh, Hà Nội</h1>

<p style="font-size:16px;line-height:1.7;color:#f1e4dc;margin-bottom:24px"><strong>Lalalay Residences</strong> gồm <strong>4 tòa 20 tầng nổi, 3 hầm và 2 khối đế TMDV</strong> trên khu đất <strong>27.793 m²</strong>, cung cấp <strong>1.492 căn hộ</strong> Studio – 4PN sở hữu lâu dài. Dự án do <strong>Ramoori Holdings</strong> đồng hành kiến tạo, <strong>STELLAR</strong> tư vấn thiết kế và <strong>Delta</strong> làm tổng thầu – định vị chuẩn sống <em>“Sống đủ đầy – Vui all day”</em>.</p>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px">
	<div style="border-radius:10px;padding:12px 14px">
		<strong style="display:block;font-size:22px;font-weight:800;color:#F7B98B">4 tòa</strong>
		<span style="font-size:12.5px;color:#e7d6cc">20 tầng nổi • 3 hầm</span>
	</div>
	<div style="border-radius:10px;padding:12px 14px">
		<strong style="display:block;font-size:22px;font-weight:800;color:#FDE68A">1.492</strong>
		<span style="font-size:12.5px;color:#e7d6cc">Căn hộ</span>
	</div>
	<div style="border-radius:10px;padding:12px 14px">
		<strong style="display:block;font-size:22px;font-weight:800;color:#A7F3D0">27.793 m²</strong>
		<span style="font-size:12.5px;color:#e7d6cc">Tổng diện tích đất</span>
	</div>
	<div style="border-radius:10px;padding:12px 14px">
		<strong style="display:block;font-size:22px;font-weight:800;color:#BAE6FD">2029</strong>
		<span style="font-size:12.5px;color:#e7d6cc">Dự kiến bàn giao</span>
	</div>
</div>

[button text="📥 Nhận Bảng Giá &amp; Mặt Bằng LALA 1" color="secondary" size="larger" radius="8" link="#nhan-bang-gia"]
[button text="📞 Hotline Tư Vấn: 0942.655.111" style="outline" color="white" size="larger" radius="8" link="tel:0942655111"]

[/col]

[col span="5" span__sm="12"]

[kbds_quick_lead_card title="ĐĂNG KÝ NHẬN TÀI LIỆU LALALAY" subtitle="Nhận Bảng giá dự kiến, Mặt bằng tòa LALA 1, Chính sách bán hàng &amp; Tiêu chuẩn bàn giao qua Zalo:" project="Lalalay Residences"]

[/col]

[/row]

[/section]

[section label="2. Menu Phụ Điều Hướng Dự Án (Sticky Sub-Nav)" class="kbds-proj-sticky-subnav" bg_color="#ffffff" padding="0px"]

<div class="kbds-proj-nav-container">
	<nav class="kbds-proj-nav">
		<a href="#tong-quan">Tổng Quan</a>
		<a href="#vi-tri">Vị Trí</a>
		<a href="#tien-ich">Tiện Ích</a>
		<a href="#san-pham">Tòa LALA 1</a>
		<a href="#can-ho-mau">Căn Hộ Mẫu</a>
		<a href="#ban-giao">Bàn Giao</a>
		<a href="#nhan-bang-gia" class="kbds-proj-nav-cta">Nhận Bảng Giá</a>
	</nav>
</div>

[/section]

[section label="3. Tổng Quan Dự Án &amp; Thông Số" bg_color="#FBF6F1" padding="60px"]

[row style="large" v_align="top"]

[col span="7" span__sm="12"]

<div id="tong-quan"></div>
<span class="kbds-sub-badge">01 | THÔNG TIN DỰ ÁN</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 16px;line-height:1.3">1. Tổng Quan Dự Án Lalalay Residences Bắc An Khánh</h2>

<p style="font-size:15.5px;line-height:1.75;color:#334155"><strong>Lalalay Residences</strong> là tổ hợp căn hộ tọa lạc tại <strong>Bắc An Khánh, Hà Nội</strong> – ngay giao điểm <strong>Đại lộ Thăng Long</strong> và <strong>Vành đai 3.5</strong>, cạnh <strong>Ga Metro số 7</strong>. Dự án quy mô <strong>4 tòa, 20 tầng nổi, 3 tầng hầm và 2 khối đế thương mại dịch vụ</strong> trên tổng diện tích đất <strong>27.793 m²</strong>, đáp ứng cơ cấu dân số khoảng <strong>2.999 người</strong>.</p>

<p style="font-size:15.5px;line-height:1.75;color:#334155">Kiến trúc dự án nổi bật với những dải ban công cong mềm mại tầng tầng lớp lớp và khối đế vòm cột hình hoa cách điệu tông đỏ đất nung – tạo nên diện mạo độc đáo, giàu cảm xúc giữa khu vực phía Tây Hà Nội. Sản phẩm đa dạng từ <strong>Studio, 1PN, 2PN, 3PN đến 4PN</strong>, tất cả đều <strong>sở hữu lâu dài</strong>.</p>

<div style="background:#ffffff;border-left:4px solid #C2562B;border-radius:10px;padding:18px 20px;margin:20px 0">
	<h3 style="color:#0B2C4D;font-size:18px;font-weight:800;margin:0 0 8px">⚖️ Pháp lý minh bạch</h3>
	<p style="margin:0;font-size:15px;line-height:1.65;color:#475569">Dự án đã có <strong>Quy hoạch chi tiết 1/500 được phê duyệt</strong> và <strong>Chấp thuận chủ trương đầu tư</strong> – nền tảng pháp lý vững chắc cho khách hàng an cư lẫn nhà đầu tư.</p>
</div>

<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:14px;margin-top:20px">
	<div class="kbds-ux-card" style="padding:16px 18px">
		<strong style="color:#0B2C4D;font-size:15px;display:block;margin-bottom:4px">🏗️ Đội ngũ kiến tạo uy tín</strong>
		<span style="font-size:13.5px;color:#64748b;line-height:1.5;display:block">Ramoori Holdings đồng hành kiến tạo, STELLAR tư vấn &amp; thiết kế, Delta tổng thầu xây dựng.</span>
	</div>
	<div class="kbds-ux-card" style="padding:16px 18px">
		<strong style="color:#C2562B;font-size:15px;display:block;margin-bottom:4px">🚇 Sát Ga Metro số 7</strong>
		<span style="font-size:13.5px;color:#64748b;line-height:1.5;display:block">5 phút tới Ga Metro số 5 &amp; 7, kết nối nhanh Mỹ Đình và trung tâm Thủ đô.</span>
	</div>
</div>

[/col]

[col span="5" span__sm="12"]

<div style="background:#ffffff;border:2px solid #0B2C4D;border-radius:14px;overflow:hidden">
	<div style="background:linear-gradient(135deg,#7A2E14 0%,#C2562B 100%);color:#ffffff;padding:18px 22px">
		<span style="font-size:11.5px;color:#FFD9BF;font-weight:700;letter-spacing:0.5px;display:block">BẢNG THÔNG SỐ CHÍNH THỨC</span>
		<strong style="font-size:18px">Hồ Sơ Dự Án Lalalay Residences</strong>
	</div>
	<div style="padding:8px 20px 18px">
		<table style="width:100%;border-collapse:collapse;font-size:14px">
			<tbody>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569;width:42%">Tên dự án:</td><td style="padding:10px 4px;font-weight:800;color:#0B2C4D">LALALAY RESIDENCES</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Vị trí:</td><td style="padding:10px 4px;font-weight:700;color:#1e293b">Bắc An Khánh, Hà Nội</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Quy mô xây dựng:</td><td style="padding:10px 4px;font-weight:700;color:#1e293b">4 tòa, 20 tầng nổi, 3 hầm, 2 khối đế TMDV</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Số lượng căn:</td><td style="padding:10px 4px;font-weight:800;color:#C2562B">1.492 căn</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Tổng diện tích đất:</td><td style="padding:10px 4px;font-weight:800;color:#0E8A4A">27.793 m²</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Sản phẩm:</td><td style="padding:10px 4px;font-weight:700;color:#1e293b">Studio | 1PN | 2PN | 3PN | 4PN (Sở hữu lâu dài)</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Cơ cấu dân số:</td><td style="padding:10px 4px;font-weight:700;color:#1e293b">2.999 người</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Nhà đồng hành kiến tạo:</td><td style="padding:10px 4px;font-weight:700;color:#C2562B">Ramoori Holdings</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Tư vấn &amp; Thiết kế:</td><td style="padding:10px 4px;font-weight:700;color:#1e293b">STELLAR</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Tổng thầu xây dựng:</td><td style="padding:10px 4px;font-weight:700;color:#1e293b">Delta</td></tr>
				<tr style="border-bottom:1px solid #e2e8f0"><td style="padding:10px 4px;font-weight:600;color:#475569">Pháp lý:</td><td style="padding:10px 4px;font-weight:700;color:#0B2C4D">QHCT 1/500 đã phê duyệt | Chấp thuận chủ trương đầu tư</td></tr>
				<tr><td style="padding:10px 4px;font-weight:600;color:#475569">Bàn giao:</td><td style="padding:10px 4px;font-weight:800;color:#0B2C4D">Dự kiến 2029</td></tr>
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

[section label="4. Vị Trí &amp; Kết Nối 15 Phút" bg_color="#ffffff" padding="60px"]

[row style="large" v_align="middle"]

[col span="7" span__sm="12"]

<div id="vi-tri"></div>
{IMG_LOCATION}

[/col]

[col span="5" span__sm="12"]

<span class="kbds-sub-badge">VỊ TRÍ GIAO ĐIỂM HUYẾT MẠCH PHÍA TÂY</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 16px;line-height:1.3">2. Vị Trí Lalalay Residences – 15 Phút Nối Liền Mọi Tiện Ích</h2>

<p style="font-size:15.5px;line-height:1.75;color:#334155">Dự án nằm ngay nút giao <strong>Đại lộ Thăng Long × Vành đai 3.5</strong>, cạnh <strong>Ga Metro số 7</strong> và gần tuyến <strong>Metro số 5</strong> – thuận tiện di chuyển về Mỹ Đình, Hà Đông, Khu công nghệ cao Hòa Lạc và các hướng cao tốc.</p>

<div style="background:#FBF6F1;border-radius:12px;padding:16px 18px;margin-bottom:12px">
	<strong style="color:#C2562B;font-size:17px">⏱ 5 phút</strong>
	<p style="margin:6px 0 0;font-size:14.5px;line-height:1.65;color:#334155">Ga Metro số 5 &amp; 7 • Trường quốc tế St Paul • Vinschool Thăng Long • Công viên Thiên đường Bảo Sơn</p>
</div>
<div style="background:#FBF6F1;border-radius:12px;padding:16px 18px;margin-bottom:12px">
	<strong style="color:#C2562B;font-size:17px">⏱ 10 phút</strong>
	<p style="margin:6px 0 0;font-size:14.5px;line-height:1.65;color:#334155">KĐT đa mục tiêu • Bảo tàng Lịch sử Quân sự Việt Nam • SVĐ Quốc gia Mỹ Đình • Bệnh viện ĐKQT Vinmec &amp; Hồng Ngọc • Vincom Mega Mall Smart City • Trung tâm Hội nghị Quốc gia</p>
</div>
<div style="background:#FBF6F1;border-radius:12px;padding:16px 18px;margin-bottom:20px">
	<strong style="color:#C2562B;font-size:17px">⏱ 15 phút</strong>
	<p style="margin:6px 0 0;font-size:14.5px;line-height:1.65;color:#334155">Aeon Mall Hà Đông • Bệnh viện Huyết học TW • Bệnh viện Đa khoa Hoài Đức • Bến xe Mỹ Đình • Khu công nghệ cao Hòa Lạc</p>
</div>

[button text="🗺️ Nhận Bản Đồ Vị Trí &amp; Quy Hoạch" color="primary" size="large" radius="8" link="#nhan-bang-gia"]

[/col]

[/row]

[row style="large" v_align="middle"]
[col span="5" span__sm="12"]
{IMG_CONNECT}
[/col]
[col span="7" span__sm="12"]
{IMG_HERO}
[/col]
[/row]

[/section]

[section label="5. Tiện Ích Dự Án" bg_color="#2A1A12" dark="true" padding="64px"]

[row]
[col span="12" span__sm="12"]
<div id="tien-ich" style="text-align:center;max-width:820px;margin:0 auto 32px">
	<span style="display:inline-block;border:1px solid #F0B48A;color:#FFD9BF;padding:5px 16px;border-radius:99px;font-size:12px;font-weight:700;letter-spacing:0.6px;margin-bottom:12px">SỐNG ĐỦ ĐẦY – VUI ALL DAY</span>
	<h2 style="color:#ffffff;font-size:30px;font-weight:800;margin:0 0 12px">3. Tổng Mặt Bằng &amp; Hệ Tiện Ích Lalalay Residences</h2>
	<p style="color:#e7d6cc;font-size:15.5px;line-height:1.65;margin:0">16 tiện ích ngoài trời trải dài giữa 4 tòa LALA 1 – LALA 4, cùng chuỗi tiện ích trong nhà và kết nối Công viên Thành phố, nhà đỗ xe nổi thành phố.</p>
</div>
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]
{IMG_MASTERPLAN}
[/col]
[/row]

[row style="normal"]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">🌿</div>
	<h3 style="color:#F7B98B;font-size:19px;font-weight:800;margin:0 0 10px">Cảnh Quan &amp; Thư Giãn</h3>
	<p style="color:#e7d6cc;font-size:14.5px;line-height:1.65;margin:0">Thác nước Thư Thái • Khu nghỉ chân • Đường dạo massage chân • Đường dạo bộ Thảnh Thơi • Đường dạo bộ Tiết Tấu • Vườn cảnh quan Phiêu Nhịp</p>
</div>
[/col]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">🎠</div>
	<h3 style="color:#FDE68A;font-size:19px;font-weight:800;margin:0 0 10px">Vui Chơi &amp; Gia Đình</h3>
	<p style="color:#e7d6cc;font-size:14.5px;line-height:1.65;margin:0">Quảng trường Rong Chơi • 2 khu vui chơi trẻ em • Màn nước Sắc Màu • Quảng trường Giao Hưởng • Đài Ngắm Vàng</p>
</div>
[/col]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">🏋️</div>
	<h3 style="color:#A7F3D0;font-size:19px;font-weight:800;margin:0 0 10px">Thể Thao &amp; Biểu Tượng</h3>
	<p style="color:#e7d6cc;font-size:14.5px;line-height:1.65;margin:0">Khu gym ngoài trời • Biểu tượng Miền hoa đá • Biểu tượng Miền khởi sinh • Biển hiệu dự án • Công viên Thành phố kế cận</p>
</div>
[/col]

[/row]

[row style="large" v_align="middle"]
[col span="12" span__sm="12"]
<h3 style="color:#ffffff;font-size:22px;font-weight:800;margin:10px 0 14px;text-align:center">Tiện Ích Nội Khu Tòa LALA 4: Gym &amp; Yoga • Bắn Cung Trong Nhà • Kid Zone</h3>
{IMG_AMENITY4}
[/col]
[/row]

[/section]

[section label="6. Tòa LALA 1 Mở Bán Đầu Tiên" bg_color="#ffffff" padding="60px"]

[row]
[col span="12" span__sm="12"]
<div id="san-pham" style="text-align:center;max-width:800px;margin:0 auto 30px">
	<span class="kbds-sub-badge">02 | TÒA MỞ BÁN ĐẦU TIÊN</span>
	<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 12px">4. Tòa LALA 1 – Mặt Bằng &amp; Cơ Cấu Căn Hộ</h2>
	<p style="color:#64748B;font-size:15.5px;margin:0">Tòa LALA 1 là tòa đầu tiên được mở bán của Lalalay Residences với mật độ chỉ 14 căn/sàn.</p>
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
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:14px">
	<div class="kbds-ux-card" style="padding:18px;text-align:center"><strong style="display:block;font-size:24px;color:#C2562B">20</strong><span style="font-size:13px;color:#64748b">Tầng cao</span></div>
	<div class="kbds-ux-card" style="padding:18px;text-align:center"><strong style="display:block;font-size:24px;color:#C2562B">252</strong><span style="font-size:13px;color:#64748b">Tổng số căn hộ</span></div>
	<div class="kbds-ux-card" style="padding:18px;text-align:center"><strong style="display:block;font-size:24px;color:#C2562B">14</strong><span style="font-size:13px;color:#64748b">Căn / sàn</span></div>
	<div class="kbds-ux-card" style="padding:18px;text-align:center"><strong style="display:block;font-size:24px;color:#C2562B">36 – 100 m²</strong><span style="font-size:13px;color:#64748b">Diện tích căn hộ</span></div>
	<div class="kbds-ux-card" style="padding:18px;text-align:center"><strong style="display:block;font-size:20px;color:#C2562B">Studio – 3PN</strong><span style="font-size:13px;color:#64748b">Loại căn hộ</span></div>
</div>
<div style="text-align:center;margin-top:22px">
	<a href="#nhan-bang-gia" style="display:inline-block;background:#C2562B;color:#fff;font-weight:700;padding:12px 24px;border-radius:8px;text-decoration:none;font-size:14px">📥 Nhận Mặt Bằng Chi Tiết &amp; Bảng Giá Tòa LALA 1 →</a>
</div>
[/col]
[/row]

[/section]

[section label="7. Căn Hộ Mẫu" bg_color="#FBF6F1" padding="60px"]

[row]
[col span="12" span__sm="12"]
<div id="can-ho-mau" style="text-align:center;max-width:800px;margin:0 auto 30px">
	<span class="kbds-sub-badge">KHÔNG GIAN SỐNG TINH TẾ</span>
	<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 12px">5. Căn Hộ Mẫu Lalalay Residences</h2>
	<p style="color:#64748B;font-size:15.5px;margin:0">Ba phong cách nội thất gợi ý cho căn 1PN, 2PN và 3PN – tối ưu công năng, ngập tràn ánh sáng tự nhiên.</p>
</div>
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]
<h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 12px">🛋️ Căn hộ mẫu 1 phòng ngủ</h3>
{IMG_MAU1PN}
<h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:20px 0 12px">🎨 Căn hộ mẫu 2 phòng ngủ</h3>
{IMG_MAU2PN}
<h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:20px 0 12px">👨‍👩‍👧 Căn hộ mẫu 3 phòng ngủ</h3>
{IMG_MAU3PN}
[/col]
[/row]

[/section]

[section label="8. Tiêu Chuẩn Bàn Giao" bg_color="#ffffff" padding="60px"]

[row]
[col span="12" span__sm="12"]
<div id="ban-giao" style="text-align:center;max-width:800px;margin:0 auto 30px">
	<span class="kbds-sub-badge">03 | TIÊU CHUẨN BÀN GIAO DỰ KIẾN</span>
	<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 12px">6. Tiêu Chuẩn Bàn Giao Căn Hộ Lalalay Residences</h2>
</div>
[/col]
[/row]

[row style="large"]
[col span="12" span__sm="12"]
{IMG_HANDOVER}
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:14px;margin-top:10px">
	<div class="kbds-ux-card" style="padding:16px"><strong style="font-size:26px;color:#C2562B">1</strong><p style="margin:6px 0 0;font-size:14px;color:#334155;line-height:1.55">Hệ cửa nhôm kính khung <strong>Xingfa</strong> cao cấp</p></div>
	<div class="kbds-ux-card" style="padding:16px"><strong style="font-size:26px;color:#C2562B">2</strong><p style="margin:6px 0 0;font-size:14px;color:#334155;line-height:1.55">Cửa ra vào chống cháy, kèm <strong>khóa thông minh</strong> nhập khẩu 4 tính năng</p></div>
	<div class="kbds-ux-card" style="padding:16px"><strong style="font-size:26px;color:#C2562B">3</strong><p style="margin:6px 0 0;font-size:14px;color:#334155;line-height:1.55">Hệ <strong>điều hòa âm trần</strong> nhập khẩu</p></div>
	<div class="kbds-ux-card" style="padding:16px"><strong style="font-size:26px;color:#C2562B">4</strong><p style="margin:6px 0 0;font-size:14px;color:#334155;line-height:1.55">Bếp bàn giao đủ <strong>tủ, bếp, hút mùi</strong> nhập khẩu cao cấp</p></div>
	<div class="kbds-ux-card" style="padding:16px"><strong style="font-size:26px;color:#C2562B">5</strong><p style="margin:6px 0 0;font-size:14px;color:#334155;line-height:1.55">Phòng WC với <strong>thiết bị vệ sinh nhập khẩu</strong> cao cấp</p></div>
</div>
[/col]
[/row]

[/section]

[section label="9. Giỏ Hàng &amp; Tính Lãi Vay" bg_color="#FBF6F1" padding="60px"]

[row]
[col span="12" span__sm="12"]
<div id="bang-gia-lai-vay"></div>
<span class="kbds-sub-badge">GIỎ HÀNG &amp; DÒNG TIỀN</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 20px">7. Giỏ Hàng Lalalay Residences &amp; Bảng Tính Lãi Vay</h2>

[kbds_project_listings project_id="{PROJECT_ID}" limit="6"]

[kbds_loan_calculator]
[/col]
[/row]

[/section]

[section label="10. Câu Hỏi Thường Gặp (FAQ)" bg_color="#ffffff" padding="60px"]

[row]
[col span="12" span__sm="12"]
<div id="faq"></div>
<span class="kbds-sub-badge">GIẢI ĐÁP THẮC MẮC</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 20px">8. Câu Hỏi Thường Gặp Về Dự Án Lalalay Residences</h2>

[accordion]

[accordion-item title="1. Dự án Lalalay Residences nằm ở đâu?"]
<p>Lalalay Residences tọa lạc tại <strong>Bắc An Khánh, Hà Nội</strong>, ngay giao điểm Đại lộ Thăng Long và Vành đai 3.5, cạnh Ga Metro số 7.</p>
[/accordion-item]

[accordion-item title="2. Quy mô dự án Lalalay Residences như thế nào?"]
<p>Dự án gồm <strong>4 tòa (LALA 1 – LALA 4), 20 tầng nổi, 3 tầng hầm, 2 khối đế TMDV</strong>, tổng <strong>1.492 căn hộ</strong> trên diện tích đất <strong>27.793 m²</strong>.</p>
[/accordion-item]

[accordion-item title="3. Lalalay Residences có những loại căn hộ nào?"]
<p>Dự án cung cấp căn hộ <strong>Studio, 1PN, 2PN, 3PN và 4PN</strong>, hình thức <strong>sở hữu lâu dài</strong>. Riêng tòa mở bán đầu tiên LALA 1 có các loại Studio – 3PN, diện tích 36 – 100 m².</p>
[/accordion-item]

[accordion-item title="4. Ai là đơn vị phát triển và thi công Lalalay Residences?"]
<p>Nhà đồng hành kiến tạo: <strong>Ramoori Holdings</strong>; Tư vấn &amp; Thiết kế: <strong>STELLAR</strong>; Tổng thầu xây dựng: <strong>Delta</strong>.</p>
[/accordion-item]

[accordion-item title="5. Pháp lý và thời gian bàn giao dự án?"]
<p>Dự án đã có <strong>QHCT 1/500 được phê duyệt</strong> và <strong>Chấp thuận chủ trương đầu tư</strong>, dự kiến bàn giao <strong>năm 2029</strong>.</p>
[/accordion-item]

[/accordion]
[/col]
[/row]

[/section]

[section label="11. Form Đăng Ký Nhận Bảng Giá" bg_color="#FBF6F1" padding="50px"]

[row]
[col span="12" span__sm="12"]
<div id="nhan-bang-gia"></div>
[kbds_lead_form title="📥 Đăng Ký Nhận Bảng Giá, Mặt Bằng Tòa LALA 1 &amp; Chính Sách Lalalay Residences" project="Lalalay Residences"]
[/col]
[/row]

[/section]
EOD;

$content = strtr( $content, $P );

// ---------- 3. Tạo / cập nhật bài Dự án ----------
$slug     = 'lalalay-residences';
$existing = get_posts( array( 'post_type' => 'du_an', 'name' => $slug, 'post_status' => 'any', 'posts_per_page' => 1 ) );
$excerpt  = 'Lalalay Residences Bắc An Khánh, Hà Nội: 4 tòa 20 tầng, 3 hầm, 2 khối đế TMDV, 1.492 căn hộ Studio – 4PN sở hữu lâu dài trên 27.793 m². Ramoori Holdings đồng hành kiến tạo, STELLAR thiết kế, Delta tổng thầu. Bàn giao dự kiến 2029.';

$postarr = array(
	'post_type'    => 'du_an',
	'post_title'   => 'Lalalay Residences',
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_excerpt' => $excerpt,
	'post_content' => '',
);
if ( $existing ) {
	$postarr['ID'] = $existing[0]->ID;
}
$post_id = wp_insert_post( $postarr, true );
if ( is_wp_error( $post_id ) ) {
	die( '[-] ' . $post_id->get_error_message() . "\n" );
}

// Nội dung (cần post ID cho shortcode giỏ hàng)
wp_update_post( array( 'ID' => $post_id, 'post_content' => str_replace( '{PROJECT_ID}', $post_id, $content ) ) );
set_post_thumbnail( $post_id, $img['hero']['id'] );

$meta = array(
	'_kbds_project_code'   => 'DA-LALALAY-HN',
	'_kbds_price_from'     => 'Đang cập nhật (Tòa LALA 1 mở bán)',
	'_kbds_address'        => 'Bắc An Khánh, Hà Nội (Đại lộ Thăng Long × Vành đai 3.5)',
	'_kbds_total_area'     => '27.793 m²',
	'_kbds_scale'          => '4 tòa, 20 tầng nổi, 3 hầm, 2 khối đế TMDV • 1.492 căn (Studio – 4PN)',
	'_kbds_legal_status'   => 'QHCT 1/500 đã phê duyệt • Chấp thuận chủ trương đầu tư • Sở hữu lâu dài',
	'_kbds_handover_time'  => 'Dự kiến bàn giao 2029',
	'_kbds_bank_support'   => 'Liên hệ để nhận chính sách vay & ưu đãi mới nhất',
	'_kbds_review_score'   => '9.0',
	'_kbds_pros_cons'      => "+ Vị trí giao điểm Đại lộ Thăng Long & Vành đai 3.5, sát Ga Metro số 7.\n+ Pháp lý QHCT 1/500 đã phê duyệt, sở hữu lâu dài.\n+ Kiến trúc ban công cong độc đáo, 16 tiện ích ngoài trời.\n+ Tòa LALA 1 mật độ 14 căn/sàn.",
	'rank_math_focus_keyword' => 'Lalalay Residences,dự án Lalalay Residences,Lalalay Bắc An Khánh,căn hộ Lalalay',
	'rank_math_title'         => 'Lalalay Residences Bắc An Khánh: Thông Tin, Mặt Bằng & Bảng Giá',
	'rank_math_description'   => 'Dự án Lalalay Residences Bắc An Khánh, Hà Nội: 4 tòa 20 tầng, 1.492 căn Studio – 4PN sở hữu lâu dài, sát Ga Metro số 7. Mặt bằng tòa LALA 1, tiện ích & tiêu chuẩn bàn giao.',
	'rank_math_pillar_content' => 'on',
);
foreach ( $meta as $k => $v ) {
	update_post_meta( $post_id, $k, $v );
}

// Taxonomies
$dev = term_exists( 'ramoori-holdings', 'chu_dau_tu' );
if ( ! $dev ) {
	$dev = wp_insert_term( 'Ramoori Holdings', 'chu_dau_tu', array( 'slug' => 'ramoori-holdings' ) );
}
wp_set_object_terms( $post_id, array( (int) $dev['term_id'] ), 'chu_dau_tu' );
wp_set_object_terms( $post_id, array( 'ha-noi' ), 'khu_vuc_bds' );
wp_set_object_terms( $post_id, array( 'can-ho-chung-cu' ), 'loai_hinh_bds' );
wp_set_object_terms( $post_id, array( 'sap-mo-ban' ), 'trang_thai_du_an' );

echo "\n[+] HOÀN TẤT! Dự án Lalalay Residences – Post ID {$post_id}\n";
echo "    URL: " . get_permalink( $post_id ) . "\n";
