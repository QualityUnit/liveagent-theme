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

/**
 * Youtube iframe replacemenets with image, loading YT on click
 */

function youtube_loader( $html ) {
	$html = preg_replace_callback(
		'/\<iframe.+?title="(.+).+?src=".+?(youtube\.com|youtu\.be)(\/embed)?\/?(.+?)(\?.+?)?"(.+\>)/',
		function ( $m ) {
				return '<div class="youtube__loader" title="' . $m[1] . '" data-ytid="' . $m[4] . '"><img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[4] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt="' . $m[1] . '"></div>';
		},
		$html
	);

	return $html;
}

add_filter( 'the_content', 'youtube_loader', 10 );

function youtube_loader2( $html ) {
	$html = preg_replace_callback(
		'/\<iframe.+?src=".+?(youtube\.com|youtu\.be)(\/embed)?\/?(.+?)(\?.+?)?".+?title="(.+?)"(.+?\>)/',
		function ( $m ) {
				return '<div class="youtube__loader" title="' . $m[5] . '" data-ytid="' . $m[3] . '"><img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[3] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt="' . $m[5] . '"></div>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'youtube_loader2', 10 );

function elementor_youtube_loader( $html ) {
	$html = preg_replace_callback(
		'/\<div(.+)elementor-widget-video.+data-settings=.+(youtube\.com|youtu\.be)\\\\\/(watch\?v=)?(.+?)(&amp;|&quot;|\?)(.+?\>)((\n.+?)+)?(.+elementor-video.+?\>)/',
		function ( $m ) {
				return '<div' . $m[1] . ' elementor-widget-video">' . $m[7] . $m[9] . '<div class="youtube__loader youtube__loader--elementor" title="" data-ytid="' . $m[4] . '" data-width="" data-height=""><img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[4] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt=""></div>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'elementor_youtube_loader', 10 );
