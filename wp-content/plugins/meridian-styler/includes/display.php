<?php
/**
 * # Display Panel ( meridian_styler_display_panel )
 */

/**
 * # Display Panel
 *
 * @since 1.0
 */
function meridian_styler_display_panel() {

	if ( meridian_styler_user_can_acces() ) {

		?>

		<div id="mtst-panel">

			<div id="mtst-panel-header-top">
				<div class="mtst-panel-header-top-logo">
					<img src="<?php echo MERIDIAN_STYLER_URL; ?>/images/logo.png" />
				</div><!-- #mtst-panel-header-top-logo -->
				<div class="mtst-panel-header-top-actions">
					<!-- <span class="mtst-panel-header-top-action mtst-panel-header-top-action-settings"><span class="mtst-icon mtst-icon-cog"></span></span> -->
					<span class="mtst-panel-header-top-action mtst-panel-header-top-action-minimize" title="Open/Close"><span class="mtst-icon mtst-icon-minus"></span></span>
				</div><!-- #mtst-panel-header-top-actions -->
			</div><!-- #mtst-panel-header-top -->

			<div id="mtst-panel-main-wrap">

				<div id="mtst-panel-main">

					<!-- Select -->

					<div id="mtst-panel-main-select" class="mtst-panel-section mtst-active" data-mtst-id="select">

						Click the element you want to style.

					</div><!-- #mtst-panel-main-select -->

					<!-- Options -->

					<div id="mtst-panel-options" class="mtst-panel-section" data-mtst-id="options">

						<div id="mtst-panel-header">
							<span id="mtst-panel-header-primary">Currently Editing:</span>
							<span id="mtst-panel-header-secondary">- Select Element -</span>
						</div><!-- #mtst-panel-header -->

						<!-- Typography -->

						<div class="mtst-panel-options-group" data-mtst-id="typography">

							<div class="mtst-panel-options-group-header">
								<span class="mtst-panel-options-group-label"><span class="mtst-icon mtst-icon-font"></span><span class="mtst-panel-options-group-label-text">Typography</span></span>
							</div><!-- .mtst-panel-options-group-header -->

							<div class="mtst-panel-options-group-main">
								<div class="mtst-panel-options-group-main-inner">
									<div class="scrollbar-inner">
										<?php meridian_styler_display_options_typography(); ?>
									</div><!-- .mtst-panel-scrollbar-inner -->
								</div><!-- .mtst-panel-options-group-main-inner -->	
							</div><!-- .mtst-panel-options-group-main -->

						</div><!-- .mtst-panel-options-group -->

						<!-- Spacing -->

						<div class="mtst-panel-options-group" data-mtst-id="spacing">

							<div class="mtst-panel-options-group-header">
								<span class="mtst-panel-options-group-label"><span class="mtst-icon mtst-icon-move"></span><span class="mtst-panel-options-group-label-text">Spacing</span></span>
							</div><!-- .mtst-panel-options-group-header -->

							<div class="mtst-panel-options-group-main">
								<div class="mtst-panel-options-group-main-inner">
									<div class="scrollbar-inner">
										<?php meridian_styler_display_options_spacing(); ?>
									</div>
								</div><!-- .mtst-panel-options-group-main-inner -->	
							</div><!-- .mtst-panel-options-group-main -->

						</div><!-- .mtst-panel-options-group -->

						<!-- Background -->

						<div class="mtst-panel-options-group" data-mtst-id="background">

							<div class="mtst-panel-options-group-header">
								<span class="mtst-panel-options-group-label"><span class="mtst-icon mtst-icon-picture"></span><span class="mtst-panel-options-group-label-text">Background</span></span>
							</div><!-- .mtst-panel-options-group-header -->

							<div class="mtst-panel-options-group-main">
								<div class="mtst-panel-options-group-main-inner">
									<div class="scrollbar-inner">
										<?php meridian_styler_display_options_background(); ?>
									</div>
								</div><!-- .mtst-panel-options-group-main-inner -->	
							</div><!-- .mtst-panel-options-group-main -->

						</div><!-- .mtst-panel-options-group -->

						<!-- Border -->

						<div class="mtst-panel-options-group" data-mtst-id="border">

							<div class="mtst-panel-options-group-header">
								<span class="mtst-panel-options-group-label"><span class="mtst-icon mtst-icon-unchecked"></span><span class="mtst-panel-options-group-label-text">Border</span></span>
							</div><!-- .mtst-panel-options-group-header -->

							<div class="mtst-panel-options-group-main">
								<div class="mtst-panel-options-group-main-inner">
									<div class="scrollbar-inner">
										<?php meridian_styler_display_options_border(); ?>
									</div>
								</div><!-- .mtst-panel-options-group-main-inner -->	
							</div><!-- .mtst-panel-options-group-main -->

						</div><!-- .mtst-panel-options-group -->

						<!-- Animation -->

						<div class="mtst-panel-options-group" data-mtst-id="animation">

							<div class="mtst-panel-options-group-header">
								<span class="mtst-panel-options-group-label"><span class="mtst-icon mtst-icon-css3"></span><span class="mtst-panel-options-group-label-text">Animation</span></span>
							</div><!-- .mtst-panel-options-group-header -->

							<div class="mtst-panel-options-group-main">
								<div class="mtst-panel-options-group-main-inner">
									<?php meridian_styler_display_options_animation(); ?>
								</div><!-- .mtst-panel-options-group-main-inner -->	
							</div><!-- .mtst-panel-options-group-main -->

						</div><!-- .mtst-panel-options-group -->

					</div><!-- #mtst-panel-option -->

					<!-- Discard -->

					<div id="mtst-panel-section-discard" class="mtst-panel-section" data-mtst-id="discard">

						<p>Discard changes from this session or all changes you've made? <strong>Note:</strong> Page will be reloaded.</p>

						<p>
							<span class="mtst-button mtst-hook-discard-session">This Session</span>
							<span class="mtst-button mtst-hook-discard-all">All Changes</span>
						</p>

						Or perhaps <span class="mtst-action mtst-hook-cancel-discard">cancel discarding</span>

					</div><!-- #mtst-panel-section-discard -->

				</div><!-- #mtst-panel-main -->

				<div id="mtst-panel-footer">
					
					<div id="mtst-panel-confirm"><span class="mtst-loading"><span class="mtst-icon mtst-icon-spinner mtst-icon-spin"></span></span><span class="mtst-loaded">Publish Changes</span></div>
					<div id="mtst-panel-discard">Discard Changes</div>

				</div><!-- #mtst-panel-footer -->

			</div><!-- #mtst-panel-main-wrap -->

			<?php

				// Current data
				$current_data_value = '';
				if ( meridian_styler_get_js_data() ) {
					$current_data_value = meridian_styler_get_js_data();
				}

				// current CSS code
				$current_css_value = '';
				if ( meridian_styler_get_css_code() ) {
					$current_css_value = meridian_styler_get_css_code();
				}

			?>

			<textarea id="mtst-panel-data"><?php echo $current_data_value; ?></textarea>
			<textarea id="mtst-panel-code"><?php echo $current_css_value; ?></textarea>

		</div><!-- .mtst-panel -->

		<?php

	}
	
	// current animation data
	$current_animation_data = '';
	if ( meridian_styler_get_animation_data() ) {
		$current_animation_data = meridian_styler_get_animation_data();
	}
	?><textarea style="display: none;" id="mtst-panel-animation-data"><?php echo $current_animation_data; ?></textarea><?php

} add_action( 'wp_footer', 'meridian_styler_display_panel' );

/**
 * Display Options
 *
 * @since 1.0
 */
function meridian_styler_display_option( $atts = array() ) {

	// ( all ) type
	$type = 'text';
	if ( isset( $atts['type'] ) )
		$type = $atts['type'];

	// ( all ) affect CSS rule
	$affect = '';
	if ( isset( $atts['affect'] ) )
		$affect = $atts['affect'];

	// ( all ) label
	$label = '';
	if ( isset( $atts['label'] ) )
		$label = $atts['label'];

	// ( slider ) extension
	$ext = '';
	if ( isset( $atts['ext'] ) )
		$ext = $atts['ext'];

	// ( slider ) minimum
	$min = '';
	if ( isset( $atts['min'] ) )
		$min = $atts['min'];

	// ( slider ) maximum
	$max = '';
	if ( isset( $atts['max'] ) )
		$max = $atts['max'];

	// ( slider ) increment
	$inc = '';
	if ( isset( $atts['inc'] ) )
		$inc = $atts['inc'];

	// ( select ) choices
	$choices = array();
	if ( isset( $atts['choices'] ) )
		$choices = $atts['choices'];	

	?>
	<div class="mtst-panel-option mtst-panel-option-type-<?php echo $type; ?>" data-mtst-affect="<?php echo $affect; ?>" data-mtst-ext="<?php echo $ext; ?>" data-mtst-min="<?php echo $min; ?>" data-mtst-max="<?php echo $max; ?>" data-mtst-inc="<?php echo $inc; ?>">

		<div class="mtst-panel-option-header">
			<span class="mtst-panel-option-label"><?php echo $label; ?></span>
			<span class="mtst-panel-option-extra"></span>
		</div><!-- .mtst-panel-option-header -->

		<div class="mtst-panel-option-main">
			
			<?php if ( $type == 'select' ) : ?>
				<select class="mtst-panel-option-value">
					<?php foreach ( $choices as $choice_val => $choice_lab ) : ?>
						<option value="<?php echo $choice_val; ?>"><?php echo $choice_lab; ?></option>
					<?php endforeach; ?>
				</select>
			<?php else : ?>
				<input type="text" class="mtst-panel-option-value" />
			<?php endif; ?>
			
			<?php if ( $type == 'font-family' ) : ?>
				<div class="mtst-panel-option-type-font-family-suggest"></div>
			<?php elseif ( $type == 'slider' ) : ?>
				<div class="mtst-panel-option-slider"></div>
			<?php endif; ?>

		</div><!-- .mtst-panel-option-main -->

	</div><!-- .mtst-panel-option -->
	<?php

}

/**
 * Display typography options
 *
 * @since 1.0
 */
function meridian_styler_display_options_typography() {

	// Color
	meridian_styler_display_option( array(
		'type'   => 'colorpicker',
		'affect' => 'color',
		'label'  => 'Color',
	));

	// Font family
	meridian_styler_display_option( array(
		'type'   => 'font-family',
		'affect' => 'font-family',
		'label'  => 'Font family',
	));

	// Font size
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'font-size',
		'ext'    => 'px',
		'label'  => 'Font Size',
	));

	// Font weight
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'font-weight',
		'ext'    => '',
		'min'    => '100',
		'max'    => '900',
		'inc'    => '100',
		'label'  => 'Font Weight',
	));

	// Line height
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'line-height',
		'ext'    => 'px',
		'label'  => 'Line Height',
	));

	// Letter Spacing
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'letter-spacing',
		'ext'    => 'px',
		'max'    => '40',
		'label'  => 'Letter Spacing',
	));

	// Letter Spacing
	meridian_styler_display_option( array(
		'type'   => 'select',
		'choices' => array(
			'left'   => 'Left',
			'center' => 'Center',
			'right'  => 'Right',
		),
		'affect' => 'text-align',
		'label'  => 'Text Align',
	));

	// Hook to add more options to this group
	do_action( 'meridian_styler_display_options_typography' );

}

/**
 * Display spacing options
 *
 * @since 1.0
 */
function meridian_styler_display_options_spacing() {

	// Padding left
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'padding-left',
		'ext'    => 'px',
		'label'  => 'Padding Left',
	));

	// Padding right
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'padding-right',
		'ext'    => 'px',
		'label'  => 'Padding Right',
	));

	// Padding top
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'padding-top',
		'ext'    => 'px',
		'label'  => 'Padding Top',
	));

	// Padding bottom
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'padding-bottom',
		'ext'    => 'px',
		'label'  => 'Padding Bottom',
	));	

	// Margin left
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'margin-left',
		'ext'    => 'px',
		'label'  => 'Margin Left',
	));

	// Margin right
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'margin-right',
		'ext'    => 'px',
		'label'  => 'Margin Right',
	));

	// Margin top
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'margin-top',
		'ext'    => 'px',
		'label'  => 'Margin Top',
	));

	// Margin bottom
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'margin-bottom',
		'ext'    => 'px',
		'label'  => 'Margin Bottom',
	));

}

/**
 * Display typography options
 *
 * @since 1.0
 */
function meridian_styler_display_options_background() {

	// BG Color
	meridian_styler_display_option( array(
		'type'   => 'colorpicker',
		'affect' => 'background-color',
		'label'  => 'Color',
	));

	// BG Image

	// BG Repeat
	meridian_styler_display_option( array(
		'type'    => 'select',
		'choices' => array(
			'repeat'    => 'Repeat',
			'repeat-x'  => 'Repeat Horizontal',
			'repeat-y'  => 'Repeat Vertical',
			'no-repeat' => 'No Repeat'
		),
		'affect'  => 'background-repeat',
		'label'   => 'Image Repeat',
	));

	// BG attachment
	meridian_styler_display_option( array(
		'type'    => 'select',
		'choices' => array(
			'fixed'  => 'Fixed',
			'scroll' => 'Scroll',
		),
		'affect'  => 'background-attachment',
		'label'   => 'Image Attachment',
	));

	// Position
	meridian_styler_display_option( array(
		'type'    => 'select',
		'choices' => array(
			'left top'       => 'Top Left',
			'right top'      => 'Top Right',
			'center top'     => 'Top Center',
			'left center'    => 'Center Left',
			'right center'   => 'Center Right',
			'center center'  => 'Center',
			'left bottom'    => 'Bottom Left',
			'right bottom'   => 'Bottom Right',
			'center bottom'  => 'Bottom Center',
		),
		'affect'  => 'background-attachment',
		'label'   => 'Image Position',
	));

}

/**
 * Display border options
 *
 * @since 1.0
 */
function meridian_styler_display_options_border() {

	// Top Left Radius
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'border-top-left-radius',
		'ext'    => 'px',
		'label'  => 'Radius - Top Left',
	));

	// Top Right Radius
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'border-top-right-radius',
		'ext'    => 'px',
		'label'  => 'Radius - Top Right',
	));	

	// Bottom Right Radius
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'border-bottom-right-radius',
		'ext'    => 'px',
		'label'  => 'Radius - Bottom Right',
	));	

	// Bottom Right Radius
	meridian_styler_display_option( array(
		'type'   => 'slider',
		'affect' => 'border-bottom-left-radius',
		'ext'    => 'px',
		'label'  => 'Radius - Bottom Left',
	));	

}

/**
 * Display animation options
 *
 * @since 1.0
 */
function meridian_styler_display_options_animation() {

	// Position
	meridian_styler_display_option( array(
		'type'    => 'select',
		'choices' => array(
			'none' => 'None',
			'flash' => 'flash',
			'bounce' => 'bounce',
			'pulse' => 'pulse',
			'rubberBand' => 'rubberBand',
			'shake' => 'shake',
			'headShake' => 'headShake',
			'swing' => 'swing',
			'tada' => 'tada',
			'wobble' => 'wobble',
			'jello' => 'jello',
			'bounceIn' => 'bounceIn',
			'bounceInDown' => 'bounceInDown',
			'bounceInLeft' => 'bounceInLeft',
			'bounceInRight' => 'bounceInRight',
			'bounceInUp' => 'bounceInUp',
			//'bounceOut' => 'bounceOut',
			//'bounceOutDown' => 'bounceOutDown',
			//'bounceOutLeft' => 'bounceOutLeft',
			//'bounceOutRight' => 'bounceOutRight',
			//'bounceOutUp' => 'bounceOutUp',
			'fadeIn' => 'fadeIn',
			'fadeInDown' => 'fadeInDown',
			'fadeInDownBig' => 'fadeInDownBig',
			'fadeInLeft' => 'fadeInLeft',
			'fadeInLeftBig' => 'fadeInLeftBig',
			'fadeInRight' => 'fadeInRight',
			'fadeInRightBig' => 'fadeInRightBig',
			'fadeInUp' => 'fadeInUp',
			'fadeInUpBig' => 'fadeInUpBig',
			//'fadeOut' => 'fadeOut',
			//'fadeOutDown' => 'fadeOutDown',
			//'fadeOutDownBig' => 'fadeOutDownBig',
			//'fadeOutLeft' => 'fadeOutLeft',
			//'fadeOutLeftBig' => 'fadeOutLeftBig',
			//'fadeOutRight' => 'fadeOutRight',
			//'fadeOutRightBig' => 'fadeOutRightBig',
			//'fadeOutUp' => 'fadeOutUp',
			//'fadeOutUpBig' => 'fadeOutUpBig',
			'flipInX' => 'flipInX',
			'flipInY' => 'flipInY',
			//'flipOutX' => 'flipOutX',
			//'flipOutY' => 'flipOutY',
			'lightSpeedIn' => 'lightSpeedIn',
			//'lightSpeedOut' => 'lightSpeedOut',
			'rotateIn' => 'rotateIn',
			'rotateInDownLeft' => 'rotateInDownLeft',
			'rotateInDownRight' => 'rotateInDownRight',
			'rotateInUpLeft' => 'rotateInUpLeft',
			'rotateInUpRight' => 'rotateInUpRight',
			//'rotateOut' => 'rotateOut',
			//'rotateOutDownLeft' => 'rotateOutDownLeft',
			//'rotateOutDownRight' => 'rotateOutDownRight',
			//'rotateOutUpLeft' => 'rotateOutUpLeft',
			//'rotateOutUpRight' => 'rotateOutUpRight',
			//'hinge' => 'hinge',
			'rollIn' => 'rollIn',
			//'rollOut' => 'rollOut',
			'zoomIn' => 'zoomIn',
			'zoomInDown' => 'zoomInDown',
			'zoomInLeft' => 'zoomInLeft',
			'zoomInRight' => 'zoomInRight',
			'zoomInUp' => 'zoomInUp',
			//'zoomOut' => 'zoomOut',
			//'zoomOutDown' => 'zoomOutDown',
			//'zoomOutLeft' => 'zoomOutLeft',
			//'zoomOutRight' => 'zoomOutRight',
			//'zoomOutUp' => 'zoomOutUp',
			'slideInDown' => 'slideInDown',
			'slideInLeft' => 'slideInLeft',
			'slideInRight' => 'slideInRight',
			'slideInUp' => 'slideInUp',
			//'slideOutDown' => 'slideOutDown',
			//'slideOutLeft' => 'slideOutLeft',
			//'slideOutRight' => 'slideOutRight',
			//'slideOutUp' => 'slideOutUp',
		),
		'affect'  => 'animation',
		'label'   => 'Animation',
	));

}