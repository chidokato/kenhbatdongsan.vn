<?php
/**
 * Script tạo 5 bài viết vệ tinh chuẩn SEO cho dự án Lalalay Residences
 */
require_once __DIR__ . '/../wp-load.php';

// Base URL cho ảnh
$upload_dir = wp_upload_dir();
$base_upload_url = $upload_dir['baseurl'];

// Danh sách bài viết vệ tinh
$satellite_posts = [
    // BÀI 1: VỊ TRÍ
    [
        'title'         => 'Vị Trí Dự Án Lalalay Residences: Tâm Điểm Kết Nối Đại Lộ Thăng Long & Vành Đai 3.5',
        'slug'          => 'vi-tri-du-an-lalalay-residences',
        'featured_id'   => 161, // vi-tri-du-an-lalalay-residences-dai-lo-thang-long
        'category_slug' => 'quy-hoach-ha-tang',
        'focus_kw'      => 'Vị trí dự án Lalalay Residences',
        'meta_desc'     => 'Phân tích chi tiết vị trí dự án Lalalay Residences Bắc An Khánh: Giao điểm vàng Đại lộ Thăng Long & Vành đai 3.5, kết nối Mỹ Đình 15 phút, đón đầu Metro số 5.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Vị trí dự án Lalalay Residences</strong> tọa lạc tại quỹ đất vàng thuộc khu đô thị Bắc An Khánh (Hoài Đức, Hà Nội), ngay giao lộ huyết mạch giữa <strong>Đại lộ Thăng Long</strong> và tuyến <strong>Vành đai 3.5</strong>. Đây được xem là tọa độ phồn vinh bậc nhất khu vực Tây Thủ Đô, nơi đón đầu làn sóng dịch chuyển trung tâm hành chính mới và tiềm năng bứt phá giá trị khi Hoài Đức chính thức lên Quận.
    </p>

    <div class="kbds-highlight-box" style="background:#FFF9F5;border-left:4px solid #C2562B;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#C2562B;font-size:17px;font-weight:700;">📍 TỔNG QUAN TỌA ĐỘ VÀNG LALALAY RESIDENCES</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Địa chỉ chính xác:</strong> Khu đô thị Bắc An Khánh, Hoài Đức, TP. Hà Nội.</li>
            <li><strong>Tâm điểm hạ tầng:</strong> Mặt tiền trục kết nối Đại lộ Thăng Long & tuyến đường Vành đai 3.5.</li>
            <li><strong>Hạ tầng tương lai:</strong> Kế cận tuyến đường sắt đô thị Metro số 5 (Văn Cao – Ngọc Khánh – Láng – Hòa Lạc).</li>
            <li><strong>Dự án liên kết chính:</strong> <a href="/du-an/lalalay-residences/" style="color:#C2562B;font-weight:700;">Lalalay Residences</a> do Ramoori Holdings phát triển.</li>
        </ul>
    </div>

    <h2>1. Tâm Điểm Kết Nối Hạ Tầng Giao Thông Phía Tây Hà Nội</h2>
    <p>
        Khu Tây Hà Nội trong hơn một thập kỷ qua luôn giữ vững vị thế là tâm điểm đầu tư hạ tầng mạnh mẽ nhất Thủ đô. Sự xuất hiện của <strong>Lalalay Residences</strong> tại Bắc An Khánh thừa hưởng trọn vẹn toàn bộ mạng lưới giao thông liên vùng đã hoàn thiện và đang tiếp tục nâng cấp mở rộng.
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/vi-tri-du-an-lalalay-residences-dai-lo-thang-long.jpg" alt="Vị trí dự án Lalalay Residences Đại lộ Thăng Long" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Sơ đồ vị trí kim cương của dự án Lalalay Residences tại Bắc An Khánh, đón đầu giao điểm Đại lộ Thăng Long và Vành đai 3.5</figcaption>
    </figure>

    <p>
        Từ vị trí dự án, cư dân dễ dàng di chuyển nhanh chóng tới mọi khu vực trọng yếu:
    </p>
    <ul>
        <li><strong>Trục Đại lộ Thăng Long:</strong> Trục cao tốc đô thị hiện đại nhất miền Bắc với 12-16 làn xe, giúp việc di chuyển vào trung tâm Mỹ Đình, Cầu Giấy và Trung tâm Hội nghị Quốc gia chỉ mất đúng <strong>12 – 15 phút</strong> chạy xe.</li>
        <li><strong>Tuyến Vành đai 3.5:</strong> Kết nối trực tiếp từ Bắc An Khánh sang Hà Đông, Thanh Trì, Cầu Thượng Cát sang Bắc Từ Liêm và Đông Anh, biến nơi đây thành ngã tư giao thương sầm uất.</li>
        <li><strong>Tuyến Metro số 5 (Văn Cao – Hòa Lạc):</strong> Khi đi vào vận hành, các ga depot Metro quanh khu vực An Khánh sẽ mở ra phương tiện giao thông công cộng hiện đại bậc nhất, rút ngắn tối đa thời gian di chuyển vào nội thành.</li>
    </ul>

    <h2>2. Liên Kết Vùng Đắt Giá: 15 Phút Chạm Ngàn Tiện Ích</h2>
    <p>
        Được định vị là dòng sản phẩm căn hộ hạng sang, Lalalay Residences sở hữu bán kính liên kết vùng vô cùng ấn tượng. Trong vòng 5 - 15 phút, cư dân tiếp cận toàn bộ các trung tâm hành chính, tài chính, giáo dục và y tế chuẩn quốc tế của Thủ đô:
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/ket-noi-15-phut-lalalay-residences.jpg" alt="Liên kết vùng 15 phút Lalalay Residences" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Bản đồ kết nối 15 phút từ Lalalay Residences tới các trung tâm vui chơi, giải trí và học tập hàng đầu</figcaption>
    </figure>

    <table style="width:100%;border-collapse:collapse;margin:24px 0;font-size:14.5px;">
        <thead>
            <tr style="background:#0B2C4D;color:#FFF;">
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Thời gian</th>
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Địa điểm & Tiện ích kết nối</th>
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Tuyến đường di chuyển</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#C2562B;">3 – 5 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">KĐT Splendora Bắc An Khánh, Vinhomes Smart City, Thiên Đường Bảo Sơn</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Đại lộ Thăng Long, Vành đai 3.5</td>
            </tr>
            <tr style="background:#F8FAFC;">
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#C2562B;">8 – 10 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Trung tâm Hội nghị Quốc gia, Khách sạn JW Marriott, Bảo tàng Hà Nội, BigC Thăng Long</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Đại lộ Thăng Long thẳng tiến</td>
            </tr>
            <tr>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#C2562B;">12 – 15 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Keangnam Landmark 72, SVĐ Quốc gia Mỹ Đình, ĐH Quốc Gia Hà Nội, ĐH Sư Phạm</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Trục Phạm Hùng – Lê Quang Đạo mở rộng</td>
            </tr>
            <tr style="background:#F8FAFC;">
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#C2562B;">20 – 25 phút</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Khu Công nghệ cao Hòa Lạc, Đại học FPT, Tổ hợp R&D Quốc tế</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Cao tốc Láng – Hòa Lạc</td>
            </tr>
        </tbody>
    </table>

    <h2>3. Đòn Bẩy Tăng Giá Từ Quy Hoạch Lên Quận & Hạ Tầng Tương Lai</h2>
    <p>
        Không chỉ mang đến trải nghiệm sống thuận tiện cho cư dân, <strong>vị trí dự án Lalalay Residences</strong> còn là tài sản tích lũy có tỷ suất sinh lời vượt trội nhờ 3 xung lực quy hoạch lớn:
    </p>
    <ol>
        <li><strong>Hoài Đức lên Quận:</strong> Khi Hoài Đức chính thức lên Quận, toàn bộ hệ thống hạ tầng chiếu sáng, cấp thoát nước, công viên cây xanh và quy chuẩn dịch vụ công sẽ được đồng bộ theo tiêu chuẩn đô thị loại 1, kéo theo mặt bằng giá bất động sản gia tăng mạnh mẽ.</li>
        <li><strong>Lực đẩy từ Đại học & Trung tâm Đổi mới Sáng tạo:</strong> Tuyến cao tốc nối thẳng tới Khu Công nghệ cao Hòa Lạc giúp Lalalay Residences đón đầu lượng lớn chuyên gia cao cấp, kỹ sư công nghệ và giảng viên tìm kiếm không gian an cư chất lượng cao.</li>
        <li><strong>Sự cộng hưởng từ các đại đô thị lân cận:</strong> Nằm liền kề quần thể Splendora và Vinhomes Smart City, cư dân Lalalay Residences vừa tận hưởng môi trường sống riêng tư, văn minh vừa dễ dàng thụ hưởng chuỗi trung tâm thương mại Vincom Mega Mall, trường học liên cấp Vinschool và bệnh viện đa khoa quốc tế Vinmec.</li>
    </ol>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#0B2C4D 0%,#1A4670 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#F6C000;font-size:22px;margin:0 0 10px;">Khám Phá Chi Tiết Mặt Bằng & Quỹ Căn Đẹp Đợt 1</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Tìm hiểu chi tiết cơ cấu mặt bằng căn hộ và chính sách ưu đãi mở bán Tòa LALA 1 dự án Lalalay Residences.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/du-an/lalalay-residences/" style="background:#C2562B;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Trang Dự Án Lalalay Residences →</a>
            <a href="/mat-bang-du-an-lalalay-residences/" style="background:#FFF;color:#0B2C4D;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Chi Tiết Mặt Bằng →</a>
        </div>
    </div>
</div>
HTML
    ],

    // BÀI 2: TIỆN ÍCH
    [
        'title'         => 'Hệ Thống Tiện Ích Dự Án Lalalay Residences: Chuẩn Sống Nghỉ Dưỡng Thượng Lưu Tại Phía Tây Hà Nội',
        'slug'          => 'tien-ich-du-an-lalalay-residences',
        'featured_id'   => 165, // tien-ich-noi-khu-toa-lala-4-lalalay-residences
        'category_slug' => 'review-du-an',
        'focus_kw'      => 'Tiện ích dự án Lalalay Residences',
        'meta_desc'     => 'Khám phá trọn vẹn chuỗi tiện ích dự án Lalalay Residences Bắc An Khánh: Bể bơi resort, vườn chân mây Sky Garden, khối đế thương mại TMDV, kiến trúc Terracotta độc bản.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Tiện ích dự án Lalalay Residences</strong> được chủ đầu tư Ramoori Holdings và đơn vị tư vấn thiết kế quốc tế STELLAR kiến tạo theo phong cách nghỉ dưỡng thượng lưu (Resort Living). Lấy cảm hứng từ chất liệu đất nung ấm áp Terracotta phối hợp hài hòa cùng công viên cây xanh mặt nước, dự án mang đến trải nghiệm sống như tại khu nghỉ dưỡng 5 sao giữa lòng phía Tây Hà Nội.
    </p>

    <div class="kbds-highlight-box" style="background:#FFF9F5;border-left:4px solid #C2562B;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#C2562B;font-size:17px;font-weight:700;">🌟 ĐIỂM NHẤN TIỆN ÍCH NỔI BẬT LALALAY RESIDENCES</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Quy mô tiện ích:</strong> 2 tầng khối đế thương mại dịch vụ (TMDV) sầm uất và 3 tầng hầm thông minh.</li>
            <li><strong>Kiến trúc cảnh quan:</strong> Cổng chào biểu tượng uốn lượn phong cách Terracotta & đài phun nước nghệ thuật.</li>
            <li><strong>Không gian rèn luyện sức khỏe:</strong> Bể bơi nhiệt đới ngoài trời, đường chạy bộ liên tòa, phòng Gym & Yoga tiêu chuẩn quốc tế.</li>
            <li><strong>Tiện ích trên cao:</strong> Sky Garden chân mây, khu ngắm hoàng hôn, vườn nướng BBQ ngoài trời.</li>
        </ul>
    </div>

    <h2>1. Quảng Trường Cảnh Quan Terracotta & Cổng Chào Biểu Tượng</h2>
    <p>
        Bước chân vào <a href="/du-an/lalalay-residences/" style="color:#C2562B;font-weight:700;">Lalalay Residences</a>, cư dân sẽ bị ấn tượng ngay bởi kiến trúc cổng vòm uốn lượn bằng gam màu đất nung ấm cúng. Thiết kế này phá vỡ cảm giác thô cứng của các khối bê tông thông thường, thay vào đó là những đường cong mềm mại tựa như những tác phẩm điêu khắc nghệ thuật đương đại.
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/tien-ich-noi-khu-toa-lala-4-lalalay-residences.jpg" alt="Tiện ích nội khu Lalalay Residences Tòa Lala 4" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Không gian tiện ích nội khu chân tháp Lalalay Residences với quảng trường bậc thang và cảnh quan nhiệt đới</figcaption>
    </figure>

    <p>
        Quảng trường trung tâm được quy hoạch các đài phun nước tương tác, các bậc thang cảnh quan rộng lớn làm nơi thư giãn, sinh hoạt cộng đồng và tổ chức các sự kiện văn hóa ngoài trời cho cư dân.
    </p>

    <h2>2. Bể Bơi Phong Cách Resort & Chuỗi Tiện Ích Chăm Sóc Sức Khỏe</h2>
    <p>
        Sức khỏe thể chất và tinh thần là trọng tâm trong định hướng thiết kế của Ramoori Holdings. Tại Lalalay Residences, cư dân được tận hưởng chuỗi tiện ích Wellness toàn diện:
    </p>
    <ul>
        <li><strong>Bể bơi tràn bờ phong cách Resort:</strong> Làn nước trong xanh được bao bọc bởi rặng cọ nhiệt đới và ghế tắm nắng cao cấp, mang lại cảm giác thư thái sau một ngày làm việc bận rộn.</li>
        <li><strong>Phòng tập Gym & Yoga đa năng:</strong> Trang bị hệ thống máy móc cao cấp nhập khẩu, view kính tràn panorama nhìn ra vườn cây xanh mát.</li>
        <li><strong>Đường chạy bộ uốn lượn liên tòa:</strong> Lát đá chống trượt, ngăn cách hoàn toàn với làn xe cơ giới, đảm bảo an toàn tuyệt đối cho người cao tuổi và trẻ nhỏ.</li>
        <li><strong>Khu vui chơi trẻ em Kid Garden:</strong> Sân chơi cát tự nhiên, khu vận động liên hoàn giúp con trẻ thỏa sức khám phá thế giới tự nhiên.</li>
    </ul>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/tong-mat-bang-tien-ich-lalalay-residences.jpg" alt="Tổng mặt bằng tiện ích Lalalay Residences" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Tổng mặt bằng bố trí hơn 30 tiện ích khép kín đặc quyền dành riêng cho cư dân Lalalay Residences</figcaption>
    </figure>

    <h2>3. Tổ Hợp TMDV 2 Tầng Khối Đế & 3 Tầng Hầm Đỗ Xe Rộng Rãi</h2>
    <p>
        Một trong những nỗi lo lớn nhất của cư dân các khu căn hộ cao cấp hiện nay là vấn đề bãi đỗ xe ô tô và sự thuận tiện mua sắm thường nhật. Tại Lalalay Residences, bài toán này được giải quyết triệt để:
    </p>
    <ul>
        <li><strong>3 tầng hầm liên thông toàn khu:</strong> Ứng dụng công nghệ quản lý đỗ xe thông minh, camera tự động nhận diện biển số, giải quyết 100% nhu cầu đỗ xe ô tô và xe máy của 1.492 hộ cư dân.</li>
        <li><strong>2 tầng khối đế thương mại (TMDV):</strong> Quy tụ các siêu thị tiện ích, cửa hàng thời trang, nhà thuốc, quán cafe sân vườn, nhà hàng ẩm thực phong phú phục vụ ngay dưới chân nhà.</li>
        <li><strong>Sảnh đón 5 sao chuẩn khách sạn:</strong> Chiều cao trần lên tới 7m, ốp đá cẩm thạch sang trọng cùng đội ngũ lễ tân và bảo vệ chuyên nghiệp trực 24/7.</li>
    </ul>

    <h2>4. Tiêu Chuẩn Bàn Giao Nội Thất Cao Cấp Đi Kèm</h2>
    <p>
        Bên cạnh tiện ích ngoại khu, giá trị sống của cư dân còn được bảo chứng bởi danh mục vật liệu và trang thiết bị bàn giao cao cấp từ các thương hiệu hàng đầu:
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/tieu-chuan-ban-giao-lalalay-residences.jpg" alt="Tiêu chuẩn bàn giao Lalalay Residences" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Tiêu chuẩn bàn giao liền tường cao cấp: Cửa Xingfa, khóa thông minh 4 tính năng, điều hòa âm trần, full bếp và thiết bị vệ sinh nhập khẩu</figcaption>
    </figure>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#0B2C4D 0%,#1A4670 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#F6C000;font-size:22px;margin:0 0 10px;">Đăng Ký Trải Nghiệm Nhà Mẫu & Nhận Bảng Giá Đợt 1</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Liên hệ đội ngũ chuyên viên Kênh Bất Động Sản để nhận mặt bằng chi tiết và bảng tính dòng tiền ưu đãi Tòa LALA 1.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/mat-bang-du-an-lalalay-residences/" style="background:#C2562B;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Mặt Bằng Dự Án →</a>
            <a href="/thiet-ke-can-ho-2-pn-du-an-lalalay-residences/" style="background:#FFF;color:#0B2C4D;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Thiết Kế Căn Hộ 2PN →</a>
        </div>
    </div>
</div>
HTML
    ],

    // BÀI 3: MẶT BẰNG
    [
        'title'         => 'Mặt Bằng Dự Án Lalalay Residences Bắc An Khánh: Quy Hoạch Tổng Thể & Chi Tiết Tòa LALA 1',
        'slug'          => 'mat-bang-du-an-lalalay-residences',
        'featured_id'   => 163, // tong-mat-bang-tien-ich-lalalay-residences
        'category_slug' => 'review-du-an',
        'focus_kw'      => 'Mặt bằng dự án Lalalay Residences',
        'meta_desc'     => 'Phân tích chi tiết mặt bằng dự án Lalalay Residences Bắc An Khánh: Quy hoạch 4 tòa tháp 20 tầng, 1.492 căn hộ, chi tiết layout tòa LALA 1 mở bán đợt 1.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Mặt bằng dự án Lalalay Residences</strong> được quy hoạch bài bản trên quỹ đất rộng <strong>27.793 m²</strong> tại Bắc An Khánh (Hoài Đức, Hà Nội), bao gồm 4 tòa tháp căn hộ cao 20 tầng nổi, 3 tầng hầm thông minh và 2 tầng khối đế thương mại dịch vụ. Với quy mô 1.492 căn hộ, mặt bằng dự án được tối ưu hóa tối đa nhằm mang lại độ thông thoáng, ánh sáng tự nhiên và tầm view khoáng đạt cho từng căn hộ.
    </p>

    <div class="kbds-highlight-box" style="background:#FFF9F5;border-left:4px solid #C2562B;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#C2562B;font-size:17px;font-weight:700;">📐 THÔNG SỐ QUY HOẠCH MẶT BẰNG LALALAY RESIDENCES</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Tổng diện tích khu đất:</strong> 27.793 m².</li>
            <li><strong>Số lượng tòa tháp:</strong> 4 tòa căn hộ cao 20 tầng (Tòa LALA 1, LALA 2, LALA 3, LALA 4).</li>
            <li><strong>Tầng hầm:</strong> 3 tầng hầm liên thông để xe toàn khu.</li>
            <li><strong>Tổng số lượng căn hộ:</strong> 1.492 căn hộ cao cấp (Sở hữu lâu dài).</li>
            <li><strong>Cơ cấu sản phẩm:</strong> Căn hộ Studio, 1PN, 2PN, 3PN và 4PN.</li>
            <li><strong>Tòa mở bán đầu tiên:</strong> <strong>Tòa LALA 1</strong> với chính sách giá gốc đợt 1 ưu đãi nhất.</li>
        </ul>
    </div>

    <h2>1. Quy Hoạch Tổng Mặt Bằng 4 Tòa Tháp Lalalay Residences</h2>
    <p>
        Điểm khác biệt trong quy hoạch mặt bằng tại <a href="/du-an/lalalay-residences/" style="color:#C2562B;font-weight:700;">Lalalay Residences</a> là sự bố trí khéo léo giữa 4 tòa tháp nhằm tạo ra khoảng thông tầng và luồng gió đối lưu tự nhiên hoàn hảo. Khoảng cách giữa các tòa nhà rộng rãi, không bị che chắn tầm nhìn, bảo đảm mỗi căn hộ đều sở hữu góc nhìn panorama thoáng đãng.
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/tong-mat-bang-tien-ich-lalalay-residences.jpg" alt="Mặt bằng tổng thể dự án Lalalay Residences" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Sơ đồ tổng mặt bằng quy hoạch 4 tòa tháp Lalalay Residences tại Bắc An Khánh</figcaption>
    </figure>

    <p>
        Toàn bộ diện tích nội khu ở giữa các tòa tháp được ưu tiên tuyệt đối cho không gian xanh, hồ bơi ngoài trời, sân chơi trẻ em và quảng trường cảnh quan Terracotta, tạo nên ốc đảo tĩnh lặng tách biệt khỏi sự ồn ào của nhịp sống phố thị.
    </p>

    <h2>2. Chi Tiết Tòa LALA 1 – Tòa Tháp Mở Bán Đầu Tiên Đợt 1</h2>
    <p>
        Trong giai đoạn 1, chủ đầu tư Ramoori Holdings chính thức giới thiệu ra thị trường <strong>Tòa LALA 1</strong>. Đây là tòa tháp sở hữu vị trí mặt tiền đắt giá, kết nối trực diện với trục đường lớn và cụm tiện ích trung tâm.
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/toa-lala-1-mo-ban-dau-tien-lalalay-residences.jpg" alt="Tòa LALA 1 mở bán đầu tiên Lalalay Residences" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Phối cảnh kiến trúc Tòa LALA 1 – Tháp căn hộ mở bán đầu tiên với nhiều ưu đãi cho nhà đầu tư</figcaption>
    </figure>

    <p>
        Ưu điểm nổi bật của mặt bằng Tòa LALA 1:
    </p>
    <ul>
        <li><strong>Mật độ căn hộ hợp lý:</strong> Bố trí số lượng căn hộ vừa phải trên một mặt sàn, giúp sảnh hành lang luôn thông thoáng và giảm tải áp lực thang máy trong giờ cao điểm.</li>
        <li><strong>Thang máy tốc độ cao:</strong> Trang bị cụm thang máy hiện đại phân tầng thông minh và thẻ từ bảo mật, đảm bảo quyền riêng tư tuyệt đối cho cư dân.</li>
        <li><strong>Tầm view đắt giá:</strong> Một mặt hướng về công viên cảnh quan nội khu thanh bình, mặt còn lại hướng về toàn cảnh đại lộ Thăng Long rực rỡ ánh đèn về đêm.</li>
    </ul>

    <h2>3. Cơ Cấu Diện Tích & Bố Trí Căn Hộ Tại Dự Án</h2>
    <p>
        Các dòng căn hộ tại Lalalay Residences được thiết kế phong phú, đáp ứng nhu cầu an cư của nhiều phân khúc khách hàng:
    </p>

    <table style="width:100%;border-collapse:collapse;margin:24px 0;font-size:14.5px;">
        <thead>
            <tr style="background:#0B2C4D;color:#FFF;">
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Loại hình căn hộ</th>
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Đặc điểm không gian</th>
                <th style="padding:12px 16px;text-align:left;border:1px solid #CBD5E1;">Đối tượng khách hàng phù hợp</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#C2562B;">Căn hộ Studio</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Không gian mở all-in-one, tối ưu công năng, ban công thoáng</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Người trẻ độc thân, chuyên gia thuê ngắn/dài hạn</td>
            </tr>
            <tr style="background:#F8FAFC;">
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#C2562B;"><a href="/thiet-ke-can-ho-1-pn-du-an-lalalay-residences/" style="color:#C2562B;text-decoration:none;">Căn hộ 1 Phòng Ngủ (1PN)</a></td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Phòng ngủ riêng biệt, phòng khách + bếp liên hoàn, có thêm không gian +1</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Vợ chồng mới cưới, người độc thân thu nhập cao, nhà đầu tư cho thuê</td>
            </tr>
            <tr>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#C2562B;"><a href="/thiet-ke-can-ho-2-pn-du-an-lalalay-residences/" style="color:#C2562B;text-decoration:none;">Căn hộ 2 Phòng Ngủ (2PN)</a></td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">2PN - 2WC hoặc 2PN+1, 2 logia riêng biệt, phòng ngủ Master khép kín</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Gia đình trẻ có 1 - 2 con nhỏ, lựa chọn an cư chuẩn mực</td>
            </tr>
            <tr style="background:#F8FAFC;">
                <td style="padding:12px 16px;border:1px solid #CBD5E1;font-weight:700;color:#C2562B;">Căn hộ 3PN & 4PN</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Vị trí căn góc 2 mặt thoáng, phòng khách rộng lớn, ban công panorama</td>
                <td style="padding:12px 16px;border:1px solid #CBD5E1;">Gia đình đa thế hệ, khách hàng cần không gian sống đẳng cấp</td>
            </tr>
        </tbody>
    </table>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#0B2C4D 0%,#1A4670 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#F6C000;font-size:22px;margin:0 0 10px;">Tải File Mặt Bằng Độ Nét Cao Tòa LALA 1</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Nhận ngay trọn bộ hồ sơ bản vẽ mặt bằng chi tiết từng tầng và layout căn hộ chính xác nhất.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/thiet-ke-can-ho-1-pn-du-an-lalalay-residences/" style="background:#C2562B;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Layout Căn 1PN →</a>
            <a href="/thiet-ke-can-ho-2-pn-du-an-lalalay-residences/" style="background:#FFF;color:#0B2C4D;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Layout Căn 2PN →</a>
        </div>
    </div>
</div>
HTML
    ],

    // BÀI 4: THIẾT KẾ CĂN HỘ 1PN
    [
        'title'         => 'Thiết Kế Căn Hộ 1 PN Dự Án Lalalay Residences: Không Gian Sống Tinh Tế, Tối Ưu Cho Gia Đình Trẻ & Nhà Đầu Tư',
        'slug'          => 'thiet-ke-can-ho-1-pn-du-an-lalalay-residences',
        'featured_id'   => 166, // can-ho-mau-1-phong-ngu-lalalay-residences
        'category_slug' => 'review-du-an',
        'focus_kw'      => 'Thiết kế căn hộ 1 PN dự án Lalalay Residences',
        'meta_desc'     => 'Đánh giá chi tiết thiết kế căn hộ 1 PN dự án Lalalay Residences: Không gian mở hiện đại, đa năng 1PN+1, nội thất cao cấp, tỷ suất sinh lời cho thuê vượt trội.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Thiết kế căn hộ 1 PN dự án Lalalay Residences</strong> là giải pháp không gian sống hoàn hảo dành cho giới trẻ hiện đại, các cặp vợ chồng mới cưới và nhà đầu tư tìm kiếm dòng tiền cho thuê bền vững. Dưới bàn tay tài hoa của các kiến trúc sư STELLAR, căn hộ 1 phòng ngủ tại đây được tối ưu đến từng centimet vuông, loại bỏ hoàn toàn các góc chết để mang lại không gian sống ngập tràn ánh sáng và cảm hứng sáng tạo.
    </p>

    <div class="kbds-highlight-box" style="background:#FFF9F5;border-left:4px solid #C2562B;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#C2562B;font-size:17px;font-weight:700;">🏠 THÔNG TIN CĂN HỘ 1 PHÒNG NGỦ LALALAY RESIDENCES</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Loại hình:</strong> Căn hộ 1 Phòng Ngủ & Căn hộ 1 Phòng Ngủ + 1 (1PN+1).</li>
            <li><strong>Pháp lý:</strong> Sở hữu lâu dài (Sổ hồng chính chủ).</li>
            <li><strong>Không gian:</strong> Phòng khách, bếp mở, 1 phòng ngủ riêng biệt, 1 WC, logia giặt phơi riêng.</li>
            <li><strong>Điểm cộng đắt giá:</strong> Không gian đa năng "+1" linh hoạt chuyển đổi công năng.</li>
        </ul>
    </div>

    <h2>1. Ngôn Ngữ Thiết Kế Mở Thông Minh & Tối Ưu Ánh Sáng</h2>
    <p>
        Căn hộ 1PN tại <a href="/du-an/lalalay-residences/" style="color:#C2562B;font-weight:700;">Lalalay Residences</a> được thiết kế theo trường phái mở (Open Plan). Phòng khách và khu vực bàn ăn liên thông với ban công rộng mở, sử dụng hệ cửa nhôm kính Xingfa kịch trần giúp đón trọn vẹn luồng gió trời tươi mới và ánh sáng tự nhiên.
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/can-ho-mau-1-phong-ngu-lalalay-residences.jpg" alt="Căn hộ mẫu 1 phòng ngủ Lalalay Residences" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Hình ảnh thực tế không gian căn hộ mẫu 1 phòng ngủ tại Lalalay Residences với tone màu Sandstone & Terracotta thanh lịch</figcaption>
    </figure>

    <p>
        Phòng ngủ chính được ngăn cách độc lập bằng vách tường kiên cố, vừa đảm bảo sự riêng tư kín đáo vừa sở hữu cửa sổ lớn hướng ra ngoài trời, không bị cảm giác bí bách như những thiết kế căn hộ nhỏ truyền thống.
    </p>

    <h2>2. Không Gian Đa Năng "+1" – Biến Hóa Linh Hoạt Theo Nhu Cầu</h2>
    <p>
        Điểm sáng tạo nhất trong layout căn hộ 1PN tại dự án chính là góc không gian mở <strong>"+1"</strong>. Đây là khu vực diện tích mở thêm vô cùng giá trị, chủ nhân có thể tùy biến thành:
    </p>
    <ul>
        <li><strong>Phòng làm việc tại nhà (Work from Home):</strong> Góc làm việc yên tĩnh, đủ đặt bàn máy tính và giá sách trang nhã.</li>
        <li><strong>Góc đọc sách & thư giãn (Chill corner):</strong> Đặt ghế bành thư giãn, đàn piano hoặc góc thiền yên bình.</li>
        <li><strong>Không gian phòng ngủ phụ cho bé nhỏ:</strong> Dành cho các cặp vợ chồng có con nhỏ trong những năm đầu đời trước khi nâng cấp không gian lớn hơn.</li>
    </ul>

    <h2>3. Tiêu Chuẩn Bàn Giao Nội Thất Hoàn Thiện Liền Tường</h2>
    <p>
        Căn hộ 1PN Lalalay Residences được bàn giao với danh mục trang thiết bị cao cấp, giúp gia chủ tiết kiệm hàng trăm triệu đồng chi phí hoàn thiện nội thất:
    </p>
    <ul>
        <li><strong>Cửa ra vào căn hộ:</strong> Cửa gỗ công nghiệp cao cấp chống cháy, tích hợp khóa thông minh 4 tính năng (Vân tay, mã số, thẻ từ, khóa cơ).</li>
        <li><strong>Hệ điều hòa âm trần:</strong> Nhập khẩu từ các thương hiệu hàng đầu, làm mát êm ái và thẩm mỹ vượt trội.</li>
        <li><strong>Khu bếp hoàn chỉnh:</strong> Đầy đủ tủ bếp trên dưới chống ẩm, mặt bếp đá nhân tạo cao cấp, bếp từ đôi và máy hút mùi nhập khẩu.</li>
        <li><strong>Phòng vệ sinh sang trọng:</strong> Đầy đủ thiết bị vệ sinh cao cấp, vách kính tắm đứng cường lực, bình nước nóng an toàn.</li>
    </ul>

    <h2>4. Tiềm Năng Đầu Tư Cho Thuê Cực Lớn Của Căn 1PN</h2>
    <p>
        Với vị trí kế cận Khu Công nghệ cao Hòa Lạc và trục kết nối Đại lộ Thăng Long vào Mỹ Đình, nhu cầu thuê căn hộ cao cấp 1PN của các kỹ sư, chuyên gia nước ngoài và quản lý cấp cao là rất lớn:
    </p>
    <ul>
        <li><strong>Tổng vốn đầu tư ban đầu thấp:</strong> Dễ dàng sở hữu với số vốn tự có vừa phải kết hợp chính sách hỗ trợ lãi suất 0% từ ngân hàng.</li>
        <li><strong>Thanh khoản và tỷ lệ lấp đầy cao:</strong> Căn hộ 1PN luôn là loại hình có tốc độ cho thuê nhanh nhất và giữ giá ổn định qua các chu kỳ thị trường.</li>
    </ul>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#0B2C4D 0%,#1A4670 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#F6C000;font-size:22px;margin:0 0 10px;">Nhận Bảng Giá Căn Hộ 1PN Tòa LALA 1 Đợt Mở Bán Đầu</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Cập nhật danh sách các suất căn 1PN tầng đẹp, view thoáng với mức giá gốc ưu đãi nhất từ chủ đầu tư Ramoori Holdings.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/thiet-ke-can-ho-2-pn-du-an-lalalay-residences/" style="background:#C2562B;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Tiếp Thiết Kế Căn 2PN →</a>
            <a href="/mat-bang-du-an-lalalay-residences/" style="background:#FFF;color:#0B2C4D;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Toàn Bộ Mặt Bằng →</a>
        </div>
    </div>
</div>
HTML
    ],

    // BÀI 5: THIẾT KẾ CĂN HỘ 2PN
    [
        'title'         => 'Thiết Kế Căn Hộ 2 PN Dự Án Lalalay Residences: Đỉnh Cao Kiến Trúc Tổ Ấm Hiện Đại Cho Gia Đình Trẻ',
        'slug'          => 'thiet-ke-can-ho-2-pn-du-an-lalalay-residences',
        'featured_id'   => 167, // can-ho-mau-2-phong-ngu-lalalay-residences
        'category_slug' => 'review-du-an',
        'focus_kw'      => 'Thiết kế căn hộ 2 PN dự án Lalalay Residences',
        'meta_desc'     => 'Khám phá chi tiết thiết kế căn hộ 2 PN dự án Lalalay Residences: Layout 2PN-2WC thông minh, 2 ban công thoáng mát, phòng Master sang trọng cho gia đình hiện đại.',
        'content'       => <<<HTML
<div class="kbds-article-content">
    <p class="kbds-lead-text">
        <strong>Thiết kế căn hộ 2 PN dự án Lalalay Residences</strong> được đánh giá là dòng sản phẩm "quốc dân" được săn đón nhiều nhất nhờ sự cân bằng lý tưởng giữa diện tích sử dụng, công năng sinh hoạt và mức giá đầu tư hợp lý. Được kiến tạo dành riêng cho các gia đình hiện đại, căn hộ 2 phòng ngủ tại Lalalay Residences sở hữu layout vuông vức, 2 mặt thoáng và không gian sinh hoạt chung ấm cúng, gắn kết các thành viên trong tổ ấm.
    </p>

    <div class="kbds-highlight-box" style="background:#FFF9F5;border-left:4px solid #C2562B;padding:18px 22px;border-radius:0 12px 12px 0;margin:24px 0;">
        <h4 style="margin:0 0 10px;color:#C2562B;font-size:17px;font-weight:700;">👨‍👩‍👧‍👦 ĐẶC ĐIỂM NỔI BẬT CĂN HỘ 2 PHÒNG NGỦ LALALAY RESIDENCES</h4>
        <ul style="margin:0;padding-left:20px;line-height:1.7;color:#334155;font-size:15px;">
            <li><strong>Cơ cấu mặt bằng:</strong> 2 Phòng ngủ riêng biệt + 2 Nhà vệ sinh (2PN - 2WC).</li>
            <li><strong>Hệ thống ban công:</strong> 2 Logia tách biệt (Logia phòng khách ngắm cảnh & Logia giặt phơi kín đáo).</li>
            <li><strong>Phòng ngủ Master:</strong> Có WC khép kín, không gian tủ đồ âm tường thông minh.</li>
            <li><strong>Tầm view:</strong> Hướng trọn vẹn ra hồ bơi resort, vườn nội khu hoặc đại lộ ánh sáng.</li>
        </ul>
    </div>

    <h2>1. Bố Trí Không Gian Sinh Hoạt Chung Rộng Mở & Gắn Kết</h2>
    <p>
        Bước vào căn hộ 2PN tại <a href="/du-an/lalalay-residences/" style="color:#C2562B;font-weight:700;">Lalalay Residences</a>, cảm giác đầu tiên là sự rộng rãi và liền mạch. Khu vực tiền sảnh dẫn vào phòng khách và bàn ăn liên thông với nhau, tạo thành một không gian sinh hoạt chung rộng lớn lên đến gần 30m².
    </p>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/can-ho-mau-2-phong-ngu-lalalay-residences.jpg" alt="Căn hộ mẫu 2 phòng ngủ Lalalay Residences" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Không gian phòng khách và bếp liên hoàn sang trọng tại căn hộ mẫu 2PN Lalalay Residences Bắc An Khánh</figcaption>
    </figure>

    <p>
        Bếp nấu được thiết kế theo dạng chữ L hoặc song song gọn gàng, có vách ngăn nhẹ và kết nối thẳng ra logia phụ. Thiết kế này giúp mùi thức ăn khi nấu nướng thoát ra ngoài nhanh chóng, không gây ám mùi vào phòng khách hay phòng ngủ của gia đình.
    </p>

    <h2>2. Hai Phòng Ngủ Tràn Ngập Ánh Sáng Tự Nhiên</h2>
    <p>
        Khác với nhiều dự án căn hộ có phòng ngủ "âm" (không có cửa sổ ra ngoài trời), tại Lalalay Residences 100% các phòng ngủ đều tiếp xúc trực tiếp với không gian mở:
    </p>
    <ul>
        <li><strong>Phòng ngủ Master:</strong> Là chốn nghỉ ngơi sang trọng của gia chủ với diện tích lớn, cửa sổ panorama view trọn cảnh quan. Đi kèm là phòng tắm khép kín tiện nghi với vách kính cường lực và thiết bị vệ sinh nhập khẩu chuẩn 5 sao.</li>
        <li><strong>Phòng ngủ phụ:</strong> Thiết kế vuông vắn, lý tưởng cho con cái hoặc người thân ghé thăm. Cửa sổ rộng đón ánh sáng tự nhiên giúp các bé có môi trường học tập và phát triển tinh thần tốt nhất.</li>
    </ul>

    <figure style="margin:28px 0;text-align:center;">
        <img src="https://kenhbatdongsan.vn/wp-content/uploads/2026/11/can-ho-mau-3-phong-ngu-lalalay-residences.jpg" alt="Phòng ngủ hiện đại căn hộ Lalalay Residences" style="width:100%;max-width:920px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);" />
        <figcaption style="font-size:13.5px;color:#64748B;margin-top:10px;font-style:italic;">Thiết kế phòng ngủ với cửa sổ khổ lớn đón nắng gió tự nhiên và sàn gỗ cao cấp ấm áp</figcaption>
    </figure>

    <h2>3. Thiết Kế 2 Logia Độc Lập – Chuẩn Mực Căn Hộ Cao Cấp</h2>
    <p>
        Một chi tiết tinh tế khẳng định đẳng cấp của Lalalay Residences là việc bố trí <strong>2 logia riêng biệt</strong>:
    </p>
    <ul>
        <li><strong>Logia chính (Ban công phòng khách):</strong> Rộng rãi, gia chủ có thể thỏa sức decor tiểu cảnh xanh, bàn trà ngắm hoàng hôn mỗi chiều.</li>
        <li><strong>Logia phụ (Khu vực kỹ thuật):</strong> Kết nối trực tiếp từ gian bếp, dùng để đặt máy giặt, giàn phơi thông minh và cục nóng điều hòa âm trần. Khu vực này được giấu kín khéo léo để đảm bảo tính thẩm mỹ cho tổng thể mặt ngoài tòa nhà.</li>
    </ul>

    <h2>4. Tiến Độ Thanh Toán Giãn & Bàn Giao Năm 2029</h2>
    <p>
        Dự kiến bàn giao vào năm 2029 cùng pháp lý minh bạch (QHCT 1/500 đã phê duyệt, Chấp thuận chủ trương đầu tư), căn hộ 2PN Lalalay Residences mang đến phương án tài chính vô cùng nhẹ nhàng:
    </p>
    <ul>
        <li>Tiến độ thanh toán chia nhỏ thành nhiều đợt theo tiến độ thi công thực tế của tổng thầu Delta.</li>
        <li>Ngân hàng đồng hành hỗ trợ vay vốn lên tới 70% giá trị căn hộ, ân hạn nợ gốc và miễn lãi suất trong thời gian xây dựng.</li>
    </ul>

    <div class="kbds-cta-box" style="background:linear-gradient(135deg,#0B2C4D 0%,#1A4670 100%);padding:28px 32px;border-radius:14px;color:#FFF;text-align:center;margin:36px 0;">
        <h3 style="color:#F6C000;font-size:22px;margin:0 0 10px;">Đặt Lịch Xem Thực Tế Sa Bàn & Nhà Mẫu Lalalay Residences</h3>
        <p style="color:#E2E8F0;font-size:15px;margin:0 0 20px;">Đội ngũ chuyên viên tư vấn Kênh Bất Động Sản sẵn sàng hỗ trợ quý khách xem sa bàn và trải nghiệm trực tiếp không gian căn hộ mẫu.</p>
        <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="/du-an/lalalay-residences/" style="background:#C2562B;color:#FFF;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Trang Tổng Quan Dự Án →</a>
            <a href="/tien-ich-du-an-lalalay-residences/" style="background:#FFF;color:#0B2C4D;padding:12px 24px;border-radius:8px;font-weight:700;text-decoration:none;">Xem Hệ Thống Tiện Ích →</a>
        </div>
    </div>
</div>
HTML
    ],
];

echo "==============================================================\n";
echo "🚀 BẮT ĐẦU TẠO 5 BÀI VIẾT VỆ TINH LALALAY RESIDENCES\n";
echo "==============================================================\n";

foreach ($satellite_posts as $item) {
    // Tìm bài viết theo slug xem đã tồn tại chưa
    $existing = get_page_by_path($item['slug'], OBJECT, 'post');
    $cat = get_category_by_slug($item['category_slug']);
    $cat_ids = $cat ? [$cat->term_id] : [1];

    $post_data = [
        'post_title'    => $item['title'],
        'post_name'     => $item['slug'],
        'post_content'   => $item['content'],
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
        // Gán Featured Image
        set_post_thumbnail($pid, $item['featured_id']);

        // Gán Rank Math SEO meta
        update_post_meta($pid, 'rank_math_title', $item['title'] . ' | Kênh Bất Động Sản');
        update_post_meta($pid, 'rank_math_description', $item['meta_desc']);
        update_post_meta($pid, 'rank_math_focus_keyword', $item['focus_kw']);
        update_post_meta($pid, '_kbds_project_ref', 170); // Liên kết với Dự án Lalalay Residences
        echo "   -> Gán Featured Image (ID: {$item['featured_id']}) & Rank Math SEO thành công.\n";
    }
}

echo "==============================================================\n";
echo "🎉 HOÀN THÀNH TẠO 5 BÀI VIẾT VỆ TINH TRÊN LOCALHOST!\n";
echo "==============================================================\n";
