/**
 * trident-bar.js
 *
 * Used for handling the trending bar on top.
 */

jQuery( document ).ready(function( $ ) {
	$('.trending-ticker ul').each(function() {				
		if (!$(this).find('li.active').length) {
			$(this).find('li:first').addClass('active');
		}
		
		var ticker = $(this);
		
		window.setInterval(function() {
			
			var active = ticker.find('li.active');
			active.fadeOut(function() {
				
				var next = active.next();
				if (!next.length) {
					next = ticker.find('li:first');
				}
				
				next.addClass('active').fadeIn();
				active.removeClass('active');
			});

		}, 3000);
	});
});