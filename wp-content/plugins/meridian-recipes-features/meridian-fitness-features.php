<?php
/*
	Plugin Name: Meridian Recipes Features
	Description: Shortcodes and custom post types for the Meridian Recipes theme.
	Author: MeridianThemes
	Author URI: http://meridianthemes.net
	Version: 1.0.2
	Text Domain: meridian-recipes-features
	License: GPLv2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define( 'MERIDIAN_RECIPES_FEATURES_URL', plugin_dir_url( __FILE__ ) );

/**
 * Register Custom Post Types
 *
 * @since 1.0
 */
function meridian_recipes_features_cpt() {

	// Do not register post types if disabled
	if ( meridian_recipes_features_get_theme_mod( 'recipes_functionality', 'enabled' ) != 'enabled' )
		return;

	/**
	 * Recipes
	 */

	// Arguments ( post type )
	$args = array(
		'labels' => array(
			'name' => __( 'Recipes', 'meridian-recipes-features' ),
			'singular_name' => __( 'Recipe', 'meridian-recipes-features' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => 'recipe-view', 'with_front' => false ),
		'supports' => array( 'title', 'custom-fields', 'excerpt', 'editor', 'thumbnail', 'comments', 'author' ),
	);

	// Filter arguments
	$args = apply_filters( 'meridian_recipes_cpt_args', $args );

	// Register ( post type )
	register_post_type( 'mrdt_recipes', $args );

	/**
	 * Recipes Categories
	 */

	// Arguments ( categories )
	$cat_args = array(
		'hierarchical'          => true,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'recipes-category' ),
	);

	// Filter arguments
	$cat_args = apply_filters( 'meridian_recipes_cat_args', $cat_args );

	// Register ( category )
	register_taxonomy( 'mrdt_recipes_cats', 'mrdt_recipes', $cat_args );

	/**
	 * Recipes Tags
	 */

	// Arguments ( tags )
	$tag_args = array(
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'recipes-tag' ),
	);

	// Filter arguments
	$tag_args = apply_filters( 'meridian_recipes_tag_args', $tag_args );

	// Register ( tags )
	register_taxonomy( 'mrdt_recipes_tags', 'mrdt_recipes', $tag_args );


} add_action( 'init', 'meridian_recipes_features_cpt' );

/**
 * Add the recipes to the author archive
 *
 * @since 1.0
 */
function meridian_recipes_features_author_query( $query ) {

	if ( $query->is_main_query() && $query->is_author ) {
		$query->set( 'post_type', array( 'mrdt_recipes' ) );
	}

} add_action('pre_get_posts', 'meridian_recipes_features_author_query'); 

/**
 * Columns Shortcode
 *
 * @since 1.0
 */
function meridian_recipes_features_column_sc( $atts, $content = '' ) {

	// Attributes
	extract( shortcode_atts( array(
		'size' => '12',
		'last' => 'no'
	), $atts));

	// Generate class
	$class = 'col col-' . $size . ' ';
	if ( $last == 'yes' ) {
		$class .= 'col-last ';
	}

	// Return content
	return do_shortcode( '<div class="' . $class . '">' . $content . '</div>' );

} add_shortcode( 'column', 'meridian_recipes_features_column_sc' );

/**
 * Info Box
 *
 * @since 1.0
 */
function meridian_recipes_features_info_box_sc( $atts, $content = '' ) {

	// Attributes
	extract( shortcode_atts( array(
		'color' => false,
		'title' => false
	), $atts));

	// Generate style
	$style = '';
	if ( $color ) {
		$style = 'border-color: ' . $color;
	}

	// Start HTML
	$output = '<div class="info-box" style="' . $style . '">';

		// Title
		if ( $title ) {
			$output .= '<h4>' . $title . '</h4>';
		}

		// Content
		$output .= $content;

	// End HTML
	$output .= '</div>';

	// Retrun content
	return $output;

} add_shortcode( 'info_box', 'meridian_recipes_features_info_box_sc' );

/**
 * Tabs
 *
 * @since 1.0
 */
function meridian_recipes_features_tabs_sc( $atts, $content = '' ) {

	// Attributes
	extract( shortcode_atts( array(
		'title' => false
	), $atts));

	$tabs = do_shortcode( $content );

	ob_start();

	?>

	</div><!-- .wrapper -->
		
	<div class="tabs-container">

		<div class="wrapper">

			<div class="tabs">

				<div class="tabs-nav"></div>

				<div class="tabs-content">
					<?php echo $tabs; ?>
				</div><!-- .tabs-content -->

			</div><!-- .tabs -->

		</div><!-- .wrapper -->

	</div><!-- .tabs-container -->

	<div class="wrapper">

	<?php

	$output = ob_get_contents();
	ob_end_clean();

	return $output;

} add_shortcode( 'tabs', 'meridian_recipes_features_tabs_sc' );

/**
 * Tab
 *
 * @since 1.0
 */
function meridian_recipes_features_tab_sc( $atts, $content = '' ) {

	// Attributes
	extract( shortcode_atts( array(
		'title' => 'Tab Title',
	), $atts));

	ob_start();

	?>	

		<div class="tabs-tab" data-title="<?php echo esc_attr( $title ); ?>">
			<?php echo $content; ?>
		</div><!-- .tabs-tab-->

	<?php

	$output = ob_get_contents();
	ob_end_clean();

	return $output;

} add_shortcode( 'tab', 'meridian_recipes_features_tab_sc' );

/**
 * Returns customizer option value
 *
 * @since 1.0
 */
function meridian_recipes_features_get_theme_mod( $option_id, $default = '' ) {

	$return = get_theme_mod( 'meridian_recipes_theme_' . $option_id, $default );
	if ( $return == '' ) { $return = $default; }

	return $return;

}