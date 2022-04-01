<?php

/**
  * Remove jQuery Migrate
  */

function remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];

		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );


/**
  * Remove global styles
  */

function wps_deregister_styles() {
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );


/**
  * Remove WPML codes
  */

define( 'ICL_DONT_LOAD_NAVIGATION_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );


/**
	* Add Missing Style to Gutenberg
	*/

function add_style_to_gutenberg() {
	echo '<style>@import "/wp/wp-includes/css/dist/edit-post/classic.min.css";</style>';
}
add_action( 'admin_head', 'add_style_to_gutenberg' );


/**
	* Clean Elementor
	*/

add_action(
	'wp_print_styles',
	function() {
		if ( ! is_user_logged_in() ) {
				wp_dequeue_style( 'font-awesome' );
				wp_dequeue_style( 'font-awesome-5-all' );
				wp_dequeue_style( 'font-awesome-4-shim' );
				wp_deregister_style( 'elementor-icons-shared-0' );
				wp_deregister_style( 'elementor-icons' );
				wp_deregister_style( 'elementor-icons-fa-brands' );
				wp_deregister_style( 'elementor-animations' );
				wp_deregister_style( 'wp-nux' );
				wp_deregister_style( 'wpml-legacy-horizontal-list-0' );

				// Call for Roboto font internal Elementor
				wp_dequeue_style( 'google-fonts-1' );

				// Scripts
				wp_dequeue_script( 'font-awesome-4-shim' );
				wp_deregister_script( 'elementor-sticky' );
				wp_deregister_script( 'elementor-frontend' );
				wp_deregister_script( 'wpml-xdomain-data' );
				wp_deregister_script( 'wpml-xdomain-data-js-extra' );
		}
	},
	999
);

add_action(
	'elementor/frontend/after_enqueue_styles',
	function() {
		wp_deregister_style( 'elementor-pro' );
	},
	1000
);


/**
	* Defer all JS
	*/

function defer_parsing_of_js( $url ) {
	if ( is_user_logged_in() ) {
		return $url; //don't break WP Admin
	}
	if ( false === strpos( $url, '.js' ) ) {
		return $url;
	}
	if ( strpos( $url, 'jquery.js' ) ) {
		return $url;
	}

	if ( strpos( $url, 'i18n.js' ) ) {
		return $url;
	}

	if ( strpos( $url, 'wp-polyfill.js' ) ) {
		return $url;
	}

	if ( strpos( $url, 'hooks.js' ) ) {
		return $url;
	}

	if ( strpos( $url, 'i18n.min.js' ) ) {
		return $url;
	}

	if ( strpos( $url, 'wp-polyfill.min.js' ) ) {
		return $url;
	}

	if ( strpos( $url, 'hooks.min.js' ) ) {
		return $url;
	}

	return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );
