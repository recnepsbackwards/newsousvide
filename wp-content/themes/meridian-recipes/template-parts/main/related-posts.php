<?php
	
	// Query args
	$args = array(
		'posts_per_page' => 3,
		'orderby' => 'rand',
	);

	// Query posts
	$meridian_recipes_query = new WP_Query( $args );

	// vars ( passed on to template )
	$count = 0;
	$real_count = 0;
	$post_columns = 4;
	$max_columns = 12 / $post_columns;

	// If there are posts
	if ( $meridian_recipes_query->have_posts() ) :

		meridian_recipes_section_title( esc_html__( 'Related Posts', 'meridian-recipes' ) );

		?><div class="related-posts clearfix"><?php

			// Loop posts
			while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

				// reset vars
				$post_class_append = '';
				$column_class = '';

				// increase counts
				$count++;
				$real_count++;

				// thumbnail sizes
				$thumb_width = 287;
				$thumb_height = $thumb_width / 1.27;
				$mobile_thumb_height = 480 / 1.27;

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

				// post template
				get_template_part( 'template-parts/listing/post-s2' );

			endwhile;

		?></div><!-- .related-posts --><?php

	// If no posts found
	else :

		// Output from template
		get_template_part( 'template-parts/content', 'none' );

	// Finish if statement
	endif; 

	wp_reset_postdata(); 

?>