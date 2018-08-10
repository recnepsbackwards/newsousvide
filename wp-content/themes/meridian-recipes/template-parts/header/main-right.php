<div id="header-right">

	<?php if ( meridian_recipes_get_theme_mod( 'header_social_state', 'enabled' ) == 'enabled' ) : ?>
		<div class="header-social" data-mtst-selector=".header-social a" data-mtst-label="Header Social Links" data-mtst-no-support="border,background">
			<?php if ( meridian_recipes_get_theme_mod( 'social_twitter', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_twitter', false ) ); ?>" target="_blank"><span class="fa fa-twitter"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_facebook', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_facebook', false ) ); ?>" target="_blank"><span class="fa fa-facebook"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_youtube', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_youtube', false ) ); ?>" target="_blank"><span class="fa fa-youtube-play"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_vimeo', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_vimeo', false ) ); ?>" target="_blank"><span class="fa fa-vimeo"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_tumblr', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_tumblr', false ) ); ?>" target="_blank"><span class="fa fa-tumblr"></span></a>					
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_pinterest', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_pinterest', false ) ); ?>" target="_blank"><span class="fa fa-pinterest"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_linkedin', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_linkedin', false ) ); ?>" target="_blank"><span class="fa fa-linkedin"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_instagram', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_instagram', false ) ); ?>" target="_blank"><span class="fa fa-instagram"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_github', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_github', false ) ); ?>" target="_blank"><span class="fa fa-github"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_googleplus', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_googleplus', false ) ); ?>" target="_blank"><span class="fa fa-google-plus"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_dribbble', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_dribbble', false ) ); ?>" target="_blank"><span class="fa fa-dribbble"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_dropbox', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_dropbox', false ) ); ?>" target="_blank"><span class="fa fa-dropbox"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_flickr', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_flickr', false ) ); ?>" target="_blank"><span class="fa fa-flickr"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_foursquare', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_foursquare', false ) ); ?>" target="_blank"><span class="fa fa-foursquare"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_behance', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_behance', false ) ); ?>" target="_blank"><span class="fa fa-behance"></span></a>
			<?php endif; ?>
			<?php if ( meridian_recipes_get_theme_mod( 'social_rss', false ) ) : $has_icons = true; ?>
				<a href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_rss', false ) ); ?>" target="_blank"><span class="fa fa-rss"></span></a>
			<?php endif; ?>
		</div><!-- .header-social -->
	<?php endif; ?>

	<?php if ( meridian_recipes_get_theme_mod( 'header_account_state', 'enabled' ) == 'enabled' ) : ?>
		<div class="header-account" data-mtst-selector=".header-account a" data-mtst-label="Header Links" data-mtst-no-support="background,border">
			<?php if ( is_user_logged_in() ) : ?>
				<?php
					$user_profile_page_id = meridian_recipes_get_page_by_template( 'template-user-profile.php' );
					$user_profile_page_url = '#';
					if ( $user_profile_page_id ) {
						$user_profile_page_url = get_permalink( $user_profile_page_id );
					}
				?>
				<a href="<?php echo esc_url( $user_profile_page_url ); ?>"><?php esc_html_e( 'My Profile', 'meridian-recipes' ); ?></a>
				<span class="header-account-separator"></span>
				<a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php esc_html_e( 'Log Out', 'meridian-recipes' ); ?></a>
			<?php else : ?>
				<a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php esc_html_e( 'Log In', 'meridian-recipes' ); ?></a>
				<span class="header-account-separator"></span>
				<a href="<?php echo wp_registration_url(); ?>"><?php esc_html_e( 'Sign Up', 'meridian-recipes' ); ?></a>
			<?php endif; ?>
		</div><!-- .header-account -->
	<?php endif; ?>

</div><!-- #header-right -->