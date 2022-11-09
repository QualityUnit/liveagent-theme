<?php


/**
	* Remove Not Used Sizes
	*/

function remove_default_img_sizes( $sizes ) {
	$targets = array( '1536x1536', '2048x2048' );

	foreach ( $sizes as $size_index => $size ) {
		if ( in_array( $size, $targets, true ) ) {
			unset( $sizes[ $size_index ] );
		}
	}

	return $sizes;
}
add_filter( 'intermediate_image_sizes', 'remove_default_img_sizes', 10, 1 );
