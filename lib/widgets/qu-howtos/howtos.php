<?php
/**
 * Plugin Name:       QU howtos
 * Description:       howtos block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Jozef Remen
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       howtos
*/

function qu_howtos_init() {
	$domain = 'qu-howtos/';
	$path   = get_parent_theme_file_path( '/lib/widgets/' . $domain );

	require_once $path . 'layouts/howto-item.php';

	// Resources for editor/admin part
	function howtos_editor_assets() {
		$domain   = 'qu-howtos/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = THEME_VERSION;

		wp_enqueue_style(
			'qu_howtos_block_editor_style',
			$path_uri . 'build/qu_howtos_edit.css',
			array(),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_howto_block_frontend_style',
			$path_uri . 'build/qu_howtos_frontend.css',
			array(),
			$version,
			false
		);

		wp_enqueue_script(
			'qu_howto_item_editor_script',
			$path_uri . 'build/qu_howto_edit_item.js',
			array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
			$version,
			true
		);

		wp_enqueue_script(
			'qu_howto_editor_script',
			$path_uri . 'build/qu_howtos_edit.js',
			array( 'wp-blocks' ),
			$version,
			true
		);
	}

	// Resources for User visible part
	function howtos_assets() {
		$domain   = 'qu-howtos/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = THEME_VERSION;

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/howto', $id ) ) {
				wp_enqueue_style(
					'qu_howto_block_frontend_style',
					$path_uri . 'build/qu_howtos_frontend.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'howtos_assets' );
	add_action( 'enqueue_block_editor_assets', 'howtos_editor_assets' );


	function render_howto_item( $attr ) {
		return howto_item( $attr );
	}

	register_block_type(
		'qu/howtoitem',
		array(
			'qu_howto_editor_style'       => 'qu_howto_block_editor_style',
			'qu_howto_item_editor_script' => 'qu_howto_item_editor_script',
			'qu_howto_style'              => 'qu_howto_block_frontend_style',
			'qu_howto_frontend'           => 'qu_howto_block_frontend_script',
			'render_callback'             => 'render_howto_item',
			'attributes'                  => array(
				'howtoId'     => array(
					'type' => 'string',
				),
				'howtoItemId' => array(
					'type' => 'string',
				),
				'schemaImage' => array(
					'type' => 'string',
				),
				'header'      => array(
					'type'    => 'string',
					'default' => 'Enter howto title here…',
				),
				'content'     => array(
					'type'    => 'string',
					'default' => '',
				),
			),
		),
	);

	function render_howto( $attr, $content ) {
		$pagetitle = explode( '^', get_the_title() );
		if ( isset( $pagetitle[1] ) ) {
			$pagetitle = esc_html( $pagetitle[0] . ' ' . $pagetitle[1] . ' ' . $pagetitle[2] );
		} else {
			$pagetitle = get_the_title();
		}

		$post_content = apply_filters( 'the_content', $content );

		// Calculating reading time of the post
		$read_time = ceil( strlen( wp_strip_all_tags( $post_content ) ) * 0.035 / 60 ); // About 0,035 seconds per char;

		return '<div class="qu-HowTo" itemscope itemtype="https://schema.org/HowTo"
							data-list="' . $attr['howtoId'] . '">
							<meta itemprop="supply" content="' . $attr['supply'] . '">
							<meta itemprop="tool" content="' . $attr['tool'] . '">
							<meta itemprop="totalTime" content="PT' . ( strlen( $attr['totalTime'] ) > 0 ? $attr['totalTime'] : $read_time ) . 'M">
							
							<span itemprop="name" style="display:none">' . $pagetitle . '</span>' .
								apply_filters( 'the_content', $content )
						. '</div>';
	}

	register_block_type(
		'qu/howto',
		array(
			'qu_howto_editor_style'  => 'qu_howto_block_editor_style',
			'qu_howto_editor_script' => 'qu_howto_editor_script',
			'qu_howto_style'         => 'qu_howto_block_frontend_style',
			'qu_howto_frontend'      => 'qu_howto_block_frontend_script',
			'render_callback'        => 'render_howto',
			'attributes'             => array(
				'howtoId'   => array(
					'type' => 'string',
				),
				'supply'    => array(
					'type'    => 'string',
					'default' => 'Help Desk Software',
				),
				'tool'      => array(
					'type'    => 'string',
					'default' => 'LiveAgent',
				),
				'totalTime' => array(
					'type'    => 'string',
					'default' => '',
				),
			),
		),
	);
}


add_action( 'init', 'qu_howtos_init' );
