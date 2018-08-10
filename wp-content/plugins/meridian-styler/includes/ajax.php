<?php

/**
 * Publish changes
 *
 * @since 1.0
 */
function meridian_styler_ajax_publish_changes( $atts ) {

	//Can the user save?
	if ( meridian_styler_user_can_save() ) {

		// Response array
		$response = array();

		// CSS code
		$css_code = stripslashes( $_POST['css_code'] );

		// JS data
		$js_data = $_POST['js_data'];

		// Animation data
		$animation_data = stripslashes( $_POST['animation_data'] );

		// Save the new CSS code
		if ( update_option( 'mtst_css_code', $css_code ) )
			$response['status'] = 'success';
		else
			$response['status'] = 'failed';

		// Save the new JS data
		if ( update_option( 'mtst_js_data', $js_data ) )
			$response['status'] = 'success';
		else
			$response['status'] = 'failed';

		// Save the new animation data
		update_option( 'mtst_animation_data', $animation_data );

		$response['status'] = 'success';

		// Encode response
		$response_json = json_encode( $response );

		// Send the response
		header( "Content-Type: application/json" );
		echo $response_json;

		// Au revoir
		exit;

	}

} add_action( 'wp_ajax_mtst-ajax-publish-changes', 'meridian_styler_ajax_publish_changes' );

/**
 * Publish changes
 *
 * @since 1.0
 */
function meridian_styler_ajax_discard_all_changes( $atts ) {

	//Can the user save?
	if ( meridian_styler_user_can_save() ) {

		// Response array
		$response = array();

		// Delete option dta
		delete_option( 'mtst_css_code' );
		delete_option( 'mtst_js_data' );
		delete_option( 'mtst_animation_data' );

		$response['status'] = 'success';

		// Encode response
		$response_json = json_encode( $response );

		// Send the response
		header( "Content-Type: application/json" );
		echo $response_json;

		// Au revoir
		exit;

	}

} add_action( 'wp_ajax_mtst-ajax-discard-all-changes', 'meridian_styler_ajax_discard_all_changes' );