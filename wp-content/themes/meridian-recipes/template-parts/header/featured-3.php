<?php

// vars used
$count = 0;
$real_count = 0;
$post_columns = 12;
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
	'posts_per_page' => 3,
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

	<div id="featured" class="featured-3 no-col-spacing">

		<div class="wrapper clearfix">

			<?php
				
				// loop posts
				while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

					// reset vars
					$post_class_append = '';
					$column_class = '';

					// increase counts
					$count++;
					$real_count++;

					// thumbnail sizes
					if ( $real_count == 1 ) {
						$thumb_width = 700;
						$thumb_height = $thumb_width / 1;
						$mobile_thumb_height = 480;
					} else {
						$thumb_width = 350;
						$thumb_height = $thumb_width;
						$mobile_thumb_height = 350;
					}

					// post class
					$post_class = 'post-s4-center';

					// var name used for output buffering
					$varname = 'item_' . $real_count;

					// tumbnail size for first item
					if ( $real_count == 1 ) {
						$thumb_width = 700;
						$thumb_ratio = 1;

					// thumbnail size for second and third
					} else {
						$thumb_width = 700;
						$thumb_ratio = 2;
					}

					// set post vars
					meridian_recipes_set_post_vars(array(
						'post_class' => $post_class,
						'thumb_width' => $thumb_width,
						'thumb_height' => $thumb_height,
						'mobile_thumb_height' => $mobile_thumb_height
					));

					// start output buffer
					ob_start();

						// post template
						get_template_part( 'template-parts/listing/post-s4' );

					// collect and end output buffer
					$$varname = ob_get_contents();
					ob_end_clean();

				// end loop posts
				endwhile;

				?>

				<div class="featured-3-primary col col-6">
					<?php echo do_shortcode( $item_1 ); ?>
				</div><!-- .col-6 -->

				<div class="featured-3-secondary col col-6 col-last">
					<?php echo do_shortcode( $item_2 ); ?>
					<?php echo do_shortcode( $item_3 ); ?>
				</div><!-- .col-6 -->

		</div><!-- .wrapper -->

	</div><!-- #featured -->

<?php

// finish if statement
endif; 

// reset query
wp_reset_postdata();
