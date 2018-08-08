<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package trident
 */
?>

		</div><!-- .row -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row-fluid" id="footer-body">
				<div id="footer-widgets">

					<div id="footer-widget1">
					<?php if ( !dynamic_sidebar('footer-1') ) : ?>
					<?php endif; ?>
					</div>

					<div id="footer-widget2">
					<?php if ( !dynamic_sidebar('footer-2') ) : ?>
					<?php endif; ?>
					</div>

					<div id="footer-widget3">
					<?php if ( !dynamic_sidebar('footer-3') ) : ?>
					<?php endif; ?>
					</div>

				</div><!-- #footer-widget1 -->
			</div>
		</div><!-- .container -->
		<div id="footer-bottom">
			<div class="container">
				<div class="site-info">
					<?php if ( get_theme_mod( 'trident_footer_text' ) ) : ?>
						<?php echo esc_html( get_theme_mod( 'trident_footer_text' ) ); ?>
					<?php else : ?>
						<?php _e( 'Copyright &copy; 2014 <a href="http://themes.qlue.co">Qlue Themes</a>', 'trident' ); ?>						
					<?php endif; ?>
				</div>
				<div class="footer-nav">
					<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- #footer-bottom -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>