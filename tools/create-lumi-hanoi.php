<?php
require_once dirname(__DIR__) . '/wp-load.php';

echo "=== TẠO DỰ ÁN LUMI HANOI CAPITALAND ===\n";

// 1. Kiểm tra nếu dự án đã tồn tại
$existing = get_page_by_path('lumi-hanoi', OBJECT, 'du_an');
$post_id = $existing ? $existing->ID : 0;

$title = 'Chung Cư Lumi Hanoi CapitaLand - Đại Lộ Thăng Long, Nam Từ Liêm';
$slug = 'lumi-hanoi';

// Load image map
$image_map = json_decode(file_get_contents(__DIR__ . '/lumi-images.json'), true);

$img_tong_the   = $image_map['phoi-canh-tong-the-lumi-hanoi-capitaland.jpg']['url'];
$img_dem         = $image_map['phoi-canh-dem-ruc-ro-lumi-hanoi.jpg']['url'];
$img_mb_tong     = $image_map['mat-bang-tong-the-du-an-lumi-hanoi.webp']['url'];
$img_mb_prestige = $image_map['mat-bang-toa-prestige-1-lumi-hanoi.jpg']['url'];
$img_elite_ngoai = $image_map['kien-truc-mat-ngoai-lumi-elite-capitaland.jpg']['url'];
$img_rooftop     = $image_map['san-vuon-tren-cao-rooftop-lumi-elite.jpg']['url'];
$img_be_boi      = $image_map['be-boi-resort-sole-lap-pool-lumi-hanoi.jpg']['url'];
$img_nuoc        = $image_map['san-choi-nuoc-adventure-waterplay-lumi-hanoi.jpg']['url'];
$img_bbq         = $image_map['vuon-bbq-sole-ngoai-troi-lumi-hanoi.jpg']['url'];
$img_la_phoi     = $image_map['cong-vien-la-phoi-xanh-green-lung-lumi-hanoi.jpg']['url'];
$img_lobby       = $image_map['dai-sanh-grand-lobby-signature-1-lumi-hanoi.jpg']['url'];
$img_party       = $image_map['phong-tiec-cu-dan-party-house-lumi-hanoi.jpg']['url'];
$img_toddler     = $image_map['khu-vui-choi-tre-em-toddlers-playroom-lumi-hanoi.jpg']['url'];
$img_kids        = $image_map['san-choi-kham-pha-kids-adventure-lumi-hanoi.jpg']['url'];

$featured_img_id = $image_map['phoi-canh-tong-the-lumi-hanoi-capitaland.jpg']['id'] ?? 497;

// Content HTML
$content = <<<HTML
<div class="kbds-project-subnav"><div class="kbds-container kbds-subnav-container"><div class="kbds-subnav-brand"><span class="kbds-subnav-dot"></span>LUMI HANOI</div><a href="#dang-ky" class="kbds-subnav-cta">Nhận Báo Giá Gốc</a><nav class="kbds-subnav-links"><a href="#tong-quan" class="kbds-subnav-link">Tổng Quan</a><a href="#vi-tri" class="kbds-subnav-link">Vị Trí</a><a href="#tien-ich" class="kbds-subnav-link">Tiện Ích 5 Sao</a><a href="#mat-bang" class="kbds-subnav-link">Mặt Bằng &amp; Phân Khu</a><a href="#can-ho" class="kbds-subnav-link">Căn Hộ Mẫu</a><a href="#bang-gia" class="kbds-subnav-link">Bảng Giá 2026</a><a href="#phap-ly" class="kbds-subnav-link">Pháp Lý &amp; CĐT</a><a href="#tin-tuc-du-an" class="kbds-subnav-link">Tin Tức</a></nav></div></div>

<!-- SECTION 1: HERO BANNER -->
<section style="position:relative;background:linear-gradient(135deg,#071D36 0%,#0B2C4D 50%,#164E8E 100%);color:#fff;padding:80px 0 100px;overflow:hidden">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.25;background:radial-gradient(circle at 75% 25%,#D4AF37 0%,transparent 65%);pointer-events:none"></div>
  <div class="kbds-container" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:40px;align-items:center">
    <div>
      <div style="display:inline-flex;align-items:center;gap:8px;color:#FDE68A;padding:6px 18px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px">
        ⭐ CAPITALAND DEVELOPMENT • THÀNH PHỐ ÁNH SÁNG TÂY HÀ NỘI
      </div>
      <h1 style="color:#FFFFFF;font-size:40px;font-weight:900;line-height:1.2;margin:0 0 18px;font-family:'Playfair Display',Georgia,serif">
        CHUNG CƯ LUMI HANOI
        <span style="display:block;font-size:22px;font-weight:600;color:#D4AF37;margin-top:6px;font-family:'Be Vietnam Pro',sans-serif">Mặt Tiền Đại Lộ Thăng Long, Tây Mỗ, Quận Nam Từ Liêm, Hà Nội</span>
      </h1>
      <p style="color:#E2E8F0;font-size:16px;line-height:1.7;margin:0 0 28px;max-width:620px">
        Tọa lạc đắc địa tại mặt tiền <strong>Đại lộ Thăng Long</strong>, phường Tây Mỗ, Nam Từ Liêm. <strong>Lumi Hanoi</strong> là siêu phẩm bất động sản căn hộ hạng sang có quy mô <strong>5.6 ha</strong> được đầu tư và phát triển bởi tập đoàn bất động sản hàng đầu châu Á <strong>CapitaLand Development (Singapore)</strong>. Dự án được kiến tạo bởi kiến trúc sư lừng danh người Pháp <strong>Jean-François Milou</strong>, gồm <strong>9 tòa tháp cao 29 - 35 tầng</strong> với gần <strong>3.950 căn hộ cao cấp</strong> cùng hệ sinh thái hơn <strong>80 tiện ích resort đặc quyền</strong>.
      </p>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:30px">
        <div style="padding:14px 10px;border-radius:10px;text-align:center;background:rgba(255,255,255,0.08)">
          <div style="font-size:18px;font-weight:800;color:#FDE68A">5.6 ha</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px">Quy mô khu đô thị</div>
        </div>
        <div style="padding:14px 10px;border-radius:10px;text-align:center;background:rgba(255,255,255,0.08)">
          <div style="font-size:18px;font-weight:800;color:#38BDF8">9 Tòa Tháp</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px">Cao 29 - 35 Tầng</div>
        </div>
        <div style="padding:14px 10px;border-radius:10px;text-align:center;background:rgba(255,255,255,0.08)">
          <div style="font-size:18px;font-weight:800;color:#4ADE80">80+ Tiện Ích</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px">Chuẩn Resort 5 Sao</div>
        </div>
        <div style="padding:14px 10px;border-radius:10px;text-align:center;background:rgba(255,255,255,0.08)">
          <div style="font-size:18px;font-weight:800;color:#F472B6">Sổ Hồng</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px">Lâu dài vĩnh viễn</div>
        </div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap">
        <a href="#dang-ky" style="background:linear-gradient(135deg,#D4AF37 0%,#AA8010 100%);color:#071D36;font-weight:800;padding:14px 28px;border-radius:8px;text-decoration:none;display:inline-flex;align-items:center;gap:8px">
          <span>Nhận Báo Giá Đợt 1 &amp; Mặt Bằng 9 Tòa</span> →
        </a>
        <a href="#mat-bang" style="background:transparent;color:#fff;border:1px solid rgba(255,255,255,0.3);font-weight:600;padding:14px 24px;border-radius:8px;text-decoration:none">
          Xem Mặt Bằng Chi Tiết
        </a>
      </div>
    </div>
    <div>
      [kbds_quick_lead_card_cao_tang project="Chung Cư Lumi Hanoi CapitaLand" title="NHẬN BẢNG GIÁ GỐC ĐỢT 1" subtitle="Tải trọn bộ Layout 3D phân khu Signature, Prestige, Elite và Chính sách thanh toán thảnh thơi 50% đến khi nhận nhà"]
    </div>
  </div>
</section>

<!-- SECTION 2: TỔNG QUAN HỒ SƠ DỰ ÁN -->
<section id="tong-quan" style="padding:70px 0;background:#ffffff">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px">HỒ SƠ NĂNG LỰC DỰ ÁN</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif">TỔNG QUAN DỰ ÁN CHUNG CƯ LUMI HANOI</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6">Khu đô thị căn hộ cao cấp chuẩn quốc tế tiên phong ứng dụng ngôn ngữ ánh sáng và kiến trúc xanh bền vững tại trung tâm hành chính mới phía Tây Thủ đô.</p>
    </div>
    
    <div style="display:grid;grid-template-columns:1.1fr 0.9fr;gap:35px;align-items:center">
      <div style="border-radius:14px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 10px 25px -5px rgba(0,0,0,0.06)">
        <img src="{$img_tong_the}" alt="Phối cảnh tổng thể 9 tòa căn hộ cao cấp dự án Lumi Hanoi CapitaLand mặt đường Đại lộ Thăng Long" style="width:100%;height:auto;display:block" />
      </div>
      <div>
        <table style="width:100%;border-collapse:collapse;font-size:14.5px">
          <tbody>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D;width:38%">Tên thương mại:</td><td style="padding:12px 10px;color:#334155"><strong>Lumi Hanoi</strong> (Chung cư Lumi Hanoi)</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Chủ đầu tư:</td><td style="padding:12px 10px;color:#334155"><strong>CapitaLand Development (Singapore)</strong></td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Vị trí tọa lạc:</td><td style="padding:12px 10px;color:#334155">Mặt tiền Đại lộ Thăng Long, P. Tây Mỗ, Q. Nam Từ Liêm, Hà Nội</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Tổng diện tích đất:</td><td style="padding:12px 10px;color:#334155">5,6 ha (56.000 m²), tổng mức đầu tư hơn 18.000 tỷ đồng (~1 tỷ SGD)</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Kiến trúc sư trưởng:</td><td style="padding:12px 10px;color:#334155"><strong>Jean-François Milou</strong> (Studio Milou Pháp)</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Quy mô dự án:</td><td style="padding:12px 10px;color:#334155">9 tòa tháp căn hộ cao từ 29 đến 35 tầng, ~3.950 căn hộ cao cấp</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Phân khu phát triển:</td><td style="padding:12px 10px;color:#334155">Lumi Signature (Giai đoạn 1), Lumi Prestige (Giai đoạn 2), Lumi Elite (Giai đoạn 3)</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Cơ cấu diện tích:</td><td style="padding:12px 10px;color:#334155">1PN (42.2m²), 2PN (53.8m² - 74.3m²), 3PN (86m² - 117.8m²), 4PN (136m²), Duplex &amp; Penthouse (193m² - 411m²)</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Hệ thống tiện ích:</td><td style="padding:12px 10px;color:#334155">Hơn 80 tiện ích cao cấp: Bể bơi resort 50m, công viên Lá phổi xanh 2.4ha, cầu dạo bộ trên không...</td></tr>
            <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Thời gian bàn giao:</td><td style="padding:12px 10px;color:#334155">Dự kiến từ Quý III - IV/2026</td></tr>
            <tr><td style="padding:12px 10px;font-weight:700;color:#0B2C4D">Hình thức sở hữu:</td><td style="padding:12px 10px;color:#16A34A;font-weight:700">Sổ hồng sở hữu lâu dài (người Việt Nam), 50 năm (người nước ngoài)</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VỊ TRÍ & LIÊN KẾT HẠ TẦNG CHIẾN LƯỢC -->
<section id="vi-tri" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px">TÂM ĐIỂM SIÊU KẾT NỐI TÂY HÀ NỘI</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif">VỊ TRÍ CHIẾN LƯỢC MẶT TIỀN ĐẠI LỘ THĂNG LONG</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6">Tọa lạc tại vị trí độc tôn ngay mặt tiền trục đường tơ lụa phía Tây – Đại lộ Thăng Long, Lumi Hanoi kết nối trực tiếp các trung tâm tài chính, hành chính và giáo dục hàng đầu của Thủ đô.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:35px">
      <div style="background:#fff;border-radius:12px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05)">
        <div style="font-size:32px;margin-bottom:12px">🛣️</div>
        <h3 style="font-size:18px;font-weight:800;color:#0B2C4D;margin:0 0 10px">Mặt Tiền Đại Lộ Thăng Long</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0">Tuyến đại lộ hiện đại nhất Thủ đô với 12 làn xe thông thoáng, kết nối thẳng vào trung tâm Hội nghị Quốc gia, Trần Duy Hưng và Vành Đai 3 mà không lo ùn tắc giao thông.</p>
      </div>
      <div style="background:#fff;border-radius:12px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05)">
        <div style="font-size:32px;margin-bottom:12px">🚇</div>
        <h3 style="font-size:18px;font-weight:800;color:#0B2C4D;margin:0 0 10px">Giao Lộ 3 Tuyến Metro</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0">Nằm cận kề điểm giao thoa của 3 tuyến Metro trọng điểm: Tuyến số 5 (Văn Cao – Hòa Lạc), Tuyến số 6 (Nội Bài – Ngọc Hồi) và Tuyến số 7 (Mê Linh – Hà Đông).</p>
      </div>
      <div style="background:#fff;border-radius:12px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05)">
        <div style="font-size:32px;margin-bottom:12px">🌳</div>
        <h3 style="font-size:18px;font-weight:800;color:#0B2C4D;margin:0 0 10px">Kế Cận Công Viên 5ha</h3>
        <p style="font-size:14px;color:#64748B;line-height:1.6;margin:0">Liền kề công viên trung tâm quy hoạch rộng 5ha và hưởng trọn hạ tầng hoàn chỉnh của đại đô thị Vinhomes Smart City, trung tâm thương mại Vincom Mega Mall và Bệnh viện Đa khoa Quốc tế Vinmec.</p>
      </div>
    </div>

    <!-- Mạng lưới liên kết thời gian -->
    <div style="background:#fff;border-radius:14px;padding:30px;border:1px solid #E2E8F0">
      <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 20px;text-align:center">MẠNG LƯỚI KẾT NỐI VÀNG TỪ CHUNG CƯ LUMI HANOI</h3>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;text-align:center">
        <div style="padding:16px;background:#F1F5F9;border-radius:10px">
          <div style="font-size:24px;font-weight:900;color:#2563EB">1 Phút</div>
          <div style="font-size:13.5px;color:#334155;margin-top:6px;font-weight:600">Đến Vincom Mega Mall &amp; Vườn Nhật Smart City</div>
        </div>
        <div style="padding:16px;background:#F1F5F9;border-radius:10px">
          <div style="font-size:24px;font-weight:900;color:#0D9488">5 Phút</div>
          <div style="font-size:13.5px;color:#334155;margin-top:6px;font-weight:600">Đến Sân vận động Mỹ Đình &amp; Đường đua F1</div>
        </div>
        <div style="padding:16px;background:#F1F5F9;border-radius:10px">
          <div style="font-size:24px;font-weight:900;color:#D97706">8 Phút</div>
          <div style="font-size:13.5px;color:#334155;margin-top:6px;font-weight:600">Đến TT Hội Nghị Quốc Gia &amp; Keangnam Landmark 72</div>
        </div>
        <div style="padding:16px;background:#F1F5F9;border-radius:10px">
          <div style="font-size:24px;font-weight:900;color:#DC2626">35 Phút</div>
          <div style="font-size:13.5px;color:#334155;margin-top:6px;font-weight:600">Đến Sân bay Quốc tế Nội Bài qua Vành Đai 3</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: HỆ THỐNG TIỆN ÍCH RESORT NỘI KHU 5 SAO -->
<section id="tien-ich" style="padding:70px 0;background:#ffffff">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px">CHUẨN MỰC NGHỈ DƯỠNG QUỐC TẾ</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif">HƠN 80 TIỆN ÍCH ĐẶC QUYỀN CHUẨN RESORT 5 SAO</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6">Lumi Hanoi tái định nghĩa phong cách sống thượng lưu với hệ tiện ích đa tầng, nơi mọi thành viên gia đình được chăm sóc toàn diện về sức khỏe thể chất và nuôi dưỡng tinh thần.</p>
    </div>

    <!-- 4 Khối tiện ích lớn -->
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:24px;margin-bottom:30px">
      <div style="border-radius:14px;overflow:hidden;border:1px solid #E2E8F0;background:#F8FAFC">
        <img src="{$img_be_boi}" alt="Bể bơi resort Sole Lap Pool dài 50m chuẩn Olympic tại phân khu Signature dự án Lumi Hanoi CapitaLand" style="width:100%;height:320px;object-fit:cover;display:block" />
        <div style="padding:18px 20px">
          <h3 style="color:#0B2C4D;font-size:19px;font-weight:800;margin:0 0 8px">Bể Bơi Resort Sole Lap Pool 50m Chuẩn Olympic</h3>
          <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0">Cụm hồ bơi vô cực dài 50m được bao quanh bởi rặng dừa xanh mát, sàn tắm nắng phong cách Maldives mang đến trải nghiệm nghỉ dưỡng 365 ngày ngay ngưỡng cửa nhà.</p>
        </div>
      </div>

      <div style="border-radius:14px;overflow:hidden;border:1px solid #E2E8F0;background:#F8FAFC">
        <img src="{$img_la_phoi}" alt="Công viên Lá phổi xanh Green Lung và cầu dạo bộ trên không kết nối thiên nhiên dự án Lumi Hanoi" style="width:100%;height:320px;object-fit:cover;display:block" />
        <div style="padding:18px 20px">
          <h3 style="color:#0B2C4D;font-size:19px;font-weight:800;margin:0 0 8px">Công Viên Sinh Thái Lá Phổi Xanh &amp; Cầu Dạo Bộ Trên Không</h3>
          <p style="color:#64748B;font-size:14px;line-height:1.6;margin:0">Khu vườn xanh mướt rộng 2.4ha với đường dạo bộ trên không rợp bóng cây kết nối xuyên suốt các tòa tháp, là nơi picnic cuối tuần và thư giãn tĩnh tại cho cả gia đình.</p>
        </div>
      </div>
    </div>

    <!-- 4 tiện ích chi tiết 4 cột -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:30px">
      <div style="border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;background:#fff">
        <img src="{$img_lobby}" alt="Đại sảnh đón tiếp 5 sao Grand Lobby Signature 1 Lumi Hanoi" style="width:100%;height:180px;object-fit:cover;display:block" />
        <div style="padding:12px 14px">
          <strong style="color:#0B2C4D;font-size:14px;display:block;margin-bottom:4px">Đại Sảnh Grand Lobby 5 Sao</strong>
          <span style="color:#64748B;font-size:12.5px;line-height:1.4;display:block">Cao trần bề thế đón khách sang trọng</span>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;background:#fff">
        <img src="{$img_party}" alt="Phòng tiệc cư dân đẳng cấp Party House phân khu Signature 2 Lumi Hanoi" style="width:100%;height:180px;object-fit:cover;display:block" />
        <div style="padding:12px 14px">
          <strong style="color:#0B2C4D;font-size:14px;display:block;margin-bottom:4px">Phòng Tiệc Party House</strong>
          <span style="color:#64748B;font-size:12.5px;line-height:1.4;display:block">Không gian tổ chức sinh nhật &amp; hội họp cư dân</span>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;background:#fff">
        <img src="{$img_nuoc}" alt="Sân chơi nước phiêu lưu trẻ em Adventure Waterplay Lumi Hanoi" style="width:100%;height:180px;object-fit:cover;display:block" />
        <div style="padding:12px 14px">
          <strong style="color:#0B2C4D;font-size:14px;display:block;margin-bottom:4px">Sân Chơi Nước Phiêu Lưu</strong>
          <span style="color:#64748B;font-size:12.5px;line-height:1.4;display:block">Hồ vầy máng trượt Adventure Waterplay cho bé</span>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;background:#fff">
        <img src="{$img_bbq}" alt="Vườn nướng BBQ ngoài trời Sole BBQ Pavilion dự án Lumi Hanoi" style="width:100%;height:180px;object-fit:cover;display:block" />
        <div style="padding:12px 14px">
          <strong style="color:#0B2C4D;font-size:14px;display:block;margin-bottom:4px">Vườn BBQ Sole Pavilion</strong>
          <span style="color:#64748B;font-size:12.5px;line-height:1.4;display:block">Tiệc nướng ẩm thực ven hồ lãng mạn</span>
        </div>
      </div>
    </div>

    <!-- Khối tiện ích trẻ em & rooftop -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px">
      <div style="border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;background:#fff">
        <img src="{$img_toddler}" alt="Khu vui chơi trong nhà cho bé Toddlers Playroom Lumi Hanoi" style="width:100%;height:180px;object-fit:cover;display:block" />
        <div style="padding:12px 14px">
          <strong style="color:#0B2C4D;font-size:14px;display:block;margin-bottom:4px">Toddler's Playroom</strong>
          <span style="color:#64748B;font-size:12.5px;line-height:1.4;display:block">Khu vận động nhẹ nhàng an toàn cho trẻ nhỏ</span>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;background:#fff">
        <img src="{$img_kids}" alt="Sân chơi phiêu lưu khám phá Kids Adventure Playground Lumi Hanoi" style="width:100%;height:180px;object-fit:cover;display:block" />
        <div style="padding:12px 14px">
          <strong style="color:#0B2C4D;font-size:14px;display:block;margin-bottom:4px">Kids' Adventure Land</strong>
          <span style="color:#64748B;font-size:12.5px;line-height:1.4;display:block">Mô hình nhà xe buýt xe đua kích thích sáng tạo</span>
        </div>
      </div>

      <div style="border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;background:#fff">
        <img src="{$img_rooftop}" alt="Sân vườn trên cao Rooftop Garden phân khu Lumi Elite" style="width:100%;height:180px;object-fit:cover;display:block" />
        <div style="padding:12px 14px">
          <strong style="color:#0B2C4D;font-size:14px;display:block;margin-bottom:4px">Sân Vườn Tầng Không Rooftop</strong>
          <span style="color:#64748B;font-size:12.5px;line-height:1.4;display:block">Đài thiên văn ngắm sao &amp; Sky Lounge thượng lưu</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: MẶT BẰNG QUY HOẠCH TỔNG THỂ & PHÂN KHU -->
<section id="mat-bang" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px">QUY HOẠCH ĐỒNG BỘ 5.6 HECTA</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif">MẶT BẰNG TỔNG THỂ &amp; CHI TIẾT CÁC TÒA THÁP</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6">Được thiết kế khoa học với mật độ xây dựng khối tháp thấp, các tòa tháp được bố trí sole so le thông minh nhằm tối đa hóa tầm nhìn khoáng đạt và đón trọn ánh sáng tự nhiên.</p>
    </div>

    <!-- Mặt bằng tổng thể -->
    <div style="background:#fff;border-radius:14px;padding:25px;border:1px solid #E2E8F0;margin-bottom:30px">
      <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 14px">1. Sơ Đồ Mặt Bằng Tổng Thể 3 Phân Khu Lumi Hanoi</h3>
      <p style="color:#64748B;font-size:14px;margin-bottom:18px">Gồm 3 phân khu chính: <strong>Lumi Signature</strong> (5 tòa), <strong>Lumi Prestige</strong> (2 tòa) và <strong>Lumi Elite</strong> (2 tòa) nằm hài hòa bên công viên trung tâm và trục đường giao thông nội khu.</p>
      <div style="border-radius:10px;overflow:hidden;border:1px solid #CBD5E1">
        <img src="{$img_mb_tong}" alt="Mặt bằng tổng thể dự án Lumi Hanoi CapitaLand phân khu Prestige, Signature, Elite và hệ thống tiện ích" style="width:100%;height:auto;display:block" />
      </div>
    </div>

    <!-- Chi tiết Mặt bằng Tòa Prestige 1 -->
    <div style="background:#fff;border-radius:14px;padding:25px;border:1px solid #E2E8F0">
      <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 14px">2. Mặt Bằng Tầng Điển Hình Tòa Prestige 1 (16 Căn/Sàn)</h3>
      <p style="color:#64748B;font-size:14px;margin-bottom:18px">Tòa Prestige 1 cao 30 tầng với mật độ chỉ 16 căn/sàn, trang bị 6 thang máy tốc độ cao và tầng 20 tích hợp gian cứu nạn (Refuge Area) theo quy chuẩn an toàn PCCC cao nhất.</p>
      
      <div style="display:grid;grid-template-columns:1.2fr 0.8fr;gap:25px;align-items:start">
        <div style="border-radius:10px;overflow:hidden;border:1px solid #CBD5E1">
          <img src="{$img_mb_prestige}" alt="Mặt bằng tầng điển hình tòa Prestige 1 dự án Lumi Hanoi từ tầng 2 đến tầng 28" style="width:100%;height:auto;display:block" />
        </div>
        <div>
          <h4 style="color:#0B2C4D;font-size:16.5px;font-weight:800;margin:0 0 12px;border-bottom:2px solid #D4AF37;padding-bottom:8px">Cơ Cấu Căn Hộ Tòa Prestige 1:</h4>
          <table style="width:100%;border-collapse:collapse;font-size:13.5px">
            <thead>
              <tr style="background:#0F172A;color:#fff">
                <th style="padding:10px 8px;text-align:left">Loại Căn</th>
                <th style="padding:10px 8px;text-align:center">Diện Tích Thông Thủy</th>
                <th style="padding:10px 8px;text-align:center">Mã Căn Điển Hình</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC">
                <td style="padding:10px 8px;font-weight:700;color:#9333EA">1 Phòng Ngủ (1BR)</td>
                <td style="padding:10px 8px;text-align:center"><strong>42.2 m²</strong></td>
                <td style="padding:10px 8px;text-align:center">Căn 05, 06, 07</td>
              </tr>
              <tr style="border-bottom:1px solid #E2E8F0">
                <td style="padding:10px 8px;font-weight:700;color:#0284C7">2 Phòng Ngủ Nhỏ (2BR Small)</td>
                <td style="padding:10px 8px;text-align:center"><strong>53.8 – 54.5 m²</strong></td>
                <td style="padding:10px 8px;text-align:center">Căn 02, 14, 15</td>
              </tr>
              <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC">
                <td style="padding:10px 8px;font-weight:700;color:#16A34A">2 Phòng Ngủ Vừa (2BR Medium)</td>
                <td style="padding:10px 8px;text-align:center"><strong>62.1 m²</strong></td>
                <td style="padding:10px 8px;text-align:center">Căn 03, 10, 11, 13</td>
              </tr>
              <tr style="border-bottom:1px solid #E2E8F0">
                <td style="padding:10px 8px;font-weight:700;color:#EAB308">3 Phòng Ngủ Vừa (3BR Medium)</td>
                <td style="padding:10px 8px;text-align:center"><strong>86.0 m²</strong></td>
                <td style="padding:10px 8px;text-align:center">Căn 01, 16</td>
              </tr>
              <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC">
                <td style="padding:10px 8px;font-weight:700;color:#DC2626">3 Phòng Ngủ Lớn (3BR Large)</td>
                <td style="padding:10px 8px;text-align:center"><strong>106.9 – 117.8 m²</strong></td>
                <td style="padding:10px 8px;text-align:center">Căn 08, 09 (Góc)</td>
              </tr>
              <tr style="border-bottom:1px solid #E2E8F0">
                <td style="padding:10px 8px;font-weight:700;color:#7C3AED">4 Phòng Ngủ (4BR Large)</td>
                <td style="padding:10px 8px;text-align:center"><strong>136.0 m²</strong></td>
                <td style="padding:10px 8px;text-align:center">Căn 04, 12 (Góc)</td>
              </tr>
              <tr style="background:#FEF3C7;font-weight:800;color:#92400E">
                <td style="padding:12px 8px">TỔNG MẬT ĐỘ SÀN</td>
                <td style="padding:12px 8px;text-align:center">-</td>
                <td style="padding:12px 8px;text-align:center">16 Căn/Sàn (6 Thang Máy)</td>
              </tr>
            </tbody>
          </table>
          <div style="margin-top:14px;padding:12px;background:#EFF6FF;border-radius:6px;font-size:12.5px;color:#1E40AF;line-height:1.5">
            💡 <strong>Điểm nhấn kiến trúc:</strong> 100% căn hộ sở hữu ban công kính thoáng rộng, phòng ngủ tràn ngập ánh sáng tự nhiên. Khu vực bếp được thiết kế khép kín nối liền logia phụ thoát mùi tối ưu.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: KIẾN TRÚC TINH HOA & CĂN HỘ MẪU -->
<section id="can-ho" style="padding:70px 0;background:#ffffff">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px">NGHỆ THUẬT KIẾN TRÚC QUỐC TẾ</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif">THIẾT KẾ BIỂU TƯỢNG BỞI KTS JEAN-FRANÇOIS MILOU</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6">Mỗi tòa tháp tại Lumi Hanoi được tính toán tỉ mỉ với các lam chắn nắng nghệ thuật, hệ kính Low-E cản nhiệt và ban công xanh đa tầng tạo nên bức tranh ánh sáng lung linh rực rỡ cả ngày lẫn đêm.</p>
    </div>

    <!-- 2 ảnh lớn kiến trúc đêm và ngoại thất -->
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:24px;margin-bottom:24px">
      <div style="border-radius:14px;overflow:hidden;border:1px solid #E2E8F0">
        <img src="{$img_dem}" alt="Phối cảnh ban đêm rực rỡ dự án Lumi Hanoi CapitaLand mặt đường Đại lộ Thăng Long" style="width:100%;height:320px;object-fit:cover;display:block" />
        <div style="padding:14px 18px;background:#F8FAFC"><strong style="color:#0B2C4D">Phối cảnh ánh sáng lung linh rực rỡ khi về đêm</strong></div>
      </div>
      <div style="border-radius:14px;overflow:hidden;border:1px solid #E2E8F0">
        <img src="{$img_elite_ngoai}" alt="Kiến trúc mặt ngoài phân khu Lumi Elite với hệ lam chắn nắng hiện đại và ban công xanh" style="width:100%;height:320px;object-fit:cover;display:block" />
        <div style="padding:14px 18px;background:#F8FAFC"><strong style="color:#0B2C4D">Kiến trúc mặt ngoài tinh tế phân khu siêu sang Lumi Elite</strong></div>
      </div>
    </div>

    <!-- Tiêu chuẩn bàn giao -->
    <div style="background:#F8FAFC;border-radius:14px;padding:30px;border:1px solid #E2E8F0">
      <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 16px;text-align:center">DANH MỤC VẬT LIỆU BÀN GIAO TIÊU CHUẨN 5 SAO QUỐC TẾ</h3>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px">
        <div style="background:#fff;border-radius:10px;padding:20px;border:1px solid #E2E8F0">
          <strong style="color:#2563EB;font-size:16px;display:block;margin-bottom:8px">🚪 Khóa Cửa &amp; Cửa Chính</strong>
          <p style="font-size:13.5px;color:#64748B;line-height:1.6;margin:0">Cửa gỗ chống cháy cao cấp, khóa thông minh tích hợp 4 phương thức mở khóa: vân tay, mã số, thẻ từ và chìa cơ cơ học.</p>
        </div>
        <div style="background:#fff;border-radius:10px;padding:20px;border:1px solid #E2E8F0">
          <strong style="color:#0D9488;font-size:16px;display:block;margin-bottom:8px">🍳 Thiết Bị Bếp Nhập Khẩu</strong>
          <p style="font-size:13.5px;color:#64748B;line-height:1.6;margin:0">Bàn giao đầy đủ tủ bếp trên dưới acrylic bóng gương, mặt bếp đá thạch anh nhân tạo cao cấp, bếp từ và máy hút mùi Hafele / Bosch.</p>
        </div>
        <div style="background:#fff;border-radius:10px;padding:20px;border:1px solid #E2E8F0">
          <strong style="color:#D97706;font-size:16px;display:block;margin-bottom:8px">🚿 Thiết Bị Vệ Sinh Kohler</strong>
          <p style="font-size:13.5px;color:#64748B;line-height:1.6;margin:0">Toàn bộ thiết bị vệ sinh cao cấp thương hiệu Kohler (Mỹ), vách tắm kính cường lực, lavabo âm bàn và sen tắm đứng hiện đại.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: BẢNG GIÁ DỰ KIẾN & TIẾN ĐỘ THANH TOÁN ĐỢT 1 NĂM 2026 -->
<section id="bang-gia" style="padding:70px 0;background:#F8FAFC;border-top:1px solid #E2E8F0">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px">CHÍNH SÁCH BÁN HÀNG NĂM 2026</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif">BẢNG GIÁ CĂN HỘ &amp; TIẾN ĐỘ THANH TOÁN LUMI HANOI</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6">Chính sách thanh toán thảnh thơi chuẩn CapitaLand Singapore: Chỉ thanh toán 50% trước khi nhận nhà cùng gói hỗ trợ tài chính ưu việt từ ngân hàng.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:35px">
      <!-- Căn 1PN -->
      <div style="background:#fff;border-radius:14px;padding:30px 24px;border:1.5px solid #E2E8F0;text-align:center;position:relative">
        <h3 style="font-size:20px;font-weight:800;color:#0B2C4D;margin:0 0 10px">Căn Hộ 1 Phòng Ngủ</h3>
        <div style="font-size:14px;color:#64748B;margin-bottom:16px">Diện tích: <strong>42.2 m²</strong> (1WC, 1 Logia)</div>
        <div style="font-size:26px;font-weight:900;color:#DC2626;margin-bottom:16px">Từ 2.9 - 3.4 Tỷ</div>
        <ul style="text-align:left;font-size:13.5px;color:#475569;line-height:1.8;padding-left:18px;margin-bottom:24px">
          <li>Vốn tự có ban đầu chỉ từ: <strong>580 triệu (20%)</strong></li>
          <li>Lựa chọn lý tưởng cho chuyên gia nước ngoài thuê</li>
          <li>Suất sinh lời dòng tiền cho thuê 7-9%/năm</li>
        </ul>
        <a href="#dang-ky" style="display:block;background:#0F172A;color:#fff;font-weight:700;padding:12px;border-radius:8px;text-decoration:none">Nhận Bảng Tính Dòng Tiền 1PN</a>
      </div>

      <!-- Căn 2PN Hot -->
      <div style="background:#fff;border-radius:14px;padding:30px 24px;border:2px solid #D4AF37;text-align:center;position:relative;box-shadow:0 10px 25px -5px rgba(212,175,55,0.25)">
        <div style="position:absolute;top:-12px;left:50%;transform:translateX(-50%);background:#D4AF37;color:#071D36;font-size:11.5px;font-weight:800;padding:4px 14px;border-radius:20px;text-transform:uppercase">🔥 Căn Hộ Bán Chạy Nhất</div>
        <h3 style="font-size:20px;font-weight:800;color:#0B2C4D;margin:0 0 10px">Căn Hộ 2 Phòng Ngủ</h3>
        <div style="font-size:14px;color:#64748B;margin-bottom:16px">Diện tích: <strong>53.8 – 74.3 m²</strong> (2WC, 2 Ban công)</div>
        <div style="font-size:26px;font-weight:900;color:#DC2626;margin-bottom:16px">Từ 3.9 - 5.2 Tỷ</div>
        <ul style="text-align:left;font-size:13.5px;color:#475569;line-height:1.8;padding-left:18px;margin-bottom:24px">
          <li>Thiết kế tối ưu cho gia đình trẻ 1-2 con</li>
          <li>Ngân hàng hỗ trợ vay 70%, ân hạn gốc &amp; LS 0%</li>
          <li>Chiết khấu booking sớm hấp dẫn từ CĐT</li>
        </ul>
        <a href="#dang-ky" style="display:block;background:linear-gradient(135deg,#D4AF37 0%,#AA8010 100%);color:#071D36;font-weight:800;padding:12px;border-radius:8px;text-decoration:none">Nhận Báo Giá Căn 2PN</a>
      </div>

      <!-- Căn 3PN Góc -->
      <div style="background:#fff;border-radius:14px;padding:30px 24px;border:1.5px solid #E2E8F0;text-align:center;position:relative">
        <h3 style="font-size:20px;font-weight:800;color:#0B2C4D;margin:0 0 10px">Căn Hộ 3 Phòng Ngủ (Góc)</h3>
        <div style="font-size:14px;color:#64748B;margin-bottom:16px">Diện tích: <strong>86.0 – 117.8 m²</strong> (2-3WC, 2 Mặt thoáng)</div>
        <div style="font-size:26px;font-weight:900;color:#DC2626;margin-bottom:16px">Từ 5.9 - 8.5 Tỷ</div>
        <ul style="text-align:left;font-size:13.5px;color:#475569;line-height:1.8;padding-left:18px;margin-bottom:24px">
          <li>View trực diện hồ bơi resort và công viên 2.4ha</li>
          <li>Không gian sinh hoạt rộng rãi cho gia đình 3 thế hệ</li>
          <li>Bàn giao gói nội thất nhập khẩu cao cấp</li>
        </ul>
        <a href="#dang-ky" style="display:block;background:#0F172A;color:#fff;font-weight:700;padding:12px;border-radius:8px;text-decoration:none">Nhận Bảng Giá Căn 3PN</a>
      </div>
    </div>

    <!-- Công cụ tính lãi vay -->
    [kbds_loan_calculator]
  </div>
</section>

<!-- SECTION 8: PHÁP LÝ HOÀN CHỈNH & BẢO CHỨNG TẬP ĐOÀN CAPITALAND -->
<section id="phap-ly" style="padding:70px 0;background:#ffffff;border-top:1px solid #E2E8F0">
  <div class="kbds-container">
    <div style="text-align:center;max-width:800px;margin:0 auto 40px">
      <span style="color:#C2562B;font-weight:700;text-transform:uppercase;letter-spacing:1px;font-size:13px">BẢO CHỨNG ĐẦU TƯ BỀN VỮNG</span>
      <h2 style="color:#0B2C4D;font-size:32px;font-weight:800;margin:8px 0 14px;font-family:'Playfair Display',Georgia,serif">PHÁP LÝ MINH BẠCH &amp; UY TÍN TẬP ĐOÀN CAPITALAND</h2>
      <p style="color:#64748B;font-size:15.5px;line-height:1.6">Lựa chọn Lumi Hanoi đồng nghĩa với việc sở hữu một tài sản truyền đời an toàn tuyệt đối được bảo chứng bởi tập đoàn bất động sản uy tín hàng đầu châu Á.</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px">
      <div style="background:#F8FAFC;border-radius:12px;padding:28px;border:1px solid #E2E8F0">
        <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 14px;display:flex;align-items:center;gap:10px">
          <span>⚖️</span> Hồ Sơ Pháp Lý Đầy Đủ
        </h3>
        <ul style="color:#475569;font-size:14.5px;line-height:1.9;padding-left:20px;margin:0">
          <li>Dự án đã có quyết định phê duyệt Quy hoạch chi tiết 1/500 và chấp thuận chủ trương đầu tư chính thức.</li>
          <li>Đầy đủ Giấy phép xây dựng, hồ sơ nghiệm thu móng và thẩm duyệt PCCC theo tiêu chuẩn an toàn hiện hành.</li>
          <li>Hình thức sở hữu: <strong>Sổ hồng sở hữu lâu dài (vĩnh viễn)</strong> đối với người Việt Nam và 50 năm đối với người nước ngoài.</li>
          <li>Các ngân hàng lớn Vietcombank, BIDV, Techcombank bảo lãnh tiến độ và hỗ trợ giải ngân 70% giá trị hợp đồng.</li>
        </ul>
      </div>

      <div style="background:#F8FAFC;border-radius:12px;padding:28px;border:1px solid #E2E8F0">
        <h3 style="color:#0B2C4D;font-size:20px;font-weight:800;margin:0 0 14px;display:flex;align-items:center;gap:10px">
          <span>🏛️</span> Tiềm Lực Tập Đoàn CapitaLand
        </h3>
        <ul style="color:#475569;font-size:14.5px;line-height:1.9;padding-left:20px;margin:0">
          <li>Tập đoàn bất động sản đa quốc gia trụ sở chính tại Singapore với tổng tài sản quản lý hơn 130 tỷ SGD trên toàn cầu.</li>
          <li>Hơn 30 năm phát triển tại Việt Nam với các dự án biểu tượng: <strong>Heritage West Lake (Tây Hồ)</strong>, <strong>Seasons Avenue</strong>, <strong>Feliz en Vista</strong>, <strong>d'Edge Thảo Điền</strong>, <strong>Define</strong>...</li>
          <li>Cam kết chất lượng xây dựng vượt trội, quản lý vận hành chuẩn 5 sao quốc tế và bàn giao nhà đúng tiến độ.</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 9: FORM ĐĂNG KÝ CAO TẦNG -->
<section id="dang-ky" style="padding:40px 0;background:#0A2244">
  <div class="kbds-container">
    [kbds_lead_form_cao_tang project="Chung Cư Lumi Hanoi CapitaLand" title="📥 ĐĂNG KÝ NHẬN BẢNG GIÁ GỐC ĐỢT 1 &amp; MẶT BẰNG 9 TÒA THÁP" button_text="GỬI BẢNG GIÁ CHO TÔI QUA ZALO ➔"]
  </div>
</section>

<!-- SECTION 10: TIN TỨC VỆ TINH TOPIC CLUSTER -->
[kbds_project_news]
HTML;

$post_data = [
    'post_title'   => $title,
    'post_name'    => $slug,
    'post_content' => $content,
    'post_status'  => 'publish',
    'post_type'    => 'du_an',
    'post_author'  => 1
];

if ($post_id > 0) {
    $post_data['ID'] = $post_id;
    wp_update_post($post_data);
    echo "Updated existing project ID: $post_id\n";
} else {
    $post_id = wp_insert_post($post_data);
    echo "Created new project ID: $post_id\n";
}

// 2. Set Featured Image
set_post_thumbnail($post_id, $featured_img_id);
echo "Set featured image ID: $featured_img_id\n";

// 3. Taxonomies
// CĐT CapitaLand
$cdt_term = term_exists('CapitaLand Development', 'chu_dau_tu');
if (!$cdt_term) {
    $cdt_term = wp_insert_term('CapitaLand Development', 'chu_dau_tu', ['slug' => 'capitaland-development']);
}
$cdt_id = is_array($cdt_term) ? $cdt_term['term_id'] : $cdt_term;
wp_set_object_terms($post_id, [(int)$cdt_id], 'chu_dau_tu');

// Khu vực: Dự án tại Hà Nội (ID 16), Nam Từ Liêm (ID 62)
wp_set_object_terms($post_id, [16, 62], 'khu_vuc_bds');

// Loại hình: Căn hộ chung cư (ID 6), can-ho-cao-cap (ID 89)
wp_set_object_terms($post_id, [6, 89], 'loai_hinh_bds');

// 4. Custom Meta Fields
update_post_meta($post_id, '_kbds_project_code', 'LUMI-CAPITALAND');
update_post_meta($post_id, '_kbds_price_from', '66 Triệu/m²');
update_post_meta($post_id, '_kbds_price_to', '85 Triệu/m²');
update_post_meta($post_id, '_kbds_address', 'Mặt tiền Đại lộ Thăng Long, P. Tây Mỗ, Q. Nam Từ Liêm, Hà Nội');
update_post_meta($post_id, '_kbds_total_area', '5.6 ha (56.000 m²)');
update_post_meta($post_id, '_kbds_scale', '9 tòa tháp cao 29 - 35 tầng, ~3.950 căn hộ cao cấp, Duplex & Penthouse');
update_post_meta($post_id, '_kbds_legal_status', 'Sổ hồng sở hữu lâu dài (người Việt Nam), 50 năm (người nước ngoài)');
update_post_meta($post_id, '_kbds_handover_time', 'Quý III - IV/2026');
update_post_meta($post_id, '_kbds_bank_support', 'Vietcombank, BIDV, Techcombank hỗ trợ vay 70%, ân hạn gốc & lãi suất 0%');
update_post_meta($post_id, '_kbds_brochure_url', 'https://kenhbatdongsan.vn/du-an/lumi-hanoi/#dang-ky');
update_post_meta($post_id, '_kbds_review_score', '9.6');
update_post_meta($post_id, '_kbds_pros_cons', "+ Tọa lạc mặt tiền Đại lộ Thăng Long kết nối trực tiếp trung tâm hành chính phía Tây\n+ Phát triển bởi CapitaLand Development - Tập đoàn số 1 Singapore với hơn 30 năm uy tín\n+ Thiết kế độc bản bởi KTS thế giới Jean-François Milou\n+ Hơn 80 tiện ích cao cấp chuẩn resort 5 sao quốc tế");

// 5. Rank Math SEO Fields
update_post_meta($post_id, 'rank_math_title', 'Chung Cư Lumi Hanoi CapitaLand | Bảng Giá & Mặt Bằng 2026');
update_post_meta($post_id, 'rank_math_description', 'Đại dự án chung cư Lumi Hanoi CapitaLand mặt đường Đại lộ Thăng Long, Nam Từ Liêm. Cập nhật bảng giá gốc CĐT, mặt bằng 9 tòa tháp & chính sách ưu đãi mới nhất 2026.');
update_post_meta($post_id, 'rank_math_focus_keyword', 'Lumi Hanoi, chung cư Lumi Hanoi, Lumi Hanoi CapitaLand, dự án Lumi Hanoi');
update_post_meta($post_id, 'rank_math_robots', serialize(['index', 'follow']));
update_post_meta($post_id, 'rank_math_seo_score', 96);
update_post_meta($post_id, 'rank_math_pillar_content', 'on');
update_post_meta($post_id, 'rank_math_internal_links_processed', 1);

// Schema Structured Data
$schema_data = [
    '@context' => 'https://schema.org',
    '@type' => 'ApartmentComplex',
    'name' => 'Lumi Hanoi',
    'alternateName' => ['Chung cư Lumi Hanoi', 'Lumi Hanoi CapitaLand'],
    'description' => 'Tổ hợp căn hộ cao cấp 5.6ha Lumi Hanoi do CapitaLand Development phát triển tại mặt đường Đại lộ Thăng Long, Tây Mỗ, Nam Từ Liêm, Hà Nội.',
    'url' => 'https://kenhbatdongsan.vn/du-an/lumi-hanoi/',
    'telephone' => '0942.655.111',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Đại lộ Thăng Long, Phường Tây Mỗ',
        'addressLocality' => 'Quận Nam Từ Liêm',
        'addressRegion' => 'Hà Nội',
        'addressCountry' => 'VN'
    ],
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => 20.9995,
        'longitude' => 105.7482
    ],
    'amenityFeature' => [
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Bể bơi resort 50m Sole Lap Pool', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Công viên Lá phổi xanh Green Lung 2.4ha', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Cầu dạo bộ trên không kết nối 9 tòa tháp', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Đại sảnh Grand Lobby 5 sao', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Phòng tiệc Party House & BBQ Pavilion', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Khu vui chơi trẻ em Kids Adventure Land', 'value' => true]
    ]
];
update_post_meta($post_id, 'rank_math_schema_ApartmentComplex', $schema_data);

echo "SUCCESS! Project ID: $post_id created/updated with full SEO metadata and schema!\n";
echo "URL: " . get_permalink($post_id) . "\n";
