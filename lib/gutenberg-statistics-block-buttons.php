<?php
// Gutenberg Statistics block - Adds twitter and copy buttons to top right corners
function statistics_buttons( $content ) {
	if ( ! $content ) {
		return $content;
	}

	if ( isset( $_SERVER['HTTPS'] ) &&
			( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 ) || //@codingStandardsIgnoreLine
			isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) &&
			$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) { //@codingStandardsIgnoreLine
		$protocol = 'https://';
	} else {
		$protocol = 'http://';
	}

		$dom = new DOMDocument();
		libxml_use_internal_errors( true );
		$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
		libxml_clear_errors();
		$xpath       = new DOMXPath( $dom );
		$block_class = 'Statistics--block';
		$blocks      = get_nodes( $xpath, $block_class );
		$children    = array();
		
	foreach ( $blocks as $block ) {
		$children    = $block->childNodes; //@codingStandardsIgnoreLine
		$btn_wrapper = $dom->createElement( 'div' );
		$btn_wrapper->setAttribute( 'class', 'Research--block__buttons' );
		$twitter = $dom->createElement( 'a', 'Twitter' );
		$twitter->setAttribute( 'class', 'Research--block__button__twitter' );
		$twitter->setAttribute( 'target', '_blank' );
		$copy = $dom->createElement( 'a', 'Copy' );
		$copy->setAttribute( 'class', 'Research--block__button__copy' );
		$copy->setAttribute( 'href', '#' );
		$text = '';
		
		foreach ( $children as $child ) {
			
			$text    .= str_replace( '%', '%25', $child->textContent ); //@codingStandardsIgnoreLine
			$text    = preg_replace( '/^\^(.+?)/', '$1', preg_replace( '/\^+/', '^', str_replace( array( "\t", "\n" ), '^', $text ) ) );
			$newtext = explode( '^', $text );
			$referer = urlencode($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); //@codingStandardsIgnoreLine;
			if ( isset( $newtext[0] ) && isset( $newtext[1] ) ) {
				$url = 'https://twitter.com/intent/tweet?text=' . $newtext[0] . '%20' . $newtext[1] . ( isset( $newtext[2] ) ? '%20' . $newtext[2] : '' ) . '&url=' . $protocol . $referer;
				$twitter->setAttribute( 'href', $url );
				$copy->setAttribute( 'data-text', str_replace( '%25', '%', ( $newtext[0] . ' ' . $newtext[1] . ( isset( $newtext[2] ) ? ' ' . $newtext[2] : '' ) ) . ' - ' . $protocol . urldecode( $referer ) ) );
			}
		}
		
		$btn_wrapper->appendChild( $twitter );
		$btn_wrapper->appendChild( $copy );
		$block->appendChild( $btn_wrapper );
	}
		$dom->removeChild( $dom->doctype );
		$content = $dom->saveHtml();
		$content = str_replace( '<html><body>', '', $content );
		$content = str_replace( '</body></html>', '', $content );
		return $content;
}

add_action( 'the_content', 'statistics_buttons', PHP_INT_MAX );
