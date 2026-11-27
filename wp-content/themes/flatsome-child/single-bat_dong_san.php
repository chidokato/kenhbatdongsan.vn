<?php
/**
 * Template Chi tiết Sản phẩm Giỏ hàng BĐS (/mua-ban/{slug}/)
 * Tối ưu hiển thị rộng, sang trọng, đầy đủ chi tiết cho sản phẩm chuyển nhượng & cho thuê
 */
get_header();
?>
<style>
.kbds-single-bds-wrap {
	max-width: 1400px;
	margin: 0 auto;
	padding: 24px 20px 60px;
	box-sizing: border-box;
}
.kbds-bds-meta-bar {
	display: flex;
	gap: 12px;
	flex-wrap: wrap;
	align-items: center;
	margin-bottom: 28px;
	padding: 16px 20px;
	background: #F8FAFC;
	border: 1px solid #E2E8F0;
	border-radius: 12px;
	box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.kbds-bds-meta-item {
	font-size: 14px;
	color: #334155;
	background: #ffffff;
	padding: 6px 14px;
	border-radius: 8px;
	border: 1px solid #CBD5E1;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
.kbds-bds-price-tag {
	font-size: 20px;
	font-weight: 800;
	color: #DC2626;
	background: #FEF2F2;
	padding: 6px 16px;
	border-radius: 8px;
	border: 1px solid #FECACA;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
.kbds-bds-verified-tag {
	background: #ECFDF5;
	color: #047857;
	border: 1px solid #A7F3D0;
	font-weight: 700;
	padding: 6px 14px;
	border-radius: 8px;
	font-size: 13.5px;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}
</style>

<div id="content" role="main" class="content-area">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$post_id   = get_the_ID();
		$price     = get_post_meta( $post_id, '_kbds_price', true ) ?: get_post_meta( $post_id, '_kbds_listing_price', true );
		$area      = get_post_meta( $post_id, '_kbds_area', true ) ?: get_post_meta( $post_id, '_kbds_area_m2', true );
		$rooms     = get_post_meta( $post_id, '_kbds_bedrooms', true );
		$baths     = get_post_meta( $post_id, '_kbds_bathrooms', true );
		$direction = get_post_meta( $post_id, '_kbds_direction', true );
		$legal     = get_post_meta( $post_id, '_kbds_listing_legal', true );
		$code      = get_post_meta( $post_id, '_kbds_listing_code', true );
		$verified  = get_post_meta( $post_id, '_kbds_is_verified', true );
		
		$proj      = get_post_meta( $post_id, '_kbds_project_ref', true ) ?: get_post_meta( $post_id, '_kbds_parent_project_id', true );
		$proj_post = $proj ? get_post( $proj ) : null;
		
		$has_meta = ( ! empty( $price ) || ! empty( $area ) || ! empty( $rooms ) || ! empty( $baths ) || ! empty( $direction ) || ! empty( $proj_post ) );
		?>

		<div class="kbds-single-bds-wrap">
			<!-- BREADCRUMB -->
			<div class="kbds-breadcrumb" style="font-size:14px;color:#64748B;margin-bottom:18px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:#0B2C4D;text-decoration:none;font-weight:600;">Trang chủ</a> <span>&raquo;</span>
				<a href="<?php echo esc_url( home_url( '/mua-ban/' ) ); ?>" style="color:#0284c7;text-decoration:none;font-weight:600;">Giỏ hàng BĐS</a> <span>&raquo;</span>
				<span style="color:#D4AF37;font-weight:700;"><?php the_title(); ?></span>
			</div>
			
			<h1 style="color:#0B2C4D;font-size:clamp(24px, 2.6vw, 34px);font-weight:800;margin-bottom:16px;line-height:1.35;">
				<?php the_title(); ?>
			</h1>
			
			<?php if ( $has_meta ) : ?>
				<div class="kbds-bds-meta-bar">
					<?php if ( $price ) : ?>
						<div class="kbds-bds-price-tag">
							💰 <strong><?php echo esc_html( $price ); ?></strong>
						</div>
					<?php endif; ?>

					<?php if ( $area ) : ?>
						<div class="kbds-bds-meta-item">
							📐 Diện tích: <strong><?php echo esc_html( $area ); ?> m²</strong>
						</div>
					<?php endif; ?>

					<?php if ( $rooms ) : ?>
						<div class="kbds-bds-meta-item">
							🛏️ Phòng ngủ: <strong><?php echo esc_html( $rooms ); ?> PN</strong>
						</div>
					<?php endif; ?>

					<?php if ( $baths ) : ?>
						<div class="kbds-bds-meta-item">
							🚿 Phòng tắm: <strong><?php echo esc_html( $baths ); ?> WC</strong>
						</div>
					<?php endif; ?>

					<?php if ( $direction ) : ?>
						<div class="kbds-bds-meta-item">
							🧭 Hướng: <strong><?php echo esc_html( $direction ); ?></strong>
						</div>
					<?php endif; ?>

					<?php if ( $legal ) : ?>
						<div class="kbds-bds-meta-item">
							📜 Pháp lý: <strong><?php echo esc_html( $legal ); ?></strong>
						</div>
					<?php endif; ?>

					<?php if ( '1' === (string) $verified ) : ?>
						<div class="kbds-bds-verified-tag">
							✔ Đã xác thực pháp lý &amp; giá
						</div>
					<?php endif; ?>

					<?php if ( $proj_post ) : ?>
						<div class="kbds-bds-meta-item" style="background:#EFF6FF;border-color:#BFDBFE;color:#0B2C4D;">
							🏢 Dự án: <a href="<?php echo esc_url( get_permalink( $proj_post->ID ) ); ?>" style="font-weight:700;color:#0B2C4D;text-decoration:underline;margin-left:4px;"><?php echo esc_html( $proj_post->post_title ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="kbds-listing-body" style="background:#ffffff;border-radius:12px;">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<?php
get_footer();
