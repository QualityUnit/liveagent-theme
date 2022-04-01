<?php

function ms_blockquote( $atts ) {
	$atts = shortcode_atts(
		array(
			'text'   => '',
			'author' => '',
			'type'   => 'discover',
		),
		$atts,
		'blockquote'
	);

	ob_start();
	?>

	<div class="BlockQuote BlockQuote--<?= esc_attr( $atts['type'] ); ?>">
		<p class="BlockQuote__text"><?= esc_html( $atts['text'] ); ?></p>
		<p class="BlockQuote__author"><?= esc_html( $atts['author'] ); ?></p>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'blockquote', 'ms_blockquote' );
