<?php get_header(); ?>
	
	<div class="wrapper clearfix">

		<?php global $post; if ( '' !== $post->post_content ) : ?>

			<section id="content">

				<?php meridian_recipes_section_title( get_the_title() ); ?>

				<?php

					// Loop posts
					while ( have_posts() ) : the_post();

						// Output from template
						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

					endwhile;
				?>			

			</section><!-- #content -->

		<?php endif; ?>

	</div><!-- .wrapper -->

<?php get_footer();
