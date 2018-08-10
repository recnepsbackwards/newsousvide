<?php
/**
 * # Enqueue Scripts and Styles ( meridian_styler_enqueues )
 * # Can the user access? ( meridian_styler_user_can_acces )
 * # Can the user save? ( meridian_styler_user_can_acces )
 * # Get the CSS code ( meridian_styler_get_css_code )
 * # Output CSS code ( meridian_styler_output_css_code )
 * # Get Google Fonts ( meridian_styler_output_google_fonts_import )
 */

/**
 * Enqueue Scripts and Styles
 *
 * @since 1.0
 */
function meridian_styler_enqueues() {

	// CSS
	wp_enqueue_style( 'meridian-styler-css-animate', MERIDIAN_STYLER_URL . 'css/animate.css', array(), MERIDIAN_STYLER_VER );

	// JS
	wp_enqueue_script( 'meridian-styler-js-custom', MERIDIAN_STYLER_URL . 'javascript/custom.js', array( 'jquery' ), MERIDIAN_STYLER_VER, true );

	if ( meridian_styler_user_can_acces() ) {

		// Fonts Arrays
		$fonts = array(
			'regular' => array( "Georgia", "Times", "Arial", "Lucida Sans Unicode", "Tahoma", "Trebuchet MS", "Verdana", "Helvetica" ),
			'google' => array( "ABeeZee","Abel","Abril Fatface","Aclonica","Acme","Actor","Adamina","Advent Pro","Aguafina Script","Akronim","Aladin","Aldrich","Alef","Alegreya","Alegreya SC","Alex Brush","Alfa Slab One","Alice","Alike","Alike Angular","Allan","Allerta","Allerta Stencil","Allura","Almendra","Almendra Display","Almendra SC","Amarante","Amaranth","Amatic SC","Amethysta","Anaheim","Andada","Andika","Annie Use Your Telescope","Anonymous Pro","Antic","Antic Didone","Antic Slab","Anton","Arapey","Arbutus","Arbutus Slab","Architects Daughter","Archivo Black","Archivo Narrow","Arimo","Arizonia","Armata","Artifika","Arvo","Asap","Asset","Astloch","Asul","Atomic Age","Aubrey","Audiowide","Autour One","Average","Average Sans","Averia Gruesa Libre","Averia Libre","Averia Sans Libre","Averia Serif Libre","Bad Script","Balthazar","Bangers","Basic","Baumans","Belgrano","Belleza","BenchNine","Bentham","Berkshire Swash","Bevan","Bigelow Rules","Bigshot One","Bilbo","Bilbo Swash Caps","Bitter","Black Ops One","Bonbon","Boogaloo","Bowlby One","Bowlby One SC","Brawler","Bree Serif","Bubblegum Sans","Bubbler One","Buda","Buenard","Butcherman","Butterfly Kids","Cabin","Cabin Condensed","Cabin Sketch","Caesar Dressing","Cagliostro","Calligraffitti","Cambo","Candal","Cantarell","Cantata One","Cantora One","Capriola","Cardo","Carme","Carrois Gothic","Carrois Gothic SC","Carter One","Caudex","Cedarville Cursive","Ceviche One","Changa One","Chango","Chau Philomene One","Chela One","Chelsea Market","Cherry Cream Soda","Cherry Swash","Chewy","Chicle","Chivo","Cinzel","Cinzel Decorative","Clicker Script","Coda","Coda Caption","Codystar","Combo","Comfortaa","Coming Soon","Concert One","Condiment","Contrail One","Convergence","Cookie","Copse","Corben","Courgette","Cousine","Coustard","Covered By Your Grace","Crafty Girls","Creepster","Crete Round","Crimson Text","Croissant One","Crushed","Cuprum","Cutive","Cutive Mono","Damion","Dancing Script", "Dawning of a New Day","Days One","Delius","Delius Swash Caps","Delius Unicase","Della Respira","Denk One","Devonshire","Didact Gothic","Diplomata","Diplomata SC","Domine","Donegal One","Doppio One","Dorsa","Dosis","Dr Sugiyama","Droid Sans","Droid Sans Mono","Droid Serif","Duru Sans","Dynalight","Eagle Lake","Eater","EB Garamond","Economica","Electrolize","Elsie","Elsie Swash Caps","Emblema One","Emilys Candy","Engagement","Englebert","Enriqueta","Erica One","Esteban","Euphoria Script","Ewert","Exo","Expletus Sans","Fanwood Text","Fascinate","Fascinate Inline","Faster One","Fauna One","Federant","Federo","Felipa","Fenix","Finger Paint","Fjalla One","Fjord One","Flamenco","Flavors","Fondamento","Fontdiner Swanky","Forum","Francois One","Freckle Face","Fredericka the Great","Fredoka One","Fresca","Frijole","Fruktur","Fugaz One","Gabriela","Gafata","Galdeano","Galindo","Gentium Basic","Gentium Book Basic","Geo","Geostar","Geostar Fill","Germania One","GFS Didot","GFS Neohellenic","Gilda Display","Give You Glory","Glass Antiqua","Glegoo","Gloria Hallelujah","Goblin One","Gochi Hand","Gorditas","Goudy Bookletter 1911","Graduate","Grand Hotel","Gravitas One","Great Vibes","Griffy","Gruppo","Gudea","Habibi","Hammersmith One","Hanalei","Hanalei Fill","Handlee","Happy Monkey","Headland One","Henny Penny","Herr Von Muellerhoff","Holtwood One SC","Homemade Apple","Homenaje","Iceberg","Iceland","IM Fell Double Pica","IM Fell Double Pica SC","IM Fell DW Pica","IM Fell DW Pica SC","IM Fell English","IM Fell English SC","IM Fell French Canon","IM Fell French Canon SC","IM Fell Great Primer","IM Fell Great Primer SC","Imprima","Inconsolata","Inder","Indie Flower","Inika","Irish Grover","Istok Web","Italiana","Italianno","Jacques Francois","Jacques Francois Shadow","Jim Nightshade","Jockey One","Jolly Lodger","Josefin Sans","Josefin Slab","Joti One","Judson","Julee","Julius Sans One","Junge","Jura","Just Another Hand","Just Me Again Down Here","Kameron","Karla","Kaushan Script","Kavoon","Keania One","Kelly Slab","Kenia","Kite One","Knewave","Kotta One","Kranky","Kreon","Kristi","Krona One","La Belle Aurore","Lancelot","Lato","League Script","Leckerli One","Ledger","Lekton","Lemon","Libre Baskerville","Life Savers","Lilita One","Lily Script One","Limelight","Linden Hill","Lobster","Lobster Two","Londrina Outline","Londrina Shadow","Londrina Sketch","Londrina Solid","Lora","Love Ya Like A Sister","Loved by the King","Lovers Quarrel","Luckiest Guy","Lusitana","Lustria","Macondo","Macondo Swash Caps","Magra","Maiden Orange","Mako","Marcellus","Marcellus SC","Marck Script","Margarine","Marko One","Marmelad","Marvel","Mate","Mate SC","Maven Pro","McLaren","Meddon","MedievalSharp","Medula One","Megrim","Meie Script","Merienda","Merienda One","Merriweather","Merriweather Sans","Metal Mania","Metamorphous","Metrophobic","Michroma","Milonga","Miltonian","Miltonian Tattoo","Miniver","Miss Fajardose","Modern Antiqua","Molengo","Molle","Monda","Monofett","Monoton","Monsieur La Doulaise","Montaga","Montez","Montserrat","Montserrat Alternates","Montserrat Subrayada","Mountains of Christmas","Mouse Memoirs","Mr Bedfort","Mr Dafoe","Mr De Haviland","Mrs Saint Delafield","Mrs Sheppards","Muli","Mystery Quest","Neucha","Neuton","New Rocker","News Cycle","Niconne","Nixie One","Nobile","Norican","Nosifer","Nothing You Could Do","Noticia Text","Noto Sans","Noto Serif","Nova Cut","Nova Flat","Nova Mono","Nova Oval","Nova Round","Nova Script","Nova Slim","Nova Square","Numans","Nunito","Offside","Old Standard TT","Oldenburg","Oleo Script","Oleo Script Swash Caps","Open Sans","Open Sans Condensed","Oranienbaum","Orbitron","Oregano","Orienta","Original Surfer","Oswald","Over the Rainbow","Overlock","Overlock SC","Ovo","Oxygen","Oxygen Mono","Pacifico","Paprika","Parisienne","Passero One","Passion One","Pathway Gothic One","Patrick Hand","Patrick Hand SC","Patua One","Paytone One","Peralta","Permanent Marker","Petit Formal Script","Petrona","Philosopher","Piedra","Pinyon Script","Pirata One","Plaster","Play","Playball","Playfair Display","Playfair Display SC","Podkova","Poiret One","Poller One","Poly","Pompiere","Pontano Sans","Poppins","Port Lligat Sans","Port Lligat Slab","Prata","Press Start 2P","Princess Sofia","Prociono","Prosto One","PT Mono","PT Sans","PT Sans Caption","PT Sans Narrow","PT Serif","PT Serif Caption","Puritan","Purple Purse","Quando","Quantico","Quattrocento","Quattrocento Sans","Questrial","Quicksand","Quintessential","Qwigley","Racing Sans One","Radley","Raleway","Raleway Dots","Rambla","Rammetto One","Ranchers","Rancho","Rationale","Redressed","Reenie Beanie","Revalia","Ribeye","Ribeye Marrow","Righteous","Risque","Roboto","Roboto Condensed","Roboto Slab","Rochester","Rock Salt","Rokkitt","Romanesco","Ropa Sans","Rosario","Rosarivo","Rouge Script","Ruda","Rufina","Ruge Boogie","Ruluko","Rum Raisin","Ruslan Display","Russo One","Ruthie","Rye","Sacramento","Sail","Salsa","Sanchez","Sancreek","Sansita One","Sarina","Satisfy","Scada","Schoolbell","Seaweed Script","Sevillana","Seymour One","Shadows Into Light","Shadows Into Light Two","Shanti","Share","Share Tech","Share Tech Mono","Shojumaru","Short Stack","Sigmar One","Signika","Signika Negative","Simonetta","Sintony","Sirin Stencil","Six Caps","Skranji","Slackey","Smokum","Smythe","Sniglet","Snippet","Snowburst One","Sofadi One","Sofia","Sonsie One","Sorts Mill Goudy","Source Code Pro","Source Sans Pro","Special Elite","Spicy Rice","Spinnaker","Spirax","Squada One","Stalemate","Stalinist One","Stardos Stencil","Stint Ultra Condensed","Stint Ultra Expanded","Stoke","Strait","Sue Ellen Francisco","Sunshiney","Supermercado One","Swanky and Moo Moo","Syncopate","Tangerine","Tauri","Telex","Tenor Sans","Text Me One","The Girl Next Door","Tienne","Tinos","Titan One","Titillium Web","Trade Winds","Trocchi","Trochut","Trykker","Tulpen One","Ubuntu","Ubuntu Condensed","Ubuntu Mono","Ultra","Uncial Antiqua","Underdog","Unica One","UnifrakturCook","UnifrakturMaguntia","Unkempt","Unlock","Unna","Vampiro One","Varela","Varela Round","Vast Shadow","Vibur","Vidaloka","Viga","Voces","Volkhov","Vollkorn","Voltaire","VT323","Waiting for the Sunrise","Wallpoet","Walter Turncoat","Warnes","Wellfleet","Wendy One","Wire One","Yanone Kaffeesatz","Yellowtail","Yeseva One","Yesteryear","Zeyada" ),
		);

		// WP CSS
		wp_enqueue_style( 'jquery-ui-slider' );

		// CSS
		wp_enqueue_style( 'meridian-styler-panel-css-plugins', MERIDIAN_STYLER_URL . 'css/panel/plugins.css', array(), MERIDIAN_STYLER_VER );
		wp_enqueue_style( 'meridian-styler-panel-css-font-awesome', MERIDIAN_STYLER_URL . 'css/panel/font-awesome.css', array(), MERIDIAN_STYLER_VER );
		wp_enqueue_style( 'meridian-styler-panel-css-custom', MERIDIAN_STYLER_URL . 'css/panel/custom.css', array(), MERIDIAN_STYLER_VER );

		// WP JavaScript
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
		wp_enqueue_script( 'jquery-effects-core' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'wp-color-picker' );

		// Outside JavaScript
		wp_enqueue_script( 'meridian-styler-panel-google-webfont', '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js' );

		// JavaScript
		wp_enqueue_script( 'meridian-styler-panel-js-plugins', MERIDIAN_STYLER_URL . 'javascript/panel/plugins.js', array( 'jquery' ), MERIDIAN_STYLER_VER, true );
		wp_enqueue_script( 'meridian-styler-panel-js-custom', MERIDIAN_STYLER_URL . 'javascript/panel/custom.js', array(), MERIDIAN_STYLER_VER, true );

		// Localize JS ( AJAX )
		if ( is_ssl() )
			wp_localize_script( 'meridian-styler-panel-js-custom', 'MTSTAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php', 'https' ) ) );
		else
			wp_localize_script( 'meridian-styler-panel-js-custom', 'MTSTAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php', 'http' ) ) );

		// Localize JS ( fonts )
		wp_localize_script( 'meridian-styler-panel-js-custom', 'MTSTFonts', $fonts );

	}

} add_action( 'wp_enqueue_scripts', 'meridian_styler_enqueues' );

/**
 * Can the user access?
 *
 * @since 1.0
 */
function meridian_styler_user_can_acces() {

	// Return true if the user is logged in AND can manage options
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
		return true;
	// If not return false
	} else {
		return false;
	}

}

/**
 * Can the user save?
 *
 * @since 1.0
 */
function meridian_styler_user_can_save() {

	// Return true if the user is logged in AND can manage options
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
		return true;
	// If not return false
	} else {
		return false;
	}

}

/**
 * Get the CSS code
 *
 * @since 1.0
 */
function meridian_styler_get_css_code() {

	return get_option( 'mtst_css_code', false );

}

/**
 * Output CSS code
 *
 * @since 1.0
 */
function meridian_styler_output_css_code() {

	if ( meridian_styler_get_css_code() ) {

		echo '<style type="text/css">' . meridian_styler_get_css_code() . '</style>';

	}

} add_action( 'wp_footer', 'meridian_styler_output_css_code' );

/**
 * Output Google Fonts CSS
 *
 * @since 1.0
 */
function meridian_styler_output_google_fonts_import() {

	// If no data return
	if ( ! meridian_styler_get_js_data() )
		return;

	// Fonts
	$fonts = array();

	// Fonts import
	$fonts_import = '@import url("//fonts.googleapis.com/css?family=';

	// Get data
	$data = maybe_unserialize( meridian_styler_get_js_data( false ) );

	// Go through each selector
	foreach ( $data as $selector => $rules ) {

		// Check if font family set
		if ( isset( $rules['font-family'] ) ) {
			$fonts[] = $rules['font-family'];
		}

	}

	// Go through each font and generate code
	foreach ( $fonts as $font ) {
		$font = str_replace(' ', '+', $font );
		$fonts_import .=  $font . ':400,100,300,700,900|';
	}

	// Remove last |
	$fonts_import = rtrim( $fonts_import, '|' );

	// Close import
	$fonts_import .= '")';

	echo '<style type="text/css">' . $fonts_import . '</style>';

} add_action( 'wp_footer', 'meridian_styler_output_google_fonts_import' );

/**
 * Get the JS data
 *
 * @since 1.0
 */
function meridian_styler_get_js_data( $encode = true ) {

	if ( get_option( 'mtst_js_data', false ) ) {
		if ( $encode )
			return json_encode( get_option( 'mtst_js_data', false ) );
		else
			return get_option( 'mtst_js_data', false );
	} else {
		return false;
	}

}

/**
 * Get the animation data
 *
 * @since 1.0
 */
function meridian_styler_get_animation_data( $encode = true ) {

	if ( get_option( 'mtst_animation_data', false ) ) {
		if ( $encode )
			return json_encode( get_option( 'mtst_animation_data', false ) );
		else
			return get_option( 'mtst_animation_data', false );
	} else {
		return false;
	}

}