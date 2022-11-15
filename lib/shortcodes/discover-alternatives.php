<?php

function ms_discover_alternatives( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'        => '',
			'orange-title' => '',
			'text'         => '',
			'link'         => '',
			'image-link'   => '',
		),
		$atts,
		'discover_alternatives'
	);

	ob_start();
	?>

	<div class="InternalLinks__wrapper">
		<a href="<?= esc_url( $atts['link'] ); ?>" >
			<div class="InternalLinks__element">
			<div class="InternalLinks__element__image"><img src="<?= esc_url( $atts['image-link'] ); ?>"></div>
				<div class="InternalLinks__element__content">
					<div class="InternalLinks__element__content__title"><?= esc_html( $atts['title'] ); ?>
						<div class="InternalLinks__element__content__title--orange"><?= esc_html( $atts['orange-title'] ); ?></div>
					</div>
					<div class="InternalLinks__element__content__text"><?= esc_html( $atts['text'] ); ?></div>
				</div>
				<div class="InternalLinks__element__button"></div>
			</div>
		</a>
	</div>

	<?php
	set_custom_source( 'shortcodes/InternalLinks' );
	return ob_get_clean();
}
add_shortcode( 'discover_alternatives', 'ms_discover_alternatives' );
