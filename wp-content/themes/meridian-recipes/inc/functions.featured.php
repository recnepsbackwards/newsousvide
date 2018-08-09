<?php
/**
 * meridian_recipes_featured_post_thumb ( Thumbnail element for featured posts listing )
 * meridian_recipes_featured_post_thumb_cats ( Categories element inside of thumbnail for featured posts listing )
 * meridian_recipes_featured_post_cats ( Categories element for featured posts listing )
 * meridian_recipes_featured_post_title ( Title element for featured posts listing )
 * meridian_recipes_featured_post_button ( Button element for featured posts listing )
 * meridian_recipes_featured_post_meta ( Meta information for featured posts listing )
 */

if ( ! function_exists( 'meridian_recipes_featured_post_thumb' ) ) {

	/**
	 * Thumbnail element for featured posts listing
	 *
	 * @since 1.0
	 */
	function meridian_recipes_featured_post_thumb( $sizes = array(), $atts = array( 'cats' => false, 'overlay' => false ) ) {

		if ( ! isset( $atts['cats'] ) )
			$atts['cats'] = false;

		if ( ! isset( $atts['overlay'] ) )
			$atts['overlay'] = false;

		if ( has_post_thumbnail() ) : ?>
			<div class="featured-post-thumb">
				
				<?php
					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
					$thumb_url = $thumb_url[0];
					$res_img = meridian_recipes_aq_resize( $thumb_url, $sizes[0], $sizes[1], true );
					$img_alt = meridian_recipes_get_attachment_alt( get_post_thumbnail_id() );
				?>
				<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $res_img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" /></a>
					
				<?php if ( $atts['overlay'] ) : ?>
					<div class="featured-post-thumb-overlay"></div>
				<?php endif; ?>

				<?php if ( $atts['cats'] ) : ?>
					<?php meridian_recipes_featured_post_thumb_cats(); ?>
				<?php endif; ?>

			</div><!-- .featured-post-thumb -->
		<?php endif;

	}

}

if ( ! function_exists( 'meridian_recipes_featured_post_thumb_cats' ) ) {

	/**
	 * Categories element inside of thumbnail for featured posts listing
	 *
	 * @since 1.0
	 */
	function meridian_recipes_featured_post_thumb_cats( $classes = '' ) {

		?>
		<div class="featured-post-thumb-cats">
			<div class="featured-post-thumb-cats-inner">
				<?php the_terms( get_the_ID(), 'mrdt_recipes_cats', '', ' ', '' ); ?>
			</div><!-- .featured-post-thumb-cats-inner -->
		</div><!-- .featured-post-thumb-cats -->
		<?php

	}

}

if ( ! function_exists( 'meridian_recipes_featured_post_cats' ) ) {

	/**
	 * Categories element for featured posts listing
	 *
	 * @since 1.0
	 */
	function meridian_recipes_featured_post_cats( $classes = '' ) {

		?>
		<div class="featured-post-cats">
			<?php the_terms( get_the_ID(), 'mrdt_recipes_cats', '', ' ', '' ); ?>
		</div><!-- .featured-post-cats -->
		<?php

	}

}

if ( ! function_exists( 'meridian_recipes_featured_post_title' ) ) {

	/**
	 * Title element for featured posts listing
	 *
	 * @since 1.0
	 */
	function meridian_recipes_featured_post_title( $classes = '' ) {

		?>
		<h4 class="featured-post-title <?php echo esc_attr( $classes ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php

	}

}

if ( ! function_exists( 'meridian_recipes_featured_post_button' ) ) {

	/**
	 * Button element for featured posts listing
	 *
	 * @since 1.0
	 */
	function meridian_recipes_featured_post_button() {

		?>
		<div class="featured-post-read-more">
			<div class="featured-post-read-more-inner">
				<span class="featured-post-read-more-outline"></span>
				<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading', 'meridian-recipes' ); ?></a>
			</div><!-- .featured-post-read-more-inner -->
		</div><!-- .featured-post-read-more -->
		<?php

	}

}

if ( ! function_exists( 'meridian_recipes_featured_post_meta' ) ) {

	/**
	 * Meta information for featured posts listing
	 *
	 * @since 1.0
	 */
	function meridian_recipes_featured_post_meta( $elements = array(), $sep_style = 'dot' ) {

		// Separator HTML
		if ( $sep_style == 'dot' )
			$sep_html = '<span class="featured-post-meta-separator"></span>';
		else
			$sep_html = '<span class="featured-post-meta-separator-clean"></span>';

		// Show separator
		$sep = false;

		?>
		<div class="featured-post-meta">
			
			<?php if ( in_array( 'date', $elements ) ) : ?>
				<span class="featured-post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'author', $elements ) ) : ?>
				<?php if ( $sep ) echo $sep_html; ?>
				<span class="featured-post-author"><?php the_author_posts_link(); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'timeago', $elements ) ) : ?>
				<?php if ( $sep ) echo $sep_html; ?>
				<span class="featured-post-time-ago small"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'meridian-recipes' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'shares', $elements ) ) : ?>
				<?php if ( $sep ) echo $sep_html; ?>
				<span class="featured-post-shares">
					<a href="#"><span class="fa fa-facebook-square"></span>2.6K</a>
					<a href="#"><span class="fa fa-pinterest-square"></span>200</a>
				</span>
			<?php $sep = true; endif; ?>

		</div><!-- .featured-post-meta -->
		<?php

	}

}

if ( ! function_exists( 'meridian_recipes_post_meta' ) ) {

	/**
	 * Meta information for featured posts listing
	 *
	 * @since 1.0
	 */
	function meridian_recipes_post_meta( $elements = array(), $sep_style = 'dot' ) {

		// Separator HTML
		if ( $sep_style == 'dot' )
			$sep_html = '<span class="post-meta-separator"></span>';
		else
			$sep_html = '<span class="post-meta-separator-clean"></span>';

		// Show separator
		$sep = false;

		?>
		<div class="post-meta">
			
			<?php if ( in_array( 'date', $elements ) ) : ?>
				<span class="post-meta-date" data-mtst-selector=".post-meta-date" data-mtst-label="Post Meta - Date" data-mtst-no-support="background,border"><?php the_time( get_option( 'date_format' ) ); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'author', $elements ) ) : ?>
				<?php if ( $sep ) echo $sep_html; ?>
				<span class="post-meta-author" data-mtst-selector=".post-meta-author" data-mtst-label="Post Meta - Author" data-mtst-no-support="background,border"><?php the_author_posts_link(); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'timeago', $elements ) ) : ?>
				<?php if ( $sep ) echo $sep_html; ?>
				<?php if ( meridian_recipes_get_theme_mod( 'date_format', 'timeago' ) == 'date' ) : ?>
					<span class="post-meta-date" data-mtst-selector=".post-meta-date" data-mtst-label="Post Meta - Date" data-mtst-no-support="background,border"><?php the_time( get_option( 'date_format' ) ); ?></span>
				<?php else : ?>
					<span class="post-meta-time-ago" data-mtst-selector=".post-meta-time-ago" data-mtst-label="Post Meta - Time Ago" data-mtst-no-support="background,border"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'meridian-recipes' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
				<?php endif; ?>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'servings', $elements ) ) : ?>
				<?php if ( $sep ) echo $sep_html; ?>
				<?php if ( meridian_recipes_get_post_meta( get_the_ID(), 'servings' ) ) : ?>
					<span class="post-meta-servings" data-mtst-selector=".post-meta-servings" data-mtst-label="Post Meta - Servings" data-mtst-no-support="background,border">
						<span class="fa fa-user"></span><span class="post-meta-servings-text"><?php echo intval( meridian_recipes_get_post_meta( get_the_ID(), 'servings' ) ); ?></span>
					</span><!-- .recipe-post-single-servings -->
				<?php endif; ?>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'preparation', $elements ) ) : ?>
				<?php if ( $sep ) echo $sep_html; ?>
				<?php if ( meridian_recipes_get_post_meta( get_the_ID(), 'preparation_time' ) ) : ?>
					<span class="post-meta-preparation-time" data-mtst-selector=".post-meta-preparation-time" data-mtst-label="Post Meta - Prep Time" data-mtst-no-support="background,border">
						<span class="fa fa-clock-o"></span><span class="post-meta-servings-text"><?php echo meridian_recipes_get_post_meta( get_the_ID(), 'preparation_time' ); ?></span>
					</span><!-- .post-meta-preparation-tim -->
				<?php endif; ?>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'shares', $elements ) ) : ?>
				<?php if ( $sep ) echo $sep_html; ?>
				<?php $shares_count = meridian_recipes_get_social_count( get_the_ID() ); ?>
				<span class="post-meta-shares-count" data-post-id="<?php echo get_the_ID() ; ?>" data-mtst-selector=".post-meta-shares-count" data-mtst-label="Post Meta - Shares" data-mtst-no-support="background,border"><span class="fa fa-share"></span><?php echo esc_html( $shares_count['total'] ); ?></span>
			<?php $sep = true; endif; ?>

		</div><!-- .post-meta -->
		<?php

	}

}