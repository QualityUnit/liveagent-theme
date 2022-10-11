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
	$item_classes = $item->classes;
	if ( ! empty( $item->description ) ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );

		if ( in_array( 'fontello-menu-take-a-tour', $item_classes ) ) {
			$item_output .= '
			<div data-ytid="3zYfDwqNj0U" data-lightbox="youtube" class="Header__navigation__promo">
				<img src="' . get_template_directory_uri() . '/assets/images/tour_video.png" alt="LiveAgent Tour Video" />' . '
			</div>';
			?>
		<script>
			(
				() => {
					const tourVideo = document.querySelector('li > .Header__navigation__promo');
					if(tourVideo) {
						const parent = tourVideo.closest('li');
						parent.insertAdjacentElement('afterend', tourVideo);
					}
				}
			)();
		</script>
			<?php
		}

		foreach ( $item_classes as $class ) {
			if ( str_contains( $class, 'icn-' ) ) {
				$fragment    = preg_replace( '/^icn-(.+?)/', '$1', $class );
				$item_output = '<svg class="icon icon-' . $fragment . '"><use xlink:href="' . get_template_directory_uri() . '/assets/images/icons.svg#' . $fragment . '"></use></svg>' . $item_output;
			}
		}
	}
	?>

	<?php
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'show_description_header_nav', 10, 4 );


/**
	* Lightbox Rel
	*/

function add_lightbox_rel( $content ) {
	if ( ! $content ) {
					return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath = new DOMXPath( $dom );

	foreach ( $xpath->query( '//a' )    as  $link ) {
		$link_href = $link->getAttribute( 'href' );
		if ( $link_href && verify_image_link( $link_href ) ) {
						$link->setAttribute( 'data-lightbox', 'gallery' );
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}

add_filter( 'the_content', 'add_lightbox_rel' );

function insert_svg_icons( $content ) {

	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath  = new DOMXPath( $dom );
	$blocks = $xpath->query( ".//*[contains(@class, 'icn-')]" );

	// @codingStandardsIgnoreStart
	foreach ( $blocks as $block ) {
		$class = $block->getAttribute('class');
		preg_match( '/icn-(after-)?([^ ]+)/i', $class, $class_fragment );
		$fragment = $class_fragment[2];
		$svg = $dom->createDocumentFragment();
		$svg->appendXML( '<svg class="icon icon-' . $fragment . '"><use xlink:href="' . get_template_directory_uri() . '/assets/images/icons.svg#' . $fragment . '"></use></svg>' );
		if ( str_contains( $class, 'icn-after' ) and $block !== $svg ) {
			$block->insertBefore( $svg, $block->firstChild );
		}
		if ( ! str_contains( $class, 'icn-after' ) and $block !== $svg ) {
			$block->appendChild( $svg );
		}
	}
	// @codingStandardsIgnoreEnd

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}

add_filter( 'the_content', 'insert_svg_icons' );


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
		$match = '/\<p\>(\<a.+?\>)?([A-Z])([^<]+)(\<\/a\>)?/i';
		if ( ! empty( $match ) ) {
			$dropcap = '<p>$1<span class="dropcap">$2</span>$3$4';
			$content = preg_replace( $match, $dropcap, $content, 1 );
		}
	}

	return $content;
}
// add_filter( 'the_content', 'add_drop_caps', 30 );
// add_filter( 'the_excerpt', 'add_drop_caps', 30 );

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
	$xpath    = new DOMXPath( $dom );
	$sections = get_nodes( $xpath, 'elementor-section' );

	foreach ( $sections as $section ) {
		//get list of pros/cons sections
		$new_dom = new DomDocument();
		libxml_use_internal_errors( true );
		$new_dom->appendChild( $new_dom->importNode( $section, true ) );
		libxml_clear_errors();
		$new_xpath  = new DOMXPath( $new_dom );
		$checklists = get_nodes( $new_xpath, 'checklist' );
		$cols       = get_nodes( $new_xpath, 'elementor-col-50' );

		if ( 2 == $checklists->length && 2 == $cols->length ) {

			$checklists_index = 1;

			foreach ( $checklists as $checklist ) {
				$cl_checklist = $checklist->getAttribute( 'class' );
				$id_checklist = $checklist->getAttribute( 'data-id' );

				//get checklist node form $dom and add class
				$checklist_dom = $xpath->query( "//*[@data-id='$id_checklist']" );
				$checklist     = $checklist_dom->item( 0 );

				if ( 1 == $checklists_index ) {
					$checklist->setAttribute( 'class', $cl_checklist . ' checklist--pros' );
				}

				if ( 2 == $checklists_index ) {
					$checklist->setAttribute( 'class', $cl_checklist . ' checklist--cons' );
				}
				$checklists_index++;
			}
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}
add_filter( 'the_content', 'elementor_pros_cons', 9999 );

function change_schema_hostname( $data ) {
	$protocol = 'http:\/\/';
	$hostname = 'www.liveagent.com';
	
	if ( isset( $_SERVER['HTTPS'] ) &&
			( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 ) || //@codingStandardsIgnoreLine
			isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) &&
			$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) { //@codingStandardsIgnoreLine
		$protocol = 'https:\/\/';
	}

	if ( isset( $_SERVER['SERVER_NAME'] ) ) {
		$hostname = $_SERVER['SERVER_NAME']; //@codingStandardsIgnoreLine
	}

	$json   = wp_json_encode( $data );
	$output = preg_replace( '/http(s?):\\\\\/\\\\\/(www\.)?live.?agent\.(.+?)\//', $protocol . $hostname . '\/', $json );
	return $output;
}

add_filter( 'wpseo_schema_graph', 'change_schema_hostname', 10, 2 );
