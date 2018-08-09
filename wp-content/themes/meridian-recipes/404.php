<?php get_header(); ?>
	
	<div class="wrapper clearfix">
	
		<section id="content" class="col col-8">

			<h2><?php esc_html_e( 'Sorry, Nothing Found!', 'meridian-recipes' ); ?></h2>
			<p><?php esc_html_e( 'The page you were looking for could not be found. Maybe try the search form below.', 'meridian-recipes' ); ?></p>
			<?php get_search_form(); ?>

		</section><!-- #content -->

		<?php get_sidebar(); ?>

	</div><!-- .wrapper -->

<?php get_footer();
