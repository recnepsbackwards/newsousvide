<?php
/**
 * trident Theme Customizer
 *
 * @package trident
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trident_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section( 'trident_logo_section' ,
		array(
			'title'       => __( 'Logo', 'trident' ),
			'priority'    => 30,
			'description' => __( 'Upload a logo image/text to replace the default site name in the header', 'trident' ),
		) 
	);
	
	$wp_customize->add_setting( 'trident_logo_type', array(
		'default' => 'image',
		'sanitize_callback' => 'trident_sanitize_logo_type',
	) );
	$wp_customize->add_control( 'trident_logo_type',
		array(
			'type' => 'radio',
			'label' => __( 'Logo Type', 'trident' ),
			'section' => 'trident_logo_section',
			'choices' => array(
				'image' => __( 'Image Logo', 'trident' ),
				'text' => __( 'Text Logo', 'trident' )
			),
		)
	);
	
	/**
	 * Sanitize the logo type value.
	*/
	function trident_sanitize_logo_type( $logo_type ) {
		if ( ! in_array( $logo_type, array( 'image', 'text' ) ) ) {
			$logo_type = 'image';
		}
		return $logo_type;
	}
	
	$wp_customize->add_setting( 'trident_logo', array(
		'sanitize_callback' => 'trident_sanitize_logo_image',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'trident_logo',
		array(
			'label'    => __( 'Logo Image', 'trident' ),
			'section'  => 'trident_logo_section',
			'settings' => 'trident_logo',
		) 
	) );
	
	/**
	 * Sanitize the uploaded logo image
	*/
	function trident_sanitize_logo_image( $logo_image ) {
		$file_ext = strrchr( $logo_image, '.' );
		$whitelist = array( ".jpg",".jpeg",".gif",".png" ); 
		if ( ! in_array( $file_ext, $whitelist ) ) {
			$logo_image = '';
		}
		return $logo_image;
	}

	
	$wp_customize->add_setting( 'trident_logo_text', array(
		'sanitize_callback' => 'trident_sanitize_text',
	) );
	$wp_customize->add_control( 'trident_logo_text',
		array(
			'label' => __( 'Text for Logo', 'trident' ),
			'section' => 'trident_logo_section',
			'type' => 'text',
		)
	);

	$wp_customize->add_section( 'trident_footer_credits' ,
		array(
			'title'       => __( 'Footer Credits', 'trident' ),
			'priority'    => 200,
			'description' => __( 'Change your site\'s footer credentials', 'trident' ),
		) 
	);
	$wp_customize->add_setting( 'trident_footer_text', array(
		'sanitize_callback' => 'trident_sanitize_text',
	) );
	$wp_customize->add_control( 'trident_footer_text',
		array(
			'label' => __( 'Footer Credits', 'trident' ),
			'section' => 'trident_footer_credits',
			'type' => 'text',
		)
	);
	
	/**
	 * Sanitize provided text
	*/
	function trident_sanitize_text( $text ) {
		$text = esc_html( $text );
		return $text;
	}
	
}
add_action( 'customize_register', 'trident_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function trident_customize_preview_js() {
	wp_enqueue_script( 'trident_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'trident_customize_preview_js' );
