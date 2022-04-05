<?php

	// Get English Category slug of localized Post Type
function get_en_category( $post_type, $post_id ) {
	global $sitepress;
	$orig_lang = ICL_LANGUAGE_CODE;
	$sitepress->switch_lang( 'en' );
	$postid_en       = icl_object_id( $post_id, $post_type, false, 'ICL_LANGUAGE_CODE' );
	$header_category = get_the_terms( $postid_en, $post_type . '_categories' );
	if ( ! empty( $header_category ) ) {
		$header_category = array_shift( $header_category );
		$header_category = $header_category->slug;
		return $header_category;
	}
	$sitepress->switch_lang( $orig_lang );
}

// Function to get content of <head> to identify page for CSS/JS import
function wp_head_content( $page ) {
	ob_start();
	wp_head();
	$head = ob_get_contents();
	ob_end_clean();
	$head_alternate = preg_match( '/\<link rel="alternate" hreflang="en".+' . $page . '/', $head );
	$meta_url       = preg_match( '/\<meta property="og:url" content=".+' . $page . '/', $head );
	$body_class     = preg_match( '/.+' . $page . '.+/', implode( get_body_class() ) );

	if ( $head_alternate || $meta_url || $body_class ) {
		return true;
	}
}

// Calling specific JS/CSS for page or subpage, ie. features/pageXXX will be $page = features
function set_source( $page, $source_file, $filetype = 'css' ) {
	if ( wp_head_content( $page ) ) {
		if ( 'css' === $filetype ) {
			?>
			<link rel="stylesheet" type="text/css" media="all" href="<?php echo ( esc_url( get_template_directory_uri() ) . '/assets/dist/' . esc_attr( $source_file ) . esc_attr( isrtl() . wpenv() ) . '.css?ver=' . esc_attr( THEME_VERSION ) . '" />' ); ?>
			<?php
			// @codingStandardsIgnoreEnd
		}
		if ( 'js' === $filetype ) {
			wp_enqueue_script( $source_file, get_template_directory_uri() . '/assets/dist/' . $source_file . wpenv() . '.js', array(), THEME_VERSION, true );
		}
	}
}

function set_custom_source( $source_file, $filetype = 'css', $depends = false ) {
	if ( 'css' === $filetype ) {
		wp_enqueue_style( $source_file, get_template_directory_uri() . '/assets/dist/' . $source_file . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
	if ( 'js' === $filetype ) {
		wp_enqueue_script( $source_file, get_template_directory_uri() . '/assets/dist/' . $source_file . wpenv() . '.js', $depends, THEME_VERSION, true );
	}
}
