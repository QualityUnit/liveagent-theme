<?php

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

	if ( $blocks[0] ) {
		set_custom_source( 'pages/post', 'css' );
		set_custom_source( 'common/splide', 'css' );
		set_custom_source( 'components/SmallPhotoSlider', 'css' );
		set_custom_source( 'splide', 'js' );
		set_custom_source( 'custom_lightbox', 'js' );
		set_custom_source( 'slider', 'js' );
		set_custom_source( 'sidebar_toc', 'js' );
	}

	foreach ( $blocks as $block ) {
		foreach ( $block->getElementsByTagName( 'pre' ) as $pre ) {
			
			$header      = $pre->childNodes->item( 0 )->textContent; // @codingStandardsIgnoreLine
			$regex       = '/(.+)(–|—|-|-)(.+)(\n|\r)*(.*)/';
			$strong_text = preg_replace( $regex, '$1', $header );
			$value_text  = preg_replace( $regex, '$3', $header );
			$main_text   = $pre->textContent; // @codingStandardsIgnoreLine
			$main_text   = preg_replace( $regex, '$5', $main_text );
			if ( isset( $pre->childNodes->item( 3 )->textContent ) ) { // @codingStandardsIgnoreLine
				$main_text = $pre->childNodes->item( 3 )->textContent; // @codingStandardsIgnoreLine
			}
			$pre->textContent = ''; // @codingStandardsIgnoreLine
			$strong           = $dom->createElement( 'strong' );
			$flex             = $dom->createElement( 'div' );
			$flex->setAttribute( 'class', 'flex' );
			$strong->textContent = $strong_text; // @codingStandardsIgnoreLine
			$flex->appendChild( $strong );
			$flex->appendChild( $dom->createTextNode( $value_text ) );
			$pre->appendChild( $flex );
			$pre->appendChild( $dom->createTextNode( $main_text ) );
		}   
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

function learnmore_sidebars( $content ) {

	if ( ! $content ) {
		return $content;
	}

	$cl_block          = 'Block--learnMore';
	$cl_block_header   = 'Block--learnMore__header';
	$cl_content        = 'Content';
	$cl_target         = 'elementor-widget-wrap';
	$cl_post_container = 'wrapper__wide Post__container';
	$cl_post_content   = 'BlogPost__content Post__content';
	$cl_post_sidebar   = 'Post__sidebar';
	$cl_post_signup    = 'Signup__sidebar-wrapper';

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath  = new DOMXPath( $dom );
	$blocks = get_nodes( $xpath, $cl_block );

	if ( count( $blocks ) > 0 ) {

		$block_index = 0;
		foreach ( $blocks as $block ) {

			//process only first block
			if ( 0 == $block_index ) {

				//remove 'Content' class from section
				$block_classes = $block->getAttribute( 'class' );
				$block_classes = str_replace( ' ' . $cl_content, '', $block_classes );
				$block->setAttribute( 'class', $block_classes );

				$div_index = 0;
				foreach ( $block->getElementsByTagName( 'div' ) as $div ) {
					if ( str_contains( $div->getAttribute( 'class' ), $cl_target ) ) {
						if ( 0 == $div_index ) {

							//isolate block-header
							$is_block_header = false;
							foreach ( $div->childNodes as $el_block_header ) { // @codingStandardsIgnoreLine
								if ( $el_block_header instanceof DOMElement ) {
									$block_header_classes = $el_block_header->getAttribute( 'class' );
									if ( preg_match( '/.' . $cl_block_header . './i', $block_header_classes ) ) {
										$new_block_header = $el_block_header->cloneNode( true );
										$el_block_header->parentNode->removeChild( $el_block_header ); // @codingStandardsIgnoreLine
										$is_block_header = true;
										break;
									}
								}
							}

							//create wrappers structure
							$div->setAttribute( 'class', $cl_content . ' ' . $cl_post_content );

							$wrap = $dom->createElement( 'div' );
							$wrap->setAttribute( 'class', $cl_target );

							$el_post_wrapper = $dom->createElement( 'div' );
							$el_post_wrapper->setAttribute( 'class', $cl_post_container );

							$el_content_wraper = $dom->createElement( 'div' );
							$el_content_wraper->setAttribute( 'class', $cl_post_content );

							$el_post__sidebar = $dom->createElement( 'div' );
							$el_post__sidebar->setAttribute( 'class', $cl_post_sidebar );

							$el_post_signup = $dom->createElement( 'div' );
							$el_post_signup->setAttribute( 'class', $cl_post_signup );

							//right sidebar
							$sidebar_right = new DOMDocument();
							$sidebar_right->loadHTML( mb_convert_encoding( do_shortcode( '[signup-sidebar]' ), 'HTML-ENTITIES', 'UTF-8' ) );

							//left sidebar
							$new = new DomDocument();
							libxml_use_internal_errors( true );
							$new->appendChild( $new->importNode( $div, true ) );
							libxml_clear_errors();
							$xpath = new DOMXPath( $new );
							$tags  = $xpath->query( './/h2 | .//h3' );

							if ( count( $tags ) > 2 ) {
								foreach ( $tags as $node ) {
									$tag   = $node->tagName; // @codingStandardsIgnoreLine
									$title = $node->nodeValue; // @codingStandardsIgnoreLine
									$id    = $node->getAttribute( 'id' );
									if ( strlen( $id ) > 2 ) {
										$toc[] = '<li class="SidebarTOC__item SidebarTOC__item--' . $tag . '"><a href="#' . $id . '">' . $title . '</a></li>'; 
									}
								}
								if ( isset( $toc ) ) {
									$sidebar_left = new DOMDocument();
									$sidebar_left->loadHTML(
										mb_convert_encoding(
											'
                                        <div class="SidebarTOC-wrapper">
                                            <div class="SidebarTOC">
                                                <div class="SidebarTOC__slider slider splide">
                                                    <div class="splide__track">
                                                        <ul class="SidebarTOC__content splide__list">' .
															implode( '', $toc ) . '
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>', 
											'HTML-ENTITIES',
											'UTF-8' 
										) 
									);
								}
							}

							//fill wrappers
							$div->parentNode->insertBefore( $wrap, $div->parentNode->firstChild ); // @codingStandardsIgnoreLine
							$wrap->appendChild( $el_post_wrapper );
							$el_post_wrapper->appendChild( $el_post__sidebar );
							$el_post_wrapper->appendChild( $el_post_signup );
							$el_post_wrapper->appendChild( $el_content_wraper );
							$el_post_wrapper->replaceChild( $div, $el_content_wraper );

							if ( $is_block_header ) {
								$wrap->insertBefore( $new_block_header, $wrap->firstChild ); // @codingStandardsIgnoreLine
							}

							if ( isset( $sidebar_right ) ) {
								$el_post_signup->appendChild( $dom->importNode( $sidebar_right->documentElement, true ) ); // @codingStandardsIgnoreLine
							}

							if ( isset( $sidebar_left ) ) {
								$el_post__sidebar->appendChild( $dom->importNode( $sidebar_left->documentElement, true ) ); // @codingStandardsIgnoreLine
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
	return $content;

	
}
add_filter( 'the_content', 'learnmore_sidebars', 9999 );

/*
*  gallery sider in Block--learnMore
*/

function learnmore_gallery( $content ) {
	
	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath    = new DOMXPath( $dom );
	$sections = get_nodes( $xpath, 'Block--learnMore' );
	foreach ( $sections as $section ) {
		//get list of galleries
		$new_dom = new DomDocument();
		libxml_use_internal_errors( true );
		$new_dom->appendChild( $new_dom->importNode( $section, true ) );
		libxml_clear_errors();
		$new_xpath = new DOMXPath( $new_dom );
		$galleries = $new_xpath->query( ".//*[contains(@class, 'galleryid-')]" );
		foreach ( $galleries as $gallery ) {
			$gallery_id  = $gallery->getAttribute( 'id' );
			$html_arrows = '
            <div class="splide__arrows nice__arrows">
                <button class="splide__arrow splide__arrow--prev">
                <svg viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg"><path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" /> </svg>
                </button>
                <button class="splide__arrow splide__arrow--next">
                <svg viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg"> <path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" /> </svg>
                </button>
            </div>';

			//get list of gallerry items
			$gallery_item = array();
			foreach ( $gallery->childNodes as $item ) { // @codingStandardsIgnoreLine
				$gallery_item[] = '
                    <div class="splide__slide">
                        <div class="slide__inn">' . 
						$new_dom->saveHtml( $item ) . '
                        </div>
                    </div>';
			}

			//build new gallery markup
			if ( isset( $gallery_item ) ) {
				$new_gallery = new DOMDocument();
				$new_gallery->loadHTML(
					mb_convert_encoding(
						'
                    <div class="SmallPhoto__slider slider splide" data-splide=\'{"perPage":2}\'>' . 
						$html_arrows . '
                        <div class="splide__track">
                            <div class="splide__list">' . 
							implode( '', $gallery_item ) . '
                            </div>
                        </div>
                    </div>',
						'HTML-ENTITIES',
						'UTF-8' 
					) 
				);
			}

			//find gallery node and replace it
			$gallery_node = $xpath->query( ".//*[contains(@class, 'galleryid-') and contains(@id, '$gallery_id')]" );
			$gallery_node = $gallery_node->item( 0 );
			$gallery_node->parentNode->replaceChild( $dom->importNode( $new_gallery->documentElement, true ), $gallery_node ); // @codingStandardsIgnoreLine
		}
	}
	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'learnmore_gallery', 9999 );

/*
*  lightbox images in Block--learnMore
*/

function learnmore_image( $content ) {
	if ( ! $content ) {
		return $content;
	}
	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath          = new DOMXPath( $dom );
	$sections       = get_nodes( $xpath, 'Block--learnMore' );
	$overlay_markup = '<span class="SmallPhoto__slider__zoomin"><svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg"> <path d="M15.0086 13.2075H14.06L13.7238 12.8834C14.9005 11.5146 15.6089 9.73756 15.6089 7.80446C15.6089 3.494 12.1149 0 7.80446 0C3.494 0 0 3.494 0 7.80446C0 12.1149 3.494 15.6089 7.80446 15.6089C9.73756 15.6089 11.5146 14.9005 12.8834 13.7238L13.2075 14.06V15.0086L19.211 21L21 19.211L15.0086 13.2075V13.2075ZM7.80446 13.2075C4.81475 13.2075 2.40137 10.7942 2.40137 7.80446C2.40137 4.81475 4.81475 2.40137 7.80446 2.40137C10.7942 2.40137 13.2075 4.81475 13.2075 7.80446C13.2075 10.7942 10.7942 13.2075 7.80446 13.2075Z"></path></svg>Zoom in</span>';


	foreach ( $sections as $section ) {
		foreach ( $section->getElementsByTagName( 'img' ) as $img ) {
			if ( $img->parentNode->nodeName == 'a' ) { // @codingStandardsIgnoreLine
				$link      = $img->parentNode; // @codingStandardsIgnoreLine
				$link_href = $link->getAttribute( 'href' );
				if ( $link_href && verify_image_link( $link_href ) ) {
					$img_overlay = new DOMDocument();
					$img_overlay->loadHTML( $overlay_markup );
					add_class_to_node( $link, array( 'SmallPhoto__slider__photo' ) );
					$link->setAttribute( 'data-elementor-open-lightbox', 'no' );
					$link->insertBefore( $dom->importNode( $img_overlay->documentElement, true ), $link->firstChild ); // @codingStandardsIgnoreLine

					//image caption or gallery image caption
                    // @codingStandardsIgnoreStart
					$caption = $link->nextSibling; 
					if ( ! $caption || $caption->nodeName != 'figcaption' ) {
						//gallery image caption
						foreach ( $link->parentNode->parentNode->childNodes as $child ) {
							if ( $child->nodeName == 'figcaption' ) { 
								$caption = $child;
							}
						}
					}
                    // @codingStandardsIgnoreEnd

					//captions
					if ( $caption && $caption->nodeName == 'figcaption' ) { // @codingStandardsIgnoreLine
						add_class_to_node( $caption, array( 'SmallPhoto__slider__desc' ) );
						$caption_new = $dom->createElement( 'figcaption' );
						$link->appendChild( $caption_new );
						$caption_new->parentNode->replaceChild( $caption, $caption_new ); // @codingStandardsIgnoreLine
					} else {
						add_class_to_node( $link, array( 'notitle' ) );
					}
				}
			}
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
	
}
add_filter( 'the_content', 'learnmore_image', 9999 );
