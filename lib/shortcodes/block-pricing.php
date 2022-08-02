<?php

function ms_block_pricing( $atts ) {
	$atts = shortcode_atts(
		array(
			'title1'   => 'Ticket',
			'price1'   => '$15',
			'title2'   => 'Ticket+chat',
			'price2'   => '$29',
			'title3'   => 'All-Inclusive',
			'price3'   => '$49',
			'title4'   => 'Free',
			'price4'   => '$0',
			'startups' => false,
		),
		$atts,
		'block_pricing'
	);

	ob_start();
	?>

<div class="BlockPricing__container <?= esc_attr( ! $atts['startups'] ? '' : 'startups' ); ?>">
	<div class="BlockPricing__container__item">
		<div class="PricingTable__header">
			<div class="PricingTable__header__price">
				<div class="PricingTable__header__price--wrap">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price1'] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
			</div>
			<div class="PricingTable__header__title">
				<h3><?= esc_html( $atts['title1'] ); ?></h3>
			</div>
			<div class="PricingTable__header__description">
				<ul>
					<li class="checkmark">
						<span><?php _e( 'Unlimited ticket history', 'ms' ); ?></span>
					</li>
					<li class="checkmark">
						<span><?php _e( 'Unlimited email addresses', 'ms' ); ?></span>
					</li>
					<li class="checkmark">
						<span><?php _e( 'Advanced reporting', 'ms' ); ?></span>
					</li>
					<li class="checkmark">
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
				<div class="PricingTable__header__price--wrap">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price2'] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
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
	<div class="BlockPricing__container__item <?= esc_attr( ! $atts['startups'] ? '' : 'BlockPricing__container__item--startups' ); ?>">
		<div class="PricingTable__header popular">
			<div class="PricingTable__header__price <?= esc_attr( ! $atts['startups'] ? '' : 'crossed' ); ?>">
				<span class="PricingTable__header__price__popular highlight-gradient"><?php _e( 'Most popular', 'ms' ); ?></span>
				<div class="PricingTable__header__price--wrap">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price3'] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
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
	<?php if ( $atts['startups'] ) { ?>
		<div class="Block--startups__graphics--last">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
					<div class="elementor-element elementor-element-ae87b0c elementor-widget elementor-widget-text-editor"
						data-id="ae87b0c" data-element_type="widget" data-widget_type="text-editor.default">
						<div class="elementor-widget-container">
							<div class="elementor-text-editor elementor-clearfix">
								<p><b><?php _e( 'Special offer&nbsp;for Startups', 'ms' ); ?></b></p>
							</div>
						</div>
					</div>
					<div class="elementor-element elementor-element-2f86633 price elementor-widget elementor-widget-heading"
						data-id="2f86633" data-element_type="widget" data-widget_type="heading.default">
						<div class="elementor-widget-container">
							<h3 class="elementor-heading-title elementor-size-default"><?php _e( '$0', 'ms' ); ?> </h3>
						</div>
					</div>
					<div class="elementor-element elementor-element-3f1dffa elementor-widget elementor-widget-text-editor"
						data-id="3f1dffa" data-element_type="widget" data-widget_type="text-editor.default">
						<div class="elementor-widget-container">
							<div class="elementor-text-editor elementor-clearfix">
								<p><?php _e( 'for 6 months', 'ms' ); ?>
									<br><br><strong><?php _e( 'All-Inclusive plan', 'ms' ); ?></strong></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	<div class="BlockPricing__container__item BlockPricing__container__item--last">
		<div class="PricingTable__header">
			<div class="PricingTable__header__price">
				<div class="PricingTable__header__price--wrap">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price4'] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
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
	<a href="<?php _e( '/pricing/', 'ms' ); ?>" class="Button Button--full">
		<span><?php _e( 'Compare plans', 'ms' ); ?></span>
		<span class="ButtonPricing--arrow">&#8594;</span>
	</a>
</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'block_pricing', 'ms_block_pricing' );
