<?php

/**
 * Editor styles
 */

function editor_assets() {
	wp_enqueue_style(
		'editor-custom',
		get_template_directory_uri() . '/assets/dist/editor/editor.min.css',
		array(),
		THEME_VERSION,
		false
	);

	wp_enqueue_script(
		'editor-custom',
		get_template_directory_uri() . '/assets/dist/editor.min.js',
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
		THEME_VERSION,
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'editor_assets' );

/**
  * Styles
  */

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'la-font-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap', false, '1' );
		wp_enqueue_style( 'la-font-opensans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap', false, '1' );
		wp_enqueue_style( 'la-font-patrickhand', 'https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap', false, '1' );
		
		if ( is_page_template( 'elementor.php' ) || is_page_template( 'front-page.php' ) || is_page_template( 'page.php' ) || is_page_template( 'template-academy-header.php' ) || is_page_template( 'template-blog-header.php' ) ) {
			wp_enqueue_style( 'elementor-layout', get_template_directory_uri() . '/assets/dist/Elementor' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		}

		if ( ! is_page_template( 'elementor.php' ) ) {
			wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/dist/app' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
			wp_enqueue_style( 'wp_block-library', includes_url() . 'css/dist/block-library/style' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		}

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
