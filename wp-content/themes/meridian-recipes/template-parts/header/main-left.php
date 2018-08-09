<div id="header-left">
	<?php if ( meridian_recipes_get_theme_mod( 'header_search_state', 'enabled' ) == 'enabled' ) : ?>
		<div class="header-search">
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="text" class="header-search-input" name="s" value="" placeholder="<?php esc_html_e( 'Search the site', 'meridian-recipes' ); ?>" data-mtst-selector='.header-search input.header-search-input' data-mtst-label="Header Search Input" />
			</form>
			<span class="header-search-icon" data-mtst-selector=".header-search-icon" data-mtst-label="Header Search Icon" data-mtst-no-support="background,spacing,border"><span class="fa fa-search"></span></span>
		</div><!-- .header-search -->
	<?php endif; ?>
</div><!-- #header-left -->