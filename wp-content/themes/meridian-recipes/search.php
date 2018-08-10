<?php get_header(); ?>
<?php
// vars used
$count = 0;
$real_count = 0;
$post_columns = 12;
$max_columns = 12 / $post_columns;
?>
	
	<div class="wrapper clearfix">

		<section id="content" class="col col-8">

			<?php

				// get the title
				$title = get_search_query();

			?>

			<?php meridian_recipes_section_title( $title, esc_html__( 'Search Results For:', 'meridian-recipes' ) ); ?>

			<?php 

				// If there are posts
				if ( have_posts() ) :

					?><div class="posts-listing blog-posts-listing"><?php

						?><div class="posts-listing-inner blog-posts-listing-inner clearfix">

							<?php while ( have_posts() ) : the_post(); ?>

							<?php

								// reset vars
								$post_class_append = '';
								$column_class = '';

								// increase counts
								$count++;
								$real_count++;

								// thumbnail sizes
								$thumb_width = 394;
								$thumb_height = $thumb_width / 1.56;
								$mobile_thumb_height = 480 / 1.56;

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

							?>

							<?php get_template_part( 'template-parts/listing/post-s3' ); ?>

						<?php endwhile;

						?></div><!-- .blog-posts-listing-inner --><?php

						// Post navigation
						meridian_recipes_posts_pagination();

					?></div><!-- .blog-posts-listing --><?php

				// If no posts found
				else :

					// Output from template
					get_template_part( 'template-parts/content', 'none' );

				// Finish if statement
				endif; 

			?>

		</section><!-- #content -->

		<?php get_sidebar(); ?>

	</div><!-- .wrapper -->

<?php get_footer();
