<?php

// get section info
$section_info = meridian_recipes_get_section_info();

?>
<div class="module-wrapper">

	<div class="module-custom-wrapper">

		<div class="wrapper clearfix">

			<?php if ( isset( $section_info['custom_content'] ) ) : ?>
				<div class="module-custom-content">
					<?php echo do_shortcode( $section_info['custom_content'] ); ?>
				</div><!-- .module-custom-content -->
			<?php endif; ?>

		</div><!-- .wrapper -->

	</div><!-- .module-subscribe-overlay -->

</div><!-- .module-wrapper -->
