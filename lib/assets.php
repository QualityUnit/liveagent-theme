<?php

/**
  * Styles
  */

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'la-font-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap', false, '1' );
		wp_enqueue_style( 'la-font-opensans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap', false, '1' );
		wp_enqueue_style( 'elementor-cherrypick', get_template_directory_uri() . '/assets/dist/vendor/elementor-cherrypick' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/dist/app' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		wp_enqueue_style( 'wp_block-library', includes_url() . 'css/dist/block-library/style' . isrtl() . wpenv() . '.css', false, THEME_VERSION );

		wp_deregister_script( 'wp-embed' );
	},
	100
);


/**
 * Scripts
 */

add_action(
	'wp_footer',
	function () {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'app_js', get_template_directory_uri() . '/assets/dist/app' . wpenv() . '.js', array( 'wp-i18n' ), THEME_VERSION, true );
	}
);
