<?php
/**
 * Tạo trọn gói Trang Dự Án The Win City (Đức Hòa - Long An) + 5 Bài viết vệ tinh chuẩn SEO Topic Cluster
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU XÂY DỰNG TRANG DỰ ÁN THE WIN CITY (ĐỨC HÒA - LONG AN)\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/the-win-city-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/the-win-city-media-map.json. Hãy chạy tools/import-the-win-city.php trước!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// 1. Tạo Term Chủ đầu tư & Khu vực nếu chưa có
if (!term_exists('Thắng Lợi Group', 'chu_dau_tu')) {
    wp_insert_term('Thắng Lợi Group', 'chu_dau_tu', [
        'slug' => 'thang-loi-group',
        'description' => 'Tập đoàn Thắng Lợi (Thắng Lợi Homes) - Nhà phát triển bất động sản uy tín hàng đầu khu Tây Sài Gòn & Long An'
    ]);
    echo " + Đã tạo term Chủ đầu tư: Thắng Lợi Group\n";
}
if (!term_exists('Gỗ An Cường', 'chu_dau_tu')) {
    wp_insert_term('Gỗ An Cường', 'chu_dau_tu', [
        'slug' => 'go-an-cuong',
        'description' => 'Công ty Cổ phần Gỗ An Cường - Thương hiệu giải pháp gỗ và vật liệu nội thất số 1 Việt Nam'
    ]);
    echo " + Đã tạo term Chủ đầu tư: Gỗ An Cường\n";
}
if (!term_exists('Central Construction', 'chu_dau_tu')) {
    wp_insert_term('Central Construction', 'chu_dau_tu', [
        'slug' => 'central-construction',
        'description' => 'Công ty Cổ phần Xây dựng Central - Tổng thầu xây dựng hàng đầu Việt Nam'
    ]);
    echo " + Đã tạo term Chủ đầu tư: Central Construction\n";
}
if (!term_exists('Long An', 'khu_vuc_bds')) {
    wp_insert_term('Long An', 'khu_vuc_bds', [
        'slug' => 'long-an',
        'description' => 'Thị trường Bất Động Sản tỉnh Long An - Đô thị vệ tinh giáp ranh TP.HCM'
    ]);
    echo " + Đã tạo term Khu vực: Long An\n";
}

// 2. SOẠN THẢO NỘI DUNG LANDING PAGE 10 SECTION CHUẨN UX CHO THE WIN CITY
$landing_html = <<<HTML
<!-- SUBNAV ĐIỀU HƯỚNG DỰ ÁN THE WIN CITY -->
<div class="kbds-project-subnav" style="position:sticky;top:0;z-index:99;background:#0F172A;box-shadow:0 4px 20px rgba(0,0,0,0.15);border-bottom:1px solid #1E293B;">
  <div class="kbds-container" style="display:flex;align-items:center;justify-content:space-between;padding:12px 20px;overflow-x:auto;white-space:nowrap;gap:12px;">
    <div style="font-weight:800;font-size:16px;color:#F8FAFC;display:flex;align-items:center;gap:8px;">
      <span style="display:inline-block;width:10px;height:10px;background:#D97706;border-radius:50%;box-shadow:0 0 10px #D97706;"></span>
      THE WIN CITY
    </div>
    <div style="display:flex;gap:18px;font-size:13.5px;font-weight:600;">
      <a href="#tong-quan" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Tổng Quan</a>
      <a href="#vi-tri" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Vị Trí Mặt Tiền</a>
      <a href="#phan-khu" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">3 Phân Khu</a>
      <a href="#tien-ich" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Tiện Ích 5.500m²</a>
      <a href="#mat-bang" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Mặt Bằng VIC 1.2</a>
      <a href="#can-ho-mau" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Căn Hộ Mẫu An Cường</a>
      <a href="#bang-gia" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Bảng Giá & CSBH</a>
      <a href="#tien-do" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Tiến Độ Thi Công</a>
      <a href="#tin-tuc-du-an" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Tin Tức Đánh Giá</a>
    </div>
    <a href="#dang-ky" style="background:linear-gradient(135deg,#D97706,#B45309);color:#fff;padding:8px 18px;border-radius:24px;font-size:12.5px;font-weight:700;text-decoration:none;box-shadow:0 4px 12px rgba(217,119,6,0.35);">Nhận Báo Giá Gốc</a>
  </div>
</div>

<!-- SECTION 1: HERO BANNER -->
<section style="position:relative;background:linear-gradient(135deg,#071526 0%,#0F2B48 50%,#B45309 100%);color:#fff;padding:80px 0 100px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.22;background:radial-gradient(circle at 75% 25%,#F59E0B 0%,transparent 60%);pointer-events:none;"></div>
  <div class="kbds-container" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:40px;align-items:center;">
    <div>
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(245,158,11,0.2);border:1px solid rgba(245,158,11,0.45);color:#FDE68A;padding:6px 16px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;">
        🏆 LIÊN DANH THẮNG LỢI GROUP • GỖ AN CƯỜNG • CENTRAL
      </div>
      <h1 style="color:#FFFFFF;font-size:40px;font-weight:900;line-height:1.2;margin:0 0 18px;">
        THE WIN CITY
        <span style="display:block;font-size:22px;font-weight:600;color:#F59E0B;margin-top:6px;">Khu Đô Thị Cao Tầng Phức Hợp 13,18 Ha Giáp Ranh Phía Tây TP.HCM</span>
      </h1>
      <p style="color:#E2E8F0;font-size:16px;line-height:1.7;margin:0 0 28px;max-width:620px;">
        Tọa lạc đắc địa tại mặt tiền <strong>Tỉnh Lộ 10 (ĐT825 / trục Trần Văn Giàu)</strong>, xã Đức Hòa, Long An. <strong>The Win City</strong> (Khu đô thị Bình An Đức Hòa) là quần thể căn hộ hiện đại quy mô gần 6.000 sản phẩm, tháp biểu tượng <strong>Win Mark 42 tầng</strong>, bàn giao hoàn thiện nội thất An Cường cao cấp và mức giá sơ cấp đột phá chỉ từ <strong>30,5 triệu/m² (khoảng 1,4 tỷ/căn)</strong>.
      </p>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:30px;">
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#F59E0B;">13,18 ha</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">18 Block Tháp Hiện Đại</div>
        </div>
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#38BDF8;">Từ 30,5 Tr/m²</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Căn hộ từ ~1,4 tỷ đồng</div>
        </div>
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#4ADE80;">Sổ Hồng</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Sở hữu lâu dài</div>
        </div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:#D97706;color:#fff;font-weight:700;padding:14px 28px;border-radius:8px;text-decoration:none;box-shadow:0 6px 20px rgba(217,119,6,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Nhận Bảng Giá Đợt 1 & Chính Sách Gốc</span> →
        </a>
        <a href="#mat-bang" style="background:transparent;color:#fff;font-weight:600;padding:14px 24px;border-radius:8px;text-decoration:none;border:1px solid rgba(255,255,255,0.3);">
          Xem Mặt Bằng Tháp VIC 1.2
        </a>
      </div>
    </div>
    <div style="position:relative;">
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.45);border:2px solid rgba(255,255,255,0.15);">
        <img src="{$m['tong_the_hoang_hon']['url']}" alt="{$m['tong_the_hoang_hon']['alt']}" style="width:100%;height:400px;object-fit:cover;display:block;" />
      </div>
      <div style="position:absolute;bottom:-18px;left:20px;right:20px;background:rgba(15,23,42,0.92);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.15);padding:14px 20px;border-radius:12px;color:#fff;display:flex;align-items:center;justify-content:space-between;">
        <div>
          <span style="font-size:11.5px;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Toàn cảnh hoàng hôn</span>
          <div style="font-size:15px;font-weight:700;color:#F59E0B;">Đại Đô Thị The Win City 13,18ha</div>
        </div>
        <span style="background:#16A34A;color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:12px;">Đã Cất Nóc Tháp 1</span>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: BẢNG TỔNG QUAN HỒ SƠ DỰ ÁN -->
<section id="tong-quan" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="background:#FEF3C7;color:#D97706;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Hồ sơ chính thức</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 10px;">TỔNG QUAN DỰ ÁN THE WIN CITY</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Khu đô thị căn hộ phức hợp hiện đại chuẩn mực bậc nhất cửa ngõ phía Tây TP.HCM</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:16px;padding:32px;">
      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tên thương mại:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:15px;">THE WIN CITY</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tên pháp lý:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Khu đô thị Bình An Đức Hòa</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Vị trí dự án:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Mặt tiền Tỉnh Lộ 10 (ĐT825 / trục Trần Văn Giàu), xã Đức Hòa Hạ, Đức Hòa, Long An (giáp Bình Chánh)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Liên danh phát triển:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:14.5px;">Thắng Lợi Group (Thắng Lợi Homes) • Gỗ An Cường • Central Construction</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tổng thầu xây dựng:</span>
          <span style="flex:1;font-weight:700;color:#D97706;font-size:14.5px;">Central Construction (Tổng thầu top 1 Việt Nam)</span>
        </div>
        <div style="display:flex;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Đối tác nội thất:</span>
          <span style="flex:1;font-weight:700;color:#16A34A;font-size:14.5px;">Gỗ An Cường (Cung ứng toàn bộ giải pháp gỗ cao cấp)</span>
        </div>
      </div>

      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Quy mô dự án:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Khoảng 13,18 ha gồm 18 block cao từ 24 - 33 tầng (và tháp Win Mark 42 tầng)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">3 Phân khu lớn:</span>
          <span style="flex:1;font-weight:700;color:#D97706;font-size:14.5px;">Victory Heights • Glory Sky • Prime Majestic</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tổng số sản phẩm:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:14.5px;">Gần 6.000 căn hộ (Studio, 1PN, 1PN+, 2PN, 3PN & Shophouse)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Diện tích căn hộ:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Từ 34,5 m² – 88,3 m² (tối ưu hóa diện tích thông thủy)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Mức giá tham khảo:</span>
          <span style="flex:1;font-weight:700;color:#DC2626;font-size:14.5px;">Từ 30,5 – 33 triệu/m² (Căn hộ từ ~1,4 tỷ đồng)</span>
        </div>
        <div style="display:flex;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Hình thức sở hữu:</span>
          <span style="flex:1;font-weight:700;color:#16A34A;font-size:14.5px;">Sở hữu lâu dài (Sổ hồng từng căn hộ)</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VỊ TRÍ ĐẮC ĐỊA MẶT TIỀN TỈNH LỘ 10 -->
<section id="vi-tri" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;">
      <div>
        <span style="background:#FEF3C7;color:#D97706;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Tâm điểm kết nối phía Tây</span>
        <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 16px;">VỊ TRÍ KIM CƯƠNG MẶT TIỀN TRẦN VĂN GIÀU</h2>
        <p style="color:#475569;font-size:15px;line-height:1.7;margin:0 0 16px;">
          <strong>The Win City</strong> sở hữu vị trí vàng ngay mặt tiền tuyến giao thương huyết mạch <strong>Tỉnh Lộ 10 (ĐT825 / trục đại lộ Trần Văn Giàu)</strong> thuộc huyện Đức Hòa, tỉnh Long An – khu vực tiếp giáp trực tiếp ranh giới huyện Bình Chánh, TP.HCM.
        </p>
        <p style="color:#475569;font-size:15px;line-height:1.7;margin:0 0 24px;">
          Nhờ trục kết nối thẳng tắp này, cư dân The Win City dễ dàng di chuyển về trung tâm TP.HCM, Quận Bình Tân, Quận 6, Quận 5 và đại lộ Võ Văn Kiệt chỉ mất từ <strong>20 - 30 phút lái xe</strong>, hoàn toàn không bị ùn tắc hay ngăn cách địa lý.
        </p>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
          <div style="background:#fff;border:1px solid #E2E8F0;padding:14px 18px;border-radius:10px;border-left:4px solid #D97706;">
            <div style="font-weight:700;color:#0F172A;font-size:14px;">5 - 10 Phút</div>
            <div style="color:#64748B;font-size:13px;margin-top:2px;">KCN Tân Đức, Tân Đô, Hải Sơn, ĐH Tân Tạo, Bệnh viện Xuyên Á</div>
          </div>
          <div style="background:#fff;border:1px solid #E2E8F0;padding:14px 18px;border-radius:10px;border-left:4px solid #16A34A;">
            <div style="font-weight:700;color:#0F172A;font-size:14px;">15 - 20 Phút</div>
            <div style="color:#64748B;font-size:13px;margin-top:2px;">Aeon Mall Bình Tân, Bến xe Miền Tây, Bệnh viện Triều An</div>
          </div>
          <div style="background:#fff;border:1px solid #E2E8F0;padding:14px 18px;border-radius:10px;border-left:4px solid #0284C7;">
            <div style="font-weight:700;color:#0F172A;font-size:14px;">25 - 30 Phút</div>
            <div style="color:#64748B;font-size:13px;margin-top:2px;">Trung tâm Quận 1, Chợ Bến Thành thông qua đại lộ Võ Văn Kiệt</div>
          </div>
          <div style="background:#fff;border:1px solid #E2E8F0;padding:14px 18px;border-radius:10px;border-left:4px solid #7C3AED;">
            <div style="font-weight:700;color:#0F172A;font-size:14px;">Hạ Tầng Tương Lai</div>
            <div style="color:#64748B;font-size:13px;margin-top:2px;">Đón đầu Vành Đai 3, Vành Đai 4 và Metro số 3A kéo dài</div>
          </div>
        </div>
      </div>

      <div style="border-radius:16px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.1);border:1px solid #E2E8F0;">
        <img src="{$m['quy_hoach_3_phan_khu']['url']}" alt="{$m['quy_hoach_3_phan_khu']['alt']}" style="width:100%;height:auto;display:block;" />
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: QUY HOẠCH 3 PHÂN KHU LỚN -->
<section id="phan-khu" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="background:#FEF3C7;color:#D97706;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Kiến trúc đỉnh cao</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 10px;">QUY HOẠCH 3 PHÂN KHU ĐÔ THỊ THE WIN CITY</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">18 Block tháp được phân bổ khoa học thành 3 phong cách sống riêng biệt, tối ưu tầm nhìn và đối lưu gió</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
      <!-- Phân khu 1: Victory Heights -->
      <div style="background:#FFFDF7;border:1px solid #FDE68A;border-radius:14px;padding:26px;box-shadow:0 4px 12px rgba(217,119,6,0.06);display:flex;flex-direction:column;justify-content:space-between;">
        <div>
          <div style="display:inline-block;background:#D97706;color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:6px;text-transform:uppercase;margin-bottom:12px;">Đang Mở Bán Đợt 1</div>
          <h3 style="color:#0F172A;font-size:20px;font-weight:800;margin:0 0 10px;">VICTORY HEIGHTS</h3>
          <p style="color:#475569;font-size:14px;line-height:1.6;margin:0 0 16px;">
            Phân khu tiên phong mở màn cho đại đô thị The Win City. Sở hữu <strong>Tháp Hoàng Hậu Victory Hermes</strong> và các block VIC 1.1, VIC 1.2, VIC 1.3 đối diện Đại lộ Champion và công viên Victory Central.
          </p>
          <ul style="color:#64748B;font-size:13px;line-height:1.8;padding-left:18px;margin:0 0 16px;">
            <li>Sản phẩm: Studio, 1PN, 1PN+, 2PN, 3PN (34,5 – 88,3 m²)</li>
            <li>Đặc quyền: Ôm trọn công viên Victory Central 5.500m²</li>
            <li>Tiến độ: Đã cất nóc tháp đầu tiên vượt tiến độ</li>
          </ul>
        </div>
        <a href="#mat-bang" style="color:#D97706;font-weight:700;font-size:13.5px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
          Xem Chi Tiết Victory Heights →
        </a>
      </div>

      <!-- Phân khu 2: Glory Sky -->
      <div style="background:#F0F9FF;border:1px solid #BAE6FD;border-radius:14px;padding:26px;box-shadow:0 4px 12px rgba(2,132,199,0.06);display:flex;flex-direction:column;justify-content:space-between;">
        <div>
          <div style="display:inline-block;background:#0284C7;color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:6px;text-transform:uppercase;margin-bottom:12px;">Giai Đoạn Kế Tiếp</div>
          <h3 style="color:#0F172A;font-size:20px;font-weight:800;margin:0 0 10px;">GLORY SKY</h3>
          <p style="color:#475569;font-size:14px;line-height:1.6;margin:0 0 16px;">
            Phân khu căn hộ trung tâm với tầm view khoáng đạt về phía chân trời Sài Gòn. Tích hợp chuỗi tiện ích chăm sóc sức khỏe, vườn treo Sky Garden và hồ bơi tầng cao thư giãn.
          </p>
          <ul style="color:#64748B;font-size:13px;line-height:1.8;padding-left:18px;margin:0 0 16px;">
            <li>Phong cách sống chuẩn xanh bền vững cho gia đình</li>
            <li>Kết nối trực tiếp trục Kênh cảnh quan Bà Cốt Bi</li>
            <li>Khu vui chơi trẻ em Kid Zone và sảnh đón sang trọng</li>
          </ul>
        </div>
        <a href="#dang-ky" style="color:#0284C7;font-weight:700;font-size:13.5px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
          Đăng Ký Nhận Thông Tin Glory Sky →
        </a>
      </div>

      <!-- Phân khu 3: Prime Majestic -->
      <div style="background:#FAF5FF;border:1px solid #E9D5FF;border-radius:14px;padding:26px;box-shadow:0 4px 12px rgba(124,58,237,0.06);display:flex;flex-direction:column;justify-content:space-between;">
        <div>
          <div style="display:inline-block;background:#7C3AED;color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:6px;text-transform:uppercase;margin-bottom:12px;">Biểu Tượng Đỉnh Cao</div>
          <h3 style="color:#0F172A;font-size:20px;font-weight:800;margin:0 0 10px;">PRIME MAJESTIC</h3>
          <p style="color:#475569;font-size:14px;line-height:1.6;margin:0 0 16px;">
            Phân khu thương mại - tài chính biểu tượng với tòa tháp <strong>Win Mark cao 42 tầng</strong> sừng sững tại mặt tiền Trần Văn Giàu, quy tụ khách sạn 5 sao, trung tâm thương mại và văn phòng hạng A.
          </p>
          <ul style="color:#64748B;font-size:13px;line-height:1.8;padding-left:18px;margin:0 0 16px;">
            <li>Tháp Win Mark 42 tầng biểu tượng mới của Long An</li>
            <li>Hệ thống Shophouse và phố mua sắm sầm uất 24/7</li>
            <li>Giá trị gia tăng và tính thương mại số 1 toàn khu</li>
          </ul>
        </div>
        <a href="#dang-ky" style="color:#7C3AED;font-weight:700;font-size:13.5px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
          Đăng Ký Tư Vấn Shophouse →
        </a>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: HỆ THỐNG TIỆN ÍCH ALL-IN-ONE -->
<section id="tien-ich" style="padding:70px 0;background:#0F172A;color:#fff;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="background:rgba(217,119,6,0.2);border:1px solid rgba(217,119,6,0.4);color:#FDE68A;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Hệ sinh thái All-In-One</span>
      <h2 style="color:#FFFFFF;font-size:32px;font-weight:800;margin:0 0 10px;">ĐẶC QUYỀN TIỆN ÍCH ĐẠI ĐÔ THỊ THE WIN CITY</h2>
      <p style="color:#94A3B8;font-size:15px;margin:0;">Mọi nhu cầu sống, học tập, rèn luyện thể thao và giải trí của cư dân đều được đáp ứng trọn vẹn ngay trong khuôn viên 13,18ha</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:36px;">
      <div style="border-radius:12px;overflow:hidden;background:#1E293B;border:1px solid #334155;">
        <img src="{$m['vuon_hoa_noi_khu']['url']}" alt="{$m['vuon_hoa_noi_khu']['alt']}" style="width:100%;height:180px;object-fit:cover;display:block;" />
        <div style="padding:16px;">
          <h4 style="color:#F59E0B;font-size:15px;font-weight:700;margin:0 0 6px;">Công Viên Victory Central</h4>
          <p style="color:#94A3B8;font-size:12.5px;line-height:1.5;margin:0;">Quy mô 5.500m² với vườn hoa rực rỡ, đường dạo bộ và thảm cỏ dã ngoại picnic.</p>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;background:#1E293B;border:1px solid #334155;">
        <img src="{$m['pho_shophouse']['url']}" alt="{$m['pho_shophouse']['alt']}" style="width:100%;height:180px;object-fit:cover;display:block;" />
        <div style="padding:16px;">
          <h4 style="color:#F59E0B;font-size:15px;font-weight:700;margin:0 0 6px;">Phố Mua Sắm Shophouse</h4>
          <p style="color:#94A3B8;font-size:12.5px;line-height:1.5;margin:0;">Tuyến shophouse khối đế sầm uất với chuỗi siêu thị, cafe, nhà hàng ẩm thực đa dạng.</p>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;background:#1E293B;border:1px solid #334155;">
        <img src="{$m['cong_vien_canh_quan']['url']}" alt="{$m['cong_vien_canh_quan']['alt']}" style="width:100%;height:180px;object-fit:cover;display:block;" />
        <div style="padding:16px;">
          <h4 style="color:#F59E0B;font-size:15px;font-weight:700;margin:0 0 6px;">Quảng Trường Thể Thao</h4>
          <p style="color:#94A3B8;font-size:12.5px;line-height:1.5;margin:0;">Sân chơi đa năng Active Zone, đường chạy bộ ven kênh và sân tập thể thao ngoài trời.</p>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;background:#1E293B;border:1px solid #334155;">
        <img src="{$m['ban_cong_sky_garden']['url']}" alt="{$m['ban_cong_sky_garden']['alt']}" style="width:100%;height:180px;object-fit:cover;display:block;" />
        <div style="padding:16px;">
          <h4 style="color:#F59E0B;font-size:15px;font-weight:700;margin:0 0 6px;">Sky Garden Ban Công Xanh</h4>
          <p style="color:#94A3B8;font-size:12.5px;line-height:1.5;margin:0;">Vườn trên cao thư thái, không gian ngắm bình minh và hoàng hôn thi vị cho cư dân.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: MẶT BẰNG ĐIỂN HÌNH THÁP VIC 1.2 -->
<section id="mat-bang" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:760px;margin:0 auto 36px;">
      <span style="background:#FEF3C7;color:#D97706;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Chi tiết thiết kế tầng</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 10px;">MẶT BẰNG ĐIỂN HÌNH THÁP VIC 1.2 (TẦNG 05 - 22)</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Thuộc phân khu Victory Heights – Thiết kế thông minh với 22 căn hộ/tầng đón trọn ánh sáng và gió trời tự nhiên</p>
    </div>

    <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:16px;padding:24px;margin-bottom:30px;box-shadow:0 8px 24px rgba(0,0,0,0.05);">
      <div style="text-align:center;margin-bottom:20px;">
        <img src="{$m['mat_bang_vic12']['url']}" alt="{$m['mat_bang_vic12']['alt']}" style="max-width:100%;height:auto;border-radius:8px;display:inline-block;" />
      </div>

      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;padding-top:20px;border-top:1px solid #E2E8F0;">
        <div style="background:#fff;border:1px solid #E2E8F0;padding:14px;border-radius:10px;text-align:center;">
          <div style="font-weight:800;color:#0F172A;font-size:16px;">Căn 1 Phòng Ngủ (1PN)</div>
          <div style="color:#D97706;font-weight:700;font-size:13.5px;margin:4px 0;">34,5 – 40,8 m²</div>
          <div style="color:#64748B;font-size:12px;">Mã căn A-13 (DT tim tường 40,8m² / thông thủy 37,1m²)</div>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;padding:14px;border-radius:10px;text-align:center;">
          <div style="font-weight:800;color:#0F172A;font-size:16px;">Căn 1PN+1 (Đa Năng)</div>
          <div style="color:#D97706;font-weight:700;font-size:13.5px;margin:4px 0;">44,3 – 48,5 m²</div>
          <div style="color:#64748B;font-size:12px;">Mã căn A-12 (DT tim tường 44,3m² / thông thủy 40,1m²)</div>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;padding:14px;border-radius:10px;text-align:center;">
          <div style="font-weight:800;color:#0F172A;font-size:16px;">Căn 2PN - 1WC</div>
          <div style="color:#D97706;font-weight:700;font-size:13.5px;margin:4px 0;">50,2 m²</div>
          <div style="color:#64748B;font-size:12px;">Mã căn A-08 đến A-11, A-14, A-17 đến A-22 (Thông thủy 46m²)</div>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;padding:14px;border-radius:10px;text-align:center;">
          <div style="font-weight:800;color:#0F172A;font-size:16px;">Căn 2PN - 2WC (Góc)</div>
          <div style="color:#D97706;font-weight:700;font-size:13.5px;margin:4px 0;">64,3 – 70,8 m²</div>
          <div style="color:#64748B;font-size:12px;">Mã căn A-01 đến A-07, A-15, A-16 (View góc thoáng 2 mặt)</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: CĂN HỘ MẪU & VẬT LIỆU BÀN GIAO GỖ AN CƯỜNG -->
<section id="can-ho-mau" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="background:#E0F2FE;color:#0284C7;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Chuẩn mực hoàn thiện</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 10px;">TRẢI NGHIỆM CĂN HỘ MẪU THE WIN CITY</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Toàn bộ nội thất gỗ liền tường và tủ bếp do thương hiệu danh tiếng Gỗ An Cường bảo chứng chất lượng</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:30px;">
      <div style="border-radius:12px;overflow:hidden;background:#fff;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <img src="{$m['phong_khach_mau_1']['url']}" alt="{$m['phong_khach_mau_1']['alt']}" style="width:100%;height:240px;object-fit:cover;display:block;" />
        <div style="padding:16px;">
          <h4 style="color:#0F172A;font-size:15px;font-weight:700;margin:0 0 4px;">Phòng Khách View Ban Công</h4>
          <p style="color:#64748B;font-size:13px;line-height:1.5;margin:0;">Cửa kính kịch trần đón trọn ánh sáng tự nhiên và gió mát từ công viên nội khu.</p>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;background:#fff;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <img src="{$m['phong_ngu_master']['url']}" alt="{$m['phong_ngu_master']['alt']}" style="width:100%;height:240px;object-fit:cover;display:block;" />
        <div style="padding:16px;">
          <h4 style="color:#0F172A;font-size:15px;font-weight:700;margin:0 0 4px;">Phòng Ngủ Master An Cường</h4>
          <p style="color:#64748B;font-size:13px;line-height:1.5;margin:0;">Tủ quần áo và bàn trang điểm gỗ công nghiệp cao cấp, bề mặt phủ Melamine sang trọng.</p>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;background:#fff;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <img src="{$m['khu_bep_an_cuong']['url']}" alt="{$m['khu_bep_an_cuong']['alt']}" style="width:100%;height:240px;object-fit:cover;display:block;" />
        <div style="padding:16px;">
          <h4 style="color:#0F172A;font-size:15px;font-weight:700;margin:0 0 4px;">Khu Bếp Hiện Đại Tiện Nghi</h4>
          <p style="color:#64748B;font-size:13px;line-height:1.5;margin:0;">Hệ tủ bếp trên & dưới An Cường chống ẩm, phụ kiện giảm chấn êm ái tiện dụng.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 8: BẢNG GIÁ & CHÍNH SÁCH BÁN HÀNG ĐỢT 1 -->
<section id="bang-gia" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="background:#DCFCE7;color:#16A34A;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Cơ hội an cư & đầu tư</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 10px;">BẢNG GIÁ & CHÍNH SÁCH BÁN HÀNG THE WIN CITY</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Mức giá sơ cấp cạnh tranh số 1 thị trường giáp ranh TP.HCM cùng phương thức thanh toán giãn nhẹ nhàng</p>
    </div>

    <div style="overflow-x:auto;margin-bottom:30px;">
      <table style="width:100%;border-collapse:collapse;font-size:14.5px;color:#1E293B;background:#fff;box-shadow:0 4px 16px rgba(0,0,0,0.06);border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;">
        <thead>
          <tr style="background:#0F172A;color:#fff;text-align:left;">
            <th style="padding:16px 20px;">Loại Hình Căn Hộ</th>
            <th style="padding:16px 20px;">Diện Tích Tim Tường</th>
            <th style="padding:16px 20px;">Diện Tích Thông Thủy</th>
            <th style="padding:16px 20px;">Giá Bán Dự Kiến (VAT)</th>
            <th style="padding:16px 20px;">Hỗ Trợ Vay Ngân Hàng</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:14px 20px;font-weight:700;color:#0F172A;">Căn Hộ Studio</td>
            <td style="padding:14px 20px;">34,5 m²</td>
            <td style="padding:14px 20px;">31,2 m²</td>
            <td style="padding:14px 20px;font-weight:700;color:#D97706;">Từ 1,05 – 1,15 Tỷ</td>
            <td style="padding:14px 20px;">Vay 70% (Chỉ cần 300 triệu)</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;">
            <td style="padding:14px 20px;font-weight:700;color:#0F172A;">Căn Hộ 1 Phòng Ngủ</td>
            <td style="padding:14px 20px;">40,8 m²</td>
            <td style="padding:14px 20px;">37,1 m²</td>
            <td style="padding:14px 20px;font-weight:700;color:#D97706;">Từ 1,35 – 1,45 Tỷ</td>
            <td style="padding:14px 20px;">Vay 70% (Chỉ cần 400 triệu)</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:14px 20px;font-weight:700;color:#0F172A;">Căn Hộ 1PN+1 (Đa Năng)</td>
            <td style="padding:14px 20px;">44,3 – 48,5 m²</td>
            <td style="padding:14px 20px;">40,1 – 44,5 m²</td>
            <td style="padding:14px 20px;font-weight:700;color:#D97706;">Từ 1,48 – 1,60 Tỷ</td>
            <td style="padding:14px 20px;">Vay 70% (Chỉ cần 450 triệu)</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;">
            <td style="padding:14px 20px;font-weight:700;color:#0F172A;">Căn Hộ 2 Phòng Ngủ - 1WC</td>
            <td style="padding:14px 20px;">50,2 m²</td>
            <td style="padding:14px 20px;">46,0 m²</td>
            <td style="padding:14px 20px;font-weight:700;color:#D97706;">Từ 1,65 – 1,75 Tỷ</td>
            <td style="padding:14px 20px;">Vay 70% (Chỉ cần 500 triệu)</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:14px 20px;font-weight:700;color:#0F172A;">Căn Hộ 2 Phòng Ngủ - 2WC (Góc)</td>
            <td style="padding:14px 20px;">64,3 – 70,8 m²</td>
            <td style="padding:14px 20px;">59,0 – 65,0 m²</td>
            <td style="padding:14px 20px;font-weight:700;color:#D97706;">Từ 2,10 – 2,35 Tỷ</td>
            <td style="padding:14px 20px;">Vay 70% (Chỉ cần 650 triệu)</td>
          </tr>
          <tr>
            <td style="padding:14px 20px;font-weight:700;color:#0F172A;">Căn Hộ 3 Phòng Ngủ (VIP)</td>
            <td style="padding:14px 20px;">80,0 – 88,3 m²</td>
            <td style="padding:14px 20px;">74,0 – 82,0 m²</td>
            <td style="padding:14px 20px;font-weight:700;color:#D97706;">Từ 2,65 – 2,90 Tỷ</td>
            <td style="padding:14px 20px;">Vay 70% (Chỉ cần 800 triệu)</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- BẢNG TÍNH LÃI VAY SHORTCODE -->
    <div style="margin-top:36px;">
      [kbds_loan_calculator]
    </div>
  </div>
</section>

<!-- SECTION 9: TIẾN ĐỘ THI CÔNG VƯỢT KẾ HOẠCH -->
<section id="tien-do" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;">
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.1);border:1px solid #E2E8F0;">
        <img src="{$m['tong_the_hoang_hon']['url']}" alt="{$m['tong_the_hoang_hon']['alt']}" style="width:100%;height:380px;object-fit:cover;display:block;" />
      </div>

      <div>
        <span style="background:#DCFCE7;color:#16A34A;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Bảo chứng uy tín Central</span>
        <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 16px;">TIẾN ĐỘ THI CÔNG THỰC TẾ NĂM 2026</h2>
        <p style="color:#475569;font-size:15px;line-height:1.7;margin:0 0 16px;">
          Khởi công chính thức từ cuối tháng 10/2025, với năng lực vượt trội của <strong>Tổng thầu xây dựng Central</strong>, đại công trường The Win City đang hoạt động liên tục 3 ca ngày đêm.
        </p>
        <div style="background:#fff;border:1px solid #E2E8F0;padding:18px;border-radius:12px;margin-bottom:18px;">
          <h4 style="color:#16A34A;font-size:16px;font-weight:700;margin:0 0 6px;">🎉 Cất nóc tháp đầu tiên vượt tiến độ 30 ngày (10/2026)</h4>
          <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0;">
            Phân khu Victory Heights đã hoàn thành toàn bộ khối móng hầm, đang tăng tốc hoàn thiện phần thân và đã chính thức cất nóc tòa tháp đầu tiên trước thời hạn cam kết, minh chứng cho uy tín và tiềm lực tài chính vững mạnh của liên danh chủ đầu tư.
          </p>
        </div>
        <p style="color:#475569;font-size:15px;line-height:1.7;margin:0;">
          Dự kiến bàn giao những căn hộ đầu tiên tới tay khách hàng vào giai đoạn <strong>Quý IV/2026 – Quý I/2027</strong>.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 10: TIN TỨC & BÀI VIẾT VỆ TINH DỰ ÁN (#tin-tuc-du-an) -->
[kbds_project_news limit="12"]

<!-- SECTION 11: FORM ĐĂNG KÝ TƯ VẤN & NHẬN BẢNG GIÁ GỐC -->
<section id="dang-ky" style="padding:70px 0;background:linear-gradient(135deg,#071526 0%,#0F2B48 100%);color:#fff;">
  <div class="kbds-container" style="max-width:800px;text-align:center;">
    <span style="background:rgba(217,119,6,0.25);border:1px solid rgba(217,119,6,0.5);color:#FDE68A;font-size:12px;font-weight:700;padding:5px 16px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:12px;">Ưu đãi độc quyền đợt 1</span>
    <h2 style="color:#FFFFFF;font-size:32px;font-weight:800;margin:0 0 12px;">ĐĂNG KÝ NHẬN BẢNG GIÁ & CHÍNH SÁCH THE WIN CITY</h2>
    <p style="color:#CBD5E1;font-size:15px;line-height:1.6;margin:0 0 30px;">
      Để lại thông tin chính xác bên dưới để chuyên viên Kênh Bất Động Sản gửi trọn bộ file thiết kế mặt bằng chi tiết 18 block, bảng giá giỏ hàng ngoại giao đợt 1 và lịch xem căn hộ mẫu miễn phí.
    </p>

    <div style="background:#FFFFFF;border-radius:16px;padding:32px;box-shadow:0 12px 32px rgba(0,0,0,0.3);text-align:left;color:#1E293B;">
      [kbds_lead_form project="The Win City Đức Hòa Long An"]
    </div>
  </div>
</section>
HTML;

// 3. TẠO HOẶC CẬP NHẬT POST DỰ ÁN (du_an)
$project_slug = 'the-win-city-long-an';
$existing_project = get_posts([
    'post_type'   => 'du_an',
    'name'        => $project_slug,
    'posts_per_page' => 1,
    'post_status' => 'any'
]);

$project_data = [
    'post_title'   => 'Khu Đô Thị The Win City Đức Hòa (Bình An Đức Hòa) - Long An',
    'post_name'    => $project_slug,
    'post_content' => $landing_html,
    'post_status'  => 'publish',
    'post_type'    => 'du_an',
    'post_excerpt' => 'The Win City (Khu đô thị Bình An Đức Hòa) quy mô 13,18ha gồm 18 block tháp gần 6.000 căn hộ mặt tiền Tỉnh Lộ 10 giáp ranh TP.HCM. Giá bán chỉ từ 30,5 triệu/m² (1,4 tỷ/căn), sổ hồng sở hữu lâu dài, liên danh Thắng Lợi Group, Gỗ An Cường và Central.',
];

if (!empty($existing_project)) {
    $project_id = $existing_project[0]->ID;
    $project_data['ID'] = $project_id;
    wp_update_post($project_data);
    echo " ✔ Đã cập nhật Dự án The Win City (ID: {$project_id})\n";
} else {
    $project_id = wp_insert_post($project_data);
    echo " + Đã tạo mới Dự án The Win City (ID: {$project_id})\n";
}

// Thiết lập Featured Image (Ảnh đại diện)
if (!empty($m['tong_the_hoang_hon']['id'])) {
    set_post_thumbnail($project_id, $m['tong_the_hoang_hon']['id']);
}

// Gán Taxonomies
wp_set_object_terms($project_id, 'Long An', 'khu_vuc_bds');
wp_set_object_terms($project_id, ['can-ho-chung-cu', 'khu-do-thi-biet-thu'], 'loai_hinh_bds');
wp_set_object_terms($project_id, 'dang-mo-ban', 'trang_thai_du_an');
wp_set_object_terms($project_id, ['thang-loi-group', 'go-an-cuong', 'central-construction'], 'chu_dau_tu');

// Cập nhật Meta fields chuẩn mô hình B
update_post_meta($project_id, '_kbds_project_code', 'DA-WINCITY');
update_post_meta($project_id, '_kbds_price_from', 'Từ 30,5 – 33 triệu/m² (Căn hộ từ ~1,4 tỷ đồng)');
update_post_meta($project_id, '_kbds_price_min_num', '30.5');
update_post_meta($project_id, '_kbds_address', 'Mặt tiền Tỉnh lộ 10 (ĐT825 / trục Trần Văn Giàu), xã Đức Hòa Hạ, Đức Hòa, Long An (giáp ranh Bình Chánh, TP.HCM)');
update_post_meta($project_id, '_kbds_total_area', '13,18 ha (Mật độ xây dựng ~35%)');
update_post_meta($project_id, '_kbds_scale', '18 block tháp cao từ 24 - 33 tầng (và tháp Win Mark 42 tầng), gần 6.000 sản phẩm (Studio, 1PN, 2PN, 3PN & Shophouse)');
update_post_meta($project_id, '_kbds_legal_status', 'Khu đô thị Bình An Đức Hòa - Quy hoạch 1/500, GPXD đầy đủ, Sổ hồng sở hữu lâu dài (người Việt Nam)');
update_post_meta($project_id, '_kbds_handover_time', 'Dự kiến Quý IV/2026 – Quý I/2027 (Đã cất nóc tháp đầu tiên phân khu Victory Heights cuối 10/2026)');
update_post_meta($project_id, '_kbds_bank_support', 'Ngân hàng hỗ trợ vay 70%, ân hạn gốc & ưu đãi lãi suất, tiến độ giãn chỉ 1 - 1.5%/tháng');
update_post_meta($project_id, '_kbds_review_score', '9.2');
update_post_meta($project_id, '_kbds_pros_cons', "+ Vị trí đắc địa mặt tiền Tỉnh Lộ 10 (Trần Văn Giàu) kết nối thẳng về trung tâm TP.HCM chỉ 25-30 phút\n+ Liên danh bảo chứng thép: Thắng Lợi Homes, Gỗ An Cường và Tổng thầu Central thi công chất lượng vượt tiến độ\n+ Mức giá sơ cấp cạnh tranh vượt trội chỉ từ 30,5 - 33 triệu/m² (khoảng 1,4 tỷ/căn), hiếm có tại khu vực giáp ranh TP.HCM\n+ Hệ tiện ích đồng bộ All-In-One: Công viên Victory Central 5.500m², Trường liên cấp Win Edu, Tháp biểu tượng Win Mark 42 tầng\n- Quy mô đại đô thị 18 block cần triển khai theo lộ trình từng giai đoạn");

// Cấu hình Rank Math SEO cho Dự án
update_post_meta($project_id, 'rank_math_title', 'The Win City Đức Hòa Long An | Bảng Giá CĐT & Tiến Độ Thi Công Mới Nhất 2026');
update_post_meta($project_id, 'rank_math_description', 'Đánh giá chi tiết Khu đô thị The Win City Đức Hòa Long An (13,18ha, 18 block, gần 6.000 căn hộ) mặt tiền Tỉnh Lộ 10 giáp ranh TP.HCM. Cập nhật bảng giá 30,5 - 33 triệu/m², mặt bằng và chính sách ưu đãi đợt 1.');
update_post_meta($project_id, 'rank_math_focus_keyword', 'the win city, the win city long an, căn hộ the win city đức hòa');
update_post_meta($project_id, 'rank_math_robots', ['index', 'follow']);


// 4. TẠO 5 BÀI VIẾT VỆ TINH TOPIC CLUSTER CHUYÊN SÂU
$cat_review = get_category_by_slug('review-du-an');
$cat_rv_id  = $cat_review ? $cat_review->term_id : 1;

$cat_plan   = get_category_by_slug('quy-hoach-ha-tang');
$cat_pl_id  = $cat_plan ? $cat_plan->term_id : 1;

$cat_news   = get_category_by_slug('tin-tuc-thi-truong');
$cat_nw_id  = $cat_news ? $cat_news->term_id : 1;

$project_url = get_permalink($project_id);

$satellites = [
    // Bài 1: Quy hoạch 3 Phân khu
    [
        'title' => 'Quy Hoạch 3 Phân Khu Dự Án The Win City Long An: Victory Heights, Glory Sky & Prime Majestic',
        'slug'  => 'quy-hoach-3-phan-khu-the-win-city-long-an',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['quy_hoach_3_phan_khu']['id'],
        'focus_kw' => 'phân khu the win city, victory heights the win city, glory sky the win city, prime majestic the win city',
        'desc'  => 'Phân tích quy hoạch 13,18ha đại đô thị The Win City Đức Hòa Long An với 3 phân khu Victory Heights, Glory Sky và Prime Majestic cùng tòa tháp Win Mark 42 tầng biểu tượng.',
        'content' => <<<HTML
<p>Được quy hoạch trên quỹ đất vàng rộng <strong>13,18 ha</strong> tại mặt tiền Tỉnh Lộ 10 (trục Trần Văn Giàu), <strong><a href="{$project_url}">The Win City</a></strong> (Khu đô thị Bình An Đức Hòa) là quần thể căn hộ cao tầng phức hợp quy mô bậc nhất khu vực giáp ranh phía Tây TP.HCM. Dự án gồm 18 block tháp cao từ 24 đến 33 tầng được phân bổ khoa học thành 3 phân khu lớn: <strong>Victory Heights, Glory Sky và Prime Majestic</strong>.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['quy_hoach_3_phan_khu']['url']}" alt="{$m['quy_hoach_3_phan_khu']['alt']}"/><figcaption>{$m['quy_hoach_3_phan_khu']['caption']}</figcaption></figure></div>

<h2>1. Phân Khu Victory Heights – Tọa Độ Tiên Phong Mở Màn</h2>
<p><strong>Victory Heights</strong> là phân khu đầu tiên được liên danh chủ đầu tư Thắng Lợi Group, Gỗ An Cường và Central ra mắt thị trường. Tọa lạc ngay vị trí đắc địa tiếp giáp trục Đại lộ Champion và công viên trung tâm Victory Central rộng 5.500m².</p>
<p>Điểm nhấn đặc biệt của phân khu là <strong>Tháp Hoàng Hậu Victory Hermes</strong> cùng các khối tháp VIC 1.1, VIC 1.2, VIC 1.3 với đa dạng loại hình sản phẩm từ căn hộ Studio, 1PN, 1PN+, 2PN đến 3PN diện tích từ 34,5 – 88,3 m². Đây cũng là phân khu có tiến độ xây dựng thần tốc nhất, đã cất nóc tháp đầu tiên vào cuối tháng 10/2026 vượt tiến độ 30 ngày.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['vuon_hoa_noi_khu']['url']}" alt="{$m['vuon_hoa_noi_khu']['alt']}"/><figcaption>{$m['vuon_hoa_noi_khu']['caption']}</figcaption></figure></div>

<h2>2. Phân Khu Glory Sky – Không Gian Sống Chuẩn Xanh Thoáng Đạt</h2>
<p>Nằm ở vị trí trung tâm đại đô thị, <strong>Glory Sky</strong> được định vị là không gian sống xanh an yên cho các gia đình hiện đại. Các khối tháp tại Glory Sky được thiết kế so le để đón trọn luồng gió mát lành từ Kênh Bà Cốt Bi và tầm nhìn khoáng đạt về phía chân trời TP.HCM.</p>
<p>Hệ thống tiện ích nội khu phân khu Glory Sky tập trung vào sức khỏe với công viên cây xanh, khu tập dưỡng sinh, vườn hoa dạo bộ và sân chơi trẻ em an toàn.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['tong_the_hoang_hon']['url']}" alt="{$m['tong_the_hoang_hon']['alt']}"/><figcaption>{$m['tong_the_hoang_hon']['caption']}</figcaption></figure></div>

<h2>3. Phân Khu Prime Majestic – Trung Tâm Thương Mại & Tháp Win Mark 42 Tầng</h2>
<p>Là phân khu sầm uất và đẳng cấp nhất, <strong>Prime Majestic</strong> sở hữu công trình biểu tượng chọc trời <strong>Win Mark cao 42 tầng</strong> sừng sững tại mặt tiền đường Trần Văn Giàu. Tòa tháp quy tụ trung tâm thương mại cao cấp, khách sạn 5 sao, văn phòng hạng A và các tiện ích giải trí thời thượng.</p>
<p>Khối đế của Prime Majestic là chuỗi Shophouse thương mại phục vụ nhu cầu mua sắm, ẩm thực và dịch vụ 24/7 của toàn bộ cư dân The Win City và cư dân khu vực lân cận.</p>

<p>Xem thông tin chi tiết bảng giá và chính sách từng phân khu tại trang <strong><a href="{$project_url}">Dự án The Win City Long An</a></strong>.</p>
HTML
    ],

    // Bài 2: Mặt bằng Tháp VIC 1.2
    [
        'title' => 'Mặt Bằng Chi Tiết Tháp VIC 1.2 Phân Khu Victory Heights The Win City: Đa Dạng Loại Hình Từ Studio Đến 3PN',
        'slug'  => 'mat-bang-thap-vic12-victory-heights-the-win-city',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['mat_bang_vic12']['id'],
        'focus_kw' => 'mặt bằng the win city, mặt bằng vic 1.2 the win city, thiết kế căn hộ the win city, victory heights the win city',
        'desc'  => 'Phân tích chi tiết mặt bằng tầng 05 - 22 tháp VIC 1.2 phân khu Victory Heights dự án The Win City Long An: Layout căn hộ Studio, 1PN, 2PN, 3PN thông minh, đón sáng tự nhiên.',
        'content' => <<<HTML
<p>Trong đợt mở bán đầu tiên của đại đô thị <strong><a href="{$project_url}">The Win City Đức Hòa</a></strong>, tháp <strong>VIC 1.2</strong> thuộc phân khu <strong>Victory Heights</strong> là một trong những khối tháp tâm điểm nhận được sự quan tâm lớn nhất từ khách hàng mua ở thực và nhà đầu tư nhờ thiết kế mặt bằng vuông vức, mật độ hợp lý và tỷ lệ căn hộ view công viên tuyệt đẹp.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['mat_bang_vic12']['url']}" alt="{$m['mat_bang_vic12']['alt']}"/><figcaption>{$m['mat_bang_vic12']['caption']}</figcaption></figure></div>

<h2>1. Thông Số Mặt Bằng Điển Hình Tầng 05 - 22 Tháp VIC 1.2</h2>
<p>Tháp VIC 1.2 được thiết kế với mật độ <strong>22 căn hộ/sàn</strong>, bố trí dọc hành lang thông thoáng với các giếng trời và cụm thang máy tốc độ cao ở vị trí trung tâm, đảm bảo di chuyển êm ái và an toàn tuyệt đối:</p>
<ul>
  <li><strong>Căn hộ Studio (34,5 m²):</strong> Mã căn tối ưu công năng cho người độc thân hoặc khai thác cho thuê chuyên gia KCN lân cận.</li>
  <li><strong>Căn hộ 1 Phòng Ngủ (Mã căn A-13):</strong> Diện tích tim tường 40,8 m², thông thủy 37,1 m² – phòng khách kết nối ban công thoáng đãng.</li>
  <li><strong>Căn hộ 1PN+1 Đa Năng (Mã căn A-12):</strong> Diện tích tim tường 44,3 m², thông thủy 40,1 m² – có thêm không gian làm việc hoặc giường phụ cho bé.</li>
  <li><strong>Căn hộ 2PN - 1WC:</strong> Diện tích tim tường 50,2 m², thông thủy 46,0 m² (Mã căn A-08 đến A-11, A-14, A-17 đến A-22) – lựa chọn hoàn hảo cho các gia đình trẻ tài chính vừa tầm.</li>
  <li><strong>Căn hộ 2PN - 2WC (Căn góc VIP):</strong> Diện tích tim tường 64,3 – 70,8 m² (Mã căn A-01 đến A-07, A-15, A-16) – sở hữu 2 mặt thoáng view trọn công viên và cảnh quan.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['can_ho_studio_1pn']['url']}" alt="{$m['can_ho_studio_1pn']['alt']}"/><figcaption>{$m['can_ho_studio_1pn']['caption']}</figcaption></figure></div>

<h2>2. Ưu Điểm Nổi Bật Trong Kiến Trúc Căn Hộ</h2>
<p>Toàn bộ các căn hộ tại tháp VIC 1.2 đều được liên danh thiết kế tính toán công thái học kỹ lưỡng:</p>
<ul>
  <li>100% căn hộ đều có ban công hoặc logia thông thoáng, không có góc chết hay phòng ngủ bí.</li>
  <li>Khu bếp nấu được bố trí khéo léo kết nối với logia giặt phơi, giúp thoát mùi nhanh chóng khi nấu nướng.</li>
  <li>Vật liệu hoàn thiện nội thất liền tường do <strong>Gỗ An Cường</strong> trực tiếp cung cấp, đảm bảo tính thẩm mỹ và độ bền vượt trội theo năm tháng.</li>
</ul>

<p>Đăng ký nhận mặt bằng cad chi tiết và giỏ hàng tầng đẹp tại <strong><a href="{$project_url}">Hồ sơ The Win City</a></strong>.</p>
HTML
    ],

    // Bài 3: Liên danh Thắng Lợi - An Cường - Central
    [
        'title' => 'Liên Danh Thắng Lợi Group, Gỗ An Cường & Central: Bộ Ba Bảo Chứng Chất Lượng Dự Án The Win City',
        'slug'  => 'lien-danh-thang-loi-an-cuong-central-the-win-city',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['phong_khach_mau_1']['id'],
        'focus_kw' => 'chủ đầu tư the win city, thắng lợi group the win city, gỗ an cường the win city, tổng thầu central the win city',
        'desc'  => 'Tìm hiểu liên danh 3 bên bảo chứng chất lượng vàng cho đại đô thị The Win City: Thắng Lợi Group phát triển, Gỗ An Cường cung ứng nội thất và Central Construction tổng thầu thi công.',
        'content' => <<<HTML
<p>Giữa bối cảnh thị trường bất động sản đòi hỏi tính minh bạch và năng lực thực thi khắt khe, sự xuất hiện của <strong><a href="{$project_url}">The Win City</a></strong> đã tạo nên làn sóng quan tâm mạnh mẽ nhờ cú bắt tay chiến lược giữa ba "ông lớn" đầu ngành tại Việt Nam: <strong>Thắng Lợi Group (Thắng Lợi Homes), Gỗ An Cường và Tổng thầu Central</strong>.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phong_khach_mau_1']['url']}" alt="{$m['phong_khach_mau_1']['alt']}"/><figcaption>{$m['phong_khach_mau_1']['caption']}</figcaption></figure></div>

<h2>1. Thắng Lợi Group (Thắng Lợi Homes) – Nhà Phát Triển Đô Thị Dày Dặn Kinh Nghiệm</h2>
<p>Với hơn một thập kỷ kiến tạo hàng loạt dự án khu đô thị và nhà ở kiểu mẫu tại Long An và vùng phụ cận TP.HCM, Thắng Lợi Group khẳng định vị thế nhà phát triển bất động sản thấu hiểu sâu sắc nhu cầu an cư thực của người dân. Tại The Win City, Thắng Lợi Homes đóng vai trò định vị quy hoạch đô thị, phát triển hạ tầng và hoàn thiện pháp lý chuẩn chỉnh.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['khu_bep_an_cuong']['url']}" alt="{$m['khu_bep_an_cuong']['alt']}"/><figcaption>{$m['khu_bep_an_cuong']['caption']}</figcaption></figure></div>

<h2>2. Gỗ An Cường – Cổ Đông Chiến Lược & Bảo Chứng Nội Thất Cao Cấp</h2>
<p><strong>Công ty Cổ phần Gỗ An Cường</strong> là thương hiệu sản xuất và cung cấp giải pháp vật liệu gỗ công nghiệp số 1 Việt Nam. Không chỉ là đối tác cung cấp vật liệu, An Cường còn là cổ đông chiến lược tham gia sâu vào dự án The Win City. Mọi căn hộ bàn giao đều được trang bị hệ tủ bếp, cửa gỗ và vật liệu nội thất đạt tiêu chuẩn quốc tế về độ bền, khả năng chống ẩm và thân thiện với sức khỏe người dùng.</p>

<h2>3. Central Construction – Tổng Thầu Xây Dựng Top Đầu Việt Nam</h2>
<p>Được mệnh danh là "nhà thầu của những công trình biểu tượng", <strong>Central</strong> là cái tên bảo chứng vàng cho tiến độ và chất lượng kết cấu xây dựng. Năng lực thi công của Central đã được khẳng định thực tế tại The Win City khi đơn vị này xuất sắc <strong>cất nóc tòa tháp đầu tiên vượt tiến độ 30 ngày</strong> vào cuối tháng 10/2026, áp dụng các công nghệ coppha nhôm và kỹ thuật đổ bê tông tiên tiến nhất.</p>

<p>Sự kết hợp giữa Năng lực phát triển (Thắng Lợi) – Chất lượng xây dựng (Central) – Thẩm mỹ nội thất (An Cường) đã tạo nên giá trị cạnh tranh tuyệt đối cho <strong><a href="{$project_url}">Khu đô thị The Win City Đức Hòa</a></strong>.</p>
HTML
    ],

    // Bài 4: Vị trí Tỉnh Lộ 10
    [
        'title' => 'Vị Trí The Win City Đức Hòa Mặt Tiền Tỉnh Lộ 10 (Trần Văn Giàu): Lợi Thế Kết Nối Trực Tiếp TP.HCM',
        'slug'  => 'vi-tri-the-win-city-duc-hoa-tinh-lo-10-tran-van-giau',
        'cat_id'=> $cat_pl_id,
        'thumb' => $m['pho_shophouse']['id'],
        'focus_kw' => 'vị trí the win city, the win city tỉnh lộ 10, the win city trần văn giàu, the win city đức hòa long an',
        'desc'  => 'Đánh giá chi tiết tiềm năng kết nối và giá trị gia tăng từ vị trí mặt tiền Tỉnh Lộ 10 (trục Trần Văn Giàu) của dự án The Win City Đức Hòa Long An giáp ranh Bình Chánh, TP.HCM.',
        'content' => <<<HTML
<p>Yếu tố quan trọng hàng đầu làm nên sức hút đặc biệt của đại đô thị <strong><a href="{$project_url}">The Win City</a></strong> (Khu đô thị Bình An Đức Hòa) chính là tọa độ kim cương tại <strong>mặt tiền Tỉnh Lộ 10 (ĐT825 / trục đại lộ Trần Văn Giàu)</strong> thuộc xã Đức Hòa Hạ, huyện Đức Hòa, Long An.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['pho_shophouse']['url']}" alt="{$m['pho_shophouse']['alt']}"/><figcaption>{$m['pho_shophouse']['caption']}</figcaption></figure></div>

<h2>1. Trục Huyết Mạch Kết Nối Thẳng Về Trung Tâm TP.HCM</h2>
<p>Tỉnh Lộ 10 nối liền với trục đường Trần Văn Giàu là một trong những hành lang giao thông hướng tâm trọng điểm phía Tây TP.HCM. Tuyến đường có mặt cắt ngang rộng từ 6 đến 8 làn xe thông thoáng, giúp cư dân The Win City di chuyển thẳng tắp:</p>
<ul>
  <li>Chỉ <strong>15 phút</strong> tới trung tâm quận Bình Tân, Aeon Mall Bình Tân, Bến xe Miền Tây.</li>
  <li>Chỉ <strong>20 phút</strong> tới Quận 6 (khu vực Chợ Lớn, vòng xoay Phú Lâm).</li>
  <li>Chỉ <strong>25 - 30 phút</strong> di chuyển theo đại lộ Võ Văn Kiệt về thẳng trung tâm Quận 1 và bến Bạch Đằng.</li>
</ul>

<h2>2. Liền Kề Quần Thể Khu Công Nghiệp Trọng Điểm</h2>
<p>Bao quanh The Win City trong bán kính 3 - 5km là cụm các Khu công nghiệp quy mô lớn nhất Long An như: <strong>KCN Tân Đức (1.159ha), KCN Tân Đô (303ha), KCN Hải Sơn, KCN Hạnh Phúc</strong> cùng trường Đại học Quốc tế Tân Tạo. Đây là nguồn cầu khổng lồ về nhà ở chất lượng cao từ hàng chục nghìn chuyên gia, kỹ sư và quản lý cấp cao đang làm việc tại khu vực nhưng chưa có nơi ở xứng tầm.</p>

<h2>3. Đòn Bẩy Hạ Tầng Đón Đầu Đức Hòa Lên Thành Phố</h2>
<p>Đức Hòa đang là hạt nhân kinh tế công nghiệp dẫn đầu tỉnh Long An và đang tăng tốc hoàn thiện các tiêu chí để chính thức lên Thành phố. Hàng loạt dự án giao thông tỷ đô xung quanh dự án như đường <strong>Vành Đai 3 TP.HCM, Vành Đai 4, tuyến cao tốc TP.HCM – Mộc Bài</strong> và kéo dài tuyến Metro số 3A sẽ tạo nên lực đẩy gia tăng giá trị phi mã cho bất động sản nơi đây.</p>

<p>Nhận phân tích quy hoạch và bảng giá chi tiết tại <strong><a href="{$project_url}">Dự án The Win City Long An</a></strong>.</p>
HTML
    ],

    // Bài 5: Cập nhật Bảng giá & Tiến độ
    [
        'title' => 'Cập Nhật Bảng Giá & Tiến Độ Thi Công Dự Án The Win City Đức Hòa Mới Nhất Năm 2026',
        'slug'  => 'bang-gia-tien-do-thi-cong-the-win-city-duc-hoa-2026',
        'cat_id'=> $cat_nw_id,
        'thumb' => $m['tong_the_hoang_hon']['id'],
        'focus_kw' => 'giá bán the win city, bảng giá the win city 2026, tiến độ the win city, chính sách the win city',
        'desc'  => 'Cập nhật bảng giá bán căn hộ The Win City Đức Hòa Long An mới nhất năm 2026 chỉ từ 30,5 - 33 triệu/m² (1,4 tỷ/căn) và hình ảnh thực tế cất nóc tháp đầu tiên phân khu Victory Heights.',
        'content' => <<<HTML
<p>Với mức giá sơ cấp chỉ từ <strong>30,5 – 33 triệu/m² (khoảng 1,4 tỷ đồng/căn)</strong>, dự án <strong><a href="{$project_url}">The Win City Đức Hòa Long An</a></strong> đang trở thành tâm điểm chú ý của toàn thị trường căn hộ phía Nam trong năm 2026, khi mà mặt bằng giá căn hộ tại TP.HCM đã thiết lập mức trung bình trên 60 – 80 triệu/m².</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['tong_the_hoang_hon']['url']}" alt="{$m['tong_the_hoang_hon']['alt']}"/><figcaption>{$m['tong_the_hoang_hon']['caption']}</figcaption></figure></div>

<h2>1. Bảng Giá Chi Tiết Từng Loại Hình Căn Hộ (Đợt 1)</h2>
<p>Bảng giá tham khảo trực tiếp từ liên danh chủ đầu tư Thắng Lợi Group trong giỏ hàng phân khu Victory Heights:</p>
<ul>
  <li><strong>Căn Studio (34,5 m²):</strong> Giá chỉ từ <strong>1,05 – 1,15 Tỷ/căn</strong>.</li>
  <li><strong>Căn 1 Phòng Ngủ (40,8 m²):</strong> Giá chỉ từ <strong>1,35 – 1,45 Tỷ/căn</strong>.</li>
  <li><strong>Căn 1PN+1 Đa Năng (44,3 – 48,5 m²):</strong> Giá chỉ từ <strong>1,48 – 1,60 Tỷ/căn</strong>.</li>
  <li><strong>Căn 2 Phòng Ngủ - 1WC (50,2 m²):</strong> Giá chỉ từ <strong>1,65 – 1,75 Tỷ/căn</strong>.</li>
  <li><strong>Căn 2 Phòng Ngủ - 2WC Góc (64,3 – 70,8 m²):</strong> Giá chỉ từ <strong>2,10 – 2,35 Tỷ/căn</strong>.</li>
  <li><strong>Căn 3 Phòng Ngủ VIP (80 – 88,3 m²):</strong> Giá chỉ từ <strong>2,65 – 2,90 Tỷ/căn</strong>.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phong_khach_mau_2']['url']}" alt="{$m['phong_khach_mau_2']['alt']}"/><figcaption>{$m['phong_khach_mau_2']['caption']}</figcaption></figure></div>

<h2>2. Chính Sách Bán Hàng & Tiến Độ Thanh Toán Linh Hoạt</h2>
<p>Chủ đầu tư áp dụng các phương án tài chính tối ưu cho người mua:</p>
<ul>
  <li><strong>Phương án chuẩn:</strong> Thanh toán giãn nhẹ nhàng theo tiến độ xây dựng thực tế, trung bình chỉ khoảng 1 - 1,5%/tháng.</li>
  <li><strong>Phương án vay vốn ngân hàng:</strong> Ngân hàng hỗ trợ vay tới 70% giá trị hợp đồng, ân hạn nợ gốc và hỗ trợ lãi suất 0% trong 12 – 24 tháng. Khách hàng chỉ cần có sẵn từ 300 – 450 triệu đồng vốn tự có là đã sở hữu căn hộ.</li>
  <li><strong>Chiết khấu thanh toán nhanh:</strong> Nhận chiết khấu lên đến 7 - 10% khi thanh toán sớm bằng vốn tự có.</li>
</ul>

<h2>3. Tiến Độ Thi Công Thực Tế: Cất Nóc Tháp Đầu Tiên Vượt Tiến Độ</h2>
<p>Được tổng thầu xây dựng <strong>Central</strong> triển khai từ cuối tháng 10/2025, công trường The Win City hiện đang duy trì nhịp độ khẩn trương. Cuối tháng 10/2026 vừa qua, dự án đã chính thức <strong>cất nóc tòa tháp đầu tiên thuộc phân khu Victory Heights</strong>, vượt tiến độ 30 ngày so với cam kết ban đầu.</p>
<p>Công tác hoàn thiện mặt ngoài, lắp đặt hệ thống cơ điện (MEP) và nội thất căn hộ đang được chuẩn bị để sẵn sàng bàn giao cho cư dân đúng hạn vào Quý IV/2026 – Quý I/2027.</p>

<p>Đăng ký nhận bảng tính thanh toán chi tiết từng căn tại <strong><a href="{$project_url}">Căn hộ The Win City</a></strong>.</p>
HTML
    ]
];

// Tạo các bài viết vệ tinh
echo "\n--- ĐANG TẠO 5 BÀI VIẾT VỆ TINH TOPIC CLUSTER CHO THE WIN CITY ---\n";
foreach ($satellites as $idx => $art) {
    $existing = get_posts([
        'post_type'   => 'post',
        'name'        => $art['slug'],
        'posts_per_page' => 1,
        'post_status' => 'any'
    ]);

    $post_data = [
        'post_title'    => $art['title'],
        'post_name'     => $art['slug'],
        'post_content'  => $art['content'],
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_category' => [$art['cat_id']],
        'post_excerpt'  => $art['desc'],
    ];

    if (!empty($existing)) {
        $art_id = $existing[0]->ID;
        $post_data['ID'] = $art_id;
        wp_update_post($post_data);
        echo " ✔ Đã cập nhật Bài viết " . ($idx + 1) . ": {$art['title']} (ID: {$art_id})\n";
    } else {
        $art_id = wp_insert_post($post_data);
        echo " + Đã tạo mới Bài viết " . ($idx + 1) . ": {$art['title']} (ID: {$art_id})\n";
    }

    if (!empty($art['thumb'])) {
        set_post_thumbnail($art_id, $art['thumb']);
    }

    // Gắn Meta _kbds_project_ref liên kết ngược về trang dự án Hub
    update_post_meta($art_id, '_kbds_project_ref', $project_id);
    update_post_meta($art_id, '_kbds_project_slug', $project_slug);
    wp_set_post_tags($art_id, ['The Win City', 'The Win City Đức Hòa', 'Căn hộ The Win City', 'Bình An Đức Hòa'], true);

    // Rank Math SEO
    update_post_meta($art_id, 'rank_math_title', $art['title'] . ' | Kênh Bất Động Sản');
    update_post_meta($art_id, 'rank_math_description', $art['desc']);
    update_post_meta($art_id, 'rank_math_focus_keyword', $art['focus_kw']);
    update_post_meta($art_id, 'rank_math_robots', ['index', 'follow']);
}

echo "\n==============================================================\n";
echo "🎉 HOÀN THÀNH XÂY DỰNG TRANG DỰ ÁN THE WIN CITY & 5 BÀI VỆ TINH!\n";
echo "==============================================================\n";
