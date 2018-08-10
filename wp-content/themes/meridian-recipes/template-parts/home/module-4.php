<?php

// section info
$section_info = meridian_recipes_get_section_info();

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
	'posts_per_page' => 6,
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

// do the query
$meridian_recipes_query = new WP_Query( $args );

// if there are posts
if ( $meridian_recipes_query->have_posts() ) :

?>

	<div class="module-wrapper module-6-wrapper">

		<div class="wrapper clearfix">

			<?php 
				
				while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

					// reset vars
					$post_class_append = '';
					$column_class = '';

					// increase counts
					$count++;
					$real_count++;

					// thumbnail sizes
					if ( $real_count == 1 ) {
						$thumb_width = 394;
						$thumb_height = $thumb_width / 1.11;
						$mobile_thumb_height = 480 / 1.11;
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

					if ( $real_count == 1 ) {						
						ob_start();
						get_template_part( 'template-parts/listing/post-s1' );
						$output_1 .= ob_get_contents();
						ob_end_clean();
					} else {
						ob_start();
						get_template_part( 'template-parts/listing/post-s6' );
						$output_2 .= ob_get_contents();
						ob_end_clean();
					}

				endwhile; 
			?>
			
			<div class="module-4 clearfix">

				<div class="module-4-main col col-8">
					
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

					<div class="clearfix">

						<div class="module-4-left col col-6">
							<?php echo do_shortcode( $output_1 ); ?>
						</div>

						<div class="module-4-right col col-6 col-last">
							<?php echo do_shortcode( $output_2 ); ?>
						</div>

					</div><!-- .clearfix -->

				</div><!-- .module-4-main -->

				<?php if ( is_active_sidebar( 'sidebar-m-4' ) ) : ?>
					<div class="sidebar module-4-sidebar col col-4 col-last">
						<?php dynamic_sidebar( 'sidebar-m-4' ); ?>
					</div><!-- .module-4-sidebar -->
				<?php endif; ?>

			</div><!-- .module-4 -->

		</div><!-- .wrapper -->

	</div><!-- module-4-wrapper -->

<?php

// end if there are posts
endif;

// rest post data
wp_reset_postdata();