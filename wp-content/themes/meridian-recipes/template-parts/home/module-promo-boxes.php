<?php

// get section info
$section_info = meridian_recipes_get_section_info();

?>
<div class="module-wrapper module-promo-boxes-wrapper">

	<div class="wrapper">

		<div class="promo-boxes clearfix">

			<?php if ( isset( $section_info['promo_box_1_title'] ) ) : ?>

				<div class="promo-box col col-4" style="<?php if ( isset( $section_info['promo_box_1_bg_image'] ) ) : ?>background-image:url('<?php echo esc_attr( $section_info['promo_box_1_bg_image'] ); ?>')<?php endif; ?>">

					<div class="promo-box-overlay"></div>

					<div class="promo-box-main">
						<?php if ( isset( $section_info['promo_box_1_subtitle'] ) ) : ?>
							<div class="promo-box-subtitle"><?php echo do_shortcode( $section_info['promo_box_1_subtitle'] ); ?></div>
						<?php endif; ?>
						<h4 class="promo-box-title"><?php echo do_shortcode( $section_info['promo_box_1_title'] ); ?></h4>
						<?php if ( isset( $section_info['promo_box_1_url'] ) ) : ?>
							<a href="<?php echo esc_url( $section_info['promo_box_1_url'] ); ?>" class="promo-box-link"></a>
						<?php endif; ?>
					</div><!-- .promo-box-main -->

				</div><!-- .promo-box -->

			<?php endif; ?>

			<?php if ( isset( $section_info['promo_box_2_title'] ) ) : ?>

				<div class="promo-box col col-4" style="<?php if ( isset( $section_info['promo_box_2_bg_image'] ) ) : ?>background-image:url('<?php echo esc_attr( $section_info['promo_box_2_bg_image'] ); ?>')<?php endif; ?>">

					<div class="promo-box-overlay"></div>

					<div class="promo-box-main">
						<?php if ( isset( $section_info['promo_box_2_subtitle'] ) ) : ?>
							<div class="promo-box-subtitle"><?php echo do_shortcode( $section_info['promo_box_2_subtitle'] ); ?></div>
						<?php endif; ?>
						<h4 class="promo-box-title"><?php echo do_shortcode( $section_info['promo_box_2_title'] ); ?></h4>
						<?php if ( isset( $section_info['promo_box_2_url'] ) ) : ?>
							<a href="<?php echo esc_url( $section_info['promo_box_2_url'] ); ?>" class="promo-box-link"></a>
						<?php endif; ?>
					</div><!-- .promo-box-main -->

				</div><!-- .promo-box -->

			<?php endif; ?>

			<?php if ( isset( $section_info['promo_box_3_title'] ) ) : ?>

				<div class="promo-box col col-4 col-last" style="<?php if ( isset( $section_info['promo_box_3_bg_image'] ) ) : ?>background-image:url('<?php echo esc_attr( $section_info['promo_box_3_bg_image'] ); ?>')<?php endif; ?>">

					<div class="promo-box-overlay"></div>

					<div class="promo-box-main">
						<?php if ( isset( $section_info['promo_box_3_subtitle'] ) ) : ?>
							<div class="promo-box-subtitle"><?php echo do_shortcode( $section_info['promo_box_3_subtitle'] ); ?></div>
						<?php endif; ?>
						<h4 class="promo-box-title"><?php echo do_shortcode( $section_info['promo_box_3_title'] ); ?></h4>
						<?php if ( isset( $section_info['promo_box_3_url'] ) ) : ?>
							<a href="<?php echo esc_url( $section_info['promo_box_3_url'] ); ?>" class="promo-box-link"></a>
						<?php endif; ?>
					</div><!-- .promo-box-main -->

				</div><!-- .promo-box -->

			<?php endif; ?>

		</div><!-- .promo-boxes -->

	</div><!-- .wrapper -->

</div><!-- .module-wrapper -->
