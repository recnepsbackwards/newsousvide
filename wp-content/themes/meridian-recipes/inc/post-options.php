<?php
/**
 * Post Options
 */

// Initiate CMB2
if ( file_exists( MERIDIAN_RECIPES_CMB2_PATH . '/init.php' ) ) { require_once MERIDIAN_RECIPES_CMB2_PATH . '/init.php'; }

/**
 * Add post options
 */
function meridian_recipes_post_options_register() {

	// Recipe categories
	$recipe_categories = get_terms( 'mrdt_recipes_cats' );
	$recipe_categories_options = array();
	if ( ! is_wp_error( $recipe_categories ) ) {
		foreach ( $recipe_categories as $recipe_category ) {
			$recipe_categories_options[$recipe_category->term_id] = $recipe_category->name;
		}
	}

	// Blog categories
	$blog_categories = get_terms( 'category' );
	$blog_categories_options = array();
	if ( ! is_wp_error( $blog_categories ) ) {
		foreach ( $blog_categories as $blog_category ) {
			$blog_categories_options[$blog_category->term_id] = $blog_category->name;
		}
	}

	$prefix = '_meridian_recipes_';

	/**
	 * Featured options
	 */

	$page_featured_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_featured',
		'title'         => esc_html__( 'Featured Section ( Header Variations )', 'meridian-recipes' ),
		'object_types'  => array( 'page' ),
	) );

		$page_featured_opts->add_field( array(
			'name' => 'What is a featured section?',
			'desc' => 'The featured section area is a blog/recipe listing shown just below the navigation. It is meant to be used on the homepage but you may use it on any page you want.',
			'type' => 'title',
			'id' => $prefix . 'featured_section_a_title'
		) );

		$page_featured_opts->add_field( array(
			'name'       => esc_html__( 'Style', 'meridian-recipes' ),
			'desc'       => esc_html__( 'Which style should the featured section have?.', 'meridian-recipes' ),
			'id'         => $prefix . 'featured_type',
			'type'       => 'select',
			'options'    => array(
				'disabled' => esc_html__( 'Disabled', 'meridian-recipes' ),
				'1'        => esc_html__( 'Style One', 'meridian-recipes' ),
				'2'        => esc_html__( 'Style Two', 'meridian-recipes' ),
				'3'        => esc_html__( 'Style Three', 'meridian-recipes' ),
				'4'        => esc_html__( 'Style Four', 'meridian-recipes' ),
				'5'        => esc_html__( 'Style Five', 'meridian-recipes' ),
			),
		) );

		if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) {

			$page_featured_opts->add_field( array(
				'name'       => esc_html__( 'Post Types', 'meridian-recipes' ),
				'desc'       => esc_html__( 'Which post types should be included in the featured section?', 'meridian-recipes' ),
				'id'         => $prefix . 'featured_post_type',
				'type'       => 'select',
				'default'    => 'mixed',
				'options'    => array(
					'post' => esc_html__( 'Blog Posts', 'meridian-recipes' ),
					'mrdt_recipes' => esc_html__( 'Recipes', 'meridian-recipes' ),
					'mixed' => esc_html__( 'Mixed ( blog + recipes )', 'meridian-recipes' ),
				),
			) );

		}

		$page_featured_opts->add_field( array(
			'name'       => esc_html__( 'Tag', 'meridian-recipes' ),
			'desc'       => esc_html__( 'Which tag should be used to get the posts for the featured section.', 'meridian-recipes' ),
			'id'         => $prefix . 'featured_tag',
			'type'       => 'text',
			'default'    => 'featured',
		) );

	/**
	 * Page options
	 */

	$page_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_page',
		'title'         => esc_html__( 'Content Sections', 'meridian-recipes' ),
		'object_types'  => array( 'page', ),
	) );

		$page_opts->add_field( array(
			'name' => 'What are content sections?',
			'desc' => 'These sections will be displayed in the main area of the page. They are meant to be used on a homepage but you may use them on any page you like. There are over 15 different modules to choose from.',
			'type' => 'title',
			'id' => $prefix . 'sections_a_title'
		) );

		// Sections
		$page_group_field = $page_opts->add_field( array(
			'id'          => $prefix . 'home_sections',
			'name'        => '',
			'type'        => 'group',
			'description' => esc_html__( '', 'meridian-recipes' ),
			'repeatable'  => true,
			'options'     => array(
				'group_title'   => esc_html__( 'Section {#}', 'meridian-recipes' ),
				'add_button'    => esc_html__( 'Add Section', 'meridian-recipes' ),
				'remove_button' => esc_html__( 'Remove Section', 'meridian-recipes' ),
				'sortable'      => true,
				'closed'        => true
			),
		) );

			/* sections */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Module',
				'description' => 'Which module should the section use?',
				'id'   => 'section',
				'type' => 'select',
				'default' => 'none',
				'options' => array(
					'none'     => esc_html__( '- Select -', 'meridian-recipes' ),
					'module-1' => esc_html__( 'Module One', 'meridian-recipes' ),
					'module-2' => esc_html__( 'Module Two', 'meridian-recipes' ),
					'module-3' => esc_html__( 'Module Three', 'meridian-recipes' ),
					'module-4' => esc_html__( 'Module Four', 'meridian-recipes' ),
					'module-5' => esc_html__( 'Module Five', 'meridian-recipes' ),
					'module-6' => esc_html__( 'Module Six', 'meridian-recipes' ),
					'module-7' => esc_html__( 'Module Seven', 'meridian-recipes' ),
					'module-8' => esc_html__( 'Module Eight', 'meridian-recipes' ),
					'module-9' => esc_html__( 'Module Nine', 'meridian-recipes' ),
					'module-10' => esc_html__( 'Module Ten', 'meridian-recipes' ),
					'module-11' => esc_html__( 'Module Eleven', 'meridian-recipes' ),
					'module-12' => esc_html__( 'Module Twelve', 'meridian-recipes' ),
					'module-13' => esc_html__( 'Module Thirteen', 'meridian-recipes' ),
					'module-14' => esc_html__( 'Module Fourteen', 'meridian-recipes' ),
					'module-15' => esc_html__( 'Module Fifteen', 'meridian-recipes' ),
					'module-16' => esc_html__( 'Module Sixteen', 'meridian-recipes' ),
					'module-promo-boxes' => esc_html__( 'Promo Boxes', 'meridian-recipes' ),
					'module-subscribe' => esc_html__( 'Subscribe', 'meridian-recipes' ),
					'module-search' =>  esc_html__( 'Search', 'meridian-recipes' ),
					'module-custom' =>  esc_html__( 'Custom Content', 'meridian-recipes' ),
				)
			) );

			/* Section Title */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Heading Title',
				'description' => 'The title for the heading element displayed at the top.',
				'id'   => 'section_title',
				'type' => 'text',
				'default' => '',
			) );

			/* Section Link */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Heading URL',
				'description' => 'The URL to which the heading element will be linked. Leave empty for no linking.',
				'id'   => 'section_title_url',
				'type' => 'text',
				'default' => '',
			) );

			/* module 11 - featured post */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'First Post Featured',
				'description' => 'Should the first post in the module have a featured style?',
				'id'   => 'module_11_featured',
				'type' => 'select',
				'default' => 'enabled',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'meridian-recipes' ),
					'disabled' => esc_html__( 'Disabled', 'meridian-recipes' ),					
				)
			) );

			/* module 12 - featured post */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'First Post Featured',
				'description' => 'Should the first post in the module have a featured style?',
				'id'   => 'module_12_featured',
				'type' => 'select',
				'default' => 'enabled',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'meridian-recipes' ),
					'disabled' => esc_html__( 'Disabled', 'meridian-recipes' ),					
				)
			) );
			
			if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) {

				/* post type */
				$page_opts->add_group_field( $page_group_field, array(
					'name' => 'Post Type',
					'description' => 'Which post type do you want to show?',
					'id'   => 'post_type',
					'type' => 'select',
					'default' => 'post',
					'options' => array(
						'post' => esc_html__( 'Blog Posts', 'meridian-recipes' ),
						'mrdt_recipes' => esc_html__( 'Recipes', 'meridian-recipes' ),
						'both' => esc_html__( 'Mixed ( recipes + blog posts )', 'meridian-recipes' ),
					)
				) );

			}

			/* amount of posts */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Amount of posts',
				'description' => 'How many posts do you want to show. If empty the amount of posts will default to the best one that fits the chosen module.',
				'id'   => 'posts_per_page',
				'type' => 'text',
			) );

			/* pagination */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Pagination',
				'description' => 'Enable/disable pagination for this module.',
				'id'   => 'post_pagination',
				'type' => 'select',
				'default' => '',
				'options' => array(
					'disabled' => esc_html__( 'Disabled', 'meridian-recipes' ),
					'enabled' => esc_html__( 'Enabled', 'meridian-recipes' ),
				)
			) );

			/* order by */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Order By',
				'description' => 'What should the posts be ordered by?',
				'id'   => 'post_orderby',
				'type' => 'select',
				'default' => 'date',
				'options' => array(
					'date' => esc_html__( 'Publish Date', 'meridian-recipes' ),
					'modified' => esc_html__( 'Modified Date', 'meridian-recipes' ),
					'title' => esc_html__( 'Title', 'meridian-recipes' ),
					'comment_count' => esc_html__( 'Comment Count', 'meridian-recipes' ),
					'rand' => esc_html__( 'Random', 'meridian-recipes' ),
				)
			) );

			/* order by */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Order',
				'description' => 'What order should the posts be shown in?',
				'id'   => 'post_order',
				'type' => 'select',
				'default' => 'DESC',
				'options' => array(
					'DESC' => esc_html__( 'Descending', 'meridian-recipes' ),
					'ASC' => esc_html__( 'Ascending', 'meridian-recipes' ),
				)
			) );

			if ( meridian_recipes_get_theme_mod( 'recipes_functionality', 'enabled' ) == 'enabled' ) {

				/* recipe categories */
				$page_opts->add_group_field( $page_group_field, array(
					'name' => 'Recipe Categories',
					'description' => 'Which categories do you want to display in this module. If none selected all categories will be included.',
					'id'   => 'recipe_categories',
					'type' => 'multicheck',
					'default' => '',
					'options' => $recipe_categories_options
				) );

			}

			/* blog categories */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Blog Categories',
				'description' => 'Which categories do you want to display in this module. If none selected all categories will be included.',
				'id'   => 'blog_categories',
				'type' => 'multicheck',
				'default' => '',
				'options' => $blog_categories_options
			) );

			/* promo boxes */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 1 - Title',
				'description' => 'Title for the promo box.',
				'id'   => 'promo_box_1_title',
				'default' => 'About Myself',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 1 - Subtitle',
				'description' => 'Subtitle for the promo box.',
				'id'   => 'promo_box_1_subtitle',
				'default' => 'Learn More',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 1 - URL',
				'description' => 'URL for the promo box.',
				'id'   => 'promo_box_1_url',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 1 - BG Image',
				'description' => 'Background image for the promo box.',
				'id'   => 'promo_box_1_bg_image',
				'type' => 'file',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 2 - Title',
				'description' => 'Title for the promo box.',
				'id'   => 'promo_box_2_title',
				'default' => 'The Magazine',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 2 - Subtitle',
				'description' => 'Subtitle for the promo box.',
				'id'   => 'promo_box_2_subtitle',
				'default' => 'Subscribe To',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 2 - URL',
				'description' => 'URL for the promo box.',
				'id'   => 'promo_box_2_url',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 2 - BG Image',
				'description' => 'Background image for the promo box.',
				'id'   => 'promo_box_2_bg_image',
				'type' => 'file',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 3 - Title',
				'description' => 'Title for the promo box.',
				'id'   => 'promo_box_3_title',
				'default' => 'On Instagram',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 3 - Subtitle',
				'description' => 'Subtitle for the promo box.',
				'id'   => 'promo_box_3_subtitle',
				'default' => 'Follow Me',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 3 - URL',
				'description' => 'URL for the promo box.',
				'id'   => 'promo_box_3_url',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Promo Box 3 - BG Image',
				'description' => 'Background image for the promo box.',
				'id'   => 'promo_box_3_bg_image',
				'type' => 'file',
			) );

			/* subscribe */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Subscribe - Style',
				'description' => 'Choose the style for the subscribe section.',
				'id'   => 'subscribe_style',
				'type' => 'select',
				'default' => 'full_width',
				'options' => array(
					'full_width' => esc_html__( 'Full Width', 'meridian-recipes' ),
					'wrapped' => esc_html__( 'Wrapped', 'meridian-recipes' ),
				)
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Subscribe - Title',
				'description' => 'Title for the subscribe section.',
				'id'   => 'subscribe_title',
				'default' => 'Subscribe & Get The Best Recipes Straight Into Your Inbox!',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Subscribe - Subtitle',
				'description' => 'Subtitle for the subscribe section.',
				'id'   => 'subscribe_subtitle',
				'default' => 'Don\'t Worry, We Don\'t Spam.',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Subscribe - Content',
				'description' => 'Content for the subscribe section.',
				'id'   => 'subscribe_content',
				'type' => 'textarea',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Subscribe - BG Image',
				'description' => 'Background image for the subscribe section.',
				'id'   => 'subscribe_bg_image',
				'type' => 'file',
			) );

			/* search */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Search - Style',
				'description' => 'Choose the style for the search section.',
				'id'   => 'search_style',
				'type' => 'select',
				'default' => 'full_width',
				'options' => array(
					'full_width' => esc_html__( 'Full Width', 'meridian-recipes' ),
					'wrapped' => esc_html__( 'Wrapped', 'meridian-recipes' ),
				)
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Search - Title',
				'description' => 'Title for the search section.',
				'id'   => 'search_title',
				'default' => 'Don\'t Know What To Cook? Search The Website.',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Search - BG Image',
				'description' => 'Background image for the search section.',
				'id'   => 'search_bg_image',
				'type' => 'file',
			) );

			/* custom */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => 'Custom Content',
				'description' => 'Supports HTML.',
				'id'   => 'custom_content',
				'type' => 'textarea_code',
			) );

	/** 
	 * General Options
	 */
	$page_general_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_general',
		'title'         => esc_html__( 'General Options', 'meridian-recipes' ),
		'object_types'  => array( 'page' ),
	) );

		$page_general_opts->add_field( array(
			'name'    => esc_html__( 'Logo', 'meridian-recipes' ),
			'desc'    => esc_html__( 'If you want to show a different logo on this page you can set it here. If not supplied the regular logo from the Customizer options will be used.', 'meridian-recipes' ),
			'id'      => $prefix . 'custom_logo',
			'type'    => 'file',
		) );

		$page_general_opts->add_field( array(
			'name'    => esc_html__( 'Logo - Retina', 'meridian-recipes' ),
			'desc'    => esc_html__( 'If you want to show a different logo on this page you can set it here. If not supplied the regular logo from the Customizer options will be used.', 'meridian-recipes' ),
			'id'      => $prefix . 'custom_logo_retina',
			'type'    => 'file',
		) );

	/**
	 * Post general options
	 */
	$post_general_options = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_post_general',
		'title'         => esc_html__( 'General Options', 'meridian-recipes' ),
		'object_types'  => array( 'post', 'mrdt_recipes' ),
	) );

		$post_general_options->add_field( array(
			'name'       => esc_html__( 'Layout', 'meridian-recipes' ),
			'desc'       => esc_html__( 'With or without sidebar?', 'meridian-recipes' ),
			'id'         => $prefix . 'post_layout',
			'type'       => 'select',
			'options'    => array(
				'with_sidebar' => esc_html__( 'Content + Sidebar', 'meridian-recipes' ),
				'full_width' => esc_html__( 'Full Width Content', 'meridian-recipes' ),
			),
		) );

	/**
	 * recipe options
	 */

	$recipe_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_recipe',
		'title'         => esc_html__( 'Recipe Options', 'meridian-recipes' ),
		'object_types'  => array( 'mrdt_recipes' ),
	) );

		/**
		 * Servings
		 */
		$recipe_opts->add_field( array(
			'name' => 'Servings',
			'description' => 'The number of servings. Example: 4 servings',
			'id'   => $prefix . 'servings',
			'type' => 'text',
			'default' => '',
		) );

		/**
		 * Preparation Time
		 */
		$recipe_opts->add_field( array(
			'name' => 'Preparation Time',
			'description' => 'Enter the time needed to prepare. Example: 45 mins',
			'id'   => $prefix . 'preparation_time',
			'type' => 'text',
			'default' => '',
		) );

		/**
		 *  Ingredients
		 */

		$recipe_opts->add_field( array(
			'name' => 'Ingredients',
			'desc' => 'In the options below add the ingredients used in this recipes.',
			'type' => 'title',
			'id' => $prefix . 'ingredients_a_title'
		) );

		$recipes_ingredients_group = $recipe_opts->add_field( array(
			'id'          => $prefix . 'ingredients',
			'name'        => '',
			'type'        => 'group',
			'description' => '',
			'repeatable'  => true,
			'options'     => array(
				'group_title'   => esc_html__( 'Ingredient {#}', 'meridian-recipes' ),
				'add_button'    => esc_html__( 'Add Ingredient', 'meridian-recipes' ),
				'remove_button' => esc_html__( 'Remove Ingredient', 'meridian-recipes' ),
				'sortable'      => true,
				'closed'        => true
			),
		) );

			$recipe_opts->add_group_field( $recipes_ingredients_group, array(
				'name' => 'Text',
				'id'   => 'text',
				'type' => 'textarea_code',
				'default' => '',
			) );

		/**
		 *  Instructions
		 */
		$recipe_opts->add_field( array(
			'name' => 'Instructions',
			'desc' => 'In the options below add the instructions on how to prepare this recipe step by step.',
			'type' => 'title',
			'id' => $prefix . 'instructions_a_title'
		) );

		$recipes_instructions_group = $recipe_opts->add_field( array(
			'id'          => $prefix . 'instructions',
			'name'        => '',
			'type'        => 'group',
			'description' => '',
			'repeatable'  => true,
			'options'     => array(
				'group_title'   => esc_html__( 'Instruction {#}', 'meridian-recipes' ),
				'add_button'    => esc_html__( 'Add Instruction', 'meridian-recipes' ),
				'remove_button' => esc_html__( 'Remove Instruction', 'meridian-recipes' ),
				'sortable'      => true,
				'closed'        => true
			),
		) );

			$recipe_opts->add_group_field( $recipes_instructions_group, array(
				'name' => 'Text',
				'id'   => 'text',
				'type' => 'textarea',
				'default' => '',
			) );

			$recipe_opts->add_group_field( $recipes_instructions_group, array(
				'name' => 'Image',
				'id'   => 'image',
				'type' => 'file',
				'default' => '',
			) );


} add_action( 'cmb2_admin_init', 'meridian_recipes_post_options_register' );