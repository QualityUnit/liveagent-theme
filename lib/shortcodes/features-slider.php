<?php

function ms_features_slider() {
	ob_start();
	?>


	<?php

	return ob_get_clean();
}
add_shortcode( 'features-slider', 'ms_features_slider' );
