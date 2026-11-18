<?php
/**
 * TẠO & CẬP NHẬT TRỌN BỘ 8 TRANG PHÁP LÝ, CHÍNH SÁCH QUẢNG CÁO & TRUST E-E-A-T
 * Website: Kênh Bất Động Sản (kenhbatdongsan.vn)
 * Đơn vị chủ quản: CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE (MST: 0317401603)
 */

require_once dirname(__DIR__) . '/wp-load.php';

echo "====================================================================\n";
echo "🚀 ĐANG KHỞI TẠO BỘ TRANG PHÁP LÝ, POLICY & TRUST E-E-A-T...\n";
echo "====================================================================\n";

$company = [
    'name'        => 'CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE',
    'brand'       => 'Kênh Bất Động Sản (kenhbatdongsan.vn)',
    'tax_id'      => '0317401603',
    'hcm_address' => 'Số 45 Thạch Thị Thanh, Phường Tân Định, TP. Hồ Chí Minh, Việt Nam',
    'hn_address'  => 'Tầng 2 tòa nhà Capital Elite, Số 18 Phạm Hùng, Phường Mỹ Đình, Nam Từ Liêm, Hà Nội',
    'hotline'     => '0942.655.111',
    'email'       => 'suport@kenhbatdongsan.vn',
    'website'     => 'https://kenhbatdongsan.vn'
];

$common_css = <<<CSS
<style id="kbds-legal-pages-css">
.kbds-legal-wrap {
    max-width: 1040px;
    margin: 0 auto;
    padding: 35px 20px 75px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: #1E293B;
    line-height: 1.8;
    font-size: 15.5px;
}
.kbds-legal-hero {
    background: linear-gradient(135deg, #0B132B 0%, #1C2541 50%, #2E3E5B 100%);
    color: #FFFFFF;
    padding: 50px 24px 42px;
    text-align: center;
    border-radius: 16px;
    margin-bottom: 35px;
    box-shadow: 0 10px 30px rgba(11,19,43,0.12);
}
.kbds-legal-hero .kbds-hero-pill {
    display: inline-block;
    background: rgba(217,119,6,0.25);
    border: 1px solid rgba(245,158,11,0.55);
    color: #FDE68A;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
}
.kbds-legal-hero h1 {
    font-size: 32px;
    font-weight: 900;
    color: #FFFFFF;
    margin: 0 0 10px;
    line-height: 1.35;
}
.kbds-legal-hero p {
    font-size: 15px;
    color: #CBD5E1;
    max-width: 720px;
    margin: 0 auto 14px;
    line-height: 1.6;
}
.kbds-legal-hero .kbds-hero-meta {
    font-size: 12.5px;
    color: #94A3B8;
}
.kbds-legal-body h2 {
    font-size: 21px;
    font-weight: 800;
    color: #0F172A;
    margin: 36px 0 14px;
    padding-bottom: 8px;
    border-bottom: 2px solid #E2E8F0;
    line-height: 1.4;
}
.kbds-legal-body h3 {
    font-size: 17.5px;
    font-weight: 700;
    color: #1E293B;
    margin: 22px 0 10px;
}
.kbds-legal-body p {
    margin-bottom: 15px;
}
.kbds-legal-body ul, .kbds-legal-body ol {
    margin-bottom: 18px;
    padding-left: 22px;
}
.kbds-legal-body li {
    margin-bottom: 7px;
}
.kbds-note-card {
    background: #F8FAFC;
    border-left: 4px solid #D97706;
    padding: 16px 20px;
    border-radius: 0 10px 10px 0;
    margin: 22px 0;
    font-size: 14.5px;
    line-height: 1.7;
}
.kbds-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 18px;
    margin: 24px 0;
}
.kbds-card-box {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.03);
}
.kbds-card-box h4 {
    margin: 0 0 8px;
    color: #0F172A;
    font-size: 16px;
    font-weight: 700;
}
.kbds-legal-table {
    width: 100%;
    border-collapse: collapse;
    margin: 22px 0;
    font-size: 14px;
}
.kbds-legal-table th {
    background: #F1F5F9;
    color: #0F172A;
    font-weight: 700;
    padding: 12px 14px;
    text-align: left;
    border: 1px solid #CBD5E1;
}
.kbds-legal-table td {
    padding: 12px 14px;
    border: 1px solid #E2E8F0;
    vertical-align: top;
}
.kbds-cta-banner {
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
    color: #FFFFFF;
    padding: 30px;
    border-radius: 14px;
    margin: 40px 0 15px;
    text-align: center;
}
.kbds-cta-banner h3 {
    color: #FFFFFF;
    font-size: 21px;
    font-weight: 800;
    margin: 0 0 10px;
}
.kbds-cta-banner p {
    color: #CBD5E1;
    font-size: 14.5px;
    max-width: 650px;
    margin: 0 auto 18px;
}
@media (max-width: 768px) {
    .kbds-legal-hero h1 { font-size: 23px; }
    .kbds-legal-wrap { padding: 20px 14px 45px; }
    .kbds-card-grid { grid-template-columns: 1fr; }
    .kbds-legal-table { font-size: 13px; }
    .kbds-legal-table th, .kbds-legal-table td { padding: 8px 10px; }
}
</style>
CSS;

$pages_data = [];

// =========================================================================
// 1. CHÍNH SÁCH BẢO MẬT THÔNG TIN (PRIVACY POLICY)
// =========================================================================
$pages_data['chinh-sach-bao-mat'] = [
    'title'   => 'Chính Sách Bảo Mật Thông Tin | Kênh Bất Động Sản (kenhbatdongsan.vn)',
    'h1'      => 'CHÍNH SÁCH BẢO MẬT THÔNG TIN',
    'badge'   => 'TUÂN THỦ NGHỊ ĐỊNH 13/2023/NĐ-CP & CHUẨN QUẢNG CÁO GOOGLE - META',
    'subtitle'=> 'Cam kết minh bạch mục đích thu thập, phạm vi sử dụng và bảo mật tuyệt đối dữ liệu khách hàng theo tiêu chuẩn an toàn thông tin.',
    'meta_title' => 'Chính Sách Bảo Mật Thông Tin Khách Hàng | Kênh Bất Động Sản',
    'meta_desc'  => 'Chính sách bảo mật thông tin khách hàng tại kenhbatdongsan.vn: Minh bạch mục đích thu thập, bảo mật dữ liệu theo Nghị định 13/2023/NĐ-CP và chính sách quảng cáo Google, Meta.',
    'focus_kw'   => 'chính sách bảo mật kenhbatdongsan',
    'robots'     => ['noindex', 'follow'],
    'content'    => $common_css . <<<HTML
<div class="kbds-legal-wrap">
  <div class="kbds-legal-hero">
    <span class="kbds-hero-pill">TUÂN THỦ NGHỊ ĐỊNH 13/2023/NĐ-CP & CHUẨN QUẢNG CÁO GOOGLE - META</span>
    <h1>CHÍNH SÁCH BẢO MẬT THÔNG TIN</h1>
    <p>Cam kết minh bạch mục đích thu thập, phạm vi sử dụng và bảo mật tuyệt đối dữ liệu khách hàng theo tiêu chuẩn an toàn thông tin mạng.</p>
    <div class="kbds-hero-meta">Áp dụng từ: Tháng 01/2026 • Đơn vị chủ quản: CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE</div>
  </div>

  <div class="kbds-legal-body">
    <div class="kbds-note-card">
      <strong>Kính gửi Quý khách hàng & Quý đối tác:</strong><br />
      Sự riêng tư và an toàn dữ liệu cá nhân của Quý vị là ưu tiên hàng đầu tại <strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong>. Chính sách này được thiết lập tuân thủ nghiêm ngặt <em>Luật An toàn thông tin mạng 2015</em>, <em>Nghị định 52/2013/NĐ-CP</em>, <em>Nghị định 85/2021/NĐ-CP</em> và đặc biệt là <strong>Nghị định số 13/2023/NĐ-CP</strong> của Chính phủ về Bảo vệ Dữ liệu Cá nhân (PDPD), cũng như đáp ứng các tiêu chuẩn khắt khe về Quảng cáo tạo khách hàng tiềm năng (Lead Generation) của Google Ads và Meta Ads.
    </div>

    <h2>1. Đơn Vị Thu Thập Và Quản Lý Dữ Liệu</h2>
    <ul>
      <li><strong>Tên đơn vị:</strong> CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE</li>
      <li><strong>Mã số doanh nghiệp (MST):</strong> 0317401603 do Sở Kế hoạch và Đầu tư TP.HCM cấp</li>
      <li><strong>Trụ sở chính:</strong> Số 45 Thạch Thị Thanh, Phường Tân Định, TP. Hồ Chí Minh</li>
      <li><strong>Văn phòng đại diện Hà Nội:</strong> Tầng 2 tòa nhà Capital Elite, Số 18 Phạm Hùng, Phường Mỹ Đình, Nam Từ Liêm, Hà Nội</li>
      <li><strong>Hotline tiếp nhận bảo mật:</strong> 0942.655.111 (Hỗ trợ 24/7)</li>
      <li><strong>Email chuyên trách bảo vệ dữ liệu:</strong> suport@kenhbatdongsan.vn</li>
    </ul>

    <h2>2. Mục Đích Thu Thập Dữ Liệu Cá Nhân</h2>
    <p>Khi Quý khách truy cập, tương tác và điền biểu mẫu (Form đăng ký nhận bảng giá, tài liệu thiết kế, xem nhà mẫu, ký gửi bất động sản) trên website <code>kenhbatdongsan.vn</code>, chúng tôi thu thập các trường thông tin cơ bản sau:</p>
    <ul>
      <li><strong>Họ và tên:</strong> Để xưng hô lịch sự và cá nhân hóa tài liệu gửi tới Quý khách.</li>
      <li><strong>Số điện thoại (kèm Zalo):</strong> Để chuyên viên tư vấn liên hệ xác nhận nhu cầu, gửi bảng giá gốc trực tiếp từ Chủ đầu tư và gửi tài liệu PDF mặt bằng chi tiết.</li>
      <li><strong>Địa chỉ Email (nếu có):</strong> Để gửi báo cáo phân tích thị trường định kỳ, tiến độ thi công và hợp đồng mẫu.</li>
      <li><strong>Nhu cầu chi tiết về bất động sản:</strong> Khoảng ngân sách, loại hình căn hộ (1PN, 2PN, 3PN, Dual Key, Shophouse, Biệt thự), tiến độ mong muốn.</li>
      <li><strong>Dữ liệu kỹ thuật tự động:</strong> Địa chỉ IP, loại trình duyệt, thời gian truy cập nhằm mục đích bảo mật chống spam bot và tối ưu hóa trải nghiệm hiển thị.</li>
    </ul>

    <h2>3. Phạm Vi Sử Dụng Thông Tin Khách Hàng</h2>
    <p>Chúng tôi cam kết dữ liệu cá nhân chỉ được sử dụng cho các mục đích hợp pháp sau đây:</p>
    <ol>
      <li>Cung cấp chính xác bảng giá gốc, chính sách chiết khấu thanh toán và chương trình hỗ trợ lãi suất từ Chủ đầu tư của dự án Quý khách quan tâm.</li>
      <li>Kết nối chuyên viên tư vấn chuyên sâu của dự án để hỗ trợ đặt lịch tham quan thực tế nhà mẫu và công trường thi công.</li>
      <li>Hỗ trợ khách hàng hoàn tất thủ tục đặt cọc, thẩm định hồ sơ vay vốn ngân hàng và ký Hợp đồng mua bán / chuyển nhượng hợp pháp.</li>
      <li>Giải quyết các thắc mắc, khiếu nại hoặc yêu cầu hỗ trợ sau giao dịch.</li>
    </ol>

    <h2>4. Cam Kết Không Chia Sẻ, Không Bán Dữ Liệu Cho Bên Thứ Ba</h2>
    <div class="kbds-note-card">
      🛡️ <strong>CAM KẾT BẢO MẬT TUYỆT ĐỐI:</strong><br />
      Chúng tôi <strong>TUYỆT ĐỐI KHÔNG BÁN, KHÔNG TRAO ĐỔI, KHÔNG CHO THUÊ</strong> danh sách dữ liệu cá nhân của Quý khách hàng cho bất kỳ công ty quảng cáo, đại lý bảo hiểm, sàn tài chính hay bất kỳ bên thứ ba nào vì mục đích thương mại.<br />
      Thông tin chỉ được chia sẻ duy nhất với Chủ đầu tư dự án tương ứng hoặc Ngân hàng chỉ định khi Quý khách chính thức có văn bản ủy quyền làm thủ tục mua bán / giải ngân.
    </div>

    <h2>5. Thời Gian Lưu Trữ Dữ Liệu</h2>
    <p>Dữ liệu cá nhân của khách hàng sẽ được lưu trữ an toàn trong hệ thống máy chủ cơ sở dữ liệu (CRM) nội bộ của Công ty cho đến khi:</p>
    <ul>
      <li>Hoàn thành mục đích tư vấn và chăm sóc dự án mà khách hàng đăng ký; HOẶC</li>
      <li>Khách hàng gửi yêu cầu hủy bỏ, xóa dữ liệu thông qua Hotline hoặc Email chính thức; HOẶC</li>
      <li>Hết thời hạn lưu trữ theo quy định của pháp luật hiện hành.</li>
    </ul>

    <h2>6. Quyền Của Khách Hàng Đối Với Dữ Liệu Cá Nhân</h2>
    <p>Theo quy định tại Nghị định 13/2023/NĐ-CP, Quý khách hàng là chủ thể dữ liệu có đầy đủ các quyền sau:</p>
    <ul>
      <li><strong>Quyền được biết & Tiếp cận:</strong> Yêu cầu cung cấp thông tin về dữ liệu cá nhân của mình đang được lưu trữ.</li>
      <li><strong>Quyền chỉnh sửa:</strong> Yêu cầu cập nhật, chỉnh sửa số điện thoại, email hoặc nhu cầu nếu có sai sót.</li>
      <li><strong>Quyền xóa dữ liệu (Rút lại sự đồng ý):</strong> Quý khách có quyền yêu cầu xóa hoàn toàn dữ liệu cá nhân khỏi hệ thống bất kỳ lúc nào bằng cách gửi email về <code>suport@kenhbatdongsan.vn</code> hoặc gọi điện trực tiếp tới Hotline <code>0942.655.111</code>. Chúng tôi sẽ xử lý và xác nhận kết quả trong vòng 24 giờ làm việc.</li>
      <li><strong>Quyền khiếu nại:</strong> Gửi khiếu nại nếu phát hiện dữ liệu cá nhân bị sử dụng sai mục đích cam kết.</li>
    </ul>

    <h2>7. Biện Pháp Bảo Đảm An Toàn Thông Tin Kỹ Thuật</h2>
    <ul>
      <li><strong>Mã hóa đường truyền SSL/TLS 256-bit:</strong> Toàn bộ dữ liệu truyền tải giữa trình duyệt của khách hàng và website kenhbatdongsan.vn đều được mã hóa theo tiêu chuẩn ngân hàng.</li>
      <li><strong>Tường lửa & Hệ thống kiểm soát truy cập (WAF):</strong> Hệ thống máy chủ được bảo vệ bởi tường lửa chống tấn công DDOS, SQL Injection và phân quyền truy cập nội bộ bằng xác thực 2 yếu tố.</li>
      <li><strong>Tuân thủ Google Ads & Meta Lead Ads:</strong> Dưới mọi biểu mẫu điền thông tin, chúng tôi đều niêm yết rõ liên kết tới Chính sách bảo mật này, đảm bảo tính tự nguyện và đồng thuận minh bạch 100% của người dùng.</li>
    </ul>

    <div class="kbds-cta-banner">
      <h3>CẦN HỖ TRỢ VỀ CHÍNH SÁCH BẢO MẬT & DỮ LIỆU CÁ NHÂN?</h3>
      <p>Vui lòng liên hệ trực tiếp Bộ phận Pháp chế & An toàn thông tin của Indochine BĐS để được giải đáp trong 24 giờ.</p>
      <div style="display:flex;justify-content:center;gap:15px;flex-wrap:wrap;">
        <a href="tel:0942655111" style="background:#F59E0B;color:#0F172A;font-weight:800;padding:10px 22px;border-radius:24px;text-decoration:none;">📞 Hotline: 0942.655.111</a>
        <a href="mailto:suport@kenhbatdongsan.vn" style="background:rgba(255,255,255,0.15);color:#FFF;font-weight:700;padding:10px 22px;border-radius:24px;text-decoration:none;border:1px solid rgba(255,255,255,0.3);">✉ Email: suport@kenhbatdongsan.vn</a>
      </div>
    </div>
  </div>
</div>
HTML
];

// =========================================================================
// 2. ĐIỀU KHOẢN SỬ DỤNG (TERMS OF SERVICE)
// =========================================================================
$pages_data['dieu-khoan-su-dung'] = [
    'title'   => 'Điều Khoản Sử Dụng Website | Kênh Bất Động Sản (kenhbatdongsan.vn)',
    'h1'      => 'ĐIỀU KHOẢN SỬ DỤNG WEBSITE',
    'badge'   => 'QUY ĐỊNH PHÁP LÝ & BẢO HỘ BẢN QUYỀN NỘI DUNG',
    'subtitle'=> 'Quy định quyền và nghĩa vụ của người dùng, bảo vệ quyền sở hữu trí tuệ, hình ảnh phối cảnh 3D và dữ liệu dự án trên hệ thống.',
    'meta_title' => 'Điều Khoản Sử Dụng Website | Kênh Bất Động Sản',
    'meta_desc'  => 'Điều khoản sử dụng website kenhbatdongsan.vn: Quy định quyền và trách nhiệm của khách hàng, đối tác, bảo hộ bản quyền nội dung và thiết kế 3D.',
    'focus_kw'   => 'điều khoản sử dụng kenhbatdongsan',
    'robots'     => ['noindex', 'follow'],
    'content'    => $common_css . <<<HTML
<div class="kbds-legal-wrap">
  <div class="kbds-legal-hero">
    <span class="kbds-hero-pill">QUY ĐỊNH PHÁP LÝ & BẢO HỘ BẢN QUYỀN NỘI DUNG</span>
    <h1>ĐIỀU KHOẢN SỬ DỤNG WEBSITE</h1>
    <p>Quy định quyền, nghĩa vụ và trách nhiệm pháp lý khi truy cập, khai thác thông tin và sử dụng dịch vụ trên nền tảng Kênh Bất Động Sản.</p>
    <div class="kbds-hero-meta">Phiên bản: 2.0 • Hiệu lực từ: 2026 • Đơn vị chủ quản: CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE</div>
  </div>

  <div class="kbds-legal-body">
    <div class="kbds-note-card">
      Chào mừng Quý khách đến với <strong>kenhbatdongsan.vn</strong>. Khi Quý khách tiếp tục duyệt xem, tra cứu thông tin hoặc để lại yêu cầu tư vấn trên website này, Quý khách được xem là đã đọc, hiểu và đồng ý vô điều kiện với toàn bộ các điều khoản và điều kiện được nêu dưới đây.
    </div>

    <h2>1. Định Nghĩa & Phạm Vi Áp Dụng</h2>
    <ul>
      <li><strong>Website:</strong> Là trang thông tin điện tử và sàn giao dịch bất động sản có địa chỉ tên miền duy nhất là <code>https://kenhbatdongsan.vn</code>.</li>
      <li><strong>Ban quản trị:</strong> Công ty Cổ phần Bất Động Sản Indochine – đơn vị sở hữu, quản lý và vận hành website.</li>
      <li><strong>Người dùng / Khách hàng:</strong> Mọi cá nhân, tổ chức truy cập, xem tài liệu hoặc gửi form đăng ký tư vấn trên website.</li>
      <li><strong>Đối tác / Môi giới (Agents):</strong> Nhân viên kinh doanh, đơn vị phân phối F1 được cấp quyền đăng tin hoặc phối hợp tư vấn dự án.</li>
    </ul>

    <h2>2. Quyền Sở Hữu Trí Tuệ & Bản Quyền Nội Dung</h2>
    <p>Toàn bộ tài sản trí tuệ hiển thị trên website <code>kenhbatdongsan.vn</code> bao gồm nhưng không giới hạn ở:</p>
    <ul>
      <li>Các bài viết phân tích chuyên sâu, báo cáo đánh giá thị trường, cẩm nang đầu tư và quy hoạch do đội ngũ chuyên gia của Kênh BĐS biên soạn độc quyền.</li>
      <li>Hình ảnh đồ họa, bản đồ vị trí, infographic, sơ đồ mặt bằng bóc tách và các video phối cảnh 3D được thiết kế riêng.</li>
      <li>Mã nguồn lập trình, giao diện người dùng (UI/UX) và cơ sở dữ liệu phân loại dự án.</li>
    </ul>
    <div class="kbds-note-card">
      ⛔ <strong>NGHIÊM CẤM SAO CHÉP TRÁI PHÉP:</strong><br />
      Mọi hành vi sao chép, tái bản, trích dẫn nội dung, sử dụng công cụ tự động (crawling/scraping) để trích xuất dữ liệu của <code>kenhbatdongsan.vn</code> mà không ghi rõ nguồn hoặc chưa có văn bản đồng ý trước từ Ban quản trị đều là hành vi xâm phạm quyền tác giả theo <em>Luật Sở hữu trí tuệ Việt Nam</em>.
    </div>

    <h2>3. Quy Định Đối Với Người Dùng Khi Truy Cập</h2>
    <p>Khi sử dụng website, người dùng cam kết:</p>
    <ol>
      <li>Cung cấp thông tin liên hệ chính xác, trung thực khi gửi yêu cầu nhận bảng giá hoặc tư vấn pháp lý.</li>
      <li>Không sử dụng bất kỳ thiết bị, phần mềm, công cụ độc hại nào nhằm can thiệp, làm gián đoạn hoặc phá hoại cấu trúc hệ thống máy chủ của website.</li>
      <li>Không đăng tải, phát tán các bình luận mang tính xúc phạm, vi phạm thuần phong mỹ tục hoặc vi phạm pháp luật nước CHXHCN Việt Nam.</li>
      <li>Chịu trách nhiệm bảo mật thông tin tài khoản đăng nhập (nếu là môi giới/thành viên được cấp quyền).</li>
    </ol>

    <h2>4. Quyền Và Nghĩa Vụ Của Ban Quản Trị Website</h2>
    <ul>
      <li><strong>Quyền hạn:</strong> Ban quản trị có quyền từ chối, tạm khóa hoặc xóa vĩnh viễn các bài đăng, tài khoản môi giới hoặc yêu cầu vi phạm quy chế hoạt động mà không cần báo trước. Có quyền cập nhật, nâng cấp giao diện, nội dung hoặc bổ sung điều khoản sử dụng bất kỳ thời điểm nào.</li>
      <li><strong>Nghĩa vụ:</strong> Nỗ lực duy trì hệ thống hoạt động ổn định 24/7; kiểm duyệt tính chân thực của thông tin dự án; bảo vệ bí mật dữ liệu cá nhân của khách hàng theo đúng Chính sách bảo mật.</li>
    </ul>

    <h2>5. Giới Hạn Trách Nhiệm Pháp Lý</h2>
    <p>Ban quản trị không chịu trách nhiệm bồi thường đối với các thiệt hại hoặc sự cố gián đoạn phát sinh do:</p>
    <ul>
      <li>Sự cố kỹ thuật từ nhà cung cấp đường truyền mạng Internet, viễn thông hoặc sự cố bất khả kháng (thiên tai, dịch bệnh, sự cố mạng diện rộng).</li>
      <li>Khách hàng tự ý cung cấp thông tin tài khoản hoặc số điện thoại cho các đối tượng giả mạo mạo danh thương hiệu Kênh Bất Động Sản.</li>
    </ul>

    <h2>6. Luật Điều Chỉnh & Cơ Quan Giải Quyết Tranh Chấp</h2>
    <p>Các điều khoản này được điều chỉnh và giải thích theo quy định của pháp luật nước Cộng hòa Xã hội Chủ nghĩa Việt Nam. Mọi tranh chấp phát sinh từ việc sử dụng website trước hết sẽ được giải quyết thông qua thương lượng thiện chí. Nếu không giải quyết được bằng hòa giải, tranh chấp sẽ được đưa ra Tòa án nhân dân có thẩm quyền tại Việt Nam để phân xử.</p>
  </div>
</div>
HTML
];

// =========================================================================
// 3. TUYÊN BỐ MIỄN TRỪ TRÁCH NHIỆM (DISCLAIMER)
// =========================================================================
$pages_data['tuyen-bo-mien-tru-trach-nhiem'] = [
    'title'   => 'Tuyên Bố Miễn Trừ Trách Nhiệm | Kênh Bất Động Sản (kenhbatdongsan.vn)',
    'h1'      => 'TUYÊN BỐ MIỄN TRỪ TRÁCH NHIỆM',
    'badge'   => 'TÍNH CHẤT THÔNG TIN THAM KHẢO & PHÁP LÝ DỰ ÁN TỪ CHỦ ĐẦU TƯ',
    'subtitle'=> 'Lưu ý pháp lý quan trọng: Các thông tin, bản vẽ, hình ảnh trên website chỉ mang tính chất tham khảo tại thời điểm phát hành.',
    'meta_title' => 'Tuyên Bố Miễn Trừ Trách Nhiệm | Kênh Bất Động Sản',
    'meta_desc'  => 'Tuyên bố miễn trừ trách nhiệm của kenhbatdongsan.vn: Thông tin dự án, mặt bằng, bảng giá chỉ mang tính chất tham khảo; thông tin chính thức quy định tại HĐMB với CĐT.',
    'focus_kw'   => 'miễn trừ trách nhiệm kenhbatdongsan',
    'robots'     => ['noindex', 'follow'],
    'content'    => $common_css . <<<HTML
<div class="kbds-legal-wrap">
  <div class="kbds-legal-hero">
    <span class="kbds-hero-pill">TÍNH CHẤT THÔNG TIN THAM KHẢO & PHÁP LÝ DỰ ÁN TỪ CHỦ ĐẦU TƯ</span>
    <h1>TUYÊN BỐ MIỄN TRỪ TRÁCH NHIỆM</h1>
    <p>Khuyến cáo pháp lý quan trọng dành cho Quý khách hàng, Nhà đầu tư và Đối tác khi tiếp cận dữ liệu trên website.</p>
    <div class="kbds-hero-meta">Áp dụng cho toàn bộ nội dung xuất bản trên kenhbatdongsan.vn</div>
  </div>

  <div class="kbds-legal-body">
    <div class="kbds-note-card">
      ⚠️ <strong>KHUYẾN CÁO ĐẶC BIỆT DÀNH CHO KHÁCH HÀNG & NHÀ ĐẦU TƯ:</strong><br />
      Thị trường Bất động sản có đặc thù liên tục biến động về giá bán, quỹ căn mở bán, tiến độ xây dựng và chính sách thanh toán từ các Chủ đầu tư. Nhằm bảo vệ tối đa quyền lợi của khách hàng và tránh các hiểu lầm pháp lý ngoài ý muốn, <strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong> xin đưa ra tuyên bố miễn trừ trách nhiệm chi tiết dưới đây.
    </div>

    <h2>1. Tính Chất Thông Tin Mang Tính Tham Khảo</h2>
    <p>Tất cả các nội dung đăng tải trên website bao gồm:</p>
    <ul>
      <li>Thông số kỹ thuật dự án, diện tích tim tường, diện tích thông thủy, chiều cao tầng;</li>
      <li>Bản vẽ mặt bằng quy hoạch 1/500, sơ đồ tầng điển hình, layout thiết kế từng mã căn hộ;</li>
      <li>Hình ảnh phối cảnh 3D minh họa, video sa bàn ảo, ảnh cảnh quan tiện ích mẫu;</li>
      <li>Bảng giá bán dự kiến, mức chiết khấu, lãi suất vay ngân hàng và lịch thanh toán;</li>
      <li>Các bài viết đánh giá, phân tích tiềm năng tăng giá và khả năng cho thuê...</li>
    </ul>
    <p>đều chỉ mang <strong>tính chất tham khảo</strong> tại thời điểm biên soạn và xuất bản bài viết.</p>

    <h2>2. Sự Điều Chỉnh Và Thay Đổi Từ Chủ Đầu Tư</h2>
    <p>Trong quá trình thi công và triển khai dự án thực tế, Chủ đầu tư có toàn quyền:</p>
    <ul>
      <li>Điều chỉnh thiết kế, danh mục vật liệu bàn giao, tên gọi phân khu hoặc vị trí tiện ích nội khu để phù hợp với quy chuẩn xây dựng và phê duyệt của cơ quan quản lý nhà nước.</li>
      <li>Thay đổi bảng giá gốc, chính sách bán hàng, quà tặng ưu đãi theo từng giai đoạn thị trường mà không bắt buộc phải thông báo trước cho các bên trung gian.</li>
    </ul>

    <h2>3. Giá Trị Pháp Lý Của Hợp Đồng Mua Bán (HĐMB)</h2>
    <div class="kbds-note-card">
      ⚖️ <strong>QUY ĐỊNH PHÁP LÝ DUY NHẤT CÓ HIỆU LỰC RÀNG BUỘC:</strong><br />
      Mọi quyền lợi, nghĩa vụ, giá bán chính thức, thời hạn bàn giao căn hộ và điều kiện pháp lý giữa các bên <strong>CHỈ ĐƯỢC XÁC ĐỊNH DUY NHẤT VÀ CÓ HIỆU LỰC PHÁP LÝ RÀNG BUỘC</strong> tại:
      <ul>
        <li><strong>Hợp đồng mua bán / Hợp đồng chuyển nhượng / Văn bản thỏa thuận</strong> ký kết chính thức bằng văn bản giữa Quý khách hàng và Chủ đầu tư hoặc chủ sở hữu hợp pháp của bất động sản.</li>
      </ul>
      Không có bất kỳ thông tin, hình ảnh, bài phân tích nào trên website này được coi là một phần của Hợp đồng hay là lời cam kết bảo lãnh pháp lý thay thế cho văn bản chính thức của Chủ đầu tư.
    </div>

    <h2>4. Giới Hạn Trách Nhiệm Của Ban Quản Trị Website</h2>
    <p>Ban quản trị website và Công ty Cổ phần Bất Động Sản Indochine được miễn trừ hoàn toàn trách nhiệm đối với:</p>
    <ol>
      <li>Bất kỳ thiệt hại trực tiếp, gián tiếp, ngẫu nhiên hoặc các tổn thất tài chính phát sinh từ việc người dùng tự ý đưa ra quyết định đặt cọc, mua bán hoặc đầu tư dựa trên thông tin trên website mà không thông qua bước xác minh thực tế với nhân sự được ủy quyền chính thức.</li>
      <li>Sự sai lệch giữa hình ảnh phối cảnh nghệ thuật (Render 3D) và hiện trạng thực tế công trình sau khi hoàn thiện bàn giao.</li>
      <li>Các thông tin do các môi giới hoặc cộng tác viên tự ý phát ngôn ngoài phạm vi tài liệu chính thức được Chủ đầu tư phê duyệt.</li>
    </ol>

    <h2>5. Lời Khuyên Dành Cho Khách Hàng Giao Dịch BĐS</h2>
    <p>Để đảm bảo an toàn tuyệt đối cho tài sản của mình, chúng tôi khuyến nghị Quý khách hàng:</p>
    <ul>
      <li>Luôn yêu cầu kiểm tra bộ hồ sơ pháp lý hoàn chỉnh của dự án (Giấy phép xây dựng, Biên bản nghiệm thu phần móng, Giấy chứng nhận bảo lãnh ngân hàng...).</li>
      <li>Đọc kỹ từng điều khoản trong Hợp đồng mua bán trước khi ký kết và thực hiện chuyển tiền vào đúng tài khoản ngân hàng của Chủ đầu tư.</li>
      <li>Liên hệ trực tiếp với chuyên viên tư vấn chính thức của chúng tôi qua Hotline <strong>0942.655.111</strong> để được cung cấp văn bản và bảng giá mới nhất.</li>
    </ul>
  </div>
</div>
HTML
];

// =========================================================================
// 4. QUY CHẾ HOẠT ĐỘNG SÀN GIAO DỊCH BĐS (OPERATING REGULATIONS)
// =========================================================================
$pages_data['quy-che-hoat-dong'] = [
    'title'   => 'Quy Chế Hoạt Động Sàn Giao Dịch BĐS | Kênh Bất Động Sản (kenhbatdongsan.vn)',
    'h1'      => 'QUY CHẾ HOẠT ĐỘNG SÀN GIAO DỊCH TMĐT & BĐS',
    'badge'   => 'TUÂN THỦ NGHỊ ĐỊNH 52/2013/NĐ-CP & NGHỊ ĐỊNH 85/2021/NĐ-CP BỘ CÔNG THƯƠNG',
    'subtitle'=> 'Quy định nguyên tắc hoạt động, quy trình kiểm duyệt tin đăng, quyền và trách nhiệm của Ban quản trị, Người đăng tin và Khách hàng.',
    'meta_title' => 'Quy Chế Hoạt Động Sàn Giao Dịch BĐS | Kênh Bất Động Sản',
    'meta_desc'  => 'Quy chế hoạt động sàn giao dịch TMĐT bất động sản kenhbatdongsan.vn: Tuân thủ quy định Bộ Công Thương, quy trình đăng tin, xác thực và bảo vệ người dùng.',
    'focus_kw'   => 'quy chế hoạt động kenhbatdongsan',
    'robots'     => ['noindex', 'follow'],
    'content'    => $common_css . <<<HTML
<div class="kbds-legal-wrap">
  <div class="kbds-legal-hero">
    <span class="kbds-hero-pill">TUÂN THỦ NGHỊ ĐỊNH 52/2013/NĐ-CP & NGHỊ ĐỊNH 85/2021/NĐ-CP BỘ CÔNG THƯƠNG</span>
    <h1>QUY CHẾ HOẠT ĐỘNG SÀN GIAO DỊCH TMĐT & BĐS</h1>
    <p>Văn bản quy định chuẩn tắc vận hành, quy trình xác thực sản phẩm, kiểm duyệt tin đăng và trách nhiệm của các bên tham gia sàn giao dịch.</p>
    <div class="kbds-hero-meta">Ban hành bởi: Ban Quản Trị Sàn Giao Dịch BĐS Indochine • Năm 2026</div>
  </div>

  <div class="kbds-legal-body">
    <h2>I. NGUYÊN TẮC CHUNG</h2>
    <p>1. Sàn giao dịch thương mại điện tử <strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong> do Công ty Cổ phần Bất Động Sản Indochine thành lập và vận hành, là cổng kết nối thông tin chuyên sâu giữa Chủ đầu tư, Đơn vị phân phối F1, Môi giới chuyên nghiệp và Khách hàng có nhu cầu mua, bán, thuê bất động sản trên toàn lãnh thổ Việt Nam.</p>
    <p>2. Hoạt động trên Sàn được tổ chức công khai, minh bạch, bảo vệ quyền lợi chính đáng của người tiêu dùng và tôn trọng quyền tự do kinh doanh hợp pháp theo quy định của pháp luật Việt Nam.</p>

    <h2>II. QUY TRÌNH GIAO DỊCH DÀNH CHO CÁC BÊN</h2>
    <div class="kbds-card-grid">
      <div class="kbds-card-box">
        <h4>1. Dành Cho Khách Hàng (Người Mua/Thuê)</h4>
        <ol>
          <li>Tra cứu dự án, giỏ hàng theo khu vực, mức giá, loại hình căn hộ.</li>
          <li>Xem thông tin chi tiết: Pháp lý, mặt bằng, hình ảnh, tiến độ thực tế.</li>
          <li>Gửi thông tin yêu cầu báo giá qua Form hoặc gọi trực tiếp Hotline 0942.655.111.</li>
          <li>Được chuyên viên xác thực hỗ trợ xem nhà mẫu, thẩm định hợp đồng và giao dịch trực tiếp với Chủ đầu tư/Chủ nhà.</li>
        </ol>
      </div>

      <div class="kbds-card-box">
        <h4>2. Dành Cho Người Đăng Tin (Môi Giới / Đối Tác)</h4>
        <ol>
          <li>Đăng ký tài khoản thành viên và xác thực thông tin định danh (CCCD/Số điện thoại).</li>
          <li>Biên tập tin đăng theo đúng quy chuẩn: Giá thật, ảnh thực tế, mô tả rõ pháp lý.</li>
          <li>Gửi tin đăng vào hệ thống chờ duyệt (Pending Review).</li>
          <li>Ban quản trị thẩm định tính xác thực trong vòng 2 - 4 giờ trước khi xuất bản.</li>
        </ol>
      </div>
    </div>

    <h2>III. QUY TRÌNH KIỂM DUYỆT THÔNG TIN DỰ ÁN & GIỎ HÀNG</h2>
    <p>Nhằm loại bỏ hoàn toàn tình trạng "tin rác, giá ảo, dự án ma", Ban quản trị áp dụng quy trình kiểm duyệt 2 lớp nghiêm ngặt:</p>
    <ul>
      <li><strong>Lớp 1 (Kiểm duyệt pháp lý đầu vào):</strong> Đối chiếu thông tin dự án với các văn bản pháp lý đã được cấp phép (Quy hoạch 1/500, Giấy phép xây dựng, Chủ trương đầu tư của UBND cấp tỉnh/thành phố).</li>
      <li><strong>Lớp 2 (Kiểm duyệt nội dung & giá bán):</strong> Kiểm tra mức giá đăng tải so với khung giá chính thức của Chủ đầu tư; loại bỏ ngay các tin đăng có tiêu đề gây hiểu nhầm, ảnh mượn không xin phép hoặc spam từ khóa vô nghĩa.</li>
    </ul>

    <h2>IV. QUYỀN VÀ NGHĨA VỤ CỦA BAN QUẢN TRỊ WEBSITE</h2>
    <ul>
      <li><strong>Quyền hạn:</strong> Có quyền kiểm tra, từ chối hoặc hạ bài viết vi phạm quy chế; tạm đình chỉ hoặc xóa vĩnh viễn tài khoản môi giới vi phạm; lưu giữ thông tin giao dịch để phục vụ công tác thanh tra khi cơ quan nhà nước yêu cầu.</li>
      <li><strong>Nghĩa vụ:</strong> Đăng ký, khai báo hoạt động sàn giao dịch với Bộ Công Thương theo quy định; thiết lập cơ chế tiếp nhận phản ánh và khiếu nại của khách hàng; đảm bảo an toàn hệ thống thông tin.</li>
    </ul>

    <h2>V. QUYỀN VÀ NGHĨA VỤ CỦA THÀNH VIÊN ĐĂNG TIN (AGENTS)</h2>
    <ul>
      <li><strong>Quyền hạn:</strong> Được sử dụng các công cụ đăng tin, nhận thông báo khách hàng tiềm năng phân bổ từ hệ thống; được hỗ trợ tài liệu bán hàng chính thống.</li>
      <li><strong>Nghĩa vụ:</strong> Cung cấp thông tin trung thực, chính xác 100%; bảo mật thông tin tài khoản; tôn trọng khách hàng; tuyệt đối không thực hiện các hành vi lừa dối, thu tiền chênh trái quy định.</li>
    </ul>

    <h2>VI. QUYỀN VÀ NGHĨA VỤ CỦA KHÁCH HÀNG</h2>
    <ul>
      <li><strong>Quyền hạn:</strong> Được cung cấp tài liệu miễn phí, được bảo vệ bí mật đời tư theo Chính sách bảo mật; có quyền gửi khiếu nại nếu phát hiện thông tin sai sự thật.</li>
      <li><strong>Nghĩa vụ:</strong> Tự chịu trách nhiệm trong việc kiểm tra, thẩm định hợp đồng mua bán với đối tác trước khi thực hiện giao dịch tài chính.</li>
    </ul>
  </div>
</div>
HTML
];

// =========================================================================
// 5. CHẾ TÀI XỬ LÝ VI PHẠM (SANCTIONS FOR VIOLATIONS)
// =========================================================================
$pages_data['che-tai-xu-ly-vi-pham'] = [
    'title'   => 'Chế Tài Xử Lý Vi Phạm Quy Định Đăng Tin & Giao Dịch | Kênh Bất Động Sản',
    'h1'      => 'CHẾ TÀI XỬ LÝ VI PHẠM QUY ĐỊNH',
    'badge'   => 'BẢO ĐẢM MÔI TRƯỜNG KINH DOANH MINH BẠCH - KHÔNG DỰ ÁN MA - KHÔNG GIÁ ẢO',
    'subtitle'=> 'Quy định các hành vi bị nghiêm cấm và khung xử phạt áp dụng đối với thành viên, môi giới và đối tác vi phạm quy chế.',
    'meta_title' => 'Chế Tài Xử Lý Vi Phạm Quy Định Đăng Tin | Kênh Bất Động Sản',
    'meta_desc'  => 'Quy định các hành vi bị nghiêm cấm và chế tài xử lý vi phạm đối với thành viên, môi giới đăng tin trên sàn kenhbatdongsan.vn. Bảo vệ quyền lợi người mua BĐS.',
    'focus_kw'   => 'chế tài xử lý vi phạm kenhbatdongsan',
    'robots'     => ['noindex', 'follow'],
    'content'    => $common_css . <<<HTML
<div class="kbds-legal-wrap">
  <div class="kbds-legal-hero">
    <span class="kbds-hero-pill">BẢO ĐẢM MÔI TRƯỜNG KINH DOANH MINH BẠCH - KHÔNG DỰ ÁN MA - KHÔNG GIÁ ẢO</span>
    <h1>CHẾ TÀI XỬ LÝ VI PHẠM QUY ĐỊNH</h1>
    <p>Khung chế tài xử lý nghiêm minh nhằm đảm bảo tính trung thực, đạo đức nghề nghiệp và an toàn pháp lý trên Kênh Bất Động Sản.</p>
    <div class="kbds-hero-meta">Áp dụng cho toàn bộ thành viên, nhân viên kinh doanh & đối tác liên kết</div>
  </div>

  <div class="kbds-legal-body">
    <div class="kbds-note-card">
      Mục tiêu cao nhất của <strong>Kênh Bất Động Sản</strong> là kiến tạo một môi trường giao dịch bất động sản chuẩn mực, nơi người mua nhận được thông tin chân thực nhất và người môi giới làm việc chuyên nghiệp, có trách nhiệm. Mọi hành vi cố tình gian dối, trục lợi hoặc làm xấu hình ảnh thị trường đều sẽ bị xử lý không khoan nhượng.
    </div>

    <h2>1. Danh Mục Các Hành Vi Bị Nghiêm Cấm</h2>
    <ol>
      <li><strong>Đăng tin dự án ảo, dự án "ma":</strong> Bất kỳ thông tin nào về dự án chưa được cấp phép đầu tư, dự án phân lô trái phép trên đất nông nghiệp/rừng hoặc dự án đang trong tình trạng tranh chấp, kê biên phát mại mà không nêu rõ.</li>
      <li><strong>Đăng sai lệch giá bán (Giá ảo, Cắt lỗ giả):</strong> Đăng giá thấp hơn thực tế để "câu view", đăng giá chênh, giấu chi phí thuế phí làm sai lệch nhận định của khách hàng.</li>
      <li><strong>Sử dụng hình ảnh sai lệch, vi phạm bản quyền:</strong> Đăng ảnh của dự án cao cấp khác gán cho dự án kém chất lượng; đăng ảnh phản cảm, bạo lực, vi phạm thuần phong mỹ tục.</li>
      <li><strong>Mạo danh Chủ đầu tư hoặc đại diện độc quyền:</strong> Tự nhận là Chủ đầu tư hoặc Ban quản lý dự án khi chỉ là cá nhân môi giới tự do.</li>
      <li><strong>Spam tin hàng loạt & Dùng công cụ phá hoại:</strong> Đăng lặp đi lặp lại một tin đăng nhiều lần; chèn link mã độc hoặc spam từ khóa vô nghĩa.</li>
      <li><strong>Ứng xử thiếu văn hóa, lừa dối khách hàng:</strong> Có hành vi đe dọa, xúc phạm hoặc cố tình cung cấp hồ sơ giả mạo trong quá trình tư vấn.</li>
    </ol>

    <h2>2. Bảng Khung Chế Tài Xử Lý Vi Phạm</h2>
    <table class="kbds-legal-table">
      <thead>
        <tr>
          <th style="width:18%;">Mức độ vi phạm</th>
          <th style="width:38%;">Hành vi tương ứng</th>
          <th style="width:44%;">Hình thức chế tài áp dụng</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>Mức 1<br />(Vi phạm nhẹ)</strong></td>
          <td>Sai lỗi chính tả cố ý, sai sót nhỏ về số tầng/diện tích, đặt tiêu đề in hoa toàn bộ phản cảm.</td>
          <td>Hạ bài viết, gửi email cảnh cáo lần 1, yêu cầu sửa đổi nội dung chuẩn xác trong vòng 12 giờ.</td>
        </tr>
        <tr>
          <td><strong>Mức 2<br />(Vi phạm lần 2)</strong></td>
          <td>Tái diễn đăng giá ảo, spam lặp tin trên 3 lần, đăng ảnh phối cảnh sai dự án.</td>
          <td>Tạm khóa quyền đăng tin và đóng băng tài khoản từ <strong>15 đến 30 ngày</strong>; gỡ toàn bộ các tin đăng hiện có trên sàn.</td>
        </tr>
        <tr>
          <td><strong>Mức 3<br />(Vi phạm nghiêm trọng)</strong></td>
          <td>Đăng tin dự án ma, lừa đảo đặt cọc, mạo danh Chủ đầu tư, có hành vi xúc phạm khách hàng.</td>
          <td><strong>XÓA VĨNH VIỄN TÀI KHOẢN MÔI GIỚI MÀ KHÔNG CẦN BÁO TRƯỚC</strong>. Đưa thông tin vào Danh sách đen (Blacklist) toàn hệ thống.</td>
        </tr>
        <tr>
          <td><strong>Mức 4<br />(Vi phạm pháp luật)</strong></td>
          <td>Làm giả giấy tờ pháp lý, chiếm đoạt tiền đặt cọc của khách hàng, vi phạm hình sự.</td>
          <td>Chuyển giao toàn bộ hồ sơ, nhật ký IP và bằng chứng sang <strong>Cơ quan Cảnh sát Điều tra</strong> để truy cứu trách nhiệm hình sự theo pháp luật.</td>
        </tr>
      </tbody>
    </table>

    <h2>3. Cơ Chế Báo Cáo Vi Phạm (Report) Dành Cho Khách Hàng</h2>
    <p>Nếu Quý khách phát hiện bất kỳ bài đăng nào có dấu hiệu sai sự thật hoặc môi giới có hành vi gian dối, xin vui lòng bấm nút "Báo cáo vi phạm" hoặc gửi thông tin về:</p>
    <ul>
      <li><strong>Hotline thanh tra nội bộ:</strong> 0942.655.111 (Trực 24/7)</li>
      <li><strong>Email tiếp nhận:</strong> suport@kenhbatdongsan.vn (Tiêu đề: [Báo Cáo Vi Phạm] - Tên dự án / Số điện thoại môi giới)</li>
    </ul>
    <p>Ban quản trị cam kết sẽ tiếp nhận, xác minh và xử lý nghiêm trong vòng <strong>24 giờ</strong> làm việc.</p>
  </div>
</div>
HTML
];

// =========================================================================
// 6. QUY TRÌNH TIẾP NHẬN & GIẢI QUYẾT TRANH CHẤP, KHIẾU NẠI (DISPUTE RESOLUTION)
// =========================================================================
$pages_data['giai-quyet-tranh-chap-khieu-nai'] = [
    'title'   => 'Quy Trình Tiếp Nhận & Giải Quyết Tranh Chấp, Khiếu Nại | Kênh Bất Động Sản',
    'h1'      => 'QUY TRÌNH TIẾP NHẬN & GIẢI QUYẾT TRANH CHẤP, KHIẾU NẠI',
    'badge'   => 'TUÂN THỦ ĐIỀU 74 NGHỊ ĐỊNH 52/2013/NĐ-CP VỀ THƯƠNG MẠI ĐIỆN TỬ',
    'subtitle'=> 'Quy trình 4 bước xử lý khiếu nại minh bạch, nhanh chóng và công bằng, cam kết thời hạn giải quyết trong 3 - 5 ngày làm việc.',
    'meta_title' => 'Quy Trình Giải Quyết Tranh Chấp, Khiếu Nại | Kênh Bất Động Sản',
    'meta_desc'  => 'Quy trình giải quyết tranh chấp, khiếu nại khách hàng tại kenhbatdongsan.vn: Tuân thủ quy định Bộ Công Thương, tiếp nhận đa kênh, cam kết xử lý trong 3-5 ngày.',
    'focus_kw'   => 'giải quyết khiếu nại kenhbatdongsan',
    'robots'     => ['noindex', 'follow'],
    'content'    => $common_css . <<<HTML
<div class="kbds-legal-wrap">
  <div class="kbds-legal-hero">
    <span class="kbds-hero-pill">TUÂN THỦ ĐIỀU 74 NGHỊ ĐỊNH 52/2013/NĐ-CP VỀ THƯƠNG MẠI ĐIỆN TỬ</span>
    <h1>QUY TRÌNH TIẾP NHẬN & GIẢI QUYẾT TRANH CHẤP, KHIẾU NẠI</h1>
    <p>Cơ chế minh bạch nhằm lắng nghe phản hồi, bảo vệ quyền lợi hợp pháp của khách hàng và giải quyết mâu thuẫn thỏa đáng.</p>
    <div class="kbds-hero-meta">Bộ phận Chăm sóc khách hàng & Pháp chế • Indochine BĐS</div>
  </div>

  <div class="kbds-legal-body">
    <div class="kbds-note-card">
      <strong>Kính gửi Quý khách hàng:</strong><br />
      <strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong> luôn đề cao tinh thần trách nhiệm, sự cầu thị và tính minh bạch trong mọi hoạt động tư vấn. Chúng tôi cam kết tiếp nhận và xử lý mọi khiếu nại của Quý khách theo đúng quy trình chuẩn hóa dưới đây.
    </div>

    <h2>1. Nguyên Tắc Giải Quyết Tranh Chấp</h2>
    <ul>
      <li>Mọi mâu thuẫn, tranh chấp giữa người mua và người bán/môi giới đều được ưu tiên thương lượng, hòa giải trên tinh thần tôn trọng quyền lợi chính đáng của nhau.</li>
      <li>Ban quản trị đóng vai trò là cầu nối trung gian, hỗ trợ thông tin, xác thực tài liệu và đôn đốc các bên thực hiện nghĩa vụ đã cam kết.</li>
      <li>Nếu hành vi vi phạm có dấu hiệu lừa đảo hoặc vi phạm hình sự, Ban quản trị sẽ lập biên bản và chuyển giao cho cơ quan pháp luật có thẩm quyền xử lý.</li>
    </ul>

    <h2>2. Các Kênh Tiếp Nhận Khiếu Nại Chính Thức</h2>
    <div class="kbds-card-grid">
      <div class="kbds-card-box">
        <h4>📞 Qua Tổng Đài Hotline 24/7</h4>
        <p><strong>0942.655.111</strong> (Gặp trực tiếp Tổ trưởng Bộ phận Chăm sóc khách hàng & Xử lý khiếu nại).</p>
      </div>
      <div class="kbds-card-box">
        <h4>✉ Qua Hòm Thư Điện Tử</h4>
        <p><strong>suport@kenhbatdongsan.vn</strong> (Ghi rõ tiêu đề: [Khiếu nại] - Họ tên - Số điện thoại phản ánh).</p>
      </div>
      <div class="kbds-card-box">
        <h4>🏢 Làm Việc Trực Tiếp Tại Văn Phòng</h4>
        <p><strong>Hà Nội:</strong> Tầng 2 tòa nhà Capital Elite, 18 Phạm Hùng, Mỹ Đình.<br />
        <strong>TP.HCM:</strong> Số 45 Thạch Thị Thanh, P. Tân Định.</p>
      </div>
    </div>

    <h2>3. Quy Trình 4 Bước Giải Quyết Khiếu Nại</h2>
    <table class="kbds-legal-table">
      <thead>
        <tr>
          <th style="width:15%;">Giai đoạn</th>
          <th style="width:30%;">Nội dung công việc</th>
          <th style="width:25%;">Đơn vị thực hiện</th>
          <th style="width:30%;">Thời hạn cam kết</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>Bước 1</strong></td>
          <td>Tiếp nhận đơn khiếu nại, ghi nhận nội dung sự việc, thu thập tài liệu/bằng chứng liên quan.</td>
          <td>Bộ phận CSKH</td>
          <td>Phản hồi xác nhận trong vòng <strong>24 giờ</strong> làm việc.</td>
        </tr>
        <tr>
          <td><strong>Bước 2</strong></td>
          <td>Xác minh thông tin: Làm việc với người phản ánh và người bị khiếu nại (môi giới/đối tác); kiểm tra nhật ký tư vấn.</td>
          <td>Phòng Thanh tra & Pháp chế</td>
          <td>Hoàn tất xác minh trong <strong>24 - 48 giờ</strong>.</td>
        </tr>
        <tr>
          <td><strong>Bước 3</strong></td>
          <td>Tổ chức hòa giải, đưa ra phương án xử lý thỏa đáng, áp dụng chế tài kỷ luật nếu môi giới sai phạm.</td>
          <td>Ban Quản Trị Website</td>
          <td>Thời hạn giải quyết trong <strong>3 - 5 ngày làm việc</strong>.</td>
        </tr>
        <tr>
          <td><strong>Bước 4</strong></td>
          <td>Thông báo kết quả xử lý bằng văn bản cho các bên. Đóng hồ sơ hoặc hỗ trợ khách hàng khởi kiện nếu không đạt thỏa thuận.</td>
          <td>Ban Quản Trị & Pháp chế</td>
          <td>Kết thúc vụ việc dứt điểm.</td>
        </tr>
      </tbody>
    </table>

    <h2>4. Trách Nhiệm Cung Cấp Thông Tin Cho Cơ Quan Nhà Nước</h2>
    <p>Trong trường hợp tranh chấp phát sinh từ các hành vi lừa đảo, chiếm đoạt tài sản có tổ chức, Ban quản trị website <code>kenhbatdongsan.vn</code> có trách nhiệm cung cấp đầy đủ thông tin đăng ký, lịch sử giao dịch và địa chỉ IP của đối tượng vi phạm cho cơ quan Công an hoặc Tòa án nhân dân để phục vụ công tác điều tra và bảo vệ tài sản của nhân dân.</p>
  </div>
</div>
HTML
];

// =========================================================================
// 7. GIỚI THIỆU (ABOUT US) - CHUẨN E-E-A-T & MINH BẠCH DOANH NGHIỆP
// =========================================================================
$pages_data['gioi-thieu'] = [
    'title'   => 'Về Chúng Tôi | Kênh Bất Động Sản (kenhbatdongsan.vn) - Indochine BĐS',
    'h1'      => 'VỀ CHÚNG TÔI - KÊNH BẤT ĐỘNG SẢN',
    'badge'   => 'ĐƠN VỊ PHÂN TÍCH DỮ LIỆU & PHÂN PHỐI BẤT ĐỘNG SẢN CHUYÊN NGHIỆP',
    'subtitle'=> 'Cổng dữ liệu dự án chuẩn xác, phân tích chuyên sâu và giỏ hàng bất động sản cao cấp hàng đầu Việt Nam.',
    'meta_title' => 'Giới Thiệu Về Kênh Bất Động Sản | Đơn Vị Chủ Quản Indochine BĐS',
    'meta_desc'  => 'Giới thiệu về Kênh Bất Động Sản (kenhbatdongsan.vn): Đơn vị chủ quản Công ty CP BĐS Indochine (MST 0317401603). Đội ngũ chuyên gia hơn 10 năm kinh nghiệm chuẩn SEO E-E-A-T.',
    'focus_kw'   => 'giới thiệu Kênh Bất Động Sản',
    'robots'     => ['index', 'follow'],
    'content'    => $common_css . <<<HTML
<div class="kbds-legal-wrap">
  <div class="kbds-legal-hero">
    <span class="kbds-hero-pill">ĐƠN VỊ PHÂN TÍCH DỮ LIỆU & PHÂN PHỐI BẤT ĐỘNG SẢN CHUYÊN NGHIỆP</span>
    <h1>VỀ CHÚNG TÔI - KÊNH BẤT ĐỘNG SẢN</h1>
    <p>Đồng hành cùng hơn 5.000 khách hàng và nhà đầu tư, mang lại giải pháp an cư thịnh vượng và tối ưu hóa lợi nhuận bền vững.</p>
    <div class="kbds-hero-meta">Đơn vị chủ quản: CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE (MST: 0317401603)</div>
  </div>

  <div class="kbds-legal-body">
    <div class="kbds-note-card">
      <strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong> được xây dựng với sứ mệnh trở thành nền tảng dữ liệu dự án bất động sản chuẩn xác, minh bạch và chuyên sâu hàng đầu tại Việt Nam. Chúng tôi không chỉ cung cấp thông tin mở bán đơn thuần, mà là đối tác chiến lược đồng hành cùng khách hàng từ khâu thẩm định pháp lý, phân tích dòng tiền cho đến khi nhận bàn giao nhà và khai thác sinh lời.
    </div>

    <h2>1. Thông Tin Pháp Lý Đơn Vị Chủ Quản</h2>
    <table class="kbds-legal-table">
      <tbody>
        <tr>
          <td style="width:30%;"><strong>Tên công ty:</strong></td>
          <td style="width:70%;"><strong>CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE</strong></td>
        </tr>
        <tr>
          <td><strong>Tên thương hiệu:</strong></td>
          <td><strong>Kênh Bất Động Sản (kenhbatdongsan.vn)</strong></td>
        </tr>
        <tr>
          <td><strong>Mã số doanh nghiệp (MST):</strong></td>
          <td><strong>0317401603</strong> do Sở Kế hoạch & Đầu tư TP.HCM cấp ngày 27/07/2022</td>
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
          <td><strong>Hotline toàn quốc:</strong></td>
          <td><strong>0942.655.111</strong> (Trực tư vấn 24/7)</td>
        </tr>
        <tr>
          <td><strong>Email liên hệ:</strong></td>
          <td><strong>suport@kenhbatdongsan.vn</strong></td>
        </tr>
      </tbody>
    </table>

    <h2>2. Tầm Nhìn, Sứ Mệnh & Giá Trị Cốt Lõi</h2>
    <div class="kbds-card-grid">
      <div class="kbds-card-box">
        <h4>🎯 Tầm Nhìn Chiến Lược</h4>
        <p>Trở thành cổng tra cứu dữ liệu quy hoạch, đánh giá dự án và phân phối bất động sản cao cấp uy tín hàng đầu tại các thị trường trọng điểm: Hà Nội, TP.HCM, Nha Trang, Đà Nẵng, Quảng Ninh.</p>
      </div>
      <div class="kbds-card-box">
        <h4>🚀 Sứ Mệnh Vì Khách Hàng</h4>
        <p>Bảo vệ tài sản và tương lai tài chính của người mua nhà bằng cách sàng lọc khắt khe tính pháp lý, bóc tách ưu/nhược điểm từng dự án một cách trung thực và khách quan nhất.</p>
      </div>
      <div class="kbds-card-box">
        <h4>💎 Giá Trị Cốt Lõi: TẬN TÂM - MINH BẠCH</h4>
        <p>Minh bạch trong thông tin, Chuyên sâu trong kiến thức phân tích, Tận tâm trong từng bước tư vấn và Thượng tôn pháp luật trong mọi giao dịch.</p>
      </div>
    </div>

    <h2>3. Khung Năng Lực E-E-A-T Của Kênh Bất Động Sản</h2>
    <p>Đáp ứng trọn vẹn tiêu chuẩn chất lượng cao nhất theo hướng dẫn của Google về độ uy tín và tin cậy chuyên ngành Bất động sản (YMYL - Your Money Your Life):</p>
    <ul>
      <li><strong>Experience (Kinh nghiệm thực chiến):</strong> Hơn 10 năm hoạt động trong lĩnh vực phân phối bất động sản dự án và chuyển nhượng thứ cấp, tham gia tư vấn thành công hàng nghìn giao dịch căn hộ cao cấp, shophouse và biệt thự nghỉ dưỡng.</li>
      <li><strong>Expertise (Chuyên môn sâu sắc):</strong> Đội ngũ nhân sự nòng cốt bao gồm các chuyên viên thẩm định pháp lý, kiến trúc sư quy hoạch và chuyên gia phân tích tài chính ngân hàng, trực tiếp khảo sát thực địa từng công trình.</li>
      <li><strong>Authoritativeness (Thẩm quyền phân tích):</strong> Đối tác phân phối F1 chiến lược của nhiều Tập đoàn phát triển BĐS uy tín: WTO (Hinode), Vinhomes, Masterise Homes, Nam Long, Sun Group, Ecopark...</li>
      <li><strong>Trustworthiness (Độ tin cậy tuyệt đối):</strong> 100% giỏ hàng niêm yết được xác thực tính chính danh, công khai bảng giá gốc, tuyệt đối không đưa tin ảo, không kê giá ăn chênh.</li>
    </ul>

    <h2>4. Các Lĩnh Vực Hoạt Động Chủ Lực</h2>
    <ol>
      <li><strong>Phân phối F1 Dự án BĐS Cao cấp:</strong> Cung cấp bảng giá gốc, quỹ căn đẹp trực tiếp từ Chủ đầu tư với chính sách ưu đãi tài chính tốt nhất.</li>
      <li><strong>Giỏ hàng Chuyển nhượng Xác thực (Verified Listings):</strong> Sàn lọc các căn hộ, biệt thự cắt lỗ sâu hoặc giá tốt từ chủ nhà gửi bán độc quyền.</li>
      <li><strong>Tư vấn Pháp lý & Cấu trúc Dòng tiền:</strong> Hỗ trợ khách hàng phân tích bài toán vay đòn bẩy ngân hàng, đánh giá tiềm năng cho thuê (Rental Yield) và giải pháp căn hộ Dual Key.</li>
      <li><strong>Xuất bản Báo cáo Nghiên cứu & Bản đồ Quy hoạch:</strong> Cung cấp miễn phí các tài liệu phân tích thị trường 24/7 giúp nhà đầu tư nắm bắt cơ hội.</li>
    </ol>
  </div>
</div>
HTML
];

// =========================================================================
// 8. LIÊN HỆ (CONTACT US) - VĂN PHÒNG, HOTLINE, BẢN ĐỒ & FORM
// =========================================================================
$pages_data['lien-he'] = [
    'title'   => 'Liên Hệ Với Kênh Bất Động Sản | Hotline 0942.655.111 - Hỗ Trợ 24/7',
    'h1'      => 'LIÊN HỆ VỚI CHÚNG TÔI',
    'badge'   => 'HỆ THỐNG TRỤ SỞ HÀ NỘI & TP. HỒ CHÍ MINH - TƯ VẤN 24/7',
    'subtitle'=> 'Quý khách vui lòng liên hệ trực tiếp qua Hotline, Email hoặc ghé thăm văn phòng giao dịch của chúng tôi để được đón tiếp chu đáo.',
    'meta_title' => 'Liên Hệ Kênh Bất Động Sản | Hotline 0942.655.111 - Văn Phòng HN & HCM',
    'meta_desc'  => 'Liên hệ Kênh Bất Động Sản (kenhbatdongsan.vn): Trụ sở TP.HCM (45 Thạch Thị Thanh) & Văn phòng Hà Nội (Capital Elite 18 Phạm Hùng). Hotline 24/7: 0942.655.111.',
    'focus_kw'   => 'liên hệ Kênh Bất Động Sản',
    'robots'     => ['index', 'follow'],
    'content'    => $common_css . <<<HTML
<div class="kbds-legal-wrap">
  <div class="kbds-legal-hero">
    <span class="kbds-hero-pill">HỆ THỐNG TRỤ SỞ HÀ NỘI & TP. HỒ CHÍ MINH - TƯ VẤN 24/7</span>
    <h1>LIÊN HỆ VỚI CHÚNG TÔI</h1>
    <p>Chúng tôi luôn sẵn sàng lắng nghe mọi câu hỏi, yêu cầu tư vấn dự án và đóng góp ý kiến từ Quý khách hàng.</p>
    <div class="kbds-hero-meta">Đơn vị chủ quản: CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN INDOCHINE (MST: 0317401603)</div>
  </div>

  <div class="kbds-legal-body">
    <div class="kbds-card-grid">
      <div class="kbds-card-box" style="border-top:4px solid #D97706;">
        <h4>🏛️ Trụ Sở Chính Tại TP.HCM</h4>
        <p><strong>Địa chỉ:</strong> Số 45 Thạch Thị Thanh, Phường Tân Định, TP. Hồ Chí Minh, Việt Nam.</p>
        <p><strong>Hotline:</strong> <a href="tel:0942655111" style="color:#D97706;font-weight:700;">0942.655.111</a></p>
        <p><strong>Giờ làm việc:</strong> Thứ 2 – Thứ 7 (8:00 – 18:00)</p>
      </div>

      <div class="kbds-card-box" style="border-top:4px solid #2563EB;">
        <h4>🏛️ Văn Phòng Giao Dịch Hà Nội</h4>
        <p><strong>Địa chỉ:</strong> Tầng 2 tòa nhà Capital Elite, Số 18 Phạm Hùng, Phường Mỹ Đình, Nam Từ Liêm, Hà Nội.</p>
        <p><strong>Hotline:</strong> <a href="tel:0942655111" style="color:#2563EB;font-weight:700;">0942.655.111</a></p>
        <p><strong>Giờ làm việc:</strong> Thứ 2 – Chủ Nhật (Trực 24/7)</p>
      </div>

      <div class="kbds-card-box" style="border-top:4px solid #10B981;">
        <h4>✉ Kênh Liên Hệ Trực Tuyến</h4>
        <p><strong>Email hỗ trợ:</strong> <a href="mailto:suport@kenhbatdongsan.vn" style="color:#0F172A;font-weight:700;">suport@kenhbatdongsan.vn</a></p>
        <p><strong>Zalo OA / Chat:</strong> <a href="https://zalo.me/0942655111" target="_blank" style="color:#10B981;font-weight:700;">Chat trực tiếp qua Zalo</a></p>
        <p><strong>Website:</strong> <a href="https://kenhbatdongsan.vn" style="color:#0F172A;font-weight:700;">kenhbatdongsan.vn</a></p>
      </div>
    </div>

    <h2>Gửi Yêu Cầu Tư Vấn / Hỗ Trợ Trực Tuyến</h2>
    <p>Quý khách vui lòng để lại thông tin theo biểu mẫu bên dưới. Chuyên viên chăm sóc khách hàng của Kênh Bất Động Sản sẽ liên hệ phản hồi Quý khách trong vòng <strong>3 phút</strong> làm việc:</p>

    <div style="background:#0F172A;border-radius:14px;padding:25px;margin:25px 0;">
      [kbds_lead_form title="📥 Gửi Yêu Cầu Liên Hệ & Nhận Tư Vấn Trực Tiếp" project="Trang Liên Hệ - kenhbatdongsan.vn" button_text="GỬI YÊU CẦU CHO CHÚNG TÔI ➔"]
    </div>

    <h2>Bản Đồ Vị Trí Trụ Sở & Văn Phòng Giao Dịch</h2>
    <div class="kbds-card-grid">
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
// THỰC THI TẠO HOẶC CẬP NHẬT TRÊN LOCAL DATABASE
// =========================================================================
$created_page_ids = [];

foreach ($pages_data as $slug => $data) {
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
        $created_page_ids[$slug] = $page_id;

        // Cập nhật Rank Math SEO metadata
        update_post_meta($page_id, 'rank_math_title', $data['meta_title']);
        update_post_meta($page_id, 'rank_math_description', $data['meta_desc']);
        update_post_meta($page_id, 'rank_math_focus_keyword', $data['focus_kw']);
        update_post_meta($page_id, 'rank_math_robots', $data['robots']);
        update_post_meta($page_id, '_wp_page_template', 'page-blank.php');
        echo "   -> Meta Rank Math: Robots = " . implode(', ', $data['robots']) . " | Template: page-blank.php\n";
    }
}

// =========================================================================
// CẬP NHẬT UX BLOCK 123 (FOOTER CHÂN TRANG)
// =========================================================================
echo "\n--- CẬP NHẬT UX BLOCK 123 (FOOTER CHÂN TRANG) ---\n";
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
							<li><a href="#kbds-section-cta">Báo giá và tư vấn dự án</a></li>
							<li><a href="/cam-nang-phap-ly/">Cẩm nang đầu tư & Pháp lý</a></li>
							<li><a href="/sitemap_index.xml">Sơ đồ website (Sitemap)</a></li>
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
    echo "✔ Đã cập nhật UX Block 123 (Footer) liên kết đầy đủ 8 trang chính sách & quy chế!\n";
}

echo "\n====================================================================\n";
echo "🎉 HOÀN THÀNH TẠO 8 TRANG PHÁP LÝ & CẬP NHẬT FOOTER TRÊN LOCALHOST!\n";
echo "====================================================================\n";
