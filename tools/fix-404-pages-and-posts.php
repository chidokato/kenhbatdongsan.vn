<?php
/**
 * Xử lý dứt điểm các lỗi 404 cho:
 * 1. https://kenhbatdongsan.vn/tin-tuc/
 * 2. https://kenhbatdongsan.vn/handico-sunshine-new-ha-noi/
 * 3. https://kenhbatdongsan.vn/mat-bang-handico-sunshine-new-ha-noi/
 */

require_once dirname(__DIR__) . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU TẠO DỮ LIỆU ĐỂ KHẮC PHỤC TRIỆT ĐỂ CÁC LỖI 404\n";
echo "==============================================================\n";

// 1. Tạo Term Chủ đầu tư Handico & Sunshine Group nếu chưa có
if (!term_exists('Handico & Sunshine Group', 'chu_dau_tu')) {
    wp_insert_term('Handico & Sunshine Group', 'chu_dau_tu', [
        'slug' => 'handico-sunshine-group',
        'description' => 'Liên danh Tổng công ty Đầu tư và Phát triển nhà Hà Nội (HANDICO) và Tập đoàn Sunshine Group'
    ]);
    echo "✔ Đã tạo Term Chủ đầu tư: Handico & Sunshine Group\n";
}

// -----------------------------------------------------------------------------
// 1. TẠO TRANG TIN TỨC: /tin-tuc/
// -----------------------------------------------------------------------------
$news_page_slug = 'tin-tuc';
$news_page_title = 'Tin Tức Bất Động Sản | Kênh Phân Tích Quy Hoạch, Dự Án & Thị Trường 24/7';

$news_html = <<<HTML
<div class="kbds-guide-wrap" style="max-width:1200px;margin:0 auto;padding:25px 20px 60px;">
  <div class="kbds-guide-hero" style="background:linear-gradient(135deg,#071931 0%,#0A2244 50%,#0E2E5C 100%);color:#fff;padding:50px 24px;border-radius:16px;text-align:center;margin-bottom:35px;border-bottom:3px solid #C59B27;">
    <span style="display:inline-block;background:rgba(212,175,55,0.2);color:#FDE68A;border:1px solid #D4AF37;padding:5px 16px;border-radius:20px;font-size:12.5px;font-weight:700;text-transform:uppercase;margin-bottom:14px;letter-spacing:0.5px;">CỔNG DỮ LIỆU & BẢN TIN THỊ TRƯỜNG CHÍNH THỨC</span>
    <h1 style="font-size:34px;font-weight:800;color:#FFFFFF;margin-bottom:12px;font-family:'Playfair Display',Georgia,serif;">TIN TỨC & PHÂN TÍCH THỊ TRƯỜNG BẤT ĐỘNG SẢN</h1>
    <p style="font-size:15.5px;color:#CBD5E1;max-width:760px;margin:0 auto;line-height:1.6;">Tổng hợp dữ liệu thẩm định độc lập, bản đồ quy hoạch hạ tầng giao thông, giải mã thiết kế dự án và cẩm nang pháp lý bất động sản cao cấp 24/7.</p>
    
    <div style="display:flex;justify-content:center;gap:10px;flex-wrap:wrap;margin-top:24px;">
      <a href="https://kenhbatdongsan.vn/review-du-an/" style="background:rgba(255,255,255,0.1);color:#fff;border:1px solid rgba(255,255,255,0.25);padding:8px 16px;border-radius:20px;font-size:13.5px;font-weight:600;text-decoration:none;">🏛️ Review Dự Án</a>
      <a href="https://kenhbatdongsan.vn/quy-hoach-ha-tang/" style="background:rgba(255,255,255,0.1);color:#fff;border:1px solid rgba(255,255,255,0.25);padding:8px 16px;border-radius:20px;font-size:13.5px;font-weight:600;text-decoration:none;">🗺️ Quy Hoạch & Hạ Tầng</a>
      <a href="https://kenhbatdongsan.vn/tin-tuc-thi-truong/" style="background:rgba(255,255,255,0.1);color:#fff;border:1px solid rgba(255,255,255,0.25);padding:8px 16px;border-radius:20px;font-size:13.5px;font-weight:600;text-decoration:none;">📈 Thị Trường & Tài Chính</a>
      <a href="https://kenhbatdongsan.vn/cam-nang-phap-ly/" style="background:rgba(255,255,255,0.1);color:#fff;border:1px solid rgba(255,255,255,0.25);padding:8px 16px;border-radius:20px;font-size:13.5px;font-weight:600;text-decoration:none;">⚖️ Cẩm Nang Pháp Lý</a>
    </div>
  </div>

  <div style="margin-bottom:40px;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:2px solid #E2E8F0;padding-bottom:12px;">
      <h2 style="font-size:22px;font-weight:800;color:#0B2C4D;margin:0;font-family:'Playfair Display',Georgia,serif;">BÀI VIẾT PHÂN TÍCH CHUYÊN SÂU MỚI NHẤT</h2>
      <span style="font-size:13.5px;color:#64748B;font-weight:600;">Cập nhật liên tục 24/7</span>
    </div>

    [blog_posts posts="12" columns="3" columns__md="2" columns__sm="1" image_height="56.25%" show_date="true" excerpt_length="22" comments="false"]
  </div>

  <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:16px;padding:35px 25px;text-align:center;margin-top:30px;">
    <h3 style="font-size:22px;font-weight:800;color:#0B2C4D;margin-bottom:10px;font-family:'Playfair Display',Georgia,serif;">Đăng Ký Nhận Bản Tin Phân Tích Thị Trường Định Kỳ</h3>
    <p style="font-size:14.5px;color:#64748B;max-width:600px;margin:0 auto 22px;">Nhận các báo cáo nghiên cứu độc quyền, bảng so sánh giá bán và cảnh báo quy hoạch trực tiếp qua Zalo/Email.</p>
    [kbds_lead_form title="" project="Đăng Ký Nhận Tin Tức Bất Động Sản" button_text="Đăng Ký Nhận Bản Tin Miễn Phí ➔"]
  </div>
</div>
HTML;

$news_page = get_page_by_path($news_page_slug, OBJECT, 'page');
$news_page_args = [
    'post_title'   => $news_page_title,
    'post_name'    => $news_page_slug,
    'post_content' => $news_html,
    'post_status'  => 'publish',
    'post_type'    => 'page'
];

if ($news_page) {
    $news_page_args['ID'] = $news_page->ID;
    $news_page_id = wp_update_post($news_page_args);
    echo "✔ Đã cập nhật Trang Tin Tức (ID: {$news_page_id}) -> /{$news_page_slug}/\n";
} else {
    $news_page_id = wp_insert_post($news_page_args);
    echo "✔ Đã tạo mới Trang Tin Tức (ID: {$news_page_id}) -> /{$news_page_slug}/\n";
}

update_post_meta($news_page_id, 'rank_math_title', 'Tin Tức Bất Động Sản 24/7 | Đánh Giá Dự Án & Quy Hoạch | Kênh Bất Động Sản');
update_post_meta($news_page_id, 'rank_math_description', 'Cập nhật tin tức thị trường bất động sản mới nhất 2026: Phân tích dự án, bản đồ quy hoạch, lãi suất vay ngân hàng và cẩm nang pháp lý chuẩn xác.');
update_post_meta($news_page_id, 'rank_math_focus_keyword', 'tin tức bất động sản, thị trường bất động sản');
update_post_meta($news_page_id, 'rank_math_robots', ['index', 'follow']);


// -----------------------------------------------------------------------------
// 2. TẠO DỰ ÁN & TRANG: /handico-sunshine-new-ha-noi/
// -----------------------------------------------------------------------------
$proj_slug = 'handico-sunshine-new-ha-noi';
$proj_title = 'Đại Đô Thị Handico Sunshine New Hà Nội (Bắc Thăng Long Urban City 465ha)';

$proj_html = <<<HTML
<!-- SUBNAV ĐIỀU HƯỚNG DỰ ÁN HANDICO SUNSHINE NEW HÀ NỘI -->
<div class="kbds-project-subnav">
  <div class="kbds-container kbds-subnav-container">
    <div class="kbds-subnav-brand">
      <span class="kbds-subnav-dot"></span>
      HANDICO SUNSHINE NEW HÀ NỘI
    </div>
    <a href="#dang-ky" class="kbds-subnav-cta">Nhận Bảng Giá Gốc</a>
    <nav class="kbds-subnav-links">
      <a href="#tong-quan" class="kbds-subnav-link">Tổng Quan</a>
      <a href="#vi-tri" class="kbds-subnav-link">Vị Trí Cửa Ngõ</a>
      <a href="#quy-hoach" class="kbds-subnav-link">Quy Hoạch 465ha</a>
      <a href="#san-pham" class="kbds-subnav-link">Sản Phẩm Đẳng Cấp</a>
      <a href="#tien-ich" class="kbds-subnav-link">Tiện Ích Smart City</a>
      <a href="#mat-bang-chi-tiet" class="kbds-subnav-link">Mặt Bằng Thiết Kế</a>
      <a href="#dang-ky" class="kbds-subnav-link">Báo Giá Đợt 1</a>
    </nav>
  </div>
</div>

<!-- SECTION 1: HERO BANNER -->
<section id="tong-quan" class="kbds-project-hero" style="position:relative;background:linear-gradient(135deg,#071931 0%,#0A2244 50%,#0E2E5C 100%);color:#fff;padding:85px 0 100px;overflow:hidden;">
  <div style="position:absolute;top:0;right:0;bottom:0;left:0;opacity:0.18;background:radial-gradient(circle at 75% 25%,#C59B27 0%,transparent 65%);pointer-events:none;"></div>
  <div class="kbds-container kbds-hero-grid" style="position:relative;z-index:2;display:grid;grid-template-columns:1.2fr 0.8fr;gap:40px;align-items:center;">
    <div class="kbds-hero-content">
      <div class="kbds-hero-badge" style="display:inline-flex;align-items:center;gap:8px;background:rgba(197,155,39,0.22);border:1px solid rgba(197,155,39,0.5);padding:6px 16px;border-radius:30px;font-size:13px;font-weight:700;color:#FDE68A;margin-bottom:20px;letter-spacing:0.5px;">
        🏛️ SIÊU ĐẠI ĐÔ THỊ THÔNG MINH BẮC THĂNG LONG 465HA
      </div>
      <h1 class="kbds-hero-title" style="font-size:38px;line-height:1.22;font-weight:900;margin-bottom:16px;color:#FFFFFF;text-shadow:0 2px 10px rgba(0,0,0,0.5);">
        HANDICO SUNSHINE NEW HÀ NỘI
        <span class="kbds-hero-subtitle" style="display:block;font-size:22px;color:#FBBF24;font-weight:700;margin-top:8px;">Bắc Thăng Long Urban City – Đô Thị Sinh Thái Thông Minh 4.0</span>
      </h1>
      <p class="kbds-hero-desc" style="font-size:16px;line-height:1.7;color:#E2E8F0;margin-bottom:26px;">
        Siêu đại đô thị quy mô <strong>465,45 ha</strong> với tổng mức đầu tư gần <strong>100.000 tỷ đồng</strong> tọa lạc tại cửa ngõ phía Bắc Thủ đô Hà Nội (xã Thiên Lộc & Phúc Thịnh, Mê Linh – tiếp giáp Đông Anh). Phát triển bởi liên danh uy tín <strong>HANDICO & SUNSHINE GROUP</strong>, kiến tạo chuẩn mực sống quốc tế Smart Living kết hợp sinh thái nghỉ dưỡng ven kênh đào cho hơn 97.500 cư dân tinh hoa.
      </p>
      <div class="kbds-hero-actions" style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#dang-ky" style="background:linear-gradient(135deg,#C59B27,#B0871B);color:#071931;padding:14px 28px;border-radius:10px;font-size:15px;font-weight:800;text-decoration:none;box-shadow:0 6px 20px rgba(197,155,39,0.4);display:inline-flex;align-items:center;gap:8px;">
          <span>Nhận Bảng Giá Đợt 1 & Quy Hoạch 1/500</span> ➔
        </a>
        <a href="#mat-bang-chi-tiet" style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.25);padding:14px 26px;border-radius:10px;font-size:15px;font-weight:700;text-decoration:none;">
          Xem Chi Tiết Mặt Bằng 465ha
        </a>
      </div>
    </div>
    <div class="kbds-hero-media" style="position:relative;">
      <div style="background:#0F243E;border:2px solid #C59B27;border-radius:20px;padding:32px 24px;box-shadow:0 20px 45px rgba(0,0,0,0.5);">
        <h3 style="color:#FBBF24;font-size:18px;font-weight:800;margin-bottom:18px;text-align:center;text-transform:uppercase;">THÔNG SỐ VÀNG SIÊU DỰ ÁN</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;text-align:center;">
          <div style="background:rgba(255,255,255,0.06);padding:14px;border-radius:10px;border:1px solid rgba(255,255,255,0.1);">
            <div style="font-size:24px;font-weight:900;color:#FBBF24;">465,45 ha</div>
            <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Tổng quy mô quy hoạch</div>
          </div>
          <div style="background:rgba(255,255,255,0.06);padding:14px;border-radius:10px;border:1px solid rgba(255,255,255,0.1);">
            <div style="font-size:24px;font-weight:900;color:#FBBF24;">100.000 Tỷ</div>
            <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Tổng vốn đầu tư dự án</div>
          </div>
          <div style="background:rgba(255,255,255,0.06);padding:14px;border-radius:10px;border:1px solid rgba(255,255,255,0.1);">
            <div style="font-size:24px;font-weight:900;color:#FBBF24;">97.500</div>
            <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Quy mô dân số tinh hoa</div>
          </div>
          <div style="background:rgba(255,255,255,0.06);padding:14px;border-radius:10px;border:1px solid rgba(255,255,255,0.1);">
            <div style="font-size:24px;font-weight:900;color:#22C55E;">Sổ Hồng</div>
            <div style="font-size:12px;color:#94A3B8;margin-top:4px;">Pháp lý sở hữu lâu dài</div>
          </div>
        </div>
        <div style="margin-top:16px;padding:10px;background:rgba(197,155,39,0.15);border-radius:8px;font-size:12.5px;color:#FDE68A;text-align:center;">
          ✓ Phê duyệt quy hoạch 1/500 & Giấy phép xây dựng hoàn chỉnh
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: VỊ TRÍ CHIẾN LƯỢC CỬA NGÕ PHÍA BẮC -->
<section id="vi-tri" style="padding:75px 0;background:#FFFFFF;">
  <div class="kbds-container" style="max-width:1160px;margin:0 auto;padding:0 20px;">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="color:#C59B27;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:1px;">TÂM ĐIỂM KẾT NỐI HẠ TẦNG TƯƠNG LAI</span>
      <h2 style="font-size:32px;font-weight:800;color:#0B2C4D;margin-top:8px;font-family:'Playfair Display',Georgia,serif;">Vị Trí Kim Cương Trục Nhật Tân – Nội Bài & Cầu Tứ Liên</h2>
      <p style="font-size:15px;color:#64748B;line-height:1.6;">Dự án Handico Sunshine New Hà Nội nằm ngay cửa ngõ giao thương chiến lược giữa Đông Anh và Mê Linh, đón trọn xung lực bứt phá từ các siêu dự án giao thông trọng điểm quốc gia.</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:35px;align-items:center;">
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:16px;padding:30px;">
        <h3 style="font-size:20px;font-weight:700;color:#0B2C4D;margin-bottom:16px;">Khả Năng Siêu Kết Nối Đa Chiều:</h3>
        <ul style="padding-left:18px;line-height:1.8;color:#334155;font-size:15px;">
          <li>Chỉ <strong>10 phút</strong> di chuyển thẳng tới Cảng hàng không quốc tế Nội Bài.</li>
          <li>Chỉ <strong>15 phút</strong> qua cầu Nhật Tân kết nối trung tâm Tây Hồ Tây, KĐT Ngoại Giao Đoàn và Starlake.</li>
          <li>Kết nối trực tiếp vào Trung tâm Hoàn Kiếm và Ba Đình qua tuyến cầu Tứ Liên sắp khởi công.</li>
          <li>Kế cận đường Vành Đai 3, Vành Đai 3.5 và hành lang phát triển công nghệ cao Bắc Thăng Long.</li>
        </ul>
      </div>

      <div style="background:#FDFBF7;border:2px dashed #C59B27;border-radius:16px;padding:30px;">
        <h3 style="font-size:20px;font-weight:700;color:#92400E;margin-bottom:14px;">Đòn Bẩy Quy Hoạch Lên Quận & Thành Phố Phía Bắc:</h3>
        <p style="font-size:14.5px;color:#78350F;line-height:1.6;">
          Theo định hướng Quy hoạch Thủ đô đến năm 2030, tầm nhìn 2050, khu vực Mê Linh – Đông Anh – Sóc Sơn sẽ hình thành <strong>Thành phố phía Bắc Thủ đô</strong> lấy công nghệ cao, dịch vụ thương mại quốc tế và đô thị thông minh làm mũi nhọn. Handico Sunshine New Hà Nội đóng vai trò là "trái tim" đại đô thị biểu tượng của toàn bộ vùng quy hoạch này.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: MẶT BẰNG & SẢN PHẨM -->
<section id="mat-bang-chi-tiet" style="padding:75px 0;background:#F8FAFC;border-top:1px solid #E2E8F0;border-bottom:1px solid #E2E8F0;">
  <div class="kbds-container" style="max-width:1160px;margin:0 auto;padding:0 20px;">
    <div style="text-align:center;max-width:760px;margin:0 auto 40px;">
      <span style="color:#C59B27;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:1px;">QUY HOẠCH PHÂN KHU ĐẲNG CẤP</span>
      <h2 style="font-size:32px;font-weight:800;color:#0B2C4D;margin-top:8px;font-family:'Playfair Display',Georgia,serif;">Cơ Cấu Sản Phẩm Đa Dạng Tại Đại Đô Thị 465ha</h2>
      <p style="font-size:15px;color:#64748B;line-height:1.6;">Mật độ xây dựng chỉ từ 28% – 32%, hơn 50% diện tích là không gian mặt nước hồ cảnh quan, kênh đào sinh thái và công viên xanh.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px;">
      <div style="background:#fff;border-radius:14px;padding:26px;box-shadow:0 4px 15px rgba(0,0,0,0.05);border-top:4px solid #C59B27;">
        <h4 style="font-size:18px;font-weight:800;color:#0B2C4D;margin-bottom:10px;">Căn Hộ Thông Minh 4.0</h4>
        <p style="font-size:14px;color:#64748B;line-height:1.6;">Ứng dụng toàn diện công nghệ AI Smart Living, hệ thống kính Low-E tràn viền và điều hòa âm trần cao cấp.</p>
        <div style="font-size:13px;font-weight:700;color:#C59B27;margin-top:12px;">Diện tích: 48m² – 125m² (1PN – 3PN)</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:26px;box-shadow:0 4px 15px rgba(0,0,0,0.05);border-top:4px solid #0B2C4D;">
        <h4 style="font-size:18px;font-weight:800;color:#0B2C4D;margin-bottom:10px;">Biệt Thự Ven Hồ Sinh Thái</h4>
        <p style="font-size:14px;color:#64748B;line-height:1.6;">Biệt thự đơn lập và song lập view trực diện công viên mặt nước kênh đào, phong cách tân cổ điển quý tộc.</p>
        <div style="font-size:13px;font-weight:700;color:#C59B27;margin-top:12px;">Diện tích: 180m² – 450m²</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:26px;box-shadow:0 4px 15px rgba(0,0,0,0.05);border-top:4px solid #C59B27;">
        <h4 style="font-size:18px;font-weight:800;color:#0B2C4D;margin-bottom:10px;">Shophouse Thương Mại</h4>
        <p style="font-size:14px;color:#64748B;line-height:1.6;">Tọa lạc trên các trục đại lộ huyết mạch nội khu rộng từ 25m – 40m, tối ưu kinh doanh buôn bán và cho thuê sinh lời.</p>
        <div style="font-size:13px;font-weight:700;color:#C59B27;margin-top:12px;">Diện tích: 90m² – 160m²</div>
      </div>

      <div style="background:#fff;border-radius:14px;padding:26px;box-shadow:0 4px 15px rgba(0,0,0,0.05);border-top:4px solid #0B2C4D;">
        <h4 style="font-size:18px;font-weight:800;color:#0B2C4D;margin-bottom:10px;">Tháp Tài Chính Văn Phòng</h4>
        <p style="font-size:14px;color:#64748B;line-height:1.6;">Tổ hợp trung tâm thương mại liên hoàn, khách sạn 5 sao và văn phòng hạng A đón làn sóng doanh nghiệp quốc tế.</p>
        <div style="font-size:13px;font-weight:700;color:#C59B27;margin-top:12px;">Chuẩn văn phòng xanh LEED</div>
      </div>
    </div>

    <div style="text-align:center;margin-top:35px;">
      <a href="https://kenhbatdongsan.vn/mat-bang-handico-sunshine-new-ha-noi/" style="background:#0B2C4D;color:#FBBF24;display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:8px;font-weight:700;text-decoration:none;font-size:14.5px;">
        Xem Phân Tích Chi Tiết Mặt Bằng 1/500 Dự Án Handico Sunshine ➔
      </a>
    </div>
  </div>
</section>

<!-- SECTION 4: FORM ĐĂNG KÝ NHẬN BÁO GIÁ GỐC -->
<section id="dang-ky" style="padding:80px 0;background:linear-gradient(135deg,#071931 0%,#0E2E5C 100%);color:#fff;">
  <div class="kbds-container" style="max-width:850px;margin:0 auto;padding:0 20px;">
    <div style="background:#0F243E;border:2px solid #C59B27;border-radius:20px;padding:45px 35px;text-align:center;">
      <span style="display:inline-block;background:#C59B27;color:#071931;font-weight:800;font-size:12px;padding:5px 14px;border-radius:20px;text-transform:uppercase;margin-bottom:14px;">BẢNG GIÁ ĐỢT 1 & HỒ SƠ QUY HOẠCH</span>
      <h2 style="font-size:28px;font-weight:800;color:#FFFFFF;margin-bottom:12px;font-family:'Playfair Display',Georgia,serif;">ĐĂNG KÝ NHẬN BẢNG GIÁ HANDICO SUNSHINE NEW HÀ NỘI</h2>
      <p style="font-size:15px;color:#CBD5E1;max-width:620px;margin:0 auto 26px;line-height:1.6;">Để lại thông tin chính xác dưới đây để nhận trọn bộ tài liệu quy hoạch 1/500, bản vẽ mặt bằng từng phân khu và bảng giá ưu đãi đợt 1 trực tiếp từ chủ đầu tư.</p>

      [kbds_lead_form title="" project="Handico Sunshine New Hà Nội" button_text="Gửi Yêu Cầu Nhận Báo Giá & Hồ Sơ Quy Hoạch ➔"]
    </div>
  </div>
</section>
HTML;

// Tạo Page: /handico-sunshine-new-ha-noi/
$proj_page = get_page_by_path($proj_slug, OBJECT, 'page');
$proj_page_args = [
    'post_title'   => 'Dự Án Handico Sunshine New Hà Nội (Bắc Thăng Long Urban City 465ha Mê Linh)',
    'post_name'    => $proj_slug,
    'post_content' => $proj_html,
    'post_status'  => 'publish',
    'post_type'    => 'page'
];

if ($proj_page) {
    $proj_page_args['ID'] = $proj_page->ID;
    $proj_page_id = wp_update_post($proj_page_args);
    echo "✔ Đã cập nhật Trang Dự Án (ID: {$proj_page_id}) -> /{$proj_slug}/\n";
} else {
    $proj_page_id = wp_insert_post($proj_page_args);
    echo "✔ Đã tạo mới Trang Dự Án (ID: {$proj_page_id}) -> /{$proj_slug}/\n";
}

update_post_meta($proj_page_id, 'rank_math_title', 'Dự Án Handico Sunshine New Hà Nội | Bắc Thăng Long Urban City 465ha | Kênh Bất Động Sản');
update_post_meta($proj_page_id, 'rank_math_description', 'Thông tin chính thức dự án Handico Sunshine New Hà Nội (Bắc Thăng Long Urban City 465ha): Vị trí cửa ngõ Đông Anh - Mê Linh, quy hoạch 1/500, bảng giá đợt 1.');
update_post_meta($proj_page_id, 'rank_math_focus_keyword', 'Handico Sunshine New Hà Nội, Bắc Thăng Long Urban City, Handico Sunshine Mê Linh');
update_post_meta($proj_page_id, 'rank_math_robots', ['index', 'follow']);


// Tạo CPT du_an: /du-an/handico-sunshine-new-ha-noi/
$proj_cpt = get_page_by_path($proj_slug, OBJECT, 'du_an');
$proj_cpt_args = [
    'post_title'   => $proj_title,
    'post_name'    => $proj_slug,
    'post_content' => $proj_html,
    'post_status'  => 'publish',
    'post_type'    => 'du_an'
];

if ($proj_cpt) {
    $proj_cpt_args['ID'] = $proj_cpt->ID;
    $proj_cpt_id = wp_update_post($proj_cpt_args);
    echo "✔ Đã cập nhật CPT Dự Án (ID: {$proj_cpt_id}) -> /du-an/{$proj_slug}/\n";
} else {
    $proj_cpt_id = wp_insert_post($proj_cpt_args);
    echo "✔ Đã tạo mới CPT Dự Án (ID: {$proj_cpt_id}) -> /du-an/{$proj_slug}/\n";
}

// Gán phân loại taxonomy cho dự án
wp_set_object_terms($proj_cpt_id, ['ha-noi'], 'khu_vuc');
wp_set_object_terms($proj_cpt_id, ['khu-do-thi', 'can-ho-cao-cap', 'biet-thu-nha-pho'], 'loai_hinh_bds');
wp_set_object_terms($proj_cpt_id, ['handico-sunshine-group'], 'chu_dau_tu');

update_post_meta($proj_cpt_id, '_kbds_project_scale', '465,45 ha');
update_post_meta($proj_cpt_id, '_kbds_project_price_from', 'Từ 4x Tr/m²');
update_post_meta($proj_cpt_id, '_kbds_project_legal', 'Sổ hồng lâu dài, 1/500');
update_post_meta($proj_cpt_id, '_kbds_project_developer', 'HANDICO & Sunshine Group');
update_post_meta($proj_cpt_id, 'rank_math_title', 'Dự Án Handico Sunshine New Hà Nội | Bảng Giá & Quy Hoạch 465ha | Kênh Bất Động Sản');
update_post_meta($proj_cpt_id, 'rank_math_description', 'Cập nhật tổng quan dự án Handico Sunshine New Hà Nội (Bắc Thăng Long Urban City 465ha): Chủ đầu tư Handico & Sunshine Group, mặt bằng 1/500, bảng giá 2026.');
update_post_meta($proj_cpt_id, 'rank_math_focus_keyword', 'Handico Sunshine New Hà Nội, Bắc Thăng Long Urban City');
update_post_meta($proj_cpt_id, 'rank_math_robots', ['index', 'follow']);


// -----------------------------------------------------------------------------
// 3. TẠO BÀI VIẾT: /mat-bang-handico-sunshine-new-ha-noi/
// -----------------------------------------------------------------------------
$post_slug = 'mat-bang-handico-sunshine-new-ha-noi';
$post_title = 'Mặt Bằng Dự Án Handico Sunshine New Hà Nội: Chi Tiết Quy Hoạch 465ha & Thiết Kế Căn Hộ, Biệt Thự Thông Minh';

$post_html = <<<HTML
<p>Là một trong những siêu dự án có quy mô lớn nhất từng được công bố tại cửa ngõ phía Bắc Thủ đô, <strong><a href="https://kenhbatdongsan.vn/handico-sunshine-new-ha-noi/">Handico Sunshine New Hà Nội</a></strong> (tên quy hoạch: <strong>Khu đô thị đa mục tiêu Bắc Thăng Long Urban City</strong>) đang tạo nên sức hút mạnh mẽ đối với giới đầu tư bất động sản cả nước. Dự án do liên danh giữa <strong>Tổng công ty HANDICO</strong> và <strong>Tập đoàn Sunshine Group</strong> đầu tư phát triển với tổng quy mô lên tới <strong>465,45 ha</strong> và tổng mức đầu tư gần 100.000 tỷ đồng.</p>

<p>Bài viết dưới đây từ đội ngũ <strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong> sẽ cung cấp phân tích chuyên sâu về quy hoạch tổng thể mặt bằng 1/500 và chi tiết thiết kế các dòng sản phẩm chủ đạo tại đại đô thị thông minh này.</p>

<h2>1. Tổng Quan Quy Hoạch Mặt Bằng 465,45 Hecta</h2>
<p>Mặt bằng tổng thể của dự án Handico Sunshine New Hà Nội được quy hoạch theo mô hình <strong>Đại đô thị thông minh tích hợp sinh thái chuẩn quốc tế ("City within a City")</strong>. Điểm nhấn nổi bật nhất trong đồ án quy hoạch tỷ lệ 1/500 của dự án là cấu trúc không gian mở với tỷ lệ mảng xanh và mặt nước vượt trội:</p>
<ul>
  <li><strong>Mật độ xây dựng:</strong> Toàn dự án duy trì ở mức lý tưởng chỉ từ <strong>28% – 32%</strong>.</li>
  <li><strong>Hơn 50% quỹ đất:</strong> Được dành riêng cho hệ thống công viên cây xanh trung tâm, hồ điều hòa sinh thái, kênh đào cảnh quan uốn lượn và mạng lưới giao thông nội khu đồng bộ.</li>
  <li><strong>Mô hình phát triển định hướng giao thông (TOD):</strong> Các cụm cao tầng và trung tâm thương mại được bố trí kết nối trực tiếp với các trạm dừng xe buýt nhanh và tuyến đường sắt đô thị tương lai.</li>
</ul>

<h2>2. Chi Tiết Các Phân Khu Chức Năng Chính</h2>
<p>Mặt bằng đại đô thị được phân chia khoa học thành 4 phân khu chức năng hoàn chỉnh:</p>

<h3>Phân khu A: Cụm Căn Hộ Cao Tầng Smart Living 4.0</h3>
<p>Bao gồm các tòa tháp chung cư cao cấp cao từ 25 đến 35 tầng bố trí dọc theo các trục đại lộ chính. Thiết kế căn hộ thông minh với diện tích đa dạng:</p>
<ul>
  <li><strong>Căn hộ 1 phòng ngủ (45m² – 54m²):</strong> Lựa chọn tối ưu cho chuyên gia trẻ, kỹ sư công nghệ làm việc tại các khu công nghiệp Bắc Thăng Long hoặc nhà đầu tư khai thác cho thuê.</li>
  <li><strong>Căn hộ 2 phòng ngủ (68m² – 82m²):</strong> Thiết kế vuông vắn, 2 phòng vệ sinh, ban công rộng thoáng đón ánh sáng tự nhiên, phù hợp cho tổ ấm gia đình trẻ.</li>
  <li><strong>Căn hộ 3 phòng ngủ (95m² – 125m²):</strong> Căn góc với tầm nhìn panorama triệu đô hướng trọn hồ nước và kênh đào cảnh quan.</li>
  <li><strong>Căn hộ Penthouse / Duplex:</strong> Không gian sống thượng lưu đỉnh cao với sân vườn trên không độc bản.</li>
</ul>

<h3>Phân khu B: Quần Thể Biệt Thự Sinh Thái Ven Hồ</h3>
<p>Nằm tại trung tâm tĩnh lặng của dự án, bao bọc bởi mặt nước hồ điều hòa và dải công viên sinh thái:</p>
<ul>
  <li><strong>Biệt thự đơn lập (300m² – 450m²):</strong> Kiến trúc tân cổ điển sang trọng, sở hữu 4 mặt thoáng, bến đỗ du thuyền mini hoặc bể bơi riêng biệt từng căn.</li>
  <li><strong>Biệt thự song lập (180m² – 250m²):</strong> Thiết kế 3 tầng 1 tum tối ưu diện tích sinh hoạt gia đình đa thế hệ, kề cận các công viên chủ đề.</li>
</ul>

<h3>Phân khu C: Đại Lộ Shophouse & Nhà Phố Thương Mại</h3>
<p>Tọa lạc ngay mặt tiền các tuyến giao thông đối ngoại và trục xuyên tâm dự án có lộ giới từ 25m đến 40m. Mỗi căn shophouse được thiết kế tối ưu với chiều cao 4 – 5 tầng, mặt tiền rộng 6 – 8m, vừa tiện kinh doanh các ngành hàng cao cấp, mở văn phòng đại diện, vừa làm nơi an cư tiện nghi ở các tầng trên.</p>

<h3>Phân khu D: Tháp Tài Chính – Khách Sạn & Trung Tâm Đổi Mới Sáng Tạo</h3>
<p>Cụm công trình biểu tượng với các tòa tháp văn phòng hạng A đạt chứng chỉ xanh quốc tế LEED, trung tâm tài chính ngân hàng, khách sạn 5 sao quốc tế và chuỗi trung tâm thương mại Mega Mall sầm uất, đóng vai trò là "nam châm" thu hút các tập đoàn đa quốc gia và chuyên gia quốc tế.</p>

<h2>3. Ứng Dụng Công Nghệ 4.0 Trong Quản Lý Vận Hành Mặt Bằng</h2>
<p>Thừa hưởng thế mạnh công nghệ tiên phong từ Sunshine Group, mặt bằng Handico Sunshine New Hà Nội được số hóa toàn diện:</p>
<ul>
  <li><strong>Hệ thống Smart Parking:</strong> Tìm kiếm và dẫn đường đến điểm đỗ xe trống tự động qua ứng dụng di động.</li>
  <li><strong>Camera AI nhận diện khuôn mặt (FaceID):</strong> Kiểm soát an ninh đa tầng từ cổng khu đô thị, sảnh tòa nhà đến thang máy.</li>
  <li><strong>Trạm sạc xe điện thông minh:</strong> Bố trí rộng khắp các bãi đỗ xe công cộng và tầng hầm các tòa nhà.</li>
</ul>

<h2>4. Kết Luận & Đánh Giá Tiềm Năng Đầu Tư</h2>
<p>Với mặt bằng quy hoạch đồng bộ, quy mô tầm cỡ đại đô thị 465ha cùng pháp lý chuẩn mực, Handico Sunshine New Hà Nội không chỉ giải quyết bài toán an cư chất lượng cao cho hàng vạn gia đình mà còn là kênh tích sản sinh lời đột phá đón đầu quy hoạch lên thành phố phía Bắc Thủ đô.</p>

<p>Xem thông tin chi tiết tổng quan dự án và đăng ký nhận bảng giá đợt 1 tại: <strong><a href="https://kenhbatdongsan.vn/handico-sunshine-new-ha-noi/">Dự Án Handico Sunshine New Hà Nội (Bắc Thăng Long Urban City 465ha)</a></strong>.</p>
HTML;

$post_obj = get_page_by_path($post_slug, OBJECT, 'post');
$post_args = [
    'post_title'   => $post_title,
    'post_name'    => $post_slug,
    'post_content' => $post_html,
    'post_status'  => 'publish',
    'post_type'    => 'post',
    'post_category'=> [2] // Review & Phân tích Dự án
];

if ($post_obj) {
    $post_args['ID'] = $post_obj->ID;
    $post_id = wp_update_post($post_args);
    echo "✔ Đã cập nhật Bài Viết (ID: {$post_id}) -> /{$post_slug}/\n";
} else {
    $post_id = wp_insert_post($post_args);
    echo "✔ Đã tạo mới Bài Viết (ID: {$post_id}) -> /{$post_slug}/\n";
}

wp_set_post_tags($post_id, ['handico-sunshine-new-ha-noi', 'bac-thang-long-urban-city', 'sunshine-group', 'handico', 'mat-bang-handico-sunshine']);
update_post_meta($post_id, '_kbds_project_slug', $proj_slug);
update_post_meta($post_id, 'rank_math_title', 'Mặt Bằng Dự Án Handico Sunshine New Hà Nội 465ha Chi Tiết | Kênh Bất Động Sản');
update_post_meta($post_id, 'rank_math_description', 'Phân tích chi tiết mặt bằng quy hoạch 1/500 dự án Handico Sunshine New Hà Nội (Bắc Thăng Long Urban City 465ha): Thiết kế căn hộ thông minh 4.0, biệt thự ven hồ, shophouse.');
update_post_meta($post_id, 'rank_math_focus_keyword', 'mặt bằng Handico Sunshine New Hà Nội, quy hoạch Handico Sunshine Mê Linh');
update_post_meta($post_id, 'rank_math_robots', ['index', 'follow']);

echo "==============================================================\n";
echo "🎉 HOÀN TẤT TẠO 3 MỤC NỘI DUNG XỬ LÝ LỖI 404 TRÊN LOCALHOST!\n";
echo "==============================================================\n";
