<?php

// get section info
$section_info = meridian_recipes_get_section_info();

?>
<div class="module-wrapper">

	<div class="module-search-wrapper module-search-style-<?php echo esc_attr( $section_info['search_style'] ); ?>" <?php if ( $section_info['search_style'] == 'full_width' && isset( $section_info['search_bg_image'] ) ) : ?>style="background-image:url('<?php echo esc_attr( $section_info['search_bg_image'] ); ?>')"<?php endif; ?>>

		<?php if ( $section_info['search_style'] == 'full_width' ) : ?>
			<div class="module-search-overlay"></div>
		<?php endif; ?>

		<div class="wrapper">

			<div class="module-search clearfix" <?php if ( $section_info['search_style'] == 'wrapped' && isset( $section_info['search_bg_image'] ) ) : ?>style="background-image:url('<?php echo esc_attr( $section_info['search_bg_image'] ); ?>')"<?php endif; ?>>

				<?php if ( $section_info['search_style'] == 'wrapped' ) : ?>
					<div class="module-search-overlay"></div>
				<?php endif; ?>

				<div class="module-search-main">
					
					<?php if ( isset( $section_info['search_title'] ) ) : ?>
						<div class="module-search-col-1">
							<?php echo do_shortcode( $section_info['search_title'] ); ?>
						</div><!-- .module-search-col-1 -->	
					<?php endif; ?>

					<div class="module-search-col-2">
						<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" name="s" placeholder="<?php esc_html_e( 'Enter Keywords...', 'meridian-recipes' ); ?>" />
							<input type="submit" value="<?php esc_html_e( 'Search', 'meridian-recipes' ); ?>" />
						</form>
					</div><!-- .module-search-col-2 -->

					<div class="module-search-col-3">
						<strong><?php esc_html_e( 'Popular Categories', 'meridian-recipes' ); ?></strong>
						<?php

							$taxonomy = 'mrdt_recipes_cats';
							if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'disabled' ) {
								$taxonomy = 'category';
							}

							$terms = get_terms( $taxonomy, array( 'order' => 'DESC', 'number' => 4, 'orderby' => 'count' ) );
							foreach ( $terms as $term ) {
								?><a href="<?php echo get_term_link( $term, $taxonomy ); ?>"><?php echo esc_html( $term->name ); ?></a><?php
							}
						?>
					</div><!-- .module-search-col-3 -->

				</div><!-- .module-search-main -->

			</div><!-- .module-search -->

		</div><!-- .wrapper -->

	</div><!-- .module-search-wrapper -->

</div><!-- .module-wrapper -->
