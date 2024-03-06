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
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'elementor-custom' );

		// Using screen for media to avoid defer loading in import-functions.php condition, function preload_custom_styles 
		if ( is_singular( 'ms_research' ) ) {
			wp_enqueue_style( 'research-single', get_template_directory_uri() . '/assets/dist/pages/Research' . isrtl() . wpenv() . '.css', false, THEME_VERSION, 'screen' );
		}

		if ( is_singular( 'ms_reviews' ) ) {
			wp_enqueue_style( 'reviews-single', get_template_directory_uri() . '/assets/dist/pages/Reviews' . isrtl() . wpenv() . '.css', false, THEME_VERSION, 'screen' );
		}

		if ( is_page_template( 'elementor.php' ) || is_page_template( 'front-page.php' ) || is_page_template( 'page.php' ) || is_page_template( 'template-academy-header.php' ) || is_page_template( 'template-blog-header.php' ) ) {
			wp_enqueue_style( 'elementor-layout', get_template_directory_uri() . '/assets/dist/Elementor' . isrtl() . wpenv() . '.css', false, THEME_VERSION, 'screen' );
		}

		if ( is_page_template( 'template-blog-header.php' ) || is_page_template( 'template-academy-header.php' ) ) {
			wp_enqueue_style( 'elementor-custom', get_template_directory_uri() . '/assets/dist/common/elementor-custom' . isrtl() . wpenv() . '.css', false, THEME_VERSION, 'screen' );

			if ( is_page_template( 'template-blog-header.php' ) ) {
				wp_enqueue_style( 'post', get_template_directory_uri() . '/assets/dist/pages/post' . isrtl() . wpenv() . '.css', false, THEME_VERSION, 'screen' );
			}
		}

		if ( ! is_page_template( 'elementor.php' ) ) {
			wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/dist/app' . isrtl() . wpenv() . '.css', false, THEME_VERSION, 'screen' );
		}

		require_once get_template_directory() . '/functions/components-imports.php';
		components_imports();
	},
	100
);

add_action(
	'get_footer',
	function () {
		if ( ! is_page_template( 'elementor.php' ) ) {
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
		wp_enqueue_script( 'popper_js', get_template_directory_uri() . '/assets/dist/popper' . wpenv() . '.js', array( 'wp-i18n' ), THEME_VERSION, true );
		wp_enqueue_script( 'app_js', get_template_directory_uri() . '/assets/dist/app' . wpenv() . '.js', array( 'wp-i18n' ), THEME_VERSION, true );
	}
);
