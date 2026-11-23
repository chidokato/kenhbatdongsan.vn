<?php
/**
 * Template Chi tiết Sản phẩm Giỏ hàng BĐS (/mua-ban/{slug}/)
 */
get_header();
?>
<div id="content" role="main" class="content-area">
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="kbds-container" style="padding-top:36px;padding-bottom:56px;max-width:1200px;margin:0 auto;padding-left:15px;padding-right:15px;">
			<div class="kbds-breadcrumb" style="font-size:13.5px;color:#64748B;margin-bottom:18px;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:#0B2C4D;">Trang chủ</a> &raquo;
				<a href="<?php echo esc_url( home_url( '/mua-ban/' ) ); ?>" style="color:#0B2C4D;">Giỏ hàng BĐS</a> &raquo;
				<span style="color:#D4AF37;font-weight:600;"><?php the_title(); ?></span>
			</div>
			
			<h1 style="color:#0B2C4D;font-size:28px;font-weight:800;margin-bottom:12px;line-height:1.35;"><?php the_title(); ?></h1>
			
			<?php
			$price = get_post_meta( get_the_ID(), '_kbds_price', true );
			$area  = get_post_meta( get_the_ID(), '_kbds_area', true );
			$rooms = get_post_meta( get_the_ID(), '_kbds_bedrooms', true );
			$baths = get_post_meta( get_the_ID(), '_kbds_bathrooms', true );
			$proj  = get_post_meta( get_the_ID(), '_kbds_project_ref', true );
			$proj_post = $proj ? get_post( $proj ) : null;
			?>
			
			<div style="display:flex;gap:12px;flex-wrap:wrap;align-items:center;margin-bottom:24px;padding:14px 18px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:10px;">
				<?php if ( $price ) : ?>
					<div style="font-size:18px;font-weight:800;color:#DC2626;margin-right:16px;">💰 <?php echo esc_html( $price ); ?></div>
				<?php endif; ?>
				<?php if ( $area ) : ?>
					<div style="font-size:14px;color:#334155;background:#fff;padding:4px 12px;border-radius:6px;border:1px solid #CBD5E1;">📐 <strong><?php echo esc_html( $area ); ?> m²</strong></div>
				<?php endif; ?>
				<?php if ( $rooms ) : ?>
					<div style="font-size:14px;color:#334155;background:#fff;padding:4px 12px;border-radius:6px;border:1px solid #CBD5E1;">🛏️ <strong><?php echo esc_html( $rooms ); ?> PN</strong></div>
				<?php endif; ?>
				<?php if ( $baths ) : ?>
					<div style="font-size:14px;color:#334155;background:#fff;padding:4px 12px;border-radius:6px;border:1px solid #CBD5E1;">🚿 <strong><?php echo esc_html( $baths ); ?> WC</strong></div>
				<?php endif; ?>
				<?php if ( $proj_post ) : ?>
					<div style="font-size:14px;color:#0B2C4D;background:#EFF6FF;padding:4px 12px;border-radius:6px;border:1px solid #BFDBFE;">🏢 Dự án: <a href="<?php echo esc_url( get_permalink( $proj_post->ID ) ); ?>" style="font-weight:700;color:#0B2C4D;text-decoration:underline;"><?php echo esc_html( $proj_post->post_title ); ?></a></div>
				<?php endif; ?>
			</div>

			<div class="kbds-listing-body">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<?php
get_footer();
