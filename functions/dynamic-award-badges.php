<?php

function get_awards( $number ) {
	$awards_posts = get_posts(
		array(
			'post_type'      => 'ms_awards',
			'posts_per_page' => $number,
			'fields'         => 'ids',
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);

	return $awards_posts;
}

function badges_elementor_block( $content ) {
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath    = new DOMXPath( $dom );
	$elements = get_nodes( $xpath, 'BlockBadges' );
	$elements = $xpath->query( "//*[contains(concat(' ', normalize-space(@class), ' '), ' BlockBadges ')]" );

	if ( $elements->item( 0 ) ) {
		set_custom_source( 'shortcodes/BlockBadges' );
	}

	foreach ( $elements as $element ) {
	
		$new_dom = new DomDocument();
		libxml_use_internal_errors( true );
		$new_dom->appendChild( $new_dom->importNode( $element, true ) );
		libxml_clear_errors();
		$new_xpath    = new DOMXPath( $new_dom );
		$badge_images = $element->getElementsByTagName( 'img' );

		foreach ( $badge_images as $badge ) {
			$wrapper = $dom->createElement( 'div' );
			$wrapper->setAttribute( 'class', 'award-badges' );
			foreach ( get_awards( 6 ) as $award_id ) {
				$award_img = $dom->createElement( 'div' );
				$award_img->setAttribute( 'style', 'background-image: url(' . get_the_post_thumbnail_url( $award_id, 'box_archive_thumbnail' ) . ');' );
				$wrapper->appendChild( $award_img );
			}
			$badge->parentNode->replaceChild( $wrapper, $badge ); //@codingStandardsIgnoreLine
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'badges_elementor_block', 10000 );
