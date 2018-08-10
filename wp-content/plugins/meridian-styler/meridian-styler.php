<?php
/*
	Plugin Name: Meridian Styler
	Description: A tool for changing up the styling on themes by MeridianThemes
	Author: MeridianThemes
	Author URI: http://meridianthemes.net
	Version: 1.0.1
	Text Domain: meridian-styler
	License: GPLv2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * Constants
 */
define( 'MERIDIAN_STYLER_VER', '1.0' );
define( 'MERIDIAN_STYLER_URL', plugin_dir_url( __FILE__ ) );
define( 'MERIDIAN_STYLER_BASENAME', plugin_basename( __FILE__ ) );
define( 'MERIDIAN_STYLER_DIR_NAME', dirname( plugin_basename( __FILE__ ) ) );
define( 'MERIDIAN_STYLER_ABS', dirname(__FILE__) );

/**
 * Includes
 */
include MERIDIAN_STYLER_ABS . '/includes/general.php';
include MERIDIAN_STYLER_ABS . '/includes/display.php';
include MERIDIAN_STYLER_ABS . '/includes/ajax.php';
include MERIDIAN_STYLER_ABS . '/includes/process.php';
