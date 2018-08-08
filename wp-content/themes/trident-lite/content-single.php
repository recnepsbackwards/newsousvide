<?php
/**
 * @package trident
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="entry-image">
		<a href="<?php echo get_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	</div>
	<?php } ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php trident_posted_on(); ?>
			<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'trident' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'trident' ) );

			if ( ! trident_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( '<span class="meta-tag"><i class="fa fa-tag"></i> %2$s</span>', 'trident' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '<span class="meta-cat"><i class="fa fa-book"></i></span> %1$s <span class="meta-tag"><i class="fa fa-tag"></i> %2$s</span>', 'trident' );
				} else {
					$meta_text = __( '<span class="meta-cat"><i class="fa fa-book"></i> %1$s</span>', 'trident' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list
			);

			printf(' <i class="fa fa-comments"></i> ');

			comments_popup_link('0', '1', '%');
		?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'trident' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'trident' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
