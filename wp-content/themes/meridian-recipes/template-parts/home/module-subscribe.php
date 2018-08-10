<?php

// get section info
$section_info = meridian_recipes_get_section_info();

?>
<div class="module-wrapper">

	<div class="module-subscribe-wrapper module-subscribe-style-<?php echo esc_attr( $section_info['subscribe_style'] ); ?>" <?php if ( $section_info['subscribe_style'] == 'full_width' && isset( $section_info['subscribe_bg_image'] ) ) : ?>style="background-image:url('<?php echo esc_attr( $section_info['subscribe_bg_image'] ); ?>')"<?php endif; ?>>

		<div class="wrapper">

			<div class="subscribe clearfix" style="<?php if ( $section_info['subscribe_style'] == 'wrapped' && isset( $section_info['subscribe_bg_image'] ) ) : ?>background-image:url('<?php echo esc_attr( $section_info['subscribe_bg_image'] ); ?>')<?php endif; ?>">

				<?php if ( isset( $section_info['subscribe_title'] ) ) : ?>
					<h2 class="subscribe-title"><?php echo do_shortcode( $section_info['subscribe_title'] ); ?></h2>
				<?php endif; ?>

				<?php if ( isset( $section_info['subscribe_content'] ) ) : ?>
					<div class="subscribe-main">
						<?php echo do_shortcode( $section_info['subscribe_content'] ); ?>
					</div><!-- -.subscribe-main -->
				<?php endif; ?>

				<?php if ( isset( $section_info['subscribe_subtitle'] ) ) : ?>
					<div class="subscribe-subtitle">
						<?php echo do_shortcode( $section_info['subscribe_subtitle'] ); ?>
					</div><!-- .subscribe-subtitle -->
				<?php endif; ?>

			</div><!-- .subscribe -->

		</div><!-- .wrapper -->

	</div><!-- .module-subscribe-overlay -->

</div><!-- .module-wrapper -->
