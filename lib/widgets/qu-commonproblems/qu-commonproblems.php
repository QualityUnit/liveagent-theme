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
	$path = get_parent_theme_file_path( '/lib/widgets/' . __DIR__ );

	require_once $path . 'includes/cp-item.php';

	// Resources for editor/admin part
	function commonproblems_editor_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . __DIR__;
		$version  = THEME_VERSION;

		wp_enqueue_style(
			'qu_commonproblems_editor_style',
			$path_uri . 'build/qu_commonproblems_edit.css',
			array(),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_commonproblems_frontend_style',
			$path_uri . 'build/qu_commonproblems_frontend.css',
			array(),
			$version,
			false
		);

		wp_enqueue_script(
			'qu_commonproblems_item_editor_script',
			$path_uri . 'build/qu_commonproblems_edit_item.js',
			array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
			$version,
			true
		);

		wp_enqueue_script(
			'qu_commonproblems_editor_script',
			$path_uri . 'build/qu_commonproblems_edit.js',
			array( 'wp-blocks' ),
			$version,
			true
		);
	}

	// Resources for User visible part
	function commonproblems_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . __DIR__;
		$version  = THEME_VERSION;

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/commonproblems', $id ) ) {
				wp_enqueue_style(
					'qu_commonproblems_frontend_style',
					$path_uri . 'build/qu_commonproblems_frontend.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'commonproblems_assets' );
	add_action( 'enqueue_block_editor_assets', 'commonproblems_editor_assets' );


	function render_commonproblems_item( $attr ) {
		return commonproblems_item( $attr );
	}

	register_block_type(
		'qu/commonproblems-item',
		array(
			'qu_commonproblems_editor_style'  => 'qu_commonproblems_editor_style',
			'qu_commonproblems_editor_script' => 'qu_commonproblems_item_editor_script',
			'qu_commonproblems_style'         => 'qu_commonproblems_frontend_style',
			'render_callback'                 => 'render_commonproblems_item',
			'attributes'                      => array(
				'commonproblemsId'     => array(
					'type' => 'string',
				),
				'header'      => array(
					'type'    => 'string',
					'default' => 'Enter problem here…',
				),
				'content'     => array(
					'type'    => 'string',
					'default' => 'Enter solution…',
				),
			),
		),
	);

	function render_commonproblems( $attr, $content ) {
		return '<div class="qu-CommonProblems">							
							<span itemprop="name" style="display:none">' . $pagetitle . '</span>' .
								apply_filters( 'the_content', $content )
						. '</div>';
	}

	register_block_type(
		'qu/commonproblems',
		array(
			'qu_commonproblems_editor_style'  => 'qu_commonproblems_editor_style',
			'qu_commonproblems_editor_script' => 'qu_commonproblems_editor_script',
			'qu_commonproblems_style'         => 'qu_commonproblems_frontend_style',
			'render_callback'                 => 'render_commonproblems',
			'attributes'                      => array(
				'commonproblemsId'   => array(
					'type' => 'string',
				),
			),
		),
	);
}


add_action( 'init', 'qu_commonproblems_init' );
