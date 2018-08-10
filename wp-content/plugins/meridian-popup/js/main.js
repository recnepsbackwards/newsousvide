/**
 * = Table Of Contents =
 *
 * # Ready
 * # Load
 * # Scroll
 * # Resize
*/

/**
 * meridian_popup_events ( events )
 */
function meridian_popup_events() {

	/* close popup */
	jQuery(document).on( 'click', '.meridian-popup-overlay, .meridian-popup-close', function(e){
		if(e.target != this) return;
		meridian_popup_close();
	})

	/* invoke promo */
	jQuery(document).on( 'click', 'a[href*="meridian_popup"]', function(e){
		e.preventDefault();
		meridian_popup_display( true );
	});

}

/**
 * meridian_popup_display ( displays a popup )
 */
function meridian_popup_display( invokeDisplay ) {

	invokeDisplay = typeof invokeDisplay !== 'undefined' ? invokeDisplay : false;

	// popup element
	var popup = jQuery('.meridian-popup-overlay');

	// if no popup return
	if ( ! popup.length )
		return;

	// popup info
	var popupID = popup.data('meridian-popup-id'),
	popupExpiration = parseInt( popup.data('meridian-popup-expiration') ),
	cookieID = 'meridian_popup_' + popupID,
	delay = popup.data('meridian-popup-delay');

	if ( delay == '-1' && ! invokeDisplay )
		return;

	if ( Cookies.get(cookieID) == undefined || popupExpiration == 0 ) {

		// display
		setTimeout( function(){

			// display but invisible
			popup.css({
				opacity : 0,
				display : 'block'
			});

			// make sure popup fits
			meridian_popup_fit();
			
			var centerOffset = jQuery(window).height() / 2 - popup.find('.meridian-popup').outerHeight() / 2;

			// center the content
			popup.find('.meridian-popup').css({
				marginTop : centerOffset - 50
			}).animate({ marginTop : centerOffset }, 400, 'easeOutCirc');

			// show it
			popup.animate({ opacity : 1 }, 400, 'easeOutCirc' );

		}, delay );

	}

}

/**
 * meridian_popup_center ( centers a popup )
 */
function meridian_popup_center() {

	var popup = jQuery('.meridian-popup-overlay');
	var centerOffset = jQuery(window).height() / 2 - popup.find('.meridian-popup').outerHeight() / 2;

	// center the content
	popup.find('.meridian-popup').css({
		marginTop : centerOffset
	});

}

/**
 * meridian_popup_fit ( make sure popup fits )
 */
function meridian_popup_fit() {

	var popup = jQuery('.meridian-popup');
	var windowHeight = jQuery(window).height();
	var popupHeight = popup.outerHeight();
	var banner = popup.find('.meridian-popup-banner');
	var bannerHeight = banner.outerHeight();

	var difference = popupHeight - windowHeight + 40;
	banner.css({ 'max-height' : bannerHeight - difference });

}

/**
 * meridian_popup_close ( closes a popup )
 */
function meridian_popup_close() {

	// popup element
	var popup = jQuery('.meridian-popup-overlay');

	// if no popup return
	if ( ! popup.length )
		return;

	// popup info
	var popupID = popup.data('meridian-popup-id'),
	popupExpiration = parseInt( popup.data('meridian-popup-expiration') ),
	cookieID = 'meridian_popup_' + popupID;

	// set cookie so it does not show again
	if ( popupExpiration > 0 ) {
		Cookies.set( cookieID, { expires: popupExpiration });
	}

	// hide popup
	popup.animate({ opacity : 0 }, 200, function(){
		popup.hide();
	});

}

/**
 * # Ready
 */
jQuery(document).ready(function($){

	meridian_popup_events();

});

/**
 * # Load
 */
jQuery(window).load(function(){
	meridian_popup_display();
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

	// make sure popup fits
	meridian_popup_fit();

	// center the popups
	meridian_popup_center();

});
