"use strict";

/**
 * = Table Of Contents =
 * 
 * meridian_recipes_social_share ( Social sharing )
 * meridian_recipes_carousel ( Carousel )
 * meridian_recipes_retina_img_replace ( Retina images replace )
 *
 * # Ready
 * # Load
 * # Scroll
 * # Resize
*/

/**
 * share
 */
function meridian_recipes_share( postID ) {

	// AJAX
	jQuery.ajax({
		method: 'POST',
		type: 'POST',
		url: MeridianAjax.ajaxurl,
		data: {
			action : 'meridian-recipes-ajax-share',
			mt_post_id : postID,
		},
		timeout: 10000
	}).done(function( response ) {

		jQuery('.share-post-inner').html( response.output );

		var popup = jQuery('.share-post-overlay');

		var centerOffset = jQuery(window).height() / 2 - popup.find('.share-post').outerHeight() / 2;

		// center the content
		popup.find('.share-post').animate({
			marginTop : centerOffset
		}, 400, 'easeOutCirc');

	}).fail(function( response ) {

		if ( response.statusText == 'timeout' ) {
			alert( 'The request timed out after 10 seconds. Please try again. ( Error 2 )' );
		} else {
			alert( 'Well this is odd, something went wrong. Please try again. ( Error 3 )' );
		}

	}).always(function( reseponse ) {

		

	});

}

/**
 * rate
 */
function meridian_recipes_rate( postID, rating ) {

	// AJAX
	jQuery.ajax({
		method: 'POST',
		type: 'POST',
		url: MeridianAjax.ajaxurl,
		data: {
			action : 'meridian-recipes-ajax-rate',
			mt_post_id : postID,
			mt_rating : rating
		},
		timeout: 10000
	}).done(function( response ) {

		// Success
		if ( response.status == 'success' ) {

			var rateText = jQuery('.recipe-post-single-rating-rate');
			rateText.find('.recipe-post-single-rating-rate-text').text( rateText.data('rated-text') );

			jQuery('.recipe-post-single-meta-item.recipe-post-single-rating').html( response.rating_html );
			jQuery('.recipe-post-single-top-rate-main').html('<span class="fa fa-star"></span> recipe rated');
			
		// FAIL
		} else {
			if ( response.status_reason != 'none' ) {
				alert( response.status_reason );
			} else {
				alert( 'Something went wrong. Please try again. ( Error 1 )' );
			}
		}

	}).fail(function( response ) {

		if ( response.statusText == 'timeout' ) {
			alert( 'The request timed out after 10 seconds. Please try again. ( Error 2 )' );
		} else {
			alert( 'Well this is odd, something went wrong. Please try again. ( Error 3 )' );
		}

	}).always(function( reseponse ) {

		

	});

}

/**
 * cookmode
 */
function meridian_recipes_cookmode() {

	//  return if not on recipe single
	if ( ! jQuery('.cookmode').length )
		return;

	// Get HTML
	var cookmode = jQuery('.cookmode'),
	content = jQuery('#content'),
	contentHTML = content.html();

	// Add HTML
	cookmode.find('.cookmode-main').html( contentHTML );

	// Remove HTML
	cookmode.find('#comments, .recipe-post-single-thumb').remove();

	// Get related posts HTML
	var related = jQuery('#footer-posts .wrapper'),
	relatedHTML = related.html();

	// Add HTML
	cookmode.find('.cookmode-bottom').html( relatedHTML );

}

/**
 * bookmark
 */
function meridian_recipes_bookmark( postID, postType ) {

	// AJAX
	jQuery.ajax({
		method: 'POST',
		type: 'POST',
		url: MeridianAjax.ajaxurl,
		data: {
			action : 'meridian-recipes-ajax-bookmark',
			mt_post_id : postID,
			mt_post_type : postType
		},
		timeout: 10000
	}).done(function( response ) {

		// Success
		if ( response.status == 'success' ) {

			if ( response.action == 'add' ) { 
				if ( postType == 'mrdt_recipes' ) {
					jQuery('.bookmark-recipe-hook').html('<span class="fa fa-bookmark"></span> bookmarked');
				} else {
					jQuery('.bookmark-blog-hook').html('<span class="fa fa-bookmark"></span> bookmarked');
				}
			} else if ( response.action = 'remove' ) {
				if ( postType == 'mrdt_recipes' ) {
					jQuery('.bookmark-recipe-hook').html('<span class="fa fa-bookmark-o"></span> bookmark');
				} else {
					jQuery('.bookmark-blog-hook').html('<span class="fa fa-bookmark-o"></span> bookmark');
				}
			}
			
		// FAIL
		} else {
			if ( response.status_reason != 'none' ) {
				alert( response.status_reason );
			} else {
				alert( 'Something went wrong. Please try again. ( Error 1 )' );
			}
		}

	}).fail(function( response ) {

		if ( response.statusText == 'timeout' ) {
			alert( 'The request timed out after 10 seconds. Please try again. ( Error 2 )' );
		} else {
			alert( 'Well this is odd, something went wrong. Please try again. ( Error 3 )' );
		}

	}).always(function( reseponse ) {

	});

}

/**
 * social sharing
 */
function meridian_recipes_social_share( width, height, url ) {

	// vars
	var leftPosition, topPosition, u, t, windowFeatures;

	// positions
	leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
	topPosition = (window.screen.height / 2) - ((height / 2) + 50);
	
	// window features
	windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";

	// other
	u=location.href;
	t=document.title;

	// open up new window
	window.open(url,'sharer', windowFeatures);

	// return
	return false;

}

/**
 * Carousel
 */

function meridian_recipes_carousel() {

	// each carousel
	jQuery('.carousel').each(function(){

		// vars
		var pagination,
		items,
		single = false;

		jQuery(this).show();

		// pagination
		if ( jQuery(this).data('pagination') == true ) {
			pagination = true;
		} else {
			pagination = false;
		}

		// items
		if ( jQuery(this).data('items') ) {
			items = jQuery(this).data('items');
		} else {
			items = 3;
		}

		// single
		if ( items == 1 ) {
			single = true;
		}

		// vars
		var firstItem = jQuery(this).find('.carousel-item:first'),
		slider = jQuery(this),
		spacing = jQuery('.wrapper').width() / 100 * 2.76 / 2;

		// no spacing
		if ( slider.closest('.no-col-spacing').length ) {
			spacing = 0;
		}

		// apply sizes
		if ( single == false ) {
			slider.find('.carousel-item').css({ 'padding-left' : spacing, 'padding-right' : spacing });
			slider.css({ 'margin-left' : spacing * -1, 'width' : jQuery('.wrapper').width() + spacing * 2 });
		}

		if ( slider.closest('.featured-4').length || slider.closest('.module-16-wrapper').length ) {

			// Content
			var duplicateContent = slider.html();

			// Duplicate if not iPhone
			if( ! navigator.userAgent.match(/iPhone/i) ) {
				// Duplicate 2x before and after if less than 12
				if ( slider.find('.carousel-item').length < 12 ) {
					slider.prepend( duplicateContent );
					slider.prepend( duplicateContent );
					slider.append( duplicateContent );
					slider.append( duplicateContent );		
				// If more than 12 duplicate once before and after
				} else {
					slider.prepend( duplicateContent );
					slider.append( duplicateContent );
				}
			}

		}

		// Set first carousel item class
		firstItem.addClass('first-carousel-item');

		// initiate carousel
		jQuery(this).owlCarousel({
			slideSpeed : 1000,
			mouseDrag : true,
			pagination : pagination,
			scrollPerPage: true,
			items: items,
			single : single,
			itemsDesktop : [ 1500, items ],
			itemsDesktopSmall : [ 1280, items ],
			itemsTablet : [1024,items],
			itemsMobile : [767,1],
			afterAction: function( carousel ){
				var visible_items = this.owl.visibleItems;
				carousel.find('.carousel-item-visible').removeClass('carousel-item-visible');
				carousel.find('.owl-item').filter(function(index) {
					return visible_items.indexOf(index) > -1;
				}).addClass('carousel-item-visible');				
			},
		});

		// Jump to first
		var owl = slider.data('owlCarousel');
		owl.jumpTo( slider.find('.first-carousel-item').closest('.owl-item').index() );

	});

	// prev
	jQuery(document).on( 'mousedown', '.carousel-nav-overlay-prev, .carousel-nav-prev, .carousel-nav-circle-prev, .carousel-nav-arrow-prev', function() {
		var carousel = jQuery(this).closest('.carousel-wrapper').find('.carousel');		
		carousel.trigger('owl.prev');
	});

	// next
	jQuery(document).on( 'mousedown', '.carousel-nav-overlay-next, .carousel-nav-next, .carousel-nav-circle-next, .carousel-nav-arrow-next', function() {
		var carousel = jQuery(this).closest('.carousel-wrapper').find('.carousel');
		carousel.trigger('owl.next');
	});

}

/**
 * Retina Images
 */
function meridian_recipes_retina_img_replace() {

	jQuery('img.has-retina-ver').each(function(){

		jQuery(this)
			.css({ height : jQuery(this).height(), width : jQuery(this).width() })
			.attr( 'src', jQuery(this).data('retina-ver') );		

	});

}

/**
 * replace smaller images with bigger versions
 */
function meridian_recipes_mobile_images() {

	if ( jQuery(window).width() <= 767 ) {

		var images = jQuery('img[data-mobile-version]'),
		mobileVersion = '';

		images.each(function(){

			mobileVersion = jQuery(this).data('mobile-version');

			if ( mobileVersion !== '' ) {
				jQuery(this).attr( 'src', mobileVersion );
			}

		});

	}

	if ( jQuery(window).width() <= 1023 && jQuery(window).width() > 767 ) {

		var images = jQuery('img[data-tablet-version]'),
		tabletVersion = '';

		images.each(function(){

			tabletVersion = jQuery(this).data('tablet-version');

			if ( tabletVersion !== '' ) {
				jQuery(this).attr( 'src', tabletVersion );
			}

		});

	}

}

/**
 * # Ready
 */
jQuery(document).ready(function($){

	meridian_recipes_mobile_images();

	// Remove empty paragraphs
	jQuery('p:empty').remove();

	// admin bar hover
	$(document).on( 'mouseenter', '#wpadminbar', function(){
		$('body').addClass('mt-admin-bar-hover');
	}).on( 'mouseleave', '#wpadminbar', function(){
		$('body').removeClass('mt-admin-bar-hover');
	});

	// Add arrows to navigation items with submenus
	$('#navigation #primary-menu > li:has(ul) > a').append('<span class="fa fa-chevron-down"></span>');

	/**
	 * Print
	 */
	$(document).on( 'click', '.recipe-post-single-top-print, .blog-post-single-top-print', function(){
		window.print();
	});

	/**
	 * Share Show
	 */
	$(document).on( 'click', '.recipe-post-single-top-share, .blog-post-single-top-share, .post-meta-shares-count', function(){

		var popup = $('.share-post-overlay'),
		postID = $(this).data('post-id');

		meridian_recipes_share( postID );

		// display but invisible
		popup.css({
			opacity : 0,
			display : 'block'
		});

		var centerOffset = jQuery(window).height() / 2 - popup.find('.share-post').outerHeight() / 2;

		// center the content
		popup.find('.share-post').css({
			marginTop : centerOffset
		});

		// show it
		popup.animate({ opacity : 1 }, 200 );

	});

	/**
	 * Share Close
	 */
	$(document).on( 'click', '.share-post-close, .share-post-overlay', function(e){

		if(e.target != this) return;

		var popup = $('.share-post-overlay');

		popup.animate({ opacity : 0 }, 200, function(){
			popup.hide();
			popup.find('.share-post-inner').html('<div class="text-align-center"><span class="fa fa-refresh fa-spin"></span></div>');
		});

	});

	/**
	 * Rating
	 */
	$(document).on( 'mouseenter', '.recipe-post-single-rating-rate-action span', function(){

		var rateNum = parseInt( $(this).data('rate') );

		$('.cookmode .recipe-post-single-rating-rate-action span:lt(' + rateNum + ')').addClass('active');
		$('.recipe-post-single-rating-rate-action span:lt(' + rateNum + ')').addClass('active');

	}).on( 'mouseleave', '.recipe-post-single-rating-rate-action span', function(){

		$('.cookmode .recipe-post-single-rating-rate-action span').removeClass('active');
		$('.recipe-post-single-rating-rate-action span').removeClass('active');

	}).on( 'click', '.recipe-post-single-rating-rate-action span', function(){

		var rateNum = parseInt( $(this).data('rate') ),
		postID = $(this).data('post-id');

		meridian_recipes_rate( postID, rateNum );

	});

	/**
	 * Rating center
	 */
	 $(document).on( 'mouseenter', '.recipe-post-single-top-rate', function(){

	 	var tooltip = $(this).find('.recipe-post-single-rating-rate'),
	 	offset = jQuery(this).width() / 2 - tooltip.outerWidth() / 2;
	 	
	 	tooltip.css({ left : offset });

	 });

	/**
	 * Bookmark center
	 */
	 $(document).on( 'mouseenter', '.recipe-post-single-top-bookmark', function(){

	 	var tooltip = $(this).find('.recipe-post-single-bookmark-tooltip'),
	 	offset = jQuery(this).width() / 2 - tooltip.outerWidth() / 2;
	 	
	 	tooltip.css({ left : offset });

	 });

	/**
	 * Header Search
	 */

	// Mobile Nav
	$('.header-mobile-nav-hook select').change(function() { window.location = $(this).val(); });	

	// Focus on click
	$('.header-search-placeholder').click(function(){ $('.header-search input[type="text"]').focus(); });

	// Show/Hide Placeholder
	$('.header-search input[type="text"]').keyup(function() {
		if ( $(this).val() == '' ) {
			$('.header-search-placeholder').show();
		} else {
			$('.header-search-placeholder').hide();
		}
	});

	// Show Search
	$(document).on( 'click', '.header-search-hook-show', function(e) {

		e.preventDefault();

		var parent = $(this).closest('.header-social'),
		holder = parent.find('.header-search'),
		form = holder.find('form'),
		input = holder.find('input[type="text"]');

		input.focus();

		holder.stop().animate({ width : form.outerWidth() }, 300, function(){
			holder.find( '.header-search-hook-hide' ).stop().animate({ opacity : 1 }, 200);
			holder.find( '.header-search-placeholder' ).stop().animate({ opacity : 0.6 }, 200);
		});

	});

	// Hide Search
	$(document).on( 'click', '.header-search-hook-hide', function(e) {

		e.preventDefault();

		var parent = $(this).closest('.header-social'),
		holder = parent.find('.header-search'),
		form = holder.find('form');

		holder.find( '.header-search-placeholder, .header-search-hook-hide' ).stop().animate({ opacity : 0 }, 200, function(){
			holder.stop().animate({ width : 0 }, 300 );
		});

	});

	/**
	 * Pagination
	 */

	// Load More
	$(document).on( 'click', '.pagination-load-more:not(.pagination-loading-more) a', function(e) {

		e.preventDefault();

		if ( $(this).parent().hasClass('active') ) {

			// Vars
			var _this = $(this),
			module = $(this).closest('.posts-listing'),
			pagination = module.find('.pagination'),
			postsContainer = module.find('.posts-listing-inner'),
			moduleID = module.attr('id'),
			pagLink = _this.attr('href'),
			tempHolder = module.find('.load-more-temp');

			// add loading class
			_this.closest('.pagination-load-more').addClass('pagination-loading-more');

			// Spin animation
			_this.find('.fa').addClass('fa-spin');

			// Make ajax request
			tempHolder.load( pagLink + ' .posts-listing', function(){

				// Add new posts to temporary holder
				postsContainer.append( tempHolder.find('.posts-listing-inner').html() );

				// Replace pagination temorray holder
				module.find('.pagination').html( tempHolder.find('.pagination').html() );

				// Change the pagination HTML
				pagination.replaceWith( tempHolder.find('.pagination') );

				// Clean temporary holder
				tempHolder.html('');

				// remove loading class
				_this.closest('.pagination-load-more').removeClass('pagination-loading-more');

			});
		}	

	});

	/**
	 * Bookmark
	 */
	$(document).on( 'click', '.bookmark-recipe-hook', function(){

		var postID = $(this).data('post-id');
		meridian_recipes_bookmark( postID, 'mrdt_recipes' );

	});

	/**
	 * Bookmark
	 */
	$(document).on( 'click', '.bookmark-blog-hook', function(){

		var postID = $(this).data('post-id');
		meridian_recipes_bookmark( postID, 'post' );

	});

	/**
	 * Gallery Images Popup
	 */

	// Trigger click on gallery
	$(document).on( 'click', '.classes-post-single-gallery-item', function(){

	 	var imageIndex = jQuery(this).index() + 1;
	 	jQuery(this).closest('.classes-post-single-gallery-items').siblings('.hidden-lightbox-gallery').find('a:nth-child(' + imageIndex + ')').click();

	});

	// Initiate popup
	$('.hidden-lightbox-gallery').magnificPopup({
		delegate: 'a',
		gallery: {
			enabled: true
		},
		type: 'image'
	});

	/**
	 * Cook mode events
	 */

	jQuery(document).on( 'click', '.recipe-post-single-top-cook-mode', function(){
		meridian_recipes_cookmode();
	 	jQuery('.cookmode, .cookmode-overlay').show().animate({ 
	 		opacity : 1
	 	}, 200);
	});

	jQuery(document).on( 'click', '.cookmode-close, .cookmode-overlay', function(){
	 	jQuery('.cookmode, .cookmode-overlay').animate({ 
	 		opacity : 0
	 	}, 200, function(){
	 		jQuery('.cookmode, .cookmode-overlay').hide();
	 	});
	});

});

/**
 * # Load
 */
jQuery(window).load(function(){

	if ( jQuery(window).width() > 767 ) {
		jQuery('.module-wrapper .sidebar').stick_in_parent();
		jQuery('.body-single-post-sticky-sidebar #sidebar').stick_in_parent();
		jQuery('#navigation').stick_in_parent({
			parent : 'body'
		});
	}

	// Hide the overlay
	jQuery('#page-overlay').hide();

	// Init carousel
	meridian_recipes_carousel();

	// post s7 fake thumb
	jQuery('.header-posts .post-s7-fake-thumb').each(function(){
		jQuery(this).height( jQuery(this).closest('.header-posts').find('.post-s7-thumb').height() );
	});

	// Center in post s4
	jQuery('.post-s4-center').each(function(){

		var container = jQuery(this),
		element = container.find('.post-s4-main'),
		containerHeight = container.height(),
		elementHeight = element.outerHeight(),
		centerOffset = containerHeight / 2 - elementHeight / 2;

		element.css({ paddingBottom : centerOffset });

	});

	/**
	 * Retina
	 */
	var retina = window.devicePixelRatio > 1;
	if ( retina ) {
		jQuery('body').addClass('retina');
		meridian_recipes_retina_img_replace();
	} else {
		jQuery('body').addClass('not-retina');		
	}

	/**
	 * Reloading page
	 */

	var startMode;

	if ( window.matchMedia('(max-width: 479px)').matches )
		startMode = 'portrait';
	else if ( window.matchMedia('(min-width: 480px)').matches && window.matchMedia('(max-width: 767px)').matches )
		startMode = 'landscape';
	else if ( window.matchMedia('(min-width: 768px)').matches && window.matchMedia('(max-width: 1023px)').matches )
		startMode = 'tablet';
	else if ( window.matchMedia('(min-width: 1024px)').matches && window.matchMedia('(max-width: 1400px)').matches )
		startMode = 'monitor-small'
	else if ( window.matchMedia('(min-width: 1401px)').matches && window.matchMedia('(max-width: 1500px)').matches )
		startMode = 'monitor-medium';
	else
		startMode = 'big'

	jQuery('#page').data( 'start-mode', startMode);

});

/**
 * # Scroll
 */
jQuery(window).scroll(function(){

	if ( jQuery('body').hasClass('body-pagination-type-infinite') ) {
		var pagination = jQuery('.pagination-load-more:not(.pagination-loading-more):not(.inactive)');
		if ( pagination.length ) {

			var windowHeight = jQuery(window).height(),
			windowScroll = jQuery(window).scrollTop(),
			paginationOffset = pagination.offset().top + pagination.height() - windowScroll - windowHeight;
			
			if ( paginationOffset < 0 ) {
				pagination.find('a').trigger('click');
			}

		}
	}

});

/**
 * # Resize
 */ 
jQuery(window).resize(function(){

	// post s7 fake thumb
	jQuery('.header-posts .post-s7-fake-thumb').each(function(){
		jQuery(this).height( jQuery(this).closest('.header-posts').find('.post-s7-thumb').height() );
	});

	// Center in post s4
	jQuery('.post-s4-center').each(function(){

		var container = jQuery(this),
		element = container.find('.post-s4-main'),
		containerHeight = container.height(),
		elementHeight = element.outerHeight(),
		centerOffset = containerHeight / 2 - elementHeight / 2;

		element.css({ paddingBottom : centerOffset });

	});

	if ( jQuery('#page.reloading').length < 1 ) {

		var startMode = jQuery('#page').data('start-mode');
		var currMode;

		// currennt mode
		if ( window.matchMedia('(max-width: 479px)').matches )
			currMode = 'portrait';
		else if ( window.matchMedia('(min-width: 480px)').matches && window.matchMedia('(max-width: 767px)').matches )
			currMode = 'landscape';
		else if ( window.matchMedia('(min-width: 768px)').matches && window.matchMedia('(max-width: 1023px)').matches )
			currMode = 'tablet';
		else if ( window.matchMedia('(min-width: 1024px)').matches && window.matchMedia('(max-width: 1400px)').matches )
			currMode = 'monitor-small'
		else if ( window.matchMedia('(min-width: 1401px)').matches && window.matchMedia('(max-width: 1500px)').matches )
			currMode = 'monitor-medium';
		else
			currMode = 'big'

		if ( startMode != currMode ) {
			location.reload();
			jQuery('#page').addClass('reloading');
		}

	}

});