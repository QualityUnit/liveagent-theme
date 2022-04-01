<?php

function ms_discover( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'  => '',
			'text'   => '',
			'button' => '',
			'link'   => '',
			'type'   => 'discover',
		),
		$atts,
		'discover'
	);

	ob_start();
	?>

	<div class="BlockDiscover BlockDiscover--<?= esc_attr( $atts['type'] ); ?>">
		<p><strong><?= esc_html( $atts['title'] ); ?></strong></p>
		<p><?= esc_html( $atts['text'] ); ?></p>

		<a href="<?= esc_url( $atts['link'] ); ?>" class="Button Button--white">
			<span><?= esc_html( $atts['button'] ); ?></span>
		</a>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'discover', 'ms_discover' );
