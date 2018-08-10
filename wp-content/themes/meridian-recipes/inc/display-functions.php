<?php
/**
 * Table of Contents
 *
 * meridian_recipes_posts_pagination ( Outputs post pagination )
 * meridian_recipes_posts_alternate ( Output posts alternate listing )
 * meridian_recipes_display_comments ( Template for comments and pingbacks )
 * meridian_recipes_mobile_nav ( Handles output of mobile nav )
 * meridian_recipes_display_rating ( Displays rating of a recipe )
 * meridian_recipes_section_title ( Displays section title )
 * meridian_recipes_admin_logo ( Changed the logo on admin sign in / sign up page )
 */

if ( ! function_exists( 'meridian_recipes_posts_pagination' ) ) : 

	/**
	 * Output post pagination
	 *
	 * @since 1.0
	 */
	function meridian_recipes_posts_pagination( $atts = false ) {

		// The output will be stored here
		$output = '';

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		}

		if ( ! isset( $atts['force_number'] ) ) $force_number = false; else $force_number = $atts['force_number'];
		if ( ! isset( $atts['pages'] ) ) $pages = false; else $pages = $atts['pages'];
		if ( ! isset( $atts['type'] ) ) $type = 'loadmore'; else $type = $atts['type'];
		$range = 2;

		$showitems = ($range * 2)+1;  

		if ( empty ( $paged ) ) { $paged = 1; }		

		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if( ! $pages ) {
				$pages = 1;
			}
		}

		if( 1 != $pages ) {

			?>
			<div class="pagination pagination-type-<?php echo esc_attr( $type ); ?>">
				<ul class="clearfix">
					<?php

						if ( $type == 'numbered' ) {

							if($paged > 2 && $paged > $range+1 && $showitems < $pages) { echo "<li class='inactive'><a href='".get_pagenum_link(1)."'>&laquo;</a></li>"; }
							if($paged > 1 && $showitems < $pages) { echo "<li class='inactive'><a href='".get_pagenum_link($paged - 1)."' >&lsaquo;</a></li>"; }

							for ($i=1; $i <= $pages; $i++){
								if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)){
									echo ($paged == $i)? "<li class='active'><a href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."'>".$i."</a></li>";
								}
							}

							if ($paged < $pages && $showitems < $pages) { echo "<li class='inactive'><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>"; } 
							if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) { echo "<li class='inactive'><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>"; }

						} elseif ( $type == 'prevnext' ) {

							if($paged > 1 ) { echo "<li class='inactive fl'><a href='".get_pagenum_link($paged - 1)."' >" . esc_html__( 'Newer', 'meridian-recipes' ) . "</a></li>"; }
							if ($paged < $pages ) { echo "<li class='inactive fr'><a href='".get_pagenum_link($paged + 1)."'>" . esc_html__( 'Older', 'meridian-recipes' ) . "</a></li>"; } 

						} elseif ( $type == 'default' ) {

							posts_nav_link();

						}

						if ( $type == 'loadmore' ) {
							if ($paged < $pages ) { 
								echo "<li class='pagination-load-more active'><a href='".get_pagenum_link($paged + 1)."'><span class='fa fa-refresh'></span>" . esc_html__( 'LOAD MORE ITEMS', 'meridian-recipes' ) . "</a></li>";
							} else {
								echo "<li class='pagination-load-more inactive'><a href='#'><span class='fa fa-refresh'></span>" . esc_html__( 'LOAD MORE ITEMS', 'meridian-recipes' ) . "</a></li>";
							}
						}
						
					?>
				</ul>

				<?php if ( $type == 'loadmore' ) : ?>
					<div class="load-more-temp"></div>
				<?php endif; ?>

			</div><!-- .pagination --><?php
		}

	}

endif;  // End if mdrt_posts_slider exists

if ( ! function_exists( 'meridian_recipes_posts_alternate' ) ) : 

	/**
	 * Output Posts ( alternate styling )
	 *
	 * @since 1.0
	 */
	function meridian_recipes_posts_alternate( $args ) {

		// The output will be stored here
		$output = '';

		// Default query arguments
		$def_query_args = array(
			'post_type' => 'post',
			'posts_per_page' => 4,
		);

		// Merge query args
		if ( isset( $args['query_args'] ) && is_array( $args['query_args'] ) ) {
			$query_args = array_merge( $def_query_args, $args['query_args'] );
		} else {
			$query_args = $def_query_args;
		}	

		// Do the query
		$meridian_recipes_query = new WP_Query( $query_args );

		// Class attribute
		$post_class = 'blog-post-alt carousel-item ';
		$post_class .= ' ';

		// Class append
		$post_class_append = '';

		// Count
		$count = 0;
		$real_count = 0;

		/**
		 * What to show
		 */

		// Defaults
		$show_heading = false;
		$show_date = false;
		$show_title = false;
		$show_comments = false;

		// Show heading?
		if ( $args['location'] == 'header_posts' ) {
			if ( meridian_recipes_get_theme_mod( 'featured_post_heading_state', 'enabled' ) == 'enabled' ) { $show_heading = true; }
		} elseif( $args['location'] == 'footer_posts' ) {
			if ( meridian_recipes_get_theme_mod( 'popular_post_heading_state', 'enabled' ) == 'enabled' ) { $show_heading = true; }
		}

		// Show date?
		if ( $args['location'] == 'header_posts' ) {
			if ( meridian_recipes_get_theme_mod( 'featured_post_date_state', 'enabled' ) == 'enabled' ) { $show_date = true; }
		} elseif( $args['location'] == 'footer_posts' ) {
			if ( meridian_recipes_get_theme_mod( 'popular_post_date_state', 'enabled' ) == 'enabled' ) { $show_date = true; }
		}

		// Show title?
		if ( $args['location'] == 'header_posts' ) {
			if ( meridian_recipes_get_theme_mod( 'featured_post_title_state', 'enabled' ) == 'enabled' ) { $show_title = true; }
		} elseif( $args['location'] == 'footer_posts' ) {
			if ( meridian_recipes_get_theme_mod( 'popular_post_title_state', 'enabled' ) == 'enabled' ) { $show_title = true; }
		}

		// Show comments?
		if ( $args['location'] == 'header_posts' ) {
			if ( meridian_recipes_get_theme_mod( 'featured_post_comments_state', 'enabled' ) == 'enabled' ) { $show_comments = true; }
		} elseif( $args['location'] == 'footer_posts' ) {
			if ( meridian_recipes_get_theme_mod( 'popular_post_comments_state', 'enabled' ) == 'enabled' ) { $show_comments = true; }
		}
		

		?>

		<?php if ( $meridian_recipes_query->have_posts() ) : ?>

			<?php if ( isset( $args['heading_title'] ) && $show_heading ) : ?>
				<div class="wrapper">
					<div class="section-heading">
						<h2><?php echo esc_html( $args['heading_title'] ); ?></h2>
						<span class="section-heading-line"></span>
					</div><!-- .section-heading -->
				</div><!-- .wrapper -->
			<?php endif; ?>

			<div class="carousel-container blog-posts-alt clearfix">

				<div class="wrapper">

					<div class="carousel">

						<?php while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post(); $count++; $real_count++; ?>

							<?php

								// Last col in row?
								$post_class_append = '';
								if ( $count == 3 ) {
									$post_class_append = 'col-last ';
									$count = 0;
								}

							?>
						
							<div <?php post_class( $post_class . $post_class_append ); ?>>

								<?php if ( has_post_thumbnail() ) : ?>
									<div class="blog-post-alt-thumb">
											
										<?php
											$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
											$thumb_url = $thumb_url[0];
											$res_img = meridian_recipes_aq_resize( $thumb_url, 600, 400, true );
											$img_alt = meridian_recipes_get_attachment_alt( get_post_thumbnail_id() );
										?>

										<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $res_img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" /></a>

									</div><!-- .blog-post-alt-thumb -->
								<?php endif; ?>

								<div class="blog-post-alt-main">

									<?php if ( $show_date ) : ?>

										<div class="blog-post-alt-meta">
											<?php 
												the_time( get_option( 'date_format' ) );
												echo ' ';
												esc_html_e( 'by', 'meridian-recipes'); 
												echo ' ';
												the_author_posts_link(); 
											?>
										</div><!-- .blog-post-alt-meta -->

									<?php endif; ?>

									<?php if ( $show_title ) : ?>

										<div class="blog-post-alt-title">
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										</div><!-- .blog-post-alt-title -->

									<?php endif; ?>

									<?php if ( $show_comments ) : ?>

										<div class="blog-post-alt-comments-count">
											<a href="<?php comments_link(); ?>"><span class="fa fa-comments"></span><?php comments_number( esc_html__( 'No comments', 'meridian-recipes' ), esc_html__( 'One comment', 'meridian-recipes' ), esc_html__( '% comments', 'meridian-recipes' ) ); ?></a>
										</div><!-- .blog-post-alt-comments-count -->

									<?php endif; ?>

								</div><!-- .blog-post-alt-main -->

							</div><!-- .blog-post-alt -->

						<?php endwhile; ?>

					</div><!-- .carousel -->

					<div class="carousel-go-prev"></div>
					<div class="carousel-go-next"></div>

				</div><!-- .wrapper -->

			</div><!-- .blog-posts-listing-alt -->

		<?php else :  ?>

			<?php // Nadda ?>

		<?php endif; ?>

		<?php

		wp_reset_postdata();

	}

endif; // End if meridian_recipes_posts_alternate exists

if ( ! function_exists( 'meridian_themes_comment_layout' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * @since 1.0
	 */
	function meridian_themes_comment_layout( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		
		switch ( $comment->comment_type ) :
			
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="comments-pingback">
					<p><?php esc_html_e( 'Pingback:', 'meridian-recipes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'meridian-recipes' ), ' ' ); ?></p>
				<?php
			break;
			default :

				if ( $comment->comment_approved == '1' ) :

					?>

					<li <?php comment_class( 'comment' ); ?> id="comment-<?php comment_ID(); ?>">

						<div class="comment-inner">

							<span class="comment-author-avatar"><?php echo get_avatar( $comment, 60 ); ?></span>

							<div class="comment-info clearfix">

								<ul class="comment-meta clearfix">
									<li class="comment-meta-author"><?php echo get_comment_author_link(); ?></li>
									<li class="comment-meta-date"><?php echo get_comment_date(); ?></li>
								</ul>

								<span class="comment-reply">
									<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
								</span>

							</div><!-- .comment-info -->

							<div class="comment-main clearfix">
								
								<?php if ( $comment->comment_approved == '0' ) : ?>
									<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'meridian-recipes' ); ?></em></p>
								<?php endif; ?>
								<?php comment_text(); ?>

							</div><!-- .comment-main -->

						</div><!-- .comment-inner -->

					<?php

				endif;

				break;
		endswitch;

	}

endif; // End if meridian_themes_comment_layout

if ( ! function_exists( 'meridian_recipes_mobile_nav' ) ) :

	/**
	 * Handles output of mobile nav
	 *
	 * @since 1.0
	 */
	function meridian_recipes_mobile_nav() {

		$mobile_nav_output = '';
		if( has_nav_menu('primary') ) {
			
			$locations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object($locations['primary']);
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			$mobile_nav_output = '';
			
			?>

			<select>
				<option><?php esc_html_e( '- Select Page -', 'meridian-recipes' ); ?></option>
				<?php foreach ( $menu_items as $key => $menu_item ) : ?>
					<?php
						$title = $menu_item->title;
						$url = $menu_item->url;
						$nav_selected = '';
						//if($menu_item->object_id == get_the_ID()){ $nav_selected = 'selected="selected"'; }
					?>
					<?php if($menu_item->post_parent !== 0) : ?>
						<option value="<?php echo esc_url( $url ); ?>"> - <?php echo esc_html( $title ); ?></option>
					<?php else : ?>
						<option value="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
			<?php

		}

	}

endif; // End if meridian_recipes_mobile_nav

/**
 * Displays rating of a recipe
 *
 * @since 1.0
 */
function meridian_recipes_display_rating( $recipeID = false ) {

	if ( ! $recipeID )
		$recipeID = get_the_ID();

	$user_rated = false;

	// Get ratings
	$ratings = array();
	if ( get_post_meta( $recipeID, 'meridian_recipes_ratings', true ) ) {
		$ratings = get_post_meta( $recipeID, 'meridian_recipes_ratings', true );
	}

	// Get average rating
	$average_rating = false;
	if ( get_post_meta( $recipeID, 'meridian_recipes_rating', true ) ) {
		$average_rating = get_post_meta( $recipeID, 'meridian_recipes_rating', true );
	}

	?>
	<div class="recipe-post-single-meta-item recipe-post-single-rating" data-post-id="<?php echo esc_attr( $recipeID ); ?>">
		
		<?php if ( $average_rating ) : ?>
			
			<?php 
				// loop 1 to 5
				for ( $i = 1; $i <= 5; $i++ ) {

					// if rating bigger than or equal i
					if ( $i <= $average_rating ) {
						?><span class="fa fa-star"></span><?php

					// if rating less than i
					} else {

						// if rating 0.5
						if ( ( $average_rating - $i + 1 ) == 0.5 ) {
							?><span class="fa fa-star-half-o"></span><?php

						// if rating 0
						} else {
							?><span class="fa fa-star-o"></span><?php
						}

					}

				}
			?>

			<span class="recipe-post-meta-item-text"><?php echo esc_html( $average_rating ); ?>/5</span>

		<?php else : ?>
			<span class="recipe-post-meta-item-text"><?php esc_html_e( 'No Ratings Yet', 'meridian-recipes' ); ?></span>
		<?php endif; ?>

	</div><!-- .recipe-post-single-rating -->
	<?php

}

function meridian_recipes_section_title( $title = false, $prepend = false, $url = false ) {

	if ( $url ) : 
		?><h2 class="section-title" data-mtst-selector=".section-title a" data-mtst-label="Section Title"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a></h2><?php
	else : 
		?><h2 class="section-title" data-mtst-selector=".section-title span" data-mtst-label="Section Title"><span><?php if ( $prepend ) : ?><small class="no-caps"><?php echo esc_html( $prepend ); ?></small> <?php endif; ?><?php echo esc_html( $title ); ?></span></h2><?php
	endif;

}

/**
 * meridian_recipes_admin_logo
 *
 * @since 1.0
 */
function meridian_recipes_admin_logo() {

	// user defined logo image
	$logo_img_src = meridian_recipes_get_theme_mod( 'logo_admin', false );
	if ( $logo_img_src ) : 
		?>
			<style type="text/css">
				#login h1 a, .login h1 a {
					background-image: url(<?php echo $logo_img_src; ?>);
					margin-left: 0;
					margin-right: 0;
					background-size: contain;
					width: 100%;
				}
			</style>
		<?php 
	endif; 
} add_action( 'login_enqueue_scripts', 'meridian_recipes_admin_logo' );