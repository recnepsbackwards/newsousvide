<?php
/**
 * $post_class, $thumb_width and $thumb_height need to be defined in the file that is calling this template part
 */
?>
<div <?php post_class( 'post-s1 clearfix ' . $post_class ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s1-thumb">
			<a href="<?php the_permalink(); ?>"><?php meridian_recipes_the_post_thumbnail( $thumb_width, $thumb_height, true, false, $mobile_thumb_height ); ?></a>
		</div><!-- .post-s1-thumb -->
	<?php endif; ?>

	<div class="post-s1-main">

		<h2 class="post-s1-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s1-excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .post-s1-excerpt -->

		<div class="post-s1-meta">
			<?php meridian_recipes_post_meta( array( 'date', 'shares' ), 'clean' ); ?>
		</div><!-- .posts-s1-meta -->

	</div><!-- .post-s1-main -->

</div><!-- .post-s1 -->