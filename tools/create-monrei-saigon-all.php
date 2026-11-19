<?php
/**
 * Tạo trọn gói Trang Dự Án Monrei Saigon + 5 Bài viết vệ tinh chuẩn SEO Topic Cluster
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU XÂY DỰNG TRANG DỰ ÁN MONREI SAIGON (BÌNH DƯƠNG)\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/monrei-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/monrei-media-map.json. Hãy chạy tools/import-monrei-saigon.php trước!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// 1. Tạo Term Chủ đầu tư nếu chưa có
if (!term_exists('Mitsubishi Corporation', 'chu_dau_tu')) {
    wp_insert_term('Mitsubishi Corporation', 'chu_dau_tu', [
        'slug' => 'mitsubishi-corporation',
        'description' => 'Tập đoàn đa quốc gia hàng đầu Nhật Bản - Cổ đông lớn nhất nắm giữ 56% dự án Monrei Saigon'
    ]);
    echo " + Đã tạo term Chủ đầu tư: Mitsubishi Corporation\n";
}
if (!term_exists('Phát Đạt', 'chu_dau_tu')) {
    wp_insert_term('Phát Đạt', 'chu_dau_tu', [
        'slug' => 'phat-dat',
        'description' => 'Công ty Cổ phần Phát triển Bất động sản Phát Đạt (PDR)'
    ]);
    echo " + Đã tạo term Chủ đầu tư: Phát Đạt\n";
}

// 2. SOẠN NỘI DUNG LANDING PAGE 10 SECTION CHUẨN UX CHO MONREI SAIGON
$landing_html = <<<HTML
<!-- SUBNAV ĐIỀU HƯỚNG DỰ ÁN MONREI SAIGON -->
<div class="kbds-project-subnav">
  <div class="kbds-container kbds-subnav-container">
    <div class="kbds-subnav-brand">
      <span class="kbds-subnav-dot" style="background:#0284C7;box-shadow:0 0 10px #0284C7"></span>
      MONREI SAIGON
    </div>
    <a href="#dang-ky" class="kbds-subnav-cta" style="background:linear-gradient(135deg,#0284C7,#0369A1);box-shadow:0 4px 12px rgba(2,132,199,0.35)">Nhận Báo Giá Gốc</a>
    <nav class="kbds-subnav-links">
      <a href="#tong-quan" class="kbds-subnav-link">Tổng Quan</a>
      <a href="#vi-tri" class="kbds-subnav-link">Vị Trí Cửa Ngõ</a>
      <a href="#thuy-lieu" class="kbds-subnav-link">Thành Phố Thủy Liệu</a>
      <a href="#onsen-sento" class="kbds-subnav-link">Onsen &amp; Sento</a>
      <a href="#aqua-massage" class="kbds-subnav-link">Aqua Massage Bed</a>
      <a href="#tien-ich-kodomo" class="kbds-subnav-link">Sân Chơi Kodomo</a>
      <a href="#tien-do" class="kbds-subnav-link">Tiến Độ Thực Tế</a>
      <a href="#tin-tuc-du-an" class="kbds-subnav-link">Tin Tức Đánh Giá</a>
    </nav>
  </div>
</div>

<!-- SECTION 1: HERO BANNER -->
<section style="position:relative;background:linear-gradient(135deg,#031B33 0%,#0B3B60 50%,#0284C7 100%);color:#fff;padding:80px 0 100px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.18;background:radial-gradient(circle at 75% 25%,#38BDF8 0%,transparent 60%);pointer-events:none;"></div>
  <div class="kbds-container" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:40px;align-items:center;">
    <div>
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(56,189,248,0.2);border:1px solid rgba(56,189,248,0.4);color:#BAE6FD;padding:6px 16px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;">
        🇯🇵 LIÊN DANH MITSUBISHI CORPORATION & PHÁT ĐẠT
      </div>
      <h1 style="color:#FFFFFF;font-size:42px;font-weight:900;line-height:1.2;margin:0 0 18px;">
        MONREI SAIGON
        <span style="display:block;font-size:24px;font-weight:600;color:#38BDF8;margin-top:6px;">Thành Phố Thủy Liệu Nhật Bản Đầu Tiên Tại Việt Nam</span>
      </h1>
      <p style="color:#E2E8F0;font-size:16.5px;line-height:1.7;margin:0 0 28px;max-width:620px;">
        Tọa lạc tại mặt tiền Nguyễn Thị Minh Khai, cửa ngõ TP. Thuận An liền kề TP.HCM. <strong>Monrei Saigon</strong> là biểu tượng sống đỉnh cao mang tiêu chuẩn khắt khe Nhật Bản với hệ sinh thái thủy liệu khoáng nóng Onsen, bể sục Sento, dòng sông lười resort và thác nước mây mưa độc bản.
      </p>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:30px;">
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#38BDF8;">4,46 ha</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Quy mô đại đô thị</div>
        </div>
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#FDBA74;">6 Tòa 39 Tầng</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Khoảng 6.000 căn hộ</div>
        </div>
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#4ADE80;">Mitsubishi</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Chủ đầu tư Nhật Bản 56%</div>
        </div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:#0284C7;color:#fff;font-weight:700;padding:14px 28px;border-radius:8px;text-decoration:none;box-shadow:0 6px 20px rgba(2,132,199,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Nhận Bảng Giá Đợt 1 & Chính Sách Gốc</span> →
        </a>
        <a href="#thuy-lieu" style="background:transparent;color:#fff;font-weight:600;padding:14px 24px;border-radius:8px;text-decoration:none;border:1px solid rgba(255,255,255,0.3);">
          Khám Phá Chuỗi Tiện Ích Thủy Liệu
        </a>
      </div>
    </div>
    <div style="position:relative;">
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.4);border:2px solid rgba(255,255,255,0.15);">
        <img src="{$m['song_luoi']['url']}" alt="{$m['song_luoi']['alt']}" style="width:100%;height:400px;object-fit:cover;display:block;" />
      </div>
      <div style="position:absolute;bottom:-18px;left:20px;right:20px;background:rgba(15,23,42,0.92);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.15);padding:14px 20px;border-radius:12px;color:#fff;display:flex;align-items:center;justify-content:space-between;">
        <div>
          <span style="font-size:11.5px;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Biểu tượng nghỉ dưỡng</span>
          <div style="font-size:15px;font-weight:700;color:#38BDF8;">Hồ Bơi Resort & Dòng Sông Lười Thủy Liệu</div>
        </div>
        <span style="background:#16A34A;color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:12px;">Chuẩn Nhật</span>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: BẢNG TỔNG QUAN HỒ SƠ DỰ ÁN -->
<section id="tong-quan" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="background:#E0F2FE;color:#0284C7;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Hồ sơ chính thức</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 10px;">TỔNG QUAN DỰ ÁN MONREI SAIGON</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Tổ hợp căn hộ cao cấp và trung tâm thương mại mang tầm vóc biểu tượng mới tại cửa ngõ Đông Bắc Sài Gòn</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:16px;padding:32px;">
      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tên thương mại:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:15px;">MONREI SAIGON</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Vị trí dự án:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Đường Nguyễn Thị Minh Khai, P. Thuận Giao, TP. Thuận An, Bình Dương (Kế cận QL13 & AEON Mall)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Chủ đầu tư:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:14.5px;">Liên danh Mitsubishi Corporation (56%), Tokyu Land (24%) & Phát Đạt (20%)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tổng vốn đầu tư:</span>
          <span style="flex:1;font-weight:700;color:#C2410C;font-size:14.5px;">Khoảng 18.000 Tỷ Đồng</span>
        </div>
        <div style="display:flex;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tổng thầu thi công:</span>
          <span style="flex:1;font-weight:700;color:#0284C7;font-size:14.5px;">Central Construction</span>
        </div>
      </div>

      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Quy mô dự án:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">4,46 ha gồm 6 tòa tháp cao 39 tầng</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Số lượng căn hộ:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:14.5px;">Khoảng 6.000 căn hộ cao cấp (1PN, 2PN, 3PN & Penthouse)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Mô hình định vị:</span>
          <span style="flex:1;font-weight:700;color:#0284C7;font-size:14.5px;">Thành phố Thủy liệu (Urban Hydrotherapy City)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Hình thức sở hữu:</span>
          <span style="flex:1;font-weight:700;color:#16A34A;font-size:14.5px;">Sở hữu lâu dài (Sổ hồng từng căn)</span>
        </div>
        <div style="display:flex;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tiến độ bàn giao:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Dự kiến Quý IV/2026 - 2027</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VỊ TRÍ CHIẾN LƯỢC CỬA NGÕ TP. THỦ ĐỨC & TP.HCM -->
<section id="vi-tri" style="padding:70px 0;background:#F1F5F9;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 40px;">
      <span style="background:#E0F2FE;color:#0284C7;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Vị trí vương giả</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 12px;">VỊ TRÍ CHIẾN LƯỢC TRÊN TRỤC ĐẠI LỘ TỶ ĐÔ QUỐC LỘ 13</h2>
      <p style="color:#475569;font-size:15px;margin:0;line-height:1.6;">
        Tọa lạc đắc địa tại mặt tiền đường Nguyễn Thị Minh Khai, giao cắt trực tiếp Quốc lộ 13 (Đại lộ Bình Dương đang mở rộng 8 làn xe), kế cận Vành Đai 3 và cách ranh giới TP. Thủ Đức chỉ vài phút di chuyển.
      </p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center;">
      <div style="border-radius:14px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.1);border:1px solid #CBD5E1;background:#fff;">
        <img src="{$m['tien_do_thuc_te']['url']}" alt="{$m['tien_do_thuc_te']['alt']}" style="width:100%;height:340px;object-fit:cover;display:block;" />
      </div>
      <div>
        <h3 style="color:#0F172A;font-size:22px;font-weight:800;margin:0 0 16px;">Tâm Điểm Liên Kết Vùng Đắt Giá Bậc Nhất Phía Nam</h3>
        <p style="color:#475569;font-size:14.5px;line-height:1.7;margin:0 0 20px;">
          Thuận An là thủ phủ công nghiệp và đô thị dịch vụ vệ tinh trọng điểm phát triển mạnh nhất giáp ranh TP.HCM. Từ Monrei Saigon, cư dân kết nối thần tốc tới toàn bộ hạ tầng tiện ích cao cấp:
        </p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
          <div style="background:#fff;border-left:4px solid #0284C7;padding:12px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:18px;font-weight:800;color:#0284C7;">3 Phút</div>
            <div style="font-size:13px;color:#64748B;margin-top:2px;">Tới AEON Mall Canary & Sân Golf Sông Bé</div>
          </div>
          <div style="background:#fff;border-left:4px solid #16A34A;padding:12px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:18px;font-weight:800;color:#16A34A;">5 Phút</div>
            <div style="font-size:13px;color:#64748B;margin-top:2px;">Bệnh viện Quốc tế Columbia Asia & VSIP 1</div>
          </div>
          <div style="background:#fff;border-left:4px solid #EA580C;padding:12px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:18px;font-weight:800;color:#EA580C;">15 Phút</div>
            <div style="font-size:13px;color:#64748B;margin-top:2px;">Tới trung tâm TP. Thủ Đức & Cầu Bình Triệu</div>
          </div>
          <div style="background:#fff;border-left:4px solid #8B5CF6;padding:12px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:18px;font-weight:800;color:#8B5CF6;">25 Phút</div>
            <div style="font-size:13px;color:#64748B;margin-top:2px;">Tới Sân bay Quốc tế Tân Sơn Nhất & Quận 1</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: THÀNH PHỐ THỦY LIỆU URBAN HYDROTHERAPY -->
<section id="thuy-lieu" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 40px;">
      <span style="background:#E0F2FE;color:#0284C7;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Triết lý sống Wellness</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 12px;">ĐỈNH CAO "THÀNH PHỐ THỦY LIỆU" ĐẦU TIÊN TẠI VIỆT NAM</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Lấy cảm hứng từ văn hóa tắm khoáng thanh tẩy cơ thể của Nhật Bản, Monrei Saigon kiến tạo liệu trình chăm sóc sức khỏe toàn diện bằng năng lượng của nước.</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center;">
      <div>
        <h3 style="color:#0284C7;font-size:22px;font-weight:800;margin:0 0 16px;">Thác Nước Mây Mưa & Dòng Sông Lười Nghỉ Dưỡng</h3>
        <p style="color:#475569;font-size:15px;line-height:1.7;margin:0 0 18px;">
          Bước chân vào nội khu Monrei Saigon, cư dân như lạc vào một ốc đảo nhiệt đới yên bình tách biệt hoàn toàn khỏi khói bụi phố thị. Công trình <strong>Thác Nước Mây Mưa</strong> với hệ thống vòm phun mưa nhân tạo độc đáo kết hợp cùng dòng sông lười uốn lượn xuyên qua các khu vườn tán rộng.
        </p>
        <ul style="color:#475569;font-size:14.5px;line-height:1.8;padding-left:20px;margin:0 0 20px;">
          <li>Hồ bơi phong cách Resort nhiệt đới rộng lớn với làn nước trong vắt màu lam ngọc.</li>
          <li>Khu chèo thuyền kayak thư giãn trên sông lười nội khu mát lành.</li>
          <li>Cầu gỗ trên cao ngắm trọn toàn cảnh công viên nước từ tầng canopy.</li>
        </ul>
      </div>
      <div style="border-radius:14px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.1);border:1px solid #E2E8F0;">
        <img src="{$m['thac_nuoc_may_mua']['url']}" alt="{$m['thac_nuoc_may_mua']['alt']}" style="width:100%;height:360px;object-fit:cover;display:block;" />
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: KHOÁNG NÓNG ONSEN & BỂ SỰC SENTO NHẬT BẢN -->
<section id="onsen-sento" style="padding:70px 0;background:#0F172A;color:#fff;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 44px;">
      <span style="background:rgba(56,189,248,0.2);border:1px solid rgba(56,189,248,0.4);color:#BAE6FD;font-size:12px;font-weight:700;padding:5px 16px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Chuẩn mực Onsen Nhật Bản</span>
      <h2 style="color:#FFFFFF;font-size:32px;font-weight:800;margin:0 0 12px;">TỔ HỢP KHOÁNG NÓNG ONSEN & BỂ SỤC NƯỚC ẤM SENTO</h2>
      <p style="color:#CBD5E1;font-size:15px;margin:0;">Liệu trình phục hồi tuần hoàn, làm chậm lão hóa và tái tạo năng lượng sống ngay dưới thềm nhà</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center;margin-bottom:40px;">
      <div style="border-radius:14px;overflow:hidden;box-shadow:0 16px 32px rgba(0,0,0,0.4);border:1px solid rgba(255,255,255,0.15);">
        <img src="{$m['khoang_nong_onsen']['url']}" alt="{$m['khoang_nong_onsen']['alt']}" style="width:100%;height:320px;object-fit:cover;display:block;" />
      </div>
      <div>
        <h3 style="color:#FDBA74;font-size:22px;font-weight:800;margin:0 0 14px;">Tổ Hợp Khoáng Nóng Onsen View Hoàng Hôn</h3>
        <p style="color:#E2E8F0;font-size:14.5px;line-height:1.7;margin:0 0 16px;">
          Được thiết kế kỳ công theo tiêu chuẩn các khu nghỉ dưỡng suối nước nóng tại Hakone Nhật Bản. Nguồn khoáng chất giàu vi lượng giúp giải phóng các huyệt đạo, làm dịu các cơn đau cơ xương khớp và mang lại giấc ngủ sâu an lành cho cư dân sau một ngày làm việc bận rộn.
        </p>
        <div style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);padding:14px 18px;border-radius:10px;">
          <div style="font-weight:700;color:#38BDF8;font-size:14px;margin-bottom:4px;">Tầm view đắt giá ngắm hoàng hôn</div>
          <div style="color:#94A3B8;font-size:13px;">Ngâm mình giữa làn nước khoáng bốc hơi ấm áp trong khung cảnh chiều tà lãng mạn như miền viễn xứ.</div>
        </div>
      </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center;">
      <div style="order:2;border-radius:14px;overflow:hidden;box-shadow:0 16px 32px rgba(0,0,0,0.4);border:1px solid rgba(255,255,255,0.15);">
        <img src="{$m['be_suc_sento']['url']}" alt="{$m['be_suc_sento']['alt']}" style="width:100%;height:320px;object-fit:cover;display:block;" />
      </div>
      <div style="order:1;">
        <h3 style="color:#38BDF8;font-size:22px;font-weight:800;margin:0 0 14px;">Bể Sục Nước Ấm Sento Tái Tạo Thể Chất</h3>
        <p style="color:#E2E8F0;font-size:14.5px;line-height:1.7;margin:0 0 16px;">
          Được bảo chứng bởi tập đoàn đa quốc gia <strong>Mitsubishi Corporation</strong>, hệ thống bể sục nước ấm Sento vận hành công nghệ lọc tuần hoàn đa tầng tiên tiến của Nhật Bản. Hàng triệu bọt khí li ti tác động trực tiếp vào từng thớ cơ giúp đánh thức mọi giác quan.
        </p>
        <ul style="color:#CBD5E1;font-size:14px;line-height:1.8;padding-left:20px;margin:0;">
          <li>Nhiệt độ nước ấm duy trì ổn định, an toàn tuyệt đối cho người lớn tuổi và trẻ nhỏ.</li>
          <li>Khu vườn cảnh quan đá tự nhiên và thảm thực vật phong cách Zen tĩnh tại.</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: AQUA MASSAGE THỦY LIỆU & GIƯỜNG NẰM THƯ GIÃN -->
<section id="aqua-massage" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1.05fr 0.95fr;gap:40px;align-items:center;">
      <div>
        <span style="background:#E0F2FE;color:#0284C7;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Trị liệu công nghệ cao</span>
        <h2 style="color:#0F172A;font-size:32px;font-weight:800;line-height:1.3;margin:0 0 16px;">
          GIƯỜNG THỦY LIỆU AQUA MASSAGE BED ĐỘC BẢN
        </h2>
        <p style="color:#475569;font-size:15px;line-height:1.7;margin:0 0 18px;">
          Lần đầu tiên xuất hiện tại một dự án căn hộ tại miền Nam, <strong>Aqua Massage Bed</strong> là hệ thống giường nằm trị liệu ngập trong làn nước lam ngọc được bao quanh bởi các vòm che điêu khắc gỗ nghệ thuật.
        </p>
        <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:24px;">
          <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="color:#0284C7;font-size:18px;">💧</span>
            <div>
              <strong style="color:#0F172A;font-size:14.5px;">Tia nước Hydro Jets siêu việt:</strong>
              <div style="color:#64748B;font-size:13.5px;">Tạo luồng chuyển động êm dịu xoa bóp vùng lưng, vai gáy và cột sống.</div>
            </div>
          </div>
          <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="color:#16A34A;font-size:18px;">🌿</span>
            <div>
              <strong style="color:#0F172A;font-size:14.5px;">Thiết kế chìm trong thiên nhiên:</strong>
              <div style="color:#64748B;font-size:13.5px;">Vừa thư giãn vừa lắng nghe tiếng nước chảy róc rách giữa vườn nhiệt đới xanh mướt.</div>
            </div>
          </div>
        </div>
      </div>
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 16px 36px rgba(0,0,0,0.12);border:1px solid #E2E8F0;">
        <img src="{$m['aqua_massage']['url']}" alt="{$m['aqua_massage']['alt']}" style="width:100%;height:380px;object-fit:cover;display:block;" />
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: SÂN CHƠI NƯỚC KODOMO CHO BÉ & VƯỜN HOA ANH ĐÀO -->
<section id="tien-ich-kodomo" style="padding:70px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;">
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 16px 36px rgba(0,0,0,0.1);border:1px solid #E2E8F0;">
        <img src="{$m['san_choi_kodomo']['url']}" alt="{$m['san_choi_kodomo']['alt']}" style="width:100%;height:380px;object-fit:cover;display:block;" />
      </div>
      <div>
        <span style="background:#FEF3C7;color:#D97706;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Thiên đường cho con yêu</span>
        <h2 style="color:#0F172A;font-size:32px;font-weight:800;line-height:1.3;margin:0 0 16px;">
          SÂN CHƠI NƯỚC KODOMO & CÔNG VIÊN ANH ĐÀO SAKURA
        </h2>
        <p style="color:#475569;font-size:15px;line-height:1.7;margin:0 0 18px;">
          <strong>Kodomo Water Park</strong> là thế giới giải trí nước sắc màu được thiết kế riêng biệt cho các cư dân nhí. Nằm giữa vườn hoa anh đào rực rỡ và những đường cầu dạo bộ uốn lượn, nơi các con được tự do vui đùa, phát triển thể chất và kết nối bạn bè trong môi trường an toàn tuyệt đối.
        </p>
        <ul style="color:#475569;font-size:14.5px;line-height:1.8;padding-left:20px;margin:0;">
          <li>Mực nước thiết kế an toàn tiêu chuẩn quốc tế, trang bị sàn chống trơn trượt.</li>
          <li>Đài phun nước vảy cá ngộ nghĩnh và các trò chơi vận động dưới nước hấp dẫn.</li>
          <li>Khu vực ghế ngồi quan sát thư thái dành riêng cho phụ huynh.</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 8: TIẾN ĐỘ THI CÔNG THỰC TẾ CÔNG TRƯỜNG 2026 -->
<section id="tien-do" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 40px;">
      <span style="background:#DCFCE7;color:#16A34A;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Minh bạch thực tế</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 12px;">HÌNH ẢNH THỰC TẾ TIẾN ĐỘ THI CÔNG MONREI SAIGON</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Tổng thầu Central cùng hàng trăm kỹ sư công nhân đang tăng tốc thi công ngày đêm đảm bảo tiến độ bàn giao</p>
    </div>

    <div style="display:grid;grid-template-columns:1.2fr 0.8fr;gap:36px;align-items:center;">
      <div style="border-radius:14px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.12);border:1px solid #CBD5E1;">
        <img src="{$m['tien_do_thuc_te']['url']}" alt="{$m['tien_do_thuc_te']['alt']}" style="width:100%;height:380px;object-fit:cover;display:block;" />
      </div>
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:14px;padding:28px;">
        <h3 style="color:#0F172A;font-size:20px;font-weight:800;margin:0 0 14px;">Bảo Chứng Bởi Những Đơn Vị Uy Tín Nhất</h3>
        <p style="color:#475569;font-size:14px;line-height:1.7;margin:0 0 16px;">
          Dự án đã hoàn thành toàn bộ thủ tục pháp lý, quy hoạch chi tiết 1/500 và giấy phép xây dựng. Các tòa tháp đang được đẩy nhanh thi công phần thân với hệ thống cẩu tháp công suất lớn.
        </p>
        <div style="display:flex;flex-direction:column;gap:12px;">
          <div style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #E2E8F0;font-size:14px;">
            <span style="color:#64748B;">Pháp lý:</span>
            <strong style="color:#16A34A;">Sở hữu lâu dài (Sổ hồng)</strong>
          </div>
          <div style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #E2E8F0;font-size:14px;">
            <span style="color:#64748B;">Tiến độ khối tháp:</span>
            <strong style="color:#0284C7;">Đang lên tầng thần tốc</strong>
          </div>
          <div style="display:flex;justify-content:space-between;padding:10px 0;font-size:14px;">
            <span style="color:#64748B;">Dự kiến bàn giao:</span>
            <strong style="color:#0F172A;">Quý IV/2026 - 2027</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 9: FORM ĐĂNG KÝ NHẬN BẢNG GIÁ & TƯ VẤN TRỰC TIẾP -->
<section id="dang-ky" style="padding:70px 0;background:linear-gradient(135deg,#031B33 0%,#0F2942 100%);color:#fff;">
  <div class="kbds-container" style="max-width:960px;">
    <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.12);padding:40px;border-radius:20px;box-shadow:0 20px 40px rgba(0,0,0,0.3);">
      <div style="text-align:center;margin-bottom:30px;">
        <span style="background:rgba(56,189,248,0.2);color:#BAE6FD;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:700;text-transform:uppercase;">Cơ hội sở hữu đợt 1</span>
        <h2 style="color:#fff;font-size:30px;font-weight:800;margin:10px 0 8px;">ĐĂNG KÝ NHẬN BẢNG GIÁ GỐC & CHÍNH SÁCH ƯU ĐÃI MONREI SAIGON</h2>
        <p style="color:#CBD5E1;font-size:14.5px;margin:0;">Liên hệ Phòng Kinh Doanh dự án để nhận trọn bộ tài liệu thiết kế mặt bằng căn hộ, chính sách ân hạn lãi suất 0% và suất chọn căn đẹp nhất.</p>
      </div>
      [kbds_lead_form title="" button_text="Đăng Ký Nhận Suất Ngoại Giao Ngay"]
    </div>
  </div>
</section>
HTML;

// 3. TẠO HOẶC CẬP NHẬT DỰ ÁN MONREI SAIGON
$existing_proj = get_posts([
    'post_type' => 'du_an',
    'name' => 'monrei-saigon',
    'posts_per_page' => 1,
    'post_status' => 'any'
]);

$proj_data = [
    'post_title'   => 'Căn Hộ Monrei Saigon Bình Dương (Mitsubishi Corporation)',
    'post_name'    => 'monrei-saigon',
    'post_type'    => 'du_an',
    'post_status'  => 'publish',
    'post_content' => $landing_html,
    'post_excerpt' => 'Dự án căn hộ Monrei Saigon tại Thuận An, Bình Dương do liên danh tập đoàn Mitsubishi Corporation (56%), Tokyu Land (24%) và Phát Đạt (20%) phát triển. Quy mô 4,46 ha, thành phố thủy liệu Onsen đầu tiên tại Việt Nam.'
];

if (!empty($existing_proj)) {
    $project_id = $existing_proj[0]->ID;
    $proj_data['ID'] = $project_id;
    wp_update_post($proj_data);
    echo "✔ Đã cập nhật Dự Án Monrei Saigon (ID: {$project_id})\n";
} else {
    $project_id = wp_insert_post($proj_data);
    echo "+ Đã tạo mới Dự Án Monrei Saigon (ID: {$project_id})\n";
}

// 4. CẬP NHẬT META DỰ ÁN & RANK MATH SEO
$meta_fields = [
    '_kbds_project_code'   => 'MRS-BD',
    '_kbds_price_from'     => 'Đang cập nhật (Từ 35 - 45 Triệu/m²)',
    '_kbds_address'        => 'Mặt tiền Nguyễn Thị Minh Khai, Phường Thuận Giao, TP. Thuận An, Tỉnh Bình Dương (Liền kề QL13 & AEON Mall)',
    '_kbds_total_area'     => '4,46 ha',
    '_kbds_scale'          => '6 tòa tháp cao 39 tầng, khoảng 6.000 căn hộ cao cấp & Penthouse',
    '_kbds_legal_status'   => 'Sở hữu lâu dài (Sổ hồng từng căn) - Quy hoạch 1/500 hoàn chỉnh',
    '_kbds_handover_time'  => 'Dự kiến Quý IV/2026 - 2027',
    '_kbds_bank_support'   => 'Hỗ trợ vay 70%, ân hạn gốc & hỗ trợ lãi suất 0%',
    '_kbds_review_score'   => '9.7',
    '_kbds_developer'      => 'Mitsubishi Corporation, Tokyu Land & Phát Đạt',
    '_kbds_facility_count' => 'Hơn 50 tiện ích thủy liệu Onsen, Sento, Sông lười, Thác nước mây mưa',
    'rank_math_title'      => 'Monrei Saigon - Bảng Giá & Tiến Độ Căn Hộ Mitsubishi Bình Dương',
    'rank_math_description'=> 'Đại lý phân phối dự án Monrei Saigon tại Thuận An, Bình Dương liên danh tập đoàn Mitsubishi Corporation & Phát Đạt. Căn hộ thủy liệu Onsen, sông lười, giá gốc chủ đầu tư.',
    'rank_math_focus_keyword' => 'Monrei Saigon, căn hộ Monrei Saigon, Monrei Bình Dương'
];

foreach ($meta_fields as $k => $v) {
    update_post_meta($project_id, $k, $v);
}

// Gán Featured Image (Hồ bơi dòng sông lười - ID 220)
set_post_thumbnail($project_id, $m['song_luoi']['id']);

// Gán Taxonomies
wp_set_object_terms($project_id, ['binh-duong'], 'khu_vuc_bds');
wp_set_object_terms($project_id, ['can-ho-chung-cu'], 'loai_hinh_bds');
wp_set_object_terms($project_id, ['dang-mo-ban'], 'trang_thai_du_an');
wp_set_object_terms($project_id, ['mitsubishi-corporation', 'phat-dat'], 'chu_dau_tu');

echo "✔ Đã thiết lập Meta, Taxonomies & Ảnh đại diện cho Dự Án Monrei Saigon.\n";

// 5. TẠO 5 BÀI VIẾT VỆ TINH CHUẨN SEO TOPIC CLUSTER
$cat_qh = get_category_by_slug('quy-hoach-ha-tang');
$cat_rv = get_category_by_slug('review-du-an');
$cat_qh_id = $cat_qh ? $cat_qh->term_id : 3;
$cat_rv_id = $cat_rv ? $cat_rv->term_id : 2;

$articles = [
    // Bài 1: Vị trí
    [
        'title' => 'Vị Trí Dự Án Monrei Saigon: Tọa Độ Vàng Cửa Ngõ Thuận An Liền Kề TP.HCM & Trục Đại Lộ QL13',
        'slug'  => 'vi-tri-du-an-monrei-saigon',
        'cat_id'=> $cat_qh_id,
        'thumb' => $m['tien_do_thuc_te']['id'],
        'focus_kw' => 'vị trí dự án monrei saigon, vị trí monrei saigon, monrei bình dương',
        'desc'  => 'Phân tích chi tiết vị trí dự án Monrei Saigon tại Thuận An, Bình Dương. Tọa độ kim cương kết nối Quốc lộ 13 mở rộng, Vành Đai 3 và trung tâm TP.HCM chỉ 15 phút.',
        'content' => <<<HTML
<p><strong>Vị trí dự án Monrei Saigon</strong> tọa lạc tại mặt tiền đường Nguyễn Thị Minh Khai, phường Thuận Giao, thành phố Thuận An, tỉnh Bình Dương. Nằm sát cạnh giao lộ xương sống Quốc lộ 13 (Đại lộ Bình Dương) và trục đường Vành Đai 3, dự án sở hữu tọa độ cửa ngõ giao thương chiến lược giữa TP.HCM và vùng kinh tế trọng điểm Đông Nam Bộ.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['tien_do_thuc_te']['url']}" alt="{$m['tien_do_thuc_te']['alt']}"/><figcaption>{$m['tien_do_thuc_te']['caption']}</figcaption></figure></div>

<h2>1. Vị Trí Cửa Ngõ Liền Kề Trung Tâm TP.HCM</h2>
<p>Thuận An từ lâu đã được xem là "sân sau" sầm uất nhất của TP.HCM nhờ vị trí tiếp giáp trực tiếp với thành phố Thủ Đức và quận 12. Từ <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Căn hộ Monrei Saigon</a></strong>, cư dân chỉ mất:</p>
<ul>
  <li><strong>3 phút</strong>: Tiếp cận đại siêu thị AEON Mall Canary Bình Dương và sân golf Sông Bé quy mô 27 lỗ chuẩn quốc tế.</li>
  <li><strong>5 phút</strong>: Di chuyển tới Khu công nghiệp VSIP 1, Bệnh viện Quốc tế Columbia Asia và Bệnh viện Quốc tế Becamex.</li>
  <li><strong>15 phút</strong>: Kết nối thẳng tới trung tâm TP. Thủ Đức, đại học Quốc gia TP.HCM và cầu Bình Triệu.</li>
  <li><strong>25 phút</strong>: Di chuyển tới Sân bay Quốc tế Tân Sơn Nhất và Quận 1 qua trục Quốc lộ 13 – Phạm Văn Đồng.</li>
</ul>

<h2>2. Đòn Bẩy Hạ Tầng Nâng Tầm Giá Trị Monrei Saigon</h2>
<p>Khu vực Thuận An đang là tâm điểm của các đại dự án hạ tầng giao thông trọng điểm miền Nam:</p>
<ul>
  <li><strong>Mở rộng Quốc lộ 13 lên 8 làn xe</strong>: Tuyến đường cửa ngõ huyết mạch kết nối trực tiếp Bình Dương vào TP.HCM đang được thi công mở rộng, giúp giải quyết triệt để tình trạng ùn tắc giao thông.</li>
  <li><strong>Đường Vành Đai 3 TP.HCM</strong>: Tuyến vành đai huyết mạch kết nối 4 tỉnh thành kinh tế lớn (TP.HCM, Bình Dương, Đồng Nai, Long An), tạo cú hích tăng trưởng phi mã cho thị trường bất động sản dọc tuyến.</li>
  <li><strong>Tuyến Metro số 1 nối dài</strong>: Kế hoạch mở rộng Metro Bến Thành – Suối Tiên đến Bình Dương sẽ biến khu vực này thành trung tâm đô thị hiện đại và thịnh vượng bậc nhất.</li>
</ul>

<p>Xem toàn cảnh thông tin dự án tại <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Dự án Monrei Saigon Bình Dương</a></strong>.</p>
HTML
    ],

    // Bài 2: Tiện ích thủy liệu
    [
        'title' => 'Hệ Thống Tiện Ích Thủy Liệu Chuẩn Nhật Tại Monrei Saigon: Đỉnh Cao Wellness Living',
        'slug'  => 'tien-ich-thuy-lieu-monrei-saigon',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['song_luoi']['id'],
        'focus_kw' => 'tiện ích dự án monrei saigon, tiện ích monrei saigon, thành phố thủy liệu monrei saigon',
        'desc'  => 'Khám phá tổ hợp tiện ích thủy liệu đầu tiên tại Việt Nam tại Monrei Saigon: Hồ bơi dòng sông lười resort, thác nước mây mưa và không gian sống Wellness chuẩn Nhật.',
        'content' => <<<HTML
<p>Được định vị là <strong>"Thành phố Thủy liệu" (Urban Hydrotherapy City)</strong> đầu tiên tại Việt Nam, hệ thống tiện ích tại <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Monrei Saigon</a></strong> mở ra một kỷ nguyên sống mới – nơi nước không chỉ là cảnh quan mà còn là nguồn năng lượng chữa lành và chăm sóc sức khỏe toàn diện cho cả gia đình.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['song_luoi']['url']}" alt="{$m['song_luoi']['alt']}"/><figcaption>{$m['song_luoi']['caption']}</figcaption></figure></div>

<h2>1. Hồ Bơi Resort & Dòng Sông Lười Thủy Liệu Uốn Lượn</h2>
<p>Trái tim cảnh quan nội khu của Monrei Saigon là quần thể hồ bơi phong cách nhiệt đới trải dài với dòng sông lười êm đềm uốn lượn dưới những tán cây xanh mát. Cư dân có thể thả mình bồng bềnh trên những chiếc thuyền kayak, tận hưởng làn gió mát lành và cảm giác nghỉ dưỡng chuẩn 5 sao mỗi ngày ngay tại thềm nhà.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['thac_nuoc_may_mua']['url']}" alt="{$m['thac_nuoc_may_mua']['alt']}"/><figcaption>{$m['thac_nuoc_may_mua']['caption']}</figcaption></figure></div>

<h2>2. Thác Nước Mây Mưa – Kiến Trúc Cảnh Quan Độc Bản</h2>
<p>Một điểm nhấn thị giác và thính giác vô cùng ấn tượng tại quảng trường trung tâm là công trình <strong>Thác Nước Mây Mưa</strong>. Được thiết kế như những đám mây bồng bềnh với những làn mưa nhân tạo dịu mát rơi xuống hồ cảnh quan, công trình giúp điều hòa nhiệt độ không khí nội khu luôn mát mẻ hơn từ 2 - 3 độ C so với bên ngoài.</p>

<h2>3. Hệ Sinh Thái Tiện Ích Đa Tầng "All-in-one"</h2>
<p>Bên cạnh chuỗi tiện ích mặt nước, Monrei Saigon còn quy tụ hàng loạt tiện ích cao cấp phục vụ mọi lứa tuổi:</p>
<ul>
  <li>Trung tâm thương mại khối đế sầm uất với các thương hiệu bán lẻ Nhật Bản.</li>
  <li>Khu thể thao phức hợp, phòng gym hiện đại và yoga view vườn thiền Zen.</li>
  <li>Đường dạo bộ trên cao canopy kết nối các khối tháp rợp bóng cây xanh.</li>
  <li>Hệ thống an ninh thông minh 24/7 kiểm soát nghiêm ngặt bằng FaceID.</li>
</ul>

<p>Nhận trọn bộ brochure tiện ích tại <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Dự án Monrei Saigon</a></strong>.</p>
HTML
    ],

    // Bài 3: Onsen & Sento
    [
        'title' => 'Trải Nghiệm Tổ Hợp Khoáng Nóng Onsen & Bể Sục Sento Tại Căn Hộ Monrei Saigon',
        'slug'  => 'khoang-nong-onsen-sento-monrei-saigon',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['khoang_nong_onsen']['id'],
        'focus_kw' => 'khoáng nóng onsen monrei saigon, bể sục sento monrei saigon, onsen monrei bình dương',
        'desc'  => 'Trải nghiệm đỉnh cao tắm khoáng Onsen và bể sục nước ấm Sento chuẩn phong cách Nhật Bản tại dự án căn hộ Monrei Saigon. Tái tạo thể chất và phục hồi tinh thần.',
        'content' => <<<HTML
<p>Văn hóa tắm khoáng nóng Onsen và ngâm mình trong bể sục nước ấm Sento từ lâu đã trở thành bí quyết trường thọ và thanh lọc tâm trí nổi tiếng của người Nhật. Tại <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Monrei Saigon</a></strong>, tập đoàn Mitsubishi Corporation đã tái hiện trọn vẹn tinh hoa này vào một tổ hợp chăm sóc sức khỏe độc bản ngay trong lòng dự án.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['khoang_nong_onsen']['url']}" alt="{$m['khoang_nong_onsen']['alt']}"/><figcaption>{$m['khoang_nong_onsen']['caption']}</figcaption></figure></div>

<h2>1. Tổ Hợp Khoáng Nóng Onsen – Liệu Pháp Chữa Lành Từ Thiên Nhiên</h2>
<p>Được thiết kế nương theo kiến trúc Onsen truyền thống của xứ sở hoa anh đào, khu tắm khoáng nóng tại Monrei Saigon sở hữu nguồn nước giàu khoáng chất vi lượng được tinh chế bằng công nghệ Nhật Bản. Nước khoáng nóng giúp:</p>
<ul>
  <li>Tăng cường lưu thông tuần hoàn máu, hỗ trợ đào thải độc tố qua da.</li>
  <li>Giảm căng thẳng thần kinh, xua tan đau nhức cơ bắp và đau mỏi vai gáy.</li>
  <li>Tăng độ đàn hồi cho da, mang lại tinh thần sảng khoái và giấc ngủ sâu trọn vẹn.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['be_suc_sento']['url']}" alt="{$m['be_suc_sento']['alt']}"/><figcaption>{$m['be_suc_sento']['caption']}</figcaption></figure></div>

<h2>2. Bể Sục Nước Ấm Sento Tái Tạo Nguồn Năng Lượng Sống</h2>
<p>Bể sục Sento tại Monrei Saigon là sự kết hợp hoàn hảo giữa nhiệt độ nước ấm lý tưởng và hệ thống bọt khí sục mạnh mẽ. Hàng ngàn bọt khí thủy lực liên tục tác động vào các huyệt đạo trên cơ thể, mang lại cảm giác thư giãn tuyệt đối như tại các spa cao cấp tại Tokyo.</p>
<p>Không gian xung quanh bể Sento được bao bọc bởi những phiến đá tự nhiên và thảm cây xanh Zen Garden, tạo nên một không gian thiền định kín đáo và thanh lịch.</p>

<p>Tìm hiểu thêm chi tiết dự án tại <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Hồ sơ Monrei Saigon Bình Dương</a></strong>.</p>
HTML
    ],

    // Bài 4: Chủ đầu tư Mitsubishi
    [
        'title' => 'Dấu Ấn Tập Đoàn Mitsubishi & Tokyu Land Tại Dự Án Monrei Saigon: Chuẩn Mực Bất Động Sản "Made In Japan"',
        'slug'  => 'chu-dau-tu-mitsubishi-monrei-saigon',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['be_suc_sento']['id'],
        'focus_kw' => 'chủ đầu tư monrei saigon, mitsubishi monrei saigon, tokyu land monrei saigon',
        'desc'  => 'Tìm hiểu liên danh chủ đầu tư danh tiếng đứng sau dự án Monrei Saigon: Tập đoàn Mitsubishi Corporation (56%), Tokyu Land (24%) và Phát Đạt (20%).',
        'content' => <<<HTML
<p>Sự xuất hiện của <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Monrei Saigon</a></strong> đã tạo nên tiếng vang lớn trên thị trường bất động sản phía Nam nhờ cú bắt tay chiến lược giữa các tập đoàn hàng đầu thế giới đến từ Nhật Bản và nhà phát triển bất động sản uy tín tại Việt Nam.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['be_suc_sento']['url']}" alt="{$m['be_suc_sento']['alt']}"/><figcaption>{$m['be_suc_sento']['caption']}</figcaption></figure></div>

<h2>1. Mitsubishi Corporation – Cổ Đông Lớn Nhất Nắm Giữ 56%</h2>
<p><strong>Mitsubishi Corporation</strong> là tập đoàn đa ngành có lịch sử hơn 150 năm và quy mô thuộc top đầu thế giới. Tại thị trường Việt Nam, tập đoàn đã tham gia phát triển hàng loạt dự án đại đô thị biểu tượng. Với việc nắm giữ tới 56% cổ phần tại Monrei Saigon, Mitsubishi trực tiếp giám sát quy trình thiết kế, tiêu chuẩn thi công và hoàn thiện công trình theo chuẩn mực khắt khe <em>"Made in Japan"</em>.</p>

<h2>2. Tokyu Land Corporation – Bậc Thầy Đô Thị Sinh Thái Đến Từ Tokyo</h2>
<p>Sở hữu 24% cổ phần tại dự án, <strong>Tokyu Land</strong> mang đến bề dày kinh nghiệm hàng chục năm trong việc kiến tạo các đại đô thị thông minh và công trình xanh bền vững tại Nhật Bản. Dấu ấn của Tokyu Land thể hiện rõ nét qua việc tối ưu hóa diện tích cây xanh, ứng dụng vật liệu thân thiện môi trường và hệ thống cảnh quan thủy sinh độc bản.</p>

<h2>3. Phát Đạt (PDR) – 20 Năm Khẳng Định Vị Thế Nhà Phát Triển Hàng Đầu</h2>
<p>Với 20% cổ phần, <strong>Công ty Cổ phần Phát triển Bất động sản Phát Đạt</strong> đóng vai trò thấu hiểu thị hiếu khách hàng nội địa, hoàn thiện pháp lý minh bạch và đảm bảo tiến độ triển khai đồng bộ cùng nhà thầu xây dựng danh tiếng Central Construction.</p>

<h2>4. Bảo Chứng Vàng Cho Giá Trị Bất Động Sản Bền Vững</h2>
<p>Sự hiện diện của liên danh hùng mạnh này không chỉ đảm bảo tiến độ xây dựng và chất lượng công trình vượt trội, mà còn là cam kết vững chắc cho tiềm năng gia tăng giá trị tài sản và tính thanh khoản vượt trội trong tương lai.</p>

<p>Đăng ký nhận bảng giá gốc tại <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Căn hộ Monrei Saigon</a></strong>.</p>
HTML
    ],

    // Bài 5: Tiến độ thi công
    [
        'title' => 'Cập Nhật Tiến Độ Thi Công Dự Án Monrei Saigon Mới Nhất Năm 2026: Đảm Bảo Tiến Độ Bàn Giao',
        'slug'  => 'tien-do-thi-cong-monrei-saigon',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['tien_do_thuc_te']['id'],
        'focus_kw' => 'tiến độ thi công monrei saigon, tiến độ monrei saigon, hình ảnh thực tế monrei saigon',
        'desc'  => 'Cập nhật hình ảnh thực tế tiến độ thi công dự án căn hộ Monrei Saigon Thuận An Bình Dương năm 2026. Tổng thầu Central tăng tốc xây dựng phần thân và khối đế.',
        'content' => <<<HTML
<p>Ghi nhận thực tế tại đại công trường dự án <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Monrei Saigon</a></strong> (mặt tiền đường Nguyễn Thị Minh Khai, TP. Thuận An, Bình Dương) trong năm 2026 cho thấy không khí thi công đang diễn ra vô cùng khẩn trương và chuyên nghiệp dưới sự giám sát nghiêm ngặt của chủ đầu tư liên danh Mitsubishi Corporation và tổng thầu xây dựng Central.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['tien_do_thuc_te']['url']}" alt="{$m['tien_do_thuc_te']['alt']}"/><figcaption>{$m['tien_do_thuc_te']['caption']}</figcaption></figure></div>

<h2>1. Hình Ảnh Thực Tế Công Trường Năm 2026</h2>
<p>Dự án đã hoàn thành toàn bộ phần móng hầm kiên cố và hiện đang bước vào giai đoạn tăng tốc thi công phần thân các khối tháp. Hệ thống cẩu tháp hiện đại hoạt động liên tục ngày đêm, các khối kết cấu bê tông cốt thép vươn cao vững chắc giữa bầu trời khu Đông Bắc Sài Gòn.</p>

<h2>2. Năng Lực Của Tổng Thầu Xây Dựng Central</h2>
<p>Central Construction là một trong những nhà thầu xây dựng uy tín hàng đầu tại Việt Nam, từng triển khai thành công hàng loạt dự án resort và căn hộ cao cấp chuẩn quốc tế. Với việc áp dụng công nghệ thi công cốp pha nhôm và quy trình kiểm soát chất lượng chuẩn ISO, Central cam kết mang lại chất lượng kết cấu bền vững theo thời gian.</p>

<h2>3. Cam Kết Tiến Độ Bàn Giao Quý IV/2026 - 2027</h2>
<p>Với nguồn lực tài chính hùng mạnh từ các tập đoàn Nhật Bản Mitsubishi Corporation và Tokyu Land, tiến độ thi công tại Monrei Saigon luôn được bảo đảm thông suốt, không bị ảnh hưởng bởi biến động dòng tiền. Dự án dự kiến sẽ cất nóc và bàn giao những căn hộ cao cấp đầu tiên đến tay cư dân từ Quý IV/2026 đến năm 2027.</p>

<p>Khám phá trọn bộ tài liệu dự án tại <strong><a href="https://kenhbatdongsan.vn/du-an/monrei-saigon/">Dự án Căn hộ Monrei Saigon</a></strong>.</p>
HTML
    ]
];

foreach ($articles as $art) {
    $existing_art = get_posts([
        'post_type' => 'post',
        'name' => $art['slug'],
        'posts_per_page' => 1,
        'post_status' => 'any'
    ]);

    $post_data = [
        'post_title'   => $art['title'],
        'post_name'    => $art['slug'],
        'post_type'    => 'post',
        'post_status'  => 'publish',
        'post_content' => $art['content'],
        'post_excerpt' => $art['desc'],
        'post_category'=> [$art['cat_id']]
    ];

    if (!empty($existing_art)) {
        $art_id = $existing_art[0]->ID;
        $post_data['ID'] = $art_id;
        wp_update_post($post_data);
        echo " ✔ Đã cập nhật bài viết: [{$art['title']}] (ID: {$art_id})\n";
    } else {
        $art_id = wp_insert_post($post_data);
        echo " + Đã tạo mới bài viết: [{$art['title']}] (ID: {$art_id})\n";
    }

    // Gán Featured Image & Chuyên mục
    if (!empty($art['thumb'])) {
        set_post_thumbnail($art_id, $art['thumb']);
    }
    wp_set_post_categories($art_id, [$art['cat_id']], false);

    // Meta Rank Math SEO & Project Ref
    update_post_meta($art_id, 'rank_math_title', $art['title'] . ' | Kênh Bất Động Sản');
    update_post_meta($art_id, 'rank_math_description', $art['desc']);
    update_post_meta($art_id, 'rank_math_focus_keyword', $art['focus_kw']);
    update_post_meta($art_id, '_kbds_project_ref', $project_id);
    update_post_meta($art_id, '_kbds_project_slug', 'monrei-saigon');
}

echo "==============================================================\n";
echo "🎉 HOÀN THÀNH XÂY DỰNG TRỌN GÓI DỰ ÁN MONREI SAIGON TRÊN LOCALHOST!\n";
echo "==============================================================\n";
