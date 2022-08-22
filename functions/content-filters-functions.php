<?php

function add_class_to_node( $node, $classes ) {
	$origin_classes  = $node->getAttribute( 'class' );
	$node->setAttribute( 'class', $origin_classes . ' ' . implode( ' ', $classes ) );
}

function verify_image_link( $path ) {
	$supported = array( 'gif', 'jpg', 'jpeg', 'png', 'webp', 'avif' );
	$ext = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
	if ( in_array( $ext, $supported ) ) {
		return true;
	}
	return false;
}
