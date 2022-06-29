<?php


//Retrieves back old Widgets editor in WP 5.8 and newer

function enable_old_widget_editor() {
	remove_theme_support( 'widgets-block-editor' );
}

add_action( 'after_setup_theme', 'enable_old_widget_editor' );


/**
	* Show description in navigation
	*/

function show_description_header_nav( $item_output, $item, $depth, $args ) {
	if ( ! empty( $item->description ) ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'show_description_header_nav', 10, 4 );


/**
	* Lightbox Rel
	*/

function add_lightbox_rel( $content ) {
	$pattern     = "/<a(.*?)href=('|\")(.*?).(gif|jpeg|jpg|png|webp)('|\")(.*?)>/i";
	$replacement = '<a$1href=$2$3.$4$5 data-lightbox="gallery"$6>';
	$content     = preg_replace( $pattern, $replacement, $content );
	return $content;
}
add_filter( 'the_content', 'add_lightbox_rel' );


/**
 * IconTabs block CSS and JS importer
 */

function icontabs_sources( $content ) {
	$icontabs_block = preg_match( '/\<section.+class=".+IconTabs.+/', $content );

	if ( $icontabs_block || is_user_logged_in() ) {
		wp_enqueue_style( 'icontabs', get_template_directory_uri() . '/assets/dist/components/IconTabs' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		wp_enqueue_script( 'icontabs', get_template_directory_uri() . '/assets/dist/IconTabs' . wpenv() . '.js', false, THEME_VERSION, true );
	}
		return $content;
}

add_filter( 'the_content', 'icontabs_sources' );
add_action( 'admin_enqueue_scripts', 'icontabs_sources' );

/**
	* Add alt tag for every image
	*/

function add_img_alt_tag_title( $attr, $attachment = null ) {
	$img_title = str_replace( '^', '', str_replace( '-', ' ', trim( wp_strip_all_tags( $attachment->post_title ) ) ) );

	if ( empty( $attr['alt'] ) ) {
		$attr['alt'] = $img_title;
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'add_img_alt_tag_title', 10, 2 );

function add_alt_tag_to_images( $html ) {
	$replace = str_replace( '^', '', get_the_title() );

	$html = preg_replace( '/alt=""\s/', 'alt="' . $replace . '"', $html );

	return $html;
}
add_filter( 'the_content', 'add_alt_tag_to_images', 30 );
add_filter( 'render_block', 'add_alt_tag_to_images', 30 );

/**
	* Add X-DEFAULT Header
	*/

function wps_head_hreflang_xdefault( $url, $lang_code ) {
	if ( apply_filters( 'wpml_default_language', null ) === $lang_code ) {
		echo '<link rel="alternate" href="' . esc_url( $url ) . '" hreflang="x-default" />';
	}

	return $url;
}
add_filter( 'wpml_alternate_hreflang', 'wps_head_hreflang_xdefault', 10, 2 );


/**
	* Fix CORS for Elementor
	*/

	remove_action( 'login_init', 'send_frame_options_header' );
	remove_action( 'admin_init', 'send_frame_options_header' );


/**
	* Admin CSS
	*/

function custom_admin_css() {
	?>
	<style>
		.settings_page_wprocket .update-nag,
		.settings_page_wprocket .notice {
			display: block;
		}
	</style>
	<?php
}
add_action( 'admin_head', 'custom_admin_css' );


/**
	* Remove Trash Characters in JSONs
	*/

function clean_json( $string ) {
	$string = str_replace( "\n", '', $string );
	$string = str_replace( "\r", '', $string );
	$string = str_replace( "'", '’', $string );
	$string = str_replace( '"', '’', $string );

	return $string;
}

/**
 * Fixes WPML stripping HTML tags from translations
 */
function km_add_unfiltered_html_capability_to_editors( $caps, $cap, $user_id ) {
	if ( 'unfiltered_html' === $cap && ( user_can( $user_id, 'editor' ) || user_can( $user_id, 'administrator' ) ) ) {
		$caps = array( 'unfiltered_html' );
	}
	return $caps;
}
add_filter( 'map_meta_cap', 'km_add_unfiltered_html_capability_to_editors', 1, 3 );

/**
	* Drop cap first letter of each post
	*/

function add_drop_caps( $content ) {
	global $post;

	if ( ! empty( $post ) && 'post' === $post->post_type ) {
		$match = get_matches( '/\<p\>[A-Z]/i', $content, true );

		if ( ! empty( $match ) ) {
			$letter  = str_replace( '<p>', '', $match );
			$dropcap = '<p><span class="dropcap">' . $letter . '</span>';
			$content = str_replace_once( $match, $dropcap, $content );
		}
	}

	return $content;
}
add_filter( 'the_content', 'add_drop_caps', 30 );
add_filter( 'the_excerpt', 'add_drop_caps', 30 );

function get_matches( $p, $s, $first_value = false, $n = 0 ) {
	$ok = preg_match_all( $p, $s, $matches );

	if ( ! $ok ) {
		return false;
	} else {
		if ( $first_value ) {
			return $matches[ $n ][0];
		} else {
			return $matches[ $n ];
		}
	}
}

function str_replace_once( $search, $replace, $subject ) {
	$first_char = strpos( $subject, $search );

	if ( false !== $first_char ) {
		$before_str = substr( $subject, 0, $first_char );
		$after_str  = substr( $subject, $first_char + strlen( $search ) );

		return $before_str . $replace . $after_str;
	} else {
		return $subject;
	}
}


/**
 * Changes default WordPress gutenberg button to LA style buttn
 */

function wp_button( $html ) {
	$html = preg_replace_callback(
		'/wp-block-button__link.+?"/',
		function ( $m ) {
				return 'Button Button--full"';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'wp_button', 10 );

add_filter( 'template_include', 'portfolio_page_template', 99 );
function portfolio_page_template( $template ) {
	if ( is_page( 'portfolio' ) ) {
		$new_template = locate_template( array( 'portfolio-page-template.php' ) );
		if ( '' != $new_template ) {
			return $new_template;
		}
	}
	return $template;
}


// Fixes spaces in href attribute of URLs in content
function url_space_replace( $content ) {
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();

	foreach ( $dom->getElementsByTagName( 'a' ) as $link ) {
		$href  = $link->getAttribute( 'href' ); //@codingStandardsIgnoreLine
		$fixed = str_replace( ' ', '', $href );
		$fixed = str_replace( '%20', '', $fixed );
		$link->setAttribute( 'href', $fixed );
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'url_space_replace', 9999 );


// Function to remove ^ in title for highlight gradient
function start_wp_head_buffer() {
	ob_start();
}
add_action( 'wp_head', 'start_wp_head_buffer', 0 );

function end_wp_head_buffer() {
	$head = ob_get_clean();

	// @codingStandardsIgnoreLine
	echo preg_replace( '/(\<title.+)\^(.+)\^(.+)/', '$1$2$3', $head );
}
add_action( 'wp_head', 'end_wp_head_buffer', PHP_INT_MAX );

/*
 * Change version of SVG images
 */

function svg_version( $html ) {
	$html = preg_replace_callback(
		'/(\<img.+)(src=".+?svg)/',
		function ( $m ) {
				return $m[1] . $m[2] . '?v=2021-06-25';
		},
		$html
	);

	return $html;
}
add_filter( 'the_content', 'svg_version', 10 );

	// Get WP_ENV
function wpenv() {
	$min = '';

	if ( WP_ENV === 'production' ) {
		$min = '.min';
	}

	return $min;
}

// Check if RTL (arabic, hebrew, etc.)
function isrtl() {
	$rtl = '';

	if ( is_rtl() ) {
		// We only have .min RTL CSS, so adding .min if not in production, not adding (as we have this covered) in prd
		$rtl = '-rtl' . ( WP_ENV === 'production' ? '' : '.min' );
	}

	return $rtl;
}


//Removes Search and related direct queries

function remove_search( $query, $error = true ) {

	if ( is_search() && ! is_user_logged_in() ) {
		$query->is_search = false;

		// to error
		if ( $error == true ) // @codingStandardsIgnoreLine
			wp_safe_redirect( '/', 301 );
			exit;
	}
}

add_action( 'parse_query', 'remove_search' );

/**
	* Clean Yoast SEO Sitemap
	*/

function sitemap_exclude_taxonomy( $value, $taxonomy ) {
	$taxonomy_to_exclude = array( 'ms_awards_years', 'ms_research_categories', 'ms_about_categories' );

	if ( in_array( $taxonomy, $taxonomy_to_exclude ) ) {
		return true;
	}

	return true;
}

add_filter( 'wpseo_sitemap_exclude_taxonomy', 'sitemap_exclude_taxonomy', 10, 2 );

function exclude_posts_from_xml_sitemaps() {
	return array( 534996, 534995, 534994, 534993, 534992, 534812 );
}

add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', 'exclude_posts_from_xml_sitemaps' );


/**
	* Flush permalinks after post update
	*/

function flush_rules_on_save_posts() {
	flush_rewrite_rules(); //@codingStandardsIgnoreLine
}

add_action( 'save_post', 'flush_rules_on_save_posts', 20, 2 );


/**
 * Replace admin subdomain
 */

function replace_admin_subdomain( $content ) {
	$pattern     = '/admin.liveagent.com/i';
	$replacement = 'www.liveagent.com';
	return preg_replace( $pattern, $replacement, $content );
}
add_filter( 'the_content', 'replace_admin_subdomain' );


/*
* Change formatting in Block--learnMore <pre> blocks
*/

function learnmore_pre_block( $content ) {
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath       = new DOMXPath( $dom );
	$block_class = 'Block--learnMore';
	$blocks      = get_nodes( $xpath, $block_class );

	foreach ( $blocks as $block ) {
		foreach ( $block->getElementsByTagName( 'pre' ) as $pre ) {
			// @codingStandardsIgnoreStart
			$header      = $pre->childNodes->item( 0 )->textContent;
			$regex       = '/(.+)(–|—|-|-)(.+)(\n|\r)*(.*)/';
			$strong_text = preg_replace( $regex, '$1', $header );
			$value_text  = preg_replace( $regex, '$3', $header );
			$main_text   = $pre->textContent;
			$main_text   = preg_replace( $regex, '$5', $main_text );
			if( isset( $pre->childNodes->item( 3 )->textContent ) ) {
				$main_text = $pre->childNodes->item( 3 )->textContent;
			}
			$pre->textContent = '';
			$strong           = $dom->createElement( 'strong' );
			$flex             = $dom->createElement( 'div' );
			$flex->setAttribute( 'class', 'flex' );
			$strong->textContent = $strong_text;
			$flex->appendChild( $strong );
			$flex->appendChild( $dom->createTextNode( $value_text ) );
			$pre->appendChild( $flex );
			$pre->appendChild( $dom->createTextNode( $main_text ) );
		}
		// @codingStandardsIgnoreEnd
	}
	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'learnmore_pre_block', 9999 );

/*
* Add sidebars to Block--learnMore block
*/

function add_class_to_node( $node, $classes ) {
    $origin_classes  = $node->getAttribute( 'class' );
    $node->setAttribute( 'class', $origin_classes . ' ' . implode(' ', $classes) );
}

function learnmore_sidebars( $content ) {

	if ( ! $content ) {
		return $content;
	}

	// @codingStandardsIgnoreStart

	$cl_block = 'Block--learnMore';
	$cl_block_header = 'Block--learnMore__header';
	$cl_content = 'Content';
	$cl_target = 'elementor-widget-wrap';
	$cl_post_container = 'wrapper__wide Post__container';
	$cl_post_content = 'BlogPost__content Post__content';
	$cl_post_sidebar = 'Post__sidebar';
	$cl_post_signup = 'Signup__sidebar-wrapper';

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath       = new DOMXPath( $dom );
	$blocks      = get_nodes( $xpath, $cl_block );

	if ( count($blocks) > 0 ) {

		$block_index = 0;
		foreach ( $blocks as $block ) {

			//process only first block
			if( $block_index == 0 ) {

				//remove 'Content' class from section
				$block_classes = $block->getAttribute( 'class' );
				$block_classes = str_replace( ' ' . $cl_content, '', $block_classes);
				$block->setAttribute( 'class', $block_classes );

				$div_index = 0;
				foreach ( $block->getElementsByTagName( 'div' ) as $div ) {
					if ( $div->getAttribute( 'class' ) == $cl_target ) {
						if( $div_index == 0 ) {

							//isolate block-header
							$is_block_header = false;
							foreach ( $div->childNodes as $el_block_header ) {
								if($el_block_header instanceof DOMElement) {
									$block_header_classes = $el_block_header->getAttribute( 'class' );
									if( preg_match( '/.'.$cl_block_header.'./i', $block_header_classes ) ) {
										$new_block_header = $el_block_header->cloneNode(true);
										$el_block_header->parentNode->removeChild($el_block_header);
										$is_block_header = true;
										break;
									}
								}
							}

							//create wrappers structure
							$div->setAttribute('class', $cl_content . ' ' . $cl_post_content);

							$wrap = $dom->createElement('div');
							$wrap->setAttribute('class', $cl_target);

							$el_post_wrapper = $dom->createElement('div');
							$el_post_wrapper->setAttribute('class', $cl_post_container);

							$el_content_wraper = $dom->createElement('div');
							$el_content_wraper->setAttribute('class', $cl_post_content);

							$el_post__sidebar = $dom->createElement('div');
							$el_post__sidebar->setAttribute('class', $cl_post_sidebar);

							$el_post_signup = $dom->createElement('div');
							$el_post_signup->setAttribute('class', $cl_post_signup);

							//right sidebar
							$sidebar_right = new DOMDocument;
							$sidebar_right->loadHTML( mb_convert_encoding( do_shortcode("[signup-sidebar]"), 'HTML-ENTITIES', 'UTF-8' ) );

							//left sidebar
							$new = new DomDocument;
							libxml_use_internal_errors( true );
							$new->appendChild($new->importNode($div, true));
							libxml_clear_errors();
							$xpath = new DOMXPath( $new );
							$tags  = $xpath->query( './/h2 | .//h3' );

							if ( count( $tags ) > 2 ) {
								foreach ( $tags as $node ) {
									$tag   = $node->tagName;
									$title = $node->nodeValue;
									$id    = $node->getAttribute( 'id' );
									if ( strlen( $id ) > 2 ) {
										$toc[] = '<li class="SidebarTOC__item SidebarTOC__item--' . $tag . '"><a href="#' . $id . '">' . $title . '</a></li>'; // @codingStandardsIgnoreLine
									}
								}
								if ( isset( $toc ) ) {
									$sidebar_left = new DOMDocument;
									$sidebar_left->loadHTML( '<div class="SidebarTOC-wrapper"><div class="SidebarTOC"><div class="SidebarTOC__slider slider splide"><div class="splide__track"><ul class="SidebarTOC__content splide__list">' .
											implode( '', $toc ) .'</ul></div></div></div></div>' );
								}
							}

							//fill wrappers
							$div->parentNode->insertBefore($wrap, $div->parentNode->firstChild );
							$wrap->appendChild($el_post_wrapper);
							$el_post_wrapper->appendChild($el_post__sidebar);
							$el_post_wrapper->appendChild($el_post_signup);
							$el_post_wrapper->appendChild($el_content_wraper);
							$el_post_wrapper->replaceChild($div,$el_content_wraper);

							if ( $is_block_header ) {
								$wrap->insertBefore( $new_block_header, $wrap->firstChild );
							}

							if ( isset( $sidebar_right ) ) {
								$el_post_signup->appendChild( $dom->importNode($sidebar_right->documentElement, TRUE) );
							}

							if ( isset( $sidebar_left ) ) {
								$el_post__sidebar->appendChild( $dom->importNode($sidebar_left->documentElement, TRUE) );
							}


						}
						$div_index++;
					}
				}

			}

			break;

		}

	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return  $content;

	// @codingStandardsIgnoreEnd
}
add_filter( 'the_content', 'learnmore_sidebars', 9999 );

/*
*  gallery sider in Block--learnMore
*/

function learnmore_gallery( $content ) {
    // @codingStandardsIgnoreStart
    if ( ! $content ) {
        return $content;
    }

    $dom = new DOMDocument();
    libxml_use_internal_errors( true );
    $dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
    libxml_clear_errors();
    $xpath      = new DOMXPath( $dom );
    $sections   = get_nodes( $xpath, 'Block--learnMore' );
    foreach ( $sections as $section ) {
        //get list of galleries
        $new_dom = new DomDocument;
        libxml_use_internal_errors( true );
        $new_dom->appendChild($new_dom->importNode($section, true));
        libxml_clear_errors();
        $new_xpath = new DOMXPath( $new_dom );
        $galleries	= $new_xpath->query(".//*[contains(@class, 'galleryid-')]");
        foreach ( $galleries as $gallery ) {
            $gallery_id = $gallery->getAttribute( 'id' );
            //todo: load markup from one source
            $html_arrows = '<div class="splide__arrows nice__arrows"> <button class="splide__arrow splide__arrow--prev"> <svg viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg"> <path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" /> </svg> </button> <button class="splide__arrow splide__arrow--next"> <svg viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg"> <path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" /> </svg> </button> </div>';

            //get list of gallerry items
            $gallery_item = [];
            foreach ( $gallery->childNodes as $item){
                $gallery_item[] = '<div class="splide__slide"><div class="slide__inn">' . $new_dom->saveHtml($item) . '</div></div>';
            }

            //build new gallery markup
            if ( isset( $gallery_item ) ) {
                $new_gallery = new DOMDocument;
                $new_gallery->loadHTML( '<div class="SmallPhoto__slider slider splide">' . $html_arrows . '<div class="splide__track"><div class="splide__list">' . implode( '', $gallery_item ) . '</div></div></div>' );
            }

            //find gallery node and replace it
            $gallery_node = $xpath->query( ".//*[contains(@class, 'galleryid-') and contains(@id, '$gallery_id')]" );
            $gallery_node = $gallery_node->item( 0 );
            $gallery_node->parentNode->replaceChild( $dom->importNode ($new_gallery->documentElement, TRUE), $gallery_node );
        }
    }
    $dom->removeChild( $dom->doctype );
    $content = $dom->saveHtml();
    $content = str_replace( '<html><body>', '', $content );
    $content = str_replace( '</body></html>', '', $content );
    return $content;
    // @codingStandardsIgnoreEnd
}
add_filter( 'the_content', 'learnmore_gallery', 9999 );

/*
*  lightbox images in Block--learnMore
*/

function learnmore_image( $content ) {
    // @codingStandardsIgnoreStart
    if ( ! $content ) {
        return $content;
    }
    $dom = new DOMDocument();
    libxml_use_internal_errors( true );
    $dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
    libxml_clear_errors();
    $xpath       = new DOMXPath( $dom );
    $sections      = get_nodes( $xpath, 'Block--learnMore' );
    $overlay_markup = '<span class="SmallPhoto__slider__zoomin"><svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg"> <path d="M15.0086 13.2075H14.06L13.7238 12.8834C14.9005 11.5146 15.6089 9.73756 15.6089 7.80446C15.6089 3.494 12.1149 0 7.80446 0C3.494 0 0 3.494 0 7.80446C0 12.1149 3.494 15.6089 7.80446 15.6089C9.73756 15.6089 11.5146 14.9005 12.8834 13.7238L13.2075 14.06V15.0086L19.211 21L21 19.211L15.0086 13.2075V13.2075ZM7.80446 13.2075C4.81475 13.2075 2.40137 10.7942 2.40137 7.80446C2.40137 4.81475 4.81475 2.40137 7.80446 2.40137C10.7942 2.40137 13.2075 4.81475 13.2075 7.80446C13.2075 10.7942 10.7942 13.2075 7.80446 13.2075Z"></path></svg>Zoom in</span>';

    foreach ( $sections as $section ) {
        foreach ( $section->getElementsByTagName( 'img' ) as $img ) {
            if ( $img->parentNode->nodeName == 'a' ) {
                $img_overlay = new DOMDocument;
                $img_overlay->loadHTML($overlay_markup);
                $link = $img->parentNode;
                add_class_to_node( $link, array('SmallPhoto__slider__photo'));
                $link->setAttribute( 'data-elementor-open-lightbox', 'no' );
                $link->insertBefore($dom->importNode($img_overlay->documentElement, TRUE), $link->firstChild );

                //image caption or gallery image caption
                $caption = $link->nextSibling;
                if ( ! $caption || $caption->nodeName != 'figcaption' ) {
                    //gallery image caption
                    foreach ($link->parentNode->parentNode->childNodes as $child) {
                        if ($child->nodeName == 'figcaption') {
                            $caption = $child;
                        }
                    }
                }
                //captions
                if ( $caption && $caption->nodeName == 'figcaption' ) {
                    add_class_to_node( $caption, array('SmallPhoto__slider__desc'));
                    $caption_new = $dom->createElement('figcaption');
                    $link->appendChild($caption_new);
                    $caption_new->parentNode->replaceChild($caption,$caption_new);
                }else{
                    add_class_to_node( $link, array('notitle'));
                }
            }
        }
    }

    $dom->removeChild( $dom->doctype );
    $content = $dom->saveHtml();
    $content = str_replace( '<html><body>', '', $content );
    $content = str_replace( '</body></html>', '', $content );
    return $content;
    // @codingStandardsIgnoreEnd
}
add_filter( 'the_content', 'learnmore_image', 9999 );

/*
*  checklists (pros and cons) in Block--learnMore
*/

function elementor_pros_cons( $content ) {
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath = new DOMXPath( $dom );
	$sections = get_nodes( $xpath, 'elementor-section' );

	// @codingStandardsIgnoreStart
	foreach ( $sections as $section ) {
		//get list of pros/cons sections
		$new_dom = new DomDocument;
		libxml_use_internal_errors( true );
		$new_dom->appendChild($new_dom->importNode($section, true));
		libxml_clear_errors();
		$new_xpath = new DOMXPath( $new_dom );
		$checklists	= get_nodes( $new_xpath, 'checklist' );
		$cols = get_nodes( $new_xpath, 'elementor-col-50' );

		if ( $checklists->length == 2 && $cols->length == 2) {

			$checklists_index = 1;

			foreach ( $checklists as $checklist ) {
				$cl_checklist = $checklist->getAttribute( 'class' );
				$id_checklist = $checklist->getAttribute( 'data-id' );

				//get checklist node form $dom and add class
				$checklist_dom = $xpath->query( "//*[@data-id='$id_checklist']" );
				$checklist = $checklist_dom->item( 0 );

				if ($checklists_index == 1) {
					$checklist->setAttribute( 'class', $cl_checklist . ' checklist--pros' );
				}

				if ($checklists_index == 2) {
					$checklist->setAttribute( 'class', $cl_checklist . ' checklist--cons' );
				}
				$checklists_index++;
			}
		}
	}
	// @codingStandardsIgnoreEnd

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'elementor_pros_cons', 9999 );
