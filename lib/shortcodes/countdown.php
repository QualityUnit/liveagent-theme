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
		<div class="el-countdown" data-endtime="<?= esc_attr( $atts['date'] ); ?>">
			<div class="el-countdown__items">
				<div class="el-countdown__item">
					<span class="el-countdown__digits el-countdown__digits--days"></span>
					<span class="el-countdown__label">Days</span>
				</div>
				<div class="el-countdown__item">
					<span class="el-countdown__digits el-countdown__digits--hours"></span>
					<span class="el-countdown__label">Hours</span>
				</div>
				<div class="el-countdown__item">
					<span class="el-countdown__digits el-countdown__digits--minutes"></span>
					<span class="el-countdown__label">Minutes</span>
				</div>
				<div class="el-countdown__item">
					<span class="el-countdown__digits el-countdown__digits--seconds"></span>
					<span class="el-countdown__label">Seconds</span>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php
	set_custom_source( 'countdown', 'js' );
	return ob_get_clean();
}
add_shortcode( 'countdown', 'ms_countdown' );
