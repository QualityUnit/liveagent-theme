<?php

function verify_image_link( $path ) {
	$supported = array( 'gif', 'jpg', 'jpeg', 'png', 'webp' );
	$ext = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
	if ( in_array( $ext, $supported ) ) {
		return true;
	}
	return false;
}
