<?php
	/* Outputs on a single blog post page */
?>

<div class="blog-post-single-top">

	<div class="blog-post-single-top-item blog-post-single-top-share" data-post-id="<?php the_ID(); ?>">
		<span class="fa fa-share-alt"></span>
		<?php echo esc_html_e( 'share', 'meridian-recipes' ); ?>
	</div><!-- .blog-post-single-top-item blog-post-single-top-share -->

	<?php if ( is_user_logged_in() ) : ?>
		<?php
			$user_id = get_current_user_id();
			$user_bookmarks = get_user_meta( $user_id, 'meridian_recipes_bookmarks_blog_posts', true );
			$bookmarked = false;
			if ( $user_bookmarks && in_array( get_the_ID(), $user_bookmarks ) ) {
				$bookmarked = true;
			}
		?>
		<div class="blog-post-single-top-item blog-post-single-top-bookmark">
			<?php if ( $bookmarked ) : ?>
				<a href="#" class="bookmark-blog-hook" data-post-id="<?php echo get_the_ID(); ?>">
					<span class="fa fa-bookmark"></span>
					<?php echo esc_html_e( 'bookmarked', 'meridian-recipes' ); ?>
				</a>
			<?php else : ?>
				<a href="#" class="bookmark-blog-hook" data-post-id="<?php echo get_the_ID(); ?>">
					<span class="fa fa-bookmark-o"></span>
					<?php echo esc_html_e( 'bookmark', 'meridian-recipes' ); ?>
				</a>
			<?php endif; ?>
		</div><!-- .blog-post-single-top-item blog-post-single-top-bookmark -->
	<?php endif; ?>

</div><!-- .blog-post-single-top -->

<h1 class="blog-post-single-title"><?php the_title(); ?></h1>

<div class="blog-post-single-top-meta">
	
	<div class="blog-post-single-tags">
		<?php the_tags( '', '', '' ); ?>
	</div><!-- .blog-post-single-tags -->

	<div class="blog-post-single-date">
		<?php meridian_recipes_post_meta( array( 'timeago' ) ); ?>
	</div><!-- .blog-post-single-date -->

</div><!-- .blog-post-single-top-meta -->

<?php if ( has_post_thumbnail() ) : ?>
	<div class="blog-post-single-thumb">
		<?php the_post_thumbnail( 'full' ); ?>
	</div><!-- .blog-post-single-thumb -->
<?php endif; ?>

<div class="blog-post-single-content">
	<?php the_content(); ?>
</div><!-- .blog-post-single-content -->

<div class="blog-post-single-link-pages">
	<?php wp_link_pages(); ?>
</div><!-- .blog-post-single-link-pages -->