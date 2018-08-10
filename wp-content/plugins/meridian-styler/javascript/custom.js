jQuery.fn.extend({
    animateCSS: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
       	jQuery(this).addClass('animated ' + animationName).one(animationEnd, function() {
            jQuery(this).removeClass('animated ' + animationName);
        });
    }
});

jQuery(window).load(function(){

    if ( jQuery('#mtst-panel-animation-data').val() ) {

    	var animData = JSON.parse( jQuery('#mtst-panel-animation-data').val() );

    	jQuery.each( animData, function( key, value ) {

    		jQuery(key).animateCSS(value);

    	});

    }

});