<?php
/**
 * Table of Contents
 *
 * # Bookmark ( meridian_recipes_ajax_bookmark )
 * # Rate ( meridian_recipes_ajax_rate )
 * # Share ( meridian_recipes_ajax_share )
 */

/**
 * # Bookmark ( meridian_recipes_ajax_bookmark )
 *
 * @since 1.0
 */
function meridian_recipes_ajax_bookmark() {

	// If user logged in
	if ( is_user_logged_in() ) {

		$user_id = get_current_user_id();

		// Response array
		$response = array();		

		// Response default values
		$response['status'] = 'fail';

		// Vars
		$post_id = absint( $_POST['mt_post_id'] );
		$post_type = $_POST['mt_post_type'];

		// If not recipes or blog, something is wrong, stop it
		if ( $post_type != 'mrdt_recipes' && $post_type != 'post' )
			return;

		// The field ID
		if ( $post_type == 'mrdt_recipes' ) {
			$field_id = 'meridian_recipes_bookmarks_recipes';
		} else {
			$field_id = 'meridian_recipes_bookmarks_blog_posts';
		}

		// Get current post meta
		$current_data = get_user_meta( $user_id, $field_id, true );

		// if no data make an empty array
		if ( ! $current_data ) {
			$new_data = array();
		} else {
			$new_data = $current_data;
		}

		// Is it already bookmarked remove it
		if ( in_array( $post_id, $new_data ) ) {
			if ( ( $key = array_search( $post_id, $new_data ) ) !== false ) {
				unset($new_data[$key]);
			}
			$response['action'] = 'remove';
		// otherwise add it
		} else {
			$new_data[] = $post_id;
			$response['action'] = 'add';
		}

		// Update post meta
		if ( update_user_meta( $user_id, $field_id, $new_data ) ) {
			$response['status'] = 'success';
		}

		// Encode response
		$response_json = json_encode( $response );

		// Send response
		header( "Content-Type: application/json" );
		echo $response_json;

	} // Check if user can save

	// Exit
	exit;	

}  add_action( 'wp_ajax_meridian-recipes-ajax-bookmark', 'meridian_recipes_ajax_bookmark' );

/**
 * # Rate ( meridian_recipes_ajax_rate )
 *
 * @since 1.0
 */
function meridian_recipes_ajax_rate() {

	// If user logged in
	if ( is_user_logged_in() ) {

		$user_id = get_current_user_id();

		// Response array
		$response = array();		

		// Response default values
		$response['status'] = 'fail';

		// Vars
		$post_id = absint( $_POST['mt_post_id'] );
		$rating = absint( $_POST['mt_rating'] );

		/**
		 * Update Post Data
		 */

		// Get current post meta
		$current_data = get_post_meta( $post_id, 'meridian_recipes_ratings', true );

		// if no data make an empty array
		if ( ! $current_data ) {
			$new_data = array();
		} else {
			$new_data = $current_data;
		}

		// Append to new data
		$new_data['user-' . $user_id] = $rating;

		// Update post meta
		update_post_meta( $post_id, 'meridian_recipes_ratings', $new_data );

		// Get average rating
		$average_rating = 0;
		foreach ( $new_data as $key => $value ) {
			$average_rating += $value;
		}
		$average_rating = round( $average_rating / count( $new_data ) );

		// Update average rating
		update_post_meta( $post_id, 'meridian_recipes_rating', $average_rating );

		// Status to success
		$response['status'] = 'success';

		// Get average rating
		$response['rating_html'] = '';
		// loop 1 to 5
		for ( $i = 1; $i <= 5; $i++ ) {

			// if rating bigger than or equal i
			if ( $i <= $average_rating ) {
				$response['rating_html'] .= '<span class="fa fa-star"></span>';

			// if rating less than i
			} else {

				// if rating 0.5
				if ( ( $average_rating - $i + 1 ) == 0.5 ) {
					$response['rating_html'] .= '<span class="fa fa-star-half-o"></span>';

				// if rating 0
				} else {
					$response['rating_html'] .= '<span class="fa fa-star-o"></span>';
				}

			}

		}
		$response['rating_html'] .= '<span class="recipe-post-meta-item-text">' . $average_rating . '/5</span>';

		/**
		 * Update User Data
		 */

		// Get current post meta
		$current_data = get_user_meta( $user_id, 'meridian_recipes_ratings_recipes', true );

		// if no data make an empty array
		if ( ! $current_data ) {
			$new_data = array();
		} else {
			$new_data = $current_data;
		}

		// add new data
		$new_data[] = $post_id;

		// Update post meta
		update_user_meta( $user_id, 'meridian_recipes_ratings_recipes', $new_data );

		// Encode response
		$response_json = json_encode( $response );

		// Send response
		header( "Content-Type: application/json" );
		echo $response_json;

	} // Check if user can save

	// Exit
	exit;	

} add_action( 'wp_ajax_meridian-recipes-ajax-rate', 'meridian_recipes_ajax_rate' );

/**
 * # Share ( meridian_recipes_ajax_share )
 *
 * @since 1.0
 */
function meridian_recipes_ajax_share() {

	// Response array
	$response = array();		

	// Vars
	$post_id = absint( $_POST['mt_post_id'] );
	$the_post = get_post( $post_id );

	// start output buffering
	ob_start();

	?>
		<div class="share-post-info">

			<div class="share-post-info-thumb">
				<?php 
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' ); 
					$image_url = $image_url[0];
					echo '<img src="' . meridian_recipes_aq_resize( $image_url, 167, 167, true ) . '" />';
				?>
			</div><!-- .share-post-info-thumb -->

			<div class="share-post-info-main">
				<div class="share-post-info-title"><?php echo get_the_title( $post_id ); ?></div>
				<div class="share-post-info-excerpt"><?php echo esc_html( $the_post->post_excerpt ); ?></div>
			</div><!-- .share-post-info-main -->

			<?php if ( get_post_type( $the_post ) == 'mrdt_recipes' ) : ?>

				<div class="share-post-info-extra">

					<div class="recipe-post-single-meta clearfix">

						<?php meridian_recipes_display_rating( $post_id ); ?>

						<?php if ( meridian_recipes_get_post_meta( $post_id, 'servings' ) ) : ?>
							<div class="recipe-post-single-meta-item recipe-post-single-servings">
								<span class="fa fa-user"></span>
								<span class="recipe-post-meta-item-text"><?php echo meridian_recipes_get_post_meta( $post_id, 'servings' ); ?></span>
							</div><!-- .recipe-post-single-servings -->
						<?php endif; ?>

						<?php if ( meridian_recipes_get_post_meta( $post_id, 'preparation_time' ) ) : ?>
							<div class="recipe-post-single-meta-item recipe-post-single-time">
								<span class="fa fa-clock-o"></span>
								<span class="recipe-post-meta-item-text"><?php echo meridian_recipes_get_post_meta( $post_id, 'preparation_time' ); ?></span>
							</div><!-- .recipe-post-single-time -->
						<?php endif; ?>

					</div><!-- .recipe-post-single-meta -->

				</div><!-- .share-post-info-extra -->

			<?php endif; ?>

		</div><!-- .share-post-info -->

		<?php
		// vars
		$post_permalink = get_permalink( $post_id );
		$post_title = str_replace( '&#038;', '', get_the_title( $post_id ) );
		$post_img = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
		?>

		<div class="share-post-actions">
			<a href="#" class="share-post-action-facebook" target="_blank" onClick="return meridian_recipes_social_share(400, 300, 'http://www.facebook.com/share.php?u=<?php echo esc_html( $post_permalink ); ?>')"><span class="fa fa-facebook-square"></span><span class="share-post-action-text"><?php esc_html_e( 'Share on facebook', 'meridian-recipes' ); ?></span></a>
			<a href="#" class="share-post-action-pinterest" onClick="return meridian_recipes_social_share(400, 300, 'https://pinterest.com/pin/create/button/?url=<?php echo esc_html( $post_permalink ); ?>&amp;media=<?php echo esc_html( $post_img ); ?>')"><span class="fa fa-pinterest-square"></span><span class="share-post-action-text"><?php esc_html_e( 'Share on pinterest', 'meridian-recipes' ); ?></span></a>
			<a href="#" class="share-post-action-twitter" onClick="return meridian_recipes_social_share(400, 300, 'https://twitter.com/home?status=<?php echo esc_html( $post_title . ' ' . $post_permalink ); ?>')" ><span class="fa fa-twitter"></span></a>
			<a href="#" class="share-post-action-google-plus" onClick="return meridian_recipes_social_share(400, 300, 'https://plus.google.com/share?url=<?php echo esc_html( $post_permalink ); ?>')" ><span class="fa fa-google-plus"></span></a>
			<a href="mailto:someone@example.com?subject=<?php echo rawurlencode( $post_title ); ?>&amp;body=<?php echo rawurlencode( $post_title . ' ' . $post_permalink ); ?>" class="share-post-action-email"><span class="fa fa-envelope-o"></span></a>
		</div><!-- .share-post-actions -->
	<?php

	$response['output'] = ob_get_contents();
	ob_end_clean();

	// Encode response
	$response_json = json_encode( $response );

	// Send response
	header( "Content-Type: application/json" );
	echo $response_json;

	// Exit
	exit;	

} add_action( 'wp_ajax_meridian-recipes-ajax-share', 'meridian_recipes_ajax_share' );
add_action( 'wp_ajax_nopriv_meridian-recipes-ajax-share', 'meridian_recipes_ajax_share' );
