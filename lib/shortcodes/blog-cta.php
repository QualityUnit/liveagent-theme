<?php

function ms_blog_cta( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'  => '',
			'button' => '',
			'link'   => '',
			'type'   => 'discover',
		),
		$atts,
		'blog_cta'
	);

	ob_start();
	?>

	<div class="BlogCTA__wrapper">
		<div class="BlogCTA__element">
			<div class="BlogCTA__element__text"><?= wp_kses_post( $atts['title'] ); ?></div>
			<div class="BlogCTA__element__image--<?= esc_attr( $atts['type'] ); ?>"></div>
			<div class="BlogCTA__element__button">
				<a href="<?= esc_url( $atts['link'] ); ?>" class="Button Button--white">
					<span><?= esc_html( $atts['button'] ); ?></span>
				</a>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'blog_cta', 'ms_blog_cta' );
