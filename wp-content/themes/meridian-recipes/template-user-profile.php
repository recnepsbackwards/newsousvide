<?php
/**
 * Template Name: User Profile
 */
?>
<?php get_header(); ?>
<?php
	// User ID
	$user_id = get_current_user_id();

	// Filter
	$filter = false;
	if ( isset( $_GET['filter'] ) ) {
		$filter = $_GET['filter'];
	}

	// Bookmarked Recipes
	$bookmarked_recipes = false;
	if ( get_user_meta( $user_id, 'meridian_recipes_bookmarks_recipes', true ) ) {
		$bookmarked_recipes = get_user_meta( $user_id, 'meridian_recipes_bookmarks_recipes', true );
	}

	// Bookmarked Blog Posts
	$bookmarked_blog_posts = false;
	if ( get_user_meta( $user_id, 'meridian_recipes_bookmarks_blog_posts', true ) ) {
		$bookmarked_blog_posts = get_user_meta( $user_id, 'meridian_recipes_bookmarks_blog_posts', true );
	}

	// Rated Recipes
	$rated_recipes = false;
	if ( get_user_meta( $user_id, 'meridian_recipes_ratings_recipes', true ) ) {
		$rated_recipes = get_user_meta( $user_id, 'meridian_recipes_ratings_recipes', true );
	}
?>

	<div class="wrapper clearfix">

		<section id="content" class="col col-8">

			<?php
				/* Bookmarked recipes */
			?>

			<?php if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) : ?>

				<?php if ( ! $filter || $filter == 'bookmarked-recipes' ) : ?>

					<div class="user-profile-bookmarked-recipes clearfix">

						<?php meridian_recipes_section_title( esc_html__( 'Bookmarked Recipes', 'meridian-recipes' ) ); ?>

						<?php if ( $bookmarked_recipes ) : ?>

							<div class="clearfix">

								<?php
									// vars used
									$count = 0;
									$real_count = 0;
									$post_columns = 6;
									$max_columns = 12 / $post_columns;

									// query arguments
									$args = array(
										'post_type' => 'mrdt_recipes',
										'posts_per_page' => 12,
										'post__in' => $bookmarked_recipes,
										'ignore_sticky_posts' => true,
									);

									// if filter no max posts per page
									if ( $filter == 'bookmarked-recipes' ) {
										$args['posts_per_page'] = -1;
									}

									// query posts
									$meridian_recipes_query = new WP_Query( $args );

									// start loop posts
									if ( $meridian_recipes_query->have_posts() ) : while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

										// reset vars
										$post_class_append = '';
										$column_class = '';

										// increase counts
										$count++;
										$real_count++;

										// different thumbnail sizes
										$thumb_width = 87;
										$thumb_height = 87;

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
											'mobile_thumb_height' => false
										));

										// load template
										get_template_part( 'template-parts/listing/post-s6' );

									// end loop posts
									endwhile; endif;

									// reset post data
									wp_reset_postdata();

								?>

							</div><!-- .clearfix -->

							<?php if ( ! $filter ) : ?>
								<?php $view_all_link = add_query_arg( 'filter', 'bookmarked-recipes', get_permalink() ); ?>
								<a href="<?php echo esc_url( $view_all_link ); ?>" class="user-profile-button"><?php esc_html_e( 'View All Bookmarked Recipes', 'meridian-recipes' ); ?></a>
							<?php endif; ?>

						<?php else : ?>

							<?php esc_html_e( 'You have not bookmarked any recipes yet.', 'meridian-recipes' ); ?>

						<?php endif; ?>

					</div><!-- .user-profile-bookmarked-recipes -->

				<?php endif; ?>

			<?php endif; ?>

			<?php
				/* Bookmarked blog posts */
			?>

			<?php if ( ! $filter || $filter == 'bookmarked-blog-posts' ) : ?>

				<div class="user-profile-bookmarked-blog-posts clearfix">

					<?php meridian_recipes_section_title( esc_html__( 'Bookmarked Blog Posts', 'meridian-recipes' ) ); ?>

					<?php if ( $bookmarked_blog_posts ) : ?>

						<div class="clearfix">

							<?php
								// vars used
								$count = 0;
								$real_count = 0;
								$post_columns = 6;
								$max_columns = 12 / $post_columns;

								// query arguments
								$args = array(
									'post_type' => 'post',
									'posts_per_page' => 12,
									'post__in' => $bookmarked_blog_posts,
									'ignore_sticky_posts' => true,
								);

								// if filter no max posts per page
								if ( $filter == 'bookmarked-blog-posts' ) {
									$args['posts_per_page'] = -1;
								}

								// query posts
								$meridian_recipes_query = new WP_Query( $args );

								// start loop posts
								if ( $meridian_recipes_query->have_posts() ) : while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

									// reset vars
									$post_class_append = '';
									$column_class = '';

									// increase counts
									$count++;
									$real_count++;

									// different thumbnail sizes
									$thumb_width = 87;
									$thumb_height = 87;
									$mobile_thumb_height = 480;

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
									get_template_part( 'template-parts/listing/post-s6' );

								// end loop posts
								endwhile; endif;

								// reset post data
								wp_reset_postdata();

							?>

						</div><!-- .clearfix -->

						<?php if ( ! $filter ) : ?>
							<?php $view_all_link = add_query_arg( 'filter', 'bookmarked-blog-posts', get_permalink() ); ?>
							<a href="<?php echo esc_url( $view_all_link ); ?>" class="user-profile-button"><?php esc_html_e( 'View All Bookmarked Blog Posts', 'meridian-recipes' ); ?></a>
						<?php endif; ?>

					<?php else : ?>

						<?php esc_html_e( 'You have not bookmarked any blog posts yet.', 'meridian-recipes' ); ?>

					<?php endif; ?>

				</div><!-- .user-profile-bookmarked-blog-posts -->

			<?php endif; ?>

			<?php
				/* Rated recipes */
			?>

			<?php if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) : ?>

				<?php if ( ! $filter || $filter == 'rated-recipes' ) : ?>

					<div class="user-profile-bookmarked-recipes clearfix">

						<?php meridian_recipes_section_title( esc_html__( 'Rated Recipes', 'meridian-recipes' ) ); ?>

						<?php if ( $rated_recipes ) : ?>

							<div class="clearfix">

								<?php
									// vars used
									$count = 0;
									$real_count = 0;
									$post_columns = 6;
									$max_columns = 12 / $post_columns;

									// query arguments
									$args = array(
										'post_type' => 'mrdt_recipes',
										'posts_per_page' => 12,
										'post__in' => $rated_recipes,
										'ignore_sticky_posts' => true,
									);

									// if filter no max posts per page
									if ( $filter == 'rated-recipes' ) {
										$args['posts_per_page'] = -1;
									}

									// query posts
									$meridian_recipes_query = new WP_Query( $args );

									// start loop posts
									if ( $meridian_recipes_query->have_posts() ) : while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

										// reset vars
										$post_class_append = '';
										$column_class = '';

										// increase counts
										$count++;
										$real_count++;

										// different thumbnail sizes
										$thumb_width = 87;
										$thumb_height = 87;
										$mobile_thumb_height = 480;

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
										get_template_part( 'template-parts/listing/post-s6' );

									// end loop posts
									endwhile; endif;

									// reset post data
									wp_reset_postdata();

								?>

							</div><!-- .clearfix -->

							<?php if ( ! $filter ) : ?>
								<?php $view_all_link = add_query_arg( 'filter', 'rated-recipes', get_permalink() ); ?>
								<a href="<?php echo esc_url( $view_all_link ); ?>" class="user-profile-button"><?php esc_html_e( 'View All Rated Recipes', 'meridian-recipes' ); ?></a>
							<?php endif; ?>

						<?php else : ?>

							<?php esc_html_e( 'You have not rated any recipes yet.', 'meridian-recipes' ); ?>

						<?php endif; ?>

					</div><!-- .user-profile-bookmarked-recipes -->

				<?php endif; ?>

			<?php endif; ?>

		</section><!-- #content -->

		<?php get_sidebar( 'user-profile' ); ?>

	</div><!-- .wrapper -->

<?php get_footer(); ?>