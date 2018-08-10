<?php $post_vars = meridian_recipes_get_post_vars(); ?>
<div <?php post_class( 'post-s6 clearfix ' . $post_vars['post_class'] ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s6-thumb">
			<a href="<?php the_permalink(); ?>"><?php meridian_recipes_the_post_thumbnail( $post_vars['thumb_width'], $post_vars['thumb_height'], true, false, $post_vars['mobile_thumb_height'] ); ?></a>
		</div><!-- .post-s6-thumb -->
	<?php endif; ?>

	<div class="post-s6-main">

		<h2 class="post-s6-title" data-mtst-selector=".post-s6-title" data-mtst-label="Post S6 - Title" data-mtst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s6-meta">
			<?php 
				if ( get_post_type() == 'mrdt_recipes' )
					meridian_recipes_post_meta( array( 'preparation', 'servings' ) );
				else 
					meridian_recipes_post_meta( array( 'author', 'timeago' ) );
			?>
		</div><!-- .posts-s6-meta -->

	</div><!-- .post-s6-main -->

</div><!-- .post-s6 -->