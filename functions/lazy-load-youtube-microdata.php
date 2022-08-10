<?php

// /**
//  * Youtube iframe replacemenets with image, loading YT on click
//  */

function youtube_loader( $html ) {
	$html = preg_replace_callback(
		'/\<iframe.+?title="(.+).+?src=".+?(youtube\.com|youtu\.be)(\/embed)?\/?(.+?)(\?.+?)?"(.+\>)/',
		function ( $m ) {
				return '
				<div class="youtube__loader" title="' . $m[1] . '" data-ytid="' . $m[4] . '">
				<img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[4] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt="' . $m[1] . '">
				</div>';
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
				return '
				<div class="youtube__loader" title="' . $m[5] . '" data-ytid="' . $m[3] . '">
				<img class="youtube__loader--img" data-lasrc="https://i.ytimg.com/vi/' . $m[3] . '/hqdefault.jpg" style="opacity: 0; transition: opacity .5s" alt="' . $m[5] . '">
				</div>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'youtube_loader2', 10 );

function elementor_youtube_loader( $content ) {
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath         = new DOMXPath( $dom );
	$parent        = "//div[contains(@class, 'elementor-widget-video')]";
	$parent_blocks = $xpath->query( $parent );

	foreach ( $parent_blocks as $parent_block ) {
			$settings = $parent_block->getAttribute( 'data-settings' );
			$child    = $xpath->query( "//div[@data-settings='" . $settings . "']//div[contains(@class, 'elementor-video')]" );
			preg_match( '/(youtube|youtu)(\.com|\.be)((\\\\\/)(.+?))"/', $settings, $ytid );

			
		if ( isset( $ytid[5] ) ) {
			$ytid           = str_replace( 'watch?v=', '', $ytid[5] );
			$youtube_loader = $dom->createElement( 'div' );
			$youtube_loader->setAttribute( 'class', 'youtube__loader youtube__loader--elementor' );
			$youtube_loader->setAttribute( 'data-ytid', $ytid );
				
			$youtube_img = $dom->createElement( 'img' );
			$youtube_img->setAttribute( 'class', 'youtube__loader--img' );
			$youtube_img->setAttribute( 'data-lasrc', 'https://i.ytimg.com/vi/' . $ytid . '/hqdefault.jpg' );
			$youtube_img->setAttribute( 'style', 'opacity: 0; transition: opacity .5s' );
			$youtube_img->setAttribute( 'alt', 'Youtube video ' . $ytid );
	
			$youtube_loader->appendChild( $youtube_img );
				
			if ( $child->length ) {
				$video_wrap = $dom->createElement( 'div' );
				$video_wrap->setAttribute( 'class', 'elementor-video-new'); // @codingStandardsIgnoreLine
				$video_wrap->appendChild( $youtube_loader );
				$child->item(0)->parentNode->appendChild( $video_wrap ); // @codingStandardsIgnoreLine
				$child->item(0)->parentNode->removeChild( $child->item(0) ); // @codingStandardsIgnoreLine
				if ( isset( $schema ) ) {
					$video_wrap->appendChild( $dom->importNode( $schema->documentElement, true ) ); // @codingStandardsIgnoreLine
				}
			}
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'elementor_youtube_loader', 10 );
