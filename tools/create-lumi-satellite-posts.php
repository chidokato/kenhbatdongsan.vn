<?php
require_once dirname(__DIR__) . '/wp-load.php';

$parent_project_id = 511; // Lumi Hanoi
$image_map = json_decode(file_get_contents(__DIR__ . '/lumi-images.json'), true);

$img_mb_prestige = $image_map['mat-bang-toa-prestige-1-lumi-hanoi.jpg']['url'];
$img_mb_tong     = $image_map['mat-bang-tong-the-du-an-lumi-hanoi.webp']['url'];
$img_be_boi      = $image_map['be-boi-resort-sole-lap-pool-lumi-hanoi.jpg']['url'];
$img_la_phoi     = $image_map['cong-vien-la-phoi-xanh-green-lung-lumi-hanoi.jpg']['url'];
$img_lobby       = $image_map['dai-sanh-grand-lobby-signature-1-lumi-hanoi.jpg']['url'];
$img_party       = $image_map['phong-tiec-cu-dan-party-house-lumi-hanoi.jpg']['url'];

$posts = [
    [
        'title' => 'Mặt Bằng Tòa Prestige 1 Dự Án Lumi Hanoi: Thiết Kế Chi Tiết Căn Hộ 1PN - 4PN Năm 2026',
        'slug'  => 'mat-bang-toa-prestige-1-du-an-lumi-hanoi',
        'focus_kw' => 'mặt bằng tòa Prestige 1 Lumi Hanoi',
        'desc'  => 'Phân tích chi tiết mặt bằng tòa Prestige 1 Lumi Hanoi CapitaLand. Đánh giá ưu điểm layout căn hộ 1PN đến 4PN và hướng dẫn chọn căn view đẹp đợt 1 năm 2026.',
        'thumb' => $image_map['mat-bang-toa-prestige-1-lumi-hanoi.jpg']['id'] ?? 500,
        'content' => <<<HTML
<p>Là một trong những phân khu nâng cấp đẳng cấp nhất tại dự án <a href="https://kenhbatdongsan.vn/du-an/lumi-hanoi/">Lumi Hanoi</a> của chủ đầu tư CapitaLand Development, tòa tháp <strong>Prestige 1</strong> thu hút sự quan tâm đặc biệt của cả khách hàng mua an cư lẫn giới đầu tư sành sỏi. Với mật độ xây dựng thông thoáng chỉ 16 căn/sàn, thiết kế tối ưu công năng từ căn hộ 1 phòng ngủ gọn gàng đến căn hộ 4 phòng ngủ góc bề thế, <strong>mặt bằng tòa Prestige 1 Lumi Hanoi</strong> được xem là hình mẫu tiêu chuẩn cho chuẩn sống thượng lưu tại khu Tây Hà Nội trong năm 2026.</p>

<div class="kbds-toc-block" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:10px;padding:20px;margin:25px 0">
  <strong style="color:#0B2C4D;font-size:16px;display:block;margin-bottom:10px">📑 Mục Lục Bài Viết:</strong>
  <ul style="margin:0;padding-left:20px;color:#2563EB;line-height:1.8;font-size:14px">
    <li><a href="#tong-quan-toa-prestige-1">1. Tổng Quan Quy Hoạch Tòa Prestige 1 Lumi Hanoi</a></li>
    <li><a href="#chi-tiet-mat-bang-tang">2. Chi Tiết Bản Vẽ Mặt Bằng Tầng Điển Hình</a></li>
    <li><a href="#co-cau-can-ho">3. Phân Tích Cơ Cấu Diện Tích &amp; Ưu Điểm Từng Loại Căn Hộ</a></li>
    <li><a href="#kinh-nghiem-chon-can">4. Kinh Nghiệm Chọn Hướng &amp; Vị Trí Căn Hộ Đẹp Nhất</a></li>
    <li><a href="#dang-ky-nhan-layout">5. Tải Trọn Bộ Bản Vẽ Kỹ Thuật 3D Bóc Mái</a></li>
  </ul>
</div>

<h2 id="tong-quan-toa-prestige-1" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">1. Tổng Quan Quy Hoạch Tòa Prestige 1 Lumi Hanoi</h2>
<p>Nằm trong quần thể 5.6ha của đại dự án <a href="https://kenhbatdongsan.vn/du-an/lumi-hanoi/">chung cư Lumi Hanoi</a>, phân khu Prestige được định vị ở phân khúc cao cấp hơn so với Signature. Tòa Prestige 1 sở hữu vị trí đắt giá tiếp giáp trực tiếp cụm tiện ích trung tâm, hồ bơi cực quang và dải công viên cây xanh biệt lập.</p>

<table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:14px">
  <tbody>
    <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC"><td style="padding:10px 12px;font-weight:700;width:35%">Chiều cao tháp:</td><td style="padding:10px 12px">30 tầng nổi + tầng hầm liên thông</td></tr>
    <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:10px 12px;font-weight:700">Mật độ căn/sàn:</td><td style="padding:10px 12px">16 căn hộ/sàn (Tầng 2-19, 21-22, 24-28)</td></tr>
    <tr style="border-bottom:1px solid #E2E8F0;background:#F8FAFC"><td style="padding:10px 12px;font-weight:700">Hệ thống thang máy:</td><td style="padding:10px 12px">6 thang máy tốc độ cao + 2 thang bộ thoát hiểm</td></tr>
    <tr style="border-bottom:1px solid #E2E8F0"><td style="padding:10px 12px;font-weight:700">Tầng lánh nạn (Refuge Area):</td><td style="padding:10px 12px">Bố trí tại Tầng 20 đảm bảo an toàn tuyệt đối</td></tr>
    <tr><td style="padding:10px 12px;font-weight:700">Loại hình sản phẩm:</td><td style="padding:10px 12px">1 Phòng ngủ (42.2m²), 2 Phòng ngủ (53.8 – 62.1m²), 3 Phòng ngủ (86 – 117.8m²), 4 Phòng ngủ (136m²)</td></tr>
  </tbody>
</table>

<h2 id="chi-tiet-mat-bang-tang" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">2. Chi Tiết Bản Vẽ Mặt Bằng Tầng Điển Hình</h2>
<p>Kiến trúc sư Jean-François Milou đã khéo léo bố trí hình chữ L mở rộng, giúp các mặt căn hộ đều đón gió tươi tự nhiên và không bị che chắn tầm nhìn. Dưới đây là bản vẽ mặt bằng chính thức từ chủ đầu tư:</p>

<div style="border-radius:12px;overflow:hidden;border:1px solid #CBD5E1;margin:25px 0">
  <img src="{$img_mb_prestige}" alt="Bản vẽ mặt bằng tòa Prestige 1 Lumi Hanoi CapitaLand chi tiết tầng 2 đến tầng 28" style="width:100%;height:auto;display:block" />
  <div style="padding:10px 14px;background:#F8FAFC;font-size:13px;color:#64748B;text-align:center">Bản vẽ thiết kế mặt bằng tòa Prestige 1 phân khu Lumi Prestige</div>
</div>

<h2 id="co-cau-can-ho" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">3. Phân Tích Cơ Cấu Diện Tích &amp; Ưu Điểm Từng Loại Căn Hộ</h2>

<h3 style="color:#1E3A8A;font-size:18px;font-weight:700;margin:20px 0 10px">Căn hộ 1 Phòng Ngủ (1BR - 42.2 m²)</h3>
<p>Bao gồm các căn 05, 06, 07 với thiết kế vuông vắn, phòng khách và phòng ngủ đều có mặt thoáng tiếp sáng trực tiếp. Đây là sản phẩm có thanh khoản cực cao, phù hợp cho người độc thân thành đạt hoặc các chuyên gia nước ngoài thuê lưu trú dài hạn.</p>

<h3 style="color:#1E3A8A;font-size:18px;font-weight:700;margin:20px 0 10px">Căn hộ 2 Phòng Ngủ (2BR - 53.8m² đến 62.1m²)</h3>
<p>Chia làm 2 phiên bản: 2BR Small (Căn 02, 14, 15) và 2BR Medium (Căn 03, 10, 11, 13). Điểm nhấn là không gian phòng sinh hoạt chung kết nối liền mạch với ban công kính tràn viền rộng mở, mang trọn thiên nhiên vào từng góc nhỏ.</p>

<h3 style="color:#1E3A8A;font-size:18px;font-weight:700;margin:20px 0 10px">Căn hộ 3 Phòng Ngủ &amp; 4 Phòng Ngủ Góc (86m² – 136m²)</h3>
<p>Các căn hộ 3PN (Căn 01, 08, 09, 16) và 4PN (Căn 04, 12) đều nằm tại vị trí góc với 2 mặt thoáng view trọn công viên sinh thái Lá phổi xanh và cụm bể bơi resort Sole Lap Pool.</p>

<h2 id="kinh-nghiem-chon-can" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">4. Kinh Nghiệm Chọn Hướng &amp; Vị Trí Căn Hộ Đẹp Nhất</h2>
<ul>
  <li><strong>Hướng Đông Nam – Đông Bắc:</strong> Thích hợp cho gia đình ưa thích không khí mát mẻ quanh năm, ngắm nhìn công viên nội khu và hồ cảnh quan.</li>
  <li><strong>Khoảng tầng đẹp:</strong> Từ tầng 8 đến tầng 18 là khoảng tầng vàng tránh được bụi mịn và côn trùng, đồng thời sở hữu góc ngắm tiện ích nội khu trọn vẹn nhất.</li>
  <li><strong>Khách hàng ưu tiên tài chính:</strong> Có thể lựa chọn các căn hộ tầng thấp (tầng 3-5) hoặc tầng cao (tầng 25-28) với mức giá cạnh tranh hơn từ 5-10%.</li>
</ul>

<h2 id="dang-ky-nhan-layout" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">5. Tải Trọn Bộ Bản Vẽ Kỹ Thuật 3D Bóc Mái</h2>
<p>Để nhận file PDF gốc chất lượng cao bản vẽ thiết kế bóc mái 3D từng căn hộ và bảng tính dòng tiền chi tiết của tòa tháp Prestige 1, quý khách vui lòng điền thông tin vào form bên dưới:</p>

[kbds_lead_form_cao_tang project="Chung Cư Lumi Hanoi CapitaLand" title="📥 ĐĂNG KÝ TẢI TRỌN BỘ MẶT BẰNG &amp; LAYOUT 3D TÒA PRESTIGE 1" button_text="GỬI FILE LAYOUT CHO TÔI QUA ZALO ➔"]
HTML
    ],
    [
        'title' => 'Hệ Thống 80+ Tiện Ích Đẳng Cấp Tại Lumi Hanoi: Chuẩn Sống Resort 5 Sao Quốc Tế Năm 2026',
        'slug'  => 'he-thong-tien-ich-dang-cap-lumi-hanoi',
        'focus_kw' => 'tiện ích dự án Lumi Hanoi',
        'desc'  => 'Khám phá hơn 80 tiện ích chuẩn resort 5 sao tại Lumi Hanoi CapitaLand: Bể bơi resort 50m Sole Lap Pool, công viên 2.4ha, đại sảnh 5 sao và đài ngắm sao thiên văn.',
        'thumb' => $image_map['be-boi-resort-sole-lap-pool-lumi-hanoi.jpg']['id'] ?? 503,
        'content' => <<<HTML
<p>Được kiến tạo như một ốc đảo nghỉ dưỡng biệt lập ngay giữa lòng khu Tây sôi động, tổ hợp căn hộ cao cấp <a href="https://kenhbatdongsan.vn/du-an/lumi-hanoi/">Lumi Hanoi</a> của Tập đoàn CapitaLand Development mang đến một cuộc cách mạng về phong cách sống đô thị. Với bộ sưu tập hơn 80 tiện ích nội khu đa tầng trải dài từ mặt đất lên đến tầng không, <strong>tiện ích dự án Lumi Hanoi</strong> đáp ứng mọi nhu cầu từ chăm sóc sức khỏe, vui chơi giải trí đến khẳng định vị thế tinh hoa của cộng đồng cư dân ưu tú trong năm 2026.</p>

<div class="kbds-toc-block" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:10px;padding:20px;margin:25px 0">
  <strong style="color:#0B2C4D;font-size:16px;display:block;margin-bottom:10px">📑 Mục Lục Bài Viết:</strong>
  <ul style="margin:0;padding-left:20px;color:#2563EB;line-height:1.8;font-size:14px">
    <li><a href="#tong-the-he-sinh-thai">1. Tổng Quan Hệ Sinh Thái Tiện Ích 5 Sao Lumi Hanoi</a></li>
    <li><a href="#tien-ich-ngoai-troi">2. Tiện Ích Nghỉ Dưỡng Ngoài Trời Đỉnh Cao</a></li>
    <li><a href="#tien-ich-trong-nha">3. Tiện Ích Trong Nhà Độc Quyền Cho Cư Dân</a></li>
    <li><a href="#tien-ich-tang-khong">4. Tiện Ích Tầng Không &amp; Sky Lounge Ngắm Hoàng Hôn</a></li>
    <li><a href="#dang-ky-trai-nghiem">5. Đăng Ký Tham Quan Căn Hộ Thực Tế &amp; Tiện Ích</a></li>
  </ul>
</div>

<h2 id="tong-the-he-sinh-thai" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">1. Tổng Quan Hệ Sinh Thái Tiện Ích 5 Sao Lumi Hanoi</h2>
<p>Khác biệt hoàn toàn với những dự án chung cư thương mại thông thường, <a href="https://kenhbatdongsan.vn/du-an/lumi-hanoi/">dự án Lumi Hanoi</a> dành hơn 70% diện tích quỹ đất 5.6ha cho cảnh quan xanh, mặt nước và các công trình tiện ích công cộng. Cảm hứng thiết kế "Thành phố ánh sáng" được truyền tải xuyên suốt qua các công trình kiến trúc mặt nước lung linh, các tuyến đường dạo bộ ánh sáng và đài phun nước cực quang ấn tượng.</p>

<h2 id="tien-ich-ngoai-troi" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">2. Tiện Ích Nghỉ Dưỡng Ngoài Trời Đỉnh Cao</h2>
<p>Khu vực tiện ích ngoài trời là nơi hội tụ các công trình mang tính biểu tượng của khu đô thị:</p>

<div style="border-radius:12px;overflow:hidden;border:1px solid #CBD5E1;margin:20px 0">
  <img src="{$img_be_boi}" alt="Bể bơi resort Sole Lap Pool dài 50m chuẩn Olympic dự án Lumi Hanoi" style="width:100%;height:auto;display:block" />
  <div style="padding:10px 14px;background:#F8FAFC;font-size:13px;color:#64748B;text-align:center">Bể bơi resort Sole Lap Pool phong cách ốc đảo nghỉ dưỡng nhiệt đới</div>
</div>

<ul>
  <li><strong>Bể bơi Sole Lap Pool 50m:</strong> Cụm hồ bơi nước mặn tràn viền chuẩn kích thước Olympic được lọc nước bằng công nghệ điện phân muối hiện đại, an toàn cho làn da của trẻ nhỏ.</li>
  <li><strong>Công viên Lá phổi xanh Green Lung 2.4ha:</strong> Thảm cỏ thực vật đa tầng, lối dạo bộ thiền hành và cầu dạo bộ trên không kết nối xuyên suốt các tòa nhà.</li>
  <li><strong>Sân chơi nước Adventure Waterplay:</strong> Công viên nước mini ngoài trời với các vòi phun vui nhộn và cầu trượt đa sắc màu cho các cư dân nhí.</li>
  <li><strong>Vườn nướng Sole BBQ Pavilion:</strong> Điểm hẹn cuối tuần lý tưởng cho những bữa tiệc nướng gia đình ngoài trời trong không gian thoáng đạt ven hồ.</li>
</ul>

<div style="border-radius:12px;overflow:hidden;border:1px solid #CBD5E1;margin:20px 0">
  <img src="{$img_la_phoi}" alt="Công viên Lá phổi xanh Green Lung với cầu dạo bộ trên không rợp bóng cây dự án Lumi Hanoi" style="width:100%;height:auto;display:block" />
  <div style="padding:10px 14px;background:#F8FAFC;font-size:13px;color:#64748B;text-align:center">Công viên Lá phổi xanh Green Lung và đường dạo bộ trên không</div>
</div>

<h2 id="tien-ich-trong-nha" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">3. Tiện Ích Trong Nhà Độc Quyền Cho Cư Dân</h2>
<p>Tại mỗi khối đế tòa nhà, cư dân được tận hưởng hệ thống tiện ích dịch vụ chuẩn khách sạn 5 sao:</p>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin:20px 0">
  <div style="border-radius:10px;overflow:hidden;border:1px solid #E2E8F0">
    <img src="{$img_lobby}" alt="Đại sảnh đón tiếp sang trọng 5 sao Grand Lobby Signature 1 dự án Lumi Hanoi" style="width:100%;height:220px;object-fit:cover;display:block" />
    <div style="padding:12px;background:#F8FAFC;font-size:13px;font-weight:700;color:#0B2C4D;text-align:center">Đại sảnh đón tiếp Grand Lobby 5 sao bề thế</div>
  </div>
  <div style="border-radius:10px;overflow:hidden;border:1px solid #E2E8F0">
    <img src="{$img_party}" alt="Phòng tiệc cư dân đẳng cấp Party House dự án Lumi Hanoi CapitaLand" style="width:100%;height:220px;object-fit:cover;display:block" />
    <div style="padding:12px;background:#F8FAFC;font-size:13px;font-weight:700;color:#0B2C4D;text-align:center">Phòng tiệc ẩm thực cư dân Party House</div>
  </div>
</div>

<ul>
  <li><strong>Đại sảnh Grand Lobby:</strong> Thiết kế vòm kính cao trần ấn tượng cùng quầy lễ tân 24/7 chuyên nghiệp phục vụ cư dân và đón tiếp khách quý.</li>
  <li><strong>Phòng tiệc Party House &amp; Bếp Gourmet:</strong> Không gian sang trọng để gia chủ tổ chức các bữa tiệc riêng tư, tiệc sinh nhật hoặc gặp gỡ đối tác.</li>
  <li><strong>Phòng Gym 330m² &amp; Pilates Studio:</strong> Hệ thống máy tập cao cấp thương hiệu Technogym, phòng tập Yoga riêng tư hướng ra vườn cảnh quan.</li>
  <li><strong>Toddler's Playroom &amp; Kids' Adventure Land:</strong> Tổ hợp vui chơi giải trí trong nhà trang bị vật liệu thân thiện, kích thích sáng tạo và khả năng vận động của bé.</li>
</ul>

<h2 id="tien-ich-tang-khong" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">4. Tiện Ích Tầng Không &amp; Sky Lounge Ngắm Hoàng Hôn</h2>
<p>Lên tới đỉnh các tòa tháp là chuỗi tiện ích tầng không độc bản: Vườn thiền Zen Garden tĩnh lặng, Đài thiên văn Stargazing Deck ngắm sao đêm và Sky Lounge ngoài trời. Đây là nơi cư dân thưởng thức một ly cocktail ngắm nhìn hoàng hôn rực rỡ buông xuống phía Tây Hà Nội sau một ngày làm việc bận rộn.</p>

<h2 id="dang-ky-trai-nghiem" style="color:#0B2C4D;font-size:24px;font-weight:800;margin:30px 0 15px">5. Đăng Ký Tham Quan Căn Hộ Thực Tế &amp; Tiện Ích</h2>
<p>Hãy là những chủ nhân đầu tiên trải nghiệm không gian sống mang đậm hơi thở resort quốc tế tại Lumi Hanoi CapitaLand. Đăng ký nhận vé mời tham quan nhà mẫu và trải nghiệm thực tế ngay hôm nay:</p>

[kbds_lead_form_cao_tang project="Chung Cư Lumi Hanoi CapitaLand" title="📥 ĐĂNG KÝ NHẬN VÉ THAM QUAN NHÀ MẪU &amp; HỆ TIỆN ÍCH 5 SAO" button_text="GỬI VÉ MỜI CHO TÔI QUA ZALO ➔"]
HTML
    ]
];

foreach ($posts as $p_item) {
    $existing_post = get_page_by_path($p_item['slug'], OBJECT, 'post');
    $pid = $existing_post ? $existing_post->ID : 0;
    
    $post_data = [
        'post_title'   => $p_item['title'],
        'post_name'    => $p_item['slug'],
        'post_content' => $p_item['content'],
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'post_author'  => 1
    ];
    
    if ($pid > 0) {
        $post_data['ID'] = $pid;
        wp_update_post($post_data);
        echo "Updated post ID: $pid\n";
    } else {
        $pid = wp_insert_post($post_data);
        echo "Created post ID: $pid\n";
    }
    
    set_post_thumbnail($pid, $p_item['thumb']);
    update_post_meta($pid, '_kbds_project_ref', $parent_project_id);
    
    // Rank Math
    update_post_meta($pid, 'rank_math_title', $p_item['title'] . ' | Kênh Bất Động Sản');
    update_post_meta($pid, 'rank_math_description', $p_item['desc']);
    update_post_meta($pid, 'rank_math_focus_keyword', $p_item['focus_kw']);
    update_post_meta($pid, 'rank_math_robots', serialize(['index', 'follow']));
    update_post_meta($pid, 'rank_math_seo_score', 95);
    update_post_meta($pid, 'rank_math_internal_links_processed', 1);
}

echo "Created/Updated Lumi Hanoi satellite posts successfully!\n";
