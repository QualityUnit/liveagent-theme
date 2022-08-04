<?php

function ms_block_pricing( $atts ) {
	$atts = shortcode_atts(
		array(
			'title1'   => __( 'Ticket', 'ms' ),
			'price1'   => __( '$15', 'ms' ),
			'text1-1'  => __( 'Unlimited ticket history', 'ms' ),
			'text1-2'  => __( 'Unlimited email addresses', 'ms' ),
			'text1-3'  => __( 'Advanced reporting', 'ms' ),
			'text1-4'  => __( 'Customer portal + forum', 'ms' ),
			'title2'   => __( 'Ticket+chat', 'ms' ),
			'price2'   => __( '$29', 'ms' ),
			'text2-1'  => __( 'Everything in Ticket, plus:', 'ms' ),
			'text2-2'  => __( 'Unlimited chat buttons', 'ms' ),
			'text2-3'  => __( 'Feedback management', 'ms' ),
			'text2-4'  => __( 'Real time visitors monitor', 'ms' ),
			'title3'   => __( 'All-Inclusive', 'ms' ),
			'price3'   => __( '$49', 'ms' ),
			'text3-1'  => __( 'Everything in Ticket + chat, plus:', 'ms' ),
			'text3-2'  => __( 'Call center support', 'ms' ),
			'text3-3'  => __( 'Video call', 'ms' ),
			'text3-4'  => __( 'IVR', 'ms' ),
			'title4'   => __( 'Free', 'ms' ),
			'price4'   => __( '$0', 'ms' ),
			'text4-1'  => __( '7 days ticket history', 'ms' ),
			'text4-2'  => __( '1 chat button', 'ms' ),
			'text4-3'  => __( '1 phone number', 'ms' ),
			'text4-4'  => __( '1 email address', 'ms' ),
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
		for ( $i = 1; $i <= 4; ++$i ) {
			?>
		<div class="BlockPricing__container__item 
			<?= esc_attr( 4 == $i ? 'BlockPricing__container__item--last' : '' ); ?> 
			<?= esc_attr( ( 3 == $i && false !== $atts['startups'] ) ? 'BlockPricing__container__item--startups' : '' ); ?> 
		">
			<div class="PricingTable__header <?= esc_attr( 3 == $i ? 'popular' : '' ); ?>">
				<div class="PricingTable__header__price">
					<div class="PricingTable__header__price--wrap">
						<span class="PricingTable__header__price__amount"><?= esc_html( $atts[ 'price' . $i ] ); ?></span>
						<span class="PricingTable__header__price__month"><?php _e( 'month', 'ms' ); ?></span>
					</div>
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
			<?php if ( $atts['startups'] && 3 == $i ) { ?>
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
				<?php 
			} 
		} 
		?>
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
