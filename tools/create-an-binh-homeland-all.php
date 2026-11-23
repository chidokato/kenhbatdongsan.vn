<?php
/**
 * Tạo trọn gói Dự Án Chung Cư An Bình Homeland (Geleximco - Lê Trọng Tấn, Hà Đông)
 * Bao gồm:
 * 1. Hồ sơ Dự án CPT du_an + Landing Page 10 Section chuẩn UX/UI
 * 2. 2 Căn hộ Giỏ hàng xác thực CPT bat_dong_san
 * 3. 4 Bài viết vệ tinh chuyên sâu CPT post liên kết Topic Cluster
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU XÂY DỰNG DỰ ÁN CHUNG CƯ AN BÌNH HOMELAND (GELEXIMCO)\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/an-binh-homeland-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy an-binh-homeland-media-map.json\n");
}
$m = json_decode(file_get_contents($map_file), true);

// 1. Khởi tạo Taxonomy Terms
if (!term_exists('Tập đoàn Geleximco', 'chu_dau_tu')) {
    wp_insert_term('Tập đoàn Geleximco', 'chu_dau_tu', [
        'slug' => 'geleximco',
        'description' => 'Tập đoàn Geleximco (Glexhomes) - Thương hiệu bất động sản hàng đầu với các đại dự án: An Bình City, Geleximco Lê Trọng Tấn, An Bình Plaza...'
    ]);
    echo " + Tạo term CĐT: Tập đoàn Geleximco\n";
}

if (!term_exists('Hà Nội', 'khu_vuc_bds')) {
    wp_insert_term('Hà Nội', 'khu_vuc_bds', ['slug' => 'ha-noi', 'description' => 'Bất động sản Thủ đô Hà Nội']);
}
if (!term_exists('Hà Đông', 'khu_vuc_bds')) {
    $parent_hn = term_exists('Hà Nội', 'khu_vuc_bds');
    $p_id = is_array($parent_hn) ? $parent_hn['term_id'] : 0;
    wp_insert_term('Hà Đông', 'khu_vuc_bds', [
        'slug' => 'ha-dong',
        'parent' => $p_id,
        'description' => 'Quận Hà Đông, Hà Nội - Tâm điểm đón sóng hạ tầng phía Tây Thủ đô'
    ]);
    echo " + Tạo term Khu vực: Hà Đông\n";
}

// 2. Nội dung Landing Page 10 Section chuẩn UX
$subnav_html = '<div class="kbds-project-subnav"><div class="kbds-container kbds-subnav-container"><div class="kbds-subnav-brand"><span class="kbds-subnav-dot"></span>AN BÌNH HOMELAND</div><a href="#dang-ky" class="kbds-subnav-cta">Nhận Báo Giá Gốc</a><nav class="kbds-subnav-links"><a href="#tong-quan" class="kbds-subnav-link">Tổng Quan</a><a href="#vi-tri" class="kbds-subnav-link">Vị Trí</a><a href="#tien-ich" class="kbds-subnav-link">Tiện Ích Resort</a><a href="#mat-bang" class="kbds-subnav-link">Mặt Bằng Tòa C1</a><a href="#can-ho" class="kbds-subnav-link">Căn Hộ Mẫu</a><a href="#bang-gia" class="kbds-subnav-link">Bảng Giá Đợt 1</a><a href="#phap-ly" class="kbds-subnav-link">Pháp Lý & CĐT</a><a href="#tin-tuc-du-an" class="kbds-subnav-link">Tin Tức</a></nav></div></div>';

$landing_html = <<<HTML
{$subnav_html}

<!-- SECTION 1: HERO BANNER -->
<section style="position:relative;background:linear-gradient(135deg,#071D36 0%,#0B2C4D 50%,#164E8E 100%);color:#fff;padding:80px 0 100px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.25;background:radial-gradient(circle at 75% 25%,#D4AF37 0%,transparent 65%);pointer-events:none;"></div>
  <div class="kbds-container" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:40px;align-items:center;">
    <div>
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(212,175,55,0.2);border:1px solid rgba(212,175,55,0.5);color:#FDE68A;padding:6px 18px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;">
        ⭐ GELEXIMCO GROUP • TỔ HỢP CĂN HỘ CAO CẤP TÂY HÀ NỘI
      </div>
      <h1 style="color:#FFFFFF;font-size:40px;font-weight:900;line-height:1.2;margin:0 0 18px;font-family:'Playfair Display',Georgia,serif;">
        CHUNG CƯ AN BÌNH HOMELAND
        <span style="display:block;font-size:22px;font-weight:600;color:#D4AF37;margin-top:6px;font-family:'Be Vietnam Pro',sans-serif;">Khu Đô Thị Geleximco Lê Trọng Tấn, Quận Hà Đông, Hà Nội</span>
      </h1>
      <p style="color:#E2E8F0;font-size:16px;line-height:1.7;margin:0 0 28px;max-width:620px;">
        Tọa lạc đắc địa tại <strong>Lô đất C19, Phân khu C – KĐT Geleximco Lê Trọng Tấn</strong>, Hà Đông. <strong>An Bình Homeland</strong> là quần thể căn hộ chuẩn hiện đại quy mô <strong>15.702 m²</strong> do <strong>Tập đoàn Geleximco</strong> đầu tư phát triển. Với quy hoạch thông minh gồm <strong>4 tòa tháp cao 25 tầng (C1, C2, C3, C4)</strong> ôm trọn công viên lõi xanh <strong>3.840 m²</strong> và hồ bơi phong cách resort nhiệt đới, dự án mang đến chuẩn mực sống an cư trọn vẹn tại cửa ngõ Tây Nam Thủ đô.
      </p>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:30px;">
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 10px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#FDE68A;">1,57 ha</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Quy mô dự án</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 10px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#38BDF8;">4 Tòa Tháp</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Cao 25 Tầng Nổi</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 10px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#4ADE80;">3 Phút</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Đến Aeon Mall</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 10px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#F472B6;">Sổ Hồng</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Lâu dài vĩnh viễn</div>
        </div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:linear-gradient(135deg,#D4AF37 0%,#AA8010 100%);color:#071D36;font-weight:800;padding:14px 28px;border-radius:8px;text-decoration:none;box-shadow:0 6px 20px rgba(212,175,55,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Nhận Báo Giá Đợt 1 & Mặt Bằng Tòa C1</span> →
        </a>
        <a href="#mat-bang" style="background:transparent;color:#fff;font-weight:600;padding:14px 24px;border-radius:8px;text-decoration:none;border:1px solid rgba(255,255,255,0.35);">
          Xem Mặt Bằng Chi Tiết
        </a>
      </div>
    </div>
    <div>
      [kbds_quick_lead_card_cao_tang project="Chung Cư An Bình Homeland Hà Đông" title="NHẬN BẢNG GIÁ GỐC ĐỢT 1" subtitle="Tải trọn bộ Layout bóc mái 3D, Bảng giá Studio - 3PN và Chính sách vay 0% từ CĐT"]
    </div>
  </div>
</section>

<!-- SECTION 2: TỔNG QUAN HỒ SƠ DỰ ÁN -->
<section id="tong-quan" style="padding:70px 0;background:#ffffff;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px;">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px;">HỒ SƠ NĂNG LỰC DỰ ÁN</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif;">TỔNG QUAN AN BÌNH HOMELAND GELEXIMCO</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6;">Tổ hợp căn hộ cao cấp khép kín với hệ tiện ích All-in-one hoàn chỉnh, kế thừa trọn vẹn hạ tầng đồng bộ của Đại đô thị Geleximco Lê Trọng Tấn 135ha.</p>
    </div>
    
    <div style="display:grid;grid-template-columns:1.1fr 0.9fr;gap:35px;align-items:center;">
      <div style="border-radius:14px;overflow:hidden;box-shadow:0 12px 30px rgba(11,44,77,0.12);border:1px solid #E2E8F0;">
        <img src="{$m['phoi-canh-tong-the-4-toa-an-binh-homeland']['url']}" alt="{$m['phoi-canh-tong-the-4-toa-an-binh-homeland']['alt']}" style="width:100%;height:auto;display:block;" />
      </div>
      <div>
        <table style="width:100%;border-collapse:collapse;font-size:14.5px;">
          <tbody>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;width:38%;">Tên thương mại:</td><td style="padding:12px 10px;color:#334155;"><strong>An Bình Homeland</strong> (An Bình Home Land Geleximco)</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Chủ đầu tư:</td><td style="padding:12px 10px;color:#334155;"><strong>Tập đoàn Geleximco</strong> (Công ty CP Ngôi Sao An Bình / Glexhomes)</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Vị trí tọa lạc:</td><td style="padding:12px 10px;color:#334155;">Lô C19, Phân khu C – KĐT Geleximco, Đ. Lê Trọng Tấn, Q. Hà Đông, Hà Nội</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Tổng diện tích:</td><td style="padding:12px 10px;color:#334155;">15.702 m² (~1.57 ha), mật độ xây dựng khối tháp ~45%</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Quy mô tháp:</td><td style="padding:12px 10px;color:#334155;">4 tòa tháp căn hộ (C1, C2, C3, C4) cao 25 tầng + 2 tầng hầm thông nhau</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Mật độ căn/sàn:</td><td style="padding:12px 10px;color:#334155;">14 căn/sàn (Tòa C1), 4 thang máy tốc độ cao + 2 thang bộ thoát hiểm</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Cơ cấu căn hộ:</td><td style="padding:12px 10px;color:#334155;">2PN (68.1m²), 2PN+1 (74.6m² - 74.8m²), 3PN (68.8m² - 92.9m²)</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Diện tích công viên:</td><td style="padding:12px 10px;color:#334155;">3.840 m² cây xanh, hồ bơi resort, quảng trường trung tâm</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Đơn vị thiết kế:</td><td style="padding:12px 10px;color:#334155;">Công ty CP Tư vấn Xây dựng CONSTECH Việt Nam</td></tr>
            <tr><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;">Hình thức sở hữu:</td><td style="padding:12px 10px;color:#16A34A;font-weight:700;">Sổ hồng sở hữu lâu dài (vĩnh viễn)</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VỊ TRÍ & LIÊN KẾT HẠ TẦNG CHIẾN LƯỢC -->
<section id="vi-tri" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px;">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px;">TÂM ĐIỂM SIÊU KẾT NỐI TÂY HÀ NỘI</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif;">VỊ TRÍ ĐẮC ĐỊA MẶT TIỀN ĐƯỜNG LÊ TRỌNG TẤN</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6;">Sở hữu vị trí vàng ngay trung tâm Phân khu C Khu đô thị Geleximco, kết nối trực tiếp các đại lộ huyết mạch và hưởng trọn tiện ích bậc nhất phía Tây Thủ đô.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:35px;">
      <div style="background:#fff;border-radius:12px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.04);">
        <div style="font-size:32px;margin-bottom:12px;">🛣️</div>
        <h3 style="font-size:18px;font-weight:800;color:#0B2C4D;margin:0 0 10px;">Trục Đường Huyết Mạch</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0;">Tọa lạc ngay mặt đường đôi Lê Trọng Tấn (Hà Đông) rộng 42m, giao thoa trực tiếp cùng Đại lộ Thăng Long, Tố Hữu - Lê Văn Lương và Vành Đai 3.5.</p>
      </div>
      <div style="background:#fff;border-radius:12px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.04);">
        <div style="font-size:32px;margin-bottom:12px;">🚀</div>
        <h3 style="font-size:18px;font-weight:800;color:#0B2C4D;margin:0 0 10px;">Lê Quang Đạo Kéo Dài</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0;">Cách điểm giao đường Lê Quang Đạo kéo dài chỉ vài phút di chuyển, giúp kết nối thẳng tới Trung tâm Mỹ Đình, SVĐ Quốc gia và Bộ Ngoại Giao trong 10 phút.</p>
      </div>
      <div style="background:#fff;border-radius:12px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.04);">
        <div style="font-size:32px;margin-bottom:12px;">🛍️</div>
        <h3 style="font-size:18px;font-weight:800;color:#0B2C4D;margin:0 0 10px;">Đại Siêu Thị Kế Cận</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0;">Chỉ 3 phút tới Đại siêu thị AEON Mall Hà Đông, 5 phút tới Vincom Mega Mall Smart City, Công viên Thiên văn học 12ha và Công viên Thiên Đường Bảo Sơn.</p>
      </div>
    </div>

    <!-- Phối cảnh trên cao -->
    <div style="border-radius:14px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
      <img src="{$m['phoi-canh-tren-cao-4-toa-an-binh-homeland']['url']}" alt="{$m['phoi-canh-tren-cao-4-toa-an-binh-homeland']['alt']}" style="width:100%;height:auto;display:block;" />
      <div style="background:#0F172A;color:#CBD5E1;padding:12px 20px;font-size:13.5px;text-align:center;">
        <em>Phối cảnh góc cao tổ hợp An Bình Homeland ôm trọn công viên trung tâm và hạ tầng giao thông kết nối đồng bộ KĐT Geleximco.</em>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: HỆ THỐNG TIỆN ÍCH RESORT NỘI KHU -->
<section id="tien-ich" style="padding:70px 0;background:#ffffff;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px;">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px;">ĐẶC QUYỀN SỐNG NGHỈ DƯỠNG</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif;">KHÔNG GIAN TIỆN ÍCH LÕI XANH 3.840 M²</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6;">4 tòa tháp bố trí theo hình chữ U mở ôm trọn công viên sinh thái, bảo đảm 100% căn hộ đều đón gió tự nhiên và ngắm trọn hồ bơi nhiệt đới.</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:28px;margin-bottom:30px;">
      <div style="border-radius:12px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,0.08);">
        <img src="{$m['phoi-canh-ho-boi-resort-an-binh-homeland']['url']}" alt="{$m['phoi-canh-ho-boi-resort-an-binh-homeland']['alt']}" style="width:100%;height:320px;object-fit:cover;display:block;" />
        <div style="padding:18px 20px;background:#F8FAFC;">
          <h4 style="margin:0 0 6px;color:#0B2C4D;font-size:17px;font-weight:800;">🏊 Hồ Bơi Ngoài Trời Resort Nhiệt Đới</h4>
          <p style="margin:0;color:#64748B;font-size:14px;line-height:1.5;">Hồ bơi thiết kế uốn lượn phong cách ốc đảo nghỉ dưỡng cùng sàn tắm nắng và quầy bar cafe thư giãn ven hồ.</p>
        </div>
      </div>
      <div style="border-radius:12px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,0.08);">
        <img src="{$m['quang-truong-cong-vien-noi-khu-an-binh-homeland']['url']}" alt="{$m['quang-truong-cong-vien-noi-khu-an-binh-homeland']['alt']}" style="width:100%;height:320px;object-fit:cover;display:block;" />
        <div style="padding:18px 20px;background:#F8FAFC;">
          <h4 style="margin:0 0 6px;color:#0B2C4D;font-size:17px;font-weight:800;">✨ Quảng Trường Ánh Sáng & Biểu Tượng Cổng Chào</h4>
          <p style="margin:0;color:#64748B;font-size:14px;line-height:1.5;">Điểm check-in rực rỡ sắc màu về đêm, nơi giao lưu kết nối cộng đồng cư dân tinh hoa và không gian vui chơi của các bé.</p>
        </div>
      </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
      <div style="background:#F8FAFC;padding:18px;border-radius:10px;border-left:3px solid #D4AF37;">
        <strong style="color:#0B2C4D;display:block;font-size:15px;margin-bottom:6px;">🛍️ 3 Tầng TTTM Dịch Vụ</strong>
        <span style="font-size:13px;color:#64748B;">Siêu thị tiện ích, chuỗi nhà hàng cafe, hiệu thuốc và spa làm đẹp.</span>
      </div>
      <div style="background:#F8FAFC;padding:18px;border-radius:10px;border-left:3px solid #D4AF37;">
        <strong style="color:#0B2C4D;display:block;font-size:15px;margin-bottom:6px;">🚗 2 Tầng Hầm Thông Minh</strong>
        <span style="font-size:13px;color:#64748B;">Đảm bảo chỗ đỗ ô tô và xe máy với camera giám sát an ninh 24/7.</span>
      </div>
      <div style="background:#F8FAFC;padding:18px;border-radius:10px;border-left:3px solid #D4AF37;">
        <strong style="color:#0B2C4D;display:block;font-size:15px;margin-bottom:6px;">🏋️ Phòng Gym & Yoga Hiện Đại</strong>
        <span style="font-size:13px;color:#64748B;">Trang thiết bị tập luyện chuẩn quốc tế view trọn vườn cảnh quan.</span>
      </div>
      <div style="background:#F8FAFC;padding:18px;border-radius:10px;border-left:3px solid #D4AF37;">
        <strong style="color:#0B2C4D;display:block;font-size:15px;margin-bottom:6px;">🧸 Trường Mầm Non Nội Khu</strong>
        <span style="font-size:13px;color:#64748B;">Không gian giáo dục chất lượng cao an toàn tuyệt đối cho con trẻ.</span>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: MẶT BẰNG QUY HOẠCH TỔNG THỂ & CHI TIẾT TÒA C1 -->
<section id="mat-bang" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px;">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px;">QUY HOẠCH & BẢN VẼ KỸ THUẬT</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif;">MẶT BẰNG TỔNG THỂ & LAYOUT TÒA C1</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6;">Được tư vấn thiết kế bởi CONSTECH Việt Nam, toàn bộ căn hộ đều được tối ưu hóa góc sáng, sở hữu logia rộng rãi và ban công thoáng mát.</p>
    </div>

    <!-- Mặt bằng Tầng 1 -->
    <div style="background:#fff;border-radius:14px;padding:25px;border:1px solid #E2E8F0;box-shadow:0 6px 20px rgba(0,0,0,0.05);margin-bottom:35px;">
      <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 14px;">1. Bản Vẽ Quy Hoạch Mặt Bằng Tầng 1 (4 Tòa C1, C2, C3, C4)</h3>
      <p style="color:#64748B;font-size:14px;margin-bottom:18px;">Tổng diện tích sàn xây dựng S=5.417,2 m² với quỹ đất cây xanh công viên rộng tới 3.840 m².</p>
      <img src="{$m['mat-bang-tong-the-tang-1-an-binh-homeland']['url']}" alt="{$m['mat-bang-tong-the-tang-1-an-binh-homeland']['alt']}" style="width:100%;height:auto;border-radius:8px;display:block;" />
    </div>

    <!-- Mặt bằng Tòa C1 Tầng 6-23 -->
    <div style="background:#fff;border-radius:14px;padding:25px;border:1px solid #E2E8F0;box-shadow:0 6px 20px rgba(0,0,0,0.05);">
      <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 14px;">2. Mặt Bằng Tầng Điển Hình 6-23 Tòa C1 (14 Căn/Sàn)</h3>
      <p style="color:#64748B;font-size:14px;margin-bottom:18px;">Diện tích sàn xây dựng công trình S=1.404,2 m², diện tích sàn sử dụng S=1.067,2 m² (chiếm 76.0%). Cơ cấu gồm 6 loại layout căn hộ từ 2PN đến 3PN.</p>
      
      <div style="display:grid;grid-template-columns:1.2fr 0.8fr;gap:25px;align-items:start;">
        <div>
          <img src="{$m['mat-bang-tang-dien-hinh-toa-c1-an-binh-homeland']['url']}" alt="{$m['mat-bang-tang-dien-hinh-toa-c1-an-binh-homeland']['alt']}" style="width:100%;height:auto;border-radius:8px;display:block;border:1px solid #CBD5E1;" />
        </div>
        <div>
          <h4 style="color:#0B2C4D;font-size:16.5px;font-weight:800;margin:0 0 12px;border-bottom:2px solid #D4AF37;padding-bottom:8px;">Bảng Thống Kê Căn Hộ Tòa C1:</h4>
          <table style="width:100%;border-collapse:collapse;font-size:13.5px;">
            <thead>
              <tr style="background:#0F172A;color:#fff;">
                <th style="padding:10px 8px;text-align:left;">Tên Căn</th>
                <th style="padding:10px 8px;text-align:center;">Diện Tích TT</th>
                <th style="padding:10px 8px;text-align:center;">Số Căn/Tầng</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;"><td style="padding:10px 8px;font-weight:700;color:#9333EA;">Loại B1 (02 Ngủ)</td><td style="padding:10px 8px;text-align:center;"><strong>68.1 m²</strong></td><td style="padding:10px 8px;text-align:center;">02 căn</td></tr>
              <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:10px 8px;font-weight:700;color:#EAB308;">Loại B2 (02 Ngủ+)</td><td style="padding:10px 8px;text-align:center;"><strong>74.8 m²</strong></td><td style="padding:10px 8px;text-align:center;">01 căn</td></tr>
              <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;"><td style="padding:10px 8px;font-weight:700;color:#F97316;">Loại B3 (02 Ngủ+)</td><td style="padding:10px 8px;text-align:center;"><strong>74.6 m²</strong></td><td style="padding:10px 8px;text-align:center;">01 căn</td></tr>
              <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:10px 8px;font-weight:700;color:#0284C7;">Loại B4 (03 Ngủ Góc)</td><td style="padding:10px 8px;text-align:center;"><strong>92.9 m²</strong></td><td style="padding:10px 8px;text-align:center;color:#DC2626;font-weight:700;">04 căn</td></tr>
              <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;"><td style="padding:10px 8px;font-weight:700;color:#CA8A04;">Loại B5 (03 Ngủ)</td><td style="padding:10px 8px;text-align:center;"><strong>68.8 m²</strong></td><td style="padding:10px 8px;text-align:center;">02 căn</td></tr>
              <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:10px 8px;font-weight:700;color:#16A34A;">Loại B6 (02 Ngủ)</td><td style="padding:10px 8px;text-align:center;"><strong>68.1 m²</strong></td><td style="padding:10px 8px;text-align:center;">04 căn</td></tr>
              <tr style="background:#FEF3C7;font-weight:800;color:#92400E;"><td style="padding:12px 8px;">TỔNG CỘNG</td><td style="padding:12px 8px;text-align:center;">-</td><td style="padding:12px 8px;text-align:center;">14 Căn/Tầng</td></tr>
            </tbody>
          </table>
          <div style="margin-top:14px;padding:12px;background:#EFF6FF;border-radius:6px;font-size:12.5px;color:#1E40AF;line-height:1.5;">
            💡 <strong>Ưu điểm thiết kế:</strong> Hành lang rộng 1.8m thông gió tự nhiên, 4 thang máy tải trọng lớn phân luồng thông minh, khu kỹ thuật và rác riêng biệt cách ly mùi hoàn hảo.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: KHÔNG GIAN NỘI THẤT CĂN HỘ MẪU -->
<section id="can-ho" style="padding:70px 0;background:#ffffff;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px;">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px;">TRẢI NGHIỆM KHÔNG GIAN SỐNG</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif;">THIẾT KẾ CĂN HỘ MẪU SANG TRỌNG & TINH TẾ</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6;">Ứng dụng ngôn ngữ kiến trúc Scandinavian phối hợp hiện đại với tone màu ấm cúng, tối đa hóa mặt thoáng và ban công kính mở rộng tầm nhìn Panorama.</p>
    </div>

    <!-- Grid 4 ảnh nội thất đẹp -->
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:24px;margin-bottom:24px;">
      <div style="border-radius:12px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,0.08);">
        <img src="{$m['phong-khach-sang-trong-an-binh-homeland']['url']}" alt="{$m['phong-khach-sang-trong-an-binh-homeland']['alt']}" style="width:100%;height:300px;object-fit:cover;display:block;" />
        <div style="padding:14px 18px;background:#F8FAFC;"><strong style="color:#0B2C4D;">Phòng khách hiện đại liên thông ban công kính tràn viền</strong></div>
      </div>
      <div style="border-radius:12px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,0.08);">
        <img src="{$m['thiet-ke-phong-ngu-master-an-binh-homeland-1']['url']}" alt="{$m['thiet-ke-phong-ngu-master-an-binh-homeland-1']['alt']}" style="width:100%;height:300px;object-fit:cover;display:block;" />
        <div style="padding:14px 18px;background:#F8FAFC;"><strong style="color:#0B2C4D;">Phòng ngủ Master ấm áp với cửa kính lớn view thành phố</strong></div>
      </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">
      <div style="border-radius:12px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,0.08);">
        <img src="{$m['phong-an-can-ho-mau-an-binh-homeland']['url']}" alt="{$m['phong-an-can-ho-mau-an-binh-homeland']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:12px 14px;background:#F8FAFC;font-size:13.5px;"><strong style="color:#0B2C4D;">Bàn ăn gắn kết gia đình</strong></div>
      </div>
      <div style="border-radius:12px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,0.08);">
        <img src="{$m['phong-ngu-tre-em-giuong-tang-an-binh-homeland']['url']}" alt="{$m['phong-ngu-tre-em-giuong-tang-an-binh-homeland']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:12px 14px;background:#F8FAFC;font-size:13.5px;"><strong style="color:#0B2C4D;">Phòng trẻ em giường tầng đa năng</strong></div>
      </div>
      <div style="border-radius:12px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,0.08);">
        <img src="{$m['phong-ve-sinh-hien-dai-an-binh-homeland']['url']}" alt="{$m['phong-ve-sinh-hien-dai-an-binh-homeland']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:12px 14px;background:#F8FAFC;font-size:13.5px;"><strong style="color:#0B2C4D;">Phòng tắm ốp đá cao cấp</strong></div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: BẢNG GIÁ DỰ KIẾN & TIẾN ĐỘ THANH TOÁN ĐỢT 1 -->
<section id="bang-gia" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px;">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px;">CHÍNH SÁCH BÁN HÀNG NĂM 2026</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif;">BẢNG GIÁ DỰ KIẾN & CHÍNH SÁCH ƯU ĐÃI ĐỢT 1</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6;">Cơ hội sở hữu căn hộ cao cấp thương hiệu Geleximco với mức giá đợt 1 hấp dẫn cùng giải pháp tài chính linh hoạt.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:35px;">
      <!-- Gói Căn 2PN -->
      <div style="background:#fff;border-radius:14px;padding:30px 24px;border:1.5px solid #E2E8F0;text-align:center;position:relative;box-shadow:0 8px 24px rgba(0,0,0,0.05);">
        <h3 style="font-size:20px;font-weight:800;color:#0B2C4D;margin:0 0 10px;">Căn Hộ 2 Phòng Ngủ</h3>
        <div style="font-size:14px;color:#64748B;margin-bottom:16px;">Diện tích: <strong>68.1 m²</strong> (2WC, 2 Logia)</div>
        <div style="font-size:26px;font-weight:900;color:#DC2626;margin-bottom:16px;">Từ 2.4 - 2.8 Tỷ</div>
        <ul style="text-align:left;font-size:13.5px;color:#475569;line-height:1.8;padding-left:18px;margin-bottom:24px;">
          <li>Vốn tự có ban đầu chỉ từ: <strong>480 triệu (20%)</strong></li>
          <li>Thích hợp cho gia đình trẻ 1-2 thế hệ</li>
          <li>Bàn giao nội thất cơ bản cao cấp</li>
        </ul>
        <a href="#dang-ky" style="display:block;background:#0F172A;color:#fff;font-weight:700;padding:12px;border-radius:8px;text-decoration:none;">Nhận Bảng Tính Dòng Tiền 2PN</a>
      </div>

      <!-- Gói Căn 2PN+1 Hot -->
      <div style="background:#fff;border-radius:14px;padding:30px 24px;border:2px solid #D4AF37;text-align:center;position:relative;box-shadow:0 12px 30px rgba(212,175,55,0.18);">
        <div style="position:absolute;top:-12px;left:50%;transform:translateX(-50%);background:#D4AF37;color:#071D36;font-size:11.5px;font-weight:800;padding:4px 14px;border-radius:20px;text-transform:uppercase;">🔥 Căn Hộ Bán Chạy Nhất</div>
        <h3 style="font-size:20px;font-weight:800;color:#0B2C4D;margin:0 0 10px;">Căn Hộ 2PN+1 Đa Năng</h3>
        <div style="font-size:14px;color:#64748B;margin-bottom:16px;">Diện tích: <strong>74.6 m² - 74.8 m²</strong></div>
        <div style="font-size:26px;font-weight:900;color:#DC2626;margin-bottom:16px;">Từ 2.8 - 3.2 Tỷ</div>
        <ul style="text-align:left;font-size:13.5px;color:#475569;line-height:1.8;padding-left:18px;margin-bottom:24px;">
          <li>Không gian +1 linh hoạt làm phòng làm việc/ngủ phụ</li>
          <li>Ngân hàng hỗ trợ vay 70%, LS 0% 18-24 tháng</li>
          <li>Chiết khấu thanh toán sớm lên tới 8%</li>
        </ul>
        <a href="#dang-ky" style="display:block;background:linear-gradient(135deg,#D4AF37 0%,#AA8010 100%);color:#071D36;font-weight:800;padding:12px;border-radius:8px;text-decoration:none;">Nhận Suất Đẹp 2PN+1</a>
      </div>

      <!-- Gói Căn 3PN Góc -->
      <div style="background:#fff;border-radius:14px;padding:30px 24px;border:1.5px solid #E2E8F0;text-align:center;position:relative;box-shadow:0 8px 24px rgba(0,0,0,0.05);">
        <h3 style="font-size:20px;font-weight:800;color:#0B2C4D;margin:0 0 10px;">Căn Hộ 3 Phòng Ngủ (Góc)</h3>
        <div style="font-size:14px;color:#64748B;margin-bottom:16px;">Diện tích: <strong>68.8 m² - 92.9 m²</strong> (2WC, 2 Ban công)</div>
        <div style="font-size:26px;font-weight:900;color:#DC2626;margin-bottom:16px;">Từ 3.3 - 4.1 Tỷ</div>
        <ul style="text-align:left;font-size:13.5px;color:#475569;line-height:1.8;padding-left:18px;margin-bottom:24px;">
          <li>2 mặt thoáng view trọn công viên và hồ bơi</li>
          <li>Không gian sinh hoạt rộng rãi cho gia đình 3 thế hệ</li>
          <li>Tặng gói Smarthome thông minh đợt 1</li>
        </ul>
        <a href="#dang-ky" style="display:block;background:#0F172A;color:#fff;font-weight:700;padding:12px;border-radius:8px;text-decoration:none;">Nhận Bảng Giá Căn 3PN</a>
      </div>
    </div>

    <!-- Công cụ tính lãi vay -->
    [kbds_loan_calculator]
  </div>
</section>

<!-- SECTION 8: PHÁP LÝ HOÀN CHỈNH & BẢO CHỨNG TẬP ĐOÀN GELEXIMCO -->
<section id="phap-ly" style="padding:70px 0;background:#ffffff;border-top:1px solid #E2E8F0;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px;">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px;">BẢO CHỨNG ĐẦU TƯ & AN CƯ</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif;">PHÁP LÝ MINH BẠCH & UY TÍN TẬP ĐOÀN GELEXIMCO</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6;">Khách hàng hoàn toàn yên tâm khi chọn An Bình Homeland làm chốn an cư với nền tảng pháp lý vững chắc và uy tín hơn 30 năm của Tập đoàn Geleximco.</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;">
      <div style="background:#F8FAFC;border-radius:12px;padding:28px;border:1px solid #E2E8F0;">
        <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 14px;display:flex;align-items:center;gap:10px;">
          <span>⚖️</span> Hồ Sơ Pháp Lý Dự Án
        </h3>
        <ul style="color:#475569;font-size:14.5px;line-height:1.9;padding-left:20px;margin:0;">
          <li>Khu đất C19 nằm trong Quy hoạch chi tiết 1/500 Khu đô thị mới Geleximco Lê Trọng Tấn được UBND TP. Hà Nội phê duyệt.</li>
          <li>Giấy phép xây dựng và đầy đủ hồ sơ thẩm duyệt PCCC theo tiêu chuẩn an toàn kỹ thuật cao nhất.</li>
          <li>Hình thức sở hữu: <strong>Sổ hồng sở hữu lâu dài (vĩnh viễn)</strong> đối với người Việt Nam, 50 năm đối với người nước ngoài.</li>
          <li>Ngân hàng bảo lãnh tiến độ thi công và giải ngân cho vay với mức ưu đãi tốt nhất.</li>
        </ul>
      </div>

      <div style="background:#F8FAFC;border-radius:12px;padding:28px;border:1px solid #E2E8F0;">
        <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 14px;display:flex;align-items:center;gap:10px;">
          <span>🏛️</span> Uy Tín Thương Hiệu Geleximco
        </h3>
        <ul style="color:#475569;font-size:14.5px;line-height:1.9;padding-left:20px;margin:0;">
          <li>Top tập đoàn kinh tế tư nhân đa ngành lớn nhất Việt Nam với hơn 30 năm phát triển bền vững.</li>
          <li>Thương hiệu "An Bình" đã được khẳng định qua thành công vang dội của <strong>An Bình City (Phạm Văn Đồng)</strong> và <strong>An Bình Plaza (Mỹ Đình)</strong>.</li>
          <li>Tiềm lực tài chính vững mạnh, cam kết chất lượng xây dựng chuẩn mực và bàn giao đúng tiến độ cam kết.</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 9: FORM ĐĂNG KÝ CAO TẦNG -->
<section id="dang-ky" style="padding:40px 0;background:#0A2244;">
  <div class="kbds-container">
    [kbds_lead_form_cao_tang project="Chung Cư An Bình Homeland Geleximco" title="📥 ĐĂNG KÝ NHẬN BẢNG GIÁ GỐC ĐỢT 1 & HỒ SƠ MẶT BẰNG TÒA C1" button_text="GỬI BẢNG GIÁ CHO TÔI QUA ZALO ➔"]
  </div>
</section>

<!-- SECTION 10: TIN TỨC VỆ TINH TOPIC CLUSTER -->
[kbds_project_news]
HTML;

// 3. Khởi tạo / Cập nhật CPT du_an
$proj_slug = 'an-binh-homeland';
$proj_title = 'Chung Cư An Bình Homeland Geleximco - Lê Trọng Tấn, Hà Đông';
$existing_proj = get_page_by_path($proj_slug, OBJECT, 'du_an');

$proj_args = [
    'post_title'   => $proj_title,
    'post_name'    => $proj_slug,
    'post_content' => $landing_html,
    'post_status'  => 'publish',
    'post_type'    => 'du_an'
];

if ($existing_proj) {
    $proj_args['ID'] = $existing_proj->ID;
    $proj_id = wp_update_post($proj_args);
    echo "✔ Đã cập nhật Dự án [An Bình Homeland] ID: {$proj_id}\n";
} else {
    $proj_id = wp_insert_post($proj_args);
    echo "✔ Đã tạo mới Dự án [An Bình Homeland] ID: {$proj_id}\n";
}

// Gắn Ảnh đại diện
if (!empty($m['phoi-canh-tong-the-4-toa-an-binh-homeland']['id'])) {
    set_post_thumbnail($proj_id, $m['phoi-canh-tong-the-4-toa-an-binh-homeland']['id']);
    echo " + Đã gắn Featured Image: ID " . $m['phoi-canh-tong-the-4-toa-an-binh-homeland']['id'] . "\n";
}

// Gắn Taxonomies
wp_set_object_terms($proj_id, ['geleximco'], 'chu_dau_tu');
wp_set_object_terms($proj_id, ['ha-noi', 'ha-dong'], 'khu_vuc_bds');
wp_set_object_terms($proj_id, ['can-ho-cao-cap', 'can-ho-chung-cu'], 'loai_hinh_bds');

// Gắn Meta Fields
update_post_meta($proj_id, '_kbds_project_code', 'ABH-GELEXIMCO');
update_post_meta($proj_id, '_kbds_price_from', '35 Triệu/m²');
update_post_meta($proj_id, '_kbds_price_to', '45 Triệu/m²');
update_post_meta($proj_id, '_kbds_address', 'Lô C19, Phân khu C – KĐT Geleximco Lê Trọng Tấn, P. Dương Nội, Q. Hà Đông, Hà Nội');
update_post_meta($proj_id, '_kbds_total_area', '15.702 m² (~1.57 ha)');
update_post_meta($proj_id, '_kbds_scale', '4 tòa tháp cao 25 tầng (C1, C2, C3, C4) + 2 tầng hầm thông nhau, ~1.200 căn hộ');
update_post_meta($proj_id, '_kbds_legal_status', 'Sổ hồng sở hữu lâu dài (vĩnh viễn)');
update_post_meta($proj_id, '_kbds_handover_time', 'Quý IV/2026');
update_post_meta($proj_id, '_kbds_bank_support', 'BIDV, Vietcombank, TPBank hỗ trợ vay 70%, ân hạn nợ gốc');
update_post_meta($proj_id, '_kbds_brochure_url', 'https://kenhbatdongsan.vn/du-an/an-binh-homeland/#dang-ky');
update_post_meta($proj_id, '_kbds_review_score', '9.4');
update_post_meta($proj_id, '_kbds_pros_cons', "+ Tọa lạc ngay mặt đường Lê Trọng Tấn kết nối thẳng Lê Quang Đạo kéo dài về Mỹ Đình\n+ Quần thể 4 tòa khép kín ôm trọn công viên 3.840m2 và hồ bơi resort\n+ Chủ đầu tư Geleximco uy tín hơn 30 năm, pháp lý chuẩn sổ hồng lâu dài\n- Mật độ giao thông đường Lê Trọng Tấn vào giờ cao điểm khá đông đúc");

// Rank Math SEO
update_post_meta($proj_id, 'rank_math_title', 'Chung Cư An Bình Homeland Geleximco Lê Trọng Tấn | Bảng Giá & Mặt Bằng 2026');
update_post_meta($proj_id, 'rank_math_description', 'Thông tin chính thức Chung cư An Bình Homeland Lê Trọng Tấn, Hà Đông của CĐT Geleximco. Bảng giá gốc đợt 1, mặt bằng tòa C1, chính sách bán hàng và suất ngoại giao mới nhất.');
update_post_meta($proj_id, 'rank_math_focus_keyword', 'an binh homeland, chung cu an binh homeland, an binh homeland geleximco');

// 4. Tạo 2 Căn Hộ Giỏ Hàng Mẫu (CPT bat_dong_san)
$listings = [
    [
        'title' => 'Căn Hộ 2PN-2WC Tầng Trung Tòa C1 View Trực Diện Hồ Bơi Resort An Bình Homeland',
        'slug'  => 'can-ho-2pn-view-ho-boi-an-binh-homeland',
        'code'  => 'ABH-C1-1206',
        'price' => '2.58 Tỷ',
        'area'  => '68.1',
        'beds'  => '2',
        'baths' => '2',
        'dir'   => 'Đông Nam',
        'thumb' => $m['phong-khach-sang-trong-an-binh-homeland']['id'] ?? 0,
        'desc'  => 'Căn hộ 2 phòng ngủ 68.1m² thiết kế hiện đại tại tòa C1 tầng 12 view trực diện lõi công viên và hồ bơi ngoài trời. Bàn giao đầy đủ nội thất cơ bản cao cấp.'
    ],
    [
        'title' => 'Căn Hộ Góc 3PN-2WC 92.9m² Tòa C1 2 Mặt Thoáng Cực Đẹp An Bình Homeland',
        'slug'  => 'can-ho-goc-3pn-toa-c1-an-binh-homeland',
        'code'  => 'ABH-C1-1804',
        'price' => '3.65 Tỷ',
        'area'  => '92.9',
        'beds'  => '3',
        'baths' => '2',
        'dir'   => 'Đông Bắc - Đông Nam',
        'thumb' => $m['thiet-ke-phong-ngu-master-an-binh-homeland-1']['id'] ?? 0,
        'desc'  => 'Căn góc 3 phòng ngủ 92.9m² diện tích thông thủy lớn nhất tòa C1 An Bình Homeland. Sở hữu 2 ban công thoáng mát, view trọn KĐT Geleximco và công viên nội khu.'
    ]
];

foreach ($listings as $item) {
    $exist_l = get_page_by_path($item['slug'], OBJECT, 'bat_dong_san');
    $l_args = [
        'post_title'   => $item['title'],
        'post_name'    => $item['slug'],
        'post_content' => $item['desc'] . "\n\n[kbds_lead_form_cao_tang project=\"An Bình Homeland\"]",
        'post_status'  => 'publish',
        'post_type'    => 'bat_dong_san'
    ];
    if ($exist_l) {
        $l_args['ID'] = $exist_l->ID;
        $lid = wp_update_post($l_args);
    } else {
        $lid = wp_insert_post($l_args);
    }

    if ($item['thumb']) set_post_thumbnail($lid, $item['thumb']);
    update_post_meta($lid, '_kbds_parent_project_id', $proj_id);
    update_post_meta($lid, '_kbds_listing_code', $item['code']);
    update_post_meta($lid, '_kbds_listing_price', $item['price']);
    update_post_meta($lid, '_kbds_area_m2', $item['area']);
    update_post_meta($lid, '_kbds_bedrooms', $item['beds']);
    update_post_meta($lid, '_kbds_bathrooms', $item['baths']);
    update_post_meta($lid, '_kbds_direction', $item['dir']);
    update_post_meta($lid, '_kbds_is_verified', '1');
    update_post_meta($lid, '_kbds_listing_status', 'active');
    echo " + Đã tạo/cập nhật Giỏ hàng: {$item['title']} (ID {$lid})\n";
}

// 5. Tạo 4 Bài Viết Vệ Tinh Chuẩn Topic Cluster (CPT post)
$sat_posts = [
    [
        'title' => 'Đánh Giá Vị Trí Chung Cư An Bình Homeland Lê Trọng Tấn: Lợi Thế Kết Nối Tuyến Lê Quang Đạo Kéo Dài',
        'slug'  => 'vi-tri-chung-cu-an-binh-homeland-le-trong-tan-ha-dong',
        'thumb' => $m['phoi-canh-tren-cao-4-toa-an-binh-homeland']['id'] ?? 0,
        'cat'   => 'review-du-an',
        'excerpt' => 'Phân tích chi tiết tọa độ vàng của chung cư An Bình Homeland tại Lô C19 KĐT Geleximco Lê Trọng Tấn, tiềm năng tăng giá đột phá khi thông tuyến Lê Quang Đạo kéo dài về Mỹ Đình.',
        'content' => <<<POSTHTML
<p class="lead"><strong>Chung cư An Bình Homeland</strong> tọa lạc tại phân khu C Khu đô thị Geleximco Lê Trọng Tấn (Hà Đông, Hà Nội). Đây được đánh giá là một trong những tọa độ kim cương tại trung tâm phát triển sôi động bậc nhất phía Tây Thủ đô, hưởng trọn hạ tầng giao thông nghìn tỷ đang được tăng tốc hoàn thiện.</p>

<p style="text-align:center;"><img src="{$m['phoi-canh-tren-cao-4-toa-an-binh-homeland']['url']}" alt="Vị trí đắc địa chung cư An Bình Homeland Lê Trọng Tấn Hà Đông" style="width:100%;border-radius:10px;" /></p>

<h2>1. Vị trí chính xác của dự án An Bình Homeland</h2>
<p>Dự án tọa lạc tại <strong>Lô đất C19, Phân khu C – Khu đô thị mới Geleximco</strong>, mặt tiền đường Lê Trọng Tấn, phường Dương Nội, quận Hà Đông, Hà Nội. Đây là trục đại lộ xuyên tâm kết nối từ ngã tư Lê Trọng Tấn - Quang Trung (Hà Đông) thẳng đến Đại lộ Thăng Long.</p>
<ul>
  <li><strong>Phía Đông Bắc:</strong> Tiếp giáp trục đường đôi Lê Trọng Tấn rộng 42m, nhìn sang Phân khu D Geleximco.</li>
  <li><strong>Phía Tây Nam:</strong> Hướng về trung tâm KĐT Geleximco phân khu C và công viên cảnh quan.</li>
  <li><strong>Phía Đông Nam:</strong> Kết nối trực tiếp khu đô thị Park City Hanoi và trục Tố Hữu - Lê Văn Lương.</li>
  <li><strong>Phía Tây Bắc:</strong> Tiếp giáp KĐT Vinhomes Smart City và đường Đại lộ Thăng Long.</li>
</ul>

<h2>2. Lợi thế siêu kết nối từ tuyến đường Lê Quang Đạo kéo dài</h2>
<p>Cú hích hạ tầng lớn nhất tác động trực tiếp đến giá trị của An Bình Homeland chính là tuyến đường <strong>Lê Quang Đạo kéo dài</strong> với mặt cắt ngang 40m nối thẳng từ nút giao Mễ Trì (Bộ Ngoại Giao, SVĐ Quốc gia Mỹ Đình) qua KĐT Dương Nội và tiếp giáp phân khu Geleximco.</p>
<p>Khi tuyến đường này vận hành thông suốt, thời gian di chuyển từ An Bình Homeland đến trung tâm hành chính mới Mỹ Đình chỉ còn <strong>khoảng 8 – 10 phút</strong>, rút ngắn hơn 50% thời gian so với cung đường cũ.</p>

<h2>3. Hệ sinh thái tiện ích ngoại khu cao cấp bán kính 2km</h2>
<p>Không chỉ sở hữu giao thông thuận tiện, cư dân An Bình Homeland còn dễ dàng tiếp cận hệ thống dịch vụ vui chơi, mua sắm, giáo dục hàng đầu Thủ đô:</p>
<ul>
  <li><strong>Đại siêu thị AEON Mall Hà Đông:</strong> Chỉ cách 1.5 km (3 phút lái xe) – thiên đường mua sắm, ẩm thực và rạp chiếu phim hiện đại.</li>
  <li><strong>Đại đô thị Vinhomes Smart City:</strong> Cách 2.5 km, hưởng trọn tiện ích công viên Nhật Bản Zen Park và Vincom Mega Mall.</li>
  <li><strong>Công viên Thiên văn học Dương Nội:</strong> Hồ điều hòa rộng 12ha xanh mát chỉ cách 5 phút di chuyển.</li>
  <li><strong>Hệ thống giáo dục liên cấp:</strong> Trường Quốc tế Nhật Bản (JIS), Trường Olympia, Hệ thống trường Vinschool, Chuyên Nguyễn Huệ...</li>
</ul>

<p>Chi tiết hồ sơ dự án và mặt bằng tổng thể, quý khách có thể xem thêm tại <a href="https://kenhbatdongsan.vn/du-an/an-binh-homeland/"><strong>Dự Án Chung Cư An Bình Homeland</strong></a>.</p>

[kbds_lead_form_cao_tang project="An Bình Homeland" title="Đăng Ký Nhận Bản Đồ Quy Hoạch Vị Trí An Bình Homeland" button_text="Tải Bản Đồ Quy Hoạch Mới Nhất ➔"]
POSTHTML
    ],
    [
        'title' => 'Mặt Bằng Tầng Điển Hình Tòa C1 Chung Cư An Bình Homeland: Phân Tích Layout Căn 2PN - 3PN',
        'slug'  => 'mat-bang-thiet-ke-can-ho-toa-c1-an-binh-homeland',
        'thumb' => $m['mat-bang-tang-dien-hinh-toa-c1-an-binh-homeland']['id'] ?? 0,
        'cat'   => 'review-du-an',
        'excerpt' => 'Phân tích chi tiết mặt bằng căn hộ tầng điển hình 6-23 tòa C1 An Bình Homeland: Thiết kế 14 căn/sàn, 4 thang máy, cơ cấu các loại diện tích từ 68.1m² đến 92.9m².',
        'content' => <<<POSTHTML
<p class="lead">Tòa C1 là một trong những khối tháp căn hộ sở hữu vị trí đẹp nhất tổ hợp <strong>Chung cư An Bình Homeland Geleximco</strong>. Dưới bàn tay thiết kế của đơn vị tư vấn CONSTECH Việt Nam, mặt bằng tầng điển hình tòa C1 ghi điểm tuyệt đối nhờ bố cục thông minh, tối ưu diện tích sử dụng và đối lưu không khí hoàn hảo.</p>

<p style="text-align:center;"><img src="{$m['mat-bang-tang-dien-hinh-toa-c1-an-binh-homeland']['url']}" alt="Bản vẽ mặt bằng tầng điển hình 6-23 tòa C1 chung cư An Bình Homeland" style="width:100%;border-radius:10px;" /></p>

<h2>1. Thông số kỹ thuật mặt bằng tầng điển hình tòa C1</h2>
<ul>
  <li><strong>Tầng căn hộ:</strong> Từ tầng 6 đến tầng 23.</li>
  <li><strong>Mật độ xây dựng:</strong> 14 căn hộ / mặt sàn.</li>
  <li><strong>Diện tích sàn xây dựng công trình:</strong> S = 1.404,2 m².</li>
  <li><strong>Diện tích sàn sử dụng căn hộ:</strong> S = 1.067,2 m² (đạt tỷ lệ vàng 76,0%).</li>
  <li><strong>Hệ thống giao thông đứng:</strong> 4 thang máy tốc độ cao + 2 thang bộ thoát hiểm cách ly khói độc.</li>
</ul>

<h2>2. Chi tiết cơ cấu các loại căn hộ tòa C1 An Bình Homeland</h2>

<h3>Loại B1 & B6: Căn hộ 2 Phòng Ngủ Tiêu Chuẩn (68.1 m²)</h3>
<p>Gồm 6 căn/sàn (02 căn loại B1 và 04 căn loại B6). Thiết kế thông minh với phòng khách rộng nối liền ban công, 2 phòng ngủ đều có cửa sổ đón nắng tự nhiên, 2 nhà vệ sinh tách biệt và khu giặt phơi riêng kín đáo.</p>

<h3>Loại B2 & B3: Căn hộ 2 Phòng Ngủ + 1 Đa Năng (74.6 m² – 74.8 m²)</h3>
<p>Gồm 2 căn/sàn (01 căn B2 và 01 căn B3). Điểm đặc biệt là khoảng không gian <strong>+1 đa năng</strong> rộng rãi, gia chủ có thể linh hoạt thiết kế thành phòng làm việc, phòng đọc sách, phòng thờ hoặc phòng ngủ nhỏ cho bé thứ hai.</p>

<h3>Loại B4: Căn hộ Góc 3 Phòng Ngủ Thượng Lưu (92.9 m²)</h3>
<p>Gồm <strong>4 căn góc/sàn</strong> sở hữu 2 mặt thoáng tuyệt đẹp. Tầm nhìn mở rộng 270 độ bao quát công viên trung tâm và hồ bơi ngoài trời. Đây là dòng sản phẩm danh giá dành riêng cho các gia đình đa thế hệ mong muốn không gian sống rộng rãi.</p>

<h3>Loại B5: Căn hộ 3 Phòng Ngủ Tối Ưu (68.8 m²)</h3>
<p>Gồm 2 căn/sàn. Thiết kế đột phá với 3 phòng ngủ đầy đủ chức năng nhưng tối ưu diện tích thông thủy, giúp tổng giá bán cực kỳ vừa vặn với túi tiền của các gia đình trẻ.</p>

<p style="text-align:center;"><img src="{$m['phong-khach-sang-trong-an-binh-homeland']['url']}" alt="Thiết kế nội thất căn hộ mẫu sang trọng An Bình Homeland" style="width:100%;border-radius:10px;" /></p>

<p>Tham khảo đầy đủ thông số dự án tại trang chính thức: <a href="https://kenhbatdongsan.vn/du-an/an-binh-homeland/"><strong>Dự Án Chung Cư An Bình Homeland Geleximco</strong></a>.</p>

[kbds_lead_form_cao_tang project="An Bình Homeland" title="Đăng Ký Nhận Trọn Bộ Layout Bóc Mái 3D Tòa C1" button_text="Tải File PDF Mặt Bằng Tòa C1 ➔"]
POSTHTML
    ],
    [
        'title' => 'Khám Phá Hệ Thống Tiện Ích Đẳng Cấp Tại Chung Cư An Bình Homeland Geleximco',
        'slug'  => 'he-thong-tien-ich-an-binh-homeland-geleximco',
        'thumb' => $m['phoi-canh-ho-boi-resort-an-binh-homeland']['id'] ?? 0,
        'cat'   => 'review-du-an',
        'excerpt' => 'Trải nghiệm không gian sống nghỉ dưỡng tại chung cư An Bình Homeland với công viên lõi xanh 3.840m², hồ bơi resort nhiệt đới, quảng trường ánh sáng và 3 tầng trung tâm thương mại.',
        'content' => <<<POSTHTML
<p class="lead">Được định vị là tổ hợp căn hộ cao cấp chuẩn sinh thái, <strong>Chung cư An Bình Homeland</strong> không chỉ mang đến những căn hộ tiện nghi mà còn kiến tạo một hệ sinh thái tiện ích "All-in-one" trọn vẹn, đáp ứng nhu cầu tái tạo năng lượng mỗi ngày của mọi thành viên trong gia đình.</p>

<p style="text-align:center;"><img src="{$m['phoi-canh-ho-boi-resort-an-binh-homeland']['url']}" alt="Hồ bơi nhiệt đới phong cách resort dự án An Bình Homeland" style="width:100%;border-radius:10px;" /></p>

<h2>1. Công viên lõi xanh trung tâm 3.840 m²</h2>
<p>Điểm nhấn độc bản của An Bình Homeland là quy hoạch 4 tòa tháp theo hình chữ U hướng tâm, ôm trọn công viên cây xanh và mặt nước rộng đến <strong>3.840 m²</strong>. Cây xanh phân tầng đa dạng mang lại bầu không khí trong lành, xua tan khói bụi ồn ào của đô thị.</p>

<h2>2. Hồ bơi ngoài trời phong cách Resort nhiệt đới</h2>
<p>Giữa lòng dự án là hồ bơi ngoài trời uốn lượn phong cách nghỉ dưỡng nhiệt đới. Hồ bơi được ứng dụng công nghệ lọc nước điện phân muối kháng khuẩn hiện đại, an toàn cho làn da nhạy cảm của trẻ nhỏ cùng sàn tắm nắng và khu cafe thư giãn ven hồ.</p>

<p style="text-align:center;"><img src="{$m['quang-truong-cong-vien-noi-khu-an-binh-homeland']['url']}" alt="Quảng trường ánh sáng trung tâm chung cư An Bình Homeland" style="width:100%;border-radius:10px;" /></p>

<h2>3. Quảng trường ánh sáng & phố thương mại sầm uất</h2>
<ul>
  <li><strong>Quảng trường trung tâm:</strong> Khu vực đài phun nước biểu tượng, đường dạo bộ dưỡng sinh và sân khấu sự kiện ngoài trời.</li>
  <li><strong>3 tầng trung tâm thương mại:</strong> Quy tụ các thương hiệu thời trang, siêu thị tiêu dùng, nhà hàng ẩm thực và chuỗi cafe nổi tiếng.</li>
  <li><strong>Phòng tập Gym & Yoga:</strong> Hệ thống máy tập Technogym chuẩn quốc tế view trọn công viên xanh mát.</li>
  <li><strong>Khu vui chơi trẻ em Kid Corner:</strong> Sân chơi cát tự nhiên, cầu trượt liên hoàn kích thích phát triển thể chất và trí tuệ của trẻ.</li>
</ul>

<p>Xem toàn bộ thông tin chi tiết dự án tại <a href="https://kenhbatdongsan.vn/du-an/an-binh-homeland/"><strong>Chung Cư An Bình Homeland</strong></a>.</p>

[kbds_lead_form_cao_tang project="An Bình Homeland" title="Đăng Ký Tham Quan Căn Hộ Mẫu & Trải Nghiệm Tiện Ích" button_text="Đăng Ký Xem Căn Hộ Mẫu Ngay ➔"]
POSTHTML
    ],
    [
        'title' => 'Cập Nhật Bảng Giá Bán & Chính Sách Bán Hàng An Bình Homeland Năm 2026: Đòn Bẩy Tài Chính Từ Geleximco',
        'slug'  => 'bang-gia-chinh-sach-ban-hang-an-binh-homeland-2026',
        'thumb' => $m['phoi-canh-tong-the-4-toa-an-binh-homeland']['id'] ?? 0,
        'cat'   => 'tin-tuc-thi-truong',
        'excerpt' => 'Bảng giá bán căn hộ An Bình Homeland đợt 1 mới nhất năm 2026: Đơn giá từ 35 - 45 triệu/m², chính sách thanh toán linh hoạt và gói hỗ trợ lãi suất 0% từ các ngân hàng lớn.',
        'content' => <<<POSTHTML
<p class="lead">Trong bối cảnh nguồn cung căn hộ sơ cấp tại Hà Nội đang khan hiếm và mức giá mặt bằng chung liên tục thiết lập mặt bằng mới, <strong>Chung cư An Bình Homeland Lê Trọng Tấn</strong> đang trở thành điểm nóng thu hút dòng tiền nhờ mức giá đợt 1 cực kỳ hợp lý cùng thương hiệu bảo chứng Geleximco.</p>

<p style="text-align:center;"><img src="{$m['phoi-canh-tong-the-4-toa-an-binh-homeland']['url']}" alt="Bảng giá bán căn hộ chung cư An Bình Homeland Geleximco đợt 1" style="width:100%;border-radius:10px;" /></p>

<h2>1. Bảng giá dự kiến căn hộ An Bình Homeland đợt 1</h2>
<p>Mức giá dự kiến của dự án dao động từ <strong>35 – 45 triệu/m²</strong> (đã bao gồm VAT và kinh phí bảo trì), tương ứng với các khoảng giá theo từng loại hình căn hộ:</p>
<table style="width:100%;border-collapse:collapse;margin:20px 0;">
  <thead>
    <tr style="background:#0F172A;color:#fff;">
      <th style="padding:10px;text-align:left;">Loại Căn Hộ</th>
      <th style="padding:10px;text-align:center;">Diện Tích (m²)</th>
      <th style="padding:10px;text-align:center;">Giá Bán Dự Kiến (Tỷ)</th>
    </tr>
  </thead>
  <tbody>
    <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:10px;"><strong>Căn hộ 2 Phòng Ngủ</strong></td><td style="padding:10px;text-align:center;">68.1 m²</td><td style="padding:10px;text-align:center;color:#DC2626;font-weight:700;">2.4 – 2.8 Tỷ</td></tr>
    <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;"><td style="padding:10px;"><strong>Căn hộ 2 Phòng Ngủ + 1</strong></td><td style="padding:10px;text-align:center;">74.6 – 74.8 m²</td><td style="padding:10px;text-align:center;color:#DC2626;font-weight:700;">2.8 – 3.2 Tỷ</td></tr>
    <tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:10px;"><strong>Căn hộ 3 Phòng Ngủ (Góc)</strong></td><td style="padding:10px;text-align:center;">68.8 – 92.9 m²</td><td style="padding:10px;text-align:center;color:#DC2626;font-weight:700;">3.3 – 4.1 Tỷ</td></tr>
  </tbody>
</table>

<h2>2. Chính sách bán hàng & Tiến độ thanh toán linh hoạt</h2>
<ul>
  <li><strong>Tiến độ thanh toán chuẩn:</strong> Chia nhỏ làm 7 – 8 đợt theo tiến độ thi công thực tế, giúp khách hàng chủ động dòng tiền.</li>
  <li><strong>Chính sách thanh toán sớm:</strong> Nhận chiết khấu trực tiếp lên đến <strong>7% – 8%</strong> trên tổng giá trị căn hộ.</li>
  <li><strong>Hỗ trợ vay vốn ngân hàng:</strong> Ngân hàng BIDV, Vietcombank hỗ trợ vay lên đến <strong>70% giá trị hợp đồng</strong>, hỗ trợ lãi suất 0% và ân hạn nợ gốc từ 18 – 24 tháng.</li>
</ul>

<p>Khám phá trọn bộ thông tin dự án tại: <a href="https://kenhbatdongsan.vn/du-an/an-binh-homeland/"><strong>Dự Án Chung Cư An Bình Homeland Hà Đông</strong></a>.</p>

[kbds_lead_form_cao_tang project="An Bình Homeland" title="Đăng Ký Nhận Bảng Tính Lãi Vay & Suất Ngoại Giao Đợt 1" button_text="Nhận Bảng Giá Chi Tiết ➔"]
POSTHTML
    ]
];

foreach ($sat_posts as $sp) {
    $exist_p = get_page_by_path($sp['slug'], OBJECT, 'post');
    $p_args = [
        'post_title'   => $sp['title'],
        'post_name'    => $sp['slug'],
        'post_content' => $sp['content'],
        'post_excerpt' => $sp['excerpt'],
        'post_status'  => 'publish',
        'post_type'    => 'post'
    ];
    if ($exist_p) {
        $p_args['ID'] = $exist_p->ID;
        $pid = wp_update_post($p_args);
    } else {
        $pid = wp_insert_post($p_args);
    }

    if ($sp['thumb']) set_post_thumbnail($pid, $sp['thumb']);

    // Gắn chuyên mục
    $cat = get_category_by_slug($sp['cat']);
    if ($cat) {
        wp_set_post_categories($pid, [$cat->term_id]);
    }

    // Gắn liên kết dự án _kbds_project_ref
    update_post_meta($pid, '_kbds_project_ref', $proj_id);
    update_post_meta($pid, '_kbds_project_slug', $proj_slug);
    update_post_meta($pid, 'rank_math_title', $sp['title'] . ' | Kênh Bất Động Sản');
    update_post_meta($pid, 'rank_math_description', $sp['excerpt']);
    echo " + Đã tạo/cập nhật Bài viết vệ tinh: {$sp['title']} (ID {$pid})\n";
}

echo "\n==============================================================\n";
echo "🎉 HOÀN THÀNH XÂY DỰNG TOÀN BỘ DỰ ÁN AN BÌNH HOMELAND (GELEXIMCO)!\n";
echo "==============================================================\n";
