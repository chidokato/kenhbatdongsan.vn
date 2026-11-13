<?php
/**
 * Script cập nhật Landing Page Vinhomes King Park (Post ID 102) với 14 hình ảnh thực tế & phối cảnh
 */

define( 'WP_USE_THEMES', false );
require_once __DIR__ . '/../wp-load.php';

$post_id = 102;
$post    = get_post( $post_id );

if ( ! $post ) {
	die( "Không tìm thấy post ID {$post_id}\n" );
}

// 1. Cập nhật Featured Image (Thumbnail) thành ID 142 (Góc cao toàn cảnh bán đảo xanh)
set_post_thumbnail( $post_id, 142 );
echo "[+] Đã cập nhật ảnh đại diện (Featured Image) -> ID 142\n";

// 2. Nội dung hoàn chỉnh chuẩn UX Builder & SEO cho Landing Page
$content = <<<'EOD'
[section label="1. Hero Banner Vinhomes King Park" bg="142" bg_size="original" bg_overlay="rgba(7, 25, 46, 0.78)" dark="true" padding="60px"]

[row style="large" v_align="middle"]

[col span="7" span__sm="12"]

<div style="display:inline-flex;align-items:center;gap:8px;border:1px solid #E5C158;color:#FDE68A;padding:6px 16px;border-radius:99px;font-size:12.5px;font-weight:700;letter-spacing:0.6px;margin-bottom:16px">
	<span>👑 TÂM ĐIỂM SỐNG &amp; NGHỈ DƯỠNG MỚI TẠI KINH BẮC • BÁN ĐẢO HÒA LONG</span>
</div>

<h1 style="font-size:36px;font-weight:800;line-height:1.25;color:#ffffff;margin:0 0 16px">Vinhomes King Park Bắc Ninh – Đại Đô Thị Sân Golf 90ha &amp; Sinh Thái 268,8ha Bên Sông Cầu</h1>

<p style="font-size:16px;line-height:1.7;color:#e2e8f0;margin-bottom:24px">Được kiến tạo bởi <strong>Chủ đầu tư Liên doanh Vingroup</strong> và <strong>Đơn vị phát triển MIK Group</strong>, <strong>Vinhomes King Park</strong> sở hữu mật độ xây dựng chỉ <strong>18,5%</strong> với <strong>101,69 ha cây xanh – mặt nước</strong>, dòng <strong>sông Cầu</strong> ôm trọn phía Bắc cùng tuyệt tác <strong>Sân Golf 18 lỗ rộng 90 ha</strong> ngay trên bán đảo Hòa Long.</p>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px">
	<div style="border-radius:10px;padding:12px 14px">
		<strong style="display:block;font-size:22px;font-weight:800;color:#E5C158">268,8 ha</strong>
		<span style="font-size:12.5px;color:#cbd5e1">Tổng diện tích đất</span>
	</div>
	<div style="border-radius:10px;padding:12px 14px">
		<strong style="display:block;font-size:22px;font-weight:800;color:#4ADE80">101,69 ha</strong>
		<span style="font-size:12.5px;color:#cbd5e1">Cây xanh &amp; Mặt nước</span>
	</div>
	<div style="border-radius:10px;padding:12px 14px">
		<strong style="display:block;font-size:22px;font-weight:800;color:#38BDF8">90 ha</strong>
		<span style="font-size:12.5px;color:#cbd5e1">Sân Golf 18 lỗ Hòa Long</span>
	</div>
	<div style="border-radius:10px;padding:12px 14px">
		<strong style="display:block;font-size:22px;font-weight:800;color:#FBBF24">18,5%</strong>
		<span style="font-size:12.5px;color:#cbd5e1">Mật độ xây dựng</span>
	</div>
</div>

[button text="📥 Nhận Bảng Giá &amp; Mặt Bằng 1/500" color="secondary" size="larger" radius="8" link="#nhan-bang-gia"]
[button text="📞 Hotline Tư Vấn: 0942.655.111" style="outline" color="white" size="larger" radius="8" link="tel:0942655111"]

[/col]

[col span="5" span__sm="12"]

[kbds_quick_lead_card title="ĐĂNG KÝ NHẬN BỘ TÀI LIỆU GỐC" subtitle="Nhận Bảng giá dự kiến, Bản đồ quy hoạch bán đảo Hòa Long 268,8ha &amp; Lịch mở bán Quý III/2026 qua Zalo:" project="Vinhomes King Park Bắc Ninh"]

[/col]

[/row]

[/section]

[section label="2. Menu Phụ Điều Hướng Dự Án (Sticky Sub-Nav)" class="kbds-proj-sticky-subnav" bg_color="#ffffff" padding="0px"]

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

[/section]

[section label="3. Tổng Quan Dự Án &amp; Thông Số Kỹ Thuật" bg_color="#F8F9FA" padding="60px"]

[row style="large" v_align="top"]

[col span="7" span__sm="12"]

<div id="tong-quan"></div>
<span class="kbds-sub-badge">HỒ SƠ PHÁP LÝ &amp; QUY HOẠCH TỔNG THỂ</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 16px;line-height:1.3">1. Tổng Quan Dự Án Vinhomes King Park Bắc Ninh – Biểu Tượng Sống "Xanh Dương"</h2>

<p style="font-size:15.5px;line-height:1.75;color:#334155"><strong>Vinhomes King Park</strong> được định vị trở thành tâm điểm sống và nghỉ dưỡng mới tại vùng đất di sản <strong>Kinh Bắc</strong> nói riêng và tỉnh <strong>Bắc Ninh</strong> nói chung. Dự án là sự kết hợp chiến lược giữa <strong>Chủ đầu tư Công ty liên doanh Vingroup</strong> và <strong>Đơn vị phát triển dự án MIK Group</strong> trên tổng quỹ đất rộng tới <strong>268,8 ha</strong> tại bán đảo Hòa Long.</p>

<p style="font-size:15.5px;line-height:1.75;color:#334155">Điểm tạo nên sức hút đặc biệt của <strong>dự án Vinhomes King Park Bắc Ninh</strong> nằm ở triết lý quy hoạch sinh thái mật độ cực thấp: <strong>mật độ xây dựng toàn khu chỉ 18,5%</strong>. Phần lớn diện tích được ưu tiên cho thiên nhiên với tổng diện tích cây xanh và mặt nước bên trong khu đô thị (bao gồm công viên nội khu và sông hồ nội khu) lên tới <strong>101,69 ha</strong>, kết hợp cùng dòng <strong>sông Cầu</strong> ôm trọn phía Bắc khu đô thị, kiến tạo chuẩn sống <em>“Xanh dương”</em> đẳng cấp – nơi con người được hòa mình giữa miền thiên nhiên thuần khiết.</p>

<div style="background:#ffffff;border-left:4px solid #C59B27;border-radius:10px;padding:18px 20px;margin:20px 0">
	<h3 style="color:#0B2C4D;font-size:18px;font-weight:800;margin:0 0 8px">👑 Ý nghĩa tên gọi "Vinhomes King Park"</h3>
	<p style="margin:0;font-size:15px;line-height:1.65;color:#475569">Ngoài việc từ <strong>“King Park”</strong> là cách đọc lái đầy tự hào của vùng đất văn hiến <strong>“Kinh Bắc”</strong>, tên gọi dự án còn lấy cảm hứng trực tiếp từ đại công viên sinh thái và <strong>sân golf 18 lỗ rộng lên tới 90 ha</strong> nằm gọn bên trong bán đảo Hòa Long – biểu tượng sống vương giả lần đầu tiên xuất hiện tại Bắc Ninh.</p>
</div>

<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:14px;margin-top:20px">
	<div class="kbds-ux-card" style="padding:16px 18px">
		<strong style="color:#0B2C4D;font-size:15px;display:block;margin-bottom:4px">🏛️ Bảo chứng từ Vingroup &amp; MIK Group</strong>
		<span style="font-size:13.5px;color:#64748b;line-height:1.5;display:block">Tiến độ thần tốc, chất lượng xây dựng vượt trội và chuẩn vận hành đô thị thông minh hàng đầu Việt Nam.</span>
	</div>
	<div class="kbds-ux-card" style="padding:16px 18px">
		<strong style="color:#0E8A4A;font-size:15px;display:block;margin-bottom:4px">🌿 Tỷ lệ Xanh &amp; Mặt nước kỷ lục</strong>
		<span style="font-size:13.5px;color:#64748b;line-height:1.5;display:block">101,69 ha công viên – hồ nội khu cùng 90 ha sân golf Hòa Long tạo vi khí hậu trong lành quanh năm.</span>
	</div>
</div>

[/col]

[col span="5" span__sm="12"]

<div style="background:#ffffff;border:2px solid #0B2C4D;border-radius:14px;overflow:hidden">
	<div style="background:linear-gradient(135deg,#0B2C4D 0%,#164B7D 100%);color:#ffffff;padding:18px 22px;display:flex;justify-content:space-between;align-items:center">
		<div>
			<span style="font-size:11.5px;color:#E5C158;font-weight:700;letter-spacing:0.5px;display:block">BẢNG THÔNG SỐ CHÍNH THỨC</span>
			<strong style="font-size:18px">Hồ Sơ Dự Án Vinhomes King Park</strong>
		</div>
		<span style="background:#C59B27;color:#fff;padding:5px 12px;border-radius:8px;font-weight:800;font-size:13.5px">⭐ 9.5/10</span>
	</div>
	<div style="padding:8px 20px 18px">
		<table style="width:100%;border-collapse:collapse;font-size:14px">
			<tbody>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569;width:42%">Tên thương mại:</td>
					<td style="padding:11px 4px;font-weight:800;color:#0B2C4D">Vinhomes King Park</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Vị trí dự án:</td>
					<td style="padding:11px 4px;font-weight:700;color:#1e293b">Bán đảo Hòa Long, TP. Bắc Ninh, tỉnh Bắc Ninh</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Chủ đầu tư:</td>
					<td style="padding:11px 4px;font-weight:700;color:#C59B27">Công ty liên doanh Vingroup</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Đơn vị phát triển:</td>
					<td style="padding:11px 4px;font-weight:700;color:#0B2C4D">MIK Group</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Tổng diện tích đất:</td>
					<td style="padding:11px 4px;font-weight:800;color:#0E8A4A">268,8 ha</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Mật độ xây dựng:</td>
					<td style="padding:11px 4px;font-weight:800;color:#0B2C4D">18,5%</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Cây xanh &amp; Mặt nước:</td>
					<td style="padding:11px 4px;font-weight:700;color:#0E8A4A">101,69 ha (Công viên &amp; Sông hồ nội khu)</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Sân Golf nội khu:</td>
					<td style="padding:11px 4px;font-weight:800;color:#C59B27">90 ha (Sân golf 18 lỗ Hòa Long)</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Quy mô sản phẩm:</td>
					<td style="padding:11px 4px;font-weight:700;color:#1e293b">8 tòa căn hộ cao tầng &amp; 4.222 căn thấp tầng</td>
				</tr>
				<tr style="border-bottom:1px solid #e2e8f0">
					<td style="padding:11px 4px;font-weight:600;color:#475569">Khởi công &amp; Bàn giao:</td>
					<td style="padding:11px 4px;font-weight:700;color:#1e293b">Khởi công Q3/2026 – Bàn giao 2027</td>
				</tr>
				<tr>
					<td style="padding:11px 4px;font-weight:600;color:#475569">Hình thức sở hữu:</td>
					<td style="padding:11px 4px;font-weight:700;color:#0B2C4D">Sổ đỏ lâu dài (Người Việt Nam)</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

[/col]

[/row]

[row style="large"]
[col span="12" span__sm="12"]
[ux_image id="149" image_size="original" caption="true"]
[/col]
[/row]

[/section]

[section label="4. Vị Trí Bán Đảo Hòa Long &amp; Phong Thủy Sông Cầu" bg_color="#ffffff" padding="60px"]

[row style="large" v_align="middle"]

[col span="6" span__sm="12"]

<div id="vi-tri"></div>
[ux_image id="139" image_size="original" caption="true"]

[/col]

[col span="6" span__sm="12"]

<span class="kbds-sub-badge">TỌA ĐỘ PHONG THỦY ĐỘC TÔN TẠI BẮC NINH</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 16px;line-height:1.3">2. Vị Trí Dự Án Vinhomes King Park – Bán Đảo Hòa Long Ôm Trọn Bởi Dòng Sông Cầu</h2>

<p style="font-size:15.5px;line-height:1.75;color:#334155">Tọa lạc tại <strong>bán đảo Hòa Long, TP. Bắc Ninh</strong>, <strong>Vinhomes King Park</strong> sở hữu địa thế tự nhiên hiếm có khi toàn bộ <strong>phía Bắc khu đô thị được dòng sông Cầu lịch sử ôm trọn</strong>. Trong phong thủy phương Đông, thế đất bán đảo được dòng sông lớn bao bọc mang lại vượng khí sinh tài lộc, đồng thời tạo lập vành đai sinh thái biệt lập, yên bình ngay sát trung tâm đô thị.</p>

<ul style="font-size:15px;line-height:1.8;color:#334155;padding-left:20px;margin-bottom:22px">
	<li><strong>Tâm điểm kết nối Kinh Bắc:</strong> Di chuyển nhanh chóng vào trung tâm hành chính – thương mại TP. Bắc Ninh chỉ trong 8 phút qua trục đường Lạc Long Quân và đại lộ Tây Thăng Long.</li>
	<li><strong>Cửa ngõ đón sóng chuyên gia quốc tế:</strong> Kết nối trực tiếp tới các Khu công nghiệp trọng điểm tại Bắc Ninh – Bắc Giang (KCN Yên Phong 20 phút, Samsung, Amkor, Foxconn...), nơi quy tụ hơn 50.000 chuyên gia cấp cao.</li>
	<li><strong>Liên kết vùng toàn diện:</strong> Chỉ 10 phút kết nối trực tiếp Đường Vành Đai 4, 15 phút tới Quốc Lộ 1A, 25 phút về Thủ đô Hà Nội qua QL18/QL1A, và 35 phút tới Sân bay Quốc tế Nội Bài.</li>
</ul>

[button text="🗺️ Nhận Bản Đồ Quy Hoạch Giao Thông Hòa Long" color="primary" size="large" radius="8" link="#nhan-bang-gia"]

[/col]

[/row]

[row style="large"]
[col span="6" span__sm="12"]
[ux_image id="138" image_size="original" caption="true"]
[/col]
[col span="6" span__sm="12"]
[ux_image id="150" image_size="original" caption="true"]
[/col]
[/row]

[/section]

[section label="5. Hệ Sinh Thái Tiện Ích All-in-One &amp; Sân Golf 90ha" bg_color="#0B2C4D" dark="true" padding="64px"]

[row]

[col span="12" span__sm="12"]

<div id="tien-ich" style="text-align:center;max-width:820px;margin:0 auto 36px">
	<span style="display:inline-block;border:1px solid #E5C158;color:#FDE68A;padding:5px 16px;border-radius:99px;font-size:12px;font-weight:700;letter-spacing:0.6px;margin-bottom:12px">HỆ SINH THÁI ALL-IN-ONE ĐẲNG CẤP VINGROUP</span>
	<h2 style="color:#ffffff;font-size:30px;font-weight:800;margin:0 0 12px">3. Hệ Thống Tiện Ích Vinhomes King Park: Sân Golf 90ha &amp; 101,69ha Cây Xanh Mặt Nước</h2>
	<p style="color:#cbd5e1;font-size:15.5px;line-height:1.65;margin:0">Sở hữu chuẩn sống nghỉ dưỡng 365 ngày với hệ sinh thái tiện ích khép kín chuẩn quốc tế lần đầu tiên quy tụ đầy đủ tại bán đảo Hòa Long, Bắc Ninh.</p>
</div>

[/col]

[/row]

[row style="normal"]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">⛳</div>
	<h3 style="color:#E5C158;font-size:19px;font-weight:800;margin:0 0 10px">Sân Golf 18 Lỗ Rộng 90 ha</h3>
	<p style="color:#e2e8f0;font-size:14.5px;line-height:1.65;margin:0">Nằm gọn bên trong bán đảo Hòa Long, sân golf 18 lỗ quy mô 90 ha không chỉ là nơi giao lưu của giới thượng lưu mà còn mở ra tầm nhìn xanh mát triệu đô cho các phân khu biệt thự và căn hộ.</p>
</div>
[/col]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">🌊</div>
	<h3 style="color:#4ADE80;font-size:19px;font-weight:800;margin:0 0 10px">101,69 ha Cây Xanh &amp; Mặt Nước</h3>
	<p style="color:#e2e8f0;font-size:14.5px;line-height:1.65;margin:0">Bao gồm chuỗi công viên nội khu chủ đề và hệ thống sông hồ nội khu rộng lớn, kết hợp dòng sông Cầu phía Bắc mang lại cuộc sống "Xanh dương" thanh khiết.</p>
</div>
[/col]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">🛍️</div>
	<h3 style="color:#38BDF8;font-size:19px;font-weight:800;margin:0 0 10px">TTTM Vincom &amp; Phố Shophouse</h3>
	<p style="color:#e2e8f0;font-size:14.5px;line-height:1.65;margin:0">Tâm điểm mua sắm, giải trí, rạp chiếu phim, ẩm thực cao cấp tại trung tâm thương mại Vincom cùng các dãy nhà phố thương mại Shophouse sầm uất ngày đêm.</p>
</div>
[/col]

[/row]

[row style="normal"]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">🎓</div>
	<h3 style="color:#FDE68A;font-size:19px;font-weight:800;margin:0 0 10px">Trường Học Liên Cấp Vinschool</h3>
	<p style="color:#e2e8f0;font-size:14.5px;line-height:1.65;margin:0">Môi trường giáo dục chuẩn quốc tế ngay trong nội khu, giúp thế hệ tương lai tại Kinh Bắc phát triển toàn diện cả trí tuệ, thể chất lẫn kỹ năng hội nhập toàn cầu.</p>
</div>
[/col]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">🏥</div>
	<h3 style="color:#F87171;font-size:19px;font-weight:800;margin:0 0 10px">Bệnh Viện Quốc Tế Vinmec</h3>
	<p style="color:#e2e8f0;font-size:14.5px;line-height:1.65;margin:0">Hệ thống y tế và chăm sóc sức khỏe tiêu chuẩn quốc tế Vinmec với trang thiết bị tối tân, bảo vệ sức khỏe 24/7 cho mọi thành viên trong gia đình.</p>
</div>
[/col]

[col span="4" span__sm="12"]
<div class="kbds-ux-card-dark">
	<div style="font-size:28px;margin-bottom:10px">🏊</div>
	<h3 style="color:#A7F3D0;font-size:19px;font-weight:800;margin:0 0 10px">Công Viên Nội Khu &amp; Thể Thao</h3>
	<p style="color:#e2e8f0;font-size:14.5px;line-height:1.65;margin:0">Chuỗi bể bơi resort, đường dạo bộ ven sông hồ, sân thể thao liên hoàn, vườn BBQ và bến cảnh quan phục vụ đặc quyền cho cư dân.</p>
</div>
[/col]

[/row]

[row style="large"]
[col span="6" span__sm="12"]
[ux_image id="145" image_size="original" caption="true"]
[/col]
[col span="6" span__sm="12"]
[ux_image id="143" image_size="original" caption="true"]
[/col]
[/row]

[row style="large"]
[col span="6" span__sm="12"]
[ux_image id="144" image_size="original" caption="true"]
[/col]
[col span="6" span__sm="12"]
[ux_image id="148" image_size="original" caption="true"]
[/col]
[/row]

[row]

[col span="12" span__sm="12"]
<div style="text-align:center;margin-top:16px">
	<p style="color:#cbd5e1;font-size:14.5px;margin-bottom:14px">👉 Xem bài phân tích chuyên sâu: <a href="https://kenhbatdongsan.vn/tien-ich-du-an-vinhomes-king-park-bac-ninh-san-golf-90ha-he-sinh-thai-10169ha-cay-xanh-mat-nuoc/" style="color:#E5C158;font-weight:700;text-decoration:underline">Chi tiết hệ thống tiện ích dự án Vinhomes King Park Bắc Ninh &amp; Sân Golf 90ha</a></p>
</div>
[/col]

[/row]

[/section]

[section label="6. Quy Mô Phát Triển &amp; Cơ Cấu Sản Phẩm" bg_color="#ffffff" padding="60px"]

[row]

[col span="12" span__sm="12"]

<div id="san-pham" style="text-align:center;max-width:800px;margin:0 auto 36px">
	<span class="kbds-sub-badge">QUY MÔ PHÁT TRIỂN ĐA DẠNG</span>
	<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 12px">4. Mặt Bằng &amp; Các Loại Hình Sản Phẩm Tại Vinhomes King Park</h2>
	<p style="color:#64748B;font-size:15.5px;margin:0">Cung cấp bộ sưu tập sản phẩm bất động sản đa dạng từ căn hộ cao cấp đến biệt thự sinh thái siêu sang ven sông và sân golf.</p>
</div>

[/col]

[/row]

[row style="large"]
[col span="12" span__sm="12"]
[ux_image id="137" image_size="original" caption="true"]
[/col]
[/row]

[row style="large" v_align="top"]

[col span="6" span__sm="12"]
<div class="kbds-ux-card" style="padding:28px;height:100%">
	<div style="display:flex;align-items:center;gap:12px;margin-bottom:14px">
		<span style="background:#0B2C4D;color:#fff;font-size:12px;font-weight:800;padding:4px 12px;border-radius:99px">KHỐI CAO TẦNG</span>
		<span style="color:#64748B;font-size:13px;font-weight:600">Đại lộ phồn hoa</span>
	</div>
	<h3 style="color:#0B2C4D;font-size:21px;font-weight:800;margin:0 0 12px">8 Tòa Căn Hộ Chung Cư Cao Cấp</h3>
	<p style="color:#475569;font-size:14.5px;line-height:1.65;margin-bottom:16px">Được thiết kế theo tiêu chuẩn hiện đại, tối ưu mặt thoáng hướng sông Cầu và sân golf Hòa Long. Cung cấp không gian sống lý tưởng cho gia đình trẻ và chuyên gia nước ngoài:</p>
	<table style="width:100%;border-collapse:collapse;font-size:14px;margin-bottom:18px">
		<thead>
			<tr style="background:#F1F5F9;color:#0B2C4D">
				<th style="padding:9px 12px;text-align:left">Loại căn hộ</th>
				<th style="padding:9px 12px;text-align:left">Diện tích thông thủy (dự kiến)</th>
			</tr>
		</thead>
		<tbody>
			<tr style="border-bottom:1px solid #e2e8f0">
				<td style="padding:9px 12px;font-weight:700">Studio &amp; 1PN</td>
				<td style="padding:9px 12px">28 – 42 m² (Cho thuê chuyên gia cực tốt)</td>
			</tr>
			<tr style="border-bottom:1px solid #e2e8f0">
				<td style="padding:9px 12px;font-weight:700">Căn hộ 1PN+1</td>
				<td style="padding:9px 12px">45 – 52 m² (Đa năng, tối ưu công năng)</td>
			</tr>
			<tr style="border-bottom:1px solid #e2e8f0">
				<td style="padding:9px 12px;font-weight:700">Căn hộ 2PN (1-2WC)</td>
				<td style="padding:9px 12px">58 – 68 m² (Lựa chọn vàng của gia đình trẻ)</td>
			</tr>
			<tr style="border-bottom:1px solid #e2e8f0">
				<td style="padding:9px 12px;font-weight:700">Căn hộ 2PN+1</td>
				<td style="padding:9px 12px">70 – 78 m² (Rộng rãi, ban công lớn)</td>
			</tr>
			<tr>
				<td style="padding:9px 12px;font-weight:700">Căn hộ 3PN</td>
				<td style="padding:9px 12px">85 – 110 m² (Căn góc panorama view hồ &amp; sân golf)</td>
			</tr>
		</tbody>
	</table>
	<a href="#nhan-bang-gia" style="display:inline-block;background:#0B2C4D;color:#fff;font-weight:700;padding:10px 20px;border-radius:8px;text-decoration:none;font-size:13.5px">📥 Nhận Layout Thiết Kế 8 Tòa Căn Hộ →</a>
</div>
[/col]

[col span="6" span__sm="12"]
<div class="kbds-ux-card" style="padding:28px;height:100%">
	<div style="display:flex;align-items:center;gap:12px;margin-bottom:14px">
		<span style="background:#C59B27;color:#fff;font-size:12px;font-weight:800;padding:4px 12px;border-radius:99px">KHỐI THẤP TẦNG</span>
		<span style="color:#64748B;font-size:13px;font-weight:600">Tuyệt tác giới tinh hoa</span>
	</div>
	<h3 style="color:#0B2C4D;font-size:21px;font-weight:800;margin:0 0 12px">4.222 Căn Biệt Thự Sinh Thái, Liền Kề &amp; Shophouse</h3>
	<p style="color:#475569;font-size:14.5px;line-height:1.65;margin-bottom:16px">Tọa lạc giữa những bán đảo cây xanh, hồ cảnh quan nội khu và kế cận sân golf 18 lỗ rộng 90 ha, phân khu thấp tầng là tài sản truyền đời khẳng định vị thế chủ nhân:</p>
	<table style="width:100%;border-collapse:collapse;font-size:14px;margin-bottom:18px">
		<thead>
			<tr style="background:#FDF8EC;color:#9A7312">
				<th style="padding:9px 12px;text-align:left">Loại hình thấp tầng</th>
				<th style="padding:9px 12px;text-align:left">Giá trị độc bản tại bán đảo Hòa Long</th>
			</tr>
		</thead>
		<tbody>
			<tr style="border-bottom:1px solid #e2e8f0">
				<td style="padding:9px 12px;font-weight:700">Biệt thự Đơn lập</td>
				<td style="padding:9px 12px">Vị trí kim cương ven sông hồ &amp; sân golf 90ha, sân vườn rộng</td>
			</tr>
			<tr style="border-bottom:1px solid #e2e8f0">
				<td style="padding:9px 12px;font-weight:700">Biệt thự Song lập</td>
				<td style="padding:9px 12px">Kiến trúc sang trọng, 3 mặt thoáng xanh mát kế cận công viên</td>
			</tr>
			<tr style="border-bottom:1px solid #e2e8f0">
				<td style="padding:9px 12px;font-weight:700">Nhà ở Liền kề</td>
				<td style="padding:9px 12px">Tối ưu diện tích sử dụng, không gian sống văn minh khép kín</td>
			</tr>
			<tr>
				<td style="padding:9px 12px;font-weight:700">Nhà phố Shophouse</td>
				<td style="padding:9px 12px">Mặt trục đường lớn &amp; kế cận Vincom, vừa ở vừa kinh doanh đắc lộc</td>
			</tr>
		</tbody>
	</table>
	<a href="#nhan-bang-gia" style="display:inline-block;background:#C59B27;color:#fff;font-weight:700;padding:10px 20px;border-radius:8px;text-decoration:none;font-size:13.5px">📥 Nhận Bản Đồ Phân Lô 4.222 Căn Thấp Tầng →</a>
</div>
[/col]

[/row]

[row style="large"]
[col span="4" span__sm="12"]
[ux_image id="146" image_size="original" caption="true"]
[/col]
[col span="4" span__sm="12"]
[ux_image id="147" image_size="original" caption="true"]
[/col]
[col span="4" span__sm="12"]
[ux_image id="141" image_size="original" caption="true"]
[/col]
[/row]

[/section]

[section label="7. Tiến Độ 2026-2027, Giỏ Hàng &amp; Tính Lãi Vay" bg_color="#F8F9FA" padding="60px"]

[row]

[col span="12" span__sm="12"]

<div id="bang-gia-lai-vay"></div>
<span class="kbds-sub-badge">LỘ TRÌNH TRIỂN KHAI &amp; THỰC TẾ CÔNG TRƯỜNG</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 20px">5. Tiến Độ Dự Án Vinhomes King Park (2026 – 2027) &amp; Bảng Tính Dòng Tiền</h2>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-bottom:32px">
	<div style="background:#ffffff;border:1px solid #CBD5E1;border-top:4px solid #0B2C4D;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,0.04)">
		<span style="font-size:12px;font-weight:800;color:#0B2C4D;background:#E2E8F0;padding:3px 10px;border-radius:99px">CỘT MỐC 1</span>
		<h3 style="color:#0B2C4D;font-size:19px;font-weight:800;margin:10px 0 6px">Quý III/2026: Khởi Công Dự Án</h3>
		<p style="font-size:14px;color:#475569;margin:0;line-height:1.6">Chính thức khởi công hạ tầng tổng thể 268,8 ha tại bán đảo Hòa Long, triển khai cảnh quan 101,69 ha cây xanh mặt nước và sân golf 90 ha.</p>
	</div>
	<div style="background:#ffffff;border:1px solid #CBD5E1;border-top:4px solid #C59B27;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,0.04)">
		<span style="font-size:12px;font-weight:800;color:#9A7312;background:#FDF8EC;padding:3px 10px;border-radius:99px">CỘT MỐC 2</span>
		<h3 style="color:#0B2C4D;font-size:19px;font-weight:800;margin:10px 0 6px">Cuối 2026 – 2027: Thi Công Thần Tốc</h3>
		<p style="font-size:14px;color:#475569;margin:0;line-height:1.6">Đồng loạt thi công 8 tòa căn hộ, 4.222 căn biệt thự/liền kề/shophouse cùng hệ sinh thái Vincom, Vinschool, Vinmec dưới sự phát triển của MIK Group.</p>
	</div>
	<div style="background:#ffffff;border:1px solid #CBD5E1;border-top:4px solid #0E8A4A;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,0.04)">
		<span style="font-size:12px;font-weight:800;color:#0E8A4A;background:#DCFCE7;padding:3px 10px;border-radius:99px">CỘT MỐC 3</span>
		<h3 style="color:#0B2C4D;font-size:19px;font-weight:800;margin:10px 0 6px">Năm 2027: Bàn Giao &amp; Vận Hành</h3>
		<p style="font-size:14px;color:#475569;margin:0;line-height:1.6">Dự kiến bàn giao nhà cho cư dân ngay trong năm 2027, đưa Vinhomes King Park trở thành tâm điểm sống &amp; nghỉ dưỡng sôi động bậc nhất Bắc Ninh.</p>
	</div>
</div>

[/col]

[/row]

[row style="large"]
[col span="12" span__sm="12"]
[ux_image id="140" image_size="original" caption="true"]
[/col]
[/row]

[row]
[col span="12" span__sm="12"]

[kbds_project_listings project_id="102" limit="6"]

[kbds_loan_calculator]

[/col]
[/row]

[/section]

[section label="8. Tin Tức &amp; Bài Viết Chuyên Sâu Về Dự Án" bg_color="#ffffff" padding="60px"]

[row]

[col span="12" span__sm="12"]

<div id="tin-tuc-du-an"></div>
<span class="kbds-sub-badge">CẬP NHẬT THỊ TRƯỜNG &amp; PHÂN TÍCH CHUYÊN GIA</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 20px">Tin Tức &amp; Đánh Giá Dự Án Vinhomes King Park</h2>

[kbds_project_news project_id="102" limit="6"]

[/col]

[/row]

[/section]

[section label="9. Câu Hỏi Thường Gặp (FAQ Chuẩn SEO)" bg_color="#F8F9FA" padding="60px"]

[row]

[col span="12" span__sm="12"]

<div id="faq"></div>
<span class="kbds-sub-badge">GIẢI ĐÁP THẮC MẮC NHÀ ĐẦU TƯ</span>
<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 20px">6. Câu Hỏi Thường Gặp Về Dự Án Vinhomes King Park Bắc Ninh</h2>

[accordion]

[accordion-item title="1. Chủ đầu tư và đơn vị phát triển dự án Vinhomes King Park Bắc Ninh là ai?"]
<p>Dự án <strong>Vinhomes King Park</strong> do <strong>Công ty liên doanh Vingroup</strong> làm Chủ đầu tư và được phát triển bởi <strong>MIK Group</strong> – hai thương hiệu bất động sản uy tín hàng đầu Việt Nam bảo chứng cho pháp lý, tiến độ và chất lượng vận hành.</p>
[/accordion-item]

[accordion-item title="2. Tổng diện tích và mật độ xây dựng của Vinhomes King Park là bao nhiêu?"]
<p>Tổng diện tích đất của dự án Vinhomes King Park là <strong>268,8 ha</strong> tại bán đảo Hòa Long, Bắc Ninh. Đặc biệt, mật độ xây dựng toàn khu chỉ chiếm <strong>18,5%</strong>, dành tới <strong>101,69 ha</strong> cho cây xanh và mặt nước nội khu (công viên nội khu &amp; sông hồ nội khu) cùng <strong>90 ha</strong> cho sân golf 18 lỗ.</p>
[/accordion-item]

[accordion-item title="3. Dự án Vinhomes King Park Bắc Ninh có những loại hình sản phẩm nào?"]
<p>Quy mô phát triển của dự án bao gồm 2 dòng sản phẩm chính:</p>
<ul>
	<li><strong>Phân khu Cao tầng (8 tòa căn hộ):</strong> Đa dạng diện tích gồm Studio, 1PN, 1PN+1, 2PN, 2PN+1 và 3PN.</li>
	<li><strong>Phân khu Thấp tầng (4.222 căn):</strong> Gồm Biệt thự đơn lập, Biệt thự song lập, Liền kề và Nhà phố thương mại Shophouse.</li>
</ul>
[/accordion-item]

[accordion-item title="4. Hệ thống tiện ích Vinhomes King Park có gì đặc biệt?"]
<p>Dự án sở hữu hệ sinh thái <strong>“All-in-one”</strong> đẳng cấp gồm: Trung tâm thương mại <strong>Vincom</strong>, trường học liên cấp <strong>Vinschool</strong>, bệnh viện quốc tế <strong>Vinmec</strong>, hệ thống công viên &amp; sông hồ nội khu <strong>101,69 ha</strong>, dòng <strong>sông Cầu</strong> ôm trọn phía Bắc và nổi bật nhất là <strong>sân golf 18 lỗ rộng 90 ha</strong> nằm gọn bên trong bán đảo Hòa Long.</p>
[/accordion-item]

[accordion-item title="5. Thời điểm khởi công và bàn giao dự án Vinhomes King Park là khi nào?"]
<p>Theo kế hoạch triển khai, dự án Vinhomes King Park Bắc Ninh có thời điểm khởi công vào <strong>Quý III/2026</strong> và dự kiến bàn giao vào <strong>Năm 2027</strong>.</p>
[/accordion-item]

[/accordion]

[/col]

[/row]

[/section]

[section label="10. Form Đăng Ký Nhận Bảng Giá &amp; Chính Sách" bg_color="#ffffff" padding="50px"]

[row]

[col span="12" span__sm="12"]

<div id="nhan-bang-gia"></div>
[kbds_lead_form title="📥 Đăng Ký Nhận Bảng Giá Gốc, Mặt Bằng 1/500 &amp; Chính Sách Ưu Đãi Vinhomes King Park" project="Vinhomes King Park Bắc Ninh"]

[/col]

[/row]

[/section]
EOD;

wp_update_post( array(
	'ID'           => $post_id,
	'post_content' => $content,
) );

echo "[+] ĐÃ CẬP NHẬT NỘI DUNG TRANG DỰ ÁN (POST ID: {$post_id}) THÀNH CÔNG!\n";
