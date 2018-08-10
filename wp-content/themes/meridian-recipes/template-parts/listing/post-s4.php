<?php $post_vars = meridian_recipes_get_post_vars(); ?>
<?php
	$term_id = 'category';
	if ( get_post_type() == 'mrdt_recipes' ) {
		$term_id = 'mrdt_recipes_cats';
	}
?>
<div <?php post_class( 'post-s4 clearfix ' . $post_vars['post_class'] ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s4-thumb">
			<a href="<?php the_permalink(); ?>"><?php meridian_recipes_the_post_thumbnail( $post_vars['thumb_width'], $post_vars['thumb_height'], true, false, $post_vars['mobile_thumb_height'] ); ?></a>
			<div class="post-s4-thumb-overlay"></div>
		</div><!-- .post-s4-thumb -->
	<?php endif; ?>

	<div class="post-s4-main">

		<div class="post-s4-cats" data-mtst-selector=".post-s4-cats a" data-mtst-label="Post S4 - Category">
			<?php the_terms( get_the_ID(), $term_id, '', '', '' ); ?>
		</div><!-- .post-s4-cats -->

		<div class="post-s4-main-inner">

			<h2 class="post-s4-title" data-mtst-selector=".post-s4-title" data-mtst-label="Post S4 - Title" data-mtst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<div class="post-s4-meta">
				<?php 
					if ( get_post_type() == 'mrdt_recipes' )
						meridian_recipes_post_meta( array( 'preparation', 'servings', 'shares' ), 'clean' );
					else 
						meridian_recipes_post_meta( array( 'author', 'timeago' ) );
				?>
			</div><!-- .posts-s4-meta -->

			<div class="post-s4-read-more">
				<span class="post-s4-read-more-outline" data-mtst-selector=".post-s4-read-more-outline" data-mtst-label="Post S4 - Button Outline" data-mtst-no-support="typography,spacing,background,animation"></span>
				<a href="<?php the_permalink(); ?>" data-mtst-selector=".post-s4-read-more a" data-mtst-label="Post S4 - Button"><?php esc_html_e( 'Continue Reading', 'meridian-recipes' ); ?></a>
			</div><!-- .post-s4-read-more -->

		</div><!-- .post-s4-main-inner -->

	</div><!-- .post-s4-main -->

</div><!-- .post-s4 -->