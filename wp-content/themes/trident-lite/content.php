<?php
/**
 * @package trident
 */
?>

<?php global $post; ?>
<div class="article-box">
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail-wrap">
		<div class="post_category fixed">
			<?php 
				$category_list = explode(', ', (get_the_category_list( __( ', ', 'trident' )) ));
				echo $category_list[0];
			?>
		</div>
		<div class="entry-image">					
			<a href="<?php echo get_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	</div>
	
	<?php } ?>
	<header class="entry-header">
		<h6 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php echo trident_shorten_title( get_the_title() ); ?>
			</a>
		</h6>

		<div class="entry-meta">
			<?php trident_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php echo trident_shorten_excerpt( get_the_excerpt() ); ?>
	</div><!-- .entry-content -->
</div>