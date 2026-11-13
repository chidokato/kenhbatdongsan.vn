<?php
/**
 * Template: Phân loại theo Loại giao dịch (Chuyển nhượng, Cho thuê, Giỏ hàng CĐT)
 */
get_header();
$term = get_queried_object();
?>
<div class="kbds-archive-wrapper">
	<?php
	echo do_shortcode( sprintf(
		'[kbds_sec_hero badge="CHUYỂN NHƯỢNG & CHO THUÊ BẤT ĐỘNG SẢN" title="%s" subtitle="Danh sách sản phẩm giá tốt, cam kết hình ảnh thật và pháp lý rõ ràng."]',
		esc_attr( $term->name )
	) );
	echo do_shortcode( '[kbds_sec_listings limit="12" title="Danh Sách Sản Phẩm Đang Giao Dịch"]' );
	echo do_shortcode( '[kbds_sec_tools]' );
	echo do_shortcode( '[kbds_sec_cta_lead]' );
	?>
</div>
<?php
get_footer();
