<?php
/**
 * trident functions and definitions
 *
 * @package trident
 */


/**
 * Activates Theme Mode
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Hide Settings Pages
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Loads OptionTree
 */
require( trailingslashit( get_template_directory() ) . 'inc/option-tree/ot-loader.php' );

/**
 * Loads Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );



/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'trident_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function trident_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on trident, use a find and replace
	 * to change 'trident' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'trident', get_template_directory() . '/assets/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'trident' ),
		'secondary' => __( 'Secondary Menu', 'trident' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'video', 'quote', 'link', 'audio' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'trident_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // trident_setup
add_action( 'after_setup_theme', 'trident_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function trident_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'trident' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Widget', 'trident' ),
		'id'            => 'header-widget',
		'before_widget' => '<div id="%1$s" class="widget trident-header-ad %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
		'name' => __( 'Footer Widget 1', 'trident' ),
		'id' => 'footer-1',
		'description' => __( 'First footer widget area', 'trident' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Footer Widget 2', 'trident' ),
		'id' => 'footer-2',
		'description' => __( 'Second footer widget area', 'trident' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Footer Widget 3', 'trident' ),
		'id' => 'footer-3',
		'description' => __( 'Third footer widget area', 'trident' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'trident_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function trident_scripts() {
	wp_enqueue_style( 'trident-style', get_stylesheet_uri(), array( 'dashicons' ), '1.0' );
	
	wp_enqueue_style( 'trident-bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.css' );
	
	wp_enqueue_style( 'trident-bootstrap-theme', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap-theme.css' );
	
	wp_enqueue_style( 'trident-custom-style', get_template_directory_uri() . '/custom.css' );

	//Add Google Fonts
	wp_register_style('trident-google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,900,400italic,600italic,700italic,900italic');
    wp_enqueue_style( 'trident-google-fonts');

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'trident-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'trident-trending-bar', get_template_directory_uri() . '/assets/js/trending-bar.js', array( 'jquery' ), '20140818', false );

	wp_enqueue_script( 'trident-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_active_widget( false, false, 'trident-google-widget', true ) ){
		wp_enqueue_script( 'trident-google-widget', get_template_directory_uri() . '/assets/js/google-widget.js', array( 'jquery' ), '20140818', true );
	}
	
	wp_enqueue_script( 'trident-bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'trident_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/* 
 * Custom Header Codes
 */
add_action( 'wp_head', 'trident_custom_header_code' ); 
function trident_custom_header_code() {
	
	// Output favicon image
	if ( ! empty( $favicon ) ) { 
		echo '<link id="favicon" rel="shortcut icon" href="' . $favicon . '" sizes="16x16 32x32 48x48" type="image/png">';
	}	
}



// Register and load custom widgets
function trident_load_widget() {
	register_widget( 'trident_recent_posts' );
	register_widget( 'trident_recent_comments' );
	register_widget( 'trident_popular_posts' );
	register_widget( 'trident_facebook_widget' );
	register_widget( 'trident_google_widget' );
}
add_action( 'widgets_init', 'trident_load_widget' );

// Include Recent Posts Widget
require_once get_template_directory() . '/inc/widgets/recent-posts-widget.php';

// Include Recent Comments Widget
require_once get_template_directory() . '/inc/widgets/recent-comments-widget.php';

// Include Popular Posts Widget
require_once get_template_directory() . '/inc/widgets/popular-posts-widget.php';

// Include Facebook Widget
require_once get_template_directory() . '/inc/widgets/widget-facebook.php';

// Include Google+ Widget
require_once get_template_directory() . '/inc/widgets/widget-google.php';

// Include custom CSS
require_once get_template_directory() . '/custom-css.php';

// Remove Search button
add_filter('get_search_form', 'trident_search_form'); 
function trident_search_form($text) {
	$text = str_replace(
		'<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s" title="Search for:" />', 
		'<input type="search" class="search-field" value="" placeholder="'.__( 'Enter your search term&hellip;', 'trident' ).'" name="s" title="'.__( 'Search for:', 'trident' ).'" />
		<button class="search-button" type="submit"><div class="dashicons dashicons-search"></div></button>', 
		$text);
	return $text;
}

// Custom styling the admin area of Option Tree
add_action('admin_print_styles-appearance_page_ot-theme-options', 'trident_custom_style');

function trident_custom_style() {
  echo '<style>
  			#option-tree-options-layouts-form {
  				display: none;
			}
		</style>';
 }


// Sanitizing the uploaded favicon. Only .ico files will be accepted, will return empty otherwise
function trident_sanitize_favicon() {
	$custom_favicon = ot_get_option('trident_custom_favicon');
	$file_ext = strrchr( $custom_favicon, '.' );
	$whitelist = array( ".ico" ); 
	if ( ! in_array( $file_ext, $whitelist ) ) {
		$custom_favicon = '';
	} else {
		?>
			<link rel="shortcut icon" href="<?php echo $custom_favicon; ?>" />
		<?php
	}
	return $custom_favicon;
}
?>