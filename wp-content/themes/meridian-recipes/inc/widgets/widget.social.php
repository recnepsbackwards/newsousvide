<?php

// Register Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "meridian_recipes_social_widget" );' ) );

// Widget Class
class Meridian_Recipes_Social_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_recipes_social_widget', // Base ID
			esc_html__( 'MeridianThemes - Social', 'meridian-recipes' ), // Name
			array( 'description' => esc_html__( 'Show social links.', 'meridian-recipes' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		?>

			<div class="social-widget">

				<?php if ( meridian_recipes_get_theme_mod( 'social_twitter', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-twitter" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_twitter', false ) ); ?>" target="_blank"><span class="fa fa-twitter"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_facebook', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-facebook" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_facebook', false ) ); ?>" target="_blank"><span class="fa fa-facebook"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_youtube', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-youtube" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_youtube', false ) ); ?>" target="_blank"><span class="fa fa-youtube-play"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_vimeo', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-vimeo" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_vimeo', false ) ); ?>" target="_blank"><span class="fa fa-vimeo"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_tumblr', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-tumblr" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_tumblr', false ) ); ?>" target="_blank"><span class="fa fa-tumblr"></span></a>					
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_pinterest', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-pinterest" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_pinterest', false ) ); ?>" target="_blank"><span class="fa fa-pinterest"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_linkedin', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-linkedin" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_linkedin', false ) ); ?>" target="_blank"><span class="fa fa-linkedin"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_instagram', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-instagram" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_instagram', false ) ); ?>" target="_blank"><span class="fa fa-instagram"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_github', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-github" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_github', false ) ); ?>" target="_blank"><span class="fa fa-github"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_googleplus', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-googleplus" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_googleplus', false ) ); ?>" target="_blank"><span class="fa fa-googleplus"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_dribbble', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-dribbble" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_dribbble', false ) ); ?>" target="_blank"><span class="fa fa-dribbble"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_dropbox', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-dropbox" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_dropbox', false ) ); ?>" target="_blank"><span class="fa fa-dropbox"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_flickr', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-flickr" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_flickr', false ) ); ?>" target="_blank"><span class="fa fa-flickr"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_foursquare', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-foursquare" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_foursquare', false ) ); ?>" target="_blank"><span class="fa fa-foursquare"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_behance', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-behance" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_behance', false ) ); ?>" target="_blank"><span class="fa fa-behance"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_vine', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-vine" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_vine', false ) ); ?>" target="_blank"><span class="fa fa-vine"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'social_rss', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-rss" href="<?php echo esc_attr( meridian_recipes_get_theme_mod( 'social_rss', false ) ); ?>" target="_blank"><span class="fa fa-rss"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>

			</div><!-- .subscribe-widget -->

		<?php

		/* End - Widget Content */

		echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Get values
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Social Profiles';
		

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<?php esc_html_e( 'The URLs to the social profiles are set in WP admin &rarr; Appearance &rarr; Customize &rarr; Social', 'meridian-recipes' ); ?>
		</p>

		<?php 

	}

}