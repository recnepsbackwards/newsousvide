<?php get_header(); ?>
		
	<?php

		// has sidebar?
		$has_sidebar = true;
		if ( meridian_recipes_get_post_meta( get_the_ID(), 'post_layout' ) == 'full_width' ) {
			$has_sidebar = false;
		}

	?>

	<div class="wrapper clearfix">

		<section id="content" class="<?php if ( $has_sidebar ) echo 'col col-8'; ?> single-content">

			<?php

				// Loop posts
				while ( have_posts() ) : the_post();

					// Output content
					get_template_part( 'template-parts/content-single', get_post_format() );

					// related posts
					get_template_part( 'template-parts/main/related-posts' );

					// Output about author
					get_template_part( 'template-parts/main/about-author' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

				endwhile;
			?>

		</section><!-- #content -->

		<?php if ( $has_sidebar ) get_sidebar(); ?>

	</div><!-- .wrapper -->

<?php get_footer();
