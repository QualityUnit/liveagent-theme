<?php

function ms_block_pricing( $atts ) {
	$atts = shortcode_atts(
		array(
			'title1'  => 'Ticket',
			'price1'  => '15$',
			'text1-1' => __( 'Unlimited ticket history', 'ms' ),
			'text1-2' => __( 'Unlimited email addresses', 'ms' ),
			'text1-3' => __( 'Advanced reporting', 'ms' ),
			'text1-4' => __( 'Customer portal + forum', 'ms' ),
			'title2'  => 'Ticket+chat',
			'price2'  => '29$',
			'text2-1' => __( 'Everything in Ticket, plus:', 'ms' ),
			'text2-2' => __( 'Unlimited chat buttons', 'ms' ),
			'text2-3' => __( 'Feedback management', 'ms' ),
			'text2-4' => __( 'Real time visitors monitor', 'ms' ),
			'title3'  => 'All-Inclusive',
			'price3'  => '49$',
			'text3-1' => __( 'Everything in Ticket + chat, plus:', 'ms' ),
			'text3-2' => __( 'Call center support', 'ms' ),
			'text3-3' => __( 'Video call', 'ms' ),
			'text3-4' => __( 'IVR', 'ms' ),
			'title4'  => 'Free',
			'price4'  => '0$',
			'text4-1' => __( '7 days ticket history', 'ms' ),
			'text4-2' => __( '1 chat button', 'ms' ),
			'text4-3' => __( '1 phone number', 'ms' ),
			'text4-4' => __( '1 email address', 'ms' ),
		),
		$atts,
		'block_pricing'
	);

	$classes = array('checkmark', 'italic', 'italic', 'checkmark');
	$button_link = array('trial', 'trial', 'trial', 'free-account');
	$button_text = array('Try for FREE', 'Try for FREE', 'Try for FREE', 'Create');

	ob_start();
	?>

	<div class="BlockPricing__container">
		<?php
		for ( $i = 1; $i <= 4; ++$i ) {
			?>
			<div class="BlockPricing__container__item">
			<div class="PricingTable__header <?php if ($i == 3) echo ' popular'?>">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts['price' . $i] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts['title' . $i] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul>
						<li class=<?php _e( $classes[$i-1] ); ?>>
							<span><?php _e( $atts[ 'text' . $i . '-1'] ); ?></span>
						</li>
						<li class="checkmark" >
							<span><?php _e( $atts[ 'text' . $i . '-2'] ); ?></span>
						</li>
						<li  class="checkmark">
							<span><?php _e( $atts[ 'text' . $i . '-3'] ); ?></span>
						</li>
						<li  class="checkmark">
							<span><?php _e( $atts[ 'text' . $i . '-4'] ); ?></span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<a href="<?php _e( '/' . $button_link[$i-1] . '/', 'ms' ); ?>" class="Button Button--outline">
						<span><?php _e( $button_text[$i-1], 'ms' ); ?></span>
					</a>
				</div>
			</div>

		</div>
		<?php 
		}
		?>
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
