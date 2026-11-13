<?php
/**
 * Template: Danh bạ Dự án Bất Động Sản (/du-an/)
 */
get_header();
?>
<div class="kbds-archive-wrapper">
	<?php echo do_shortcode( '[kbds_sec_hero badge="DANH BẠ DỰ ÁN BẤT ĐỘNG SẢN TOÀN QUỐC" title="Hồ Sơ Pháp Lý, Bảng Giá & Tiến Độ Dự Án" subtitle="Tra cứu thông tin chính thống, quy hoạch 1/500 và đánh giá độc lập từ chuyên gia Kênh BĐS."]' ); ?>
	<?php echo do_shortcode( '[kbds_sec_projects limit="12" title="Tất Cả Hồ Sơ Dự Án Đang Cập Nhật"]' ); ?>
	<?php echo do_shortcode( '[kbds_sec_cta_lead]' ); ?>
</div>
<?php
get_footer();
