<?php
	namespace QualityUnit\Extras;

/**
	* Add <body> classes
	*/

function body_class( $classes ) {
	// Add page slug if it doesn't exist
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
			$classes[] = basename( get_permalink() );
		}
	}

	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );

/**
 * Load an inline SVG.
 *
 * @param string $filename The filename of the SVG you want to load.
 *
 * @return string The content of the SVG you want to load.
 */
function load_inline_svg( $filename ) {

	// Add the path to your SVG directory inside your theme.
	$svg_path = '/assets/images/';

	// Check the SVG file exists
	if ( file_exists( get_template_directory() . $svg_path . $filename . '.svg' ) ) {

		// Load and return the contents of the file
		return file_get_contents( get_template_directory_uri() . $svg_path . $filename . '.svg' );
	}

	// Return a blank string if we can't find the file.
	return '';
}
