<?php

// Register Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "meridian_recipes_search_widget" );' ) );

// Widget Class
class Meridian_Recipes_Search_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_recipes_search_widget', // Base ID
			esc_html__( 'MeridianThemes - Search', 'meridian-recipes' ), // Name
			array( 'description' => esc_html__( 'Show search form.', 'meridian-recipes' ) ) // Args
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

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		?>

			<div class="search-widget" <?php if ( $bg_image != '' ) echo 'style="background-image:url(' . $bg_image . ');"'; ?>>

				<div class="search-widget-inner">

					<h4 class="search-widget-heading"><?php echo do_shortcode( $heading_primary ); ?></h4>

					<div class="search-widget-form">
						<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" name="s" placeholder="<?php esc_html_e( 'Enter Keywords...', 'meridian-recipes' ); ?>" />
							<input type="submit" value="<?php esc_html_e( 'Search', 'meridian-recipes' ); ?>" />
						</form>
					</div><!-- .search-widget-form -->

					<div class="search-widget-categories">
						
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

					</div><!-- .search-widget-categories -->

				</div><!-- .search-widget-inner -->

			</div><!-- .search-widget -->

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
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Search The Website';
		if ( isset( $instance[ 'bg_image' ] ) ) $bg_image = $instance[ 'bg_image' ]; else $bg_image = '';
		if ( isset( $instance[ 'heading_primary' ] ) ) $heading_primary = $instance[ 'heading_primary' ]; else $heading_primary = 'Don\'t Know What To Cook? Search The Website.';
		

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

		<?php 

	}

}