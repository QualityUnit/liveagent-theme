<?php

/**
 * Lazy load for HTML video element
 */

function video_lazyload( $html ) {
	$html = preg_replace_callback(
		'/(\<video.+)(src=".+\<\/video\>)/',
		function ( $m ) {
				return $m[1] . 'style="opacity: 0;" data-la' . $m[2];
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'video_lazyload', 10 );

/**
 * Lazy load for HTML img element
 */
function img_lazyload( $html ) {
	$html = preg_replace_callback(
		'/(\<img.+)(src((?!.+?\bset\b).+?)=".+\>)/',
		function ( $m ) {
				return $m[1] . 'style="opacity: 0; transition: opacity .5s" data-la' . $m[2];
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'img_lazyload', 100 );

function img_srcset_lazyload( $html ) {
	$html = preg_replace_callback(
		'/(\<img.+)(src=".+)(srcset=".+\>)/',
		function ( $m ) {
				return $m[1] . ' data-la' . $m[2] . 'style="opacity: 0; transition: opacity .5s" data-la' . $m[3];
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'img_srcset_lazyload', 100 );
