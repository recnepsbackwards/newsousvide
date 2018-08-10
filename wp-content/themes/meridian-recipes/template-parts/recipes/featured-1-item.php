<?php
	
	$post_class = meridian_recipes_get_post_class();
	$thumb_resize = meridian_recipes_get_thumb_sizes();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'featured-post col ' . $post_class ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-post-thumb">
			
			<?php
				$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
				$thumb_url = $thumb_url[0];
				$res_img = meridian_recipes_aq_resize( $thumb_url, $thumb_resize['width'], $thumb_resize['height'], $thumb_resize['crop'] );
				$img_alt = meridian_recipes_get_attachment_alt( get_post_thumbnail_id() );
			?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $res_img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" /></a>
			
			<?php meridian_recipes_featured_post_thumb_cats(); ?>

		</div><!-- .featured-post-thumb -->
	<?php endif; ?>

	<div class="featured-post-main clearfix">

		<?php meridian_recipes_featured_post_title(); ?>

		<?php meridian_recipes_featured_post_meta( array( 'author', 'timeago' ) ); ?>

	</div><!-- .featured-post-main -->

</article><!-- .featured-post -->
