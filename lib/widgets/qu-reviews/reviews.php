<?php
/**
 * Plugin Name:       QU Reviews Widget
 * Description:       Reviews widget block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Jozef Remen
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       reviews
*/


function qu_reviews_init() {
	$domain = 'qu-reviews/';
	$path   = get_parent_theme_file_path( '/lib/widgets/' . $domain );

	// Resources for editor/admin part
	function reviews_editor_assets() {
		$domain   = 'qu-reviews/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = THEME_VERSION;

		wp_enqueue_style(
			'qu_reviews_editor_style',
			$path_uri . 'build/qu_reviews_edit.css',
			array(),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_reviews_frontend_style',
			$path_uri . 'build/qu_reviews_frontend.css',
			array(),
			$version,
			false
		);

		wp_enqueue_script(
			'qu_reviews_editor_script',
			$path_uri . 'build/qu_reviews_edit.js',
			array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
			$version,
			true
		);
	}

	// Resources for User visible part
	function reviews_assets() {
		$domain   = 'qu-reviews/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = THEME_VERSION;

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/reviews', $id ) ) {
				wp_enqueue_style(
					'qu_reviews_frontend_style',
					$path_uri . 'build/qu_reviews_frontend.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'reviews_assets' );
	add_action( 'enqueue_block_editor_assets', 'reviews_editor_assets' );


	function render_reviews( $attr ) {
		return '
			<div class="qu-expertNote" itemscope itemtype="https://schema.org/Claim">
				
			</div>
		';
		// @codingStandardsIgnoreEnd
	}

	register_block_type(
		'qu/reviews',
		array(
			'qu_reviews_editor_style'  => 'qu_reviews_editor_style',
			'qu_reviews_editor_script' => 'qu_reviews_editor_script',
			'qu_reviews_style'         => 'qu_reviews_frontend_style',
			'render_callback'          => 'render_reviews',
			'attributes'               => array(
				'categoryId' => array(
					'type'    => 'string',
				),
				'reviewId' => array(
					'type'    => 'string',
				),
			),
		),
	);
}


add_action( 'init', 'qu_reviews_init' );
