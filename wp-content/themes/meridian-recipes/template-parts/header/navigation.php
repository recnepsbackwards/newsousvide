<nav id="navigation" data-mtst-selector="#navigation .menu > li > a" data-mtst-label="Navigation Items" data-mtst-no-support="background,border">
	<div class="wrapper clearfix">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'fallback_cb' => false ) ); ?>
	</div><!-- .wrapper -->
</nav><!-- #navigation -->

<div id="mobile-navigation">
	<span class="header-mobile-nav-hook"><span class="fa fa-reorder"></span><?php esc_html_e( 'Navigation', 'meridian-recipes' ); ?><?php meridian_recipes_mobile_nav(); ?></span>
</div><!-- #mobile-navigation -->