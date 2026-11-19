<?php
/**
 * Tạo trọn gói Trang Dự Án Ansana by Kita (Võ Văn Kiệt - Bình Tân - TP.HCM) + 4 Bài viết vệ tinh chuẩn SEO Topic Cluster
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU XÂY DỰNG TRANG DỰ ÁN ANSANA BY KITA (VÕ VĂN KIỆT - TP.HCM)\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/ansana-by-kita-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/ansana-by-kita-media-map.json. Hãy chạy tools/import-ansana-by-kita.php trước!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// 1. Tạo Term Chủ đầu tư & Khu vực nếu chưa có
if (!term_exists('KITA Group', 'chu_dau_tu')) {
    wp_insert_term('KITA Group', 'chu_dau_tu', [
        'slug' => 'kita-group',
        'description' => 'Tập đoàn KITA (KITA Group / Kita Homes) - Nhà phát triển bất động sản uy tín với chuỗi dự án đô thị và căn hộ cao cấp hàng đầu Việt Nam'
    ]);
    echo " + Đã tạo term Chủ đầu tư: KITA Group\n";
}
if (!term_exists('TP. Hồ Chí Minh', 'khu_vuc_bds')) {
    wp_insert_term('TP. Hồ Chí Minh', 'khu_vuc_bds', [
        'slug' => 'tp-ho-chi-minh',
        'description' => 'Thị trường Bất Động Sản TP. Hồ Chí Minh'
    ]);
    echo " + Đã tạo term Khu vực: TP. Hồ Chí Minh\n";
}
if (!term_exists('Bình Tân', 'khu_vuc_bds')) {
    $parent_hcm = term_exists('TP. Hồ Chí Minh', 'khu_vuc_bds');
    $parent_id = is_array($parent_hcm) ? $parent_hcm['term_id'] : 0;
    wp_insert_term('Bình Tân', 'khu_vuc_bds', [
        'slug' => 'binh-tan',
        'parent' => $parent_id,
        'description' => 'Quận Bình Tân, TP. Hồ Chí Minh - Cửa ngõ kết nối giao thương phía Tây sầm uất'
    ]);
    echo " + Đã tạo term Khu vực: Bình Tân\n";
}

// 2. SOẠN THẢO NỘI DUNG LANDING PAGE 10 SECTION CHUẨN UX CHO ANSANA BY KITA
// Lưu ý: subnav viết gọn không line break bên trong để wpautop không thêm <p> hoặc <br>
$subnav_html = '<div class="kbds-project-subnav"><div class="kbds-container kbds-subnav-container"><div class="kbds-subnav-brand"><span class="kbds-subnav-dot"></span>ANSANA BY KITA</div><a href="#dang-ky" class="kbds-subnav-cta">Nhận Báo Giá Gốc</a><nav class="kbds-subnav-links"><a href="#tong-quan" class="kbds-subnav-link">Tổng Quan</a><a href="#vi-tri" class="kbds-subnav-link">Vị Trí</a><a href="#tien-ich" class="kbds-subnav-link">Tiện Ích Wellness</a><a href="#mat-bang" class="kbds-subnav-link">Mặt Bằng Masterplan</a><a href="#can-ho" class="kbds-subnav-link">Căn Hộ</a><a href="#bang-gia" class="kbds-subnav-link">Bảng Giá</a><a href="#phap-ly" class="kbds-subnav-link">Pháp Lý & CĐT</a><a href="#tin-tuc-du-an" class="kbds-subnav-link">Tin Tức</a></nav></div></div>';

$landing_html = <<<HTML
{$subnav_html}

<!-- SECTION 1: HERO BANNER -->
<section style="position:relative;background:linear-gradient(135deg,#0a192f 0%,#1e3a5f 50%,#B45309 100%);color:#fff;padding:80px 0 100px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.22;background:radial-gradient(circle at 75% 25%,#F59E0B 0%,transparent 65%);pointer-events:none;"></div>
  <div class="kbds-container" style="position:relative;z-index:2;display:grid;grid-template-columns:1.15fr 0.85fr;gap:40px;align-items:center;">
    <div>
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(245,158,11,0.2);border:1px solid rgba(245,158,11,0.5);color:#FDE68A;padding:6px 18px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;">
        💎 KITA GROUP • BIỂU TƯỢNG SỐNG WELLNESS LUXURY KHU TÂY
      </div>
      <h1 style="color:#FFFFFF;font-size:42px;font-weight:900;line-height:1.2;margin:0 0 18px;">
        ANSANA BY KITA
        <span style="display:block;font-size:22px;font-weight:600;color:#F59E0B;margin-top:6px;">Căn Hộ Hạng Sang Mặt Tiền Đại Lộ Võ Văn Kiệt, TP. Hồ Chí Minh</span>
      </h1>
      <p style="color:#E2E8F0;font-size:16px;line-height:1.7;margin:0 0 28px;max-width:620px;">
        Tọa lạc kiêu hãnh tại số <strong>69 – 79 – 89 Đại lộ Võ Văn Kiệt</strong>, phường An Lạc, quận Bình Tân, TP.HCM. <strong>Ansana by Kita</strong> (tiền thân là Stella En Tropic) là quần thể căn hộ cao cấp quy mô <strong>2,43 ha</strong> do <strong>Tập đoàn KITA Group</strong> phát triển cùng tổng thầu <strong>Newtecons</strong>. Kiến tạo không gian sống chuẩn <strong>Wellness Luxury</strong> kết hợp mô hình <strong>Green – Smart Tower</strong> với hồ bơi resort nhiệt đới và chuỗi tiện ích chăm sóc sức khỏe toàn diện.
      </p>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:30px;">
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 12px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#FDE68A;">2,43 ha</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Quy mô đại dự án</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 12px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#38BDF8;">24 Tầng</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Tháp căn hộ hiện đại</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 12px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#4ADE80;">15 Phút</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Về thẳng Quận 1</div>
        </div>
        <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);padding:14px 12px;border-radius:10px;text-align:center;">
          <div style="font-size:18px;font-weight:800;color:#F472B6;">Sổ Hồng</div>
          <div style="font-size:12px;color:#CBD5E1;margin-top:4px;">Sở hữu lâu dài</div>
        </div>
      </div>
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:#D97706;color:#fff;font-weight:700;padding:14px 28px;border-radius:8px;text-decoration:none;box-shadow:0 6px 20px rgba(217,119,6,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Nhận Bảng Giá Đợt 1 & Chính Sách Gốc CĐT</span> →
        </a>
        <a href="#mat-bang" style="background:transparent;color:#fff;font-weight:600;padding:14px 24px;border-radius:8px;text-decoration:none;border:1px solid rgba(255,255,255,0.35);">
          Xem Mặt Bằng Masterplan
        </a>
      </div>
    </div>
    <div>
      <div style="position:relative;border-radius:16px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.5);border:2px solid rgba(245,158,11,0.35);">
        <img src="{$m['phoi_canh_dem_tong_the']['url']}" alt="{$m['phoi_canh_dem_tong_the']['alt']}" style="width:100%;height:auto;display:block;"/>
        <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(0,0,0,0.85),transparent);padding:20px;text-align:center;color:#FDE68A;font-weight:600;font-size:14px;">
          Ansana by Kita – Quần Thể Căn Hộ Biểu Tượng Mặt Tiền Đại Lộ Võ Văn Kiệt
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
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">TỔNG QUAN DỰ ÁN ANSANA BY KITA</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Tổ hợp căn hộ cao cấp 24 tầng tọa lạc tại tâm điểm giao thương mặt tiền Võ Văn Kiệt, mang lại giá trị an cư thượng lưu và tiềm năng gia tăng giá trị bền vững.
      </p>
    </div>

    <div style="background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.06);overflow:hidden;border:1px solid #E2E8F0;">
      <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;text-align:left;font-size:15px;">
          <tbody>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;width:28%;background:#F8FAFC;">Tên thương mại</td>
              <td style="padding:16px 24px;font-weight:700;color:#B45309;">ANSANA BY KITA</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Tên trước đây / Pháp lý</td>
              <td style="padding:16px 24px;color:#334155;">Stella En Tropic (Khu căn hộ Stella Võ Văn Kiệt)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Chủ đầu tư</td>
              <td style="padding:16px 24px;color:#334155;"><strong>Tập đoàn KITA Group (Kita Homes)</strong> – Đơn vị phát triển BĐS uy tín hàng đầu</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Tổng thầu thi công</td>
              <td style="padding:16px 24px;color:#334155;"><strong>Newtecons</strong> – Tổng thầu xây dựng chất lượng số 1 Việt Nam</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Vị trí dự án</td>
              <td style="padding:16px 24px;color:#334155;">Số 69 – 79 – 89 Đại lộ Võ Văn Kiệt, P. An Lạc, Q. Bình Tân, TP. Hồ Chí Minh (ngay nút giao An Dương Vương – Hồ Học Lãm)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Quy mô khu đất</td>
              <td style="padding:16px 24px;color:#334155;"><strong>2,43 ha (hơn 30.000 m²)</strong></td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Mật độ xây dựng</td>
              <td style="padding:16px 24px;color:#334155;">Khoảng <strong>34%</strong> (66% dành cho công viên sinh thái, hồ bơi resort, cây xanh mặt nước và tiện ích nội khu)</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Quy mô công trình</td>
              <td style="padding:16px 24px;color:#334155;">Các khối tháp căn hộ cao <strong>24 tầng nổi + 2 tầng hầm</strong> để xe rộng rãi</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Số lượng sản phẩm</td>
              <td style="padding:16px 24px;color:#334155;">Khoảng <strong>hơn 1.500 căn hộ cao cấp</strong>, shophouse và penthouse</td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Cơ cấu diện tích</td>
              <td style="padding:16px 24px;color:#334155;">
                • <strong>Căn hộ 1PN+1:</strong> 51 m² – 57 m²<br/>
                • <strong>Căn hộ 2PN - 2WC:</strong> 67 m² – 88 m²<br/>
                • <strong>Căn hộ 3PN - 2WC:</strong> 97 m² – 115 m²<br/>
                • <strong>Penthouse thượng lưu:</strong> 149 m² – 301 m²
              </td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Định vị & Tiêu chuẩn sống</td>
              <td style="padding:16px 24px;color:#334155;">Căn hộ chuẩn <strong>Wellness Luxury</strong> kết hợp mô hình <strong>Green – Smart Tower</strong></td>
            </tr>
            <tr style="border-bottom:1px solid #E2E8F0;">
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Hình thức sở hữu</td>
              <td style="padding:16px 24px;color:#334155;"><strong>Sổ hồng sở hữu lâu dài</strong> (người Việt Nam); 50 năm (người nước ngoài theo luật định)</td>
            </tr>
            <tr>
              <td style="padding:16px 24px;font-weight:700;color:#0F172A;background:#F8FAFC;">Thời gian bàn giao dự kiến</td>
              <td style="padding:16px 24px;color:#334155;">Dự kiến Quý IV/2026 – Quý II/2027 (Bàn giao hoàn thiện cao cấp)</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: VỊ TRÍ ĐẮC ĐỊA MẶT TIỀN VÕ VĂN KIỆT -->
<section id="vi-tri" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;">
      <div>
        <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">TÂM ĐIỂM GIAO THƯƠNG CỬA NGÕ PHÍA TÂY</span>
        <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 20px;">VỊ TRÍ KIM CƯƠNG MẶT TIỀN ĐẠI LỘ ĐÔNG TÂY</h2>
        <p style="color:#475569;font-size:16px;line-height:1.7;margin-bottom:20px;">
          <strong>Ansana by Kita</strong> tọa lạc ngay mặt tiền tuyến đường đẹp và thông thoáng nhất TP.HCM – <strong>Đại lộ Võ Văn Kiệt</strong> (số 69 – 79 – 89 Võ Văn Kiệt), thuộc phường An Lạc, quận Bình Tân. Tuyến đại lộ có lộ giới lên đến 60 mét, với 10 làn xe chạy thông suốt không có đèn đỏ giao cắt, không lo kẹt xe hay ngập nước.
        </p>
        <div style="background:#F8FAFC;border-left:4px solid #D97706;padding:16px 20px;border-radius:0 8px 8px 0;margin-bottom:24px;">
          <h4 style="margin:0 0 8px;color:#0F172A;font-size:16px;">Mạng Lưới Siêu Kết Nối Trực Tiếp Trong Bán Kính 2 – 5km:</h4>
          <ul style="margin:0;padding-left:18px;color:#475569;font-size:14px;line-height:1.8;">
            <li><strong>Chỉ 5 – 7 phút:</strong> Đến Bến xe Miền Tây, Bệnh viện Triều An, Bệnh viện Quốc tế City (CIH), Siêu thị Mega Market Bình Phú.</li>
            <li><strong>Chỉ 8 – 10 phút:</strong> Đến TTTM Aeon Mall Bình Tân, Công viên Phú Lâm, trung tâm Quận 6 (Chợ Lớn), Quận 5.</li>
            <li><strong>Chỉ 15 – 20 phút:</strong> Chạy thẳng trục Võ Văn Kiệt đến trung tâm Quận 1 (Chợ Bến Thành, Bitexco), Quận 4 và qua Hầm Thủ Thiêm sang KĐT mới Thủ Thiêm (TP. Thủ Đức).</li>
            <li><strong>Chỉ 15 phút:</strong> Kết nối qua trục Nguyễn Văn Linh sang Khu dân cư Trung Sơn, ĐH RMIT và Khu đô thị Phú Mỹ Hưng (Quận 7).</li>
            <li><strong>Dễ dàng kết nối liên tỉnh:</strong> Tiếp cận nhanh chóng Quốc lộ 1A và Cao tốc TP.HCM – Trung Lương để đi về các tỉnh miền Tây Nam Bộ.</li>
          </ul>
        </div>
        <p style="color:#475569;font-size:15px;line-height:1.7;">
          Sở hữu vị trí mặt tiền đại lộ huyết mạch liên kết các quận trung tâm cùng hạ tầng giao thông ngày càng đồng bộ, Ansana by Kita không chỉ mang lại cuộc sống thuận tiện mỗi ngày mà còn là bảo chứng vững chắc cho tiềm năng tăng giá trị bất động sản theo thời gian.
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

<!-- SECTION 4: HỆ TIỆN ÍCH WELLNESS LUXURY & HỒ BƠI RESORT -->
<section id="tien-ich" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 50px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">CHUẨN SỐNG TÁI TẠO NĂNG LƯỢNG MỖI NGÀY</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">HỆ TIỆN ÍCH WELLNESS LUXURY ĐẲNG CẤP</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Tại Ansana by Kita, mỗi ngày trở về nhà là một kỳ nghỉ dưỡng đích thực với tổ hợp tiện ích All-in-one được may đo riêng cho sức khỏe thể chất và tinh thần của cư dân.
      </p>
    </div>

    <!-- HÌNH HỒ BƠI RESORT LỚN -->
    <div style="margin-bottom:40px;border-radius:16px;overflow:hidden;box-shadow:0 15px 35px rgba(0,0,0,0.1);border:1px solid #E2E8F0;">
      <img src="{$m['ho_boi_resort']['url']}" alt="{$m['ho_boi_resort']['alt']}" style="width:100%;height:auto;display:block;"/>
      <div style="padding:16px 24px;background:#fff;text-align:center;font-size:14px;color:#334155;font-weight:600;">
        {$m['ho_boi_resort']['caption']}
      </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">
      <div style="background:#fff;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="font-size:28px;margin-bottom:12px;">🏊</div>
        <h4 style="font-size:17px;font-weight:700;color:#0F172A;margin:0 0 8px;">Hồ Bơi Resort Nhiệt Đới</h4>
        <p style="color:#64748B;font-size:13px;line-height:1.6;margin:0;">
          Hồ bơi tràn bờ uốn lượn tại khối đế tiện ích với làn nước trong xanh, ốc đảo cọ nhiệt đới, quầy pool bar và sàn tắm nắng thư thái.
        </p>
      </div>

      <div style="background:#fff;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="font-size:28px;margin-bottom:12px;">🌿</div>
        <h4 style="font-size:17px;font-weight:700;color:#0F172A;margin:0 0 8px;">Công Viên Xanh Sinh Thái</h4>
        <p style="color:#64748B;font-size:13px;line-height:1.6;margin:0;">
          Không gian cảnh quan xanh mát bao bọc các khối tháp với vườn thiền, đồi cỏ dạo bộ và vườn nướng BBQ gia đình ngoài trời.
        </p>
      </div>

      <div style="background:#fff;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="font-size:28px;margin-bottom:12px;">🧘</div>
        <h4 style="font-size:17px;font-weight:700;color:#0F172A;margin:0 0 8px;">Gym, Yoga & Spa VIP</h4>
        <p style="color:#64748B;font-size:13px;line-height:1.6;margin:0;">
          Phòng tập thể hình trang bị máy tập Technogym hiện đại, phòng tập Yoga kính tràn ngắm cảnh quan và khu xông hơi thư giãn.
        </p>
      </div>

      <div style="background:#fff;padding:24px;border-radius:12px;border:1px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,0.03);">
        <div style="font-size:28px;margin-bottom:12px;">🛍️</div>
        <h4 style="font-size:17px;font-weight:700;color:#0F172A;margin:0 0 8px;">Shophouse Thương Mại</h4>
        <p style="color:#64748B;font-size:13px;line-height:1.6;margin:0;">
          Tuyến phố mua sắm sầm uất ngay dưới khối đế quy tụ chuỗi siêu thị, nhà hàng, cafe thương hiệu và dịch vụ tiện ích 24/7.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: MẶT BẰNG MASTERPLAN TỔNG THỂ -->
<section id="mat-bang" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 40px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">QUY HOẠCH ĐỒNG BỘ 2,43 HECTA</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">MẶT BẰNG MASTERPLAN ANSANA BY KITA</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Các tòa tháp được bố trí so le thông minh nhằm mở rộng tối đa tầm nhìn, đón trọn luồng gió mát lành từ kênh rạch tự nhiên và đại lộ Võ Văn Kiệt.
      </p>
    </div>

    <!-- HÌNH ẢNH MASTERPLAN -->
    <div style="border-radius:16px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.1);border:1px solid #E2E8F0;margin-bottom:30px;">
      <img src="{$m['masterplan_tong_the']['url']}" alt="{$m['masterplan_tong_the']['alt']}" style="width:100%;height:auto;display:block;"/>
    </div>
    <div style="text-align:center;font-size:14px;color:#64748B;font-style:italic;">
      {$m['masterplan_tong_the']['caption']}
    </div>
  </div>
</section>

<!-- SECTION 6: CƠ CẤU CĂN HỘ CHUẨN XANH -->
<section id="can-ho" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 50px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">THIẾT KẾ THÔNG MINH – TỐI ƯU CÔNG NĂNG</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">CƠ CẤU CĂN HỘ ANSANA BY KITA</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Tất cả các căn hộ đều được thiết kế ban công rộng mở, logia phơi đồ riêng biệt và cửa sổ lớn chạm sàn, đón trọn ánh sáng tự nhiên và luồng sinh khí thịnh vượng.
      </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:40px;">
      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#D97706;text-transform:uppercase;margin-bottom:8px;">Căn Hộ 1PN + 1</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Đa Năng Tinh Tế</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">51 – 57 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Thêm không gian làm việc hoặc giường phụ cho bé, phù hợp chuyên gia trẻ</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#D97706;text-transform:uppercase;margin-bottom:8px;">Căn Hộ 2PN - 2WC</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Dòng Căn Hộ Chủ Lực</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">67 – 88 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">2 phòng ngủ rộng rãi, view hồ bơi resort hoặc đại lộ, tối ưu cho gia đình hiện đại</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#D97706;text-transform:uppercase;margin-bottom:8px;">Căn Hộ 3PN - 2WC</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Không Gian Đa Thế Hệ</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">97 – 115 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Vị trí căn góc 2 mặt thoáng, phòng khách nối liền ban công Panorama tráng lệ</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:24px;border:1px solid #E2E8F0;box-shadow:0 4px 14px rgba(0,0,0,0.04);text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#D97706;text-transform:uppercase;margin-bottom:8px;">Penthouse / Sky Villa</div>
        <h4 style="font-size:18px;color:#0F172A;margin:0 0 12px;">Dinh Thự Trên Không</h4>
        <div style="font-size:24px;font-weight:800;color:#0F172A;margin-bottom:8px;">149 – 301 m²</div>
        <div style="font-size:13px;color:#64748B;line-height:1.5;">Tầng thượng đỉnh tháp, sân vườn riêng, tầm nhìn triệu đô bao trọn Sài Gòn</div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 7: BẢNG GIÁ DỰ KIẾN & CHÍNH SÁCH THANH TOÁN 2026 -->
<section id="bang-gia" style="padding:80px 0;background:#FFFFFF;">
  <div class="kbds-container">
    <div style="text-align:center;max-width:850px;margin:0 auto 40px;">
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">GIÁ GỐC & CHÍNH SÁCH ƯU ĐÃI KITA GROUP</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">BẢNG GIÁ DỰ KIẾN ANSANA BY KITA</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Mức giá tham khảo cạnh tranh tại khu vực mặt tiền Võ Văn Kiệt cùng chính sách hỗ trợ tài chính đặc quyền từ các ngân hàng lớn (Vietcombank, MB, VPBank).
      </p>
    </div>

    <div style="background:#fff;border-radius:16px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 4px 20px rgba(0,0,0,0.06);margin-bottom:40px;">
      <table style="width:100%;border-collapse:collapse;font-size:15px;text-align:left;">
        <thead>
          <tr style="background:#0F172A;color:#fff;">
            <th style="padding:16px 20px;">Loại Căn Hộ</th>
            <th style="padding:16px 20px;">Diện Tích Tim Tường</th>
            <th style="padding:16px 20px;">Đơn Giá Dự Kiến</th>
            <th style="padding:16px 20px;">Tổng Giá Bán (VAT)</th>
            <th style="padding:16px 20px;">Chính Sách Hỗ Trợ</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Căn Hộ 1PN + 1</td>
            <td style="padding:16px 20px;">51 – 57 m²</td>
            <td style="padding:16px 20px;">Từ 90 – 95 Tr/m²</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 5,2 – 5,6 Tỷ</td>
            <td style="padding:16px 20px;">Vay 70%, LS 0% đến 24 tháng</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Căn Hộ 2PN - 2WC</td>
            <td style="padding:16px 20px;">67 – 88 m²</td>
            <td style="padding:16px 20px;">Từ 92 – 98 Tr/m²</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 6,7 – 8,5 Tỷ</td>
            <td style="padding:16px 20px;">Ân hạn nợ gốc suốt thời gian ưu đãi</td>
          </tr>
          <tr style="border-bottom:1px solid #E2E8F0;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Căn Hộ 3PN - 2WC (Góc)</td>
            <td style="padding:16px 20px;">97 – 115 m²</td>
            <td style="padding:16px 20px;">Từ 95 – 102 Tr/m²</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 9,7 – 11,8 Tỷ</td>
            <td style="padding:16px 20px;">Chiết khấu thanh toán sớm lên tới 8%</td>
          </tr>
          <tr style="background:#F8FAFC;">
            <td style="padding:16px 20px;font-weight:700;color:#0F172A;">Penthouse Thượng Lưu</td>
            <td style="padding:16px 20px;">149 – 301 m²</td>
            <td style="padding:16px 20px;">Thỏa thuận</td>
            <td style="padding:16px 20px;font-weight:700;color:#D97706;">Từ 15 Tỷ trở lên</td>
            <td style="padding:16px 20px;">Đặc quyền thiết kế riêng biệt</td>
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

<!-- SECTION 8: PHÁP LÝ MINH BẠCH & UY TÍN CHỦ ĐẦU TƯ KITA GROUP -->
<section id="phap-ly" style="padding:80px 0;background:#F8FAFC;">
  <div class="kbds-container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;">
      <div>
        <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">NĂNG LỰC & UY TÍN BẢO CHỨNG</span>
        <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 20px;">PHÁP LÝ VỮNG VÀNG – SỞ HỮU LÂU DÀI</h2>
        <p style="color:#475569;font-size:16px;line-height:1.7;margin-bottom:20px;">
          Dự án <strong>Ansana by Kita</strong> sở hữu pháp lý hoàn chỉnh, được cấp phép xây dựng và phát triển đúng quy định của Nhà nước:
        </p>
        <ul style="color:#475569;font-size:15px;line-height:1.8;padding-left:20px;margin-bottom:24px;">
          <li>Quy hoạch chi tiết 1/500 đã được phê duyệt chính thức.</li>
          <li>Quyết định giao đất, hoàn thành nghĩa vụ tài chính tiền sử dụng đất.</li>
          <li>Hình thức sở hữu: <strong>Sổ hồng sở hữu lâu dài</strong> cho người Việt Nam.</li>
          <li>Đồng hành bởi tổng thầu xây dựng <strong>Newtecons</strong> – bảo chứng thép cho tiến độ và chất lượng kết cấu công trình.</li>
        </ul>
        <h4 style="font-size:18px;font-weight:700;color:#0F172A;margin:20px 0 10px;">Về Tập Đoàn KITA Group:</h4>
        <p style="color:#475569;font-size:15px;line-height:1.7;">
          Thành lập từ năm 2014, KITA Group đã khẳng định vị thế vững chắc trên thị trường bất động sản với tiềm lực tài chính dồi dào và chuỗi dự án quy mô lớn (tiêu biểu như Stella Mega City 150ha tại Cần Thơ, KITA Airport City, Golden Hills...). Ansana by Kita là dự án chiến lược mang tính biểu tượng của KITA tại thị trường TP. Hồ Chí Minh.
        </p>
      </div>
      <div>
        <div style="background:#fff;border-radius:16px;padding:36px;box-shadow:0 8px 30px rgba(0,0,0,0.06);border:1px solid #E2E8F0;">
          <h3 style="font-size:20px;font-weight:800;color:#0F172A;margin:0 0 20px;text-align:center;">5 GIÁ TRỊ VÀNG TẠO NÊN SỨC HÚT ANSANA BY KITA</h3>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">01</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Mặt Tiền Đại Lộ Đẹp Nhất TP.HCM</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Mặt tiền Võ Văn Kiệt 60m thông thoáng, không ngập nước, chạy thẳng về Quận 1 chỉ 15 – 20 phút.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">02</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Quy Mô 2,43ha Hiếm Hoi Nội Đô</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Quỹ đất lớn hiếm hoi còn sót lại tại khu Tây, mật độ xây dựng chỉ 34% nhiều mảng xanh sinh thái.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">03</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Chuẩn Sống Wellness Luxury & Green Smart</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Hồ bơi resort nhiệt đới, công viên xanh mát, công nghệ quản lý tòa nhà thông minh tiết kiệm năng lượng.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;margin-bottom:18px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">04</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Bộ Đôi Bảo Chứng: KITA Group & Newtecons</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Chủ đầu tư tiềm lực tài chính mạnh kết hợp cùng tổng thầu xây dựng đẳng cấp hàng đầu Việt Nam.</div>
            </div>
          </div>
          <div style="display:flex;gap:16px;">
            <div style="font-size:20px;font-weight:800;color:#D97706;line-height:1;">05</div>
            <div>
              <div style="font-weight:700;color:#0F172A;font-size:15px;">Pháp Lý Sổ Hồng Sở Hữu Lâu Dài</div>
              <div style="font-size:13px;color:#64748B;margin-top:2px;">Quyền sở hữu vĩnh viễn, bảo toàn và gia tăng giá trị tài sản truyền đời cho thế hệ tương lai.</div>
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
      <span style="color:#D97706;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">CẨM NANG & THỊ TRƯỜNG</span>
      <h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:8px 0 16px;">TIN TỨC & ĐÁNH GIÁ DỰ ÁN ANSANA BY KITA</h2>
      <p style="color:#64748B;font-size:16px;line-height:1.6;">
        Cập nhật liên tục tiến độ thi công, phân tích thị trường căn hộ Võ Văn Kiệt và bảng giá mới nhất từ các chuyên gia Kênh Bất Động Sản.
      </p>
    </div>

    [kbds_project_news limit="12"]
  </div>
</section>

<!-- SECTION 10: FORM ĐĂNG KÝ TƯ VẤN & NHẬN BẢNG GIÁ GỐC -->
<section id="dang-ky" style="padding:80px 0;background:linear-gradient(135deg,#0a192f 0%,#1e3a5f 100%);color:#fff;">
  <div class="kbds-container" style="max-width:800px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:36px;">
      <span style="color:#F59E0B;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;">ĐĂNG KÝ THAM QUAN & NHẬN BẢNG GIÁ GỐC</span>
      <h2 style="font-size:32px;font-weight:800;color:#fff;margin:8px 0 16px;">LIÊN HỆ PHÒNG KINH DOANH ANSANA BY KITA</h2>
      <p style="color:#94A3B8;font-size:15px;line-height:1.6;">
        Để lại thông tin chính xác, chuyên viên tư vấn dự án Ansana by Kita sẽ gửi trọn bộ tài liệu gồm Mặt bằng layout chi tiết, Bảng giá đợt 1 và Giỏ hàng căn view đẹp qua Zalo trong vòng 3 phút.
      </p>
    </div>

    <div style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);border-radius:16px;padding:36px;box-shadow:0 12px 30px rgba(0,0,0,0.3);">
      [kbds_lead_form project="Ansana by Kita Võ Văn Kiệt"]
    </div>
  </div>
</section>
HTML;

// 3. TẠO HOẶC CẬP NHẬT POST DỰ ÁN (du_an)
$project_slug = 'ansana-by-kita';
$existing_project = get_posts([
    'post_type'   => 'du_an',
    'name'        => $project_slug,
    'posts_per_page' => 1,
    'post_status' => 'any'
]);

$project_data = [
    'post_title'   => 'Ansana by Kita Võ Văn Kiệt - Bình Tân | Căn Hộ KITA Group',
    'post_name'    => $project_slug,
    'post_content' => $landing_html,
    'post_status'  => 'publish',
    'post_type'    => 'du_an',
    'post_excerpt' => 'Ansana by Kita (Stella En Tropic) là tổ hợp căn hộ cao cấp 24 tầng quy mô 2,43ha tại số 69-79-89 mặt tiền Đại lộ Võ Văn Kiệt, P. An Lạc, Q. Bình Tân, TP.HCM do KITA Group phát triển và Newtecons thi công. Chuẩn sống Wellness Luxury, hồ bơi resort, 15 phút về Quận 1.',
];

if (!empty($existing_project)) {
    $project_id = $existing_project[0]->ID;
    $project_data['ID'] = $project_id;
    wp_update_post($project_data);
    echo " ✔ Đã cập nhật Dự án Ansana by Kita (ID: {$project_id})\n";
} else {
    $project_id = wp_insert_post($project_data);
    echo " + Đã tạo mới Dự án Ansana by Kita (ID: {$project_id})\n";
}

// Thiết lập Featured Image (Ảnh đại diện)
if (!empty($m['phoi_canh_dem_tong_the']['id'])) {
    set_post_thumbnail($project_id, $m['phoi_canh_dem_tong_the']['id']);
}

// Gán Taxonomies
wp_set_object_terms($project_id, ['tp-ho-chi-minh', 'binh-tan'], 'khu_vuc_bds');
wp_set_object_terms($project_id, ['can-ho-chung-cu'], 'loai_hinh_bds');
wp_set_object_terms($project_id, 'sap-mo-ban', 'trang_thai_du_an');
wp_set_object_terms($project_id, 'kita-group', 'chu_dau_tu');

// Cập nhật Meta fields chuẩn mô hình B
update_post_meta($project_id, '_kbds_project_code', 'DA-ANSANA');
update_post_meta($project_id, '_kbds_price_from', 'Từ 90 – 100 triệu/m² (Căn hộ từ ~5,2 tỷ/căn)');
update_post_meta($project_id, '_kbds_price_min_num', '90');
update_post_meta($project_id, '_kbds_address', 'Số 69 – 79 – 89 Đại lộ Võ Văn Kiệt, P. An Lạc, Q. Bình Tân, TP. Hồ Chí Minh (ngay nút giao An Dương Vương – Hồ Học Lãm)');
update_post_meta($project_id, '_kbds_total_area', '2,43 ha (Mật độ xây dựng ~34%)');
update_post_meta($project_id, '_kbds_scale', 'Các khối tháp căn hộ cao 24 tầng nổi + 2 tầng hầm, quy mô hơn 1.500 sản phẩm (1PN+1, 2PN, 3PN, Penthouse & Shophouse)');
update_post_meta($project_id, '_kbds_legal_status', 'Quy hoạch 1/500 hoàn thiện, Giấy phép xây dựng đầy đủ, Sổ hồng sở hữu lâu dài');
update_post_meta($project_id, '_kbds_handover_time', 'Dự kiến Quý IV/2026 – Quý II/2027 (Bàn giao hoàn thiện cao cấp)');
update_post_meta($project_id, '_kbds_bank_support', 'Ngân hàng hỗ trợ vay 70%, ân hạn nợ gốc và hỗ trợ lãi suất 0% lên tới 24 tháng');
update_post_meta($project_id, '_kbds_review_score', '9.5');
update_post_meta($project_id, '_kbds_pros_cons', "+ Vị trí đắc địa mặt tiền Đại lộ Võ Văn Kiệt 60m thông thoáng, không ngập nước, di chuyển về Quận 1 chỉ 15 – 20 phút\n+ Quy mô 2,43ha hiếm hoi còn lại tại khu Tây với mật độ xây dựng chỉ 34%\n+ Chuẩn sống Wellness Luxury và Green - Smart Tower với hồ bơi resort nhiệt đới và công viên sinh thái\n+ Bảo chứng thép từ chủ đầu tư KITA Group và tổng thầu xây dựng Newtecons\n+ Pháp lý hoàn chỉnh, Sổ hồng sở hữu lâu dài\n- Phân khúc cao cấp, đơn giá thuộc top đầu khu Tây TP.HCM");

// Cấu hình Rank Math SEO cho Dự án
update_post_meta($project_id, 'rank_math_title', 'Ansana by Kita Võ Văn Kiệt Bình Tân | Bảng Giá Căn Hộ KITA 2026');
update_post_meta($project_id, 'rank_math_description', 'Đánh giá chi tiết dự án Ansana by Kita (Stella En Tropic 2,43ha, 24 tầng) mặt tiền Đại lộ Võ Văn Kiệt Bình Tân TP.HCM. Cập nhật bảng giá từ 90 triệu/m², mặt bằng và chính sách ưu đãi KITA Group.');
update_post_meta($project_id, 'rank_math_focus_keyword', 'ansana by kita, ansana võ văn kiệt, căn hộ ansana by kita, kita group võ văn kiệt');
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
    // Bài 1: Đánh giá vị trí mặt tiền Võ Văn Kiệt
    [
        'title' => 'Đánh Giá Vị Trí Ansana by Kita Mặt Tiền Đại Lộ Võ Văn Kiệt: Tâm Điểm Siêu Kết Nối Cửa Ngõ Phía Tây TP.HCM',
        'slug'  => 'vi-tri-ansana-by-kita-mat-tien-vo-van-kiet-binh-tan',
        'cat_id'=> $cat_pl_id,
        'thumb' => $m['so_do_vi_tri']['id'],
        'focus_kw' => 'vị trí ansana by kita, ansana võ văn kiệt, căn hộ võ văn kiệt bình tân, ansana by kita bình tân',
        'desc'  => 'Phân tích chi tiết vị trí kim cương mặt tiền Đại lộ Võ Văn Kiệt của dự án Ansana by Kita Bình Tân: Lợi thế kết nối Quận 1, Quận 5, Quận 6 và cửa ngõ giao thương phía Tây.',
        'content' => <<<HTML
<p>Trong bản đồ quy hoạch đô thị của TP. Hồ Chí Minh, Đại lộ Võ Văn Kiệt (trục Đại lộ Đông Tây) luôn được đánh giá là một trong những tuyến giao thông đẹp, hiện đại và thông thoáng bậc nhất thành phố. Tọa lạc tại số <strong>69 – 79 – 89 Đại lộ Võ Văn Kiệt</strong>, phường An Lạc, quận Bình Tân, dự án <strong><a href="{$project_url}">Ansana by Kita</a></strong> sở hữu vị trí mặt tiền đắt giá mang lại tiềm năng kết nối và gia tăng giá trị vượt bậc.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['so_do_vi_tri']['url']}" alt="{$m['so_do_vi_tri']['alt']}"/><figcaption>{$m['so_do_vi_tri']['caption']}</figcaption></figure></div>

<h2>1. Trục Đại Lộ Đắc Địa Không Đèn Đỏ – Không Ngập Nước</h2>
<p>Khác biệt hoàn toàn với những tuyến đường nội đô thường xuyên ùn ứ, Đại lộ Võ Văn Kiệt sở hữu lộ giới rộng tới 60 mét với 10 làn xe chạy riêng biệt. Điểm đắt giá nhất của tuyến đường này là hầu như không có đèn đỏ giao cắt trực tiếp ở làn xe ô tô tốc độ cao, giúp cư dân Ansana by Kita di chuyển:</p>
<ul>
  <li>Chỉ <strong>15 – 20 phút</strong> chạy thẳng một mạch đến trung tâm Quận 1 (Chợ Bến Thành, Phố đi bộ Nguyễn Huệ, Bitexco).</li>
  <li>Chỉ <strong>10 phút</strong> tiếp cận trung tâm thương mại sầm uất Quận 5 và Quận 6 (khu vực Chợ Lớn).</li>
  <li>Kết nối nhanh chóng sang Khu đô thị mới Thủ Thiêm (TP. Thủ Đức) qua hầm vượt sông Sài Gòn chỉ trong 20 phút.</li>
</ul>

<h2>2. Tâm Điểm Giao Thoa Của Mạng Lưới Hạ Tầng Khu Tây</h2>
<p>Ansana by Kita nằm ngay giao điểm của các tuyến đường huyết mạch: <strong>Võ Văn Kiệt, An Dương Vương, Hồ Học Lãm và Quốc lộ 1A</strong>. Nhờ đó, việc tiếp cận các tiện ích ngoại khu hiện hữu chỉ diễn ra trong vòng vài phút:</p>
<ul>
  <li><strong>Y tế:</strong> Bệnh viện Triều An, Bệnh viện Quốc tế City (CIH), Bệnh viện Chợ Rẫy, Bệnh viện Đại học Y Dược TP.HCM.</li>
  <li><strong>Thương mại & Giải trí:</strong> TTTM Aeon Mall Bình Tân, Siêu thị Mega Market Bình Phú, Siêu thị Co.opmart, Công viên văn hóa Phú Lâm.</li>
  <li><strong>Giáo dục:</strong> Hệ thống trường học các cấp từ mầm non đến THPT, kề cận các trường đại học lớn như ĐH Kinh Tế TP.HCM, ĐH Y Dược.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phoi_canh_dem_tong_the']['url']}" alt="{$m['phoi_canh_dem_tong_the']['alt']}"/><figcaption>{$m['phoi_canh_dem_tong_the']['caption']}</figcaption></figure></div>

<h2>3. Tiềm Năng Tăng Giá Từ Các Quy Hoạch Tương Lai</h2>
<p>Khu Tây TP.HCM đang là tâm điểm đón dòng vốn đầu tư công mạnh mẽ với các dự án mở rộng đường Hồ Học Lãm, nâng cấp đường An Dương Vương và tuyến xe buýt nhanh BRT số 1 dọc hành lang Võ Văn Kiệt – Mai Chí Thọ. Sự bứt phá về hạ tầng sẽ tạo đòn bẩy kép thúc đẩy mặt bằng giá căn hộ tại Ansana by Kita gia tăng mạnh mẽ trong những năm tới.</p>

<p>Xem thông tin chi tiết bảng giá và chính sách từng phân khu tại trang <strong><a href="{$project_url}">Dự Án Ansana by Kita Võ Văn Kiệt</a></strong>.</p>
HTML
    ],

    // Bài 2: Hệ tiện ích Wellness Luxury & Hồ bơi resort
    [
        'title' => 'Hệ Tiện Ích Chuẩn Wellness Luxury Tại Ansana by Kita: Hồ Bơi Resort Nhiệt Đới & Không Gian Tái Tạo Năng Lượng',
        'slug'  => 'tien-ich-wellness-luxury-ansana-by-kita',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['ho_boi_resort']['id'],
        'focus_kw' => 'tiện ích ansana by kita, wellness luxury ansana by kita, hồ bơi resort ansana by kita, căn hộ xanh ansana',
        'desc'  => 'Trải nghiệm hệ tiện ích chuẩn Wellness Luxury tại Ansana by Kita Bình Tân: Hồ bơi resort nhiệt đới, công viên sinh thái, phòng gym yoga hiện đại tái tạo trọn vẹn năng lượng sống.',
        'content' => <<<HTML
<p>Giữa nhịp sống đô thị hối hả và ô nhiễm khói bụi, nhu cầu tìm kiếm một chốn an cư có thể "chữa lành", phục hồi sức khỏe và nuôi dưỡng tâm hồn trở thành ưu tiên hàng đầu của giới thượng lưu. Tại <strong><a href="{$project_url}">Ansana by Kita</a></strong>, Chủ đầu tư KITA Group đã tiên phong đưa mô hình <strong>Wellness Luxury</strong> vào từng ngóc ngách của dự án.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['ho_boi_resort']['url']}" alt="{$m['ho_boi_resort']['alt']}"/><figcaption>{$m['ho_boi_resort']['caption']}</figcaption></figure></div>

<h2>1. Hồ Bơi Tràn Bờ Phong Cách Resort Nhiệt Đới Độc Bản</h2>
<p>Điểm nhấn đắt giá nhất trong quần thể tiện ích của Ansana by Kita là <strong>Hồ bơi tràn bờ phong cách Resort (Podium Pool)</strong> tọa lạc tại tầng tiện ích khối đế:</p>
<ul>
  <li>Thiết kế uốn lượn mềm mại như dòng suối tự nhiên giữa những rặng cọ xanh mát và thảm thực vật phong phú.</li>
  <li>Làn nước được xử lý bằng công nghệ điện phân muối khoáng tự nhiên, bảo vệ tối đa sức khỏe làn da và đôi mắt của cư dân.</li>
  <li>Khu vực sảnh lounge ngắm cảnh, quầy bar ngoài trời và sàn tắm nắng mang lại cảm giác nghỉ dưỡng 5 sao ngay tại gia đình.</li>
</ul>

<h2>2. Chuỗi Tiện Ích Chăm Sóc Thân – Tâm – Trí Toàn Diện</h2>
<p>Ansana by Kita trang bị hệ sinh thái tiện ích khép kín đáp ứng trọn vẹn mọi nhu cầu chăm sóc sức khỏe:</p>
<ul>
  <li><strong>Vườn thiền & Đường dạo bộ sinh thái:</strong> Nơi cư dân tản bộ dưới những tán cây xanh rợp bóng, hít thở bầu không khí trong lành vào mỗi sớm mai.</li>
  <li><strong>Phòng Gym hiện đại & Sân tập Yoga ngoài trời:</strong> Trang bị hệ thống máy móc tập luyện tiên tiến nhập khẩu, phòng tập Yoga đón ánh nắng sớm tái tạo sinh khí dồi dào.</li>
  <li><strong>Khu vui chơi trẻ em & Trường mầm non nội khu:</strong> Đem lại không gian phát triển thể chất và trí tuệ an toàn tuyệt đối cho các cư dân nhí.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['masterplan_tong_the']['url']}" alt="{$m['masterplan_tong_the']['alt']}"/><figcaption>{$m['masterplan_tong_the']['caption']}</figcaption></figure></div>

<h2>3. Mô Hình Green – Smart Tower Tối Ưu Năng Lượng</h2>
<p>Bên cạnh các tiện ích xanh, dự án còn ứng dụng công nghệ <strong>Smart Tower</strong> tiên tiến trong quản lý vận hành: hệ thống pin năng lượng mặt trời cho các khu vực công cộng, camera an ninh AI đa lớp và ứng dụng cư dân thông minh, tạo nên một chuẩn mực sống bền vững vượt thời gian.</p>

<p>Khám phá trọn bộ tiện ích tại <strong><a href="{$project_url}">Hồ Sơ Ansana by Kita Bình Tân</a></strong>.</p>
HTML
    ],

    // Bài 3: Phân tích mặt bằng & thiết kế căn hộ
    [
        'title' => 'Phân Tích Mặt Bằng Tổng Thể & Layout Căn Hộ Ansana by Kita Võ Văn Kiệt: Tối Ưu Nắng Gió Chuẩn Xanh',
        'slug'  => 'mat-bang-thiet-ke-can-ho-ansana-by-kita',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['masterplan_tong_the']['id'],
        'focus_kw' => 'mặt bằng ansana by kita, thiết kế căn hộ ansana by kita, layout ansana by kita, masterplan ansana by kita',
        'desc'  => 'Đánh giá chi tiết mặt bằng quy hoạch tổng thể 2,43ha và layout thiết kế các loại căn hộ 1PN, 2PN, 3PN tại dự án Ansana by Kita mặt tiền Võ Văn Kiệt Bình Tân.',
        'content' => <<<HTML
<p>Được quy hoạch trên quỹ đất rộng lớn <strong>2,43 ha</strong> ngay mặt tiền Đại lộ Võ Văn Kiệt, <strong><a href="{$project_url}">Ansana by Kita</a></strong> gây ấn tượng mạnh mẽ bởi thiết kế mặt bằng thông minh, cân bằng hoàn hảo giữa mật độ xây dựng thấp và cảnh quan thiên nhiên sinh thái.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['masterplan_tong_the']['url']}" alt="{$m['masterplan_tong_the']['alt']}"/><figcaption>{$m['masterplan_tong_the']['caption']}</figcaption></figure></div>

<h2>1. Quy Hoạch Mặt Bằng Tổng Thể Masterplan Đồng Bộ</h2>
<p>Mặt bằng tổng thể của Ansana by Kita được bố trí gồm các khối tháp cao 24 tầng nổi so le khoa học, giúp 100% căn hộ không bị che chắn tầm nhìn:</p>
<ul>
  <li>Khối đế thương mại dịch vụ sầm uất tiếp giáp mặt tiền đường lớn và đường quy hoạch 13m nội khu.</li>
  <li>Lõi trung tâm dự án là công viên cây xanh, hồ bơi tràn resort và cụm tiện ích thể thao biệt lập, đảm bảo sự yên tĩnh tuyệt đối cho cư dân sinh sống.</li>
  <li>2 tầng hầm đậu xe rộng rãi thông suốt toàn khu đất, đáp ứng đầy đủ nhu cầu đỗ xe ô tô và xe máy của mọi gia đình.</li>
</ul>

<h2>2. Phân Tích Layout Thiết Kế Các Loại Căn Hộ</h2>
<p>Từng căn hộ tại Ansana by Kita đều được kiến tạo theo tiêu chuẩn công thái học hiện đại:</p>
<ul>
  <li><strong>Căn hộ 1PN + 1 (51 – 57 m²):</strong> Không gian mở linh hoạt, có thể bố trí phòng làm việc, phòng đọc sách hoặc giường đơn phụ cho con nhỏ.</li>
  <li><strong>Căn hộ 2PN - 2WC (67 – 88 m²):</strong> Sản phẩm chủ lực với phòng khách nối liền ban công đón trọn gió trời, 2 phòng ngủ riêng tư đón ánh sáng tự nhiên, khu bếp nấu kết nối logia giặt phơi thông thoáng.</li>
  <li><strong>Căn hộ 3PN - 2WC (97 – 115 m²):</strong> Tọa lạc tại các vị trí góc với 2 mặt thoáng view toàn cảnh đại lộ và hồ bơi, lý tưởng cho các gia đình đa thế hệ cùng chung sống.</li>
  <li><strong>Penthouse thượng lưu (149 – 301 m²):</strong> Dinh thự trên mây với trần cao khoáng đạt và sân vườn riêng biệt, khẳng định vị thế đỉnh cao của chủ nhân.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phoi_canh_dem_tong_the']['url']}" alt="{$m['phoi_canh_dem_tong_the']['alt']}"/><figcaption>{$m['phoi_canh_dem_tong_the']['caption']}</figcaption></figure></div>

<p>Đăng ký nhận trọn bộ mặt bằng cad và layout chi tiết tại <strong><a href="{$project_url}">Trang Dự Án Ansana by Kita</a></strong>.</p>
HTML
    ],

    // Bài 4: Cập nhật bảng giá & chính sách bán hàng 2026
    [
        'title' => 'Cập Nhật Bảng Giá Bán & Chính Sách Ưu Đãi Căn Hộ Ansana by Kita Năm 2026: Đòn Bẩy Tài Chính Từ KITA Group',
        'slug'  => 'bang-gia-chinh-sach-ban-hang-ansana-by-kita-2026',
        'cat_id'=> $cat_rv_id,
        'thumb' => $m['phoi_canh_dem_tong_the']['id'],
        'focus_kw' => 'bảng giá ansana by kita, giá bán căn hộ ansana by kita, chính sách bán hàng ansana by kita, giá căn hộ võ văn kiệt',
        'desc'  => 'Cập nhật bảng giá bán tham khảo và chính sách ưu đãi tài chính mới nhất năm 2026 của dự án căn hộ cao cấp Ansana by Kita Võ Văn Kiệt do KITA Group phát triển.',
        'content' => <<<HTML
<p>Là một trong những dự án căn hộ cao cấp quy mô bậc nhất chuẩn bị ra mắt tại khu Tây TP.HCM trong năm 2026, <strong><a href="{$project_url}">Ansana by Kita</a></strong> đang nhận được sự quan tâm rất lớn từ khách hàng có nhu cầu ở thực lẫn các nhà đầu tư sành sỏi. Dưới đây là tổng hợp bảng giá dự kiến và các gói giải pháp tài chính tối ưu từ Chủ đầu tư KITA Group.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phoi_canh_dem_tong_the']['url']}" alt="{$m['phoi_canh_dem_tong_the']['alt']}"/><figcaption>{$m['phoi_canh_dem_tong_the']['caption']}</figcaption></figure></div>

<h2>1. Bảng Giá Dự Kiến Căn Hộ Ansana by Kita Đợt 1</h2>
<p>Đơn giá rumor của dự án dao động từ <strong>90 – 100 triệu/m²</strong> (đã bao gồm VAT và hoàn thiện nội thất cơ bản cao cấp):</p>
<table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:15px;">
  <thead>
    <tr style="background:#0F172A;color:#fff;">
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Loại Căn Hộ</th>
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Diện Tích</th>
      <th style="padding:12px 16px;border:1px solid #CBD5E1;">Giá Bán Dự Kiến (VAT)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Căn hộ 1PN + 1</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">51 – 57 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 5,2 – 5,6 Tỷ</td>
    </tr>
    <tr style="background:#F8FAFC;">
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Căn hộ 2PN - 2WC</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">67 – 88 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 6,7 – 8,5 Tỷ</td>
    </tr>
    <tr>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Căn hộ 3PN - 2WC (Góc)</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">97 – 115 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 9,7 – 11,8 Tỷ</td>
    </tr>
    <tr style="background:#F8FAFC;">
      <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;">Penthouse Thượng Lưu</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;">149 – 301 m²</td>
      <td style="padding:12px 16px;border:1px solid #CBD5E1;color:#D97706;font-weight:700;">Từ 15 Tỷ trở lên</td>
    </tr>
  </tbody>
</table>

<h2>2. Chính Sách Bán Hàng & Hỗ Trợ Tài Chính Ưu Việt</h2>
<p>KITA Group hợp tác cùng các ngân hàng thương mại hàng đầu mang đến giải pháp tài chính vượt trội:</p>
<ul>
  <li><strong>Hỗ trợ vay vốn ngân hàng:</strong> Ngân hàng giải ngân lên tới 70% giá trị hợp đồng mua bán.</li>
  <li><strong>Hỗ trợ lãi suất 0%:</strong> Áp dụng trong thời gian dài lên tới 24 tháng hoặc đến thời điểm bàn giao nhà thực tế.</li>
  <li><strong>Ân hạn nợ gốc:</strong> Khách hàng không phải trả tiền gốc trong suốt thời gian hỗ trợ lãi suất.</li>
  <li><strong>Chiết khấu thanh toán sớm:</strong> Nhận mức chiết khấu hấp dẫn lên tới 8% dành cho khách hàng thanh toán sớm bằng vốn tự có.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['ho_boi_resort']['url']}" alt="{$m['ho_boi_resort']['alt']}"/><figcaption>{$m['ho_boi_resort']['caption']}</figcaption></figure></div>

<p>Đăng ký nhận giỏ hàng ưu đãi đợt 1 tại <strong><a href="{$project_url}">Hồ Sơ Ansana by Kita Võ Văn Kiệt</a></strong>.</p>
HTML
    ]
];

// Tạo các bài viết vệ tinh
echo "\n--- ĐANG TẠO 4 BÀI VIẾT VỆ TINH TOPIC CLUSTER CHO ANSANA BY KITA ---\n";
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
    wp_set_post_tags($art_id, ['Ansana by Kita', 'Ansana Võ Văn Kiệt', 'Căn hộ Ansana', 'KITA Group'], true);

    // Rank Math SEO
    update_post_meta($art_id, 'rank_math_title', $art['title'] . ' | Kênh Bất Động Sản');
    update_post_meta($art_id, 'rank_math_description', $art['desc']);
    update_post_meta($art_id, 'rank_math_focus_keyword', $art['focus_kw']);
    update_post_meta($art_id, 'rank_math_robots', ['index', 'follow']);
}

echo "\n==============================================================\n";
echo "🎉 HOÀN TẤT XÂY DỰNG LANDING PAGE & 4 BÀI VIẾT VỆ TINH ANSANA BY KITA!\n";
echo "==============================================================\n";
