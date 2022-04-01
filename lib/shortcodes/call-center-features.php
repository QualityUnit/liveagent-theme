<?php

function ms_call_center_features() {
	ob_start();
	?>

	<div class="WordCloud__container">
		<?php echo wp_kses_post( get_option( 'ms_theme_ms_strings_cc_features' ) ); ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'call-center-features', 'ms_call_center_features' );
