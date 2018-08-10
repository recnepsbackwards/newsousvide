<?php

// Register Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "meridian_recipes_subscribe_widget" );' ) );

// Widget Class
class Meridian_Recipes_Subscribe_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_recipes_subscribe_widget', // Base ID
			esc_html__( 'MeridianThemes - Subscribe', 'meridian-recipes' ), // Name
			array( 'description' => esc_html__( 'Show subscription form.', 'meridian-recipes' ) ) // Args
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
		
		// Options
		$bg_image = $instance['bg_image'];
		$heading_primary = $instance['heading_primary'];
		$heading_secondary = $instance['heading_secondary'];
		$subscribe_id = $instance['subscribe_id'];
		$subscribe_shortcode = $instance['subscribe_shortcode'];

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		?>

			<div class="subscribe-widget" <?php if ( $bg_image != '' ) echo 'style="background-image:url(' . $bg_image . ');"'; ?> data-mtst-selector=".subscribe-widget" data-mtst-label="Subscribe" data-mtst-no-support="typography">

				<div class="subscribe-widget-inner" data-mtst-selector=".subscribe-widget-inner" data-mtst-label="Subscribe Inner" data-mtst-no-support="typography">

					<h4 data-mtst-selector=".subscribe-widget h4" data-mtst-label="Subscribe Title" data-mtst-no-support="background,border"><?php echo esc_html( $heading_primary ); ?></h4>

					<div class="subscribe-widget-form">
						<?php if ( ! empty( $subscribe_shortcode ) && $subscribe_shortcode == '' ) : ?>
							<?php echo do_shortcode( $subscribe_shortcode ); ?>
						<?php else : ?>
							<?php echo do_shortcode( '[wysija_form id="' . $subscribe_id . '"]' ); ?>
						<?php endif; ?>
					</div><!-- .subscribe-widget-form -->

					<h5 data-mtst-selector=".subscribe-widget h5" data-mtst-label="Subscribe Subtitle" data-mtst-no-support="background,border"><?php echo esc_html( $heading_secondary ); ?></h5>

				</div><!-- .subscribe-widget-inner -->

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
			
		$instance['bg_image'] = strip_tags( $new_instance['bg_image'] );
		$instance['heading_primary'] = strip_tags( $new_instance['heading_primary'] );
		$instance['heading_secondary'] = strip_tags( $new_instance['heading_secondary'] );
		$instance['subscribe_id'] = strip_tags( $new_instance['subscribe_id'] );
		$instance['subscribe_shortcode'] = strip_tags( $new_instance['subscribe_shortcode'] );
	
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
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Subscribe To The Newsletter';
		if ( isset( $instance[ 'bg_image' ] ) ) $bg_image = $instance[ 'bg_image' ]; else $bg_image = '';
		if ( isset( $instance[ 'heading_primary' ] ) ) $heading_primary = $instance[ 'heading_primary' ]; else $heading_primary = 'Get The Best Recipes  Straight  Into Your Inbox!';
		if ( isset( $instance[ 'heading_secondary' ] ) ) $heading_secondary = $instance[ 'heading_secondary' ]; else $heading_secondary = 'Don\'t Worry, I Don\'t Spam.';
		if ( isset( $instance[ 'subscribe_id' ] ) ) $subscribe_id = $instance[ 'subscribe_id' ]; else $subscribe_id = '1';
		if ( isset( $instance[ 'subscribe_shortcode' ] ) ) $subscribe_shortcode = $instance[ 'subscribe_shortcode' ]; else $subscribe_shortcode = '';
		

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'bg_image' ) ); ?>"><?php esc_html_e( 'BG Image URL:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bg_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bg_image' ) ); ?>" type="text" value="<?php echo esc_attr( $bg_image ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'heading_primary' ) ); ?>"><?php esc_html_e( 'Primary Text:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading_primary' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'heading_primary' ) ); ?>" type="text" value="<?php echo esc_attr( $heading_primary ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'heading_secondary' ) ); ?>"><?php esc_html_e( 'Secondary Text:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading_secondary' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'heading_secondary' ) ); ?>" type="text" value="<?php echo esc_attr( $heading_secondary ); ?>" />
		</p>
		<?php if ( defined( 'WYSIJA' ) ) : ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'subscribe_id' ) ); ?>"><?php esc_html_e( 'Subscribe ID ( mailpoet ):', 'meridian-recipes' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subscribe_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subscribe_id' ) ); ?>" type="text" value="<?php echo esc_attr( $subscribe_id ); ?>" />
			</p>
		<?php endif; ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'subscribe_shortcode' ) ); ?>"><?php esc_html_e( 'Form Shortcode:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subscribe_shortcode' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subscribe_shortcode' ) ); ?>" type="text" value="<?php echo esc_attr( $subscribe_shortcode ); ?>" />
		</p>

		<?php 

	}

}