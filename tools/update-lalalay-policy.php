<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU CẬP NHẬT CHÍNH SÁCH BÁN HÀNG & TIẾN ĐỘ LALALAY RESIDENCES\n";
echo "==============================================================\n";

$project = get_post(170);
if (!$project) {
    die("❌ Không tìm thấy dự án ID 170\n");
}

$media_map_file = __DIR__ . '/lalalay-policy-media-map.json';
$media_map = file_exists($media_map_file) ? json_decode(file_get_contents($media_map_file), true) : [];

$img_policy   = $media_map['chinh-sach-ban-hang-du-kien-lalalay-residences.jpg']['url'] ?? '';
$img_standard = $media_map['tien-do-thanh-toan-chuan-quy-thuong-lalalay-residences.jpg']['url'] ?? '';
$img_early    = $media_map['tien-do-thanh-toan-som-quy-lalakey-lalalay-residences.jpg']['url'] ?? '';
$img_super    = $media_map['tien-do-thanh-toan-sieu-gian-quy-lalakey-lalalay-residences.jpg']['url'] ?? '';

// 1. XÂY DỰNG SECTION CHÍNH SÁCH BÁN HÀNG & TIẾN ĐỘ THANH TOÁN (UX BUILDER)
$policy_section = <<<EOT
[section label="9.5. Chính Sách Bán Hàng & Tiến Độ Thanh Toán Lalalay Residences" bg_color="#F8FAFC" padding="64px"]

<div id="chinh-sach-ban-hang"></div>

[row]
[col span="12" span__sm="12"]

<div style="text-align:center;max-width:850px;margin:0 auto 36px">
	<span class="kbds-lala-badge" style="background:rgba(217, 74, 30, 0.12);color:#D94A1E;border:1px solid rgba(217, 74, 30, 0.3);padding:6px 16px;border-radius:20px;font-weight:700;font-size:12px;letter-spacing:0.5px;text-transform:uppercase;display:inline-block;margin-bottom:12px">⚡ CẬP NHẬT CHÍNH THỨC TỪ BOLT HOLDINGS</span>
	<h2 style="color:#2D241E;font-size:32px;font-weight:900;line-height:1.3;margin:0 0 12px;letter-spacing:-0.5px">Chính Sách Bán Hàng &amp; 3 Phương Án Tiến Độ Thanh Toán Lalalay Residences</h2>
	<p style="color:#64748B;font-size:16px;line-height:1.65;margin:0">Chủ đầu tư áp dụng chính sách thanh toán linh hoạt bậc nhất phía Tây Hà Nội: Hỗ trợ lãi suất 24 tháng hoặc nhận chiết khấu thanh toán sớm đến 7%, cùng gói giãn tiến độ siêu việt đến năm 2032 dành riêng cho Quỹ Lalakey.</p>
</div>

<!-- ĐẶC QUYỀN ÁP DỤNG CHUNG -->
<div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:14px;padding:28px 24px;margin-bottom:30px;box-shadow:0 4px 20px rgba(0,0,0,0.04)">
	<div style="display:flex;align-items:center;gap:10px;margin-bottom:18px;border-bottom:2px solid #F1F5F9;padding-bottom:12px">
		<span style="font-size:22px">💎</span>
		<h3 style="margin:0;font-size:20px;font-weight:800;color:#0F172A">Đặc Quyền Áp Dụng Chung Cho Mọi Căn Hộ</h3>
	</div>
	<div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:18px">
		<div style="background:linear-gradient(135deg,#FFF7ED 0%,#FFEDD5 100%);border-left:4px solid #EA580C;padding:18px 20px;border-radius:10px">
			<div style="font-size:28px;font-weight:900;color:#C2410C;margin-bottom:4px">2 NĂM</div>
			<div style="font-size:15px;font-weight:700;color:#9A3412;margin-bottom:4px">Miễn Phí Dịch Vụ &amp; Phí Tiện Ích</div>
			<p style="font-size:13px;color:#7C2D12;margin:0;line-height:1.5">Miễn phí hoàn toàn phí quản lý vận hành tòa nhà và trải nghiệm hệ sinh thái 16 tiện ích cao cấp nội khu.</p>
		</div>
		<div style="background:linear-gradient(135deg,#EFF6FF 0%,#DBEAFE 100%);border-left:4px solid #2563EB;padding:18px 20px;border-radius:10px">
			<div style="font-size:28px;font-weight:900;color:#1D4ED8;margin-bottom:4px">-1.5%</div>
			<div style="font-size:15px;font-weight:700;color:#1E40AF;margin-bottom:4px">Chiết Khấu Booking Sớm</div>
			<p style="font-size:13px;color:#1E3A8A;margin:0;line-height:1.5">Áp dụng trực tiếp vào giá bán dành riêng cho 100 khách hàng đầu tiên đăng ký giữ chỗ căn hộ.</p>
		</div>
		<div style="background:linear-gradient(135deg,#F0FDF4 0%,#DCFCE7 100%);border-left:4px solid #16A34A;padding:18px 20px;border-radius:10px">
			<div style="font-size:28px;font-weight:900;color:#15803D;margin-bottom:4px">-1.8%</div>
			<div style="font-size:15px;font-weight:700;color:#166534;margin-bottom:4px">Không Nhận Bảo Lãnh Ngân Hàng</div>
			<p style="font-size:13px;color:#14532D;margin:0;line-height:1.5">Khấu trừ trực tiếp 1.8% vào hợp đồng khi khách hàng tự nguyện không yêu cầu thư bảo lãnh ngân hàng.</p>
		</div>
	</div>
</div>

<!-- SO SÁNH ƯU ĐÃI: QUỸ THƯỜNG VS QUỸ LALAKEY -->
<div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:24px;margin-bottom:36px">
	<!-- Cột Quỹ Thường -->
	<div style="background:#FFFFFF;border:2px solid #E2E8F0;border-radius:14px;overflow:hidden;box-shadow:0 6px 24px rgba(0,0,0,0.05);display:flex;flex-direction:column">
		<div style="background:#8C3823;color:#FFFFFF;padding:16px 20px;text-align:center">
			<span style="font-size:12px;text-transform:uppercase;letter-spacing:1px;font-weight:700;opacity:0.9">Sản phẩm mở bán đại trà</span>
			<h3 style="margin:4px 0 0;font-size:22px;font-weight:900;color:#FFFFFF">ƯU ĐÃI QUỸ THƯỜNG</h3>
		</div>
		<div style="padding:24px;flex-grow:1;display:flex;flex-direction:column;justify-content:space-between">
			<div style="margin-bottom:20px">
				<div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;padding-bottom:14px;border-bottom:1px dashed #E2E8F0">
					<div style="font-size:32px;font-weight:900;color:#DC2626;min-width:75px">-7%</div>
					<div>
						<strong style="color:#0F172A;font-size:15px;display:block">Chiết khấu Thanh Toán Sớm</strong>
						<span style="color:#64748B;font-size:13px">Khách hàng thanh toán nhanh theo tiến độ chuẩn nhận ngay chiết khấu 7%</span>
					</div>
				</div>
				<div style="display:flex;align-items:center;gap:12px">
					<div style="font-size:32px;font-weight:900;color:#2563EB;min-width:75px">+9%</div>
					<div>
						<strong style="color:#0F172A;font-size:15px;display:block">Hỗ trợ lãi suất 70% trong 24 THÁNG</strong>
						<span style="color:#64748B;font-size:13px">Ngân hàng giải ngân 70%, CĐT hỗ trợ lãi suất 0% và ân hạn nợ gốc suốt 24 tháng</span>
					</div>
				</div>
			</div>
			<div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:12px 14px;font-size:13px;color:#475569">
				💡 <em>Thích hợp cho khách hàng tận dụng đòn bẩy tài chính ngân hàng hoặc sẵn vốn muốn nhận chiết khấu tiền mặt cao nhất.</em>
			</div>
		</div>
	</div>

	<!-- Cột Quỹ Lalakey -->
	<div style="background:#FFFFFF;border:2px solid #D4AF37;border-radius:14px;overflow:hidden;box-shadow:0 8px 28px rgba(212,175,55,0.18);display:flex;flex-direction:column">
		<div style="background:linear-gradient(135deg,#071D36 0%,#0B2C4D 100%);color:#FFFFFF;padding:16px 20px;text-align:center;border-bottom:2px solid #D4AF37">
			<span style="font-size:12px;text-transform:uppercase;letter-spacing:1px;font-weight:700;color:#FDE68A">Quỹ Căn Tinh Hoa Độc Quyền</span>
			<h3 style="margin:4px 0 0;font-size:22px;font-weight:900;color:#FDE68A">ƯU ĐÃI QUỸ LALAKEY</h3>
		</div>
		<div style="padding:24px;flex-grow:1;display:flex;flex-direction:column;justify-content:space-between">
			<div style="margin-bottom:20px">
				<div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;padding-bottom:14px;border-bottom:1px dashed #E2E8F0">
					<div style="font-size:32px;font-weight:900;color:#D4AF37;min-width:75px">-2.5%</div>
					<div>
						<strong style="color:#0F172A;font-size:15px;display:block">Chiết khấu Thanh Toán Sớm</strong>
						<span style="color:#64748B;font-size:13px">Nhận ngay chiết khấu 2.5% trừ vào giá trị hợp đồng khi thanh toán sớm</span>
					</div>
				</div>
				<div style="display:flex;align-items:center;gap:12px">
					<div style="font-size:26px;font-weight:900;color:#0D9488;min-width:75px">SIÊU GIÃN</div>
					<div>
						<strong style="color:#0F172A;font-size:15px;display:block">Thanh toán kéo dài đến năm 2032</strong>
						<span style="color:#64748B;font-size:13px">Nhận nhà ở Quý 1/2029 khi mới đóng 55%, 45% còn lại trả dần tới T11/2032</span>
					</div>
				</div>
			</div>
			<div style="background:#FFFBEB;border:1px solid #FDE68A;border-radius:8px;padding:12px 14px;font-size:13px;color:#92400E">
				🌟 <em>Đặc quyền độc nhất vô nhị: Khách hàng tích sản an toàn, không lo lãi suất vay, dòng tiền siêu nhẹ mỗi đợt chỉ 2-3%.</em>
			</div>
		</div>
	</div>
</div>

<!-- ẢNH INFOGRAPHIC CHÍNH SÁCH BÁN HÀNG DỰ KIẾN -->
<div style="text-align:center;margin-bottom:48px">
	<img src="{$img_policy}" alt="Chính sách bán hàng dự kiến dự án căn hộ Lalalay Residences Bắc An Khánh" style="width:100%;max-width:1100px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 8px 30px rgba(0,0,0,0.06)" />
	<p style="font-size:13px;color:#64748B;font-style:italic;margin-top:8px">Hình ảnh: Bảng tổng hợp chính sách bán hàng dự kiến dự án Lalalay Residences (Nguồn: Bolt Holdings)</p>
</div>

<!-- PHƯƠNG ÁN 1: QUỸ THƯỜNG - TIẾN ĐỘ CHUẨN -->
<div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:14px;padding:32px 28px;margin-bottom:40px;box-shadow:0 4px 20px rgba(0,0,0,0.04)">
	<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px">
		<div>
			<span style="background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;text-transform:uppercase">Phương Án 1</span>
			<h3 style="margin:8px 0 0;font-size:24px;font-weight:800;color:#0F172A">Quỹ Thường – Tiến Độ Thanh Toán Chuẩn (16 Đợt Kéo Dài Đến 2029)</h3>
		</div>
		<span style="font-size:14px;color:#64748B;font-weight:600">Lũy kế: 2027 (30%) • 2028 (30%) • 2029 (40%)</span>
	</div>
	
	<div style="margin-bottom:24px">
		<img src="{$img_standard}" alt="Tiến độ thanh toán chuẩn quỹ thường căn hộ Lalalay Residences" style="width:100%;border-radius:10px;border:1px solid #E2E8F0" />
	</div>

	<div style="overflow-x:auto">
		<table style="width:100%;border-collapse:collapse;font-size:14px;text-align:left">
			<thead>
				<tr style="background:#F1F5F9;color:#0F172A;font-weight:700">
					<th style="padding:12px 14px;border:1px solid #E2E8F0">Giai Đoạn</th>
					<th style="padding:12px 14px;border:1px solid #E2E8F0">Đợt Thanh Toán</th>
					<th style="padding:12px 14px;border:1px solid #E2E8F0">Thời Điểm</th>
					<th style="padding:12px 14px;border:1px solid #E2E8F0;text-align:center">Tỷ Lệ</th>
					<th style="padding:12px 14px;border:1px solid #E2E8F0;text-align:center">Lũy Kế</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="6" style="padding:12px 14px;border:1px solid #E2E8F0;font-weight:700;color:#8C3823;background:#FFF7ED">Năm 2027<br><small style="color:#C2410C">(6 đợt - 30%)</small></td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 1</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Ký HĐDV (Ngày T, dự kiến 05/01/2027)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">50 Triệu</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">50 Triệu</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 2 - 3</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">T+30 (5%) và T+60 (5%)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">10%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">10% + 50tr</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 4</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Ký HĐMB (Dự kiến T09/2027)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">5%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">15%</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 5</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Tháng 10/2027</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">5%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">20%</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 6</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Tháng 11/2027</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">5%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">25%</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 7</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Tháng 12/2027</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">5%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">30%</td>
				</tr>
				<tr>
					<td rowspan="3" style="padding:12px 14px;border:1px solid #E2E8F0;font-weight:700;color:#2563EB;background:#EFF6FF">Năm 2028<br><small style="color:#1D4ED8">(6 đợt - 30%)</small></td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 8 - 9</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Tháng 02/2028 (5%) và Tháng 04/2028 (5%)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">10%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">40%</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 10 - 11</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Tháng 06/2028 (5%) và Tháng 08/2028 (5%)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">10%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">50%</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 12 - 13</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Tháng 10/2028 (5%) và Tháng 12/2028 (5%)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">10%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">60%</td>
				</tr>
				<tr>
					<td rowspan="3" style="padding:12px 14px;border:1px solid #E2E8F0;font-weight:700;color:#16A34A;background:#F0FDF4">Năm 2029<br><small style="color:#15803D">(4 đợt - 40%)</small></td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 14 - 15</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Tháng 02/2029 (5%) và Tháng 03/2029 (5%)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">10%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center">70%</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;font-weight:700;color:#D94A1E">Đợt 16 (Bàn giao)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;font-weight:700">BÀN GIAO CĂN HỘ (Dự kiến Quý 1/2029)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:800;color:#D94A1E">25%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">95%</td>
				</tr>
				<tr>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Đợt 17 (Sổ đỏ)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0">Thông báo nhận Giấy chứng nhận quyền sở hữu (T10/2029)</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700">5%</td>
					<td style="padding:10px 14px;border:1px solid #E2E8F0;text-align:center;font-weight:700;color:#16A34A">100%</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<!-- PHƯƠNG ÁN 2 & 3: QUỸ LALAKEY -->
<div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:14px;padding:32px 28px;margin-bottom:40px;box-shadow:0 4px 20px rgba(0,0,0,0.04)">
	<div style="margin-bottom:20px">
		<span style="background:#FEF3C7;color:#D97706;border:1px solid #FDE68A;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;text-transform:uppercase">Phương Án 2 &amp; 3</span>
		<h3 style="margin:8px 0 0;font-size:24px;font-weight:800;color:#0F172A">Quỹ Lalakey – Tiến Độ Thanh Toán Sớm &amp; Tiến Độ Siêu Giãn</h3>
	</div>

	<!-- TAB / BLOCK 2A: THANH TOÁN SỚM -->
	<div style="border:1px solid #F1F5F9;border-radius:12px;padding:22px;margin-bottom:30px;background:#FAF5FF">
		<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:14px">
			<h4 style="margin:0;font-size:18px;font-weight:800;color:#6B21A8">🌟 Phương Án 2: Quỹ Lalakey - Thanh Toán Sớm (Nhận Chiết Khấu -2.5%)</h4>
			<span style="font-size:13px;background:#F3E8FF;color:#7E22CE;padding:4px 10px;border-radius:6px;font-weight:700">Tổng 7 Đợt</span>
		</div>
		<img src="{$img_early}" alt="Tiến độ thanh toán sớm quỹ Lalakey căn hộ Lalalay Residences" style="width:100%;border-radius:10px;border:1px solid #E2E8F0;margin-bottom:14px" />
		<ul style="margin:0;padding-left:20px;font-size:14px;color:#475569;line-height:1.75">
			<li><strong>Đợt 1 (T1/2027):</strong> 50 Triệu (Đặt cọc &amp; ký HĐDV)</li>
			<li><strong>Đợt 2 - 3 (T2 &amp; T3/2027):</strong> Mỗi đợt 5% (Lũy kế 10%)</li>
			<li><strong>Đợt 4 (T9/2027):</strong> Ký HĐTM nộp 5% (Lũy kế 15%)</li>
			<li><strong>Đợt 5 (T10/2027):</strong> Thanh toán 35% (Lũy kế đạt 50% - Sau đó thảnh thơi suốt hơn 1 năm không đóng tiền)</li>
			<li><strong>Đợt 6 (Quý 1/2029):</strong> Bàn giao nhà nộp 45% (Lũy kế 95%)</li>
			<li><strong>Đợt 7 (Quý 3/2029):</strong> Nhận sổ đỏ nộp 5% còn lại (Hoàn tất 100%)</li>
		</ul>
	</div>

	<!-- TAB / BLOCK 2B: THANH TOÁN SIÊU GIÃN ĐẾN 2032 -->
	<div style="border:1px solid #CCFBF1;border-radius:12px;padding:22px;background:#F0FDFA">
		<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:14px">
			<h4 style="margin:0;font-size:18px;font-weight:800;color:#0F766E">💎 Phương Án 3: Quỹ Lalakey - Thanh Toán Siêu Giãn (Kéo Dài Đến Tận Năm 2032)</h4>
			<span style="font-size:13px;background:#CCFBF1;color:#0D9488;padding:4px 10px;border-radius:6px;font-weight:700">Trả Chậm 3 Năm Sau Bàn Giao</span>
		</div>
		<img src="{$img_super}" alt="Tiến độ thanh toán siêu giãn quỹ Lalakey dự án Lalalay Residences" style="width:100%;border-radius:10px;border:1px solid #E2E8F0;margin-bottom:14px" />
		<div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-top:16px">
			<div style="background:#FFFFFF;border:1px solid #99F6E4;padding:12px 14px;border-radius:8px">
				<strong style="color:#0F766E;display:block;font-size:14px">Năm 2027: Lũy kế 26%</strong>
				<span style="font-size:12.5px;color:#64748B">6 đợt đóng: Cọc 50tr + 5 đợt x 5%</span>
			</div>
			<div style="background:#FFFFFF;border:1px solid #99F6E4;padding:12px 14px;border-radius:8px">
				<strong style="color:#0F766E;display:block;font-size:14px">Năm 2028: Lũy kế 18%</strong>
				<span style="font-size:12.5px;color:#64748B">6 đợt đóng: 3%/đợt (17 tháng)</span>
			</div>
			<div style="background:#FFFFFF;border:1px solid #99F6E4;padding:12px 14px;border-radius:8px">
				<strong style="color:#D94A1E;display:block;font-size:14px">Quý 1/2029: Bàn giao 5%</strong>
				<span style="font-size:12.5px;color:#64748B">Nhận nhà ở ngay khi lũy kế mới chỉ 55%!</span>
			</div>
			<div style="background:#FFFFFF;border:1px solid #99F6E4;padding:12px 14px;border-radius:8px">
				<strong style="color:#0F766E;display:block;font-size:14px">Năm 2030 - 2031: 24%</strong>
				<span style="font-size:12.5px;color:#64748B">Mỗi năm 12% (chia 6 đợt x 2%/đợt)</span>
			</div>
			<div style="background:#FFFFFF;border:1px solid #99F6E4;padding:12px 14px;border-radius:8px">
				<strong style="color:#0F766E;display:block;font-size:14px">Năm 2032: 15% (Sổ đỏ T11)</strong>
				<span style="font-size:12.5px;color:#64748B">Hoàn tất 100% sau 3 năm nhận nhà</span>
			</div>
		</div>
	</div>
</div>

<!-- FORM ĐĂNG KÝ BẢNG TÍNH DÒNG TIỀN -->
[kbds_lead_form_cao_tang]

[/col]
[/row]

[/section]
EOT;

// 2. CHÈN SECTION VÀO BÀI VIẾT DỰ ÁN 170 VÀ CẬP NHẬT SUBNAV
$raw_content = $project->post_content;

// Cập nhật Sub-Nav để có link #chinh-sach-ban-hang
if (strpos($raw_content, '#chinh-sach-ban-hang') === false) {
    $raw_content = str_replace(
        '<a href="#bang-gia-chinh-sach">Bảng Giá &amp; Lãi Vay</a>',
        '<a href="#chinh-sach-ban-hang">Chính Sách &amp; Tiến Độ</a>' . "\n\t\t" . '<a href="#bang-gia-chinh-sach">Giỏ Hàng &amp; Lãi Vay</a>',
        $raw_content
    );
}

// Kiểm tra xem đã có Section 9.5 chưa
if (strpos($raw_content, 'label="9.5. Chính Sách Bán Hàng & Tiến Độ') !== false) {
    // Thay thế section cũ
    $raw_content = preg_replace(
        '/\[section label="9\.5\. Chính Sách Bán Hàng & Tiến Độ.*?\[\/section\]/s',
        $policy_section,
        $raw_content
    );
    echo " + Đã cập nhật lại Section 9.5 Chính sách bán hàng trên Landing Page\n";
} else {
    // Chèn trước Section 10
    $target = '[section label="10. Giỏ Hàng &amp; Bảng Tính Lãi Vay"';
    if (strpos($raw_content, $target) !== false) {
        $raw_content = str_replace($target, $policy_section . "\n\n" . $target, $raw_content);
        echo " + Đã chèn Section 9.5 Chính sách bán hàng & Tiến độ thanh toán trước Section 10\n";
    } else {
        $raw_content .= "\n\n" . $policy_section;
        echo " + Đã nối Section 9.5 vào cuối bài viết\n";
    }
}

// Cập nhật meta bank support & review score
update_post_meta(170, '_kbds_bank_support', 'Hỗ trợ lãi suất 70% trong 24 tháng (+9%) • Chiết khấu thanh toán sớm 7% • Miễn phí dịch vụ 2 năm • Tiến độ siêu giãn đến 2032');

// Lưu bài viết dự án
wp_update_post([
    'ID'           => 170,
    'post_content' => $raw_content,
]);
echo "✔ Đã cập nhật Landing Page Dự Án Lalalay Residences (ID 170)\n";

// 3. TẠO HOẶC CẬP NHẬT BÀI VIẾT VỆ TINH VỀ CHÍNH SÁCH BÁN HÀNG
$sat_slug = 'chinh-sach-ban-hang-tien-do-thanh-toan-lalalay-residences';
$existing_sat = get_page_by_path($sat_slug, OBJECT, 'post');

$sat_title = 'Chính Sách Bán Hàng & Tiến Độ Thanh Toán Lalalay Residences: Phân Tích Quỹ Thường & Quỹ Lalakey 2026';
$sat_excerpt = 'Phân tích chi tiết chính sách bán hàng và 3 phương án tiến độ thanh toán dự án Lalalay Residences Bắc An Khánh: Miễn phí dịch vụ 2 năm, chiết khấu tới 7%, hỗ trợ lãi suất 24 tháng và gói thanh toán siêu giãn đến năm 2032.';

$sat_content = <<<EOT
<p class="kbds-post-lead"><strong>Lalalay Residences Bắc An Khánh</strong> vừa chính thức công bố chính sách bán hàng và các phương án tiến độ thanh toán cho đợt mở bán đầu tiên (Tòa LALA 1). Với sự phân chia độc đáo giữa <strong>Quỹ Thường</strong> và <strong>Quỹ Lalakey</strong>, dự án mang đến cho khách hàng mua để ở lẫn nhà đầu tư tích sản những đòn bẩy tài chính vô cùng hấp dẫn và an toàn bậc nhất thị trường phía Tây Hà Nội.</p>

<div class="kbds-toc-box" style="background:#F8FAFC;border:1px solid #E2E8F0;border-left:4px solid #D94A1E;border-radius:8px;padding:18px 22px;margin:24px 0;">
	<h3 style="margin:0 0 10px;font-size:16px;color:#0F172A;font-weight:800;">Mục Lục Bài Viết</h3>
	<ul style="margin:0;padding-left:20px;font-size:14px;line-height:1.75;color:#475569;">
		<li><a href="#dac-quyen-chung" style="color:#D94A1E;text-decoration:none;">1. Đặc quyền ưu đãi áp dụng chung cho mọi căn hộ</a></li>
		<li><a href="#so-sanh-quy-can" style="color:#D94A1E;text-decoration:none;">2. So sánh chính sách Quỹ Thường vs Quỹ Lalakey</a></li>
		<li><a href="#phuong-an-1" style="color:#D94A1E;text-decoration:none;">3. Phương án 1: Tiến độ thanh toán chuẩn Quỹ Thường (16 đợt đến 2029)</a></li>
		<li><a href="#phuong-an-2" style="color:#D94A1E;text-decoration:none;">4. Phương án 2: Tiến độ thanh toán sớm Quỹ Lalakey (Chiết khấu 2.5%)</a></li>
		<li><a href="#phuong-an-3" style="color:#D94A1E;text-decoration:none;">5. Phương án 3: Tiến độ thanh toán siêu giãn Quỹ Lalakey (Kéo dài đến 2032)</a></li>
		<li><a href="#loi-khuyen-tai-chinh" style="color:#D94A1E;text-decoration:none;">6. Lời khuyên tài chính: Nên chọn phương án thanh toán nào?</a></li>
	</ul>
</div>

<h2 id="dac-quyen-chung" style="color:#0F172A;font-size:24px;font-weight:800;margin-top:32px;">1. Đặc Quyền Ưu Đãi Áp Dụng Chung Cho Mọi Căn Hộ</h2>
<p>Dù lựa chọn bất kỳ loại hình căn hộ nào tại tòa LALA 1 hay các phân khu sau, tất cả khách hàng đều được thụ hưởng gói đặc quyền đồng bộ từ Chủ đầu tư Bolt Holdings:</p>

<div style="text-align:center;margin:24px 0;">
	<img src="{$img_policy}" alt="Chính sách bán hàng dự kiến dự án Lalalay Residences Bắc An Khánh" style="width:100%;max-width:960px;border-radius:10px;border:1px solid #E2E8F0;box-shadow:0 6px 20px rgba(0,0,0,0.06);" />
	<p style="font-size:13px;color:#64748B;font-style:italic;margin-top:6px;">Chính sách bán hàng dự kiến ban hành nội bộ dành cho dự án Lalalay Residences</p>
</div>

<ul>
	<li><strong>Miễn phí dịch vụ &amp; tiện ích 2 NĂM:</strong> Gia chủ được miễn phí toàn bộ chi phí quản lý vận hành tòa nhà tiêu chuẩn quốc tế và quyền sử dụng miễn phí hệ sinh thái 16 cụm tiện ích ngoài trời cùng tòa tiện ích độc quyền LALA 4.</li>
	<li><strong>Chiết khấu Booking Sớm -1.5%:</strong> Dành riêng cho 100 khách hàng đầu tiên đăng ký nguyện vọng giữ chỗ, chiết khấu được trừ trực tiếp vào giá bán chưa VAT và KPBT.</li>
	<li><strong>Chiết khấu Không nhận bảo lãnh ngân hàng -1.8%:</strong> Khách hàng tự nguyện không yêu cầu ngân hàng phát hành thư bảo lãnh tiến độ sẽ được chiết khấu thêm 1.8% giá trị căn hộ.</li>
</ul>

<h2 id="so-sanh-quy-can" style="color:#0F172A;font-size:24px;font-weight:800;margin-top:32px;">2. So Sánh Chính Sách Bán Hàng: Quỹ Thường vs Quỹ Lalakey</h2>
<p>Điểm khác biệt mang tính chiến lược của Lalalay Residences nằm ở cơ chế ưu đãi riêng cho hai nhóm quỹ căn:</p>

<table style="width:100%;border-collapse:collapse;font-size:14px;margin:20px 0;">
	<thead>
		<tr style="background:#0B2C4D;color:#FFFFFF;font-weight:700;">
			<th style="padding:12px 14px;border:1px solid #E2E8F0;">Tiêu Chí So Sánh</th>
			<th style="padding:12px 14px;border:1px solid #E2E8F0;">Quỹ Thường (Standard)</th>
			<th style="padding:12px 14px;border:1px solid #E2E8F0;">Quỹ Lalakey (Key Allotment)</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;font-weight:700;">Chiết khấu Thanh toán sớm</td>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;color:#DC2626;font-weight:700;">-7% Giá trị căn hộ</td>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;color:#D97706;font-weight:700;">-2.5% Giá trị căn hộ</td>
		</tr>
		<tr>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;font-weight:700;">Hỗ trợ lãi suất (HTLS)</td>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;color:#2563EB;font-weight:700;">Hỗ trợ vay 70% trong 24 Tháng (+9%)</td>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;">Thanh toán theo tiến độ vốn tự có</td>
		</tr>
		<tr>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;font-weight:700;">Phương án tiến độ thanh toán</td>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;">Tiến độ chuẩn 16 đợt đến năm 2029</td>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;font-weight:700;color:#0D9488;">Lựa chọn: Thanh toán sớm HOẶC Siêu giãn đến 2032</td>
		</tr>
		<tr>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;font-weight:700;">Đối tượng phù hợp</td>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;">Người mua ở cần đòn bẩy ngân hàng, hoặc nhà đầu tư vốn mạnh nhận chiết khấu cao</td>
			<td style="padding:10px 14px;border:1px solid #E2E8F0;">Nhà đầu tư tích sản dài hạn, gia đình trẻ tích lũy thu nhập hàng tháng không muốn gánh nợ ngân hàng</td>
		</tr>
	</tbody>
</table>

<h2 id="phuong-an-1" style="color:#0F172A;font-size:24px;font-weight:800;margin-top:32px;">3. Phương Án 1: Tiến Độ Thanh Toán Chuẩn Quỹ Thường (16 Đợt Đến Năm 2029)</h2>
<p>Phương án thanh toán chuẩn chia nhỏ dòng tiền thành 16 đợt, mỗi đợt chỉ 5% cách nhau từ 1 đến 2 tháng, giúp khách hàng hoàn toàn chủ động kế hoạch tài chính cá nhân:</p>

<div style="text-align:center;margin:24px 0;">
	<img src="{$img_standard}" alt="Tiến độ thanh toán chuẩn quỹ thường căn hộ Lalalay Residences" style="width:100%;max-width:960px;border-radius:10px;border:1px solid #E2E8F0;box-shadow:0 6px 20px rgba(0,0,0,0.06);" />
	<p style="font-size:13px;color:#64748B;font-style:italic;margin-top:6px;">Sơ đồ 16 đợt thanh toán chuẩn phân kỳ 3 năm (2027 - 2029) Quỹ Thường</p>
</div>

<ul>
	<li><strong>Năm 2027 (6 đợt thanh toán – Lũy kế 30%):</strong> Bắt đầu từ đặt cọc 50 triệu và ký HĐDV (Ngày T, dự kiến 05/01/2027), sau đó thanh toán 5% mỗi đợt tại T+30, T+60, thời điểm ký HĐMB (T09/2027) và các tháng 10, 11, 12/2027.</li>
	<li><strong>Năm 2028 (6 đợt thanh toán – Lũy kế 30%):</strong> Thanh toán đều đặn 5% vào các tháng chẵn: Tháng 2, 4, 6, 8, 10, 12/2028.</li>
	<li><strong>Năm 2029 (4 đợt thanh toán – Lũy kế 40%):</strong> Tháng 02/2029 đóng 5%, Tháng 03/2029 đóng 5%. Đến thời điểm <strong>Nhận bàn giao nhà (Quý 1/2029)</strong> thanh toán 25%. Cuối cùng, khi có thông báo bàn giao Sổ hồng (Tháng 10/2029) nộp 5% còn lại.</li>
</ul>

<h2 id="phuong-an-2" style="color:#0F172A;font-size:24px;font-weight:800;margin-top:32px;">4. Phương Án 2: Tiến Độ Thanh Toán Sớm Quỹ Lalakey (Chiết Khấu 2.5%)</h2>
<p>Dành cho khách hàng có nguồn vốn sẵn có muốn hoàn tất sớm các đợt đóng tiền để an tâm chờ nhận bàn giao nhà:</p>

<div style="text-align:center;margin:24px 0;">
	<img src="{$img_early}" alt="Tiến độ thanh toán sớm quỹ Lalakey căn hộ Lalalay Residences" style="width:100%;max-width:960px;border-radius:10px;border:1px solid #E2E8F0;box-shadow:0 6px 20px rgba(0,0,0,0.06);" />
	<p style="font-size:13px;color:#64748B;font-style:italic;margin-top:6px;">Lộ trình thanh toán sớm Quỹ Lalakey: Thanh toán 50% trong năm 2027, sau đó thảnh thơi chờ nhận nhà</p>
</div>

<ul>
	<li><strong>T1/2027:</strong> Đặt cọc &amp; ký HĐDV 50 triệu đồng.</li>
	<li><strong>T2 &amp; T3/2027:</strong> Đóng 5%/tháng (Lũy kế 10%).</li>
	<li><strong>T9/2027:</strong> Ký HĐTM đóng 5% (Lũy kế 15%).</li>
	<li><strong>T10/2027:</strong> Đóng 35% một lần (Lũy kế đạt 50%). Khách hàng được <strong>nghỉ ngơi tài chính suốt hơn 14 tháng</strong> không phải nộp thêm bất kỳ khoản tiền nào.</li>
	<li><strong>Quý 1/2029:</strong> Nhận bàn giao căn hộ nộp 45% (Lũy kế 95%).</li>
	<li><strong>Quý 3/2029:</strong> Nhận Giấy chứng nhận quyền sở hữu nộp nốt 5% cuối cùng.</li>
</ul>

<h2 id="phuong-an-3" style="color:#0F172A;font-size:24px;font-weight:800;margin-top:32px;">5. Phương Án 3: Tiến Độ Thanh Toán Siêu Giãn Quỹ Lalakey (Kéo Dài Đến Tận Năm 2032)</h2>
<p>Đây được xem là chính sách "vô tiền khoáng hậu" trên thị trường bất động sản thủ đô hiện nay. Khách hàng được <strong>nhận nhà vào ở hoặc khai thác cho thuê ngay từ Quý 1/2029 khi mới chỉ thanh toán 55% giá trị căn hộ</strong>, 45% còn lại tiếp tục trả chậm không lãi suất trong hơn 3 năm tiếp theo:</p>

<div style="text-align:center;margin:24px 0;">
	<img src="{$img_super}" alt="Tiến độ thanh toán siêu giãn quỹ Lalakey dự án Lalalay Residences" style="width:100%;max-width:960px;border-radius:10px;border:1px solid #E2E8F0;box-shadow:0 6px 20px rgba(0,0,0,0.06);" />
	<p style="font-size:13px;color:#64748B;font-style:italic;margin-top:6px;">Phương án thanh toán siêu giãn Quỹ Lalakey kéo dài 6 năm (2027 - 2032)</p>
</div>

<ul>
	<li><strong>Năm 2027 (Lũy kế 26%):</strong> Chia làm 6 đợt thanh toán (Đặt cọc 50tr + 5 đợt x 5%).</li>
	<li><strong>Năm 2028 (Lũy kế 18%):</strong> Chia làm 6 đợt, mỗi đợt chỉ <strong>3%/đợt</strong> trong khoảng thời gian 17 tháng.</li>
	<li><strong>Năm 2029 (Bàn giao nhà - Lũy kế 17%):</strong> Tại thời điểm <strong>Nhận bàn giao nhà Quý 1/2029</strong>, khách hàng <strong>chỉ phải đóng 5%</strong>! Lũy kế toàn bộ số tiền đã đóng khi nhận chìa khóa trao tay chỉ vỏn vẹn <strong>55%</strong>.</li>
	<li><strong>Năm 2030 (Lũy kế 12%):</strong> Khi đã nhận nhà ở hoặc cho thuê sinh dòng tiền, khách hàng chia làm 6 đợt thanh toán, mỗi đợt chỉ <strong>2%</strong>.</li>
	<li><strong>Năm 2031 (Lũy kế 12%):</strong> Tiếp tục 6 đợt thanh toán, mỗi đợt chỉ 2%.</li>
	<li><strong>Năm 2032 (Lũy kế 15%):</strong> Hoàn tất các đợt còn lại và thanh toán 5% cuối cùng khi nhận sổ hồng vào Tháng 11/2032.</li>
</ul>

<h2 id="loi-khuyen-tai-chinh" style="color:#0F172A;font-size:24px;font-weight:800;margin-top:32px;">6. Lời Khuyên Tài Chính: Bạn Nên Chọn Phương Án Nào?</h2>
<ul>
	<li><strong>Gia đình trẻ mua ở lần đầu:</strong> Nên chọn <em>Quỹ Thường + Gói vay ngân hàng 70% được HTLS 0% trong 24 tháng</em>. Vốn tự có ban đầu chỉ cần 30% đóng rải rác trong năm 2027, 2 năm tiếp theo hoàn toàn không phải trả gốc và lãi.</li>
	<li><strong>Khách hàng có sẵn dòng tiền nhàn rỗi:</strong> Nên chọn <em>Quỹ Thường thanh toán nhanh nhận chiết khấu 7%</em> cộng dồn với các chiết khấu booking (-1.5%) và không nhận bảo lãnh (-1.8%) để tiết kiệm hàng trăm triệu đồng ngay khi ký hợp đồng.</li>
	<li><strong>Nhà đầu tư cho thuê &amp; tích sản:</strong> Lựa chọn số 1 chắc chắn là <em>Quỹ Lalakey Siêu Giãn</em>. Khách hàng nhận nhà Quý 1/2029 khi mới đóng 55%, lập tức đưa vào vận hành cho thuê đạt tỷ suất lợi nhuận cao, dùng chính dòng tiền cho thuê để bù đắp khoản thanh toán 2%/đợt mỗi 2 tháng mà không phải chịu áp lực trả nợ ngân hàng.</li>
</ul>

<p>Để nhận bảng tính dòng tiền chi tiết cho từng mã căn hộ Studio, 1PN, 2PN, 3PN tại dự án <a href="https://kenhbatdongsan.vn/du-an/lalalay-residences/" style="font-weight:700;color:#D94A1E;">Lalalay Residences</a>, quý khách vui lòng điền thông tin bên dưới:</p>

[kbds_lead_form_cao_tang]
EOT;

$post_data = [
    'post_title'   => $sat_title,
    'post_content' => $sat_content,
    'post_excerpt' => $sat_excerpt,
    'post_status'  => 'publish',
    'post_type'    => 'post',
    'post_name'    => $sat_slug,
];

if ($existing_sat) {
    $post_data['ID'] = $existing_sat->ID;
    wp_update_post($post_data);
    $sat_id = $existing_sat->ID;
    echo "✔ Cập nhật bài viết vệ tinh ID {$sat_id}\n";
} else {
    $sat_id = wp_insert_post($post_data);
    echo "✔ Tạo mới bài viết vệ tinh ID {$sat_id}\n";
}

// Gắn thumbnail là ảnh chính sách bán hàng dự kiến (ID 407)
if (!empty($media_map['chinh-sach-ban-hang-du-kien-lalalay-residences.jpg']['id'])) {
    set_post_thumbnail($sat_id, $media_map['chinh-sach-ban-hang-du-kien-lalalay-residences.jpg']['id']);
}

// Gắn meta dự án liên kết & Rank Math SEO
update_post_meta($sat_id, '_kbds_project_ref', 170);
update_post_meta($sat_id, 'rank_math_focus_keyword', 'chính sách bán hàng Lalalay Residences, tiến độ thanh toán Lalalay Residences, Quỹ Lalakey, Quỹ Thường Lalalay');
update_post_meta($sat_id, 'rank_math_title', 'Chính Sách Bán Hàng & Tiến Độ Thanh Toán Lalalay Residences 2026');
update_post_meta($sat_id, 'rank_math_description', 'Chi tiết chính sách bán hàng và 3 phương án tiến độ thanh toán Lalalay Residences: Miễn phí dịch vụ 2 năm, chiết khấu tới 7%, vay 0% lãi suất 24 tháng hoặc giãn tiến độ đến 2032.');

// Gắn chuyên mục Tin tức thị trường / Bất động sản
$cat = get_category_by_slug('tin-tuc-thi-truong');
if ($cat) {
    wp_set_post_categories($sat_id, [$cat->term_id]);
}

echo "✔ Đã gắn Thumbnail, Meta _kbds_project_ref và Rank Math SEO cho bài viết ID {$sat_id}\n";
echo "==============================================================\n";
echo "🎉 HOÀN TẤT CẬP NHẬT THÀNH CÔNG!\n";
echo "==============================================================\n";
