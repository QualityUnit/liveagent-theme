<?php
// Generates Table of content from H2 titles in compact header
function compact_header_toc( $custom_content = null ) {
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
				$toc[] = '<li class="item item--' . $tag . '"><a href="#' . $id . '">' . $title . '</a></li>'; // @codingStandardsIgnoreLine
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
