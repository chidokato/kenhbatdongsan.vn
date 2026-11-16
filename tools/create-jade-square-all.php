<?php
/**
 * Tạo Trang Dự Án Jade Square + 5 Bài Viết Vệ Tinh Chuẩn SEO
 */
require_once __DIR__ . '/../wp-load.php';

$media_map = json_decode(file_get_contents(__DIR__ . '/jade-media-map.json'), true);

// 1. TẠO HOẶC CẬP NHẬT DỰ ÁN JADE SQUARE
$project_title = 'Chung Cư Jade Square Bắc Từ Liêm';
$project_slug  = 'jade-square';

$existing_proj = get_page_by_path($project_slug, OBJECT, 'du_an');

$proj_content = <<<HTML
[section label="1. Hero Banner Jade Square" bg_color="#042F2C" dark="true" padding="60px 0px 40px"]
<div class="kbds-container" style="max-width:1200px;margin:0 auto;padding:0 15px;">
	<div style="display:flex;flex-wrap:wrap;align-items:center;gap:30px;">
		<div style="flex:1 1 580px;">
			<div style="display:inline-flex;align-items:center;gap:8px;background:rgba(45,212,191,0.15);border:1px solid #2DD4BF;padding:6px 14px;border-radius:30px;color:#2DD4BF;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:16px;">
				💎 BIỂU TƯỢNG SỐNG THƯỢNG LƯU TÂY HỒ TÂY
			</div>
			<h1 style="color:#FFFFFF;font-size:36px;font-weight:800;line-height:1.25;margin:0 0 16px;">
				CHUNG CƯ JADE SQUARE BẮC TỪ LIÊM
			</h1>
			<p style="color:#E2E8F0;font-size:16px;line-height:1.6;margin:0 0 24px;">
				Tổ hợp căn hộ hạng sang & shophouse thương mại liền kề New CBD Tây Hồ Tây. Sở hữu tọa độ siêu kết nối đón đầu tuyến Metro số 2 & số 6, chuỗi 39 tiện ích đa tầng chuẩn nghỉ dưỡng cùng thiết kế kính tràn chạm sàn sang trọng.
			</p>
			<div style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:28px;">
				<div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:8px;padding:10px 16px;">
					<span style="font-size:11px;color:#94A3B8;display:block;text-transform:uppercase;">Tòa Mở Bán</span>
					<strong style="font-size:16px;color:#2DD4BF;">TÒA SAPPHIRE</strong>
				</div>
				<div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:8px;padding:10px 16px;">
					<span style="font-size:11px;color:#94A3B8;display:block;text-transform:uppercase;">Mật Độ Siêu Thấp</span>
					<strong style="font-size:16px;color:#2DD4BF;">9 - 11 Căn/Sàn</strong>
				</div>
				<div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:8px;padding:10px 16px;">
					<span style="font-size:11px;color:#94A3B8;display:block;text-transform:uppercase;">Pháp Lý</span>
					<strong style="font-size:16px;color:#2DD4BF;">Sổ Hồng Lâu Dài</strong>
				</div>
			</div>
			<div style="display:flex;gap:14px;flex-wrap:wrap;">
				<a href="#nhan-bang-gia" style="background:#0D9488;color:#FFF;padding:13px 26px;border-radius:8px;font-weight:700;font-size:15px;text-decoration:none;box-shadow:0 4px 14px rgba(13,148,136,0.4);">
					Nhận Bảng Giá Đợt 1 Tòa Sapphire →
				</a>
				<a href="#mat-bang" style="background:transparent;color:#FFF;border:1px solid rgba(255,255,255,0.3);padding:13px 24px;border-radius:8px;font-weight:700;font-size:15px;text-decoration:none;">
					Xem Mặt Bằng Tầng
				</a>
			</div>
		</div>
		<div style="flex:1 1 500px;text-align:center;">
			<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/phoi-canh-toa-can-ho-sapphire-jade-square.jpg" alt="Chung cư Jade Square Bắc Từ Liêm" style="width:100%;max-width:560px;border-radius:14px;box-shadow:0 12px 36px rgba(0,0,0,0.4);" />
		</div>
	</div>
</div>
[/section]

[section label="2. Sticky Subnav Jade Square" bg_color="#FFFFFF" padding="0px"]
<div class="kbds-proj-nav-container">
	<nav class="kbds-proj-nav">
		<a href="#tong-quan">Tổng Quan</a>
		<a href="#vi-tri">Vị Trí Siêu Kết Nối</a>
		<a href="#tien-ich">39 Tiện Ích Đa Tầng</a>
		<a href="#mat-bang">Mặt Bằng Tòa Sapphire</a>
		<a href="#layout-can-ho">Layout Căn Hộ</a>
		<a href="#chinh-sach">Giá Bán &amp; Lãi Vay</a>
		<a href="#faq">Hỏi Đáp</a>
		<a href="#tin-tuc-du-an">Tin Tức Dự Án</a>
		<a href="#nhan-bang-gia" class="kbds-proj-nav-cta">Nhận Bảng Giá Gốc</a>
	</nav>
</div>
[/section]

[section label="3. Tổng Quan & Thông Số Vàng" bg_color="#F8FAFC" padding="50px 0px"]
<div class="kbds-container" id="tong-quan" style="max-width:1160px;margin:0 auto;padding:0 15px;">
	<div style="text-align:center;max-width:760px;margin:0 auto 36px;">
		<span style="color:#0D9488;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:8px;">HỒ SƠ BẤT ĐỘNG SẢN CHÍNH THỨC</span>
		<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 10px;">Tổng Quan Dự Án Chung Cư Jade Square</h2>
		<p style="color:#64748B;font-size:15px;margin:0;">Thông tin pháp lý, chủ đầu tư, quy mô xây dựng và tiến độ mới nhất do Kênh Bất Động Sản kiểm chứng.</p>
	</div>

	<div style="background:#FFF;border-radius:14px;border:1px solid #E2E8F0;box-shadow:0 4px 16px rgba(0,0,0,0.04);overflow:hidden;">
		<table style="width:100%;border-collapse:collapse;font-size:14.5px;">
			<tbody>
				<tr style="border-bottom:1px solid #F1F5F9;">
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;width:28%;background:#F8FAFC;">Tên thương mại</td>
					<td style="padding:14px 20px;font-weight:700;color:#0D9488;">JADE SQUARE (PHÂN KHU CĂN HỘ CAO CẤP TÒA SAPPHIRE)</td>
				</tr>
				<tr style="border-bottom:1px solid #F1F5F9;">
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;background:#F8FAFC;">Vị trí dự án</td>
					<td style="padding:14px 20px;color:#334155;">Khu đô thị Bắc Cổ Nhuế – Chèm, Đường Nguyễn Đình Tứ, P. Xuân Đỉnh & Cổ Nhuế 2, Q. Bắc Từ Liêm, Hà Nội</td>
				</tr>
				<tr style="border-bottom:1px solid #F1F5F9;">
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;background:#F8FAFC;">Đơn vị phát triển</td>
					<td style="padding:14px 20px;color:#334155;">Tập đoàn Vimedimex / Vimefulland – Phân phối chiến lược: Bất Động Sản Indochine</td>
				</tr>
				<tr style="border-bottom:1px solid #F1F5F9;">
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;background:#F8FAFC;">Quy mô tháp Sapphire</td>
					<td style="padding:14px 20px;color:#334155;">Cao 26 tầng nổi (Tầng 1-3 khối đế TM & tiện ích, Tầng 4-26 căn hộ) + 3 tầng hầm liên thông để xe</td>
				</tr>
				<tr style="border-bottom:1px solid #F1F5F9;">
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;background:#F8FAFC;">Mật độ căn hộ</td>
					<td style="padding:14px 20px;color:#334155;">Chỉ 11 căn/sàn (Tầng 04-24) và 9 căn/sàn (Tầng 25-26) – Cụm 5 thang máy tốc độ cao</td>
				</tr>
				<tr style="border-bottom:1px solid #F1F5F9;">
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;background:#F8FAFC;">Cơ cấu căn hộ</td>
					<td style="padding:14px 20px;color:#334155;">Căn 2PN (71.41 – 85.55 m²), Căn 2PN góc (79.91 m²), Căn 3PN (127.43 – 127.86 m²), Căn 4PN (154.02 m²)</td>
				</tr>
				<tr style="border-bottom:1px solid #F1F5F9;">
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;background:#F8FAFC;">Hệ thống tiện ích</td>
					<td style="padding:14px 20px;color:#334155;">39 tiện ích đặc quyền đa tầng (Quảng trường Ngọc Bích, bể bơi nước nóng, sân Pickleball, Sky Garden tầng mái...)</td>
				</tr>
				<tr style="border-bottom:1px solid #F1F5F9;">
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;background:#F8FAFC;">Hình thức sở hữu</td>
					<td style="padding:14px 20px;color:#16A34A;font-weight:700;">Sổ hồng sở hữu lâu dài cho người Việt Nam</td>
				</tr>
				<tr>
					<td style="padding:14px 20px;font-weight:700;color:#0B2C4D;background:#F8FAFC;">Dự kiến bàn giao</td>
					<td style="padding:14px 20px;color:#0B2C4D;font-weight:700;">Quý IV/2026</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
[/section]

[section label="4. Vị Trí Siêu Kết Nối" bg_color="#FFFFFF" padding="60px 0px"]
<div class="kbds-container" id="vi-tri" style="max-width:1160px;margin:0 auto;padding:0 15px;">
	<div style="text-align:center;max-width:780px;margin:0 auto 36px;">
		<span style="color:#0D9488;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:8px;">TÂM ĐIỂM ĐÓN SÓNG TĂNG TRƯỞNG TÂY HỒ TÂY</span>
		<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 10px;">Vị Trí Kim Cương &amp; Mạng Lưới Siêu Kết Nối</h2>
		<p style="color:#64748B;font-size:15px;margin:0;">Liền kề Tây Hồ Tây – trung tâm tài chính kinh tế mới của Thủ đô, kế cận 2 tuyến Metro số 2 và số 6.</p>
	</div>

	<div style="text-align:center;margin-bottom:36px;">
		<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/vi-tri-toa-do-sieu-ket-noi-jade-square-tay-ho-tay.jpg" alt="Vị trí siêu kết nối dự án Jade Square Tây Hồ Tây" style="width:100%;max-width:980px;border-radius:14px;box-shadow:0 8px 28px rgba(0,0,0,0.08);" />
	</div>

	<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;">
		<div style="background:#F0FDFA;border:1px solid #CCFBF1;border-radius:10px;padding:18px;text-align:center;">
			<strong style="font-size:28px;color:#0D9488;display:block;line-height:1;margin-bottom:6px;">01 PHÚT</strong>
			<span style="font-size:13.5px;color:#334155;font-weight:600;">Tuyến Metro số 6 & ga dừng hiện đại</span>
		</div>
		<div style="background:#F0FDFA;border:1px solid #CCFBF1;border-radius:10px;padding:18px;text-align:center;">
			<strong style="font-size:28px;color:#0D9488;display:block;line-height:1;margin-bottom:6px;">03 PHÚT</strong>
			<span style="font-size:13.5px;color:#334155;font-weight:600;">Bệnh viện Đa khoa Phương Đông</span>
		</div>
		<div style="background:#F0FDFA;border:1px solid #CCFBF1;border-radius:10px;padding:18px;text-align:center;">
			<strong style="font-size:28px;color:#0D9488;display:block;line-height:1;margin-bottom:6px;">05 PHÚT</strong>
			<span style="font-size:13.5px;color:#334155;font-weight:600;">Ga Metro số 2 (C1), Ciputra, Lotte Mall Tây Hồ, Starlake</span>
		</div>
		<div style="background:#F0FDFA;border:1px solid #CCFBF1;border-radius:10px;padding:18px;text-align:center;">
			<strong style="font-size:28px;color:#0D9488;display:block;line-height:1;margin-bottom:6px;">10 PHÚT</strong>
			<span style="font-size:13.5px;color:#334155;font-weight:600;">Hồ Tây lộng gió, KĐT Ngoại Giao Đoàn, Trụ sở 11 Bộ Ngành</span>
		</div>
		<div style="background:#F0FDFA;border:1px solid #CCFBF1;border-radius:10px;padding:18px;text-align:center;">
			<strong style="font-size:28px;color:#0D9488;display:block;line-height:1;margin-bottom:6px;">20 PHÚT</strong>
			<span style="font-size:13.5px;color:#334155;font-weight:600;">Sân bay Quốc tế Nội Bài qua cầu Thăng Long & Nhật Tân</span>
		</div>
	</div>
</div>
[/section]

[section label="5. Chuỗi 39 Tiện Ích Đa Tầng" bg_color="#F8FAFC" padding="60px 0px"]
<div class="kbds-container" id="tien-ich" style="max-width:1160px;margin:0 auto;padding:0 15px;">
	<div style="text-align:center;max-width:780px;margin:0 auto 36px;">
		<span style="color:#0D9488;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:8px;">TRỌN VẸN PHONG CÁCH SỐNG NGHỈ DƯỠNG</span>
		<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 10px;">Hệ Thống 39 Tiện Ích Đẳng Cấp Đa Tầng Trải Nghiệm</h2>
		<p style="color:#64748B;font-size:15px;margin:0;">Kiến tạo 3 tầng không gian sống từ mặt đất, trong nhà cho đến tầng mái chạm mây.</p>
	</div>

	<div style="text-align:center;margin-bottom:36px;">
		<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/tong-mat-bang-39-tien-ich-dang-cap-jade-square.jpg" alt="Tổng mặt bằng 39 tiện ích đẳng cấp Jade Square" style="width:100%;max-width:980px;border-radius:14px;box-shadow:0 8px 28px rgba(0,0,0,0.08);" />
	</div>

	<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:24px;">
		<div style="background:#FFF;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
			<h3 style="color:#0D9488;font-size:18px;font-weight:700;margin:0 0 14px;display:flex;align-items:center;gap:8px;">
				🌿 Tiện Ích Ngoài Trời & Cảnh Quan
			</h3>
			<ul style="margin:0;padding-left:18px;line-height:1.8;color:#475569;font-size:14.5px;">
				<li>Quảng trường Ngọc Bích biểu tượng dự án</li>
				<li>Hệ thống an ninh 3 lớp bảo vệ chuyên nghiệp 24/7</li>
				<li><strong>Bể bơi nước nóng</strong> chuẩn nghỉ dưỡng 4 mùa</li>
				<li><strong>Sân thể thao Pickleball</strong> & sân tập bóng rổ hiện đại</li>
				<li>Khu vui chơi trẻ em Kid Zone & khu thiếu niên</li>
				<li>Công viên Ngọc Lam & đường dạo bộ cây xanh mát</li>
			</ul>
		</div>

		<div style="background:#FFF;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
			<h3 style="color:#0D9488;font-size:18px;font-weight:700;margin:0 0 14px;display:flex;align-items:center;gap:8px;">
				🏢 Tiện Ích Trong Nhà (Tầng 1 – 3)
			</h3>
			<ul style="margin:0;padding-left:18px;line-height:1.8;color:#475569;font-size:14.5px;">
				<li>Khối đế thương mại mua sắm & ẩm thực sầm uất</li>
				<li>Sảnh đón tiếp sang trọng 5 sao cao trần</li>
				<li>Trường mầm non tiêu chuẩn quốc tế ngay trong tòa nhà</li>
				<li>Khu văn phòng làm việc & phòng họp đa năng</li>
				<li>Trung tâm Gym + Yoga với dàn máy tập cao cấp</li>
				<li>Phòng sinh hoạt cộng đồng, câu lạc bộ bi-a, bóng bàn</li>
			</ul>
		</div>

		<div style="background:#FFF;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
			<h3 style="color:#0D9488;font-size:18px;font-weight:700;margin:0 0 14px;display:flex;align-items:center;gap:8px;">
				✨ Tiện Ích Tầng Mái Sky Garden
			</h3>
			<ul style="margin:0;padding-left:18px;line-height:1.8;color:#475569;font-size:14.5px;">
				<li><strong>Đài quan sát & Kính viễn vọng</strong> ngắm toàn cảnh thành phố</li>
				<li>Khu vực vườn thiền tĩnh tâm & sân tập Yoga chân mây</li>
				<li>Đường đá massage chân tăng cường tuần hoàn sức khỏe</li>
				<li>Vườn nướng BBQ ngoài trời dành cho gia đình & bạn bè</li>
				<li>Góc thư giãn cà phê ngắm hoàng hôn Tây Hồ Tây</li>
				<li>Hệ thống quản lý tòa nhà thông minh Smart BMS</li>
			</ul>
		</div>
	</div>
</div>
[/section]

[section label="6. Mặt Bằng Tòa Sapphire" bg_color="#FFFFFF" padding="60px 0px"]
<div class="kbds-container" id="mat-bang" style="max-width:1160px;margin:0 auto;padding:0 15px;">
	<div style="text-align:center;max-width:780px;margin:0 auto 36px;">
		<span style="color:#0D9488;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:8px;">QUY HOẠCH MẶT BẰNG CHI TIẾT</span>
		<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 10px;">Mặt Bằng Tầng Điển Hình Tòa Sapphire (Tòa J3)</h2>
		<p style="color:#64748B;font-size:15px;margin:0;">Mật độ căn hộ siêu lý tưởng chỉ 9 - 11 căn/sàn, 5 thang máy tốc độ cao đảm bảo không gian yên tĩnh và riêng tư.</p>
	</div>

	<div style="margin-bottom:40px;">
		<h3 style="color:#0B2C4D;font-size:20px;font-weight:700;margin:0 0 12px;text-align:center;">
			1. Mặt Bằng Tầng 04 – 24 (11 Căn/Sàn)
		</h3>
		<p style="text-align:center;color:#64748B;font-size:14.5px;margin:0 0 18px;">Bố trí hài hòa giữa các căn 2PN (72m² - 85m²), 2PN góc (79.91m²) và căn 3PN (127.82m²).</p>
		<div style="text-align:center;">
			<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/mat-bang-tang-dien-hinh-tang-04-24-toa-sapphire-jade-square.jpg" alt="Mặt bằng tầng 04-24 tòa Sapphire Jade Square" style="width:100%;max-width:980px;border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
		</div>
	</div>

	<div>
		<h3 style="color:#0B2C4D;font-size:20px;font-weight:700;margin:0 0 12px;text-align:center;">
			2. Mặt Bằng Tầng 25 – 26 (9 Căn/Sàn)
		</h3>
		<p style="text-align:center;color:#64748B;font-size:14.5px;margin:0 0 18px;">Tầng cao đặc quyền với sự xuất hiện của các siêu căn hộ 4 Phòng Ngủ diện tích 154.02 m².</p>
		<div style="text-align:center;">
			<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/mat-bang-tang-dien-hinh-tang-25-26-toa-sapphire-jade-square.jpg" alt="Mặt bằng tầng 25-26 tòa Sapphire Jade Square" style="width:100%;max-width:980px;border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
		</div>
	</div>
</div>
[/section]

[section label="7. Layout Thiết Kế Căn Hộ" bg_color="#F8FAFC" padding="60px 0px"]
<div class="kbds-container" id="layout-can-ho" style="max-width:1160px;margin:0 auto;padding:0 15px;">
	<div style="text-align:center;max-width:780px;margin:0 auto 36px;">
		<span style="color:#0D9488;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:8px;">LAYOUT THIẾT KẾ CĂN HỘ CHI TIẾT</span>
		<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 10px;">Bộ Sưu Tập Căn Hộ Sang Trọng Tòa Sapphire</h2>
		<p style="color:#64748B;font-size:15px;margin:0;">100% phòng ngủ tiếp xúc ánh sáng tự nhiên, ban công rộng mở, bàn giao hoàn thiện liền tường cao cấp.</p>
	</div>

	<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px;margin-bottom:30px;">
		<!-- Căn 2PN Thường -->
		<div style="background:#FFF;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);overflow:hidden;padding:16px;">
			<span style="background:#0D9488;color:#FFF;font-size:11.5px;font-weight:700;padding:3px 10px;border-radius:4px;display:inline-block;margin-bottom:10px;">CĂN 2 PHÒNG NGỦ</span>
			<h4 style="color:#0B2C4D;font-size:17px;font-weight:700;margin:0 0 8px;">Diện tích: 71.41 – 85.55 m²</h4>
			<p style="color:#64748B;font-size:13.5px;line-height:1.5;margin:0 0 14px;">Số lượng: 157 căn. Bố trí 2PN - 2WC, phòng khách kết nối logia thoáng đãng.</p>
			<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/thiet-ke-layout-can-ho-2-phong-ngu-jade-square.jpg" alt="Layout căn hộ 2 phòng ngủ Jade Square" style="width:100%;border-radius:8px;" />
		</div>

		<!-- Căn 2PN Góc -->
		<div style="background:#FFF;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);overflow:hidden;padding:16px;">
			<span style="background:#0D9488;color:#FFF;font-size:11.5px;font-weight:700;padding:3px 10px;border-radius:4px;display:inline-block;margin-bottom:10px;">CĂN 2 PHÒNG NGỦ GÓC</span>
			<h4 style="color:#0B2C4D;font-size:17px;font-weight:700;margin:0 0 8px;">Diện tích: 79.91 m²</h4>
			<p style="color:#64748B;font-size:13.5px;line-height:1.5;margin:0 0 14px;">Số lượng: 42 căn. 2 mặt thoáng ngắm toàn cảnh, đón gió và nắng tự nhiên tối đa.</p>
			<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/thiet-ke-layout-can-ho-2-phong-ngu-goc-jade-square.jpg" alt="Layout căn hộ 2 phòng ngủ góc Jade Square" style="width:100%;border-radius:8px;" />
		</div>

		<!-- Căn 3PN -->
		<div style="background:#FFF;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);overflow:hidden;padding:16px;">
			<span style="background:#0B2C4D;color:#FFF;font-size:11.5px;font-weight:700;padding:3px 10px;border-radius:4px;display:inline-block;margin-bottom:10px;">CĂN 3 PHÒNG NGỦ</span>
			<h4 style="color:#0B2C4D;font-size:17px;font-weight:700;margin:0 0 8px;">Diện tích: 127.43 – 127.86 m²</h4>
			<p style="color:#64748B;font-size:13.5px;line-height:1.5;margin:0 0 14px;">Số lượng: 46 căn. Không gian đại gia đình đẳng cấp với phòng khách siêu rộng.</p>
			<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/thiet-ke-layout-can-ho-3-phong-ngu-jade-square.jpg" alt="Layout căn hộ 3 phòng ngủ Jade Square" style="width:100%;border-radius:8px;" />
		</div>

		<!-- Căn 4PN -->
		<div style="background:#FFF;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);overflow:hidden;padding:16px;">
			<span style="background:#C59B27;color:#FFF;font-size:11.5px;font-weight:700;padding:3px 10px;border-radius:4px;display:inline-block;margin-bottom:10px;">CĂN 4 PHÒNG NGỦ VIP</span>
			<h4 style="color:#0B2C4D;font-size:17px;font-weight:700;margin:0 0 8px;">Diện tích: 154.02 m²</h4>
			<p style="color:#64748B;font-size:13.5px;line-height:1.5;margin:0 0 14px;">Số lượng: Chỉ 4 căn độc bản tại tầng 25-26. Dành riêng cho chủ nhân thượng lưu.</p>
			<img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/thiet-ke-layout-can-ho-4-phong-ngu-jade-square.jpg" alt="Layout căn hộ 4 phòng ngủ Jade Square" style="width:100%;border-radius:8px;" />
		</div>
	</div>
</div>
[/section]

[section label="8. Chính Sách & Giá Bán" bg_color="#FFFFFF" padding="60px 0px"]
<div class="kbds-container" id="chinh-sach" style="max-width:1160px;margin:0 auto;padding:0 15px;">
	<div style="text-align:center;max-width:780px;margin:0 auto 36px;">
		<span style="color:#0D9488;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:8px;">ƯU ĐÃI ĐỢT 1 TÒA SAPPHIRE</span>
		<h2 style="color:#0B2C4D;font-size:28px;font-weight:800;margin:0 0 10px;">Chính Sách Bán Hàng &amp; Tiến Độ Thanh Toán</h2>
		<p style="color:#64748B;font-size:15px;margin:0;">Lộ trình thanh toán linh hoạt, hỗ trợ lãi suất 0% từ các ngân hàng đối tác uy tín.</p>
	</div>

	<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:24px;">
		<div style="background:#F0FDFA;border:1px solid #CCFBF1;border-radius:12px;padding:24px;">
			<h3 style="color:#0D9488;font-size:18px;font-weight:700;margin:0 0 14px;">🎁 Ưu Đãi Đặt Mua Sớm Đợt 1</h3>
			<ul style="margin:0;padding-left:18px;line-height:1.8;color:#334155;font-size:14.5px;">
				<li>Chiết khấu thanh toán sớm lên tới <strong>8% - 10%</strong> giá trị căn hộ.</li>
				<li>Quà tặng gói tân gia nội thất cao cấp cho 50 khách hàng đầu tiên.</li>
				<li>Miễn phí <strong>02 năm phí quản lý dịch vụ</strong> tiêu chuẩn quốc tế.</li>
				<li>Ưu tiên chọn tầng, chọn hướng đẹp và suất đỗ xe định danh.</li>
			</ul>
		</div>

		<div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:12px;padding:24px;">
			<h3 style="color:#0B2C4D;font-size:18px;font-weight:700;margin:0 0 14px;">🏦 Gói Vay Hỗ Trợ Ngân Hàng</h3>
			<ul style="margin:0;padding-left:18px;line-height:1.8;color:#334155;font-size:14.5px;">
				<li>Hỗ trợ vay vốn lên tới <strong>70% giá trị hợp đồng</strong>.</li>
				<li><strong>Lãi suất 0%</strong> và ân hạn nợ gốc tới khi nhận bàn giao nhà.</li>
				<li>Thời hạn vay linh hoạt kéo dài lên tới <strong>25 - 35 năm</strong>.</li>
				<li>Thủ tục phê duyệt nhanh chóng, đối tác: Vietcombank, BIDV, MBBank.</li>
			</ul>
		</div>
	</div>
</div>
[/section]

[section label="9. Hỏi Đáp FAQ" bg_color="#F8FAFC" padding="50px 0px"]
<div class="kbds-container" id="faq" style="max-width:980px;margin:0 auto;padding:0 15px;">
	<div style="text-align:center;margin-bottom:36px;">
		<span style="color:#0D9488;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:8px;">HỎI ĐÁP PHỔ BIẾN</span>
		<h2 style="color:#0B2C4D;font-size:26px;font-weight:800;margin:0;">Những Câu Hỏi Thường Gặp Về Chung Cư Jade Square</h2>
	</div>

	<div style="display:flex;flex-direction:column;gap:14px;">
		<div style="background:#FFF;padding:18px 22px;border-radius:10px;border:1px solid #E2E8F0;">
			<strong style="color:#0B2C4D;font-size:16px;display:block;margin-bottom:6px;">1. Dự án Jade Square nằm ở đâu và kết nối giao thông thế nào?</strong>
			<p style="color:#475569;font-size:14.5px;line-height:1.6;margin:0;">Dự án tọa lạc tại KĐT Bắc Cổ Nhuế – Chèm, đường Nguyễn Đình Tứ, Bắc Từ Liêm, Hà Nội. Nằm ngay sát trục Phạm Văn Đồng, đường Tây Thăng Long và tuyến Metro số 2, số 6, kết nối tới Lotte Mall Tây Hồ, Ngoại Giao Đoàn và Starlake chỉ trong 5 - 10 phút.</p>
		</div>
		<div style="background:#FFF;padding:18px 22px;border-radius:10px;border:1px solid #E2E8F0;">
			<strong style="color:#0B2C4D;font-size:16px;display:block;margin-bottom:6px;">2. Tòa Sapphire có bao nhiêu căn hộ và mật độ sàn ra sao?</strong>
			<p style="color:#475569;font-size:14.5px;line-height:1.6;margin:0;">Tòa Sapphire cao 26 tầng, mật độ cực kỳ thấp chỉ 11 căn/sàn (tầng 04-24) và 9 căn/sàn (tầng 25-26), phục vụ bởi 5 thang máy tốc độ cao, đem lại không gian sống yên tĩnh và văn minh tối đa.</p>
		</div>
		<div style="background:#FFF;padding:18px 22px;border-radius:10px;border:1px solid #E2E8F0;">
			<strong style="color:#0B2C4D;font-size:16px;display:block;margin-bottom:6px;">3. Pháp lý dự án Jade Square có an toàn không?</strong>
			<p style="color:#475569;font-size:14.5px;line-height:1.6;margin:0;">Dự án có đầy đủ quy hoạch 1/500, giấy phép xây dựng và hình thức sở hữu sổ hồng lâu dài cho khách hàng mang quốc tịch Việt Nam.</p>
		</div>
	</div>
</div>
[/section]

[section label="10. Form Nhận Bảng Giá" bg_color="#042F2C" dark="true" padding="60px 0px"]
<div class="kbds-container" id="nhan-bang-gia" style="max-width:880px;margin:0 auto;padding:0 15px;text-align:center;">
	<span style="color:#2DD4BF;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:10px;">TRỰC TIẾP TỪ CHỦ ĐẦU TƯ</span>
	<h2 style="color:#FFFFFF;font-size:30px;font-weight:800;margin:0 0 12px;">Đăng Ký Nhận Bảng Giá Gốc &amp; Suất Đẹp Tòa Sapphire</h2>
	<p style="color:#CBD5E1;font-size:15px;line-height:1.6;margin:0 auto 30px;max-width:680px;">
		Chuyên viên Kênh Bất Động Sản sẽ gửi trọn bộ file mặt bằng bản vẽ chi tiết độ nét cao, bảng tính dòng tiền vay ngân hàng và danh sách căn tầng đẹp trực tiếp qua Zalo của quý khách trong 3 phút.
	</p>
	<div style="background:#FFFFFF;border-radius:14px;padding:30px;box-shadow:0 10px 30px rgba(0,0,0,0.3);text-align:left;color:#0B2C4D;">
		[contact-form-7 id="36" title="Form Tư Vấn BĐS"]
		<p style="text-align:center;font-size:12px;color:#64748B;margin:12px 0 0;">🔒 Cam kết bảo mật thông tin 100%. Phản hồi chính xác &amp; tận tâm 24/7.</p>
	</div>
</div>
[/section]
HTML;

$proj_data = [
    'post_title'   => $project_title,
    'post_name'    => $project_slug,
    'post_content' => $proj_content,
    'post_status'  => 'publish',
    'post_type'    => 'du_an',
    'post_author'  => 1,
];

if ($existing_proj) {
    $proj_data['ID'] = $existing_proj->ID;
    $proj_id = wp_update_post($proj_data);
    echo "✔ Đã cập nhật Dự án [{$project_title}] (ID: {$proj_id})\n";
} else {
    $proj_id = wp_insert_post($proj_data);
    echo "+ Đã tạo mới Dự án [{$project_title}] (ID: {$proj_id})\n";
}

// Gán ảnh đại diện và meta cho Dự án
set_post_thumbnail($proj_id, $media_map['phoi-canh-toa-can-ho-sapphire-jade-square']);

$proj_meta = [
    '_kbds_project_code'   => 'DA-JS-05',
    '_kbds_price_from'     => 'Đang cập nhật (Mở bán Đợt 1 Tòa Sapphire)',
    '_kbds_address'        => 'Khu đô thị Bắc Cổ Nhuế – Chèm, Đường Nguyễn Đình Tứ, Bắc Từ Liêm, Hà Nội',
    '_kbds_total_area'     => 'Tổ hợp 8,9 ha (Tòa Sapphire 26 tầng nổi, 3 tầng hầm)',
    '_kbds_scale'          => 'Tòa Sapphire cao 26 tầng, mật độ 9-11 căn/sàn, 249 căn hộ cao cấp',
    '_kbds_legal_status'   => 'Sổ hồng sở hữu lâu dài (Đầy đủ QH 1/500)',
    '_kbds_handover_time'  => 'Dự kiến Quý IV/2026',
    '_kbds_bank_support'   => 'Hỗ trợ vay 70%, lãi suất 0% & ân hạn nợ gốc',
    '_kbds_review_score'   => '9.5',
    '_kbds_pros_cons'      => 'Tọa độ siêu kết nối Tây Hồ Tây, 39 tiện ích đa tầng, mật độ căn hộ siêu thấp chỉ 9-11 căn/sàn.',
    'rank_math_title'      => 'Chung Cư Jade Square Bắc Từ Liêm | Bảng Giá & Mặt Bằng Tòa Sapphire',
    'rank_math_description'=> 'Thông tin chính thức dự án chung cư Jade Square Bắc Từ Liêm: Tọa độ kết nối Tây Hồ Tây, 39 tiện ích đẳng cấp, bảng giá đợt 1 & layout mặt bằng Tòa Sapphire.',
    'rank_math_focus_keyword' => 'Chung cư Jade Square',
];

foreach ($proj_meta as $mk => $mv) {
    update_post_meta($proj_id, $mk, $mv);
}

// Gán Taxonomies
wp_set_object_terms($proj_id, 'Hà Nội', 'khu_vuc_bds');
wp_set_object_terms($proj_id, 'Căn hộ chung cư', 'loai_hinh_bds');
wp_set_object_terms($proj_id, 'Sắp mở bán', 'trang_thai_du_an');
wp_set_object_terms($proj_id, 'Vimefulland', 'chu_dau_tu');

echo "✔ Đã cấu hình Meta, Taxonomy & Featured Image cho Dự án Jade Square (ID: {$proj_id})\n";

// Lưu ID dự án để dùng tiếp
file_put_contents(__DIR__ . '/jade-project-id.txt', $proj_id);
