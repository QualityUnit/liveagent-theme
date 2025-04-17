<?php

function ms_block_pricing( $atts ) {
	$atts = shortcode_atts(
		array(
			'title1'   => __( 'Small', 'ms' ),
			'price1'   => __( '$15', 'ms' ),
			'text1-1'  => __( 'Unlimited ticket history', 'ms' ),
			'text1-2'  => __( '3 email addresses', 'ms' ),
			'text1-3'  => __( '3 contact forms', 'ms' ),
			'text1-4'  => __( '1 API key', 'ms' ),
			'title2'   => __( 'Medium', 'ms' ),
			'price2'   => __( '$29', 'ms' ),
			'text2-1'  => __( 'Everything in Small, plus', 'ms' ),
			'text2-2'  => __( '10 email addresses', 'ms' ),
			'text2-3'  => __( '3 live chat buttons', 'ms' ),
			'text2-4'  => __( 'Departments management', 'ms' ),
			'title3'   => __( 'Large', 'ms' ),
			'price3'   => __( '$49', 'ms' ),
			'text3-1'  => __( 'Everything in Medium plus', 'ms' ),
			'text3-2'  => __( '40 email addresses', 'ms' ),
			'text3-3'  => __( '10 live chat buttons', 'ms' ),
			'text3-4'  => __( 'WhatsApp', 'ms' ),
			'popular'  => __( 'Most Popular', 'ms' ),
			'startups' => false,
		),
		$atts,
		'block_pricing'
	);

	$classes = array( 'checkmark', 'italic', 'italic', 'checkmark' );

	ob_start();
	?>

<div class="BlockPricing__container <?= esc_attr( ! $atts['startups'] ? '' : 'startups' ); ?>">
		<?php
		for ( $i = 1; $i <= 3; ++$i ) {
			?>
		<div class="BlockPricing__container__item
			<?= esc_attr( ( 3 == $i && false !== $atts['startups'] ) ? 'BlockPricing__container__item--startup-label' : '' ); ?>
		">
			<div class="PricingTable__header <?= esc_attr( 3 == $i ? 'popular' : '' ); ?>">
				<div class="PricingTable__header__price">
					<div class="PricingTable__header__price--wrap">
						<span class="PricingTable__header__price__amount"><?= esc_html( $atts[ 'price' . $i ] ); ?></span>
						<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
					</div>
				</div>
				<?php
				if ( 3 == $i ) {
					?>
					<p class="PricingTable__header__most-popular"><?= esc_html( $atts['popular'] ); ?></p>
					<?php
				}
				?>
				<?php if ( $atts['startups'] && 3 == $i ) { ?>
					<div class="PricingTable__header__startup__label">
						<p class="PricingTable__header__startup__label__title">
							<?php _e( 'Special offer&nbsp;for Startups', 'ms' ); ?>
						</p>
						<div class="PricingTable__header__startup__label__price">
							<h3><?php _e( '$0', 'ms' ); ?> </h3>
							<p><?php _e( 'for 6 months', 'ms' ); ?></p>
						</div>
						<p class="PricingTable__header__startup__label__name"><strong><?php _e( 'Large plan', 'ms' ); ?></strong></p>
					</div>
				<?php } ?>
				<div class="PricingTable__header__title">
					<h3><?= esc_html( $atts[ 'title' . $i ] ); ?>
						<small><?php _e( 'business', 'ms' ); ?></small>
					</h3>
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
					<a href="<?= esc_url( __( '/trial/', 'ms' ) ); ?>" class="Button Button--outline">
						<span><?= esc_html( __( 'Try for FREE', 'ms' ) ); ?></span>
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
	set_custom_source( 'shortcodes/BlockPricing' );
	return ob_get_clean();
}
add_shortcode( 'block_pricing', 'ms_block_pricing' );
