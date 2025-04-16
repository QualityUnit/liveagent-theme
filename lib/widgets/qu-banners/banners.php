<?php
/**
 * Plugin Name:       Banners
 * Description:       Banners block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       banners
*/

function banners_block_init() {
	$path = get_template_directory() . '/lib/widgets/qu-banners/';

	require_once $path . 'layouts/banner1.php';

	function banners_editor_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/qu-banners/';
		$version  = THEME_VERSION;
		$js_data  = array(
			'url' => $path_uri . 'images',
		);

		wp_enqueue_script(
			'qu_banners_block_editor_script',
			$path_uri . 'build/qu_banners_edit.js',
			array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data' ),
			$version,
			true
		);

		wp_add_inline_script(
			'qu_banners_block_editor_script',
			'window.quBannersConfig = ' . wp_json_encode( $js_data ) . ';',
			'before'
		);

		wp_enqueue_style(
			'qu_banners_block_editor_style',
			$path_uri . 'build/qu_banners_edit.css',
			array( 'wp-edit-blocks' ),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_banners_block_frontend_style',
			$path_uri . 'build/style-qu_banners_edit.css',
			array( 'wp-edit-blocks' ),
			$version,
			false
		);
	}

	add_action( 'enqueue_block_editor_assets', 'banners_editor_assets' );

	function banners_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/qu-banners/';
		$version  = THEME_VERSION;

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/banners', $id ) ) {

				wp_enqueue_style(
					'qu_banners_block_frontend_style',
					$path_uri . 'build/style-qu_banners_edit.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'banners_assets' );

	function render_banners( $attr ) {
		$layout = $attr['layout'];
		if ( $layout === 'banner1' ) {/*@codingStandardsIgnoreLine */
			return banner1( $attr );
		};
	}

	register_block_type(
		'qu/banners',
		array(
			'qu_banners_editor_script' => 'qu_banners_block_editor_script',
			'qu_banners_editor_style'  => 'qu_banners_block_editor_style',
			'qu_banners_style'         => 'qu_banners_block_frontend_style',
			'render_callback'          => 'render_banners',
			'attributes'               => array(
				'bannerId' => array(
					'type' => 'string',
				),
				'banner1'  => array(
					'type'    => 'object',
					'default' => array(
						'header'      => 'Improve your customer service with the right help desk software',
						'content'     => '<ul><li>Ticketing</li><li>Live Chat</li><li>Social media</li><li>Call center</li><li>Knowledge base</li></ul>',
						'buttonText'  => 'Try for free',
						'buttonUrl'   => '',
						'openInTab'   => false,
						'activeStyle' => 'Improve__service',
					),
				),
				'layout'   => array(
					'type'    => 'string',
					'default' => 'banner1',
				),
				'style'    => array(
					'type'    => 'array',
					'default' => array(
						'banners--block__negative has-bg',
						'',
						'banners--block__grey',
					),
				),

			),
		)
	);
}

add_action( 'init', 'banners_block_init' );
