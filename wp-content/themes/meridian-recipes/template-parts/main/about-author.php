<?php
	/* About Author */
?>

<?php
	
	// Get author ID	
	if ( get_the_author_meta( 'ID' ) )
		$author_id = get_the_author_meta( 'ID' );
	else
		$author_id = 1;

?>

<?php if ( get_the_author_meta( 'description', $author_id ) ) : ?>

	<div class="about-author white-wrapper-no-border">
						
		<div class="about-author-avatar">
			<?php echo get_avatar( $author_id , 85 ); ?>
		</div><!-- .about-author-avatar -->

		<div class="about-author-main">

			<h4 class="about-author-name"><?php the_author_posts_link(); ?></h4>

			<div class="about-author-bio">
				<?php echo get_the_author_meta( 'description', $author_id ); ?>
			</div><!-- .about-author-bio -->

			<div class="about-author-social">
				<?php if ( get_the_author_meta( 'meridian_recipes_twitter', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'meridian_recipes_twitter' ); ?>"><span class="fa fa-twitter"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'meridian_recipes_facebook', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'meridian_recipes_facebook' ); ?>"><span class="fa fa-facebook"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'meridian_recipes_instagram', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'meridian_recipes_instagram' ); ?>"><span class="fa fa-instagram"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'meridian_recipes_behance', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'meridian_recipes_behance' ); ?>"><span class="fa fa-behance"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'meridian_recipes_dribbble', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'meridian_recipes_dribbble' ); ?>"><span class="fa fa-dribbble"></span></a>
				<?php endif; ?>
			</div><!-- .about-author-social -->

		</div><!-- .about-author-main -->

	</div><!-- .about-author -->

<?php endif; ?>