<?php

function ms_extrafaq( $atts ) {
	$atts = shortcode_atts(
		array(
			'schema'      => 'yes',
			'is-wide'     => 'true',
			'headline'    => '',
			'subheadline' => '',
		),
		$atts,
		'extrafaq'
	);

	ob_start();
	do_shortcode( '[urlslab-faq]' );
	return ob_get_clean();
}
add_shortcode( 'extrafaq', 'ms_extrafaq' );
