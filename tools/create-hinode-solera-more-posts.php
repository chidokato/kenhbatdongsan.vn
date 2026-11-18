<?php
/**
 * Tạo thêm 5 Bài viết vệ tinh SEO mở rộng cho Dự Án Hinode Solera Phạm Hùng
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU TẠO THÊM 5 BÀI VIẾT VỆ TINH CHO HINODE SOLERA PHẠM HÙNG\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/hinode-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/hinode-media-map.json!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// Tìm Project Hub Hinode Solera
$proj = get_page_by_path('hinode-solera-pham-hung', OBJECT, 'du_an');
if (!$proj) {
    // Thử tìm theo slug
    $found = get_posts([
        'post_type' => 'du_an',
        'name' => 'hinode-solera-pham-hung',
        'posts_per_page' => 1,
        'post_status' => 'any'
    ]);
    if ($found) {
        $proj = $found[0];
    }
}

if (!$proj) {
    die("❌ Không tìm thấy Dự án Hinode Solera Phạm Hùng trên hệ thống!\n");
}

$proj_id = $proj->ID;
$proj_slug = $proj->post_name;
echo "✔ Đã kết nối Project Hub ID: {$proj_id} ({$proj->post_title})\n";

// Cập nhật limit cho shortcode tin tức trên trang dự án thành 12
if (strpos($proj->post_content, 'limit="6"') !== false) {
    $updated_content = str_replace('limit="6"', 'limit="12"', $proj->post_content);
    wp_update_post([
        'ID' => $proj_id,
        'post_content' => $updated_content
    ]);
    echo "✔ Đã nâng giới hạn hiển thị tin tức dự án lên 12 bài viết.\n";
}

// 5 BÀI VIẾT VỆ TINH MỚI
$new_posts = [
    [
        'title' => 'Thiết Kế Căn Hộ 1 Phòng Ngủ Hinode Solera Phạm Hùng: Không Gian Sống Tinh Tế Cho Chuyên Gia & Gia Đình Trẻ',
        'slug'  => 'thiet-ke-can-ho-1pn-hinode-solera-pham-hung',
        'cat_id'=> 2, // Review & Phân tích Dự án
        'thumb' => $m['mat_bang_dien_hinh']['id'],
        'seo_focus' => 'thiết kế căn hộ 1 phòng ngủ Hinode Solera',
        'seo_desc' => 'Đánh giá chi tiết thiết kế căn hộ 1 phòng ngủ (54.3m² – 57.1m²) tại dự án Hinode Solera 28 Phạm Hùng: Tối ưu ánh sáng, ban công thoáng, lựa chọn hoàn hảo cho chuyên gia và gia đình trẻ.',
        'content' => <<<HTML
<p>Trong bối cảnh quỹ căn hộ diện tích vừa phải nhưng sở hữu tiêu chuẩn bàn giao cao cấp tại trung tâm Mỹ Đình ngày càng khan hiếm, <strong>thiết kế căn hộ 1 phòng ngủ tại <a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a></strong> nổi lên như một điểm sáng đắt giá thu hút đông đảo khách hàng trẻ thành đạt và các nhà đầu tư cho thuê chuyên nghiệp.</p>

<h2>1. Cơ Cấu Diện Tích & Mã Căn 1 Phòng Ngủ Trên Mặt Sàn</h2>
<p>Trên mỗi tầng điển hình của tòa tháp Hinode Solera 28 Phạm Hùng, chủ đầu tư WTO bố trí 5 căn hộ 1 phòng ngủ với diện tích thông thủy từ <strong>54.3m² đến 57.1m²</strong>, bao gồm các mã căn cụ thể:</p>
<ul>
  <li><strong>Căn hộ S-06 (Diện tích thông thủy: 54.3m²):</strong> Căn hộ 1PN nhỏ gọn, tối ưu công năng, không gian bếp và phòng khách liên thông thoáng đãng.</li>
  <li><strong>Các căn hộ S-01, S-11, S-12, S-15 (Diện tích thông thủy: 57.1m²):</strong> Căn 1PN tiêu chuẩn diện tích rộng rãi, bố trí thêm không gian làm việc hoặc góc đọc sách tiện nghi.</li>
</ul>

<p style="text-align:center;">
  <img src="{$m['mat_bang_dien_hinh']['url']}" alt="{$m['mat_bang_dien_hinh']['alt']}" style="width:100%;max-width:850px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Vị trí các mã căn 1 phòng ngủ (S-01, S-06, S-11, S-12, S-15) trên mặt bằng tầng điển hình Hinode Solera Phạm Hùng.</span>
</p>

<h2>2. Ưu Điểm Vượt Trội Trong Thiết Kế Căn Hộ 1PN Hinode Solera</h2>
<ol>
  <li><strong>Tối ưu ánh sáng tự nhiên:</strong> 100% phòng ngủ và phòng khách đều sở hữu cửa sổ kính Low-E tràn viền chạm sàn, mang ánh sáng tự nhiên và gió trời mát lành vào từng ngóc ngách căn phòng.</li>
  <li><strong>Khu vực bếp thông minh:</strong> Bếp được thiết kế vuông vắn nối thẳng ra logia giặt phơi, giúp thoát mùi nhanh chóng khi nấu nướng mà không ảnh hưởng đến không gian phòng khách.</li>
  <li><strong>Ban công rộng thoáng:</strong> Ban công phòng khách có chiều sâu lý tưởng, đủ để gia chủ bố trí bàn trà ngắm cảnh hoàng hôn hoặc vườn cây xanh mini thư giãn.</li>
  <li><strong>Nội thất bàn giao cao cấp:</strong> Trang bị hệ thống điều hòa âm trần multi, khóa cửa thông minh vân tay cao cấp, thiết bị vệ sinh nhập khẩu chuẩn khách sạn 5 sao.</li>
</ol>

<h2>3. Đối Tượng Khách Hàng Phù Hợp & Tiềm Năng Cho Thuê</h2>
<p>Với mức giá hợp lý và diện tích dễ sở hữu, căn hộ 1PN Hinode Solera đặc biệt phù hợp với:</p>
<ul>
  <li><strong>Gia đình trẻ mới kết hôn:</strong> Cần tổ ấm hiện đại, an ninh khép kín, tiện ích đầy đủ ngay trung tâm để thuận tiện đi làm.</li>
  <li><strong>Chuyên gia nước ngoài:</strong> Các kỹ sư, chuyên gia Hàn Quốc, Nhật Bản làm việc tại Keangnam Landmark 72, The Manor, thung lũng công nghệ Duy Tân.</li>
  <li><strong>Nhà đầu tư cho thuê:</strong> Dễ dàng đạt tỷ suất lợi nhuận cho thuê từ 8% - 10%/năm nhờ tính thanh khoản cao và nhu cầu thuê luôn vượt nguồn cung.</li>
</ul>
HTML
    ],

    [
        'title' => 'Thiết Kế Căn Hộ 2 Phòng Ngủ Hinode Solera Phạm Hùng: Chuẩn Mực Tổ Ấm Hiện Đại Trung Tâm Mỹ Đình',
        'slug'  => 'thiet-ke-can-ho-2pn-hinode-solera-pham-hung',
        'cat_id'=> 2, // Review & Phân tích Dự án
        'thumb' => $m['mat_bang_dien_hinh']['id'],
        'seo_focus' => 'thiết kế căn hộ 2 phòng ngủ Hinode Solera',
        'seo_desc' => 'Khám phá thiết kế căn hộ 2 phòng ngủ (87.7m² – 88.3m²) tại Hinode Solera Phạm Hùng: Diện tích tối ưu, 2 WC rộng rãi, không gian gắn kết ấm cúng cho gia đình hạt nhân.',
        'content' => <<<HTML
<p>Trong cơ cấu sản phẩm tại dự án <strong><a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a></strong>, dòng căn hộ 2 phòng ngủ là loại hình sản phẩm được tìm kiếm nhiều nhất nhờ diện tích lý tưởng từ <strong>87.7m² đến 88.3m²</strong>, đáp ứng trọn vẹn tiêu chuẩn sống tiện nghi của các gia đình hạt nhân từ 3 – 4 thành viên.</p>

<h2>1. Chi Tiết Các Mã Căn 2 Phòng Ngủ Trên Mặt Bằng Tầng Điển Hình</h2>
<p>Mỗi tầng điển hình của Hinode Solera có 5 căn hộ 2 phòng ngủ, được bố trí tại các vị trí thoáng sáng:</p>
<ul>
  <li><strong>Căn hộ S-10 (Diện tích thông thủy: 88.3m²):</strong> Căn hộ góc 2 mặt thoáng view nhìn rộng mở về phía Tây thủ đô.</li>
  <li><strong>Căn hộ S-05 và S-07 (Diện tích thông thủy: 87.8m²):</strong> Mặt tiền hướng Nam nhìn thẳng trục đường Phạm Hùng và công viên hồ điều hòa Cầu Giấy 32ha.</li>
  <li><strong>Căn hộ S-12A và S-12B (Diện tích thông thủy: 87.7m²):</strong> Bố trí hợp lý, đón gió đông nam mát mẻ quanh năm.</li>
</ul>

<p style="text-align:center;">
  <img src="{$m['mat_bang_dien_hinh']['url']}" alt="{$m['mat_bang_dien_hinh']['alt']}" style="width:100%;max-width:850px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Mặt bằng chi tiết các căn hộ 2 phòng ngủ (S-05, S-07, S-10, S-12A, S-12B) tại Hinode Solera Phạm Hùng.</span>
</p>

<h2>2. Triết Lý Thiết Kế: Cân Bằng Giữa Riêng Tư & Gắn Kết Gia Đình</h2>
<p>Các kiến trúc sư tài ba của WTO đã tính toán tỉ mỉ đến từng centimet để tối ưu hóa công năng căn 2PN:</p>
<ul>
  <li><strong>Phòng khách & Phòng ăn không khoảng góc chết:</strong> Không gian sinh hoạt chung rộng tới gần 35m², tạo cảm giác thoáng đãng như căn hộ 100m², là nơi cả gia đình quây quần sum họp sau mỗi ngày làm việc.</li>
  <li><strong>2 Phòng ngủ độc lập:</strong> Phòng ngủ Master dành cho bố mẹ có phòng tắm khép kín và khu vực để bàn trang điểm/tủ quần áo rộng rãi; phòng ngủ phụ cho con cái sở hữu cửa sổ lớn ngập tràn ánh sáng.</li>
  <li><strong>2 Phòng vệ sinh hiện đại:</strong> Trang bị vách kính tắm đứng, sen tắm nhiệt độ ổn định chuẩn Nhật Bản, gạch ốp chống trơn trượt cao cấp.</li>
  <li><strong>Khu giặt phơi tách biệt:</strong> Logia kỹ thuật đặt máy giặt và dàn phơi thông minh, đảm bảo mỹ quan tổng thể cho mặt ngoài tòa nhà.</li>
</ul>

<h2>3. Giá Trị Sống Vững Bền Cho Gia Đình Trẻ Thành Đạt</h2>
<p>Sở hữu căn hộ 2 phòng ngủ tại số 28 Phạm Hùng, gia đình bạn sẽ được sống trong một quần thể dịch vụ 5 sao khép kín: con cái theo học tại các trường điểm chất lượng cao như Marie Curie, Lomonoxop chỉ mất vài phút đi bộ; bố mẹ rèn luyện sức khỏe mỗi ngày tại bể bơi bốn mùa hay dạo bộ quanh hồ điều hòa Cầu Giấy trong lành.</p>
HTML
    ],

    [
        'title' => 'Khám Phá Căn Hộ 3 Phòng Ngủ Hinode Solera Phạm Hùng: Đỉnh Cao Sống Thượng Lưu View Hồ 32ha',
        'slug'  => 'thiet-ke-can-ho-3pn-hinode-solera-pham-hung',
        'cat_id'=> 2, // Review & Phân tích Dự án
        'thumb' => $m['vi_tri_ho_cau_giay']['id'],
        'seo_focus' => 'căn hộ 3 phòng ngủ Hinode Solera',
        'seo_desc' => 'Trải nghiệm không gian sống thượng lưu tại căn hộ 3 phòng ngủ mã căn S-08 (122.7m²) Hinode Solera Phạm Hùng: Tầm nhìn trực diện công viên hồ điều hòa Cầu Giấy 32ha và Keangnam.',
        'content' => <<<HTML
<p>Nếu bạn đang tìm kiếm một không gian sống đẳng cấp, rộng lớn dành cho gia đình đa thế hệ ngay giữa trung tâm hành chính mới Mỹ Đình, thì <strong>căn hộ 3 phòng ngủ mã căn S-08 tại dự án <a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a></strong> chính là siêu phẩm độc bản không thể bỏ qua.</p>

<h2>1. Vị Trí Độc Tôn: Duy Nhất 1 Căn/Sàn Điển Hình</h2>
<p>Khác biệt hoàn toàn với các dự án căn hộ thương mại đại trà, tại Hinode Solera số 28 Phạm Hùng, căn hộ 3 phòng ngủ là "hàng hiếm" khi mỗi tầng chỉ có <strong>duy nhất 1 căn (Mã căn S-08)</strong> với diện tích thông thủy lên tới <strong>122.7 m²</strong>.</p>

<p style="text-align:center;">
  <img src="{$m['vi_tri_ho_cau_giay']['url']}" alt="{$m['vi_tri_ho_cau_giay']['alt']}" style="width:100%;max-width:850px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Tầm nhìn triệu đô trực diện công viên hồ điều hòa Cầu Giấy 32ha từ ban công căn hộ 3PN S-08 Hinode Solera.</span>
</p>

<h2>2. Tầm Nhìn Panorama Triệu Đô Trực Diện Mặt Nước 19ha</h2>
<p>Căn hộ S-08 tọa lạc tại vị trí trung tâm mặt tiền tòa tháp, sở hữu tầm nhìn trực diện không giới hạn hướng thẳng sang <strong>Công viên hồ điều hòa Cầu Giấy rộng 32ha</strong> và kế cận tháp tài chính Keangnam Landmark 72 biểu tượng. Vào mỗi buổi sáng sớm hay chiều tà, gia chủ có thể thảnh thơi nhâm nhi tách trà bên ban công lộng gió, chiêm ngưỡng mặt hồ phẳng lặng xanh ngắt – một đặc quyền sống nghỉ dưỡng xa xỉ giữa lòng thủ đô.</p>

<h2>3. Bố Trí Mặt Bằng Công Năng Đỉnh Cao</h2>
<ul>
  <li><strong>Phòng khách Master sang trọng:</strong> Chiều ngang rộng mở, nối liền ban công kính Low-E tràn viền, tôn vinh đẳng cấp thượng lưu của chủ nhân mỗi khi đón tiếp khách quý.</li>
  <li><strong>3 Phòng ngủ thoáng sáng:</strong> Phòng ngủ Master sở hữu bồn tắm nằm và phòng thay đồ Walk-in Closet riêng biệt; 2 phòng ngủ phụ được thiết kế vuông vức, đảm bảo không gian riêng tư cho ông bà và con cái.</li>
  <li><strong>Bếp khép kín cao cấp:</strong> Khu bếp nối liền logia phụ, trang bị đầy đủ hệ tủ bếp Acrylic, mặt đá nhân tạo cao cấp và thiết bị hút mùi hiện đại.</li>
  <li><strong>Phòng đa năng / Phòng làm việc:</strong> Dễ dàng biến tấu thành phòng làm việc tại gia, phòng đọc sách hoặc không gian tâm linh trang nghiêm.</li>
</ul>

<h2>4. Giá Trị Truyền Đời & Tài Sản Khẳng Định Vị Thế</h2>
<p>Số lượng giới hạn chỉ khoảng 20 căn hộ 3PN trên toàn dự án khiến mã căn S-08 luôn giữ vững giá trị gia tăng lũy tiến theo thời gian, là món quà bảo chứng tài sản vững bền truyền đời cho thế hệ tương lai.</p>
HTML
    ],

    [
        'title' => 'Phân Tích Tiềm Năng Khai Thác Cho Thuê Căn Hộ Hinode Solera Phạm Hùng: Điểm Hẹn Chuyên Gia Ngoại Quốc',
        'slug'  => 'tiem-nang-cho-thue-hinode-solera-pham-hung',
        'cat_id'=> 2, // Review & Phân tích Dự án
        'thumb' => $m['phoi_canh_toa_thap']['id'],
        'seo_focus' => 'tiềm năng cho thuê Hinode Solera Phạm Hùng',
        'seo_desc' => 'Đánh giá tiềm năng đầu tư cho thuê căn hộ Hinode Solera số 28 Phạm Hùng: Tỷ suất lợi nhuận 7% - 9%/năm nhờ sức hút từ cộng đồng chuyên gia quốc tế tại Mỹ Đình - Mễ Trì.',
        'content' => <<<HTML
<p>Thị trường cho thuê căn hộ cao cấp tại khu vực Mỹ Đình – Mễ Trì (Nam Từ Liêm) từ lâu đã được mệnh danh là "mỏ vàng" của các nhà đầu tư bất động sản thủ đô. Với sự xuất hiện của dự án <strong><a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a></strong>, bài toán đầu tư khai thác dòng tiền cho thuê tiếp tục được nâng lên một tầm cao mới.</p>

<h2>1. Vị Thế "Thủ Phủ Chuyên Gia Ngoại Quốc" Tại Mỹ Đình - Mễ Trì</h2>
<p>Khu vực xung quanh tòa tháp Keangnam Landmark 72, đường Phạm Hùng và khu đô thị The Manor hiện là nơi tập trung cộng đồng người Hàn Quốc, Nhật Bản và Đài Loan đông đúc nhất Hà Nội với hơn <strong>30.000 chuyên gia, CEO và kỹ sư cao cấp</strong> đang sinh sống và làm việc lâu dài.</p>

<p style="text-align:center;">
  <img src="{$m['phoi_canh_toa_thap']['url']}" alt="{$m['phoi_canh_toa_thap']['alt']}" style="width:100%;max-width:800px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Tòa tháp căn hộ hạng sang Hinode Solera sở hữu sức hút cho thuê mãnh liệt tại cửa ngõ phía Tây thủ đô.</span>
</p>

<h2>2. Tiêu Chí Chọn Nhà Khắt Khe Của Khách Ngoại & Sự Đáp Ứng Của Hinode Solera</h2>
<p>Các chuyên gia nước ngoài thường sẵn sàng chi trả từ <strong>800 USD đến 2.500 USD/tháng</strong> cho một căn hộ, nhưng đặt ra những yêu cầu cực kỳ khắt khe:</p>
<ul>
  <li><strong>Vị trí mặt tiền đại lộ lớn:</strong> Thuận tiện di chuyển đến các khu công nghiệp tại Bắc Ninh, Thái Nguyên, Hải Phòng thông qua đường Vành đai 3 trên cao.</li>
  <li><strong>Tầm nhìn sinh thái xanh:</strong> Hinode Solera sở hữu tầm nhìn trực diện công viên hồ điều hòa Cầu Giấy 32ha, mang lại không gian tĩnh dưỡng sau những giờ làm việc áp lực.</li>
  <li><strong>Hệ thống tiện ích 5 sao:</strong> Tích hợp 5 tầng khối đế thương mại sầm uất, bể bơi bốn mùa, gym, spa và an ninh bảo vệ đa tầng nghiêm ngặt.</li>
  <li><strong>Vận hành chuẩn phong cách Nhật Bản:</strong> Tỉ mỉ, chu đáo và tôn trọng tuyệt đối tính riêng tư của cư dân.</li>
</ul>

<h2>3. Đột Phá Doanh Thu Với Dòng Căn Hộ Dual Key</h2>
<p>Đặc biệt, sự xuất hiện của các căn hộ Dual Key 1+1 (88.5m² – 122.2m²) và Dual Key 2+1 (159.4m²) tại Hinode Solera mang đến giải pháp "nhân đôi dòng tiền" độc nhất vô nhị:</p>
<table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:14px;">
  <thead>
    <tr style="background:#0F172A;color:#fff;">
      <th style="padding:10px;text-align:left;">Loại hình căn hộ</th>
      <th style="padding:10px;text-align:center;">Giá thuê ước tính</th>
      <th style="padding:10px;text-align:center;">Tỷ suất lợi nhuận/năm</th>
    </tr>
  </thead>
  <tbody>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:600;">Căn 1 Phòng ngủ (54.3 - 57.1m²)</td>
      <td style="padding:10px;text-align:center;color:#D97706;font-weight:700;">14 - 17 triệu/tháng</td>
      <td style="padding:10px;text-align:center;font-weight:700;">~7.5% - 8.5%</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:600;">Căn 2 Phòng ngủ (87.7 - 88.3m²)</td>
      <td style="padding:10px;text-align:center;color:#D97706;font-weight:700;">22 - 28 triệu/tháng</td>
      <td style="padding:10px;text-align:center;font-weight:700;">~7.0% - 8.0%</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:600;">Căn 3 Phòng ngủ VIP (122.7m²)</td>
      <td style="padding:10px;text-align:center;color:#D97706;font-weight:700;">32 - 40 triệu/tháng</td>
      <td style="padding:10px;text-align:center;font-weight:700;">~6.8% - 7.5%</td>
    </tr>
    <tr>
      <td style="padding:10px;font-weight:600;color:#DC2626;">Căn Dual Key Khai Thác Kép</td>
      <td style="padding:10px;text-align:center;color:#DC2626;font-weight:700;">36 - 48 triệu/tháng</td>
      <td style="padding:10px;text-align:center;color:#DC2626;font-weight:700;">~9.0% - 11.5%</td>
    </tr>
  </tbody>
</table>

<p>Nhờ lợi thế khan hiếm quỹ đất nội đô và chất lượng công trình vượt trội, Hinode Solera Phạm Hùng tự tin là kênh trú ẩn dòng tiền an toàn và sinh lời bền vững bậc nhất thị trường Hà Nội năm 2026.</p>
HTML
    ],

    [
        'title' => 'Cập Nhật Giá Bán & Chính Sách Bán Hàng Hinode Solera Phạm Hùng Mới Nhất Năm 2026',
        'slug'  => 'gia-ban-chinh-sach-hinode-solera-pham-hung',
        'cat_id'=> 2, // Review & Phân tích Dự án
        'thumb' => $m['phoi_canh_toa_thap']['id'],
        'seo_focus' => 'giá bán Hinode Solera Phạm Hùng',
        'seo_desc' => 'Cập nhật thông tin giá bán dự kiến đợt 1, chính sách chiết khấu thanh toán sớm và gói vay hỗ trợ lãi suất 0% tại chung cư Hinode Solera số 28 Phạm Hùng năm 2026.',
        'content' => <<<HTML
<p>Dự án <strong><a href="/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a> (số 28 Phạm Hùng, quận Nam Từ Liêm, Hà Nội)</strong> đang thu hút sự chú ý đặc biệt từ giới đầu tư và khách hàng mua ở thực. Dưới đây là bảng tổng hợp giá bán dự kiến đợt 1 và các gói chính sách bán hàng ưu đãi tài chính hấp dẫn nhất trong năm 2026.</p>

<h2>1. Mặt Bằng Giá Căn Hộ Cao Cấp Trục Đường Phạm Hùng Hiện Nay</h2>
<p>Trục đường Vành đai 3 Phạm Hùng là tuyến đại lộ kim cương của phía Tây thủ đô, nơi quỹ đất phát triển nhà ở đã hoàn toàn cạn kiệt. Khảo sát thực tế giá bán chuyển nhượng các dự án lân cận:</p>
<ul>
  <li><strong>Vinhomes Skylake (đối diện qua đường Phạm Hùng):</strong> Giá giao dịch căn hộ hiện dao động từ 75 – 105 triệu/m².</li>
  <li><strong>Keangnam Landmark 72:</strong> Căn hộ đã vận hành hơn 12 năm vẫn duy trì mức giá 55 – 70 triệu/m².</li>
  <li><strong>The Matrix One Mễ Trì:</strong> Giá chuyển nhượng từ 85 – 120 triệu/m².</li>
</ul>
<p>Với lợi thế công trình mới xây dựng, công nghệ thi công hiện đại và tiêu chuẩn bàn giao cao cấp, mức giá mở bán đợt 1 của Hinode Solera được đánh giá là cực kỳ cạnh tranh và sở hữu biên độ tăng giá rất lớn.</p>

<p style="text-align:center;">
  <img src="{$m['phoi_canh_toa_thap']['url']}" alt="{$m['phoi_canh_toa_thap']['alt']}" style="width:100%;max-width:800px;border-radius:12px;margin:20px 0;display:block;margin-left:auto;margin-right:auto;">
  <span style="font-size:13.5px;color:#64748B;font-style:italic;">Cơ hội sở hữu căn hộ Hinode Solera số 28 Phạm Hùng với chính sách giá gốc đợt 1 từ chủ đầu tư WTO.</span>
</p>

<h2>2. Bảng Giá Dự Kiến Theo Từng Loại Căn Hộ Đợt 1</h2>
<table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:14px;">
  <thead>
    <tr style="background:#0F172A;color:#fff;">
      <th style="padding:10px;text-align:left;">Loại hình sản phẩm</th>
      <th style="padding:10px;text-align:center;">Diện tích thông thủy</th>
      <th style="padding:10px;text-align:center;">Giá bán tham khảo đợt 1</th>
      <th style="padding:10px;text-align:left;">Phù hợp với nhu cầu</th>
    </tr>
  </thead>
  <tbody>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:600;">Căn hộ 1 Phòng ngủ</td>
      <td style="padding:10px;text-align:center;">54.3 – 57.1 m²</td>
      <td style="padding:10px;text-align:center;color:#D97706;font-weight:700;">Từ 3.x tỷ/căn</td>
      <td style="padding:10px;">Chuyên gia độc thân & gia đình trẻ mới cưới</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:600;">Căn hộ 2 Phòng ngủ</td>
      <td style="padding:10px;text-align:center;">87.7 – 88.3 m²</td>
      <td style="padding:10px;text-align:center;color:#D97706;font-weight:700;">Từ 5.x tỷ/căn</td>
      <td style="padding:10px;">Gia đình hạt nhân 3 - 4 thành viên</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:600;">Căn hộ 3 Phòng ngủ VIP</td>
      <td style="padding:10px;text-align:center;">122.7 m²</td>
      <td style="padding:10px;text-align:center;color:#D97706;font-weight:700;">Từ 8.x tỷ/căn</td>
      <td style="padding:10px;">Gia đình đa thế hệ, view trọn hồ Cầu Giấy</td>
    </tr>
    <tr>
      <td style="padding:10px;font-weight:600;color:#DC2626;">Căn hộ Dual Key (1+1 & 2+1)</td>
      <td style="padding:10px;text-align:center;">88.5 – 159.4 m²</td>
      <td style="padding:10px;text-align:center;color:#DC2626;font-weight:700;">Liên hệ nhận báo giá</td>
      <td style="padding:10px;">Nhà đầu tư khai thác cho thuê kép chuyên gia</td>
    </tr>
  </tbody>
</table>

<h2>3. Chính Sách Bán Hàng & Hỗ Trợ Lãi Suất Ưu Đãi Đợt 1</h2>
<ol>
  <li><strong>Chính sách thanh toán sớm:</strong> Khách hàng thanh toán sớm bằng vốn tự có dự kiến nhận mức chiết khấu hấp dẫn lên tới <strong>6% – 8%</strong> trên tổng giá trị căn hộ.</li>
  <li><strong>Hỗ trợ tài chính từ ngân hàng bảo lãnh:</strong>
    <ul>
      <li>Hỗ trợ vay vốn tối đa lên tới <strong>70% giá trị hợp đồng mua bán</strong>.</li>
      <li>Ân hạn nợ gốc và hỗ trợ lãi suất <strong>0% trong vòng 18 – 24 tháng</strong> (hoặc đến khi nhận bàn giao nhà).</li>
      <li>Miễn phí trả nợ trước hạn trong thời gian hỗ trợ lãi suất.</li>
    </ul>
  </li>
  <li><strong>Tiến độ thanh toán chuẩn:</strong> Chia nhỏ thành 7 – 8 đợt linh hoạt theo tiến độ xây dựng thực tế của công trình, giảm tối đa áp lực dòng tiền cho khách hàng.</li>
</ol>

<h2>4. Đăng Ký Nhận Bảng Giá Gốc & Chọn Căn Đợt 1</h2>
<p>Để nhận trọn bộ tài liệu thiết kế mặt bằng chi tiết 16 căn hộ, bảng tính dòng tiền ngân hàng và bảng giá đợt 1 trực tiếp từ chủ đầu tư WTO, quý khách vui lòng liên hệ trực tiếp hoặc để lại thông tin tại biểu mẫu dưới đây:</p>

[kbds_lead_form project="Chung Cư Hinode Solera Phạm Hùng" title="Đăng Ký Nhận Bảng Giá Đợt 1 Hinode Solera" button_text="Gửi Yêu Cầu Nhận Bảng Giá Gốc"]
HTML
    ]
];

// Tiến hành tạo hoặc cập nhật 5 bài viết
foreach ($new_posts as $p_item) {
    $existing = get_posts([
        'post_type' => 'post',
        'name' => $p_item['slug'],
        'posts_per_page' => 1,
        'post_status' => 'any'
    ]);

    $post_data = [
        'post_title'   => $p_item['title'],
        'post_name'    => $p_item['slug'],
        'post_content' => $p_item['content'],
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'post_excerpt' => $p_item['seo_desc']
    ];

    if (!empty($existing)) {
        $post_id = $existing[0]->ID;
        $post_data['ID'] = $post_id;
        wp_update_post($post_data);
        echo " ✔ Cập nhật Bài viết [{$p_item['title']}] (ID: {$post_id})\n";
    } else {
        $post_id = wp_insert_post($post_data);
        echo " + Tạo mới Bài viết [{$p_item['title']}] (ID: {$post_id})\n";
    }

    // Gắn Thumbnail
    set_post_thumbnail($post_id, $p_item['thumb']);

    // Gắn Chuyên mục chuẩn (Review & Phân tích Dự án)
    wp_set_post_categories($post_id, [$p_item['cat_id']]);

    // Gắn Meta _kbds_project_ref liên kết ngược về Dự Án Hub
    update_post_meta($post_id, '_kbds_project_ref', $proj_id);
    update_post_meta($post_id, '_kbds_project_slug', $proj_slug);

    // Rank Math SEO
    update_post_meta($post_id, 'rank_math_title', $p_item['title']);
    update_post_meta($post_id, 'rank_math_description', $p_item['seo_desc']);
    update_post_meta($post_id, 'rank_math_focus_keyword', $p_item['seo_focus']);
}

echo "\n🎉 HOÀN TẤT TẠO THÊM 5 BÀI VIẾT VỆ TINH CHO HINODE SOLERA PHẠM HÙNG!\n";
