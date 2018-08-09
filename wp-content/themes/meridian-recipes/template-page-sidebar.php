<?php
/**
 * Template Name: Page with sidebar
 */
?>
<?php get_header(); ?>

<div class="wrapper clearfix">

	<section id="content" class="col col-8">

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

	<?php get_sidebar(); ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>