<?php


////Add ID to every H2 and H3 element in post/page that has no ID. Generated from sanitized text content of element
function add_id_to_h2( $html ) {
	// Adds ID only to <h2> and <h3> headings that already have a non-empty ID
	$html = preg_replace_callback(
		'/<h(2|3)([^>]*)id="([^"]+)"([^>]*)>(.*?)<\/h\1>/',
		function ( $m ) {
			// If the heading already has a non-empty ID and contains text, return it unchanged
			return trim( $m[5] ) !== '' ? $m[0] : $m[0];
		},
		$html
	);

	// Adds ID only to <h2> headings without an ID
	$html = preg_replace_callback(
		'/<h2(?!.*\sid=").*?>(.*?)<\/h2>/',
		function ( $m ) {
			// Adds ID only if the heading contains text
			return trim( $m[1] ) !== ''
				? '<h2 id="h-' . preg_replace( '/[%\/\:]/i', '', sanitize_title( $m[1] ) ) . '">' . $m[1] . '</h2>'
				: $m[0];
		},
		$html
	);

	// Adds ID only to <h3> headings without an ID
	$html = preg_replace_callback(
		'/<h3(?!.*\sid=").*?>(.*?)<\/h3>/',
		function ( $m ) {
			// Adds ID only if the heading contains text
			return trim( $m[1] ) !== ''
				? '<h3 id="h-' . preg_replace( '/[%\/\:]/i', '', sanitize_title( $m[1] ) ) . '">' . $m[1] . '</h3>'
				: $m[0];
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'add_id_to_h2', 99 );

// Generates Table of content from H2 titles in sidebar for Blog posts
function sidebar_toc( $custom_content = null ) {
	$content = apply_filters( 'the_content', strip_shortcodes( get_the_content() ) );
	if ( isset( $custom_content ) ) {
		$content = apply_filters( 'the_content', strip_shortcodes( $custom_content ) );
	}

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
