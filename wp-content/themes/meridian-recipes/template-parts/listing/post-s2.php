<?php $post_vars = meridian_recipes_get_post_vars(); ?>
<?php
	$term_id = 'category';
	if ( get_post_type() == 'mrdt_recipes' ) {
		$term_id = 'mrdt_recipes_cats';
	}
?>
<div <?php post_class( 'post-s2 clearfix ' . $post_vars['post_class'] ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s2-thumb">
			<a href="<?php the_permalink(); ?>"><?php meridian_recipes_the_post_thumbnail( $post_vars['thumb_width'], $post_vars['thumb_height'], true, false, $post_vars['mobile_thumb_height'] ); ?></a>
			<div class="post-s2-thumb-cats" data-mtst-selector=".post-s2-thumb-cats a" data-mtst-label="Post S2 - Category" data-mtst-no-support="border">
				<?php the_terms( get_the_ID(), $term_id, '', ' ', '' ); ?>
			</div><!-- .post-s2-thumb-cats -->
		</div><!-- .post-s2-thumb -->
	<?php endif; ?>

	<div class="post-s2-main">

		<h2 class="post-s2-title" data-mtst-selector=".post-s2-title" data-mtst-label="Post S2 - Title" data-mtst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s2-meta">
			<?php 
				if ( get_post_type() == 'mrdt_recipes' )
					meridian_recipes_post_meta( array( 'preparation', 'servings', 'shares' ) );
				else 
					meridian_recipes_post_meta( array( 'timeago' ) );
			?>
		</div><!-- .posts-s2-meta -->

	</div><!-- .post-s2-main -->

</div><!-- .post-s2 -->