<?php

function ms_block_pricing( $atts ) {
	$atts = shortcode_atts(
		array(
			'title1' => '',
			'price1' => '',
			'title2' => '',
			'price2' => '',
			'title3' => '',
			'price3' => '',
			'title4' => '',
			'price4' => '',
		),
		$atts,
		'block_pricing'
	);

	ob_start();
	?>

	<div class="BlockPricing__container">
		<div class="BlockPricing__container__item">
			<div class="PricingTable__header">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price1'] ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title1'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul>
						<li class="checkmark">
							<span>Unlimited ticket history</span>
						</li>
						<li class="checkmark" >
							<span>Unlimited email addresses</span>
						</li>
						<li  class="checkmark">
							<span>Advanced reporting</span>
						</li>
						<li  class="checkmark">
							<span>Customer portal + forum</span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="/trial/'" class="Button Button--outline">
						<span>Try for FREE</span>
					</a>
				</div>
			</div>

		</div>
		<div class="BlockPricing__container__item">
			<div class="PricingTable__header">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price2'] ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title2'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul">
						<li class="italic">
							<span>Everything in Ticket, plus:</span>
						</li>
						<li class="checkmark">
							<span>Unlimited chat buttons</span>
						</li>
						<li class="checkmark">
							<span>Feedback management</span>
						</li>
						<li class="checkmark">
							<span>Real time visitors monitor</span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="/trial/'" class="Button Button--outline">
						<span>Try for FREE</span>
					</a>
				</div>
			</div>
		</div>
		<div class="BlockPricing__container__item">
			<div class="PricingTable__header popular">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price3'] ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title3'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul>
						<li class="italic">
							<span>Everything in Ticket + chat, plus:</span>
						</li>
						<li class="checkmark">
							<span>Call center support</span>
						</li>
						<li class="checkmark">
							<span>Video call</span>
						</li>
						<li class="checkmark">
							<span>IVR</span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="/trial/'" class="Button Button--outline">
						<span>Try for FREE</span>
					</a>
				</div>
			</div>

		</div>
		<div class="BlockPricing__container__item">
			<div class="PricingTable__header">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price4'] ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title4'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul>
						<li class="checkmark">
							<span>7 days ticket history</span>
						</li>
						<li class="checkmark">
							<span>1 chat button</span>
						</li>
						<li class="checkmark">
							<span>1 phone number</span>
						</li>
						<li class="checkmark">
							<span>1 email address</span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="/trial/'" class="Button Button--outline">
						<span>Create</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'block_pricing', 'ms_block_pricing' );
