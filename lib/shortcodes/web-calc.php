<?php

function ms_web_calc( $atts ) {
	$atts = shortcode_atts(
		array(
			'parameters' => false,
		),
		$atts,
		'web_calc'
	);

		ob_start();
	?>

	<?php
		$sources_ver = gmdate( 'ymdGis', filemtime( get_template_directory() . '/apps/web-calc/build/static/css/main.css' ) );
	?>
	<div data-widget>
		<link <?= ! is_user_logged_in() ? 'data-' : ''; ?>href="<?= esc_url( get_template_directory_uri() ); ?>/apps/web-calc/build/static/css/main.css?<?= esc_html( $sources_ver ); ?>" rel="stylesheet">
		<div id="webcalcWrapper">
			<div id="webcalcroot" dir="ltr" class="webcalc--main"></div>
		</div>
		<?php // @codingStandardsIgnoreStart ?>
		<script>
			(() => {
				const db = sessionStorage.getItem('WebCalc');
				const isloggedin = <?= is_user_logged_in() ? 'true':'false' ?>;
				sessionStorage.setItem('WebCalc', '{}');
				<?php if($atts['parameters'] !== false && !is_user_logged_in()) { ?>
					sessionStorage.setItem('WebCalc', '<?= $atts['parameters']; ?>');
				<?php } ?>
			})()
		</script>

		<script <?= ! is_user_logged_in() ? 'data-' : '' ?>src="<?= esc_url( get_template_directory_uri() ); ?>/apps/web-calc/build/static/js/main.js?<?= esc_html( $sources_ver ) ?>"></script>
	</div>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	return ob_get_clean();
}
add_shortcode( 'web_calc', 'ms_web_calc' );
