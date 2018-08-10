"use strict";

function meridian_recipes_module_opts() {

	meridian_admin_repetable_labels();

	jQuery('#_meridian_recipes_home_sections_repeat .postbox').each(function(){

		var value = jQuery(this).find('.cmb-field-list > .cmb-row:first-child select').val();

		var container = jQuery(this),
		optSectionTitle = container.find('.cmb-row[class*="section-title"]'),
		optPostType = container.find('.cmb-row[class*="post-type"]'),
		optPostOrder = container.find('.cmb-row[class*="post-order"]'),
		optPostAmount = container.find('.cmb-row[class*="posts-per-page"]'),
		optPostPagination = container.find('.cmb-row[class*="post-pagination"]'),
		optPostRecipeCategories = container.find('.cmb-row[class*="recipe-categories"]'),
		optPostBlogCategories = container.find('.cmb-row[class*="blog-categories"]'),
		optModule11 = container.find('.cmb-row[class*="module-11"]'),
		optModule12 = container.find('.cmb-row[class*="module-12"]'),
		optModulePromoBoxes = container.find('.cmb-row[class*="promo-box"]'),
		optModuleSubscribe = container.find('.cmb-row[class*="subscribe"]'),
		optModuleSearch = container.find('.cmb-row[class*="search"]'),
		optModuleCustom = container.find('.cmb-row[class*="custom"]');

		var postType = optPostType.find('select').val();

		optModule11.hide();
		optModule12.hide();
		optModulePromoBoxes.hide();
		optModuleSubscribe.hide();
		optModuleSearch.hide();
		optModuleCustom.hide();
		optPostPagination.hide();

		optSectionTitle.show();
		optPostType.show();
		optPostOrder.show()
		optPostAmount.show();
		optPostRecipeCategories.show();
		optPostBlogCategories.show();

		if ( postType == 'post' ) {
			optPostRecipeCategories.hide();
		} else if ( postType == 'mrdt_recipes' ) {
			optPostBlogCategories.hide();
		}

		if ( value == 'module-11' ) {
			optModule11.show();
		}

		if ( value == 'module-12' ) {
			optModule12.show();
		}

		if ( value == 'module-13' ) {
			optPostPagination.show();
		}

		if ( value == 'module-promo-boxes' || value == 'module-subscribe' || value == 'module-search' || value == 'module-custom' ) { 
			optSectionTitle.hide();
			optPostType.hide();
			optPostOrder.hide()
			optPostAmount.hide();
			optPostRecipeCategories.hide();
			optPostBlogCategories.hide();
		}

		if ( value == 'module-promo-boxes' ) {
			optModulePromoBoxes.show();
		}

		if ( value == 'module-subscribe' ) {
			optModuleSubscribe.show();
		}

		if ( value == 'module-search' ) {
			optModuleSearch.show();
		}

		if ( value == 'module-custom' ) {
			optModuleCustom.show();
		}

	});


}

function meridian_recipes_opts_by_template() {

	var mrdtPageTemplate = jQuery('#page_template').val(),
	mrdtSecContact = jQuery('#_meridian_recipes_contact_metabox'),
	mrdtSecSlider = jQuery('#_meridian_recipes_metabox_slider'),
	mrdtOptLayout = jQuery('.cmb-row.cmb2-id--meridian-recipes-layout'),
	mrdtOptPostsPerPage = jQuery('.cmb-row.cmb2-id--meridian-recipes-query-posts-per-page'),
	mrdtOptColumns = jQuery('.cmb-row.cmb2-id--meridian-recipes-columns');

	// Hide/Show Contact Section
	mrdtSecContact.hide();
	if ( mrdtPageTemplate == 'template-contact.php' ) {
		mrdtSecContact.show();
	}

	// Hide/Show Slider Section
	mrdtSecSlider.hide();
	if ( mrdtPageTemplate == 'template-homepage.php' ) {
		mrdtSecSlider.show();
	}

	// Hide/Show layout,post per page, columns
	mrdtOptLayout.hide();
	mrdtOptColumns.hide();
	mrdtOptPostsPerPage.hide();
	if ( mrdtPageTemplate == 'template-blog.php' || mrdtPageTemplate == 'template-classes.php' || mrdtPageTemplate == 'template-trainers.php' ) {
		mrdtOptLayout.show();
		mrdtOptColumns.show();
		mrdtOptPostsPerPage.show();
	}

}

jQuery(document).ready(function(){

	meridian_recipes_opts_by_template();
	jQuery(document).on( 'change', '#page_template', function(){
		meridian_recipes_opts_by_template();
	});

	meridian_recipes_module_opts();
	jQuery(document).on( 'change', '#_meridian_recipes_home_sections_repeat .cmb-field-list > .cmb-row:first-child, .cmb-row[class*="post-type"] select', function(){
		meridian_recipes_module_opts();
	});

	/**
	 * On Load - Hide/Show section options based on choice
	 */
	 /*
	jQuery('select[name*="_meridian_recipes_home_sections"]').each(function(){

		var value = jQuery(this).val();
		var container = jQuery(this).closest('.cmb-field-list');

		container.find('.cmb-row').not('.cmb-type-select').not('.cmb-remove-field-row').hide();
		container.find('.cmb-row[class*="' + value + '"]').show();
		
	});
*/

	/**
	 * On Change - Hide/Show section options based on choice
	 */
	 /*
	jQuery(document).on('change', 'select[name*="_meridian_recipes_home_sections"]', function(){

		var value = jQuery(this).val();
		var container = jQuery(this).closest('.cmb-field-list');

		container.find('.cmb-row').not('.cmb-type-select').not('.cmb-remove-field-row').hide();
		container.find('.cmb-row[class*="' + value + '"]').show();

	});	
*/

	/**
	 * On Load - Hide/Show 3 Col option based on layout
	 */
	jQuery('.cmb2_select#_meridian_recipes_layout').each(function(){

		var value = jQuery(this).val();

		if ( value == 'content_sidebar' ) {
			if ( jQuery('.cmb2_select#_meridian_recipes_columns').val() == '4' ) {
				jQuery('.cmb2_select#_meridian_recipes_columns').val( '6' );
			}
			jQuery('.cmb2_select#_meridian_recipes_columns option[value="4"]').attr('disabled','disabled');
		} else {
			jQuery('.cmb2_select#_meridian_recipes_columns option[value="4"]').removeAttr('disabled');
		}
		
	});

	/**
	 * On Change - Hide/Show 3 Col option based on layout
	 */
	jQuery(document).on('change', '.cmb2_select#_meridian_recipes_layout', function(){

		var value = jQuery(this).val();

		if ( value == 'content_sidebar' ) {
			if ( jQuery('.cmb2_select#_meridian_recipes_columns').val() == '4' ) {
				jQuery('.cmb2_select#_meridian_recipes_columns').val( '6' );
			}
			jQuery('.cmb2_select#_meridian_recipes_columns option[value="4"]').attr('disabled','disabled');
		} else {
			jQuery('.cmb2_select#_meridian_recipes_columns option[value="4"]').removeAttr('disabled');
		}

	});

});

/**
 * Add move up/down for repeatables
 */
function meridian_admin_repeatable_sort() {
	jQuery('.cmb-repeatable-group .cmb-repeatable-grouping').prepend('<div class="meridian-recipes-admin-repeatable-sort"><span data-action="move-up">move up</span><span data-action="move-down">move down</span></div>');
}

function meridian_admin_repetable_labels() {

	jQuery('.cmb-repeatable-group .cmb-repeatable-grouping').each(function(){

		if ( jQuery(this).find('.cmb-row[class*="section-title"] input').length ) {

			var module = jQuery(this).find('.cmb-field-list > .cmb-row:first-child select').val(),
			moduleTitle = jQuery(this).find('.cmb-field-list > .cmb-row:first-child select option:selected').text(),
			sectionTitle =  jQuery(this).find('.cmb-row[class*="section-title"] input').val(),
			newTitle = '';

			if ( module == 'module-promo-boxes' || module == 'module-search' || module == 'module-subscribe' ) {
				newTitle = moduleTitle;
			} else {
				newTitle = moduleTitle + ' - ' + sectionTitle;
			}

			jQuery(this).find('.cmb-group-title').text( newTitle );

		}

	});

}

function meridian_admin_repeatable_iterator() {

	var count = 0;

	jQuery('.cmb-repeatable-group .cmb-repeatable-grouping').each(function(){
		jQuery(this).data( 'iterator', count );
		count++;
	});

}

jQuery(document).ready(function(){

	meridian_admin_repeatable_sort();
	meridian_admin_repetable_labels();

	jQuery(document).on('click', '.meridian-recipes-admin-repeatable-sort span', function(){

		var direction = jQuery(this).data('action'),
		item = jQuery(this).closest('.cmb-repeatable-grouping'),
		prevItem = item.prev('.cmb-repeatable-grouping'),
		nextItem = item.next('.cmb-repeatable-grouping');

		if ( direction == 'move-up' && prevItem.length ) {
			item.find('.cmb-shift-rows.move-up').trigger('click');
			meridian_admin_repetable_labels();
			meridian_recipes_module_opts();
		}

		if ( direction == 'move-down' && nextItem.length ) {
			item.find('.cmb-shift-rows.move-down').trigger('click');	
			meridian_admin_repetable_labels();
			meridian_recipes_module_opts();
		}

	});

	jQuery(document).on( 'keyup', '.cmb-row[class*="section-title"] input', function(){
		meridian_admin_repetable_labels();
	});	

});