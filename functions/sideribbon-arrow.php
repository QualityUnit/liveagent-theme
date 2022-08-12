<?php

function sideribbon_arrow( $content ) {
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath       = new DOMXPath( $dom );
	$sideribbons = get_nodes( $xpath, 'SideRibbon' );
	$svg_file    = file_get_contents( get_template_directory() . '/assets/images/sideribbon_arrow.svg' );

	// @codingStandardsIgnoreStart
	foreach ( $sideribbons as $sideribbon ) {
		$svg = $dom->createDocumentFragment();
		$svg->appendXML( $svg_file );
		$sideribbon->appendChild( $svg );
	}
	// @codingStandardsIgnoreEnd

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}

add_filter( 'the_content', 'sideribbon_arrow', 9999 );
