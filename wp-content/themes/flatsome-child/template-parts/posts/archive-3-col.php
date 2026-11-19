<?php
/**
 * Posts archive 3 column - Flatsome Child Theme.
 * Hiển thị 3 bài / hàng dạng Grid Card chuẩn BĐS cao cấp & hiện đại.
 *
 * @package Flatsome
 */

if ( have_posts() ) : ?>
	<div id="post-list" class="kbds-archive-3col-wrapper">
		<?php
		$ids = array();
		while ( have_posts() ) : the_post();
			array_push( $ids, get_the_ID() );
		endwhile;
		$ids = implode( ',', $ids );

		echo flatsome_apply_shortcode( 'blog_posts', array(
			'type'           => 'row',
			'columns'        => '3',
			'columns__md'    => '2',
			'columns__sm'    => '1',
			'col_spacing'    => 'small',
			'depth'          => '1',
			'depth_hover'    => '3',
			'text_align'     => 'left',
			'style'          => 'default',
			'image_height'   => '62%',
			'image_hover'    => 'zoom',
			'show_date'      => 'text',
			'badge_style'    => '',
			'show_category'  => 'label',
			'excerpt'        => 'visible',
			'excerpt_length' => '18',
			'readmore'       => 'Đọc tiếp →',
			'readmore_style' => 'link',
			'readmore_size'  => 'small',
			'ids'            => $ids,
		) );
		?>

		<?php flatsome_posts_pagination(); ?>
	</div>
<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content', 'none' ); ?>

<?php endif; ?>
