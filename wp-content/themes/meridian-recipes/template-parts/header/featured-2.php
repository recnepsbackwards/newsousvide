<?php

// vars used
$count = 0;
$real_count = 0;
$post_columns = 3;
$max_columns = 12 / $post_columns;

// post type
$post_type = array( 'post', 'mrdt_recipes' );
if ( meridian_recipes_get_post_meta( get_the_ID(), 'featured_post_type' ) ) {
	$post_type = meridian_recipes_get_post_meta( get_the_ID(), 'featured_post_type' );
	if ( $post_type == 'mixed' ) {
		$post_type = array( 'post', 'mrdt_recipes' );
	}
}

// force post post_type if recipes func disabled
if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'disabled' ) {
	$post_type = 'post';
}

$tag_to_show = 'featured';
if ( meridian_recipes_get_post_meta( get_the_ID(), 'featured_tag' ) ) {
	$tag_to_show = meridian_recipes_get_post_meta( get_the_ID(), 'featured_tag' );
}

// query args
$args = array(
	'post_type' => $post_type,
	'posts_per_page' => 5,
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'mrdt_recipes_tags',
			'field'    => 'slug',
			'terms'    => $tag_to_show,
		),
		array(
			'taxonomy' => 'post_tag',
			'field'    => 'slug',
			'terms'    => $tag_to_show,
		),
	),
);

$args = apply_filters( 'meridian_recipes_featured_2_args', $args );

// query posts
$meridian_recipes_query = new WP_Query( $args );

// if there are posts
if ( $meridian_recipes_query->have_posts() ) :

	?><div id="featured" class="featured-2"><?php
		
		// the cover post
		$meridian_recipes_query->the_post();

		// thumbnail
		$featured_cover_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		$featured_cover_img = $featured_cover_img[0];

		?>

		<div id="featured-cover" class="featured-cover" style="background-image: url(<?php echo esc_attr( $featured_cover_img ); ?>)">

			<div class="featured-cover-overlay"></div>

			<div class="wrapper clearfix">

				<div class="featured-post-main">

					<?php meridian_recipes_featured_post_title(); ?>
					
					<?php 
						if ( get_post_type() == 'mrdt_recipes' )
							meridian_recipes_post_meta( array( 'preparation', 'servings', 'shares' ) );
						else 
							meridian_recipes_post_meta( array( 'timeago' ) );
					?>

					<div class="featured-post-read-more">
						<span class="featured-post-read-more-outline"></span>
						<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading', 'meridian-recipes' ); ?></a>
					</div><!-- .post-s4-read-more -->

				</div><!-- .featured-post-main -->

			</div><!-- .wrapper -->

		</div><!-- #featured-cover -->

		<div class="wrapper clearfix">

			<?php

				// start posts loop
				while ( $meridian_recipes_query->have_posts() ) : $meridian_recipes_query->the_post();

					// reset vars
					$post_class_append = '';
					$column_class = '';

					// increase counts
					$count++;
					$real_count++;

					// thumbnail sizes
					$thumb_width = 287;
					$thumb_height = $thumb_width / 1.5;
					$mobile_thumb_height = 480 / 1.5;

					// column class
					$column_class = 'col col-' . $post_columns . ' ';

					// first column
					if ( $count == 1 )
						$post_class_append = 'col-first';

					// last column
					if ( $count >= $max_columns )
						$post_class_append = 'col-last';

					// reset count on max
					if ( $count >= $max_columns )
						$count = 0;

					// post class
					$post_class = $column_class . $post_class_append;

					// set post vars
					meridian_recipes_set_post_vars(array(
						'post_class' => $post_class,
						'thumb_width' => $thumb_width,
						'thumb_height' => $thumb_height,
						'mobile_thumb_height' => $mobile_thumb_height
					));

					// load template
					get_template_part( 'template-parts/listing/post-s2' );

				//end posts loop
				endwhile;
			?>

		</div><!-- .wrapper -->

	</div><!-- #featured -->

<?php

// finish if statement
endif; 

// reset query
wp_reset_postdata();

?>