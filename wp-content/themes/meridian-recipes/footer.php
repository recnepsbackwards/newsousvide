			<?php

				// if page has sections
				if ( is_singular( 'page' ) && meridian_recipes_has_page_sections() ) {

					// get page sections
					$sections = meridian_recipes_get_page_sections();

					// loop page sections
					foreach( $sections as $section ) {

						// set section info
						meridian_recipes_set_section_info( $section );

						// call the template
						get_template_part( 'template-parts/home/' . $section['section'] );

					}

				}

			?>

		</div><!-- #main -->
		
		<?php get_template_part( 'template-parts/footer/posts' ); ?>

		<footer id="footer" class="site-footer">

			<?php get_template_part( 'template-parts/footer/widgets' ); ?>

			<?php get_template_part( 'template-parts/footer/bottom' ); ?>

		</footer><!-- #footer -->

	</div><!-- #page -->

	<?php get_template_part( 'template-parts/other/side-panel' ); ?>

	<?php get_template_part( 'template-parts/other/cookmode' ); ?>

	<?php get_template_part( 'template-parts/other/share' ); ?>

	<?php wp_footer(); ?>

</body>
</html>
