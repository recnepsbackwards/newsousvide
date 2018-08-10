<?php

/**
 * Register the options
 */
function meridian_recipes_customizer_register_options( $options ) {

	$prefix = MERIDIAN_RECIPES_CUSTOMIZER_PREPEND;

	// General
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'meridian_recipes_general',
		'title' => esc_html__( '- General', 'meridian-recipes' ),
	);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'meridian-recipes' ),
				'disabled' => esc_html__( 'Disabled', 'meridian-recipes' ),
			),
			'title' => esc_html__( 'Recipes Functionality', 'meridian-recipes' ),
			'id'	=> $prefix . 'recipes_functionality',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => __( 'Logo', 'meridian-recipes' ),
			'id'	=> $prefix . 'logo',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => __( 'Logo - Retina', 'meridian-recipes' ),
			'id'	=> $prefix . 'logo_retina',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_attr__( 'Logo - Admin ( login/register page )', 'meridian-recipes' ),
			'id'	=> $prefix . 'logo_admin',
			'def'	=> '',
		);

	// Social
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'meridian_recipes_social',
		'title' => __( '- Social', 'meridian-recipes' ),
	);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Twitter URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_twitter',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Facebook URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_facebook',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Youtube URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_youtube',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Vimeo URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_vimeo',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Tumblr URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_tumblr',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Pinterest URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_pinterest',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'LinkedIn URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_linkedin',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Instagram URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_instagram',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Github URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_github',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Google Plus URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_googleplus',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Dribbble URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_dribbble',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Dropbox URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_dropbox',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Flickr URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_flickr',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Foursquare URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_foursquare',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Behance URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_behance',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Vine URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_vine',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'RSS URL', 'meridian-recipes' ),
			'id'	=> $prefix . 'social_rss',
			'def'	=> '',
		);

	// Header
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'meridian_recipes_header',
		'title' => __( '- Header', 'meridian-recipes' ),
	);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => 'Enabled',
				'disabled' => 'Disabled',
			),
			'title' => esc_attr__( 'Header Search', 'meridian-recipes' ),
			'id'	=> $prefix . 'header_search_state',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => 'Enabled',
				'disabled' => 'Disabled',
			),
			'title' => esc_attr__( 'Header Social', 'meridian-recipes' ),
			'id'	=> $prefix . 'header_social_state',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => 'Enabled',
				'disabled' => 'Disabled',
			),
			'title' => esc_attr__( 'Header Account Links', 'meridian-recipes' ),
			'id'	=> $prefix . 'header_account_state',
			'def'	=> 'enabled',
		);

	// footer
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'meridian_recipes_footer',
		'title' => __( '- Footer', 'meridian-recipes' ),
	);		

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => 'Enabled',
				'disabled' => 'Disabled',
			),
			'title' => esc_attr__( 'Footer Widgets', 'meridian-recipes' ),
			'id'	=> $prefix . 'footer_widgets_state',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => 'Enabled',
				'disabled' => 'Disabled',
			),
			'title' => esc_attr__( 'Footer Bottom', 'meridian-recipes' ),
			'id'	=> $prefix . 'footer_bottom_state',
			'def'	=> 'enabled',
		);		

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Copyright Text', 'meridian-recipes' ),
			'id'	=> $prefix . 'footer_copy_text',
			'def'	=> 'Designed &amp; Developed by <a href="http://meridianthemes.net/" rel="nofollow">MeridianThemes</a>',
		);		

	// slugs
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'meridian_recipes_slugs',
		'title' => __( '- Slugs', 'meridian-recipes' ),
		'descr' => __( 'IMPORTANT: After making changes to the slugs go to WP admin > Settings > Permalinks and click "Save Changes", that will regenerate the permalinks structure.', 'meridian-recipes' ),
	);		

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Slug - Recipe Posts', 'meridian-recipes' ),
			'id'	=> $prefix . 'slug_cpt',
			'def'	=> 'recipe-view',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Slug - Recipe Category', 'meridian-recipes' ),
			'id'	=> $prefix . 'slug_cat',
			'def'	=> 'recipes-category',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_attr__( 'Slug - Recipe Tag', 'meridian-recipes' ),
			'id'	=> $prefix . 'slug_tag',
			'def'	=> 'recipes-tag',
		);

	// custom content
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'meridian_recipes_custom_content',
		'title' => __( '- Custom Content Hooks', 'meridian-recipes' ),
	);

		$options[] = array(
			'type'	=> 'option_textarea',
			'title' => esc_attr__( 'After Ingredients Content', 'meridian-recipes' ),
			'id'	=> $prefix . 'after_ingredients_content',
			'def'	=> '',
		);	

		$options[] = array(
			'type'	=> 'option_textarea',
			'title' => esc_attr__( 'After Module 3 Left Column', 'meridian-recipes' ),
			'id'	=> $prefix . 'after_module_3_secondary',
			'def'	=> '',
		);	

	// other
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'meridian_recipes_other',
		'title' => __( '- Other', 'meridian-recipes' ),
	);		

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'same_row' => 'Same row',
				'separate_rows' => 'Separate rows',
			),
			'title' => esc_attr__( 'Recipe Ingredients/Instructions Layout', 'meridian-recipes' ),
			'id'	=> $prefix . 'recipe_ing_ins_layout',
			'def'	=> 'same_row',
		);	

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'click' => 'Click to load more',
				'infinite' => 'Scroll to load more',
			),
			'title' => esc_attr__( 'Pagination ( load more ) type', 'meridian-recipes' ),
			'id'	=> $prefix . 'pagination_type',
			'def'	=> 'click',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'meridian-recipes' ),
				'disabled' => esc_html__( 'Disabled', 'meridian-recipes' ),
			),
			'title' => esc_attr__( 'Recipe/Post Sticky Sidebar', 'meridian-recipes' ),
			'id'	=> $prefix . 'sticky_sidebar_single',
			'def'	=> 'disabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'timeago' => esc_html__( 'X Days Ago', 'meridian-recipes' ),
				'date' => esc_html__( 'Actual Date', 'meridian-recipes' ),
			),
			'title' => esc_attr__( 'Date Format', 'meridian-recipes' ),
			'id'	=> $prefix . 'date_format',
			'def'	=> 'timeago',
		);

	return $options;

} add_filter( 'meridian_recipes_customizer_register', 'meridian_recipes_customizer_register_options', 10, 1 );

/**
 * Add options to customizer
 */
function meridian_recipes_customizer_register( $wp_customize ) {
	
	$customizer_options = apply_filters( 'meridian_recipes_customizer_register', array() );

	$section_priority = 200;
	$setting_priority = 5;
	$current_section_id = '';
	$current_setting_id = '';
	
	foreach ( $customizer_options as $customizer_option ) {

		if( $customizer_option['type'] == 'section' ){
			
			/* New Section */
			
			$section_priority += 50;
			$setting_priority = 5;
			$current_section_id = $customizer_option['id'];

			if ( ! isset( $customizer_option['descr'] ) )
				$customizer_option['descr'] = '';
			
			$wp_customize->add_section( $current_section_id, array(
				'title' => $customizer_option['title'],
				'priority' => $section_priority,
				'description' => $customizer_option['descr']
			) );
			
		} elseif ( $customizer_option['type'] == 'option_color' ) {
			
			/* New Option (COLOR) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default' => $customizer_option['def'],
				'type' => 'theme_mod',
				'sanitize_callback' => 'esc_html',
			) );
			
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $current_setting_id, array(
					'label' => $customizer_option['title'],
					'section' => $current_section_id,
					'priority' => $setting_priority
				) ) );
			
		} elseif ( $customizer_option['type'] == 'option_text' ) {
			
			/* New Option (TEXT) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;

			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'wp_kses',
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'text',
					'priority'	=> $setting_priority
				));
		
		} elseif ( $customizer_option['type'] == 'option_textarea' ) {
			
			/* New Option (TEXT) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;

			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => '',
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'textarea',
					'priority'	=> $setting_priority
				));

		} elseif ( $customizer_option['type'] == 'option_select' ) {
			
			/* New Option (SELECT) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'esc_html',
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'select',
					'choices'	=> $customizer_option['opts'],
					'priority'	=> $setting_priority,
				));
			
		} elseif ( $customizer_option['type'] == 'option_checkbox' ) {
			
			/* New Option (checkbox) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'esc_html',
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'checkbox',
					'priority'	=> $setting_priority,
				));
			
		} elseif ( $customizer_option['type'] == 'option_image' ) {
			
			/* New Option (image) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'esc_url_raw',
			) );
			
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'priority'	=> $setting_priority,
				) ) );
			
		}
		
	}

} add_action( 'customize_register', 'meridian_recipes_customizer_register' );