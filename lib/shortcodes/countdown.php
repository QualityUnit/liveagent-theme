<?php

function ms_countdown( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'date' => '',
		),
		$atts,
		'countdown'
	);

	ob_start();
	?>

	<?php if ( '' !== $atts['date'] ) { ?>
		<div class="Countdown" data-endtime="<?= esc_attr( $atts['date'] ); ?>">
			<div class="Countdown__items">
				<div class="Countdown__item">
					<span class="Countdown__digits Countdown__digits--days" data-days></span>
					<span class="Countdown__label"><?php _e( 'Days', 'ms' ); ?></span>
				</div>
				<div class="Countdown__item">
					<span class="Countdown__digits Countdown__digits--hours" data-hours></span>
					<span class="Countdown__label"><?php _e( 'Hours', 'ms' ); ?></span>
				</div>
				<div class="Countdown__item">
					<span class="Countdown__digits Countdown__digits--minutes" data-minutes></span>
					<span class="Countdown__label"><?php _e( 'Minutes', 'ms' ); ?></span>
				</div>
				<div class="Countdown__item">
					<span class="Countdown__digits Countdown__digits--seconds" data-seconds></span>
					<span class="Countdown__label"><?php _e( 'Seconds', 'ms' ); ?></span>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php
	set_custom_source( 'shortcodes/Countdown' );
	set_custom_source( 'countdown', 'js' );
	return ob_get_clean();
}
add_shortcode( 'countdown', 'ms_countdown' );
