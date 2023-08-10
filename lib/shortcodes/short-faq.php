<?php

function ms_shortfaq( $atts ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'text'  => '',
		),
		$atts,
		'shortfaq'
	);

	ob_start();
	echo do_shortcode( '[urlslab-faq]' );
	return ob_get_clean();
}
add_shortcode( 'shortfaq', 'ms_shortfaq' );
