<?php
/**
 * Table Of Contents
 *
 * meridian_recipes_setup ( Sets up theme defaults and registers support for various WordPress features )
 * meridian_recipes_content_width ( Set the content width global variable )
 * meridian_recipes_register_sidebars ( Register sidebars )
 * meridian_recipes_scripts ( Enqueue scripts and styles )
 * meridian_recipes_admin_scripts ( Enqueue admin scripts and styles )
 * Include other files
 */

/**
 * Global Vars
 */

define( 'MERIDIAN_RECIPES_THEME_VER', '1.1.0' );
define( 'MERIDIAN_RECIPES_CUSTOMIZER_PREPEND', 'meridian_recipes_theme_' );
define( 'MERIDIAN_RECIPES_CMB2_PATH', get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'CMB2' );

if ( ! function_exists( 'meridian_recipes_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features
	 *
	 * @since 1.0
	 */
	function meridian_recipes_setup() {
		
		// Translation
		load_theme_textdomain( 'meridian-recipes', get_template_directory() . '/languages' );

		// Theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Register Menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'meridian-recipes' ),
			'footer' => esc_html__( 'Footer', 'meridian-recipes' ),
			'side-panel' => esc_html__( 'Side Panel', 'meridian-recipes' ),
		) );

	}

} add_action( 'after_setup_theme', 'meridian_recipes_setup' );

if ( ! function_exists( 'meridian_recipes_content_width' ) ) {

	/**
	 * Set the content width global variable
	 *
	 * @since 1.0
	 * @global int $content_width
	 */
	function meridian_recipes_content_width() {
		
		$GLOBALS['content_width'] = apply_filters( 'meridian_recipes_content_width', 1254 );

	}

} add_action( 'after_setup_theme', 'meridian_recipes_content_width', 0 );

if ( ! function_exists( 'meridian_recipes_register_sidebars' ) ) {

	/**
	 * Register Sidebars
	 *
	 * @since 1.0
	 */
	function meridian_recipes_register_sidebars() {

		// Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'meridian-recipes' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector="#sidebar .widget-title" data-mtst-label="Sidebar - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// user profile
		register_sidebar( array(
			'name'          => esc_html__( 'User Profile', 'meridian-recipes' ),
			'id'            => 'sidebar-user-profile',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector="#sidebar .widget-title" data-mtst-label="Sidebar - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 4
		register_sidebar( array(
			'name'          => esc_html__( 'Module 4 - Sidebar', 'meridian-recipes' ),
			'id'            => 'sidebar-m-4',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector=".sidebar .widget-title" data-mtst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 6
		register_sidebar( array(
			'name'          => esc_html__( 'Module 6 - Sidebar', 'meridian-recipes' ),
			'id'            => 'sidebar-m-6',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector=".sidebar .widget-title" data-mtst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 8
		register_sidebar( array(
			'name'          => esc_html__( 'Module 8 - Sidebar', 'meridian-recipes' ),
			'id'            => 'sidebar-m-8',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector=".sidebar .widget-title" data-mtst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 9
		register_sidebar( array(
			'name'          => esc_html__( 'Module 9 - Sidebar', 'meridian-recipes' ),
			'id'            => 'sidebar-m-9',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector=".sidebar .widget-title" data-mtst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 11
		register_sidebar( array(
			'name'          => esc_html__( 'Module 11 - Sidebar', 'meridian-recipes' ),
			'id'            => 'sidebar-m-11',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector=".sidebar .widget-title" data-mtst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 12
		register_sidebar( array(
			'name'          => esc_html__( 'Module 12 - Sidebar', 'meridian-recipes' ),
			'id'            => 'sidebar-m-12',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector=".sidebar .widget-title" data-mtst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// footer column 1
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 1', 'meridian-recipes' ),
			'id'            => 'sidebar-2',
			'before_widget' => '<section id="%1$s" class="widget %2$s" data-mtst-selector="#footer-widgets .widget" data-mtst-label="Footer - Widget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector="#footer .widget-title" data-mtst-label="Footer - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// footer column 2
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 2', 'meridian-recipes' ),
			'id'            => 'sidebar-3',
			'before_widget' => '<section id="%1$s" class="widget %2$s" data-mtst-selector="#footer-widgets .widget" data-mtst-label="Footer - Widget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector="#footer .widget-title" data-mtst-label="Footer - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// footer column 3
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 3', 'meridian-recipes' ),
			'id'            => 'sidebar-4',
			'before_widget' => '<section id="%1$s" class="widget %2$s" data-mtst-selector="#footer-widgets .widget" data-mtst-label="Footer - Widget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" data-mtst-selector="#footer .widget-title" data-mtst-label="Footer - Widget Title">',
			'after_title'   => '</h2>',
		) );

	}

} add_action( 'widgets_init', 'meridian_recipes_register_sidebars' );

if ( ! function_exists( 'meridian_recipes_scripts' ) ) {
	
	/**
	 * Enqueue scripts and styles
	 *
	 * @since 1.0
	 */
	function meridian_recipes_scripts() {

		// Styles
		wp_enqueue_style( 'meridian-recipes-style', get_stylesheet_uri(), array(), MERIDIAN_RECIPES_THEME_VER );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/fonts/font-awesome/font-awesome.css' );
		wp_enqueue_style( 'meridian-recipes-plugins', get_template_directory_uri() . '/css/plugins.css' );
		wp_enqueue_style( 'meridian-rercipes-print-style', get_template_directory_uri() . '/print.css', array(), MERIDIAN_RECIPES_THEME_VER, 'print' );

		// Scripts
		wp_enqueue_script( 'meridian-recipes-plugins-js', get_template_directory_uri() . '/js/plugins.js', array( 'jquery', 'jquery-effects-core' ), MERIDIAN_RECIPES_THEME_VER, true );
		wp_enqueue_script( 'meridian-recipes-main-js', get_template_directory_uri() . '/js/main.js', array(), MERIDIAN_RECIPES_THEME_VER, true );
		wp_localize_script( 'meridian-recipes-main-js', 'MeridianAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		// Google Fonts
		wp_enqueue_style( 'meridian-recipes-google-fonts', meridian_recipes_fonts_url(), array(), '1.0.0' );

		// Comment reply script
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

} add_action( 'wp_enqueue_scripts', 'meridian_recipes_scripts' );

if ( ! function_exists( 'meridian_recipes_fonts_url' ) ) {

	/**
	 * Returns the google fonts URL
	 *
	 * @since 1.0
	 */
	function meridian_recipes_fonts_url() {
		
		$font_url = '';

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$font_state = _x( 'on', 'Google fonts: on or off', 'meridian-recipes' );
		if ( 'off' !== $font_state ) {
			$font_url = add_query_arg( 'family', urlencode( 'Vollkorn:400,700,400italic|Lato:400,300,400italic,700,700italic' ), "//fonts.googleapis.com/css" );
		}

		return $font_url;
	}

}

if ( ! function_exists( 'meridian_recipes_admin_scripts' ) ) {
	
	/**
	 * Enqueue admin scripts and styles
	 *
	 * @since 1.0
	 */
	function meridian_recipes_admin_scripts() {

		wp_enqueue_style( 'meridian-recipes-admin-css', get_template_directory_uri() . '/css/admin.css' );
		wp_enqueue_script( 'meridian-recipes-admin-js', get_template_directory_uri() . '/js/admin.js' );

	} 

} add_action( 'admin_enqueue_scripts', 'meridian_recipes_admin_scripts' );

// Include TGM Init ( plugin activation )
include get_template_directory() . '/inc/tgm/tgm-init.php';

// Include Frameworks & Options
include get_template_directory() . '/inc/post-options.php';
include get_template_directory() . '/inc/user-options.php';
include get_template_directory() . '/inc/theme-options.php';
include get_template_directory() . '/inc/importer/init.php';

// Include Other
include get_template_directory() . '/inc/functions.featured.php';
include get_template_directory() . '/inc/functions.php';
include get_template_directory() . '/inc/display-functions.php';
include get_template_directory() . '/inc/ajax.php';
include get_template_directory() . '/inc/welcome.php';

// Include Widgets
include get_template_directory() . '/inc/widgets/widget.author.php';
include get_template_directory() . '/inc/widgets/widget.posts.php';
include get_template_directory() . '/inc/widgets/widget.subscribe.php';
include get_template_directory() . '/inc/widgets/widget.social.php';
include get_template_directory() . '/inc/widgets/widget.instagram.php';
include get_template_directory() . '/inc/widgets/widget.search.php';

/**
 * Handle the updates
 */
function wupdates_check( $transient ) {
	// Nothing to do here if the checked transient entry is empty
	if ( empty( $transient->checked ) ) {
		return $transient;
	}

	// Let's start gathering data about the theme
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );
	// Then WordPress version
	include( ABSPATH . WPINC . '/version.php' );
	$http_args = array (
		'body' => array(
			'slug' => $slug,
			'url' => home_url(), //the site's home URL
			'version' => 0,
			'locale' => get_locale(),
			'phpv' => phpversion(),
			'child_theme' => is_child_theme(),
			'data' => null, //no optional data is sent by default
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
	);

	// If the theme has been checked for updates before, get the checked version
	if ( isset( $transient->checked[ $slug ] ) && $transient->checked[ $slug ] ) {
		$http_args['body']['version'] = $transient->checked[ $slug ];
	}

	// Use this filter to add optional data to send
	// Make sure you return an associative array - do not encode it in any way
	$optional_data = apply_filters( 'wupdates_call_data_request', $http_args['body']['data'], $slug, $http_args['body']['version'] );

	// Encrypting optional data with private key, just to keep your data a little safer
	// You should not edit the code bellow
	$optional_data = json_encode( $optional_data );
	$w=array();$re="";$s=array();$sa=md5('c4a6fbaeaae9154234af2d156f7c906a8aa363ea');
	$l=strlen($sa);$d=$optional_data;$ii=-1;
	while(++$ii<256){$w[$ii]=ord(substr($sa,(($ii%$l)+1),1));$s[$ii]=$ii;} $ii=-1;$j=0;
	while(++$ii<256){$j=($j+$w[$ii]+$s[$ii])%255;$t=$s[$j];$s[$ii]=$s[$j];$s[$j]=$t;}
	$l=strlen($d);$ii=-1;$j=0;$k=0;
	while(++$ii<$l){$j=($j+1)%256;$k=($k+$s[$j])%255;$t=$w[$j];$s[$j]=$s[$k];$s[$k]=$t;
	$x=$s[(($s[$j]+$s[$k])%255)];$re.=chr(ord($d[$ii])^$x);}
	$optional_data=bin2hex($re);

	// Save the encrypted optional data so it can be sent to the updates server
	$http_args['body']['data'] = $optional_data;

	// Check for an available update
	$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/themes/check_version/JDOLV', 'http' );
	if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
		$url = set_url_scheme( $url, 'https' );
	}

	$raw_response = wp_remote_post( $url, $http_args );
	if ( $ssl && is_wp_error( $raw_response ) ) {
		$raw_response = wp_remote_post( $http_url, $http_args );
	}
	// We stop in case we haven't received a proper response
	if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
		return $transient;
	}

	$response = (array) json_decode($raw_response['body']);
	if ( ! empty( $response ) ) {
		// You can use this action to show notifications or take other action
		do_action( 'wupdates_before_response', $response, $transient );
		if ( isset( $response['allow_update'] ) && $response['allow_update'] && isset( $response['transient'] ) ) {
			$transient->response[ $slug ] = (array) $response['transient'];
		}
		do_action( 'wupdates_after_response', $response, $transient );
	}

	return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'wupdates_check' );

/**
 * Add the wupdates ID for the theme ( does not seem to be used )
 */
function wupdates_add_id( $ids = array() ) {
    $slug = basename( get_template_directory() );
    $ids[ $slug ] = array( 'id' => 'JDOLV', 'type' => 'theme', );

    return $ids;
}
add_filter( 'wupdates_gather_ids', 'wupdates_add_id', 10, 1 );

/**
 * Show message in theme description
 */
function wupdates_add_purchase_code_field( $themes ) {
	$output = '';
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );
	if ( ! is_multisite() && isset( $themes[ $slug ] ) ) {
		$output .= "<br/><br/>"; //put a little space above

		//get errors so we can show them
		$errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
		delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

		//check if we have a purchase code saved already
		$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
		//in case there is an update available, tell the user that it needs a valid purchase code
		if ( empty( $purchase_code ) && ! empty( $themes[ $slug ]['hasUpdate'] ) ) {
			$output .= '<div class="notice notice-error notice-alt notice-large">' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'meridian-recipes' ) . '</div>';
		}
		//output errors and notifications
		if ( ! empty( $errors ) ) {
			foreach ( $errors as $key => $error ) {
				$output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
			}
		}
		if ( ! empty( $purchase_code ) ) {
			if ( ! empty( $errors ) ) {
				//since there is already a purchase code present - notify the user
				$output .= '<div class="notice notice-warning notice-alt"><p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'meridian-recipes' ) . '</p></div>';
			} else {
				//this means a valid purchase code is present and no errors were found
				$output .= '<div class="notice notice-success notice-alt notice-large">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'meridian-recipes' ) . '</div>';
			}
		}
		$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
		$output .= '<form class="wupdates_purchase_code" action="" method="post">' .
			'<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
			'<input type="text" id="' . $purchase_code_key . '" name="' . $purchase_code_key . '"
			        value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'meridian-recipes' ) . '" style="width:100%"/>' .
			'<p>' . __( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'meridian-recipes' ) . '</p>' .
			'<p class="theme-description">' .
				__( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'meridian-recipes' ) .
				'</p>
			</form>';
	}
	//finally put the markup after the theme tags
	if ( ! isset( $themes[ $slug ]['tags'] ) ) {
		$themes[ $slug ]['tags'] = '';
	}
	$themes[ $slug ]['tags'] .= $output;

	return $themes;
}
//add_filter( 'wp_prepare_themes_for_js' ,'wupdates_add_purchase_code_field' );

/**
 * MU installation - Show message in theme description
 */
function wupdates_ms_theme_list_purchase_code_field( $theme, $r ) {
	$output = '<br/>';
	$slug = $theme->get_template();
	//get errors so we can show them
	$errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
	delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

	//check if we have a purchase code saved already
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
	//in case there is an update available, tell the user that it needs a valid purchase code
	if ( empty( $purchase_code ) ) {
		$output .=  '<p>' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'meridian-recipes' ) . '</p>';
	}
	//output errors and notifications
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $key => $error ) {
			$output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
		}
	}
	if ( ! empty( $purchase_code ) ) {
		if ( ! empty( $errors ) ) {
			//since there is already a purchase code present - notify the user
			$output .= '<p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'meridian-recipes' ) . '</p>';
		} else {
			//this means a valid purchase code is present and no errors were found
			$output .= '<p><span class="notice notice-success notice-alt">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'meridian-recipes' ) . '</span></p>';
		}
	}
	$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
	$output .= '<form class="wupdates_purchase_code" action="" method="post">' .
		'<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
		'<input type="text" id="' . $purchase_code_key . '" name="' . $purchase_code_key . '"
		        value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'meridian-recipes' ) . '"/>' . ' ' .
		__( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'meridian-recipes' ) . ' ' .
		__( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'meridian-recipes' ) .
		'</form>';

	echo $output;
}
//add_action( 'in_theme_update_message-' . basename( get_template_directory() ), 'wupdates_ms_theme_list_purchase_code_field', 10, 2 );

/**
 * Show a notice to get automatic updates
 */
function wupdates_purchase_code_needed_notice() {
	global $current_screen;

	$output = '';
	$slug = basename( get_template_directory() );
	//check if we have a purchase code saved already
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
	//if the purchase code doesn't pass the prevalidation, show notice
	if ( in_array( $current_screen->id, array( 'update-core', 'update-core-network') ) && true !== wupdates_prevalidate_purchase_code( $purchase_code ) ) {
		$output .= '<div class="updated"><p>' . sprintf( __( '<a href="%s">Please enter your purchase code</a> to get automatic updates for <b>%s</b>.', 'meridian-recipes' ), network_admin_url( 'themes.php?page=meridian-recipes-getting-started' ), wp_get_theme( $slug ) ) . '</p></div>';
	}

	echo $output;
}
add_action( 'admin_notices', 'wupdates_purchase_code_needed_notice' );
add_action( 'network_admin_notices', 'wupdates_purchase_code_needed_notice' );

/**
 * Validate purchase code
 */
function wupdates_process_purchase_code() {
	//in case the user has submitted the purchase code form
	if ( ! empty( $_POST['wupdates_pc_theme'] ) ) {
		
		$errors = array();
		$slug = sanitize_text_field( $_POST['wupdates_pc_theme'] ); // get the theme's slug
		//PHP doesn't allow dots or spaces in $_POST keys - it converts them into underscore; so we do also
		$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
		$purchase_code = false;

		// handle username
		$custom_username = false;
		if ( empty( $_POST['wupdates_custom_username'] ) ) {
			$errors[] = 'Please supply your username.';
		} else {
			$custom_username = sanitize_text_field( $_POST['wupdates_custom_username'] );
		}

		// handle password
		$custom_email = false;
		if ( empty( $_POST['wupdates_custom_email'] ) ) {
			$errors[] = 'Please supply your email address.';
		} else {
			$custom_email = sanitize_text_field( $_POST['wupdates_custom_email'] );
		}

		// handle newsletter 
		$custom_newsletter = 'NO';
		if ( ! empty( $_POST['wupdates_custom_newsletter'] ) ) {
			$custom_newsletter = 'YES';
		}

		if ( ! empty( $_POST[ $purchase_code_key ] ) ) {
			//get the submitted purchase code and sanitize it
			$purchase_code = sanitize_text_field( $_POST[ $purchase_code_key ] );
			//do a prevalidation; no need to make the API call if the format is not right
			if ( true !== wupdates_prevalidate_purchase_code( $purchase_code ) ) {
				$purchase_code = false;
			}
		}
		if ( ! empty( $purchase_code ) ) {
			//check if this purchase code represents a sale of the theme
			$http_args = array (
				'body' => array(
					'slug' => $slug, //the theme's slug
					'url' => home_url(), //the site's home URL
					'purchase_code' => $purchase_code,
				)
			);
			
			//make sure that we use a protocol that this hosting is capable of
			$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/front/check_envato_purchase_code/JDOLV', 'http' );
			if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
				$url = set_url_scheme( $url, 'https' );
			}
			//make the call to the purchase code check API
			$raw_response = wp_remote_post( $url, $http_args );
			if ( $ssl && is_wp_error( $raw_response ) ) {
				$raw_response = wp_remote_post( $http_url, $http_args );
			}
			// In case the server hasn't responded properly, show error
			if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
				$errors[] = __( 'We are sorry but we couldn\'t connect to the verification server. Please try again later.', 'meridian-recipes' ) . '<span class="hidden">' . print_r( $raw_response, true ) . '</span>';
			} elseif ( empty ( $errors ) ) {				
				$response = json_decode( $raw_response['body'], true );
				if ( ! empty( $response ) ) {
					//we will only update the purchase code if it's valid
					//this way we keep existing valid purchase codes
					if ( isset( $response['purchase_code'] ) && 'valid' == $response['purchase_code'] ) {
						//all is good, update the purchase code option
						update_option( strtolower( $slug ) . '_wup_purchase_code', $purchase_code );
						//delete the update_themes transient so we force a recheck
						set_site_transient('update_themes', null);
						// custom process
						meridian_recipes_process_activation(array(
							'username' => $custom_username,
							'email' => $custom_email,
							'theme' => $slug,
							'newsletter' => $custom_newsletter
						));
					} else {
						if ( isset( $response['reason'] ) && ! empty( $response['reason'] ) && 'out_of_support' == $response['reason'] ) {
							$errors[] = esc_html__( 'Your purchase\'s support period has ended. Please extend it to receive automatic updates.', 'meridian-recipes' );
						} else {
							$errors[] = esc_html__( 'Could not find a sale with this purchase code. Please double check.', 'meridian-recipes' );
						}
					}
				}
			}
		} else {
			//in case the user hasn't entered a valid purchase code
			$errors[] = esc_html__( 'Please enter a valid purchase code. Make sure to get all the characters.', 'meridian-recipes' );
		}

		if ( count( $errors ) > 0 ) {
			//if we do have errors, save them in the database so we can display them to the user
			update_option( strtolower( $slug ) . '_wup_errors', $errors );
		} else {
			//since there are no errors, delete the option
			delete_option( strtolower( $slug ) . '_wup_errors' );
		}

		//redirect back to the themes page and open popup
		//wp_redirect( esc_url_raw( add_query_arg( 'theme', $slug ) ) );
		//exit;

	}

}
add_action( 'admin_init', 'wupdates_process_purchase_code' );

/**
 * Pass the purchase code ( when checking for updates )
 */
function wupdates_send_purchase_code( $optional_data, $slug ) {
	//get the saved purchase code
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );

	if ( null === $optional_data ) { //if there is no optional data, initialize it
		$optional_data = array();
	}
	//add the purchase code to the optional_data so we can check it upon update check
	//if a theme has an Envato item selected, this is mandatory
	$optional_data['envato_purchase_code'] = $purchase_code;

	return $optional_data;
}
add_filter( 'wupdates_call_data_request', 'wupdates_send_purchase_code', 10, 2 );

/** 
 * Validate the format of the purchase code
 */
function wupdates_prevalidate_purchase_code( $purchase_code ) {
	$purchase_code = preg_replace( '#([a-z0-9]{8})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{12})#', '$1-$2-$3-$4-$5', strtolower( $purchase_code ) );
	if ( 36 == strlen( $purchase_code ) ) {
		return true;
	}
	return false;
}

/* End of Envato checkup code */