<?php
/*
	Plugin Name: Meridian Popup
	Description: Popup plugin from MeridianThemes
	Author: MeridianThemes
	Author URI: http://meridianthemes.net
	Version: 1.0.1
	Text Domain: meridian-popup
	License: GPLv2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define( 'MERIDIAN_POPUP_FEATURES_URL', plugin_dir_url( __FILE__ ) );
define( 'MERIDIAN_POPUP_OPTIONS_PREFIX', 'meridian_popup_' );
define( 'MERIDIAN_POPUP_VER', '1.0.1' );

/**
 * Enqueue Scripts and Styles
 *
 * @since 1.0
 */
function meridian_popup_enqueue_scripts() {

	// CSS
	wp_enqueue_style( 'meridian-popup-main-css', MERIDIAN_POPUP_FEATURES_URL . 'css/main.css', array(), MERIDIAN_POPUP_VER );

	// JS
	wp_enqueue_script( 'meridian-popup-plugins-js', MERIDIAN_POPUP_FEATURES_URL . 'js/plugins.js', array( 'jquery' ), MERIDIAN_POPUP_VER, true );
	wp_enqueue_script( 'meridian-popup-main-js', MERIDIAN_POPUP_FEATURES_URL . 'js/main.js', array( 'jquery' ), MERIDIAN_POPUP_VER, true );

} add_action( 'wp_enqueue_scripts', 'meridian_popup_enqueue_scripts' );

/**
 * Register Custom Post Types
 *
 * @since 1.0
 */
function meridian_popup_features_cpt() {

	// Arguments ( post type )
	$args = array(
		'labels' => array(
			'name' => __( 'Popups', 'meridian-popup' ),
			'singular_name' => __( 'Popup', 'meridian-popup' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => 'popup-view', 'with_front' => false ),
		'supports' => array( 'title' ),
	);

	// Register ( post type )
	register_post_type( 'mrdt_popup', $args );

} add_action( 'init', 'meridian_popup_features_cpt' );

/**
 * Register options
 *
 * @since 1.0
 */
function meridian_popup_options() {

	$prefix = MERIDIAN_POPUP_OPTIONS_PREFIX;

	$popup_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_featured',
		'title'         => esc_html__( 'Popup Settings', 'meridian-popup' ),
		'object_types'  => array( 'mrdt_popup' ),
	) );

		$popup_opts->add_field( array(
			'name'       => esc_html__( 'Display On', 'meridian-popup' ),
			'desc'       => esc_html__( 'MUST SELECT. Where should this popup be displayed. If none selected the popup will NOT SHOW.', 'meridian-popup' ),
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

		$popup_opts->add_field( array(
			'name'       => esc_html__( 'Banner Image', 'meridian-popup' ),
			'desc'       => esc_html__( 'Select the image that shows up at the very top.', 'meridian-popup' ),
			'id'         => $prefix . 'banner_image',
			'type'       => 'file',
		) );

		$popup_opts->add_field( array(
			'name'       => esc_html__( 'Title', 'meridian-popup' ),
			'desc'       => esc_html__( 'Enter the title for the popup.', 'meridian-popup' ),
			'id'         => $prefix . 'title',
			'type'       => 'text',
		) );

		$popup_opts->add_field( array(
			'name'       => esc_html__( 'Subtitle', 'meridian-popup' ),
			'desc'       => esc_html__( 'Enter the subtitle for the popup.', 'meridian-popup' ),
			'id'         => $prefix . 'subtitle',
			'type'       => 'textarea',
		) );		

		$popup_opts->add_field( array(
			'name'       => esc_html__( 'Content', 'meridian-popup' ),
			'desc'       => esc_html__( 'Enter the content for the popup.', 'meridian-popup' ),
			'id'         => $prefix . 'content',
			'type'       => 'textarea',
		) );	

		$popup_opts->add_field( array(
			'name'       => esc_html__( 'After Content', 'meridian-popup' ),
			'desc'       => esc_html__( 'Enter the text to show after the content.', 'meridian-popup' ),
			'id'         => $prefix . 'content_after',
			'type'       => 'text',
		) );	

		$popup_opts->add_field( array(
			'name'       => esc_html__( 'Delay', 'meridian-popup' ),
			'desc'       => esc_html__( 'After how many milliseconds after the page loads should the popup show up. Example: 5000 is 5 seconds. For it not to show automatically enter -1', 'meridian-popup' ),
			'id'         => $prefix . 'delay',
			'type'       => 'text',
			'default'    => '0',
		) );

		$popup_opts->add_field( array(
			'name'       => esc_html__( 'Expiration ( when visitor closes )', 'meridian-popup' ),
			'desc'       => esc_html__( 'When a visitor closes the popup, after how many days should it show up again. 0 to show every page load.', 'meridian-popup' ),
			'id'         => $prefix . 'expiration',
			'type'       => 'text',
			'default'    => '7',
		) );

} add_action( 'cmb2_admin_init', 'meridian_popup_options' );

/**
 * Display
 *
 * @since 1.0
 */
function meridian_popup_display() {

	$prefix = MERIDIAN_POPUP_OPTIONS_PREFIX;

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

	// Get the ID of the popup for this page
	$meridian_popup_query = new WP_Query( array(
		'post_type' => 'mrdt_popup',
		'posts_per_page' => 1,
		'meta_query' => array(
			array(
				'key'     => $prefix . 'display_on',
				'value'   => $location,
				'compare' => 'LIKE',
			),
		)
	));
	$popup_ID = false;
	if ( $meridian_popup_query->have_posts() ) : while ( $meridian_popup_query->have_posts() ) : $meridian_popup_query->the_post();
		$popup_ID = get_the_ID();
	endwhile; endif;

	if ( ! $popup_ID ) 
		return;

	// Get option values
	$popup_banner_image = get_post_meta( $popup_ID, $prefix . 'banner_image', true );
	$popup_title = get_post_meta( $popup_ID, $prefix . 'title', true );
	$popup_subtitle = get_post_meta( $popup_ID, $prefix . 'subtitle', true );
	$popup_content = get_post_meta( $popup_ID, $prefix . 'content', true );
	$popup_content_after = get_post_meta( $popup_ID, $prefix . 'content_after', true );
	$popup_delay = get_post_meta( $popup_ID, $prefix . 'delay', true );
	$popup_expiration = get_post_meta( $popup_ID, $prefix . 'expiration', true );

	?>
	
	<?php if ( $popup_ID ) : ?>
		
		<div class="meridian-popup-overlay" data-meridian-popup-id="<?php echo esc_attr( $popup_ID ); ?>" data-meridian-popup-delay="<?php echo esc_attr( $popup_delay ); ?>" data-meridian-popup-expiration="<?php echo esc_attr( $popup_expiration ); ?>">

			<div class="meridian-popup">

				<?php if ( $popup_banner_image ) : ?>
					<div class="meridian-popup-banner">
						<img src="<?php echo $popup_banner_image; ?>" alt="" />
					</div><!-- .meridian-popup-banner -->
				<?php endif; ?>

				<div class="meridian-popup-main">
					<div class="meridian-popup-title"><?php echo $popup_title; ?></div>
					<div class="meridian-popup-subtitle"><?php echo $popup_subtitle; ?></div>
					<div class="meridian-popup-content"><?php echo do_shortcode( $popup_content ); ?></div>
					<div class="meridian-popup-content-after"><?php echo do_shortcode( $popup_content_after ); ?></div>
				</div><!-- .meridian-popup-main -->

				<span class="meridian-popup-close">X</span>

			</div><!-- .meridian-popup -->

		</div><!-- .meridian-popup -->

	<?php endif; ?>

	<?php

} add_action( 'wp_footer', 'meridian_popup_display' );