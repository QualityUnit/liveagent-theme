<?php

function ms_discover( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'      => '',
			'text'       => '',
			'button'     => '',
			'buttonDemo' => '',
			'link'       => '',
			'linkDemo'   => '/demo',
			'type'       => 'discover',
		),
		$atts,
		'discover'
	);

	ob_start();
	?>

	<div class="BlockDiscover BlockDiscover--<?= esc_attr( $atts['type'] ); ?>">
		<h4><?= esc_html( $atts['title'] ); ?></h4>
		<p><?= esc_html( $atts['text'] ); ?></p>

		<div class="BlockDiscover__buttons">
			<a href="<?= esc_url( $atts['link'] ); ?>" class="Button Button--knockout">
				<span><?= esc_html( $atts['button'] ); ?></span>
			</a>
			<a href="<?= esc_url( $atts['linkDemo'] ); ?>" class="Button Button--outline Button--outline__white">
				<span><?= esc_html( strlen( $atts['buttonDemo'] ) > 0 ? $atts['buttonDemo'] : __( 'Schedule a Demo', 'ms' ) ); ?></span>
			</a>
		</div>

	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'discover', 'ms_discover' );
