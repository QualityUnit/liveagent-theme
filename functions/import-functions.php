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
	$body_class     = preg_match( '/.+' . $page . '.+/', implode( get_body_class() ) );

	if ( $body_class ) {
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


// Breadcrumb (BreadcrumbList) structured data
function site_breadcrumb() {
	$breadcrumb = array();
	$home_url = home_url( '/', 'relative' );
	$home_title = __( 'Home' );
	$home = array( $home_title, $home_url );
	
	if ( is_category() || is_single() ) {
		$breadcrumb[] = array(get_the_title());
		//print_r(get_the_terms());
		if ( is_single() ) {
			
			$taxonomy_objects = get_object_taxonomies( get_post_type(), 'objects' );
			$out = array();
			foreach ( $taxonomy_objects as $taxonomy_slug => $taxonomy ) {
				$terms = get_terms( $taxonomy_slug, 'hide_empty=0' );
				if ( ! empty( $terms ) ) {
					$out[] = '<strong>' . $taxonomy->label . "</strong>\n<ul>";
					foreach ( $terms as $term ) {
						$out[] =
							'  <li>'
							. $term->name
							. "  </li>\n";
					}
					$out[] = "</ul>\n";
				}
			}
			echo implode( '', $out );
   
   
			$breadcrumb[] = array(get_the_title());
		}
	} elseif ( get_post_type() === '' ) {
		array_push( $breadcrumb, $home );
	} elseif ( is_front_page() ) {
		array_push( $breadcrumb, $home );
	} elseif ( is_page() ) {
		array_push( $breadcrumb, $home );
		array_push( $breadcrumb, array( get_the_title() ) );
	} elseif ( is_search() ) {
		array_push( $breadcrumb, $home );
		array_push( $breadcrumb, array( get_search_query() ) );
	}
	print_r( $breadcrumb );
	
	
	/*function site_breadcrumb() {
	$breadcrumb = array();
	$home_url = home_url( '/', 'relative' );
	$home_title = __( 'Home' );
	$home = array( $home_title, $home_url );
	
	if ( is_category() || is_single() ) {
		if ( !is_single() ) {
			array_push( $breadcrumb, $home );
		}
		$breadcrumb[] = array(__( 'Blog', 'ms' ), __( '/blog/', 'ms' ));
		if ( is_single() ) {
			$breadcrumb[] = array(get_the_title());
		}
	} elseif ( get_post_type() === '' ) {
	
	} elseif ( is_front_page() ) {
		array_push( $breadcrumb, $home );
	} elseif ( is_page() ) {
		array_push( $breadcrumb, $home );
		array_push( $breadcrumb, array( get_the_title() ) );
	} elseif ( is_search() ) {
		array_push( $breadcrumb, $home );
		array_push( $breadcrumb, array( get_search_query() ) );
	}
	print_r( $breadcrumb );
}*/

}
