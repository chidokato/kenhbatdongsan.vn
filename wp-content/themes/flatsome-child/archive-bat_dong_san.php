<?php
/**
 * Template: Giỏ hàng Mua bán & Chuyển nhượng Đã xác thực (/mua-ban/)
 */
get_header();
?>
<div class="kbds-archive-wrapper">
	<?php echo do_shortcode( '[kbds_sec_hero badge="GIỎ HÀNG BẤT ĐỘNG SẢN ĐÃ XÁC THỰC 100%" title="Mua Bán, Chuyển Nhượng & Suất Ngoại Giao Giá Tốt" subtitle="Cam kết hình ảnh thực tế, giá bán chuẩn xác và pháp lý minh bạch đã được kiểm duyệt."]' ); ?>
	<?php echo do_shortcode( '[kbds_sec_listings limit="12" title="Danh Sách Sản Phẩm Trong Giỏ Hàng"]' ); ?>
	<?php echo do_shortcode( '[kbds_sec_tools]' ); ?>
	<?php echo do_shortcode( '[kbds_sec_cta_lead]' ); ?>
</div>
<?php
get_footer();
