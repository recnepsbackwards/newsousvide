<?php
/***** Trident Recent Posts *****/
class trident_recent_posts extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'trident_recent_posts', 

		// Widget name will appear in UI
		__('Trident Recent Posts', 'trident'), 

		// Widget description
		array( 'description' => __( 'Shows your site\'s most recent posts.', 'trident' ), ) 
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		global $post;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Posts', 'trident' ) : $instance['title'] );
		$number = empty( $instance['number'] ) ? 4 : $instance['number'];
		
		echo $args['before_widget'];
		
			if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

			$query = new WP_Query();
			$query->query( array( 'post_type' => 'post', 'posts_per_page' => $number, 'ignore_sticky_posts' => 1 ) ); 
			$count = 1; ?>
			
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>		
				<div class="trident-recent-posts">
					<?php $url = esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ); ?>
					<div class="trident-recent-posts-thumbnail">
						<a href="<?php echo esc_html( esc_url ( get_permalink() ) ); ?>">
							<img src="<?php echo esc_url( $url ); ?>"  alt="Thumbnail" />
							<span class="post-number"><?php echo $count++; ?></span>
						</a>
					</div>
					<div class="trident-post">
						<a href="<?php echo esc_html( esc_url( get_permalink() ) ); ?>"><?php the_title(); ?></a>
						<p><?php echo get_the_date( ); ?></p>
					</div>
					<div class="clearfix"></div>
				</div>							
			<?php  endwhile; wp_reset_postdata(); endif; 
		
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {	
		$title = empty( $instance['title'] ) ? __( 'Recent Posts', 'trident' ) : $instance['title'];
		$number = empty( $instance['number'] ) ? 4 : $instance['number'];
	
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'trident' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'trident' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr( $number ); ?>" size="3">
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
		return $instance;
	}
} // Class trident_recent_posts ends here
?>