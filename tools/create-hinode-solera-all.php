<?php
/**
 * Tạo trọn gói Trang Dự Án Hinode Solera Phạm Hùng + 5 Bài viết vệ tinh chuẩn SEO Topic Cluster
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU XÂY DỰNG TRANG DỰ ÁN HINODE SOLERA PHẠM HÙNG (HÀ NỘI)\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/hinode-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/hinode-media-map.json. Hãy chạy tools/import-hinode-solera.php trước!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// 1. Tạo Term Chủ đầu tư nếu chưa có
if (!term_exists('WTO (Vietracimex)', 'chu_dau_tu')) {
    wp_insert_term('WTO (Vietracimex)', 'chu_dau_tu', [
        'slug' => 'wto-vietracimex',
        'description' => 'Tổng công ty Cổ phần Thương mại Xây dựng (WTO - tiền thân là Vietracimex)'
    ]);
    echo " + Đã tạo term Chủ đầu tư: WTO (Vietracimex)\n";
}

// 2. SOẠN NỘI DUNG LANDING PAGE 10 SECTION CHUẨN UX CHO HINODE SOLERA PHẠM HÙNG
$landing_html = <<<HTML
<!-- SUBNAV ĐIỀU HƯỚNG DỰ ÁN -->
<div class="kbds-project-subnav" style="position:sticky;top:0;z-index:99;background:#0F172A;box-shadow:0 4px 20px rgba(0,0,0,0.25);border-bottom:1px solid #1E293B;">
  <div class="kbds-container" style="display:flex;align-items:center;justify-content:space-between;padding:12px 20px;overflow-x:auto;white-space:nowrap;gap:12px;">
    <div style="font-weight:800;font-size:16px;color:#F8FAFC;display:flex;align-items:center;gap:8px;">
      <span style="display:inline-block;width:10px;height:10px;background:#D97706;border-radius:50%;box-shadow:0 0 10px #D97706;"></span>
      HINODE SOLERA PHẠM HÙNG
    </div>
    <div style="display:flex;gap:18px;font-size:13.5px;font-weight:600;">
      <a href="#tong-quan" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Tổng Quan</a>
      <a href="#vi-tri" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Vị Trí Kim Cương</a>
      <a href="#tien-ich" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Tiện Ích 5 Sao</a>
      <a href="#mat-bang" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Mặt Bằng Tầng</a>
      <a href="#can-ho-dual-key" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Căn Hộ Dual Key</a>
      <a href="#tin-tuc-du-an" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#F59E0B'" onmouseout="this.style.color='#CBD5E1'">Tin Tức Đánh Giá</a>
    </div>
    <a href="#dang-ky" style="background:linear-gradient(135deg,#D97706,#B45309);color:#fff;padding:8px 18px;border-radius:24px;font-size:12.5px;font-weight:700;text-decoration:none;box-shadow:0 4px 12px rgba(217,119,6,0.35);">Nhận Báo Giá Gốc</a>
  </div>
</div>

<!-- SECTION 1: HERO BANNER -->
<section class="kbds-project-hero" style="position:relative;background:linear-gradient(135deg,#0B132B 0%,#1C2541 50%,#3A506B 100%);color:#fff;padding:85px 0 105px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.18;background:radial-gradient(circle at 75% 25%,#F59E0B 0%,transparent 65%);pointer-events:none;"></div>
  <div class="kbds-container kbds-hero-grid" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:45px;align-items:center;">
    <div class="kbds-hero-content">
      <div class="kbds-hero-badge" style="display:inline-flex;align-items:center;gap:8px;background:rgba(217,119,6,0.22);border:1px solid rgba(245,158,11,0.5);padding:6px 16px;border-radius:30px;font-size:13px;font-weight:700;color:#FDE68A;margin-bottom:20px;letter-spacing:0.5px;">
        🏛️ BIỂU TƯỢNG CĂN HỘ HẠNG SANG TRUNG TÂM MỸ ĐÌNH
      </div>
      <h1 class="kbds-hero-title" style="font-size:38px;line-height:1.25;font-weight:900;margin-bottom:18px;color:#FFFFFF;text-shadow:0 2px 10px rgba(0,0,0,0.5);">
        HINODE SOLERA PHẠM HÙNG
        <span class="kbds-hero-subtitle" style="display:block;font-size:23px;color:#FBBF24;font-weight:700;margin-top:6px;">Tọa Độ Kim Cương 28 Phạm Hùng – Trực Diện Hồ Điều Hòa Cầu Giấy 32ha</span>
      </h1>
      <p class="kbds-hero-desc" style="font-size:16px;line-height:1.7;color:#E2E8F0;margin-bottom:28px;">
        Tổ hợp căn hộ cao cấp và văn phòng thương mại chuẩn Nhật Bản tọa lạc ngay mặt tiền số 28 Phạm Hùng (Nam Từ Liêm, Hà Nội). Sở hữu tầm nhìn panorama triệu đô hướng trọn công viên hồ điều hòa Cầu Giấy 32ha, kề cận Keangnam Landmark 72 và Vinhomes Skylake, kiến tạo không gian sống thượng lưu độc bản cùng giải pháp căn hộ Dual Key đột phá.
      </p>
      <div class="kbds-hero-actions" style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:linear-gradient(135deg,#F59E0B,#D97706);color:#0F172A;padding:14px 28px;border-radius:10px;font-size:15px;font-weight:800;text-decoration:none;box-shadow:0 6px 20px rgba(245,158,11,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Đăng Ký Tư Vấn & Bảng Giá Đợt 1</span> ➔
        </a>
        <a href="#mat-bang" style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.25);padding:14px 26px;border-radius:10px;font-size:15px;font-weight:700;text-decoration:none;backdrop-filter:blur(10px);">
          Xem Mặt Bằng 16 Căn/Tầng
        </a>
      </div>
    </div>
    <div class="kbds-hero-media" style="position:relative;">
      <div style="border-radius:20px;overflow:hidden;box-shadow:0 20px 45px rgba(0,0,0,0.5);border:2px solid rgba(245,158,11,0.4);">
        <img class="kbds-hero-img" src="{$m['phoi_canh_toa_thap']['url']}" alt="{$m['phoi_canh_toa_thap']['alt']}" style="width:100%;height:440px;object-fit:cover;display:block;">
      </div>
      <div class="kbds-hero-float-badge" style="position:absolute;bottom:-18px;left:20px;background:#0F172A;border:1px solid #D97706;padding:12px 22px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.4);display:flex;align-items:center;gap:14px;">
        <div style="background:#D97706;width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px;overflow:hidden;flex-shrink:0;">💎</div>
        <div>
          <div style="font-size:11.5px;color:#94A3B8;text-transform:uppercase;font-weight:700;">Dòng sản phẩm độc bản</div>
          <div style="font-size:14.5px;font-weight:800;color:#FDE68A;">Căn Hộ Dual Key 1+1 & 2+1</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: QUICK STATS BAR -->
<div style="background:#0F172A;border-bottom:1px solid #1E293B;padding:26px 0;">
  <div class="kbds-container" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;text-align:center;">
    <div style="padding:10px;border-right:1px solid #334155;">
      <div style="font-size:26px;font-weight:900;color:#F59E0B;">25 TẦNG</div>
      <div style="font-size:13px;color:#94A3B8;margin-top:4px;">Chiều cao công trình + 3 tầng hầm</div>
    </div>
    <div style="padding:10px;border-right:1px solid #334155;">
      <div style="font-size:26px;font-weight:900;color:#F59E0B;">16 CĂN/SÀN</div>
      <div style="font-size:13px;color:#94A3B8;margin-top:4px;">Mật độ thấp, tối ưu độ riêng tư</div>
    </div>
    <div style="padding:10px;border-right:1px solid #334155;">
      <div style="font-size:26px;font-weight:900;color:#F59E0B;">54.3 – 159.4 m²</div>
      <div style="font-size:13px;color:#94A3B8;margin-top:4px;">Căn hộ 1PN, 2PN, 3PN & Dual Key</div>
    </div>
    <div style="padding:10px;">
      <div style="font-size:26px;font-weight:900;color:#F59E0B;">HỒ 32HA</div>
      <div style="font-size:13px;color:#94A3B8;margin-top:4px;">Trực diện công viên hồ Cầu Giấy</div>
    </div>
  </div>
</div>

<!-- SECTION 3: TỔNG QUAN DỰ ÁN -->
<section id="tong-quan" style="padding:75px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:750px;margin:0 auto 45px;">
      <div style="font-size:13px;font-weight:800;color:#D97706;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px;">HỒ SƠ TỔNG QUAN</div>
      <h2 style="font-size:32px;font-weight:900;color:#0F172A;">THÔNG TIN DỰ ÁN HINODE SOLERA PHẠM HÙNG</h2>
      <p style="font-size:15px;color:#64748B;line-height:1.7;">Được kiến tạo bởi Tập đoàn WTO (Vietracimex) danh tiếng với chuỗi thương hiệu Hinode trứ danh, dự án là kiệt tác kiến trúc sang trọng ngay trái tim kinh tế mới Mỹ Đình.</p>
    </div>

    <div class="kbds-2col-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:35px;align-items:center;">
      <div style="background:#F8FAFC;padding:32px;border-radius:18px;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.04);">
        <table style="width:100%;border-collapse:collapse;font-size:14.5px;">
          <tbody>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 0;color:#64748B;font-weight:600;width:38%;">Tên thương mại:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">Hinode Solera (Hinode Suite Phạm Hùng)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 0;color:#64748B;font-weight:600;">Vị trí tọa lạc:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">Số 28 Phạm Hùng, P. Mỹ Đình 1, Q. Nam Từ Liêm, Hà Nội</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 0;color:#64748B;font-weight:600;">Chủ đầu tư:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">Tập đoàn WTO (Vietracimex)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 0;color:#64748B;font-weight:600;">Đơn vị phân phối:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">Indochine Real Estate & các đối tác chiến lược</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 0;color:#64748B;font-weight:600;">Quy mô dự án:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">4.824 m², 1 tòa tháp 25 tầng nổi & 3 tầng hầm</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 0;color:#64748B;font-weight:600;">Khối đế dịch vụ:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">Tầng 1 - 5 (TTTM, Gym, Spa, Sảnh đón 5 sao, Văn phòng)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 0;color:#64748B;font-weight:600;">Khối căn hộ cao cấp:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">Tầng 6 - 25 (~300 căn hộ thượng lưu, 16 căn/sàn)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 0;color:#64748B;font-weight:600;">Cơ cấu sản phẩm:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">Căn 1PN, 2PN, 3PN & Dual Key (1+1, 2+1)</td>
            </tr>
            <tr>
              <td style="padding:12px 0;color:#64748B;font-weight:600;">Hình thức sở hữu:</td>
              <td style="padding:12px 0;color:#0F172A;font-weight:700;">Sổ hồng lâu dài</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div>
        <div style="border-radius:18px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.12);border:1px solid #E2E8F0;">
          <img src="{$m['phoi_canh_toa_thap']['url']}" alt="{$m['phoi_canh_toa_thap']['alt']}" style="width:100%;height:380px;object-fit:cover;display:block;">
        </div>
        <div style="margin-top:16px;background:#FEF3C7;border-left:4px solid #D97706;padding:14px 18px;border-radius:6px;font-size:13.5px;color:#92400E;line-height:1.6;">
          <strong>💡 Giá trị cốt lõi:</strong> Số lượng hữu hạn chỉ khoảng 300 căn hộ nằm trên trục đường Vành đai 3 Phạm Hùng đắt giá – nơi quỹ đất phát triển nhà ở cao tầng nội đô đã hoàn toàn cạn kiệt.
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: VỊ TRÍ & TẦM NHÌN HỒ ĐIỀU HÒA 32HA -->
<section id="vi-tri" style="padding:80px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;border-bottom:1px solid #E2E8F0;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:750px;margin:0 auto 45px;">
      <div style="font-size:13px;font-weight:800;color:#D97706;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px;">TỌA ĐỘ VÀNG NỘI ĐÔ</div>
      <h2 style="font-size:32px;font-weight:900;color:#0F172A;">VỊ TRÍ SỐ 28 PHẠM HÙNG – TRỰC DIỆN HỒ CẦU GIẤY 32HA</h2>
      <p style="font-size:15px;color:#64748B;line-height:1.7;">Nằm ngay tâm điểm trục giao thương kinh tế huyết mạch Vành đai 3 trên cao, liền kề các tòa cao ốc biểu tượng và tận hưởng trọn vẹn lá phổi xanh mát lành của hồ nước điều hòa.</p>
    </div>

    <div class="kbds-2col-grid" style="display:grid;grid-template-columns:1.1fr 0.9fr;gap:40px;align-items:center;">
      <div style="border-radius:18px;overflow:hidden;box-shadow:0 15px 35px rgba(0,0,0,0.12);border:1px solid #CBD5E1;">
        <img src="{$m['vi_tri_ho_cau_giay']['url']}" alt="{$m['vi_tri_ho_cau_giay']['alt']}" style="width:100%;height:400px;object-fit:cover;display:block;">
        <div style="padding:14px 18px;background:#0F172A;color:#E2E8F0;font-size:13px;line-height:1.5;">
          📍 <em>Hình ảnh thực tế tầm nhìn từ công viên hồ điều hòa Cầu Giấy 32ha hướng về Hinode Solera số 28 Phạm Hùng, Keangnam Landmark 72 và Vinhomes Skylake.</em>
        </div>
      </div>

      <div>
        <h3 style="font-size:22px;font-weight:800;color:#0F172A;margin-bottom:18px;">Liên Kết Vùng Hoàn Hảo Trong Bán Kính 500m – 2km</h3>
        <ul style="list-style:none;padding:0;margin:0 0 24px 0;display:flex;flex-direction:column;gap:14px;font-size:14.5px;color:#334155;">
          <li style="display:flex;align-items:flex-start;gap:12px;">
            <span style="color:#D97706;font-size:18px;line-height:1;">🌊</span>
            <div><strong>Trực diện Công viên Hồ Điều Hòa Cầu Giấy 32ha:</strong> Không gian mặt nước rộng 19ha mang lại vi khí hậu trong lành quanh năm cho toàn bộ cư dân.</div>
          </li>
          <li style="display:flex;align-items:flex-start;gap:12px;">
            <span style="color:#D97706;font-size:18px;line-height:1;">🏢</span>
            <div><strong>Liền kề Keangnam Landmark 72 & Vinhomes Skylake:</strong> Nằm giữa quần thể bất động sản đắt đỏ bậc nhất khu vực Tây Hà Nội.</div>
          </li>
          <li style="display:flex;align-items:flex-start;gap:12px;">
            <span style="color:#D97706;font-size:18px;line-height:1;">🚌</span>
            <div><strong>Cách Bến xe Mỹ Đình chỉ 500m:</strong> Dễ dàng kết nối giao thông liên tỉnh và các tuyến xe buýt nhanh BRT, Metro tương lai.</div>
          </li>
          <li style="display:flex;align-items:flex-start;gap:12px;">
            <span style="color:#D97706;font-size:18px;line-height:1;">🎓</span>
            <div><strong>Hệ thống giáo dục & y tế hàng đầu:</strong> Liền kề Marie Curie, Lomonoxop, ĐH Quốc Gia Hà Nội, Viện Huyết học, Bệnh viện 19-8 Bộ Công An.</div>
          </li>
        </ul>
        <div style="background:#FFFBEB;border:1px dashed #D97706;padding:16px 20px;border-radius:12px;color:#92400E;font-size:13.5px;line-height:1.6;">
          <strong>🎯 Tiềm năng cho thuê vượt trội:</strong> Khu vực tập trung hơn 30.000 chuyên gia cao cấp nước ngoài (Hàn Quốc, Nhật Bản, Đài Loan), mang đến tỷ suất lợi nhuận cho thuê ổn định 7% - 9%/năm.
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: TIỆN ÍCH NỘI KHU 5 SAO -->
<section id="tien-ich" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:750px;margin:0 auto 45px;">
      <div style="font-size:13px;font-weight:800;color:#D97706;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px;">CHUẨN SỐNG THƯỢNG LƯU</div>
      <h2 style="font-size:32px;font-weight:900;color:#0F172A;">HỆ THỐNG TIỆN ÍCH ĐẲNG CẤP CHUẨN KHÁCH SẠN 5 SAO</h2>
      <p style="font-size:15px;color:#64748B;line-height:1.7;">Hinode Solera Phạm Hùng tích hợp chuỗi dịch vụ khép kín từ khối đế thương mại 5 tầng đến không gian thư giãn đỉnh cao trên cao, phục vụ trọn vẹn nhu cầu sống và làm việc của giới tinh hoa.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px;">
      <div style="background:#F8FAFC;padding:26px;border-radius:16px;border:1px solid #E2E8F0;transition:all 0.3s;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 25px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
        <div style="font-size:36px;margin-bottom:14px;">🏊‍♂️</div>
        <h3 style="font-size:18px;font-weight:800;color:#0F172A;margin-bottom:10px;">Bể Bơi Bốn Mùa Trong Nhà</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0;">Bể bơi ứng dụng công nghệ điện phân muối khoáng, điều hòa nhiệt độ nước chuẩn 4 mùa giúp cư dân thư giãn mỗi ngày.</p>
      </div>

      <div style="background:#F8FAFC;padding:26px;border-radius:16px;border:1px solid #E2E8F0;transition:all 0.3s;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 25px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
        <div style="font-size:36px;margin-bottom:14px;">🛍️</div>
        <h3 style="font-size:18px;font-weight:800;color:#0F172A;margin-bottom:10px;">5 Tầng TTTM & Dịch Vụ Cao Cấp</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0;">Hội tụ các thương hiệu thời trang, chuỗi nhà hàng ẩm thực Nhật - Á - Âu cao cấp, cafe lounge và siêu thị tiện lợi.</p>
      </div>

      <div style="background:#F8FAFC;padding:26px;border-radius:16px;border:1px solid #E2E8F0;transition:all 0.3s;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 25px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
        <div style="font-size:36px;margin-bottom:14px;">🏋️‍♂️</div>
        <h3 style="font-size:18px;font-weight:800;color:#0F172A;margin-bottom:10px;">Phòng Gym & Trung Tâm Wellness</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0;">Trang thiết bị tập luyện chuẩn Olympic, kết hợp phòng tập Yoga chuyên sâu, phòng xông hơi Sauna phục hồi thể chất.</p>
      </div>

      <div style="background:#F8FAFC;padding:26px;border-radius:16px;border:1px solid #E2E8F0;transition:all 0.3s;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 25px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
        <div style="font-size:36px;margin-bottom:14px;">🛎️</div>
        <h3 style="font-size:18px;font-weight:800;color:#0F172A;margin-bottom:10px;">Sảnh Đón 5 Sao & Concierge 24/7</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0;">Sảnh đón sang trọng ốp đá Marble quý phái, dịch vụ lễ tân chuyên nghiệp và an ninh kiểm soát thẻ từ đa tầng nghiêm ngặt.</p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: MẶT BẰNG TẦNG ĐIỂN HÌNH -->
<section id="mat-bang" style="padding:80px 0;background:#0F172A;color:#fff;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 45px;">
      <div style="font-size:13px;font-weight:800;color:#F59E0B;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px;">QUY HOẠCH CHI TIẾT MẶT BẰNG</div>
      <h2 style="font-size:32px;font-weight:900;color:#FFFFFF;">MẶT BẰNG TẦNG ĐIỂN HÌNH 16 CĂN HỘ / SÀN</h2>
      <p style="font-size:15px;color:#94A3B8;line-height:1.7;">Cơ cấu căn hộ được bố trí khoa học, tất cả các căn đều có mặt thoáng tiếp sáng tự nhiên, hành lang rộng rãi và hệ thống thang máy tốc độ cao chuyên biệt.</p>
    </div>

    <div style="background:#1E293B;padding:24px;border-radius:20px;border:1px solid #334155;box-shadow:0 15px 40px rgba(0,0,0,0.4);margin-bottom:40px;">
      <img src="{$m['mat_bang_dien_hinh']['url']}" alt="{$m['mat_bang_dien_hinh']['alt']}" style="width:100%;height:auto;border-radius:12px;display:block;">
      <div style="text-align:center;font-size:13px;color:#94A3B8;margin-top:14px;">
        📐 <em>Sơ đồ vị trí và mặt bằng chi tiết 16 căn hộ/sàn tại tòa tháp Hinode Solera Phạm Hùng (Mặt tiền Phạm Hùng hướng Nam, la bàn chỉ Bắc).</em>
      </div>
    </div>

    <!-- BẢNG CƠ CẤU SẢN PHẨM -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;">
      <div style="background:#1E293B;border:1px solid #334155;border-top:4px solid #E2E8F0;padding:20px;border-radius:12px;">
        <div style="font-size:12px;color:#94A3B8;font-weight:700;text-transform:uppercase;">Căn Hộ 1 Phòng Ngủ</div>
        <div style="font-size:22px;font-weight:800;color:#FFFFFF;margin:6px 0;">54.3 – 57.1 m²</div>
        <div style="font-size:13px;color:#CBD5E1;line-height:1.5;">Gồm các mã căn: <strong>S-06</strong> (54.3m²), <strong>S-01, S-11, S-12, S-15</strong> (57.1m²). Tối ưu cho chuyên gia & gia đình trẻ.</div>
      </div>

      <div style="background:#1E293B;border:1px solid #334155;border-top:4px solid #F59E0B;padding:20px;border-radius:12px;">
        <div style="font-size:12px;color:#F59E0B;font-weight:700;text-transform:uppercase;">Căn Hộ 2 Phòng Ngủ</div>
        <div style="font-size:22px;font-weight:800;color:#F59E0B;margin:6px 0;">87.7 – 88.3 m²</div>
        <div style="font-size:13px;color:#CBD5E1;line-height:1.5;">Gồm các mã căn: <strong>S-10</strong> (88.3m²), <strong>S-05, S-07</strong> (87.8m²), <strong>S-12A, S-12B</strong> (87.7m²). Thiết kế 2WC rộng rãi.</div>
      </div>

      <div style="background:#1E293B;border:1px solid #334155;border-top:4px solid #B45309;padding:20px;border-radius:12px;">
        <div style="font-size:12px;color:#B45309;font-weight:700;text-transform:uppercase;">Căn Hộ 3 Phòng Ngủ</div>
        <div style="font-size:22px;font-weight:800;color:#FDE68A;margin:6px 0;">122.7 m²</div>
        <div style="font-size:13px;color:#CBD5E1;line-height:1.5;">Mã căn: <strong>S-08</strong> (122.7m²). Không gian sinh hoạt đại gia đình, tầm view khoáng đạt trực diện công viên.</div>
      </div>

      <div style="background:#1E293B;border:1px solid #334155;border-top:4px solid #DC2626;padding:20px;border-radius:12px;">
        <div style="font-size:12px;color:#F87171;font-weight:700;text-transform:uppercase;">Căn Hộ Dual Key 1+1</div>
        <div style="font-size:22px;font-weight:800;color:#F87171;margin:6px 0;">88.5 – 122.2 m²</div>
        <div style="font-size:13px;color:#CBD5E1;line-height:1.5;">Gồm các mã căn: <strong>S-02</strong> (88.5m²), <strong>S-03A</strong> (122.2m²). 1 cửa vào chia 2 căn khép kín sinh lời kép.</div>
      </div>

      <div style="background:#1E293B;border:1px solid #334155;border-top:4px solid #991B1B;padding:20px;border-radius:12px;">
        <div style="font-size:12px;color:#EF4444;font-weight:700;text-transform:uppercase;">Căn Hộ Dual Key 2+1</div>
        <div style="font-size:22px;font-weight:800;color:#EF4444;margin:6px 0;">159.4 m²</div>
        <div style="font-size:13px;color:#CBD5E1;line-height:1.5;">Gồm các mã căn góc VIP: <strong>S-03</strong> và <strong>S-09</strong> (159.4m²). Đỉnh cao căn góc 2 mặt thoáng view hồ Cầu Giấy.</div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: ĐỘT PHÁ CĂN HỘ DUAL KEY -->
<section id="can-ho-dual-key" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div class="kbds-2col-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:45px;align-items:center;">
      <div>
        <div style="font-size:13px;font-weight:800;color:#DC2626;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px;">MÔ HÌNH BẤT ĐỘNG SẢN TƯƠNG LAI</div>
        <h2 style="font-size:32px;font-weight:900;color:#0F172A;line-height:1.3;margin-bottom:20px;">
          ĐỘT PHÁ CĂN HỘ DUAL KEY: “VỪA Ở VỪA CHO THUÊ KHÉP KÍN”
        </h2>
        <p style="font-size:15px;color:#475569;line-height:1.7;margin-bottom:20px;">
          Tại Hinode Solera Phạm Hùng, dòng sản phẩm <strong>Dual Key (1+1 và 2+1)</strong> với diện tích từ 88.5m² đến 159.4m² là bước đột phá kiến trúc độc quyền:
        </p>
        <div style="display:flex;flex-direction:column;gap:16px;">
          <div style="display:flex;gap:14px;background:#FEF2F2;border:1px solid #FEE2E2;padding:16px;border-radius:12px;">
            <div style="font-size:24px;">🔑</div>
            <div>
              <div style="font-weight:800;font-size:15px;color:#991B1B;">1 Cửa Chung – 2 Không Gian Biệt Lập</div>
              <div style="font-size:13.5px;color:#7F1D1D;line-height:1.5;margin-top:4px;">Chủ sở hữu có thể ở một căn và cho chuyên gia nước ngoài thuê căn còn lại mà không hề ảnh hưởng đến sự riêng tư của gia đình.</div>
            </div>
          </div>
          <div style="display:flex;gap:14px;background:#FEF3C7;border:1px solid #FDE68A;padding:16px;border-radius:12px;">
            <div style="font-size:24px;">💰</div>
            <div>
              <div style="font-weight:800;font-size:15px;color:#92400E;">Tối Đa Hóa Doanh Thu Cho Thuê (Airbnb / Chuyên gia)</div>
              <div style="font-size:13.5px;color:#78350F;line-height:1.5;margin-top:4px;">Doanh thu cho thuê 2 căn hộ riêng biệt luôn cao hơn từ 25% – 35% so với việc cho thuê 1 căn hộ 3 phòng ngủ truyền thống.</div>
            </div>
          </div>
          <div style="display:flex;gap:14px;background:#F0FDF4;border:1px solid #DCFCE7;padding:16px;border-radius:12px;">
            <div style="font-size:24px;">👨‍👩‍👧‍👦</div>
            <div>
              <div style="font-weight:800;font-size:15px;color:#166534;">Tổ Ấm Hoàn Hảo Cho Gia Đình Đa Thế Hệ</div>
              <div style="font-size:13.5px;color:#14532D;line-height:1.5;margin-top:4px;">Ông bà và con cháu sống chung dưới một mái nhà nhưng vẫn giữ được nếp sinh hoạt độc lập, ấm cúng và trọn vẹn hiếu thuận.</div>
            </div>
          </div>
        </div>
      </div>

      <div style="background:#F8FAFC;padding:32px;border-radius:20px;border:1px solid #E2E8F0;text-align:center;">
        <div style="font-size:14px;font-weight:800;color:#0F172A;text-transform:uppercase;margin-bottom:14px;">BẢNG SO SÁNH HIỆU QUẢ ĐẦU TƯ CĂN DUAL KEY</div>
        <table style="width:100%;border-collapse:collapse;font-size:13.5px;margin-bottom:20px;">
          <thead>
            <tr style="background:#0F172A;color:#fff;">
              <th style="padding:10px;text-align:left;border-radius:8px 0 0 8px;">Tiêu chí</th>
              <th style="padding:10px;text-align:center;">Căn hộ thường</th>
              <th style="padding:10px;text-align:center;background:#D97706;border-radius:0 8px 8px 0;">Căn Dual Key Hinode</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 10px;text-align:left;font-weight:600;">Dòng tiền khai thác</td>
              <td style="padding:12px 10px;text-align:center;">1 nguồn đơn</td>
              <td style="padding:12px 10px;text-align:center;font-weight:700;color:#D97706;">2 dòng tiền độc lập</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 10px;text-align:left;font-weight:600;">Tính linh hoạt</td>
              <td style="padding:12px 10px;text-align:center;">Chỉ để ở hoặc cho thuê</td>
              <td style="padding:12px 10px;text-align:center;font-weight:700;color:#D97706;">Vừa ở vừa cho thuê</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:12px 10px;text-align:left;font-weight:600;">Tỷ suất lợi nhuận</td>
              <td style="padding:12px 10px;text-align:center;">5% - 6%/năm</td>
              <td style="padding:12px 10px;text-align:center;font-weight:700;color:#D97706;">8.5% - 11%/năm</td>
            </tr>
            <tr>
              <td style="padding:12px 10px;text-align:left;font-weight:600;">Thanh khoản</td>
              <td style="padding:12px 10px;text-align:center;">Trung bình</td>
              <td style="padding:12px 10px;text-align:center;font-weight:700;color:#D97706;">Rất cao (hàng hiếm)</td>
            </tr>
          </tbody>
        </table>
        <a href="#dang-ky" style="background:#0F172A;color:#FDE68A;display:inline-block;padding:12px 24px;border-radius:10px;font-weight:700;text-decoration:none;font-size:14px;">Nhận Phân Tích Dòng Tiền Dual Key</a>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 8: TIN TỨC & BÀI VIẾT VỆ TINH DỰ ÁN (#tin-tuc-du-an) -->
[kbds_project_news limit="12"]

<!-- SECTION 9: FORM ĐĂNG KÝ BẢNG GIÁ & TƯ VẤN -->
<section id="dang-ky" style="padding:85px 0;background:linear-gradient(135deg,#0F172A 0%,#1E293B 100%);color:#fff;">
  <div class="kbds-container" style="max-width:850px;">
    <div style="background:#1E293B;border:2px solid #D97706;border-radius:24px;padding:45px 35px;box-shadow:0 25px 60px rgba(0,0,0,0.5);text-align:center;">
      <div style="display:inline-block;background:#D97706;color:#0F172A;font-weight:800;font-size:12px;padding:5px 14px;border-radius:20px;text-transform:uppercase;margin-bottom:14px;">BẢNG GIÁ ĐỢT 1 TỪ CHỦ ĐẦU TƯ</div>
      <h2 style="font-size:30px;font-weight:900;color:#FFFFFF;margin-bottom:12px;">ĐĂNG KÝ NHẬN THÔNG TIN & BẢNG GIÁ HINODE SOLERA</h2>
      <p style="font-size:15px;color:#CBD5E1;max-width:620px;margin:0 auto 28px;line-height:1.6;">Để lại thông tin chính xác dưới đây để nhận trọn bộ tài liệu thiết kế chi tiết 16 căn hộ, bảng giá gốc đợt 1 và chính sách ưu đãi tài chính tốt nhất.</p>

      [kbds_lead_form title="" project="Chung Cư Hinode Solera Phạm Hùng" button_text="Gửi Yêu Cầu Nhận Báo Giá & Chính Sách Đợt 1 ➔"]
    </div>
  </div>
</section>
HTML;

// 3. TẠO HOẶC CẬP NHẬT POST DỰ ÁN (du_an)
$proj_slug = 'hinode-solera-pham-hung';
$existing_proj = get_posts([
    'post_type' => 'du_an',
    'name' => $proj_slug,
    'posts_per_page' => 1,
    'post_status' => 'any'
]);

$proj_data = [
    'post_title'   => 'Chung Cư Hinode Solera Phạm Hùng (Hinode Suite 28 Phạm Hùng)',
    'post_name'    => $proj_slug,
    'post_content' => $landing_html,
    'post_status'  => 'publish',
    'post_type'    => 'du_an',
    'post_excerpt' => 'Dự án Hinode Solera số 28 Phạm Hùng (Nam Từ Liêm, Hà Nội) do WTO phát triển. Tọa độ kim cương trực diện hồ Cầu Giấy 32ha, kề Keangnam & Skylake, đa dạng căn 1-3PN & Dual Key.'
];

if (!empty($existing_proj)) {
    $proj_id = $existing_proj[0]->ID;
    $proj_data['ID'] = $proj_id;
    wp_update_post($proj_data);
    echo "✔ Đã cập nhật Dự án [Hinode Solera Phạm Hùng] (ID: {$proj_id})\n";
} else {
    $proj_id = wp_insert_post($proj_data);
    echo "✔ Đã tạo mới Dự án [Hinode Solera Phạm Hùng] (ID: {$proj_id})\n";
}

// Gắn Thumbnail
set_post_thumbnail($proj_id, $m['phoi_canh_toa_thap']['id']);

// Gắn Taxonomies
wp_set_object_terms($proj_id, 'ha-noi', 'khu_vuc_bds');
wp_set_object_terms($proj_id, 'can-ho-chung-cu', 'loai_hinh_bds');
wp_set_object_terms($proj_id, 'dang-mo-ban', 'trang_thai_du_an');
wp_set_object_terms($proj_id, 'wto-vietracimex', 'chu_dau_tu');

// Gắn Meta
update_post_meta($proj_id, '_kbds_price', 'Đang cập nhật đợt 1');
update_post_meta($proj_id, '_kbds_area', '4.824 m²');
update_post_meta($proj_id, '_kbds_location', 'Số 28 Phạm Hùng, P. Mỹ Đình 1, Q. Nam Từ Liêm, Hà Nội');
update_post_meta($proj_id, '_kbds_developer', 'Tập đoàn WTO (Vietracimex)');
update_post_meta($proj_id, 'rank_math_title', 'Chung Cư Hinode Solera Phạm Hùng – 28 Phạm Hùng Trực Diện Hồ Cầu Giấy');
update_post_meta($proj_id, 'rank_math_description', 'Bảng giá & Mặt bằng Chung cư Hinode Solera số 28 Phạm Hùng (WTO). Căn hộ 1-3PN và Dual Key cao cấp đối diện công viên hồ điều hòa Cầu Giấy 32ha.');
update_post_meta($proj_id, 'rank_math_focus_keyword', 'Hinode Solera Phạm Hùng, Hinode Suite 28 Phạm Hùng, chung cư Hinode Phạm Hùng');


// 4. DANH SÁCH 5 BÀI VIẾT VỆ TINH CHUẨN SEO TOPIC CLUSTER
$satellites = [
    [
        'title' => 'Vị Trí Dự Án Hinode Solera 28 Phạm Hùng: Tọa Độ Kim Cương Đối Diện Công Viên Hồ Cầu Giấy 32ha',
        'slug'  => 'vi-tri-du-an-hinode-solera-pham-hung',
        'cat'   => 'quy-hoach-ha-tang',
        'cat_id'=> 3,
        'thumb' => $m['vi_tri_ho_cau_giay']['id'],
        'seo_focus' => 'vị trí Hinode Solera Phạm Hùng',
        'seo_desc' => 'Phân tích chi tiết vị trí dự án Hinode Solera tại số 28 Phạm Hùng: Tọa độ kim cương trực diện hồ Cầu Giấy 32ha, kề cận Keangnam Landmark 72 và Vinhomes Skylake.',
        'content' => <<<HTML
<p><strong>Vị trí dự án Hinode Solera số 28 Phạm Hùng</strong> (còn được biết đến với tên gọi Hinode Suite Phạm Hùng) tọa lạc ngay tại trung tâm hành chính – kinh tế mới Mỹ Đình (quận Nam Từ Liêm, Hà Nội). Đây được xem là một trong những mảnh đất "vàng mười" hiếm hoi còn lại trên tuyến đại lộ huyết mạch Vành đai 3 trên cao.</p>

<h2>1. Tọa Độ Đắt Giá Số 28 Phạm Hùng – Trung Tâm Trục Giao Thừa Tây Hà Nội</h2>
<p>Dự án nằm tại số 28 đường Phạm Hùng, phường Mỹ Đình 1, quận Nam Từ Liêm, TP. Hà Nội. Trục đường Phạm Hùng là tuyến giao thông đối ngoại xương sống kết nối khu vực phía Tây với sân bay quốc tế Nội Bài, trung tâm lõi Ba Đình – Hoàn Kiếm và các tỉnh công nghiệp phía Bắc.</p>

<p style="text-align:center;">
  <img src="{$m['vi_tri_ho_cau_giay']['url']}" alt="{$m['vi_tri_ho_cau_giay']['alt']}" style="width:100%;max-width:850px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Hình ảnh thực tế: Vị trí Hinode Solera 28 Phạm Hùng nhìn từ công viên hồ điều hòa Cầu Giấy 32ha, kề cận Keangnam và Skylake.</span>
</p>

<h2>2. Trực Diện Công Viên Hồ Điều Hòa Cầu Giấy 32ha: Giá Trị Phong Thủy & Sinh Thái Triệu Đô</h2>
<p>Điểm nhấn đắt giá nhất của <a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a> chính là tầm nhìn trực diện và hưởng trọn không gian xanh sinh thái từ <strong>Công viên hồ điều hòa Cầu Giấy rộng 32ha</strong> (trong đó diện tích mặt nước hồ điều hòa lên tới 19ha). Trong bối cảnh quỹ đất trung tâm nội đô ngày càng ngột ngạt, việc sở hữu căn hộ view hồ nước rộng lớn không chỉ mang đến nguồn không khí thanh mát, vượng khí tài lộc mà còn đảm bảo giá trị gia tăng bất động sản bền vững theo thời gian.</p>

<h2>3. Kết Nối Vùng Hoàn Hảo Trong Bán Kính 500m – 2km</h2>
<ul>
  <li><strong>Kế cận tổ hợp cao cấp:</strong> Nằm đối diện tổ hợp Vinhomes Skylake, kề cận Keangnam Landmark 72 và quần thể KĐT cao cấp Sudico Mễ Trì – The Manor.</li>
  <li><strong>Giao thông vận tải:</strong> Cách Bến xe Mỹ Đình chỉ 500m, dễ dàng tiếp cận tuyến đường sắt đô thị Metro, đường Vành đai 3 trên cao và trục Đại lộ Thăng Long.</li>
  <li><strong>Trung tâm hành chính quốc gia:</strong> Cách Trung tâm Hội nghị Quốc gia, Bảo tàng Hà Nội, Sân vận động Mỹ Đình chỉ 5 - 7 phút di chuyển.</li>
  <li><strong>Hệ thống giáo dục tinh hoa:</strong> Gần các trường học danh tiếng như Trường Marie Curie, Lomonoxop, Amsterdam, Đại học Quốc Gia Hà Nội, Đại học Sư Phạm.</li>
</ul>

<h2>4. Tiềm Năng Khai Thác Cho Thuê Hấp Dẫn Dành Cho Chuyên Gia Quốc Tế</h2>
<p>Khu vực Mỹ Đình - Mễ Trì - Phạm Hùng từ lâu đã là "thủ phủ" sinh sống và làm việc của cộng đồng hơn 30.000 chuyên gia Hàn Quốc, Nhật Bản và các kỹ sư cấp cao. Với vị trí đối diện hồ nước và đầy đủ dịch vụ 5 sao, Hinode Solera Phạm Hùng hứa hẹn mang lại tỷ suất khai thác cho thuê đạt từ 7% - 9%/năm, thanh khoản cực kỳ ấn tượng.</p>
HTML
    ],

    [
        'title' => 'Mặt Bằng Tầng Điển Hình Dự Án Hinode Solera Phạm Hùng: Chi Tiết Thiết Kế 16 Căn/Tầng Đa Dạng Diện Tích',
        'slug'  => 'mat-bang-du-an-hinode-solera-pham-hung',
        'cat'   => 'review-du-an',
        'cat_id'=> 2,
        'thumb' => $m['mat_bang_dien_hinh']['id'],
        'seo_focus' => 'mặt bằng Hinode Solera Phạm Hùng',
        'seo_desc' => 'Khám phá mặt bằng tầng điển hình 16 căn/sàn tại chung cư Hinode Solera Phạm Hùng: Cơ cấu diện tích 54.3m² – 159.4m² từ 1PN, 2PN, 3PN đến căn hộ Dual Key độc bản.',
        'content' => <<<HTML
<p><strong>Mặt bằng tầng điển hình dự án Hinode Solera Phạm Hùng</strong> gây ấn tượng mạnh mẽ trong giới đầu tư nhờ mật độ bố trí cực kỳ thông thoáng: chỉ <strong>16 căn hộ trên một mặt sàn</strong>, phục vụ bởi hệ thống thang máy tốc độ cao và sảnh hành lang rộng rãi chuẩn phong cách khách sạn 5 sao.</p>

<p style="text-align:center;">
  <img src="{$m['mat_bang_dien_hinh']['url']}" alt="{$m['mat_bang_dien_hinh']['alt']}" style="width:100%;max-width:900px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Sơ đồ mặt bằng tầng điển hình 16 căn hộ tại dự án Hinode Solera số 28 Phạm Hùng (Nam Từ Liêm, Hà Nội).</span>
</p>

<h2>1. Tổng Quan Cơ Cấu Căn Hộ Trên Một Mặt Sàn</h2>
<p>Mặt bằng tầng căn hộ tại <a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a> được phân chia thông minh thành 5 loại hình chính:</p>
<table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:14.5px;">
  <thead>
    <tr style="background:#0F172A;color:#fff;">
      <th style="padding:12px;border:1px solid #CBD5E1;text-align:left;">Loại hình căn hộ</th>
      <th style="padding:12px;border:1px solid #CBD5E1;text-align:center;">Mã căn trên sàn</th>
      <th style="padding:12px;border:1px solid #CBD5E1;text-align:center;">Diện tích thông thủy</th>
      <th style="padding:12px;border:1px solid #CBD5E1;text-align:left;">Đặc điểm nổi bật</th>
    </tr>
  </thead>
  <tbody>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:12px;font-weight:700;">Căn hộ 1 Phòng Ngủ</td>
      <td style="padding:12px;text-align:center;">S-06, S-01, S-11, S-12, S-15</td>
      <td style="padding:12px;text-align:center;font-weight:700;color:#D97706;">54.3 – 57.1 m²</td>
      <td style="padding:12px;">Thiết kế vuông vắn, phòng khách thoáng, thích hợp cho chuyên gia & đầu tư cho thuê.</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:12px;font-weight:700;">Căn hộ 2 Phòng Ngủ</td>
      <td style="padding:12px;text-align:center;">S-10, S-05, S-07, S-12A, S-12B</td>
      <td style="padding:12px;text-align:center;font-weight:700;color:#D97706;">87.7 – 88.3 m²</td>
      <td style="padding:12px;">2 phòng ngủ rộng, 2 phòng vệ sinh, ban công phòng khách đón gió mát tự nhiên.</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:12px;font-weight:700;">Căn hộ 3 Phòng Ngủ</td>
      <td style="padding:12px;text-align:center;">S-08</td>
      <td style="padding:12px;text-align:center;font-weight:700;color:#D97706;">122.7 m²</td>
      <td style="padding:12px;">Không gian sinh hoạt đẳng cấp, ban công trải dài ngắm trọn công viên hồ Cầu Giấy 32ha.</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:12px;font-weight:700;">Căn hộ Dual Key 1+1</td>
      <td style="padding:12px;text-align:center;">S-02, S-03A</td>
      <td style="padding:12px;text-align:center;font-weight:700;color:#DC2626;">88.5 – 122.2 m²</td>
      <td style="padding:12px;">Mô hình 2 chìa khóa riêng biệt, tối ưu hóa công năng vừa ở vừa khai thác cho thuê.</td>
    </tr>
    <tr>
      <td style="padding:12px;font-weight:700;">Căn hộ Dual Key 2+1</td>
      <td style="padding:12px;text-align:center;">S-03, S-09</td>
      <td style="padding:12px;text-align:center;font-weight:700;color:#991B1B;">159.4 m²</td>
      <td style="padding:12px;">Căn góc VIP diện tích lớn nhất sàn, 2 mặt thoáng view hồ điều hòa và đại lộ Phạm Hùng.</td>
    </tr>
  </tbody>
</table>

<h2>2. Điểm Nhấn Kiến Trúc Tối Ưu Ánh Sáng Tự Nhiên</h2>
<p>Nhờ thiết kế hình khối thông minh, 100% các căn hộ tại Hinode Solera đều được tiếp xúc trực tiếp với ánh sáng tự nhiên. Các căn mặt trước hướng trực diện đường Phạm Hùng và công viên hồ điều hòa Cầu Giấy, các căn mặt sau nhìn về không gian đô thị thoáng đãng của khu vực Mỹ Đình.</p>
HTML
    ],

    [
        'title' => 'Đột Phá Thiết Kế Căn Hộ Dual Key Hinode Solera Phạm Hùng: Giải Pháp Vừa Ở Vừa Khai Thác Cho Thuê Kép',
        'slug'  => 'thiet-ke-can-ho-dual-key-hinode-solera-pham-hung',
        'cat'   => 'review-du-an',
        'cat_id'=> 2,
        'thumb' => $m['phoi_canh_toa_thap']['id'],
        'seo_focus' => 'căn hộ Dual Key Hinode Solera Phạm Hùng',
        'seo_desc' => 'Đánh giá chi tiết mô hình căn hộ Dual Key 1+1 và 2+1 tại dự án Hinode Solera Phạm Hùng: Lợi thế nhân đôi dòng tiền cho thuê và không gian sống đa thế hệ lý tưởng.',
        'content' => <<<HTML
<p>Trong số các dòng căn hộ cao cấp tại dự án <a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a>, dòng sản phẩm <strong>Căn hộ Dual Key (căn hộ 2 chìa khóa)</strong> với diện tích từ 88.5m² đến 159.4m² đang trở thành tâm điểm thu hút các nhà đầu tư sành sỏi.</p>

<p style="text-align:center;">
  <img src="{$m['phoi_canh_toa_thap']['url']}" alt="{$m['phoi_canh_toa_thap']['alt']}" style="width:100%;max-width:800px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Phối cảnh tòa tháp căn hộ hạng sang Hinode Solera Phạm Hùng sở hữu dòng sản phẩm Dual Key thời thượng.</span>
</p>

<h2>1. Khái Niệm Căn Hộ Dual Key & Cơ Chế Hoạt Động</h2>
<p>Căn hộ Dual Key sở hữu một cửa chính ra vào dẫn vào tiền sảnh chung. Từ tiền sảnh này sẽ phân tách ra 2 cánh cửa dẫn vào 2 căn hộ hoàn toàn độc lập, mỗi căn đều sở hữu đầy đủ không gian: phòng khách, phòng ngủ, khu bếp nấu và phòng vệ sinh khép kín.</p>

<h2>2. Hai Biến Thể Dual Key Tại Hinode Solera</h2>
<ul>
  <li><strong>Căn hộ Dual Key 1+1 (Căn S-02 diện tích 88.5m² & Căn S-03A diện tích 122.2m²):</strong> Chia thành 2 căn hộ 1 phòng ngủ độc lập, cực kỳ phù hợp cho thuê ngắn ngày (Airbnb) hoặc cho 2 chuyên gia độc thân thuê cùng lúc.</li>
  <li><strong>Căn hộ Dual Key 2+1 (Căn S-03 & S-09 diện tích 159.4m²):</strong> Là 2 căn góc lớn nhất tầng, chia thành 1 căn hộ 2 phòng ngủ rộng rãi và 1 căn hộ Studio/1PN cao cấp.</li>
</ul>

<h2>3. Bài Toán Đầu Tư: Nhân Đôi Doanh Thu Khai Thác Cho Thuê</h2>
<p>Với vị trí nằm ngay trung tâm cộng đồng Hàn Quốc tại Mỹ Đình, nhu cầu thuê căn hộ khép kín, tiện nghi cao cấp luôn ở mức cao kỷ lục. Thay vì cho thuê 1 căn hộ 3PN với mức giá khoảng 25 - 30 triệu/tháng, căn Dual Key có thể khai thác độc lập:</p>
<ul>
  <li>Căn 2PN cho thuê dài hạn: 20 - 25 triệu/tháng.</li>
  <li>Căn 1PN cho thuê chuyên gia ngắn hạn: 14 - 18 triệu/tháng.</li>
  <li><strong>Tổng thu nhập ước tính:</strong> 34 - 43 triệu/tháng (tăng 30% - 40% so với căn thông thường).</li>
</ul>
HTML
    ],

    [
        'title' => 'Hệ Thống Tiện Ích Đẳng Cấp Tại Chung Cư Hinode Solera Phạm Hùng: Chuẩn Sống Nghỉ Dưỡng Ngay Cửa Ngõ Phía Tây',
        'slug'  => 'tien-ich-chung-cu-hinode-solera-pham-hung',
        'cat'   => 'review-du-an',
        'cat_id'=> 2,
        'thumb' => $m['phoi_canh_toa_thap']['id'],
        'seo_focus' => 'tiện ích Hinode Solera Phạm Hùng',
        'seo_desc' => 'Khám phá hệ sinh thái tiện ích chuẩn 5 sao tại chung cư Hinode Solera 28 Phạm Hùng: Bể bơi bốn mùa, 5 tầng TTTM, Sky Garden và sảnh đón Marble sang trọng.',
        'content' => <<<HTML
<p>Không chỉ sở hữu vị trí đắt giá trên mặt đường Phạm Hùng, <strong>dự án chung cư Hinode Solera Phạm Hùng</strong> còn được chủ đầu tư WTO kiến tạo theo chuẩn mực sống nghỉ dưỡng thượng lưu, đáp ứng trọn vẹn mọi nhu cầu khắt khe của cộng đồng cư dân tinh hoa.</p>

<p style="text-align:center;">
  <img src="{$m['phoi_canh_toa_thap']['url']}" alt="{$m['phoi_canh_toa_thap']['alt']}" style="width:100%;max-width:800px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Tòa tháp Hinode Solera Phạm Hùng với 5 tầng khối đế thương mại và dịch vụ cao cấp.</span>
</p>

<h2>1. Khối Đế Thương Mại 5 Tầng Sầm Uất</h2>
<p>Từ tầng 1 đến tầng 5 của tòa tháp được quy hoạch thành trung tâm thương mại và dịch vụ cao cấp bao gồm:</p>
<ul>
  <li>Sảnh đón Grand Lobby cao rộng, ốp đá cẩm thạch sang trọng mang phong cách khách sạn quốc tế.</li>
  <li>Hệ thống cửa hàng mua sắm, siêu thị thực phẩm nhập khẩu tiện lợi.</li>
  <li>Chuỗi nhà hàng ẩm thực Á – Âu, nhà hàng phong cách Nhật Bản và quán cafe sang trọng.</li>
</ul>

<h2>2. Bể Bơi Bốn Mùa & Trung Tâm Chăm Sóc Sức Khỏe</h2>
<p>Cư dân <a href="/du-an/hinode-solera-pham-hung/">Hinode Solera</a> sẽ được tận hưởng bể bơi bốn mùa nước ấm trong nhà, phòng tập Gym & Yoga hiện đại với máy móc ngoại nhập cùng khu xông hơi thư giãn, giúp giải tỏa căng thẳng sau những giờ làm việc mệt mỏi.</p>

<h2>3. Hệ Thống 3 Tầng Hầm Đỗ Xe Thông Minh</h2>
<p>Tại khu vực trung tâm Mỹ Đình – nơi tình trạng thiếu hụt chỗ đỗ xe luôn là nỗi lo thường trực, Hinode Solera sở hữu tới 3 tầng hầm đỗ xe thông minh, đảm bảo đáp ứng đầy đủ chỗ đỗ xe ô tô và xe máy cho từng căn hộ của cư dân.</p>
HTML
    ],

    [
        'title' => 'Dấu Ấn Chủ Đầu Tư WTO & Chuỗi Thương Hiệu Hinode Tại Tòa Tháp Hạng Sang 28 Phạm Hùng',
        'slug'  => 'chu-dau-tu-wto-hinode-solera-pham-hung',
        'cat'   => 'review-du-an',
        'cat_id'=> 2,
        'thumb' => $m['phoi_canh_toa_thap']['id'],
        'seo_focus' => 'chủ đầu tư WTO Hinode Solera Phạm Hùng',
        'seo_desc' => 'Tìm hiểu uy tín và tiềm lực của chủ đầu tư WTO (Vietracimex) cùng dấu ấn thành công của dòng sản phẩm Hinode tại tòa tháp căn hộ Hinode Solera số 28 Phạm Hùng.',
        'content' => <<<HTML
<p>Được phát triển bởi <strong>Tập đoàn WTO (Tổng công ty CP Thương mại Xây dựng - tiền thân là Vietracimex)</strong>, dự án <strong>Hinode Solera Phạm Hùng</strong> tiếp nối tinh hoa từ chuỗi bất động sản mang thương hiệu "Hinode" vốn đã tạo dựng tiếng vang lớn tại thị trường thủ đô.</p>

<p style="text-align:center;">
  <img src="{$m['phoi_canh_toa_thap']['url']}" alt="{$m['phoi_canh_toa_thap']['alt']}" style="width:100%;max-width:800px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Dự án Hinode Solera Phạm Hùng mang dấu ấn kiến trúc tinh tế và chuẩn mực thi công từ Tập đoàn WTO.</span>
</p>

<h2>1. Về Tập Đoàn WTO (Vietracimex)</h2>
<p>Thành lập từ năm 1961, với hơn 60 năm hình thành và phát triển vững chắc, WTO là một trong những tập đoàn kinh tế đa ngành hàng đầu Việt Nam, hoạt động nổi bật trong các lĩnh vực: Bất động sản, Năng lượng tái tạo (thủy điện, điện mặt trời, điện gió), Sản xuất công nghiệp và Thi công hạ tầng.</p>

<h2>2. Chuỗi Dự Án Mang Thương Hiệu "Hinode" Trứ Danh</h2>
<ul>
  <li><strong>Hinode City (201 Minh Khai, Hà Nội):</strong> Biểu tượng phong cách Nhật Bản trung tâm quận Hai Bà Trưng, mang đến không gian sống an yên, tỉ mỉ và đẳng cấp.</li>
  <li><strong>Hinode Royal Park (Kim Chung - Di Trạch, Hoài Đức):</strong> Đại đô thị 146ha với hồ trung tâm 6ha cùng phân khu cao tầng The Wisteria được thị trường đón nhận nồng nhiệt.</li>
  <li><strong>Hinode Solera (28 Phạm Hùng):</strong> Kiệt tác căn hộ hạng sang giới hạn chỉ khoảng 300 căn nằm trên trục đại lộ vàng Vành đai 3, khẳng định vị thế đỉnh cao của WTO tại phân khúc căn hộ cao cấp nội đô.</li>
</ul>

<h2>3. Cam Kết Tiến Độ & Pháp Lý Minh Bạch</h2>
<p>Với tiềm lực tài chính hùng mạnh, WTO cam kết bàn giao các căn hộ <a href="/du-an/hinode-solera-pham-hung/">Hinode Solera</a> đúng chất lượng cam kết, pháp lý hoàn chỉnh với hình thức sở hữu lâu dài, đem lại sự an tâm tuyệt đối cho khách hàng an cư lẫn các nhà đầu tư chiến lược.</p>
HTML
    ]
];

// 5. TẠO CÁC BÀI VIẾT VỆ TINH
foreach ($satellites as $idx => $sat) {
    $existing = get_posts([
        'post_type' => 'post',
        'name' => $sat['slug'],
        'posts_per_page' => 1,
        'post_status' => 'any'
    ]);

    $post_data = [
        'post_title'   => $sat['title'],
        'post_name'    => $sat['slug'],
        'post_content' => $sat['content'],
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'post_excerpt' => $sat['seo_desc']
    ];

    if (!empty($existing)) {
        $p_id = $existing[0]->ID;
        $post_data['ID'] = $p_id;
        wp_update_post($post_data);
        echo " ✔ Cập nhật Bài viết [{$sat['title']}] (ID: {$p_id})\n";
    } else {
        $p_id = wp_insert_post($post_data);
        echo " + Tạo mới Bài viết [{$sat['title']}] (ID: {$p_id})\n";
    }

    // Set Featured Image
    set_post_thumbnail($p_id, $sat['thumb']);

    // Set Category (Loại bỏ Chưa phân loại)
    wp_set_post_categories($p_id, [$sat['cat_id']]);

    // Gắn Meta _kbds_project_ref liên kết ngược về trang dự án Hub
    update_post_meta($p_id, '_kbds_project_ref', $proj_id);
    update_post_meta($p_id, '_kbds_project_slug', $proj_slug);

    // Rank Math SEO
    update_post_meta($p_id, 'rank_math_title', $sat['title']);
    update_post_meta($p_id, 'rank_math_description', $sat['seo_desc']);
    update_post_meta($p_id, 'rank_math_focus_keyword', $sat['seo_focus']);
}

echo "\n🎉 HOÀN TẤT XÂY DỰNG TOÀN BỘ TRANG DỰ ÁN & 5 BÀI VIẾT VỆ TINH!\n";
