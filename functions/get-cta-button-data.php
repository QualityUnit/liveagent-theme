<?php
function get_cta_button_data() {
	$cta_button_text = get_post_meta( get_the_ID(), 'cta_button_text', true );
	$cta_button_url = get_post_meta( get_the_ID(), 'cta_button_url', true );
	$cta_button_enabled = get_post_meta( get_the_ID(), 'cta_button_switch', true );

	$default_cta_button_text = 'Free trial';
	$default_cta_button_url = '/trial/';
	$default_cta_button_enabled = 'no';

	$cta_button_text = ( '' !== $cta_button_text ) ? $cta_button_text : $default_cta_button_text;
	$cta_button_url = ( '' !== $cta_button_url ) ? $cta_button_url : $default_cta_button_url;
	$cta_button_enabled = ( '' !== $cta_button_enabled ) ? $cta_button_enabled : $default_cta_button_enabled;

	$header_cta_button = array();
	if ( $cta_button_text || $cta_button_url ) {
		$header_cta_button[] = array(
			'enabled' => $cta_button_enabled,
			'url' => $cta_button_url,
			'text' => $cta_button_text,
		);
	}

	return $header_cta_button;
}
