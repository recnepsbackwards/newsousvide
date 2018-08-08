<?php
/**
 * The Template for displaying all single posts.
 *
 * @package trident
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-8">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php trident_post_nav(); ?>

			<div id="author-title">
				<h3>
					<?php _e( 'About ', 'trident' );
						echo get_the_author(); ?>
				</h3>
			</div>
			<div id="authorbio">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>			
				</div>
				<div class="authorinfo">					
					<?php the_author_meta( 'description' ); ?>			
				</div>
				<div class="clearfix"></div>
			</div>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>