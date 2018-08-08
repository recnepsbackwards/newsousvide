<?php
/**
 * The Home Page Template
 *
 * @package trident
 */

get_header(); ?>

	<?php 		
		// Getting features posts status from database
		$trident_enable_featured_posts = ot_get_option('trident_enable_featured_posts');
		$trident_featured_posts_category = ot_get_option('trident_featured_posts_category');
		
		// Chekcs if featured posts is enabled from theme options
		if( isset( $trident_enable_featured_posts ) && 'on' == $trident_enable_featured_posts ) :
			if( isset( $trident_featured_posts_category ) ){
				$featured_cat = $trident_featured_posts_category;
			} else {
				$featured_posts_category_id = get_cat_ID('Uncategorized');
				$featured_cat = $featured_posts_category_id;
			}
	?>

	<?php 	
	$featuredPosts = get_posts(array( 'post_type' => 'post', 'category' => $featured_cat, 'meta_key' => '_thumbnail_id', 'posts_per_page' => 3, 'ignore_sticky_posts' => 1 ));
	if($featuredPosts && count($featuredPosts) > 2) {
	?>

	<div id="featured-posts-wrap">
		<div class="featured-post" id="featured-post-big">
			<a href="<?php echo esc_url( get_permalink( $featuredPosts[0]->ID ) ); ?>">
				<?php echo get_the_post_thumbnail( $featuredPosts[0]->ID ); ?>
			</a>
			<div class="feature_text">
				<?php $category = get_the_category($featuredPosts[0]->ID); ?>
				<span class="category">
					<a href="<?php echo get_category_link($category[0]->term_id ); ?>"><?php echo $category[0]->cat_name; ?></a>
				</span>
				<h2 class="entry-title">
					<a href="<?php echo esc_url( get_permalink( $featuredPosts[0]->ID ) ); ?>" rel="bookmark"><?php echo $featuredPosts[0]->post_title; ?></a>
				</h2>
			</div>
			<a href="<?php echo esc_url( get_permalink( $featuredPosts[0]->ID ) ); ?>" rel="bookmark">
				<div class="feature_overlay"></div>
			</a>
		</div>
		<div id="featured-posts-grid">
			<div class="featured-post-small featured-post">
				<a href="<?php echo esc_url( get_permalink( $featuredPosts[1]->ID ) ); ?>">
					<?php echo get_the_post_thumbnail( $featuredPosts[1]->ID ); ?>
				</a>
				<div class="feature_text">
					<?php $category = get_the_category($featuredPosts[1]->ID); ?>
					<span class="category">
						<a href="<?php echo get_category_link($category[0]->term_id ); ?>"><?php echo $category[0]->cat_name; ?></a>
					</span>
					<h2 class="entry-title">
						<a href="<?php echo esc_url( get_permalink( $featuredPosts[1]->ID ) ); ?>" rel="bookmark"><?php echo $featuredPosts[1]->post_title; ?></a>
					</h6>
				</div>
				<a href="<?php echo esc_url( get_permalink( $featuredPosts[1]->ID ) ); ?>" rel="bookmark">
					<div class="feature_overlay"></div>
				</a>
			</div>
			<div class="featured-post-small last featured-post">
				<a href="<?php echo esc_url( get_permalink( $featuredPosts[2]->ID ) ); ?>">
					<?php echo get_the_post_thumbnail( $featuredPosts[2]->ID ); ?>
				</a>
				<div class="feature_text">
					<?php $category = get_the_category($featuredPosts[2]->ID); ?>
					<span class="category">
						<a href="<?php echo get_category_link($category[0]->term_id ); ?>"><?php echo $category[0]->cat_name; ?></a>
					</span>
					<h2 class="entry-title">
						<a href="<?php echo esc_url( get_permalink( $featuredPosts[2]->ID ) ); ?>" rel="bookmark"><?php echo $featuredPosts[2]->post_title; ?></a>
					</h6>
				</div>
				<a href="<?php echo esc_url( get_permalink( $featuredPosts[2]->ID ) ); ?>" rel="bookmark">
					<div class="feature_overlay"></div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php } ?>


<?php endif; // featured posts checker if ends here ?>

	<div id="primary" class="content-area col-sm-8">
		<main id="home-main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
			<?php global $post; ?>
			<div <?php post_class('article-box'); ?>>
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="thumbnail-wrap">
					<div class="post_category fixed">
						<?php 
							$category_list = explode(', ', (get_the_category_list( __( ', ', 'trident' )) ));
							echo $category_list[0];
						?>
					</div>
					<div class="entry-image">					
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
				</div>
				
				<?php } ?>
				<header class="entry-header">
					<h6 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php echo trident_shorten_title( get_the_title() ); ?>
						</a>
					</h6>

					<div class="entry-meta">
						<?php trident_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php echo trident_shorten_excerpt( get_the_excerpt() ); ?>
				</div><!-- .entry-content -->
			</div>

			<?php endwhile; ?>
			
			<div class="clearfix"></div>

			<?php trident_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>