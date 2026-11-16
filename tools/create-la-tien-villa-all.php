<?php
/**
 * Tạo trọn gói Trang Dự Án La Tiên Villa Nha Trang + 5 Bài viết vệ tinh chuẩn SEO Topic Cluster
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU XÂY DỰNG TRANG DỰ ÁN LA TIÊN VILLA NHA TRANG\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/la-tien-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/la-tien-media-map.json. Hãy chạy tools/import-la-tien-villa.php trước!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// 1. Đảm bảo term Chủ đầu tư KDI Holdings tồn tại
if (!term_exists('KDI Holdings', 'chu_dau_tu')) {
    wp_insert_term('KDI Holdings', 'chu_dau_tu', [
        'slug' => 'kdi-holdings',
        'description' => 'Tập đoàn KDI Holdings - Chủ đầu tư siêu dự án quần thể biển Libera Nha Trang'
    ]);
    echo " + Đã tạo term Chủ đầu tư: KDI Holdings\n";
}

// 2. SOẠN NỘI DUNG 10 SECTION LANDING PAGE LA TIÊN VILLA
$landing_html = <<<HTML
<!-- SUBNAV ĐIỀU HƯỚNG DỰ ÁN -->
<div class="kbds-project-subnav" style="position:sticky;top:0;z-index:99;background:#0F172A;box-shadow:0 4px 20px rgba(0,0,0,0.15);border-bottom:1px solid #1E293B;">
  <div class="kbds-container" style="display:flex;align-items:center;justify-content:space-between;padding:12px 20px;overflow-x:auto;white-space:nowrap;gap:12px;">
    <div style="font-weight:800;font-size:16px;color:#F8FAFC;display:flex;align-items:center;gap:8px;">
      <span style="display:inline-block;width:10px;height:10px;background:#EA580C;border-radius:50%;box-shadow:0 0 10px #EA580C;"></span>
      LA TIÊN VILLA
    </div>
    <div style="display:flex;gap:18px;font-size:13.5px;font-weight:600;">
      <a href="#tong-quan" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#EA580C'" onmouseout="this.style.color='#CBD5E1'">Tổng Quan</a>
      <a href="#vi-tri" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#EA580C'" onmouseout="this.style.color='#CBD5E1'">Vị Trí Bãi Tiên</a>
      <a href="#tien-ich" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#EA580C'" onmouseout="this.style.color='#CBD5E1'">Tiện Ích 5 Sao</a>
      <a href="#quang-truong" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#EA580C'" onmouseout="this.style.color='#CBD5E1'">Quảng Trường Âm Nhạc</a>
      <a href="#yacht-club" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#EA580C'" onmouseout="this.style.color='#CBD5E1'">Yacht Clubhouse</a>
      <a href="#san-pham" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#EA580C'" onmouseout="this.style.color='#CBD5E1'">Biệt Thự & Phố Thương Mại</a>
      <a href="#hoang-hon-bai-tien" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#EA580C'" onmouseout="this.style.color='#CBD5E1'">Vịnh Biển Bãi Tiên</a>
      <a href="#tin-tuc-du-an" style="color:#CBD5E1;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#EA580C'" onmouseout="this.style.color='#CBD5E1'">Tin Tức Phân Tích</a>
    </div>
    <a href="#dang-ky" style="background:linear-gradient(135deg,#EA580C,#C2410C);color:#fff;padding:8px 18px;border-radius:24px;font-size:12.5px;font-weight:700;text-decoration:none;box-shadow:0 4px 12px rgba(234,88,12,0.35);">Đăng Ký Tư Vấn</a>
  </div>
</div>

<!-- SECTION 1: HERO BANNER -->
<section style="position:relative;background:linear-gradient(135deg,#021526 0%,#0F2942 50%,#0369A1 100%);color:#fff;padding:80px 0 100px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.18;background:radial-gradient(circle at 80% 20%,#EA580C 0%,transparent 60%);pointer-events:none;"></div>
  <div class="kbds-container" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:40px;align-items:center;">
    <div>
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(234,88,12,0.2);border:1px solid rgba(234,88,12,0.4);color:#FDBA74;padding:6px 16px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;">
        ⭐ TUYỆT TÁC BIỆT THỰ BIỂN SỞ HỮU LÂU DÀI TẠI NHA TRANG
      </div>
      <h1 style="color:#FFFFFF;font-size:42px;font-weight:900;line-height:1.2;margin:0 0 18px;">
        LA TIÊN VILLA NHA TRANG
        <span style="display:block;font-size:24px;font-weight:600;color:#38BDF8;margin-top:6px;">Quần Thể Đô Thị Biển Libera Bãi Tiên</span>
      </h1>
      <p style="color:#E2E8F0;font-size:16.5px;line-height:1.7;margin:0 0 28px;max-width:620px;">
        Tọa lạc tại Bãi Tiên thơ mộng – nơi giao thoa tuyệt mỹ giữa núi non kỳ vĩ và vịnh biển Nha Trang trong xanh. <strong>La Tiên Villa</strong> kiến tạo chuẩn sống <em>"Home Living 5 Sao"</em> với bến du thuyền riêng, triết lý kiến trúc <em>"nhà biết thở"</em> và hệ sinh thái quốc tế vận hành bởi The Ascott Limited.
      </p>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:30px;">
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#FDBA74;">668 Căn</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Biệt thự giới hạn</div>
        </div>
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#38BDF8;">Sổ Lâu Dài</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Pháp lý hoàn chỉnh</div>
        </div>
        <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);padding:14px 16px;border-radius:10px;text-align:center;">
          <div style="font-size:20px;font-weight:800;color:#4ADE80;">The Ascott</div>
          <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Quản lý vận hành 5★</div>
        </div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:#EA580C;color:#fff;font-weight:700;padding:14px 28px;border-radius:8px;text-decoration:none;box-shadow:0 6px 20px rgba(234,88,12,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Nhận Bảng Giá Gốc & CSBH Mới Nhất</span> →
        </a>
        <a href="#vi-tri" style="background:transparent;color:#fff;font-weight:600;padding:14px 24px;border-radius:8px;text-decoration:none;border:1px solid rgba(255,255,255,0.3);">
          Khám Phá Vị Trí Bãi Tiên
        </a>
      </div>
    </div>
    <div style="position:relative;">
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.4);border:2px solid rgba(255,255,255,0.15);">
        <img src="{$m['yacht_clubhouse']['url']}" alt="{$m['yacht_clubhouse']['alt']}" style="width:100%;height:400px;object-fit:cover;display:block;" />
      </div>
      <div style="position:absolute;bottom:-18px;left:20px;right:20px;background:rgba(15,23,42,0.92);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.15);padding:14px 20px;border-radius:12px;color:#fff;display:flex;align-items:center;justify-content:space-between;">
        <div>
          <span style="font-size:11.5px;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Biểu tượng nghỉ dưỡng</span>
          <div style="font-size:15px;font-weight:700;color:#FDBA74;">Yacht Clubhouse & Bến Du Thuyền</div>
        </div>
        <span style="background:#0284C7;color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:12px;">Đẳng cấp quốc tế</span>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: BẢNG TỔNG QUAN HỒ SƠ DỰ ÁN -->
<section id="tong-quan" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="background:#FFF7ED;color:#C2410C;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Hồ sơ chính thức</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 10px;">THÔNG TIN TỔNG QUAN LA TIÊN VILLA</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Hội tụ các đối tác kiến tạo hàng đầu Việt Nam và Quốc tế trong quần thể đô thị biển Libera Nha Trang</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:16px;padding:32px;">
      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tên dự án:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:15px;">LA TIÊN VILLA (Libera Nha Trang)</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Vị trí dự án:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Bãi Tiên, Đại lộ Phạm Văn Đồng, P. Vĩnh Hòa, TP. Nha Trang, Tỉnh Khánh Hòa</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Chủ đầu tư:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:14.5px;">Tập đoàn KDI Holdings</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Đồng phát triển:</span>
          <span style="flex:1;font-weight:700;color:#C2410C;font-size:14.5px;">Masterise Homes</span>
        </div>
        <div style="display:flex;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Vận hành quản lý:</span>
          <span style="flex:1;font-weight:700;color:#0284C7;font-size:14.5px;">The Ascott Limited (Singapore)</span>
        </div>
      </div>

      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Quy mô quần thể:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">44 ha với hơn 2km bờ biển riêng & 3 bãi tắm tự nhiên</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Sản phẩm phát triển:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Biệt thự biển (Central, Nature, Hidden, Oceanview, Dốc Hoa) & Boutique House phố thương mại</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Số lượng:</span>
          <span style="flex:1;font-weight:700;color:#0F172A;font-size:14.5px;">668 căn biệt thự phiên bản giới hạn</span>
        </div>
        <div style="display:flex;border-bottom:1px solid #E2E8F0;padding-bottom:12px;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Pháp lý dự án:</span>
          <span style="flex:1;font-weight:700;color:#16A34A;font-size:14.5px;">Sở hữu lâu dài (Sổ đỏ từng căn)</span>
        </div>
        <div style="display:flex;">
          <span style="width:160px;font-weight:700;color:#475569;font-size:14.5px;">Tiêu chuẩn bàn giao:</span>
          <span style="flex:1;color:#0F172A;font-size:14.5px;">Hoàn thiện Full nội thất cao cấp chuẩn Home Living 5 sao</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VỊ TRÍ & TỌA ĐỘ SIÊU KẾT NỐI -->
<section id="vi-tri" style="padding:70px 0;background:#F1F5F9;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 40px;">
      <span style="background:#E0F2FE;color:#0284C7;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Tọa độ vương giả</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 12px;">VỊ TRÍ KIM CƯƠNG TẠI BÃI TIÊN NHA TRANG</h2>
      <p style="color:#475569;font-size:15px;margin:0;line-height:1.6;">
        Sở hữu địa thế "Tựa Sơn Hướng Hải" độc tôn tại Bãi Tiên – một trong những vịnh biển ngắm hoàng hôn và bình minh đẹp nhất hành tinh, dễ dàng kết nối tới trung tâm TP. Nha Trang và Sân bay Quốc tế Cam Ranh.
      </p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center;">
      <div style="border-radius:14px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.1);border:1px solid #CBD5E1;background:#fff;">
        <img src="{$m['ban_do_vi_tri']['url']}" alt="{$m['ban_do_vi_tri']['alt']}" style="width:100%;height:auto;display:block;" />
      </div>
      <div>
        <h3 style="color:#0F172A;font-size:22px;font-weight:800;margin:0 0 16px;">Tâm Điểm Kết Nối Liên Vùng & Hạ Tầng Hàng Không</h3>
        <p style="color:#475569;font-size:14.5px;line-height:1.7;margin:0 0 20px;">
          Nhờ tuyến đường ven biển tỷ đô Phạm Văn Đồng và quy hoạch kết nối sân bay qua đèo Cù Hin, cư dân và du khách tại La Tiên Villa tận hưởng thời gian di chuyển cực kỳ nhanh chóng:
        </p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
          <div style="background:#fff;border-left:4px solid #EA580C;padding:12px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:18px;font-weight:800;color:#EA580C;">15 Phút</div>
            <div style="font-size:13px;color:#64748B;margin-top:2px;">Tới Tháp Trầm Hương & Trung tâm Nha Trang</div>
          </div>
          <div style="background:#fff;border-left:4px solid #0284C7;padding:12px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:18px;font-weight:800;color:#0284C7;">-10 km</div>
            <div style="font-size:13px;color:#64748B;margin-top:2px;">Rút ngắn đi Sân bay Cam Ranh qua đèo Cù Hin</div>
          </div>
          <div style="background:#fff;border-left:4px solid #16A34A;padding:12px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:18px;font-weight:800;color:#16A34A;">8 - 12 km</div>
            <div style="font-size:13px;color:#64748B;margin-top:2px;">Tháp Po Nagar, Chợ Đầm, Nhà thờ Núi</div>
          </div>
          <div style="background:#fff;border-left:4px solid #8B5CF6;padding:12px 16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:18px;font-weight:800;color:#8B5CF6;">4 Tiếng</div>
            <div style="font-size:13px;color:#64748B;margin-top:2px;">Kết nối TP.HCM qua toàn tuyến Cao Tốc Bắc Nam</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: HỆ THỐNG TIỆN ÍCH QUỐC TẾ 5 SAO -->
<section id="tien-ich" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 40px;">
      <span style="background:#FEF3C7;color:#D97706;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Hệ sinh thái đẳng cấp</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 12px;">BỘ SƯU TẬP TIỆN ÍCH ĐỘC BẢN CHUẨN THƯỢNG LƯU</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Thừa hưởng toàn bộ chuỗi tiện ích tỷ đô của quần thể Libera Nha Trang, đáp ứng trọn vẹn nhu cầu nghỉ dưỡng – giải trí – chăm sóc sức khỏe đỉnh cao.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
      <!-- Tiện ích 1 -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:14px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <img src="{$m['ho_vay']['url']}" alt="{$m['ho_vay']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:20px;">
          <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:0 0 8px;">Hồ Vầy Nội Khu An Toàn Cho Bé</h3>
          <p style="color:#475569;font-size:13.5px;line-height:1.6;margin:0;">Thiết kế thoai thoải phong cách ốc đảo lagoon với nền cát mịn tự nhiên, mực nước an toàn và bao bọc bởi vườn cây nhiệt đới tươi mát.</p>
        </div>
      </div>

      <!-- Tiện ích 2 -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:14px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <img src="{$m['san_choi_tre_em']['url']}" alt="{$m['san_choi_tre_em']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:20px;">
          <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:0 0 8px;">Sân Chơi Trẻ Em Eco-Friendly</h3>
          <p style="color:#475569;font-size:13.5px;line-height:1.6;margin:0;">Khu vui chơi sinh thái núp lùm dưới những tán cây xanh mát, nổi bật với tượng linh vật Voọc chà vá chân nâu cách điệu nghệ thuật.</p>
        </div>
      </div>

      <!-- Tiện ích 3 -->
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:14px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <img src="{$m['boutique_house']['url']}" alt="{$m['boutique_house']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:20px;">
          <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:0 0 8px;">Phố Thương Mại Boutique House</h3>
          <p style="color:#475569;font-size:13.5px;line-height:1.6;margin:0;">Chuỗi shophouse, nhà hàng ẩm thực Michelin, cafe view biển và boutique store thời trang cao cấp phục vụ hàng triệu lượt khách mỗi năm.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: QUẢNG TRƯỜNG ÂM NHẠC & CÔNG TRÌNH BIỂU TƯỢNG TRỐNG ĐỒNG -->
<section id="quang-truong" style="padding:70px 0;background:#0F172A;color:#fff;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 44px;">
      <span style="background:rgba(234,88,12,0.25);border:1px solid rgba(234,88,12,0.4);color:#FDBA74;font-size:12px;font-weight:700;padding:5px 16px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Kỳ quan kiến trúc</span>
      <h2 style="color:#FFFFFF;font-size:32px;font-weight:800;margin:0 0 12px;">QUẢNG TRƯỜNG ÂM NHẠC & BIỂU TƯỢNG TRỐNG ĐỒNG</h2>
      <p style="color:#CBD5E1;font-size:15px;margin:0;">Tâm điểm văn hóa nghệ thuật và lễ hội quốc tế với sức chứa lên tới 6.000 khán giả cùng lúc</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center;margin-bottom:40px;">
      <div style="border-radius:14px;overflow:hidden;box-shadow:0 16px 32px rgba(0,0,0,0.4);border:1px solid rgba(255,255,255,0.15);">
        <img src="{$m['quang_truong_am_nhac']['url']}" alt="{$m['quang_truong_am_nhac']['alt']}" style="width:100%;height:320px;object-fit:cover;display:block;" />
      </div>
      <div>
        <h3 style="color:#38BDF8;font-size:22px;font-weight:800;margin:0 0 14px;">Quảng Trường Âm Nhạc 10 Cây Bao Báp Khổng Lồ</h3>
        <p style="color:#E2E8F0;font-size:14.5px;line-height:1.7;margin:0 0 16px;">
          Điểm nhấn chưa từng có tại Việt Nam: 10 cây bao báp kỳ vĩ tỏa bóng mát ôm trọn quảng trường âm nhạc dân tộc rộng lớn. Nơi diễn ra các sự kiện âm nhạc, đại nhạc hội bờ biển quốc tế và lễ hội văn hóa đa sắc màu suốt 365 ngày trong năm.
        </p>
        <ul style="color:#CBD5E1;font-size:14px;line-height:1.8;padding-left:20px;margin:0;">
          <li>Sức chứa sự kiện quy mô lớn lên tới <strong>6.000 khách cùng lúc</strong>.</li>
          <li>Khu vực artwork âm nhạc dân tộc độc bản tôn vinh văn hóa Việt.</li>
          <li>Kết nối trực tiếp trục phố đi bộ thương mại hướng biển sầm uất.</li>
        </ul>
      </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center;">
      <div style="order:2;border-radius:14px;overflow:hidden;box-shadow:0 16px 32px rgba(0,0,0,0.4);border:1px solid rgba(255,255,255,0.15);">
        <img src="{$m['trong_dong']['url']}" alt="{$m['trong_dong']['alt']}" style="width:100%;height:320px;object-fit:cover;display:block;" />
      </div>
      <div style="order:1;">
        <h3 style="color:#FDBA74;font-size:22px;font-weight:800;margin:0 0 14px;">Công Trình Biểu Tượng Trống Đồng Việt Nam</h3>
        <p style="color:#E2E8F0;font-size:14.5px;line-height:1.7;margin:0 0 16px;">
          Khối kiến trúc hình trống đồng khổng lồ bằng kính trong suốt phát sáng rực rỡ trong đêm, kết hợp hệ thống nhạc nước công nghệ laser 3D hiện đại. Đây là công trình biểu tượng trường tồn, giao thoa tinh tế giữa bản sắc ngàn năm văn hiến và tinh hoa kiến trúc thế giới.
        </p>
        <div style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);padding:14px 18px;border-radius:10px;">
          <div style="font-weight:700;color:#FDBA74;font-size:14px;margin-bottom:4px;">Nhà hát nghệ thuật đương đại Vega Theatre</div>
          <div style="color:#94A3B8;font-size:13px;">Nơi biểu diễn vở diễn Rối Mơ độc quyền vang danh thế giới, thu hút hàng trăm nghìn lượt khách quốc tế mỗi năm.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 6: YACHT CLUBHOUSE & BẾN DU THUYỀN -->
<section id="yacht-club" style="padding:70px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1.05fr 0.95fr;gap:40px;align-items:center;">
      <div>
        <span style="background:#E0F2FE;color:#0369A1;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Biểu tượng vương giả</span>
        <h2 style="color:#0F172A;font-size:32px;font-weight:800;line-height:1.3;margin:0 0 16px;">
          YACHT CLUBHOUSE: NƠI HỘI NGỘ CỦA GIỚI THƯỢNG LƯU
        </h2>
        <p style="color:#475569;font-size:15px;line-height:1.7;margin:0 0 18px;">
          Tọa lạc ngay cửa ngõ dự án sát vịnh biển, <strong>Yacht Clubhouse</strong> mang thiết kế đương đại tôn vinh vẻ đẹp thiên nhiên từ cảm hứng <em>cát biển và san hô đỏ "signature"</em> tại vùng đất Libera Nha Trang.
        </p>
        <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:24px;">
          <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="color:#EA580C;font-size:18px;">⚓</span>
            <div>
              <strong style="color:#0F172A;font-size:14.5px;">Bến đỗ du thuyền cá nhân:</strong>
              <div style="color:#64748B;font-size:13.5px;">Phục vụ những hải trình xa hoa khám phá vịnh Nha Trang và các đảo ngọc.</div>
            </div>
          </div>
          <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="color:#0284C7;font-size:18px;">🍸</span>
            <div>
              <strong style="color:#0F172A;font-size:14.5px;">Lounge bar & Cigar Club thượng hạng:</strong>
              <div style="color:#64748B;font-size:13.5px;">Không gian gặp gỡ kín đáo, sang trọng dành riêng cho cộng đồng tinh hoa chủ nhân biệt thự.</div>
            </div>
          </div>
          <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="color:#16A34A;font-size:18px;">🏊</span>
            <div>
              <strong style="color:#0F172A;font-size:14.5px;">Hồ bơi vô cực tràn biển:</strong>
              <div style="color:#64748B;font-size:13.5px;">Tầm nhìn thẳng ra đường chân trời, ôm trọn vẻ đẹp lấp lánh của đại dương.</div>
            </div>
          </div>
        </div>
      </div>
      <div style="border-radius:16px;overflow:hidden;box-shadow:0 16px 36px rgba(0,0,0,0.12);border:1px solid #E2E8F0;">
        <img src="{$m['yacht_clubhouse']['url']}" alt="{$m['yacht_clubhouse']['alt']}" style="width:100%;height:420px;object-fit:cover;display:block;" />
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: CÁC DÒNG SẢN PHẨM BIỆT THỰ & PHỐ THƯƠNG MẠI -->
<section id="san-pham" style="padding:70px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 40px;">
      <span style="background:#FFF7ED;color:#EA580C;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Kiệt tác không gian</span>
      <h2 style="color:#0F172A;font-size:32px;font-weight:800;margin:0 0 12px;">BỘ SƯU TẬP 6 DÒNG BIỆT THỰ "NHÀ BIẾT THỞ"</h2>
      <p style="color:#64748B;font-size:15px;margin:0;">Nương theo sườn đồi thoai thoải hướng biển, 100% căn biệt thự đón trọn làn gió đại dương và ánh sáng tự nhiên</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:30px;">
      <div style="background:#fff;border:1px solid #E2E8F0;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="font-size:12px;color:#EA580C;font-weight:700;text-transform:uppercase;letter-spacing:1px;">Dòng 01</div>
        <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:6px 0 10px;">Central Villa</h3>
        <p style="color:#64748B;font-size:13.5px;line-height:1.6;margin:0;">Nằm tại trái tim phân khu, kết nối tức thì tới quảng trường âm nhạc và chuỗi tiện ích trung tâm sôi động.</p>
      </div>
      <div style="background:#fff;border:1px solid #E2E8F0;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="font-size:12px;color:#0284C7;font-weight:700;text-transform:uppercase;letter-spacing:1px;">Dòng 02</div>
        <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:6px 0 10px;">Oceanview Villa</h3>
        <p style="color:#64748B;font-size:13.5px;line-height:1.6;margin:0;">Tầm nhìn trực diện đại dương vô cực, đón bình minh rực rỡ và những cơn gió biển trong lành mỗi sớm mai.</p>
      </div>
      <div style="background:#fff;border:1px solid #E2E8F0;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="font-size:12px;color:#16A34A;font-weight:700;text-transform:uppercase;letter-spacing:1px;">Dòng 03</div>
        <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:6px 0 10px;">Nature & Hidden Villa</h3>
        <p style="color:#64748B;font-size:13.5px;line-height:1.6;margin:0;">Không gian riêng tư tuyệt đối ẩn mình giữa thảm thực vật nhiệt đới xanh mát, chuẩn nghỉ dưỡng chữa lành tâm hồn.</p>
      </div>
      <div style="background:#fff;border:1px solid #E2E8F0;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="font-size:12px;color:#8B5CF6;font-weight:700;text-transform:uppercase;letter-spacing:1px;">Dòng 04</div>
        <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:6px 0 10px;">Villa Dốc Hoa</h3>
        <p style="color:#64748B;font-size:13.5px;line-height:1.6;margin:0;">Địa hình giật cấp độc đáo men theo triền hoa sắc màu, mang lại tầm view tầng bậc ngoạn mục.</p>
      </div>
      <div style="background:#fff;border:1px solid #E2E8F0;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="font-size:12px;color:#D97706;font-weight:700;text-transform:uppercase;letter-spacing:1px;">Dòng 05</div>
        <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:6px 0 10px;">Garden Villa</h3>
        <p style="color:#64748B;font-size:13.5px;line-height:1.6;margin:0;">Khu vườn thượng uyển rộng lớn ôm quanh biệt thự, thích hợp cho các buổi tiệc BBQ sân vườn gia đình ấm cúng.</p>
      </div>
      <div style="background:#fff;border:1px solid #E2E8F0;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="font-size:12px;color:#EC4899;font-weight:700;text-transform:uppercase;letter-spacing:1px;">Dòng 06</div>
        <h3 style="color:#0F172A;font-size:18px;font-weight:700;margin:6px 0 10px;">Boutique House</h3>
        <p style="color:#64748B;font-size:13.5px;line-height:1.6;margin:0;">Nhà phố thương mại kề cận quảng trường và bờ biển, tối ưu công năng vừa ở vừa kinh doanh sinh lời đột phá.</p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 8: KỲ QUAN HOÀNG HÔN & BÌNH MINH BÃI TIÊN -->
<section id="hoang-hon-bai-tien" style="padding:70px 0;background:#0F172A;color:#fff;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:820px;margin:0 auto 40px;">
      <span style="background:rgba(234,88,12,0.25);border:1px solid rgba(234,88,12,0.4);color:#FDBA74;font-size:12px;font-weight:700;padding:5px 16px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;display:inline-block;margin-bottom:8px;">Bức tranh thiên nhiên vô giá</span>
      <h2 style="color:#FFFFFF;font-size:32px;font-weight:800;margin:0 0 12px;">CHIÊM NGƯỠNG HOÀNG HÔN & BÌNH MINH TẠI BÃI TIÊN</h2>
      <p style="color:#CBD5E1;font-size:15px;margin:0;">Nơi hiếm hoi tại vịnh Nha Trang sở hữu tầm nhìn ngắm cả khoảnh khắc mặt trời mọc rạng ngời và hoàng hôn nhuộm đỏ chân mây</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
      <div style="border-radius:12px;overflow:hidden;border:1px solid rgba(255,255,255,0.15);box-shadow:0 8px 20px rgba(0,0,0,0.3);">
        <img src="{$m['hoang_hon_bien']['url']}" alt="{$m['hoang_hon_bien']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:12px;background:rgba(15,23,42,0.85);font-size:13px;font-weight:600;color:#FDBA74;text-align:center;">Hoàng Hôn Tĩnh Lặng Bãi Tiên</div>
      </div>
      <div style="border-radius:12px;overflow:hidden;border:1px solid rgba(255,255,255,0.15);box-shadow:0 8px 20px rgba(0,0,0,0.3);">
        <img src="{$m['chieu_ta_do']['url']}" alt="{$m['chieu_ta_do']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:12px;background:rgba(15,23,42,0.85);font-size:13px;font-weight:600;color:#FDBA74;text-align:center;">Ánh Chiều Tà Nhuộm Đỏ Vịnh Biển</div>
      </div>
      <div style="border-radius:12px;overflow:hidden;border:1px solid rgba(255,255,255,0.15);box-shadow:0 8px 20px rgba(0,0,0,0.3);">
        <img src="{$m['binh_minh']['url']}" alt="{$m['binh_minh']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:12px;background:rgba(15,23,42,0.85);font-size:13px;font-weight:600;color:#38BDF8;text-align:center;">Bình Minh Trên Sóng Nước Bãi Tiên</div>
      </div>
      <div style="border-radius:12px;overflow:hidden;border:1px solid rgba(255,255,255,0.15);box-shadow:0 8px 20px rgba(0,0,0,0.3);">
        <img src="{$m['toan_canh_vinh']['url']}" alt="{$m['toan_canh_vinh']['alt']}" style="width:100%;height:220px;object-fit:cover;display:block;" />
        <div style="padding:12px;background:rgba(15,23,42,0.85);font-size:13px;font-weight:600;color:#38BDF8;text-align:center;">Toàn Cảnh Bờ Cánh Cung Triệu Đô</div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 9: FORM ĐĂNG KÝ NHẬN BẢNG GIÁ & TƯ VẤN TRỰC TIẾP -->
<section id="dang-ky" style="padding:70px 0;background:linear-gradient(135deg,#021526 0%,#0F2942 100%);color:#fff;">
  <div class="kbds-container" style="max-width:960px;">
    <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.12);padding:40px;border-radius:20px;box-shadow:0 20px 40px rgba(0,0,0,0.3);">
      <div style="text-align:center;margin-bottom:30px;">
        <span style="background:rgba(234,88,12,0.2);color:#FDBA74;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:700;text-transform:uppercase;">Cơ hội đầu tư đợt 1</span>
        <h2 style="color:#fff;font-size:30px;font-weight:800;margin:10px 0 8px;">ĐĂNG KÝ NHẬN BẢNG GIÁ GỐC & CHÍNH SÁCH BÁN HÀNG LA TIÊN VILLA</h2>
        <p style="color:#CBD5E1;font-size:14.5px;margin:0;">Liên hệ Phòng Kinh Doanh dự án để nhận trọn bộ tài liệu thiết kế, layout biệt thự và thư mời tham quan Bãi Tiên trực tiếp.</p>
      </div>
      [kbds_lead_form title="" button_text="Đăng Ký Nhận Tư Vấn Suất Đẹp Ngay"]
    </div>
  </div>
</section>
HTML;

// 3. TẠO HOẶC CẬP NHẬT DỰ ÁN LA TIÊN VILLA
$existing_proj = get_posts([
    'post_type' => 'du_an',
    'name' => 'la-tien-villa',
    'posts_per_page' => 1,
    'post_status' => 'any'
]);

$proj_data = [
    'post_title'   => 'Biệt Thự Biển La Tiên Villa Nha Trang (Libera Bãi Tiên)',
    'post_name'    => 'la-tien-villa',
    'post_type'    => 'du_an',
    'post_status'  => 'publish',
    'post_content' => $landing_html,
    'post_excerpt' => 'Biệt thự biển La Tiên Villa thuộc quần thể Libera Nha Trang (KDI Holdings & Masterise Homes) tại Bãi Tiên. Sổ hồng lâu dài, kiến trúc nhà biết thở, bến du thuyền và quản lý bởi The Ascott Limited.'
];

if (!empty($existing_proj)) {
    $project_id = $existing_proj[0]->ID;
    $proj_data['ID'] = $project_id;
    wp_update_post($proj_data);
    echo "✔ Đã cập nhật Dự Án La Tiên Villa (ID: {$project_id})\n";
} else {
    $project_id = wp_insert_post($proj_data);
    echo "+ Đã tạo mới Dự Án La Tiên Villa (ID: {$project_id})\n";
}

// 4. CẬP NHẬT META DỰ ÁN & RANK MATH SEO
$meta_fields = [
    '_kbds_project_code'   => 'LTV-NTR',
    '_kbds_price_from'     => 'Đang cập nhật (Từ 15 - 35 Tỷ/căn)',
    '_kbds_address'        => 'Bãi Tiên, Đại lộ Phạm Văn Đồng, Phường Vĩnh Hòa, TP. Nha Trang, Tỉnh Khánh Hòa',
    '_kbds_total_area'     => '44 ha (Quần thể Libera Nha Trang)',
    '_kbds_scale'          => 'Khoảng 668 căn biệt thự biển giới hạn & Dãy Boutique House',
    '_kbds_legal_status'   => 'Sở hữu lâu dài (Sổ đỏ từng căn) - Quy hoạch 1/500 phê duyệt',
    '_kbds_handover_time'  => 'Dự kiến 2026 - 2027',
    '_kbds_bank_support'   => 'Hỗ trợ vay 70%, ân hạn nợ gốc & 0% lãi suất',
    '_kbds_review_score'   => '9.8',
    '_kbds_developer'      => 'KDI Holdings & Masterise Homes',
    '_kbds_facility_count' => '39+ tiện ích quốc tế & Quảng trường 6.000 khách',
    'rank_math_title'      => 'Biệt Thự La Tiên Villa Nha Trang - Bảng Giá & Ưu Đãi Libera Bãi Tiên',
    'rank_math_description'=> 'Đại lý chính thức phân phối Biệt Thự La Tiên Villa thuộc quần thể Libera Nha Trang (KDI Holdings & Masterise Homes). Vị trí Bãi Tiên, sổ hồng lâu dài, tiện ích bến du thuyền.',
    'rank_math_focus_keyword' => 'La Tiên Villa, biệt thự La Tiên Villa, Libera Nha Trang'
];

foreach ($meta_fields as $k => $v) {
    update_post_meta($project_id, $k, $v);
}

// Gán Featured Image (Yacht Clubhouse - ID 197)
set_post_thumbnail($project_id, $m['yacht_clubhouse']['id']);

// Gán Taxonomies
wp_set_object_terms($project_id, ['khanh-hoa'], 'khu_vuc_bds');
wp_set_object_terms($project_id, ['bds-nghi-duong', 'khu-do-thi-biet-thu'], 'loai_hinh_bds');
wp_set_object_terms($project_id, ['sap-mo-ban'], 'trang_thai_du_an');
wp_set_object_terms($project_id, ['kdi-holdings', 'masterise-homes'], 'chu_dau_tu');

echo "✔ Đã thiết lập Meta, Taxonomies & Ảnh đại diện cho Dự Án La Tiên Villa.\n";

// 5. TẠO 5 BÀI VIẾT VỆ TINH CHUẨN SEO TOPIC CLUSTER
$cat_qh = get_category_by_slug('quy-hoach-ha-tang');
$cat_rv = get_category_by_slug('review-bat-dong-san');
$cat_qh_id = $cat_qh ? $cat_qh->term_id : 1;
$cat_rv_id = $cat_rv ? $cat_rv->term_id : 1;

$articles = [
    // Bài 1: Vị trí
    [
        'title' => 'Vị Trí Dự Án La Tiên Villa: Tọa Độ Kim Cương Bãi Tiên, Tâm Điểm Kết Nối Vịnh Biển Nha Trang',
        'slug'  => 'vi-tri-du-an-la-tien-villa',
        'cat_id'=> $cat_qh_id,
        'thumb' => $m['ban_do_vi_tri']['id'],
        'focus_kw' => 'vị trí dự án la tiên villa, vị trí la tiên villa, bãi tiên nha trang',
        'desc'  => 'Phân tích chi tiết vị trí dự án La Tiên Villa tại Bãi Tiên, Nha Trang. Tọa độ kim cương kết nối sân bay Quốc tế Cam Ranh, Tháp Trầm Hương và hạ tầng cao tốc liên vùng.',
        'content' => <<<HTML
<p><strong>Vị trí dự án La Tiên Villa</strong> tọa lạc tại vịnh Bãi Tiên – một trong những cung đường biển đắt giá và thơ mộng nhất của thành phố biển Nha Trang, tỉnh Khánh Hòa. Là phân khu biệt thự biển cao cấp nằm trọn trong quần thể đô thị nghỉ dưỡng biển quốc tế <strong><a href="https://kenhbatdongsan.vn/du-an/la-tien-villa/">La Tiên Villa Libera Nha Trang</a></strong>, dự án sở hữu tọa độ "tựa sơn hướng hải" đắc địa hiếm có, nơi hội tụ phong thủy thịnh vượng và tiềm năng sinh lời vượt bậc.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['ban_do_vi_tri']['url']}" alt="{$m['ban_do_vi_tri']['alt']}"/><figcaption>{$m['ban_do_vi_tri']['caption']}</figcaption></figure></div>

<h2>1. Tọa Độ Độc Tôn: Tựa Sơn Nghinh Hải Tại Vịnh Bãi Tiên</h2>
<p>Bãi Tiên từ lâu đã được mệnh danh là "nàng thơ" ẩn mình của vịnh Nha Trang bởi làn nước biển xanh trong như ngọc bích, bãi cát thoai thoải và những triền đồi nguyên sơ bao bọc. Tại đây, La Tiên Villa sở hữu đường bờ biển riêng tư kéo dài hơn 2km với 3 bãi tắm tự nhiên tuyệt mỹ.</p>
<p>Thế đất nương theo sườn đồi thoai thoải hướng ra đại dương bao la giúp 100% các căn biệt thự có tầm view panorama khoáng đạt, không bị che chắn, đón trọn ánh bình minh sớm mai và khoảnh khắc hoàng hôn nhuộm đỏ chân mây.</p>

<h2>2. Mạng Lưới Siêu Kết Nối Giao Thông Hiện Đại</h2>
<p>Tọa lạc ngay mặt tiền Đại lộ Phạm Văn Đồng – trục đường ven biển huyết mạch mở rộng về phía Bắc Nha Trang, cư dân và du khách tại La Tiên Villa dễ dàng tiếp cận mọi danh thắng và trung tâm hành chính:</p>
<ul>
  <li><strong>15 phút</strong>: Di chuyển tới Quảng trường 2/4, Tháp Trầm Hương và trung tâm thành phố Nha Trang.</li>
  <li><strong>8 - 10 km</strong>: Tiếp cận Tháp Bà Po Nagar, Chợ Đầm lịch sử, bến tàu du lịch quốc tế.</li>
  <li><strong>12 - 16 km</strong>: Kết nối Nhà thờ Núi, Ga Nha Trang, Viện Hải dương học.</li>
  <li><strong>Kết nối sân bay Cam Ranh qua đường đèo Cù Hin</strong>: Giúp rút ngắn cự ly thêm hơn 10km, di chuyển thuận tiện và ngắm trọn cảnh sắc vịnh biển hùng vĩ.</li>
</ul>

<h2>3. Đòn Bẩy Hạ Tầng Đưa Bãi Tiên Trở Thành Trung Tâm Mới Của Nha Trang</h2>
<p>Nha Trang đang định hướng phát triển mạnh mẽ về phía Bắc với quy hoạch mở rộng không gian đô thị du lịch biển cao cấp. Cùng với việc hoàn thành thông tuyến cao tốc Cam Lâm – Vĩnh Hảo và TP.HCM – Nha Trang (rút ngắn thời gian lái xe chỉ còn 4 tiếng), dự án La Tiên Villa trở thành thỏi nam châm thu hút dòng vốn đầu tư từ giới tinh hoa trong và ngoài nước.</p>
<p>Khám phá trọn vẹn thông tin mặt bằng và bảng giá mới nhất tại <strong><a href="https://kenhbatdongsan.vn/du-an/la-tien-villa/">Dự án La Tiên Villa Nha Trang</a></strong>.</p>
HTML
    ],

    // Bài 2: Tiện ích
    [
        'title' => 'Hệ Thống Tiện Ích Đỉnh Cao Tại Dự Án La Tiên Villa: Quảng Trường Âm Nhạc, Yacht Clubhouse & Trống Đồng Biểu Tượng',
        'slug'  => 'tien-ich-du-an-la-tien-villa',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['quang_truong_am_nhac']['id'],
        'focus_kw' => 'tiện ích dự án la tiên villa, tiện ích la tiên villa, quảng trường âm nhạc la tiên villa',
        'desc'  => 'Khám phá chuỗi tiện ích thượng lưu tại La Tiên Villa Libera Nha Trang: Quảng trường 10 cây bao báp, công trình Trống Đồng biểu tượng, Yacht Clubhouse bến du thuyền 5 sao.',
        'content' => <<<HTML
<p>Không chỉ sở hữu địa thế thiên nhiên kỳ vĩ, <strong>hệ thống tiện ích dự án La Tiên Villa</strong> được định vị theo chuẩn mực nghỉ dưỡng thượng lưu quốc tế, kiến tạo một quần thể "All-in-one" sôi động suốt 365 ngày đêm tại vùng đất Libera Nha Trang.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['quang_truong_am_nhac']['url']}" alt="{$m['quang_truong_am_nhac']['alt']}"/><figcaption>{$m['quang_truong_am_nhac']['caption']}</figcaption></figure></div>

<h2>1. Quảng Trường Âm Nhạc 10 Cây Bao Báp Khổng Lồ</h2>
<p>Điểm nhấn độc nhất vô nhị của dự án là <strong>Quảng trường Âm nhạc</strong> rộng lớn được bao bọc bởi 10 cây bao báp vĩ đại. Đây là không gian giao lưu cộng đồng và tổ chức các đại nhạc hội quốc tế với quy mô sức chứa lên tới <strong>6.000 khách cùng lúc</strong>.</p>
<p>Cùng với các tác phẩm Artwork tôn vinh âm nhạc dân tộc Việt Nam, quảng trường mang đến những trải nghiệm văn hóa nghệ thuật sống động và đẳng cấp chưa từng có.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['trong_dong']['url']}" alt="{$m['trong_dong']['alt']}"/><figcaption>{$m['trong_dong']['caption']}</figcaption></figure></div>

<h2>2. Công Trình Biểu Tượng Trống Đồng Việt Nam & Vega Theatre</h2>
<p>Nằm sừng sững tại trung tâm quần thể là <strong>Công trình biểu tượng Trống Đồng Việt Nam</strong> được chế tác bằng kính cường lực phát sáng kết hợp màn trình diễn nhạc nước nghệ thuật công nghệ cao. Kế cận là Nhà hát đương đại Vega Theatre – nơi trình diễn các show nghệ thuật bản địa đỉnh cao thu hút đông đảo du khách toàn cầu.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['yacht_clubhouse']['url']}" alt="{$m['yacht_clubhouse']['alt']}"/><figcaption>{$m['yacht_clubhouse']['caption']}</figcaption></figure></div>

<h2>3. Yacht Clubhouse & Bến Du Thuyền Thượng Lưu</h2>
<p>Được thiết kế nương theo cảm hứng từ vẻ đẹp của cát biển và san hô đỏ "signature" Bãi Tiên, <strong>Yacht Clubhouse</strong> là cánh cổng đón chào những hải trình xa hoa. Nơi đây quy tụ bến đỗ du thuyền riêng tư, bể bơi vô cực view biển chân mây và câu lạc bộ Cigar Lounge dành riêng cho giới tinh hoa.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['ho_vay']['url']}" alt="{$m['ho_vay']['alt']}"/><figcaption>{$m['ho_vay']['caption']}</figcaption></figure></div>

<h2>4. Chuỗi Tiện Ích Sinh Thái Dành Riêng Cho Gia Đình & Trẻ Nhỏ</h2>
<p>Chủ đầu tư KDI Holdings và Masterise Homes đặc biệt chú trọng kiến tạo không gian nuôi dưỡng thế hệ tương lai:</p>
<ul>
  <li><strong>Hồ vầy nội khu an toàn cho bé</strong>: Mực nước cạn an toàn, bờ cát nhân tạo thoai thoải như bãi biển thu nhỏ giữa lòng ốc đảo cây xanh.</li>
  <li><strong>Sân chơi trẻ em Eco-Friendly</strong>: Không gian vận động ngoài trời với linh vật Voọc chà vá chân nâu nghệ thuật, khuyến khích trẻ khám phá thiên nhiên.</li>
</ul>
<p>Xem toàn cảnh dự án tại <strong><a href="https://kenhbatdongsan.vn/du-an/la-tien-villa/">Hồ sơ chi tiết La Tiên Villa Nha Trang</a></strong>.</p>
HTML
    ],

    // Bài 3: Mặt bằng
    [
        'title' => 'Mặt Bằng & Quy Hoạch Tổng Thể Phân Khu Biệt Thự La Tiên Villa Libera Nha Trang',
        'slug'  => 'mat-bang-du-an-la-tien-villa',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['toan_canh_vinh']['id'],
        'focus_kw' => 'mặt bằng dự án la tiên villa, mặt bằng la tiên villa, quy hoạch la tiên villa',
        'desc'  => 'Phân tích chi tiết quy hoạch mặt bằng tổng thể 44ha phân khu biệt thự La Tiên Villa Libera Bãi Tiên Nha Trang: Phân bổ 668 căn biệt thự biển và dãy phố thương mại.',
        'content' => <<<HTML
<p><strong>Mặt bằng dự án La Tiên Villa</strong> được quy hoạch bài bản trên quỹ đất vàng rộng 44 ha thuộc siêu quần thể đô thị biển Libera Nha Trang. Dự án giới hạn chỉ khoảng 668 căn biệt thự đơn lập, song lập và dãy phố thương mại Boutique House, được các kiến trúc sư quốc tế thiết kế khéo léo nương theo địa hình sườn núi thoai thoải hướng thẳng ra biển Bãi Tiên.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['toan_canh_vinh']['url']}" alt="{$m['toan_canh_vinh']['alt']}"/><figcaption>{$m['toan_canh_vinh']['caption']}</figcaption></figure></div>

<h2>1. Quy Hoạch Giật Cấp – Tầm Nhìn Biển Không Giới Hạn</h2>
<p>Khác biệt hoàn toàn với các khu đô thị biển bằng phẳng truyền thống, La Tiên Villa tận dụng hoàn hảo độ dốc tự nhiên của núi non Bãi Tiên. Các dãy biệt thự được xếp lớp giật cấp thông minh từ cao xuống thấp, đảm bảo mỗi căn nhà đều sở hữu góc nhìn bao quát vịnh biển mà không bị che khuất bởi căn phía trước.</p>

<h2>2. Bố Cục 6 Dòng Sản Phẩm Biệt Thự Chuyên Biệt</h2>
<p>Dự án mang đến sự lựa chọn phong phú cho từng gu thẩm mỹ và phong cách sống của chủ nhân thượng lưu:</p>
<ul>
  <li><strong>Central Villa</strong>: Tọa lạc tại khu vực trung tâm kết nối, tiếp cận nhanh chóng các tiện ích cao cấp nhất của dự án.</li>
  <li><strong>Oceanview Villa</strong>: Trực diện biển Bãi Tiên, mở cửa ra là thấy sóng vỗ rì rào và đại dương mênh mông.</li>
  <li><strong>Nature & Hidden Villa</strong>: Nằm ẩn mình giữa những vạt rừng nhiệt đới, tối đa hóa tính riêng tư và tĩnh lặng.</li>
  <li><strong>Villa Dốc Hoa</strong>: Men theo những triền dốc ngập tràn sắc hoa rực rỡ, kiến tạo nên khung cảnh lãng mạn như miền nam nước Pháp.</li>
  <li><strong>Garden Villa</strong>: Dành cho những chủ nhân yêu thiên nhiên với sân vườn rộng bao quanh khuôn viên.</li>
  <li><strong>Boutique House</strong>: Nằm dọc các trục đường chính và kề cận quảng trường âm nhạc, đón đầu lưu lượng khách mua sắm sầm uất.</li>
</ul>

<h2>3. Mật Độ Xây Dựng Thấp, Ưu Tiên Mảng Xanh & Cảnh Quan</h2>
<p>Hơn 70% diện tích dự án được dành trọn cho thảm thực vật cây xanh, công viên chủ đề, mặt nước và các công trình văn hóa biểu tượng. Điều này không chỉ đem lại vi khí hậu mát mẻ quanh năm mà còn đảm bảo chất lượng sống sinh thái đẳng cấp bậc nhất tại thành phố Nha Trang.</p>
<p>Chi tiết bảng giá và chính sách từng phân khu tại <strong><a href="https://kenhbatdongsan.vn/du-an/la-tien-villa/">Dự Án La Tiên Villa</a></strong>.</p>
HTML
    ],

    // Bài 4: Thiết kế biệt thự
    [
        'title' => 'Thiết Kế Biệt Thự La Tiên Villa: Triết Lý "Nhà Biết Thở", Đỉnh Cao Home Living 5 Sao',
        'slug'  => 'thiet-ke-biet-thu-la-tien-villa',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['yacht_clubhouse']['id'],
        'focus_kw' => 'thiết kế biệt thự la tiên villa, thiết kế la tiên villa, nhà biết thở la tiên villa',
        'desc'  => 'Bóc tách ngôn ngữ kiến trúc độc bản "nhà biết thở" tại Biệt thự La Tiên Villa Nha Trang. Tiêu chuẩn bàn giao hoàn thiện full nội thất 5 sao vận hành bởi The Ascott Limited.',
        'content' => <<<HTML
<p>Lấy cảm hứng từ vẻ đẹp nguyên sơ của biển Bãi Tiên và triết lý kiến trúc đương đại bền vững, <strong>thiết kế biệt thự La Tiên Villa</strong> tiên phong ứng dụng ngôn ngữ <em>"Nhà biết thở" (Breathable Architecture)</em> – nơi không gian sống hòa làm một với nhịp điệu của biển trời và núi rừng Nha Trang.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['yacht_clubhouse']['url']}" alt="{$m['yacht_clubhouse']['alt']}"/><figcaption>{$m['yacht_clubhouse']['caption']}</figcaption></figure></div>

<h2>1. Triết Lý Kiến Trúc "Nhà Biết Thở" Độc Bản</h2>
<p>Mỗi căn biệt thự tại La Tiên Villa được tính toán tỉ mỉ theo hướng gió tự nhiên thổi từ đại dương và luồng không khí mát lành từ rặng núi phía sau. Hệ thống vách kính Low-E tràn viền kịch trần kết hợp lam chắn nắng thông minh giúp không gian luôn thông thoáng, mát mẻ tự nhiên mà không cần phụ thuộc quá nhiều vào điều hòa cơ học.</p>
<p>Cửa kính lớn mở rộng tối đa tầm mắt, xóa nhòa ranh giới giữa phòng khách sang trọng và thiên nhiên đại dương bao la ngoài ban công.</p>

<h2>2. Bàn Giao Full Nội Thất Chuẩn Vận Hành Khách Sạn 5 Sao Quốc Tế</h2>
<p>Được đồng hành quản lý và vận hành bởi <strong>The Ascott Limited</strong> – tập đoàn quản lý lưu trú hàng đầu thế giới đến từ Singapore, các căn biệt thự La Tiên Villa được bàn giao hoàn thiện đầy đủ nội thất cao cấp:</p>
<ul>
  <li>Vật liệu thân thiện môi trường, đá tự nhiên và gỗ cao cấp mang tone màu ấm cúng, sang trọng.</li>
  <li>Trang thiết bị vệ sinh nhập khẩu Châu Âu từ các thương hiệu danh tiếng hàng đầu thế giới.</li>
  <li>Hệ thống Smart Home điều khiển thông minh qua ứng dụng di động.</li>
  <li>Hồ bơi riêng biệt và sân vườn cảnh quan được trau chuốt tỉ mỉ từng chi tiết.</li>
</ul>

<h2>3. Chuẩn Sống "Home Living" – Vừa Ở Vừa Khai Thác Cho Thuê Hiệu Quả</h2>
<p>Khác biệt với các dòng sản phẩm nghỉ dưỡng thông thường chỉ có thời hạn 50 năm, La Tiên Villa sở hữu pháp lý <strong>lâu dài (sổ đỏ vĩnh viễn)</strong>. Chủ nhân vừa có thể sử dụng làm ngôi nhà thứ hai (Second Home) đẳng cấp để an cư, vừa có thể ủy thác cho The Ascott Limited vận hành cho thuê với dòng tiền ngoại tệ bền vững hàng năm.</p>
<p>Xem thêm phân tích chi tiết tại trang chủ <strong><a href="https://kenhbatdongsan.vn/du-an/la-tien-villa/">Dự Án Biệt Thự La Tiên Villa Nha Trang</a></strong>.</p>
HTML
    ],

    // Bài 5: Boutique House
    [
        'title' => 'Boutique House & Phố Thương Mại La Tiên Villa: Tâm Điểm Giao Thương, Tiềm Năng Khai Thác Đột Phá',
        'slug'  => 'boutique-house-la-tien-villa',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['boutique_house']['id'],
        'focus_kw' => 'boutique house la tiên villa, shophouse la tiên villa, phố thương mại la tiên villa',
        'desc'  => 'Đánh giá tiềm năng kinh doanh và đầu tư dãy nhà phố thương mại Boutique House La Tiên Villa Libera Nha Trang. Đón trọn dòng khách 6.000 người từ quảng trường âm nhạc.',
        'content' => <<<HTML
<p>Nằm dọc theo tuyến đường dạo bộ ven biển và kề cận quảng trường sự kiện 6.000 người, dòng sản phẩm <strong>Boutique House La Tiên Villa</strong> nổi lên như một điểm sáng đầu tư sinh lời vượt trội tại trung tâm đô thị biển Libera Nha Trang.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['boutique_house']['url']}" alt="{$m['boutique_house']['alt']}"/><figcaption>{$m['boutique_house']['caption']}</figcaption></figure></div>

<h2>1. Kiến Trúc Uốn Lượn Giao Thoa Biển Cả & Núi Non</h2>
<p>Dãy phố thương mại Boutique House sở hữu ngôn ngữ kiến trúc uốn lượn mềm mại như những con sóng đại dương. Mặt tiền rộng mở với hệ cửa kính lớn trong suốt, ban công ngập tràn giàn hoa rực rỡ tạo nên một tuyến phố mua sắm sầm uất mang đậm hơi thở nghỉ dưỡng Địa Trung Hải.</p>

<h2>2. Đón Dòng Khách Du Lịch Khổng Lồ Suốt 24/7</h2>
<p>Tiềm năng thương mại của Boutique House La Tiên Villa được bảo chứng nhờ các đòn bẩy lưu lượng khách ấn tượng:</p>
<ul>
  <li><strong>Hơn 6.000 khách</strong> tham dự các sự kiện âm nhạc, đại nhạc hội quốc tế tại Quảng trường Âm nhạc mỗi đêm.</li>
  <li>Hàng nghìn du khách quốc tế đổ về thưởng thức show diễn tại Nhà hát đương đại Vega Theatre.</li>
  <li>Cộng đồng cư dân thượng lưu sinh sống tại 668 căn biệt thự biển và chuỗi khách sạn 5 sao cao tầng kề cận.</li>
  <li>Khách du thuyền cập bến tại Yacht Clubhouse sang trọng ngay lối vào.</li>
</ul>

<h2>3. Đa Dạng Loại Hình Kinh Doanh Sinh Lời Cao</h2>
<p>Với kết cấu thông minh đa tầng, chủ nhân Boutique House có thể linh hoạt khai thác nhiều mô hình dịch vụ cao cấp:</p>
<ul>
  <li>Nhà hàng hải sản fine dining, quán cà phê lounge ngắm hoàng hôn Bãi Tiên.</li>
  <li>Cửa hàng thời trang resort wear, showroom lưu niệm văn hóa bản địa.</li>
  <li>Spa, clinic chăm sóc sức khỏe sắc đẹp phục vụ du khách nghỉ dưỡng.</li>
  <li>Mini hotel, homestay boutique tầng trên mang lại nguồn thu ổn định quanh năm.</li>
</ul>
<p>Nhận trọn bộ phân tích dòng tiền và chính sách ưu đãi tại <strong><a href="https://kenhbatdongsan.vn/du-an/la-tien-villa/">Dự Án La Tiên Villa Nha Trang</a></strong>.</p>
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

    // Gán Featured Image & Meta liên kết
    if (!empty($art['thumb'])) {
        set_post_thumbnail($art_id, $art['thumb']);
    }
    wp_set_post_categories($art_id, [$art['cat_id']], false);

    // Meta Rank Math SEO & Project Ref
    update_post_meta($art_id, 'rank_math_title', $art['title'] . ' | Kênh Bất Động Sản');
    update_post_meta($art_id, 'rank_math_description', $art['desc']);
    update_post_meta($art_id, 'rank_math_focus_keyword', $art['focus_kw']);
    update_post_meta($art_id, '_kbds_project_ref', $project_id);
    update_post_meta($art_id, '_kbds_project_slug', 'la-tien-villa');
}

echo "==============================================================\n";
echo "🎉 HOÀN THÀNH XÂY DỰNG TRỌN GÓI DỰ ÁN LA TIÊN VILLA TRÊN LOCALHOST!\n";
echo "==============================================================\n";
