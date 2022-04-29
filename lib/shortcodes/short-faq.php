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

	<div class="Faq__item">
		<h3><?= esc_html( $atts['title'] ); ?></h3>
		<div class="Faq__outer-wrapper">
			<div class="Faq__inner-wrapper">
				<p><?= esc_html( $atts['text'] ); ?></p>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'shortfaq', 'ms_shortfaq' );
