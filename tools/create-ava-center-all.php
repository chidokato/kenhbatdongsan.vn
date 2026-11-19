<?php
/**
 * Tạo trọn gói Trang Dự Án AVA Center (Thuận An - Bình Dương) + 4 Bài viết vệ tinh chuẩn SEO Topic Cluster
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU XÂY DỰNG TRANG DỰ ÁN AVA CENTER (THUẬN AN - BÌNH DƯƠNG)\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/ava-center-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/ava-center-media-map.json. Hãy chạy tools/import-ava-center.php trước!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// 1. Tạo Term Chủ đầu tư & Khu vực nếu chưa có
if (!term_exists('AVA Group', 'chu_dau_tu')) {
    wp_insert_term('AVA Group', 'chu_dau_tu', [
        'slug' => 'ava-group',
        'description' => 'Tập đoàn AVA (AVA Group / Tyson An Phú) - Nhà phát triển bất động sản và không gian sống chuẩn mực hàng đầu'
    ]);
    echo " + Đã tạo term Chủ đầu tư: AVA Group\n";
}
if (!term_exists('Bình Dương', 'khu_vuc_bds')) {
    wp_insert_term('Bình Dương', 'khu_vuc_bds', [
        'slug' => 'binh-duong',
        'description' => 'Thị trường Bất Động Sản tỉnh Bình Dương - Thủ phủ công nghiệp và đô thị vệ tinh giáp ranh TP.HCM'
    ]);
    echo " + Đã tạo term Khu vực: Bình Dương\n";
}
if (!term_exists('Thuận An', 'khu_vuc_bds')) {
    $parent_bd = term_exists('Bình Dương', 'khu_vuc_bds');
    $parent_id = is_array($parent_bd) ? $parent_bd['term_id'] : 0;
    wp_insert_term('Thuận An', 'khu_vuc_bds', [
        'slug' => 'thuan-an',
        'parent' => $parent_id,
        'description' => 'Thành phố Thuận An, Bình Dương - Cửa ngõ kết nối trực tiếp với TP. Hồ Chí Minh'
    ]);
    echo " + Đã tạo term Khu vực: Thuận An\n";
}

// 2. SOẠN THẢO NỘI DUNG LANDING PAGE 10 SECTION CHUẨN UX CHO AVA CENTER
// Lưu ý: subnav viết gọn không line break bên trong để wpautop không thêm <p> hoặc <br>
$subnav_html = '<div class="kbds-project-subnav"><div class="kbds-container kbds-subnav-container"><div class="kbds-subnav-brand"><span class="kbds-subnav-dot"></span>AVA CENTER</div><a href="#dang-ky" class="kbds-subnav-cta">Nhận Báo Giá Gốc</a><nav class="kbds-subnav-links"><a href="#tong-quan" class="kbds-subnav-link">Tổng Quan</a><a href="#vi-tri" class="kbds-subnav-link">Vị Trí</a><a href="#tien-ich" class="kbds-subnav-link">36 Tiện Ích</a><a href="#can-ho-mau" class="kbds-subnav-link">Modern Vibes</a><a href="#mat-bang" class="kbds-subnav-link">Mặt Bằng</a><a href="#bang-gia" class="kbds-subnav-link">Bảng Giá & CSBH</a><a href="#phap-ly" class="kbds-subnav-link">Pháp Lý & CĐT</a><a href="#tin-tuc-du-an" class="kbds-subnav-link">Tin Tức</a></nav></div></div>';

$landing_html = <<<HTML
{$subnav_html}

<!-- SECTION 1: HERO BANNER -->
<section style="position:relative;background:linear-gradient(135deg,#064E3B 0%,#0F766E 50%,#D97706 100%);color:#fff;padding:80px 0 100px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.22;background:radial-gradient(circle at 75% 25%,#34D399 0%,transparent 65%);pointer-events:none;"></div>
  <div class="kbds-container" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:40px;align-items:center;">
    <div>
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(52,211,153,0.2);border:1px solid rgba(52,211,153,0.5);color:#A7F3D0;padding:6px 18px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;">
        🌟 AVA GROUP • AUTHENTIC VALUE ASCENDS
      </div>
      <h1 style="color:#FFFFFF;font-size:42px;font-weight:900;line-height:1.2;margin:0 0 18px;">
        AVA CENTER THUẬN AN
        <span style="display:block;font-size:22px;font-weight:600;color:#FDE68A;margin-top:6px;">Tổ Hợp Căn Hộ Cao Cấp 40 Tầng – Điểm Hẹn Cộng Đồng Tinh Hoa</span>
      </h1>
      <p style="color:#E2E8F0;font-size:16px;line-height:1.7;margin:0 0 28px;max-width:620px;">
        Tọa lạc đắc địa tại mặt tiền đường <strong>Thủ Khoa Huân</strong>, phường Thuận Giao, TP. Thuận An, Bình Dương (ngay ngã tư Hòa Lân, kề cận Quốc lộ 13, đối diện KCN VSIP 1). <strong>AVA Center</strong> (Chung cư trung tâm AVA) là tổ hợp tháp biểu tượng <strong>40 tầng</strong> với hơn 800 căn hộ cao cấp bàn giao <strong>FULL NỘI THẤT Modern Vibes</strong> theo sở thích riêng của gia chủ, cách <strong>nhà ga số 6 Metro chỉ 300 mét</strong> và chính sách thanh toán ưu việt <strong>vốn chỉ từ 186 triệu đồng</strong>.
      </p>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:30px;">
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 12px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#FDE68A;">40 Tầng</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Tháp biểu tượng</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 12px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#6EE7B7;">186 Triệu</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Vốn ban đầu sở hữu</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 12px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#38BDF8;">300 Mét</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Đến Ga Metro số 6</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 12px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#F472B6;">Full Nội Thất</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Chuẩn Modern Vibes</div>
        </div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:#D97706;color:#fff;font-weight:700;padding:14px 28px;border-radius:8px;text-decoration:none;box-shadow:0 6px 20px rgba(217,119,6,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Nhận Báo Giá Đợt 1 & Ưu Đãi 186 Tr</span> →
        </a>
        <a href="#can-ho-mau" style="background:transparent;color:#fff;font-weight:600;padding:14px 24px;border-radius:8px;text-decoration:none;border:1px solid rgba(255,255,255,0.35);">
          Xem Căn Hộ Modern Vibes
        </a>
      </div>
    </div>
    <div>
      <div style="position:relative;border-radius:16px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.4);border:2px solid rgba(52,211,153,0.35);">
        <img src="{$m['poster_cong_dong_tinh_hoa']['url']}" alt="{$m['poster_cong_dong_tinh_hoa']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(0,0,0,0.85),transparent);padding:20px;text-align:center;color:#FDE68A;font-weight:600;font-size:14px;">
          AVA Center – Điểm Hẹn Cộng Đồng Tinh Hoa, Trí Thức & Văn Minh
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: TỔNG QUAN DỰ ÁN -->
<section id="tong-quan" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 50px;">
      <span style="color:#0F766E;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">THÔNG TIN QUY HOẠCH & PHÁP LÝ MINH BẠCH</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">TỔNG QUAN DỰ ÁN AVA CENTER THUẬN AN</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Tổ hợp căn hộ cao cấp 40 tầng kiến tạo chuẩn mực sống thượng lưu tại cửa ngõ Thuận An, kề cận trục Quốc lộ 13 và đối diện KCN kiểu mẫu VSIP 1.
      </p>
    </div>

    <div style="background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.06);overflow:hidden;border:1px solid #E2E8F0;">
      <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;text-align:left;font-size:15px;">
          <tbody>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;width:28%;background:#F8FAFC;">Tên thương mại</td>
              <td style="padding:16px 24px;font-weight:700;color:#0F766E;">AVA CENTER (Authentic Value Ascends)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Tên pháp lý</td>
              <td style="padding:16px 24px;color:#334155;">Chung cư trung tâm AVA</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Chủ đầu tư</td>
              <td style="padding:16px 24px;color:#334155;"><strong>Công ty TNHH Tyson An Phú</strong> (Thành viên <strong>AVA Group</strong>)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Vị trí dự án</td>
              <td style="padding:16px 24px;color:#334155;">Mặt tiền đường Thủ Khoa Huân, P. Thuận Giao, TP. Thuận An, Bình Dương (ngay ngã tư Hòa Lân, kề QL13)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Quy mô khu đất</td>
              <td style="padding:16px 24px;color:#334155;"><strong>7.342,9 m²</strong> | Tổng vốn đầu tư khoảng <strong>1.621 tỷ đồng</strong></td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Quy mô xây dựng</td>
              <td style="padding:16px 24px;color:#334155;">
                • <strong>Block A:</strong> Cao 40 tầng nổi + 2 tầng hầm (Căn hộ ở cao cấp & Officetel)<br/>
                • <strong>Block B:</strong> Cao 6 tầng (Khối đế thương mại dịch vụ, nhà trẻ & tiện ích cộng đồng)
              </td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Số lượng sản phẩm</td>
              <td style="padding:16px 24px;color:#334155;">Khoảng <strong>800 – 850 sản phẩm</strong> (Căn hộ 1PN, 2PN, 3PN, Officetel & Shophouse)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Diện tích căn hộ</td>
              <td style="padding:16px 24px;color:#334155;">Linh hoạt từ <strong>~36 m² đến 90 m²</strong> (Studio, 1PN, 2PN, 3PN)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Tiêu chuẩn bàn giao</td>
              <td style="padding:16px 24px;color:#334155;"><strong>Bàn giao FULL NỘI THẤT cao cấp</strong> theo sở thích riêng (Phong cách Modern Vibes: Đương Đại, Tối Giản, Smart Home)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Hệ thống tiện ích</td>
              <td style="padding:16px 24px;color:#334155;">
                <strong>Tổ hợp 36 tiện ích độc bản:</strong> Bác sĩ tại gia, Trung tâm gia sư & AVA Kids, Công viên thú cưng, Hồ bơi vô cực trên cao, Sân Pickleball, Sân Golf mini, Grand Lobby 5 sao, Bãi sạc xe điện...
              </td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Chính sách tài chính</td>
              <td style="padding:16px 24px;color:#334155;">Vốn ban đầu chỉ từ <strong>186 triệu đồng</strong>, ngân hàng hỗ trợ vay, <strong>lãi suất cố định 5%/năm trong vòng 5 năm</strong></td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Hình thức sở hữu</td>
              <td style="padding:16px 24px;color:#334155;"><strong>Sổ hồng sở hữu lâu dài</strong> (đối với người Việt Nam); 50 năm (đối với người nước ngoài)</td>
            </tr>
            <tr>
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Thời gian bàn giao</td>
              <td style="padding:16px 24px;color:#334155;">Dự kiến Quý IV/2026 – Quý I/2027</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VỊ TRÍ ĐẮC ĐỊA & KẾT NỐI METRO -->
<section id="vi-tri" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;">
      <div>
        <span style="color:#0F766E;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">CỬA NGÕ GIAO THƯƠNG SẦM UẤT THUẬN AN</span>
        <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 20px;">VỊ TRÍ KIM CƯƠNG CÁCH GA METRO CHỈ 300 MÉT</h2>
        <p style="color:#475569;font-size:16px;line-height:1.7;margin-bottom:20px;">
          <strong>AVA Center</strong> ngự trị tại mặt tiền đường <strong>Thủ Khoa Huân</strong>, phường Thuận Giao, TP. Thuận An, Bình Dương. Dự án nằm ngay nút giao ngã tư Hòa Lân – điểm giao thoa giữa Quốc lộ 13 (Đại lộ Bình Dương) mở rộng 8 làn xe và đường Thủ Khoa Huân kết nối thẳng tới đường Mỹ Phước – Tân Vạn.
        </p>
        <div style="background:#F0FDF4;border-left:4px solid #0F766E;padding:16px 20px;border-radius:0 8px 8px 0;margin-bottom:24px;">
          <h4 style="margin:0 0 8px;color:#064E3B;font-size:16px;">Tọa Độ Kết Nối Siêu Tốc Trong Bán Kính 1 - 5km:</h4>
          <ul style="margin:0;padding-left:18px;color:#334155;font-size:14px;line-height:1.8;">
            <li><strong>Chỉ 300 mét (2 phút đi bộ):</strong> Tiếp cận Nhà ga số 6 thuộc tuyến Metro kết nối trực tiếp TP. Mới Bình Dương và TP.HCM.</li>
            <li><strong>Chỉ 2 phút:</strong> Đối diện KCN VSIP 1, KCN Việt Hương – nơi tập trung hơn 50.000 chuyên gia, kỹ sư nước ngoài và lao động tay nghề cao.</li>
            <li><strong>Chỉ 5 – 7 phút:</strong> Đến TTTM Aeon Mall Bình Dương Canary, Lotte Mart Thuận An, Sân Golf Sông Bé 27 lỗ chuẩn quốc tế.</li>
            <li><strong>Chỉ 8 – 10 phút:</strong> Tiếp cận Bệnh viện Quốc tế Columbia Asia, Bệnh viện Đa khoa Quốc tế Becamex, Vincom Plaza Dĩ An.</li>
            <li><strong>15 – 20 phút:</strong> Kết nối thông suốt về TP. Thủ Đức, KĐT Vạn Phúc, Gigamall Phạm Văn Đồng, Ngã tư Hàng Xanh và Sân bay Quốc tế Tân Sơn Nhất.</li>
          </ul>
        </div>
        <p style="color:#475569;font-size:15px;line-height:1.7;">
          Lợi thế kề cận nhà ga Metro và nằm giữa trái tim thủ phủ công nghiệp phát triển năng động nhất Bình Dương mang lại cho AVA Center tiềm năng tăng trưởng giá trị vượt trội và tỷ suất lợi nhuận cho thuê chuyên gia lên tới 8 – 10%/năm.
        </p>
      </div>
      <div>
        <div style="border-radius:16px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.1);border:1px solid #CBD5E1;">
          <img src="{$m['so_do_vi_tri']['url']}" alt="{$m['so_do_vi_tri']['alt']}" style="width:100%;height:auto;display:block;"/>
        </div>
        <div style="margin-top:12px;font-size:13px;color:#64748B;text-align:center;font-style:italic;">
          {$m['so_do_vi_tri']['caption']}
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: TỔ HỢP 36 TIỆN ÍCH ĐỘC BẢN -->
<section id="tien-ich" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 50px;">
      <span style="color:#0F766E;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">CHỌN TIỆN NGHI – TRỌN TRẢI NGHIỆM</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">TỔ HỢP 36 TIỆN ÍCH ĐỘC BẢN AVA CENTER</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Hệ sinh thái All-In-One khép kín được thiết kế riêng biệt để phục vụ trọn vẹn mọi nhu cầu chăm sóc sức khỏe, giáo dục trẻ em, thư giãn và gắn kết cộng đồng cư dân tinh hoa.
      </p>
    </div>

    <!-- HÌNH MẶT BẰNG 36 TIỆN ÍCH -->
    <div style="margin-bottom:40px;border-radius:16px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
      <img src="{$m['to_hop_36_tien_ich']['url']}" alt="{$m['to_hop_36_tien_ich']['alt']}" style="width:100%;height:auto;display:block;"/>
    </div>

    <!-- 4 TIỆN ÍCH ĐỘC BẢN HIGHLIGHT -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:40px;">
      <div style="background:#fff;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="font-size:28px;margin-bottom:12px;">🩺</div>
        <h4 style="font-size:17px;font-weight:700;color:#0F172A;margin:0 0 8px;">Bác Sĩ Tại Gia & Nhà Thuốc</h4>
        <p style="color:#64748B;font-size:13px;line-height:1.6;margin:0;">
          Phòng khám gia đình nội khu với đội ngũ bác sĩ chuyên khoa túc trực, chăm sóc sức khỏe định kỳ và cấp cứu y tế 24/7 cho toàn thể cư dân.
        </p>
      </div>

      <div style="background:#fff;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="font-size:28px;margin-bottom:12px;">📚</div>
        <h4 style="font-size:17px;font-weight:700;color:#0F172A;margin:0 0 8px;">Trung Tâm Gia Sư & AVA Kids</h4>
        <p style="color:#64748B;font-size:13px;line-height:1.6;margin:0;">
          Trường mầm non quốc tế, trung tâm giữ và dạy kèm trẻ em ngoài giờ cùng khu vui chơi AVA Kids giúp con trẻ phát triển tư duy toàn diện an toàn.
        </p>
      </div>

      <div style="background:#fff;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="font-size:28px;margin-bottom:12px;">🐕</div>
        <h4 style="font-size:17px;font-weight:700;color:#0F172A;margin:0 0 8px;">Công Viên Thú Cưng (Pet Park)</h4>
        <p style="color:#64748B;font-size:13px;line-height:1.6;margin:0;">
          Không gian xanh rực rỡ dành riêng cho thú cưng vui chơi và vận động, trang bị chướng ngại vật huấn luyện và khu vệ sinh chuyên biệt sạch sẽ.
        </p>
      </div>

      <div style="background:#fff;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="font-size:28px;margin-bottom:12px;">🏓</div>
        <h4 style="font-size:17px;font-weight:700;color:#0F172A;margin:0 0 8px;">Sân Pickleball & Golf Mini</h4>
        <p style="color:#64748B;font-size:13px;line-height:1.6;margin:0;">
          Cụm thể thao thời thượng với sân chơi Pickleball chuẩn thi đấu, sân tập Golf mini, phòng Gym, Yoga ngoài trời và đường chạy bộ rợp bóng mát.
        </p>
      </div>
    </div>

    <!-- 2 ẢNH TIỆN ÍCH LỚN: HỒ BƠI VÔ CỰC & GRAND LOBBY -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;">
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
        <img src="{$m['ho_boi_vo_cuc']['url']}" alt="{$m['ho_boi_vo_cuc']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="padding:16px;background:#fff;font-size:14px;color:#334155;font-weight:600;text-align:center;">
          Hồ bơi vô cực trên cao Infinity Sky Pool – Ngắm hoàng hôn tuyệt mỹ
        </div>
      </div>
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
        <img src="{$m['sanh_don_grand_lobby']['url']}" alt="{$m['sanh_don_grand_lobby']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="padding:16px;background:#fff;font-size:14px;color:#334155;font-weight:600;text-align:center;">
          Sảnh đón Grand Lobby chuẩn khách sạn 5 sao sang trọng thông tầng
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: CĂN HỘ MẪU MODERN VIBES BÀN GIAO FULL NỘI THẤT -->
<section id="can-ho-mau" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 50px;">
      <span style="color:#0F766E;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">CHỌN NHÀ THEO GU RIÊNG</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">PHONG CÁCH NỘI THẤT MODERN VIBES</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        AVA Center mang đến giải pháp căn hộ bàn giao <strong>FULL NỘI THẤT</strong> theo phong cách sống riêng của từng gia chủ, kết hợp hài hòa giữa Đương Đại phóng khoáng, Tối Giản thanh lịch và Tiện Nghi thông minh Smart Home.
      </p>
    </div>

    <!-- HÌNH BANNER MODERN VIBES -->
    <div style="margin-bottom:36px;border-radius:16px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,0.06);border:1px solid #E2E8F0;">
      <img src="{$m['noi_that_modern_vibes']['url']}" alt="{$m['noi_that_modern_vibes']['alt']}" style="width:100%;height:auto;display:block;"/>
    </div>

    <!-- 3 CỘT PHÂN TÍCH GU THIẾT KẾ -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:26px;">
      <div style="border-radius:14px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.04);">
        <img src="{$m['phong_cach_duong_dai']['url']}" alt="{$m['phong_cach_duong_dai']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="padding:22px;background:#fff;">
          <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">Phong Cách Đương Đại</h4>
          <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0 0 10px;">
            Không bị bó buộc vào quy chuẩn cũ kỹ. Ưu tiên các khối hình học dứt khoát, mảng miếng rõ rệt kết hợp phá cách giữa kính, thép, bê tông trần và gỗ tự nhiên tạo nên cảm giác mạnh mẽ nhưng ấm cúng.
          </p>
        </div>
      </div>

      <div style="border-radius:14px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.04);">
        <img src="{$m['phong_cach_toi_gian']['url']}" alt="{$m['phong_cach_toi_gian']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="padding:22px;background:#fff;">
          <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">Phong Cách Tối Giản</h4>
          <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0 0 10px;">
            Tối giản không có nghĩa là trống rỗng, mà là sự chắt lọc tinh túy nhất. Sử dụng bảng màu trung tính nhẹ nhàng (trắng, xám, beige, xanh pastel) giúp tâm trí gia chủ được giải phóng khỏi những bộn bề sau ngày dài.
          </p>
        </div>
      </div>

      <div style="border-radius:14px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.04);">
        <img src="{$m['tien_nghi_smart_home']['url']}" alt="{$m['tien_nghi_smart_home']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="padding:22px;background:#fff;">
          <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">Tiện Nghi & Smart Home</h4>
          <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0 0 10px;">
            Trải nghiệm người dùng đặt lên hàng đầu. Nội thất thông minh đa công năng tối ưu diện tích, tích hợp hệ thống Smart Home điều khiển ánh sáng, âm thanh và an ninh tự động chỉ với một nút chạm trên smartphone.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: MẶT BẰNG & CƠ CẤU SẢN PHẨM -->
<section id="mat-bang" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 50px;">
      <span style="color:#0F766E;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">THIẾT KẾ CÔNG THÁI HỌC THÔNG MINH</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">MẶT BẰNG CĂN HỘ AVA CENTER THUẬN AN</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Tất cả các căn hộ tại tháp A (40 tầng) đều sở hữu thiết kế vuông vức, ban công đón gió mát tự nhiên, tối ưu ánh sáng và tầm view khoáng đạt nhìn về sân Golf Sông Bé hoặc trung tâm TP.HCM.
      </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:40px;">
      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#0F766E;text-transform:uppercase;margin-bottom:8px;">Căn Hộ Officetel</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Đa Năng Vừa Ở Vừa Làm</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">36 – 42 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Phù hợp người độc thân, chuyên gia trẻ khởi nghiệp & mở văn phòng</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#0F766E;text-transform:uppercase;margin-bottom:8px;">Căn Hộ 1 Phòng Ngủ</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Tổ Ấm Nhỏ Tinh Tế</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">48 – 52 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Phòng khách nối dài ban công thoáng đãng, tối ưu không gian bếp</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#0F766E;text-transform:uppercase;margin-bottom:8px;">Căn Hộ 2 Phòng Ngủ</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Chuẩn Gia Đình Hiện Đại</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">62 – 72 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">2 phòng ngủ riêng biệt, 2WC, phòng ngủ master đón trọn ánh sáng</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#0F766E;text-transform:uppercase;margin-bottom:8px;">Căn Hộ 3 Phòng Ngủ</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Căn Góc Thượng Lưu</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">85 – 90 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Góc 2 mặt thoáng view toàn cảnh, không gian sống sang trọng đa thế hệ</div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: BẢNG GIÁ & CHÍNH SÁCH THANH TOÁN ĐỘT PHÁ -->
<section id="bang-gia" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 40px;">
      <span style="color:#0F766E;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">GIẢI PHÁP TÀI CHÍNH AN TÂM AN CƯ</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">BẢNG GIÁ DỰ KIẾN & CHÍNH SÁCH AVA CENTER</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Sở hữu căn hộ cao cấp bàn giao full nội thất với số vốn ban đầu chỉ từ <strong>186 triệu đồng</strong> và chính sách cố định lãi suất <strong>5%/năm suốt 5 năm</strong>.
      </p>
    </div>

    <!-- BANNER CHÍNH SÁCH -->
    <div style="margin-bottom:36px;border-radius:16px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,0.08);border:1px solid #CBD5E1;">
      <img src="{$m['banner_tong_quan']['url']}" alt="{$m['banner_tong_quan']['alt']}" style="width:100%;height:auto;display:block;"/>
    </div>

    <div style="background:#fff;border-radius:16px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 4px 20px rgba(0,0,0,0.06);margin-bottom:40px;">
      <table style="width:100%;border-collapse:collapse;font-size:15px;text-align:left;">
        <thead>
          <tr style="background:#064E3B;color:#fff;">
            <th style="padding:16px 20px;">Loại Căn Hộ</th>
            <th style="padding:16px 20px;">Diện Tích</th>
            <th style="padding:16px 20px;">Tiêu Chuẩn Bàn Giao</th>
            <th style="padding:16px 20px;">Giá Bán Dự Kiến (VAT)</th>
            <th style="padding:16px 20px;">Vốn Ban Đầu Cần Có</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Officetel Đa Năng</td>
            <td style="padding:16px 20px;">36 – 42 m²</td>
            <td style="padding:16px 20px;">Full nội thất thông minh + Smart Home</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 1,35 – 1,50 Tỷ</td>
            <td style="padding:16px 20px;font-weight:700;color:#0F766E;">Chỉ từ 186 Triệu (15%)</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Căn Hộ 1 Phòng Ngủ</td>
            <td style="padding:16px 20px;">48 – 52 m²</td>
            <td style="padding:16px 20px;">Full nội thất chuẩn Modern Vibes</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 1,65 – 1,80 Tỷ</td>
            <td style="padding:16px 20px;font-weight:700;color:#0F766E;">Chỉ từ 250 Triệu (15%)</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Căn Hộ 2 Phòng Ngủ</td>
            <td style="padding:16px 20px;">62 – 72 m²</td>
            <td style="padding:16px 20px;">Full nội thất cao cấp hoàn chỉnh</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 2,10 – 2,45 Tỷ</td>
            <td style="padding:16px 20px;font-weight:700;color:#0F766E;">Chỉ từ 320 Triệu (15%)</td>
          </tr>
          <tr style="background:#F8FAFC;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Căn Hộ 3 Phòng Ngủ (Góc)</td>
            <td style="padding:16px 20px;">85 – 90 m²</td>
            <td style="padding:16px 20px;">Full nội thất VIP thiết kế riêng</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 2,85 – 3,20 Tỷ</td>
            <td style="padding:16px 20px;font-weight:700;color:#0F766E;">Chỉ từ 430 Triệu (15%)</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- CÔNG CỤ TÍNH LÃI VAY -->
    <div style="margin-top:36px;">
      [kbds_loan_calculator]
    </div>
  </div>
</section>

<!-- SECTION 8: PHÁP LÝ & BẢO CHỨNG CHỦ ĐẦU TƯ AVA GROUP -->
<section id="phap-ly" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;">
      <div>
        <span style="color:#0F766E;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">UY TÍN TẠO NIỀM TIN VỮNG BỀN</span>
        <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 20px;">PHÁP LÝ VỮNG CHẮC – SỔ HỒNG LÂU DÀI</h2>
        <p style="color:#475569;font-size:16px;line-height:1.7;margin-bottom:20px;">
          Dự án <strong>Chung cư trung tâm AVA (AVA Center)</strong> được phê duyệt đầy đủ các thủ tục pháp lý nghiêm ngặt theo quy chuẩn nhà ở thương mại của UBND tỉnh Bình Dương:
        </p>
        <ul style="color:#475569;font-size:15px;line-height:1.8;padding-left:20px;margin-bottom:24px;">
          <li>Quy hoạch chi tiết xây dựng tỷ lệ 1/500 đã được phê duyệt chính thức.</li>
          <li>Quyết định chấp thuận chủ trương đầu tư và công nhận chủ đầu tư Công ty TNHH Tyson An Phú (AVA Group).</li>
          <li>Giấy phép xây dựng đầy đủ, thực hiện đầy đủ nghĩa vụ thuế đất và bảo lãnh từ các ngân hàng thương mại uy tín.</li>
          <li>Hình thức sở hữu: <strong>Sổ hồng sở hữu lâu dài</strong> cho người Việt Nam.</li>
        </ul>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:20px 0 10px;">Về Tập Đoàn AVA (AVA Group):</h4>
        <p style="color:#475569;font-size:15px;line-height:1.7;">
          Với phương châm <em>"Authentic Value Ascends – Giá trị đích thực thăng hoa"</em>, AVA Group luôn chú trọng vào chất lượng xây dựng, tính ứng dụng thực tế của không gian sống và hệ thống dịch vụ tiện ích hướng tới con người, cam kết đồng hành lâu dài cùng khách hàng.
        </p>
      </div>
      <div>
        <div style="background:#fff;border-radius:16px;padding:36px;box-shadow:0 8px 30px rgba(0,0,0,0.06);border:1px solid #E2E8F0;">
          <h3 style="font-size:20px;font-weight:800;color:#064E3B;margin:0 0 20px;text-align:center;">5 ĐIỂM CỘNG ĐỘT PHÁ CỦA AVA CENTER</h3>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#0F766E;line-height:1;">01</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Cách Ga Số 6 Tuyến Metro Chỉ 300 Mét</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Di chuyển bằng đường sắt đô thị siêu tốc đến trung tâm TP.HCM và TP. Mới Bình Dương.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#0F766E;line-height:1;">02</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Bàn Giao Full Nội Thất Modern Vibes</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Nhận nhà vào ở hoặc khai thác cho thuê ngay mà không tốn thêm chi phí và thời gian sắm sửa.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#0F766E;line-height:1;">03</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Vốn Ban Đầu Cực Nhẹ Chỉ Từ 186 Triệu</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Lãi suất ưu đãi cố định 5%/năm kéo dài 5 năm, xóa tan áp lực tài chính cho gia đình trẻ.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#0F766E;line-height:1;">04</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Tổ Hợp 36 Tiện Ích Độc Bản Khép Kín</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Bác sĩ tại gia, Trung tâm gia sư & AVA Kids, Hồ bơi vô cực ngắm hoàng hôn, Công viên thú cưng.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;">
            <div style="font-size:20px;font-weight:800;color:#0F766E;line-height:1;">05</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Nhu Cầu Thuê Khổng Lồ Từ KCN VSIP 1</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Hơn 50.000 chuyên gia, kỹ sư và quản lý cấp cao sẵn sàng chi trả mức thuê hấp dẫn.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 9: TIN TỨC DỰ ÁN LIÊN QUAN (TOPIC CLUSTER) -->
<section id="tin-tuc-du-an" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 40px;">
      <span style="color:#0F766E;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">CẨM NANG & THỊ TRƯỜNG</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">TIN TỨC & ĐÁNH GIÁ DỰ ÁN AVA CENTER</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Cập nhật liên tục tiến độ thi công, tiến độ tuyến Metro và bảng giá mới nhất từ các chuyên gia Kênh Bất Động Sản.
      </p>
    </div>

    [kbds_project_news limit="12"]
  </div>
</section>

<!-- SECTION 10: FORM ĐĂNG KÝ TƯ VẤN & NHẬN BẢNG GIÁ NGOẠI GIAO -->
<section id="dang-ky" style="padding:80px 0;background:linear-gradient(135deg,#064E3B 0%,#0F766E 100%);color:#fff;">
  <div class="kbds-container" style="max-width:800px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:36px;">
      <span style="color:#FDE68A;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">ĐĂNG KÝ NHẬN BÁO GIÁ ĐỢT 1 & SUẤT 186 TRIỆU</span>
      <h2 style="font-size:32px;font-weight:800;color:#fff;margin:8px 0 16px;">LIÊN HỆ PHÒNG KINH DOANH AVA CENTER</h2>
      <p style="color:#CBD5E1;font-size:15px;line-height:1.6;">
        Để lại thông tin chính xác, chuyên viên tư vấn dự án AVA Center sẽ gửi trọn bộ tài liệu gồm Mặt bằng layout căn hộ, Bảng tính lãi suất 5% và Giỏ hàng căn tầng đẹp qua Zalo trong vòng 3 phút.
      </p>
    </div>

    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.18);border-radius:16px;padding:36px;box-shadow:0 12px 30px rgba(0,0,0,0.25);">
      [kbds_lead_form project="AVA Center Bình Dương"]
    </div>
  </div>
</section>
HTML;

// 3. TẠO HOẶC CẬP NHẬT POST DỰ ÁN (du_an)
$project_slug = 'ava-center-binh-duong';
$existing_project = get_posts([
    'post_type'   => 'du_an',
    'name'        => $project_slug,
    'posts_per_page' => 1,
    'post_status' => 'any'
]);

$project_data = [
    'post_title'   => 'AVA Center Thuận An - Bình Dương | Căn Hộ Cao Cấp AVA Group',
    'post_name'    => $project_slug,
    'post_content' => $landing_html,
    'post_status'  => 'publish',
    'post_type'    => 'du_an',
    'post_excerpt' => 'AVA Center (Chung cư trung tâm AVA) là tổ hợp căn hộ cao cấp 40 tầng mặt tiền Thủ Khoa Huân, P. Thuận Giao, TP. Thuận An, Bình Dương. Bàn giao Full nội thất Modern Vibes, cách ga Metro số 6 chỉ 300m, vốn từ 186 triệu, lãi suất 5% trong 5 năm, 36 tiện ích độc bản.',
];

if (!empty($existing_project)) {
    $project_id = $existing_project[0]->ID;
    $project_data['ID'] = $project_id;
    wp_update_post($project_data);
    echo " ✔ Đã cập nhật Dự án AVA Center (ID: {$project_id})\n";
} else {
    $project_id = wp_insert_post($project_data);
    echo " + Đã tạo mới Dự án AVA Center (ID: {$project_id})\n";
}

// Thiết lập Featured Image (Ảnh đại diện)
if (!empty($m['phoi_canh_tong_the']['id'])) {
    set_post_thumbnail($project_id, $m['phoi_canh_tong_the']['id']);
}

// Gán Taxonomies
wp_set_object_terms($project_id, ['binh-duong', 'thuan-an'], 'khu_vuc_bds');
wp_set_object_terms($project_id, ['can-ho-chung-cu'], 'loai_hinh_bds');
wp_set_object_terms($project_id, 'dang-mo-ban', 'trang_thai_du_an');
wp_set_object_terms($project_id, 'ava-group', 'chu_dau_tu');

// Cập nhật Meta fields chuẩn mô hình B
update_post_meta($project_id, '_kbds_project_code', 'DA-AVACENTER');
update_post_meta($project_id, '_kbds_price_from', 'Từ 32 – 36 triệu/m² (Căn hộ từ ~1,35 tỷ/căn full nội thất)');
update_post_meta($project_id, '_kbds_price_min_num', '32');
update_post_meta($project_id, '_kbds_address', 'Mặt tiền đường Thủ Khoa Huân, phường Thuận Giao, TP. Thuận An, tỉnh Bình Dương (ngay ngã tư Hòa Lân, kề cận QL13, đối diện VSIP 1)');
update_post_meta($project_id, '_kbds_total_area', '7.342,9 m² (Mật độ xây dựng ~38%)');
update_post_meta($project_id, '_kbds_scale', 'Tổ hợp tháp A cao 40 tầng (căn hộ ở & officetel) + 2 tầng hầm và khối đế thương mại dịch vụ B cao 6 tầng, quy mô hơn 800 căn hộ');
update_post_meta($project_id, '_kbds_legal_status', 'Chung cư trung tâm AVA - Đã duyệt 1/500, Chấp thuận chủ trương đầu tư, GPXD đầy đủ, Sổ hồng lâu dài');
update_post_meta($project_id, '_kbds_handover_time', 'Dự kiến Quý IV/2026 – Quý I/2027 (Bàn giao Full nội thất cao cấp Modern Vibes)');
update_post_meta($project_id, '_kbds_bank_support', 'Ngân hàng hỗ trợ vay, vốn ban đầu chỉ từ 186 triệu đồng, lãi suất cố định 5%/năm trong 5 năm');
update_post_meta($project_id, '_kbds_review_score', '9.4');
update_post_meta($project_id, '_kbds_pros_cons', "+ Vị trí kim cương mặt tiền Thủ Khoa Huân, đối diện KCN VSIP 1 và cách nhà ga số 6 Metro chỉ 300 mét\n+ Bàn giao Full nội thất cao cấp Modern Vibes theo gu riêng, tích hợp Smart Home thông minh\n+ Chính sách tài chính đột phá: Vốn ban đầu chỉ từ 186 triệu, lãi suất ưu đãi cố định 5%/năm trong vòng 5 năm\n+ Hệ thống 36 tiện ích độc bản: Bác sĩ tại gia, Trung tâm gia sư, AVA Kids, Hồ bơi vô cực Infinity Sky Pool, Công viên thú cưng\n- Mật độ xây dựng đô thị cao, cần lưu ý giờ cao điểm tại nút giao ngã tư Hòa Lân");

// Cấu hình Rank Math SEO cho Dự án
update_post_meta($project_id, 'rank_math_title', 'AVA Center Thuận An Bình Dương | Bảng Giá Căn Hộ AVA Group 2026');
update_post_meta($project_id, 'rank_math_description', 'Đánh giá chi tiết dự án căn hộ AVA Center Thuận An Bình Dương (40 tầng, hơn 800 căn hộ full nội thất) mặt tiền Thủ Khoa Huân cách ga Metro 300m. Cập nhật bảng giá, chính sách 186 triệu & 36 tiện ích độc bản.');
update_post_meta($project_id, 'rank_math_focus_keyword', 'ava center, ava center thuận an, căn hộ ava center, ava center bình dương');
update_post_meta($project_id, 'rank_math_robots', ['index', 'follow']);


// 4. TẠO 4 BÀI VIẾT VỆ TINH TOPIC CLUSTER CHUYÊN SÂU
$cat_review = get_category_by_slug('review-du-an');
$cat_rv_id  = $cat_review ? $cat_review->term_id : 1;

$cat_plan   = get_category_by_slug('quy-hoach-ha-tang');
$cat_pl_id  = $cat_plan ? $cat_plan->term_id : 1;

$cat_news   = get_category_by_slug('tin-tuc-thi-truong');
$cat_nw_id  = $cat_news ? $cat_news->term_id : 1;

$project_url = get_permalink($project_id);

$satellites = [
    // Bài 1: Đánh giá vị trí mặt tiền Thủ Khoa Huân - Metro - VSIP 1
    [
        'title' => 'Đánh Giá Vị Trí AVA Center Thuận An Mặt Tiền Thủ Khoa Huân: Lợi Thế 300m Đến Ga Metro & Đối Diện VSIP 1',
        'slug'  => 'vi-tri-ava-center-thuan-an-thu-khoa-huan-metro-vsip1',
        'cat_id'=> $cat_pl_id,
        'thumb' => $m['so_do_vi_tri']['id'],
        'focus_kw' => 'vị trí ava center, ava center thuận an, căn hộ thủ khoa huân, ava center vsip 1',
        'desc'  => 'Phân tích vị trí đắc địa mặt tiền Thủ Khoa Huân của dự án AVA Center Thuận An: Cách ga Metro số 6 chỉ 300m, đối diện KCN VSIP 1, kết nối Quốc lộ 13 về TP.HCM.',
        'content' => <<<HTML
<p>Nằm ngay tâm điểm phát triển đô thị sôi động nhất của thành phố Thuận An, <strong><a href="{$project_url}">AVA Center</a></strong> (Chung cư trung tâm AVA) sở hữu vị trí vàng ngay mặt tiền đường <strong>Thủ Khoa Huân</strong>, phường Thuận Giao, tỉnh Bình Dương. Đây là vị trí chiến lược đón đầu trọn vẹn sức bật hạ tầng giao thông và làn sóng dịch chuyển dân cư từ TP.HCM về các đô thị vệ tinh.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['so_do_vi_tri']['url']}" alt="{$m['so_do_vi_tri']['alt']}"/><figcaption>{$m['so_do_vi_tri']['caption']}</figcaption></figure></div>

<h2>1. Vị Trí Ngay Ngã Tư Hòa Lân – Cửa Ngõ Giao Thương Huyết Mạch</h2>
<p>Dự án tọa lạc ngay khu vực ngã tư Hòa Lân sầm uất, nơi giao cắt giữa hai trục đường trọng điểm:</p>
<ul>
  <li><strong>Đường Thủ Khoa Huân:</strong> Trục đại lộ thương mại huyết mạch kết nối từ Quốc lộ 13 sang đường Mỹ Phước – Tân Vạn và đi thẳng về trung tâm TP. Tân Uyên, TP. Dĩ An.</li>
  <li><strong>Quốc lộ 13 (Đại lộ Bình Dương):</strong> Trục xương sống kinh tế đang được nâng cấp mở rộng lên 8 làn xe, giúp việc di chuyển từ AVA Center về TP. Thủ Đức và trung tâm TP. Hồ Chí Minh chỉ mất từ 15 đến 20 phút.</li>
</ul>

<h2>2. Đòn Bẩy Đột Phá: Cách Nhà Ga Số 6 Tuyến Metro Chỉ 300 Mét</h2>
<p>Một trong những điểm nhấn giá trị nhất của AVA Center là khoảng cách chỉ <strong>300 mét đến Nhà ga số 6</strong> của tuyến Metro tương lai. Xu hướng phát triển bất động sản TOD (Transit-Oriented Development) kề cận nhà ga đường sắt đô thị trên thế giới và tại Việt Nam luôn ghi nhận mức tăng giá từ 20% – 35% so với các khu vực khác:</p>
<ul>
  <li>Cư dân chỉ mất 2 phút đi bộ để tiếp cận hệ thống tàu điện hiện đại, không lo kẹt xe hay khói bụi.</li>
  <li>Kết nối trực tiếp với tuyến Metro Bến Thành – Suối Tiên (TP.HCM) và chuỗi đô thị thông minh Thành Phố Mới Bình Dương.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phoi_canh_tong_the']['url']}" alt="{$m['phoi_canh_tong_the']['alt']}"/><figcaption>{$m['phoi_canh_tong_the']['caption']}</figcaption></figure></div>

<h2>3. Nhu Cầu Cho Thuê Khổng Lồ Từ KCN Kiểu Mẫu VSIP 1</h2>
<p>Tọa lạc đối diện trực tiếp KCN VSIP 1 và kề cận KCN Việt Hương – nơi làm việc của hơn 50.000 chuyên gia, kỹ sư và nhà quản lý nước ngoài (Hàn Quốc, Nhật Bản, Đài Loan, Singapore), AVA Center sở hữu tiềm năng khai thác cho thuê cực kỳ bền vững với giá thuê căn hộ cao cấp tại khu vực dao động từ 10 – 18 triệu đồng/tháng, mang lại tỷ suất lợi nhuận ròng hấp dẫn từ 8% đến 10%/năm.</p>

<p>Xem thông tin chi tiết bảng giá và chính sách ưu đãi tại trang <strong><a href="{$project_url}">Dự Án AVA Center Thuận An</a></strong>.</p>
HTML
    ],

    // Bài 2: Tổ hợp 36 tiện ích độc bản
    [
        'title' => 'Khám Phá Tổ Hợp 36 Tiện Ích Độc Bản Tại AVA Center: Bác Sĩ Tại Gia, Trung Tâm Gia Sư & Công Viên Thú Cưng',
        'slug'  => 'to-hop-36-tien-ich-doc-ban-ava-center-binh-duong',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['to_hop_36_tien_ich']['id'],
        'focus_kw' => 'tiện ích ava center, hồ bơi vô cực ava center, bác sĩ tại gia ava center, công viên thú cưng ava center',
        'desc'  => 'Trải nghiệm hệ sinh thái 36 tiện ích độc bản tại AVA Center Bình Dương: Bác sĩ tại gia, Trung tâm gia sư, AVA Kids, Hồ bơi vô cực Infinity Sky Pool và Công viên thú cưng.',
        'content' => <<<HTML
<p>Không chỉ chú trọng vào chất lượng xây dựng, Chủ đầu tư <strong>AVA Group</strong> đã dành trọn tâm huyết kiến tạo nên tổ hợp <strong>36 tiện ích độc bản khép kín</strong> tại <strong><a href="{$project_url}">AVA Center Thuận An</a></strong>. Đây là dự án tiên phong tại Bình Dương đưa các dịch vụ chăm sóc sức khỏe gia đình và giáo dục chuyên sâu vào ngay ngưỡng cửa từng căn hộ.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['to_hop_36_tien_ich']['url']}" alt="{$m['to_hop_36_tien_ich']['alt']}"/><figcaption>{$m['to_hop_36_tien_ich']['caption']}</figcaption></figure></div>

<h2>1. Chuỗi Tiện Ích Độc Quyền: Bác Sĩ Tại Gia & Nhà Thuốc Nội Khu</h2>
<p>Sức khỏe là tài sản quý giá nhất. Tại AVA Center, phòng khám gia đình được xây dựng đạt chuẩn với đội ngũ y bác sĩ túc trực, cung cấp dịch vụ thăm khám tại nhà, theo dõi hồ sơ sức khỏe điện tử định kỳ cho người cao tuổi và trẻ nhỏ, giải quyết kịp thời các tình huống khẩn cấp 24/7.</p>

<h2>2. Trung Tâm Gia Sư, Trường Mầm Non & Khu Vui Chơi AVA Kids</h2>
<p>Thấu hiểu nỗi bận rộn của các bậc phụ huynh trẻ, dự án bố trí hệ sinh thái giáo dục toàn diện:</p>
<ul>
  <li><strong>Trung tâm giữ và dạy kèm trẻ ngoài giờ:</strong> Giúp cha mẹ an tâm làm việc khi con cái có không gian tự học và được thầy cô kèm cặp bài vở chu đáo.</li>
  <li><strong>Trung tâm Anh ngữ & Thư viện tự học:</strong> Môi trường bồi dưỡng ngoại ngữ và kiến thức hiện đại cho các cư dân nhí.</li>
  <li><strong>Khu vui chơi trẻ em AVA Kids:</strong> Phân chia khu trong nhà và ngoài trời với các trò chơi vận động phát triển thể chất lành mạnh.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['ho_boi_vo_cuc']['url']}" alt="{$m['ho_boi_vo_cuc']['alt']}"/><figcaption>{$m['ho_boi_vo_cuc']['caption']}</figcaption></figure></div>

<h2>3. Hồ Bơi Vô Cực Infinity Sky Pool & Công Viên Thú Cưng Độc Bản</h2>
<p>Trên tầng cao của tòa tháp, <strong>Hồ bơi vô cực Infinity Sky Pool</strong> mang lại trải nghiệm nghỉ dưỡng xa hoa, nơi cư dân thả mình vào làn nước mát lành và ngắm nhìn trọn vẹn cảnh hoàng hôn rực rỡ buông xuống thành phố.</p>
<p>Bên cạnh đó, dự án còn ghi dấu ấn với <strong>Công viên thú cưng (Pet Park)</strong> – tiện ích hiếm thấy tại các chung cư, nơi thú cưng được tự do chạy nhảy trên bãi cỏ xanh mát mà không ảnh hưởng đến không gian chung.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['sanh_don_grand_lobby']['url']}" alt="{$m['sanh_don_grand_lobby']['alt']}"/><figcaption>{$m['sanh_don_grand_lobby']['caption']}</figcaption></figure></div>

<h2>4. Sảnh Đón Grand Lobby 5 Sao & Sân Thể Thao Đa Năng</h2>
<p>Bước vào AVA Center là bước vào không gian đón tiếp lộng lẫy của Grand Lobby ốp đá Marble thông tầng cao vút. Cùng với đó là cụm sân chơi thể thao xu hướng thời thượng: Sân Pickleball, Sân Golf mini, phòng Gym máy Technogym và sân tập Yoga ngoài trời tràn ngập sinh khí.</p>

<p>Đăng ký nhận sơ đồ quy hoạch 36 tiện ích tại <strong><a href="{$project_url}">Hồ Sơ Dự Án AVA Center</a></strong>.</p>
HTML
    ],

    // Bài 3: Bàn giao full nội thất phong cách Modern Vibes
    [
        'title' => 'Căn Hộ AVA Center Bàn Giao Full Nội Thất Phong Cách Modern Vibes: Đương Đại, Tối Giản & Smart Home',
        'slug'  => 'ban-giao-full-noi-that-modern-vibes-can-ho-ava-center',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['noi_that_modern_vibes']['id'],
        'focus_kw' => 'nội thất ava center, căn hộ modern vibes ava center, smart home ava center, thiết kế ava center',
        'desc'  => 'Tìm hiểu tiêu chuẩn bàn giao Full nội thất phong cách Modern Vibes tại căn hộ AVA Center Thuận An: Kết hợp Đương đại, Tối giản và công nghệ Smart Home thông minh.',
        'content' => <<<HTML
<p>Một trong những điểm khác biệt lớn nhất tạo nên sức hút khó cưỡng của <strong><a href="{$project_url}">AVA Center</a></strong> trên thị trường bất động sản năm 2026 chính là tiêu chuẩn <strong>BÀN GIAO FULL NỘI THẤT</strong> theo phong cách <strong>Modern Vibes</strong>. Khách hàng khi nhận bàn giao chỉ cần mang vali vào ở hoặc có thể vận hành cho thuê ngay mà không phát sinh thêm chi phí trang trí.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['noi_that_modern_vibes']['url']}" alt="{$m['noi_that_modern_vibes']['alt']}"/><figcaption>{$m['noi_that_modern_vibes']['caption']}</figcaption></figure></div>

<h2>1. Định Nghĩa Phong Cách Modern Vibes Tại AVA Center</h2>
<p>Modern Vibes là ngôn ngữ thiết kế tôn vinh phong cách sống năng động, tinh tế của thế hệ cư dân trẻ và các chuyên gia hiện đại. Không gian căn hộ là sự hòa quyện nhịp nhàng giữa 3 yếu tố cốt lõi: <strong>Đương Đại, Tối Giản và Tiện Nghi</strong>.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phong_cach_duong_dai']['url']}" alt="{$m['phong_cach_duong_dai']['alt']}"/><figcaption>{$m['phong_cach_duong_dai']['caption']}</figcaption></figure></div>

<h2>2. Tinh Thần Đương Đại & Khoảng Thở Tối Giản</h2>
<ul>
  <li><strong>Đường nét dứt khoát:</strong> Các mảng miếng hình học rõ ràng kết hợp khéo léo với những đường cong uốn lượn mềm mại trên bàn trà, ghế sofa và hệ vách ngăn trang trí.</li>
  <li><strong>Vật liệu cao cấp:</strong> Sự kết hợp phá cách giữa kính cường lực tràn viền, thép sơn tĩnh điện, bê tông mài và bề mặt gỗ công nghiệp chống ẩm cao cấp mang lại cảm giác vừa mạnh mẽ, vừa ấm cúng.</li>
  <li><strong>Màu sắc trung tính:</strong> Gam màu trắng, xám khói, beige kết hợp nhấn nhá xanh sage/pastel tạo cảm giác rộng rãi và thoáng đãng gấp bội so với diện tích thực tế.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phong_cach_toi_gian']['url']}" alt="{$m['phong_cach_toi_gian']['alt']}"/><figcaption>{$m['phong_cach_toi_gian']['caption']}</figcaption></figure></div>

<h2>3. Trải Nghiệm Tiện Nghi Đỉnh Cao Cùng Smart Home 4.0</h2>
<p>Căn hộ AVA Center không chỉ đẹp mà còn thông minh vượt trội nhờ hệ thống Smart Home tích hợp sẵn:</p>
<ul>
  <li>Khóa cửa thông minh nhận diện vân tay, mật mã, thẻ từ và ứng dụng điện thoại.</li>
  <li>Hệ thống chiếu sáng tự động theo ngữ cảnh (Tiếp khách, Thư giãn, Nghỉ ngơi).</li>
  <li>Điều hòa không khí và rèm cửa tự động điều khiển từ xa, giúp làm mát căn phòng trước khi gia chủ bước chân về nhà.</li>
  <li>Nội thất thông minh: Giường ngủ tích hợp ngăn kéo, bàn ăn gấp gọn, tủ bếp kịch trần tối ưu hóa 100% diện tích sử dụng.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['tien_nghi_smart_home']['url']}" alt="{$m['tien_nghi_smart_home']['alt']}"/><figcaption>{$m['tien_nghi_smart_home']['caption']}</figcaption></figure></div>

<p>Trải nghiệm thực tế căn hộ mẫu Modern Vibes tại <strong><a href="{$project_url}">Trang Dự Án AVA Center Bình Dương</a></strong>.</p>
HTML
    ],

    // Bài 4: Bảng giá & chính sách 186 triệu, lãi suất 5% trong 5 năm
    [
        'title' => 'Cập Nhật Bảng Giá & Chính Sách Thanh Toán AVA Center Năm 2026: Chỉ Từ 186 Triệu, Lãi Suất 5% Trong 5 Năm',
        'slug'  => 'bang-gia-chinh-sach-thanh-toan-ava-center-2026',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['banner_tong_quan']['id'],
        'focus_kw' => 'bảng giá ava center, giá bán căn hộ ava center, chính sách bán hàng ava center, mua nhà ava center 186 triệu',
        'desc'  => 'Bảng giá căn hộ AVA Center Thuận An Bình Dương năm 2026: Cơ hội sở hữu căn hộ cao cấp full nội thất vốn chỉ từ 186 triệu, ngân hàng cho vay lãi suất 5% trong 5 năm.',
        'content' => <<<HTML
<p>Trong bối cảnh mặt bằng giá căn hộ tại TP.HCM đã vượt ngưỡng 60 – 80 triệu/m², <strong><a href="{$project_url}">AVA Center</a></strong> xuất hiện như một "cơn mưa giải nhiệt" cho thị trường căn hộ cửa ngõ phía Đông Bắc TP.HCM với mức giá bán chỉ từ <strong>32 – 36 triệu/m²</strong> (đã gồm full nội thất) cùng chính sách tài chính chưa từng có tiền lệ.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['banner_tong_quan']['url']}" alt="{$m['banner_tong_quan']['alt']}"/><figcaption>{$m['banner_tong_quan']['caption']}</figcaption></figure></div>

<h2>1. Bảng Giá Chi Tiết Các Dòng Căn Hộ AVA Center Đợt 1</h2>
<table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:15px;">
  <thead>
    <tr style="background:#064E3B;color:#fff;">
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Loại Căn Hộ</th>
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Diện Tích</th>
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Giá Bán Dự Kiến (VAT)</th>
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Vốn Ban Đầu (15%)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Officetel Đa Năng</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">36 – 42 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 1,35 – 1,50 Tỷ</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#0F766E;font-weight:700;">Từ 186 Triệu</td>
    </tr>
    <tr style="background:#F8FAFC;">
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Căn Hộ 1 Phòng Ngủ</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">48 – 52 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 1,65 – 1,80 Tỷ</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#0F766E;font-weight:700;">Từ 250 Triệu</td>
    </tr>
    <tr>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Căn Hộ 2 Phòng Ngủ</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">62 – 72 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 2,10 – 2,45 Tỷ</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#0F766E;font-weight:700;">Từ 320 Triệu</td>
    </tr>
    <tr style="background:#F8FAFC;">
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Căn Hộ 3 Phòng Ngủ (Góc)</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">85 – 90 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 2,85 – 3,20 Tỷ</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#0F766E;font-weight:700;">Từ 430 Triệu</td>
    </tr>
  </tbody>
</table>

<h2>2. Bộ Ba Chính Sách Tài Chính Đột Phá Từ AVA Group</h2>
<ul>
  <li><strong>Vốn tự có ban đầu chỉ 186 triệu (15%):</strong> Khách hàng đã có thể ký hợp đồng mua bán và sở hữu căn hộ cho riêng mình.</li>
  <li><strong>Lãi suất cố định 5%/năm kéo dài suốt 5 năm:</strong> Đập tan nỗi lo biến động lãi suất thả nổi trên thị trường, giúp người mua chủ động lên kế hoạch tài chính dễ dàng.</li>
  <li><strong>Tiến độ giãn nhẹ nhàng:</strong> Thanh toán từng đợt chỉ từ 1 – 1,5%/tháng đến khi nhận nhà, hoàn toàn phù hợp với thu nhập của người đi làm tại TP.HCM và Bình Dương.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['poster_cong_dong_tinh_hoa']['url']}" alt="{$m['poster_cong_dong_tinh_hoa']['alt']}"/><figcaption>{$m['poster_cong_dong_tinh_hoa']['caption']}</figcaption></figure></div>

<h2>3. Bài Toán Kinh Tế Cho Người Mua Ở Thực & Nhà Đầu Tư</h2>
<p>Với mức giá chỉ từ 1,35 tỷ cho căn hộ full nội thất, tiền gốc và lãi hàng tháng chi trả ngân hàng chỉ tương đương số tiền đi thuê nhà (khoảng 6 – 8 triệu đồng/tháng). Sau 5 năm, khách hàng đã sở hữu trọn vẹn một tài sản có giá trị gia tăng gấp đôi nhờ tuyến Metro và hạ tầng mở rộng Quốc lộ 13.</p>

<p>Nhận bảng tính dòng tiền chi tiết từng căn tại <strong><a href="{$project_url}">Hồ Sơ Căn Hộ AVA Center Thuận An</a></strong>.</p>
HTML
    ]
];

// Tạo các bài viết vệ tinh
echo "\n--- ĐANG TẠO 4 BÀI VIẾT VỆ TINH TOPIC CLUSTER CHO AVA CENTER ---\n";
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
    wp_set_post_tags($art_id, ['AVA Center', 'AVA Center Thuận An', 'Căn hộ AVA Center', 'AVA Group'], true);

    // Rank Math SEO
    update_post_meta($art_id, 'rank_math_title', $art['title'] . ' | Kênh Bất Động Sản');
    update_post_meta($art_id, 'rank_math_description', $art['desc']);
    update_post_meta($art_id, 'rank_math_focus_keyword', $art['focus_kw']);
    update_post_meta($art_id, 'rank_math_robots', ['index', 'follow']);
}

echo "\n==============================================================\n";
echo "🎉 HOÀN TẤT XÂY DỰNG LANDING PAGE & 4 BÀI VIẾT VỆ TINH AVA CENTER!\n";
echo "==============================================================\n";
