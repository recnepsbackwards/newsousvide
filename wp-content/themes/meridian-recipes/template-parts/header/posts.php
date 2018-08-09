<?php

$post_type = 'mrdt_recipes';
if ( is_singular( 'post' ) ) {
	$post_type = 'post';
}

// Force post post_type if recipes functionality disabled
if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'disabled' ) {
	$post_type = 'post';
}

// vars used
$count = 0;
$real_count = 0;
$post_columns = 2;
$max_columns = 12 / $post_columns;

// query args
$args = array(
	'post_type' => $post_type,
	'posts_per_page' => 18,
);

// if user profile page get recently viewed
if ( is_page_template( 'template-user-profile.php' ) && is_user_logged_in() && meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) {

	$user_id = get_current_user_id();

	// Bookmarked Recipes
	$recently_viewed_recipes = false;
	if ( get_user_meta( $user_id, 'meridian_recipes_recently_viewed_recipes', true ) ) {
		$recently_viewed_recipes = get_user_meta( $user_id, 'meridian_recipes_recently_viewed_recipes', true );
	}

	// change query arguments
	$args['post__in'] = $recently_viewed_recipes;
	$args['orderby'] = 'post__in';

}

// query posts
$meridian_recipes_query = new WP_Query( $args );

// if there are posts
if ( $meridian_recipes_query->have_posts() ) : 

	?>

	<div class="header-posts no-col-spacing">

		<div class="carousel-wrapper">

			<div class="wrapper clearfix">

				<div class="carousel" data-items="6">

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

		</div><!-- .carousel-wrapper -->

	</div><!-- #featured -->

<?php

// finish if statement
endif; 

// reset query
wp_reset_postdata();
