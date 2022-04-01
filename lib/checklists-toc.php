<?php
// Generates Table of content from Checklists on checklist page (www.liveagent.com/checklists)

function checklists_toc() {
	$content = apply_filters( 'the_content', strip_shortcodes( get_the_content() ) );

	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath     = new DOMXPath( $dom );
	$classname = 'qu-ChecklistItem__header--text';
	$nodes     = get_nodes( $xpath, $classname );

	if ( count( $nodes ) > 2 ) {
		foreach ( $nodes as $node ) {
			$title = $node->nodeValue; //@codingStandardsIgnoreLine
			$id    = $node->getAttribute( 'id' );
			if ( strlen( $id ) > 2 ) {
				$toc[] = '<li class="Checklists__toc__item"><a href="#' . $id . '">' . $title . '</a></li>'; // @codingStandardsIgnoreLine
			}
		}
		if ( isset( $toc ) ) {
			$count_items = count( $toc );
			$toc         = implode( '', $toc );

			$output = (object) array(
				'toc'   => $toc,
				'count' => $count_items,
			);
			return $output;
		}
		return false;
	} else {
		return false;
	}
}
