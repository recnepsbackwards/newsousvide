<?php $post_vars = meridian_recipes_get_post_vars(); ?>
<div <?php post_class( 'post-s1 clearfix ' . $post_vars['post_class'] ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s1-thumb">
			<a href="<?php the_permalink(); ?>"><?php meridian_recipes_the_post_thumbnail( $post_vars['thumb_width'], $post_vars['thumb_height'], true, false, $post_vars['mobile_thumb_height'] ); ?></a>
		</div><!-- .post-s1-thumb -->
	<?php endif; ?>

	<div class="post-s1-main">

		<h2 class="post-s1-title" data-mtst-selector=".post-s1-title" data-mtst-label="Post S1 - Title" data-mtst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s1-excerpt" data-mtst-selector=".post-s1-excerpt" data-mtst-label="Post S1 - Excerpt" data-mtst-no-support="background,border">
			<?php the_excerpt(); ?>
		</div><!-- .post-s1-excerpt -->

		<div class="post-s1-meta">
			<?php 
				if ( get_post_type() == 'mrdt_recipes' )
					meridian_recipes_post_meta( array( 'preparation', 'servings', 'shares' ) );
				else 
					meridian_recipes_post_meta( array( 'author', 'timeago' ) );
			?>
		</div><!-- .posts-s1-meta -->

	</div><!-- .post-s1-main -->

</div><!-- .post-s1 -->