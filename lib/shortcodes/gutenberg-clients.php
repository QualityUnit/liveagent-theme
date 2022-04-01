<?php

function ms_gutenberg_clients( $atts ) {
	$atts = shortcode_atts(
		array(
			'background' => '',
		),
		$atts,
		'gutenberg-clients'
	);
	ob_start();
	?>

	<div class="Gutenberg Gutenberg--<?= esc_attr( $atts['background'] ); ?>">
		<?php echo do_shortcode( '[clients]' ); ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'gutenberg-clients', 'ms_gutenberg_clients' );
