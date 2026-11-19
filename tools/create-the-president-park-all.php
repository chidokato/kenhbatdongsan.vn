<?php
/**
 * Tạo trọn gói Trang Dự Án The President Park (Mễ Trì - Nam Từ Liêm - Hà Nội) + 4 Bài viết vệ tinh chuẩn SEO Topic Cluster
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU XÂY DỰNG TRANG DỰ ÁN THE PRESIDENT PARK (MỄ TRÌ - HÀ NỘI)\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/the-president-park-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/the-president-park-media-map.json. Hãy chạy tools/import-the-president-park.php trước!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// 1. Tạo Term Chủ đầu tư & Khu vực nếu chưa có
if (!term_exists('CityLand Group', 'chu_dau_tu')) {
    wp_insert_term('CityLand Group', 'chu_dau_tu', [
        'slug' => 'cityland-group',
        'description' => 'Công ty TNHH Đầu tư Địa ốc Thành Phố (CityLand) - Thương hiệu phát triển các khu đô thị kiểu mẫu cao cấp hàng đầu Việt Nam'
    ]);
    echo " + Đã tạo term Chủ đầu tư: CityLand Group\n";
}
if (!term_exists('Hà Nội', 'khu_vuc_bds')) {
    wp_insert_term('Hà Nội', 'khu_vuc_bds', [
        'slug' => 'ha-noi',
        'description' => 'Thị trường Bất Động Sản Thủ đô Hà Nội'
    ]);
    echo " + Đã tạo term Khu vực: Hà Nội\n";
}
if (!term_exists('Nam Từ Liêm', 'khu_vuc_bds')) {
    $parent_hn = term_exists('Hà Nội', 'khu_vuc_bds');
    $parent_id = is_array($parent_hn) ? $parent_hn['term_id'] : 0;
    wp_insert_term('Nam Từ Liêm', 'khu_vuc_bds', [
        'slug' => 'nam-tu-liem',
        'parent' => $parent_id,
        'description' => 'Khu vực quận Nam Từ Liêm - Trung tâm hành chính, kinh tế mới phía Tây Hà Nội'
    ]);
    echo " + Đã tạo term Khu vực: Nam Từ Liêm\n";
}

// 2. SOẠN THẢO NỘI DUNG LANDING PAGE 10 SECTION CHUẨN UX CHO THE PRESIDENT PARK
// Lưu ý: subnav viết gọn không line break bên trong để wpautop không thêm <p> hoặc <br>
$subnav_html = '<div class="kbds-project-subnav"><div class="kbds-container kbds-subnav-container"><div class="kbds-subnav-brand"><span class="kbds-subnav-dot"></span>THE PRESIDENT PARK</div><a href="#dang-ky" class="kbds-subnav-cta">Nhận Báo Giá Gốc</a><nav class="kbds-subnav-links"><a href="#tong-quan" class="kbds-subnav-link">Tổng Quan</a><a href="#vi-tri" class="kbds-subnav-link">Vị Trí</a><a href="#tien-ich" class="kbds-subnav-link">Clubhouse 5*</a><a href="#ham-sieu-xe" class="kbds-subnav-link">Hầm Siêu Xe</a><a href="#mat-bang" class="kbds-subnav-link">Mặt Bằng 149 Căn</a><a href="#bang-gia" class="kbds-subnav-link">Bảng Giá</a><a href="#phap-ly" class="kbds-subnav-link">Pháp Lý & CĐT</a><a href="#tin-tuc-du-an" class="kbds-subnav-link">Tin Tức</a></nav></div></div>';

$landing_html = <<<HTML
{$subnav_html}

<!-- SECTION 1: HERO BANNER -->
<section style="position:relative;background:linear-gradient(135deg,#0a192f 0%,#112240 50%,#B45309 100%);color:#fff;padding:80px 0 100px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.25;background:radial-gradient(circle at 80% 20%,#F59E0B 0%,transparent 65%);pointer-events:none;"></div>
  <div class="kbds-container" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:40px;align-items:center;">
    <div>
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(245,158,11,0.2);border:1px solid rgba(245,158,11,0.5);color:#FDE68A;padding:6px 18px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;">
        🏛️ CITYLAND GROUP • TUYỆT PHẨM VƯƠNG GIẢ TÂM ĐIỂM PHÍA TÂY
      </div>
      <h1 style="color:#FFFFFF;font-size:42px;font-weight:900;line-height:1.2;margin:0 0 18px;">
        THE PRESIDENT PARK
        <span style="display:block;font-size:22px;font-weight:600;color:#F59E0B;margin-top:6px;">Biểu Tượng Phong Cách Sống Trường Tồn Tại Mễ Trì, Hà Nội</span>
      </h1>
      <p style="color:#E2E8F0;font-size:16px;line-height:1.7;margin:0 0 28px;max-width:620px;">
        Tọa lạc tại ngã tư kim cương <strong>Cương Kiên – Lương Thế Vinh kéo dài</strong>, phường Mễ Trì, quận Nam Từ Liêm, Hà Nội. <strong>The President Park</strong> (Khu nhà ở thấp tầng CityLand Mễ Trì) là quần thể compound khép kín giới hạn chỉ <strong>149 sản phẩm thấp tầng hoàng gia</strong> (Biệt thự đơn lập, Song lập, Shophouse & Dinh thự), quy tụ tổ hợp <strong>Clubhouse 5 sao với phòng tập Golf 3D</strong> cùng <strong>Hầm đỗ xe ngầm thông minh cho siêu xe dưới công viên sinh thái</strong> độc bản bậc nhất Thủ đô.
      </p>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:30px;">
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.15);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#F59E0B;">6,6 ha</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Chỉ 149 Căn Độc Bản</div>
        </div>
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.15);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#38BDF8;">30,67%</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Mật độ xây dựng thấp</div>
        </div>
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.15);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#4ADE80;">Sổ Đỏ</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Sở hữu lâu dài</div>
        </div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:#D97706;color:#fff;font-weight:700;padding:14px 28px;border-radius:8px;text-decoration:none;box-shadow:0 6px 20px rgba(217,119,6,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Nhận Bảng Giá Ngoại Giao Đợt 1</span> →
        </a>
        <a href="#ham-sieu-xe" style="background:transparent;color:#fff;font-weight:600;padding:14px 24px;border-radius:8px;text-decoration:none;border:1px solid rgba(255,255,255,0.35);">
          Khám Phá Hầm Đỗ Siêu Xe
        </a>
      </div>
    </div>
    <div>
      <div style="position:relative;border-radius:16px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.5);border:2px solid rgba(245,158,11,0.3);">
        <img src="{$m['poster_tong_the']['url']}" alt="{$m['poster_tong_the']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(0,0,0,0.85),transparent);padding:20px;text-align:center;color:#FDE68A;font-weight:600;font-size:14px;">
          Biểu Tượng Sống Vương Giả Trường Tồn – Quần Thể 149 Biệt Thự & Shophouse Tân Cổ Điển
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: TỔNG QUAN DỰ ÁN -->
<section id="tong-quan" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 50px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">HỒ SƠ PHÁP LÝ & QUY HOẠCH CHI TIẾT</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">TỔNG QUAN THE PRESIDENT PARK MỄ TRÌ</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Tọa độ kim cương hiếm hoi còn sót lại tại trung tâm Tây Hà Nội, đối diện trực tiếp hồ điều hòa và KĐT Vinhomes Green Bay, kiến tạo chuẩn mực sống thượng lưu biệt lập.
      </p>
    </div>

    <div style="background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.06);overflow:hidden;border:1px solid #E2E8F0;">
      <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;text-align:left;font-size:15px;">
          <tbody>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;width:28%;background:#F8FAFC;">Tên thương mại</td>
              <td style="padding:16px 24px;color:#334155;font-weight:700;color:#B45309;">THE PRESIDENT PARK</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Tên pháp lý</td>
              <td style="padding:16px 24px;color:#334155;">Khu nhà ở thấp tầng CityLand Mễ Trì (Ô đất CQ1.1 - Đài phát sóng Mễ Trì)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Chủ đầu tư</td>
              <td style="padding:16px 24px;color:#334155;"><strong>Tập đoàn CityLand (CityLand Group)</strong> – Đơn vị phát triển BĐS cao cấp uy tín</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Vị trí dự án</td>
              <td style="padding:16px 24px;color:#334155;">Ngã tư đường Cương Kiên và Lương Thế Vinh kéo dài, P. Mễ Trì, Q. Nam Từ Liêm, TP. Hà Nội</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Tổng diện tích khu đất</td>
              <td style="padding:16px 24px;color:#334155;"><strong>6,6 ha (66.000 m²)</strong></td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Mật độ xây dựng</td>
              <td style="padding:16px 24px;color:#334155;">Chỉ khoảng <strong>30,67%</strong> (gần 70% dành cho công viên sinh thái, quảng trường La Mã, mặt nước và clubhouse)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Số lượng sản phẩm</td>
              <td style="padding:16px 24px;color:#334155;">Giới hạn duy nhất <strong>149 sản phẩm thấp tầng</strong> cao cấp</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Cơ cấu sản phẩm</td>
              <td style="padding:16px 24px;color:#334155;">
                • <strong>65 Căn Shophouse (Nhà phố thương mại):</strong> Diện tích 100m² – 245m² (4–5 tầng)<br/>
                • <strong>43 Căn Biệt thự Song lập:</strong> Diện tích 196m² – 301m² (3 tầng + 1 tum)<br/>
                • <strong>39 Căn Biệt thự Đơn lập:</strong> Diện tích 251m² – 640m² (4 mặt thoáng)<br/>
                • <strong>02 Căn Dinh thự Độc bản:</strong> Diện tích &gt; 1.000m² – 1.100m²
              </td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Tiện ích độc bản nổi bật</td>
              <td style="padding:16px 24px;color:#334155;">
                • <strong>Tổ hợp Clubhouse 5 sao:</strong> Phòng tập Golf 3D màn hình vòm, Gym/Yoga/Spa, Nhà hàng, Bể bơi tràn bờ, Mầm non 500 cháu.<br/>
                • <strong>Hầm ngầm sinh thái đỗ siêu xe:</strong> Ẩn mình 100% dưới công viên, cơ cấu nâng hạ 2 tầng thông minh, độc lập hoàn toàn không liên quan đất nhà dân.<br/>
                • <strong>Quảng trường La Mã Colosseum:</strong> Tháp Obelisk hoàng gia và đài phun nước biểu tượng thịnh vượng.
              </td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Hình thức sở hữu</td>
              <td style="padding:16px 24px;color:#334155;"><strong>Sổ đỏ lâu dài</strong> (Đất ở đô thị sở hữu vĩnh viễn theo quy định pháp luật)</td>
            </tr>
            <tr>
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Thời gian bàn giao dự kiến</td>
              <td style="padding:16px 24px;color:#334155;">Quý IV/2026 – Quý II/2027 (Bàn giao hoàn thiện mặt ngoài, thô bên trong)</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VỊ TRÍ KIM CƯƠNG MẶT TIỀN CƯƠNG KIÊN - LƯƠNG THẾ VINH KÉO DÀI -->
<section id="vi-tri" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;">
      <div>
        <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">TÂM ĐIỂM GIAO THƯƠNG PHÍA TÂY HÀ NỘI</span>
        <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 20px;">VỊ TRÍ KIM CƯƠNG KỀ CẬN VINHOMES GREEN BAY</h2>
        <p style="color:#475569;font-size:16px;line-height:1.7;margin-bottom:20px;">
          <strong>The President Park</strong> tọa lạc ngay giao lộ đắt giá ngã tư đường <strong>Cương Kiên</strong> và đường <strong>Lương Thế Vinh kéo dài</strong>, thuộc địa phận phường Mễ Trì, quận Nam Từ Liêm, Hà Nội. Đây là khu đất đắc địa bậc nhất khu Tây khi nằm đối diện trực diện quần thể đô thị sinh thái <strong>Vinhomes Green Bay</strong> với hồ điều hòa rộng 8ha xanh mát.
        </p>
        <div style="background:#F1F5F9;border-left:4px solid #D97706;padding:16px 20px;border-radius:0 8px 8px 0;margin-bottom:24px;">
          <h4 style="margin:0 0 8px;color:#0F172A;font-size:16px;">Mạng Lưới Kết Nối Trực Tiếp Trong Bán Kính 1 - 3km:</h4>
          <ul style="margin:0;padding-left:18px;color:#475569;font-size:14px;line-height:1.8;">
            <li><strong>Chỉ 1 phút:</strong> Tiếp cận công viên hồ điều hòa Mễ Trì & quần thể Vinhomes Green Bay.</li>
            <li><strong>Chỉ 3 phút:</strong> Kết nối trực tiếp trục Đại lộ Thăng Long, đường Tố Hữu – Lê Văn Lương và đường Khuất Duy Tiến.</li>
            <li><strong>Chỉ 5 phút:</strong> Đến Trung tâm Hội nghị Quốc gia, Bảo tàng Hà Nội, Khách sạn 5 sao JW Marriott Hà Nội.</li>
            <li><strong>Chỉ 7 phút:</strong> Đến TTTM The Garden, Keangnam Landmark 72, Khu liên hợp thể thao Mỹ Đình và Trường THPT Chuyên Hà Nội - Amsterdam.</li>
            <li><strong>25 phút:</strong> Di chuyển nhanh chóng đến Hồ Hoàn Kiếm qua trục Trần Duy Hưng – Nguyễn Chí Thanh hoặc 30 phút đến Sân bay Quốc tế Nội Bài qua trục Vành Đai 3.</li>
          </ul>
        </div>
        <p style="color:#475569;font-size:15px;line-height:1.7;">
          Đặc biệt, quy hoạch mở rộng và thông tuyến hoàn chỉnh đường <strong>Lương Thế Vinh kéo dài</strong> nối thẳng từ Đại lộ Thăng Long qua Cương Kiên sang Nguyễn Trãi và Tố Hữu sẽ biến The President Park thành tâm điểm giao thương thịnh vượng với tiềm năng tăng giá phi mã.
        </p>
      </div>
      <div>
        <div style="border-radius:16px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.12);border:1px solid #CBD5E1;">
          <img src="{$m['so_do_vi_tri']['url']}" alt="{$m['so_do_vi_tri']['alt']}" style="width:100%;height:auto;display:block;"/>
        </div>
        <div style="margin-top:12px;font-size:13px;color:#64748B;text-align:center;font-style:italic;">
          {$m['so_do_vi_tri']['caption']}
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: TỔ HỢP CLUBHOUSE 5 SAO & CHUỖI ĐẶC QUYỀN VƯƠNG GIẢ -->
<section id="tien-ich" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 50px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">ĐẶC QUYỀN NGHỈ DƯỠNG THƯỢNG LƯU</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">TỔ HỢP CLUBHOUSE 5 SAO & PHÒNG TẬP GOLF 3D</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Tọa lạc ngay lõi xanh trung tâm, Clubhouse The President Park là kiệt tác kiến trúc Tân Cổ Điển quy tụ chuỗi dịch vụ thượng đỉnh chỉ dành riêng cho 149 chủ nhân danh giá.
      </p>
    </div>

    <div style="margin-bottom:40px;border-radius:16px;overflow:hidden;box-shadow:0 15px 35px rgba(0,0,0,0.1);border:1px solid #E2E8F0;">
      <img src="{$m['clubhouse_5_sao']['url']}" alt="{$m['clubhouse_5_sao']['alt']}" style="width:100%;height:auto;display:block;"/>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
      <div style="background:#fff;padding:26px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="width:48px;height:48px;background:#FEF3C7;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">⛳</div>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">Phòng Tập Golf 3D Màn Hình Vòm</h4>
        <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0;">
          Ứng dụng công nghệ giả lập radar và màn hình vòm siêu nét đa hướng, tái hiện chân thực hàng trăm sân golf huyền thoại thế giới giúp chủ nhân thỏa mãn đam mê quý tộc mọi lúc.
        </p>
      </div>

      <div style="background:#fff;padding:26px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="width:48px;height:48px;background:#DBEAFE;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">🏊</div>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">Bể Bơi Tràn Bờ Ngoài Trời</h4>
        <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0;">
          Bể bơi phong cách resort trên cao với làn nước trong xanh, view trọn vẹn cảnh quan công viên xanh ngát và quảng trường nghệ thuật hoàng gia.
        </p>
      </div>

      <div style="background:#fff;padding:26px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="width:48px;height:48px;background:#DCFCE7;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">🏫</div>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">Trường Mầm Non 500 Cháu</h4>
        <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0;">
          Hệ thống giáo dục mầm non nội khu đạt chuẩn quốc tế với quy mô 500 trẻ, sân chơi thể chất chuyên biệt đem lại môi trường phát triển toàn diện cho con trẻ ngay tại gia.
        </p>
      </div>

      <div style="background:#fff;padding:26px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="width:48px;height:48px;background:#FCE7F3;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">🧘</div>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">Khu Gym, Yoga & Spa VIP</h4>
        <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0;">
          Trang bị máy tập hiện đại của Technogym, phòng tập Yoga kính tràn và dịch vụ chăm sóc sắc đẹp, xông hơi sauna thư giãn sau ngày dài bận rộn.
        </p>
      </div>

      <div style="background:#fff;padding:26px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="width:48px;height:48px;background:#F3E8FF;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">☕</div>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">Nhà Hàng & Cafe Trung Tâm</h4>
        <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0;">
          Không gian ẩm thực fine-dining sang trọng, phục vụ các món Âu - Á thượng hạng và quầy lounge giao lưu kết nối giữa cộng đồng tinh hoa cùng đẳng cấp.
        </p>
      </div>

      <div style="background:#fff;padding:26px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="width:48px;height:48px;background:#FFEDD5;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">🛡️</div>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:0 0 10px;">An Ninh Compound 4 Lớp 24/7</h4>
        <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0;">
          Hệ thống cổng barrier kiểm soát nhận diện biển số tự động, camera AI nhận diện khuôn mặt dọc toàn khu, đội tuần tra cơ động bảo vệ sự riêng tư tuyệt đối cho cư dân.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: SIÊU TIỆN ÍCH ĐỘC BẢN - HẦM ĐỖ XE NGẦM THÔNG MINH CHO SIÊU XE -->
<section id="ham-sieu-xe" style="padding:80px 0;background:#0F172A;color:#fff;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;">
      <div>
        <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(217,119,6,0.25);border:1px solid #D97706;color:#FDE68A;padding:6px 16px;border-radius:20px;font-size:12px;font-weight:700;text-transform:uppercase;margin-bottom:16px;">
          🏎️ ĐỘC BẢN BẤT ĐỘNG SẢN THẤP TẦNG THỦ ĐÔ
        </div>
        <h2 style="font-size:32px;font-weight:800;color:#FFFFFF;margin:0 0 20px;line-height:1.3;">
          HẦM ĐỖ XE NGẦM THÔNG MINH CHO SIÊU XE
          <span style="display:block;font-size:18px;font-weight:500;color:#38BDF8;margin-top:6px;">Ẩn Mình Dưới Công Viên Sinh Thái – Tách Biệt Hoàn Toàn Đất Nhà Dân</span>
        </h2>
        <p style="color:#CBD5E1;font-size:15px;line-height:1.7;margin-bottom:20px;">
          Một trong những đột phá công nghệ và kiến trúc đắt giá nhất của <strong>The President Park Mễ Trì</strong> chính là hệ thống hầm ngầm chuyên dụng cho dàn siêu xe. Được quy hoạch nằm <strong>hoàn toàn dưới lòng đất của công viên trung tâm sinh thái</strong>, công trình mang lại giải pháp giao thông tĩnh hoàn hảo:
        </p>
        <ul style="color:#E2E8F0;font-size:14px;line-height:1.8;padding-left:20px;margin-bottom:28px;">
          <li><strong>Độc lập hoàn toàn:</strong> Không xâm lấn hay ảnh hưởng đến móng và kết cấu ngầm của các căn biệt thự, triệt tiêu tiếng ồn động cơ và khí thải.</li>
          <li><strong>Công nghệ nâng hạ 2 tầng (Smart Car Lift):</strong> Tối ưu hóa không gian, thiết kế chuẩn xác độ dốc ram dốc siêu thoai thoải dành riêng cho các dòng xe thể thao gầm cực thấp (Ferrari, Lamborghini, McLaren, Rolls-Royce, Porsche...).</li>
          <li><strong>Hạ tầng kỹ thuật 5 sao:</strong> Hệ thống chống ngập đa cấp bằng máy bơm chìm tự động, lọc không khí tươi liên tục, phòng cháy chữa cháy khí sạch chuyên dụng bảo vệ tối đa các tài sản hàng triệu đô la.</li>
          <li><strong>An ninh thẻ từ & sinh trắc học:</strong> Chỉ chủ sở hữu căn hộ mới được phân quyền ra vào tầng hầm, bảo đảm tính bí mật và an toàn tuyệt đối.</li>
        </ul>
        <a href="#dang-ky" style="background:#D97706;color:#fff;font-weight:700;padding:12px 24px;border-radius:8px;text-decoration:none;display:inline-block;">
          Đăng Ký Tham Quan Mô Hình Hầm Ngầm →
        </a>
      </div>
      <div>
        <div style="border-radius:16px;overflow:hidden;box-shadow:0 15px 40px rgba(0,0,0,0.6);border:2px solid rgba(56,189,248,0.3);">
          <img src="{$m['ham_ngam_sieu_xe']['url']}" alt="{$m['ham_ngam_sieu_xe']['alt']}" style="width:100%;height:auto;display:block;"/>
        </div>
        <div style="margin-top:12px;font-size:13px;color:#94A3B8;text-align:center;font-style:italic;">
          {$m['ham_ngam_sieu_xe']['caption']}
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: QUẢNG TRƯỜNG LA MÃ & CỘT THÁP OBELISK HOÀNG GIA -->
<section style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 50px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">KIẾN TRÚC TÂN CỔ ĐIỂN VƯƠNG GIẢ</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">QUẢNG TRƯỜNG VÒM COLOSSEUM & THÁP OBELISK</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Tái hiện vẻ đẹp trường tồn của nền văn minh La Mã cổ đại giữa lòng thủ đô Hà Nội ngàn năm văn hiến, đem lại niềm kiêu hãnh và khẳng định vị thế đỉnh cao cho gia chủ.
      </p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;">
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
        <img src="{$m['quang_truong_colosseum_dem']['url']}" alt="{$m['quang_truong_colosseum_dem']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="padding:16px;background:#F8FAFC;font-size:14px;color:#334155;font-weight:600;text-align:center;">
          Quảng trường La Mã vòm Colosseum lung linh rực sáng về đêm
        </div>
      </div>
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
        <img src="{$m['thap_obelisk_dai_phun_nuoc']['url']}" alt="{$m['thap_obelisk_dai_phun_nuoc']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="padding:16px;background:#F8FAFC;font-size:14px;color:#334155;font-weight:600;text-align:center;">
          Cột tháp Obelisk hoàng gia & đài phun nước biểu tượng thịnh vượng
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: MẶT BẰNG & CƠ CẤU 149 SẢN PHẨM HOÀNG GIA -->
<section id="mat-bang" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 50px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">QUY HOẠCH SẢN PHẨM GIỚI HẠN</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">MẶT BẰNG CHI TIẾT 149 CĂN THE PRESIDENT PARK</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Từng căn biệt thự, dinh thự và shophouse đều được thiết kế chỉn chu với khoảng lùi sân vườn thoáng đãng, trần cao khoáng đạt và ban công vòm đậm chất Tân Cổ Điển quý phái.
      </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:40px;">
      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#D97706;text-transform:uppercase;margin-bottom:8px;">65 Căn Shophouse</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Nhà Phố Thương Mại</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">100 – 245 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Xây 4 – 5 tầng, mặt tiền kinh doanh Cương Kiên & đường 17.5m</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#D97706;text-transform:uppercase;margin-bottom:8px;">43 Căn Song Lập</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Biệt Thự Song Lập</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">196 – 301 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Xây 3 tầng 1 tum, 3 mặt thoáng, sân vườn trước sau rộng rãi</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#D97706;text-transform:uppercase;margin-bottom:8px;">39 Căn Đơn Lập</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Biệt Thự Đơn Lập</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">251 – 640 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">4 mặt thoáng độc lập, view công viên hồ cảnh quan, thiết kế sang trọng</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#D97706;text-transform:uppercase;margin-bottom:8px;">02 Căn Dinh Thự</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">President Mansion</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">&gt; 1.000 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Vị trí trái tim dự án, bể bơi riêng, hầm rượu, chuẩn mực vương tộc</div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 8: BẢNG GIÁ THAM KHẢO & TIẾN ĐỘ THANH TOÁN 2026 -->
<section id="bang-gia" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 40px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">GIÁ GỐC CHỦ ĐẦU TƯ CITYLAND</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">BẢNG GIÁ DỰ KIẾN THE PRESIDENT PARK</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Chính sách bán hàng ưu đãi đợt 1 với tiến độ thanh toán linh hoạt cùng gói hỗ trợ tài chính đặc quyền từ các ngân hàng lớn (Vietcombank, MB, BIDV).
      </p>
    </div>

    <div style="background:#fff;border-radius:16px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 4px 20px rgba(0,0,0,0.06);margin-bottom:40px;">
      <table style="width:100%;border-collapse:collapse;font-size:15px;text-align:left;">
        <thead>
          <tr style="background:#0F172A;color:#fff;">
            <th style="padding:16px 20px;">Loại Hình Sản Phẩm</th>
            <th style="padding:16px 20px;">Diện Tích Đất</th>
            <th style="padding:16px 20px;">Diện Tích Xây Dựng</th>
            <th style="padding:16px 20px;">Giá Bán Dự Kiến (VAT)</th>
            <th style="padding:16px 20px;">Chính Sách Hỗ Trợ</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Shophouse Thương Mại</td>
            <td style="padding:16px 20px;">100 – 140 m²</td>
            <td style="padding:16px 20px;">350 – 480 m²</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 35 – 55 Tỷ</td>
            <td style="padding:16px 20px;">Vay 70%, ân hạn nợ gốc 18 tháng</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Biệt Thự Song Lập</td>
            <td style="padding:16px 20px;">196 – 264 m²</td>
            <td style="padding:16px 20px;">420 – 580 m²</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 60 – 85 Tỷ</td>
            <td style="padding:16px 20px;">Hỗ trợ lãi suất 0% 24 tháng</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Biệt Thự Đơn Lập</td>
            <td style="padding:16px 20px;">251 – 450 m²</td>
            <td style="padding:16px 20px;">550 – 850 m²</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 95 – 160 Tỷ</td>
            <td style="padding:16px 20px;">Chiết khấu thanh toán sớm đến 8%</td>
          </tr>
          <tr style="background:#F8FAFC;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Dinh Thự President Mansion</td>
            <td style="padding:16px 20px;">&gt; 1.000 m²</td>
            <td style="padding:16px 20px;">Theo thiết kế riêng</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Thỏa thuận riêng</td>
            <td style="padding:16px 20px;">Đặc quyền quản gia & tư vấn VIP</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div style="margin-top:36px;">
      [kbds_loan_calculator]
    </div>
  </div>
</section>

<!-- SECTION 9: PHÁP LÝ MINH BẠCH & UY TÍN CHỦ ĐẦU TƯ CITYLAND -->
<section id="phap-ly" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;">
      <div>
        <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">BẢO CHỨNG THỊNH VƯỢNG</span>
        <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 20px;">PHÁP LÝ MINH BẠCH – SỔ ĐỎ LÂU DÀI TỪNG CĂN</h2>
        <p style="color:#475569;font-size:16px;line-height:1.7;margin-bottom:20px;">
          Yếu tố then chốt tạo nên sức hút của <strong>The President Park Mễ Trì</strong> chính là tính pháp lý hoàn thiện và vững chắc bậc nhất phân khúc thấp tầng:
        </p>
        <ul style="color:#475569;font-size:15px;line-height:1.8;padding-left:20px;margin-bottom:24px;">
          <li>Quy hoạch chi tiết 1/500 đã được UBND TP. Hà Nội phê duyệt chính thức.</li>
          <li>Đầy đủ Quyết định giao đất, Giấy phép xây dựng và hoàn thành nghĩa vụ tài chính tiền sử dụng đất.</li>
          <li>Hình thức sở hữu: <strong>Sổ đỏ lâu dài</strong> cho người Việt Nam (ổn định vĩnh viễn, truyền đời giá trị cho các thế hệ tương lai).</li>
        </ul>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:20px 0 10px;">Thương Hiệu Chủ Đầu Tư CityLand Group:</h4>
        <p style="color:#475569;font-size:15px;line-height:1.7;">
          Với hơn hai thập kỷ tiên phong kiến tạo các khu đô thị kiểu mẫu cao cấp (tiêu biểu như CityLand Park Hills 27ha, CityLand Center Hills, CityLand Garden Hills tại TP.HCM), Tập đoàn CityLand luôn khẳng định triết lý phát triển bền vững, tiến độ chuẩn chỉ và chất lượng xây dựng vượt trội. The President Park là kiệt tác biểu tượng tiếp theo ghi dấu ấn của CityLand tại thị trường Thủ đô Hà Nội.
        </p>
      </div>
      <div>
        <div style="background:#fff;border-radius:16px;padding:36px;box-shadow:0 8px 30px rgba(0,0,0,0.06);border:1px solid #E2E8F0;">
          <h3 style="font-size:20px;font-weight:800;color:#0F172A;margin:0 0 20px;text-align:center;">5 LÝ DO THE PRESIDENT PARK LÀ TÀI SẢN TRUYỀN ĐỜI VÔ GIÁ</h3>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">01</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Vị Trí Kim Cương Kề Cận Vinhomes Green Bay</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Mặt tiền ngã tư Cương Kiên - Lương Thế Vinh kéo dài, kết nối thông suốt Đại lộ Thăng Long & Tố Hữu.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">02</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Số Lượng Giới Hạn Chỉ 149 Căn Hoàng Gia</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Tính khan hiếm tột bậc trong bối cảnh nội đô Hà Nội gần như cạn kiệt quỹ đất thấp tầng compound.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">03</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Hầm Đỗ Siêu Xe Dưới Công Viên Sinh Thái</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Giải pháp kỹ thuật ngầm tân tiến cơ cấu nâng hạ 2 tầng độc lập, bảo vệ tuyệt đối dàn siêu xe của chủ nhân.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">04</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Tổ Hợp Clubhouse 5 Sao & Golf 3D</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Hệ tiện ích đặc quyền vương giả với phòng tập Golf 3D màn hình vòm và trường mầm non nội khu 500 cháu.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">05</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Pháp Lý Sổ Đỏ Lâu Dài & Uy Tín CityLand</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Bảo chứng an toàn tuyệt đối cho dòng vốn đầu tư và tiềm năng tăng trưởng bền vững qua các chu kỳ.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 10: TIN TỨC DỰ ÁN LIÊN QUAN (TOPIC CLUSTER) -->
<section id="tin-tuc-du-an" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 40px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">CẨM NANG & THỊ TRƯỜNG</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">TIN TỨC & ĐÁNH GIÁ DỰ ÁN THE PRESIDENT PARK</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Cập nhật liên tục tiến độ thi công, phân tích quy hoạch hạ tầng giao thông và bảng giá mới nhất từ các chuyên gia Kênh Bất Động Sản.
      </p>
    </div>

    [kbds_project_news limit="12"]
  </div>
</section>

<!-- SECTION 11: FORM ĐĂNG KÝ TƯ VẤN & NHẬN BẢNG GIÁ NGOẠI GIAO -->
<section id="dang-ky" style="padding:80px 0;background:linear-gradient(135deg,#0a192f 0%,#112240 100%);color:#fff;">
  <div class="kbds-container" style="max-width:800px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:36px;">
      <span style="color:#F59E0B;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">ĐĂNG KÝ THAM QUAN & NHẬN BẢNG GIÁ GỐC</span>
      <h2 style="font-size:32px;font-weight:800;color:#fff;margin:8px 0 16px;">LIÊN HỆ PHÒNG KINH DOANH DỰ ÁN</h2>
      <p style="color:#94A3B8;font-size:15px;line-height:1.6;">
        Để lại thông tin chính xác dưới đây, chuyên viên tư vấn cao cấp CityLand sẽ gửi trọn bộ tài liệu gồm Mặt bằng quy hoạch 1/500, Thiết kế chi tiết từng căn và Bảng giá ngoại giao đợt 1 qua Zalo trong vòng 3 phút.
      </p>
    </div>

    <div style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);border-radius:16px;padding:36px;box-shadow:0 12px 30px rgba(0,0,0,0.3);">
      [kbds_lead_form project="The President Park Mễ Trì"]
    </div>
  </div>
</section>
HTML;

// 3. TẠO HOẶC CẬP NHẬT POST DỰ ÁN (du_an)
$project_slug = 'the-president-park-ha-noi';
$existing_project = get_posts([
    'post_type'   => 'du_an',
    'name'        => $project_slug,
    'posts_per_page' => 1,
    'post_status' => 'any'
]);

$project_data = [
    'post_title'   => 'The President Park Mễ Trì - Hà Nội | Biệt Thự & Shophouse CityLand',
    'post_name'    => $project_slug,
    'post_content' => $landing_html,
    'post_status'  => 'publish',
    'post_type'    => 'du_an',
    'post_excerpt' => 'The President Park (Khu nhà ở thấp tầng CityLand Mễ Trì) quy mô 6,6ha gồm 149 sản phẩm biệt thự, shophouse và dinh thự hoàng gia tại ngã tư Cương Kiên - Lương Thế Vinh kéo dài, đối diện Vinhomes Green Bay Mễ Trì. Sở hữu Clubhouse 5 sao, Golf 3D và hầm đỗ siêu xe ngầm dưới công viên sinh thái.',
];

if (!empty($existing_project)) {
    $project_id = $existing_project[0]->ID;
    $project_data['ID'] = $project_id;
    wp_update_post($project_data);
    echo " ✔ Đã cập nhật Dự án The President Park (ID: {$project_id})\n";
} else {
    $project_id = wp_insert_post($project_data);
    echo " + Đã tạo mới Dự án The President Park (ID: {$project_id})\n";
}

// Thiết lập Featured Image (Ảnh đại diện)
if (!empty($m['poster_tong_the']['id'])) {
    set_post_thumbnail($project_id, $m['poster_tong_the']['id']);
}

// Gán Taxonomies
wp_set_object_terms($project_id, ['ha-noi', 'nam-tu-liem'], 'khu_vuc_bds');
wp_set_object_terms($project_id, ['khu-do-thi-biet-thu', 'nha-pho-shophouse'], 'loai_hinh_bds');
wp_set_object_terms($project_id, 'sap-mo-ban', 'trang_thai_du_an');
wp_set_object_terms($project_id, 'cityland-group', 'chu_dau_tu');

// Cập nhật Meta fields chuẩn mô hình B
update_post_meta($project_id, '_kbds_project_code', 'DA-PRESIDENTPARK');
update_post_meta($project_id, '_kbds_price_from', 'Từ 35 Tỷ/Căn (Shophouse) – Từ 60 Tỷ/Căn (Biệt thự)');
update_post_meta($project_id, '_kbds_price_min_num', '35000');
update_post_meta($project_id, '_kbds_address', 'Ngã tư đường Cương Kiên và Lương Thế Vinh kéo dài, P. Mễ Trì, Q. Nam Từ Liêm, TP. Hà Nội (đối diện Vinhomes Green Bay)');
update_post_meta($project_id, '_kbds_total_area', '6,6 ha (Mật độ xây dựng ~30,67%)');
update_post_meta($project_id, '_kbds_scale', '149 sản phẩm thấp tầng gồm 65 shophouse (100–245m²), 43 biệt thự song lập (196–301m²), 39 biệt thự đơn lập (251–640m²) và 02 dinh thự (>1.000m²)');
update_post_meta($project_id, '_kbds_legal_status', 'Khu nhà ở thấp tầng CityLand Mễ Trì (Ô đất CQ1.1) - Quy hoạch 1/500, Đã giao đất & cấp phép xây dựng, Sổ đỏ lâu dài');
update_post_meta($project_id, '_kbds_handover_time', 'Dự kiến Quý IV/2026 – Quý II/2027 (Bàn giao hoàn thiện mặt ngoài, thô bên trong)');
update_post_meta($project_id, '_kbds_bank_support', 'Ngân hàng hỗ trợ vay 70%, ân hạn nợ gốc và lãi suất 0% từ 18 – 24 tháng');
update_post_meta($project_id, '_kbds_review_score', '9.6');
update_post_meta($project_id, '_kbds_pros_cons', "+ Vị trí kim cương ngã tư Cương Kiên - Lương Thế Vinh kéo dài, trực diện Vinhomes Green Bay và hồ điều hòa 8ha\n+ Mật độ xây dựng siêu thấp 30,67% với chỉ 149 căn hoàng gia compound biệt lập\n+ Tiện ích độc bản chưa từng có: Hầm đỗ siêu xe ngầm thông minh 2 tầng ẩn dưới công viên sinh thái, độc lập hoàn toàn không liên quan đất nhà dân\n+ Tổ hợp Clubhouse 5 sao với phòng tập Golf 3D màn hình vòm và trường mầm non nội khu 500 cháu\n+ Chủ đầu tư CityLand Group uy tín với pháp lý Sổ đỏ lâu dài\n- Phân khúc siêu sang kén khách, giá trị tài sản lớn phù hợp giới thượng lưu");

// Cấu hình Rank Math SEO cho Dự án
update_post_meta($project_id, 'rank_math_title', 'The President Park Mễ Trì Hà Nội | Bảng Giá & Giỏ Hàng CityLand 2026');
update_post_meta($project_id, 'rank_math_description', 'Đánh giá chi tiết dự án The President Park Mễ Trì (Khu đô thị CityLand 6,6ha, 149 căn thấp tầng) ngã tư Cương Kiên - Lương Thế Vinh kéo dài đối diện Vinhomes Green Bay. Bảng giá biệt thự, shophouse & chính sách CityLand.');
update_post_meta($project_id, 'rank_math_focus_keyword', 'the president park, the president park mễ trì, the president park hà nội, cityland mễ trì');
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
    // Bài 1: Đánh giá vị trí ngã tư Cương Kiên - Lương Thế Vinh kéo dài
    [
        'title' => 'Đánh Giá Vị Trí The President Park Mễ Trì: Tọa Độ Vàng Ngã Tư Cương Kiên – Lương Thế Vinh Kéo Dài Kề Cận Vinhomes Green Bay',
        'slug'  => 'vi-tri-the-president-park-me-tri-nga-tu-cuong-kien-luong-the-vinh',
        'cat_id'=> $cat_pl_id,
        'thumb' => $m['so_do_vi_tri']['id'],
        'focus_kw' => 'vị trí the president park, the president park mễ trì, đường cương kiên mễ trì, lương thế vinh kéo dài',
        'desc'  => 'Phân tích chi tiết vị trí ngã tư Cương Kiên - Lương Thế Vinh kéo dài của dự án The President Park Mễ Trì: Lợi thế kết nối Đại lộ Thăng Long, Tố Hữu và kề cận Vinhomes Green Bay.',
        'content' => <<<HTML
<p>Trong bối cảnh khu vực nội đô lịch sử và phía Tây Hà Nội gần như không còn quỹ đất phát triển các khu đô thị thấp tầng sinh thái compound, sự xuất hiện của <strong><a href="{$project_url}">The President Park</a></strong> (Khu nhà ở thấp tầng CityLand Mễ Trì) tại ô đất vàng CQ1.1 (Đài phát sóng Mễ Trì cũ) lập tức trở thành tâm điểm chú ý của giới tinh hoa và các nhà đầu tư bất động sản siêu sang.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['so_do_vi_tri']['url']}" alt="{$m['so_do_vi_tri']['alt']}"/><figcaption>{$m['so_do_vi_tri']['caption']}</figcaption></figure></div>

<h2>1. Tọa Độ Kim Cương Ngay Giao Lộ Huyết Mạch Phía Tây</h2>
<p><strong>The President Park Mễ Trì</strong> tọa lạc đắc địa tại ngã tư giao nhau giữa hai tuyến đường chiến lược: <strong>đường Cương Kiên</strong> và <strong>đường Lương Thế Vinh kéo dài</strong> thuộc phường Mễ Trì, quận Nam Từ Liêm, Hà Nội. Đây là khu vực có tốc độ phát triển đô thị hóa và hạ tầng giao thông đồng bộ bậc nhất Thủ đô:</p>
<ul>
  <li><strong>Đường Cương Kiên:</strong> Tuyến phố sầm uất kết nối trực tiếp từ trục Đại lộ Thăng Long sang đường Miếu Đầm, đối diện khách sạn 5 sao quốc tế JW Marriott và Trung tâm Hội nghị Quốc gia.</li>
  <li><strong>Đường Lương Thế Vinh kéo dài:</strong> Trục đại lộ xương sống kết nối xuyên tâm từ Đại lộ Thăng Long, giao cắt Cương Kiên và chạy thẳng qua đường Tố Hữu (Lê Văn Lương kéo dài) sang đường Nguyễn Trãi (quận Thanh Xuân), giúp cư dân rút ngắn thời gian di chuyển tới các quận trung tâm chỉ trong vài phút.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['poster_tong_the']['url']}" alt="{$m['poster_tong_the']['alt']}"/><figcaption>{$m['poster_tong_the']['caption']}</figcaption></figure></div>

<h2>2. Lợi Thế Kề Cận Đại Đô Thị Sinh Thái Vinhomes Green Bay</h2>
<p>Một trong những giá trị phong thủy và cảnh quan đắt giá nhất của The President Park chính là việc nằm <strong>đối diện trực tiếp KĐT sinh thái Vinhomes Green Bay Mễ Trì</strong>. Cư dân tại The President Park được thừa hưởng trọn vẹn luồng không khí trong lành, tươi mát từ hồ điều hòa rộng 8ha và cảnh quan xanh mát bao bọc.</p>
<p>Bên cạnh đó, vị trí dự án còn tiếp cận nhanh chóng chuỗi tiện ích ngoại khu chuẩn quốc tế:</p>
<ul>
  <li>Trung tâm Hội nghị Quốc gia, Bảo tàng Hà Nội (3 phút).</li>
  <li>Khách sạn 5 sao JW Marriott Hà Nội (3 phút).</li>
  <li>TTTM The Garden, Keangnam Landmark 72 (5 phút).</li>
  <li>Trường THPT Chuyên Hà Nội - Amsterdam, Đại học Quốc Gia Hà Nội (7 phút).</li>
  <li>Sân bay Quốc tế Nội Bài qua đường Vành Đai 3 trên cao chỉ 30 phút.</li>
</ul>

<h2>3. Tiềm Năng Tăng Giá Vượt Trội Từ Đòn Bẩy Hạ Tầng</h2>
<p>Khi tuyến đường Lương Thế Vinh kéo dài được hoàn thiện kết nối đồng bộ toàn tuyến, lưu lượng giao thương qua khu vực ngã tư Cương Kiên sẽ tăng vọt, biến 65 căn Shophouse thương mại tại The President Park thành những "cỗ máy in tiền" đắt giá với giá trị khai thác kinh doanh và cho thuê vượt bậc.</p>
<p>Xem thông tin chi tiết bảng giá và chính sách từng phân khu tại trang <strong><a href="{$project_url}">Dự án The President Park Mễ Trì</a></strong>.</p>
HTML
    ],

    // Bài 2: Khám phá hầm đỗ xe ngầm thông minh cho siêu xe
    [
        'title' => 'Khám Phá Hệ Thống Hầm Đỗ Xe Ngầm Thông Minh Cho Siêu Xe Dưới Công Viên Sinh Thái The President Park',
        'slug'  => 'ham-do-xe-ngam-thong-minh-sieu-xe-the-president-park',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['ham_ngam_sieu_xe']['id'],
        'focus_kw' => 'hầm đỗ xe the president park, hầm siêu xe the president park, the president park mễ trì, công viên the president park',
        'desc'  => 'Giải mã tiện ích độc bản hầm đỗ xe ngầm thông minh cho siêu xe tại The President Park Mễ Trì: Ẩn mình dưới công viên sinh thái, cơ cấu nâng hạ 2 tầng, độc lập hoàn toàn đất nhà dân.',
        'content' => <<<HTML
<p>Đối với giới siêu giàu, việc sở hữu những chiếc siêu xe triệu đô (Supercars & Hypercars) như Ferrari, Lamborghini, Rolls-Royce hay Porsche luôn đi kèm một bài toán nan giải: <em>Đỗ xe ở đâu an toàn, tránh va chạm, chống ngập nước và không bị giới hạn không gian?</em> Tại <strong><a href="{$project_url}">The President Park</a></strong>, Chủ đầu tư CityLand Group đã đưa ra câu trả lời xuất sắc bằng hệ thống <strong>Hầm đỗ xe ngầm thông minh ẩn mình dưới lòng công viên trung tâm sinh thái</strong>.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['ham_ngam_sieu_xe']['url']}" alt="{$m['ham_ngam_sieu_xe']['alt']}"/><figcaption>{$m['ham_ngam_sieu_xe']['caption']}</figcaption></figure></div>

<h2>1. Quy Hoạch Độc Lập Hoàn Toàn – Không Liên Quan Đất Nhà Dân</h2>
<p>Khác biệt hoàn toàn với các dự án biệt thự truyền thống (nơi gara thường bố trí tầng trệt hoặc tầng hầm riêng lẻ dưới móng nhà), hầm đỗ xe của The President Park được <strong>quy hoạch 100% nằm ẩn mình bên dưới công viên trung tâm sinh thái</strong>:</p>
<ul>
  <li><strong>Triệt tiêu tiếng ồn & khí thải:</strong> Tiếng gầm rú uy lực của động cơ V8, V12 hay mùi khói xăng khi khởi động sẽ không làm ảnh hưởng đến không gian tĩnh lặng và thanh bình của các căn biệt thự xung quanh.</li>
  <li><strong>Bảo vệ kết cấu công trình:</strong> Việc thi công hầm ngầm độc lập dưới đất công viên không tác động đến móng cọc hay tĩnh tải của các căn nhà ở, mang lại sự bền vững vĩnh cửu cho toàn khu đô thị.</li>
</ul>

<h2>2. Công Nghệ Thang Nâng Đỗ Xe Thông Minh 2 Tầng (Smart Car Lift)</h2>
<p>Bên trong hầm ngầm được ứng dụng công nghệ cơ khí nâng hạ tự động 2 tầng chuẩn Đức. Hệ thống cho phép tăng gấp đôi công suất đỗ xe mà vẫn giữ lối di chuyển rộng rãi, thông thoáng:</p>
<ul>
  <li>Ram dốc xuống hầm được thiết kế độ dốc siêu thoai thoải (dưới 10%), loại bỏ hoàn toàn nguy cơ cạ gầm cho những siêu xe thể thao có khoảng sáng gầm cực thấp.</li>
  <li>Các vị trí đỗ xe được phân chia kích thước ngoại cỡ, trang bị đệm chống trầy xước và hệ thống sạc điện nhanh thông minh sẵn sàng cho các dòng xe điện cao cấp (Porsche Taycan, Rolls-Royce Spectre...).</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['quang_truong_colosseum_dem']['url']}" alt="{$m['quang_truong_colosseum_dem']['alt']}"/><figcaption>{$m['quang_truong_colosseum_dem']['caption']}</figcaption></figure></div>

<h2>3. Tiêu Chuẩn Phòng Ngừa Rủi Ro & An Ninh Sinh Trắc Học Tối Tân</h2>
<p>Để bảo vệ trọn vẹn những cỗ máy giá trị hàng chục tỷ đồng của cư dân, tầng hầm The President Park được trang bị:</p>
<ul>
  <li><strong>Hệ thống trạm bơm thoát nước cưỡng bức tự động 3 cấp:</strong> Đảm bảo không xảy ra hiện tượng ngập úng dù trong điều kiện mưa bão lớn nhất lịch sử.</li>
  <li><strong>Hệ thống chữa cháy khí sạch FM-200:</strong> Dập lửa tức thì mà không dùng nước, bảo vệ tuyệt đối linh kiện điện tử và động cơ siêu xe.</li>
  <li><strong>Hệ thống lọc khí tươi & thông gió tuần hoàn:</strong> Giữ nhiệt độ và độ ẩm hầm xe luôn ở mức lý tưởng như một showroom triển lãm xe hơi đẳng cấp.</li>
</ul>

<p>Khám phá trọn bộ tiện ích thượng lưu của dự án tại <strong><a href="{$project_url}">Hồ sơ The President Park Mễ Trì</a></strong>.</p>
HTML
    ],

    // Bài 3: Tổ hợp Clubhouse 5 sao, Golf 3D & Mầm non 500 cháu
    [
        'title' => 'Tổ Hợp Clubhouse 5 Sao The President Park: Đặc Quyền Sống Vương Giả Với Phòng Tập Golf 3D Màn Hình Vòm & Trường Mầm Non 500 Cháu',
        'slug'  => 'to-hop-clubhouse-5-sao-golf-3d-the-president-park',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['clubhouse_5_sao']['id'],
        'focus_kw' => 'clubhouse the president park, golf 3d the president park, tiện ích the president park, trường mầm non the president park',
        'desc'  => 'Trải nghiệm chuỗi đặc quyền vương giả tại Clubhouse 5 sao The President Park: Phòng tập Golf 3D màn hình vòm, Gym Yoga Spa, bể bơi tràn ngoài trời và trường mầm non 500 cháu.',
        'content' => <<<HTML
<p>Một cộng đồng thượng lưu đúng nghĩa không chỉ cần những căn biệt thự lộng lẫy, mà còn đòi hỏi một không gian sinh hoạt chung xứng tầm để kết nối và tận hưởng cuộc sống. Tại <strong><a href="{$project_url}">The President Park Mễ Trì</a></strong>, tổ hợp <strong>Clubhouse 5 sao sang trọng</strong> chính là trái tim tiện ích, mang đến những đặc quyền vương giả được cá nhân hóa cho từng chủ nhân.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['clubhouse_5_sao']['url']}" alt="{$m['clubhouse_5_sao']['alt']}"/><figcaption>{$m['clubhouse_5_sao']['caption']}</figcaption></figure></div>

<h2>1. Phòng Tập Golf 3D Màn Hình Vòm – Đẳng Cấp Thể Thao Quý Tộc</h2>
<p>Golf luôn là môn thể thao biểu tượng của giới tinh hoa kinh doanh. Thấu hiểu điều đó, CityLand Group đã đưa công nghệ giả lập Golf 3D tối tân bậc nhất vào tổ hợp Clubhouse:</p>
<ul>
  <li><strong>Màn hình vòm đa hướng Panorama:</strong> Mang lại cảm giác thị giác chân thực 360 độ, tái hiện sống động âm thanh và cảnh quan của các sân golf PGA danh tiếng thế giới như St Andrews, Pebble Beach hay Augusta National.</li>
  <li><strong>Cảm biến radar phân tích đường bóng độ chính xác cao:</strong> Đo lường chi tiết tốc độ vung gậy, góc phóng, độ xoáy bóng, hỗ trợ cư dân luyện tập nâng cao trình độ ngay tại nhà mà không cần phụ thuộc vào điều kiện thời tiết ngoài trời.</li>
</ul>

<h2>2. Bể Bơi Tràn Bờ Ngoài Trời & Khu Gym, Yoga, Spa VIP</h2>
<p>Nằm trên tầng cao của Clubhouse với tầm nhìn hướng trọn về công viên cây xanh và quảng trường La Mã, <strong>Bể bơi tràn bờ ngoài trời</strong> được trang bị hệ thống lọc nước điện phân muối khoáng tự nhiên, an toàn cho làn da và đôi mắt.</p>
<p>Kề cận là tổ hợp chăm sóc sức khỏe toàn diện với trung tâm Gym trang bị máy móc Technogym nhập khẩu, phòng Yoga tĩnh tại và khu Spa xông hơi thảo dược giúp tái tạo năng lượng hoàn hảo sau những giờ làm việc căng thẳng.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['thap_obelisk_dai_phun_nuoc']['url']}" alt="{$m['thap_obelisk_dai_phun_nuoc']['alt']}"/><figcaption>{$m['thap_obelisk_dai_phun_nuoc']['caption']}</figcaption></figure></div>

<h2>3. Trường Mầm Non Nội Khu Quy Mô 500 Cháu – Môi Trường Phát Triển Toàn Diện</h2>
<p>Đặc biệt quan tâm đến thế hệ tương lai, The President Park dành riêng một khối nhà trong tổ hợp tiện ích để xây dựng <strong>Trường mầm non quốc tế quy mô 500 cháu</strong>:</p>
<ul>
  <li>Chương trình giáo dục song ngữ tiên tiến kết hợp phương pháp phát triển kỹ năng tư duy và thể chất.</li>
  <li>Khu vui chơi ngoài trời an toàn, chan hòa ánh nắng và cây xanh, được bảo vệ nghiêm ngặt 24/7.</li>
  <li>Cha mẹ hoàn toàn an tâm khi con trẻ được học tập và vui chơi ngay bên trong khuôn viên compound khép kín, loại bỏ nỗi lo tắc đường hay khói bụi khi đưa đón.</li>
</ul>

<h2>4. Nhà Hàng & Cafe Lounge Sang Trọng</h2>
<p>Tầng trệt Clubhouse là nơi tọa lạc của chuỗi nhà hàng cao cấp và cafe lounge thanh lịch. Đây là không gian lý tưởng cho các buổi tiệc gia đình ấm cúng, gặp gỡ đối tác ngoại giao hay giao lưu thân tình giữa những người hàng xóm cùng đẳng cấp tri thức và địa vị xã hội.</p>

<p>Đăng ký nhận vé mời tham quan trải nghiệm Clubhouse tại <strong><a href="{$project_url}">Trang Dự Án The President Park</a></strong>.</p>
HTML
    ],

    // Bài 4: Cập nhật bảng giá & quy hoạch 149 căn biệt thự, shophouse 2026
    [
        'title' => 'Cập Nhật Bảng Giá & Quy Hoạch 149 Căn Biệt Thự, Shophouse, Dinh Thự The President Park Năm 2026',
        'slug'  => 'bang-gia-quy-hoach-149-can-biet-thu-shophouse-the-president-park',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['poster_tong_the']['id'],
        'focus_kw' => 'bảng giá the president park, giá biệt thự the president park, shophouse the president park, dinh thự the president park',
        'desc'  => 'Cập nhật bảng giá chi tiết và chính sách bán hàng đợt 1 dự án The President Park Mễ Trì Hà Nội: Giá bán shophouse, biệt thự song lập, đơn lập và dinh thự hoàng gia CityLand.',
        'content' => <<<HTML
<p>Với số lượng cực kỳ giới hạn chỉ <strong>149 sản phẩm thấp tầng</strong> trên quỹ đất 6,6ha tại trung tâm Mễ Trì, <strong><a href="{$project_url}">The President Park</a></strong> của Tập đoàn CityLand đang tạo nên cơn sốt thực sự tại thị trường bất động sản phía Tây Hà Nội trong năm 2026. Dưới đây là phân tích chi tiết quy hoạch cơ cấu sản phẩm và bảng giá dự kiến đợt mở bán đầu tiên.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['poster_tong_the']['url']}" alt="{$m['poster_tong_the']['alt']}"/><figcaption>{$m['poster_tong_the']['caption']}</figcaption></figure></div>

<h2>1. Cơ Cấu Sản Phẩm Giới Hạn Tại The President Park</h2>
<p>Quần thể The President Park được chia thành 4 dòng sản phẩm chính, đáp ứng trọn vẹn nhu cầu ở thực thượng lưu, kinh doanh thương mại và tích sản truyền đời:</p>
<ul>
  <li><strong>65 Căn Shophouse (Nhà phố thương mại):</strong> Diện tích đất từ 100m² – 245m², xây dựng 4 – 5 tầng. Sở hữu mặt tiền rộng mở trên đường Cương Kiên và các trục giao thông chính nội khu, tối ưu công năng vừa kinh doanh vừa để ở.</li>
  <li><strong>43 Căn Biệt thự Song lập:</strong> Diện tích đất từ 196m² – 301m², xây dựng 3 tầng + 1 tum. Thiết kế 3 mặt thoáng với khoảng lùi sân vườn thanh lịch, thích hợp cho các gia đình đa thế hệ.</li>
  <li><strong>39 Căn Biệt thự Đơn lập:</strong> Diện tích đất từ 251m² – 640m². Tọa lạc tại các vị trí đắc địa view trực diện công viên sinh thái và quảng trường La Mã, sở hữu 4 mặt thoáng chan hòa ánh sáng.</li>
  <li><strong>02 Căn Dinh thự Độc bản (President Mansion):</strong> Diện tích khủng trên 1.000m² – 1.100m², nằm tại lõi trung tâm dự án, thiết kế biệt lập với hồ bơi riêng, hầm rượu và sân vườn hoàng gia.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['quang_truong_colosseum_dem']['url']}" alt="{$m['quang_truong_colosseum_dem']['alt']}"/><figcaption>{$m['quang_truong_colosseum_dem']['caption']}</figcaption></figure></div>

<h2>2. Bảng Giá Dự Kiến Đợt 1 (Đã bao gồm VAT & Xây Thô Hoàn Thiện Ngoài)</h2>
<p>Mức giá bán The President Park phản ánh đúng vị thế kim cương và giá trị độc bản của bất động sản thấp tầng tại trung tâm Nam Từ Liêm:</p>
<table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:15px;">
  <thead>
    <tr style="background:#0F172A;color:#fff;">
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Loại Sản Phẩm</th>
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Diện Tích Đất</th>
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Giá Bán Dự Kiến (VAT)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Shophouse Thương Mại</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">100 – 140 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 35 – 55 Tỷ/Căn</td>
    </tr>
    <tr style="background:#F8FAFC;">
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Biệt Thự Song Lập</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">196 – 264 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 60 – 85 Tỷ/Căn</td>
    </tr>
    <tr>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Biệt Thự Đơn Lập</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">251 – 450 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 95 – 160 Tỷ/Căn</td>
    </tr>
    <tr style="background:#F8FAFC;">
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Dinh Thự Độc Bản</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">&gt; 1.000 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Liên hệ thỏa thuận riêng</td>
    </tr>
  </tbody>
</table>

<h2>3. Chính Sách Ưu Đãi & Tiến Độ Thanh Toán Đột Phá</h2>
<p>Chủ đầu tư CityLand Group áp dụng gói giải pháp tài chính linh hoạt nhằm tối ưu hóa dòng tiền cho khách hàng:</p>
<ul>
  <li><strong>Hỗ trợ vay vốn ngân hàng:</strong> Ngân hàng hỗ trợ vay tới 70% giá trị hợp đồng, hỗ trợ lãi suất 0% và ân hạn nợ gốc từ 18 đến 24 tháng.</li>
  <li><strong>Chiết khấu thanh toán sớm:</strong> Khách hàng thanh toán sớm bằng vốn tự có nhận chiết khấu lên đến 8% giá trị sản phẩm.</li>
  <li><strong>Quà tặng đặc quyền:</strong> Tặng thẻ hội viên VIP Golf 3D trọn đời và gói dịch vụ quản gia cao cấp trong 3 năm đầu tiên.</li>
</ul>

<p>Đăng ký nhận bảng tính chi tiết từng mã căn tại <strong><a href="{$project_url}">Hồ Sơ The President Park CityLand</a></strong>.</p>
HTML
    ]
];

// Tạo các bài viết vệ tinh
echo "\n--- ĐANG TẠO 4 BÀI VIẾT VỆ TINH TOPIC CLUSTER CHO THE PRESIDENT PARK ---\n";
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
    wp_set_post_tags($art_id, ['The President Park', 'The President Park Mễ Trì', 'CityLand Mễ Trì', 'Biệt thự The President Park'], true);

    // Rank Math SEO
    update_post_meta($art_id, 'rank_math_title', $art['title'] . ' | Kênh Bất Động Sản');
    update_post_meta($art_id, 'rank_math_description', $art['desc']);
    update_post_meta($art_id, 'rank_math_focus_keyword', $art['focus_kw']);
    update_post_meta($art_id, 'rank_math_robots', ['index', 'follow']);
}

echo "\n==============================================================\n";
echo "🎉 HOÀN TẤT XÂY DỰNG LANDING PAGE & 4 BÀI VIẾT VỆ TINH THE PRESIDENT PARK!\n";
echo "==============================================================\n";
