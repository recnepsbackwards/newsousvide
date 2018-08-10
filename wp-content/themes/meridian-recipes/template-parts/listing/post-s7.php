<?php $post_vars = meridian_recipes_get_post_vars(); ?>
<div <?php post_class( 'post-s7 clearfix ' . $post_vars['post_class'] ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s7-thumb">
			<a href="<?php the_permalink(); ?>"><?php meridian_recipes_the_post_thumbnail( $post_vars['thumb_width'], $post_vars['thumb_height'], true, false, $post_vars['mobile_thumb_height'] ); ?></a>
		</div><!-- .post-s7-thumb -->
	<?php else: ?>
		<div class="post-s7-fake-thumb">
			<a href="<?php the_permalink(); ?>"></a>
		</div><!-- .post-s7-fake-thumb -->
	<?php endif; ?>

	<div class="post-s7-main">

		<h2 class="post-s7-title" data-mtst-selector=".post-s7-title" data-mtst-label="Post S7 - Title" data-mtst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	</div><!-- .post-s7-main -->

</div><!-- .post-s7 -->