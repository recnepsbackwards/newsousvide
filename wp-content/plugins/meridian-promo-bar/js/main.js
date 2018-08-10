/**
 * = Table Of Contents =
 * 
 * meridian_promo_bar_display ( displays a promo bar )
 *
 * # Ready
 * # Load
 * # Scroll
 * # Resize
*/

/**
 * meridian_promo_bar_events ( events )
 */
function meridian_promo_bar_events() {

	/* close promo bar */
	jQuery(document).on( 'click', '.meridian-promo-bar-close', function(){
		meridian_promo_bar_close();
	});

}

/**
 * meridian_promo_bar_display ( displays a promo bar )
 */
function meridian_promo_bar_display() {

	// promo bar element
	var promoBar = jQuery('.meridian-promo-bar');

	// if no promo bar return
	if ( ! promoBar.length )
		return;

	// promo bar info
	var promoBarID = promoBar.data('meridian-promo-bar-id'),
	promoBarExpiration = parseInt( promoBar.data('meridian-promo-bar-expiration') ),
	cookieID = 'meridian_promo_bar_' + promoBarID,
	delay = promoBar.data('meridian-promo-bar-delay');

	if ( Cookies.get(cookieID) == undefined ) {

		// display
		setTimeout( function(){

			if ( promoBar.hasClass('meridian-promo-bar-animation-slideDown') ) {
				jQuery('body').animate({ paddingTop : promoBar.outerHeight() }, 200);
				promoBar.slideDown(200);
			} else {
				promoBar.show();
				jQuery('body').css({ paddingTop : promoBar.outerHeight() });
			}

		}, delay );

	}

}

/**
 * meridian_promo_bar_close ( closes a promo bar )
 */
function meridian_promo_bar_close() {

	// promo bar element
	var promoBar = jQuery('.meridian-promo-bar');

	// if no promo bar return
	if ( ! promoBar.length )
		return;

	// promo bar info
	var promoBarID = promoBar.data('meridian-promo-bar-id'),
	promoBarExpiration = parseInt( promoBar.data('meridian-promo-bar-expiration') ),
	cookieID = 'meridian_promo_bar_' + promoBarID;

	// set cookie so it does not show again
	if ( promoBarExpiration > 0 ) {
		Cookies.set( cookieID, { expires: promoBarExpiration });
	}

	// hide promo bar
	promoBar.hide();
	jQuery('body').css({ paddingTop : 0 });

}

/**
 * # Ready
 */
jQuery(document).ready(function($){

	meridian_promo_bar_events();
	meridian_promo_bar_display();

});

/**
 * # Load
 */
jQuery(window).load(function(){

});

/**
 * # Scroll
 */
jQuery(window).scroll(function(){

});

/**
 * # Resize
 */
jQuery(window).resize(function(){

});
