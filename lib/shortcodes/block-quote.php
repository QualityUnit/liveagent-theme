<?php

function ms_blockquote( $atts ) {
	$atts = shortcode_atts(
		array(
			'text'       => '',
			'author'     => '',
			'button'     => __( 'Try it for free', 'ms' ),
			'buttonDemo' => '',
			'link'       => __( '/trial', 'ms' ),
			'linkDemo'   => '/demo',
			'type'       => 'discover',
		),
		$atts,
		'blockquote'
	);

	ob_start();
	?>

	<div class="<?= esc_attr( 'discover' === $atts['type'] ? 'BlogCTA__wrapper Post__m__negative' : 'BlockQuote BlockQuote--' . $atts['type'] ); ?>">
	<?php 
	if ( 'discover' === $atts['type'] ) {
		?>
	<div class="BlogCTA__element">
		<div class="BlogCTA__element__text quote">
			<div class="BlogCTA__element__text__quote"><?= wp_kses_post( $atts['text'] ); ?></div>
			<p class="BlogCTA__element__author"><?= esc_html( $atts['author'] ); ?></p>
		</div>
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
	<?php } ?>
	<?php 
	if ( 'discover' !== $atts['type'] ) {
		?>
		<p class="BlockQuote__text"><?= esc_html( $atts['text'] ); ?></ú>
		<p class="BlockQuote__author"><?= esc_html( $atts['author'] ); ?></p>
	<?php } ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'blockquote', 'ms_blockquote' );
