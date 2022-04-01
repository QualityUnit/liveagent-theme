<?php

function ms_awards_switcher( $atts ) {
	$atts = shortcode_atts(
		array(
			'select-year' => '',
		),
		$atts,
		'awards-switcher'
	);
	ob_start();
	?>

	<svg height="0" width="0">
		<defs>
			<clipPath id="yearSwitch">
				<path d="M0 6.00146C0 2.68776 2.68629 0.00146484 6 0.00146484H108C111.314 0.00146484 114 2.68776 114 6.00146V32.0015C114 35.3152 111.314 38.0015 108 38.0015H71.5716C70.5412 38.0015 69.5283 38.2668 68.6302 38.7719L58.3933 44.5296C57.5046 45.0295 56.4229 45.0437 55.5214 44.5675L44.4063 38.6962C43.5426 38.2399 42.5806 38.0015 41.6039 38.0015H6C2.68629 38.0015 0 35.3152 0 32.0015V6.00146Z" />
			</clipPath>
		</defs>
	</svg>

	<div class="Awards__switcher--inn">
		<span class="Awards__switcher--title"><?= esc_html( $atts['select-year'] ); ?></span>
		<ul class="Awards__switcher flex">
	<?php 
		$years   = array_unique( get_categories( array( 'taxonomy' => 'ms_awards_years' ) ), SORT_REGULAR );
		$counter = 0;
	foreach ( $years as $year ) {
		++$counter;
		// @codingStandardsIgnoreStart
		?>
		<li class="Awards__switcher--year <?= esc_html( $counter === 1 ? 'active':'' ); ?>" data-year="<?= esc_html( $year->slug ); ?>">
			<span>
				<?= esc_html( $year->slug ); ?>
			</span>
		</li> 
	<?php }
		// @codingStandardsIgnoreEnd
	?>
	</ul>
		</div>
	<?php
	set_custom_source( 'pages/Awards' );
	return ob_get_clean();
}
add_shortcode( 'awards-switcher', 'ms_awards_switcher' );
