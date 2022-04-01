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

	<link href="<?= esc_url( get_template_directory_uri() ); ?>/apps/web-calc/build/static/css/main.css?<?= esc_html( $sources_ver ) ?>" rel="stylesheet">
	<?php if ( is_user_logged_in() ) { ?>
		<script>
			window.location.href='#showWebCalcGenerator';
		</script>
		<div class="h5" style="color: red; text-align: center">Please preview predefined Web Calc in Privacy mode or log out.<br />When logged in, you are enforced to use WebCalc shortcode generator. This message is visible only to logged in users</div>
	<?php } ?>
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

	<script src="<?= esc_url( get_template_directory_uri() ); ?>/apps/web-calc/build/static/js/main.js?<?= esc_html( $sources_ver ) ?>"></script>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	return ob_get_clean();
}
add_shortcode( 'web_calc', 'ms_web_calc' );
