<?php

function ms_short_pricing() {
	ob_start();
	?>

	<div class="ShortPricing">
		<div class="ShortPricing__item">
			<div class="ShortPricing__item__icon">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon_plan_free.svg" alt="<?php _e( 'Free', 'ms' ); ?>">
			</div>
			<div class="ShortPricing__item__text">
				<p class="ShortPricing__item__text__title"><?php _e( 'Free', 'ms' ); ?></p>
				<p class="ShortPricing__item__text__subtitle"><?php _e( 'Forever free account with some limitations', 'ms' ); ?></p>
			</div>
			<div class="ShortPricing__item__price">
				<span class="ShortPricing__item__price__amount"><strong><?php _e( 'Free', 'ms' ); ?></strong></span>
			</div>
		</div>

		<div class="ShortPricing__item">
			<div class="ShortPricing__item__icon">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon_plan_ticket.svg" alt="<?php _e( 'Small', 'ms' ); ?>">
			</div>
			<div class="ShortPricing__item__text">
				<p class="ShortPricing__item__text__title"><?php _e( 'Small', 'ms' ); ?></p>
				<p class="ShortPricing__item__text__subtitle"><?php _e( 'Full-sized Ticketing Solution', 'ms' ); ?></p>
			</div>
			<div class="ShortPricing__item__price">
				<span class="ShortPricing__item__price__amount"><?php _e( '$', 'ms' ); ?><strong><?php _e( '9', 'ms' ); ?></strong></span>
				<span class="ShortPricing__item__price__label"><?php _e( '/agent/mo', 'ms' ); ?></span>
			</div>
		</div>

		<div class="ShortPricing__item">
			<div class="ShortPricing__item__icon">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon_plan_ticket-chat.svg" alt="<?php _e( 'Medium', 'ms' ); ?>">
			</div>
			<div class="ShortPricing__item__text">
				<p class="ShortPricing__item__text__title"><?php _e( 'Medium', 'ms' ); ?></p>
				<p class="ShortPricing__item__text__subtitle"><?php _e( 'Live Chat on top of Ticketing', 'ms' ); ?></p>
			</div>
			<div class="ShortPricing__item__price">
				<span class="ShortPricing__item__price__amount"><?php _e( '$', 'ms' ); ?><strong><?php _e( '29', 'ms' ); ?></strong></span>
				<span class="ShortPricing__item__price__label"><?php _e( '/agent/mo', 'ms' ); ?></span>
			</div>
		</div>

		<div class="ShortPricing__item">
			<div class="ShortPricing__item__icon">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon_plan_all-inclusive.svg" alt="<?php _e( 'Large', 'ms' ); ?>">
			</div>
			<div class="ShortPricing__item__text">
				<p class="ShortPricing__item__text__title"><?php _e( 'Large', 'ms' ); ?></p>
				<p class="ShortPricing__item__text__subtitle"><?php _e( 'All features under one roof', 'ms' ); ?></p>
			</div>
			<div class="ShortPricing__item__price">
				<span class="ShortPricing__item__price__amount"><?php _e( '$', 'ms' ); ?><strong><?php _e( '49', 'ms' ); ?></strong></span>
				<span class="ShortPricing__item__price__label"><?php _e( '/agent/mo', 'ms' ); ?></span>
			</div>
		</div>
	</div>

	<?php
	set_custom_source( 'components/ShortPricing' );
	return ob_get_clean();
}
add_shortcode( 'short-pricing', 'ms_short_pricing' );
