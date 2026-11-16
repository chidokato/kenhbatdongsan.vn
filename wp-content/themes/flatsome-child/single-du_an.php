<?php
/**
 * Template Chi tiết Dự án BĐS (Hỗ trợ 100% UX Builder Tràn viền Landing Page & Bố cục Hồ sơ Dự án chuẩn)
 */

get_header();
?>
<div id="content" role="main" class="content-area">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$raw_content = get_post_field( 'post_content', get_the_ID() );
		$is_ux_landing = ( function_exists( 'ux_builder_is_active' ) && ux_builder_is_active() )
			|| false !== strpos( $raw_content, '[section' )
			|| false !== strpos( $raw_content, '[ux_banner' );
		?>

		<?php if ( $is_ux_landing ) : ?>
			<!-- Chế độ Thiết kế Landing Page bằng UX Builder (Tràn viền 100%) -->
			<?php the_content(); ?>
		<?php else : ?>
			<!-- Chế độ Hồ sơ Dự án Chuẩn -->
			<div class="kbds-container" style="padding-top:36px;padding-bottom:56px;">
				<h1 style="color:#0B2C4D;font-size:32px;font-weight:800;margin-bottom:8px;"><?php the_title(); ?></h1>
				<?php
				$address = get_post_meta( get_the_ID(), '_kbds_address', true );
				if ( $address ) {
					echo '<p style="color:#64748B;font-size:15px;margin-bottom:24px;">📍 ' . esc_html( $address ) . '</p>';
				}
				?>
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

		<?php
		// Tự động hiển thị Section Tin Tức Dự Án trên mỗi trang dự án
		if ( class_exists( 'KBDS_Shortcodes' ) && ! has_shortcode( $raw_content, 'kbds_project_news' ) && false === strpos( $raw_content, 'id="tin-tuc-du-an"' ) ) {
			echo KBDS_Shortcodes::shortcode_project_news( array(
				'project_id'   => get_the_ID(),
				'project_name' => get_the_title(),
				'limit'        => 6,
			) );
		}
		?>
	<?php endwhile; ?>
</div>
<?php
get_footer();
