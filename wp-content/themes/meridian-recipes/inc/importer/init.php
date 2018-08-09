<?php

	if ( get_option( 'mt_ajax_installer', 'open' ) != 'closed' && defined( 'MERIDIAN_RECIPES_FEATURES_URL' ) ) {

		include get_template_directory() . '/inc/importer/ajax.php';

		function meridian_recipes_importer_scripts() {

			wp_enqueue_style( 'meridian-recipes-importer-style', get_template_directory_uri() . '/inc/importer/css/main.css', array(), '1.0' );
			wp_enqueue_script( 'meridian-recipes-importer-js', get_template_directory_uri() . '/inc/importer/js/main.js', array(), '1.0' );			
			wp_localize_script( 'meridian-recipes-importer-js', 'MTImporterAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		} add_action( 'admin_enqueue_scripts', 'meridian_recipes_importer_scripts' );

		function meridian_recipes_importer_notification() {

			?>

			<div class="mt-importer">
				
				<div class="mt-importer-inner">

					<h2>Meridian Recipes - One Click Importer</h2>

					<div class="mt-importer-info">

						First of all, thank you for purchasing our theme. This is the <strong>one click importer</strong> which will import the content you've seen on the demo.<br>Note that the images used on the demo are commercial images that can't be redistributed so placeholder images will be used.

					</div><!-- .mt-importer-info -->

					<div class="mt-importer-note">
						<h3>Important</h3>
						<p>This theme can be used as a food <em><strong>recipes magazine</strong></em> or a <em><strong>regular magazine</strong></em> ( no recipes functionality ).<br>If you will be using the theme as a <em><strong>regular magazine</strong></em> disable the checkbox below and then proceed with the importer.</p>
						<p><input id="mt-importer-enable-disable-recipes-func" type="checkbox" checked> Include recipes functionality</p>
						<small>P.S. You can enable recipes functionality at any time in the Theme Options under General</small>
					</div><!-- .mt-importer-info -->

					<div class="mt-importer-row">
						<div class="mt-importer-progress">
							<div class="mt-importer-progress-item mt-importer-skip" data-mt-func-name="install-disable-recipes-func"><span>Disabling recipes functionality...</span> <strong>done</strong></div>
							<div class="mt-importer-progress-item" data-mt-func-name="install-nav-menus"><span>Setting up navigation menus...</span> <strong>done</strong></div>
							<div class="mt-importer-progress-item" data-mt-func-name="install-home-page"><span>Setting Up Home Page...</span> <strong>done</strong></div>
							<div class="mt-importer-progress-item" data-mt-func-name="install-categories"><span>Setting Up Categories...</span> <strong>done</strong></div>							
							<div class="mt-importer-progress-item" data-mt-func-name="install-contact-page"><span>Setting Up Contact Page...</span> <strong>done</strong></div>
							<div class="mt-importer-progress-item" data-mt-func-name="install-blog-posts"><span>adding blog posts...</span> <strong>done</strong></div>
							<div class="mt-importer-progress-item" data-mt-func-name="install-recipe-posts"><span>adding recipe posts...</span> <strong>done</strong></div>
						</div><!-- .mt-importer-progress -->
					</div><!-- .mt-importer-row -->

					<div class="mt-importer-all" style="clear:both;">
						<div class="mt-importer-button-all">
							<a href="#" class="button button-primary mt-importer-all-hook">OK, Import Demo Content</a> <a href="#" class="button button-secondary mt-importer-close-hook">Close Importer ( won't show again )</a>
						</div><!-- .mt-importer-button -->
					</div><!-- .mt-importer-all -->

				</div><!-- .mt-importer-inner -->

			</div>

			<?php

		} add_action( 'admin_notices', 'meridian_recipes_importer_notification' );

	}