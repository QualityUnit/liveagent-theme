<?php

	// Get English Category slug of localized Post Type
function get_en_category( $post_type, $post_id ) {
	global $sitepress;
	if ( is_object( $sitepress ) && defined( 'ICL_LANGUAGE_CODE' ) ) {
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
}

// Function to get content of <head> to identify page for CSS/JS import
function wp_head_content( $page ) {
	$body_class     = preg_match( '/.+' . $page . '.+/', implode( get_body_class() ) );

	if ( $body_class ) {
		return true;
	}
	return false;
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
	return ! ( ( '0' == $category->parent ) );
}

// Breadcrumb (BreadcrumbList) structured data
function site_breadcrumb( $breadcrumb = array() ) {
	if ( empty( $breadcrumb ) ) {
		$home = array( __( 'Home' ), home_url( '/', 'relative' ) );
		
		if ( is_single() ) {
			$post_type = get_post_type_object( get_post_type() );
			if ( $post_type ) {
				$post_type_name = $post_type->labels->name;
				if ( 'Posts' == $post_type_name ) {
					$categories = get_the_category();
					if ( isset( $categories[0] ) ) {
						$breadcrumb[] = array( $categories[0]->name, get_category_link( $categories[0]->term_id ) );
					}
				} else {
					$post_type_url = get_post_type_archive_link( $post_type->name );
					$breadcrumb[] = array( $post_type_name, $post_type_url );
				}
			}
			$breadcrumb[] = array( get_the_title() );
		} elseif ( is_category() ) {
			if ( is_subcategory() ) {
				$categories = get_the_category();
				if ( isset( $categories[0] ) ) {
					$breadcrumb[] = array( $categories[0]->name, get_category_link( $categories[0]->term_id ) );
				}
			} else {
				$breadcrumb[] = $home;
			}
			$breadcrumb[] = array( single_cat_title( '', false ) );
		} elseif ( is_archive() && ! is_category() ) {
			$breadcrumb[] = $home;
			$post_type = get_queried_object();
			if ( $post_type ) {
				if ( ! empty( $post_type->labels->name ) ) {
					$post_type_title = $post_type->labels->name;
				} else {
					$post_type_title = $post_type->name;
				}
				$breadcrumb[] = array( $post_type_title );
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
	}
 
	$allowed_html = array(
		'div' => array(
			'class' => array(),
		),
		'ol' => array(
			'itemscope' => array(),
			'itemtype' => array(),
		),
		'li' => array(
			'itemprop' => array(),
			'itemscope' => array(),
			'itemtype' => array(),
		),
		'a' => array(
			'itemscope' => array(),
			'itemtype' => array(),
			'itemprop' => array(),
			'itemid' => array(),
			'href' => array(),
		),
		'span' => array(
			'itemprop' => array(),
		),
		'meta' => array(
			'itemprop' => array(),
			'content' => array(),
		),
	);
	$i = 1;
	$output = '';
	$output .= '<div class="breadcrumbs">';
	$output .= '<div class="breadcrumbs-inner">';
	$output .= '<ol itemscope itemtype="https://schema.org/BreadcrumbList">';
	foreach ( $breadcrumb as $item ) {
		$item_name = str_replace( '^', '', $item[0] );
		$output .= '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		if ( count( $item ) == 2 ) {
			$item_url = $item[1];
			$output .= '<a itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="' . $item_url . '" href="' . $item_url . '">';
		}
		$output .= '<span itemprop="name">' . $item_name . '</span>';
		if ( count( $item ) == 2 ) {
			$output .= '</a>';
		}
		$output .= '<meta itemprop="position" content="' . $i . '" />';
		$output .= '</li>';
		$i++;
	}
	$output .= '</ol>';
	$output .= '</div>';
	$output .= '</div>';
	echo wp_kses( $output, $allowed_html );
}
