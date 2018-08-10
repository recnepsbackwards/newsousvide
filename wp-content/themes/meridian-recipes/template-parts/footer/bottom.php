<?php if ( meridian_recipes_get_theme_mod( 'footer_bottom_state', 'enabled' ) == 'enabled' ) : ?>

	<div id="footer-bottom" data-mtst-selector="#footer-bottom" data-mtst-label="Footer Bottom" data-mtst-no-support="typography,border">
		
		<div class="wrapper clearfix">
				
			<div id="footer-copyright" data-mtst-selector="#footer-copyright" data-mtst-label="Footer Copyright" data-mtst-no-support="background,border,spacing">
				<?php echo meridian_recipes_get_theme_mod( 'footer_copy_text', 'Designed &amp; Developed by <a href="http://meridianthemes.net/" rel="nofollow">MeridianThemes</a>' ); ?>
			</div><!-- #footer-copyright -->

			<div id="footer-navigation" data-mtst-selector="#footer-navigation li a" data-mtst-label="Footer Copyright" data-mtst-no-support="background,border,spacing">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'fallback_cb' => false ) ); ?>
			</div><!-- #footer-navigation -->

		</div><!-- .wrapper -->

	</div><!-- #footer-bottom -->

<?php endif; ?>