<?php

function ms_breadcrumb() {
	ob_start();

	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="Breadcrumb__items">', '</div>' );
	}

	return ob_get_clean();
}
add_shortcode( 'breadcrumb', 'ms_breadcrumb' );
