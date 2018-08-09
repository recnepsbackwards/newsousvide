<div class="side-panel">

	<div class="side-panel-inner">

		<div class="side-panel-left">
			<?php wp_nav_menu( array( 'theme_location' => 'side-panel', 'menu_id' => 'side-panel-menu', 'fallback_cb' => false ) ); ?>
		</div><!-- .side-panel-left -->

		<div class="side-panel-right">
			<?php echo get_bloginfo( 'name' ); ?>
		</div><!-- .side-panel-right -->

	</div><!-- .sideb-panel-inner -->

</div><!-- .side-panel -->