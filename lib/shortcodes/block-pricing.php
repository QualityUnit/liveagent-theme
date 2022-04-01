<?php

function ms_block_pricing( $atts ) {
	$atts = shortcode_atts(
		array(
			'image-link'        => '',
			'title'             => '',
			'text'              => '',
			'price'             => '',
			'buttonText'        => 'Try it',
			'buttonLink'        => '/trial/',
			'second_image-link' => '',
			'second_title'      => '',
			'second_text'       => '',
			'second_price'      => '',
		),
		$atts,
		'block_pricing'
	);

	ob_start();
	?>

	<div class="BlockPricing__container">

		<div class="BlockPricing__container__item PricingTable">
			<div class="PricingTable__header green">
				<div class="PricingTable__header__icon">
					<img src="<?= esc_url( $atts['image-link'] ); ?>" alt="<?= esc_attr( $atts['title'] ); ?>">
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<p><?= esc_html( $atts['text'] ); ?></p>
				</div>
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price'] ); ?></span>
				</div>
				<div class="PricingTable__header__button">
					<a href="<?= esc_url( $atts['buttonLink'] ); ?>" class="Button Button--outline">
						<span><?= esc_html( $atts['buttonText'] ); ?></span>
					</a>
				</div>
			</div>
		</div>

		<div class="BlockPricing__container__item PricingTable">
			<div class="PricingTable__header green">
				<div class="PricingTable__header__icon">
					<img src="<?= esc_url( $atts['second_image-link'] ); ?>" alt="<?= esc_attr( $atts['title'] ); ?>">
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['second_title'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<p><?= esc_html( $atts['second_text'] ); ?></p>
				</div>
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['second_price'] ); ?></span>
				</div>
				<div class="PricingTable__header__button">
					<a href="<?= esc_url( $atts['buttonLink'] ); ?>" class="Button Button--outline">
						<span><?= esc_html( $atts['buttonText'] ); ?></span>
					</a>
				</div>
			</div>
		</div>


	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'block_pricing', 'ms_block_pricing' );
