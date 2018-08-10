<?php
/*
	Plugin Name: Meridian Promo Bar
	Description: Promo bar plugin from MeridianThemes
	Author: MeridianThemes
	Author URI: http://meridianthemes.net
	Version: 1.0
	Text Domain: meridian-promo-bar
	License: GPLv2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define( 'MERIDIAN_PROMO_BAR_FEATURES_URL', plugin_dir_url( __FILE__ ) );
define( 'MERIDIAN_PROMO_BAR_OPTIONS_PREFIX', 'meridian_promo_bar_' );
define( 'MERIDIAN_PROMO_BAR_VER', '1.0' );

/**
 * Enqueue Scripts and Styles
 *
 * @since 1.0
 */
function meridian_promo_bar_enqueue_scripts() {

	// CSS
	wp_enqueue_style( 'meridian-promo-bar-main-css', MERIDIAN_PROMO_BAR_FEATURES_URL . 'css/main.css', array(), MERIDIAN_PROMO_BAR_VER );

	// JS
	wp_enqueue_script( 'meridian-promo-bar-plugins-js', MERIDIAN_PROMO_BAR_FEATURES_URL . 'js/plugins.js', array( 'jquery' ), MERIDIAN_PROMO_BAR_VER, true );
	wp_enqueue_script( 'meridian-promo-bar-main-js', MERIDIAN_PROMO_BAR_FEATURES_URL . 'js/main.js', array( 'jquery' ), MERIDIAN_PROMO_BAR_VER, true );

} add_action( 'wp_enqueue_scripts', 'meridian_promo_bar_enqueue_scripts' );

/**
 * Register Custom Post Types
 *
 * @since 1.0
 */
function meridian_promo_bar_features_cpt() {

	// Arguments ( post type )
	$args = array(
		'labels' => array(
			'name' => __( 'Promo Bars', 'meridian-promo-bar' ),
			'singular_name' => __( 'Promo bar', 'meridian-promo-bar' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => 'promo-bar-view', 'with_front' => false ),
		'supports' => array( 'title' ),
	);

	// Register ( post type )
	register_post_type( 'mrdt_promo_bar', $args );

} add_action( 'init', 'meridian_promo_bar_features_cpt' );

/**
 * Register options
 *
 * @since 1.0
 */
function meridian_promo_bar_options() {

	$prefix = MERIDIAN_PROMO_BAR_OPTIONS_PREFIX;

	$promo_bar_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_featured',
		'title'         => esc_html__( 'Promo Bar Settings', 'meridian-promo-bar' ),
		'object_types'  => array( 'mrdt_promo_bar' ),
	) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Display On', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'MUST SELECT. Where should this promo bar be displayed. If none selected the promo bar will NOT SHOW.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'display_on',
			'type'       => 'multicheck',
			'options'    => array(
				'home' => 'Homepage',
				'page' => 'Page',
				'post' => 'Blog Post',
				'mrdt_recipes' => 'Recipe',
				'wp404' => '404 Page',
				'wparchive' => 'Archives',
				'wpsearch' => 'Search',
			)
		) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Text', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'Enter the text for the promo bar.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'text',
			'type'       => 'text',
		) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Button URL', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'Enter the URL for the button. If empty button will not be shown.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'button_url',
			'type'       => 'text',
		) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Button Text', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'Enter the text for the button. If empty button will not be shown.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'button_text',
			'type'       => 'text',
		) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Button Target', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'Choose whether clicking the button opens in the same tab or a new one.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'button_target',
			'type'       => 'select',
			'default'    => '_self',
			'options'    => array(
				'_self' => 'Same Tab',
				'_blank' => 'New Tab',
			),
		) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Delay', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'After how many milliseconds after the page loads should the promo bar show up. Example: 5000 is 5 seconds.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'delay',
			'type'       => 'text',
			'default'    => '0',
		) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Expiration ( when visitor closes )', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'When a visitor closes the promo bar, after how many days should it show up again. 0 to show every page load.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'expiration',
			'type'       => 'text',
			'default'    => '7',
		) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Sticky', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'Choose whether the promo bar remains at one position or scroll together with the window.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'sticky',
			'type'       => 'select',
			'default'    => '',
			'options'    => array(
				'disabled' => 'Disabled',
				'enabled' => 'Enabled',
			),
		) );

		$promo_bar_opts->add_field( array(
			'name'       => esc_html__( 'Animation', 'meridian-promo-bar' ),
			'desc'       => esc_html__( 'Choose the animation for the promo bar.', 'meridian-promo-bar' ),
			'id'         => $prefix . 'animation',
			'type'       => 'select',
			'default'    => 'none',
			'options'    => array(
				'none' => 'None',
				'slideDown' => 'Slide Down',
			),
		) );

} add_action( 'cmb2_admin_init', 'meridian_promo_bar_options' );

/**
 * Display
 *
 * @since 1.0
 */
function meridian_promo_bar_display() {

	$prefix = MERIDIAN_PROMO_BAR_OPTIONS_PREFIX;

	// Where are we at?
	if ( is_singular( 'post' ) ) {
		$location = 'post';
	} elseif ( is_singular( 'mrdt_recipes' ) ) {
		$location = 'mrdt_recipes';
	} elseif ( is_singular( 'page' ) ) {
		$location = 'page';
	} elseif ( is_home() || is_front_page() ) {
		$location = 'home';
	} elseif ( is_archive() ) {
		$location = 'wparchive';
	} elseif ( is_404() ) {
		$location = 'wp404';
	} elseif ( is_search() ) {
		$location = 'wparchive';
	} else {
		$location = 'other';
	}

	// Get the ID of the promo for this page
	$meridian_promo_query = new WP_Query( array(
		'post_type' => 'mrdt_promo_bar',
		'posts_per_page' => 1,
		'meta_query' => array(
			array(
				'key'     => $prefix . 'display_on',
				'value'   => $location,
				'compare' => 'LIKE',
			),
		)
	));
	$promo_bar_ID = false;
	if ( $meridian_promo_query->have_posts() ) : while ( $meridian_promo_query->have_posts() ) : $meridian_promo_query->the_post();
		$promo_bar_ID = get_the_ID();
	endwhile; endif;

	if ( ! $promo_bar_ID ) 
		return;

	// Get option values
	$promo_bar_text = get_post_meta( $promo_bar_ID, $prefix . 'text', true );
	$promo_bar_button_url = get_post_meta( $promo_bar_ID, $prefix . 'button_url', true );
	$promo_bar_button_text = get_post_meta( $promo_bar_ID, $prefix . 'button_text', true );
	$promo_bar_button_target = get_post_meta( $promo_bar_ID, $prefix . 'button_target', true );
	$promo_bar_delay = get_post_meta( $promo_bar_ID, $prefix . 'delay', true );
	$promo_bar_expiration = get_post_meta( $promo_bar_ID, $prefix . 'expiration', true );
	$promo_bar_sticky = get_post_meta( $promo_bar_ID, $prefix . 'sticky', true );
	$promo_bar_animation = get_post_meta( $promo_bar_ID, $prefix . 'animation', true );

	?>
	
	<?php if ( $promo_bar_text ) : ?>
		
		<div class="meridian-promo-bar meridian-promo-bar-sticky-<?php echo $promo_bar_sticky; ?> meridian-promo-bar-animation-<?php echo $promo_bar_animation; ?>" data-meridian-promo-bar-id="<?php echo esc_attr( $promo_bar_ID ); ?>" data-meridian-promo-bar-delay="<?php echo esc_attr( $promo_bar_delay ); ?>" data-meridian-promo-bar-expiration="<?php echo esc_attr( $promo_bar_expiration ); ?>">

			<div class="meridian-promo-bar-inner">

				<span class="meridian-promo-bar-text"><?php echo $promo_bar_text; ?></span>
				<?php if ( $promo_bar_button_text && $promo_bar_button_url ) : ?>
					<a href="<?php echo $promo_bar_button_url; ?>" target="<?php echo $promo_bar_button_target; ?>" class="meridian-promo-bar-button"><?php echo $promo_bar_button_text; ?></a>
				<?php endif; ?>

			</div><!-- .meridian-promo-bar-inner -->

			<span class="meridian-promo-bar-close">X</span>

		</div><!-- .meridian-promo-bar -->

	<?php endif; ?>

	<?php

} add_action( 'wp_footer', 'meridian_promo_bar_display' );