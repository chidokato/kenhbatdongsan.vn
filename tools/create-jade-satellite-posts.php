<?php
/**
 * Tạo 5 bài viết vệ tinh chuẩn SEO cho dự án Jade Square
 */
require_once __DIR__ . '/../wp-load.php';

$media_map = json_decode(file_get_contents(__DIR__ . '/jade-media-map.json'), true);
$proj_id   = (int) file_get_contents(__DIR__ . '/jade-project-id.txt');
$proj_slug = 'jade-square';

$satellite_posts = [
    // BÀI 1: VỊ TRÍ
    [
        'title'         => 'Vị Trí Dự Án Chung Cư Jade Square: Tọa Độ Siêu Kết Nối Đón Sóng Tăng Trưởng Tây Hồ Tây',
        'slug'          => 'vi-tri-du-an-jade-square',
        'featured_id'   => $media_map['vi-tri-toa-do-sieu-ket-noi-jade-square-tay-ho-tay'],
        'category_slug' => 'quy-hoach-ha-tang',
        'focus_kw'      => 'Vị trí dự án Jade Square',
        'meta_desc'     => 'Phân tích vị trí dự án chung cư Jade Square Bắc Từ Liêm: Tọa độ siêu kết nối Tây Hồ Tây, kề cận 2 tuyến Metro số 2 và số 6, kết nối Ngoại Giao Đoàn, Lotte Mall.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Vị trí dự án Jade Square</strong> tọa lạc tại quỹ đất vàng thuộc Khu đô thị Bắc Cổ Nhuế – Chèm (phường Xuân Đỉnh và Cổ Nhuế 2, quận Bắc Từ Liêm, Hà Nội). Nằm ngay trên trục đường Nguyễn Đình Tứ kết nối trực tiếp với đại lộ Phạm Văn Đồng và đường Tây Thăng Long rộng 60.5m, <a href="/du-an/jade-square/" style="color:#0D9488;font-weight:700;">Jade Square</a> sở hữu tọa độ "siêu kết nối" đắt giá, đón trọn làn sóng phát triển bứt phá của trung tâm hành chính – tài chính mới Tây Hồ Tây.
    </p>

    <div class="kbds-highlight-box" style="background:#F0FDFA;border-left:4px solid #0D9488;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#0D9488;font-size:17px;font-weight:700;">📍 TỌA ĐỘ VÀNG JADE SQUARE BẮC TỪ LIÊM</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Địa chỉ dự án:</strong> Đường Nguyễn Đình Tứ, KĐT Bắc Cổ Nhuế – Chèm, Q. Bắc Từ Liêm, TP. Hà Nội.</li>
            <li><strong>Trục hạ tầng chiến lược:</strong> Trục Phạm Văn Đồng (Vành đai 3 trên cao) & Tuyến đường Tây Thăng Long (60.5m – 10 làn xe).</li>
            <li><strong>Đường sắt đô thị:</strong> Kế cận Ga Metro Tuyến số 2 (Ga C1 Nam Thăng Long) và Ga Metro Tuyến số 6.</li>
            <li><strong>Liên kết trung tâm:</strong> 5 phút tới Starlake Tây Hồ Tây, Lotte Mall và KĐT Quốc tế Ciputra.</li>
        </ul>
    </div>

    <h2>1. Tâm Điểm Đón Đầu Làn Sóng Tăng Trưởng Tây Hồ Tây</h2>
    <p>
        Khu vực Tây Hồ Tây hiện nay đang là điểm nóng phát triển bậc nhất Thủ đô, nơi định hình thành trung tâm hành chính mới với quy hoạch chuyển dời 11 Bộ, Ngành của Chính phủ, cùng các tập đoàn công nghệ toàn cầu như Trung tâm R&D Samsung.
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/vi-tri-toa-do-sieu-ket-noi-jade-square-tay-ho-tay.jpg" alt="Vị trí tọa độ siêu kết nối Jade Square Tây Hồ Tây" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Bản đồ vị trí siêu kết nối dự án chung cư Jade Square, đón đầu 2 tuyến Metro số 2 và số 6</figcaption>
    </figure>

    <p>
        Nằm ở vị trí liền kề Tây Hồ Tây, cư dân Jade Square dễ dàng thụ hưởng toàn bộ hệ sinh thái tiện ích tỷ đô mà không phải chịu mật độ dân cư quá đông đúc hay mức giá quá cao như trong lõi Starlake.
    </p>

    <h2>2. Bán Kính Siêu Kết Nối: 1 - 20 Phút Chạm Ngàn Tiện Ích</h2>
    <table style="width:100%;border-collapse:collapse;margin:24px 0;font-size:14.5px;">
        <thead>
            <tr style="background:#0F766E;color:#FFF;">
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Thời gian</th>
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Địa điểm & Hạ tầng kết nối</th>
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Giá trị mang lại cho cư dân</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#0D9488;">01 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Tuyến đường sắt đô thị Metro số 6 & ga dừng hiện đại</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Giao thông xanh không lo ùn tắc</td>
            </tr>
            <tr style="background:#F8FAFC;">
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#0D9488;">03 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Bệnh viện Đa khoa Phương Đông, Học viện Tài chính, ĐH Mỏ Địa chất</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Chăm sóc sức khỏe y tế & giáo dục chất lượng cao</td>
            </tr>
            <tr>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#0D9488;">05 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Tuyến Metro số 2 (Ga C1 Nam Thăng Long), KĐT Ciputra, Lotte Mall Tây Hồ, Starlake</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Tâm điểm vui chơi giải trí & mua sắm cao cấp nhất miền Bắc</td>
            </tr>
            <tr style="background:#F8FAFC;">
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#0D9488;">10 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Hồ Tây lộng gió, KĐT Ngoại Giao Đoàn, Công viên Hòa Bình, Đại lộ Tây Thăng Long</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Môi trường sinh thái trong lành, hạ tầng 10 làn xe</td>
            </tr>
            <tr>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#0D9488;">20 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Sân bay Quốc tế Nội Bài qua trục cầu Thăng Long và cầu Nhật Tân</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Thuận tiện tối đa cho doanh nhân & chuyên gia di chuyển</td>
            </tr>
        </tbody>
    </table>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/phoi-canh-toan-canh-chung-cu-jade-square-bac-tu-liem.jpg" alt="Toàn cảnh dự án Jade Square Bắc Từ Liêm" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Toàn cảnh tổ hợp Jade Square nằm trong lòng quần thể đô thị hiện đại và hệ thống hạ tầng đồng bộ</figcaption>
    </figure>

    <h2>3. Đòn Bẩy Hạ Tầng Đột Phá Đẩy Giá Bất Động Sản</h2>
    <p>
        Trong vòng 2-3 năm tới, giá trị căn hộ tại Jade Square sẽ được hỗ trợ mạnh mẽ bởi các đòn bẩy hạ tầng quan trọng:
    </p>
    <ul>
        <li><strong>Hoàn thiện Đại lộ Tây Thăng Long (rộng 60.5m, 10 làn xe):</strong> Trục xương sống kết nối từ Tây Hồ qua Bắc Từ Liêm đến Đan Phượng, Sơn Tây, biến khu vực quanh đường Nguyễn Đình Tứ thành trung tâm giao thương sầm uất.</li>
        <li><strong>Sự vận hành của hai tuyến Metro số 2 và số 6:</strong> Kinh nghiệm tại các nước phát triển cho thấy bất động sản nằm cạnh các ga Metro luôn có biên độ tăng giá từ 15% – 30% so với mặt bằng chung.</li>
        <li><strong>Quy hoạch chuyển dời 11 Bộ Ngành:</strong> Kéo theo hàng chục nghìn cán bộ, chuyên gia và nhân sự chất lượng cao đến làm việc và tìm kiếm nơi an cư chuẩn mực.</li>
    </ul>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#042F2C 0%,#0F766E 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#2DD4BF;font-size:22px;margin:0 0 10px;">Khám Phá Mặt Bằng Tòa Sapphire & 39 Tiện Ích Đẳng Cấp</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Tìm hiểu chi tiết thiết kế căn hộ và chính sách bán hàng đợt 1 trực tiếp từ chủ đầu tư.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/du-an/jade-square/" style="background:#0D9488;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Trang Tổng Quan Jade Square →</a>
            <a href="/mat-bang-du-an-jade-square/" style="background:#FFF;color:#0F766E;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Mặt Bằng Tòa Sapphire →</a>
        </div>
    </div>
</div>
HTML
    ],

    // BÀI 2: TIỆN ÍCH
    [
        'title'         => 'Hệ Thống 39 Tiện Ích Đẳng Cấp Tại Dự Án Jade Square: Trọn Vẹn Phong Cách Sống Đa Tầng',
        'slug'          => 'tien-ich-du-an-jade-square',
        'featured_id'   => $media_map['tong-mat-bang-39-tien-ich-dang-cap-jade-square'],
        'category_slug' => 'review-du-an',
        'focus_kw'      => 'Tiện ích dự án Jade Square',
        'meta_desc'     => 'Khám phá chi tiết 39 tiện ích đẳng cấp đa tầng tại dự án chung cư Jade Square: Bể bơi nước nóng 4 mùa, sân Pickleball, vườn thiền, đài ngắm sao Sky Garden tầng mái.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Tiện ích dự án Jade Square</strong> được định vị theo phong cách sống "đa tầng trải nghiệm" (Multi-layer Living) với tổng cộng <strong>39 tiện ích đặc quyền</strong> khép kín. Không chỉ dừng lại ở các tiện ích cơ bản, dự án kiến tạo một hành trình sống trọn vẹn: từ không gian sinh thái xanh mát dưới mặt đất, tổ hợp thể thao – thương mại trong nhà tầng 1-3, cho đến thiên đường thư giãn Sky Garden chạm mây tại tầng mái.
    </p>

    <div class="kbds-highlight-box" style="background:#F0FDFA;border-left:4px solid #0D9488;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#0D9488;font-size:17px;font-weight:700;">🌟 3 TẦNG TRẢI NGHIỆM TIỆN ÍCH ĐỘC BẢN JADE SQUARE</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Tầng 1 (Mặt đất & Ngoài trời):</strong> Quảng trường Ngọc Bích, bể bơi nước nóng, sân thể thao Pickleball, bóng rổ, công viên Ngọc Lam.</li>
            <li><strong>Tầng 1 - 3 (Trong nhà):</strong> Khối đế thương mại dịch vụ sầm uất, trường mầm non, thư viện thiếu nhi, gym-yoga, CLB bi-a, bóng bàn.</li>
            <li><strong>Tầng mái (Sky Garden):</strong> Đài quan sát viễn vọng ngắm thành phố, vườn thiền tĩnh tâm, đường đá massage chân, vườn nướng BBQ.</li>
        </ul>
    </div>

    <h2>1. Tổng Mặt Bằng Phân Bổ 39 Tiện Ích Đẳng Cấp</h2>
    <p>
        Tại <a href="/du-an/jade-square/" style="color:#0D9488;font-weight:700;">Jade Square</a>, mỗi tiện ích được trau chuốt như một tác phẩm nghệ thuật, mang biểu tượng viên ngọc bích quý phái phản chiếu nguồn năng lượng tươi mới cho cư dân.
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/tong-mat-bang-39-tien-ich-dang-cap-jade-square.jpg" alt="Tổng mặt bằng 39 tiện ích đẳng cấp Jade Square" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Sơ đồ quy hoạch chi tiết 39 tiện ích trong nhà, ngoài trời và tầng mái tại chung cư Jade Square</figcaption>
    </figure>

    <h2>2. Tiện Ích Ngoài Trời: Sống Khỏe Cùng Thiên Nhiên</h2>
    <ul>
        <li><strong>Bể bơi nước nóng 4 mùa:</strong> Thiết kế uốn lượn phong cách resort với làn nước trong vắt, hệ thống gia nhiệt hiện đại phục vụ nhu cầu bơi lội quanh năm.</li>
        <li><strong>Sân thể thao Pickleball & Bóng rổ:</strong> Đón đầu xu hướng thể thao thời thượng nhất hiện nay, tạo sân chơi kết nối cộng đồng văn minh.</li>
        <li><strong>Hệ thống an ninh 3 lớp:</strong> Camera thông minh nhận diện khuôn mặt, thẻ từ phân tầng thang máy và đội ngũ bảo vệ chuyên nghiệp trực 24/7.</li>
        <li><strong>Khu vui chơi trẻ em & Khu thư giãn người cao tuổi:</strong> Bố trí xen kẽ dưới những tán cây xanh rợp bóng của Công viên Ngọc Lam.</li>
    </ul>

    <h2>3. Tiện Ích Trong Nhà Tầng 1 Đến Tầng 3: Đáp Ứng Mọi Nhu Cầu Mua Sắm & Rèn Luyện</h2>
    <p>
        Cư dân không cần phải bước chân ra khỏi tòa nhà để tận hưởng các dịch vụ cao cấp:
    </p>
    <ul>
        <li><strong>Khối đế thương mại tầng 1-2:</strong> Chuỗi siêu thị, cửa hàng tiện lợi, nhà hàng ẩm thực, cafe sân vườn cao cấp.</li>
        <li><strong>Trường mầm non chuẩn quốc tế (Tầng 1):</strong> Mang lại sự an tâm tuyệt đối cho các bậc cha mẹ khi gửi gắm con em ngay dưới chân nhà.</li>
        <li><strong>Tổ hợp thể thao & giải trí trong nhà (Tầng 3):</strong> Phòng Gym & Yoga cao cấp, khu đánh bóng bàn, bàn bi-a, bi lắc và không gian sáng tạo dành riêng cho trẻ em.</li>
    </ul>

    <h2>4. Tiện Ích Tầng Mái Sky Garden: Thư Giãn Giữa Lưng Chừng Trời</h2>
    <p>
        Tầng mái của tòa nhà được biến thành một khu nghỉ dưỡng trên cao tuyệt mỹ:
    </p>
    <ul>
        <li><strong>Đài quan sát & Kính viễn vọng thiên văn:</strong> Điểm ngắm toàn cảnh hồ Tây, cầu Nhật Tân và pháo hoa rực rỡ vào mỗi dịp lễ hội.</li>
        <li><strong>Khu vườn thiền & Sân tập Yoga:</strong> Nơi tái tạo năng lượng thể chất và tinh thần sau những giờ làm việc căng thẳng.</li>
        <li><strong>Đường đá massage chân & Vườn BBQ:</strong> Nơi quây quần ấm cúng của các gia đình bên những bữa tiệc nướng cuối tuần.</li>
    </ul>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/phoi-canh-toa-can-ho-sapphire-jade-square.jpg" alt="Phối cảnh kiến trúc tháp Sapphire Jade Square" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Thiết kế mặt đứng kính tràn hiện đại của tháp căn hộ Sapphire Jade Square</figcaption>
    </figure>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#042F2C 0%,#0F766E 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#2DD4BF;font-size:22px;margin:0 0 10px;">Đăng Ký Tham Quan Căn Hộ Mẫu & Trải Nghiệm Tiện Ích</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Liên hệ ngay đội ngũ chuyên viên Kênh Bất Động Sản để nhận vé mời trải nghiệm thực tế dự án Jade Square.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/mat-bang-du-an-jade-square/" style="background:#0D9488;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Mặt Bằng Tầng Điển Hình →</a>
            <a href="/thiet-ke-can-ho-2-pn-du-an-jade-square/" style="background:#FFF;color:#0F766E;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Thiết Kế Căn 2PN →</a>
        </div>
    </div>
</div>
HTML
    ],

    // BÀI 3: MẶT BẰNG
    [
        'title'         => 'Mặt Bằng Tòa Sapphire Dự Án Jade Square: Chi Tiết Tầng 04-24 & Tầng 25-26',
        'slug'          => 'mat-bang-du-an-jade-square',
        'featured_id'   => $media_map['mat-bang-tang-dien-hinh-tang-04-24-toa-sapphire-jade-square'],
        'category_slug' => 'review-du-an',
        'focus_kw'      => 'Mặt bằng dự án Jade Square',
        'meta_desc'     => 'Phân tích chi tiết mặt bằng Tòa Sapphire dự án Jade Square Bắc Từ Liêm: Quy hoạch 26 tầng, mật độ 9-11 căn/sàn, 5 thang máy tốc độ cao, cơ cấu căn hộ 2PN - 4PN.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Mặt bằng dự án Jade Square (Tòa Sapphire - J3)</strong> ghi điểm mạnh mẽ với khách hàng nhờ quy hoạch thông minh và mật độ căn hộ siêu lý tưởng: chỉ <strong>11 căn/sàn</strong> tại tầng 04 – 24 và giảm xuống chỉ còn <strong>9 căn/sàn</strong> tại tầng cao 25 – 26. Với cụm 5 thang máy tốc độ cao chuyên biệt, cư dân tại đây được tận hưởng không gian sống riêng tư, tĩnh lặng và an toàn tuyệt đối.
    </p>

    <div class="kbds-highlight-box" style="background:#F0FDFA;border-left:4px solid #0D9488;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#0D9488;font-size:17px;font-weight:700;">📐 THÔNG SỐ MẶT BẰNG TÒA SAPPHIRE JADE SQUARE</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Chiều cao:</strong> 26 tầng nổi + 3 tầng hầm thông minh để xe.</li>
            <li><strong>Tầng 1 – 3:</strong> Sảnh đón tiếp 5 sao, khối đế thương mại, trường mầm non & tổ hợp tiện ích trong nhà.</li>
            <li><strong>Tầng 04 – 24:</strong> Mật độ 11 căn/sàn (Gồm căn 2PN, 2PN góc và căn 3PN).</li>
            <li><strong>Tầng 25 – 26:</strong> Mật độ 9 căn/sàn (Gồm căn 2PN, 3PN và các căn 4PN VIP).</li>
            <li><strong>Hệ thống giao thông đứng:</strong> 5 thang máy tốc độ cao + 2 thang bộ thoát hiểm tiêu chuẩn PCCC mới nhất.</li>
        </ul>
    </div>

    <h2>1. Chi Tiết Mặt Bằng Tầng Điển Hình 04 – 24 (11 Căn/Sàn)</h2>
    <p>
        Từ tầng 4 đến tầng 24 là không gian các tầng căn hộ tiêu chuẩn, được bố trí vuông vức dọc theo hành lang thông thoáng:
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/mat-bang-tang-dien-hinh-tang-04-24-toa-sapphire-jade-square.jpg" alt="Mặt bằng tầng 04-24 tòa Sapphire Jade Square" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Mặt bằng tầng 04 - 24 tòa Sapphire Jade Square: 11 căn/sàn với đa dạng diện tích từ 72m² đến 127.8m²</figcaption>
    </figure>

    <p>
        Phân bổ căn hộ trên mặt sàn tầng 04 - 24:
    </p>
    <ul>
        <li><strong>Căn hộ CH 01 & CH 11 (2PN):</strong> Diện tích thông thủy 76.17 m².</li>
        <li><strong>Căn hộ CH 02 & CH 10 (2PN):</strong> Diện tích thông thủy 72.03 m² – Lựa chọn tối ưu ngân sách.</li>
        <li><strong>Căn hộ CH 03 & CH 09 (2PN Góc):</strong> Diện tích 79.91 m² – Vị trí góc 2 mặt thoáng view rộng mở.</li>
        <li><strong>Căn hộ CH 04 & CH 08 (3PN):</strong> Diện tích 127.82 m² – Không gian sống rộng lớn cho gia đình đa thế hệ.</li>
        <li><strong>Căn hộ CH 05 & CH 07 (2PN):</strong> Diện tích 80.26 m².</li>
        <li><strong>Căn hộ CH 06 (2PN):</strong> Diện tích 85.53 m² – Căn 2PN diện tích lớn hiếm có trên thị trường.</li>
    </ul>

    <h2>2. Chi Tiết Mặt Bằng Tầng Cao 25 – 26 (9 Căn/Sàn)</h2>
    <p>
        Tầng 25 và 26 là các tầng cao nhất của tòa tháp, nơi mật độ được giảm xuống chỉ còn <strong>9 căn/sàn</strong>, nhường chỗ cho các căn hộ 4 phòng ngủ siêu sang:
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/mat-bang-tang-dien-hinh-tang-25-26-toa-sapphire-jade-square.jpg" alt="Mặt bằng tầng 25-26 tòa Sapphire Jade Square" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Mặt bằng tầng 25 - 26 tòa Sapphire Jade Square: Mật độ chỉ 9 căn/sàn với sự xuất hiện của các siêu căn hộ 4PN VIP</figcaption>
    </figure>

    <p>
        Điểm nhấn tại tầng 25-26 là sự xuất hiện của <strong>Căn hộ CH 02 & CH 08 (4PN)</strong> diện tích lên tới <strong>154.02 m²</strong>. Đây là các căn penthouse thu nhỏ dành riêng cho những gia chủ thành đạt cần không gian sinh hoạt rộng rãi và tầm view không giới hạn nhìn trọn hồ Tây.
    </p>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#042F2C 0%,#0F766E 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#2DD4BF;font-size:22px;margin:0 0 10px;">Tải File Bản Vẽ Mặt Bằng Độ Nét Cao (PDF/CAD)</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Nhận ngay trọn bộ hồ sơ bản vẽ mặt bằng và danh sách bảng giá căn tầng đẹp Tòa Sapphire.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/thiet-ke-can-ho-2-pn-du-an-jade-square/" style="background:#0D9488;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Layout Căn 2PN →</a>
            <a href="/thiet-ke-can-ho-3-4-pn-du-an-jade-square/" style="background:#FFF;color:#0F766E;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Layout Căn 3PN & 4PN →</a>
        </div>
    </div>
</div>
HTML
    ],

    // BÀI 4: THIẾT KẾ CĂN 2PN
    [
        'title'         => 'Thiết Kế Căn Hộ 2 Phòng Ngủ Dự Án Jade Square: Tối Ưu Không Gian, Đa Dạng Diện Tích 71m² - 85m²',
        'slug'          => 'thiet-ke-can-ho-2-pn-du-an-jade-square',
        'featured_id'   => $media_map['thiet-ke-layout-can-ho-2-phong-ngu-jade-square'],
        'category_slug' => 'review-du-an',
        'focus_kw'      => 'Thiết kế căn hộ 2 PN dự án Jade Square',
        'meta_desc'     => 'Đánh giá chi tiết thiết kế căn hộ 2 phòng ngủ dự án Jade Square: Căn 2PN thường (71.4m² - 85.5m²) và căn 2PN góc (79.9m²), 2 logia thoáng mát, kính tràn sang trọng.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Thiết kế căn hộ 2 phòng ngủ dự án Jade Square</strong> là dòng sản phẩm chủ đạo chiếm số lượng lớn nhất tại Tòa Sapphire với <strong>199 căn hộ</strong> (gồm 157 căn thường và 42 căn góc). Sở hữu dải diện tích thông thủy đa dạng từ <strong>71.41 m² đến 85.55 m²</strong>, căn hộ 2 phòng ngủ tại <a href="/du-an/jade-square/" style="color:#0D9488;font-weight:700;">Jade Square</a> mang lại giải pháp an cư hoàn mỹ cho các gia đình trẻ và giới chuyên gia làm việc tại khu vực Tây Hồ Tây.
    </p>

    <div class="kbds-highlight-box" style="background:#F0FDFA;border-left:4px solid #0D9488;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#0D9488;font-size:17px;font-weight:700;">🏠 THÔNG TIN CĂN HỘ 2 PHÒNG NGỦ JADE SQUARE</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Căn 2PN thường (157 căn):</strong> Diện tích thông thủy 71.41 m² – 85.55 m² (Tim tường 77.69 – 93.16 m²).</li>
            <li><strong>Căn 2PN góc (42 căn):</strong> Diện tích thông thủy 79.91 m² (Tim tường 88.66 m²).</li>
            <li><strong>Bố trí công năng:</strong> 2 Phòng ngủ riêng biệt + 2 Nhà vệ sinh + Phòng khách + Bếp + 2 Logia.</li>
            <li><strong>Hình thức sở hữu:</strong> Sổ hồng sở hữu lâu dài.</li>
        </ul>
    </div>

    <h2>1. Thiết Kế Căn Hộ 2 Phòng Ngủ Tiêu Chuẩn (71.41 m² – 85.55 m²)</h2>
    <p>
        Căn hộ 2PN tiêu chuẩn tại Jade Square sở hữu lối thiết kế vuông vắn, phân chia khu vực động (phòng khách, bếp) và khu vực tĩnh (phòng ngủ) vô cùng khoa học.
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/thiet-ke-layout-can-ho-2-phong-ngu-jade-square.jpg" alt="Layout căn hộ 2 phòng ngủ Jade Square" style="width:100%;max-width:880px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Bản vẽ layout chi tiết căn hộ 2 phòng ngủ tiêu chuẩn tại tòa Sapphire dự án Jade Square</figcaption>
    </figure>

    <p>
        Ưu điểm nổi trội của căn hộ 2PN thường:
    </p>
    <ul>
        <li><strong>Bếp nấu riêng biệt kết nối logia:</strong> Gian bếp được bố trí gọn gàng, có cửa thông thẳng ra logia phụ giúp thoát mùi nấu nướng nhanh chóng, không ám mùi vào phòng khách.</li>
        <li><strong>Hai phòng ngủ đón ánh sáng tự nhiên:</strong> Cả 2 phòng ngủ đều có cửa sổ kính khổ lớn, không góc chết. Phòng ngủ Master có phòng tắm riêng tư khép kín.</li>
        <li><strong>Ban công phòng khách rộng mở:</strong> Nơi lý tưởng để đặt bàn trà thư giãn và trồng cây cảnh xanh tươi.</li>
    </ul>

    <h2>2. Thiết Kế Căn Hộ 2 Phòng Ngủ Góc Đặc Quyền (79.91 m²)</h2>
    <p>
        Căn hộ 2PN góc là lựa chọn được săn đón nhất trong các đợt mở bán nhờ sở hữu <strong>2 mặt thoáng</strong> với tầm nhìn panorama rộng mở:
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/thiet-ke-layout-can-ho-2-phong-ngu-goc-jade-square.jpg" alt="Layout căn hộ 2 phòng ngủ góc Jade Square" style="width:100%;max-width:880px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Bản vẽ layout căn hộ 2 phòng ngủ góc 79.91 m² với 2 mặt thoáng view toàn cảnh</figcaption>
    </figure>

    <p>
        Với diện tích thông thủy 79.91 m² (tim tường 88.66 m²), căn góc tận dụng tối đa ánh sáng tự nhiên từ hai hướng khác nhau, tạo luồng gió đối lưu tự nhiên mát mẻ quanh năm và tiết kiệm đáng kể năng lượng điện chiếu sáng, làm mát.
    </p>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#042F2C 0%,#0F766E 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#2DD4BF;font-size:22px;margin:0 0 10px;">Nhận Bảng Giá Căn Hộ 2PN Đợt 1 Tòa Sapphire</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Đăng ký để nhận danh sách quỹ căn 2PN tầng đẹp, view thoáng và chính sách chiết khấu tốt nhất.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/thiet-ke-can-ho-3-4-pn-du-an-jade-square/" style="background:#0D9488;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Tiếp Căn 3PN & 4PN →</a>
            <a href="/mat-bang-du-an-jade-square/" style="background:#FFF;color:#0F766E;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Mặt Bằng Toàn Tòa →</a>
        </div>
    </div>
</div>
HTML
    ],

    // BÀI 5: THIẾT KẾ CĂN 3PN & 4PN
    [
        'title'         => 'Thiết Kế Căn Hộ 3PN & 4PN Dự Án Jade Square: Đỉnh Cao Không Gian Sống Rộng Lớn Cho Giới Thượng Lưu',
        'slug'          => 'thiet-ke-can-ho-3-4-pn-du-an-jade-square',
        'featured_id'   => $media_map['thiet-ke-layout-can-ho-3-phong-ngu-jade-square'],
        'category_slug' => 'review-du-an',
        'focus_kw'      => 'Thiết kế căn hộ 3PN 4PN dự án Jade Square',
        'meta_desc'     => 'Khám phá chi tiết thiết kế căn hộ 3PN (127m²) và căn hộ 4PN VIP (154m²) tại dự án Jade Square Bắc Từ Liêm: Không gian sống đẳng cấp, ban công siêu rộng cho giới thượng lưu.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Thiết kế căn hộ 3PN & 4PN dự án Jade Square</strong> là biểu tượng của phong cách sống vương giả và tiện nghi bậc nhất tại khu Tây Hà Nội. Với diện tích thông thủy từ <strong>127.43 m² đến 154.02 m²</strong>, các căn hộ diện tích lớn tại Tòa Sapphire mang đến không gian sinh hoạt khoáng đạt, đáp ứng trọn vẹn nhu cầu của những gia đình đa thế hệ thành đạt và cộng đồng tinh hoa.
    </p>

    <div class="kbds-highlight-box" style="background:#F0FDFA;border-left:4px solid #0D9488;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#0D9488;font-size:17px;font-weight:700;">💎 ĐẶC QUYỀN CĂN HỘ DIỆN TÍCH LỚN JADE SQUARE</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Căn hộ 3 Phòng Ngủ:</strong> Diện tích thông thủy 127.43 – 127.86 m² (Tim tường 138.46 m²), số lượng 46 căn.</li>
            <li><strong>Căn hộ 4 Phòng Ngủ VIP:</strong> Diện tích thông thủy 154.02 m² (Tim tường 166.35 m²), chỉ 4 căn độc bản tại tầng 25 – 26.</li>
            <li><strong>Phòng khách Panorama:</strong> Thiết kế phòng khách và phòng ăn siêu rộng trên 40m², ban công trải dài.</li>
            <li><strong>Tầm view đắt giá:</strong> Ôm trọn vẻ đẹp lộng lẫy của hồ Tây, cầu Nhật Tân và công viên sinh thái nội khu.</li>
        </ul>
    </div>

    <h2>1. Thiết Kế Căn Hộ 3 Phòng Ngủ (127.43 m² – 127.86 m²)</h2>
    <p>
        Căn hộ 3PN tại <a href="/du-an/jade-square/" style="color:#0D9488;font-weight:700;">Jade Square</a> được bố trí tại các vị trí đẹp nhất của mặt sàn, sở hữu không gian mở sang trọng vượt trội:
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/thiet-ke-layout-can-ho-3-phong-ngu-jade-square.jpg" alt="Layout căn hộ 3 phòng ngủ Jade Square" style="width:100%;max-width:880px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Layout căn hộ 3 phòng ngủ 127.43m² - 127.86m²: Không gian tiếp khách và bàn ăn sang trọng như biệt thự trên không</figcaption>
    </figure>

    <p>
        Điểm sáng giá của căn 3PN:
    </p>
    <ul>
        <li><strong>Phòng ngủ Master rộng lớn:</strong> Tích hợp phòng tắm cao cấp với bồn tắm nằm sang trọng, vách kính đứng và không gian tủ đồ Walk-in Closet.</li>
        <li><strong>Hai phòng ngủ phụ vuông vắn:</strong> Thiết kế tách biệt đảm bảo không gian riêng tư cho con cái hoặc ông bà.</li>
        <li><strong>Bếp nấu có đảo bếp (Kitchen Island):</strong> Đem lại trải nghiệm ẩm thực đẳng cấp 5 sao ngay tại tư gia.</li>
    </ul>

    <h2>2. Căn Hộ 4 Phòng Ngủ VIP – 4 Căn Độc Bản Dành Riêng Cho Giới Thượng Lưu</h2>
    <p>
        Chỉ có đúng <strong>4 căn hộ 4PN</strong> duy nhất trong toàn bộ tòa tháp, tọa lạc tại tầng 25 và 26:
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/thiet-ke-layout-can-ho-4-phong-ngu-jade-square.jpg" alt="Layout căn hộ 4 phòng ngủ Jade Square" style="width:100%;max-width:880px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Layout siêu căn hộ 4 phòng ngủ VIP diện tích thông thủy 154.02 m² tại tầng 25-26 Tòa Sapphire</figcaption>
    </figure>

    <p>
        Với diện tích thông thủy lên đến <strong>154.02 m² (tim tường 166.35 m²)</strong>, căn hộ 4PN được ví như một "dinh thự trên không":
    </p>
    <ul>
        <li>Bố trí 4 phòng ngủ rộng rãi cùng 3 nhà vệ sinh tiện nghi.</li>
        <li>Ban công lớn kịch trần với hệ kính Low-E cản nhiệt, ngắm toàn cảnh thành phố về đêm lung linh.</li>
        <li>Không gian lý tưởng cho các gia đình có 3 thế hệ cùng chung sống đầm ấm mà vẫn đảm bảo tính riêng tư tối cao.</li>
    </ul>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#042F2C 0%,#0F766E 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#2DD4BF;font-size:22px;margin:0 0 10px;">Đăng Ký Đặt Chỗ Suất Ngoại Giao Căn 3PN & 4PN</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Liên hệ ngay hotline chuyên viên Kênh Bất Động Sản để được hỗ trợ chính sách giá và suất đỗ xe định danh ưu tiên.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/du-an/jade-square/" style="background:#0D9488;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Tổng Quan Dự Án Jade Square →</a>
            <a href="/tien-ich-du-an-jade-square/" style="background:#FFF;color:#0F766E;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Hệ Thống 39 Tiện Ích →</a>
        </div>
    </div>
</div>
HTML
    ],
];

echo "==============================================================\n";
echo "🚀 BẮT ĐẦU TẠO 5 BÀI VIẾT VỆ TINH JADE SQUARE\n";
echo "==============================================================\n";

foreach ($satellite_posts as $item) {
    $existing = get_page_by_path($item['slug'], OBJECT, 'post');
    $cat = get_category_by_slug($item['category_slug']);
    $cat_ids = $cat ? [$cat->term_id] : [1];

    $post_data = [
        'post_title'    => $item['title'],
        'post_name'     => $item['slug'],
        'post_content'  => $item['content'],
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_category' => $cat_ids,
        'post_author'   => 1,
    ];

    if ($existing) {
        $post_data['ID'] = $existing->ID;
        $pid = wp_update_post($post_data);
        echo " ✔ Đã cập nhật bài viết: [{$item['title']}] (ID: {$pid})\n";
    } else {
        $pid = wp_insert_post($post_data);
        echo " + Đã tạo mới bài viết: [{$item['title']}] (ID: {$pid})\n";
    }

    if ($pid && !is_wp_error($pid)) {
        set_post_thumbnail($pid, $item['featured_id']);

        // Rank Math SEO & liên kết dự án mẹ
        update_post_meta($pid, 'rank_math_title', $item['title'] . ' | Kênh Bất Động Sản');
        update_post_meta($pid, 'rank_math_description', $item['meta_desc']);
        update_post_meta($pid, 'rank_math_focus_keyword', $item['focus_kw']);
        update_post_meta($pid, '_kbds_project_ref', $proj_id);
        update_post_meta($pid, '_kbds_project_slug', $proj_slug);
        echo "   -> Gán Featured Image (ID: {$item['featured_id']}) & Rank Math SEO thành công.\n";
    }
}

echo "==============================================================\n";
echo "🎉 HOÀN THÀNH TẠO 5 BÀI VIẾT VỆ TINH JADE SQUARE TRÊN LOCALHOST!\n";
echo "==============================================================\n";
