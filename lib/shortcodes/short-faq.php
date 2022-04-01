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
	?>

	<div class="ShortFaq">
		<h3><?= esc_html( $atts['title'] ); ?></h3>
		<p><?= esc_html( $atts['text'] ); ?></p>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'shortfaq', 'ms_shortfaq' );
