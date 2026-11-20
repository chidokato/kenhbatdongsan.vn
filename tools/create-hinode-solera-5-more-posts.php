<?php
/**
 * Tạo 5 Bài viết vệ tinh SEO mở rộng cho Dự Án Hinode Solera Phạm Hùng
 * - 3 bài đăng hôm nay (2026-11-20): Pháp lý, Tiến độ thực tế (ảnh user), So sánh Skylake & The Matrix One
 * - 2 bài lên lịch đăng ngày mai (2026-11-21): Tiêu chuẩn bàn giao nội thất, Đòn bẩy hạ tầng Metro số 5 & 8
 */

$root = dirname(__DIR__);
require_once $root . '/wp-load.php';

echo "\n==============================================================\n";
echo "🚀 BẮT ĐẦU TẠO 5 BÀI VIẾT VỆ TINH MỚI CHO HINODE SOLERA PHẠM HÙNG\n";
echo "==============================================================\n";

$map_file = __DIR__ . '/hinode-media-map.json';
if (!file_exists($map_file)) {
    die("❌ Không tìm thấy file tools/hinode-media-map.json!\n");
}
$m = json_decode(file_get_contents($map_file), true);

// Tìm Project Hub Hinode Solera
$proj = get_page_by_path('hinode-solera-pham-hung', OBJECT, 'du_an');
if (!$proj) {
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

// Nâng limit cho shortcode tin tức trên trang dự án lên 16 bài
if (strpos($proj->post_content, 'limit="12"') !== false) {
    $updated_content = str_replace('limit="12"', 'limit="16"', $proj->post_content);
    wp_update_post([
        'ID' => $proj_id,
        'post_content' => $updated_content
    ]);
    echo "✔ Đã nâng giới hạn hiển thị tin tức dự án lên 16 bài viết.\n";
}

$posts_data = [
    // ------------------------------------------------------------------------------------
    // BÀI 1 (ĐĂNG HÔM NAY): PHÁP LÝ DỰ ÁN HINODE SOLERA 28 PHẠM HÙNG
    // ------------------------------------------------------------------------------------
    [
        'title'      => 'Pháp Lý Dự Án Hinode Solera 28 Phạm Hùng: Hồ Sơ Phê Duyệt, Giấy Phép Xây Dựng & Cam Kết Sở Hữu Lâu Dài',
        'slug'       => 'phap-ly-du-an-hinode-solera-pham-hung',
        'status'     => 'publish',
        'date'       => '2026-11-20 09:35:00',
        'date_gmt'   => '2026-11-20 02:35:00',
        'cat_id'     => 6, // Cẩm nang Pháp lý
        'cat_slug'   => 'cam-nang-phap-ly',
        'thumb_id'   => $m['toan_canh_toa_thap_pham_hung']['id'],
        'seo_focus'  => 'pháp lý Hinode Solera Phạm Hùng',
        'seo_title'  => 'Pháp Lý Dự Án Hinode Solera 28 Phạm Hùng: Giấy Phép & Sở Hữu Lâu Dài | Kênh Bất Động Sản',
        'seo_desc'   => 'Đánh giá chi tiết hồ sơ pháp lý dự án Hinode Solera số 28 Phạm Hùng: Quy hoạch 1/500, giấy phép xây dựng, bảo lãnh ngân hàng và quyền sở hữu sổ hồng lâu dài.',
        'content'    => <<<HTML
<p>Trong bối cảnh thị trường bất động sản Thủ đô ngày càng thanh lọc mạnh mẽ, yếu tố <strong>pháp lý minh bạch</strong> và <strong>tiến độ thi công thực tế</strong> trở thành thước đo quan trọng hàng đầu giúp người mua nhà an tâm "chọn mặt gửi vàng". Tọa lạc tại số 28 Phạm Hùng (quận Nam Từ Liêm, Hà Nội), dự án <strong><a href="https://kenhbatdongsan.vn/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a></strong> do Tổng công ty Cổ phần Thương mại Xây dựng (<strong>WTO - Vietracimex</strong>) phát triển đang là tâm điểm chú ý nhờ tính chuẩn chỉ về mặt pháp lý và việc công trình đã chính thức cất nóc xong phần thô.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['toan_canh_toa_thap_pham_hung']['url']}" alt="{$m['toan_canh_toa_thap_pham_hung']['alt']}" /><figcaption>{$m['toan_canh_toa_thap_pham_hung']['caption']}</figcaption></figure></div>

<h2>1. Hồ Sơ Pháp Lý Dự Án Số 28 Phạm Hùng Gồm Những Gì?</h2>
<p>Dự án Hinode Solera (tên thương mại trước đây là Hinode Suite) được triển khai trên quỹ đất vàng mặt tiền đường Phạm Hùng với đầy đủ các văn bản pháp lý theo đúng quy định hiện hành của pháp luật về đầu tư xây dựng nhà ở thương mại:</p>
<ul>
  <li><strong>Quyết định phê duyệt quy hoạch chi tiết 1/500:</strong> Quy định rõ ràng chỉ tiêu kiến trúc, chiều cao công trình 25 tầng nổi và 3 tầng hầm, mật độ xây dựng và công năng sử dụng kết hợp giữa khối căn hộ cao cấp, văn phòng hạng A và trung tâm thương mại dịch vụ.</li>
  <li><strong>Chấp thuận chủ trương đầu tư:</strong> Được Ủy ban Nhân dân TP. Hà Nội chấp thuận cho chủ đầu tư WTO triển khai dự án tổ hợp đa năng hiện đại.</li>
  <li><strong>Giấy phép xây dựng hợp pháp:</strong> Công trình được cấp phép xây dựng đầy đủ các hạng mục từ cọc móng, tầng hầm cho tới khối tháp thân tòa nhà, đảm bảo toàn bộ quá trình thi công đều nằm dưới sự giám sát nghiêm ngặt của các cơ quan quản lý chuyên ngành.</li>
  <li><strong>Nghiệm thu phần móng & cất nóc phần thô:</strong> Dự án đã hoàn thành nghiệm thu phần móng và hiện đã cất nóc toàn bộ khung kết cấu bê tông cốt thép chịu lực, đủ điều kiện ký hợp đồng mua bán trực tiếp theo Luật Kinh doanh Bất động sản.</li>
</ul>

<h2>2. Quyền Sở Hữu Căn Hộ: Sổ Hồng Lâu Dài Vững Chắc</h2>
<p>Một trong những điểm then chốt mà khách hàng an cư lẫn nhà đầu tư đặc biệt quan tâm là hình thức sở hữu. Căn hộ tại Hinode Solera Phạm Hùng được cấp <strong>Giấy chứng nhận quyền sử dụng đất, quyền sở hữu nhà ở và tài sản khác gắn liền với đất (Sổ hồng)</strong> với thời hạn sở hữu ổn định <strong>Lâu dài</strong> đối với công dân Việt Nam, và 50 năm theo quy định đối với người nước ngoài đáp ứng điều kiện mua nhà tại Việt Nam.</p>
<p>Điều này biến mỗi căn hộ tại số 28 Phạm Hùng không chỉ là một tổ ấm sang trọng mà còn là một tài sản tích sản truyền đời có giá trị gia tăng bền vững, dễ dàng chuyển nhượng, thế chấp ngân hàng hoặc khai thác cho thuê sinh dòng tiền thụ động.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['thuc_te_cat_noc_toa_thap']['url']}" alt="{$m['thuc_te_cat_noc_toa_thap']['alt']}" /><figcaption>{$m['thuc_te_cat_noc_toa_thap']['caption']}</figcaption></figure></div>

<h2>3. Bảo Chứng Từ Uy Tín Chủ Đầu Tư WTO & Đơn Vị Quản Lý Vận Hành</h2>
<p>Chủ đầu tư <strong>WTO (Vietracimex)</strong> là một tập đoàn kinh tế đa ngành giàu tiềm lực với hơn 60 năm hình thành và phát triển. Chuỗi thương hiệu mang tên <em>Hinode</em> đã được khẳng định chất lượng qua các dự án tiêu biểu như <strong>Hinode City (201 Minh Khai, Hai Bà Trưng)</strong> và đại đô thị <strong>Hinode Royal Park (Hoài Đức)</strong>. Tiếp nối thành công đó, Hinode Solera Phạm Hùng được áp dụng các tiêu chuẩn khắt khe về kỹ thuật và kiến trúc mang đậm dấu ấn tinh hoa Nhật Bản.</p>

<p>Xem thêm đánh giá chi tiết về tiềm lực chủ đầu tư tại bài viết: <strong><a href="https://kenhbatdongsan.vn/chu-dau-tu-wto-hinode-solera-pham-hung/">Dấu Ấn Chủ Đầu Tư WTO & Chuỗi Thương Hiệu Hinode Tại Tòa Tháp Hạng Sang 28 Phạm Hùng</a></strong>.</p>

<h2>4. Bảo Lãnh Tài Chính Ngân Hàng & Tiến Độ Thanh Toán Linh Hoạt</h2>
<p>Dự án được bảo lãnh tiến độ và hợp tác chiến lược cùng các ngân hàng thương mại uy tín hàng đầu. Khách hàng giao dịch được hỗ trợ các gói vay ưu đãi tài chính:</p>
<ul>
  <li>Hỗ trợ vay vốn lên tới <strong>70% giá trị căn hộ</strong>.</li>
  <li>Chính sách hỗ trợ lãi suất <strong>0% và ân hạn nợ gốc</strong> trong suốt thời gian xây dựng hoàn thiện.</li>
  <li>Chiết khấu hấp dẫn lên tới <strong>6% – 8%</strong> dành cho khách hàng thanh toán sớm bằng vốn tự có.</li>
</ul>

<p>Nhờ nền tảng pháp lý vững vàng cùng sự đồng hành của ngân hàng lớn, người mua Hinode Solera được bảo vệ quyền lợi 100%, loại bỏ triệt để rủi ro chậm trễ tiến độ hay vướng mắc giấy tờ sở hữu.</p>

<p>Quý khách hàng quan tâm có thể tham khảo thêm thông tin chi tiết tại bài viết <strong><a href="https://kenhbatdongsan.vn/gia-ban-chinh-sach-hinode-solera-pham-hung/">Cập Nhật Bảng Giá Bán & Chính Sách Bán Hàng Hinode Solera Mới Nhất Năm 2026</a></strong>.</p>
HTML
    ],

    // ------------------------------------------------------------------------------------
    // BÀI 2 (ĐĂNG HÔM NAY): TIẾN ĐỘ THI CÔNG THỰC TẾ HINODE SOLERA NĂM 2026
    // ------------------------------------------------------------------------------------
    [
        'title'      => 'Tiến Độ Thi Công Thực Tế Tòa Tháp Hinode Solera Phạm Hùng Năm 2026: Đã Cất Nóc & Đang Hoàn Thiện Mặt Ngoài',
        'slug'       => 'tien-do-thi-cong-thuc-te-hinode-solera-pham-hung',
        'status'     => 'publish',
        'date'       => '2026-11-20 09:40:00',
        'date_gmt'   => '2026-11-20 02:40:00',
        'cat_id'     => 2, // Review & Phân tích Dự án
        'cat_slug'   => 'review-du-an',
        'thumb_id'   => $m['thuc_te_cat_noc_toa_thap']['id'],
        'seo_focus'  => 'tiến độ thi công Hinode Solera Phạm Hùng',
        'seo_title'  => 'Tiến Độ Thực Tế Hinode Solera 28 Phạm Hùng 2026: Đã Cất Nóc & Hoàn Thiện | Kênh Bất Động Sản',
        'seo_desc'   => 'Cập nhật tiến độ thực tế công trường chung cư Hinode Solera 28 Phạm Hùng năm 2026: Đã cất nóc xong phần thô, đang thi công cơ điện MEP và hoàn thiện mặt ngoài kính Low-E.',
        'content'    => <<<HTML
<p>Một trong những lợi thế cạnh tranh vượt trội nhất của dự án <strong><a href="https://kenhbatdongsan.vn/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a></strong> thời điểm hiện tại chính là <strong>bảo chứng tiến độ "mục sở thị"</strong>. Khác biệt hoàn toàn với những dự án mới chỉ nằm trên bản vẽ hoặc đang thi công cọc móng, Hinode Solera tại số 28 Phạm Hùng (Nam Từ Liêm, Hà Nội) hiện đã chính thức <strong>cất nóc toàn bộ tòa tháp 25 tầng nổi</strong> và đang gấp rút bước vào giai đoạn thi công hoàn thiện.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['thuc_te_cat_noc_toa_thap']['url']}" alt="{$m['thuc_te_cat_noc_toa_thap']['alt']}" /><figcaption>{$m['thuc_te_cat_noc_toa_thap']['caption']}</figcaption></figure></div>

<h2>1. Cập Nhật Các Hạng Mục Xây Dựng Thực Tế Tại Công Trường Số 28 Phạm Hùng</h2>
<p>Ghi nhận thực tế tại công trường dự án Hinode Solera vào quý IV/2026:</p>
<ul>
  <li><strong>Kết cấu thân tòa nhà:</strong> Toàn bộ 25 tầng nổi và khối đế thương mại đã hoàn thành đổ bê tông cốt thép, chính thức cất nóc đúng kế hoạch đề ra.</li>
  <li><strong>Hệ thống tường bao & ngăn phòng:</strong> Công tác xây gạch ngăn các căn hộ, hành lang tầng và thang thoát hiểm đã cơ bản hoàn tất đến các tầng cao nhất.</li>
  <li><strong>Hệ thống cơ điện (MEP):</strong> Đang triển khai luồn đường ống cấp thoát nước, máng cáp điện, hệ thống phòng cháy chữa cháy (PCCC) tự động đạt chuẩn mới nhất QCVN 06:2022/BXD.</li>
  <li><strong>Hạ tầng tầng hầm:</strong> 3 tầng hầm để xe với diện tích rộng rãi đã hoàn thiện phần kết cấu, đang xử lý bề mặt sơn epoxy và lắp đặt hệ thống thông gió, camera an ninh thông minh.</li>
</ul>

<h2>2. Bước Vào Giai Đoạn Hoàn Thiện Mặt Ngoài & Lắp Đặt Kính Hộp Low-E</h2>
<p>Ngay sau khi cất nóc, nhà thầu xây dựng đang tập trung nhân lực và thiết bị hiện đại để hoàn thiện diện mạo kiến trúc mặt ngoài của tòa tháp. Dự án sử dụng hệ nhôm kính cao cấp kết hợp <strong>kính hộp Low-E 2 lớp cách âm – cách nhiệt</strong>, vừa mang lại vẻ đẹp hiện đại, tráng lệ phản chiếu bầu trời Mỹ Đình, vừa giúp căn hộ luôn thoáng đãng, tiết kiệm điện năng điều hòa.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['view_ho_cau_giay_panorama']['url']}" alt="{$m['view_ho_cau_giay_panorama']['alt']}" /><figcaption>{$m['view_ho_cau_giay_panorama']['caption']}</figcaption></figure></div>

<h2>3. Tầm Nhìn Panorama Thực Tế Hướng Trọn Hồ Điều Hòa Cầu Giấy 32ha</h2>
<p>Từ các căn hộ tầng trung và tầng cao của tòa tháp Hinode Solera, khách hàng có thể chiêm ngưỡng trọn vẹn tầm nhìn khoáng đạt hướng thẳng sang <strong>công viên hồ điều hòa Cầu Giấy 32ha</strong> và Cung thiếu nhi Hà Nội mới khánh thành. Đây là giá trị sinh thái vô giá ngay giữa trung tâm hành chính phía Tây náo nhiệt, mang lại bầu không khí trong lành và cảnh quan mặt nước mát lành quanh năm.</p>

<p>Xem thêm bài viết phân tích chi tiết: <strong><a href="https://kenhbatdongsan.vn/vi-tri-du-an-hinode-solera-pham-hung/">Vị Trí Dự Án Hinode Solera 28 Phạm Hùng: Tọa Độ Kim Cương Đối Diện Công Viên Hồ Cầu Giấy 32ha</a></strong>.</p>

<h2>4. Ý Nghĩa Đối Với Khách Mua: An Tâm Tối Đa Khi Xuống Tiền</h2>
<p>Mua một căn hộ đã cất nóc mang lại những lợi ích vượt trội mà nhà đầu tư và người mua ở thực không thể bỏ qua:</p>
<ol>
  <li><strong>Không lo rủi ro đình trệ:</strong> Tòa nhà đã hiện hữu sừng sững trên mặt đường Phạm Hùng, xóa tan nỗi lo dự án chậm tiến độ hay "đắp chiếu".</li>
  <li><strong>Chuẩn bị nhận nhà sớm:</strong> Thời gian chờ đợi được rút ngắn tối đa, dự kiến bàn giao đúng hạn vào cuối năm 2026, giúp người mua tiết kiệm chi phí thuê nhà và nhanh chóng đưa căn hộ vào khai thác cho thuê đón dòng tiền.</li>
  <li><strong>Mục sở thị không gian và hướng view:</strong> Khách hàng có thể dễ dàng hình dung không gian sống thực tế, hướng đón nắng gió và góc nhìn view hồ điều hòa một cách chân thực nhất.</li>
</ol>

<p>Chi tiết cơ cấu các căn hộ trên sàn có thể tham khảo tại: <strong><a href="https://kenhbatdongsan.vn/mat-bang-du-an-hinode-solera-pham-hung/">Mặt Bằng Tầng Điển Hình Dự Án Hinode Solera Phạm Hùng</a></strong>.</p>
HTML
    ],

    // ------------------------------------------------------------------------------------
    // BÀI 3 (ĐĂNG HÔM NAY): SO SÁNH HINODE SOLERA VỚI VINHOMES SKYLAKE & THE MATRIX ONE
    // ------------------------------------------------------------------------------------
    [
        'title'      => 'So Sánh Hinode Solera Phạm Hùng Với Vinhomes Skylake & The Matrix One: Đâu Là Lựa Chọn Đầu Tư Đáng Giá Nhất?',
        'slug'       => 'so-sanh-hinode-solera-voi-vinhomes-skylake-the-matrix-one',
        'status'     => 'publish',
        'date'       => '2026-11-20 09:45:00',
        'date_gmt'   => '2026-11-20 02:45:00',
        'cat_id'     => 2, // Review & Phân tích Dự án
        'cat_slug'   => 'review-du-an',
        'thumb_id'   => $m['view_ho_cau_giay_panorama']['id'],
        'seo_focus'  => 'so sánh Hinode Solera và Vinhomes Skylake The Matrix One',
        'seo_title'  => 'So Sánh Hinode Solera Với Vinhomes Skylake & The Matrix One | Kênh Bất Động Sản',
        'seo_desc'   => 'So sánh chi tiết chung cư Hinode Solera 28 Phạm Hùng với Vinhomes Skylake và The Matrix One: Vị trí, thiết kế Dual Key, giá bán và tiềm năng sinh lời cho thuê.',
        'content'    => <<<HTML
<p>Trục đường <strong>Phạm Hùng – Mễ Trì – Vành Đai 3</strong> từ lâu đã được xem là "dải đất vàng" tập trung những quần thể căn hộ cao cấp và văn phòng hạng A sang trọng bậc nhất phía Tây Hà Nội. Khi tìm kiếm một không gian sống đẳng cấp hoặc tài sản đầu tư cho thuê chuyên gia nước ngoài, ba cái tên thường xuyên được đặt lên bàn cân là <strong><a href="https://kenhbatdongsan.vn/du-an/hinode-solera-pham-hung/">Hinode Solera (28 Phạm Hùng)</a></strong>, <strong>Vinhomes Skylake</strong> và <strong>The Matrix One</strong>.</p>

<p>Bài viết dưới đây sẽ phân tích và so sánh đa chiều giữa ba dự án nhằm giúp quý khách hàng đưa ra quyết định đầu tư sáng suốt và phù hợp nhất với nhu cầu.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['view_ho_cau_giay_panorama']['url']}" alt="{$m['view_ho_cau_giay_panorama']['alt']}" /><figcaption>{$m['view_ho_cau_giay_panorama']['caption']}</figcaption></figure></div>

<h2>1. Bảng So Sánh Tổng Quan Các Thông Số Kỹ Thuật Chính</h2>
<table style="width:100%;border-collapse:collapse;margin:20px 0;font-size:14px;">
  <thead>
    <tr style="background:#0F172A;color:#fff;">
      <th style="padding:12px;border:1px solid #CBD5E1;text-align:left;">Tiêu chí so sánh</th>
      <th style="padding:12px;border:1px solid #CBD5E1;text-align:center;background:#D97706;">Hinode Solera (28 Phạm Hùng)</th>
      <th style="padding:12px;border:1px solid #CBD5E1;text-align:center;">Vinhomes Skylake</th>
      <th style="padding:12px;border:1px solid #CBD5E1;text-align:center;">The Matrix One</th>
    </tr>
  </thead>
  <tbody>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:700;">Vị trí mặt tiền</td>
      <td style="padding:10px;text-align:center;font-weight:700;color:#D97706;">Số 28 Phạm Hùng (đối diện hồ Cầu Giấy 32ha)</td>
      <td style="padding:10px;text-align:center;">Mặt đường Phạm Hùng (kề cận hồ Cầu Giấy)</td>
      <td style="padding:10px;text-align:center;">Ngã tư Lê Quang Đạo – Mễ Trì</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:700;">Tình trạng bàn giao</td>
      <td style="padding:10px;text-align:center;font-weight:700;color:#D97706;">Đã cất nóc, bàn giao mới 2026</td>
      <td style="padding:10px;text-align:center;">Đã bàn giao sử dụng từ 2019</td>
      <td style="padding:10px;text-align:center;">Đã bàn giao Giai đoạn 1 từ 2021</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:700;">Mật độ căn/tầng</td>
      <td style="padding:10px;text-align:center;font-weight:700;color:#D97706;">16 căn/sàn (rất thông thoáng)</td>
      <td style="padding:10px;text-align:center;">16 – 20 căn/sàn</td>
      <td style="padding:10px;text-align:center;">10 căn/sàn</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:700;">Dòng sản phẩm độc bản</td>
      <td style="padding:10px;text-align:center;font-weight:700;color:#D97706;">Căn hộ Dual Key (2 chìa khóa riêng biệt)</td>
      <td style="padding:10px;text-align:center;">Căn hộ tiêu chuẩn & Penthouse/Sky Villa</td>
      <td style="padding:10px;text-align:center;">Căn hộ tiêu chuẩn & Dual Key giới hạn</td>
    </tr>
    <tr style="border-bottom:1px solid #E2E8F0;">
      <td style="padding:10px;font-weight:700;">Mặt bằng giá thứ cấp / sơ cấp</td>
      <td style="padding:10px;text-align:center;font-weight:700;color:#D97706;">Giá đợt 1 trực tiếp Chủ đầu tư, nhiều ưu đãi</td>
      <td style="padding:10px;text-align:center;">Giá thứ cấp đã tăng cao, cần trả thẳng 100%</td>
      <td style="padding:10px;text-align:center;">Giá thứ cấp ở mức cao, ít giao dịch mới</td>
    </tr>
    <tr>
      <td style="padding:10px;font-weight:700;">Tiềm năng sinh lời cho thuê</td>
      <td style="padding:10px;text-align:center;font-weight:700;color:#D97706;">Tỷ suất 7% – 9%/năm nhờ căn Dual Key</td>
      <td style="padding:10px;text-align:center;">Khoảng 5% – 6%/năm</td>
      <td style="padding:10px;text-align:center;">Khoảng 5.5% – 6.5%/năm</td>
    </tr>
  </tbody>
</table>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['ha_tang_khu_vuc_my_dinh']['url']}" alt="{$m['ha_tang_khu_vuc_my_dinh']['alt']}" /><figcaption>{$m['ha_tang_khu_vuc_my_dinh']['caption']}</figcaption></figure></div>

<h2>2. So Sánh Hinode Solera Với Vinhomes Skylake</h2>
<p><strong>Vinhomes Skylake</strong> là một khu đô thị đã đi vào vận hành ổn định và được bảo chứng bởi thương hiệu Vingroup. Tuy nhiên, ở thời điểm hiện tại:</p>
<ul>
  <li>Khách hàng mua Skylake chỉ có thể mua lại qua <strong>thị trường chuyển nhượng thứ cấp</strong> với mức giá đã lập đỉnh (từ 80 – 110 triệu/m² tùy tòa và hướng view), yêu cầu người mua phải thanh toán ngay 100% tiền mặt mà không còn các gói hỗ trợ lãi suất 0% từ chủ đầu tư.</li>
  <li>Các trang thiết bị nội thất tại Skylake đã qua sử dụng từ 5 – 7 năm, có dấu hiệu hao mòn tự nhiên và cần chi phí cải tạo lại.</li>
  <li>Trong khi đó, <strong>Hinode Solera</strong> là tòa tháp mới tinh, bàn giao thiết bị nội thất nhập khẩu thế hệ mới nhất, ký hợp đồng mua bán trực tiếp với chính sách đòn bẩy ngân hàng tối ưu.</li>
</ul>

<h2>3. So Sánh Hinode Solera Với The Matrix One</h2>
<p><strong>The Matrix One</strong> sở hữu ưu thế công viên hồ Mễ Trì 14ha và mật độ căn hộ thấp (10 căn/sàn). Song Hinode Solera lại chiếm ưu thế ở:</p>
<ul>
  <li><strong>Vị trí mặt tiền Phạm Hùng:</strong> Hinode Solera tọa lạc ngay mặt tiền số 28 Phạm Hùng, kết nối thẳng thấu tới Cầu Giấy, Xuân Thủy, sân bay Nội Bài và trung tâm Ba Đình nhanh chóng hơn.</li>
  <li><strong>Công viên hồ điều hòa Cầu Giấy rộng gấp đôi:</strong> Quy mô hồ Cầu Giấy đối diện Hinode Solera lên tới <strong>32ha</strong> với mặt nước mênh mông và Cung thiếu nhi biểu tượng mới, mang lại tầm nhìn thoáng đạt hơn hẳn.</li>
  <li><strong>Thiết kế căn hộ Dual Key tối ưu dòng tiền:</strong> Đây là "vũ khí đặc biệt" của Hinode Solera giúp nhà đầu tư vừa có thể ở một nhánh, vừa cho chuyên gia nước ngoài thuê nhánh còn lại độc lập 100%, nâng tỷ suất sinh lời lên tới 8% – 10%/năm.</li>
</ul>

<p>Đọc thêm bài phân tích chuyên sâu về mô hình này: <strong><a href="https://kenhbatdongsan.vn/thiet-ke-can-ho-dual-key-hinode-solera-pham-hung/">Đột Phá Thiết Kế Căn Hộ Dual Key Hinode Solera Phạm Hùng: Giải Pháp Vừa Ở Vừa Cho Thuê Kép</a></strong>.</p>

<h2>4. Kết Luận: Dự Án Nào Phù Hợp Với Bạn?</h2>
<ul>
  <li><strong>Chọn Vinhomes Skylake:</strong> Phù hợp với khách hàng muốn dọn vào ở ngay lập tức và có sẵn 100% nguồn vốn tài chính nhàn rỗi.</li>
  <li><strong>Chọn The Matrix One:</strong> Dành cho khách hàng thích không gian yên tĩnh hơn phía trong trục Mễ Trì – Lê Quang Đạo.</li>
  <li><strong>Chọn Hinode Solera Phạm Hùng:</strong> Lựa chọn lý tưởng cho nhà đầu tư đón sóng tăng giá đợt 1, khách hàng muốn mua nhà mới chuẩn Nhật Bản, cần đòn bẩy tài chính ngân hàng ân hạn nợ gốc và đặc biệt là nhà đầu tư nhắm đến dòng tiền cho thuê chuyên gia Hàn – Nhật dồi dào tại khu vực Keangnam.</li>
</ul>

<p>Quý khách hàng có thể tham khảo thêm phân tích dòng tiền tại: <strong><a href="https://kenhbatdongsan.vn/tiem-nang-cho-thue-hinode-solera-pham-hung/">Phân Tích Tiềm Năng Khai Thác Cho Thuê Căn Hộ Hinode Solera Phạm Hùng</a></strong>.</p>
HTML
    ],

    // ------------------------------------------------------------------------------------
    // BÀI 4 (LÊN LỊCH ĐĂNG NGÀY MAI 2026-11-21 08:30:00): TIÊU CHUẨN BÀN GIAO NỘI THẤT
    // ------------------------------------------------------------------------------------
    [
        'title'      => 'Tiêu Chuẩn Bàn Giao Nội Thất Căn Hộ Hinode Solera Phạm Hùng: Danh Mục Vật Liệu Hạng Sang Nhập Khẩu',
        'slug'       => 'tieu-chuan-ban-giao-noi-that-hinode-solera-pham-hung',
        'status'     => 'future',
        'date'       => '2026-11-21 08:30:00',
        'date_gmt'   => '2026-11-21 01:30:00',
        'cat_id'     => 2, // Review & Phân tích Dự án
        'cat_slug'   => 'review-du-an',
        'thumb_id'   => $m['mat_bang_dien_hinh']['id'],
        'seo_focus'  => 'tiêu chuẩn bàn giao nội thất Hinode Solera Phạm Hùng',
        'seo_title'  => 'Tiêu Chuẩn Bàn Giao Nội Thất Căn Hộ Hinode Solera 28 Phạm Hùng | Kênh Bất Động Sản',
        'seo_desc'   => 'Khám phá danh mục trang thiết bị và tiêu chuẩn bàn giao nội thất căn hộ Hinode Solera số 28 Phạm Hùng: Kính Low-E, điều hòa âm trần Multi, thiết bị vệ sinh cao cấp.',
        'content'    => <<<HTML
<p>Một công trình căn hộ hạng sang đích thực không chỉ khẳng định vị thế qua tọa độ đắc địa hay tầm nhìn triệu đô, mà còn được bảo chứng bởi <strong>chất lượng hoàn thiện bên trong từng mét vuông tổ ấm</strong>. Tại <strong><a href="https://kenhbatdongsan.vn/du-an/hinode-solera-pham-hung/">Hinode Solera Phạm Hùng</a></strong> (28 Phạm Hùng, Nam Từ Liêm, Hà Nội), chủ đầu tư WTO đã dành trọn tâm huyết kiến tạo tiêu chuẩn bàn giao vượt trội, lấy cảm hứng từ triết lý tinh giản, tinh xảo và bền bỉ chuẩn Nhật Bản.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['phoi_canh_toa_thap']['url']}" alt="{$m['phoi_canh_toa_thap']['alt']}" /><figcaption>{$m['phoi_canh_toa_thap']['caption']}</figcaption></figure></div>

<h2>1. Triết Lý Kiến Trúc Nhật Bản Trong Không Gian Sống Thượng Lưu</h2>
<p>Chắt lọc tinh hoa từ các dự án mang thương hiệu Hinode đi trước, căn hộ Hinode Solera được hoàn thiện với sự đồng bộ cao về màu sắc, vật liệu và công năng. Sự phối hợp giữa gam màu gỗ ấm áp, đá tự nhiên và kim loại sang trọng tạo nên một không gian sống thanh lịch, bình yên nhưng tràn ngập tiện nghi hiện đại ngay giữa lòng đô thị sôi động.</p>

<h2>2. Chi Tiết Danh Mục Bàn Giao Phòng Khách & Phòng Ngủ</h2>
<p>Không gian sinh hoạt chung và các phòng ngủ được trang bị các gói vật liệu cao cấp nhập khẩu từ các thương hiệu hàng đầu thế giới:</p>
<ul>
  <li><strong>Hệ thống cửa sổ & vách kính:</strong> Khung nhôm định hình cao cấp sơn tĩnh điện chống ăn mòn kết hợp <strong>kính hộp Low-E 2 lớp</strong> dày dặn, có khả năng giảm bức xạ nhiệt mặt trời lên tới 70% và triệt tiêu tiếng ồn từ trục đường Vành đai 3.</li>
  <li><strong>Hệ thống điều hòa không khí:</strong> Trang bị sẵn hệ thống <strong>điều hòa âm trần Multi (Daikin / Mitsubishi hoặc tương đương)</strong>, giúp trần nhà luôn phẳng phiu, giấu dàn lạnh thẩm mỹ và tối ưu hóa diện tích lô gia ngoài trời.</li>
  <li><strong>Sàn nhà:</strong> Phòng khách và phòng ngủ sử dụng sàn gỗ công nghiệp nhập khẩu cao cấp dày 12mm chịu nước tốt, chống trầy xước và chống trơn trượt hiệu quả.</li>
  <li><strong>Cửa chính & Khóa thông minh:</strong> Cửa gỗ công nghiệp chống cháy đạt chuẩn PCCC 60 phút, kết hợp khóa cửa điện tử thông minh đa phương thức mở khóa: vân tay, mã số bảo mật, thẻ từ và chìa khóa cơ.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['toan_canh_toa_thap_pham_hung']['url']}" alt="{$m['toan_canh_toa_thap_pham_hung']['alt']}" /><figcaption>{$m['toan_canh_toa_thap_pham_hung']['caption']}</figcaption></figure></div>

<h2>3. Khu Vực Bếp & Thiết Bị Vệ Sinh Chuẩn Khách Sạn 5 Sao</h2>
<p>Khu vực bếp và phòng tắm là hai không gian phản ánh rõ nét nhất đẳng cấp sống của gia chủ:</p>
<ul>
  <li><strong>Bếp sang trọng:</strong> Tủ bếp trên và tủ bếp dưới sử dụng cốt gỗ chống ẩm phủ Melamine/Acrylic cao cấp, mặt bàn bếp bằng đá nhân tạo thạch anh chống bám bẩn và chống ố, chậu rửa bát inox 304 cao cấp cùng vòi rửa xoay linh hoạt.</li>
  <li><strong>Thiết bị phòng tắm & vệ sinh:</strong> Bàn giao trọn bộ thiết bị vệ sinh nhập khẩu (Duravit / Hansgrohe / Kohler hoặc tương đương), bồn cầu liền khối phủ men nano kháng khuẩn, vách kính tắm đứng cường lực phụ kiện inox mạ crom sáng bóng, bình nóng lạnh dung tích lớn bố trí kín đáo trên trần kỹ thuật.</li>
</ul>

<h2>4. Ứng Dụng Công Nghệ Smart Home & An Ninh Đa Lớp</h2>
<p>Hinode Solera tích hợp hệ thống <strong>chuông cửa hiển thị hình ảnh (Video Doorphone)</strong> kết nối trực tiếp với lễ tân sảnh và ban quản lý tòa nhà, cho phép gia chủ nhận diện khách đến thăm trước khi mở cửa. Toàn bộ hành lang và thang máy đều được kiểm soát bằng thẻ từ phân tầng nghiêm ngặt, đảm bảo tính riêng tư tuyệt đối cho cư dân.</p>

<p>Tham khảo thêm các bài viết thiết kế căn hộ chi tiết:</p>
<ul>
  <li><strong><a href="https://kenhbatdongsan.vn/thiet-ke-can-ho-1pn-hinode-solera-pham-hung/">Thiết Kế Căn Hộ 1 Phòng Ngủ Hinode Solera Phạm Hùng</a></strong></li>
  <li><strong><a href="https://kenhbatdongsan.vn/thiet-ke-can-ho-2pn-hinode-solera-pham-hung/">Thiết Kế Căn Hộ 2 Phòng Ngủ Hinode Solera Phạm Hùng</a></strong></li>
  <li><strong><a href="https://kenhbatdongsan.vn/thiet-ke-can-ho-3pn-hinode-solera-pham-hung/">Khám Phá Căn Hộ 3 Phòng Ngủ Hinode Solera Phạm Hùng</a></strong></li>
</ul>
HTML
    ],

    // ------------------------------------------------------------------------------------
    // BÀI 5 (LÊN LỊCH ĐĂNG NGÀY MAI 2026-11-21 14:00:00): ĐÒN BẨY HẠ TẦNG METRO SỐ 5 & 8
    // ------------------------------------------------------------------------------------
    [
        'title'      => 'Đòn Bẩy Hạ Tầng Tuyến Metro Số 5 & Số 8 Đi Qua Phạm Hùng Thúc Đẩy Giá Trị Hinode Solera Ra Sao?',
        'slug'       => 'don-bay-ha-tang-metro-so-5-so-8-hinode-solera-pham-hung',
        'status'     => 'future',
        'date'       => '2026-11-21 14:00:00',
        'date_gmt'   => '2026-11-21 07:00:00',
        'cat_id'     => 4, // Quy hoạch & Hạ tầng
        'cat_slug'   => 'quy-hoach-ha-tang',
        'thumb_id'   => $m['view_ho_cau_giay_panorama']['id'],
        'seo_focus'  => 'tuyến metro số 5 số 8 Hinode Solera Phạm Hùng',
        'seo_title'  => 'Metro Số 5 & Số 8 Thúc Đẩy Giá Trị Hinode Solera 28 Phạm Hùng | Kênh Bất Động Sản',
        'seo_desc'   => 'Phân tích đòn bẩy hạ tầng từ quy hoạch 2 tuyến metro số 5 và số 8 đi qua trục Phạm Hùng tác động trực tiếp tới tiềm năng tăng giá dự án Hinode Solera.',
        'content'    => <<<HTML
<p>Lịch sử phát triển đô thị tại các trung tâm kinh tế hàng đầu châu Á như Tokyo, Singapore hay Seoul đã chứng minh: <strong>Bất động sản nằm trong bán kính đi bộ đến các nhà ga đường sắt đô thị (Metro) luôn sở hữu tốc độ tăng giá vượt trội từ 15% – 30%</strong> so với các khu vực khác, đồng thời duy trì tỷ lệ lấp đầy cho thuê ở mức đỉnh cao. Tại cửa ngõ phía Tây Thủ đô Hà Nội, dự án <strong><a href="https://kenhbatdongsan.vn/du-an/hinode-solera-pham-hung/">Hinode Solera (số 28 Phạm Hùng)</a></strong> đang là dự án hưởng lợi trực tiếp từ quy hoạch của hai tuyến metro huyết mạch: <strong>Tuyến Metro số 5</strong> và <strong>Tuyến Metro số 8</strong>.</p>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['view_ho_cau_giay_panorama']['url']}" alt="{$m['view_ho_cau_giay_panorama']['alt']}" /><figcaption>{$m['view_ho_cau_giay_panorama']['caption']}</figcaption></figure></div>

<h2>1. Quy Hoạch Hai Tuyến Metro Chiến Lược Giao Thoa Tại Trục Vành Đai 3</h2>
<p>Theo bản đồ quy hoạch giao thông vận tải Thủ đô Hà Nội tầm nhìn đến năm 2030 – 2050, khu vực Mỹ Đình – Phạm Hùng là nút thắt giao thông đa phương thức hiện đại với sự hiện diện của hai tuyến metro trọng điểm:</p>
<ul>
  <li><strong>Tuyến Metro số 5 (Văn Cao – Ngọc Khánh – Láng – Hòa Lạc):</strong> Là tuyến đường sắt đô thị có chiều dài lên tới 38,43 km, kết nối trung tâm Ba Đình lịch sử qua trục Liễu Giai – Trần Duy Hưng – Đại lộ Thăng Long để đi thẳng tới Khu công nghệ cao Hòa Lạc. Tuyến đường này giao cắt với đường Phạm Hùng ngay tại nút giao ngã tư Trần Duy Hưng – Đại lộ Thăng Long, chỉ cách Hinode Solera khoảng 5 phút di chuyển.</li>
  <li><strong>Tuyến Metro số 8 (Sơn Đồng – Mai Dịch – Vành đai 3 – Dương Xá):</strong> Là tuyến metro vành đai khép kín kết nối trực tiếp các quận phía Tây qua hành lang Phạm Hùng – Khuất Duy Tiến để kết nối sang Gia Lâm và phía Đông Hà Nội. Cư dân Hinode Solera chỉ mất vài bước chân để tiếp cận trạm dừng dọc trục Phạm Hùng.</li>
</ul>

<h2>2. Mô Hình Phát Triển Đô Thị TOD (Transit-Oriented Development)</h2>
<p>Khi hai tuyến metro đi vào vận hành thực tế, thói quen đi lại của cư dân khu vực Mỹ Đình sẽ có sự thay đổi mang tính bước ngoặt. Thay vì phải đối mặt với tình trạng tắc đường vào giờ cao điểm, cư dân Hinode Solera có thể thong thả di chuyển bằng tàu điện ngầm:</p>
<ul>
  <li>Chỉ <strong>10 phút</strong> đến trung tâm quận Ba Đình, Đống Đa và Hoàn Kiếm.</li>
  <li>Chỉ <strong>15 phút</strong> đến cụm đại học lớn tại Cầu Giấy và Khu công nghệ cao Hòa Lạc.</li>
  <li>Kết nối trực tiếp với sân bay Nội Bài qua tuyến Vành đai 3 trên cao và các tuyến metro trung chuyển.</li>
</ul>

<div class="wp-block-image"><figure class="aligncenter"><img src="{$m['ha_tang_khu_vuc_my_dinh']['url']}" alt="{$m['ha_tang_khu_vuc_my_dinh']['alt']}" /><figcaption>{$m['ha_tang_khu_vuc_my_dinh']['caption']}</figcaption></figure></div>

<h2>3. Đòn Bẩy Thúc Đẩy Giá Trị Căn Hộ Hinode Solera</h2>
<p>Sự kết hợp giữa <strong>tầm nhìn trực diện hồ điều hòa 32ha</strong> và <strong>lợi thế cận kề trạm metro</strong> tạo nên công thức "vàng" đảm bảo giá trị bất động sản tăng trưởng phi mã:</p>
<ol>
  <li><strong>Gia tăng giá trị vốn (Capital Gain):</strong> Mặt bằng giá căn hộ dọc các trục metro luôn ghi nhận mức tăng từ 20% – 40% trong giai đoạn từ khi khởi công đến khi chính thức lăn bánh thương mại.</li>
  <li><strong>Hấp dẫn tuyệt đối với khách thuê quốc tế:</strong> Cộng đồng chuyên gia Nhật Bản, Hàn Quốc và châu Âu làm việc tại Keangnam, Indochina Plaza hay các đại sứ quán lân cận vốn có thói quen sử dụng tàu điện ngầm văn minh. Căn hộ gần trạm metro sẽ luôn là ưu tiên lựa chọn hàng đầu của họ.</li>
  <li><strong>Tối ưu hóa bài toán cho thuê căn hộ Dual Key:</strong> Dòng sản phẩm 2 chìa khóa riêng biệt của Hinode Solera sẽ phát huy tối đa công suất khai thác, đảm bảo tỷ suất sinh lời vượt trội từ 8.5% – 11%/năm.</li>
</ol>

<p>Đọc thêm bài viết liên quan: <strong><a href="https://kenhbatdongsan.vn/vi-tri-du-an-hinode-solera-pham-hung/">Vị Trí Dự Án Hinode Solera 28 Phạm Hùng: Tọa Độ Kim Cương Đối Diện Công Viên Hồ Cầu Giấy 32ha</a></strong>.</p>
HTML
    ]
];

// Tiến hành tạo từng bài viết
$tags = ['hinode-solera', 'hinode-solera-pham-hung', '28-pham-hung', 'wto-vietracimex', 'chung-cu-pham-hung', 'can-ho-my-dinh'];

foreach ($posts_data as $data) {
    // Kiểm tra bài viết đã tồn tại chưa
    $existing = get_page_by_path($data['slug'], OBJECT, 'post');
    if (!$existing) {
        $found = get_posts([
            'post_type' => 'post',
            'name' => $data['slug'],
            'posts_per_page' => 1,
            'post_status' => 'any'
        ]);
        if ($found) {
            $existing = $found[0];
        }
    }

    $post_args = [
        'post_title'   => $data['title'],
        'post_name'    => $data['slug'],
        'post_content' => $data['content'],
        'post_status'  => $data['status'],
        'post_type'    => 'post',
        'post_date'    => $data['date'],
        'post_date_gmt'=> $data['date_gmt'],
        'post_category'=> [$data['cat_id']]
    ];

    if ($existing) {
        $post_args['ID'] = $existing->ID;
        $post_id = wp_update_post($post_args);
        $action_label = "Cập nhật";
    } else {
        $post_id = wp_insert_post($post_args);
        $action_label = "Tạo mới";
    }

    if (is_wp_error($post_id)) {
        echo "❌ Lỗi {$action_label} bài viết: " . $post_id->get_error_message() . "\n";
        continue;
    }

    // Gán ảnh đại diện
    set_post_thumbnail($post_id, $data['thumb_id']);

    // Gán Tags
    wp_set_post_tags($post_id, $tags);

    // Gán Meta liên kết dự án
    update_post_meta($post_id, '_kbds_project_ref', $proj_id);
    update_post_meta($post_id, '_kbds_project_slug', $proj_slug);

    // Gán Rank Math SEO
    update_post_meta($post_id, 'rank_math_title', $data['seo_title']);
    update_post_meta($post_id, 'rank_math_description', $data['seo_desc']);
    update_post_meta($post_id, 'rank_math_focus_keyword', $data['seo_focus']);
    update_post_meta($post_id, 'rank_math_robots', ['index', 'follow']);

    $status_text = ($data['status'] === 'future') ? "LÊN LỊCH NGÀY MAI ({$data['date']})" : "ĐÃ ĐĂNG HÔM NAY ({$data['date']})";
    echo " ✔ {$action_label} [{$status_text}] ID: {$post_id} -> {$data['title']}\n";
}

echo "==============================================================\n";
echo "🎉 HOÀN TẤT TẠO 5 BÀI VIẾT VỆ TINH CHO HINODE SOLERA PHẠM HÙNG!\n";
echo "==============================================================\n";
