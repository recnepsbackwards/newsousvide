"use strict";

/**
 * Initialize ( mtst_init )
 * Set option values ( mtst_options_set_values )
 * Show Options ( mtst_options_show )
 * Show options group ( mtst_options_group_show )
 * Initiate Slider Options ( mtst_options_slider_init )
 * Initiate colorpicker options ( mtst_option_colorpicker_init )
 * Go back ( mtst_panel_back )
 * Get current selector ( mtst_get_selector )
 *
 */

/**
 *  Global vars
 */
var mtstVar = {},
mtstAnimVar = {},
mtstMaxHeight = 1000,
mtstFontsRegular = MTSTFonts.regular,
mtstFontsGoogle = MTSTFonts.google,
mtstFontsAll = mtstFontsRegular.concat( mtstFontsGoogle );

/**
 * Initialize
 */
function mtst_init() {

	jQuery('.wpcf7 p').addClass('mtst-element-editable').data( 'mtst-selector', '.wpcf7 p' );
	jQuery('.wpcf7 input[type="text"]').addClass('mtst-element-editable').data( 'mtst-selector', '.wpcf7 input[type=text]' );
	jQuery('.wpcf7 input[type="submit"]').addClass('mtst-element-editable').data( 'mtst-selector', '.wpcf7 input[type=submit]' );

	jQuery('.subscribe-widget .wysija-submit-field').addClass('mtst-element-editable').data( 'mtst-selector', '.subscribe-widget input[type=submit].wysija-submit' );

	if ( jQuery('#mtst-panel-data').val() ) {
		mtstVar = JSON.parse( jQuery('#mtst-panel-data').val() );
	}

	if ( jQuery('#mtst-panel-animation-data').val() ) {
		mtstAnimVar = JSON.parse( jQuery('#mtst-panel-animation-data').val() );
	}

	jQuery('.scrollbar-inner').perfectScrollbar();

	// Initialize options
	mtst_option_slider_init();
	mtst_option_colorpicker_init();
	mtst_option_font_family_init();

	// Apply class to all editable elements and popular var
	jQuery('[data-mtst-selector]').addClass('mtst-element-editable');
	jQuery('.mtst-element-editable').each(function(){
		var selector = jQuery(this).data('mtst-selector');
		if ( mtstVar[selector] == undefined ) {
			mtstVar[selector] = {};
		}
	});

	// Disable clicking propagation
	jQuery(document).on('click', 'body.mtst-active .mtst-element-editable', function(e){
		e.preventDefault();
		e.stopPropagation()
	});

	// Disable hover propagation
	jQuery(document).on('mouseenter', 'body.mtst-active .mtst-element-editable', function(e){
		e.stopPropagation()
	});

	// Element Mouseenter
	jQuery(document).on('mouseenter', 'body.mtst-active .mtst-element-editable', function(e){
		jQuery(this).addClass('mtst-hover');
		e.stopPropagation();
	// Element Mouseleave
	}).on('mouseleave', 'body.mtst-active .mtst-element-editable', function(){
		jQuery(this).removeClass('mtst-hover');
	});

	// Elements Click
	jQuery(document).on('click', 'body.mtst-active .mtst-element-editable', function(){
		
		// Active classes
		jQuery('.mtst-element-editable.mtst-active').removeClass('mtst-active');
		jQuery(this).addClass('mtst-active');

		// Show options
		mtst_options_set_values();
		mtst_options_show();

	});

	// Group label click
	jQuery(document).on('click', '.mtst-panel-options-group-header', function(){
		mtst_options_group_show( jQuery(this).closest('.mtst-panel-options-group' ) );
	});

}

/**
 * Set option values
 */
function mtst_options_set_values() {

	// Vars
	var element = jQuery('.mtst-element-editable.mtst-active'),
	selector = element.data('mtst-selector'),
	options = jQuery('.mtst-panel-option'),
	optionRule,
	optionValue,
	option;

	// Go through every option and set values of the element
	options.each(function(){

		option = jQuery(this); 
		optionRule = option.data('mtst-affect');
		optionValue = jQuery(selector).css( optionRule );

		if ( optionRule == 'animation' ) {

			if ( mtstAnimVar[selector] !== undefined ) {

				jQuery('.mtst-panel-option-type-select[data-mtst-affect="animation"] .mtst-panel-option-value').val( mtstAnimVar[selector] );
	
			} else {

				jQuery('.mtst-panel-option-type-select[data-mtst-affect="animation"] .mtst-panel-option-value').val( 'none' );

			}

		} else {

			// Fix font weight value
			if ( optionRule == 'font-weight' ) {
				if ( optionValue == 'normal' ) {
					optionValue = 400;
				} else if ( optionValue == 'bold' ) {
					optionValue = 700;
				}
			}

			option.find('.mtst-panel-option-value').val( optionValue );

			// Update slider
			if ( option.hasClass('mtst-panel-option-type-slider') ) {
				option.find('.mtst-panel-option-slider').slider( 'value', parseInt( optionValue ) );
				option.find('.mtst-panel-option-extra').text(optionValue);
			}

			// Update colorpicker
			if ( option.hasClass('mtst-panel-option-type-colorpicker') ) {
				 option.find('.mtst-panel-option-value').spectrum( 'set', optionValue );
			}

		}

	});	

}

/**
 * Show Options
 */
function mtst_options_show() {

	// Hide/Show
	mtst_panel_show_section( 'options' );
	mtst_options_support();

	// Currently editing
	var currentlyEditing = jQuery('.mtst-element-editable.mtst-active').data('mtst-selector');
	if ( jQuery('.mtst-element-editable.mtst-active').data('mtst-label') )
		currentlyEditing = jQuery('.mtst-element-editable.mtst-active').data('mtst-label');
	jQuery('#mtst-panel-header-secondary').text(currentlyEditing);

	mtst_options_max_height();


}

/**
 * Options group hide/show based on support
 */
function mtst_options_support() {

	var selector = jQuery('.mtst-element-editable.mtst-active'),
	supports = 'all',
	groups = jQuery('.mtst-panel-options-group'),
	group,
	groupID,
	supportsData;

	// show all groups
	groups.show();

	if ( selector.data('mtst-no-support') ) {
		
		// split into array
		supportsData = selector.data('mtst-no-support').split( ',' );

		// hide unsupported groups
		groups.each(function(){
			
			group = jQuery(this);
			groupID = group.data('mtst-id');

			if ( supportsData.indexOf( groupID ) !== -1  ) {
				group.hide();
			}

		});

	}

}

/**
 * Show options group
 */
function mtst_options_group_show( group ) {

	var newGroup = group,
	prevGroup = jQuery('.mtst-panel-options-group.mtst-active');

	if ( newGroup.hasClass('mtst-active') ) {
		newGroup.removeClass('mtst-active');
	} else if ( prevGroup.length ) {
		prevGroup.removeClass('mtst-active');
		//setTimeout( function(){
			newGroup.addClass('mtst-active');
		//}, 600);
	} else {
		newGroup.addClass('mtst-active');
	}

}

/**
 * Initiate Slider Options
 */
function mtst_option_slider_init() {

	var sliders = jQuery('.mtst-panel-option-slider'),
	slider,
	option,
	input;

	sliders.each(function(){

		var attrMin = 0,
		attrMax = 150,
		attrInc = 1;

		slider = jQuery(this),
		input = slider.closest('.mtst-panel-option').find('.mtst-panel-option-value'),
		option = slider.closest('.mtst-panel-option');

		if ( option.data('mtst-min') )
			attrMin = option.data('mtst-min');

		if ( option.data('mtst-max') )
			attrMax = option.data('mtst-max');

		if ( option.data('mtst-inc') )
			attrInc = option.data('mtst-inc');

		slider.slider({
			min : attrMin,
			max : attrMax,
			step : attrInc,
			slide: function( event, ui ) {
				
				var handle = jQuery(ui.handle),
				option = handle.closest('.mtst-panel-option'),
				optionField = option.find('.mtst-panel-option-value'),
				ext = '',
				optionValue;

				if ( option.data('mtst-ext') )
					ext = option.data('mtst-ext');

				optionValue = ui.value + ext;

				optionField.val( optionValue ).trigger('change');
				option.find('.mtst-panel-option-extra').text(optionValue);

			}
		});

	});

}

/**
 * Initiate Colorpicker Options
 */
function mtst_option_colorpicker_init() {

	jQuery('.mtst-panel-option-type-colorpicker').each( function(){

		//vars
		var option = jQuery(this),
		optionField = option.find('.mtst-panel-option-value'),
		currValue = optionField.val(),
		field,
		value;

		// Initiate
		optionField.spectrum({
			color: currValue,
			showInput: true,
			allowEmpty: true,
			showAlpha: true,
			clickoutFiresChange: true,
			preferredFormat: 'rgb',
			move: function( color ) {
				
				field = jQuery(this);
				
				if ( color == null )
					value = 'transparent';
				else
					value = color.toRgbString();

				field.val( value ).trigger('change');

			},
			change: function( color ) {
				
				/*

				dslcField = jQuery(this);
				dslcFieldID = dslcField.data('id');
				
				if ( color == null )
					dslcVal = 'transparent';
				else
					dslcVal = color.toRgbString();
				
				

				*/

			},
			show: function( color ) {
				/*
				jQuery(this).spectrum( 'set', jQuery(this).val() );
				*/
			},
			hide: function() {
				/*
				jQuery('body').removeClass('dslca-disable-selection');
				*/
			}

		});

	});

}

/**
 * Initialize font family option
 */
function mtst_option_font_family_init() {

	jQuery(document).on( 'keyup', '.mtst-panel-option-type-font-family .mtst-panel-option-value', function(e){

		if ( e.which != 13 && e.which != 38 && e.which != 40 ) {

			// Vars 
			var field = jQuery(this),
			option = field.closest('.mtst-panel-option'),
			fieldVal = field.val(),
			regex = new RegExp('^' + fieldVal, 'i'),
			fontsAmount = mtstFontsAll.length,
			i = 0,
			fontMatch = [],
			font;

			// Do
			do {
				
				// Check if font meets requirements
				if (regex.test(mtstFontsAll[i])) {
					if ( fontMatch.length < 10 ) {
						fontMatch.push( mtstFontsAll[i] );
					}
				}
					
				// Increment count
				i++; 

			// While there are fonts
			} while ( i < fontsAmount );

			// Clear suggestions
			jQuery('.mtst-panel-option-type-font-family-suggest', option).html('');

			// If a match ound
			if ( fontMatch ) {
					
				// Show suggestion box
				jQuery('.mtst-panel-option-type-font-family-suggest', option).show();

				jQuery.each( fontMatch, function( key, font ) {
					jQuery('.mtst-panel-option-type-font-family-suggest', option).append('<span>' + font + '</span>');
				});


			// If a match is not found
			} else {

				// Hide suggestion box
				jQuery('.mtst-panel-option-type-font-family-suggest', option).hide();				

			}
			
			//if ( dslcFont.length )
				//dslcField.val( dslcFont.substring( 0 , dslcField.val().length ) );

		}

	});

	jQuery(document).on('click', '.mtst-panel-option-type-font-family-suggest span', function(){

		var font = jQuery(this).text(),
		option = jQuery(this).closest('.mtst-panel-option'),
		field = option.find('.mtst-panel-option-value');

		field.val( font ).trigger('change');
		jQuery('.mtst-panel-option-type-font-family-suggest', option).hide();

	});

}

/**
 * Load a font family
 */
function mtst_option_font_family_load( font ) {

	// If it's a google font
	if ( font.length && mtstFontsGoogle.indexOf( font ) !== -1  ) {

		// Font to load
		font = font + ':400,100,200,300,500,600,700,800,900';

		WebFont.load({
			google: { 
				families: [ font ] 
			},
			active : function(familyName, fvd) {
				
			},
			inactive : function ( familyName, fvd ) {
				
			}
		});

	}

}

/**
 * Go back
 */
function mtst_panel_back() {

	var activeSection = jQuery('.mtst-panel-section.mtst-active'),
	previousSection = activeSection.prev('.mtst-panel-section');

	activeSection.hide().removeClass('mtst-active');
	previousSection.show().addClass('mtst-active');
	jQuery('.mtst-element-editable').removeClass('mtst-active');

}

/**
 * Get current selector
 */
function mtst_get_selector() {

	return jQuery('.mtst-element-editable.mtst-active').data('mtst-selector');

}

/**
 * Generate CSS
 */
function mtst_generate_css() {

	var cssCode = '';

	// Go through each selector
	jQuery.each( mtstVar, function( selector, values ){

		// If selector has rules
		if ( ! jQuery.isEmptyObject( values ) ) {

			// Open up the selector rules section
			cssCode += selector + ' { ';
			
			// Go through each rule/value
			jQuery.each( values, function( rule, value ){

				// Add the rule value
				cssCode += rule + ': ' + value + '; ';

			});

			// Close the selector rules section
			cssCode += ' } ';

		}

	});

	jQuery('#mtst-panel-code').val( cssCode );

}

/**
 * Generate animation data
 */
function mtst_generate_animation_data() {

	// Go through each selector
	jQuery('#mtst-panel-animation-data').val( JSON.stringify(mtstAnimVar) );

}

/**
 * Show Section
 */
function mtst_panel_show_section( section ) {

	var currSection = jQuery('.mtst-panel-section.mtst-active'),
	newSection = jQuery('.mtst-panel-section[data-mtst-id="' + section + '"]');

	currSection.removeClass('mtst-active');
	newSection.addClass('mtst-active');

	if ( section == 'options' ) {
		mtst_panel_show_main_actions();
	} else {
		mtst_panel_hide_main_actions();
	}

}

/**
 * Publish Changes
 */
function mtst_publish_changes() {

	var cssCode = jQuery('#mtst-panel-code').val();

	jQuery('body').addClass('mtst-publish-chnges-in-progress');
	jQuery('#mtst-panel-confirm .mtst-loaded').hide();
	jQuery('#mtst-panel-confirm .mtst-loading').show();

	jQuery.ajax({
		method: 'POST',
		type: 'POST',
		url: MTSTAjax.ajaxurl,
		data: {
			action : 'mtst-ajax-publish-changes',
			css_code : cssCode,
			js_data : mtstVar,
			animation_data : mtstAnimVar,
		},
		timeout: 10000
	}).done(function( response ) {

		// Success
		if ( response.status == 'success' ) {
			
		// FAIL
		} else {
			alert( 'Well this is odd, it could not be saved. Please try again. ( Error 1 )' );
		}

	}).fail(function( response ) {

		if ( response.statusText == 'timeout' ) {
			alert( 'The request timed out after 10 seconds. Please try again. ( Error 2 )' );
		} else {
			alert( 'Well this is odd, it could not be saved. Please try again. ( Error 3 )' );
		}

	}).always(function( reseponse ) {

		jQuery('#mtst-panel-confirm .mtst-loading').hide();
		jQuery('#mtst-panel-confirm .mtst-loaded').show();

		// Remove the class previously added so we know saving is finished
		jQuery('body').removeClass('mtst-publish-chnges-in-progress');

	});

}

/**
 * Discard Changes
 */
function mtst_discard_changes() {

	mtst_panel_show_section( 'discard' );

}

/**
 * Discard All Changes
 */
function mtst_discard_all_changes() {

	jQuery.ajax({
		method: 'POST',
		type: 'POST',
		url: MTSTAjax.ajaxurl,
		data: {
			action : 'mtst-ajax-discard-all-changes',
		},
		timeout: 10000
	}).done(function( response ) {

		location.reload();

	});

}

function mtst_options_max_height() {	

	var panel = jQuery('#mtst-panel'),
	windowHeight = jQuery(window).height(),
	panelHeadings = jQuery('.mtst-panel-options-group-header'),
	panelHeadingsHeight = 0,
	panelOutside = parseInt( panel.position().top ) * 2,
	panelTopHeader = parseInt( panel.find('#mtst-panel-header-top').outerHeight() ),
	panelHeader = parseInt( panel.find('#mtst-panel-header').outerHeight() ),
	panelFooter = parseInt( panel.find('#mtst-panel-footer').outerHeight() );

	panelHeadings.each(function(){
		panelHeadingsHeight += jQuery(this).outerHeight();
	});

	mtstMaxHeight = windowHeight - panelOutside - panelTopHeader - panelHeader - panelFooter - panelHeadingsHeight;

	jQuery('.scrollbar-inner').css({ maxHeight : mtstMaxHeight });

}

function mtst_panel_open_close() {

	// Current state
	var isOpen = false;
	if ( jQuery('#mtst-panel').hasClass('mtst-active') ) {
		isOpen = true;
	}

	// If open close it
	if ( isOpen ) {

		jQuery('#mtst-panel').removeClass('mtst-active');
		jQuery('body').removeClass('mtst-active');
		setTimeout( function(){
			mtst_panel_show_section('select');
			jQuery('.mtst-element-editable.mtst-active').removeClass('mtst-active');
		}, 300);

	// If closed open it
	} else {

		jQuery('body').addClass('mtst-active');
		jQuery('#mtst-panel').addClass('mtst-active');

	}

}

/**
 * Hide main actions
 */
function mtst_panel_hide_main_actions() {
	jQuery('#mtst-panel-footer').hide();
}

/**
 * Show main actions
 */
function mtst_panel_show_main_actions() {
	jQuery('#mtst-panel-footer').show();
}

jQuery(document).ready(function($){

	mtst_init();

	// Publish changes
	$(document).on('click', '#mtst-panel-confirm', function() {
		mtst_publish_changes();
	});

	// Discard chaanges
	$(document).on('click', '#mtst-panel-discard', function() {
		mtst_discard_changes();
	});

	// Cancel Discard
	$(document).on('click', '.mtst-hook-cancel-discard', function(){
		mtst_panel_show_section('options');
	});

	// Discard session
	$(document).on('click', '.mtst-hook-discard-session', function(){
		location.reload();
	});

	// Discard all
	$(document).on('click', '.mtst-hook-discard-all', function(){
		mtst_discard_all_changes();
	});

	// Clicked on the back icon
	$(document).on('click', '.mtst-panel-back-hook', function() {
		mtst_panel_back();
	});

	// Click on minimize/maxsimize
	$(document).on('click', '.mtst-panel-header-top-action-minimize', function(e){
		e.stopPropagation();
		mtst_panel_open_close();
	});

	// Click on header to maximize
	$(document).on('click', '#mtst-panel-header-top', function(){
		if ( ! jQuery('#mtst-panel').hasClass('mtst-active') ) {			
			console.log( 'test');
			mtst_panel_open_close();
		}
	});

	// Option value changed
	$(document).on('change', '.mtst-panel-option-value', function(){

		// Vars
		var option = jQuery(this).closest('.mtst-panel-option'),
		rule = option.data('mtst-affect'),
		element = jQuery('.mtst-element-editable.mtst-active'),
		selector = element.data('mtst-selector'),
		value = jQuery(this).val();

		// If not animation
		if ( rule !== 'animation' ) {

			// If font family
			if ( rule == 'font-family' ) {
				mtst_option_font_family_load( value );
			}

			// Apply CSS to element
			jQuery(selector).css( rule, value );

			// Apply new rule to var
			mtstVar[selector][rule] = value;

			// Generate the CSS
			mtst_generate_css();

		// It is animation
		} else {

			// Apply animation for preview
			element.animateCSS(value);

			// Apply new animation rule to var
			mtstAnimVar[selector] = value;

			// Generate the animation data
			mtst_generate_animation_data();

		}

	});

	mtst_options_max_height();

});


jQuery(window).load(function($){

	mtst_options_max_height();

});

jQuery(window).resize(function(){

	mtst_options_max_height();

});