<?php //@codingStandardsIgnoreLine

/*
Adds WPML language information and IDs of post in other languages to Rest API output
*/

namespace LA\WPML;

use WP_Post;
use WP_REST_Request;

class WPML_REST_API {

	public function wordpress_hooks() {
		add_action( 'rest_api_init', array( $this, 'init' ), 1000 );
	}

	public function init() {
		// Check if WPML is installed
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		if ( ! is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
			return;
		}

		$available_languages = wpml_get_active_languages_filter( '', array( 'skip_missing' => false ) );

		if ( ! empty( $available_languages ) && ! isset( $GLOBALS['icl_language_switched'] ) || ! $GLOBALS['icl_language_switched'] ) {
			// @codingStandardsIgnoreStart
			if ( isset( $_REQUEST['wpml_lang'] ) ) {
				$lang = $_REQUEST['wpml_lang'];
			} elseif ( isset( $_REQUEST['lang'] ) ) {
				$lang = $_REQUEST['lang'];
			}
			// @codingStandardsIgnoreEnd
			if ( isset( $lang ) && in_array( $lang, array_keys( $available_languages ) ) ) {
				do_action( 'wpml_switch_language', $lang );
			}
		}

		// Add WPML fields to all post types
		// Thanks to Roy Sivan for this trick.
		// http://www.roysivan.com/wp-api-v2-adding-fields-to-all-post-types/#.VsH0e5MrLcM

		$post_types = get_post_types(
			array(
				'public'              => true,
				'exclude_from_search' => false,
			),
			'names' 
		);
		foreach ( $post_types as $post_type ) {
			$this->register_api_field( $post_type );
		}
	}

	public function register_api_field( $post_type ) {
		register_rest_field(
			$post_type,
			'wpml_current_locale',
			array(
				'get_callback'    => array( $this, 'get_current_locale' ),
				'update_callback' => null,
				'schema'          => null,
			)
		);
		register_rest_field(
			$post_type,
			'wpml_current_language_code',
			array(
				'get_callback'    => array( $this, 'get_current_language_code' ),
				'update_callback' => null,
				'schema'          => null,
			)
		);

		register_rest_field(
			$post_type,
			'wpml_translations',
			array(
				'get_callback'    => array( $this, 'get_translations' ),
				'update_callback' => null,
				'schema'          => null,
			)
		);
	}

	/**
	 * Calculate the relative path for this post, supports also nested pages
	 *
	 * @param WP_Post $this_post
	 * @return string the relative path for this page e.g. `root-page/child-page`
	 */
	public function calculate_rel_path( WP_Post $this_post ) {
		$post_name = $this_post->post_name;
		if ( $this_post->post_parent > 0 ) {
			$cur_post = get_post( $this_post->post_parent );
			if ( isset( $cur_post ) ) {
				$rel_path = $this->calculate_rel_path( $cur_post );
				return $rel_path . '/' . $post_name;
			}
		}
		return $post_name;
	}

	/**
	 * Retrieve available translations
	 *
	 * @param array $object Details of current post.
	 * @param string $field_name Name of field.
	 * @param WP_REST_Request $request Current request
	 *
	 * @return array
	 */
	public function get_translations( array $object, $field_name, WP_REST_Request $request ) {
		$languages     = apply_filters( 'wpml_active_languages', null );
		$translations  = array();
		$show_on_front = get_option( 'show_on_front' );
		$page_on_front = get_option( 'page_on_front' );

		foreach ( $languages as $language ) {
			$post_id = apply_filters( 'wpml_object_id', $object['id'], 'post', false, $language['language_code'] );
			if ( $post_id === null || $post_id == $object['id'] ) { //@codingStandardsIgnoreLine
				continue;
			}
			$this_post = get_post( $post_id );

			// Only show published posts
			if ( 'publish' !== $this_post->post_status ) {
				continue;
			}

			$href = apply_filters( 'WPML_filter_link', $language['url'], $language ); //@codingStandardsIgnoreLine
			$href = apply_filters( 'wpmlrestapi_translations_href', $href, $this_post );
			$href = trailingslashit( $href );

			if ( ! ( 'page' == $show_on_front && $object['id'] == $page_on_front ) ) {
				$post_url = $this->calculate_rel_path( $this_post );
				if ( strpos( $href, '?' ) !== false ) {
					$href = str_replace( '?', '/' . $post_url . '/?', $href );
				} else {
					if ( substr( $href, - 1 ) !== '/' ) {
						$href .= '/';
					}

					$href .= $post_url . '/';
				}

				$translation = array(
					'locale'        => $language['default_locale'],
					'language_code' => $language['language_code'],
					'id'            => $this_post->ID,
					'post_title'    => $this_post->post_title,
					'href'          => $href,
				);

				$translation    = apply_filters( 'wpmlrestapi_get_translation', $translation, $this_post, $language );
				$translations[] = $translation;
			}
		}

		return $translations;
	}

	/**
	 * Retrieve the current locale
	 *
	 * @param array $object Details of current post.
	 * @param string $field_name Name of field.
	 * @param WP_REST_Request $request Current request
	 *
	 * @return string
	 */
	public function get_current_locale( $object, $field_name, $request ) {
		$lang_info = wpml_get_language_information( $object );
		if ( ! is_wp_error( $lang_info ) ) {
			return $lang_info['locale'];
		}
	}

	public function get_current_language_code( $object, $field_name, $request ) {
		$lang_info = wpml_get_language_information( $object );
		if ( ! is_wp_error( $lang_info ) ) {
			return $lang_info['language_code'];
		}
	}
}

$GLOBALS['WPML_REST_API'] = new WPML_REST_API();
$GLOBALS['WPML_REST_API']->wordpress_hooks();
