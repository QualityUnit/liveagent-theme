<?php
// Generates Table of content from H2 titles in compact header
function compact_header_toc( $custom_content = null, $items = null ) {
	$toc_before = '<div class="compact-header__toc js-toc"><div class="FilterMenu"><div class="FilterMenu__title js-toc__title"></div><div class="FilterMenu__items js-toc__items"><div class="FilterMenu__items--inn">';
	$toc_after = '</div></div></div></div>';
	if ( isset( $items ) ) {
		foreach ( $items as $item ) {
			if ( isset( $item['id'] ) && isset( $item['title'] ) ) {
				$toc[] = '<a href="#' . $item['id'] . '" class="FilterMenu__item js-toc__item"><span class="FilterMenu__item-title js-toc__item-title">' . $item['title'] . '</span></a>'; // @codingStandardsIgnoreLine
			}
		}
		if ( isset( $toc ) ) {
			$toc = implode( '', $toc );
			return $toc_before . $toc . $toc_after;
		}
		return false;
	} else {
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
					$toc[] = '<a href="#' . $id . '" class="FilterMenu__item js-toc__item FilterMenu__item--' . $tag . '"><span class="FilterMenu__item-title js-toc__item-title">' . $title . '</span></a>'; // @codingStandardsIgnoreLine
				}
			}
			if ( isset( $toc ) ) {
				$toc = implode( '', $toc );
				return $toc_before . $toc . $toc_after;
			}
			return false;
		} else {
			return false;
		}
	}
}
