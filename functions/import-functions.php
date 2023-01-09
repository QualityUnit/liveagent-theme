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

function is_subcategory() {
	$cat = get_query_var( 'cat' );
	$category = get_category( $cat );
	$category->parent;
	return ( $category->parent == '0' ) ? false : true;
}

// Breadcrumb (BreadcrumbList) structured data
function site_breadcrumb( $output ) {
	$breadcrumb = array();
	$home = array( __( 'Home' ), home_url( '/', 'relative' ) );
	
	if ( is_single() ) {
		$post_type = get_post_type_object( get_post_type() );
		if ( $post_type ) {
			$post_type_name = $post_type->labels->name;
			if ( 'Posts' == $post_type_name ) {
				$categories = get_the_category();
				$cat = $categories[0];
				if ( $cat ) {
					$breadcrumb[] = array( $cat->name, get_category_link( $cat->term_id ) );
				}
			} else {
				$post_type_url = get_post_type_archive_link( $post_type->name );
				$breadcrumb[] = array( $post_type_name, $post_type_url );
			}
		}
		$breadcrumb[] = array( get_the_title() );
	} elseif ( is_category() ) {
		$cat = get_the_category()[0];
		if ( is_subcategory() ) {
			if ( $cat ) {
				$breadcrumb[] = array( $cat->name, get_category_link( $cat->term_id ) );
			}
		} else {
			$breadcrumb[] = $home;
		}
		$breadcrumb[] = array( single_cat_title( '', false ) );
	} elseif ( is_archive() && ! is_category() ) {
		$breadcrumb[] = $home;
		$post_type = get_queried_object();
		if ( $post_type ) {
			$breadcrumb[] = array( $post_type->labels->name );
		}
	} elseif ( get_post_type() === '' ) {
		$breadcrumb[] = $home;
	} elseif ( is_front_page() ) {
		$breadcrumb[] = $home;
	} elseif ( is_page() ) {
		$breadcrumb[] = $home;
		$breadcrumb[] = array( get_the_title() );
	} elseif ( is_search() ) {
		$breadcrumb[] = $home;
		$breadcrumb[] = array( get_search_query() );
	}
	
	if ( 'schema' == $output ) {
		$output = '';
		$i = 1;
		foreach ( $breadcrumb as $item ) {
			$output .= '{';
			$output .= '"@type": "ListItem",';
			$output .= "\"position\": $i,";
			$output .= "\"name\": $item[0],";
			if ( count( $item ) == 2 ) {
				$output .= "\"item\": $item[1],";
			}
			$output .= '},';
			$i++;
		}
		$output = substr_replace( $output, '', -2 );
		$output = '<script type="application/ld+json"> { "@context": "https://schema.org", "@type": "BreadcrumbList", "itemListElement": [' . $output . '] } </script>';
		echo wp_kses( $output, array( 'script' => array( 'type' => array() ) ) );
	} else {
		$output .= '<div class="breadcrumbs">';
		$output .= '<ul>';
		foreach ( $breadcrumb as $item ) {
			$item_output = $item[0];
			if ( count( $item ) == 2 ) {
				$item_output = '<a href="' . $item[1] . '">' . $item_output . '</a>';
			}
			$output .= '<li>' . $item_output . '</li>';
		}
		$output .= '</ul>';
		$output .= '</div>';
		echo wp_kses( $output, 'post' );
	}
}
