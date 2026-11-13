<?php
/**
 * Script Import và tối ưu hóa 14 hình ảnh thực tế & phối cảnh Vinhomes King Park vào WordPress Media Library
 */

define( 'WP_USE_THEMES', false );
require_once __DIR__ . '/../wp-load.php';
require_once ABSPATH . 'wp-content/plugins/kenhbds-data-manager/includes/class-kbds-auto-publisher.php';

$upload_source_dir = 'C:/Users/Admin/.gemini/antigravity/brain/500e8b1d-1aea-4a47-aedf-059936d8d891/.user_uploaded/';

$images_data = array(
	array(
		'file'          => 'media_1794541728168_4ef116d6.jpg',
		'slug_prefix'   => 'quy-hoach-mat-bang-tong-the-vinhomes-king-park-bac-ninh-1-500',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Mặt Bằng Quy Hoạch 1/500 Đại Đô Thị Sinh Thái Vinhomes King Park Bắc Ninh',
		'alt_text'      => 'Bản đồ quy hoạch tổng thể 1/500 bán đảo Hòa Long đại đô thị Vinhomes King Park Bắc Ninh ôm trọn bởi sông Cầu',
		'caption'       => 'Bản đồ quy hoạch tổng thể 1/500 Vinhomes King Park Bắc Ninh (268,8ha) tại bán đảo Hòa Long.',
		'description'   => 'Quy hoạch chi tiết 1/500 dự án Vinhomes King Park Bắc Ninh với diện tích 268.8ha tại bán đảo Hòa Long, được bao bọc 3 mặt bởi sông Cầu thơ mộng, quy hoạch sân golf 18 lỗ 90ha và hệ sinh thái 101.69ha cây xanh mặt nước.',
		'index'         => 1,
	),
	array(
		'file'          => 'media_1794541728176_59538d62.jpg',
		'slug_prefix'   => 'flycam-thuc-te-ban-dao-hoa-long-vinhomes-king-park-bac-ninh',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Flycam Thực Tế Toàn Cảnh Bán Đảo Hòa Long Vị Trí Vinhomes King Park Bắc Ninh',
		'alt_text'      => 'Flycam toàn cảnh thực tế bán đảo Hòa Long TP Bắc Ninh lúc hoàng hôn nơi xây dựng dự án Vinhomes King Park',
		'caption'       => 'Góc nhìn Flycam thực tế bán đảo Hòa Long được bao bọc bởi dòng sông Cầu hiền hòa - Vị trí tọa lạc đắc địa của Vinhomes King Park.',
		'description'   => 'Hình ảnh thực tế chụp từ flycam toàn cảnh bán đảo Hòa Long, TP Bắc Ninh. Địa thế tự nhiên tuyệt mỹ hình vòng cung được ôm trọn bởi dòng sông Cầu, thế đất phong thủy vượng khí bậc nhất Kinh Bắc.',
		'index'         => 2,
	),
	array(
		'file'          => 'media_1794541728180_d545f14f.jpg',
		'slug_prefix'   => 'so-do-vi-tri-ket-noi-giao-thong-vinhomes-hoa-long-king-park-bac-ninh',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Sơ Đồ Vị Trí & Kết Nối Giao Thông Chiến Lược Vinhomes King Park Hòa Long Bắc Ninh',
		'alt_text'      => 'Sơ đồ vị trí kết nối giao thông chiến lược dự án Vinhomes King Park Hòa Long Bắc Ninh tới Vành Đai 4 QL1A QL18 Nội Bài',
		'caption'       => 'Sơ đồ vị trí và mạng lưới hạ tầng giao thông kết nối liên vùng của Vinhomes King Park Hòa Long Bắc Ninh.',
		'description'   => 'Vị trí tọa lạc tâm điểm Tây Bắc TP. Bắc Ninh của Vinhomes King Park, kết nối hoàn hảo qua trục Lạc Long Quân, đường ĐT286, đại lộ Tây Thăng Long, chỉ 10 phút tới Vành Đai 4, 8 phút tới trung tâm hành chính TP Bắc Ninh, 20 phút tới KCN Yên Phong, 35 phút tới Sân bay Quốc tế Nội Bài.',
		'index'         => 3,
	),
	array(
		'file'          => 'media_1794541729818_3bba8a51.jpg',
		'slug_prefix'   => 'hinh-anh-thuc-te-cong-truong-thi-cong-du-an-vinhomes-king-park-bac-ninh',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Hình Ảnh Thực Tế Thi Công Cổng Chào Dự Án Vinhomes King Park Bắc Ninh',
		'alt_text'      => 'Hình ảnh thực tế công trường thi công cổng chào dự án Vinhomes King Park Bắc Ninh chuẩn bị khởi công',
		'caption'       => 'Cổng chào và hạ tầng trục đường chính dẫn vào đại dự án Vinhomes King Park Bắc Ninh đang được thi công thần tốc.',
		'description'   => 'Thực tế tại công trường dự án Vinhomes King Park Bắc Ninh: Cổng chào dự án đã được lắp đặt trang trọng, các phương tiện máy móc xe bê tông của nhà thầu Vincons đang san lấp và hoàn thiện tuyến đường trục chính, sẵn sàng đón đầu lễ khởi công vào Quý 3/2026.',
		'index'         => 4,
	),
	array(
		'file'          => 'media_1794541729829_ce3b9a2c.jpg',
		'slug_prefix'   => 'phoi-canh-kenh-dao-biet-thu-ven-song-vinhomes-king-park-bac-ninh',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh Kênh Đào Sinh Thái & Dãy Biệt Thự Ven Sông Vinhomes King Park',
		'alt_text'      => 'Phối cảnh dòng kênh đào sinh thái chèo thuyền thiên nga dãy biệt thự ven sông và tòa căn hộ Vinhomes King Park Bắc Ninh',
		'caption'       => 'Không gian sống nghỉ dưỡng thượng lưu bên kênh đào sinh thái uốn lượn tại Vinhomes King Park.',
		'description'   => 'Không gian mặt nước xanh mát với trải nghiệm đạp vịt, chèo thuyền Kayak trên kênh đào nội khu ôm quanh các dãy biệt thự sinh thái sang trọng và tháp căn hộ view sông thoáng đãng.',
		'index'         => 5,
	),
	array(
		'file'          => 'media_1794541729841_c0dc0d0a.jpg',
		'slug_prefix'   => 'phoi-canh-goc-cao-toan-canh-ban-dao-xanh-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh Góc Cao Toàn Cảnh Bán Đảo Đô Thị Sinh Thái Vinhomes King Park',
		'alt_text'      => 'Phối cảnh góc cao toàn cảnh bán đảo xanh sinh thái đô thị Vinhomes King Park Bắc Ninh bao quanh bởi sông Cầu',
		'caption'       => 'Bán đảo đô thị sinh thái xanh Vinhomes King Park nhìn từ trên cao - Kiệt tác biểu tượng mới của Bắc Ninh.',
		'description'   => 'Toàn cảnh bán đảo tròn Hòa Long được phủ rợp màu xanh công viên, mặt nước và các dãy biệt thự sang trọng, khẳng định vị thế dự án nghỉ dưỡng sinh thái đẳng cấp số 1 miền Bắc.',
		'index'         => 6,
	),
	array(
		'file'          => 'media_1794541729846_b9354a2d.jpg',
		'slug_prefix'   => 'phoi-canh-trung-tam-thuong-mai-vincom-shophouse-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh TTTM Vincom Mega Mall & Tuyến Phố Shophouse Vinhomes King Park',
		'alt_text'      => 'Phối cảnh trung tâm thương mại Vincom Mega Mall quảng trường vòng xuyến và khu shophouse sầm uất Vinhomes King Park Bắc Ninh',
		'caption'       => 'Đại lộ sầm uất cùng Trung tâm thương mại Vincom Mega Mall và chuỗi Shophouse thương mại phục vụ cư dân và du khách.',
		'description'   => 'Tổ hợp tiện ích mua sắm, ẩm thực và giải trí đỉnh cao Vincom Mega Mall tại vị trí vòng xuyến cửa ngõ dự án Vinhomes King Park, mang đến nhịp sống thương mại phồn hoa suốt ngày đêm.',
		'index'         => 7,
	),
	array(
		'file'          => 'media_1794541729855_651b2888.jpg',
		'slug_prefix'   => 'phoi-canh-cong-vien-ho-dieu-hoa-duong-dao-bo-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh Công Viên Hồ Điều Hòa & Đường Dạo Bộ Ven Sông Vinhomes King Park',
		'alt_text'      => 'Phối cảnh cư dân tập thể dục dạo bộ ven hồ điều hòa công viên sinh thái xanh dự án Vinhomes King Park Bắc Ninh',
		'caption'       => 'Đường dạo bộ ven hồ rộng thênh thang, nơi cư dân tận hưởng không khí trong lành nguyên bản mỗi ngày.',
		'description'   => 'Hệ thống công viên ven hồ sinh thái rộng lớn, thảm cỏ xanh mướt cùng đường dạo bộ ven hồ được thiết kế chuẩn resort quốc tế, kiến tạo lối sống khỏe mạnh và an yên trọn vẹn cho cư dân.',
		'index'         => 8,
	),
	array(
		'file'          => 'media_1794541729861_98bbb78a.jpg',
		'slug_prefix'   => 'phoi-canh-cau-canh-quan-sang-dao-san-golf-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh Cầu Đi Bộ Cảnh Quan Nối Đảo Sân Golf 18 Lỗ Vinhomes King Park',
		'alt_text'      => 'Phối cảnh cầu đi bộ cảnh quan vượt hồ sang đảo sân golf 18 lỗ quốc tế 90ha tại Vinhomes King Park Bắc Ninh',
		'caption'       => 'Cầu đi bộ cảnh quan biểu tượng dẫn lối sang ốc đảo sân golf 18 lỗ quốc tế 90ha đẳng cấp quý tộc.',
		'description'   => 'Điểm nhấn kiến trúc độc bản: Cầu đi bộ cảnh quan bắc qua hồ sinh thái dẫn trực tiếp sang đảo tròn Sân Golf quốc tế 18 lỗ quy mô 90ha - tiện ích độc quyền hàng đầu tại miền Bắc của Vinhomes King Park.',
		'index'         => 9,
	),
	array(
		'file'          => 'media_1794541729869_5bbe9b92.jpg',
		'slug_prefix'   => 'phoi-canh-tuyen-pho-biet-thu-tan-co-dien-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh Dãy Biệt Thự Tân Cổ Điển Sang Trọng Tuyến Phố Vinhomes King Park',
		'alt_text'      => 'Phối cảnh tuyến phố nội khu rợp bóng cây dãy biệt thự đơn lập song lập tân cổ điển sang trọng Vinhomes King Park Bắc Ninh',
		'caption'       => 'Khu biệt thự tân cổ điển đẳng cấp với kiến trúc hoàng gia, vỉa hè lát đá và hàng cây râm mát.',
		'description'   => 'Thiết kế biệt thự đơn lập, song lập mang phong cách Tân Cổ Điển tinh tế, sở hữu mặt tiền thoáng rộng, sân vườn riêng biệt cùng không gian sống thượng lưu khẳng định đẳng cấp chủ nhân.',
		'index'         => 10,
	),
	array(
		'file'          => 'media_1794541729876_067f31e9.jpg',
		'slug_prefix'   => 'phoi-canh-goc-bay-khu-biet-thu-ven-song-cau-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh Flycam Phân Khu Biệt Thự Ven Sông Sát Sân Golf Vinhomes King Park',
		'alt_text'      => 'Phối cảnh góc bay toàn cảnh dải biệt thự mái đỏ ven sông uốn lượn hướng tầm nhìn sân golf Vinhomes King Park Bắc Ninh',
		'caption'       => 'Phân khu biệt thự đảo sinh thái sở hữu tầm nhìn panorama triệu đô hướng thẳng ra sân golf và mặt sông Cầu.',
		'description'   => 'Vị thế độc tôn phong thủy "Tụ thủy sinh tài", các căn biệt thự ven kênh sở hữu tầm nhìn không giới hạn ra sân golf 90ha và dải sông Cầu lộng gió, mang lại chuẩn mực sống xa hoa bậc nhất Kinh Bắc.',
		'index'         => 11,
	),
	array(
		'file'          => 'media_1794541729880_aeb7cfb6.jpg',
		'slug_prefix'   => 'phoi-canh-cong-vien-giai-tri-le-hoi-vinwonders-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh Công Viên Giải Trí & Quảng Trường Lễ Hội Hoàng Gia Vinhomes King Park',
		'alt_text'      => 'Phối cảnh công viên chủ đề giải trí quảng trường lễ hội ánh sáng và vòng đu quay dự án Vinhomes King Park Bắc Ninh',
		'caption'       => 'Tổ hợp vui chơi giải trí & công viên chủ đề sôi động, điểm hẹn vui chơi cuối tuần của cả gia đình.',
		'description'   => 'Thiên đường vui chơi giải trí đa thế hệ với các trò chơi cảm giác mạnh, quảng trường lễ hội văn hóa, nhạc nước lung linh và các hoạt động nghệ thuật đường phố bốn mùa rực rỡ.',
		'index'         => 12,
	),
	array(
		'file'          => 'media_1794541729891_5e253a65.jpg',
		'slug_prefix'   => 'phoi-canh-3d-tong-the-dao-tron-san-golf-18-lo-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Phối Cảnh 3D Toàn Cảnh Đảo Tròn Sân Golf 18 Lỗ & Đô Thị Vinhomes King Park',
		'alt_text'      => 'Phối cảnh 3D tổng thể quy hoạch đảo tròn sân golf 18 lỗ 90ha và toàn khu đô thị sinh thái 268ha Vinhomes King Park Bắc Ninh',
		'caption'       => 'Phối cảnh 3D quy hoạch tổng thể với điểm nhấn ốc đảo tròn sân golf 18 lỗ ở trung tâm được ôm ấp bởi mặt nước uốn lượn.',
		'description'   => 'Thiết kế quy hoạch 3D đỉnh cao của Vinhomes King Park: Đảo tròn trung tâm được bao bọc bởi dải hồ xanh biếc tạo nên sân golf 18 lỗ tiêu chuẩn PGA, kết nối hài hòa cùng các cụm cao tầng, shophouse và biệt thự ven sông.',
		'index'         => 13,
	),
	array(
		'file'          => 'media_1794541729895_35dab835.jpg',
		'slug_prefix'   => 'ban-do-ve-tinh-ranh-gioi-ban-dao-hoa-long-vinhomes-king-park',
		'focus_keyword' => 'Vinhomes King Park Bắc Ninh',
		'image_title'   => 'Bản Đồ Vệ Tinh Ranh Giới Quy Hoạch Bán Đảo Hòa Long Vinhomes King Park',
		'alt_text'      => 'Bản đồ vệ tinh thực tế ranh giới quy hoạch bán đảo Hòa Long Tây Bắc TP Bắc Ninh dự án Vinhomes King Park',
		'caption'       => 'Bản đồ ranh giới vị trí thực tế trên vệ tinh của Vinhomes King Park tại bán đảo Hòa Long, TP. Bắc Ninh.',
		'description'   => 'Ranh giới địa lý vệ tinh chuẩn xác của dự án Vinhomes King Park: Trọn vẹn khu vực bán đảo Hòa Long ôm bởi sông Cầu, tiếp giáp khu đô thị mới Tây Bắc, kết nối thẳng đường Lạc Long Quân, đền Bà Chúa Kho và trường THPT Chuyên Bắc Ninh.',
		'index'         => 14,
	),
);

$imported_results = array();

echo "BẮT ĐẦU IMPORT VÀ TỐI ƯU HÓA 14 ẢNH VINHOMES KING PARK...\n";

foreach ( $images_data as $item ) {
	$file_path = $upload_source_dir . $item['file'];
	if ( ! file_exists( $file_path ) ) {
		echo "[-] File không tồn tại: {$file_path}\n";
		continue;
	}

	$res = KBDS_Auto_Publisher::import_and_optimize_seo_image( $file_path, array(
		'focus_keyword' => $item['focus_keyword'],
		'image_title'   => $item['image_title'],
		'alt_text'      => $item['alt_text'],
		'caption'       => $item['caption'],
		'description'   => $item['description'],
		'slug_prefix'   => $item['slug_prefix'],
		'index'         => $item['index'],
	) );

	if ( is_wp_error( $res ) ) {
		echo "[-] Lỗi import {$item['file']}: " . $res->get_error_message() . "\n";
	} else {
		echo "[+] ĐÃ IMPORT THÀNH CÔNG (ID: {$res['id']}): {$item['image_title']}\n";
		echo "    URL: {$res['url']}\n";
		$imported_results[ $item['index'] ] = $res;
	}
}

file_put_contents( __DIR__ . '/imported_images_vinhomes_king_park.json', json_encode( $imported_results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
echo "Hoàn thành! Đã lưu kết quả vào tools/imported_images_vinhomes_king_park.json\n";
