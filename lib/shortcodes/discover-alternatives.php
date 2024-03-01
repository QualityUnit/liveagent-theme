<?php

function ms_discover_alternatives( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'        => '',
			'orange-title' => '',
			'text'         => '',
			'link'         => '/trial/',
			'image-link'   => '',
			'bg-image'   => get_template_directory_uri() . '/assets/images/bg_internal_link.png',
			'bg-position'   => 'center center',
			'bg-size'   => 'contain',
			'btn-icon'   => get_template_directory_uri() . '/assets/images/arrow-right.svg',
		),
		$atts,
		'discover_alternatives'
	);

	ob_start();
	?>

	<div class="InternalLinks__wrapper">
		<a href="<?= esc_url( $atts['link'] ); ?>" >
			<div class="InternalLinks__element" style="background-image: url(<?= esc_url( $atts['bg-image'] ); ?>); background-position:<?= esc_attr( $atts['bg-position'] ); ?>; background-size:<?= esc_attr( $atts['bg-size'] ); ?>;">
			<div class="InternalLinks__element__image"><img src="<?= esc_url( $atts['image-link'] ); ?>"></div>
				<div class="InternalLinks__element__content">
					<div class="InternalLinks__element__content__title"><?= esc_html( $atts['title'] ); ?>
						<div class="InternalLinks__element__content__title--orange"><?= esc_html( $atts['orange-title'] ); ?></div>
					</div>
					<div class="InternalLinks__element__content__text"><?= esc_html( $atts['text'] ); ?></div>
				</div>
				<div class="InternalLinks__element__button" style="background-image: url(<?= esc_url( $atts['btn-icon'] ); ?>)"></div>
			</div>
		</a>
	</div>

	<?php
	set_custom_source( 'shortcodes/InternalLinks' );
	return ob_get_clean();
}
add_shortcode( 'discover_alternatives', 'ms_discover_alternatives' );
