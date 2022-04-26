<?php

function ms_blog_cta( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'  => '',
			'button' => '',
			'buttonDemo' => '',
			'link'       => '',
			'linkDemo'   => '/demo',
			'link'   => '',
			'type'   => 'discover',
		),
		$atts,
		'blog_cta'
	);

	ob_start();
	?>

	<div class="BlogCTA__wrapper Post__m__negative">
		<div class="BlogCTA__element">
			<div class="BlogCTA__element__text"><?= wp_kses_post( $atts['title'] ); ?></div>
			<div class="BlogCTA__element__image"></div>
			<div class="BlogCTA__buttons">
				<a href="<?= esc_url( $atts['link'] ); ?>" class="BlogCTA__element__button Button Button--knockout">
					<span><?= esc_html( $atts['button'] ); ?></span>
				</a>
				<a href="<?= esc_url( $atts['linkDemo'] ); ?>" class="Button Button--outline Button--outline__white">
					<span><?= esc_html( strlen( $atts['buttonDemo'] ) > 0 ? $atts['buttonDemo'] : __( 'Schedule a Demo', 'ms' ) ); ?></span>
				</a>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'blog_cta', 'ms_blog_cta' );
