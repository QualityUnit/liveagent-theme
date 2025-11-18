<?php
function black_friday_banner_mobile_shortcode() {
	ob_start();
	require_once get_template_directory() . '/contactus-banner.php';
	return ob_get_clean();
}
add_shortcode( 'black_friday_banner_mobile', 'black_friday_banner_mobile_shortcode' );
