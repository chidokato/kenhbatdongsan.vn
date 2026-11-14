<?php
/**
 * Post archive title - Flatsome Child Theme.
 * Loại bỏ hoàn toàn tiền tố "Lưu trữ danh mục: ", "Lưu trữ thẻ: " để hiển thị tên danh mục chuẩn BĐS cao cấp.
 *
 * @package Flatsome
 */

?>
<header class="archive-page-header">
	<div class="row">
	<div class="large-12 text-center col">
	<h1 class="page-title is-large uppercase">
		<?php
			if ( is_category() ) :
				echo '<span>' . single_cat_title( '', false ) . '</span>';

			elseif ( is_tag() ) :
				echo '<span>' . single_tag_title( '', false ) . '</span>';

			elseif ( is_search() ) :
				printf( __( 'Search Results for: %s', 'flatsome' ), '<span>' . get_search_query() . '</span>' );

			elseif ( is_author() ) :
				the_post();
				echo '<span class="vcard">' . get_the_author() . '</span>';
				rewind_posts();

			elseif ( is_day() ) :
				echo '<span>' . get_the_date() . '</span>';

			elseif ( is_month() ) :
				echo '<span>' . get_the_date( 'F Y' ) . '</span>';

			elseif ( is_year() ) :
				echo '<span>' . get_the_date( 'Y' ) . '</span>';

			elseif ( is_tax() ) :
				echo '<span>' . single_term_title( '', false ) . '</span>';

			else :
				echo '';

			endif;
		?>
	</h1>
	<?php
		if ( is_category() ) :
			$category_description = category_description();
			if ( ! empty( $category_description ) ) :
				echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
			endif;

		elseif ( is_tag() ) :
			$tag_description = tag_description();
			if ( ! empty( $tag_description ) ) :
				echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
			endif;

		endif;
	?>
	</div>
	</div>
</header>
