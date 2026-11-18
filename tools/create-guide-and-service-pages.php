<?php
/**
 * TẠO & VIẾT LẠI TRỌN BỘ 5 TRANG TRONG MỤC "HƯỚNG DẪN & DỊCH VỤ"
 * 1. Về chúng tôi (/gioi-thieu/)
 * 2. Liên hệ & Văn phòng (/lien-he/)
 * 3. Báo giá và tư vấn dự án (/bao-gia-va-tu-van-du-an/)
 * 4. Cẩm nang đầu tư & Pháp lý (/cam-nang-dau-tu-phap-ly/)
 * 5. Sơ đồ website (/so-do-website/)
 */

require_once dirname(__DIR__) . '/wp-load.php';

echo "====================================================================\n";
echo "🚀 ĐANG VIẾT LẠI 5 TRANG MỤC 'HƯỚNG DẪN & DỊCH VỤ' CHUẨN ĐỈNH CAO...\n";
echo "====================================================================\n";

$common_css = <<<CSS
<style id="kbds-guide-pages-css">
.kbds-guide-wrap {
    max-width: 1060px;
    margin: 0 auto;
    padding: 35px 20px 80px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: #1E293B;
    line-height: 1.8;
    font-size: 15.5px;
}
.kbds-guide-hero {
    background: linear-gradient(135deg, #0B132B 0%, #1C2541 50%, #2A3B5C 100%);
    color: #FFFFFF;
    padding: 55px 24px 45px;
    text-align: center;
    border-radius: 16px;
    margin-bottom: 35px;
    box-shadow: 0 12px 35px rgba(11,19,43,0.15);
    position: relative;
    overflow: hidden;
}
.kbds-guide-hero::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(217,119,6,0.25) 0%, transparent 70%);
    pointer-events: none;
}
.kbds-guide-hero .kbds-hero-pill {
    display: inline-block;
    background: rgba(217,119,6,0.22);
    border: 1px solid rgba(245,158,11,0.55);
    color: #FDE68A;
    padding: 5px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 14px;
}
.kbds-guide-hero h1 {
    font-size: 34px;
    font-weight: 900;
    color: #FFFFFF;
    margin: 0 0 12px;
    line-height: 1.35;
    text-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
.kbds-guide-hero p {
    font-size: 15.5px;
    color: #CBD5E1;
    max-width: 750px;
    margin: 0 auto 16px;
    line-height: 1.65;
}
.kbds-guide-hero .kbds-hero-meta {
    font-size: 12.5px;
    color: #94A3B8;
}
.kbds-guide-body h2 {
    font-size: 23px;
    font-weight: 800;
    color: #0F172A;
    margin: 40px 0 16px;
    padding-bottom: 10px;
    border-bottom: 2px solid #E2E8F0;
    line-height: 1.4;
    display: flex;
    align-items: center;
    gap: 10px;
}
.kbds-guide-body h3 {
    font-size: 18px;
    font-weight: 700;
    color: #1E293B;
    margin: 26px 0 12px;
}
.kbds-guide-body p {
    margin-bottom: 16px;
}
.kbds-guide-body ul, .kbds-guide-body ol {
    margin-bottom: 20px;
    padding-left: 22px;
}
.kbds-guide-body li {
    margin-bottom: 8px;
}
.kbds-callout-box {
    background: #F8FAFC;
    border-left: 4px solid #D97706;
    padding: 18px 22px;
    border-radius: 0 12px 12px 0;
    margin: 24px 0;
    font-size: 14.5px;
    line-height: 1.7;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}
.kbds-feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
    gap: 20px;
    margin: 28px 0;
}
.kbds-feature-card {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 24px 20px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.03);
    transition: transform 0.2s, box-shadow 0.2s;
}
.kbds-feature-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}
.kbds-feature-card h4 {
    margin: 0 0 10px;
    color: #0F172A;
    font-size: 17px;
    font-weight: 700;
}
.kbds-data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 14px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
}
.kbds-data-table th {
    background: #0F172A;
    color: #FFFFFF;
    font-weight: 700;
    padding: 14px 16px;
    text-align: left;
    border: 1px solid #1E293B;
}
.kbds-data-table td {
    padding: 12px 16px;
    border: 1px solid #E2E8F0;
    vertical-align: top;
    background: #FFFFFF;
}
.kbds-data-table tr:nth-child(even) td {
    background: #F8FAFC;
}
.kbds-step-list {
    counter-reset: kbds-counter;
    list-style: none;
    padding: 0;
    margin: 25px 0;
}
.kbds-step-list li {
    counter-increment: kbds-counter;
    position: relative;
    padding-left: 55px;
    margin-bottom: 22px;
}
.kbds-step-list li::before {
    content: counter(kbds-counter);
    position: absolute;
    left: 0;
    top: 2px;
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, #D97706 0%, #B45309 100%);
    color: #FFFFFF;
    font-weight: 800;
    font-size: 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(217,119,6,0.3);
}
.kbds-step-list h4 {
    margin: 0 0 6px;
    font-size: 17px;
    color: #0F172A;
    font-weight: 700;
}
.kbds-sitemap-section {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
}
.kbds-sitemap-section h3 {
    margin: 0 0 16px;
    padding-bottom: 8px;
    border-bottom: 2px solid #F1F5F9;
    color: #0F172A;
    font-size: 18px;
    font-weight: 800;
}
.kbds-sitemap-links {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 12px 20px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.kbds-sitemap-links li {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.kbds-sitemap-links a {
    color: #0F3E6D;
    text-decoration: none;
    font-weight: 600;
    font-size: 14.5px;
    transition: color 0.2s, transform 0.2s;
}
.kbds-sitemap-links a:hover {
    color: #D97706;
    text-decoration: underline;
    transform: translateX(3px);
}
.kbds-cta-highlight {
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
    color: #FFFFFF;
    padding: 35px 25px;
    border-radius: 16px;
    margin: 40px 0 20px;
    text-align: center;
    border: 1px solid #D97706;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}
.kbds-cta-highlight h3 {
    color: #FFFFFF;
    font-size: 23px;
    font-weight: 800;
    margin: 0 0 10px;
}
.kbds-cta-highlight p {
    color: #CBD5E1;
    font-size: 15px;
    max-width: 680px;
    margin: 0 auto 20px;
}
@media (max-width: 768px) {
    .kbds-guide-hero h1 { font-size: 24px; }
    .kbds-guide-wrap { padding: 20px 14px 50px; }
    .kbds-feature-grid { grid-template-columns: 1fr; }
    .kbds-sitemap-links { grid-template-columns: 1fr; }
    .kbds-data-table { font-size: 13px; }
    .kbds-data-table th, .kbds-data-table td { padding: 9px 10px; }
}
</style>
CSS;

$guide_pages = [];

// =========================================================================
// 1. VỀ CHÚNG TÔI (/gioi-thieu/)
// =========================================================================
$guide_pages['gioi-thieu'] = [
    'title'   => 'Về Chúng Tôi | Kênh Bất Động Sản (kenhbatdongsan.vn) - Indochine BĐS',
    'meta_title' => 'Giới Thiệu Kênh Bất Động Sản | Đơn Vị Chủ Quản Indochine BĐS',
    'meta_desc'  => 'Giới thiệu về Kênh Bất Động Sản (kenhbatdongsan.vn): Đơn vị chủ quản Công ty CP BĐS Indochine (MST 0317401603). Đội ngũ chuyên gia thẩm định dữ liệu độc lập chuẩn SEO E-E-A-T.',
    'focus_kw'   => 'về chúng tôi Kênh Bất Động Sản',
    'content'    => $common_css . <<<HTML
<div class="kbds-guide-wrap">
  <div class="kbds-guide-hero">
    <span class="kbds-hero-pill">HỒ SƠ NĂNG LỰC DOANH NGHIỆP & CHUẨN TÍN NHIỆM E-E-A-T</span>
    <h1>VỀ CHÚNG TÔI - KÊNH BẤT ĐỘNG SẢN</h1>
    <p>Cổng dữ liệu dự án chuẩn xác, phân tích chuyên sâu và phân phối bất động sản cao cấp hàng đầu Việt Nam.</p>
    <div class="kbds-hero-meta">Đơn vị chủ quản: CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE (MST: 0317401603)</div>
  </div>

  <div class="kbds-guide-body">
    <div class="kbds-callout-box">
      <strong>Kính chào Quý khách hàng & Quý nhà đầu tư:</strong><br />
      <strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong> được sáng lập bởi Công ty Cổ phần Bất Động Sản Indochine với sứ mệnh tiên phong: Thiết lập chuẩn mực mới về sự <strong>Minh bạch – Trung thực – Chuyên sâu</strong> trong ngành bất động sản Việt Nam. Chúng tôi đồng hành cùng khách hàng từ khâu tra cứu pháp lý, khảo sát thực địa, giải mã thiết kế căn hộ, tính toán dòng tiền cho thuê đến khi nhận bàn giao sổ hồng.
    </div>

    <h2>🏛️ 1. Thông Tin Pháp Lý Đơn Vị Chủ Quản</h2>
    <table class="kbds-data-table">
      <tbody>
        <tr>
          <td style="width:30%;"><strong>Tên doanh nghiệp:</strong></td>
          <td style="width:70%;"><strong>CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE</strong></td>
        </tr>
        <tr>
          <td><strong>Tên thương hiệu nền tảng:</strong></td>
          <td><strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong></td>
        </tr>
        <tr>
          <td><strong>Mã số doanh nghiệp (MST):</strong></td>
          <td><strong>0317401603</strong> do Sở Kế hoạch và Đầu tư TP.HCM cấp ngày 27/07/2022</td>
        </tr>
        <tr>
          <td><strong>Trụ sở chính (TP.HCM):</strong></td>
          <td>Số 45 Thạch Thị Thanh, Phường Tân Định, TP. Hồ Chí Minh, Việt Nam</td>
        </tr>
        <tr>
          <td><strong>Chi nhánh Hà Nội:</strong></td>
          <td>Tầng 2 tòa nhà Capital Elite, Số 18 Phạm Hùng, Phường Mỹ Đình, Nam Từ Liêm, Hà Nội</td>
        </tr>
        <tr>
          <td><strong>Tổng đài tư vấn toàn quốc:</strong></td>
          <td><strong>0942.655.111</strong> (Trực tư vấn & hỗ trợ khách hàng 24/7)</td>
        </tr>
        <tr>
          <td><strong>Email liên hệ chính thức:</strong></td>
          <td><strong>suport@kenhbatdongsan.vn</strong></td>
        </tr>
      </tbody>
    </table>

    <h2>🎯 2. Tầm Nhìn, Sứ Mệnh & 4 Giá Trị Cốt Lõi</h2>
    <div class="kbds-feature-grid">
      <div class="kbds-feature-card">
        <h4>🌟 Tầm Nhìn Đến Năm 2030</h4>
        <p>Trở thành cổng dữ liệu quy hoạch, phân tích dự án và hệ thống giỏ hàng bất động sản xác thực số 1 Việt Nam, là địa chỉ tin cậy hàng đầu cho người mua nhà ở thực và giới đầu tư tài chính.</p>
      </div>
      <div class="kbds-feature-card">
        <h4>🚀 Sứ Mệnh Vì Khách Hàng</h4>
        <p>Bảo vệ an toàn tối đa cho dòng vốn tích lũy của khách hàng bằng cách thẩm định pháp lý khắt khe, chỉ phân phối dự án của các Chủ đầu tư có tiềm lực và uy tín bàn giao thực tế.</p>
      </div>
      <div class="kbds-feature-card">
        <h4>💎 Giá Trị Cốt Lõi</h4>
        <p><strong>Minh Bạch</strong> trong mọi thông số – <strong>Khách Quan</strong> trong mọi nhận định – <strong>Chuyên Sâu</strong> trong từng phân tích – <strong>Tận Tâm</strong> trong mọi bước tư vấn.</p>
      </div>
    </div>

    <h2>🏆 3. Khung Năng Lực E-E-A-T Theo Tiêu Chuẩn Google</h2>
    <p>Kênh Bất Động Sản tự hào đáp ứng toàn diện tiêu chuẩn khắt khe nhất của Google về tính chuyên môn và độ tin cậy trong lĩnh vực tài sản có giá trị cao (YMYL):</p>
    <ul>
      <li><strong>Experience (Kinh nghiệm thực chiến >10 năm):</strong> Trải qua nhiều chu kỳ thăng trầm của thị trường, đội ngũ chuyên gia của chúng tôi đã trực tiếp đồng hành cùng hơn 5.000 khách hàng hoàn tất giao dịch an toàn tại Hà Nội, TP.HCM, Nha Trang, Đà Nẵng, Bình Dương.</li>
      <li><strong>Expertise (Chuyên môn sâu sắc):</strong> Hội đồng cố vấn bao gồm các luật sư chuyên ngành BĐS, kiến trúc sư quy hoạch và chuyên viên phân tích tài chính ngân hàng; trực tiếp bóc tách mặt bằng, kiểm tra hồ sơ đất đai và cấu trúc dòng tiền cho từng căn hộ.</li>
      <li><strong>Authoritativeness (Thẩm quyền phân phối F1):</strong> Là đại lý chiến lược F1 của các Chủ đầu tư và Tập đoàn phát triển hàng đầu: WTO (Hinode), Vinhomes, Masterise Homes, Nam Long, Sun Group, Ecopark, Tokyu Land...</li>
      <li><strong>Trustworthiness (Độ tin cậy tuyệt đối):</strong> 100% dữ liệu giỏ hàng và bảng giá gốc niêm yết trên website được xác thực từ Chủ đầu tư; cam kết không đăng giá ảo, không dùng chiêu trò cắt lỗ giả để câu view.</li>
    </ul>

    <h2>💼 4. Các Dịch Vụ Chủ Lực Của Chúng Tôi</h2>
    <ol>
      <li><strong>Phân phối F1 Dự án Căn hộ & Biệt thự Cao cấp:</strong> Cung cấp suất ngoại giao, quỹ căn tầng đẹp giá gốc với chính sách chiết khấu tốt nhất từ Chủ đầu tư.</li>
      <li><strong>Giỏ hàng Chuyển nhượng Xác thực (Verified Listings):</strong> Sàn lọc các căn hộ, nhà phố cắt lỗ thực sự hoặc giá tốt từ chủ nhà gửi bán độc quyền.</li>
      <li><strong>Tư vấn Pháp lý & Cấu trúc Tài chính:</strong> Hỗ trợ khách hàng phân tích bài toán vay ngân hàng tối ưu dòng tiền, thẩm định rủi ro hợp đồng và thủ tục sang tên sổ hồng.</li>
      <li><strong>Báo cáo Nghiên cứu Thị trường & Bản đồ Quy hoạch:</strong> Cung cấp miễn phí các bản tin phân tích độc lập 24/7 giúp nhà đầu tư đưa ra quyết định sáng suốt.</li>
    </ol>

    <div class="kbds-cta-highlight">
      <h3>SẴN SÀNG KẾT NỐI CÙNG ĐỘI NGŨ CHUYÊN GIA BĐS INDOCHINE?</h3>
      <p>Hãy để chúng tôi giúp bạn thẩm định pháp lý, chọn căn tầng đẹp và nhận trọn bộ bảng giá gốc từ Chủ đầu tư ngay hôm nay.</p>
      <div style="display:flex;justify-content:center;gap:15px;flex-wrap:wrap;">
        <a href="tel:0942655111" style="background:#F59E0B;color:#0F172A;font-weight:800;padding:12px 26px;border-radius:24px;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">📞 Hotline 24/7: 0942.655.111</a>
        <a href="/lien-he/" style="background:rgba(255,255,255,0.15);color:#FFF;font-weight:700;padding:12px 26px;border-radius:24px;text-decoration:none;border:1px solid rgba(255,255,255,0.3);">🏢 Ghé thăm văn phòng ➔</a>
      </div>
    </div>
  </div>
</div>
HTML
];

// =========================================================================
// 2. LIÊN HỆ & VĂN PHÒNG (/lien-he/)
// =========================================================================
$guide_pages['lien-he'] = [
    'title'   => 'Liên Hệ Với Kênh Bất Động Sản | Hotline 0942.655.111 - Hỗ Trợ 24/7',
    'meta_title' => 'Liên Hệ Kênh Bất Động Sản | Hotline 0942.655.111 - Trụ Sở HN & HCM',
    'meta_desc'  => 'Liên hệ Kênh Bất Động Sản (kenhbatdongsan.vn): Trụ sở TP.HCM (45 Thạch Thị Thanh) & Văn phòng Hà Nội (Capital Elite 18 Phạm Hùng). Hotline 24/7: 0942.655.111.',
    'focus_kw'   => 'liên hệ Kênh Bất Động Sản',
    'content'    => $common_css . <<<HTML
<div class="kbds-guide-wrap">
  <div class="kbds-guide-hero">
    <span class="kbds-hero-pill">KẾT NỐI TRỰC TIẾP VỚI ĐỘI NGŨ CHUYÊN GIA BĐS TOÀN QUỐC</span>
    <h1>LIÊN HỆ & HỆ THỐNG VĂN PHÒNG</h1>
    <p>Chúng tôi luôn sẵn sàng lắng nghe, tư vấn tận tâm và giải đáp mọi thắc mắc của Quý khách hàng 24/7.</p>
    <div class="kbds-hero-meta">Đơn vị chủ quản: CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE (MST: 0317401603)</div>
  </div>

  <div class="kbds-guide-body">
    <div class="kbds-feature-grid">
      <div class="kbds-feature-card" style="border-top:4px solid #2563EB;">
        <h4>🏛️ Văn Phòng Giao Dịch Hà Nội</h4>
        <p><strong>Địa chỉ:</strong> Tầng 2 tòa nhà Capital Elite, Số 18 Phạm Hùng, Phường Mỹ Đình, Nam Từ Liêm, Hà Nội.</p>
        <p><strong>Hotline tư vấn:</strong> <a href="tel:0942655111" style="color:#2563EB;font-weight:700;font-size:16px;">0942.655.111</a></p>
        <p><strong>Thời gian mở cửa:</strong> 8:00 – 20:00 (Thứ 2 – Chủ Nhật, trực Hotline 24/7)</p>
      </div>

      <div class="kbds-feature-card" style="border-top:4px solid #D97706;">
        <h4>🏛️ Trụ Sở Chính Tại TP.HCM</h4>
        <p><strong>Địa chỉ:</strong> Số 45 Thạch Thị Thanh, Phường Tân Định, TP. Hồ Chí Minh, Việt Nam.</p>
        <p><strong>Hotline giao dịch:</strong> <a href="tel:0942655111" style="color:#D97706;font-weight:700;font-size:16px;">0942.655.111</a></p>
        <p><strong>Thời gian mở cửa:</strong> 8:00 – 18:00 (Thứ 2 – Thứ 7)</p>
      </div>

      <div class="kbds-feature-card" style="border-top:4px solid #10B981;">
        <h4>✉ Kênh Hỗ Trợ Trực Tuyến</h4>
        <p><strong>Hòm thư CSKH:</strong> <a href="mailto:suport@kenhbatdongsan.vn" style="color:#0F172A;font-weight:700;">suport@kenhbatdongsan.vn</a></p>
        <p><strong>Zalo OA Chính Thức:</strong> <a href="https://zalo.me/0942655111" target="_blank" style="color:#10B981;font-weight:700;">Nhắn tin tư vấn qua Zalo</a></p>
        <p><strong>Website:</strong> <a href="https://kenhbatdongsan.vn" style="color:#0F172A;font-weight:700;">kenhbatdongsan.vn</a></p>
      </div>
    </div>

    <h2>📝 Gửi Yêu Cầu Tư Vấn / Đặt Lịch Xem Nhà Mẫu</h2>
    <p>Quý khách vui lòng để lại thông tin theo biểu mẫu bên dưới. Chuyên viên phụ trách dự án của Kênh Bất Động Sản sẽ liên hệ gửi tài liệu PDF và hỗ trợ Quý khách trong vòng <strong>3 phút</strong> làm việc:</p>

    <div style="background:#0F172A;border-radius:14px;padding:25px;margin:25px 0;">
      [kbds_lead_form title="📥 Gửi Yêu Cầu Tư Vấn Dự Án & Đặt Lịch Tham Quan Thực Tế" project="Trang Liên Hệ - kenhbatdongsan.vn" button_text="GỬI YÊU CẦU CHO CHÚNG TÔI ➔"]
    </div>

    <h2>🗺️ Bản Đồ Vị Trí Trụ Sở & Văn Phòng Giao Dịch</h2>
    <div class="kbds-feature-grid">
      <div>
        <h4 style="margin:0 0 10px;color:#0F172A;font-size:16px;">📍 Văn Phòng Hà Nội (Capital Elite 18 Phạm Hùng)</h4>
        <div style="border-radius:12px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.113264627471!2d105.77665797596956!3d21.028154187799533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b38d3844f9%3A0xe5416f212239f8d5!2zMTggUGjhuqFtIEjDuW5nLCBN4bu5IMSQw6xuaCwgTmFtIFThu6sgTGnDqm0sIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1716000000000!5m2!1svi!2s" width="100%" height="320" style="border:0;display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <div>
        <h4 style="margin:0 0 10px;color:#0F172A;font-size:16px;">📍 Trụ Sở TP.HCM (45 Thạch Thị Thanh, Tân Định)</h4>
        <div style="border-radius:12px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.08);border:1px solid #E2E8F0;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.297424687928!2d106.69080537573626!3d10.78851725896939!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f337f71f9f5%3A0x6b4ef84a7e93dc72!2zNDUgVGjhuqFjaCBUaOG7iyBUaGFuaCwgVMOibiDEkOG7i25oLCBRdeG6rW4gMSwgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1716000000000!5m2!1svi!2s" width="100%" height="320" style="border:0;display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
HTML
];

// =========================================================================
// 3. BÁO GIÁ VÀ TƯ VẤN DỰ ÁN (/bao-gia-va-tu-van-du-an/)
// =========================================================================
$guide_pages['bao-gia-va-tu-van-du-an'] = [
    'title'   => 'Báo Giá Và Tư Vấn Dự Án Bất Động Sản | Kênh Bất Động Sản (kenhbatdongsan.vn)',
    'meta_title' => 'Báo Giá Và Tư Vấn Dự Án BĐS Trực Tiếp Từ CĐT | Kênh Bất Động Sản',
    'meta_desc'  => 'Nhận trọn bộ bảng giá gốc đợt 1, chính sách chiết khấu thanh toán sớm và tư vấn pháp lý dự án BĐS cao cấp tại Hà Nội, TP.HCM, Nha Trang từ chuyên gia Indochine BĐS.',
    'focus_kw'   => 'báo giá và tư vấn dự án',
    'content'    => $common_css . <<<HTML
<div class="kbds-guide-wrap">
  <div class="kbds-guide-hero">
    <span class="kbds-hero-pill">CỔNG TIẾP NHẬN YÊU CẦU BÁO GIÁ GỐC TRỰC TIẾP TỪ CHỦ ĐẦU TƯ</span>
    <h1>BÁO GIÁ VÀ TƯ VẤN DỰ ÁN BẤT ĐỘNG SẢN</h1>
    <p>Cung cấp trọn bộ tài liệu thiết kế CAD/PDF, bảng giá đợt 1, bài toán phân tích dòng tiền và chính sách ưu đãi tài chính tốt nhất.</p>
    <div class="kbds-hero-meta">Bảo mật thông tin 100% theo tiêu chuẩn an toàn dữ liệu khách hàng</div>
  </div>

  <div class="kbds-guide-body">
    <div class="kbds-callout-box">
      <strong>Quyền lợi đặc quyền khi nhận bảng giá qua Kênh Bất Động Sản:</strong><br />
      Thay vì phải liên hệ qua nhiều nguồn tin môi giới tự do không rõ ràng, khi đăng ký nhận thông tin tại <strong>kenhbatdongsan.vn</strong>, Quý khách được kết nối trực tiếp với Giám đốc dự án và nhận bộ tài liệu chuẩn xác 100% được Chủ đầu tư phê duyệt chính thức.
    </div>

    <h2>🎁 1. Trọn Bộ Tài Liệu Quý Khách Sẽ Nhận Được</h2>
    <div class="kbds-feature-grid">
      <div class="kbds-feature-card">
        <h4>📄 1. Bảng Giá Gốc Đợt 1</h4>
        <p>Bảng giá chi tiết từng mã căn, tầng đẹp, hướng view, đơn giá tim tường & thông thủy chính thức từ Chủ đầu tư (không chênh, không phụ phí).</p>
      </div>
      <div class="kbds-feature-card">
        <h4>📐 2. File Bản Vẽ Thiết Kế Nét Cao</h4>
        <p>Bộ sơ đồ mặt bằng quy hoạch tổng thể 1/500, mặt bằng tầng điển hình và layout chi tiết từng phòng (kích thước chuẩn milimet).</p>
      </div>
      <div class="kbds-feature-card">
        <h4>💰 3. Bảng Tính Dòng Tiền & Vốn Vay</h4>
        <p>File Excel/PDF tính toán số tiền đóng từng đợt theo tiến độ, mức chiết khấu khi thanh toán sớm (8% - 12%) và lịch trả nợ ngân hàng lãi suất 0%.</p>
      </div>
      <div class="kbds-feature-card">
        <h4>⚖️ 4. Hồ Sơ Pháp Lý Đầy Đủ</h4>
        <p>Bản scan Giấy phép xây dựng, quy hoạch 1/500, biên bản nghiệm thu móng và Hợp đồng mua bán mẫu để Quý khách kiểm tra trước khi đặt cọc.</p>
      </div>
    </div>

    <h2>📊 2. Bảng Tổng Hợp Mức Giá & Chính Sách Các Dự Án Tâm Điểm (Năm 2026)</h2>
    <table class="kbds-data-table">
      <thead>
        <tr>
          <th>Tên Dự Án</th>
          <th>Vị Trí Tọa Độ</th>
          <th>Loại Hình Sản Phẩm</th>
          <th>Mức Giá Tham Khảo</th>
          <th>Chính Sách Nổi Bật</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>Hinode Solera</strong></td>
          <td>Số 28 Phạm Hùng, Mỹ Đình, Hà Nội</td>
          <td>Căn 1PN, 2PN, 3PN &amp; Dual Key (88.5m² - 159.4m²)</td>
          <td>Liên hệ nhận bảng giá đợt 1</td>
          <td>HTLS 0% đến khi nhận nhà, chiết khấu thanh toán sớm 10%</td>
        </tr>
        <tr>
          <td><strong>Monrei Saigon</strong></td>
          <td>Cửa ngõ Thuận An – Liền kề TP.HCM</td>
          <td>Căn hộ khoáng nóng Onsen chuẩn Nhật Bản</td>
          <td>Liên hệ nhận quỹ căn độc quyền</td>
          <td>Gói quà tặng nội thất cao cấp Mitsubishi, trả chậm 2 năm 0% lãi</td>
        </tr>
        <tr>
          <td><strong>La Tiên Villa</strong></td>
          <td>Libera Bãi Tiên, Vịnh Nha Trang</td>
          <td>Biệt thự biển triệu đô, Shophouse phố biển</td>
          <td>Bảng giá gốc CĐT đợt 1</td>
          <td>Cam kết chia sẻ doanh thu vận hành, tặng đêm nghỉ dưỡng 5 sao</td>
        </tr>
        <tr>
          <td><strong>Jade Square</strong></td>
          <td>Khu đô thị Bắc Từ Liêm, Tây Hồ Tây, Hà Nội</td>
          <td>Căn hộ cao cấp 2PN – 4PN, Shophouse</td>
          <td>Mức giá F1 đợt mở bán mới</td>
          <td>Thanh toán 20% ký HĐMB, ngân hàng giải ngân 70% ân hạn nợ gốc</td>
        </tr>
        <tr>
          <td><strong>The Global City</strong></td>
          <td>Phường An Phú, TP. Thủ Đức, TP.HCM</td>
          <td>Nhà phố Soho, Căn hộ hạng sang Masterise</td>
          <td>Quỹ căn chuyển nhượng &amp; mở bán mới</td>
          <td>Chính sách đặc quyền cư dân trung tâm mới của TP.HCM</td>
        </tr>
      </tbody>
    </table>

    <h2>⚡ 3. Quy Trình 4 Bước Tư Vấn Chuẩn Mực Tại Kênh Bất Động Sản</h2>
    <ol class="kbds-step-list">
      <li>
        <h4>Tiếp nhận nhu cầu & Sàng lọc quỹ căn</h4>
        <p>Quý khách để lại thông tin hoặc gọi Hotline 0942.655.111. Chuyên viên sẽ lắng nghe khoảng tài chính, tiêu chí chọn căn (tầng, hướng, diện tích) để lọc ra 3 phương án tối ưu nhất.</p>
      </li>
      <li>
        <h4>Gửi trọn bộ tài liệu nét cao qua Zalo / Email (Trong 3 phút)</h4>
        <p>Hệ thống tự động gửi file PDF mặt bằng, bảng giá chi tiết và bảng tính lãi vay ngân hàng trực tiếp vào số điện thoại hoặc Zalo của Quý khách.</p>
      </li>
      <li>
        <h4>Đón tiếp tham quan thực tế sa bàn & Nhà mẫu</h4>
        <p>Hỗ trợ xe đưa đón tận nơi (nếu Quý khách yêu cầu), hướng dẫn xem thực tế tiến độ thi công, căn hộ mẫu và trải nghiệm hệ thống tiện ích dịch vụ.</p>
      </li>
      <li>
        <h4>Hỗ trợ thủ tục đặt cọc, thẩm định hồ sơ vay & Ký HĐMB</h4>
        <p>Đồng hành cùng Quý khách trong quá trình rà soát hợp đồng mua bán, nộp hồ sơ ngân hàng và làm thủ tục nhận bàn giao nhà an toàn pháp lý.</p>
      </li>
    </ol>

    <h2>📥 Đăng Ký Nhận Bảng Giá Gốc & Tài Liệu Thiết Kế</h2>
    <div style="background:#0F172A;border-radius:14px;padding:25px;margin:25px 0;">
      [kbds_lead_form title="📥 Đăng Ký Nhận Bảng Giá Gốc Đợt 1 & Bảng Phân Tích Dòng Tiền Dự Án" project="Báo Giá & Tư Vấn Dự Án - kenhbatdongsan.vn" button_text="GỬI BẢNG GIÁ QUA ZALO CHO TÔI ➔"]
    </div>

    <div class="kbds-callout-box" style="border-left-color:#10B981;">
      🔒 <strong>CAM KẾT 3 KHÔNG TỪ INDOCHINE BĐS:</strong><br />
      1. <strong>Không spam cuộc gọi:</strong> Chỉ liên hệ đúng dự án và thời điểm Quý khách yêu cầu.<br />
      2. <strong>Không thu phí dịch vụ:</strong> Toàn bộ quá trình tư vấn và cung cấp tài liệu là hoàn toàn miễn phí 100%.<br />
      3. <strong>Không bán dữ liệu:</strong> Thông tin của Quý khách được bảo vệ nghiêm ngặt theo <a href="/chinh-sach-bao-mat/" style="color:#D97706;font-weight:700;">Chính sách bảo mật</a> của chúng tôi.
    </div>
  </div>
</div>
HTML
];

// =========================================================================
// 4. CẨM NANG ĐẦU TƯ & PHÁP LÝ (/cam-nang-dau-tu-phap-ly/)
// =========================================================================
$guide_pages['cam-nang-dau-tu-phap-ly'] = [
    'title'   => 'Cẩm Nang Đầu Tư & Pháp Lý Bất Động Sản | Kênh Bất Động Sản (kenhbatdongsan.vn)',
    'meta_title' => 'Cẩm Nang Đầu Tư & Thẩm Định Pháp Lý Dự Án BĐS Năm 2026',
    'meta_desc'  => 'Cẩm nang toàn diện về kiểm tra pháp lý dự án hình thành trong tương lai, quy trình sang tên sổ hồng, bí quyết chọn căn đẹp và bài toán dòng tiền đầu tư BĐS.',
    'focus_kw'   => 'cẩm nang đầu tư pháp lý bất động sản',
    'content'    => $common_css . <<<HTML
<div class="kbds-guide-wrap">
  <div class="kbds-guide-hero">
    <span class="kbds-hero-pill">CẨM NANG TOÀN TẬP DÀNH CHO NGƯỜI MUA NHÀ Ở THỰC & NHÀ ĐẦU TƯ</span>
    <h1>CẨM NANG ĐẦU TƯ & PHÁP LÝ BẤT ĐỘNG SẢN</h1>
    <p>Hệ thống hóa kiến thức thẩm định pháp lý, kiểm soát rủi ro dòng tiền và cẩm nang lựa chọn dự án an toàn theo Luật Đất đai & Luật Kinh doanh BĐS mới nhất.</p>
    <div class="kbds-hero-meta">Biên soạn độc quyền bởi Hội Đồng Chuyên Gia Pháp Lý & Thẩm Định Giá Indochine BĐS</div>
  </div>

  <div class="kbds-guide-body">
    <div class="kbds-callout-box">
      <strong>Lời khuyên từ Chuyên gia:</strong><br />
      Bất động sản là tài sản tích lũy lớn nhất trong đời của đại đa số người dân. Khi bước vào thị trường, <strong>"Pháp lý là tấm khiên bảo vệ tài sản, còn Dòng tiền là động cơ sinh lời bền vững"</strong>. Cẩm nang này được xây dựng nhằm cung cấp cho Quý vị bộ công cụ kiểm tra thực tế, tránh các cạm bẫy dự án ma và đưa ra quyết định đầu tư an toàn tuyệt đối.
    </div>

    <h2>📜 PHẦN 1: 5 Giấy Tờ Pháp Lý Bắt Buộc Phải Kiểm Tra Trước Khi Xuống Tiền</h2>
    <p>Đối với bất kỳ dự án nhà ở hình thành trong tương lai nào, Quý khách tuyệt đối không xuống tiền đặt cọc nếu Chủ đầu tư chưa xuất trình được đủ 5 loại giấy tờ sau:</p>

    <div class="kbds-feature-grid">
      <div class="kbds-feature-card">
        <h4>1. Quyết Định Phê Duyệt 1/500</h4>
        <p>Bản vẽ quy hoạch chi tiết 1/500 được UBND quận/huyện hoặc tỉnh/thành phố phê duyệt. Xác định rõ ranh giới đất, mật độ xây dựng, chiều cao tầng và chức năng từng phân khu.</p>
      </div>

      <div class="kbds-feature-card">
        <h4>2. Sổ Đỏ Dự Án & Biên Lai Thuế Đất</h4>
        <p>Giấy chứng nhận quyền sử dụng đất của toàn bộ khu đất dự án mang tên Chủ đầu tư, kèm biên lai xác nhận đã hoàn thành 100% nghĩa vụ tài chính về tiền sử dụng đất cho nhà nước.</p>
      </div>

      <div class="kbds-feature-card">
        <h4>3. Giấy Phép Xây Dựng (GPXD)</h4>
        <p>Do Sở Xây dựng cấp phép, cho phép xây dựng phần thân hoặc toàn bộ công trình. Kiểm tra kỹ số tầng được cấp phép có khớp với thiết kế bán hàng hay không.</p>
      </div>

      <div class="kbds-feature-card">
        <h4>4. Biên Bản Nghiệm Thu Móng</h4>
        <p>Văn bản pháp lý chứng nhận công trình đã thi công xong toàn bộ phần đài móng và hầm theo đúng thiết kế đã duyệt. Đây là điều kiện tiên quyết để ký Hợp đồng mua bán hợp pháp.</p>
      </div>
    </div>

    <div class="kbds-callout-box" style="border-left-color:#DC2626;">
      ⚠️ <strong>ĐẶC BIỆT LƯU Ý - GIẤY TỜ THỨ 5:</strong><br />
      <strong>Văn bản thông báo đủ điều kiện bán nhà ở hình thành trong tương lai</strong> do Sở Xây dựng địa phương ban hành, kèm theo <strong>Chứng thư bảo lãnh ngân hàng</strong>. Nếu dự án chưa có văn bản này, mọi hình thức ký HĐMB hoặc thu tiền vượt quá 5% giá trị căn hộ đều là trái quy định của Luật Kinh doanh BĐS.
    </div>

    <h2>💡 PHẦN 2: Cẩm Nang Chọn Căn Hộ Đẹp & Tối Ưu Hóa Dòng Tiền</h2>
    <h3>1. Nguyên tắc chọn căn tầng đẹp, thanh khoản cao:</h3>
    <ul>
      <li><strong>Khoảng tầng vàng:</strong> Tầng 8 đến tầng 22 là khoảng tầng lý tưởng nhất ở chung cư cao tầng: không khí trong lành, hạn chế tiếng ồn từ mặt đường, tránh khói bụi và có tầm nhìn thoáng đãng.</li>
      <li><strong>Hướng ban công:</strong> Ban công Đông Nam, Nam đón gió mát mùa hè và ấm áp mùa đông. Với ban công hướng Tây, cần kiểm tra xem căn hộ có hệ lam che nắng hoặc kính Low-E cản nhiệt hay không.</li>
      <li><strong>Bố cục mặt bằng:</strong> Ưu tiên căn hộ vuông vức, mọi phòng ngủ và phòng khách đều có cửa sổ tiếp xúc trực tiếp với ánh sáng tự nhiên (xẻ khe hoặc ban công trải dài).</li>
    </ul>

    <h3>2. Đột phá mô hình Căn hộ Dual Key (1+1 &amp; 2+1):</h3>
    <p>Dòng căn hộ "2 chìa khóa" có 1 cửa chính đi vào nhưng bên trong tách biệt thành 2 không gian sống hoàn chỉnh với bếp và WC riêng biệt:</p>
    <ul>
      <li><strong>Vừa ở vừa cho thuê:</strong> Gia đình ở một bên, bên còn lại cho chuyên gia nước ngoài hoặc người độc thân thuê, thu về dòng tiền đều đặn hàng tháng để trả lãi ngân hàng.</li>
      <li><strong>Đa thế hệ sống chung nhưng riêng tư:</strong> Bố mẹ lớn tuổi sống một bên, vợ chồng trẻ ở một bên; vừa gần gũi chăm sóc con cháu vừa đảm bảo không gian riêng tư tuyệt đối.</li>
    </ul>

    <h2>💳 PHẦN 3: Bẫy Đòn Bẩy Tài Chính & Quy Tắc Vay Vốn An Toàn</h2>
    <p>Khi sử dụng đòn bẩy ngân hàng mua bất động sản, nhà đầu tư thông thái cần tuân thủ nghiêm ngặt 3 quy tắc vàng sau:</p>
    <ol>
      <li><strong>Quy tắc vốn tự có tối thiểu 30% - 50%:</strong> Tuyệt đối không vay 70% - 80% nếu thu nhập hàng tháng không ổn định và không có nguồn quỹ dự phòng khẩn cấp cho ít nhất 6 tháng.</li>
      <li><strong>Quy tắc chi trả nợ không quá 40% thu nhập:</strong> Tổng số tiền trả cả gốc và lãi ngân hàng hàng tháng không được vượt quá 40% tổng thu nhập ròng của gia đình.</li>
      <li><strong>Tính toán trước kịch bản hết ưu đãi lãi suất:</strong> Các gói hỗ trợ lãi suất 0% thường chỉ kéo dài 18 - 24 tháng. Cần dự trù mức lãi suất thả nổi sau ưu đãi (thường là Lãi suất cơ sở + Biên độ 3.5% - 4.5% = khoảng 10.5% - 12%/năm) để không bị rơi vào bẫy áp lực trả nợ.</li>
    </ol>

    <h2>📚 PHẦN 4: Các Bài Viết Phân Tích & Cẩm Nang Tiêu Biểu</h2>
    <div class="kbds-feature-grid">
      <div class="kbds-feature-card">
        <h4><a href="/5-giay-to-phap-ly-bat-buoc-phai-kiem-tra-truoc-khi-mua-du-an-hinh-thanh-trong-tuong-lai/" style="color:#0F172A;text-decoration:none;">📑 5 Giấy Tờ Pháp Lý Bắt Buộc Trước Khi Mua Nhà ➔</a></h4>
        <p>Chi tiết cách nhận biết sổ đỏ thật/giả, kiểm tra quy hoạch 1/500 và thẩm định uy tín chủ đầu tư.</p>
      </div>
      <div class="kbds-feature-card">
        <h4><a href="/cap-nhat-bang-lai-suat-vay-mua-nha-ngan-hang-moi-nhat-kinh-nghiem-chon-goi-vay/" style="color:#0F172A;text-decoration:none;">💰 Cập Nhật Bảng Lãi Suất Vay Mua Nhà Ngân Hàng ➔</a></h4>
        <p>So sánh gói vay Big 4 ngân hàng nhà nước và ngân hàng thương mại, kinh nghiệm đàm phán phí trả nợ trước hạn.</p>
      </div>
      <div class="kbds-feature-card">
        <h4><a href="/dot-pha-thiet-ke-can-ho-dual-key-hinode-solera-pham-hung/" style="color:#0F172A;text-decoration:none;">🔑 Giải Pháp Thiết Kế Căn Hộ Dual Key Sinh Lời Kép ➔</a></h4>
        <p>Mô hình tối ưu dòng tiền cho thuê đạt tỷ suất 8% - 10%/năm tại trung tâm Mỹ Đình - Cầu Giấy.</p>
      </div>
    </div>

    <div class="kbds-cta-highlight">
      <h3>BẠN CẦN THẨM ĐỊNH PHÁP LÝ MỘT DỰ ÁN CỤ THỂ?</h3>
      <p>Gửi ngay thông tin dự án bạn đang quan tâm để được đội ngũ chuyên viên pháp chế Indochine BĐS kiểm tra hồ sơ quy hoạch hoàn toàn miễn phí.</p>
      <a href="tel:0942655111" style="background:#F59E0B;color:#0F172A;font-weight:800;padding:12px 28px;border-radius:24px;text-decoration:none;display:inline-block;">📞 Gọi Tư Vấn Pháp Lý 24/7: 0942.655.111</a>
    </div>
  </div>
</div>
HTML
];

// =========================================================================
// 5. SƠ ĐỒ WEBSITE / SITEMAP HTML (/so-do-website/)
// =========================================================================
$guide_pages['so-do-website'] = [
    'title'   => 'Sơ Đồ Website (HTML Sitemap) | Kênh Bất Động Sản (kenhbatdongsan.vn)',
    'meta_title' => 'Sơ Đồ Website Kênh Bất Động Sản | Toàn Bộ Cấu Trúc Trang & Dự Án',
    'meta_desc'  => 'Sơ đồ cấu trúc toàn bộ website kenhbatdongsan.vn: Danh mục dự án trọng điểm, giỏ hàng xác thực, cẩm nang đầu tư, chính sách pháp lý và công cụ tài chính.',
    'focus_kw'   => 'sơ đồ website Kênh Bất Động Sản',
    'content'    => $common_css . <<<HTML
<div class="kbds-guide-wrap">
  <div class="kbds-guide-hero">
    <span class="kbds-hero-pill">SƠ ĐỒ ĐIỀU HƯỚNG CẤU TRÚC TOÀN BỘ WEBSITE</span>
    <h1>SƠ ĐỒ WEBSITE (HTML SITEMAP)</h1>
    <p>Tra cứu nhanh chóng toàn bộ danh mục dự án trọng điểm, giỏ hàng độc quyền, bài viết phân tích chuyên sâu và các văn bản pháp lý trên hệ thống.</p>
    <div class="kbds-hero-meta">Cập nhật tự động liên tục • Dành cho Người dùng & Công cụ tìm kiếm</div>
  </div>

  <div class="kbds-guide-body">
    <!-- KHỐI 1: HỆ THỐNG DỰ ÁN BẤT ĐỘNG SẢN TRỌNG ĐIỂM -->
    <div class="kbds-sitemap-section">
      <h3>🏛️ 1. Hệ Thống Dự Án Bất Động Sản Trọng Điểm</h3>
      <ul class="kbds-sitemap-links">
        <li><span>🏢</span> <a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng (Hinode Suite 28 Phạm Hùng, Hà Nội)</a></li>
        <li><span>🏢</span> <a href="/du-an/jade-square-bac-tu-liem/">Chung Cư Jade Square Bắc Từ Liêm (Tây Hồ Tây, Hà Nội)</a></li>
        <li><span>🏢</span> <a href="/du-an/lalalay-residences/">Lalalay Residences (Bắc An Khánh, Hoài Đức, Hà Nội)</a></li>
        <li><span>⛳</span> <a href="/du-an/vinhomes-king-park-bac-ninh/">Vinhomes King Park Bắc Ninh (Sân Golf 90ha &amp; Hồ 101ha)</a></li>
        <li><span>♨️</span> <a href="/du-an/monrei-saigon/">Căn Hộ Khoáng Nóng Onsen Monrei Saigon (Bình Dương - TP.HCM)</a></li>
        <li><span>🏖️</span> <a href="/du-an/la-tien-villa-nha-trang/">Biệt Thự Biển La Tiên Villa Nha Trang (Libera Bãi Tiên)</a></li>
        <li><span>🏙️</span> <a href="/du-an/the-global-city/">Đại Đô Thị The Global City – Trung Tâm Mới TP.HCM</a></li>
        <li><span>💎</span> <a href="/du-an/eaton-park-mai-chi-tho/">Căn Hộ Hạng Sang Eaton Park Mai Chí Thọ (TP. Thủ Đức)</a></li>
        <li><span>🌊</span> <a href="/du-an/vinhomes-ocean-park-3/">Vinhomes Ocean Park 3 – The Crown (Hưng Yên)</a></li>
        <li><span>🌳</span> <a href="/du-an/vinhomes-grand-park/">Đại Đô Thị Vinhomes Grand Park (TP. Thủ Đức)</a></li>
      </ul>
    </div>

    <!-- KHỐI 2: GIỎ HÀNG CHUYỂN NHƯỢNG & SUẤT ĐỘC QUYỀN -->
    <div class="kbds-sitemap-section">
      <h3>📋 2. Giỏ Hàng Xác Thực & Suất Độc Quyền (Verified Listings)</h3>
      <ul class="kbds-sitemap-links">
        <li><span>🔑</span> <a href="/can-ho-dual-key-hinode-solera/">Căn hộ Dual Key 1+1 &amp; 2+1 Hinode Solera Phạm Hùng</a></li>
        <li><span>🏡</span> <a href="/biet-thu-don-lap-view-san-golf-90ha-song-cau-vinhomes-king-park/">Biệt Thự Đơn Lập View Sân Golf 90ha – Vinhomes King Park</a></li>
        <li><span>🏬</span> <a href="/shophouse-truc-dai-lo-trung-tam-ke-can-tttm-vincom-vinhomes-king-park/">Shophouse Đại Lộ Trung Tâm – Vinhomes King Park</a></li>
        <li><span>🏢</span> <a href="/can-ho-2pn1-tang-trung-view-ho-noi-khu-10169ha-vinhomes-king-park/">Căn Hộ 2PN+1 Tầng Trung View Hồ 101ha – King Park</a></li>
        <li><span>🏬</span> <a href="/nha-pho-thuong-mai-soho-the-global-city-truc-chinh-nhac-nuoc/">Nhà Phố Thương Mại SOHO The Global City Trục Nhạc Nước</a></li>
        <li><span>🌊</span> <a href="/suat-noi-bo-can-goc-3pn-eaton-park-tang-cao-view-song-thoang-mat/">Suất Nội Bộ Căn Góc 3PN Eaton Park View Sông</a></li>
        <li><span>💎</span> <a href="/suat-ngoai-giao-shophouse-khoi-de-glory-heights-doi-dien-vincom/">Suất Ngoại Giao Shophouse Khối Đế Glory Heights</a></li>
      </ul>
    </div>

    <!-- KHỐI 3: TIN TỨC & PHÂN TÍCH CHUYÊN SÂU -->
    <div class="kbds-sitemap-section">
      <h3>📰 3. Tin Tức Dự Án, Báo Cáo Quy Hoạch & Đánh Giá Chuyên Sâu</h3>
      <ul class="kbds-sitemap-links">
        <li><span>🔍</span> <a href="/thiet-ke-can-ho-1pn-hinode-solera-pham-hung/">Thiết Kế Căn Hộ 1 Phòng Ngủ Hinode Solera 28 Phạm Hùng</a></li>
        <li><span>🔍</span> <a href="/thiet-ke-can-ho-2pn-hinode-solera-pham-hung/">Thiết Kế Căn Hộ 2 Phòng Ngủ Hinode Solera Chuẩn Mực Mỹ Đình</a></li>
        <li><span>🔍</span> <a href="/thiet-ke-can-ho-3pn-hinode-solera-pham-hung/">Khám Phá Căn Hộ 3PN Hinode Solera View Hồ 32ha</a></li>
        <li><span>🔍</span> <a href="/thiet-ke-can-ho-dual-key-hinode-solera-pham-hung/">Đột Phá Căn Hộ Dual Key Hinode Solera Cho Thuê Kép</a></li>
        <li><span>🔍</span> <a href="/mat-bang-tang-dien-hinh-du-an-hinode-solera-pham-hung/">Mặt Bằng Tầng Điển Hình Dự Án Hinode Solera (16 Căn/Tầng)</a></li>
        <li><span>🔍</span> <a href="/vi-tri-du-an-hinode-solera-28-pham-hung-view-ho-cau-giay/">Vị Trí Dự Án Hinode Solera 28 Phạm Hùng Trực Diện Hồ Cầu Giấy</a></li>
        <li><span>🔍</span> <a href="/cap-nhat-gia-ban-chinh-sach-ban-hang-hinode-solera-pham-hung-moi-nhat-nam-2026/">Cập Nhật Bảng Giá &amp; Chính Sách Bán Hàng Hinode Solera 2026</a></li>
        <li><span>🔍</span> <a href="/trai-nghiem-to-hop-khoang-nong-onsen-be-suc-sento-tai-can-ho-monrei-saigon/">Trải Nghiệm Khoáng Nóng Onsen Chuẩn Nhật Tại Monrei Saigon</a></li>
        <li><span>🔍</span> <a href="/thiet-ke-layout-can-ho-2-phong-ngu-du-an-jade-square/">Thiết Kế Căn Hộ 2PN Dự Án Jade Square Tây Hồ Tây</a></li>
        <li><span>🔍</span> <a href="/review-so-sanh-khu-do-thi-an-phu-nen-dau-tu-eaton-park-hay-the-global-city/">So Sánh An Phú: Nên Đầu Tư Eaton Park Hay The Global City?</a></li>
      </ul>
    </div>

    <!-- KHỐI 4: HƯỚNG DẪN & DỊCH VỤ -->
    <div class="kbds-sitemap-section">
      <h3>🧭 4. Hướng Dẫn &amp; Dịch Vụ Khách Hàng</h3>
      <ul class="kbds-sitemap-links">
        <li><span>🌟</span> <a href="/gioi-thieu/">Về Chúng Tôi – Công Ty Cổ Phần BĐS Indochine</a></li>
        <li><span>🏢</span> <a href="/lien-he/">Liên Hệ &amp; Hệ Thống Văn Phòng Hà Nội - TP.HCM</a></li>
        <li><span>📥</span> <a href="/bao-gia-va-tu-van-du-an/">Báo Giá Và Tư Vấn Dự Án Trực Tiếp Từ CĐT</a></li>
        <li><span>📚</span> <a href="/cam-nang-dau-tu-phap-ly/">Cẩm Nang Đầu Tư &amp; Thẩm Định Pháp Lý Dự Án</a></li>
        <li><span>🗺️</span> <a href="/so-do-website/">Sơ Đồ Website (HTML Sitemap Trực Quan)</a></li>
      </ul>
    </div>

    <!-- KHỐI 5: QUY ĐỊNH, CHÍNH SÁCH & PHÁP LÝ -->
    <div class="kbds-sitemap-section">
      <h3>⚖️ 5. Quy Định, Chính Sách &amp; Pháp Lý</h3>
      <ul class="kbds-sitemap-links">
        <li><span>🛡️</span> <a href="/chinh-sach-bao-mat/">Chính Sách Bảo Mật Thông Tin (Privacy Policy)</a></li>
        <li><span>📜</span> <a href="/dieu-khoan-su-dung/">Điều Khoản Sử Dụng Website (Terms of Service)</a></li>
        <li><span>⚠️</span> <a href="/tuyen-bo-mien-tru-trach-nhiem/">Tuyên Bố Miễn Trừ Trách Nhiệm (Disclaimer)</a></li>
        <li><span>🏛️</span> <a href="/quy-che-hoat-dong/">Quy Chế Hoạt Động Sàn Giao Dịch BĐS (Bộ Công Thương)</a></li>
        <li><span>⛔</span> <a href="/che-tai-xu-ly-vi-pham/">Chế Tài Xử Lý Vi Phạm Quy Định Đăng Tin</a></li>
        <li><span>🤝</span> <a href="/giai-quyet-tranh-chap-khieu-nai/">Quy Trình Tiếp Nhận &amp; Giải Quyết Khiếu Nại</a></li>
      </ul>
    </div>

    <!-- KHỐI 6: CÔNG CỤ TÍNH TOÁN & TIỆN ÍCH ĐỘC QUYỀN -->
    <div class="kbds-sitemap-section">
      <h3>🛠️ 6. Tiện Ích Số &amp; Công Cụ Độc Quyền</h3>
      <ul class="kbds-sitemap-links">
        <li><span>🧮</span> <a href="/#kbds-section-tools">Công Cụ Tính Lãi Vay Mua Nhà Ngân Hàng Tự Động</a></li>
        <li><span>🎯</span> <a href="/chi-can/imperia-sky-park/">Tool Tạo Phiếu Chỉ Căn Căn Hộ BĐS Chuyên Nghiệp</a></li>
        <li><span>🤖</span> <a href="/sitemap_index.xml" target="_blank">Sơ Đồ XML Dành Cho Googlebot (XML Sitemap) ↗</a></li>
      </ul>
    </div>
  </div>
</div>
HTML
];

// =========================================================================
// THỰC THI TẠO HOẶC CẬP NHẬT TRÊN LOCAL DATABASE
// =========================================================================
foreach ($guide_pages as $slug => $data) {
    $existing = get_posts([
        'post_type'   => 'page',
        'name'        => $slug,
        'posts_per_page' => 1,
        'post_status' => 'any'
    ]);

    $post_arr = [
        'post_title'   => $data['title'],
        'post_name'    => $slug,
        'post_content' => $data['content'],
        'post_status'  => 'publish',
        'post_type'    => 'page',
    ];

    if (!empty($existing)) {
        $post_arr['ID'] = $existing[0]->ID;
        $page_id = wp_update_post($post_arr);
        echo " ✔ Đã cập nhật trang: [{$data['title']}] (ID: {$page_id}, Slug: {$slug})\n";
    } else {
        $page_id = wp_insert_post($post_arr);
        echo " + Đã tạo mới trang: [{$data['title']}] (ID: {$page_id}, Slug: {$slug})\n";
    }

    if ($page_id && !is_wp_error($page_id)) {
        update_post_meta($page_id, 'rank_math_title', $data['meta_title']);
        update_post_meta($page_id, 'rank_math_description', $data['meta_desc']);
        update_post_meta($page_id, 'rank_math_focus_keyword', $data['focus_kw']);
        update_post_meta($page_id, 'rank_math_robots', ['index', 'follow']);
        update_post_meta($page_id, '_wp_page_template', 'page-blank.php');
        echo "   -> Meta Rank Math: Robots = index, follow | Template: page-blank.php\n";
    }
}

// =========================================================================
// CẬP NHẬT UX BLOCK 123 (FOOTER) VỚI ĐẦY ĐỦ 5 LINK MỚI
// =========================================================================
echo "\n--- CẬP NHẬT LINK TRONG UX BLOCK 123 (FOOTER) ---\n";
$footer_block = get_post(123);
if ($footer_block) {
    $footer_content = <<<HTML
		<div class="kbds-footer-main">
			<div class="kbds-container">
				<!-- TẦNG 1: LOGO & 3 CỘT HOTLINE / HỖ TRỢ / CHĂM SÓC KHÁCH HÀNG -->
				<div class="kbds-footer-top">
					<div class="kbds-footer-logo">
						<a href="/">
							<img src="/wp-content/uploads/kbds-brand-logo-white.svg" alt="KenhBatDongSan.vn" style="height:56px;width:auto" />
						</a>
					</div>

					<div class="kbds-footer-contacts">
						<div class="kbds-f-contact-item">
							<div class="kbds-f-icon">
								📞
							</div>
							<div>
								<span>Hotline 24/7</span>
								<strong><a href="tel:0942655111">0942.655.111</a></strong>
							</div>
						</div>

						<div class="kbds-f-contact-item">
							<div class="kbds-f-icon">
								🏢
							</div>
							<div>
								<span>Hệ thống văn phòng</span>
								<strong><a href="/lien-he/">Hà Nội & TP.HCM</a></strong>
							</div>
						</div>

						<div class="kbds-f-contact-item">
							<div class="kbds-f-icon">
								✉
							</div>
							<div>
								<span>Chăm sóc khách hàng</span>
								<strong><a href="mailto:suport@kenhbatdongsan.vn">suport@kenhbatdongsan.vn</a></strong>
							</div>
						</div>
					</div>
				</div>

				<!-- TẦNG 2: 4 CỘT THÔNG TIN CÔNG TY, HƯỚNG DẪN, QUY ĐỊNH & PHÁP LÝ -->
				<div class="kbds-footer-middle">
					<!-- Cột 1: Thông tin Công ty Indochine -->
					<div class="kbds-f-col kbds-f-col-company">
						<h4>CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE</h4>
						<div class="kbds-f-info-row">
							<span class="kbds-f-pin">📍</span>
							<p><strong>Trụ sở TP.HCM:</strong> Số 45 Thạch Thị Thanh, Phường Tân Định, TP. Hồ Chí Minh, Việt Nam.</p>
						</div>
						<div class="kbds-f-info-row">
							<span class="kbds-f-pin">📍</span>
							<p><strong>Trụ sở Hà Nội:</strong> Tầng 2 tòa nhà Capital Elite, Số 18 Phạm Hùng, Phường Mỹ Đình, Nam Từ Liêm, Hà Nội.</p>
						</div>
						<div class="kbds-f-info-row">
							<span class="kbds-f-pin">📞</span>
							<p><strong>0942.655.111</strong> — <strong>suport@kenhbatdongsan.vn</strong></p>
						</div>
					</div>

					<!-- Cột 2: Hướng dẫn & Dịch vụ -->
					<div class="kbds-f-col">
						<h4>HƯỚNG DẪN & DỊCH VỤ</h4>
						<ul class="kbds-f-links">
							<li><a href="/gioi-thieu/">Về chúng tôi</a></li>
							<li><a href="/lien-he/">Liên hệ & Văn phòng</a></li>
							<li><a href="/bao-gia-va-tu-van-du-an/">Báo giá và tư vấn dự án</a></li>
							<li><a href="/cam-nang-dau-tu-phap-ly/">Cẩm nang đầu tư & Pháp lý</a></li>
							<li><a href="/so-do-website/">Sơ đồ website (Sitemap)</a></li>
						</ul>
					</div>

					<!-- Cột 3: Quy định & Pháp lý -->
					<div class="kbds-f-col">
						<h4>QUY ĐỊNH & PHÁP LÝ</h4>
						<ul class="kbds-f-links">
							<li><a href="/chinh-sach-bao-mat/">Chính sách bảo mật</a></li>
							<li><a href="/dieu-khoan-su-dung/">Điều khoản sử dụng</a></li>
							<li><a href="/tuyen-bo-mien-tru-trach-nhiem/">Tuyên bố miễn trừ</a></li>
							<li><a href="/quy-che-hoat-dong/">Quy chế hoạt động sàn</a></li>
							<li><a href="/che-tai-xu-ly-vi-pham/">Chế tài xử lý vi phạm</a></li>
							<li><a href="/giai-quyet-tranh-chap-khieu-nai/">Giải quyết khiếu nại</a></li>
						</ul>
					</div>

					<!-- Cột 4: Quốc gia & Ngôn ngữ -->
					<div class="kbds-f-col">
						<h4>QUỐC GIA & NGÔN NGỮ</h4>
						<div class="kbds-f-lang-select" style="margin-bottom:14px;">
							<span>🌐 Việt Nam (Tiếng Việt)</span>
						</div>
						<div style="font-size:12.5px;color:#94a3b8;line-height:1.6;">
							Cổng thông tin dự án, quy hoạch & thẩm định bất động sản cao cấp hàng đầu Việt Nam.
						</div>
					</div>
				</div>

				<!-- TẦNG 3: BẢN QUYỀN & GIẤY ĐKKD -->
				<div class="kbds-footer-bottom">
					<div class="kbds-fb-left">
						<p>Copyright © 2026 <strong>kenhbatdongsan.vn</strong>. Toàn bộ quyền được bảo lưu.</p>
						<p>Đơn vị chủ quản: <strong>CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE</strong></p>
						<p>Giấy ĐKKD số: <strong>0317401603</strong> do Sở KH&ĐT TP.HCM cấp.</p>
					</div>

					<div class="kbds-fb-center">
						<p>Hotline hỗ trợ: <strong>0942.655.111</strong> • CSKH: <strong>suport@kenhbatdongsan.vn</strong></p>
						<p>Quy chế, quy định giao dịch có hiệu lực theo quy định pháp luật hiện hành.</p>
						<p>Ghi rõ nguồn "kenhbatdongsan.vn" khi phát hành lại thông tin từ website này.</p>
					</div>

					<div class="kbds-fb-right">
						<div class="kbds-bct-badge">
							<span class="kbds-bct-check">✔</span>
							<div>
								<strong>ĐÃ ĐĂNG KÝ</strong>
								<span>BỘ CÔNG THƯƠNG</span>
							</div>
						</div>
						<div class="kbds-f-socials">
							<a href="https://facebook.com" aria-label="Facebook" title="Facebook" target="_blank">f</a>
							<a href="https://youtube.com" aria-label="YouTube" title="YouTube" target="_blank">▶</a>
							<a href="https://zalo.me/0942655111" aria-label="Zalo" title="Zalo" target="_blank">Zalo</a>
						</div>
					</div>
				</div>
			</div>
		</div>
HTML;
    wp_update_post([
        'ID' => 123,
        'post_content' => $footer_content
    ]);
    echo "✔ Đã cập nhật UX Block 123 (Footer) trỏ chuẩn xác 5 link mục Hướng dẫn & Dịch vụ!\n";
}

echo "\n====================================================================\n";
echo "🎉 HOÀN THÀNH TẠO & VIẾT LẠI 5 TRANG TRONG MỤC 'HƯỚNG DẪN & DỊCH VỤ'!\n";
echo "====================================================================\n";
