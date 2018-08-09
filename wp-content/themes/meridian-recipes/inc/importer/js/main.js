jQuery(document).ready(function($){

	function initiateImport( progressItem, all ) {

		all = typeof all !== 'undefined' ? all : false;

		funcName = 'mt-ajax-' + progressItem.data('mt-func-name');

		jQuery('.mt-importer-row').show();
		progressItem.show();
		progressItem.find('span').show();

		jQuery.post(

			MTImporterAjax.ajaxurl,
			{
				action : funcName,
			},
			function( response ) {

				if ( response.status == 'success' ) {
					progressItem.find('strong').show();
				} else {
					alert( 'Something went wrong, please try again.' );
				}

				if ( progressItem.next('.mt-importer-progress-item:not(.mt-importer-skip)').length ) {
					initiateImport( progressItem.next('.mt-importer-progress-item:not(.mt-importer-skip)'), all );
				} else {
					progressItem.after('<hr><strong>All Finished</strong>');
					progressItem.closest('.mt-importer-row').find('.mt-importer-hook').text('Installed');
					if ( all ) {
						if ( progressItem.closest('.mt-importer-row').next('.mt-importer-row').length ) {
							initiateImport( progressItem.closest('.mt-importer-row').next('.mt-importer-row').find('.mt-importer-progress-item:not(.mt-importer-skip):first'), all );
						}
					}
				}

			}

		);

	}

	function initiateImportAll() {

		initiateImport( jQuery('.mt-importer-row .mt-importer-progress-item:not(.mt-importer-skip):first'), true );

	}

	jQuery(document).on( 'click', '.mt-importer-hook:not(.button-disabled)', function(e){

		e.preventDefault();

		var _this = jQuery(this),
		progress = _this.closest('.mt-importer-row').find('.mt-importer-progress'),
		funcName,
		progressItem;

		// Disable button
		_this.addClass('button-disabled').text('Installing...');

		// Initiate Import
		initiateImport( progress.find('.mt-importer-progress-item:not(.mt-importer-skip):first'), false );

	});

	jQuery(document).on( 'click', '.mt-importer-all-hook:not(.button-disabled)', function(e){

		e.preventDefault();

		var _this = jQuery(this);

		// Disable button
		_this.addClass('button-disabled').text('Installing...');

		// Initiate Import
		initiateImportAll();

	});

	jQuery(document).on( 'click', '.mt-importer-close-hook', function(e){

		e.preventDefault();		

		jQuery.post(

			MTImporterAjax.ajaxurl,
			{
				action : 'mt-ajax-close-installer'
			},
			function( response ) {

				if ( response.status == 'success' ) {
					jQuery('.mt-importer').slideUp( 200 );
				}

			}

		);

	});

	// change enable/disable recipes func on importer
	jQuery('#mt-importer-enable-disable-recipes-func').on('change', function(){
		if ( jQuery(this).is(':checked') ) {
			jQuery('.mt-importer-progress-item[data-mt-func-name="install-disable-recipes-func"]').addClass('mt-importer-skip');
			jQuery('.mt-importer-progress-item[data-mt-func-name="install-recipe-posts"]').removeClass('mt-importer-skip');
		} else {
			jQuery('.mt-importer-progress-item[data-mt-func-name="install-disable-recipes-func"]').removeClass('mt-importer-skip');
			jQuery('.mt-importer-progress-item[data-mt-func-name="install-recipe-posts"]').addClass('mt-importer-skip');
		}
	});

});