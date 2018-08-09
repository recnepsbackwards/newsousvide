<?php

/**
 * Home
 * Home Slider
 * Home Photos
 * 
 */

/**
 * Close
 */

function mt_importer_ajax_close_installer() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		update_option( 'mt_ajax_installer', 'closed' );

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_mt-ajax-close-installer', 'mt_importer_ajax_close_installer' );

/**
 * Disable recipes func
 */

function mt_importer_ajax_install_disable_recipes_func() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		// Set new locations
		set_theme_mod( MERIDIAN_RECIPES_CUSTOMIZER_PREPEND . 'recipes_functionality', 'disabled' );

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_mt-ajax-install-disable-recipes-func', 'mt_importer_ajax_install_disable_recipes_func' );

/**
 * Nav Menus
 */

function mt_importer_ajax_install_nav_menus() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		// get locations
		$locations = get_theme_mod('nav_menu_locations');

		/**
		 * Primary
		 */

		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Primary' );

		// If it doesn't exist, let's create it.
		if ( ! $menu_exists ) {
			$menu_id = wp_create_nav_menu( 'Primary' );		
			$locations['primary'] = $menu_id;
		}




		/**
		 * Footer
		 */

		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Footer' );

		// If it doesn't exist, let's create it.
		if ( ! $menu_exists ) {
			$menu_id = wp_create_nav_menu( 'Footer' );		
			$locations['footer'] = $menu_id;

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Footer Item #1',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Footer Item #2',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Footer Item #3',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

		}



		/**
		 * Side Panel
		 */

		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Side Panel' );

		// If it doesn't exist, let's create it.
		if ( ! $menu_exists ) {

			$menu_id = wp_create_nav_menu( 'Side Panel' );		
			$locations['side-panel'] = $menu_id;

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Side Item #1',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Side Item #2',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Side Item #3',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

		}



		// Set new locations
		set_theme_mod( 'nav_menu_locations', $locations );

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_mt-ajax-install-nav-menus', 'mt_importer_ajax_install_nav_menus' );

/**
 * Home Pages
 */

function mt_importer_ajax_install_home_page() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		$datas = array(
			array(
				'post_title' => 'Home #1',
				'meta' => array(
					'_meridian_recipes_featured_type' => '1',
					'_meridian_recipes_featured_post_type' => 'mrdt_recipes',
					'_meridian_recipes_featured_tag' => 'featured',
					'_meridian_recipes_home_sections' => array (
						0 => 
						array (
							'section' => 'module-6',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						1 => 
						array (
							'section' => 'module-5',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '3',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						2 => 
						array (
							'section' => 'module-7',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '4',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						3 => 
						array (
							'section' => 'module-8',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '6',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						4 => 
						array (
							'section' => 'module-search',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'ASC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 195,
							'search_bg_image' => '',
						),
						5 => 
						array (
							'section' => 'module-13',
							'section_title' => 'Section Title',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '8',
							'post_orderby' => 'rand',
							'post_order' => 'DESC',
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
						),
					)
				)
			),
			array( 
				'post_title' => 'Home #2',
				'meta' => array(
					'_meridian_recipes_featured_type' => '4',
					'_meridian_recipes_featured_post_type' => 'post',
					'_meridian_recipes_featured_tag' => 'featured',
					'_meridian_recipes_home_sections' => array (
						0 => 
						array (
							'section' => 'module-13',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						1 => 
						array (
							'section' => 'module-promo-boxes',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '#',
							'promo_box_1_bg_image_id' => 304,
							'promo_box_1_bg_image' => '',
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '#',
							'promo_box_2_bg_image_id' => 272,
							'promo_box_2_bg_image' => '',
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '#',
							'promo_box_3_bg_image_id' => 306,
							'promo_box_3_bg_image' => '',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						2 => 
						array (
							'section' => 'module-11',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '10',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '#',
							'promo_box_1_bg_image_id' => 250,
							'promo_box_1_bg_image' => '',
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						3 => 
						array (
							'section' => 'module-subscribe',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'wrapped',
							'subscribe_title' => 'Subscribe & Get The New Articles Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '[wysija_form id="1"]',
							'subscribe_bg_image_id' => 265,
							'subscribe_bg_image' => '',
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						4 => 
						array (
							'section' => 'module-1',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '',
							'post_orderby' => 'rand',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						5 => 
						array (
							'section' => 'module-7',
							'section_title' => 'Section Title',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '8',
							'post_orderby' => 'rand',
							'post_order' => 'DESC',
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
						),
					)
				)
			),
			array( 
				'post_title' => 'Home #3',
				'meta' => array(
					'_meridian_recipes_featured_type' => '2',
					'_meridian_recipes_featured_post_type' => 'mixed',
					'_meridian_recipes_featured_tag' => 'featured',
					'_meridian_recipes_home_sections' => array (
						0 => 
						array (
							'section' => 'module-3',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						1 => 
						array (
							'section' => 'module-6',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'disabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '6',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						2 => 
						array (
							'section' => 'module-12',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'disabled',
							'post_type' => 'post',
							'posts_per_page' => '4',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						3 => 
						array (
							'section' => 'module-2',
							'section_title' => 'Section Title',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'disabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '3',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
						),
					)
				)
			),
			array( 
				'post_title' => 'Home #4',
				'meta' => array(
					'_meridian_recipes_featured_type' => '3',
					'_meridian_recipes_featured_post_type' => 'post',
					'_meridian_recipes_featured_tag' => 'featured',
					'_meridian_recipes_home_sections' => array (
						0 => 
						array (
							'section' => 'module-4',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '8',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						1 => 
						array (
							'section' => 'module-13',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '4',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						2 => 
						array (
							'section' => 'module-subscribe',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'wrapped',
							'subscribe_title' => 'Subscribe & Get The Latest Articles Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '[wysija_form id="1"]',
							'subscribe_bg_image_id' => 281,
							'subscribe_bg_image' => '',
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						3 => 
						array (
							'section' => 'module-6',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'post',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						4 => 
						array (
							'section' => 'module-5',
							'section_title' => 'Section Title',
							'section_title_url' => '',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'posts_per_page' => '',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'blog_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_content' => '',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
						),
						5 => 
						array (
							'section' => 'module-3',
							'section_title' => 'Section Title',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'post_type' => 'mrdt_recipes',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'recipe_categories' => false,
							'promo_box_1_title' => 'About Myself',
							'promo_box_1_subtitle' => 'Learn More',
							'promo_box_2_title' => 'The Magazine',
							'promo_box_2_subtitle' => 'Subscribe To',
							'promo_box_3_title' => 'On Instagram',
							'promo_box_3_subtitle' => 'Follow Me',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
							'subscribe_subtitle' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Don\'t Know What To Cook? Search The Website.',
						),
					)
				)
			)
		);
		
		$menu = wp_get_nav_menu_object( 'Primary' );
		$menu = $menu->term_id;

		$count = 0;

		foreach ( $datas as $data ) {
			
			$count++;

			// Create post object
			$the_post = array(
				'post_title' => $data['post_title'],
				'post_status' => 'publish',
				'post_type' => 'page',
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $the_post );

			// If post added
			if ( $post_id ) {

				// set homepage template
				update_post_meta( $post_id, '_wp_page_template', 'template-homepage.php' );

				// Set as front page
				if ( $count == 1 ) {
					update_option( 'page_on_front', $post_id );
					update_option( 'show_on_front', 'page' );
				}

				// if meta is set
				if ( isset( $data['meta'] ) ) {
					foreach ( $data['meta'] as $meta_key => $meta_value ) {
						update_post_meta( $post_id, $meta_key, $meta_value );
					}
				}

				// add to menu
				if ( $count == 1) {
					$menu_parent = wp_update_nav_menu_item( $menu, 0, array(
						'menu-item-title' => 'Home',
						'menu-item-object' => 'page',
						'menu-item-object-id' => $post_id,
						'menu-item-type' => 'post_type',
						'menu-item-status' => 'publish',
						'menu-item-parent-id' => 0,
					));
					wp_update_nav_menu_item( $menu, 0, array(
						'menu-item-title' => $data['post_title'],
						'menu-item-object' => 'page',
						'menu-item-object-id' => $post_id,
						'menu-item-type' => 'post_type',
						'menu-item-status' => 'publish',
						'menu-item-parent-id' => $menu_parent,
					));
				} else {
					wp_update_nav_menu_item( $menu, 0, array(
						'menu-item-title' => $data['post_title'],
						'menu-item-object' => 'page',
						'menu-item-object-id' => $post_id,
						'menu-item-type' => 'post_type',
						'menu-item-status' => 'publish',
						'menu-item-parent-id' => $menu_parent,
					));
				}

			} else {
				$response['status'] = 'fail';
			}

		}

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_mt-ajax-install-home-page', 'mt_importer_ajax_install_home_page' );

/**
 * Categories
 */

function mt_importer_ajax_install_categories() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		// Insert blog categories
		$blog_cat_1 = wp_insert_term( 'Blog Category #1', 'category' );
		$blog_cat_2 = wp_insert_term( 'Blog Category #2', 'category' );
			
		// Insert recipe categories
		if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) {
			$rec_cat_1 = wp_insert_term( 'Recipe Category #1', 'mrdt_recipes_cats' );
			$rec_cat_2 = wp_insert_term( 'Recipe Category #2', 'mrdt_recipes_cats' );
		}

		// Get menu
		$menu = wp_get_nav_menu_object( 'Primary' );
		$menu = $menu->term_id;

		if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) {

			// Insert top level
			$menu_parent = wp_update_nav_menu_item( $menu, 0, array(
				'menu-item-title' => 'Recipes',
				'menu-item-object' => 'mrdt_recipes_cats',
				'menu-item-object-id' => $rec_cat_1['term_id'],
				'menu-item-type' => 'taxonomy',
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => 0,
			));

			// Insert child level
			wp_update_nav_menu_item( $menu, 0, array(
				'menu-item-title' => 'Recipe Category #1',
				'menu-item-object' => 'mrdt_recipes_cats',
				'menu-item-object-id' => $rec_cat_1['term_id'],
				'menu-item-type' => 'taxonomy',
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $menu_parent,
			));
			wp_update_nav_menu_item( $menu, 0, array(
				'menu-item-title' => 'Recipe Category #2',
				'menu-item-object' => 'mrdt_recipes_cats',
				'menu-item-object-id' => $rec_cat_2['term_id'],
				'menu-item-type' => 'taxonomy',
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => $menu_parent,
			));

		}

		// Insert top level
		$menu_parent = wp_update_nav_menu_item( $menu, 0, array(
			'menu-item-title' => 'Magazine',
			'menu-item-object' => 'category',
			'menu-item-object-id' => $blog_cat_1['term_id'],
			'menu-item-type' => 'taxonomy',
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => 0,
		));

		// Insert child level
		wp_update_nav_menu_item( $menu, 0, array(
			'menu-item-title' => 'Blog Category #1',
			'menu-item-object' => 'mrdt_recipes_cats',
			'menu-item-object-id' => $blog_cat_1['term_id'],
			'menu-item-type' => 'taxonomy',
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => $menu_parent,
		));
		wp_update_nav_menu_item( $menu, 0, array(
			'menu-item-title' => 'Blog Category #2',
			'menu-item-object' => 'mrdt_recipes_cats',
			'menu-item-object-id' => $blog_cat_2['term_id'],
			'menu-item-type' => 'taxonomy',
			'menu-item-status' => 'publish',
			'menu-item-parent-id' => $menu_parent,
		));

		$response['status'] = 'success';

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_mt-ajax-install-categories', 'mt_importer_ajax_install_categories' );


/**
 * Contact page
 */

function mt_importer_ajax_install_contact_page() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		$post_excerpt = 'Curabitur congue dolor sed massa feugiat, sit amet tempor orci convallis. Donec lacus magna, semper eget nisl sed, posuere pellentesque tellus. Cras mauris tellus, ultricies quis hendrerit imperdiet, faucibus non nulla. Cras ex dolor, aliquet eget enim nec, luctus congue nisi. Fusce facilisis in erat vitae cursus. ';
		$post_content = 'Nunc est ex, condimentum nec auctor quis, dignissim eget lacus. Pellentesque metus lorem, varius vitae erat tincidunt, elementum auctor arcu. Morbi ullamcorper enim in velit malesuada pellentesque. Cras aliquet nunc lacus, non malesuada orci suscipit sit amet. Nam ut maximus purus. Aliquam blandit ex eros, a semper tellus pellentesque eu. Cras aliquam dolor ac mauris viverra facilisis. Pellentesque ipsum mi, porttitor a odio eu, accumsan vulputate nulla.

		Insert contact form shortcode here';

		$url = get_template_directory_uri() . '/inc/importer/images/placeholder.jpg';
		$tmp = download_url( $url );
		$post_id = 0;
		$desc = 'Placeholder';
		$file_array = array();

		// Set variables for storage
		// fix file filename for query strings
		preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
		$file_array['name'] = 'placeholder.jpg';
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc );

		// If error storing permanently, unlink
		if ( is_wp_error($id) ) {
			@unlink($file_array['tmp_name']);
			return $id;
		}
		
		for ( $i=1; $i <= 1; $i++ ) { 
			
			$date = $i;
			if ( $i < 10 ) {
				$date = '0' . $i;
			}

			// Create post object
			$the_post = array(
				'post_title' => 'Contact',
				'post_status' => 'publish',
				'post_type' => 'page',
				'post_content' => $post_content,
				'post_excerpt' => $post_excerpt,
				'post_date' => date( '2016-04-01 ' . $date . ':00:00' )
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $the_post );

			if ( $post_id && $id ) {
				add_post_meta($post_id, '_thumbnail_id', $id, true);
				update_post_meta( $post_id, '_wp_page_template', 'template-page-sidebar.php' );
			}

			// Add to menu
			$menu = wp_get_nav_menu_object( 'Primary' );
			$menu = $menu->term_id;
			wp_update_nav_menu_item( $menu, 0, array(
				'menu-item-title' => 'Contact',
				'menu-item-object' => 'page',
				'menu-item-object-id' => $post_id,
				'menu-item-type' => 'post_type',
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => 0,
			));

		}

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_mt-ajax-install-contact-page', 'mt_importer_ajax_install_contact_page' );

/**
 * Blog Posts
 */

function mt_importer_ajax_install_blog_posts() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		$post_excerpt = 'Curabitur congue dolor sed massa feugiat, sit amet tempor orci convallis. Donec lacus magna, semper eget nisl sed, posuere pellentesque tellus. Cras mauris tellus, ultricies quis hendrerit imperdiet, faucibus non nulla. Cras ex dolor, aliquet eget enim nec, luctus congue nisi. Fusce facilisis in erat vitae cursus. ';
		$post_content = 'Mauris vehicula efficitur mi, vel sollicitudin lectus vulputate a. Phasellus vulputate nunc libero, eu faucibus sem bibendum in. Aenean mollis quis diam sed cursus. Integer tristique rhoncus sapien vitae semper. Mauris euismod venenatis sem vitae congue.

Duis ullamcorper diam eget porttitor sagittis. Mauris porttitor magna in interdum vestibulum. Integer nec cursus neque. Mauris eu nibh rhoncus, laoreet sapien id, tincidunt turpis. Etiam mattis dapibus laoreet. Vestibulum bibendum tortor vel felis commodo ultrices. In in elit vitae eros suscipit commodo ut tristique erat. Vestibulum vehicula turpis id quam euismod vulputate.

Quisque lacinia, purus non porta malesuada, lectus tortor iaculis odio, nec laoreet massa dui sit amet elit. Sed tempus bibendum nisi eget vehicula. Maecenas quis leo eu augue faucibus aliquam.

Quisque sed pharetra odio, eu consectetur dui. Etiam scelerisque sagittis nunc, a scelerisque lorem. Fusce commodo tempus diam sed hendrerit. In ullamcorper odio eu pretium consectetur.

Proin quis nunc ut quam fermentum dignissim. Fusce mi nisl, auctor non laoreet a, auctor vel sem. Ut quis ex quis turpis accumsan molestie. Cras lobortis, elit vitae tincidunt varius, arcu augue vehicula tellus, vel aliquet ante odio eu mi. Nam nec nulla elit.

Quisque lacinia, purus non porta malesuada, lectus tortor iaculis odio, nec laoreet massa dui sit amet elit.';

		$url = get_template_directory_uri() . '/inc/importer/images/placeholder.jpg';
		$tmp = download_url( $url );
		$post_id = 0;
		$desc = 'Placeholder';
		$file_array = array();

		// Set variables for storage
		// fix file filename for query strings
		preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
		$file_array['name'] = 'placeholder.jpg';
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc );

		// If error storing permanently, unlink
		if ( is_wp_error($id) ) {
			@unlink($file_array['tmp_name']);
			return $id;
		}
		
		for ( $i=1; $i <= 10; $i++ ) { 
			
			$date = $i;
			if ( $i < 10 ) {
				$date = '0' . $i;
			}

			// Create post object
			$the_post = array(
				'post_title' => 'Blog Post #' . $i,
				'post_status' => 'publish',
				'post_type' => 'post',
				'post_content' => $post_content,
				'post_excerpt' => $post_excerpt,
				'post_date' => date( '2016-04-01 ' . $date . ':00:00' )
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $the_post );

			if ( $post_id && $id ) {
				add_post_meta($post_id, '_thumbnail_id', $id, true);
			}

			if ( $i < 6 ) {
				wp_set_post_terms( $post_id, 'featured', 'post_tag' );
			}

			if ( $i % 2 == 0 ) {
				wp_set_object_terms( $post_id, 'blog-category-1', 'category' );
			} else {
				wp_set_object_terms( $post_id, 'blog-category-2', 'category' );
			}

		}

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_mt-ajax-install-blog-posts', 'mt_importer_ajax_install_blog_posts' );

/**
 * Recipe Posts
 */

function mt_importer_ajax_install_recipe_posts() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		$post_excerpt = 'Curabitur congue dolor sed massa feugiat, sit amet tempor orci convallis. Donec lacus magna, semper eget nisl sed, posuere pellentesque tellus. Cras mauris tellus, ultricies quis hendrerit imperdiet, faucibus non nulla. Cras ex dolor, aliquet eget enim nec, luctus congue nisi. Fusce facilisis in erat vitae cursus. ';
		$post_content = 'Mauris vehicula efficitur mi, vel sollicitudin lectus vulputate a. Phasellus vulputate nunc libero, eu faucibus sem bibendum in. Aenean mollis quis diam sed cursus. Integer tristique rhoncus sapien vitae semper. Mauris euismod venenatis sem vitae congue.';

		$url = get_template_directory_uri() . '/inc/importer/images/placeholder-recipe.jpg';
		$tmp = download_url( $url );
		$post_id = 0;
		$desc = 'Placeholder';
		$file_array = array();

		// Set variables for storage
		// fix file filename for query strings
		preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
		$file_array['name'] = 'placeholder-recipe.jpg';
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc );

		// If error storing permanently, unlink
		if ( is_wp_error($id) ) {
			@unlink($file_array['tmp_name']);
			return $id;
		}

		for ( $i=1; $i <= 10; $i++ ) { 
			
			$date = $i;
			if ( $i < 10 ) {
				$date = '0' . $i;
			}

			// Create post object
			$the_post = array(
				'post_title' => 'Recipe Post #' . $i,
				'post_status' => 'publish',
				'post_type' => 'mrdt_recipes',
				'post_content' => $post_content,
				'post_excerpt' => $post_excerpt,
				'post_date' => date( '2016-04-01 ' . $date . ':00:00' )
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $the_post );

			if ( $post_id && $id ) {
				add_post_meta($post_id, '_thumbnail_id', $id, true);
			}

			if ( $post_id ) {

				add_post_meta( $post_id, '_meridian_recipes_servings', '4 servings' );
				add_post_meta( $post_id, '_meridian_recipes_preparation_time', '25 mins' );
				add_post_meta( $post_id, '_meridian_recipes_ingredients', array ( 0 => array ( 'text' => '2 small red beets (about 4 oz.)', ), 1 => array ( 'text' => '3 tbsp. olive oil', ), 2 => array ( 'text' => '1 tbsp. whole coriander seeds', ), 3 => array ( 'text' => '2 cups loosely packed cilantro leaves, plus more to garnish', ), 4 => array ( 'text' => '1 cup loosely packed mint leaves', ), 5 => array ( 'text' => '1 tablespoon vegetable oil', ), 6 => array ( 'text' => '1 onion, chopped', ), 7 => array ( 'text' => '2 tablespoons brown sugar', ), 8 => array ( 'text' => '1/2 cup 35% cream', ), ) );
				add_post_meta( $post_id, '_meridian_recipes_instructions', array ( 0 => array ( 'text' => 'Spray a small saute pan with cooking spray, and heat over medium high heat. Dice sausage into small disks and cook breakfast sausage along with diced onion.', ), 1 => array ( 'text' => 'Microwave, uncovered, on high for 1 minute. Remove mug and stir. Cook for an additional 1 minute, or until eggs are completely set! Remove from microwave.', ), 2 => array ( 'text' => 'Spray a small saut pan with cooking spray, and heat over medium high heat. Dice sausage into small disks and cook breakfast sausage along with diced onion.', ), 3 => array ( 'text' => 'Heat the oil in a casserole dish and sear the beef cubes over high heat until nicely browned. Season generously.', ), 4 => array ( 'text' => 'Mix in the flour and brown sugar. Mix well and cook for 1 more minute.', ), 5 => array ( 'text' => 'Add the onion, garlic, thyme, paprika, and mushrooms, and cook for 5 more minutes.', ), 6 => array ( 'text' => 'Pour in the mustard, beef broth, and cream. Cover and bake for 3 hours. Adjust the seasoning if needed and serve.', ), ) );

			}

			if ( $i < 6 ) {
				wp_set_object_terms( $post_id, 'featured', 'mrdt_recipes_tags' );
			}

			if ( $i % 2 == 0 ) {
				wp_set_object_terms( $post_id, 'recipe-category-1', 'mrdt_recipes_cats' );
			} else {
				wp_set_object_terms( $post_id, 'recipe-category-2', 'mrdt_recipes_cats' );
			}

		}

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_mt-ajax-install-recipe-posts', 'mt_importer_ajax_install_recipe_posts' );