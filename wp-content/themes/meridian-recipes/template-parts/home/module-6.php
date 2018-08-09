<?php

// section info
$section_info = meridian_recipes_get_section_info();

// amount of posts
$posts_per_page = 4;
if ( isset( $section_info['posts_per_page'] ) && is_numeric( $section_info['posts_per_page'] ) ) {
	$posts_per_page = $section_info['posts_per_page'];
}

// HTML output storage
$output_1 = '';
$output_2 = '';

// recipe categories
if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) {
	if ( is_array( $section_info['recipe_categories'] ) ) {
		$recipe_cats = $section_info['recipe_categories'];
	} else {
		$recipe_categories = get_terms( 'mrdt_recipes_cats', array( 'number' => 2 ) );
		$recipes_cats = array();
		foreach ( $recipe_categories as $recipe_category ) {
			$recipe_cats[] = $recipe_category->term_id;
		}
	}
}

// blog categories
if ( is_array( $section_info['blog_categories'] ) ) {
	$blog_cats = $section_info['blog_categories'];
} else {
	$blog_categories = get_terms( 'category', array( 'number' => 2 ) );
	$blog_cats = array();
	foreach ( $blog_categories as $blog_category ) {
		$blog_cats[] = $blog_category->term_id;
	}
}

// category titles and links
if ( $section_info['post_type'] == 'mrdt_recipes' ) {

	// If there aren't 2 categories chosen
	if ( ! isset( $recipe_cats[0] ) || ! isset( $recipe_cats[1] ) )
		return;

	// cat 1
	$cat_1 = get_term_by( 'term_id', $recipe_cats[0], 'mrdt_recipes_cats' );
	$cat_1_name = $cat_1->name;
	$cat_1_link = get_term_link( $cat_1, 'mrdt_recipes_cats' );

	// cat 2
	$cat_2 = get_term_by( 'term_id', $recipe_cats[1], 'mrdt_recipes_cats' );
	$cat_2_name = $cat_2->name;
	$cat_2_link = get_term_link( $cat_2, 'mrdt_recipes_cats' );

} else {

	// If there aren't 2 categories chosen
	if ( ! isset( $blog_cats[0] ) || ! isset( $blog_cats[1] ) )
		return;
	
	// cat 1
	$cat_1 = get_term_by( 'term_id', $blog_cats[0], 'category' );
	$cat_1_name = $cat_1->name;
	$cat_1_link = get_term_link( $cat_1, 'category' );

	// cat 2
	$cat_2 = get_term_by( 'term_id', $blog_cats[1], 'category' );
	$cat_2_name = $cat_2->name;
	$cat_2_link = get_term_link( $cat_2, 'category' );

}

/**
 * First Query
 */

// vars used
$count = 0;
$real_count = 0;
$post_columns = 12;
$max_columns = 12 / $post_columns;

// query arguments
$args = array(
	'post_type' => $section_info['post_type'],
	'posts_per_page' => $posts_per_page,
	'orderby' => $section_info['post_orderby'],
	'order' => $section_info['post_order'],
	'no_found_rows' => true,
);

// categories
if ( $section_info['post_type'] == 'mrdt_recipes' ) {
	if ( is_array( $recipe_cats ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'mrdt_recipes_cats',
			'field'    => 'term_id',
			'terms'    => $recipe_cats[0]
		);
	}
} else {
	if ( is_array( $blog_cats ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $blog_cats[0]
		);
	}
}

// do the query
$meridian_recipes_query = new WP_Query( $args );

// if there are posts
if ( $meridian_recipes_query->have_posts() ) :

	// start output buffer
	ob_start();
	
	// start posts loop
	while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

		// increase counts
		$count++;
		$real_count++;

		// thumbnail sizes
		if ( $real_count == 1 ) {
			$thumb_width = 394;
			$thumb_height = $thumb_width / 1.56;
			$mobile_thumb_height = 480 / 1.56;
		} else {
			$thumb_width = 87;
			$thumb_height = 87;
			$mobile_thumb_height = 480;
		}

		// post class
		$post_class = '';

		// set post vars
		meridian_recipes_set_post_vars(array(
			'post_class' => $post_class,
			'thumb_width' => $thumb_width,
			'thumb_height' => $thumb_height,
			'mobile_thumb_height' => $mobile_thumb_height
		));

		// if first post
		if ( $real_count == 1 ) {
			get_template_part( 'template-parts/listing/post-s1' ); 

		// after first post
		} else {
			get_template_part( 'template-parts/listing/post-s6' ); 
		}

	// end posts loop
	endwhile;

	// get output and stop buffering
	$output_1 .= ob_get_contents();
	ob_end_clean();

// end if there are posts
endif;

// Reset post data
wp_reset_postdata();

/**
 * Second Query
 */

// vars used
$count = 0;
$real_count = 0;

// query arguments
$args = array(
	'post_type' => $section_info['post_type'],
	'posts_per_page' => $posts_per_page,
	'orderby' => $section_info['post_orderby'],
	'order' => $section_info['post_order'],
	'no_found_rows' => true,
);

// categories
if ( $section_info['post_type'] == 'mrdt_recipes' ) {
	if ( is_array( $section_info['recipe_categories'] ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'mrdt_recipes_cats',
			'field'    => 'term_id',
			'terms'    => $recipe_cats[1]
		);
	}
} else {
	if ( is_array( $section_info['blog_categories'] ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $blog_cats[1]
		);
	}
}

// do the query
$meridian_recipes_query = new WP_Query( $args );

// if there are posts
if ( $meridian_recipes_query->have_posts() ) :

	// start output buffering
	ob_start();
	
	// start posts loop
	while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

		// increase counts
		$count++;
		$real_count++;

		// thumbnail sizes
		if ( $real_count == 1 ) {
			$thumb_width = 394;
			$thumb_height = $thumb_width / 1.56;
			$mobile_thumb_height = 480 / 1.56;
		} else {
			$thumb_width = 87;
			$thumb_height = 87;
			$mobile_thumb_height = 480;
		}

		// post class
		$post_class = '';

		// set post vars
		meridian_recipes_set_post_vars(array(
			'post_class' => $post_class,
			'thumb_width' => $thumb_width,
			'thumb_height' => $thumb_height,
			'mobile_thumb_height' => $mobile_thumb_height
		));

		// if first post
		if ( $real_count == 1 ) {
			get_template_part( 'template-parts/listing/post-s1' ); 

		// after first post
		} else {
			get_template_part( 'template-parts/listing/post-s6' ); 
		}

	// end posts loop
	endwhile;

	// get content and stop buffering
	$output_2 .= ob_get_contents();
	ob_end_clean();

// end if there are posts
endif;

// Reset post data
wp_reset_postdata();

?>

	<div class="module-wrapper module-6-wrapper">

		<div class="wrapper clearfix">

			<div class="module-6 col col-8 clearfix">

				<div class="module-6-left col col-6">
					<?php meridian_recipes_section_title( $cat_1_name ); ?>
					<div class="clearfix">
						<?php echo do_shortcode( $output_1 ); ?>
					</div>
					<a href="<?php echo esc_url( $cat_1_link ); ?>" class="module-6-button" data-mtst-selector=".module-6-button" data-mtst-label="Module 6 - Button"><?php esc_html_e( 'VIEW ALL', 'meridian-recipes' ); ?> <?php echo esc_html( $cat_1_name ); ?></a>
				</div>

				<div class="module-6-right col col-6 col-last">
					<?php meridian_recipes_section_title( $cat_2_name ); ?>
					<div class="clearfix">
						<?php echo do_shortcode( $output_2 ); ?>
					</div>
					<a href="<?php echo esc_url( $cat_2_link ); ?>" class="module-6-button" data-mtst-selector=".module-6-button" data-mtst-label="Module 6 - Button"><?php esc_html_e( 'VIEW ALL', 'meridian-recipes' ); ?> <?php echo esc_html( $cat_2_name ); ?></a>
				</div>

			</div><!-- .module-6 -->

			<?php if ( is_active_sidebar( 'sidebar-m-6' ) ) : ?>
				<div class="sidebar col col-4 col-last">
					<?php dynamic_sidebar( 'sidebar-m-6' ); ?>
				</div><!-- .sidebar -->
			<?php endif; ?>

		</div><!-- .wrapper -->

	</div><!-- module-6-wrapper -->

<?php
