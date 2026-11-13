<?php
/**
 * Template: Phân loại theo Khu vực BĐS (Dự án tại Hà Nội, Dự án tại TP.HCM, Dự án Tỉnh...)
 */
get_header();
$term = get_queried_object();
?>
<div class="kbds-archive-wrapper">
	<?php
	echo do_shortcode( sprintf(
		'[kbds_sec_hero badge="DANH BẠ BẤT ĐỘNG SẢN THEO KHU VỰC" title="Dự Án & Bất Động Sản: %s" subtitle="Tổng hợp các dự án trọng điểm, thông tin quy hoạch và giỏ hàng chuyển nhượng tại %s."]',
		esc_attr( $term->name ),
		esc_attr( $term->name )
	) );
	echo do_shortcode( '[kbds_sec_projects limit="12" title="Hồ Sơ Dự Án Nổi Bật"]' );
	echo do_shortcode( '[kbds_sec_listings limit="8" title="Giỏ Hàng Chuyển Nhượng & Cho Thuê Chọn Lọc"]' );
	echo do_shortcode( '[kbds_sec_cta_lead]' );
	?>
</div>
<?php
get_footer();
