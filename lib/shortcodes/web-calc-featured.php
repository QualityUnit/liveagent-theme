<?php

function ms_web_calc_featured( $atts ) {
	$atts = shortcode_atts(
		array(
			'feature' => 'ticketing',
		),
		$atts,
		'calc_featured'
	);

		ob_start();
	?>

	<?php
		$sources_ver = gmdate( 'ymdGis', filemtime( get_template_directory() . '/apps/web-calc-featured/build/static/css/main.css' ) );
	?>

	<link href="<?= esc_url( get_template_directory_uri() ); ?>/apps/web-calc-featured/build/static/css/main.css?<?= esc_html( $sources_ver ) ?>" rel="stylesheet">
	<div id="calcfeaturedWrapper">
		<div id="calcfeatured" dir="ltr" class="calcfeatured--main"></div>
	</div>
	<?php // @codingStandardsIgnoreStart ?>
	<script>
    (() => {
			sessionStorage.setItem('WebCalcFeatured', '["<?= $atts['feature']; ?>"]');
			<?php if ( is_user_logged_in() ) { ?>
				document.querySelector('#calcfeatured').dataset.showgenerator='true';
			<?php } ?>
		})()
  </script>

	<script src="<?= esc_url( get_template_directory_uri() ); ?>/apps/web-calc-featured/build/static/js/main.js?<?= esc_html( $sources_ver ) ?>"></script>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	return ob_get_clean();
}
add_shortcode( 'calc_featured', 'ms_web_calc_featured' );
