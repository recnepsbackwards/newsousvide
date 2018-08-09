<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

function meridian_recipes_register_required_plugins() {
	
	$plugins = array(

		array(
			'name'      => esc_html__( 'Meridian Recipes Features', 'meridian-recipes' ),
			'slug'      => 'meridian-recipes-features',
			'source'    => get_template_directory() . '/inc/tgm/plugins/meridian-recipes-features.zip',
			'required'  => true,
		),
		array(
			'name'      => esc_html__( 'Meridian Promo Bars', 'meridian-recipes' ),
			'slug'      => 'meridian-promo-bar',
			'source'    => get_template_directory() . '/inc/tgm/plugins/meridian-promo-bar.zip',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'Meridian Popups', 'meridian-recipes' ),
			'slug'      => 'meridian-popup',
			'source'    => get_template_directory() . '/inc/tgm/plugins/meridian-popup.zip',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'Meridian Styler', 'meridian-recipes' ),
			'slug'      => 'meridian-styler',
			'source'    => get_template_directory() . '/inc/tgm/plugins/meridian-styler.zip',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'Optin Forms', 'meridian-recipes' ),
			'slug'      => 'optin-forms',
			'required'  => true,
		),
		array(
			'name'      => esc_html__( 'Contact Form 7', 'meridian-recipes' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

} add_action( 'tgmpa_register', 'meridian_recipes_register_required_plugins' );
