<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package trident
 */

if ( ! function_exists( 'trident_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function trident_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'trident' ); ?></h2>
		<div class="nav-links">

			<?php
			global $wp_query;
			
			$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1; // Current Page

			$big = 999999999; // need an unlikely integer

			echo '<span class="pagination-status">Page '.$paged.' of '.$wp_query->max_num_pages.'</span> ';
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			) );
			?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'trident_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function trident_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'trident' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '%title', 'Previous post link', 'trident' ) );
				next_post_link( '<div class="nav-next">%link</div>',     _x( '%title', 'Next post link', 'trident' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'trident_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function trident_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	$category_list = get_the_category_list( __( ', ', 'trident' ) );
	printf( __( '<span class="post-author"> By %2$s</span> <span class="posted-on post-date">• On %1$s</span> <span class="post-category">• In %3$s</span>', 'trident' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		),
		sprintf( $category_list )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function trident_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so trident_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so trident_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in trident_categorized_blog.
 */
function trident_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'trident_category_transient_flusher' );
add_action( 'save_post',     'trident_category_transient_flusher' );


/*
* Shorten the post title to 50 characters
*/
function trident_shorten_title( $title ) {

	$chars_limit = 50;
	$chars_text = strlen( $title );
	$title = $title." ";
	$title = substr( $title, 0, $chars_limit );
	$title = substr( $title, 0, strrpos( $title,' ' ) );

	if ( $chars_text > $chars_limit ) {
		$title = $title."...";
	}

	return $title;
}


/*
* Shorten the excerpt to the limit set in options, or, to 80 characters as a default limit
*/
function trident_shorten_excerpt( $excerpt ) {
	
	// Reading the user defined value from database	        	        
	$trident_excerpt_length = ot_get_option('trident_excerpt_length');
	        
	// If not defined, setting a default value for the excerpt
	if ( !$trident_excerpt_length ) {
		$trident_excerpt_length = 80;
	}

	$chars_text = strlen( $excerpt );
	$excerpt = $excerpt." ";
	$excerpt = substr( $excerpt, 0, $trident_excerpt_length );
	$excerpt = substr( $excerpt, 0, strrpos( $excerpt,' ' ) );

	if ( $chars_text > $trident_excerpt_length ) {
		$excerpt = $excerpt."...";
	}

	return $excerpt;
}