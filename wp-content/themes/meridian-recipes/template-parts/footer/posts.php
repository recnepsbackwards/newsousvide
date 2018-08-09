<?php if ( is_singular( 'mrdt_recipes' ) && meridian_recipes_get_theme_mod( 'footer_posts', 'enabled' ) == 'enabled' ) : ?>

	<div id="footer-posts" data-mtst-selector="#footer-posts" data-mtst-label="Footer Posts" data-mtst-no-support="typogrpahy,border">

		<div class="wrapper">

			<?php meridian_recipes_section_title( esc_html__( 'Related Recipes', 'meridian-recipes' ) ); ?>

			<?php

				// current recipe info
				$current_cats = wp_get_post_terms( get_the_ID(), 'mrdt_recipes_cats' );
				$query_args_cats = array();
				if ( $current_cats ) {
					foreach( $current_cats as $current_cat ) {
						$query_args_cats[] = $current_cat->term_id;
					}
				}

				// vars used
				$count = 0;
				$real_count = 0;
				$post_columns = 3;
				$max_columns = 12 / $post_columns;

				// query arguments
				$query_args = array(
					'post_type' => 'mrdt_recipes',
					'posts_per_page' => 4,
					'post__not_in' => array( get_the_ID() ),
					'tax_query' => array(
						array(
							'taxonomy' => 'mrdt_recipes_cats',
							'field'    => 'term_id',
							'terms'    => $query_args_cats,
						),
					)			
				);

				// do the query
				$meridian_recipes_query = new WP_Query( $query_args );

				// vars ( passed on to tempalte )
				$count = 0;
				$real_count = 0;
				$post_columns = 3;				

			?>

			<?php if ( $meridian_recipes_query->have_posts() ) : ?>

				<div class="clearfix">

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

							// load template
							get_template_part( 'template-parts/listing/post-s2' );

						// end posts loop
						endwhile;

					?>

				</div><!-- .clearfix -->

			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

		</div><!-- .wrapper -->

	</div><!-- #footer-posts -->

<?php endif; ?>