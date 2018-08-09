<?php

// vars used
$count = 0;
$real_count = 0;
$post_columns = 2;
$max_columns = 12 / $post_columns;

// post type
$post_type = array( 'post', 'mrdt_recipes' );
if ( meridian_recipes_get_post_meta( get_the_ID(), 'featured_post_type' ) ) {
	$post_type = meridian_recipes_get_post_meta( get_the_ID(), 'featured_post_type' );
	if ( $post_type == 'mixed' ) {
		$post_type = array( 'post', 'mrdt_recipes' );
	}
}

// force post post_type if recipes func disabled
if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'disabled' ) {
	$post_type = 'post';
}

$tag_to_show = 'featured';
if ( meridian_recipes_get_post_meta( get_the_ID(), 'featured_tag' ) ) {
	$tag_to_show = meridian_recipes_get_post_meta( get_the_ID(), 'featured_tag' );
}

// query args
$args = array(
	'post_type' => $post_type,
	'posts_per_page' => 18,
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'mrdt_recipes_tags',
			'field'    => 'slug',
			'terms'    => $tag_to_show,
		),
		array(
			'taxonomy' => 'post_tag',
			'field'    => 'slug',
			'terms'    => $tag_to_show,
		),
	),
);

// query posts
$meridian_recipes_query = new WP_Query( $args );

// if there are posts
if ( $meridian_recipes_query->have_posts() ) :

	?>

	<div id="featured" class="featured-5">

		<div class="carousel-wrapper">

			<div class="wrapper">

				<div class="carousel no-col-spacing" data-items="6">

					<?php 

						// start posts loop
						while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

							// reset vars
							$post_class_append = '';
							$column_class = '';

							// increase counts
							$count++;
							$real_count++;

							// thumbnail sizes
							$thumb_width = 209;
							$thumb_height = $thumb_width / 1.75;
							$mobile_thumb_height = 480 / 1.75;

							// column class
							$column_class = 'carousel-item col col-' . $post_columns . ' ';

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

							// load template
							get_template_part( 'template-parts/listing/post-s7' );

						// end posts loop
						endwhile; 

					?>

				</div><!-- .carousel -->

				<?php if ( $real_count > $max_columns ) : ?>

					<span class="carousel-nav-circle-prev"><span class="fa fa-angle-left"></span></span>
					<span class="carousel-nav-circle-next"><span class="fa fa-angle-right"></span></span>

				<?php endif; ?>

			</div><!-- .wrapper -->

		</div><!-- .carousel-container -->

	</div><!-- #featured -->

<?php

// Finish if statement
endif; 

// Reset query
wp_reset_postdata();

?>