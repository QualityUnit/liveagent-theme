<?php

function ms_nicereply( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'    => 'Are you a LiveAgent customer looking to use Nicereply?',
			'discount' => 'Get a special discount now.',
			'button'   => 'Contact us',
			'checks'   => 'No setup fee|Customer service 24/7|No credit card required|Cancel any time',
		),
		$atts,
		'nicereply'
	);

	ob_start();
	?>

	<div class="Nicereply Post__m__negative">
		<div class="Nicereply__content">
			<div class="Nicereply__title">
				<?= wp_kses_post( $atts['title'] ); ?>
				<span class="highlight highlight-gradient"><?= wp_kses_post( $atts['discount'] ); ?></span>
			</div>
			<ul class="no-cc">
				<?php 
					$checks = explode( '|', $atts['checks'] );
				foreach ( $checks as $check ) {
					?>
					<li>✓ <?= esc_html( $check ); ?></li>
				<?php } ?>
			</ul>
			<div class="Nicereply__button">
				<a href="mailto:support@liveagent.com" class="Button Button--full">
					<span><?= esc_html( $atts['button'] ); ?></span>
				</a>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'nicereply', 'ms_nicereply' );
