<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://www.liveagent.com
 * @since             1.0.0
 * @package           QU_Common_Problems
 *
 * @wordpress-plugin
 * Plugin Name:       Quality Unit Common Problems
 * Description:       Common Problems widget for adding question/answer
 * Version:           1.0.0
 * Author:            Quality Unit
 * Author URI:        https://www.liveagent.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       qu-commonproblems
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function qu_commonproblems_init() {
	$path = get_parent_theme_file_path( '/lib/widgets/' . basename( __DIR__ ) );

	// Resources for editor/admin part
	function commonproblems_editor_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . basename( __DIR__ );
		$version  = THEME_VERSION;

		wp_enqueue_style(
			'qu_commonproblems_editor_style',
			$path_uri . '/build/qu_commonproblems_edit.css',
			array(),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_commonproblems_frontend_style',
			$path_uri . '/build/qu_commonproblems_frontend.css',
			array(),
			$version,
			false
		);

		wp_enqueue_script(
			'qu_commonproblems_item_editor_script',
			$path_uri . '/build/qu_commonproblems_edit_item.js',
			array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
			$version,
			true
		);

		wp_enqueue_script(
			'qu_commonproblems_editor_script',
			$path_uri . '/build/qu_commonproblems_edit.js',
			array( 'wp-blocks' ),
			$version,
			true
		);
	}

	add_action( 'enqueue_block_editor_assets', 'commonproblems_editor_assets' );

	require_once $path . '/includes/cp-item.php';

	function render_commonproblems( $attr, $content ) {
		$title = $attr['title'];
		$title = preg_replace( '/\^(.+?)\^/', '<span class="highlight-gradient">$1</span>', $title );

		return '<div class="qu-CommonProblems Faq">
							<h2 class="qu-CommonProblems__title">' . $title . '</h2>
							<p class="qu-CommonProblems__subtitle text-align-center">' .
							$attr['subtitle'] . '<br />' .
							$attr['subtitle2']
						. '</p>' .
								apply_filters( 'the_content', $content )
						. '</div>';
	}

	register_block_type(
		'qu/commonproblems',
		array(
			'qu_commonproblems_editor_style'       => 'qu_commonproblems_editor_style',
			'qu_commonproblems_item_editor_script' => 'qu_commonproblems_item_editor_script',
			'qu_commonproblems_editor_script'      => 'qu_commonproblems_editor_script',
			'render_callback'                      => 'render_commonproblems',
			'attributes'                           => array(
				'title'   => array(
					'type' => 'string',
					'default' => 'Common ^problems and solutions^',
				),
				'subtitle'   => array(
					'type' => 'string',
					'default' => 'Experiencing problems with this software?',
				),
				'subtitle2'   => array(
					'type' => 'string',
					'default' => 'Take a look at our list of the most common problems and find out how you can solve them.',
				),
			),
		),
	);
}

add_action( 'init', 'qu_commonproblems_init' );
