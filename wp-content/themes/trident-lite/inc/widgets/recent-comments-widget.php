<?php
/***** Trident Recent Comments *****/
class trident_recent_comments extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'trident_recent_comments', 

		// Widget name will appear in UI
		__('Trident Recent Comments', 'trident'), 

		// Widget description
		array( 'description' => __( 'Shows your site\'s most recent comments.', 'trident' ), ) 
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		global $post, $comments, $comment;
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Comments', 'trident' ) : $instance['title'] );
		$number = empty( $instance['number'] ) ? 4 : $instance['number'];
		
		echo $args['before_widget'];
		
			echo $args['before_title'] . $title . $args['after_title'];

			$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'type' => 'comment' ) ) );
			
			if ( $comments ) {
				$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
				_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );
				
				foreach ( (array) $comments as $comment) { ?>
					<div class="trident-recent-comments">
						<?php echo get_avatar($comment->comment_author_email, 78); ?>
						<div class="trident-comment">
							<?php echo get_comment_author_link(); ?> on
							<a href="<?php echo get_comment_link($comment->comment_ID); ?>"><?php echo $comment->post_title; ?></a>
						</div>
						<div class="clearfix"></div>
					</div>	
					<?php
				}
			}
			
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
	
		$title = empty( $instance['title'] ) ? __( 'Recent Comments', 'trident' ) : $instance['title'];
		$number = empty( $instance['number'] ) ? 4 : $instance['number'];
	
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'trident' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:', 'trident' ); ?></label>
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
} // Class trident_recent_comments ends here
?>