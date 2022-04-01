<?php


//Add ID to every H2 element in post/page that has no ID. Generated from sanitized text content of element
function add_id_to_h2( $html ) {
	$html = preg_replace_callback(
		'/\<h2( id=".+?")?\>(.+?)\<\/h2\>/',
		function ( $m ) {
			return '<h2 id="h-' . preg_replace( '/[%\/\:]/i', '', sanitize_title( $m[2] ) ) . '">' . $m[2] . '</h2>';
		},
		$html
	);

	$html = preg_replace_callback(
		'/\<h2(((?!id).).+?)\>(.+?)\<\/h2\>/',
		function ( $m ) {
			return '<h2 ' . $m[1] . ' id="h-' . preg_replace( '/[%\/]/i', '', sanitize_title( $m[3] ) ) . '">' . $m[3] . '</h2>';
		},
		$html
	);

	$html = preg_replace_callback(
		'/\<h3( id=".+?")?\>(.+)\<\/h3\>/',
		function ( $m ) {
			return '<h3 id="h-' . preg_replace( '/[%\/\:]/i', '', sanitize_title( $m[2] ) ) . '">' . $m[2] . '</h3>';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'add_id_to_h2', 99 );

// Generates Table of content from H2 titles in sidebar for Blog posts
function sidebar_toc() {
	$content = apply_filters( 'the_content', strip_shortcodes( get_the_content() ) );

	$content = wp_kses(
		$content,
		array(
			'h2' => array( 'id' => array() ),
			'h3' => array( 'id' => array() ),
		)
	);

	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath = new DOMXPath( $dom );
	$tags  = $xpath->query( '*/h2 | */h3' );

	if ( count( $tags ) > 2 ) {
		foreach ( $tags as $node ) {
			$tag   = $node->tagName; //@codingStandardsIgnoreLine
			$title = $node->nodeValue; //@codingStandardsIgnoreLine
			$id    = $node->getAttribute( 'id' );
			if ( strlen( $id ) > 2 ) {
				$toc[] = '<li class="SidebarTOC__item SidebarTOC__item--' . $tag . '"><a href="#' . $id . '">' . $title . '</a></li>'; // @codingStandardsIgnoreLine
			}
		}
		if ( isset( $toc ) ) {
			$toc = implode( '', $toc );
			return $toc;
		}
		return false;
	} else {
		return false;
	}
}
