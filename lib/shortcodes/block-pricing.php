<?php

function ms_block_pricing( $atts ) {
	$atts = shortcode_atts(
		array(
			'title1'  => __( 'Ticket', 'ms' ),
			'price1'  => __( '15$', 'ms' ),
			'text1-1' => __( 'Unlimited ticket history', 'ms' ),
			'text1-2' => __( 'Unlimited email addresses', 'ms' ),
			'text1-3' => __( 'Advanced reporting', 'ms' ),
			'text1-4' => __( 'Customer portal + forum', 'ms' ),
			'title2'  => __( 'Ticket+chat', 'ms' ),
			'price2'  => __( '29$', 'ms' ),
			'text2-1' => __( 'Everything in Ticket, plus:', 'ms' ),
			'text2-2' => __( 'Unlimited chat buttons', 'ms' ),
			'text2-3' => __( 'Feedback management', 'ms' ),
			'text2-4' => __( 'Real time visitors monitor', 'ms' ),
			'title3'  => __( 'All-Inclusive', 'ms' ),
			'price3'  => __( '49$', 'ms' ),
			'text3-1' => __( 'Everything in Ticket + chat, plus:', 'ms' ),
			'text3-2' => __( 'Call center support', 'ms' ),
			'text3-3' => __( 'Video call', 'ms' ),
			'text3-4' => __( 'IVR', 'ms' ),
			'title4'  => __( 'Free', 'ms' ),
			'price4'  => __( '0$', 'ms' ),
			'text4-1' => __( '7 days ticket history', 'ms' ),
			'text4-2' => __( '1 chat button', 'ms' ),
			'text4-3' => __( '1 phone number', 'ms' ),
			'text4-4' => __( '1 email address', 'ms' ),
		),
		$atts,
		'block_pricing'
	);

	$classes = array( 'checkmark', 'italic', 'italic', 'checkmark' );

	ob_start();
	?>

	<div class="BlockPricing__container">
		<?php
		for ( $i = 1; $i <= 4; ++$i ) {
			?>
			<div class="BlockPricing__container__item">
			<div class="PricingTable__header 
			<?php 
			if ( 3 == $i ) {
				echo ' popular'; 
			}
			?>
			">
				<div class="PricingTable__header__price">
					<span class="PricingTable__header__price__amount"><?= esc_html( $atts[ 'price' . $i ] ); ?></span>
					<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
				</div>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts[ 'title' . $i ] ); ?></h3>
				</div>
				<div class="PricingTable__header__description">
					<ul>
						<li class=<?= esc_attr( $classes[ $i - 1 ] ); ?>>
							<span><?= esc_html( $atts[ 'text' . $i . '-1' ] ); ?></span>
						</li>
						<li class="checkmark" >
							<span><?= esc_html( $atts[ 'text' . $i . '-2' ] ); ?></span>
						</li>
						<li  class="checkmark">
							<span><?= esc_html( $atts[ 'text' . $i . '-3' ] ); ?></span>
						</li>
						<li  class="checkmark">
							<span><?= esc_html( $atts[ 'text' . $i . '-4' ] ); ?></span>
						</li>
					</ul>
				</div>
				<div class="PricingTable__header__button">
					<?php
					if ( 4 != $i ) {
						?>
						<a href="<?= esc_url( __( '/trial/', 'ms' ) ); ?>" class="Button Button--outline">
							<span><?= esc_html( __( 'Try for FREE', 'ms' ) ); ?></span>
						</a>
						<?php
					} else {
						?>
						<a href="<?= esc_url( __( '/free-account/', 'ms' ) ); ?>" class="Button Button--outline">
							<span><?= esc_html( __( 'Create', 'ms' ) ); ?></span>
						</a>
						<?php
					}
					?>
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
