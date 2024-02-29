<?php

function ms_slidertestimonials() {
	ob_start();
	?>


	<?php

	return ob_get_clean();
}
add_shortcode( 'slidertestimonials', 'ms_slidertestimonials' );
