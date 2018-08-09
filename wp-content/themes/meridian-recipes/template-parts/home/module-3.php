<?php

// section info
$section_info = meridian_recipes_get_section_info();

// amount of posts
$posts_per_page = 6;
if ( isset( $section_info['posts_per_page'] ) && is_numeric( $section_info['posts_per_page'] ) ) {
	$posts_per_page = $section_info['posts_per_page'];
}

// vars used
$count = 0;
$real_count = 0;
$post_columns = 12;
$max_columns = 12 / $post_columns;

// HTML output storage
$output_1 = '';
$output_2 = '';

// current page
if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }			

// query arguments
$args = array(
	'post_type' => $section_info['post_type'],
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	'orderby' => $section_info['post_orderby'],
	'order' => $section_info['post_order'],
	'no_found_rows' => true,
);

// recipe categories
if ( isset( $section_info['recipe_categories'] ) && is_array( $section_info['recipe_categories'] ) ) {
	if ( $section_info['post_type'] == 'mrdt_recipes' || is_array( $section_info['post_type'] ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'mrdt_recipes_cats',
			'field'    => 'term_id',
			'terms'    => $section_info['recipe_categories'],
		);
	}
}

// blog categories
if ( isset( $section_info['blog_categories'] ) && is_array( $section_info['blog_categories'] ) ) {
	if ( $section_info['post_type'] == 'post' || is_array( $section_info['post_type'] ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $section_info['blog_categories'],
		);
	}
}

// if both blog and recipes
if ( is_array( $section_info['post_type'] ) ) {
	$args['tax_query']['relation'] = 'OR';
}

// category titles and links
$cat_1_name = false;
if ( $section_info['post_type'] == 'mrdt_recipes' && isset( $section_info['recipe_categories'][0] ) ) {

	// cat 1
	$cat_1 = get_term_by( 'term_id', $section_info['recipe_categories'][0], 'mrdt_recipes_cats' );
	$cat_1_name = $cat_1->name;
	$cat_1_link = get_term_link( $cat_1, 'mrdt_recipes_cats' );

} elseif ( isset( $section_info['blog_categories'][0] ) ) {

	// cat 1
	$cat_1 = get_term_by( 'term_id', $section_info['blog_categories'][0], 'category' );
	$cat_1_name = $cat_1->name;
	$cat_1_link = get_term_link( $cat_1, 'category' );

}

// do the query
$meridian_recipes_query = new WP_Query( $args );

// if there are posts
if ( $meridian_recipes_query->have_posts() ) :

?>

	<div class="module-wrapper module-3-wrapper">

		<div class="wrapper clearfix">

			<?php
				// defaults
				$heading_title = false;
				$heading_url = false;

				// title
				if ( isset( $section_info['section_title'] ) )
					$heading_title = $section_info['section_title'];

				// URL
				if ( isset( $section_info['section_title_url'] ) && ! empty( $section_info['section_title_url'] ) )
					$heading_url = $section_info['section_title_url'];

				// if title and URL
				if ( $heading_title && $heading_url ) {
					meridian_recipes_section_title( $heading_title, false, $heading_url );

				// if only title
				} elseif ( $heading_title ) {
					meridian_recipes_section_title( $heading_title );

				}
			?>

			<?php 

				// start posts loop
				while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

					// reset vars
					$post_class_append = '';
					$column_class = '';

					// increase counts
					$count++;
					$real_count++;

					// different post columns
					if ( $real_count <= 2 ) {
						$post_columns = 6;
						$max_columns = 2;
					} else {
						$post_columns = 12;
						$max_columns = 12;
					}

					// different thumbnail sizes
					if ( $real_count <= 2 ) {
						$thumb_width = 394;
						$thumb_height = $thumb_width / 1.34;
						$mobile_thumb_height = 480 / 1.34;
					} else {
						$thumb_width = 87;
						$thumb_height = 87;
						$mobile_thumb_height = 480;
					}

					// column class
					$column_class = 'col col-' . $post_columns . ' ';

					// first column
					if ( $count == 1 )
						$post_class_append = 'col-first';

					// last column
					if ( $count >= $max_columns )
						$post_class_append = 'col-last';

					// reset count on max
					if ( $count >= $max_columns )
						$count = 0;

					// post class
					$post_class = $column_class . $post_class_append;

					// set post vars
					meridian_recipes_set_post_vars(array(
						'post_class' => $post_class,
						'thumb_width' => $thumb_width,
						'thumb_height' => $thumb_height,
						'mobile_thumb_height' => $mobile_thumb_height
					));

					/**
					 * Variations
					 */

					// first and second post
					if ( $real_count <= 2 ) {
						
						ob_start();
						get_template_part( 'template-parts/listing/post-s1' );
						$output_2 .= ob_get_contents();
						ob_end_clean();

					// after second post
					} else {
						
						ob_start();
						get_template_part( 'template-parts/listing/post-s6' );
						$output_1 .= ob_get_contents();
						ob_end_clean();

					}

				// end posts loop
				endwhile; 
			?>
			
			<div class="module-3 clearfix">

				<div class="module-3-left col col-4">
					<?php if ( $cat_1_name ) : ?>
						<h3 class="module-3-heading" data-mtst-selector=".module-3-heading" data-mtst-label="Module 3 - Heading" data-mtst-no-support="border,background"><?php echo esc_html( $cat_1_name ); ?></h3>
					<?php endif; ?>
					<?php echo do_shortcode( $output_1 ); ?>

					<?php if ( $after_module_3_secondary = meridian_recipes_get_theme_mod( 'after_module_3_secondary', false ) ) : ?>
						<div class="module-3-after-secondary">
							<?php echo do_shortcode( $after_module_3_secondary ); ?>
						</div><!-- .module-3-after-secondary -->
					<?php endif; ?>
				</div>

				<div class="module-3-right col col-8 col-last">
					<?php echo do_shortcode( $output_2 ); ?>
				</div>

			</div><!-- .module-3 -->

		</div><!-- .wrapper -->

	</div><!-- module-3-wrapper -->

<?php

// end if there are posts
endif;

// reset post data
wp_reset_postdata();