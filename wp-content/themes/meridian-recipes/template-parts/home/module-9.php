<?php
// section info
$section_info = meridian_recipes_get_section_info();

// amount of posts
$posts_per_page = 20;
if ( isset( $section_info['posts_per_page'] ) && is_numeric( $section_info['posts_per_page'] ) ) {
	$posts_per_page = $section_info['posts_per_page'];
}

// vars used
$count = 0;
$real_count = 0;
$post_columns = 12;
$max_columns = 12 / $post_columns;

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

// do the query
$meridian_recipes_query = new WP_Query( $args );

// if there are posts
if ( $meridian_recipes_query->have_posts() ) :

?>

	<div class="module-wrapper module-9-wrapper">

		<div class="carousel-wrapper">

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
					
				<div class="module-9">

					<div class="carousel" data-items="1">

						<?php 

							// start posts loop
							while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

								// increase counts
								$count++;
								$real_count++;

								// thumbnail sizes
								$thumb_width = 1254;
								$thumb_height = $thumb_width / 2.18;
								$mobile_thumb_height = 480 / 2.18;

								// post class
								$post_class = 'carousel-item ';

								// set post vars
								meridian_recipes_set_post_vars(array(
									'post_class' => $post_class,
									'thumb_width' => $thumb_width,
									'thumb_height' => $thumb_height,
									'mobile_thumb_height' => $mobile_thumb_height
								));

								// post template
								get_template_part( 'template-parts/listing/post-s4' );

							// ends posts loop
							endwhile; 

						?>

					</div><!-- .carousel -->

					<?php if ( $real_count > $max_columns ) : ?>

						<span class="carousel-nav-circle-prev"><span class="fa fa-angle-left"></span></span>
						<span class="carousel-nav-circle-next"><span class="fa fa-angle-right"></span></span>

					<?php endif; ?>

				</div><!-- .module-9 -->

			</div><!-- .wrapper -->

		</div><!-- .carousel-wrapper -->

	</div><!-- module-9-wrapper -->

<?php

// end if there are posts
endif;

// reset post data
wp_reset_postdata();