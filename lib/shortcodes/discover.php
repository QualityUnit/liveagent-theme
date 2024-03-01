<?php

function ms_discover( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'      => '',
			'text'       => '',
			'button'     => '',
			'buttonDemo' => '',
			'link'       => '/trial/',
			'linkDemo'   => '/demo/',
			'type'       => 'discover',
		),
		$atts,
		'discover'
	);

	ob_start();

	$background_url = get_template_directory_uri() . '/assets/images/cta_new_bg.svg';
	?>


	<div class="BlockDiscover BlockDiscover--<?= esc_attr( $atts['type'] ); ?>" style="background-image: url(<?= esc_attr( $background_url ); ?>)">
		<p class="BlockDiscover__title"><?= esc_html( $atts['title'] ); ?></p>
		<p class="BlockDiscover__text"><?= esc_html( $atts['text'] ); ?></p>

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
	set_custom_source( 'shortcodes/BlockDiscover' );
	return ob_get_clean();
}
add_shortcode( 'discover', 'ms_discover' );
