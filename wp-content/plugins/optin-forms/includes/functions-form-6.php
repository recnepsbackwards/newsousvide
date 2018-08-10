<?php

$optinforms_form6_hide_confirm_checkbox = get_option( 'optinforms_form6_hide_confirm_checkbox' );
$optinforms_form6_confirm_checkbox = get_option( 'optinforms_form6_confirm_checkbox' );

// FORM6: default email field
function optinforms_form6_default_email_field() {
	global $optinforms_form6_email_field;
	if(empty($optinforms_form6_email_field)) {
		$optinforms_form6_email_field = __('Email Address', 'optin-forms');
	}
	if ( is_admin() ) {
		return $optinforms_form6_email_field;
	} else {
		return do_shortcode( $optinforms_form6_email_field );
	}
}

// FORM6: default button text
function optinforms_form6_default_button_text() {
	global $optinforms_form6_button_text;
	if(empty($optinforms_form6_button_text)) {
		$optinforms_form6_button_text = __('Subscribe', 'optin-forms');
	}
	if ( is_admin() ) {
		return $optinforms_form6_button_text;
	} else {
		return do_shortcode( $optinforms_form6_button_text );
	}
}

// FORM6: hide the confirm checkbox
function optinforms_form6_hide_confirm_checkbox() {
	global $optinforms_form6_hide_confirm_checkbox;
	return $optinforms_form6_hide_confirm_checkbox;
}

// FORM4: default confirm checkbox text
function optinforms_form6_default_confirm_checkbox() {
	global $optinforms_form6_confirm_checkbox;
	if(empty($optinforms_form6_confirm_checkbox)) {
		$optinforms_form6_confirm_checkbox = 'I agree to have my personal information transfered to [optinform_provider] ( <a href="[optinform_privacy_url]" target="_blank">more information</a> )';
	}
	if ( is_admin() ) {
		return $optinforms_form6_confirm_checkbox;
	} else {
		return do_shortcode( $optinforms_form6_confirm_checkbox );
	}
}