<?php
// TO be removed – now returns empty as we have replaced Alternatives posts with regular ones (instead of testimonials)
function ms_slidertestimonials_custom( $atts ) {
	return;
}
add_shortcode( 'slidertestimonials-custom', 'ms_slidertestimonials_custom' );
