<?php

function ms_block_pricing( $atts ) {
	$atts = shortcode_atts(
		array(
			'title1' => 'Ticket',
			'price1' => '15$',
			'title2' => 'Ticket+chat',
			'price2' => '29$',
			'title3' => 'All-Inclusive',
			'price3' => '49$',
			'title4' => 'Free',
			'price4' => '0$',
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
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title1'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul>
						<li class="checkmark">
							<span><?php _e( 'Unlimited ticket history', 'ms' ); ?></span>
						</li>
						<li class="checkmark" >
							<span><?php _e( 'Unlimited email addresses', 'ms' ); ?></span>
						</li>
						<li  class="checkmark">
							<span><?php _e( 'Advanced reporting', 'ms' ); ?></span>
						</li>
						<li  class="checkmark">
							<span><?php _e( 'Customer portal + forum', 'ms' ); ?></span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--outline">
						<span><?php _e( 'Try for FREE', 'ms' ); ?></span>
					</a>
				</div>
			</div>

		</div>
		<div class="BlockPricing__container__item">
			<div class="PricingTable__header">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price2'] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title2'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul">
						<li class="italic">
							<span><?php _e( 'Everything in Ticket, plus:', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( 'Unlimited chat buttons', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( 'Feedback management', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( 'Real time visitors monitor', 'ms' ); ?></span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--outline">
						<span><?php _e( 'Try for FREE', 'ms' ); ?></span>
					</a>
				</div>
			</div>
		</div>
		<div class="BlockPricing__container__item">
			<div class="PricingTable__header popular">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price3'] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title3'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul>
						<li class="italic">
							<span><?php _e( 'Everything in Ticket + chat, plus:', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( 'Call center support', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( 'Video call', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( 'IVR', 'ms' ); ?></span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--outline">
						<span><?php _e( 'Try for FREE', 'ms' ); ?></span>
					</a>
				</div>
			</div>

		</div>
		<div class="BlockPricing__container__item">
			<div class="PricingTable__header">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price4'] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title4'] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul>
						<li class="checkmark">
							<span><?php _e( '7 days ticket history', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( '1 chat button', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( '1 phone number', 'ms' ); ?></span>
						</li>
						<li class="checkmark">
							<span><?php _e( '1 email address', 'ms' ); ?></span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--outline">
						<span><?php _e( 'Create', 'ms' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="BlockPricing__button">
		<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
			<span><?php _e( 'Compare plans', 'ms' ); ?></span>
			<span class="ButtonPricing--arrow">&#8594;</span>
		</a>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'block_pricing', 'ms_block_pricing' );
