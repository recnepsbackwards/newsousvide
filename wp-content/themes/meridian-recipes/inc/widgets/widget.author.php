<?php

// Register Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "meridian_recipes_about_author_widget" );' ) );

// Widget Class
class Meridian_Recipes_About_Author_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_recipes_about_author_widget', // Base ID
			esc_html__( 'MeridianThemes - About Author', 'meridian-recipes' ), // Name
			array( 'description' => esc_html__( 'Show info about the author.', 'meridian-recipes' ) ) // Args
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
		$author_image = $instance['author_image'];
		$signature_image = $instance['signature_image'];
		$name = $instance['name'];
		$text = $instance['text'];

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		?>

			<div class="about-author-widget" data-mtst-selector=".about-author-widget" data-mtst-label="About Author" data-mtst-no-support="typography">

				<?php if ( $author_image !== '' ) : ?>
					<div class="about-author-image"><img src="<?php echo esc_attr( $author_image ); ?>" alt="<?php echo esc_html( $name ); ?>" /></div>
				<?php endif; ?>
				<div class="about-author-widget-info">
					<h2 class="about-author-widget-name" data-mtst-selector=".about-author-widget-name" data-mtst-label="About Author - Name" data-mtst-no-support="background,borders"><?php echo esc_html( $name ); ?></h2>
					<div class="about-author-widget-text" data-mtst-selector=".about-author-widget-text" data-mtst-label="About Author - Text" data-mtst-no-support="background,borders"><?php echo esc_html( $text ); ?></div>
				</div><!-- .about-author-widget-info -->
				<?php if ( $signature_image !== '' ) : ?>
					<div class="about-author-signature-image"><img src="<?php echo esc_attr( $signature_image ); ?>" alt="<?php echo esc_html( $name ); ?>" /></div>
				<?php endif; ?>

			</div><!-- .about-author-widget -->

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
			
		$instance['author_image'] = strip_tags( $new_instance['author_image'] );
		$instance['signature_image'] = strip_tags( $new_instance['signature_image'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['text'] = strip_tags( $new_instance['text'] );

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
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'About Me';
		if ( isset( $instance[ 'author_image' ] ) ) $author_image = $instance[ 'author_image' ]; else $author_image = '';
		if ( isset( $instance[ 'signature_image' ] ) ) $signature_image = $instance[ 'signature_image' ]; else $signature_image = '';
		if ( isset( $instance[ 'name' ] ) ) $name = $instance[ 'name' ]; else $name = 'I\'m Susanna, I blog about fashion.';
		if ( isset( $instance[ 'text' ] ) ) $text = $instance[ 'text' ]; else $text = 'This season, the American designer will showcase a series of historic objects from the New York museum\'s.';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'author_image' ) ); ?>"><?php esc_html_e( 'Author Image URL:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'author_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'author_image' ) ); ?>" type="text" value="<?php echo esc_attr( $author_image ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Heading Title:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Content:', 'meridian-recipes' ); ?></label> 
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_html( $text ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'signature_image' ) ); ?>"><?php esc_html_e( 'Signature Image URL:', 'meridian-recipes' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'signature_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'signature_image' ) ); ?>" type="text" value="<?php echo esc_attr( $signature_image ); ?>" />
		</p>
		

		<?php 

	}

}